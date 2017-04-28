<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use App\Jobs\UploadFilesToS3;
use App\Jobs\RemoveFileFromS3;
use App\File;
use App\Problem;
use App\ProblemSolutions;
use Auth;
use Validator, Image;

class UploadController extends Controller
{
	
    public function saveImage(Request $request){
        if($request->hasFile('file')){
            $input = $request->all();
     
            $rules = array(
                'file' => 'image|max:3000|mimes:jpeg,jpg,png',
            );
     
            $validation = Validator::make($input, $rules);
     
            if ($validation->fails()) {
                return back();
            }
     
            $destinationPath = 'uploads'; // upload path
            $extension = $request->file('file')->getClientOriginalExtension(); // getting file extension
            $fileName = time() . '.' . $extension;

            // $upload_success = $request->file('file')->move(public_path('img'), $fileName); // uploading file to given path
            Image::make($request->file('file'))->fit(200)->save(public_path('img/'.$fileName));

            $user = Auth::user();
            $user->picture = $fileName;
            $user->save();
            return back();
        }
        return back();
    }

    /**
    */
    public function uploadProblem(Request $request){
        
        if($request->hasFile('file')){
            $manipulatedFile = $this->fileManipulation('/uploads', $request);

            //Dispatch Upload file to Amazon S3 job  
            $this->dispatch(new UploadFilesToS3($manipulatedFile[0], $manipulatedFile[1]));

        }
    }

    public function uploadSolution(Request $request){
        if($request->hasFile('file')){

            
            
            $manipulatedFile = $this->fileManipulation('/uploads/solutions');
          

            

            $file = new File();
            $file->fileName = $manipulatedFile[0];
            $file->save();

            $problem = Problem::findorFail($request->prob_id);
            $problem->took = 2;
            $problem->save();

            $probSol = new ProblemSolutions();
            $probSol->file()->associate($file);
            $probSol->problem()->associate($problem);
            $probSol->save();
        }
    }

    private function fileManipulation($path, $request){
        $input = $request->all();
     
        $rules = array(
            'file' => 'max:15000|mimes:jpeg,jpg,png,zip',
        );
 
        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return back();
        }

        $file = $request->file('file');
        $path_parts = pathinfo($file->getClientOriginalName());
        $fileName = $path_parts['filename'];
        $fileExt = $path_parts['extension'];
        $rightNow = Auth::id();

        $hFileName = hash('md5', $fileName.'_'.$rightNow) . '.' . $fileExt;
        $file->move(storage_path(). $path, $hFileName);
        $file2 = storage_path(). $path.'/'. $hFileName;

        return [$hFileName, $file2];

    }

    public function removeUploadedFile(Request $request){
        $file = $request->fileName;
        $pos = strpos($file, ".");
        $rightNow = Auth::id();
        
        $fileName = substr($file, 0, $pos);
        $fileExt = substr($file, $pos, strlen($file));

        
        $hFileName = hash('md5', $fileName.'_'.$rightNow) . $fileExt;
        $this->dispatch(new RemoveFileFromS3($hFileName));
    }

}

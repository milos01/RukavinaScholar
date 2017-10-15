<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Events\SaveFileEvent;
use App\Http\Requests\SaveTaskFileRequest;
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
    public function uploadProblem(SaveTaskFileRequest $request){
        $manipulatedFile = $this->fileManipulation('new_task_upload', $request);

        //Dispatch Upload file to Amazon S3 job
        // $this->dispatch(new UploadFilesToS3($manipulatedFile[0], $manipulatedFile[1]));
        return response($manipulatedFile, 200);
    }

    public function deltefile(Request $request){
        Storage::disk('new_task_upload')->delete($request->name);
        return response('ok',200);
    }

    public function uploadSolution(Request $request){
        if($request->hasFile('file')){



            $manipulatedFile = $this->fileManipulation('new_task_upload', $request);

							$file = new File();
	            $file->fileName = $manipulatedFile[0];
	            $file->save();

	            $problem = Problem::findorFail($request->prob_id);
							if ($request->solutionDesc) {
								$problem->solution_description = $request->solutionDesc;
							}
	            $problem->took = 2;
	            $problem->save();

	            $probSol = new ProblemSolutions();
	            $probSol->file()->associate($file);
	            $probSol->problem()->associate($problem);
	            $probSol->save();

            // $this->dispatch(new UploadFilesToS3($manipulatedFile[0], $manipulatedFile[1]));



        }
    }

    private function fileManipulation($pathName, $request){
        $file = $request->file('file');
        $path_parts = pathinfo($file->getClientOriginalName());
        $fileName = $path_parts['basename'];
        $fileName = event(new SaveFileEvent($pathName, $fileName, $file));
      
        return $fileName;

    }

    private function makeFileName($extension){
        return time().".".$extension;
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

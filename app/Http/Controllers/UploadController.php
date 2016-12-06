<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use App\Jobs\UploadFilesToS3;
use App\File;
use App\Problem;
use App\ProblemSolutions;
use Auth;

class UploadController extends Controller
{
	
    public function saveImage(Request $request){
        if($request->hasFile('file')){
            $input = $request->all();
     
            $rules = array(
                'file' => 'image|max:3000',
            );
     
            $validation = Validator::make($input, $rules);
     
            if ($validation->fails()) {
                return Response::make($validation->errors->first(), 400);
            }
     
            $destinationPath = 'uploads'; // upload path
            $extension = $request->file('file')->getClientOriginalExtension(); // getting file extension
            $fileName = time() . '.' . $extension;

            // $upload_success = $request->file('file')->move(public_path('img'), $fileName); // uploading file to given path
            Image::make($request->file('file'))->fit(200)->save(public_path('img/'.$fileName));

            $user = Auth::user();
            $user->picture = $fileName;

            $user->save();
        }
    }

    public function uploadProblem(Request $request){
        
        if($request->hasFile('file')){

            $file = $request->file('file');
            $path_parts = pathinfo($file->getClientOriginalName());
            $fileName = $path_parts['filename'];
            $fileExt = $path_parts['extension'];
            $rightNow = Auth::id();

            $hFileName = hash('md5', $fileName.'_'.$rightNow) . '.' . $fileExt;

            $file->move(storage_path(). '/uploads', $hFileName);
            $file2 = storage_path(). '/uploads/'. $hFileName;

            //Dispatch Upload file to Amazon S3 job  
            $this->dispatch(new UploadFilesToS3($hFileName, $file2));

        }
    }

    public function uploadSolution(Request $request){
        if($request->hasFile('file')){

            $file = $request->file('file');
            $path_parts = pathinfo($file->getClientOriginalName());
            $fileName = $path_parts['filename'];
            $fileExt = $path_parts['extension'];

            $hFileName = hash('md5', $fileName) . '.' . $fileExt;

            $file->move(storage_path(). '/uploads', $hFileName);
            $file2 = storage_path(). '/uploads/'. $hFileName;

            //Dispatch Upload file to Amazon S3 job
            $this->dispatch(new UploadFilesToS3($hFileName, $file2));

            $file = new File();
            $file->fileName = $hFileName;
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



}

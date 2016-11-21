<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use App\Jobs\UploadFilesToS3;
use App\File;
use App\Problem;
use App\ProblemSolutions;

class UploadController extends Controller
{
	

    public function uploadProblem(Request $request){
        
        if($request->hasFile('file')){
            $file = $request->file('file');

            $fileName = $file->getClientOriginalName();
            $file->move(storage_path(). '/uploads', $fileName);
            $file2 = storage_path(). '/uploads/'. $fileName;

            //Dispatch Upload file to Amazon S3 job  
            $this->dispatch(new UploadFilesToS3($fileName, $file2));

            //    
        }
    }

    public function uploadSolution(Request $request){
        if($request->hasFile('file')){

            $file = $request->file('file');

            $fileName = $file->getClientOriginalName();
            $file->move(storage_path(). '/uploads', $fileName);
            $file2 = storage_path(). '/uploads/'. $fileName;

            // $this->dispatch(new UploadFilesToS3($fileName, $file2));

            $file = new File();
            $file->fileName = hash('md5', $fileName) . '.' . substr($fileName, -3);
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

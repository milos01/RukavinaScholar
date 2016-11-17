<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use App\Jobs\UploadFilesToS3;

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
            
            // unlink($file2);   
        }
    }

    public function uploadSolution(Request $request){
        if($request->hasFile('file')){
            $file = $request->file('file');

            $fileName = $file->getClientOriginalName();
            $file->move(storage_path(). '/uploads', $fileName);
            $file2 = storage_path(). '/uploads/'. $fileName;

            // $this->s3->put($fileName, fopen($file2,'r+'), 'public');
            unlink($file2);   
        }
    }

}

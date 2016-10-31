<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Offer;
use App\File;
use App\Problem;
use Auth,Zipper;
use Illuminate\Support\Facades\Storage;
class ProblemController extends Controller
{
	public function __construct()
    {
        // $this->middleware('auth');
    }

    public function showProblem($id){
    	$problem = Problem::findorFail($id);
    	$myMessagess = Auth::user()->fromMessages()->where('last', 1)->orWhere('user_to', Auth::user()->id)->where('last', 1)->groupBy('group_start','group_end')->orderBy('id', 'DESC')->get();
        $count = 0;
        foreach ($myMessagess as $key => $message) {
            if ($message->pivot->read == 0 and $message->pivot->user_to == Auth::id()) {
               $count++; 
            }
        }
    	return view('problem')->with('problem', $problem)->with('myMessagesCount', $count);
    }

    public function showMyProblem($id){
        $problem = Problem::findorFail($id);
        $myMessagess = Auth::user()->fromMessages()->where('last', 1)->orWhere('user_to', Auth::user()->id)->where('last', 1)->groupBy('group_start','group_end')->orderBy('id', 'DESC')->get();
        $count = 0;
        foreach ($myMessagess as $key => $message) {
            if ($message->pivot->read == 0 and $message->pivot->user_to == Auth::id()) {
               $count++; 
            }
        }
        return view('myProblem')->with('problem', $problem)->with('myMessagesCount', $count);
    }

    public function takeProblem($id){
    	$problem = Problem::findorFail($id);
    	$luser = Auth::user();
    	$problem->took = 1;
        $problem->main_slovler = $luser->id;
    	$problem->save();
        

    	return redirect('/home');
    }

    public function getAllProblems(){
        $allProblems = Problem::all();

        return json_encode($allProblems);
    }


    public function assigned(){
    	$authId = Auth::id();
    	$myProblems = Auth::user()->problems;
        $myMessagess = Auth::user()->fromMessages()->where('last', 1)->orWhere('user_to', Auth::user()->id)->where('last', 1)->groupBy('group_start','group_end')->orderBy('id', 'DESC')->get();
        $count = 0;
        foreach ($myMessagess as $key => $message) {
            if ($message->pivot->read == 0 and $message->pivot->user_to == Auth::id()) {
               $count++; 
            }
        }
    	return view('myProblems')->with('myProblems', $myProblems)->with('myMessagesCount', $count);
    }

    public function addMate(Request $request){
        $userId = $request->input('userId');
        $problemId = $request->input('problemId');
        $user = User::findorFail($userId);
    
        $user->problems()->attach($problemId);
        return $user;
    }

    public function deleteWorker(Request $request){
        $problemId = $request->input('problemId');
        $userId = $request->input('userId');

        $user = User::findorFail($userId);
        
        $user->problems()->detach($problemId);     
        
    }

    public function newProblem(){
        $myMessagess = Auth::user()->fromMessages()->where('last', 1)->orWhere('user_to', Auth::user()->id)->where('last', 1)->groupBy('group_start','group_end')->orderBy('id', 'DESC')->get();
        $count = 0;
        foreach ($myMessagess as $key => $message) {
            if ($message->pivot->read == 0 and $message->pivot->user_to == Auth::id()) {
               $count++; 
            }
        }
        return view('newProblem')->with('myMessagesCount', $count);
    }

    public function uploadProblem(Request $request){
        $s3 = Storage::disk('s3');
        if($request->hasFile('file')){
            $file = $request->file('file');

            $fileName = $file->getClientOriginalName();
            $file->move(storage_path(). '/uploads', $fileName);
            $file2 = storage_path(). '/uploads/'. $fileName;

            $s3->put($fileName, fopen($file2,'r+'), 'public');   
        }
    }

    public function newproblemsubmit(Request $request){
        $user = Auth::user()->id;
        $problem = new Problem();
        $problem->subject = $request->probName;
        $problem->person_from = $user;
        $problem->main_slovler = 1;
        $problem->problem_description = $request->probDescription;
        $problem->took = 0;
        $problem->waiting = 1;
        $problem->save();

        
        foreach ($request->selectedFiles as $value) {
            $file = new File();
            $file->problem()->associate($problem);
            $file->fileName = $value;
            $file->save();
        }
        // $file->files()->associate($user);

        // dd($request->all());
    }

    public function problemDownload($id){
        $s3 = Storage::disk('s3');
        // dd($s3->url('test.txt'));
        // return response()->download($s3->url('test.txt'));
    }

    public function getproblemoffers(Request $request){
        $problemOffers = Problem::findorFail($request->probId)->offers;
        return $problemOffers->toArray();
    }

    public function getOneUserProblems(){
        $userProblems = Problem::where('person_from', Auth::user()->id)->get();
        // dd($userProblems);
        return $userProblems->toArray();
    }
}

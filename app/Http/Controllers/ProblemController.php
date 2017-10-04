<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Offer;
use App\File;
use App\ProblemFiles;
use App\Problem;
use Auth,Zipper;
use Crypt;
use Carbon\Carbon;
class ProblemController extends Controller
{
	protected $now;
	public function __construct()
    {
        // $this->middleware('auth');
		$this->now = Carbon::now();
    }

    public function showProblem($id){
    	$problem = Problem::with('task_type')->with('offers')->findorFail($id);

    	return view('problem')->with('problem', $problem);
    }

    public function showMyProblem($id){
        $problem = Problem::findorFail($id);
        $myMessagess = Auth::user()->fromMessages()->where('last', 1)->orWhere('user_to', Auth::user()->id)->where('last', 1)->groupBy('group_start','group_end')->orderBy('id', 'DESC')->get();
        $countn = 0;
        foreach ($myMessagess as $key => $message) {
            if ($message->pivot->read == 0 and $message->pivot->user_to == Auth::id()) {
               $countn++;
            }
        }
        return view('myProblem')->with('problem', $problem)->with('myMessagesCount', $countn);
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
        $allProblems = Problem::with('offers')->with('user_from')->with('task_type')->get();
        return $allProblems;
    }


    public function assigned(){
    	$authId = Auth::id();
    	$myProblems = Auth::user()->problems;
        $this->readAssigns($myProblems);
        $myMessagess = Auth::user()->fromMessages()->where('last', 1)->orWhere('user_to', Auth::user()->id)->where('last', 1)->groupBy('group_start','group_end')->orderBy('id', 'DESC')->get();
        $countn = 0;
        foreach ($myMessagess as $key => $message) {
            if ($message->pivot->read == 0 and $message->pivot->user_to == Auth::id()) {
               $countn++;
            }
        }

        $myAssigns = Auth::user()->problems()->where('read', 0)->get();
    	return view('myProblems')->with('myProblems', $myProblems)->with('myMessagesCount', $countn)->with('myAssigns', count($myAssigns));
    }

    private function readAssigns($problems){
        foreach ($problems as $value) {
            if ($value->pivot->read == 0) {
                $value->pivot->read = 1;
                $value->pivot->save();
            }
        }
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
		public function inactiveProblem($id){
			$problem = Problem::findOrFail($id);
			$problem->inactive = 1;
			$problem->save();
			return $problem;
		}

    public function newProblem(){
        $myMessagess = Auth::user()->fromMessages()->where('last', 1)->orWhere('user_to', Auth::user()->id)->where('last', 1)->groupBy('group_start','group_end')->orderBy('id', 'DESC')->get();
        $countn = 0;
        foreach ($myMessagess as $key => $message) {
            if ($message->pivot->read == 0 and $message->pivot->user_to == Auth::id()) {
               $countn++;
            }
        }
        return view('newProblem')->with('myMessagesCount', $countn);
    }

    public function newproblemsubmit(Request $request){
        $user = Auth::user()->id;
        $problem = new Problem();
        $problem->subject = $request->probName;
        $problem->person_from = $user;
        $problem->main_slovler = $user;
        $problem->problem_type = $request->probType;
        $problem->problem_description = $request->probDescription;
        $problem->took = 0;
        $problem->waiting = 1;
        $problem->time_ends_at = $this->now->addMinutes(env('PROBLEM_EXPIRE_MINUTES'));
        $problem->save();


        foreach ($request->selectedFiles as $value) {

            $findExtension = strpos($value, ".");
            $fp =  $findExtension;
            $fileExt = substr($value, ++$fp, strlen($value));
            $fileName = substr($value, 0, $findExtension);
            $rightNow = Auth::id();


            $file = new File();
            $file->fileName = hash('md5', $fileName.'_'.$rightNow) . '.' . $fileExt;
            $file->save();

            $probFile = new ProblemFiles();
            $probFile->file()->associate($file);
            $probFile->problem()->associate($problem);
            $probFile->save();
        }


        // $file->files()->associate($user);

        // dd($problem->files);
    }

		public function updateProblemExpireTime($id){
			$problem = Problem::findOrFail($id);
			$problem->time_ends_at = $this->now->addMinutes(env('PROBLEM_EXPIRE_MINUTES'));
			$problem->waiting = 1;
			$problem->save();
			return back();

		}
    public function problemDownload($id){
        $s3 = Storage::disk('s3');
        // dd($s3->url('test.txt'));
        // return response()->download($s3->url('test.txt'));
    }

    public function getproblemoffers(Request $request){
        $problemOffers = Problem::findorFail($request->probId)->offers;
        $offers = [];
        foreach ($problemOffers as $key => $offer) {
            $off = Offer::with('personFrom')->find($offer->id);
            array_push($offers, $off);
        }
        return $offers;
    }

    public function getOneUserProblems(){
        $userProblems = Problem::with('offers')->with('task_type')->where('person_from', Auth::user()->id)->get();
        return $userProblems;
    }

    public function getProblem($probId){
        $list = [];
        $problem = Problem::with('offers')->with('user_from')->with('task_type')->findorFail($probId);
        array_push($list, $problem);
        return $list;
    }

		public function resetWaiting($id){
			$problem = Problem::findOrFail($id);
			$problem->waiting = 0;
			$problem->save();
			return $problem;
		}

		public function acceptProblem(Request $request){
    	    $probId = $request->probId;
    	    $problem = Problem::findorFail($probId);
    	    $problem->took = 1;
            $problem->main_slovler = $request->sloId;

    	    $luser = User::findorFail($request->sloId);
    	    $luser->problems()->attach($probId, ['read' => 0]);
        	if ($problem->save()) {
        		return response()->json('Ok');
        	}else{
        		return response()->json('Server error');
        	}

    }
}

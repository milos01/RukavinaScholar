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
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;
use App\Http\Transformers\ProblemTransformer;

class ProblemController extends Controller
{
	protected $now;
    protected $manager;

	public function __construct()
    {
        $this->manager = new Manager();
        $this->manager->setSerializer(new DataArraySerializer());
		$this->now = Carbon::now();
    }

    public function showProblem($problem_id){
    	$problem = Problem::with('task_type')->with('offers')->findorFail($problem_id);

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
        $allProblems = Problem::all();

        $resource = new Collection($allProblems, new ProblemTransformer());
        return $this->manager->createData($resource)->toArray();
    }


    public function assigned(){
        // $myAssigns = Auth::user()->problems()->where('read', 0)->get();
    	return view('myProblems');
    }

    public function getAssignedToMe(){
        $myProblems = Auth::user()->problems()->with('task_type')->get();
        $this->readAssigns($myProblems);
        return $myProblems;
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
        $user = Auth::id();
        $problem = Problem::create([
            'subject' => $request->probName,
            'person_from' => $user,
            'main_slovler' => $user,
            'problem_type' => $request->probType,
            'problem_description' => $request->probDescription,
            'took' => 0,
            'waiting' => 1,
            'time_ends_at' => $this->now->addMinutes(env('PROBLEM_EXPIRE_MINUTES')),
        ]);
        
        foreach ($request->selectedFiles as $media) {
            $file = $this->saveFile($problem, $media);
            $problem->files()->attach($file->id);
        }

        $resource = new Item($problem, new ProblemTransformer());
        return $this->manager->createData($resource)->toArray();
    }

    public function newsolutionsubmit(Request $request){
        $problem = Problem::findOrFail($request->task_id);
        foreach ($request->selectedFiles as $media) {
            $file = $this->saveFile($problem, $media);
            $problem->solutions()->attach($file->id);
        }
        $problem->solution_description = $request->probDescription;
        $problem->save();
    }

    private function saveFile($problem, $media){
        return File::create([
            'fileName' => $media['name'],
        ]);
    }

	public function updateProblemExpireTime($id){
		$problem = Problem::findOrFail($id);
		$problem->time_ends_at = $this->now->addMinutes(env('PROBLEM_EXPIRE_MINUTES'));
		$problem->waiting = 1;
		$problem->save();
		return $problem;

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
        $userProblems = Auth::user()->myProblems;

        $resource = new Collection($userProblems, new ProblemTransformer());
        return $this->manager->createData($resource)->toArray();
    }

    public function getProblem($probId){
        $problem = Problem::with('offers')->with('user_from')->with('task_type')->with('solutions')->with('mainSolver')->findorFail($probId);
        return $problem;
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
    	$problem->save();

        return $problem->with('mainSolver')->first();
    }
}

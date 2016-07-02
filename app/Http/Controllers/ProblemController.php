<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Problem;
use Auth;
class ProblemController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function showProblem($id){
    	$problem = Problem::findorFail($id);
    	$myMessagess = Auth::user()->fromMessages()->where('last', 1)->orWhere('user_to', Auth::user()->id)->where('last', 1)->groupBy('group_start','group_end')->orderBy('id', 'DESC')->get();
    	return view('problem')->with('myMessagess', $myMessagess->count())->with('problem', $problem);
    }

    public function takeProblem($id){
    	$problem = Problem::findorFail($id);
    	$luser = Auth::user();
    	$problem->took = 1;
    	$problem->save();
        $luser->problems()->attach($problem->id /*array('message' => $message, 'read' => 0, 'group_start' => $min, 'group_end' => $max, 'last' => 1)*/);

    	return redirect('/home');
    }

    public function assigned(){
    	$authId = Auth::id();
    	$myProblems = Auth::user()->problems;
    	return view('myProblems')->with('myProblems', $myProblems);
    }

    public function addMate(Request $request){
        $userId = $request->input('userId');
        $problemId = $request->input('problemId');
        $user = User::findorFail($userId);

        $user->problems()->attach($problemId);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
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
    	$problem->person_name = $luser->id; 
    	$problem->save();

    	return redirect('/home');
    }

    public function assigned(){
    	$authId = Auth::id();
    	$myProblems = Problem::all()->where('person_name', $authId);
    	return view('myProblems')->with('myProblems', $myProblems);
    }
}

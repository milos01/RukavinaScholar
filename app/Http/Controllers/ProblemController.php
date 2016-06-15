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
}

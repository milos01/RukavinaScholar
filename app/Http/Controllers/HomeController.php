<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Problem;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myMessagess = Auth::user()->fromMessages()->where('last', 1)->orWhere('user_to', Auth::user()->id)->where('last', 1)->groupBy('group_start','group_end')->orderBy('id', 'DESC')->get();
        $allProblems = Problem::all();

        return view('homeCenter')->with('myMessagess', $myMessagess->count())->with('allProblems',$allProblems);
    }

     public function showAdminHome(){
       
        return view('homeCenter');
     }

     public function showUserProfile($id){
        $user = User::findOrFail($id);
        return view('userProfile')->with('user',$user);
     }
}

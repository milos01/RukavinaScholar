<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth,DB;

class InboxController extends Controller
{
    public function showInbox(){
    	
    	$myMessages = Auth::user()->fromMessages()->groupBy(min('user_from', 'user_to'), max('user_from','user_to'))->get();
    	return view('inbox')->with('myMessages', $myMessages);
    }
}

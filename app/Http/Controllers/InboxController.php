<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth,DB;

class InboxController extends Controller
{
    public function showInbox(){
    	
    	$myMessages = Auth::user()->fromMessages()->where('last', 1)->orWhere('user_to', Auth::user()->id)->groupBy('group_start','group_end')->orderBy('id', 'DESC')->get();


    	
    	return view('inbox')->with('myMessages', $myMessages);
    }

    public function showUsersMessages($id){
    	$user = User::find($id);
    	if ($id < $user->id) {
    		$min = $id;
    		$max = $user->id;
    	}
    	$min = $user->id;
    	$max = $id;

    	$myMessages = Auth::user()->fromMessages()->where('user_to', Auth::id())->orWhere('group_start',$min)->orWhere('group_end', $max)->get();
    	$myMessages->last()->pivot->read = 1;
    	$myMessages->last()->pivot->save();
    	
    	return view('messages')->with('user', $user)->with('myMessages', $myMessages);
    }

    public function sendMessage(Request $request){
    	$message = $request->get('message');
		$userId = $request->get('id');
		if (Auth::id() < $userId) {
    		$min = Auth::id();
    		$max = $userId;
    	}else{
	    	$min = $userId;
	    	$max = Auth::id();
    	}
    	$user = Auth::user();
    	$user->fromMessages()->attach($userId, array('message' => $message, 'read' => 0, 'group_start' => $min, 'group_end' => $max, 'last' => 1));
    	
    	 $variable = array( 'variable1' => $message, 
                        'variable2' => $userId );
    	return json_encode($variable);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth,DB;

class InboxController extends Controller
{
    public function showInbox(){
    	
    	$myMessages = Auth::user()->fromMessages()->where('last', 1)->orWhere('user_to', Auth::user()->id)->where('last', 1)->groupBy('group_start','group_end')->orderBy('id', 'DESC')->get();
        $myMessagess = Auth::user()->fromMessages()->where('last', 1)->orWhere('user_to', Auth::user()->id)->where('last', 1)->groupBy('group_start','group_end')->orderBy('id', 'DESC')->get();
    	return view('inbox')->with('myMessages', $myMessages)->with('myMessagess', $myMessagess->count());
    }

    public function showUsersMessages($id){
    	$user = Auth::user();
    	if ($id < $user->id) {
    		$min = $id;
    		$max = $user->id;
    	}else{
    	   $min = $user->id;
    	   $max = $id;
        }
        
        $toUser = User::find($id);
    	$myMessages = Auth::user()->fromMessages()->where('user_to', Auth::id())->orWhere('group_start',$min)->where('group_end', $max)->orderBy('pivot_id','ASC')->get();
    	$myMessages->last()->pivot->read = 1;
    	$myMessages->last()->pivot->save();
    	
    	return view('messages')->with('user', $toUser)->with('myMessages', $myMessages);
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
        $changeLastMessage = $user->fromMessages()->where('group_start',$min)->where('group_end',$max)->where('last',1)->orWhere('user_to', Auth::id())->where('group_start',$min)->where('group_end',$max)->where('last',1)->get();
        $changeLastMessage->last()->pivot->last = 0;
        $changeLastMessage->last()->pivot->save();
    	$user->fromMessages()->attach($userId, array('message' => $message, 'read' => 0, 'group_start' => $min, 'group_end' => $max, 'last' => 1));
    	
    	 $variable = array( 'variable1' => $message, 
                        'variable2' => $userId );
    	return json_encode($variable);
    }
}

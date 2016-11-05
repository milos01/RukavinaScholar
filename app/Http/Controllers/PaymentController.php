<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Problem;
use App\Offer;
use App\User;
use Auth;
use App\Http\Requests;

class PaymentController extends Controller
{
    public function problemPaymentShow($problemId, $offerId){
    	$problem = Problem::findorFail($problemId);
    	$offer = Offer::with('personFrom')->findorFail($offerId);
    	// dd($offer);
    	$myMessagess = Auth::user()->fromMessages()->where('last', 1)->orWhere('user_to', Auth::user()->id)->where('last', 1)->groupBy('group_start','group_end')->orderBy('id', 'DESC')->get();
        $count = 0;
        foreach ($myMessagess as $key => $message) {
            if ($message->pivot->read == 0 and $message->pivot->user_to == Auth::id()) {
               $count++; 
            }
        }
    	return view('payment')->with('problem', $problem)->with('myMessagesCount', $count)->with('offer', $offer);
    }

    public function placeOffer(Request $request){
    	$problemId = $request->probId;
    	$problem = Problem::findorFail($problemId);
    	$problem->waiting = 0;
    	$price = $request->price;

    	$offer = new Offer();
    	$offer->problem()->associate($problem);
    	$offer->personFrom()->associate(Auth::user());
    	$offer->price = $price;

    	if ($offer->save() and $problem->save()) {
    		return response()->json("Ok");
    	}

    	return response()->json("Server error");

    }

    public function makePayment(Request $request){
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

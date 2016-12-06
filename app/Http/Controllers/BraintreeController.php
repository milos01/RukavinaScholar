<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Braintree_ClientToken;

class BraintreeController extends Controller
{
    public function generateToken(Request $request){
    	return response()->json([
		    'token' => Braintree_ClientToken::generate(),
		]);
    }
}

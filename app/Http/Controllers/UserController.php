<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\MakeUserRequest;
use App\User;
use Hash;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addStaff(MakeUserRequest $request)
    {
          $user = new User;

        $user->name = $request->fname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->lastName = $request->lname;
        $user->role = 'moderator';

        if ($user->save()) {
            return redirect('/home/admin/manage');
        }else{
            return redirect('/home/admin/manage')->with('alert', 'Something went wrong :(');
        }
    }

    public function upgradeAdmin($id){
        $user = User::find($id);
        $user->role = 'admin';
        if($user->save()){
            return redirect('/home/admin/manage');
        }

    }

    public function donwgradeAdmin($id){
        $user = User::find($id);
        $user->role = 'moderator';
        if($user->save()){
            return redirect('/home/admin/manage');
        }
    }
}

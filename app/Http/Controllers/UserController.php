<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\MakeUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\NewImageRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\User;
use Hash, Auth,DB;


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
            return redirect('/home/manage');
        }else{
            return redirect('/home/manage')->with('alert', 'Something went wrong :(');
        }
    }

    public function upgradeAdmin($id){
        $user = User::find($id);
        $user->role = 'admin';
        if($user->save()){
            return redirect('/home/manage');
        }

    }

    public function donwgradeAdmin($id){
        $user = User::find($id);
        $user->role = 'moderator';
        if($user->save()){
            return redirect('/home/manage');
        }
    }

    public function editUser(){
        return view('editUser');
    }

    public function updateUser(UpdateUserRequest $request){
        $user = Auth::user();
        $user->name = $request->fname;
        $user->lastName = $request->lname;
        if($user->save()){
            return redirect('/home/edit');
        }
    }

    public function saveImage(NewImageRequest $request){
        if ($request->file('picture')) {
            $request->file('picture')->move(public_path('img'), $request->file('picture')->getClientOriginalName());
            $user = Auth::user();
            $user->picture = $request->file('picture')->getClientOriginalName();
            if($user->save()){
                return redirect('/home/edit');
            }
        }else{
            return "error";
        }
    }

    public function updatePassword(UpdatePasswordRequest $request){
        $user = Auth::user();
        $hashedPassword = Hash::make($request->newPassword);
        if (Hash::check($user, $hashedPassword))
        {
            return "error";
        }
        $user->password = $hashedPassword;
        if ($user->save()) {
            return redirect('/home/edit');
        }
    }

    public function getApiUsers(Request $request){
        $keyword = $request->input('username');
        $allUsers = User::where(DB::raw("CONCAT(`name`, ' ', `lastName`)"), 'LIKE', '%'.$keyword.'%')->where(function($q) {
          $q->where('role', 'admin')
            ->orWhere('role', 'moderator');
      })->get();
        return json_encode($allUsers);
    }
}

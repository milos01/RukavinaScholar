<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\MakeUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\NewImageRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\User;
use App\Events\makeProfilePictureEvent;
use Hash, Auth,DB, Input, Validator, Response, Image;


class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserProfile(User $user){
        return view('userProfile')->with('user',$user);
     }

    public function addStaff(MakeUserRequest $request)
    {
        $user = User::create([
            'name' => $request->fname,
            'email' =>  $request->email,
            'password' => Hash::make('defPass'),
            'lastName' => $request->lname,
            'username' => $request->username,
            'role_id' => 2,
        ]);

        event(new makeProfilePictureEvent($request->email, $request->fname, $request->lname));
        return back();
    }

    public function upgradeAdmin($id){
        $user = User::find($id);
        $user->role_id = 3;
        if($user->save()){
            return back();
        }

    }

    public function donwgradeAdmin($id){
        $user = User::find($id);
        $user->role_id = 2;
        if($user->save()){
            return back();
        }
    }
    /**
    * Display the specified resource.
    * GET /user/{id}
    *
    * @param  int  $id  The id of a User
    * @return Response
    */
    public function editUser(){
        $myMessagess = Auth::user()->fromMessages()->where('last', 1)->orWhere('user_to', Auth::user()->id)->where('last', 1)->groupBy('group_start','group_end')->orderBy('id', 'DESC')->get();
        $count = 0;
        foreach ($myMessagess as $key => $message) {
            if ($message->pivot->read == 0 and $message->pivot->user_to == Auth::id()) {
               $count++;
            }
        }
        return view('editUser')->with('myMessagesCount', $count);
    }

    public function getAllModerators(){
        $moderators = [];
        $allUsers = User::all();
        foreach ($allUsers as $user) {
            if ($user->is('moderator') || $user->is('admin')) {
                array_push($moderators, $user);
            }
        }
        return $moderators;
    }

    public function updateUser(Request $request){
        $user = Auth::user();
        $user->name = $request->firstName;
        $user->lastName = $request->lastName;
        if($user->save()){
            return back();
        }
    }

    public function updateUsername(UpdateUserRequest $request){
        $user = Auth::user();
        $user->username = $request->username;
        if($user->save()){
            return back();
        }
    }

    public function showManage(){
        $users = User::withTrashed()->get();
        $deletedUsers = User::onlyTrashed()->get();
        
        return view('/manageUsers')->with('users', $users)->with('deletedUsers', $deletedUsers);
    }

    public function updatePassword(UpdatePasswordRequest $request){
        $user = Auth::user();
        $hashedPassword = Hash::make($request->newPassword);
        if (!Hash::check($request->oldPassword, $user->password))
        {
            return back();
        }
        $user->password = $hashedPassword;
        if ($user->save()) {
            return back();
        }
    }

    public function getApiUsers(Request $request){
        $keyword = $request->input('username');
        $allUsers = User::with('problems')->where(DB::raw("CONCAT(`name`, ' ', `lastName`)"), 'LIKE', '%'.$keyword.'%')->where(function($q) {
          $q->where('role_id', '3')
            ->orWhere('role_id', '2');
      })->where('id','!=', Auth::id())->get();

        return json_encode($allUsers);
    }

    public function getApiUsers2(Request $request){
        $keyword = $request->input('username');
        $allUsers = User::where(DB::raw("CONCAT(`name`, ' ', `lastName`)"), 'LIKE', '%'.$keyword.'%')->where('id','!=', Auth::id())->get();

        return $allUsers->toArray();
    }

    
    public function getLoggedUser(){
        $user = User::with('role')->findorFail(Auth::id());
        return $user->toArray();
    }

    public function findUserById(Request $request){
        $user = User::with('role')->findorFail($request->uid);
        
        return $user->toArray();
    }

    public function getApiUsersEmail(Request $request){
        $email = $request->input('email');
        $user = User::with('role')->where('email', $email)->get();
        return $user->toArray();
    }

    public function deleteUser($id){
        $user = User::findorFail($id);
        $user->delete();
        return back();
    }

    public function activateUser($id){
        $user = User::onlyTrashed()->findorFail($id);
        $user->restore();
        return back();
    }
}

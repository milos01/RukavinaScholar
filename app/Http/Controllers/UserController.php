<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\MakeUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\NewImageRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\User;
use Hash, Auth,DB, Input, Validator, Response, Image;


class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserProfile($id){
        $user = User::findOrFail($id);
        $myMessagess = Auth::user()->fromMessages()->where('last', 1)->orWhere('user_to', Auth::user()->id)->where('last', 1)->groupBy('group_start','group_end')->orderBy('id', 'DESC')->get();
        $count = 0;
        foreach ($myMessagess as $key => $message) {
            if ($message->pivot->read == 0 and $message->pivot->user_to == Auth::id()) {
               $count++;
            }
        }
        return view('userProfile')->with('user',$user)->with('myMessagesCount', $count);
     }

    public function addStaff(MakeUserRequest $request)
    {
        $user = new User;

        $user->name = $request->fname;
        $user->email = $request->email;
        $user->password = Hash::make('defPass');
        $user->lastName = $request->lname;
        $user->picture = "defPic.png";
        $user->role_id = 2;

        if ($user->save()) {
            return redirect('/home/manage');
        }else{
            return redirect('/home/manage')->with('alert', 'Something went wrong :(');
        }
    }

    public function upgradeAdmin($id){
        $user = User::find($id);
        $user->role_id = 3;
        if($user->save()){
            return redirect('/home/manage');
        }

    }

    public function donwgradeAdmin($id){
        $user = User::find($id);
        $user->role_id = 2;
        if($user->save()){
            return redirect('/home/manage');
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

    public function updateUser(Request $request){
        $user = Auth::user();
        $user->name = $request->firstName;
        $user->lastName = $request->lastName;
        if($user->save()){
            return redirect('/home/edit');
        }
    }


    public function showManage(){
        $users = User::all();
        $deletedUsers = User::onlyTrashed()->get();
        $myMessagess = Auth::user()->fromMessages()->where('last', 1)->orWhere('user_to', Auth::user()->id)->where('last', 1)->groupBy('group_start','group_end')->orderBy('id', 'DESC')->get();
            $count = 0;
            foreach ($myMessagess as $key => $message) {
                if ($message->pivot->read == 0 and $message->pivot->user_to == Auth::id()) {
                    $count++;
                }
            }
            return view('/manageUsers')->with('users', $users)->with('myMessagesCount', $count)->with('deletedUsers', $deletedUsers);
    }

    public function updatePassword(UpdatePasswordRequest $request){
        $user = Auth::user();
        $hashedPassword = Hash::make($request->newPassword);
        if (!Hash::check($request->oldPassword, $user->password))
        {
            return redirect('/home/edit#tab-2')->with('error', 'Current password isn\'t valid!');
        }
        $user->password = $hashedPassword;
        if ($user->save()) {
            return redirect('/home/edit');
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

    public function getApiUser(){
        $user = User::with('role')->findorFail(Auth::id());
        return $user->toArray();
    }

    public function findUserById(Request $request){
        $user = User::with('role')->findorFail($request->userId);
        
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MakeUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\User;
use App\Events\makeProfilePictureEvent;
use Hash, Auth,DB, Input, Validator, Response, Image;

class UserController extends Controller
{
//    Page showing methods
//      |
//      V
    /**
     * Show user profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserProfile(User $user){
        return view('userProfile')->with('user',$user);
    }
    /**
     * Show manage user page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showManage(){
        $users = User::withTrashed()->get();
        $deletedUsers = User::onlyTrashed()->get();

        return view('/manageUsers')->with('users', $users)->with('deletedUsers', $deletedUsers);
    }
//    User's business logic
//      |
//      V
    /**
     * Add staff on application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addStaff(MakeUserRequest $request)
    {
        User::create([
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
    /**
     * Upgrade user to admin
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upgradeAdmin($id){
        $user = User::findOrFail($id);
        $user->role_id = 3;
        if($user->save()){
            return back();
        }
    }

    /**
     * Downgrade user to professor.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function donwgradeAdmin($id){
        $user = User::find($id);
        $user->role_id = 2;
        if($user->save()){
            return back();
        }
    }
    /**
     * Soft delete user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser($id){
        $user = User::findorFail($id);
        $user->delete();
        return back();
    }
    /**
     * Restore soft deleted user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateUser($id){
        $user = User::onlyTrashed()->findorFail($id);
        $user->restore();
        return back();
    }
    /**
     * Update user's first and last name.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUser(Request $request){
        $user = Auth::user();
        $user->name = $request->firstName;
        $user->lastName = $request->lastName;
        if($user->save()){
            return back();
        }
    }
    /**
     * Update user's username.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUsername(UpdateUserRequest $request){
        $user = Auth::user();
        $user->username = $request->username;
        if($user->save()){
            return back();
        }
    }
    /**
     * Update user's password.
     *
     * @return \Illuminate\Http\Response
     */
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
//    API endpoints
//      |
//      V
    /**
     * Get all moderators.
     *
     * @return \Illuminate\Http\Response
     */
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
    /**
     * Get logged user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLoggedUser(){
        $user = User::with('role')->findorFail(Auth::id());
        return $user;
    }
    /**
     * Get user by id.
     *
     * @return \Illuminate\Http\Response
     */
    public function findUserById(Request $request){
        $user = User::with('role')->findorFail($request->uid);
        return $user;
    }
    /**
     * Get user by email.
     *
     * @return \Illuminate\Http\Response
     */
    public function getApiUsersEmail(Request $request){
        $email = $request->input('email');
        $user = User::with('role')->where('email', $email)->get();
        return $user;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Get all users.
     */
    public function index(){
        $users = User::where('type', 'user')->latest()->paginate(5);
        return $users;
    }

    /**
     * Function to fetch single user detail.
     */
    public function fetchUserDetail(Request $request){
        return $request->user();
    }

    /**
     * Api to creata a new user.
     */
    public function create(){
        return User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);
    }

    /**
     * To update user.
     */
    public function update(User $user){
        return $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password') ? bcrypt(request('password')) : $user->password
        ]);
    }

    /**
     * Api to delete user here.
     */
    public function delete(User $user){
        return $user->delete();
    }

    public function profile(Request $request, $id){
        if($id){

            $user = User::find($id);
            $user->name = $request->name;

            if($request->password){
                $user->password = bcrypt($request->password);
            }
            
            $user->save();
            return $user;
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    protected $username;
    protected $role;
    
    public function __constuct() 
    {
        parent::__constuct();
        $this->middleware('auth');
    }

    public function showAddUser()
    {
        return view('user.adduser');
    }

    public function addnewuser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages())->withInput();
            // The given data did not pass validation
        }

        $user = new user();
        $user->fullname = $request->input('fullname');
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->email = $request->input('email');
        $user->ui_language = $request->input('ui_language');
        $user->role = $request->input('role');
        $user->user_group = $request->input('user_group');
        $user->isactive = $request->input('isactive');
    //    $user->created_at = date('M d, Y');
    //    $user->updated_at = date('M d, Y');
        $user->save();
        return redirect('/user/showAllUser');
    }

    public function showAllUser()
    {
        $users = User::all();
        return view('user.showalluser',compact('users'));
    }
}

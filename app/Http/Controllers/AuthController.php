<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
class AuthController extends Controller
{
     


    public function login(){
         
        return  view('login_register');
    }

    public function loginAuth(Request $request){
        if (Auth::attempt($request->only('email', 'password') ,false)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => __('strings.LOGIN_INFO_DONT_MATCH_OUR_RECORDS'), 
        ]);
         
    }
    public function register(){
        return  view('login_register');
    }
    public function registerSave(Request $request){
        $validator=Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed',
          
        ],
        [
            'firstName.required'=>__('strings.FIRST_NAME_REQUIRED'),
            'firstName.max'=>__('strings.FIRST_NAME_MAX_CHAR'),
            'lastName.required'=>__('strings.LAST_NAME_REQUIRED'),
            'lastName.max'=>__('strings.LAST_NAME_MAX_CHAR'),
            'email.required'=>__('strings.EMAIL_REQUIRED'),
            'email.email'=>__('strings.EMAIL_EMAIL'),
            'email.unique'=>__('strings.EMAIL_UNIQUE'),
            'password.required'=>__('strings.PASSWORD_REQUIRED'),
            'password.min'=>__('strings.PASSWORD_MIN'),
            'password.confirmed'=>__('strings.PASSWORD_CONFIRMED'),
        ])->validate();
        $user= new User() ;
        $user->lastName=$request->lastName;
        $user->firstName=$request->firstName;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        return redirect()->route('login')->with('success',__('strings.REGISTER_WITH_SUCCESS')); 

    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success',__('strings.LOGOUT_WITH_SUCCESS')); 
    }


}

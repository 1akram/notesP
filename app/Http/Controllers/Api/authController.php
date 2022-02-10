<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class authController extends Controller
{
    public function login(Request $request){
        $token=Auth::guard('api')->attempt($request->only('email', 'password') );
        if($token){
            return response()->json([
                'status'=>True,
                'msg'=>'login secces',
                'errorCode'=>null,
                'data'=>$token,
            ]);
        }
         
        return response()->json([
            'status'=>false,
            'msg'=>__('strings.LOGIN_INFO_DONT_MATCH_OUR_RECORDS'), 
            'errorCode'=>'E1',
            'data'=>null,
        ]);
         
    }

    public function logout(Request $request){
         
       
        Auth::guard('api')->logout(true);
        return response()->json([
            'status'=>true,
            'msg'=>__('strings.LOGOUT_WITH_SUCCESS'), 
            'errorCode'=>null,
            'data'=>null,
        ]);
         
    }
}

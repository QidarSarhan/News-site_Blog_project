<?php

namespace App\Http\Controllers\Api;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!Hash::check($request->password, $user->password))
        {
            // return $user;
            return "can't login";
        }

        $user_status = ['admin', 'writer'];
        
        if( !in_array($user->status, $user_status) ) {
           
            return "can't login";
        }

        $token = $user->createToken($user->name);
        return response()->json(['token'=>$token->plainTextToken, 'user'=>$user]);

    }

    public function logout(Request $request) 
    {
        $user = User::where('id', $request->id)->first();
        // return $request->header();
        // return $request->all();
        // $user->tokens()->delete();
        $request->user()->currentAccessToken()->delete();
        return $user;

    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use PDO;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed'

            ]
        );

        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]
        );

        $token = $user->createToken('myToken')->plainTextToken;
        //we can change this my token to any dynamic value according to our need;

        return response(
            [
                'user' => $user,
                'token' => $token,
            ],
            201
        );
        //this "201" is a manual status code.
    }
    public function logout(){
        auth()->user()->tokens()->delete();
        return response([
            'message' =>'Successfully Logout',
        ],201);
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email',$request->email)->first();
            
        if(!$user || ! hash::check($request->password,$user->password)){
            return response(
                [
                    'message' => 'password of user not matched'
                ],401
            );
        }else{
            $token = $user->createToken('mytoken')->plainTextToken;
            return response(
                [
                    'user' => $user,
                    'token' => $token
                ],200
                );
        }
    }
}

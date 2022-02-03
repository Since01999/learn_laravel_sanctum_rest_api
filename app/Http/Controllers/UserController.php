<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
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
                        'user'=>$user,
                        'token'=>$token,
                    ],201
                );
                //this "201" is a manual status code.
    }
}

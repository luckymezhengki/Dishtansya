<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\User;
use App\Jobs\SendEmail;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $msg = $validator->errors()->first();
            return response()->json(['message' => $msg], 400 );
        }

        $guest = new User([
            'email' => $request->email,
            'password' => Hash::make( $request->password )
        ]);

        $guest->save();

        $welcome = ['email' => $request->email];
        SendEmail::dispatch($welcome);

        return response()->json(['message' => 'User successfully registered'], 201 );
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $msg = $validator->errors()->first();
            return response()->json(['message' => $msg], 400 );
        }

        $logged = [ 'email' => $request->email, 'password' => $request->password ];

        if( !Auth::attempt($logged))
        {
            return response()->json(['message' => 'invalid credentials'], 401);
        }
        else
        {
            return response()->json([ 'access_token' => Auth::attempt($logged)]);
        }
    }
}

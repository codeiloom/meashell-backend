<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserSignup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{


    public function register(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        if ($validate->fails()) {

            return response()->json([
                'message' => $validate->errors()->first(),
            ]);
        } else {

            $user = new User([

                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => $request->email_verified_at,
                'activation_token' => Str::random(60),
                'password' => bcrypt($request->password),
            ]);
            $user->save();

            // Mail Activation Link to User
            Mail::to($user->email)->send(new UserSignup($user));

            return response()->json([
                'message' => 'user has been registred!'
            ]);
        }
    }


    public function signupActive($token, Request $request)
    {

        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return response()->json([
                'message' => 'This activation toke is invalid'
            ], 404);
        }

        $user->active = true;
        $user->email_verified_at = Carbon::now();
        $user->activation_token = '';
        $user->save();

        return response()->json([
            'message' => 'user has be active!'
        ], 200);
    }
}

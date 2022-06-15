<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    //  Login user 
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required']
        ]);

        if ($validate->fails()) {

            return response()->json([
                'message' => $validate->errors()->first(),
            ]);
        } else {

            $cerdinentails = request(['email', 'password']);
            if (!Auth::attempt($cerdinentails)) {
                return response()->json([
                    'message' => 'Unauthorized',
                ], 401);
            }

            $user = Auth::user();

            if (!$user->hasVerifiedEmail()) {

                return response()->json([
                    'message' => 'Email has not verified',
                ], 401);
            }

            $tokenResult = $user->createToken('Login Token');
            $token = $tokenResult->token;
            $token->save();

            return response()->json([
                'token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),


            ], 200);
        }
    }


    public function users()
    {
        $user = User::all();
        return response()->json([
            'user' => $user,
        ], 200);
    }
}

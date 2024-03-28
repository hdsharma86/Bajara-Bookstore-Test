<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Admin login here
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        } else {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'type' => 'admin',
            ];
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('Bajara Bookstore Test');
                return response()->json(['user' => $user, 'token' => $token->plainTextToken], Response::HTTP_CREATED);
            } else {
                return response()->json(['error' => 'Unauthorized Access'], Response::HTTP_OK);
            }
        }
        return response()->json($request->all());
    }

    /**
     * Admin logout here...
     */
    public function logout(Request $request){
        $user = Auth::user();
        if (Auth::check()) {
            $user->currentAccessToken()->delete();
            return response()->json(['message'=> 'Logged out successfull.'], Response::HTTP_CREATED);
        } else {
            return response()->json(['message'=> 'Unauthorised'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function getUser(Request $request){
        return response()->json($request->user());
    }

}
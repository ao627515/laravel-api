<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\StoreUserRequest;

class UserController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        try {
            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;

            $user->save();

            return response()->json([
                'status' => 200,
                'message' => 'user register successfully',
                'user' => $user
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function login(LoginUserRequest $request){
        try {
            if(auth()->attempt($request->only(['email', 'password']))){
                $user = auth()->user();

                $token = $user->createToken('authToken')->plainTextToken;

                return response()->json([
                    'status' => 200,
                    'message' => 'user auth successfully',
                    'user' => $user,
                    'token' => $token
                ]);
            }else{
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid email or password'
                    ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}

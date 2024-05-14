<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
                'message' => 'user auth successfully',
                'user' => $user
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use App\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function getInfo(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = User::where('token', $request->get('token'))->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized', 
                'data' => null
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => "Authorized",
            'data' => $user->toArray()
        ], 200);
    }
}

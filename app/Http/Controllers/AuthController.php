<?php

namespace App\Http\Controllers;

use App\User;
use App\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $phone = PhoneNumber::where('number', $request->get('phone'))->first();

        if (!$phone) {
            return response()->json([
                'success' => false,
                'message' => 'Phone number not found', 
                'data' => null
            ], 401);
        }

        $user = $phone->user;

        if ($user->tokenIsExpired()) {
            $user->generateToken();
        }

        return response()->json([
            'success' => true,
            'message' => "You're successfully identified",
            'data' => [
                'token' => $user->token
            ]
        ], 200);
    }
}

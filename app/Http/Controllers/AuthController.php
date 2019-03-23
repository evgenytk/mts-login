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
        $this->validate($request, [
            'callback_url' => 'required|url'
        ]);

        $phone = PhoneNumber::where('number', $request->get('phone'))->first();

        if (!$phone) {
            $data = http_build_query([
                'success' => false
            ]);

            return redirect($request->get('callback_url').'?'.$data);
        }

        $user = $phone->user;

        if ($user->tokenIsExpired()) {
            $user->generateToken();
        }

        $data = http_build_query([
            'success' => true,
            'token' => $user->token,
            'token_expired' => $user->token_expired
        ]);

        return redirect($request->get('callback_url').'?'.$data);
    }
}

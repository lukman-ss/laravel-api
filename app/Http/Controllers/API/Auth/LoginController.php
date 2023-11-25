<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// resource
use App\Http\Resources\Auth\AuthResource;
class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $token = auth()->user()->createToken('token-name')->plainTextToken;
            return new AuthResource(true, 200, 'Auth Login', ['token' => $token]);
        }
        return new AuthResource(true, 401, 'Auth Login', ['error' => 'Unauthorized']);
    }
}

<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// resource
use App\Http\Resources\Auth\AuthResource;

// Validator
use Illuminate\Support\Facades\Validator;

// Enums
use App\Enums\StatusAPI;
class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Return validation errors in a structured format
            return new AuthResource(StatusAPI::ERROR, 400, 'Validation failed!', $validator->errors());
        }
        try {
            $credentials = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
    
            if (Auth::attempt($credentials)) {
                $token = auth()->user()->createToken('token-name')->plainTextToken;
                return new AuthResource(StatusAPI::SUCCESS, 200, 'Auth Login', ['token' => $token]);
            }
            return new AuthResource(StatusAPI::ERROR, 401, 'Auth Login', ['error' => 'Unauthorized']);
    
        } catch (\Exception $e) {
            // Handle any other unexpected errors
            return new AuthResource(StatusAPI::SERVER_ERROR, 500, 'Internal Server Error',  $e->getMessage());
        }


        
    }
}

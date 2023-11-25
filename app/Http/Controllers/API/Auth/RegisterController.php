<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Auth\AuthResource;

use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Return validation errors in a structured format
            return new AuthResource(false, 400, 'Validation failed', $validator->errors());
        }

        try {
            // Attempt to create a new user
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
    
            // Return a successful response
            return new AuthResource(true, 200, 'Auth Login', $user);
    
        } catch (\Exception $e) {
            // Handle any other unexpected errors
            return new AuthResource(false, 500, 'Error creating user', null, $e->getMessage());
        }
    }
}

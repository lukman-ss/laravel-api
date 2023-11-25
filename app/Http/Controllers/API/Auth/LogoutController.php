<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Auth\AuthResource;
use App\Enums\StatusAPI;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $request->user()->tokens()->delete();

            return new AuthResource(StatusAPI::SUCCESS, 200, 'Logout Successfully', []);
        } catch (\Exception $e) {
            // Handle any other unexpected errors
            return new AuthResource(StatusAPI::SERVER_ERROR, 500, 'Internal Server Error', null, $e->getMessage());
        }
    }
}

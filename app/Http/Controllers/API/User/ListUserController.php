<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// user model
use App\Models\User;

// resource main
use App\Http\Resources\Main\MainResource;

use App\Enums\StatusAPI;

class ListUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        try {
            return new MainResource(StatusAPI::SUCCESS, 200, 'Detail Data Course', $user::latest()->paginate(10));
        } catch (\Exception $e) {
            return new MainResource(StatusAPI::SERVER_ERROR, 500, 'Internal Server Error', $e->getMessage());
        }
        
    }
}

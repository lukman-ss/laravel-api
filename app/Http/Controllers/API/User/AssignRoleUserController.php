<?php

namespace App\Http\Controllers\API\User;

use App\Enums\StatusAPI;
use App\Http\Resources\Main\MainResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AssignRoleUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'role_name' => 'required|exists:roles,name',
        ]);

        if ($validator->fails()) {
            return new MainResource(StatusAPI::ERROR, 422, 'Validation failed!', $validator->errors());
        }
        try {
            $user = $user::findOrFail($request->user_id);
            // Remove all existing roles
            $user->roles()->detach();
            $user->assignRole($request->role_name);
            return new MainResource(StatusAPI::SUCCESS, 200, 'Register Successfully', $user);
        } catch (\Exception $e) {
            return new MainResource(StatusAPI::SERVER_ERROR, 500, 'Internal Server Error', $e->getMessage());
        }
    }
}

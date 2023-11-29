<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// storage
use Illuminate\Support\Facades\Storage;

// Validator
use Illuminate\Support\Facades\Validator;

// user model
use App\Models\User;

// resource main
use App\Http\Resources\Main\MainResource;

use App\Enums\StatusAPI;
class UpdateUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user, $id)
    {
         //define validation rules
         $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'description'   => 'required',
        ]);
        //check if validation fails
        if ($validator->fails()) {
            return new MainResource(StatusAPI::ERROR, 422, 'Validation failed!', $validator->errors());
        }

        $course = CourseModel::find($id);

        if(!$course)
        {
            return new MainResource(StatusAPI::NOT_FOUND, 404, 'NOT FOUND', ['error' => 'ID NOT FOUND']);

        }
        try {
            if ($request->hasFile('image')) {
            
                //upload image
                $image = $request->file('image');
                $image->storeAs('public/course', $image->hashName());

                //delete old image
                Storage::delete('public/course/'.basename($course->image));

                $course->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'image' =>  $image->hashName(),
                ]);

                return new MainResource(StatusAPI::SUCCESS, 200, 'Update Data Course & Image', $course);
            } else {
                $course->update([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);

                return new MainResource(StatusAPI::SUCCESS, 200, 'Update Data Course', $course);
            }
        } catch (\Throwable $th) {
            return new MainResource(StatusAPI::SERVER_ERROR, 500, 'Internal Server Error',$th->getMessage());
        }
    }
}

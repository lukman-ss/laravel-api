<?php

namespace App\Http\Controllers\API\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

// model
use App\Models\Course\CourseModel;

// resource
use App\Http\Resources\Course\CourseResource;

// enum
use App\Enums\StatusAPI;

class CreateCourseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'          => 'required',
            'description'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return new CourseResource(StatusAPI::ERROR, 422, 'Validation failed!', $validator->errors());
        }

        try {
            //upload image
            $image = $request->file('image');
            $image->storeAs('public/course', $image->hashName());

            //create post
            $course = CourseModel::create([
                'image'         => $image->hashName(),
                'name'          => $request->name,
                'description'   => $request->description,
                'status'        => 0,
                'created_by'    => auth()->user()->id
            ]);
            return new CourseResource(StatusAPI::SUCCESS, 200, 'List Data Course', $course);
        } catch (\Throwable $th) {
            return new CourseResource(StatusAPI::SERVER_ERROR, 500, 'Internal Server Error',$th->getMessage());
        }

        
    }
}

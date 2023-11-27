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

// storage
use Illuminate\Support\Facades\Storage;
class UpdateCourseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, CourseModel $course, $id)
    {
        // dd($course::find($id));
        // \Log::info('Request Data:', $request->all());
        // \Log::info('Course ID:', $course->id);
        // \Log::info('Old Image Path:', $course->image);
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'description'   => 'required',
        ]);
        //check if validation fails
        if ($validator->fails()) {
            return new CourseResource(StatusAPI::ERROR, 422, 'Validation failed!', $validator->errors());
        }

        $course = CourseModel::find($id);

        if(!$course)
        {
            return new CourseResource(StatusAPI::NOT_FOUND, 404, 'NOT FOUND', ['error' => 'ID NOT FOUND']);

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

                return new CourseResource(StatusAPI::SUCCESS, 200, 'Update Data Course & Image', $course);
            } else {
                $course->update([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);

                return new CourseResource(StatusAPI::SUCCESS, 200, 'Update Data Course', $course);
            }
        } catch (\Throwable $th) {
            return new CourseResource(StatusAPI::SERVER_ERROR, 500, 'Internal Server Error',$th->getMessage());
        }
    }
}

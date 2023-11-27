<?php

namespace App\Http\Controllers\API\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// model
use App\Models\Course\CourseModel;

// resource
use App\Http\Resources\Course\CourseResource;

// enum
use App\Enums\StatusAPI;

class DeleteCourseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, CourseModel $course, $id)
    {
        $course = $course::find($id);

        if(!$course)
        {
            return new CourseResource(StatusAPI::NOT_FOUND, 404, 'NOT FOUND', ['error' => 'ID NOT FOUND']);
        }
        try {
            return new CourseResource(StatusAPI::SUCCESS, 200, 'Update Data Course & Image', $course->delete());
        } catch (\Throwable $th) {
            return new CourseResource(StatusAPI::SERVER_ERROR, 500, 'Internal Server Error',$th->getMessage());
        }
    }
}

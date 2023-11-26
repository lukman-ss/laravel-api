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
class DetailCourseController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function show($id)
    {
        try {
            return new CourseResource(StatusAPI::SUCCESS, 200, 'List Data Course', CourseModel::find($id));
        } catch (\Exception $e) {
            return new CourseResource(StatusAPI::SERVER_ERROR, 500, 'Internal Server Error', $e->getMessage());
        }
    }
}

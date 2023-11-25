<?php

namespace App\Http\Controllers\API\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// model
use App\Models\Course\CourseModel;

// resource
use App\Http\Resources\Course\CourseResource;

class CourseController extends Controller
{
    /**
     ** List of Course
     */
    public function list()
    {
        return new CourseResource(true, 'List Data Course', CourseModel::latest()->paginate(10));
    }
}

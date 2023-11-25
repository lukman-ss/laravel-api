<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    use HasFactory;
    /***
     ** Fillable field
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'created_by',
    ];
}

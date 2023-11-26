<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseModel extends Model
{
    use HasFactory;

    protected $table = 'course';
    /***
     ** Fillable field
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'created_by',
        'image',
        'updated_at',
    ];
    /**
     * image
     *
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('/storage/posts/' . $image),
        );
    }
}

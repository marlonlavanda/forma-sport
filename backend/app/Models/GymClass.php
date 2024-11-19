<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymClass extends Model
{
    /** @use HasFactory<\Database\Factories\GymClassFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'schedule',
        'instructor_id',
        'capacity',
    ];

    // A class belongs to an instructor (a user)
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    // A class has many enrollments
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}

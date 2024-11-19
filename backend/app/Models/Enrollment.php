<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    /** @use HasFactory<\Database\Factories\EnrollmentFactory> */
    use HasFactory;

    protected $fillable = [
        'class_id',
        'user_id',
        'enrollment_date',
    ];

    // An enrollment belongs to a user (member)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // An enrollment belongs to a class
    public function class()
    {
        return $this->belongsTo(GymClass::class);
    }
}

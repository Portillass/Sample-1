<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'first_name',
        'middle_name',
        'last_name',
        'birth_date',
        'gender',
        'contact_number',
        'course',
        'year_level',
        'semester',
        'academic_year',
        'address',
        'city',
        'province',
        'zip_code',
        'emergency_contact',
        'emergency_number'
    ];
   
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'enrollment_subject')
        ->withPivot('grade_id')
                    ->withTimestamps();
    }
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
    public function enrollment()
    {
        return $this->hasOne(Enrollment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
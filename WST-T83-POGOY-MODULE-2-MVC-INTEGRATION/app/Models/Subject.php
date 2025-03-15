<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'units',
        'course',
        'year_level',
        'semester',
        'is_archived'
    ];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
    public function grade()
    {
        return $this->hasOne(Grade::class)->where('enrollment_id', request()->route('enrollment')->id);
    }
    public function enrollments()
    {
        return $this->belongsToMany(Enrollment::class, 'enrollment_subject')
                    ->withTimestamps();
    }
}
<?php

namespace App;

/**
 * Class Lecturer
 *
 * @package App
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property integer $department_id
 * @property string $fullname
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Lecturer extends \Eloquent
{
    protected $table = 'lecturers';

    protected $fillable = ['name', 'surname', 'department_id'];

    /**
     * User relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {

        return $this->belongsTo('App\User', 'user_id');

    }

    /**
     * Department relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id');
    }

    /**
     * Lesson relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lessons()
    {
        return $this->belongsToMany('App\Lesson','lessons_departments');
    }

    /**
     * Get full name
     *
     * @return string
     */
    public function getFullnameAttribute()
    {
        return $this->name . ' ' . $this->surname;
    }
}

<?php

namespace App;

/**
 * Class Lesson
 *
 * @package App
 * @property integer $id
 */
class Lesson extends \Eloquent
{
    protected $table = 'lessons';

    protected $fillable = ['grade','semester','code', 'name', 'credit','lecturer_id'];

    public function getLessonWithCodeAttribute()
    {
        return $this->code . ' - ' . $this->name;
    }

    public function departments()
    {
        return $this->belongsToMany('App\Department', 'lessons_departments');
    }

    public function lecturer()
    {
        return $this->belongsTo('App\Lecturer','lecturer_id');
    }

}
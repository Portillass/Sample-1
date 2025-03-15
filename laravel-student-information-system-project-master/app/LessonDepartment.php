<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonDepartment extends \Eloquent
{
    protected $table = 'lessons_departments';

    protected $guarded = ['id'];

    /**
     * Lesson relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lesson()
    {
        return $this->belongsTo('App\Lesson', 'lesson_id');
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


}

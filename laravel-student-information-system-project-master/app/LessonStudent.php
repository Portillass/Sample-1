<?php

namespace App;

/**
 * Class LessonStudent
 * @package App
 */
class LessonStudent extends \Eloquent
{
    protected $table = 'lessons_students';

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

    /** Student relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Student', 'student_id');
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
     * LessonStudent relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function score()
    {
        return $this->hasOne('App\Score', 'lesson_student_id');
    }

}
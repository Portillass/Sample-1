<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'scores';

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
     * Convert score to letter from numeric system
     *
     * @param $score
     * @return string
     */
    public static function scoreAsLetter($score)
    {
        switch (true) {
            case in_array($score, range(90, 100)):
                return 'AA';
                break;
            case in_array($score, range(82, 89)):
                return 'BA';
                break;
            case in_array($score, range(73, 81)):
                return 'BB';
                break;
            case in_array($score, range(65, 72)):
                return 'CB';
                break;
            case in_array($score, range(57, 64)):
                return 'CC';
                break;
            case in_array($score, range(48, 56)):
                return 'DC';
                break;
            case in_array($score, range(40, 47)):
                return 'DD';
                break;
            case in_array($score, range(0, 39)):
                return 'FF';
                break;
        }
    }
}

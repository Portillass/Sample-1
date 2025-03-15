<?php

namespace App;

/**
 * Class Student
 *
 * @package App
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $surname
 * @property integer $department_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Student extends \Eloquent
{


    protected $table = 'students';

    protected $fillable = ['grade','name', 'surname', 'department_id'];

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
     * Get full name
     *
     * @return string
     */
    public function getFullnameAttribute()
    {
        return $this->name . ' ' . $this->surname;
    }


}

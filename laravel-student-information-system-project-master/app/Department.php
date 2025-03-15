<?php

namespace App;

/**
 * Class Department
 *
 * @package App
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Department extends \Eloquent
{
    protected $table = 'departments';

    public $fillable = ['code', 'name'];

    /**
     * Student relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany('App\Student','department_id');
    }

    /**
     * Lecturer relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lecturers()
    {
        return $this->hasMany('App\Lecturer','department_id');
    }
}
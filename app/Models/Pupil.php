<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pupil extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'class',
        'dob',
        'age',
        'gender',
        'parent_phone',
        'parent_email',
        'admission_no',
        'entry_date',
        'photo',
    ];

    /**
     * the pupils birthday.
     */
    public function birthdays()
    {
        return $this->hasMany(Birthday::class);
    }

    /**
     * Get the tests for the pupil.
     */
    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    /**
     * Get the testResults for the pupil.
     */
    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
}

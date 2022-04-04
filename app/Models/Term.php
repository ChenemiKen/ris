<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'session',
        'start_date',
        'end_date',
    ];

     /**
     * Get the tests for the term.
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

     /**
     * Get the tests for the term.
     */
    public function termResult()
    {
        return $this->hasMany(TermReport::class);
    }

     /**
     * Get the testResults for the pupil.
     */
    public function termResults()
    {
        return $this->hasMany(TermResult::class);
    }
}

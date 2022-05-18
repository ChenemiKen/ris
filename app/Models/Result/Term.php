<?php

namespace App\Models\Result;

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
    public function primaryTests()
    {
        return $this->hasMany(PrimaryTest::class);
    }

     /**
     * Get the testResults for the pupil.
     */
    public function primaryTestResults()
    {
        return $this->hasMany(PrimaryTestResult::class);
    }

     /**
     * Get the tests for the term.
     */
    public function primaryTermReports()
    {
        return $this->hasMany(PrimaryTermReport::class);
    }

     /**
     * Get the testResults for the pupil.
     */
    public function primaryTermResults()
    {
        return $this->hasMany(PrimaryTermResult::class);
    }
}

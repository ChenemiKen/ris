<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'test_no',
        'pupil_id',
        'term_id',
        'class',
        'teacher_id',
        'date',
    ];

    /**
     * Get the pupil that owns the test.
     */
    public function pupil()
    {
        return $this->belongsTo(Pupil::class);
    }

    /**
     * Get the term of the test.
     */
    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    /**
     * Get the results for the test.
     */
    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
}

<?php

namespace App\Models\Result\Primary;
use App\Models\Pupil;
use App\Models\Teacher;
use App\Models\Result\Term;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimaryTest extends Model
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

    // Belongs to
    // --------------------------------------------
    /**
     * Get the pupil that owns the test.
     */
    public function pupil()
    {
        return $this->belongsTo(Pupil::class);
    }

    /**
     * Get the teacher.
    */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the term of the test.
     */
    public function term()
    {
        return $this->belongsTo(Term::class);
    }



    // Has
    // ----------------------------------------
    /**
     * Get the results for the test.
     */
    public function primaryTestResults()
    {
        return $this->hasMany(PrimaryTestResult::class);
    }
}

<?php

namespace App\Models\Result\Primary;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimaryTestResult extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'test_id',
        'pupil_id',
        'term_id',
        'subject_id',
        'score',
        'grade',
        'remark',
    ];


     /**
     * Get the test that this result belongs to.
     */
    public function primaryTest()
    {
        return $this->belongsTo(PrimaryTest::class);
    }

     /**
     * Get the test that this result belongs to.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
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
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

}

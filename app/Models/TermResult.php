<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermResult extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'term_report_id',
        'pupil_id',
        'term_id',
        'subject_id',
        'test_1',
        'test_2',
        'test_3',
        'test_4',
        'exam',
        'percentage',
        'grade',
        'effort_grade',
        'remark',
    ];

         /**
     * Get the test that this result belongs to.
     */
    public function termReport()
    {
        return $this->belongsTo(TermReport::class);
    }

     /**
     * Get the test that this result belongs to.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}

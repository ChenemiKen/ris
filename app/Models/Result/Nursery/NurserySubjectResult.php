<?php

namespace App\Models\Result\Nursery;

use App\Models\Result\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurserySubjectResult extends Model
{
    use HasFactory;

          /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nursery_term_report_id',
        'pupil_id',
        'term_id',
        'subject_id',
        'score',
        'remark',
    ];

    
    /**
     * Get the subject of the subject result.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

     /**
     * Get the term report of the skill result.
     */
    public function nurseryTermReport()
    {
        return $this->belongsTo(NurseryTermReport::class);
    }
}

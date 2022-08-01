<?php

namespace App\Models\Result\Nursery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pupil;
use App\Models\Teacher;
use App\Models\Result\Term;

class NurseryTermReport extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pupil_id',
        'term_id',
        'teacher_id',
        // attendance
        'times_school_opened',
        'times_present',
        'times_absent',
        // physical development, health and cleanliness
        'height_start',
        'height_end',
        'weight_start',
        'weight_end',
        //remarks
        'personal_note',
        'teacher_remark',
        'head_remark',
        'date',
    ];

        /**
     * Get the pupil that owns the report.
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
     * Get the term of the report.
     */
    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    /**
     * Get the skill nursery results.
     */
    public function nurserySkillResults()
    {
        return $this->hasMany(NurserySkillResult::class);
    }

    /**
     * Get the subject nursery results.
     */
    public function nurserySubjectResults()
    {
        return $this->hasMany(NurserySubjectResult::class);
    }

    public function percentageTotal(){
        $pt = 0;
        foreach($this->nurserySubjectResults as $result){
            $i = $result->score;
            if(is_numeric($i)){
                $pt+=$i;
            }
        }
        return $pt;
    }
}

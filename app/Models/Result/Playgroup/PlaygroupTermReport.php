<?php

namespace App\Models\Result\Playgroup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pupil;
use App\Models\Teacher;
use App\Models\Result\Term;

class PlaygroupTermReport extends Model
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
        // Attention skills
        'ability_to_concentrate',
        'crk',
        'colouring_art',
        'games',
        'lang_dev_vocab',
        'number_work',
        'other_activities',
        'pencil_play_activities',
        'phonics',
        'project_work',
        // Affective area skills
        'attitude_to_work',
        'cleanliness',
        'dress',
        'hair',
        'nails',
        'neatness',
        'punctuality',
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
    public function playgroupSkillResults()
    {
        return $this->hasMany(PlaygroupSkillResult::class);
    }
}

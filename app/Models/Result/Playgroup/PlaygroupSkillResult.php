<?php

namespace App\Models\Result\Playgroup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Result\SkillCategory;
use App\Models\Result\Skill;

class PlaygroupSkillResult extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'playgroup_term_report_id',
        'pupil_id',
        'term_id',
        'skill_category_id',
        'skill_id',
        'score',
    ];

    /**
     * Get the category of the skill.
     */
    public function skill_category()
    {
        return $this->belongsTo(SkillCategory::class);
    }

    /**
     * Get the category of the skill.
     */
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    /**
     * Get the term report of the skill result.
     */
    public function playgroupTermReport()
    {
        return $this->belongsTo(PlaygroupTermReport::class);
    }
}

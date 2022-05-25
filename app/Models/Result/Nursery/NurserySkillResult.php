<?php

namespace App\Models\Result\Nursery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Result\SkillCategory;
use App\Models\Result\Skill;

class NurserySkillResult extends Model
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
        'skill_category_id',
        'skill_id',
        'grade',
        'effort_grade',
        'remark',
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
    public function nurseryTermReport()
    {
        return $this->belongsTo(NurseryTermReport::class);
    }
}

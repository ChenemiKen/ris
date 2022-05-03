<?php

namespace App\Models\Result;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'class',
        'skill_category_id',
    ];

    /**
     * Get the category of the skill.
     */
    public function skill_category()
    {
        return $this->belongsTo(SkillCategory::class);
    }

}

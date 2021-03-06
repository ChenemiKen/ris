<?php

namespace App\Models\Result;

use App\Models\Result\Nursery\NurserySkillResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillCategory extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the skills in the category.
     */
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    /**
     * Get the skills in the category.
     */
    public function nurserySkillResults()
    {
        return $this->hasMany(NurserySkillResult::class);
    }

}

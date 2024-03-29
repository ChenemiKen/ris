<?php

namespace App\Models\Result\Primary;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pupil;
use App\Models\Teacher;
use App\Models\Result\Term;


class PrimaryTermReport extends Model
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
        'times_punctual',
        'sports_1',
        'sports_2',
        'sports_3',
        'other_event_1',
        'other_event_2',
        'other_event_3',
        // conduct
        'conduct_good',
        'conduct_bad',
        'conduct_exemplary',
        'conduct_comment',
        // physical development, health and cleanliness
        'height_start',
        'height_end',
        'weight_start',
        'weight_end',
        'illness_days',
        'nature_of_illness',
        'cleanliness_rating',
        'cleanliness_remark',
        // sports
        'ball_games',
        'tracks',
        'jumps',
        'throws',
        'swimming',
        'others',
        // clubs
        'organisation',
        'organisation_office',
        'organisation_contribution',
        'teacher_remark',
        'head_remark',
        'date',
    ];

        /**
     * Get the pupil that owns the test.
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
     * Get the results for the test.
     */
    public function primaryTermResults()
    {
        return $this->hasMany(PrimaryTermResult::class);
    }


    public function percentageTotal(){
        $pt = 0;
        foreach($this->primaryTermResults as $result){
            $i = $result->percentage;
            if(is_numeric($i)){
                $pt+=$i;
            }
        }
        return $pt;
    }
}

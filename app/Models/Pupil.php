<?php

namespace App\Models;
use App\Models\Result\Primary\PrimaryTest;
use App\Models\Result\Primary\PrimaryTestResult;
use App\Models\Result\Primary\PrimaryTermReport;
use App\Models\Result\Primary\PrimaryTermResult;
use App\Models\Result\Nursery\NurseryTermReport;
use App\Models\Result\Beacon\BeaconTermReport;
use App\Models\Result\Playgroup\PlaygroupTermReport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pupil extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'class',
        'dob',
        'age',
        'gender',
        'parent_phone',
        'parent_email',
        'admission_no',
        'entry_date',
        'photo',
    ];


    // Has
    // ------------------------------------------
    /**
     * the pupils birthday.
     */
    public function birthdays()
    {
        return $this->hasMany(Birthday::class);
    }

    /**
     * Get the tests for the pupil.
     */
    public function primaryTests()
    {
        return $this->hasMany(PrimaryTest::class);
    }

    /**
     * Get the testResults for the pupil.
     */
    public function primaryTestResults()
    {
        return $this->hasMany(PrimaryTestResult::class);
    }

    /**
     * Get the tests for the pupil.
     */
    public function primaryTermReports()
    {
        return $this->hasMany(PrimaryTermReport::class);
    }

    /**
     * Get the primaryTestResults for the pupil.
     */
    public function primaryTermResults()
    {
        return $this->hasMany(PrimaryTermResult::class);
    }

    /**
     * Get the tests for the pupil.
     */
    public function nurseryTermReports()
    {
        return $this->hasMany(NurseryTermReport::class);
    }

    /**
     * Get the tests for the pupil.
     */
    public function beaconTermReports()
    {
        return $this->hasMany(BeaconTermReport::class);
    }

    /**
     * Get the tests for the pupil.
     */
    public function playgroupTermReports()
    {
        return $this->hasMany(PlaygroupTermReport::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
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
        'max_score',
    ];

    /**
     * Get the results for the test.
     */
    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
}

<?php

namespace App\Models;

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

    /**
     * Get the results for the pupil.
     */
    public function results()
    {
        return $this->hasMany(Result::class);
    }
}

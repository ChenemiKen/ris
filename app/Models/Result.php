<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'pupil_id',
        'term',
        'data',
        'file',
    ];

     /**
     * Get the pupil that owns the result.
     */
    public function pupil()
    {
        return $this->belongsTo(Pupil::class);
    }
}

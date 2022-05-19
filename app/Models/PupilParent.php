<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PupilParent extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'admission_no',
        'phone',
        'address',
        'user_id',
        'pupil_id',
    ];

    // belongs
    // --------------------------------------------
    /**
     * Get the messages for the user.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the ward of the parent.
     */
    public function pupil()
    {
        return $this->belongsTo(Pupil::class);
    }
}

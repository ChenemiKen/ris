<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
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
        'subclass',
        'class_group',
        'gender',
        'phone',
        'user_id',
    ];

    // belongs
    // --------------------------------------------
    /**
     * Get the messages for the user.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use App\Observers\TeacherObserver;
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
        'gender',
        'phone',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function boot(){
        parent::boot();
        // Teacher::observe(new TeacherObserver());
    }
}

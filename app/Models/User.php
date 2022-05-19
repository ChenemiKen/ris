<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Observers\UserObserver;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'fullname',
        'email',
        'type_id',
        'type_type',
        'password',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function type(){
        return $this->morphTo();
    }

    // Has
    // -----------------------------------------------
    /**
     * Get the teacher for the user.
     */
    public function teacher(){
        return $this->hasOne(Teacher::class);
    }

    /**
     * Get the messages for the user.
     */
    public function pupil_parent(){
        return $this->hasOne(PupilParent::class);
    }
    
    /**
     * Get the messages for the user.
     */
    public function admin(){
        return $this->hasOne(Admin::class);
    }

    /**
     * Get the messages for the user.
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }
}

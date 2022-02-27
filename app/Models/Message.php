<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'sender_id',
        'recipient_id',
        'subject',
        'message',
    ];

     /**
     * Get the user that owns the message.
     */
    public function recipient()
    {
        return $this->belongsTo(User::class);
    }
}

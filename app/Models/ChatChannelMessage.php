<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatChannelMessage extends Model
{
    /**
     * Fillable fields
     */
    protected $fillable = [
        'sender_id',
        'chat_channel_id',
        'message',
    ];
}

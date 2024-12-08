<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ChatChannelMember extends Model
{
    /**
     * Fillable fields
     */
    protected $fillable = [
        'user_id',
        'chat_channel_id'
    ];

    /**
     * User
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

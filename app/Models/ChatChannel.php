<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChatChannel extends Model
{
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Channel members
     */
    public function members(): HasMany
    {
        return $this->hasMany(ChatChannelMember::class, 'chat_channel_id');
    }

    /**
     * Channel messages
     */
    public function messages(): HasMany
    {
        return $this->hasMany(ChatChannelMessage::class, 'chat_channel_id');
    }

    /**
     * Get channel name
     *
     * @return string
     */
    public function getChannelName()
    {
        $user = Auth::user();

        $member = $this->members()->with('user')
            ->where('user_id', '<>', $user->id)->first();

        return $member->user->name;
    }
}

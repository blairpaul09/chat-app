<?php

namespace App\Services\Chat\Traits;

use App\Models\ChatChannel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

trait InteractsWithChatChannel
{
    /**
     * Get the channel betweem 2 users
     *
     * @param User $userOne
     * @param User $userTwo
     * @return ChatChannel
     */
    public static function getChannel(User $userOne, User $userTwo): ChatChannel
    {
        $channel = ChatChannel::whereHas('members', function ($query) use ($userOne, $userTwo) {
            $query->whereIn('user_id', [$userOne->id, $userTwo->id])
                ->groupBy('chat_channel_id')
                ->having(DB::raw('COUNT(DISTINCT user_id)'), 2);
        })->first();

        if (!$channel) {
            $channel = self::createChannel($userOne, $userTwo);
        }

        return $channel;
    }

    /**
     * Create chat channel between 2 user
     *
     * @param User $userOne
     * @param User $userTwo
     * @return ChatChannel
     */
    public static function createChannel(User $userOne, User $userTwo): ChatChannel
    {
        $channel =  DB::transaction(function () use ($userOne, $userTwo) {
            $channel = ChatChannel::create([]);

            $channel->members()->create(['user_id' => $userOne->id]);
            $channel->members()->create(['user_id' => $userTwo->id]);

            return $channel;
        });

        return $channel;
    }
}

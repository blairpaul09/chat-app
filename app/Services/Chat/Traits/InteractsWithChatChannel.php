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
        $channel = ChatChannel::join('chat_channel_members', 'chat_channel_members.chat_channel_id', 'chat_channels.id')
            ->groupBy('chat_channels.id')
            ->whereIn('chat_channel_members.user_id', [$userOne->id, $userTwo->id])
            ->select('chat_channels.*', DB::raw('COUNT(DISTINCT chat_channel_members.user_id) as users_count'))
            ->having('users_count', 2)
            ->first();

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

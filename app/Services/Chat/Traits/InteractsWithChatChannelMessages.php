<?php

namespace App\Services\Chat\Traits;

use App\Models\ChatChannel;
use App\Models\ChatChannelMessage;
use Illuminate\Support\Facades\Auth;

trait InteractsWithChatChannelMessages
{
    /**
     * Get chat channel messages
     *
     * @param ?ChatChannel $channel
     * @param int $perPage
     */
    public static function getMessages(?ChatChannel $chatChannel, int $perPage = 10)
    {
        return ChatChannelMessage::whereChatChannelId($chatChannel?->id)
            ->latest()
            ->paginate($perPage, pageName: 'chat-channel-messages');
    }

    /**
     * Get chat channel messages
     *
     * @param ?ChatChannel $channel
     * @param int $limit
     */
    public static function getRecentMessages(?ChatChannel $chatChannel, int $limit = 10)
    {
        return ChatChannelMessage::whereChatChannelId($chatChannel?->id)
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Send message to a chat channel
     *
     * @param ChatChannel $channel
     * @param string $message
     */
    public static function sendMessage(?ChatChannel $channel, string $message)
    {
        if (filled($message) && $channel) {
            $channel->messages()->create([
                'sender_id' => Auth::id(),
                'message' => $message,
            ]);

            $message = '';
        }
    }
}

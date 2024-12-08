<?php

namespace App\Services\Chat;

use App\Services\Chat\Traits\InteractsWithChatChannel;
use App\Services\Chat\Traits\InteractsWithChatChannelMessages;

class ChatService
{
    use InteractsWithChatChannel;
    use InteractsWithChatChannelMessages;
}

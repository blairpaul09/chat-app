<?php

namespace App\Livewire\Chat;

use App\Models\ChatChannel;
use App\Models\User;
use App\Services\Chat\ChatService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ChatBox extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $listeners = ['setChatChannel', 'sendChatChannelMessage'];

    public null|ChatChannel $channel;

    public string $message = '';

    public int $perPage = 100;

    public function render()
    {
        $messages = ChatService::getMessages($this->channel, $this->perPage);

        return view('livewire.chat.chat-box', [
            'messages' => $messages
        ]);
    }

    /**
     * Set Chat Channel
     *
     * @param User $user
     */
    #[On('set-chat-channel')]
    public function setChatChannel(User $user)
    {
        $channel = ChatService::getChannel(Auth::user(), $user);

        $this->channel = $channel;
    }

    /**
     * Unset Chat Channel
     */
    public function unsetChatChannel()
    {
        $this->channel = null;
    }

    /**
     * Send message
     *
     * @param string $message
     */
    #[On('send-chat-channel-message')]
    public function sendChatChannelMessage()
    {
        ChatService::sendMessage($this->channel, $this->message);

        $this->message = '';
    }


    public function loadMore()
    {
        $this->perPage += 10;
    }
}

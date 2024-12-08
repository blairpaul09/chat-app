<?php

namespace App\Livewire\Users;

use App\Models\ChatChannel;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public null|ChatChannel $activeChatChannel = null;

    public function render()
    {
        $users = User::orderBy('created_at', 'desc')
            ->paginate(15, pageName: 'users-page');

        return view('livewire.users.index', compact('users'));
    }

    /**
     * Set chat Channel
     *
     * @param User $user
     */
    public function setChatChannel(User $user)
    {
        $this->dispatch('set-chat-channel', $user);
    }
}

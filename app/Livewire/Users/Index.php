<?php

namespace App\Livewire\Users;

use App\Models\ChatChannel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public null|ChatChannel $activeChatChannel = null;

    public function render()
    {
        $users = User::orderBy('created_at', 'desc')
            ->where('id', '<>', Auth::id())
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

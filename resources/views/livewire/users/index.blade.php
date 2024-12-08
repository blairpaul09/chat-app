<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right">
        <thead class="text-xs uppercase">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Joined at
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap"
                        wire:click="setChatChannel({{ $user }})">
                        {{ $user->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->created_at->format('F d, Y') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="p-4">
        {{ $users->links() }}
    </div>

    <div class="fixed  shadow-md z-50 right-0" style="bottom: 0 !important">
        <livewire:chat.chat-box :channel="$activeChatChannel" />
    </div>
</div>

<div>
    @if (filled($channel))
        <div class="bg-white rounded-lg drop-shadow-xl border-2" style="width: 380px;">
            <div class="p-2 border-b-2 flex justify-between">
                <p class="font-bold">{{ $channel->getChannelName() }}</p>
                <button wire:click="unsetChatChannel">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-2">
                <div id="messages" wire:poll.1s class="flex flex-col gap-2 items-start p-2"
                    style="overflow: scroll;height:400px;margin-bottom:80px;overflow-x:hidden;">
                    @foreach ($messages->reverse() as $message)
                        @if (auth()->id() === $message->sender_id)
                            <div class="bg-blue-400 text-white p-2 rounded-lg w-5/6 self-end">
                                {{ $message->message }}
                            </div>
                        @else
                            <div class="bg-gray-100 p-2 rounded-lg w-5/6">
                                {{ $message->message }}
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="absolute bottom-0 w-full">
                    <div class="p-4 bg-white border-t border-gray-200">
                        <div class="flex items-center gap-2">
                            <textarea wire:model="message" wire:keydown.enter="sendChatChannelMessage"
                                class="flex-grow h-12 px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-200 resize-none"
                                placeholder="Type your message..."></textarea>
                            <x-button class="h-12" @click="scrollDown">
                                send
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        async function scrollDown() {
            await @this.sendChatChannelMessage()
            var el = document.getElementById('messages');
            setTimeout(() => {
                el.scrollTop = el.scrollHeight;
            }, 500);
        }
    </script>
@endpush

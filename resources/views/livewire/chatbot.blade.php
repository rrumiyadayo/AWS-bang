<div class="flex flex-col h-full">
    <div class="flex-1 overflow-y-auto p-4">
        @foreach ($conversation as $message)
            <div class="mb-2">
                <div class="font-bold {{ $message['role'] === 'user' ? 'text-blue-500' : 'text-green-500' }}">
                    {{ $message['role'] === 'user' ? 'You:' : 'AI:' }}
                </div>
                <div class="ml-2">{{ is_array($message['content']) ? json_encode($message['content']) : $message['content'] }}</div>
            </div>
        @endforeach
    </div>

    <div class="p-4 relative">
        <input type="text" placeholder="Enter text here" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
               wire:model="message"
               wire:keydown.enter="sendMessage">
        <button type="submit" class="absolute inset-y-0 right-4 px-2 text-gray-500 hover:text-gray-700 focus:outline-none"
                wire:click="sendMessage">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                <path stroke="currentColor" stroke-width="2" fill="none" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
            </svg>
        </button>
    </div>
</div>

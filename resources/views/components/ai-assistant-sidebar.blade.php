<div id="ai-assistant-sidebar" class="fixed top-0 right-0 h-full w-96 bg-white shadow-xl transform transition-transform duration-300 ease-in-out z-50">    <div class="p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">AI Assistant</h2>
            <button id="close-ai-assistant" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="mb-4">
            <p class="text-sm text-gray-600">What do you feel like achieving today? I will try and come up with an atomic sized tasks to achieve that goal.</p>
        </div>
        <div class="hidden">
            <input type="text" id="ai-assistant-input" class="w-full border rounded-md py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your goal..." />
            <button id="ai-assistant-submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Get Suggestions</button>
        </div>
        <div id="ai-assistant-response" class="mt-4 hidden"></div>
    <div class="p-4 relative">
        <input type="text" placeholder="Enter text here" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10">
            <button type="submit" class="absolute inset-y-0 right-4 px-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                    <path stroke="currentColor" stroke-width="2" fill="none" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                </svg>
            </button>
    </div>
    </div>
</div>

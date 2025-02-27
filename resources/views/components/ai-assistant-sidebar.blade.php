<div id="ai-assistant-sidebar" class="fixed top-0 right-0 h-full w-96 bg-white shadow-xl transform transition-transform duration-300 ease-in-out z-50">
    <div class="p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">AI Assistant</h2>
            <button id="close-ai-assistant" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="mb-4">
            <p class="text-sm text-gray-600">What do you feel like achieving today? I will try and come up with atomic sized tasks to achieve that goal.</p>
        </div>
        <div class="hidden">
            <input type="text" id="ai-assistant-input" class="w-full border rounded-md py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your goal..." />
            <button id="ai-assistant-submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Get Suggestions</button>
        </div>
        <div id="ai-assistant-response" class="mt-4 hidden"></div>
        <div class="p-4 relative">
            <input type="text" id="user-prompt-input" placeholder="Enter text here" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10">
            <button type="submit" id="send-prompt-button" class="absolute inset-y-0 right-4 px-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                    <path stroke="currentColor" stroke-width="2" fill="none" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                </svg>
            </button>
        </div>
    </div>
</div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sendButton = document.getElementById('send-prompt-button');
        const userInput = document.getElementById('user-prompt-input');
        const aiResponseDiv = document.getElementById('ai-assistant-response');
        const aiAssistantSidebar = document.getElementById('ai-assistant-sidebar');
        const closeButton = document.getElementById('close-ai-assistant');

        sendButton.addEventListener('click', function() {
            const promptText = userInput.value.trim();

            if (promptText) {
                // Display loading state
                aiResponseDiv.innerHTML = '<p>Loading response...</p>';
                aiResponseDiv.classList.remove('hidden');

                fetch('/get-ai-response', { // Replace '/get-ai-response' with your actual backend endpoint URL
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json', // Important: Tell backend we're sending JSON
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // If CSRF protection is enabled in Laravel
                    },
                    body: JSON.stringify({ prompt: promptText }) // Send the prompt as JSON
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // Handle successful response
                    if (data && data.candidates && data.candidates[0] && data.candidates[0].content && data.candidates[0].content.parts && data.candidates[0].content.parts[0].text) {
                        const aiTextResponse = data.candidates[0].content.parts[0].text;
                        aiResponseDiv.innerHTML = `<p>${aiTextResponse}</p>`;
                    } else if (data && data.error) {
                        // Handle API error response
                        aiResponseDiv.innerHTML = `<p class="text-red-500">Error from AI API: ${data.error.message || 'Unknown error'}</p>`;
                    }
                    else {
                        aiResponseDiv.innerHTML = '<p class="text-red-500">Could not parse AI response.</p>';
                    }
                })
                .catch(error => {
                    // Handle fetch errors
                    console.error('Fetch error:', error);
                    aiResponseDiv.innerHTML = `<p class="text-red-500">Error fetching AI response: ${error.message}</p>`;
                });

                userInput.value = ''; // Clear the input field after sending
            } else {
                alert('Please enter a prompt.'); // Or you can display a message in the response div
            }
        });

        closeButton.addEventListener('click', function() {
            aiAssistantSidebar.classList.add('-translate-x-full'); // Hide the sidebar (assuming you have CSS to handle this)
        });

        // Example to show the sidebar (you'll need a trigger button elsewhere in your UI)
        // document.getElementById('open-ai-assistant-button').addEventListener('click', function() {
        //     aiAssistantSidebar.classList.remove('-translate-x-full'); // Show the sidebar
        // });
    });
</script>

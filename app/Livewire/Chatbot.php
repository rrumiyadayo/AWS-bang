<?php

namespace App\Livewire;

use App\Jobs\GetAiResponseJob;
use Livewire\Component;
use App\Http\Controllers\TodoController;

class Chatbot extends Component
{
    public string $message = ''; // ユーザーの入力
    public array $conversation = []; // 会話の履歴
    public bool $isLoading = false;

    protected $listeners = [
        'chatbot-response' => 'handleChatbotResponse',
    ];

    public function sendMessage()
    {
        if (trim($this->message) === '') {
            return;
        }

        $this->conversation[] = ['role' => 'user', 'content' => $this->message];

        $this->isLoading = true;

        $sessionId = session()->getId();
        \Illuminate\Support\Facades\Log::info('Session ID (sendMessage):', ['id' => $sessionId]);

        GetAiResponseJob::dispatch($this->message, $sessionId);
    }

    public function handleChatbotResponse($data)
    {
        \Illuminate\Support\Facades\Log::info('Chatbot Response Event Received:', ['data' => $data]);
        $this->conversation[] = ['role' => 'ai', 'content' => $data['ai_response']];
        $this->isLoading = $data['isLoading'];
    }

    public function render()
    {
        return view('livewire.chatbot', ['isLoading' => $this->isLoading]);
    }
}

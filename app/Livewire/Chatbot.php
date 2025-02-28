<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Controllers\TodoController;

class Chatbot extends Component
{
    public string $message = ''; // ユーザーの入力
    public array $conversation = []; // 会話の履歴

    public function sendMessage()
    {
        if (trim($this->message) === '') {
            return;
        }

        $this->conversation[] = ['role' => 'user', 'content' => $this->message];

        $todoController = new TodoController();
        $response = $todoController->getAiResponse($this->message);

        $this->conversation[] = ['role' => 'ai', 'content' => $response];

        $this->message = '';
    }

    public function render()
    {
        return view('livewire.chatbot');
    }
}

<?php

namespace App\Jobs;

use App\Http\Controllers\TodoController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Livewire\Livewire;

class GetAiResponseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $message;
    public $sessionId;

    /**
     * Create a new job instance.
     */
    public function __construct(string $message, string $sessionId)
    {
        $this->message = $message;
        $this->sessionId = $sessionId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $todoController = new TodoController();
        $response = $todoController->getAiResponse($this->message);

        \Illuminate\Support\Facades\Log::info('AI Response', ['response' => $response]);

        Livewire::broadcast('chatbot-response', [
            'conversation' => [], // The correct conversation will be set in the component
            'ai_response' => $response,
            'isLoading' => false,
        ]);
    }
}

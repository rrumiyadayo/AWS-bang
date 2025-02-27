<?php

namespace App\Http\Controllers;

use App\Models\todo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    public function getAiResponse(string $prompt, string $model = 'gemini-2.0-flash')
    {
        $apiKey = env('AI_API_KEY');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

        $response = Http::post($url, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);

        if (!$response->successful()) {
            Log::error('Gemini API Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return [
                'error' => 'Failed to get AI response',
                'status_code' => $response->status(),
                'error_details' => $response->json(),
            ];
        }

        return $response->json();
    }

    /**
     * Display a listing of the resource.
     */
    public function index() //Shows all todos
    {
        $todos = todo::all();
        return view('dashboard', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() //Not used
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $validated = request()->validate([
            'description' => 'required',
            // 'completed' attribute is not part of the form
        ]);

        $todo = todo::create($validated);
        session()->flash('success', 'Todo を追加しました。');
        return redirect()->route('todos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(todo $todo) //Shows 1 todo
    {
        return view('todo.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(todo $todo) //Not used
    {
        // return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(todo $todo) //Updates 1 todo
    {
        $validated = request()->validate([
            'description' => 'required',
            'completed' => 'boolean',
        ]);

        $todo->update($validated);
        session()->flash('success', 'Todo を更新しました。');
        return redirect()->route('todos.index', $todo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(todo $todo) //delete 1 todo
    {
        $todo->delete();
        session()->flash('success', 'Todo を削除しました。');
        return redirect()->route('todos.index');
    }
}

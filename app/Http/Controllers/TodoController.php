<?php

namespace App\Http\Controllers;

use App\Models\todo;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoretodoRequest;
use App\Http\Requests\UpdatetodoRequest;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = todo::all();
        return view('todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretodoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetodoRequest $request, todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(todo $todo)
    {
        //
    }
}

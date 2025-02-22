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
    public function store(StoretodoRequest $request)
    {

        $input = $request->all();
        $todo = todo::create($input);
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
    public function update(UpdatetodoRequest $request, todo $todo) //Updates 1 todo
    {
        $todo->update($request->all());
        return redirect()->route('todos.update',$todo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(todo $todo) //delete 1 todo
    {
        $todo->delete();
        return redirect()->route('todos.index');
    }
}

@extends('layouts.app')

@section('header')
    Todo list dashboard
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container mx-auto max-w-md p-6 bg-white rounded-lg shadow-md mt-10">
                        <h1 class="text-2xl font-bold mb-4 text-gray-800">My To-Do List</h1>
                        <form action="{{ route('todos.store') }}" method="POST" class="flex items-center mb-4">
                            @csrf
                            <input type="text" name="description" id="new-task" placeholder="Add a new task..."
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                            <button type="submit"
                                class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Add
                            </button>
                        </form>
                        <ul id="task-list" class="space-y-2">
                            @foreach ($todos as $todo)
                                <li class="flex items-center justify-between bg-gray-50 p-3 rounded-md"
                                    data-todo-id="{{ $todo->id }}">
                                    <div class="flex items-center">
                                        <form action="{{ route('todos.update', $todo) }}" method="POST" class="mr-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="checkbox" name="completed"
                                                class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500 align-top"
                                                value="1" {{ $todo->completed ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                        </form>
                                        <span
                                            class="ml-2 text-gray-800 task-description {{ $todo->completed ? 'line-through text-gray-500' : '' }}"
                                            id="task-text-{{ $todo->id }}">
                                            {{ $todo->description }}
                                        </span>
                                        <form action="{{ route('todos.update', $todo) }}" method="POST"
                                            id="edit-form-{{ $todo->id }}" class="hidden flex items-center ml-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="text" name="description" value="{{ $todo->description }}"
                                                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-sm"
                                                required>
                                            <div class="flex space-x-2 ml-2">
                                                <button type="submit"
                                                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline text-sm">
                                                    Save
                                                </button>
                                                <button type="button" onclick="toggleEditForm({{ $todo->id }})"
                                                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline text-sm">
                                                    Cancel
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button type="button" onclick="toggleEditForm({{ $todo->id }})"
                                            class="text-blue-500 hover:text-blue-700 focus:outline-none edit-btn "
                                            id="edit-button-{{ $todo->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.536L16.732 3.732z" />
                                            </svg>
                                        </button>
                                        <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700 focus:outline-none delete-btn align-middle"
                                                data-name="{{ $todo->description }}"
                                                id="delete-button-{{ $todo->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

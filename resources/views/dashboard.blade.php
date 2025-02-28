@extends('layouts.app')

@section('header')
    <div class="flex justify-between items-center">
        <div>Todo list dashboard</div>
        <div>
            <form action="#" method="POST" class="flex items-center mb-4">
                @csrf
                <button type="button"
                    class="ai-assistant-button ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline flex items-center">
                    <div>AI assistant</div>
                    <svg fill="white" width="1.5rem" height="auto" viewBox="0 0 512 512" id="icons"
                        xmlns="http://www.w3.org/2000/svg" class="ml-2">
                        <path
                            d="M208,512a24.84,24.84,0,0,1-23.34-16l-39.84-103.6a16.06,16.06,0,0,0-9.19-9.19L32,343.34a25,25,0,0,1,0-46.68l103.6-39.84a16.06,16.06,0,0,0,9.19-9.19L184.66,144a25,25,0,0,1,46.68,0l39.84,103.6a16.06,16.06,0,0,0,9.19,9.19l103,39.63A25.49,25.49,0,0,1,400,320.52a24.82,24.82,0,0,1-16,22.82l-103.6,39.84a16.06,16.06,0,0,0-9.19,9.19L231.34,496A24.84,24.84,0,0,1,208,512Zm66.85-254.84h0Z" />
                        <path
                            d="M88,176a14.67,14.67,0,0,1-13.69-9.4L57.45,122.76a7.28,7.28,0,0,0-4.21-4.21L9.4,101.69a14.67,14.67,0,0,1,0-27.38L53.24,57.45a7.31,7.31,0,0,0,4.21-4.21L74.16,9.79A15,15,0,0,1,86.23.11,14.67,14.67,0,0,1,101.69,9.4l16.86,43.84a7.31,7.31,0,0,0,4.21,4.21L166.6,74.31a14.67,14.67,0,0,1,0-27.38l-43.84,16.86a7.28,7.28,0,0,0-4.21,4.21L101.69,166.6A14.67,14.67,0,0,1,88,176Z" />
                        <path
                            d="M400,256a16,16,0,0,1-14.93-10.26l-22.84-59.37a8,8,0,0,0-4.6-4.6l-59.37-22.84a16,16,0,0,1,0-29.86l59.37-22.84a8,8,0,0,0,4.6-4.6L384.9,42.68a16.45,16.45,0,0,1,13.17-10.57,16,16,0,0,1,16.86,10.15l22.84,59.37a8,8,0,0,0,4.6,4.6l59.37,22.84a16,16,0,0,1,0,29.86l-59.37,22.84a8,8,0,0,0-4.6,4.6l-22.84,59.37A16,16,0,0,1,400,256Z" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
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
                                            <input type="hidden" name="completed" value="0" {{ $todo->completed ? '' : 'disabled' }}>
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
    <x-ai-assistant-sidebar />
@endsection

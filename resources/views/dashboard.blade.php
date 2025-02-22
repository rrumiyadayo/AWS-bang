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

                        <div class="flex items-center mb-4">
                            <input type="text" id="new-task" placeholder="Add a new task..."
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <button id="add-task-btn"
                                    class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Add
                            </button>
                        </div>

                        <ul id="task-list" class="space-y-2">
                            {{-- @foreach ($todos as $todo)

                            @endforeach --}}
                            <!-- Task items will be added here by JavaScript -->
                            <li class="flex items-center justify-between bg-gray-50 p-3 rounded-md">
                                <div class="flex items-center">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-gray-800">Example Task 1</span>
                                </div>
                                <button class="text-red-500 hover:text-red-700 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </li>
                            <li class="flex items-center justify-between bg-gray-50 p-3 rounded-md">
                                <div class="flex items-center">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500" checked>
                                    <span class="ml-2 text-gray-800 line-through text-gray-500">Completed Task Example</span>
                                </div>
                                <button class="text-red-500 hover:text-red-700 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </li>
                            <!-- More task items can be added similarly -->
                        </ul>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const taskInput = document.getElementById('new-task');
                            const addTaskButton = document.getElementById('add-task-btn');
                            const taskList = document.getElementById('task-list');

                            addTaskButton.addEventListener('click', () => {
                                const taskText = taskInput.value.trim();
                                if (taskText !== "") {
                                    addTaskToList(taskText);
                                    taskInput.value = ""; // Clear input after adding
                                }
                            });

                            taskInput.addEventListener('keypress', (event) => {
                                if (event.key === 'Enter') {
                                    addTaskButton.click(); // Trigger add button click on Enter
                                }
                            });

                            taskList.addEventListener('click', (event) => {
                                if (event.target.type === 'checkbox') {
                                    toggleTaskCompletion(event.target);
                                } else if (event.target.closest('button') && event.target.closest('li')) {
                                    deleteTask(event.target.closest('li'));
                                }
                            });


                            function addTaskToList(taskText) {
                                const listItem = document.createElement('li');
                                listItem.classList.add('flex', 'items-center', 'justify-between', 'bg-gray-50', 'p-3', 'rounded-md');

                                listItem.innerHTML = `
                                    <div class="flex items-center">
                                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                                        <span class="ml-2 text-gray-800">${taskText}</span>
                                    </div>
                                    <button class="text-red-500 hover:text-red-700 focus:outline-none delete-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                `;
                                taskList.appendChild(listItem);
                            }

                            function toggleTaskCompletion(checkbox) {
                                const taskSpan = checkbox.nextElementSibling;
                                if (checkbox.checked) {
                                    taskSpan.classList.add('line-through', 'text-gray-500');
                                    taskSpan.classList.remove('text-gray-800');
                                } else {
                                    taskSpan.classList.remove('line-through', 'text-gray-500');
                                    taskSpan.classList.add('text-gray-800');
                                }
                            }

                            function deleteTask(listItem) {
                                listItem.remove();
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection

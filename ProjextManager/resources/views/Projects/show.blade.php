<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        {{ $project->project_name }}
                    </div>

                    <div class="mt-6">
                        <p>{{ $project->description }}</p>
                        <p>{{ $project->category }}</p>
                        <p>{{ $project->objectives }}</p>
                        <p>{{ $project->start_date }}</p>
                        <p>{{ $project->end_date }}</p>
                        <p>{{ $project->status }}</p>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-lg font-semibold">{{ __('Tasks') }}</h3>
                        <form method="POST" action="{{ route('tasks.store') }}">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <div id="tasks-container">
                                <div class="task">
                                    <x-label for="task_name" value="{{ __('Task Name') }}" />
                                    <x-input id="task_name" class="block mt-1 w-full bg-white" type="text" name="task_name[]" required />
                                    <x-label for="description" value="{{ __('Description') }}" />
                                    <x-input id="description" class="block mt-1 w-full bg-white" type="text" name="description[]" required />
                                    <x-label for="status" value="{{ __('Status') }}" />
                                    <select id="status" class="block mt-1 w-full bg-white" name="status[]" required>
                                        <option value="pending" selected>{{ __('Pending') }}</option>
                                        <option value="running" disabled>{{ __('Running') }}</option>
                                        <option value="completed">{{ __('Completed') }}</option>
                                    </select>
                                    <x-label for="dependent_task_id" value="{{ __('Dependent Task') }}" />
                                    <select id="dependent_task_id" name="dependent_task_id[]" class="block mt-1 w-full bg-white" onchange="toggleRunningOption(this)">
                                        <option value="">{{ __('None') }}</option>
                                        @foreach ($tasks as $task)
                                        <option value="{{ $task->id }}" data-status="{{ $task->status }}">{{ $task->title }}</option>
                                        @endforeach
                                    </select>
                                    <x-label for="due_date" value="{{ __('Due Date') }}" />
                                    <x-input id="due_date" class="block mt-1 w-full bg-white" type="date" name="due_date[]" required />
                                    <x-label for="team_id" value="{{ __('Assign Team') }}" />
                                    <select id="team_name" name="team_name[]" class="block mt-1 w-full bg-white" required>
                                        @foreach ($teams as $team)
                                            <option value="{{ $team->team_name }}">{{ $team->team_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <x-button type="button" id="add-task-button" class="mt-4">
                                {{ __('Add Another Task') }}
                            </x-button>
                            <x-button class="mt-4">
                                {{ __('Submit Tasks') }}
                            </x-button>
                        </form>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('projects.tasks', $project->id) }}" class="text-indigo-600 hover:text-indigo-900">
                            {{ __('View Tasks') }}
                        </a>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('projects.edit', $project->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Edit Project') }}
                        </a>
                        <form method="POST" action="{{ route('projects.destroy', $project->id) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <x-button class="bg-red-600 hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring ring-red-300">
                                {{ __('Delete Project') }}
                            </x-button>
                        </form>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('projects.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            {{ __('Back to Projects') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleRunningOption(selectElement) {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var status = selectedOption.getAttribute('data-status');
            var statusSelect = selectElement.closest('.task').querySelector('#status');

            if (status === 'running' || status === 'completed') {
                statusSelect.querySelector('option[value="running"]').disabled = true;
                statusSelect.querySelector('option[value="completed"]').disabled = true;
            } else {
                statusSelect.querySelector('option[value="running"]').disabled = false;
            }
        }

        document.getElementById('add-task-button').addEventListener('click', function() {
            var taskContainer = document.getElementById('tasks-container');
            var newTask = document.createElement('div');
            newTask.classList.add('task');
            newTask.innerHTML = `
                <x-label for="task_name" value="{{ __('Task Name') }}" />
                <x-input id="task_name" class="block mt-1 w-full bg-white" type="text" name="task_name[]" required />
                <x-label for="description" value="{{ __('Description') }}" />
                <x-input id="description" class="block mt-1 w-full bg-white" type="text" name="description[]" required />
                <x-label for="status" value="{{ __('Status') }}" />
                <select id="status" class="block mt-1 w-full bg-white" name="status[]" required>
                    <option value="pending" selected>{{ __('Pending') }}</option>
                    <option value="running" disabled>{{ __('Running') }}</option>
                    <option value="completed">{{ __('Completed') }}</option>
                </select>
                <x-label for="dependent_task_id" value="{{ __('Dependent Task') }}" />
                <select id="dependent_task_id" name="dependent_task_id[]" class="block mt-1 w-full bg-white" onchange="toggleRunningOption(this)">
                    <option value="">{{ __('None') }}</option>
                    @foreach ($tasks as $task)
                        <option value="{{ $task->id }}" data-status="{{ $task->status }}">{{ $task->title }}</option>
                    @endforeach
                </select>
                <x-label for="due_date" value="{{ __('Due Date') }}" />
                <x-input id="due_date" class="block mt-1 w-full bg-white" type="date" name="due_date[]" required />
                <x-label for="team_id" value="{{ __('Assign Team') }}" />
                <select id="team_name" name="team_name[]" class="block mt-1 w-full bg-white" required>
                    @foreach ($teams as $team)
                        <option value="{{ $team->team_name }}">{{ $team->team_name }}</option>
                    @endforeach
                </select>
            `;
            taskContainer.appendChild(newTask);
        });
    </script>
</x-app-layout>

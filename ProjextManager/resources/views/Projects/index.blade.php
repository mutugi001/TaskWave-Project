<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        {{ __('Your Projects') }}
                    </div>

                    <div class="mt-6">
                        @foreach ($projects as $project)
                            <a href="{{ route('projects.show', $project->id) }}" class="block p-6 border-b border-gray-200 hover:bg-gray-100">
                                <h3 class="text-lg font-semibold">{{ $project->project_name }}</h3>
                                <p class="mt-2">{{ $project->description }}</p>
                                @php
                                    $totalTasks = \App\Models\Task::where('project_id', $project->id)->count();
                                    $completedTasks = \App\Models\Task::countTasksByStatus($project->id, 'completed');
                                    $progress = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
                                @endphp
                                <div class="mt-4">
                                    <div class="w-full bg-gray-200 rounded-full h-4">
                                        <div class="bg-green-500 h-4 rounded-full" style="width: {{ $progress }}%"></div>
                                    </div>
                                    <p class="text-sm mt-1">{{ round($progress) }}% {{ __('Completed') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            {{ __('Back to Dashboard') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

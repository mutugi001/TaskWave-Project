<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('projects.update', $project->id) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-label for="project_name" value="{{ __('Project Name') }}" />
                            <x-input id="project_name" class="block mt-1 w-full" type="text" name="project_name" value="{{ $project->project_name }}" required autofocus />
                            @error('project_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-label for="description" value="{{ __('Description') }}" />
                            <x-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{ $project->description }}" required />
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-label for="category" value="{{ __('Category') }}" />
                            <x-input id="category" class="block mt-1 w-full" type="text" name="category" value="{{ $project->category }}" required />
                            @error('category')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-label for="objectives" value="{{ __('Objectives') }}" />
                            <x-input id="objectives" class="block mt-1 w-full" type="text" name="objectives" value="{{ $project->objectives }}" required />
                            @error('objectives')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-label for="start_date" value="{{ __('Start Date') }}" />
                            <x-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" value="{{ $project->start_date }}" required />
                            @error('start_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-label for="end_date" value="{{ __('End Date') }}" />
                            <x-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" value="{{ $project->end_date }}" required />
                            @error('end_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-label for="status" value="{{ __('Status') }}" />
                            <x-input id="status" class="block mt-1 w-full" type="text" name="status" value="{{ $project->status }}" required />
                            @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ms-4">
                                {{ __('Update Project') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

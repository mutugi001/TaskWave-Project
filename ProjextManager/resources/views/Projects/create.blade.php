<x-app-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif


        {{-- <form method="POST" action="{{ route('projects.store') }}"> --}}
            <form method=POST action= "{{ route('projects.store') }}">
                @csrf
            <div>
                <x-label for="project_name" value="{{ __('Project Name') }}" />
                <x-input id="project_name" class="block mt-1 w-full" type="text" name="project_name" :value="old('project_name')" required autofocus autocomplete="project_name" />
                @error('project_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="description" value="{{ __('Description') }}" />
                <x-textarea id="description" class="block mt-1 w-full" name="description" required>{{ old('description') }}</x-textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="mt-4">
                <x-label for="category" value="{{ __('category') }}" />
                <x-textarea id="category" class="block mt-1 w-full" name="category" required>{{ old('category') }}</x-textarea>
                @error('category')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <x-label for="objectives" value="{{ __('objectives') }}" />
                <x-textarea id="objectives" class="block mt-1 w-full" name="objectives" required>{{ old('objectives') }}</x-textarea>
                @error('objectives')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="start_date" value="{{ __('Start Date') }}" />
                <x-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date')" required />
                @error('start_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="end_date" value="{{ __('End Date') }}" />
                <x-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date')" required />
                @error('end_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="status" value="{{ __('Status') }}" />
                <select id="status" class="block mt-1 w-full" name="status" required>
                    <option value="running" {{ old('status') == 'running' ? 'selected' : '' }}>Running</option>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
                @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ms-4">
                    {{ __('Create Project') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-app-layout>

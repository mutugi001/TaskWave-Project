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
            <form method=POST action= "{{ route('teams.store') }}">
                @csrf
            <div>
                <x-label for="project_name" value="{{ __('Team Name') }}" />
                <x-input id="team_name" class="block mt-1 w-full" type="text" name="team_name" :value="old('team_name')" required autofocus autocomplete="team_name" />
                @error('team_name')
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
            <div class="flex items-center justify-end mt-4">

                <x-button class="ms-4">
                    {{ __('Create Team') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-app-layout>

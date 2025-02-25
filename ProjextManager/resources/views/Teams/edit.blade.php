<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Team') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('teams.update', $team->id) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-label for="team_name" value="{{ __('Team Name') }}" />
                            <x-input id="team_name" class="block mt-1 w-full" type="text" name="team_name" value="{{ $team->team_name }}" required autofocus />
                            @error('team_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-label for="description" value="{{ __('Description') }}" />
                            <x-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{ $team->description }}" required />
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ms-4">
                                {{ __('Update Team') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

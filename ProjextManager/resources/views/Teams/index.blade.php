<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teams') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        {{ __('Your Teams') }}
                    </div>

                    <x-back-button />

                    <div class="mt-6">
                        @foreach ($teams as $team)
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-lg font-semibold">{{ $team->team_name }}</h3>
                                <p class="mt-2">{{ $team->description }}</p>
                                <a href="{{ route('teams.show', $team->id) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('View Team') }}</a>
                                {{-- <a href="{{ route('teams.members', $team->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-4">{{ __('View Members') }}</a> --}}
                            </div>
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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Member') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('members.update', $member->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $member->name }}" required autofocus />
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $member->email }}" required />
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-label for="role" value="{{ __('Role') }}" />
                            <select id="role" name="role" class="block mt-1 w-full" required>
                                <option value="Member" {{ $member->role == 'Member' ? 'selected' : '' }}>Member</option>
                                <option value="Team Lead" {{ $member->role == 'Team Lead' ? 'selected' : '' }}>Team Lead</option>
                            </select>
                            @error('role')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-label for="phone" value="{{ __('Phone') }}" />
                            <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ $member->phone }}" required />
                            @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-label for="profile_picture" value="{{ __('Profile Picture') }}" />
                            <x-input id="profile_picture" class="block mt-1 w-full" type="file" name="profile_picture" />
                            @error('profile_picture')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ms-4">
                                {{ __('Update Member') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

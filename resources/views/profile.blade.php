<x-app-layout>
    <div class="flex justify-between">
        <div class="flex-auto">
            <x-card>
                <img class="cursor-pointer bg-cover" onclick="document.getElementById('go').click();"
                            src="{{ asset('storage/icons/edit.png') }}"
                            width="20" height="20" />
                <a id="go" class="hidden" href="{{ route('user.edit', $user->id) }}"></a>
        
                <!-- Photo -->
                @livewire('upload-image', ['default_photo' => asset('images/' . $user->profile_photo)])
    
                <!-- FullName -->
                <div>
                    <div class="text-base text-white">
                        {{ __('FullName') }}
                    </div>
                    <div class="text-xl text-white font-bold">
                        {{ $user->fullname }}
                    </div>
                </div>
    
                <!-- Userame -->
                <div class="mt-4">
                    <div class="text-base text-white">
                        {{ __('Username') }}
                    </div>
                    <div class="text-xl text-white font-bold">
                        {{ $user->username }}
                    </div>
                </div>
    
                <!-- Email Address -->
                <div class="mt-4">
                    <div class="text-base text-white">
                        {{ __('Email') }}
                    </div>
                    <div class="text-xl text-white font-bold">
                        {{ $user->email }}
                    </div>
                </div>
            </x-card>
        </div>

        <div class="flex-auto mt-6">
            @forelse ($blogs as $blog)
                
            @empty
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            You have not written any blogs yet.
                            <a class="text-orange-dark" href="{{ route('blog.create') }}">Write One.</a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>

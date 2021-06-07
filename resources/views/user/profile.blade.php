<x-app-layout>
    <div class="flex justify-between">
        <div class="flex-auto max-w-xl">
            <!-- Profile  -->
            <x-card>
                <img class="cursor-pointer bg-cover" onclick="document.getElementById('user-edit').click();"
                            src="{{ asset('storage/icons/edit.png') }}"
                            width="20" height="20" />
                <a id="user-edit" class="hidden" href="{{ route('user.edit', $user->id) }}"></a>
        
                <!-- Photo -->
                @livewire('display-profile', ['user' => $user, 'dimension' => 250, 'has_event' => false])
    
                <!-- Fullname -->
                <div>
                    <div class="text-base text-white">
                        {{ __('Fullname') }}
                    </div>
                    <div class="text-xl text-white font-bold">
                        {{ $user->fullname }}
                    </div>
                </div>
    
                <!-- Username -->
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

        <!-- Blogs -->
        <div class="flex-auto mt-6 max-w-2xl">
            <div class="sm:mr-6 lg:mr-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if ($user->blogs()->count() == 0)
                            You have not written any blogs yet.
                            <a class="text-orange-dark" href="{{ route('blog.create') }}">Write One.</a>
                        @else
                            Your Stories
                        @endif
                    </div>
                </div>
            </div>

            @foreach ($user->blogs as $blog)
                <div class="flex my-3 w-4/5 p-3 bg-gradient-to-br from-orange rounded-full cursor-pointer"
                    onclick="document.getElementById('story-read').click();">
                    <!-- Blog Photo -->
                    <img class="rounded-full cursor-pointer bg-cover" 
                        src="{{ $blog->main_photo != null ? 
                                asset('images/' . $blog->main_photo) : 
                                asset('storage/defaults/blog.png') }}"
                            width="150" height="150" />
                    
                    <div class="flex mx-3 justify-center items-center flex-col">
                        <!-- Title -->
                        <div class="h-auto text-xl text-white font-bold">
                            {{ $blog->title }}
                        </div>

                        <!-- Tags -->
                        @livewire('display-tags', ['tags' => $blog->tags])
                    </div>
            
                    

                    <a id="story-read" class="hidden" href="{{ route('blog.show', $blog->id) }}"></a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

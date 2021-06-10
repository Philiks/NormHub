<x-app-layout>
    <div class="flex justify-between">
        <div class="flex-auto max-w-xl">
            <!-- Profile  -->
            <x-card>
                @author($user->id)
                    <div class="flex">
                        <x-icon-anchor modelName="user" action="edit" paramId="{{ $user->id }}" />
                        <x-icon-anchor action="logout" verb="POST" paramId="{{ $user->id }}" />
                    </div>
                @endauthor
        
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
                    <div class="p-6 bg-white border-b border-gray-200 text-2xl font-bold">
                        @if ($user->blogs()->count() == 0)
                            {{ __($user->username . ' have not written any blogs yet.') }}
                            <a class="text-orange-dark" href="{{ route('blog.create') }}">{{ __('Write One.') }}</a>
                        @else
                            {{ __($user->username . '\'s Stories') }}
                        @endif
                    </div>
                </div>
            </div>

            @foreach ($user->blogs as $blog)
                @php
                    // This is to make sure that every Blog being rendered on a page
                    // has a unique ID for its anchor tag.
                    $readAnchorId = 'story-read-' . $blog->id;
                @endphp

                <div class="flex my-3 w-4/5 p-3 bg-gradient-to-br from-orange rounded-full">
                    <!-- Blog Photo -->
                    <img class="rounded-full cursor-pointer bg-cover" 
                        onclick="document.getElementById('{{ $readAnchorId }}').click();"
                        src="{{ $blog->main_photo != null ? 
                                asset('images/' . $blog->main_photo) : 
                                asset('storage/defaults/blog.png') }}"
                            width="150" height="150" />
                    
                    <div class="flex mx-3 justify-center items-center flex-col">
                        <div class="flex justify-center items-center h-auto">
                            <!-- Title -->
                            <div class="text-xl text-white font-bold cursor-pointer" onclick="document.getElementById('{{ $readAnchorId }}').click();">
                                {{ $blog->title }}
                            </div>

                            @author($blog->author_id)
                                <x-icon-anchor modelName="blog" action="edit" paramId="{{ $blog->id }}" isInverted=true />
                                <x-icon-anchor modelName="blog" action="destroy" paramId="{{ $blog->id }}" verb="DELETE" isInverted=true />
                            @endauthor
                        </div>

                        <!-- Tags -->
                        @livewire('display-tags', ['tags' => $blog->tags])
                    </div>

                    <a id="{{ $readAnchorId }}" class="hidden" href="{{ route('blog.show', $blog->id) }}"></a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

<div>
    <div class="max-w-7xl pt-6 pb-3 mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200 text-2xl font-bold">
                @if (empty($blogs))
                    {{ __('There are no blogs found.') }}
                @else
                    {{ __('NormHub Blogs') }}
                @endif
            </div>
        </div>
    </div>

    <div class="mx-5 px-5 max-w-1 grid grid-cols-3 gap-4">
        @foreach ($blogs as $blog)
            @php                
                // This is to make sure that every Blog being rendered on a page
                // has a unique ID for its anchor tag.
                $readAnchorId = 'story-read-' . $blog['id'];
            @endphp

            <div class="flex my-3 p-3 bg-gradient-to-br from-orange rounded-full">
                <!-- Blog Photo -->
                <img class="rounded-full cursor-pointer bg-cover" 
                    onclick="document.getElementById('{{ $readAnchorId }}').click();"
                    src="{{ $blog['main_photo'] != null ? 
                        asset('images/' . $blog['main_photo']) : 
                        asset('storage/defaults/blog.png') }}"
                    width="75" height="75" />

                <div class="flex flex-row mx-3 justify-center flex-col">
                    <!-- Title -->
                    <div class="text-lg text-white font-bold cursor-pointer" onclick="document.getElementById('{{ $readAnchorId }}').click();">
                        {{ $blog['title'] }}
                    </div>

                    <div class="flex items-center h-auto">
                        @author($blog['author_id'])
                            <x-icon-anchor modelName="blog" action="edit" paramId="{{ $blog['id'] }}" isInverted=true />
                            <x-icon-anchor modelName="blog" action="destroy" paramId="{{ $blog['id'] }}" isInverted=true />
                        @endauthor
                        
                        <img class="cursor-pointer bg-cover m-1 filter brightness-0 invert" 
                            wire:click="setFeature('{{ $blog['id'] }}')"
                            src="{{ asset('storage/icons/' . ($blog['is_featured'] ? 'to_not_feature' : 'to_feature') . '.png') }}"
                            width="20" height="20" />
                    </div>
                </div>

                
                <a id="{{ $readAnchorId }}" class="hidden" href="{{ route('blog.show', $blog['id']) }}"></a>
            </div>
        @endforeach
    </div>
</div>
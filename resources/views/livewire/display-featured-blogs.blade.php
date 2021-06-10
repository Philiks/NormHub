@foreach ($blogs as $blog)
    @php
        // This is to make sure that every Blog being rendered on a page
        // has a unique ID for its anchor tag.
        $anchorId = 'blog-show-' . $blog->id;
    @endphp

    <div class="flex flex-col items-center cursor-pointer" onclick="document.getElementById('{{ $anchorId }}').click();">
        <img class="mb-3 rounded-lg"
                src="{{ $blog->main_photo != null ? 
                        asset('images/' . $blog->main_photo) : 
                        asset('storage/defaults/blog.png') }}" 
                width="250" height="250" />

        <div class="mx-3 w-full h-32 bg-orange overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex flex-col justify-between p-6 h-full bg-gradient-to-br from-orange to-orange-dark border-b-2 border-orange-light">
                <div class="text-lg font-bold">
                    {{ $blog->title }}
                </div>

                <div class="flex text-base justify-between">
                    <div>
                        {{ __('written by: ') . $blog->author->username }}
                    </div>

                    <div>
                        {{ __($blog->read_time_str()) }}
                    </div>
                </div>
            </div>
        </div>

        @livewire('display-tags', ['tags' => $blog->tags])

        <a id="{{ $anchorId }}" class="hidden" href="{{ route('blog.show', $blog->id) }}"></a>
    </div>
@endforeach

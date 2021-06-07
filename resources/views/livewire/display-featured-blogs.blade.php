@foreach ($blogs as $blog)
    <div class="flex flex-col items-center cursor-pointer" onclick="document.getElementById('read').click();">
        <img class="mb-3 rounded-lg resize-none"
                src="{{ $blog->main_photo ?? asset('storage/defaults/blog.png') }}" 
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

        <a id="read" class="hidden" href="{{ route('blog.show', $blog->id) }}"></a>
    </div>
@endforeach

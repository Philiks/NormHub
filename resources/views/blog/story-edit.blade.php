<x-guest-layout>
    <x-wide-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('blog.update', $blog->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <x-label for="title" :value="__('Title')" />

                <x-input id="title" class="text-center text-xl lg:text-3xl block mt-1 w-full" type="text" name="title" :value="$blog->title" required autofocus />
            </div>

            <!-- Photo -->
            @livewire('upload-image', ['default_photo' => asset($blog->main_photo != null ? 'images/' . $blog->main_photo : 'storage/defaults/blog.png'), 'is_round' => false])

            <!-- Content -->
            <div>
                <x-label for="content" :value="__('Content')" />

                <x-textarea id="content" class="block mt-1 w-full" type="text" name="content" value="{{ $blog->format_content() }}" required />
            </div>

            <!-- Tags -->
            <div class="mt-4">
                <x-label for="tags" :value="__('Tags *separate multiple tags using comma \',\' i.e. abc,def.')" />

                <x-input id="tags" class="block mt-1 w-full" type="text" name="tags" :value="$blog->csv_tags()" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Edit') }}
                </x-button>
            </div>
        </form>
    </x-wide-card>
</x-guest-layout>

<x-app-layout>
    <x-wide-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
        <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div>
                <x-label for="title" :value="__('Title')" />

                <x-input id="title" class="text-center text-xl lg:text-3xl block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            </div>

            <!-- Photo -->
            @livewire('upload-image', ['default_photo' => asset('storage/defaults/blog.png'), 'is_round' => false])

            <!-- Content -->
            <div>
                <x-label for="content" :value="__('Content')" />

                <x-textarea id="content" class="block mt-1 w-full" type="text" name="content" required />
            </div>

            <!-- Tags -->
            <div class="mt-4">
                <x-label for="tags" :value="__('Tags *separate multiple tags using comma \',\' i.e. abc,def.')" />

                <x-input id="tags" class="block mt-1 w-full" type="text" name="tags" :value="old('tags')" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Publish') }}
                </x-button>
            </div>
        </form>
    </x-wide-card>
</x-app-layout>
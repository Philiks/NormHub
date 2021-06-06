<x-app-layout>
    <div class="flex justify-between px-6">
        
            <x-card>
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
        
                    <!-- Photo -->
                    @livewire('upload-image', ['default_photo' => 'profile'])
        
                    <!-- FullName -->
                    <div>
                        <x-label for="fullname" :value="__('FullName')" />
        
                        <x-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" :value="old('fullname')" required autofocus />
                    </div>
        
                    <!-- Userame -->
                    <div class="mt-4">
                        <x-label for="username" :value="__('Username')" />
        
                        <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
                    </div>
        
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />
        
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>
        
                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')" />
        
                        <x-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
                    </div>
        
                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('Confirm Password')" />
        
                        <x-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required />
                    </div>
        
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
        
                        <x-button class="ml-4">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>
            </x-card>

        <div class="flex-auto py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Profile
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

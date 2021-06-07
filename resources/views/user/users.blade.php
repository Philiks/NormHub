<x-app-layout>
    <div class="max-w-7xl pt-6 pb-3 mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                {{ empty($users) ? 
                    __('There are no users found.') :
                    __('NormHub Users') }}
            </div>
        </div>
    </div>

    <div class="px-10 grid grid-cols-3 gap-6">
        @foreach ($users as $user)
            <div class="flex my-3 p-3 bg-gradient-to-br from-orange rounded-full">
                <!-- Profile Photo -->
                <img class="rounded-full cursor-pointer bg-cover" 
                    src="{{ $user->profile_photo != null ? 
                            asset('images/' . $user->profile_photo) : 
                            asset('storage/defaults/profile.png') }}"
                        width="100" height="100" />
                
                <div class="mx-3">
                    <!-- Username -->
                    <div class="text-xl text-white font-bold">
                        {{ $user->username }}
                    </div>
                    
                    <!-- Fullname -->
                    <div class="text-base text-white">
                        {{ $user->fullname }}
                    </div>
        
                    <!-- Email Address -->
                    <div class="text-base text-white">
                        {{ $user->email }}
                    </div>

                    <!-- Blog Count -->
                    <div class="text-base text-white">
                        
                        @if ($user->blogs()->count() == 0)
                            {{ __('No blogs written yet.') }}
                        @elseif($user->blogs()->count() == 1)
                            {{ __('(1) blog written.') }}
                        @else
                            {{ __('(' . $user->blogs()->count() . ') blogs written.') }}
                        @endif
                        
                    </div>
                </div>
            </div>         
        @endforeach   
    </div>
</x-app-layout>

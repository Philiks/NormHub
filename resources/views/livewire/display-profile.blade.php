<div>
    <!-- Show Profile -->
    <form method="GET" action="{{ route('user.show', auth()->user()->id) }}">
        @csrf

        <img class="rounded-full cursor-pointer bg-cover" onclick="document.getElementById('submit').click();"
                    src="{{ $profile ?? asset('storage/defaults/profile.png') }}"
                    width="40" height="40" />
                    
        <x-button id="submit" class="hidden">
        </x-button>
    </form>
</div>

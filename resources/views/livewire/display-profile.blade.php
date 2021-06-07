<div class="flex justify-center items-center">
    @if ($has_event)
        <img class="rounded-full cursor-pointer bg-cover" 
                onclick="document.getElementById('user-show').click();"
                src="{{ $profile ?? asset('storage/defaults/profile.png') }}"
                width="{{ $dimension }}" height="{{ $dimension }}" />

        <a id="user-show" class="hidden" href="{{ route('user.show', $userId) }}"></a>
    @else
        <img class="rounded-full bg-cover" 
                src="{{ $profile ?? asset('storage/defaults/profile.png') }}"
                width="{{ $dimension }}" height="{{ $dimension }}" />
    @endif
</div>

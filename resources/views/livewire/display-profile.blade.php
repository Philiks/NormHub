<div class="flex justify-center items-center">
    @if ($has_event)
        @php
            // This is to make sure that every User Profile being rendered on a page
            // has a unique ID for its anchor tag.
            $anchorId = 'user-show-' . $userId;
        @endphp

        <img class="rounded-full cursor-pointer bg-cover" 
                onclick="document.getElementById('{{ $anchorId }}').click();"
                src="{{ $profile ?? asset('storage/defaults/profile.png') }}"
                width="{{ $dimension }}" height="{{ $dimension }}" />

        <a id="{{ $anchorId }}" class="hidden" href="{{ route('user.show', $userId) }}"></a>
    @else
        <img class="rounded-full bg-cover" 
                src="{{ $profile ?? asset('storage/defaults/profile.png') }}"
                width="{{ $dimension }}" height="{{ $dimension }}" />
    @endif
</div>

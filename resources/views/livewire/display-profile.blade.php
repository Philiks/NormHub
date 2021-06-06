<div>
    <img class="rounded-full cursor-pointer bg-cover" onclick="document.getElementById('go').click();"
                src="{{ $profile ?? asset('storage/defaults/profile.png') }}"
                width="40" height="40" />
    <a id="go" class="hidden" href="{{ route('user.show', auth()->user()->id) }}"></a>
</div>

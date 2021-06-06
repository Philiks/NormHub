<div class="relative px-1/4 pb-1/2 mt-4">
    <img class="{{ $border }} absolute object-cover h-full cursor-pointer" onclick="document.getElementById('photo').click();" 
            src="{{ $photo == null ? $default_photo : $photo->temporaryUrl() }}" 
            width="{{ $width }}" height="{{ $height }}" />

    <div class="mt-2">
        <x-input id="photo" class="block mt-1 w-full hidden" 
                type="file" 
                name="photo" 
                wire:model="photo" />
    </div>
</div>

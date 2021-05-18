@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-white lg:text-base']) }}>
    {{ $value ?? $slot }}
</label>

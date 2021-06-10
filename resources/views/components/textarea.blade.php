@props(['disabled' => false, 'value' => ''])

<textarea rows="20" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'resize-none min-w-20 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>{{ $value }}</textarea>

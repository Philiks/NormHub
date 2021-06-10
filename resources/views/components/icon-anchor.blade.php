@props(['modelName' => null, 'action', 'paramId', 'verb' => 'GET', 'isInverted' => false])

@php
    $route = $modelName == null ? 
                $action :
                $modelName . '.' . $action;
@endphp

<form method="POST" action="{{ route($route, $paramId) }}">
    @csrf

    @method($verb)

    <img class="cursor-pointer bg-cover m-1 "
                onclick="event.preventDefault(); this.closest('form').submit();"
                src="{{ asset('storage/icons/' . $action . '.png') }}"
                width="20" height="20" />
</form>
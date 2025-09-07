@props(['route', 'icon', 'label'])

@php
    $isActive = request()->routeIs($route) || request()->routeIs($route . '.*');
@endphp

<a href="{{ route($route) }}"
   class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
         {{ $isActive ? 'bg-indigo-800 font-semibold' : 'hover:bg-indigo-700' }}">
    <i class="{{ $icon }}"></i>
    {{ $label }}
</a>


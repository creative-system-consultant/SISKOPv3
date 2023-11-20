@props([
    'name' => '',
    'varble' => null,
])

<style>
.tooltip .tooltip-text {
    visibility: hidden;
    text-align: center;
    padding: 2px 6px;
    position: absolute;
    z-index: 100;
}

.tooltip:hover .tooltip-text {
    visibility: visible;
}
</style>

<nav class="flex flex-col sm:flex-row tooltip text-black dark:text-white">
    @php
    $defaultClasses = 'py-4 px-4 block hover:text-primary-500 focus:outline-none cursor-pointer';
    $activeClasses = 'text-primary-500 border-b-4 font-medium border-primary-500';
    $inactiveClasses = 'text-stone-500 border-b-4 font-medium border-stone-500 hidden';
    $activeClick = "active = $name";
    @endphp

    <div class="{{ $defaultClasses }}
         @if ($varble == 1) {{ $activeClasses }} @elseif ($varble == 0) {{ $inactiveClasses }} @endif"
         x-on:click.prevent="{{ $activeClick }}"
         x-bind:class="{'{{ $activeClasses }}': active === {{ $name }} }"
         {{ $attributes }}
    >
        <div>
            {{ $slot }}
        </div>
    </div>
</nav>

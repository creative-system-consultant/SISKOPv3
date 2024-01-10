
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
    
<ul class="text-xs font-medium text-center text-gray-500 md:text-sm dark:text-white tooltip">
    <li class="mr-2">
        <a href="#" aria-current="page" class="inline-block p-4" x-on:click.prevent="active = {{ $name }}" x-bind:class="{'text-primary-800  rounded-t-lg border-b-2 border-primary-800 dark:text-primary-500 dark:border-primary-600': active === {{ $name }} }"
        {{ $livewire }}>
            {{ $slot }}
        </a>
    </li>
</ul>



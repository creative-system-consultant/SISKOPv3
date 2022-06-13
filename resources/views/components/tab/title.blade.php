<ul class="text-sm font-medium text-center text-gray-500">
    <li class="mr-2">
        <a href="#" aria-current="page" class="inline-block p-4" x-on:click.prevent="active = {{ $name }}" x-bind:class="{'text-primary-800  rounded-t-lg border-b-2 border-primary-800 ': active === {{ $name }} }"
        {{ $livewire }}>
            {{ $slot }}
        </a>
    </li>
</ul>



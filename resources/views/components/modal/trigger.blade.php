<span x-data="{id:'{{ $target }}'}" x-on:click="$dispatch('modal-overlay',{id})">
    {{ $slot }}
</span>

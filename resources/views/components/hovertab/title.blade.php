
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

    <nav class="flex flex-col sm:flex-row tooltip text-black dark:text-white ">
        <div class="py-4 px-4 block hover:text-primary-500 focus:outline-none  cursor-pointer" x-on:click.prevent="active = {{ $name }}" x-bind:class="{'text-primary-500 border-b-4 font-medium border-primary-500 ': active === {{ $name }} }"
            {{ $attributes }}
        >
            <div class="">
                {{ $slot }}
            </div>
        </div>
    </nav>

<div class="bg-white rounded-md p-6 shadow-md ">
    <h2 class="text-lg font-semibold mb-4 border-b-2 border-gray-300">Grid Component</h2>

    <!-- start Grid auto component -->
    <x-general.accordion active="selected" tab="11" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold bg-gray-50 rounded-md">
                <p class="text-sm">Auto Grid</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="border-t-2 px-6">
                <div class="bg-white shadow-lg p-4 my-4">
                    <x-general.grid mobile="1" gap="5" sm="1" md="2" lg="4" xl="4" class="col-span-12">
                        <div class="bg-yellow-500 p-4 h-24"></div>
                        <div class="bg-indigo-500 p-4 h-24"></div>
                        <div class="bg-blue-500 p-4 h-24"></div>
                        <div class="bg-pink-500 p-4 h-24"></div>
                    </x-general.grid>
                </div>
                <p class="font-semibold">Code</p>
                <pre class="language-html -mt-4" wire:ignore>
                    <code class="language-html"> 
&lt;x-general.grid mobile="1" gap="5" sm="1" md="2" lg="4" xl="4" class="col-span-12">
    &lt;div class="bg-yellow-500 p-4 h-24">&lt;/div>
    &lt;div class="bg-indigo-500 p-4 h-24">&lt;/div>
    &lt;div class="bg-blue-500 p-4 h-24">&lt;/div>
    &lt;div class="bg-pink-500 p-4 h-24">&lt;/div>
&lt;/x-general.grid>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end Grid Auto component -->

    <!-- start Grid manual component -->
    <x-general.accordion active="selected" tab="12" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold bg-gray-50 rounded-md">
                <p class="text-sm">Manual Grid</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="border-t-2 px-6">
                <div class="bg-white shadow-lg p-4 my-4">
                    <x-general.grid-manual class="" gap="5" >
                        <x-general.grid-item mobile="12" sm="12" md="4" lg="4" xl="4" class="">
                            <div class="bg-yellow-500 p-4 h-24"></div>
                        </x-general.grid-item>
                        <x-general.grid-item mobile="12" sm="12" md="8" lg="8" xl="8" class="">
                            <div class="bg-indigo-500 p-4 h-24"></div>
                        </x-general.grid-item>
                    </x-general.grid-manual>
                </div>
                <p class="font-semibold">Code</p>
                <pre class="language-html -mt-4" wire:ignore>
                    <code class="language-html"> 
&lt;x-general.grid-manual class="" gap="5" >
    &lt;x-general.grid-item mobile="12" sm="12" md="4" lg="4" xl="4" class="">
        &lt;div class="bg-yellow-500 p-4 h-24">&lt;/div>
    &lt;/x-general.grid-item>
    &lt;x-general.grid-item mobile="12" sm="12" md="8" lg="8" xl="8" class="">
        &lt;div class="bg-indigo-500 p-4 h-24">&lt;/div>
    &lt;/x-general.grid-item>
&lt;/x-general.grid-manual>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end Grid manual component -->

</div>
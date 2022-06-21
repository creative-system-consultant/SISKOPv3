<div class="p-6 bg-white rounded-md shadow-md ">
    <h2 class="mb-4 text-lg font-semibold border-b-2 border-gray-300">Grid Component</h2>

    <!-- start Grid auto component -->
    <x-general.accordion active="selected" tab="11" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Auto Grid</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                        <div class="h-24 p-4 bg-yellow-500"></div>
                        <div class="h-24 p-4 bg-indigo-500"></div>
                        <div class="h-24 p-4 bg-blue-500"></div>
                        <div class="h-24 p-4 bg-pink-500"></div>
                    </div>
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html"> 
&lt;div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
    &lt;div class="h-24 p-4 bg-yellow-500">&lt;/div>
    &lt;div class="h-24 p-4 bg-indigo-500">&lt;/div>
    &lt;div class="h-24 p-4 bg-blue-500">&lt;/div>
    &lt;div class="h-24 p-4 bg-pink-500">&lt;/div>
&lt;/div>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end Grid Auto component -->

    <!-- start Grid manual component -->
    <x-general.accordion active="selected" tab="12" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Manual Grid</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                            <div class="h-24 p-4 bg-yellow-500"></div>
                        </div>
                        <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
                            <div class="h-24 p-4 bg-indigo-500"></div>
                        </div>
                    </div>
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html"> 
&lt;div class="grid grid-cols-12 gap-6">
    &lt;div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
        &lt;div class="h-24 p-4 bg-yellow-500">&lt;/div>
    &lt;/div>
    &lt;div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
        &lt;div class="h-24 p-4 bg-indigo-500">&lt;/div>
    &lt;/div>
&lt;/div>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end Grid manual component -->

</div>
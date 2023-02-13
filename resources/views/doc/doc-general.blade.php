<div class="p-6 bg-white rounded-md shadow-md ">
    <h2 class="mb-4 text-lg font-semibold border-b-2 border-gray-300">General Component</h2>

    <!-- start table component -->
    <x-general.accordion active="selected" tab="6" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Table</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.table-header class="text-left " value="Name" sort="" />
                            <x-table.table-header class="text-left" value="Email" sort="" />
                            <x-table.table-header class="text-left" value="Phone No" sort="" />
                        </x-slot>
                        <x-slot name="tbody">
                            <tr>
                                <x-table.table-body colspan="" class="text-left">
                                    Safwan
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                    Safwan@csc.net.my
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                    01112983148
                                </x-table.table-body>
                            </tr>
                        </x-slot>
                    </x-table.table>
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html">
&lt;x-table.table>
    &lt;x-slot name="thead">
        &lt;x-table.table-header class="text-left " value="Name" sort="" />
        &lt;x-table.table-header class="text-left" value="Email" sort="" />
        &lt;x-table.table-header class="text-left" value="Phone No" sort="" />
    &lt;/x-slot>
    &lt;x-slot name="tbody">
        &lt;tr>
            &lt;x-table.table-body colspan="" class="text-left">
                Safwan
            &lt;/x-table.table-body>
            &lt;x-table.table-body colspan="" class="text-left">
                Safwan@csc.net.my
            &lt;/x-table.table-body>
            &lt;x-table.table-body colspan="" class="text-left">
                01112983148
            &lt;/x-table.table-body>
        &lt;/tr>
    &lt;/x-slot>
&lt;/x-table.table>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end table component -->

    <!-- start accordion component -->
    <x-general.accordion active="selected" tab="7" bg="white">
            <x-slot name="title">
                <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                    <p class="text-sm">Accordion</p>
                </div>
            </x-slot>
            <x-slot name="content">
                <div class="px-6 border-t-2">
                    <div class="p-4 my-4 bg-white shadow-lg">
                        <div x-data="{open : 0}">
                            <x-general.accordion active="open" tab="1" bg="white">
                                <x-slot name="title">
                                    <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                                        <p class="text-sm">Title 1</p>
                                    </div>
                                </x-slot>
                                <x-slot name="content">
                                    //conten 1
                                </x-slot>
                            </x-general.accordion>
                            <x-general.accordion active="open" tab="2" bg="white">
                                <x-slot name="title">
                                    <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                                        <p class="text-sm">Title 2</p>
                                    </div>
                                </x-slot>
                                <x-slot name="content">
                                    //conten 2
                                </x-slot>
                            </x-general.accordion>
                        </div>
                    </div>
                    <p class="font-semibold">Code</p>
                    <pre class="-mt-4 language-html" wire:ignore>
                        <code class="language-html">
&lt;div x-data="{open : 0}">
    &lt;x-general.accordion active="open" tab="1" bg="white">
        &lt;x-slot name="title">
            &lt;div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                &lt;p class="text-sm">Title 1&lt;/p>
            &lt;/div>
        &lt;/x-slot>
        &lt;x-slot name="content">
            //conten 1
        &lt;/x-slot>
    &lt;/x-general.accordion>
    &lt;x-general.accordion active="open" tab="2" bg="white">
        &lt;x-slot name="title">
            &lt;div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                &lt;p class="text-sm">Title 2&lt;/p>
            &lt;/div>
        &lt;/x-slot>
        &lt;x-slot name="content">
            //conten 2
        &lt;/x-slot>
    &lt;/x-general.accordion>
&lt;/div>
                        </code>
                    </pre>
                </div>
            </x-slot>
        </x-general.accordion>
        <!-- end accordion component -->

    <!-- start Tab component -->
    <x-general.accordion active="selected" tab="8" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Tab</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <div x-data="{active : 0}">
                        <div class="flex bg-white rounded-md">
                            <x-tab.title name="0" livewire="">
                                <div class="flex items-center">
                                    <x-heroicon-o-credit-card class="w-6 h-6 mr-2"/>
                                    <p>Tab 1</p>
                                </div>
                            </x-tab.title>
                            <x-tab.title name="1" livewire="">
                                <div class="flex items-center">
                                    <x-heroicon-o-credit-card class="w-6 h-6 mr-2"/>
                                    <p>Tab 2</p>
                                </div>
                            </x-tab.title>
                            <x-tab.title name="2" livewire="">
                            <div class="flex items-center">
                                    <x-heroicon-o-credit-card class="w-6 h-6 mr-2"/>
                                    <p>Tab 3</p>
                                </div>
                            </x-tab.title>
                        </div>
                        <div class="pt-4 bg-white border-t-2">
                            <x-tab.content name="0">
                                //content 1
                            </x-tab.content>
                            <x-tab.content name="1">
                                //content 2
                            </x-tab.content>
                            <x-tab.content name="2">
                                //content 3
                            </x-tab.content>
                        </div>
                    </div>
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html">
&lt;div x-data="{active : 0}">
    &lt;div class="flex bg-white rounded-md">
        &lt;x-tab.title name="0" livewire="">
            &lt;div class="flex items-center">
                &lt;x-heroicon-o-credit-card class="w-6 h-6 mr-2"/>
                &lt;p>Tab 1&lt;/p>
            &lt;/div>
        &lt;/x-tab.title>
        &lt;x-tab.title name="1" livewire="">
            &lt;div class="flex items-center">
                &lt;x-heroicon-o-credit-card class="w-6 h-6 mr-2"/>
                &lt;p>Tab 2</p>
            &lt;/div>
        &lt;/x-tab.title>
        &lt;x-tab.title name="2" livewire="">
        &lt;div class="flex items-center">
            &lt;x-heroicon-o-credit-card class="w-6 h-6 mr-2"/>
                &lt;p>Tab 3&lt;/p>
            &lt;/div>
        &lt;/x-tab.title>
    &lt;/div>
    &lt;div class="pt-4 bg-white border-t-2">
        &lt;x-tab.content name="0">
            //content 1
        &lt;/x-tab.content>
        &lt;x-tab.content name="1">
            //content 2
        &lt;/x-tab.content>
        &lt;x-tab.content name="2">
            //content 3
        &lt;/x-tab.content>
    &lt;/div>
&lt;/div>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end Tab component -->

    <!-- start modal component -->
    <x-general.accordion active="selected" tab="9" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Modal</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <div x-data="{openModal:false , deleteModal:false}">
                        <div class="flex space-x-4">
                            <button
                                @click="openModal = true"
                                type="button"
                                class="flex items-center p-2 text-sm text-white rounded-md bg-primary-800 hover:bg-primary-900 focus:outline-none">
                                open modal
                            </button>
                            <button
                                @click="deleteModal = true"
                                type="button"
                                class="flex items-center p-2 text-sm text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none">
                                delete modal
                            </button>
                        </div>
                        <x-modal.modal
                            modalActive="openModal"
                            title="Title"
                            modalSize="xl"
                            closeBtn="yes"
                            closeFn=""
                        >
                            <div class="p-4">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                when an unknown printer took a galley of type and scrambled it to make a
                                type specimen book. It has survived not only five centuries, but also
                                the leap into electronic typesetting, remaining essentially unchanged.
                                It was popularised in the 1960s with the release of Letraset sheets
                                containing Lorem Ipsum passages, and more recently with desktop
                                publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </div>
                        </x-modal.modal>

                        <x-modal.delete-modal
                            modalActive="deleteModal"
                            {{-- deleteFunction="" --}}
                        />
                    </div>
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html">

// general modal
&lt;div x-data="{openModal:false}">
    &lt;button
        @click="openModal = true"
        type="button"
        class="flex items-center p-2 text-sm text-white rounded-md bg-primary-800 hover:bg-primary-900 focus:outline-none">
        open modal
    &lt;/button>
    &lt;x-modal.modal
        modalActive="openModal"
        title="Title"
        modalSize="xl"
        closeBtn="yes"
        &#x7b;&#x7b;-- closeFn="function-name-when-close-modal" --&#x7d;&#x7d;
    >
        &lt;div class="p-4">
            //content
        &lt;/div>
    &lt;/x-modal.modal>
&lt;/div>

// delete modal
&lt;div x-data="{deleteModal:false}">
    &lt;button
        @click="deleteModal = true"
        type="button"
        class="flex items-center p-2 text-sm text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none">
        delete modal
    &lt;/button>
    &lt;x-modal.delete-modal
        modalActive="deleteModal"
        &#x7b;&#x7b;-- deleteFunction="YourFunction-to-delete" --&#x7d;&#x7d;
    />
&lt;/div>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end modal component -->

    <!-- start toast component -->
    <x-general.accordion active="selected" tab="10" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Toast</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <! -- Start toast alert -->
                    <div x-data="{success:false , error:false , warning:false , info:false}">
                        <p class="mb-2 font-semibold">Toast</p>
                        <div class="grid grid-cols-1 gap-2 md:grid-cols-4">
                            <button x-on:click="success = !success" type="button" class="flex items-center justify-center p-2 text-sm text-white bg-green-500 rounded-md focus:outline-none">
                                success toast
                            </button>
                            <button x-on:click="error = !error" type="button" class="flex items-center justify-center p-2 text-sm text-white bg-red-500 rounded-md focus:outline-none">
                                error toast
                            </button>
                            <button x-on:click="warning = !warning" type="button" class="flex items-center justify-center p-2 text-sm text-white bg-yellow-400 rounded-md focus:outline-none">
                                warning toast
                            </button>
                            <button x-on:click="info = !info" type="button" class="flex items-center justify-center p-2 text-sm text-white bg-blue-500 rounded-md focus:outline-none">
                                info toast
                            </button>
                        </div>

                        <div x-show="success">
                            <x-toaster.success title="success" message="message success" />
                        </div>
                        <div x-show="error">
                            <x-toaster.error title="error" message="message error" />
                        </div>
                        <div x-show="warning">
                            <x-toaster.warning title="warning" message="message warning" />
                        </div>
                        <div x-show="info">
                            <x-toaster.info title="info" message="message info" />
                        </div>
                    </div>
                    <! -- Start swall alert -->
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html">
&lt;div x-data="{success:false , error:false , warning:false , info:false}">
    &lt;p class="mb-2 font-semibold">Toast&lt;/p>
    &lt;div class="grid grid-cols-1 gap-2 md:grid-cols-4">
        &lt;button x-on:click="success = !success" type="button" class="flex items-center justify-center p-2 text-sm text-white bg-green-500 rounded-md focus:outline-none">
            success toast
        &lt;/button>
        &lt;button x-on:click="error = !error" type="button" class="flex items-center justify-center p-2 text-sm text-white bg-red-500 rounded-md focus:outline-none">
            error toast
        &lt;/button>
        &lt;button x-on:click="warning = !warning" type="button" class="flex items-center justify-center p-2 text-sm text-white bg-yellow-400 rounded-md focus:outline-none">
            warning toast
        &lt;/button>
        &lt;button x-on:click="info = !info" type="button" class="flex items-center justify-center p-2 text-sm text-white bg-blue-500 rounded-md focus:outline-none">
            info toast
        &lt;/button>
    &lt;/div>

    &lt;div x-show="success">
        &lt;x-toaster.success title="success" message="message success" />
    &lt;/div>
    &lt;div x-show="error">
        &lt;x-toaster.error title="error" message="message error" />
    &lt;/div>
    &lt;div x-show="warning">
        &lt;x-toaster.warning title="warning" message="message warning" />
    &lt;/div>
    &lt;div x-show="info">
        &lt;x-toaster.info title="info" message="message info" />
    &lt;/div>
&lt;/div>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end toast component -->

    <!-- start loading  component -->
    <x-general.accordion active="selected" tab="123" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Loading </p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    Put u function in wire:target="" when u want show the loading
                    <div wire:loading wire:target="submit">
                        <x-main-loading />
                    </div>
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html">
&lt;div wire:loading wire:target="">
    &lt;x-main-loading />
&lt;/div>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end loading component -->

    <!-- start page  component -->
    <x-general.accordion active="selected" tab="573" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Start new Page </p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <div class="p-4">
                        <h1 class="text-base font-semibold md:text-2xl">Title</h1>
                        <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
                            //content
                        </x-general.card>
                    </div>
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html">
&lt;div class="p-4">
    &lt;h1 class="text-base font-semibold md:text-2xl">Title&lt;/h1>
    &lt;x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        //content
    &lt;/x-general.card>
&lt;/div>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end page component -->

     <!-- start page  component -->
     <x-general.accordion active="selected" tab="6662352523" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Header Title </p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <div class="p-4">
                        <x-general.header-title title="Your Title" route=""/>
                    </div>
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html">
&lt;x-general.header-title title="Your Title" route="your route"/>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end page component -->

     <!-- start page  component -->
     <x-general.accordion active="selected" tab="110" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Header Title (without Link) </p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <div class="p-4">
                        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Your Title</h2>
                    </div>
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html">
&lt;h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"&gt;Your Title&lt;/h2>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end page component -->

     <!-- start page  component -->
     <x-general.accordion active="selected" tab="234666" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Hover Question mark </p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <div>
                        <x-heroicon-s-question-mark-circle
                            class="w-8 h-8 text-primary-800 tooltipbtn"
                            data-title="Your-Title"
                            data-placement="top"
                        />
                    </div>
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html">
&lt;div>
    &lt;x-heroicon-s-question-mark-circle
        class="w-8 h-8 text-primary-800 tooltipbtn"
        data-title="Your-Title"
        data-placement="top"
    />
&lt;/div>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end page component -->

</div>
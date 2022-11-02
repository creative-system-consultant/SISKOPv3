<div class="p-6 bg-white rounded-md shadow-md ">
    <h2 class="mb-4 text-lg font-semibold border-b-2 border-gray-300">Form Component</h2>

    <!-- start submit form component -->
    <x-general.accordion active="selected" tab="1" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Submit Form</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <x-form.basic-form wire:submit.prevent="">
                        using this component if u want submit or update form with validation
                    </x-form.basic-form>
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html">
&lt;x-form.basic-form wire:submit.prevent="">
    //content
&lt;/x-form.basic-form>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end Submit form component -->


    <!-- start input component -->
    <x-general.accordion active="selected" tab="2" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Input</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <x-form.input
                        label="Input Label"
                        name=""
                        value=""
                        mandatory=""
                        disable=""
                        type="text"
                    />
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html">
&lt;x-form.input
    label="Input Label"
    name=""
    value=""
    mandatory=""
    disable=""
    type="text"
/>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end input component -->

    <!-- start input Tag component -->
    <x-general.accordion active="selected" tab="3" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Tag Input</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <x-form.input-tag
                        label="Tag Input Label"
                        type="text"
                        name=""
                        value=""
                        leftTag="RM"
                        rightTag="%"
                        mandatory=""
                        disable=""
                    />
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html">
&lt;x-form.input-tag
    label="Tag Input Label"
    type="text"
    name=""
    value=""
    leftTag="RM"
    rightTag="%"
    mandatory=""
    disable=""
/>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end input Tag component -->

    <!-- start  Dropdown Input  component -->
    <x-general.accordion active="selected" tab="4" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Dropdown Input</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <x-form.dropdown
                        label="Dropdown Label"
                        value=""
                        name=""
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                    >
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </x-form.dropdown>
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html">
&lt;x-form.dropdown
    label="Dropdown Label"
    value=""
    name=""
    id=""
    mandatory=""
    disable=""
    default="yes"
>
    &lt;option value="1">1&lt;/option>
    &lt;option value="2">2&lt;/option>
    &lt;option value="3">3&lt;/option>
&lt;/x-form.dropdown>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end Dropdown Input component -->

    <!-- start  Textarea Input  component -->
    <x-general.accordion active="selected" tab="5" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Textarea Input</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <x-form.text-area
                        label="Text Area Label"
                        value=""
                        name=""
                        rows=""
                        placeholder="Place Holder"
                        disable=""
                        mandatory=""
                    />
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html">
&lt;x-form.text-area
    label="Text Area Label"
    value=""
    name=""
    rows=""
    disable=""
    mandatory=""
    placeholder="Place Holder"
/>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end Textarea Input component -->

    <!-- start addrress Input component -->
    <x-general.accordion active="selected" tab="564" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Address Input</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <x-form.address class="mt-6"
                        label="Address"
                        mandatory=""
                        disable="true"
                        name1="your_wire_model_address1"
                        name2="your_wire_model_address2"
                        name3="your_wire_model_address3"
                        name4="your_wire_model_town"
                        name5="your_wire_model_postcode"
                        name6="your_wire_model_state"
                        {{-- :state="$states" --}}
                        condition="state"
                    />
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html">
&lt;x-form.address class="mt-6"
    label="Address"
    mandatory=""
    disable=""
    name1="your_wire_model_address1"
    name2="your_wire_model_address2"
    name3="your_wire_model_address3"
    name4="your_wire_model_town"
    name5="your_wire_model_postcode"
    name6="your_wire_model_state"
    &#x7b;&#x7b; -- :state="$states" -- &#x7d;&#x7d;
    condition="state"
/>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>

         <!-- start switch toggle Input component -->
         <x-general.accordion active="selected" tab="444" bg="white">
            <x-slot name="title">
                <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                    <p class="text-sm">Switch Toggle</p>
                </div>
            </x-slot>
            <x-slot name="content">
                <div class="px-6 border-t-2">
                    <div class="p-4 my-4 bg-white shadow-lg">
                        <div class="flex items-center w-full">
                            <label for="your-id" class="flex items-center cursor-pointer">
                                <div class="relative">
                                    <input
                                        type="checkbox"
                                        id="your-id"
                                        class="sr-only"
                                        {{-- wire:click="statusBtn(your-id)" --}}
                                    >
                                    <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                                    <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <p class="font-semibold">Code</p>
                    <pre class="-mt-4 language-html" wire:ignore>
                        <code class="language-html">
    &lt;div class="flex items-center w-full">
        &lt;label for="your-id" class="flex items-center cursor-pointer">
            &lt;div class="relative">
                &lt;input
                    type="checkbox"
                    id="your-id"
                    class="sr-only"
                    &#x7b;&#x7b;-- wire:click="funtionInLivewire(your-id)" --&#x7d;&#x7d;
                >
                &lt;div class="block h-8 bg-gray-300 rounded-full w-14 body">&lt;/div>
                &lt;div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1">&lt;/div>
            &lt;/div>
        &lt;/label>
    &lt;/div>
                        </code>
                    </pre>
                </div>
            </x-slot>
        </x-general.accordion>

    <!-- start submit button -->
    <x-general.accordion active="selected" tab="32524546768543623" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Submit Cancel Button</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                   This component must be inside<br>
                   &lt;x-form.basic-form wire:submit.prevent=""><br>
                   // content<br>
                   &lt;/x-form.basic-form>
                <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                    <div class="flex items-center justify-center space-x-2">
                        <a href="{{ url()->previous() }}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-none">
                            Cancel
                        </a>
                        <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                            Submit
                        </button>
                    </div>
                </div>
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html">
&lt;div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
    &lt;div class="flex items-center justify-center space-x-2">
        &lt;a href="&#x7b;&#x7b;url()->previous()&#x7d;&#x7d;" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-none">
            Cancel
        &lt;/a>
        &lt;button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
            Submit
        &lt;/button>
    &lt;/div>
&lt;/div>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end Submit button -->
</div>


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
                        id="" 
                        rows=""
                        placeholder="Place Holder" 
                    />
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html"> 
&lt;x-form.text-area 
    label="Text Area Label" 
    value="" 
    name="" 
    id="" 
    rows=""
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
                        value1="address1"
                        value2="address2"
                        value3="address3"
                        value4="town"
                        value5="postcode"
                        value6="state"
                        {{-- :state="$states" --}}
                        state="$states"
                        condition="state"
                    />
                </div>
                <p class="font-semibold">Code</p>
                <pre class="-mt-4 language-html" wire:ignore>
                    <code class="language-html"> 
&lt;x-form.address class="mt-6"
    label="Address"
    value1="address1"
    value2="address2"
    value3="address3"
    value4="town"
    value5="postcode"
    value6="state"
    &#x7b;&#x7b; -- :state="$states" -- &#x7d;&#x7d;
    condition="state"
/>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
</div>
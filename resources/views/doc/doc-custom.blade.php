
{{-- Start CamelToString --}}
<div class="p-6 bg-white rounded-md shadow-md ">
    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">To change from CamelCase to Normal String</h2>
    <div class="p-4 my-4 bg-white shadow-lg">
        {{ cameltoString('ThisIsATestString'); }}
    </div>
    <p class="font-semibold">Code</p>
    <pre class="-mt-4 language-html" wire:ignore>
        <code class="language-html">
@{{ cameltoString('ThisIsATestString'); }}
        </code>
    </pre>
</div>
{{-- End CamelToString --}}
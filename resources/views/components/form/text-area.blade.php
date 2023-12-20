<div>
    @if($label != "")
        <label class="block text-sm font-semibold leading-5 text-gray-700 {{ ($errors->has($name)) ? 'text-red-700' : '' }}">
            {{ $label }} (<span id="charCount">0</span>/255)
            @if( $mandatory ?? '' == "true")
            <span class="font-semibold text-red-600">*</span>
            @endif
        </label>
    @endif
    <textarea {{ $attributes }}
    @if( $disable == "true" )
        disabled
    @elseif( $disable == "readonly" )
        readonly
    @endif
    data-feature="all"
    class="appearance-none block w-full h-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 form-textarea
    focus:outline-none focus:shadow-outline-blue  transition duration-150 ease-in-out sm:text-sm sm:leading-5
    {{ ($disable == 'true' || $disable == 'readonly') ? 'bg-gray-100 cursor-not-allowed' : '' }}
    {{ ($errors->has($name)) ? 'border-red-300 bg-red-50 text-red-900' : '' }}">{{ $value }}</textarea>

    @if($errors->has($name)) <p class="text-sm text-red-600">{{ $errors->first($name) }}</p> @endif

    <!-- JavaScript code for character count -->
    <script>
        const textArea = document.querySelector('textarea[name="{{ $name }}"]');
        const charCount = document.getElementById('charCount');

        // Add an input event listener to the textarea
        textArea.addEventListener('input', function () {
            const text = textArea.value;
            const characterCount = text.length;
            charCount.textContent = characterCount;

            // Update the label with the character count and limit
            const label = document.querySelector('label[for="{{ $name }}"]');
            const limit = 255; // Set your character limit here
            label.textContent = `${{ $label }} (${characterCount}/${limit})`;
        });
    </script>
</div>

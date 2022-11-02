<form {{ $attributes->merge(['class' => '']) }} {{ $attributes }}>
    @csrf
    <div>
        {{ $slot }}
    </div>
</form>

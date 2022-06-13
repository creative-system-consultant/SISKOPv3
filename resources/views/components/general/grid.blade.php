<div x-max="1" {{ $attributes->merge(['class' => 'grid grid-cols-'.$mobile.' gap-'.$gap.' sm:grid-cols-'.$sm.' md:grid-cols-'.$md.' lg:grid-cols-'.$lg.' xl:grid-cols-'.$xl]) }}>
    {{ $slot }}
</div>
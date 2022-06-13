<div {{ $attributes->merge(['class' => 'col-span-'.$mobile.' sm:col-span-'.$sm.' md:col-span-'.$md.' lg:col-span-'.$lg.' xl:col-span-'.$xl])}}>
    {{ $slot }}
</div>
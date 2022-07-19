<td {{ ($colspan != '') ? 'colspan = '.$colspan : '' }} {{ $attributes->merge(['class' => 'px-6  py-2 whitespace-no-wrap text-sm leading-5 bg-white dark:bg-gray-700 dark:text-white']) }}>
    {{ $slot }}
</td>
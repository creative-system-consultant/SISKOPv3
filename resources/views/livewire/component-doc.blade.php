<div>
    <div class="p-4" x-cloak>
        <div x-data="{active : 0}">
            <div class="flex w-full mb-2 overflow-x-auto bg-white rounded-md flex-nowrap">
                <x-tab.title name="6" livewire="">
                    <div class="flex items-center w-36 md:w-full">
                        <x-heroicon-o-code-bracket class="w-6 h-6 mr-2"/>
                        <p>Create Livewire</p>
                    </div>
                </x-tab.title>
                <x-tab.title name="7" livewire="">
                    <div class="flex items-center w-36 md:w-full">
                        <x-heroicon-o-presentation-chart-bar class="w-6 h-6 mr-2"/>
                        <p>Chart</p>
                    </div>
                </x-tab.title>
                <x-tab.title name="0" livewire="">
                    <div class="flex items-center w-36 md:w-full">
                        <x-heroicon-o-rectangle-stack class="w-6 h-6 mr-2"/>
                        <p>Component List</p>
                    </div>
                </x-tab.title>
                <x-tab.title name="1" livewire="">
                    <div class="flex items-center w-24 md:w-full">
                        <x-heroicon-o-document-duplicate class="w-6 h-6 mr-2"/>
                        <p>Call Swall</p>
                    </div>
                </x-tab.title>
                <x-tab.title name="2" livewire="">
                    <div class="flex items-center w-36 md:w-full">
                        <x-heroicon-o-swatch class="w-6 h-6 mr-2"/>
                        <p>Customize color</p>
                    </div>
                </x-tab.title>
                <x-tab.title name="3" livewire="">
                    <div class="flex items-center w-36 md:w-full">
                        <x-heroicon-o-chat-bubble-bottom-center-text class="w-6 h-6 mr-2"/>
                        <p>Custom Helper</p>
                    </div>
                </x-tab.title>
            </div>
            <div class="pt-4 bg-white border-t-2">

                <x-tab.content name="6">
                    <div class="p-4" x-data="{selected : 0}" >
                        <h1 class="mb-6 text-base font-semibold md:text-2xl"></h1>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                            <div class="p-6 bg-white rounded-md shadow-md ">
                                <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">To Create livewire page, must run this command for folder strucure</h2>
                                <p class="font-semibold">Code</p>
                                <pre class="-mt-4 language-html" wire:ignore>
                                    <code class="language-html">
php artisan make:livewire Page/YourPageName
                                    </code>
                                </pre>
                            </div>
                            <div class="p-6 bg-white rounded-md shadow-md ">
                                <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">To rename livewire page (to refactor or typo), use this command</h2>
                                <p class="font-semibold">Code</p>
                                <pre class="-mt-4 language-html" wire:ignore>
                                    <code class="language-html">
php artisan livewire:move yourpageName Page/YourPageName
                                    </code>
                                </pre>
                            </div>
                        </div>
                    </div>
                </x-tab.content>

                <x-tab.content name="7">
                    <div class="p-4" x-data="{selected : 0}">
                        <h1 class="mb-2 text-base font-semibold md:text-2xl">Chart</h1>
                        <p class="mb-6 text-base font-normal md:text-base">for more type of chart you can visit this link <a href="https://apexcharts.com/javascript-chart-demos/" target="_blank" class="text-blue-500 hover:text-blue-400">https://apexcharts.com/javascript-chart-demos/</a></p>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                            @include('doc.doc-chart')
                        </div>
                    </div>
                </x-tab.content>

                <x-tab.content name="0">
                    <div class="p-4" x-data="{selected : 0}">
                        <h1 class="mb-6 text-base font-semibold md:text-2xl">Component List</h1>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                            @include('doc.doc-form')
                            @include('doc.doc-general')
                            @include('doc.doc-grid')
                            <div class="p-6 bg-white rounded-md shadow-md ">
                            <h2 class="mb-4 text-lg font-semibold border-b-2 border-gray-300">Icon Component</h2>
                            <!-- star Icon component -->
                                <x-general.accordion active="selected" tab="3545236325" bg="white">
                                    <x-slot name="title">
                                        <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                                            <p class="text-sm">HeroIcons</p>
                                        </div>
                                    </x-slot>
                                    <x-slot name="content">
                                        <div class="px-6 border-t-2">
                                            <div class="p-4 my-4 bg-white shadow-lg">
                                                For Icon u can using this link  <a href="https://heroicons.com/" target="_blank" class="text-blue-500 hover:text-blue-400">https://heroicons.com/</a>
                                                <div class="flex mt-4 space-x-3 ">
                                                    <x-heroicon-o-home class="w-7 h-7 text-primary-800" />
                                                    <x-heroicon-s-home class="w-7 h-7 text-primary-800" />
                                                </div>
                                            </div>
                                            <p class="font-semibold">Code</p>
                                            <pre class="-mt-4 language-html" wire:ignore>
                                                <code class="language-html">
//outline icon
&lt;x-heroicon-o-home class="w-7 h-7 text-primary-800" />
//solid icon
&lt;x-heroicon-s-home class="w-7 h-7 text-primary-800" />
                                                </code>
                                            </pre>
                                        </div>
                                    </x-slot>
                                </x-general.accordion>
                                <!-- end Submit Icon component -->
                        </div>
                    </div>
                    </div>
                </x-tab.content>
                <x-tab.content name="3">
                    <div class="p-4" x-data="{selected : 0}">
                        <h1 class="mb-2 text-base font-semibold md:text-2xl">Custom PHP Function / Helper</h1>
                        <p class="mb-6 text-base font-normal md:text-base">All the functions are in App/Helper/Custom.php</p>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                            @include('doc.doc-custom')
                        </div>
                    </div>
                </x-tab.content>
                <x-tab.content name="1">
                    <div class="p-4" x-data="{selected : 0}">
                        <h1 class="mb-6 text-base font-semibold md:text-2xl">Call Swall</h1>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                            @include('doc.doc-swall')
                        </div>
                    </div>
                </x-tab.content>
                <x-tab.content name="2">
                    <div class="p-4" x-data="{selected : 0}">
                        <h1 class="mb-6 text-base font-semibold md:text-2xl">COLOR PLATE</h1>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                            @include('doc.doc-colors')
                            <div class="p-6 bg-white rounded-md shadow-md ">

                                <div class="px-6 border-t-2">
                                    <div class="p-4 my-4 bg-white shadow-lg">
                                        <x-form.basic-form wire:submit.prevent="">
                                            choose color plate
                                        </x-form.basic-form>
                                    </div>
                                    <p class="font-semibold">tailwind.config.js</p>
                                    <div class="overflow-y-auto h-96">
                                    <pre class="-mt-4 language-html" wire:ignore>
                                        <code class="language-html">
    Slate: {
        50 : '#f8fafc',
        100: '#f1f5f9',
        200: '#e2e8f0',
        300: '#cbd5e1',
        400: '#94a3b8',
        500: '#64748b',
        600: '#475569',
        700: '#334155',
        800: '#1e293b',
        900: '#0f172a',
    },
    Gray: {
        50 : '#f9fafb',
        100: '#f3f4f6',
        200: '#e5e7eb',
        300: '#d1d5db',
        400: '#9ca3af',
        500: '#6b7280',
        600: '#4b5563',
        700: '#374151',
        800: '#1f2937',
        900: '#111827',
    },
    Zinc: {
        50 : '#fafafa',
        100: '#f4f4f5',
        200: '#e4e4e7',
        300: '#d4d4d8',
        400: '#a1a1aa',
        500: '#71717a',
        600: '#52525b',
        700: '#3f3f46',
        800: '#27272a',
        900: '#18181b',
    },
    Neutral: {
        50 : '#fafafa',
        100: '#f5f5f5',
        200: '#e5e5e5',
        300: '#d4d4d4',
        400: '#a3a3a3',
        500: '#737373',
        600: '#525252',
        700: '#404040',
        800: '#262626',
        900: '#171717',
    },
    Stone: {
        50 : '#fafaf9',
        100: '#f5f5f4',
        200: '#e7e5e4',
        300: '#d6d3d1',
        400: '#a8a29e',
        500: '#78716c',
        600: '#57534e',
        700: '#44403c',
        800: '#292524',
        900: '#1c1917',
    },
    Red: {
        50 : '#fef2f2',
        100: '#fee2e2',
        200: '#fecaca',
        300: '#fca5a5',
        400: '#f87171',
        500: '#ef4444',
        600: '#dc2626',
        700: '#dc2626',
        800: '#991b1b',
        900: '#7f1d1d',
    },
    Orange: {
        50 : '#fff7ed',
        100: '#ffedd5',
        200: '#fed7aa',
        300: '#fdba74',
        400: '#fb923c',
        500: '#f97316',
        600: '#ea580c',
        700: '#c2410c',
        800: '#9a3412',
        900: '#7c2d12',
    },
    Amber: {
        50 : '#fffbeb',
        100: '#fef3c7',
        200: '#fde68a',
        300: '#fcd34d',
        400: '#fbbf24',
        500: '#f59e0b',
        600: '#d97706',
        700: '#b45309',
        800: '#92400e',
        900: '#78350f',
    },
    Yellow: {
        50 : '#fefce8',
        100: '#fef9c3',
        200: '#fef08a',
        300: '#fde047',
        400: '#facc15',
        500: '#eab308',
        600: '#ca8a04',
        700: '#a16207',
        800: '#854d0e',
        900: '#713f12',
    },
    Lime: {
        50 : '#f7fee7',
        100: '#ecfccb',
        200: '#d9f99d',
        300: '#bef264',
        400: '#a3e635',
        500: '#84cc16',
        600: '#65a30d',
        700: '#4d7c0f',
        800: '#3f6212',
        900: '#365314',
    },
    Green: {
        50 : '#f0fdf4',
        100: '#dcfce7',
        200: '#bbf7d0',
        300: '#86efac',
        400: '#4ade80',
        500: '#22c55e',
        600: '#16a34a',
        700: '#15803d',
        800: '#166534',
        900: '#14532d',
    },
    Emerald: {
        50 : '#ecfdf5',
        100: '#d1fae5',
        200: '#a7f3d0',
        300: '#6ee7b7',
        400: '#34d399',
        500: '#10b981',
        600: '#059669',
        700: '#047857',
        800: '#065f46',
        900: '#064e3b',
    },
    Teal: {
        50 : '#f0fdfa',
        100: '#ccfbf1',
        200: '#99f6e4',
        300: '#5eead4',
        400: '#2dd4bf',
        500: '#14b8a6',
        600: '#0d9488',
        700: '#0f766e',
        800: '#115e59',
        900: '#134e4a',
    },
    Cyan: {
        50 : '#ecfeff',
        100: '#cffafe',
        200: '#a5f3fc',
        300: '#67e8f9',
        400: '#22d3ee',
        500: '#06b6d4',
        600: '#0891b2',
        700: '#0e7490',
        800: '#155e75',
        900: '#164e63',
    },
    Sky: {
        50 : '#f0f9ff',
        100: '#e0f2fe',
        200: '#bae6fd',
        300: '#7dd3fc',
        400: '#38bdf8',
        500: '#0ea5e9',
        600: '#0284c7',
        700: '#0369a1',
        800: '#075985',
        900: '#0c4a6e',
    },
    Blue: {
        50 : '#eff6ff',
        100: '#dbeafe',
        200: '#bfdbfe',
        300: '#93c5fd',
        400: '#60a5fa',
        500: '#3b82f6',
        600: '#2563eb',
        700: '#1d4ed8',
        800: '#1e40af',
        900: '#1e3a8a',
    },
    Indigo: {
        50 : '#eef2ff',
        100: '#e0e7ff',
        200: '#c7d2fe',
        300: '#a5b4fc',
        400: '#818cf8',
        500: '#6366f1',
        600: '#4f46e5',
        700: '#4338ca',
        800: '#3730a3',
        900: '#312e81',
    },
    Violet: {
        50 : '#f5f3ff',
        100: '#ede9fe',
        200: '#ddd6fe',
        300: '#c4b5fd',
        400: '#a78bfa',
        500: '#8b5cf6',
        600: '#7c3aed',
        700: '#6d28d9',
        800: '#5b21b6',
        900: '#4c1d95',
    },
    Purple: {
        50 : '#faf5ff',
        100: '#f3e8ff',
        200: '#e9d5ff',
        300: '#d8b4fe',
        400: '#c084fc',
        500: '#a855f7',
        600: '#9333ea',
        700: '#7e22ce',
        800: '#6b21a8',
        900: '#581c87',
    },
    Fuchsia: {
        50 : '#fdf4ff',
        100: '#fae8ff',
        200: '#f5d0fe',
        300: '#f0abfc',
        400: '#e879f9',
        500: '#d946ef',
        600: '#c026d3',
        700: '#a21caf',
        800: '#86198f',
        900: '#701a75',
    },
    Pink: {
        50 : '#fdf2f8',
        100: '#fce7f3',
        200: '#fbcfe8',
        300: '#f0abfc',
        400: '#f9a8d4',
        500: '#ec4899',
        600: '#db2777',
        700: '#be185d',
        800: '#9d174d',
        900: '#831843',
    },
    Rose: {
        50 : '#fff1f2',
        100: '#ffe4e6',
        200: '#fecdd3',
        300: '#fda4af',
        400: '#fb7185',
        500: '#f43f5e',
        600: '#e11d48',
        700: '#be123c',
        800: '#9f1239',
        900: '#881337',
    },

                                        </code>
                                    </pre>
                                </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </x-tab.content>
            </div>
        </div>
    </div>
</div>

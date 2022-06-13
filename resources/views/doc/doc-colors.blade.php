<div class="bg-white rounded-md p-6 shadow-md ">

    <div class="border-t-2 px-6">
        <div class="bg-white shadow-lg p-4 my-4">
            <x-form.basic-form wire:submit.prevent="">
                to change color just change in colors:{'primary': { //choose color plate  }} object
                then run -: npm run dev
            </x-form.basic-form>
        </div>
        <p class="font-semibold">tailwind.config.js</p>
        <div class="h-96 overflow-y-auto">
        <pre class="language-html -mt-4" wire:ignore>
            <code class="language-html"> 
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
            width: {
                '100': '26rem',
            },
            colors: {
                'primary': {
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
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ['active'],
        }
    },
    purge: {
        content: [
            './app/**/*.php',
            './resources/**/*.html',
            './resources/**/*.js',
            './resources/**/*.jsx',
            './resources/**/*.ts',
            './resources/**/*.tsx',
            './resources/**/*.php',
            './resources/**/*.vue',
            './resources/**/*.twig',
        ],
        options: {
            defaultExtractor: (content) => content.match(/[\w-/.:]+(?<!:)/g) || [],
            whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};
                
            </code>
        </pre>
        </div>
    </div>

</div>
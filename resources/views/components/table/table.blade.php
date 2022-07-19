<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto">
        <div class="inline-block min-w-full py-2 align-middle">
            <div class="overflow-hidden bg-white border-b border-gray-200 shadow sm:rounded-lg dark:bg-gray-700">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            {{ $thead }}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{ $tbody }}
                    </tbody>
                </table>
                <div class="border-t border-gray-200">
                    <div class="mx-2 my-2">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
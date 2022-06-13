<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto">
        <div class="py-2 align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
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
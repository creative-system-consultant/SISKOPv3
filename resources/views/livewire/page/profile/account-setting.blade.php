<div class="p-4">
    @if (session('success'))
        <x-swall.success message="{{ session('message') }}"/>
    @elseif (session('error'))
        <x-swall.error  message="{{ session('message') }}"/>
    @endif

    <x-form.basic-form wire:submit.prevent="changePassword">
        <div class="overflow-hidden bg-white shadow sm:rounded-lg dark:bg-gray-700">
            <div class="px-4 py-5 sm:px-6 bg-gray-50 dark:bg-gray-600">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Change Password</h3>
                <p class="max-w-2xl mt-1 text-sm text-gray-500 dark:text-gray-100"> Change password to a new password </p>
            </div>
            <div class="border-t border-gray-200 dark:border-gray-500">
            <dl>
                <div class="px-4 py-5 bg-white border-b-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 dark:bg-gray-700">
                <dt class="text-sm font-medium text-gray-800 dark:text-white">Old Password</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-3">
                        <x-form.input
                            label=""
                            name="old_pass"
                            wire:model.lazy="old_pass"
                            value=""
                            mandatory=""
                            disable=""
                            type="password"
                        />
                    </div>
                </dd>
                </div>

            </dl>
            <dl>
                <div class="px-4 py-5 bg-white border-b-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 dark:bg-gray-700">
                <dt class="text-sm font-medium text-gray-800 dark:text-white">New Password</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-3">
                        <x-form.input
                            label=""
                            name="password"
                            wire:model.lazy="password"
                            value=""
                            mandatory=""
                            disable=""
                            type="password"
                        />
                    </div>
                </dd>
                </div>
            </dl>
            <dl>
                <div class="px-4 py-5 bg-white border-b-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 dark:bg-gray-700">
                <dt class="text-sm font-medium text-gray-800 dark:text-white">Confirm Password</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-3">
                        <x-form.input
                            label=""
                            name="confirm_pass"
                            wire:model.lazy="confirm_password"
                            value=""
                            mandatory=""
                            disable=""
                            type="password"
                        />
                    </div>
                </dd>
                </div>
            </dl>
            </div>
        </div>


        <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
            <div class="flex items-center justify-center space-x-2">
                <a href="{{ url()->previous() }}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-none">
                    Cancel
                </a>
                <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                    Submit
                </button>
            </div>
        </div>
    </x-form.basic-form>
</div>
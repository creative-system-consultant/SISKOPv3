<div class="p-4">
    <x-form.basic-form wire:submit.prevent="">
        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 bg-gray-50">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Change Password</h3>
                <p class="max-w-2xl mt-1 text-sm text-gray-500"> Change password to a new password </p>
            </div>
            <div class="border-t border-gray-200">
            <dl>
                <div class="px-4 py-5 bg-white border-b-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-800">Old Password</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-3">
                        <x-form.input 
                            label="" 
                            name="" 
                            value="" 
                            mandatory=""
                            disable=""
                            type="text"
                        />
                    </div>
                </dd>
                </div>
                
            </dl>
            <dl>
                <div class="px-4 py-5 bg-white border-b-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-800">New Password</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-3">
                        <x-form.input 
                            label="" 
                            name="" 
                            value="" 
                            mandatory=""
                            disable=""
                            type="text"
                        />
                    </div>
                </dd>
                </div>
            </dl>
            <dl>
                <div class="px-4 py-5 bg-white border-b-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-800">Confirm Password</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-3">
                        <x-form.input 
                            label="" 
                            name="" 
                            value="" 
                            mandatory=""
                            disable=""
                            type="text"
                        />
                    </div>
                </dd>
                </div>
            </dl>
            </div>
        </div>


        <div class="p-4 mt-6 rounded-md bg-gray-50">
            <div class="flex items-center justify-center space-x-2">
                <a href="{{url()->previous()}}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-non">
                    Cancel
                </a>
                <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                    Submit
                </button>
            </div>
        </div>
    </x-form.basic-form>    
</div>
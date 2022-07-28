<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">ADMIN > USER > ROLE GROUP > {{ $page }}</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-general.header-title title="Create New Role Group" route="{{ route('user.rolegroup') }}"/>
        <x-form.basic-form wire:submit.prevent="submit" class="p-4">
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-8">
                    <x-form.input 
                        label="GROUP NAME" 
                        type="text" 
                        name="group.name" 
                        value="" 
                        mandatory="" 
                        disable="" 
                        wire:model="group.name"
                    />
                </div>
                <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-4">
                    <x-form.dropdown 
                        label="ACTIVE STATUS"
                        value=""
                        name="group.status" 
                        mandatory=""
                        disable=""
                        default="" 
                        wire:model="group.status"
                    >
                        <option value="0">INACTIVE</option>
                        <option value="1">ACTIVE</option>
                    </x-form.dropdown>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-8">
                    <x-form.text-area 
                        label="DESCRIPTION" 
                        value="group.description" 
                        name="group.description" 
                        rows=""
                        disable=""
                        mandatory=""
                        placeholder="Description" 
                        wire:model="group.description"
                    />
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-4">
                    <x-form.dropdown 
                        label="ROLE"
                        value="group.role_id"
                        name="group.role_id" 
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model="group.role_id"
                    >
                    @forelse ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @empty
                    @endforelse
                        
                    </x-form.dropdown>
                </div>
            </div>

            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <input type="hidden" name="group.coop_id" value="{{ auth()->user()->coop_id }}" wire:model="group.coop_id" >
                <div class="flex items-center justify-center space-x-2">
                    <a href="{{ route('user.rolegroup') }}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-non">
                        CANCEL
                    </a>
                    <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                        {{ $page }}
                    </button>
                </div>
            </div>
        </x-form.basic-form>
    </x-general.card>
</div>

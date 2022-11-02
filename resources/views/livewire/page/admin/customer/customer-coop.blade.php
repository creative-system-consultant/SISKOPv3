<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Customer Custom Field</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-form.basic-form wire:submit.prevent="submit" class="p-4">
            <h2 class="mb-4 text-lg font-semibold border-b-2 border-gray-300">Fields</h2>
                <button wire:click.prevent="addField" type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                    Add Field
                </button>
                <div id="fields">
                @foreach($Fname as $index => $list )
                    <div class="grid grid-cols-12 gap-6 mt-6">
                        <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-2 xl:col-span-2">
                            <x-form.input label="Field Label" name="Flabel.{{ $index }}" value="" mandatory="" disable="" type="text" wire:model="Flabel.{{ $index }}"/>
                        </div>
                        <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-2 xl:col-span-2">
                            <x-form.input label="Field Name" name="Fname.{{ $index }}" value="" mandatory="" disable="" type="text" wire:model="Fname.{{ $index }}"/>
                        </div>
                        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-2 xl:col-span-2">
                            <x-form.dropdown label="Field Type" value="" name="Ftype.{{ $index }}" mandatory="" disable="" default="yes" wire:model="Ftype.{{ $index }}">
                                @foreach ($field->types() as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </x-form.dropdown>
                        </div>
                        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-2 xl:col-span-2">
                            <div class="justify-end pt-4 mt-1 rounded-md">
                                <button wire:click.prevent="remField({{ $index }})" type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 rounded-md focus:outline-none">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <a href="{{ route('home') }}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-non">
                        Cancel
                    </a>
                    <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                        Save
                    </button>
                </div>
            </div>
        </x-form.basic-form>
    </x-general.card>
</div>

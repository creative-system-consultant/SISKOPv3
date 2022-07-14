<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Special Aid > Create</h1>
        <div class="p-4 mt-4 bg-white rounded-md shadow-md">
            <x-general.header-title title="Create New Special Aid" route="{{route('special_aid.list')}}"/>
            <div class="pt-4 bg-white ">
                <div class="pb-4 pl-4 pr-4">
                    <x-form.basic-form wire:submit.prevent="submit">
                        <h2 class="mb-4 text-lg font-semibold border-b-2 border-gray-300">Information</h2>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                            <div>
                                <x-form.input 
                                    label="Name" 
                                    name="specialAid_name" 
                                    value="" 
                                    mandatory=""
                                    disable=""
                                    type="text"                                    
                                    wire:model.defer='specialAid_name'    
                                />
                            </div>
                        </div>
    
                        <div class="grid grid-cols-1 gap-6 mt-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4">
                            <div>
                                <label for="enable_applyAmt" class="block mr-3 text-sm font-semibold leading-5 text-gray-700">
                                    Enabled Apply Amount 
                                </label>
                                <div class="flex items-center w-full mt-3">
                                    <label for="enabled_apply_amt" class="flex items-center cursor-pointer">                                
                                        <div class="relative">
                                            <input 
                                                type="checkbox" 
                                                id="enabled_apply_amt" 
                                                class="sr-only"
                                                name="enabled_apply_amt"
                                                wire:model.defer='enabled_apply_amt'                                            
                                            >
                                            <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                                            <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                                        </div>
                                    </label>
                                </div>
                            </div>
    
                            <div>
                                <x-form.input-tag 
                                    label="Default Apply Amount" 
                                    type="text"
                                    name="default_apply_amount" 
                                    value=""
                                    leftTag="RM"
                                    rightTag=""
                                    mandatory=""
                                    disable=""
                                    wire:model.defer='default_apply_amount'
                                />
                            </div>

                            <div>
                                <x-form.input-tag 
                                    label="Default Minimum Amount" 
                                    type="text"
                                    name="default_min_amount" 
                                    value=""
                                    leftTag="RM"
                                    rightTag=""
                                    mandatory=""
                                    disable=""
                                    wire:model.defer='default_min_amount'
                                />
                            </div>

                            <div>
                                <x-form.input-tag 
                                    label="Default Maximum Amount" 
                                    type="text"
                                    name="default_max_amount" 
                                    value=""
                                    leftTag="RM"
                                    rightTag=""
                                    mandatory=""
                                    disable=""
                                    wire:model.defer='default_max_amount'
                                />
                            </div>
                        </div>
                    
                        <div class="grid grid-cols-1 gap-6 mt-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                            <div>
                                <x-form.input 
                                    label="Start Date" 
                                    name="start_date" 
                                    value="" 
                                    mandatory=""
                                    disable=""
                                    type="date"
                                    wire:model.defer='start_date'
                                />
                            </div>
                            
                            <div>
                                <x-form.input 
                                    label="End Date" 
                                    name="end_date" 
                                    value="" 
                                    mandatory=""
                                    disable=""
                                    type="date"
                                    wire:model.defer='end_date'
                                /> 
                            </div>                            
                        </div>
                        <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Fields</h2>
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
                                    <x-form.dropdown label="Field Type" value="" name="Ftype.{{ $index }}" id="" mandatory="" disable="" default="" wire:model="Ftype.{{ $index}}">
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
            </div>
        </div>
    </h1>
</div>
@push('js')
<script>
    var fieldCnt = 0;
</script>
<script>
    function removeField(obj) {
        obj.parentNode.parentNode.parentNode.remove();
    }
</script>
<script>
    function addField(){
        var mydiv      = document.getElementById("fields");
        var newcontent = document.createElement('div');
        var field      = document.getElementById("defaultfields");

        newcontent.innerHTML = field.innerHTML;

        mydiv.appendChild(newcontent.firstElementChild);
    }
</script>
@endpush

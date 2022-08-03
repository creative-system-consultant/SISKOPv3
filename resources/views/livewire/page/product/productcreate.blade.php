<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Create Product</h1>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-form.basic-form wire:submit.prevent="submit" class="p-4">
            <div class="bg-white rounded-md">
                <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Product Info </h2>
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input 
                    label="Product Name"
                    type="text" 
                    name="name" 
                    value="" 
                    mandatory=""
                    disable=""
                    wire:model="name"
                />

            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.dropdown 
                    label="Financing Type"
                    value=""
                    name="type" 
                    id=""
                    mandatory=""
                    disable=""
                    default="yes"  
                    wire:model="type"
                >
                @foreach ($producttype_id as $list)
                    <option value="{{ $list->id }}"> {{ $list->description }} </option>
                @endforeach
                </x-form.dropdown>

                <x-form.input-tag 
                    label="Profit Rate" 
                    type="text"
                    name="rate" 
                    value=""
                    leftTag=""
                    rightTag="%"
                    mandatory=""
                    disable=""
                    wire:model="rate"
                />
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input-tag 
                    label="Minimum Financing" 
                    type="text"
                    name="minfin" 
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable=""
                    wire:model="minfin"
                />

                <x-form.input-tag 
                    label="Maximum Financing" 
                    type="text"
                    name="maxfin" 
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable=""
                    wire:model="maxfin"
                />

            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.dropdown 
                    label="Minimum Financing Term"
                    value=""
                    name="minterm" 
                    id=""
                    leftTag=""
                    rightTag="Year"
                    mandatory=""
                    disable=""
                    default="yes"  
                    wire:model="minterm"
                >
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </x-form.dropdown>

                <x-form.dropdown 
                    label="Maximum Financing Term"
                    value=""
                    name="maxterm" 
                    id=""
                    leftTag=""
                    rightTag="Year"
                    mandatory=""
                    disable=""
                    default="yes"  
                    wire:model="maxterm"
                >
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </x-form.dropdown>

            </div>
            <div class="mb-4 mt-4 bg-white rounded-md">
                <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Form Information </h2>
                <div class="mb-4">
                    <input type="radio" id="" name="" value="" class="" />
                    <label for=""> Copy of latest Salary Statement </label>
                </div>
                <div class="mb-4">
                    <input type="radio" id="" name="" value="" class="" />
                    <label for=""> Copy of Latest Salary Statement (Guarantor) </label>
                </div>
                <div class="mb-4">
                    <input type="radio" id="" name="" value="" class="" />
                    <label for=""> Copy of Identity Card (Front and Back) </label>
                </div>
                <div class="mb-4">
                    <input type="radio" id="" name="" value="" class="" />
                    <label for=""> Copy of Child's Identity Card </label>
                </div>
                <div class="mb-4">
                    <input type="radio" id="" name="" value="" class="" />
                    <label for=""> Copy of Identity Card (Guarantor) (Front and Back) </label>
                </div>
                <div class="mb-4">
                    <input type="radio" id="" name="" value="" class="" />
                    <label for=""> Job Confirmation Letter from the Employer </label>
                </div>
                <div class="mb-4">
                    <input type="radio" id="" name="" value="" class="" />
                    <label for=""> Copy of Previous 1 Month Salary Statement </label>
                </div>
                <div class="mb-4">
                    <input type="radio" id="" name="" value="" class="" />
                    <label for=""> Copy of Previous 2 Months Salary Statement </label>
                </div>
                <div class="mb-4">
                    <input type="radio" id="" name="" value="" class="" />
                    <label for=""> Marriage Certificate </label>
                </div>
                <div class="mb-4">
                    <input type="radio" id="" name="" value="" class="" />
                    <label for=""> University Admission Offer Letter</label>
                </div>
            </div>
            </div>
            <div class="mt-4 bg-white rounded-md">
                <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Brochure </h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                    <x-form.input 
                        label="Brochure File (uploaded only: jpg/png/jpeg/pdf)" 
                        name="brochure" 
                        id="brochure"
                        value="" 
                        mandatory=""
                        disable=""
                        type="file"
                        accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                        wire:model="brochure"
                    />  
                    <div class="mt-4 mb-8">
                        <div class="flex items-center space-x-4">
                            <img 
                            class="w-auto h-32 p-2 rounded-xl ring-2 ring-gray-200 "
                            @if($brochure)
                            src="{{ $brochure->temporaryUrl() }}"
                            @endif
                            alt="Brochure"
                            > 
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 bg-white rounded-md">
                <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Payment Table </h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                    <x-form.input 
                        label="Payment Table File (uploaded only: jpg/png/jpeg/pdf)" 
                        name="payment_table" 
                        id="payment_table"
                        value="" 
                        mandatory=""
                        disable=""
                        type="file"
                        accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                        wire:model="payment_table"
                    />  
                    <div class="mt-4 mb-8">
                        <div class="flex items-center space-x-4">
                            <img 
                            class="w-auto h-32 p-2 rounded-xl ring-2 ring-gray-200 "
                            @if($payment_table)
                            src="{{ $payment_table->temporaryUrl() }}"
                            @endif
                            alt="Payment Table"
                            > 
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-center space-x-2">
                <a href="{{route('product.list')}}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-non">
                    Cancel
                </a>
                <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                    Create
                </button>
            </div>
        </x-form.basic-form>
    </div>
</div>
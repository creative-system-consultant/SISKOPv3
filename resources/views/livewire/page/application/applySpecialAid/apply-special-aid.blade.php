<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Apply Special Aid</h1>
    <x-general.card class="px-6 py-6 mt-4 bg-white rounded-md shadow-md">
        <h2 class="text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
        <div>
            <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4">
                <div>
                    <x-form.input
                        label="Name"
                        name="customer_name"
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                        wire:model.defer="customer_name"
                    />
                    @if (session('nameError'))
                        <p class="mt-2 text-sm text-red-600">{{ session('nameError') }}</p>
                    @endif
                </div>
                <div>
                    <x-form.input
                        label="Identity Number"
                        name="identity_no"
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                        wire:model.defer="identity_no"
                    />
                </div>
            </div>
            <h2 class="my-4 text-lg font-semibold border-b-2 border-gray-300">Special Aid Information</h2>
            <div x-data="{isShowing: '' }">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                    <div>
                        <x-form.dropdown
                            label="Special Aid"
                            value=""
                            name="type_specialAid"
                            id="type_specialAid"
                            mandatory=""
                            disable=""
                            default="yes"
                            x-model="isShowing"
                            wire:model="type_specialAid"
                            >
                            @foreach ($specialAids as $type)
                                <option value="{{ $type->id }}"> {{ ucwords($type->name) }} </option>
                            @endforeach
                        </x-form.dropdown>
                    </div>
                </div>

                @foreach ($specialAids as $index => $listField)
                    <div x-cloak x-show="isShowing == '{{ $listField->id }}'">
                        <x-form.basic-form wire:submit.prevent="submit('{{ $listField->uuid }}','{{ $index }}')">
                            
                            <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                                @php if ($listField->apply_amt_enable == 0) {$isDisabled = 'true';} else{$isDisabled = 'false';} @endphp
                                <div>
                                    <x-form.input-tag
                                        label="Amount Apply"
                                        type="text"
                                        name="apply_amt.{{ $index }}"
                                        value=""
                                        leftTag="RM"
                                        rightTag=""
                                        mandatory=""
                                        disable="{{ $isDisabled }}"
                                        wire:model.lazy='apply_amt.{{ $index }}'
                                    />
                                    @if (session('errors'))
                                        <p class="mt-2 text-sm text-red-600">{{ session('errors') }}</p>
                                    @endif
                                </div>
                                <div>
                                    <x-form.input-tag
                                        label="Event Date"
                                        type="date"
                                        name="event_date.{{ $index }}"
                                        value=""
                                        leftTag=""
                                        rightTag=""
                                        mandatory=""
                                        disable="{{ $isDisabled }}"
                                        wire:model.lazy='event_date.{{ $index }}'
                                    />

                                    @if (session('errorDate'))
                                        <p class="mt-2 text-sm text-red-600">{{ session('errorDate') }}</p>
                                    @endif
                                </div>

                                <div>
                                    <x-form.input
                                        label="Upload Supporting Document:(uploaded only: jpg/png/jpeg/pdf)"
                                        name="online_file"
                                        id="online_file"
                                        value=""
                                        mandatory=""
                                        disable=""
                                        type="file"
                                        accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                                        wire:model="online_file"
                                    />

                                    @if (session('errorFile'))
                                        <p class="mt-2 text-sm text-red-600">{{ session('errorFile') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                                <div class="flex items-center justify-center space-x-2">
                                    <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </x-form.basic-form>
                    </div>
                @endforeach
            </div>
        </div>
    </x-general.card>
</div>

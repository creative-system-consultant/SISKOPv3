<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Employment Information</h2>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
    <div>
        <x-form.input
            label="Company Name"
            name="Employer.name"
            value="{{ $Employer->name }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
        />
    </div>
    <div>
        <x-form.input
            label="Name Of Department"
            name="Employer.department"
            value="{{ $Employer->department }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
        /> 
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mt-4 gap-2">
    {{-- <div>
        <x-form.dropdown
            label="Sector"
            value="{{ $Employer-> }}"
            name=""
            id=""
            mandatory=""
            disable="{{ $input_disable }}"
            default="yes"
            wire:model=""
        >
            <option value="1">GOV</option>
            <option value="2">private</option>
            <option value="3">semi-gov</option>
        </x-form.dropdown>
    </div> 
    <div>
        <x-form.dropdown
            label="Work Status"
            value="{{ $Employer-> }}"
            name=""
            id=""
            mandatory=""
            disable="{{ $input_disable }}"
            default="yes"
            wire:model=""
        >
            <option value="{{ $Employer-> }}">Unemployed</option>
            <option value="{{ $Employer-> }}">Permanent</option>
            <option value="{{ $Employer-> }}">Full-Time Contract</option>
            <option value="{{ $Employer-> }}">Part-Time</option>
            <option value="{{ $Employer-> }}">Internship</option>
            <option value="{{ $Employer-> }}">Casual</option>
            <option value="{{ $Employer-> }}">Self-Employed</option>
            <option value="{{ $Employer-> }}">Pensioner/Retired</option>
            <option value="{{ $Employer-> }}">Temporary</option>
            <option value="{{ $Employer-> }}">Probation</option>
        </x-form.dropdown>
    </div>
    <div>
        <x-form.input
            label="Staff No"
            name=""
            value="{{ $Employer-> }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
            wire:model=""
        /> 
    </div>--}}
    <div>
        <x-form.input
            label="Start Work Date"
            name="Employer.work_start"
            value="{{ $Employer->work_start }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="date"
        /> 
    </div>
    <div>
        <x-form.input
            label="Position"
            name="Employer.position"
            value="{{ $Employer->position}}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
        /> 
    </div>
    <div>
        <x-form.input
            label="Office Telephone Number"
            name="Employer.office_num"
            value="{{ $Employer->office_num }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
        /> 
    </div>
    <div>
        <x-form.input-tag
            label="Salary"
            name="Employer.salary"
            value="{{ $Employer->salary }}"
            mandatory=""
            leftTag="RM"
            rightTag=""
            disable="{{ $input_disable }}"
            type="text"
        /> 
    </div>
    {{-- <div>
        <x-form.input
            label="Salary No"
            name="Employer.salary_ref"
            value="{{ $Employer-> }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
            wire:model=""
        /> 
    </div> --}}
    {{-- <div>
        <x-form.input-tag
            label="Monthly Allowance"
            name=""
            value="{{ $Employer-> }}"
            mandatory=""
            leftTag="RM"
            rightTag=""
            disable="{{ $input_disable }}"
            type="text"
            wire:model=""
        /> 
    </div> --}}
    <div>
        <x-form.input
            label="Work Phone"
            name="Employer.worker_num"
            value="{{ $Employer->worker_num }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
        /> 
    </div>
    {{--<div>
        <x-form.input
            label="Work Email"
            name=""
            value="{{ $Employer-> }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
            wire:model=""
        /> 
    </div>
     <div>
        <x-form.input
            label="Extension"
            name=""
            value="{{ $Employer-> }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
            wire:model=""
        /> 
    </div>
    <div>
        <x-form.input
            label="Start Pension Date"
            name=""
            value="{{ $Employer-> }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="date"
            wire:model=""
        /> 
    </div>
    <div>
        <x-form.input
            label="Start Pension Age "
            name=""
            value="{{ $Employer-> }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
            wire:model=""
        /> 
    </div> --}}
</div>
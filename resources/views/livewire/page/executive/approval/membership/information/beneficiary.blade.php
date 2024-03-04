<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Beneficiary Information</h2>
<div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <div>
        <x-form.input
            label="Name"
            name="CustFamily.name"
            value="{{ $CustFamily->name }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
        /> 
    </div>
    <div>
        <x-form.input
            label="Email"
            name=""
            value="{{ $CustFamily->email }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
        /> 
    </div>
    <div>
        <x-form.input
            label="IC Number"
            name="CustFamily.identity_no"
            value="{{ $CustFamily->identity_no }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
        />
    </div>
    <div>
        <x-form.input
            label="Relationship"
            name="CustFamily.relationship"
            value="{{ $CustFamily->relation?->description }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
        />
    </div>
    <div>
        <x-form.input
            label="Mobile Number"
            name="CustFamily.phone_no"
            value="{{ $CustFamily->phone_no }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
        />
    </div>
    <div>
        <x-form.input
            label="Race"
            name="CustFamily.description"
            value="{{ $CustFamily->race?->description }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
        />
    </div>
    <div>
        <x-form.input
            label="Religion"
            name="CustFamily.description"
            value="{{ $CustFamily->religion?->description }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
        />
    </div>
    <div>
        <x-form.input
            label="Employer Name"
            name="CustFamily.employer_name"
            value="{{ $CustFamily->employer_name }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
        />
    </div>
    <div>
        <x-form.input
            label="Work Post"
            name="CustFamily.work_post"
            value="{{ $CustFamily->work_post }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
        />
    </div>
    <div>
        <x-form.input
            label="Salary"
            name="CustFamily.salary"
            value="{{ $CustFamily->salary }}"
            mandatory=""
            disable="{{ $input_disable }}"
            type="text"
        />
    </div>
</div>
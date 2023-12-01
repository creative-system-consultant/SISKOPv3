<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    
    <x-form.input
        label="Title"
        name="title"
        value="{{ $Application->customer->title?->description ?? '' }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
    <x-form.input
        label="Name"
        name="custname"
        value="{{ $Application->customer->name ?? '' }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
    <x-form.input
        label="IC Number"
        name="custic"
        value="{{ $Application->customer->identity_no ?? '' }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
    <x-form.input
        label="Birthdate"
        name="birthdate"
        value="{{ $Application->customer->birthdate ?? '' }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
    <x-form.input
        label="Mobile Number"
        name="custic"
        value="{{ $Application->customer->phone ?? '' }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
    <x-form.input
        label="E-Mail"
        name="email"
        value="{{ $Application->customer->email ?? '' }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
    <x-form.input
        label="Race"
        name="race"
        value="{{ $Application->customer->race?->description ?? '' }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
    <x-form.input
        label="Gender"
        name="gender"
        value="{{ $Application->customer->gender?->description ?? '' }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
    <x-form.input
        label="Education"
        name="education"
        value="{{ $Application->customer->education?->description ?? '' }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
    <x-form.input
        label="Marital"
        name="marital"
        value="{{ $Application->customer->marital?->description ?? '' }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
</div>
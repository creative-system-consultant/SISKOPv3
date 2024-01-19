<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Introducer Information</h2>
<div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <x-form.input
        label="Name"
        name="CustIntroducer.name"
        value="{{ $CustIntroducer->name }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
    <x-form.input
        label="IC Number"
        name="CustIntroducer.icno"
        value="{{ $CustIntroducer->identity_no }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
    <x-form.input
        label="Phone Number"
        name="CustIntroducer.icno"
        value="{{ $CustIntroducer->phone }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
    <x-form.input
        label="Email"
        name="CustIntroducer.email"
        value="{{ $CustIntroducer->email }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
    {{--<x-form.input
        label="INTRODUCER MEMBERSHIP NUMBER"
        name="CustIntroducer.mbr_no"
        value="{{ $CustIntroducer->mbr_no }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />--}}
</div>
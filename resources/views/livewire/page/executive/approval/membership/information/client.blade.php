<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Membership Information</h2>
<div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <x-form.input
        label="COOP Name"
        name=""
        value="{{ $Application->client->name ?? '' }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
    <x-form.input
        label="Application Number"
        name=""
        value="{{ $Application->id }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
    <x-form.input
        label="Application Submitted"
        name=""
        value="{{ $Application->apply_date }}"
        mandatory=""
        disable="{{ $input_disable }}"
        type="text"
    />
</div>
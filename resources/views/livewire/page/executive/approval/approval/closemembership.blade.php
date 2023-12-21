<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Close Membership Information</h2>
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
        <x-form.input-tag
            label="Reason"
            type="text"
            name="Application.terminate_reason"
            value="{{ $Application->terminate_reason }}"
            leftTag=""
            rightTag=""
            mandatory=""
            disable="true"
        />
    </div>
</div>

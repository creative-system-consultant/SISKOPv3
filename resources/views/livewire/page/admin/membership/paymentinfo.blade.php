<div class="@if ($numpage != 3) hidden @endif">
    <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Payment Details</h2>
    <div @if ($member->field_status(4) == '0') style="display: none" @endif >
    <div class="p-4 text-green-900 bg-green-200">
        <p><x-form.input-tag
            label="Registration Fee"
            name="applymember.register_fee"
            value=""
            mandatory=""
            disable=""
            leftTag="RM"
            rightTag=""
            type="text"
            wire:model="applymember.register_fee"
        />  </p>
    </div>
    </div>

    <div @if ($member->field_status(5) == '0') style="display: none" @endif >
    <div class="p-4 text-green-900 bg-green-200">
        <p><x-form.input-tag
            label="Share Fee"
            name="applymember.share_fee"
            value=""
            mandatory=""
            disable=""
            leftTag="RM"
            rightTag=""
            type="text"
            wire:model="applymember.share_fee"
        />  </p>
    </div>
    </div>

    <div @if ($member->field_status(6) == '0') style="display: none" @endif >
        <div class="p-4 text-green-900 bg-green-200">
            <p><x-form.input-tag
                label="Contribution Fee"
                name="applymember.contribution_fee"
                value=""
                mandatory=""
                disable=""
                leftTag="RM"
                rightTag=""
                type="text"
                wire:model="applymember.contribution_fee"
            />  </p>
        </div>
        </div>


    <div class="flex items-center justify-center space-x-2">
        <button type="button" wire:click="back" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
            previous
        </button>
        <button type="button" wire:click="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
            Next
        </button>
    </div>
</div>
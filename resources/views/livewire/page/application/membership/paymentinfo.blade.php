<div x-show="active == 5">
    <div  class="px-6 py-4 mt-4">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Registration Fee and Deduction </h2>
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5">
            <div>
                <x-form.input-tag
                    label="Registration Fee"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    leftTag="RM"
                    rightTag=""
                    type="text"
                    wire:model="applymember.register_fee"
                />
            </div>

            <div>
                <x-form.dropdown
                    label="Share Payment Type"
                    value=""
                    name="pay_type_share"
                    id=""
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model="pay_type_share"
                >
                    <option value="1">Lump sum</option>
                    <option value="2">Installment</option>
                </x-form.dropdown>
            </div>

            @if($pay_type_share =='2')
            <div>
                <x-form.input-tag
                    label="Share (Min. Monthly RM{{$min_monthly_share}})"
                    name=""
                    value="{{$min_monthly_share}}"
                    mandatory=""
                    disable="true"
                    leftTag="RM"
                    rightTag=""
                    type="text"
                    wire:model="tot_share"
                />
            </div>
            @else
            <div>
                <x-form.input-tag
                    label="Share"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    leftTag="RM"
                    rightTag=""
                    type="text"
                    wire:model="tot_share"
                />
            </div>
            @endif

            <div>
                <x-form.input-tag
                    label="Contribution Monthly (Minimum RM{{$this->min_contribution_fee}})"
                    name="applymember.contribution_fee"
                    value=""
                    mandatory=""
                    disable=""
                    leftTag="RM"
                    rightTag=""
                    type="text"
                    wire:model="applymember.contribution_fee"
                />
            </div>
        </div>

        <h2 class="mb-4 mt-6 text-base font-semibold border-b-2 border-gray-300"> Registration Payment </h2>


        <div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5">

            <div>
                <x-form.input-tag
                    label="Total Deduction Upon Registration"
                    name=""
                    value="{{$Ftotal_deduction}}"
                    mandatory=""
                    disable="true"
                    leftTag="RM"
                    rightTag=""
                    type="text"
                    wire:model="Ftotal_deduction"
                />
            </div>
            

            <div>
                <x-form.dropdown
                    label="Registration Payment Type"
                    value=""
                    name="pay_type_regist"
                    id=""
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model="pay_type_regist"
                >
                    <option value="1">Cash/Online Payment</option>
                    <option value="2">Autopay</option>
                </x-form.dropdown>
            </div>

            @if($pay_type_regist=="1")
            
            <div>
                <x-form.input-tag
                    label="COOP Bank Name"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    leftTag=""
                    rightTag=""
                    type="text"
                    wire:model="client_bank_name"
                />
            </div>
            <div>
                <x-form.input-tag
                    label="COOP Bank Account Number"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    leftTag=""
                    rightTag=""
                    type="text"
                    wire:model="client_bank_acct"
                />
            </div>
          
            @endif
        </div>

        <div class="mt-4 text-red-500">
         Notes:
         <br>
        You're required to have a minimum share of RM500 to be a member.
        <br>
        If online payment is selected, please transfer to the provided coop bank account and upload your proof of payment on the next section.
        </div>
    </div>



    <div  class="px-6 py-4 mt-4">
        <div class="p-4 mt-6 rounded-md  bg-gray-50 dark:bg-gray-800">
            <div class="flex items-center justify-center space-x-2">
                <button type="button" wire:click="previous" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                    Previous
                </button>
                <button type="button" wire:click="next({{$numpage}},0)" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                    Next
                </button>
            </div>
        </div>
    </div>
</div>

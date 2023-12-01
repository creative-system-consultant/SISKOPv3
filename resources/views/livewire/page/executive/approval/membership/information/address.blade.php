<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Address Information</h2>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
    <div>
        <x-form.address class="mt-2"
            label="Home Address"
            mandatory=""
            disable="{{ $input_disable }}"
            name1="CustAddress.address1"
            name2="CustAddress.address2"
            name3="CustAddress.address3"
            name4="CustAddress.town"
            name5="CustAddress.postcode"
            name6="CustAddress.state_id"
            :state="$statelist"
            condition="state"
            mailFlag="true"
        />
    </div>
    <div>
        <x-form.address class="mt-2"
            label="Work Address"
            mandatory=""
            disable="{{ $input_disable }}"
            name1="EmployAddress.address1"
            name2="EmployAddress.address2"
            name3="EmployAddress.address3"
            name4="EmployAddress.town"
            name5="EmployAddress.postcode"
            name6="EmployAddress.state_id"
            :state="$statelist"
            condition="state"
            mailFlag="true"
        />
    </div>
</div>
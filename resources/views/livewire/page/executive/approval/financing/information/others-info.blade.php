
<!-- address -->
<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Address Information</h2>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
    <div>
        <x-form.address class="mt-2"
            label="Home Address"
            mandatory=""
            disable=""
            name1="CustAddress.address1"
            name2="CustAddress.address2"
            name3="CustAddress.address3"
            name4="CustAddress.town"
            name5="CustAddress.postcode"
            name6="CustAddress.state_id"
            name7="CustAddress.mail_flag"
            {{-- :state="$statelist" --}}
            condition="state"
            mailFlag="true"
        />
    </div>
    <div>
        <x-form.address class="mt-2"
            label="Work Address"
            mandatory=""
            disable=""
            name1="EmployAddress.address1"
            name2="EmployAddress.address2"
            name3="EmployAddress.address3"
            name4="EmployAddress.town"
            name5="EmployAddress.postcode"
            name6="EmployAddress.state_id"
            name7="EmployAddress.mail_flag"
            {{-- :state="$statelist" --}}
            condition="state"
            mailFlag="true"
        />
    </div>
</div>

<!-- beneficiry -->
<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Beneficiary Information</h2>
<div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <div>
        <x-form.input
            label="Full Name"
            name="CustFamily.name"
            value=""
            mandatory=""
            disable=""
            type="text"
        /> 
    </div>
    <div>
        <x-form.input
            label="Email"
            name=""
            value=""
            mandatory=""
            disable=""
            type="text"
        /> 
    </div>
    <div>
        <x-form.input
            label="IC Number"
            name="CustFamily.identity_no"
            value=""
            mandatory=""
            disable=""
            type="text"
        />
    </div>
    <div>
        <x-form.input
            label="Relationship"
            name="CustFamily.relationship"
            value=""
            mandatory=""
            disable=""
            type="text"
        />
    </div>
    <div>
        <x-form.input
            label="Mobile Number"
            name="CustFamily.phone_no"
            value=""
            mandatory=""
            disable=""
            type="text"
        />
    </div>
</div>

<!-- employment -->
<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Employment Information</h2>
<div class="grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
    <div>
        <x-form.input
            label="Company Name"
            name="Employer.name"
            value=""
            mandatory=""
            disable=""
            type="text"
        />
    </div>
    <div>
        <x-form.input
            label="Name Of Department"
            name="Employer.department"
            value=""
            mandatory=""
            disable=""
            type="text"
        /> 
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mt-4 gap-2">
    <div>
        <x-form.input
            label="Start Work Date"
            name="Employer.work_start"
            value=""
            mandatory=""
            disable=""
            type="date"
        /> 
    </div>
    <div>
        <x-form.input
            label="Position"
            name="Employer.position"
            value=""
            mandatory=""
            disable=""
            type="text"
        /> 
    </div>
    <div>
        <x-form.input
            label="Office Telephone Number"
            name="Employer.office_num"
            value=""
            mandatory=""
            disable=""
            type="text"
        /> 
    </div>
    <div>
        <x-form.input-tag
            label="Salary"
            name="Employer.salary"
            value=""
            mandatory=""
            leftTag="RM"
            rightTag=""
            disable=""
            type="text"
        /> 
    </div>
    <div>
        <x-form.input
            label="Work Phone"
            name="Employer.worker_num"
            value=""
            mandatory=""
            disable=""
            type="text"
        /> 
    </div>
</div>
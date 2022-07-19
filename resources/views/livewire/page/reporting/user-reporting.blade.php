<div class="p-4">
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div class="pb-4">
            <x-general.header-title title="List Of User" route="{{route('list-reporting')}}"/>
        </div>
        <livewire:page.reporting.report-controller.users-reporting-controller/>
    </x-general.card>
</div>
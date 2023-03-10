<div x-data="{ openModal : false }">
    <x-table.table>
        <x-slot name="thead">
            <x-table.table-header class="text-left " value="No" sort="" />
            <x-table.table-header class="text-left " value="Applicant Name" sort="" />
            <x-table.table-header class="text-left" value="IC No." sort="" />
            <x-table.table-header class="text-left" value="Special Aid Type" sort="" />
            <x-table.table-header class="text-left" value="Apply Date" sort="" />
            <x-table.table-header class="text-left" value="Application Status" sort="" />
            <x-table.table-header class="text-left" value="Action" sort="" />
        </x-slot>
        <x-slot name="tbody">
            @forelse ($specialAids as $aid)
                <tr>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $loop->iteration }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        {{ $aid->name }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $aid->customer->icno }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        @foreach ($specialAid_type as $type)
                            {{ $type->name }}
                        @endforeach
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $aid->created_at->format("Y-m-d") }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        @if ($aid->flag == '0') Still being applied
                        @elseif ($aid->flag == '1') Being Processed
                        @elseif ($aid->flag == '3') Failed / Decline
                        @elseif ($aid->flag == '6') Approved
                        @endif
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        <div class="row">
                            <button
                                wire:click="showApplication('{{ $aid->uuid }}')"
                                @click="openModal = true"
                                class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-green-500 rounded-full hover:bg-green-400" title="Show Application">
                                <x-heroicon-o-eye class="w-5 h-5"/>
                            </button>
                            <a href="{{ route('specialAid.maker', $aid->uuid) }}" class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-blue-500 rounded-full hover:bg-blue-400" title="Approval Process">
                                <x-heroicon-s-arrow-circle-right class="w-5 h-5"/>
                            </a>
                        </div>
                    </x-table.table-body>
                </tr>
            @empty
            <x-table.table-body colspan="4" class="text-left">
                No Data
            </x-table.table-body>
            @endforelse
        </x-slot>
    </x-table.table>
    <x-modal.modal modalActive="openModal" title="Special Aid Application" modalSize="7xl" closeBtn="yes">
        @include('livewire.page.application.application-list.apply-special-aid')
    </x-modal.modal>
</div>
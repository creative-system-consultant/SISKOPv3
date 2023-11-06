<div x-data="{active : 1}">
    <div class="flex bg-white rounded-md">
        @foreach ($group as $role)
            <x-tab.title name="{{ $loop->iteration }}" livewire="">
                <div class="flex items-center">
                    <x-heroicon-o-credit-card class="w-6 h-6 mr-2"/>
                    <p>{{ $role->grouping->name }}</p>
                </div>
            </x-tab.title>
        @endforeach
    </div>
    <div class="pt-4 bg-white border-t-2">
        @for ($i = 1; $i <= $group->count() ; $i++)
        <x-tab.content name="{{ $i }}">
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="No" sort="" />
                    <x-table.table-header class="text-left" value="Application" sort="" />
                    <x-table.table-header class="text-left" value="Total" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($approval_type as $item)
                        <tr>
                            <x-table.table-body colspan="" class="text-right">
                                {{ $loop->iteration }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                {{ $item->description }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-center">
                                @if($item->description == 'FINANCING')
                                {{ array_key_exists($group[$i-1]->grouping_id, $financing) ? $financing[$group[$i-1]->grouping_id]->count() : 0 }}
                                @else
                                0
                                @endif
                            </x-table.table-body>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table.table>
        </x-tab.content>
        @endfor
    </div>
</div>

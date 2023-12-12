<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Apply Change Guarantor</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md ">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Sila Isi maklumat</h2>
        <div>
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left " value="No Akaun Pembiayaan" sort="" />
                    <x-table.table-header class="text-left" value="Jumlah Pembiayaan" sort="" />
                    <x-table.table-header class="text-right" value="BAKI PEMBIAYAAN" sort="" />
                    <x-table.table-header class="text-center" value="Tindakan" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    <tr>
                        <x-table.table-body colspan="" class="text-left">
                            test
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            test
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-right">
                            test
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="">
                            <div class="flex items-center justify-center space-x-2">
                                <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 rounded-md focus:outline-none">
                                    <x-heroicon-o-cursor-arrow-rays class="w-4 h-4" />
                                    Pilih
                                </button>
                            </div>
                        </x-table.table-body>
                    </tr>
                </x-slot>
            </x-table.table>
        </div>

        <div class="mt-10">
            <x-table.table>
                <x-slot name="thead">
                    <tr  class="">
                        <th  colspan="3" class="px-6 py-3 border bg-primary-50 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center" >
                            Senarai Penjamin
                        </th>
                        <th  colspan="3" class="px-6 py-3 border bg-primary-100 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center" >
                            Penjamin Baru
                        </th>
                    </tr>
                    <tr>
                        <th  colspan="1" class="px-6 py-3 border bg-gray-50 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center" >
                            No Anggota
                        </th>
                        <th  colspan="1" class="px-6 py-3 border bg-gray-50 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center" >
                            No K/P
                        </th>
                        <th  colspan="1" class="px-6 py-3 border bg-gray-50 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center" >
                            Penjamin Semasa
                        </th>
                        <th  colspan="1" class="px-6 py-3 border bg-gray-100 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center" >
                            No Anggota
                        </th>
                        <th  colspan="1" class="px-6 py-3 border bg-gray-100 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center" >
                            No K/P penjamin Baru
                        </th>
                        <th  colspan="1" class="px-6 py-3 border bg-gray-100 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center" >
                            Nama Penjamin
                        </th>
                    </tr>
                    
                </x-slot>
                <x-slot name="tbody">
                    <tr>
                        <x-table.table-body colspan="" class="border text-center text-xs">
                            02025
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="border text-center text-xs">
                            971215105423
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="border text-center text-xs">
                            Suriyawati binti ahmad abu
                        </x-table.table-body>
                        
                        <x-table.table-body colspan="" class="border text-center">
                            <x-form.input
                                label=""
                                name=""
                                value=""
                                mandatory=""
                                disable="readonly"
                                type="text"
                            />
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="border">
                            <x-form.input
                                label=""
                                name=""
                                value=""
                                mandatory=""
                                disable=""
                                type="text"
                            />
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="border">
                            <x-form.input
                                label=""
                                name=""
                                value=""
                                mandatory=""
                                disable="readonly"
                                type="text"
                            />
                        </x-table.table-body>
                    </tr>
                </x-slot>
            </x-table.table>
        </div>

        <div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-10">
                <div>
                    <x-form.dropdown
                        label="Sebab Menukar Penjamin"
                        value=""
                        name=""
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                    >
                        <option value="">Sila Pilih</option>
                        <option value="Berhenti Ahli"> Berhenti Ahli </option>
                        <option value="Berhenti Kerja"> Berhenti Kerja </option>
                        <option value="Lain-lain"> Lain-lain (isi tempat kosong) </option>
                    </x-form.dropdown>
                </div>
            </div>


            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">
                <x-form.text-area
                    label="Sebab Lain"
                    value=""
                    name=""
                    rows=""
                    disable=""
                    mandatory=""
                    placeholder="Place Holder"
                />
            </div>

            <div class="p-4 mt-10 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                        Simpan
                    </button>
                </div>
            </div>

        </div>
    </x-general.card>
</div>

<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Apply Close Membership</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md ">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Sila Isi maklumat</h2>
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 sm:col-span-12 lg:col-span-5">
                    <x-form.input
                        label="Nama Penuh"
                        name=""
                        value=""
                        mandatory=""
                        disable="readonly"
                        type="text"
                    />
                </div>
                <div class="col-span-12 sm:col-span-12 lg:col-span-2">
                    <x-form.input
                        label="No K/P"
                        name=""
                        value=""
                        mandatory=""
                        disable="readonly"
                        type="text"
                    />
                </div>
                <div class="col-span-12 sm:col-span-12 lg:col-span-3">
                    <x-form.input
                        label="Email"
                        name=""
                        value=""
                        mandatory=""
                        disable="readonly"
                        type="text"
                    />
                </div>
                <div class="col-span-12 sm:col-span-12 lg:col-span-2">
                    <x-form.input-tag
                        label="Baki Pembiayaan"
                        type="text"
                        name=""
                        value=""
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="readonly"
                    />
                </div>
            </div>

            <h2 class="my-4 text-base font-semibold border-b-2 border-gray-300">Senarai Jaminan</h2>
            <div>
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left " value="No Akaun Pembiayaan" sort="" />
                        <x-table.table-header class="text-right" value="BAKI PEMBIAYAAN" sort="" />
                        <x-table.table-header class="text-left" value="NO K/P" sort="" />
                        <x-table.table-header class="text-left" value="NAMA JAMINAN" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        <tr>
                            <x-table.table-body colspan="" class="text-left">
                                test
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-right">
                                test
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                test
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                test
                            </x-table.table-body>
                        </tr>
                    </x-slot>
                </x-table.table>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-10">
                <x-form.input
                    label="Sebab Berhenti"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    type="text"
                />

                <x-form.input
                    label="Muat Naik Dokumen untuk Pengesahan (Jika ada) :"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    type="file"
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

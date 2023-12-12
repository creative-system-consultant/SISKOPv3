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
                    </tr>
                </x-slot>
            </x-table.table>
        </div>

        <div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-6">
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

            <div class="grid grid-cols-1 lg:grid-cols-1 gap-4 mt-12">

                <div class="flex items-start p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
                    <x-heroicon-o-information-circle class="flex-shrink-0 inline w-6 h-6 mr-2" />
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-bold">Cara Menghantar Permohonan Penukaran Penjamin:</span>
                        <ol class="list-decimal pl-4 pt-3 space-y-2">
                            <li class="">
                                <div class="flex">
                                    Tekan button Simpan dan<x-heroicon-s-arrow-down-tray class="w-4 h-4 mx-2" />muat turun borang.
                                </div>
                            </li>
                            <li class="">
                                <div class="flex">
                                    Setelah selesai memuat turun borang, dapatkan pengesahan SAKSI yang sah sahaja.
                                </div>
                            </li>
                            <li class="">
                                <div class="flex">
                                    Setelah mendapatkan pengesahan <span class="pl-1 font-bold"> SAKSI </span>, tekan button<x-heroicon-s-arrow-up-tray class="w-4 h-4 mx-2" />muat naik.
                                </div>
                            </li>
                            <li class="">
                                <div class="flex">
                                    Kemudian tekan button hantar.
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div>
                        <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 hover:bg-green-600 rounded-md focus:outline-none w-40">
                            <x-heroicon-o-bookmark class="w-4 h-4 mr-2" />
                            Simpan
                        </button>
                    </div>
                    <div>
                        <x-heroicon-o-arrow-right class="w-7 h-7" />
                    </div>
                    <div>
                        <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 rounded-md focus:outline-none w-40">
                            <x-heroicon-o-arrow-down-tray class="w-4 h-4 mr-2" />
                            Muat Turun 
                        </button>
                    </div>
                    <div>
                        <x-heroicon-o-arrow-right class="w-7 h-7" />
                    </div>
                    <div class="flex space-x-2 items-center mt-1">
                        <x-form.input
                            label=""
                            name=""
                            value=""
                            mandatory=""
                            disable=""
                            type="file"
                        />
                        <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-orange-500 hover:bg-orange-600 rounded-md focus:outline-none -mt-1 w-32">
                            <x-heroicon-o-arrow-up-tray class="w-4 h-4 mr-2" />
                            Muat Naik
                        </button>
                    </div>
                    <div>
                        <x-heroicon-o-arrow-right class="w-7 h-7" />
                    </div>
                    <div>
                        <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 hover:bg-green-600 rounded-md focus:outline-none w-40">
                            <x-heroicon-o-paper-airplane class="w-4 h-4 mr-2" />
                            Hantar
                        </button>
                    </div>
                </div>
            </div>

            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                        Lanjut
                    </button>
                </div>
            </div>

        </div>
    </x-general.card>
</div>

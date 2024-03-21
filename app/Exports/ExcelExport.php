<?php

namespace App\Exports;

use App\Models\Jenis;
use App\Models\Menu;
use App\Models\Pelanggan;
use Illuminate\Support\Collection;
use App\Models\produk_titipan; // Pastikan menggunakan namespace yang benar
use App\Models\Stok;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelExport implements FromCollection
{
    public function collection()
    {
        return produk_titipan::all();
        // return Jenis::all();
        // return Menu::all();
        // return Pelanggan::all();
        // return Stok::all();
    }
}

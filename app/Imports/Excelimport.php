<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\produk_titipan;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class Excelimport implements ToModel
{

    public function model(array $row)
    {
        return new produk_titipan([
            'id' => $row[0],
            'nama_produk' => $row[1],
            'nama_supplier' => $row[2],
            'harga_beli' => $row[3],
            'harga_jual' => $row[4],
            'stok' => $row[5],
            'keterangan' => $row[6],
        ]);
    }
}

<?php

namespace App\Imports;

use App\Models\Pelanggan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PelangganImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $rows)
    {
        return new Pelanggan([
            'nama' => $rows['nama'],
            'email' => $rows['email'],
            'no_telp' => $rows['no_telp'],
            'alamat' => $rows['alamat'],
        ]);
    }
}

<?php

namespace App\Imports;

use App\Models\Menu;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MenuImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $rows)
    {
        return new Menu([
            'jenis_id' => $rows['jenis_id'],
            'name' => $rows['nama_menu'],
            'harga' => $rows['harga'],
            'stok' => $rows['stok'],
            'image' => $rows['image'],
            'deskripsi' => $rows['deskripsi']
        ]);
    }
}

<?php

namespace App\Imports;

use App\Models\Stok;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StokImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return \App\Models\Stok|null
     */
    public function model(array $rows)
    {
        // Assuming 'Nama Menu' corresponds to 'menu_id' and 'Stok' corresponds to 'jumlah'
        return new Stok([
            'menu_id' => $rows['menu_id'], // Get 'Nama Menu' from the row data
            'jumlah' => $rows['stok'],       // Get 'Stok' from the row data
        ]);
    }
}

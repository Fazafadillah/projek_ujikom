<?php

namespace App\Imports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AbsenImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Absensi|null
     */
    public function model(array $row)
    {
        // Pastikan nama kolom sesuai dengan nama kolom dalam file Excel
        return new Absensi([
            'id' => $row[0],
            'namaKaryawan' => $row[1], 
            'tanggalMasuk' => $row[2],
            'waktuMasuk' => $row[3],
            'status' => $row[4],
            'waktuKeluar' => $row[5],


        ]);
    }
}

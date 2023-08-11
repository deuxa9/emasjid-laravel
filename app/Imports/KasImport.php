<?php

namespace App\Imports;

use App\Models\Kas;
use Maatwebsite\Excel\Concerns\ToModel;

class KasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Kas([
            'masjid_id' => $row[1],
            'tanggal' => $row[2],
            'kategori' => $row[3],
            'keterangan' => $row[4],
            'jenis' => $row[5],
            'jumlah' => $row[6],
            'created_by' => $row[7],
        ]);
    }
}

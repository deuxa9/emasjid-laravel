<?php

namespace App\Imports;

use App\Models\MasjidBank;
use Maatwebsite\Excel\Concerns\ToModel;

class BankImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MasjidBank([
            'masjid_id' => $row[1],
            'nama_bank' => $row[2],
            'kode_bank' => $row[3],
            'nomor_rekening' => $row[4],
            'nama_rekening' => $row[5],
            'created_by' => $row[6],
        ]);
    }
}

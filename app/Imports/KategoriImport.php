<?php

namespace App\Imports;

use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\ToModel;

class KategoriImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Kategori([
            'masjid_id' => $row[1],
            'parent_id' => $row[2],
            'slug' => $row[3],
            'nama' => $row[4],
            'keterangan' => $row[5],
            'created_by' => $row[6],
        ]);
    }
}

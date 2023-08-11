<?php

namespace App\Imports;

use App\Models\Profil;
use Maatwebsite\Excel\Concerns\ToModel;

class ProfilImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Profil([
            'masjid_id' => $row[1],
            'slug' => $row[2],
            'judul' => $row[3],
            'kategori' => $row[4],
            'konten' => $row[5],
            'created_by' => $row[6],
        ]);
    }
}

<?php

namespace App\Exports;

use App\Models\Profil;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProfilExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Profil::where('masjid_id', auth()->user()->masjid_id)->get();
    }
}

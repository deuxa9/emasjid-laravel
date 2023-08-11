<?php

namespace App\Exports;

use App\Models\MasjidBank;
use Maatwebsite\Excel\Concerns\FromCollection;

class BankExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MasjidBank::all();
    }
}

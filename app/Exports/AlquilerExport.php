<?php

namespace App\Exports;


use App\Models\Alquiler;
use Maatwebsite\Excel\Concerns\FromCollection;

class AlquilerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Alquiler::all();
    }
}

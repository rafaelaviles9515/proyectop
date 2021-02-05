<?php

namespace App\Exports;

use App\Models\MovimientoPelicula;

use Maatwebsite\Excel\Concerns\FromCollection;

class MovimientoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MovimientoPelicula::all();
    }
}

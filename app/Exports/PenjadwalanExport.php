<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Penjadwalan;

class PenjadwalanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }

    public function view(): View
    {
        return view('admin.penjadwalan.hasil', [
            'penjadwalan' => Penjadwalan::all()
        ]);
    }
}

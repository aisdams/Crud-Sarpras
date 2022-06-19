<?php

namespace App\Exports;

use App\Models\Product_Keluar;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ExportProdukKeluar implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function view(): View
    {
        // TODO: Implement view() method.
        return view('product_keluar.productKeluarAllExcel',[
            'product_keluar' => Product_Keluar::all()
        ]);
    }
}

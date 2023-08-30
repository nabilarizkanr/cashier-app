<?php

namespace App\Exports;
use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;


class SaleReportExport implements FromView
{
    private $dateFrom;
    private $dateTo;
    private $sales;
    private $totalSale;
    public function __construct($dateFrom, $dateTo){
        $dateFrom = date("Y-m-d H:i:s", strtotime($dateFrom));
        $dateTo = date("Y-m-d H:i:s", strtotime($dateTo));
        $sales = Sale::whereBetween('updated_at', [$dateFrom, $dateTo])->where('sale_status','paid')->get();
        $totalSale = $sales->sum('total_price');
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->sales = $sales;
        $this->totalSale = $totalSale;
    }

    public function view(): View
    {
        return view('exports.salereport',[
            'sales' => $this->sales,
            'totalSale' => $this->totalSale,
            'dateFrom' => $this->dateFrom,
            'dateTo' => $this->dateTo
        ]);
    }
}

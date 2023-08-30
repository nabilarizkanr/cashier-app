<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;

use App\Exports\SaleReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    //
    public function index(){
        return view('report.index');
    }

    public function show(Request $request){
        $request->validate([
            'dateFrom' => 'required',
            'dateTo'=> 'required'
        ]);
        $dateFrom = date("Y-m-d H:i:s", strtotime($request->dateFrom.' 00:00:00'));
        $dateTo = date("Y-m-d H:i:s", strtotime($request->dateTo.' 00:00:00'));
        $sales = Sale::whereBetween('updated_at', [$dateFrom, $dateTo])->where('sale_status','paid');
        return view('report.showReport')->with('dateFrom', date("m/d/Y H:i:s",
        strtotime($request->dateFrom. ' 00:00:00')))->with('dateTo', date('m/d/Y H:i:s', strtotime($request->dateTo. ' 23:59:59')))->with('totalSale', $sales->sum('total_price'))->with('sales', $sales->paginate(5));
    }

    public function export(Request $request){
        return Excel::download(new SaleReportExport($request->dateFrom, $request->dateTo), 'saleReport.xlsx');
    }
}

<!DOCTYPE html>
<html lang="en">
    <style>
    #wrapper{
        width: 280px;
        margin: 0 auto;
        color: #000;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px; 
    }
    #restaurant-name, #receipt-footer{
        text-align: center;
    }
    .tb-sale-detail, .tb-sale-total {
        width: 100%;
        border-spacing: 0;
        margin-top: 10px;
    }
    .tb-sale-detail{
        text-align: center;
    }
    .tb-sale-detail th{
        border-bottom: 1px solid #000;
    }
    .tb-sale-total td{
        padding: 5px 0;
        padding-left: 1.5%;
        border-bottom: 1px solid #000;
    }
    .tb-sale-total tr:first-child td:nth-child (3){
        border-left: 1px solid #999;
    }
    .tb-sale-total tr:first-child td:nth-child (4){
        text-align: right;
        padding-left: 1.5%;
    }
    .tb-sale-total tr:not(:first-child){
        background-color: #ccc;
    }
    .tb-sale-total tr:not(:first-child) td:nth-child(2){
        text-align: right;
        padding-right: 1.5%;
    }
    .btn{
        width: 100%;
        cursor: pointer;
        text-align: center;
        border-radius: 5px;
        padding: 10px;
        margin: 5px 0;
        border: none;
    }
    .btn-print{
        background-color: #FFA93C;
    }
    .btn-back{
        background-color: #4FA950;
    }
    @media print {
    .print-hide {
        display: none !important;
    }
}
    </style>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cashier App - Receipt - SaleID : {{$sale->id}}</title>
    </head>
    <body>
        <div id="wrapper">
            <div id="receipt-header">
                <h4 id="restaurant-name">Kantin Pasca Sarjana</h4>
                <p>Universitas Sumatera Utara</p>
                <p>Medan, Padang Bulan, Medan Baru, Medan City, North Sumatra 20222</p>
                <p>Reference Receipt: <strong>{{$sale->id}}</strong></p>
            </div>
            <div id="receipt-body">
                <table class="tb-sale-detail">
                    <thead>
                        <tr>
                            <!-- <th>#</th> -->
                            <th>Menu</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($saleDetails as $saleDetail)
                        <tr>
                            <!-- <td width="30">{{$saleDetail->menu_id}}</td> -->
                            <td width="180">{{$saleDetail->menu_name}}</td>
                            <td width="50">{{$saleDetail->quantity}}</td>
                            <td width="55">{{$saleDetail->menu_price}}</td>
                            <td width="65">{{$saleDetail->menu_price * $saleDetail->quantity}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="tb-sale-total">
                    <tbody>
                        <tr>
                            <td colspan="4">Total Quantity</td>
                            <td colspan="4">{{$saleDetails->count()}}</td>
                        </tr>
                        <tr>
                            <td colspan="4">Total</td>
                            <td colspan="4">Rp{{number_format($sale->total_price, 2)}}</td>
                        </tr>
                        <tr>
                            <td colspan="4">Payment Type</td>
                            <td colspan="4">{{$sale->payment_type}}</td>
                        </tr>
                        <tr>
                            <td colspan="4">Paid Amount</td>
                            <td colspan="4">Rp{{number_format($sale->total_received, 2)}}</td>
                        </tr>
                        <tr>
                            <td colspan="4">Change</td>
                            <td colspan="4">Rp{{number_format($sale->change, 2)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="receipt-footer">
                <p>Terima Kasih :)</p>
            </div>
            <div id="buttons">
                <a href="/cashier">
                <button class="btn btn-back print-hide">
                    Back to Cashier
                </button>
                </a>
                <button class="btn btn-print print-hide" type="button" onclick="window.print();return false;">
                    Print
                </button>
            </div>
        </div>
    </body>
</html>
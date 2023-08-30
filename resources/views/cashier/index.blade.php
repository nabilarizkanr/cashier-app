<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="table-detail"></div>
    <div class="row justify-content-center">
        <div class="col-md-5 d-flex flex-column">
            <button class="btn btn-primary btn-clock" id="btn-show-tables">View All Tables</button>
            <div id="selected-table"></div>
            <div id="order-detail"></div>
        </div>
        <div class="col-md-7">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    @foreach($categories as $category)
                    <a class="nav-item nav-link" data-toggle="tab" data-id="{{$category->id}}">
                        {{$category->name}}
                    </a>
                    @endforeach
                </div>
            </nav>
            <div id="list-menu" class="row mt-2"></div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Payment</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 class="totalAmount"></h4>
        <h4 class="changeAmount"></h4>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Rp</span>
            </div>
            <input type="number" id="received-amount" class="form-control"></input>
        </div>
        <div class="form-group">
            <label for="payment">Payment Type</label>
            <select class="form-control" id="payment-type">
                <option value="cash">Cash</option>
                <option value="qris">Qris</option>
            </select>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-save-payment" disabled>Save Payment</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    //make table-detail hidden
    $("#table-detail").hide();

    //show all tables when a client click on the button
    $("#btn-show-tables").click(function(){
        if($("#table-detail").is(":hidden")){
            $.get("/cashier/getTable", function(data){
            $("#table-detail").html(data);
            $("#table-detail").slideDown('fast');
            $("#btn-show-tables").html('Hide Tables').removeClass('btn-primary').addClass('btn-danger');
        })
        }else{
            $("#table-detail").slideUp('fast');
            $("#btn-show-tables").html('View All Tables').removeClass('btn-danger').addClass('btn-primary');
        }
    });
    //Menampilkan Menu per Category
    $(".nav-link").click(function(){
        $.get("/cashier/getMenuByCategory/"+$(this).data("id"),function(data){
            $("#list-menu").hide();
            $("#list-menu").html(data);
            $("#list-menu").fadeIn('fast');
        });
    })
    var SELECTED_TABLE_ID = "";
    var SELECTED_TABLE_NAME = "";
    var SALE_ID = "";
    //Detect Button Table onClick to Show Table Data
    $("#table-detail").on("click", ".btn-table", function(){
        SELECTED_TABLE_ID = $(this).data("id");
        SELECTED_TABLE_NAME = $(this).data("name");
        $("#selected-table").html('<br><h4>Table: '+SELECTED_TABLE_NAME+'</h4><hr>');
        $.get("/cashier/getSaleDetailsByTable/"+SELECTED_TABLE_ID, function(data){
            $("#order-detail").html(data);
        });
    });

    $("#list-menu").on("click", ".btn-menu", function(){
        if(SELECTED_TABLE_ID == ""){
            alert("You need to select a table for customer first");
        }else{
            var menu_id = $(this).data("id");
            $.ajax({
                type: "POST",
                data: {
                    "_token" : $('meta[name="csrf-token"').attr('content'),
                    "menu_id": menu_id,
                    "table_id": SELECTED_TABLE_ID,
                    "table_name": SELECTED_TABLE_NAME,
                    "quantity" : 1
                },
                url: "/cashier/orderFood",
                success: function(data){
                    $("#order-detail").html(data);
                }
            });
        }
    });

    $("#order-detail").on('click', ".btn-confirm-order", function(){
        var SaleID = $(this).data("id");
        $.ajax({
            type: "POST",
            data: {
                "_token" : $('meta[name="csrf-token"').attr('content'),
                "sale_id" : SaleID
            },
            url: "/cashier/confirmOrderStatus",
            success: function(data){
                $("#order-detail").html(data);
            }
        });
    });

    //delete saledetail
    $("#order-detail").on("click", ".btn-delete-saledetail", function(){
        var saleDetailID = $(this).data("id");
        $.ajax({
            type: "POST",
            data: {
                "_token" : $('meta[name="csrf-token"').attr('content'),
                "saleDetail_id" : saleDetailID
            },
            url: "/cashier/deleteSaleDetail",
            success: function(data){
                $("#order-detail").html(data);
            }
        })
    });

    //When a user click on the payment button
    $("#order-detail").on("click", ".btn-payment", function(){
        var totalAmount = $(this).attr('data-totalAmount');
        $(".totalAmount").html("Total Amount Rp" + totalAmount);
        $("#received-amount").val('');
        $(".changeAmount").html('');
        SALE_ID = $(this).data('id');
    });

    //calculate change
    $("#received-amount").keyup(function(){
        var totalAmount = $(".btn-payment").attr('data-totalAmount');
        var receivedAmount = $(this).val();
        var changeAmount = receivedAmount - totalAmount;
        $(".changeAmount").html("Total Change: Rp"+ changeAmount);

        //Ngecek kalau kasirnya enter jumlah yang betul, kalau betul button nya bisa
        if(changeAmount >= 0){
            $('.btn-save-payment').prop('disabled', false);
        }else{
            $('.btn-save-payment').prop('disabled', true);
        }
    });

    //Save payment
    $(".btn-save-payment").click(function(){
        var receivedAmount = $("#received-amount").val();
        var paymentType = $("#payment-type").val();
        var saleId = SALE_ID;
        $.ajax({
            type: "POST",
            data: {
                "_token" : $('meta[name="csrf-token"').attr('content'),
                "saleID" : saleId,
                "receivedAmount" : receivedAmount,
                "paymentType" : paymentType
            },
            url: "/cashier/savePayment",
            success: function(data){
                window.location.href=data;
            }
        });
    });
    //Increase
    $("#order-detail").on("click", ".btn-increase-quantity", function(){
        var saleDetailID = $(this).data("id");
        $.ajax({
            type: "POST",
            data: {
                "_token" : $('meta[name="csrf-token"').attr('content'),
                "saleDetail_id" : saleDetailID
            },
            url: "/cashier/increase-quantity",
            success: function(data){
                $("#order-detail").html(data);
            }
        })
    });
    //Decrease
    $("#order-detail").on("click", ".btn-kurang-quantity", function(){
        var saleDetailID = $(this).data("id");
        $.ajax({
            type: "POST",
            data: {
                "_token" : $('meta[name="csrf-token"').attr('content'),
                "saleDetail_id" : saleDetailID
            },
            url: "/cashier/decrease-quantity",
            success: function(data){
                $("#order-detail").html(data);
            }
        })
    });


});
</script>
@endsection

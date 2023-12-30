@extends('master')

@section('title','Shop Order Voucher')

@section('place')

@endsection

@section('content')

    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-5 printableArea" style="width:45%;" id='printableArea'>
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div  style="text-align:center;">
                                    <address>
                                        <strong style="font-size:17px;font-weight:bold;">COZY OASIS</strong><br>
                                            <strong style="font-size:17px;font-weight:bold;">COFFEE SHOP</strong><br>
                                            <strong style="font-size:17px;font-weight:bold;"> No (767), YayLe` Road, Maubin</strong><br>
                                            <strong style="font-size:17px;font-weight:bold;">Ayeyarwady Region, Myanmar</strong><br>
                                            <strong style="font-size:17px;font-weight:bold;"><i class="fas fa-mobile-alt"></i> 09 770 725084, 09 770 725084</strong><br>
                                    </address>
                                </div>
                                <div class="pull-right text-left" style="margin-top:20px;">
                                        <strong style="font-size:16px;font-weight:bold;">Date : <i class="fa fa-calendar"></i> {{$voucher->voucher_date}}</strong><br>
                                        <strong style="font-size:16px;font-weight:bold;">Voucher Number : {{$voucher->voucher_code}}</strong><br>

                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top:12px;">
                                <div class="table-responsive" style="clear: both;">
                                    <table class="table">
                                        <thead>
                                            <tr style="text-align:left;">
                                                <th ><strong>Menu Name</strong></th>
                                                <th ><strong>Option & Size</strong></th>
                                                <th ><strong>Price & Qty</strong></th>
                                                <th ><strong>Total</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($units as $option)
                                            <tr style="font-size:13px;">
                                                <td >{{$option->item_name}}</td>
                                                <td >{{$option->option_name}}</td>
                                                <td >{{$option->selling_price}} * {{$option->order_qty}}</td>
                                                <td >{{$option->selling_price * $option->order_qty}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div style="text-align:right;margin-right:10px;margin-top:20px;font-size:17px;font-weight:bold;">
                                        <strong>Voucher Total - {{$voucher->total_amount}}</strong><br>
                                        <strong>Pay - {{$voucher->pay}}</strong><br>
                                        <strong>Change - {{$voucher->change}}</strong><br>      
                                    </div>
                                    
                                    <h6  style="text-align:center;margin-top:10px;">**ကျေးဇူးတင်ပါသည်***</h6>
                            </div>
                        </div>
                    </div>
                 </div>

                </div>

                <div class="col-md-12">
                    <div class="text-center">
                        <button id="print" class="btn btn-info" type="button">
                            <span><i class="fa fa-print"></i> Print</span>
                        </button>
                    </div>
                </div>
                <div id="mobileprint" class="d-none">

                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')

<script src="{{asset('js/jquery.PrintArea.js')}}" type="text/JavaScript"></script>

<script>
    $(document).ready(function() {
        $("#print").click(function() {
            // var mode = 'iframe'; //popup
            // var close = mode == "popup";
            // var options = {
            //     mode: mode,
            //     popClose: close
            // };
            // $("div.printableArea").printArea(options);

            let html = document.getElementById('printableArea').innerHTML;
            $('#mobileprint').html(html);

            var printContent = $('#mobileprint')[0];
            var WinPrint = window.open('', '', 'width=900,height=650');
            WinPrint.document.write('<html><head><title>Print Voucher</title>');
            WinPrint.document.write('<link rel="stylesheet" type="text/css" href="css/style.css">');
            WinPrint.document.write('<link rel="stylesheet" type="text/css" media="print" href="css/print.css">');
            WinPrint.document.write('</head><body >');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.document.write('</body></html>');

            WinPrint.focus();
            WinPrint.print();
            WinPrint.document.close();
            WinPrint.close();
        });
    });
    </script>

@endsection

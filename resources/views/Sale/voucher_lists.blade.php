@extends('master')

@section('title','Finished Shop Order Page')

@section('place')

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="font-weight-bold mt-2">Finished Shop Order List</h4>
            </div>
            <div class="card-body">
                <div class="row form-group">
                    <div class="offset-md-3 col-md-3">
                        <label for="">Start Date</label>
                        <input type="date" class="form-control" id="start_date">
                    </div>
                    <div class="col-md-3">
                        <label for="">End Date</label>
                        <input type="date" class="form-control" id="end_date">
                    </div>
                    <div class="col-md-3" style="margin-top:35px;">
                        <button class="btn btn-m btn-primary" onclick="datefilter()">Search</button>
                    </div>
                </div>
                <div class="table-responsive">
                   
                    <table class="table" id="example23">
                        <thead>
                            <tr class="text-center">
                                <th>
                                   Voucher Number
                                </th>
                                <th>
                                    Total Amount
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Check
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="sale_table">
                            @foreach($vouchers as $vouc)
                            <tr class="text-center">
                                <td>{{$vouc->voucher_code}}</td>
                                <td>{{$vouc->total_amount}}</td>
                                <td>{{$vouc->date}}</td>
                                <td>
                                    <a href="{{route('shop_order_voucher', $vouc->id)}}" class="btn btn-sm btn-coffee rounded">Check Voucher</a>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-danger rounded text-white" onclick="ApproveLeave('{{$vouc->id}}')">Delete</a>          
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
 <script>

function ApproveLeave(value){

var voucher_id = value;

swal({
    title: "Confirm!",
    icon:'warning',
    buttons: ["No", "Yes"]
})

.then((isConfirm)=>{

if(isConfirm){

    $.ajax({
        type:'POST',
        url:'voucher/delete',
        dataType:'json',
        data:{ 
        "_token": "{{ csrf_token() }}",
        "voucher_id": voucher_id,
        },

        success: function(){
            
            swal({
                title: "Success!",
                text : "Successfully Deleted!",
                icon : "success",
            });

            setTimeout(function(){window.location.reload()}, 1000);
                
        },            
    });
}
});

}

    function datefilter(){
        let start_date = $('#start_date').val();
        let end_date = $('#end_date').val();

        $.ajax({
        type:'POST',
        url:'/Finished-Order-DateFilter',
        data:{
        "_token":"{{csrf_token()}}",
        "start_date":start_date,
        "end_date":end_date,
        },
        success:function(data){
            let html = '';
            $.each(data, function(i,v){
                console.log(data)
                let url1 = "{{url('/Shop-Order-Voucher/')}}/"+v.id;
                html +=`
                <tr class="text-center">
                    <td>${v.voucher_code}</td>
                    <td>${v.total_amount}</td>
                    <td>${v.date}</td>
                    <td>
                        <a href="${url1}" class="btn btn-sm btn-coffee rounded">Check Voucher</a>
                    </td>
                    <td class="text-center">
                        <a href="#" class="btn btn-sm btn-danger rounded text-white" onclick="ApproveLeave(${v.id})">Delete</a>          
                    </td>
                    </tr>
                        `;
            })
            $('#sale_table').html(html);
        }
        })
    }

 </script>
@endsection

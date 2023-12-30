@extends('master')

@section('title','Shop Order Sale Page')

@section('place')

@endsection

@section('content')

<div class="row">

    <div class="card col-md-6">

        <ul class="nav nav-tabs customtab" role="tablist">

            @foreach($cuisine_types as $cuisine)
            <li class="nav-item" style="font-size:14px;">
                <a class="nav-link" data-toggle="tab" href="#{{$cuisine->id}}" role="tab">

                    <span class="hidden-sm-up">
                        <i class="ti-home"></i>
                    </span>
                    <span class="hidden-xs-down">

                        {{$cuisine->name}}

                    </span>
                </a>
            </li>
            @endforeach
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
        <div class="tab-pane active"  role="tabpanel">
                <div class="row mt-3">
                @foreach($items as $item)
                <div class="card col-md-3" style="width: 18rem;margin-left:42px;">
                    <img src="{{ asset($item->photo_path) }}" class="card-img-top mb-3 mt-2" height="125rem" alt="..." style='object-fit: cover;'>
                    <div style="height:40px;">
                        <h6 class="card-title text-center font-weight bold" style="font-size:12px;">{{$item->item_name}}</h6>
                    </div>
                    <i class="btn btn-sm btn-coffee" onclick="getCountingUnit({{$item->id}})"><i class="fas fa-plus"></i>Sale</i>

                </div>
                @endforeach
                </div>
            </div>
            @foreach($cuisine_types as $cuisine)
            <div class="tab-pane" id="{{$cuisine->id}}" role="tabpanel">
                <div class="row mt-3">
                @foreach($items as $item)
                @if($item->cuisine_type_id == $cuisine->id)

                <div class="card col-md-3" style="width: 18rem;margin-left:42px;">
                    <img src="{{ asset($item->photo_path) }}" class="card-img-top mb-3 mt-2" height="125rem" alt="..." style='object-fit: cover;'>
                    <div style="height:40px;">
                        <h6 class="card-title text-center font-weight bold" style="font-size:12px;">{{$item->item_name}}</h6>
                    </div>
                    <i class="btn btn-sm btn-coffee" onclick="getCountingUnit({{$item->id}})"><i class="fas fa-plus"></i>Sale</i>

                </div>
                @endif
                @endforeach
                </div>
            </div>
            @endforeach
<!-- 
            <div class="tab-pane" id="5" role="tabpanel">

                <div class="row mt-3">
                    @foreach($items as $item)
                    @if($item->cuisine_type_id == 5)

                    <div class="card col-md-3" style="width: 18rem;margin-left:42px;">
                        <img src="{{ asset($item->photo_path) }}" class="card-img-top mb-3 mt-2" height="125rem" alt="..." style='object-fit: cover;'>
                        <div style="height:40px;">
                            <h6 class="card-title text-center font-weight bold" style="font-size:12px;">{{$item->item_name}}</h6>
                        </div>


                        <i class="btn btn-sm btn-coffee" onclick="getCountingUnit({{$item->id}})"><i class="fas fa-plus"></i>Sale</i>

                    </div>
                    @endif
                    @endforeach
                </div>
            </div> -->

            <div class="modal fade" id="unit_table_modal" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Choose Option Infomation</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="#close_modal">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body" id="checkout_modal_body">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Item Name</th>
                                        <th>Unit Name</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="count_unit">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="col-md-6">

        <div class="card">
     
            <div class="card-title">
                <a href="" class="float-right text-coffee" onclick="deleteItems()">Refresh Here &nbsp<i class="fas fa-sync"></i></a>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="font-weight-bold text-coffee">Menu Item</th>
                                <th class="font-weight-bold text-coffee">Option</th>
                                <th class="font-weight-bold text-coffee">Quantity</th>
                                <th class="font-weight-bold text-coffee">Price</th>
                            </tr>
                        </thead>
                        <tbody id="sale">
                           <tr>

                           </tr>
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <td class="font-weight-bold text-coffee" colspan="3">Total Quantity</td>
                                <td class="font-weight-bold text-coffee" id="total_quantity">0</td>
                            </tr>
                            <tr class="text-center">
                                <td class="font-weight-bold text-coffee" colspan="3">Sub Total Price</td>
                                <td class="font-weight-bold text-coffee" id="sub_total">0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                 <div class="row ml-2 justify-content-center">

                    <div class="row">
                        <div class="col-md-4">
                            <i class="btn btn-coffee mr-2" data-toggle="modal" data-target="#checkout"> Check Out&nbsp;! </i>
                            <div class="modal fade" id="checkout" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Voucher Create Form</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>

                                    <div class="modal-body">
                                        <form class="form-material" action="{{route('store_shop_order')}}" method="post" id="vourcher_page">
                                            @csrf
                                            <input type="hidden" id="item" name="option_lists">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Total Amount</label>
                                                <input type="number" id="voc_tot" name="voc_tot" class="form-control" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Pay Amount</label>
                                                <input type="number" id="voc_pay" name="voc_pay" class="form-control" value="0" onchange="chgpay(this.value)">
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Change Amount</label>
                                                <input type="number" id="voc_chg" name="voc_chg" class="form-control" readonly>
                                            </div>

                                            <input type="button" name="btnsubmit" class="btnsubmit float-right btn btn-coffee" value="Create" onclick="showCheckOut()">
                                        </form>
                                    </div>

                                </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')

<script type="text/javascript">

    $(document).ready(function() {
        $('#select2').select2();
        showmodal();
        $('#table_1').DataTable( {

            "paging":   false,
            "ordering": false,
            "info":     false,

        });

        $('#table_2').DataTable( {

            "paging":   false,
            "ordering": false,
            "info":     false,

        });

        $('#table_3').DataTable( {

            "paging":   false,
            "ordering": false,
            "info":     false,

        });
    });

    function deleteItems() {

      localStorage.clear();
    }

   function chgpay(val){
    var tot = $('#voc_tot').val();
    $('#voc_chg').val(val-tot);
   }


    function getCountingUnit(item_id){
        var html = "";

        $.ajax({

           type:'POST',

           url:'/getCountingUnitsByItemId',

           data:{
            "_token":"{{csrf_token()}}",
            "item_id":item_id,
           },

            success:function(data){
                $.each(data, function(i, unit) {
                    if(unit.brake_flag ==2){
                        html+=`<tr class="text-center">
                            <input type="hidden" id="item_name" value="${unit.menu_item.item_name}">
                            <input type="hidden" id="price_${unit.id}" value="${unit.sale_price}">
                            <td>${unit.menu_item.item_name}</td>
                            <td id="name_${unit.id}">${unit.name}</td>
                            <td>${unit.sale_price}</td>
                            <td><i class="btn btn-sm rounded btn-danger">Brake</i></td>
                            </tr>

                        `;
                    }
                    else{
                        html+=`<tr class="text-center">
                            <input type="hidden" id="item_name" value="${unit.menu_item.item_name}">
                            <input type="hidden" id="price_${unit.id}" value="${unit.sale_price}">
                            <td>${unit.menu_item.item_name}</td>
                            <td id="name_${unit.id}">${unit.name}</td>
                            <td>${unit.sale_price}</td>
                            <td><i class="btn btn-sm rounded btn-coffee" onclick="tgPanel(${unit.id})"><i class="fas fa-plus"></i>Add</i></td>
                            </tr>

                        `;
                    }
                });

                $("#count_unit").html(html);

                $("#unit_table_modal").modal('show');
            }

        });
    }

    function tgPanel(id){

        // alert(id);

var item_name = $('#item_name').val();
console.log(item_name);

var item_price_check = $('#price_' + id).val();

var name = $('#name_' + id).text();

var qty_check = $('#qty_' + id).val();

var qty = parseInt(qty_check);

var price = parseInt(item_price_check);

if( item_price_check == ""){

Swal.fire({
    title:"Please Check",
    text:"Please Select Price To Sell",
    icon:"info",
});
}
else{

// swal("Please Enter Quantity:", {
//     content: "input",
// })

// .then((value) => {
//     if(value.toString().match(/^\d+$/)){
//     if (value > qty ) {

//         swal({
//             title:"Can't Add",
//             text:"Your Input is higher than Current Quantity!",
//             icon:"info",
//         });

//     }else{

        // alert('hello!');

        $('.note_class').hide();


        var total_price = price * 1 ;

        var item={id:id,item_name:item_name,unit_name:name,current_qty:qty,order_qty:1,selling_price:price};
        console.log(item);
        var total_amount = {sub_total:total_price,total_qty:1};

        var mycart = localStorage.getItem('mycart');

        var grand_total = localStorage.getItem('grandTotal');

        //console.log(item);

        if(mycart == null ){

            mycart = '[]';

            var mycartobj = JSON.parse(mycart);

            mycartobj.push(item);

            localStorage.setItem('mycart',JSON.stringify(mycartobj));

        }else{

            var mycartobj = JSON.parse(mycart);

            var hasid = false;

            $.each(mycartobj,function(i,v){

                if(v.id == id ){

                    hasid = true;

                    v.order_qty = parseInt(1) + parseInt(v.order_qty);
                }
            })

            if(!hasid){

                mycartobj.push(item);
            }

            localStorage.setItem('mycart',JSON.stringify(mycartobj));
        }

        if(grand_total == null ){

            localStorage.setItem('grandTotal',JSON.stringify(total_amount));

        }else{

            var grand_total_obj = JSON.parse(grand_total);

            grand_total_obj.sub_total = total_price + grand_total_obj.sub_total;

            grand_total_obj.total_qty = parseInt(1) + parseInt(grand_total_obj.total_qty);

            localStorage.setItem('grandTotal',JSON.stringify(grand_total_obj));
        }

        $("#unit_table_modal").modal('hide');

        showmodal();

    }
}

    function showmodal(){

        var mycart = localStorage.getItem('mycart');
        console.log(mycart);
        var grandTotal = localStorage.getItem('grandTotal');

        var grandTotal_obj = JSON.parse(grandTotal);

        if(mycart){

            var mycartobj = JSON.parse(mycart);

            var html='';

            if(mycartobj.length>0){

                $.each(mycartobj,function(i,v){

                    var id=v.id;

                    var item=v.item_name;

                    var qty=v.order_qty;

                    var count_name = v.unit_name

                    html+=`<tr>
                            <td class="text-coffee font-weight-bold">${item}</td>

                            <td class="text-coffee font-weight-bold">${count_name}</td>

                            <td>
                                <button class="btn btn-sm btn-coffee text-white border border-radius rounded" onclick="plus(${id})" id="${id}">+</button>
                                ${qty}
                                <button class="btn btn-sm btn-coffee text-white border border-radius rounded" onclick="minus(${id})" id="${id}">-</button>
                            </td>

                            <td class="text-coffee font-weight-bold">${v.selling_price}</td>
                            </tr>
                            `;

                });
            }

            $("#total_quantity").text(grandTotal_obj.total_qty);

            $("#sub_total").text(grandTotal_obj.sub_total);

            $("#voc_tot").val(grandTotal_obj.sub_total);

            $("#sale").html(html);
        }
    }

    function plus(id){





            count_change(id,'plus',1);


    }

    function minus(id){



            count_change(id,'minus',1);


    }

    function count_change(id,action,qty){

        var grand_total = localStorage.getItem('grandTotal');

        var mycart=localStorage.getItem('mycart');

        var mycartobj=JSON.parse(mycart);

        var grand_total_obj = JSON.parse(grand_total);

        var item = mycartobj.filter(item =>item.id == id);

        if( action == 'plus'){

            if (item[0].order_qty == item[0].current_qty) {

                swal({
                    title:"Can't Add",
                    text:"Can't Added Anymore!",
                    icon:"info",
                });

                $('#btn_plus_' + item[0].id).attr('disabled', 'disabled');
            }
            item[0].order_qty++;

          grand_total_obj.sub_total += parseInt(item[0].selling_price);

          grand_total_obj.total_qty ++;

          localStorage.setItem('mycart',JSON.stringify(mycartobj));

          localStorage.setItem('grandTotal',JSON.stringify(grand_total_obj));



            showmodal();
        }
        else if (action == 'minus') {
            console.log(item[0].order_qty);
            if(item[0].order_qty == 1){

              var ans=confirm('Are you sure');

              if(ans){

                let item_cart = mycartobj.filter(item =>item.id !== id );

                grand_total_obj.sub_total -= parseInt(item[0].selling_price);

                grand_total_obj.total_qty -- ;

                localStorage.setItem('mycart',JSON.stringify(item_cart));

                localStorage.setItem('grandTotal',JSON.stringify(grand_total_obj));

                  showmodal();

              }else{

                item[0].order_qty;

                localStorage.setItem('mycart',JSON.stringify(mycartobj));

                localStorage.setItem('grandTotal',JSON.stringify(grand_total_obj));

                  showmodal();
              }

          }else{

            item[0].order_qty--;

            grand_total_obj.sub_total -= parseInt(item[0].selling_price);

            grand_total_obj.total_qty -- ;

            localStorage.setItem('mycart',JSON.stringify(mycartobj));

            localStorage.setItem('grandTotal',JSON.stringify(grand_total_obj));

            // count_item();

            showmodal();
          }
      }
  }

    function showCheckOut(){
        var mycart = localStorage.getItem('mycart');

        var myremark = localStorage.getItem('myremark');

        if(!mycart){

            swal({
                title:"Please Check",
                text:"Menu Item Cannot be Empty to Check Out",
                icon:"info",
            });

        }else{
            
            $("#item").attr('value', mycart);

            $("#vourcher_page").submit();

            localStorage.clear();

        }
    }

    $( document ).ready(function() {
    $('#name').val('');
    $('#phone').val('');
    $('#address').val('');
    $('#order_date').val('');
    $('#note').val('');
});

function fill_remark(){
    var text = ($("#select2 option:selected").text());
    $('#complain').val(text);
}


</script>

@endsection

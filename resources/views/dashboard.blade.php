@extends('master')

@section('title','Dashboard')

@section('place')

<div class="col-md-5 col-8 align-self-center">
    <h3 class="text-coffee m-b-0 m-t-0">Dashboard</h3>
</div>

@endsection

@section('content')

<div class="row">

    <div class="col-lg-3 col-md-3">
        <a href="{{route('report')}}">
            <div class="card bg-coffee">
                <div class="card-body">
                    <div class="row justify-content-center">
                    <img src="{{asset('assets/images/coffee.jpg')}}" class="border border-radius rounded" alt="" width="50px" height="40px">
                    </div>
                    <h4 class="text-center text-white font-weight-bold mt-3">Admin Dashboard</h4>

                </div>
            </div>
        </a>
    </div>

    <!-- <div class="col-lg-3 col-md-3">
        <a href="#">
            <div class="card bg-coffee">
                <div class="card-body">
                    <div class="row justify-content-center">
                    <img src="{{asset('assets/images/coffee.jpg')}}" class="border border-radius rounded" alt="" width="50px" height="40px">
                    </div>
                    <h4 class="text-center text-white font-weight-bold mt-3">Inventory</h4>

                </div>
            </div>
        </a>
    </div> -->

    <div class="col-lg-3 col-md-3">
        <a href="{{route('voucher_lists')}}">
            <div class="card bg-coffee">
                <div class="card-body">
                    <div class="row justify-content-center">
                    <img src="{{asset('assets/images/coffee.jpg')}}" class="border border-radius rounded" alt="" width="50px" height="40px">
                    </div>
                    <h4 class="text-center text-white font-weight-bold mt-3">Voucher Lists</h4>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-3">
        <a href="{{route('shop_order_panel')}}">
            <div class="card bg-coffee">
                <div class="card-body">
                    <div class="row justify-content-center">
                    <img src="{{asset('assets/images/coffee.jpg')}}" class="border border-radius rounded" alt="" width="50px" height="40px">
                    </div>
                    <h4 class="text-center text-white font-weight-bold mt-3">Shop Order</h4>
                </div>
            </div>
        </a>
    </div>
</div>

@endsection

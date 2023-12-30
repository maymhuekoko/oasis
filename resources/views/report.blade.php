@extends('master')
@section('title', 'Dashboard')
@section('content')

<style>

</style>
<div class="content">
    <div class="row">
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4">
                <div class="card-body">
                    <p class="mt-1 mb-0 text-success font-weight-normal text-sm">
                    <span>Today Sale</span>
                    </p>
                    <div class="row mt-2">
                        <div class="col">
                        <span class="h3 font-weight-normal mb-0 text-info" style="font-size: 20px;"> {{$today_sale}} Ks</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape text-white rounded-circle shadow" style="background-color:#473C70;">
                            <i class="fas fa-hand-holding-usd"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                     <p class="mt-1 mb-0 text-success font-weight-normal text-sm">
                    <span>Total Income Amount</span>
                    </p>
                    <div class="row mt-2">
                        <div class="col">
                            <span class="h3 font-weight-normal mb-0 text-info" style="font-size: 20px;">{{$total_sale}} Ks</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape text-white rounded-circle shadow" style="background-color:#473C70;">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
</div>


    <div class="row md-12">
        <div class="col-md-6">
            <div class="card card-stats mb-4" >
                <div class="card-body font-weight-bold text-center">
                    <h5>Top Five Famous Menu Item</h5>
                    <div class="row ml-5" id="famous_item">

                    </div>
                </div>
            </div>
		</div>
        <div class="col-md-6">
        <div class="card p-4">

            <div class="main">
                <canvas id="barChart" height="150"></canvas>
            </div>
        </div>
        </div>
        
	</div>

	<div class="row md-12">


	</div>

    <input type="hidden" id="total_sale" value="{{$total_sale}}">

</div>



@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">

    $('#slimtest1').slimScroll({
        height: '400px'
    });

    $('#slimtest2').slimScroll({
        height: '400px'
    });

    $(document).ready(function(){
        // bar chart famous menu
        // alert('hello');
        $.ajax({
           type:'POST',
           url:'/getWeekNowFamous',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
            },

           success:function(data){

            var html = ''; var html1 = '';
            $.each(data,function(i,v){
                html += `
                <div class="col-md-8 mt-4 ml-5" >
                    ${v.item_name}
                </div>
                `;
            })
           
            $('#famous_item').html(html);
           }
        });

    $.ajax({
           type:'POST',
           url:'/getOrderFullfill',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
            },

           success:function(data){
               console.log(data);
            //    alert(data.f_done);
            //    begin chart

            var canvas = document.getElementById("barChart");
            var ctx = canvas.getContext("2d");

                // Data with datasets options
                var data = {
                    labels: [
                        "January",
                        "Febuary",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December",
                    ],
                    datasets: [
                        {
                            label: "Sale Amount",
                            fill: false,
                            backgroundColor: 'rgba(54,162,235,0.6)',
                            data: [data.jan_income,data.feb_income,data.mar_income,data.apr_income,data.may_income,data.jun_income,data.jul_income,data.aug_income,data.sep_income,data.oct_income,data.nov_income,data.dec_income]
                        },
                        // {
                        //     label: "Unfamous Menu Items",
                        //     fill: false,
                        //     backgroundColor: 'rgba(255,99,132,0.6)',
                        //     data: [100,200,300,400,500,600,700,600,500,400,300,200]
                        // }
                    ]
                };

        //         // Notice how nested the beginAtZero is
                var options = {
                    title: {
                        display: true,
                        text: "Monthly Sale Fulfillment",
                        position: "top",
                        fontSize: 20
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: true,
                                    drawBorder: true,
                                    drawOnChartArea: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    precision: 0
                                    // beginAtZero: true
                                }
                            }
                        ]
                    }
                };

        //         // added custom plugin to wrap label to new line when \n escape sequence appear
                var labelWrap = [
                    {
                        beforeInit: function (chart) {
                            chart.data.labels.forEach(function (e, i, a) {
                                if (/\n/.test(e)) {
                                    a[i] = e.split(/\n/);
                                }
                            });
                        }
                    }
                ];

        //         // Chart declaration:
                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: options,
                    plugins: labelWrap
                });

        //     // end chart
           }
    });

});

    function search_compare_data(value)
{
    // alert(value);
    if(value ==1)
    {
        // alert("two");


        $.ajax({
           type:'POST',
           url:'/getOrderFullfill',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
            },

           success:function(data){
               console.log(data);
            //    alert(data.f_done);
            //    begin chart




            var canvas = document.getElementById("barChart");
            var ctx = canvas.getContext("2d");

// Global Options:
                Chart.defaults.global.defaultFontColor = "#2097e1";
                Chart.defaults.global.defaultFontSize = 11;

                // Data with datasets options
                var data = {
                    labels: [
                        "January",
                        "Febuary",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December",
                    ],
                    datasets: [
                        {
                            label: "Famous Menu Items",
                            fill: false,
                            backgroundColor: "#2097e1",
                            data: [1000,2000,3000,4000,5000,6000,7000,8000,9000,8000,7000,6000]
                        },
                        {
                            label: "Unfamous Menu Items",
                            fill: false,
                            backgroundColor: "#bdd9e6",
                            data: [1000,2000,3000,4000,5000,6000,7000,8000,9000,8000,7000,6000]
                        }
                    ]
                };

        //         // Notice how nested the beginAtZero is
                var options = {
                    title: {
                        display: true,
                        text: "Monthly Sale Fulfillment",
                        position: "top"
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: true,
                                    drawBorder: true,
                                    drawOnChartArea: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    precision: 0
                                    // beginAtZero: true
                                }
                            }
                        ]
                    }
                };

        //         // added custom plugin to wrap label to new line when \n escape sequence appear
                var labelWrap = [
                    {
                        beforeInit: function (chart) {
                            chart.data.labels.forEach(function (e, i, a) {
                                if (/\n/.test(e)) {
                                    a[i] = e.split(/\n/);
                                }
                            });
                        }
                    }
                ];

        //         // Chart declaration:
                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: options,
                    plugins: labelWrap
                });

        //     // end chart
           }
        });

    } else if(value ==2)
    {
        // alert("two");


        $.ajax({
           type:'POST',
           url:'/getCashCollect',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
            },

           success:function(data){
               console.log(data);
            //    alert(data.f_done);
            //    begin chart




            var canvas = document.getElementById("barChart");
            var ctx = canvas.getContext("2d");

// Global Options:
                Chart.defaults.global.defaultFontColor = "#2097e1";
                Chart.defaults.global.defaultFontSize = 11;

                // Data with datasets options
                var data = {
                    labels: [
                        "January",
                        "Febuary",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December",
                    ],
                    datasets: [
                        {
                            label: "Order Amount",
                            fill: false,
                            backgroundColor: "#2097e1",
                            data: [1000,2000,3000,4000,5000,6000,7000,8000,9000,8000,7000,6000]
                        },
                        {
                            label: "Transaction Amount",
                            fill: false,
                            backgroundColor: "#bdd9e6",
                            data: [1000,2000,3000,4000,5000,6000,7000,8000,9000,8000,7000,6000]
                        }
                    ]
                };

        //         // Notice how nested the beginAtZero is
                var options = {
                    title: {
                        display: true,
                        text: "Monthly Cash Collection",
                        position: "top"
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: true,
                                    drawBorder: true,
                                    drawOnChartArea: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    precision: 0
                                    // beginAtZero: true
                                }
                            }
                        ]
                    }
                };

        //         // added custom plugin to wrap label to new line when \n escape sequence appear
                var labelWrap = [
                    {
                        beforeInit: function (chart) {
                            chart.data.labels.forEach(function (e, i, a) {
                                if (/\n/.test(e)) {
                                    a[i] = e.split(/\n/);
                                }
                            });
                        }
                    }
                ];

        //         // Chart declaration:
                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: options,
                    plugins: labelWrap
                });

        //     // end chart
           }
        });

    }else if(value ==3)
    {
        // alert("two");

        $.ajax({
           type:'POST',
           url:'/getSupplierRepayment',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
            },

           success:function(data){
               console.log(data);
            //    alert(data.f_done);
            //    begin chart




            var canvas = document.getElementById("barChart");
            var ctx = canvas.getContext("2d");

            // Global Options:
                Chart.defaults.global.defaultFontColor = "#2097e1";
                Chart.defaults.global.defaultFontSize = 11;

                // Data with datasets options
                var data = {
                    labels: [
                        "January",
                        "Febuary",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December",
                    ],
                    datasets: [
                        {
                            label: "Purchase Amount",
                            fill: false,
                            backgroundColor: "#2097e1",
                            data: [1000,2000,3000,4000,5000,6000,7000,8000,9000,8000,7000,6000]
                        },
                        {
                            label: "Credit Repayment Amount",
                            fill: false,
                            backgroundColor: "#bdd9e6",
                            data: [1000,2000,3000,4000,5000,6000,7000,8000,9000,8000,7000,6000]
                        }
                    ]
                };

        //         // Notice how nested the beginAtZero is
                var options = {
                    title: {
                        display: true,
                        text: "Monthly Supplier Repayment",
                        position: "top",
                        fontSize: 20
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: true,
                                    drawBorder: true,
                                    drawOnChartArea: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    precision: 0
                                    // beginAtZero: true
                                }
                            }
                        ]
                    }
                };

        //         // added custom plugin to wrap label to new line when \n escape sequence appear
                var labelWrap = [
                    {
                        beforeInit: function (chart) {
                            chart.data.labels.forEach(function (e, i, a) {
                                if (/\n/.test(e)) {
                                    a[i] = e.split(/\n/);
                                }
                            });
                        }
                    }
                ];

        //         // Chart declaration:
                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: options,
                    plugins: labelWrap
                });

        //     // end chart
           }
        });

    }

}


    function getweek(week)
    {

        $.ajax({
           type:'POST',
           url:'/getWeek',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "receive_week":week,

            },

           success:function(data){

              var canvas = document.getElementById("lineChart");
            var ctx = canvas.getContext("2d");

// Global Options:
                Chart.defaults.global.defaultFontColor = "#2097e1";
                Chart.defaults.global.defaultFontSize = 11;

                // Data with datasets options
                var data = {
                    labels: [
                        data.first_day,
                        data.second_day,
                        data.third_day,
                        data.fourth_day,
                        data.fifth_day,
                        data.sixth_day,
                        data.seventh_day
                    ],
                    datasets: [
                        {
                            label: "Sales Reveneus",
                            fill: true,
                            backgroundColor: 'rgba(75,192,192,0.6)',
                            data: [1000,2000,3000,4000,5000,6000,7000,8000,9000,8000,7000,6000]
                        },
                        {
                            label: "Order Revenues",
                            fill: true,
                            backgroundColor: 'rgba(153,102,255,0.6)',
                            data: [1000,2000,3000,4000,5000,6000,7000,8000,9000,8000,7000,6000]
                        }

                    ]
                };

                // Notice how nested the beginAtZero is
                var options = {
                    title: {
                        display: true,
                        text: "Weekly Sales and Orders Revenue",
                        position: "top",
                        fontSize: 20
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: true,
                                    drawBorder: true,
                                    drawOnChartArea: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    precision: 0
                                    // beginAtZero: true
                                }
                            }
                        ]
                    }
                };

                // added custom plugin to wrap label to new line when \n escape sequence appear
                var labelWrap = [
                    {
                        beforeInit: function (chart) {
                            chart.data.labels.forEach(function (e, i, a) {
                                if (/\n/.test(e)) {
                                    a[i] = e.split(/\n/);
                                }
                            });
                        }
                    }
                ];

                // Chart declaration:
                var myBarChart = new Chart(ctx, {
                    type: "bar",
                    data: data,
                    options: options,
                    plugins: labelWrap
                });
           }

        });
    }



</script>

@endsection


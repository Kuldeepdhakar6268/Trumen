@extends('layouts.admin')
@section('page-title')
    {{ __('Purchase & Management Report') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Purchase & Management Report') }}</li>
@endsection
@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <style>
    /* Hide default arrow */
     #loading {
    position: fixed;
    width: 100%;
    height: 100vh;
    background: #fff url('images/loader.gif') no-repeat center center;
    z-index: 9999;
    }
    
    input[type="text"]::-webkit-input-placeholder {
         color: var(--color-customColor);
    font-weight: bold;
    }
    input:-moz-placeholder {
  color: red; /* Change to your desired color */
  opacity: 1; /* Adjust as needed */
}
    .dataTable-container{
            margin-top: -15px;
    }
    .dataTable-table tbody tr td {
        padding: 7px 0px 7px 0px;
    }
    .dataTable-table tbody tr td {
    padding: 7px 0px 5px 18px !important;
}
.number-color {
    width: 80px !important;
    height: 78px !important;
    padding-top: 25px !important;
    font-size: 15px !important;
    margin-top: -54px !important;
    margin-left: -25px !important;
    margin-bottom: -35px !important;
}
    </style>

@push('script-page')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://hammerjs.github.io/dist/hammer.js"></script>
    <script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    <script>
     (function () {
            var options = {
                chart: {
                    height: 180,
                    type: 'bar',
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: [{
                    name: "{{__('Income')}}",
                    data: {!! json_encode($incExpBarChartData['income']) !!}
                }, {
                    name: "{{__('Expense')}}",
                    data: {!! json_encode($incExpBarChartData['expense']) !!}
                }],
                xaxis: {
                    categories: {!! json_encode($incExpBarChartData['month']) !!},
                },
                colors: ['#00E096', '#FF5000'],
                fill: {
                    type: 'solid',
                },
                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'right',
                },
                // markers: {
                //     size: 4,
                //     colors:  ['#3ec9d6', '#FF3A6E',],
                //     opacity: 0.9,
                //     strokeWidth: 2,
                //     hover: {
                //         size: 7,
                //     }
                // }
            };
            var chart = new ApexCharts(document.querySelector("#incExpBarChart"), options);
            chart.render();
        })();
        (function () {
            var options = {
                chart: {
                    height: 180,
                    type: 'bar',
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: [{
                    name: "{{__('Payment by Bank')}}",
                    data: {!! json_encode($incExpBarChartData['income']) !!}
                }, {
                    name: "{{__('Payment by Cash')}}",
                    data: {!! json_encode($incExpBarChartData['expense']) !!}
                }],
                xaxis: {
                    categories: {!! json_encode($incExpBarChartData['month']) !!},
                },
                colors: ['#00E096', '#FF5000'],
                fill: {
                    type: 'solid',
                },
                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'right',
                },
                // markers: {
                //     size: 4,
                //     colors:  ['#3ec9d6', '#FF3A6E',],
                //     opacity: 0.9,
                //     strokeWidth: 2,
                //     hover: {
                //         size: 7,
                //     }
                // }
            };
            var chart = new ApexCharts(document.querySelector("#incTraBarChart"), options);
            chart.render();
        })();
        
         (function () {
            var options = {
                chart: {
                    height: 180,
                    type: 'bar',
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: [{
                    name: "{{__('INR')}}",
                    data: {!! json_encode($incExpBarChartData['income']) !!}
                }, {
                    name: "{{__('EURO')}}",
                    data: {!! json_encode($incExpBarChartData['expense']) !!}
                },
                {
                    name: "{{__('USD')}}",
                    data: {!! json_encode($incExpBarChartData['expense']) !!}
                }],
                xaxis: {
                    categories: {!! json_encode($incExpBarChartData['month']) !!},
                },
                colors: ['#00E096', '#FF5000', '#5D94E7'],
                fill: {
                    type: 'solid',
                },
                grid: {
                    strokeDashArray: 10,
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'right',
                },
                // markers: {
                //     size: 4,
                //     colors:  ['#3ec9d6', '#FF3A6E',],
                //     opacity: 0.9,
                //     strokeWidth: 2,
                //     hover: {
                //         size: 7,
                //     }
                // }
            };
            var chart = new ApexCharts(document.querySelector("#incCstBarChart"), options);
            chart.render();
        })();
        
    $("#datepicker").on("click",function(){
         $('#datepicker').attr('type', 'date');
         $('#calendar_icon').css('display', 'none');
    });
    $("#datepickerTo").on("click",function(){
         $('#datepickerTo').attr('type', 'date');
         $('#calendar_icon1').css('display', 'none');
    });
    $("#yearSelect").on("click",function(){
         $('#yearSelect').removeClass('text-primary')
         $('#yearSelect').addClass('text-dark')
    });
    $('#yearSelect').on('blur', function() {
        $('#yearSelect').removeClass('text-dark')
         $('#yearSelect').addClass('text-primary') 
    });
    $('#monthSelect').on('blur', function() {
        $('#monthSelect').removeClass('text-dark')
         $('#monthSelect').addClass('text-primary') 
    });
    $("#monthSelect").on("click",function(){
        $('#monthSelect').removeClass('text-primary')
         $('#monthSelect').addClass('text-dark')
    });
     $("#calendar_icon").on("click",function(){
          $('#datepicker').focus();
           $('#datepicker').attr('type', 'date');
           $('#calendar_icon').css('display', 'none');
        })
        var filename = $('#filename').val();

        function saveAsPDF() {
            var printContents = document.getElementById('printableArea').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
        <script>
          $(document).ready(function() {
              $('.choices__list').addClass('text-primary')
               $('.choices__inner').css('border-radius', '15px')
            // Create a new date object
            var date = new Date();
        
            // Get the month (0-11, where 0 is January and 11 is December)
            var month = date.getMonth();
        
            // Array of month names
            var monthNames = [
              "January", "February", "March", "April", "May", "June",
              "July", "August", "September", "October", "November", "December"
            ];
        
            // Get the name of the current month
            var monthName = monthNames[month];
        
            // Display the month name in the HTML element
            $('#monthDisplay').text(monthName);
          });
       </script>
    <script>
            $(document).ready(function() {
               var startYear = 1900;
                var endYear = new Date().getFullYear();
                var select = $('#yearSelect');
                select.append('<option value="">Select Year</option>');
                for (var year = startYear; year <= endYear; year++) {
                    select.append('<option value="' + year + '">' + year + '</option>');
                }
    
                // Set the default selected year (optional)
                // select.val(endYear);
    
                // Handle the change event
                select.change(function(){
                    var selectedYear = $(this).val();
                    console.log('Selected Year:', selectedYear);
                });
            });
        </script>
    <script>
        $(document).ready(function() {
            $("#filter").click(function() {
                $("#show_filter").toggle();
            });
        });
    </script>
     <script>
        $(document).ready(function() {
             $("#income-select").on("click",function(){
                $('#income-expense').removeClass('d-none');
                $('#generated-report').addClass('d-none');
                $('#transaction-expense').addClass('d-none');
                $('#customer-expense').addClass('d-none');
                // $('#item').addClass('d-none');
                // $('#customer').addClass('d-none');
            });
            $("#transaction-select").on("click",function(){
                $('#income-expense').addClass('d-none');
                $('#generated-report').addClass('d-none');
                $('#customer-expense').addClass('d-none');
                $('#transaction-expense').removeClass('d-none');
                //  $('#item').addClass('d-none');
                // $('#customer').addClass('d-none');
                
            });
            $("#customer-select").on("click",function(){
                $('#income-expense').addClass('d-none');
                $('#generated-report').addClass('d-none');
                $('#transaction-expense').addClass('d-none');
                $('#customer-expense').removeClass('d-none');
                // $('#item').addClass('d-none');
                // $('#customer').addClass('d-none');
                
            });
            $("#customer-report").on("click",function(){
                $('#income-expense').addClass('d-none');
                $('#generated-report').removeClass('d-none');
                $('#transaction-expense').addClass('d-none');
                $('#customer-expense').addClass('d-none');
                // $('#item').addClass('d-none');
                // $('#customer').removeClass('d-none');
                
            });
               $("#product-report").on("click",function(){
                $('#income-expense').addClass('d-none');
                $('#generated-report').removeClass('d-none');
                $('#transaction-expense').addClass('d-none');
                $('#customer-expense').addClass('d-none');
                // $('#item').removeClass('d-none');
                // $('#customer').addClass('d-none');
                
            });
        });

        document.querySelector('#show-div1 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('Vendor-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('purchase-main');
   
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
    
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

});
    document.querySelector('#return-button1').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    console.log("dslkfsdlkf")

    var targetDiv = document.getElementById('Vendor-list');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('purchase-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
});

document.querySelector('#show-div2 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('order-request-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('purchase-main');
   
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
    
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

});
    document.querySelector('#return-button2').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    console.log("dslkfsdlkf")

    var targetDiv = document.getElementById('order-request-list');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('purchase-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
});

document.querySelector('#show-div3 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('purchase-order-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('purchase-main');
   
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
    
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

});
    document.querySelector('#return-button3').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    console.log("dslkfsdlkf")

    var targetDiv = document.getElementById('purchase-order-list');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('purchase-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
});

document.querySelector('#show-div4 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('return-order-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('purchase-main');
   
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
    
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

});
    document.querySelector('#return-button4').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    console.log("dslkfsdlkf")

    var targetDiv = document.getElementById('return-order-list');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('purchase-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
});

        
    </script>
    <script>
        $(document).ready(function() {
            callback();
            function callback() {
                var start_date = $(".startDate").val();
                var end_date = $(".endDate").val();

                $('.start_date').val(start_date);
                $('.end_date').val(end_date);
            }
        });

    </script>

<script>
        $(document).ready(function() {
            var id1 = $('.nav-item .active').attr('href');
            $('.report').val(id1);

            $("ul.nav-pills > li > a").click(function() {
                var report = $(this).attr('href');
                $('.report').val(report);
            });
        });

    </script>

@endpush

@section('action-btn')
@php
 $monthNames = ["Select Month",
              "January", "February", "March", "April", "May", "June",
              "July", "August", "September", "October", "November", "December"
            ];
@endphp
    <div class="float-end">
        <a href="#" onclick="saveAsPDF()" class="btn btn-sm btn-primary me-1" data-bs-toggle="tooltip"
            title="{{ __('Print') }}" data-original-title="{{ __('Print') }}"><i class="ti ti-printer"></i></a>
    </div>

    <div class="float-end me-2">
        {{ Form::open(['route' => ['sales.export']]) }}
        <input type="hidden" name="start_date" class="start_date">
        <input type="hidden" name="end_date" class="end_date">
        <input type="hidden" name="report" class="report">
        <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="{{ __('Export') }}"
            data-original-title="{{ __('Export') }}"><i class="ti ti-file-export"></i></button>
        {{ Form::close() }}
    </div>

    <div class="float-end me-2" id="filter">
        <button id="filter" class="btn btn-sm btn-primary"><i class="ti ti-filter"></i></button>
    </div>

@endsection

@section('content')
   {{-- <div class="mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mt-2" id="multiCollapseExample1">
                    <div class="card" id="show_filter" style="display:none;">
                        <div class="card-body">
                            {{ Form::open(['route' => ['report.sales'], 'method' => 'GET', 'id' => 'report_sales']) }}
                            <div class="row align-items-center justify-content-end">
                                <div class="col-xl-10">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                            <div class="btn-box">
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                            <div class="btn-box">
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                            <div class="btn-box">
                                                {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                                                {{ Form::date('start_date', $filter['startDateRange'], ['class' => 'startDate form-control']) }}
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                            <div class="btn-box">
                                                {{ Form::label('end_date', __('End Date'), ['class' => 'form-label']) }}
                                                {{ Form::date('end_date', $filter['endDateRange'], ['class' => 'endDate form-control']) }}
                                            </div>
                                        </div>
                                        <input type="hidden" name="view" value="horizontal">
                                    </div>
                                </div>
                                <div class="col-auto mt-4">
                                    <div class="row">
                                        <div class="col-auto">
                                            <a href="#" class="btn btn-sm btn-primary"
                                                onclick="document.getElementById('report_sales').submit(); return false;"
                                                data-bs-toggle="tooltip" title="{{ __('Apply') }}"
                                                data-original-title="{{ __('apply') }}">
                                                <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                            </a>

                                            <a href="{{ route('report.sales') }}" class="btn btn-sm btn-danger "
                                                data-bs-toggle="tooltip" title="{{ __('Reset') }}"
                                                data-original-title="{{ __('Reset') }}">
                                                <span class="btn-inner--icon"><i
                                                        class="ti ti-trash-off text-white-off "></i></span>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

        @php
            $authUser = \Auth::user()->creatorId();
            $user = App\Models\User::find($authUser);
        @endphp

    </div>--}}

    <div class="row " id="purchase-main">
         <div class="row" style="margin:-2px;">
                  
                    {{--<div class="col-sm-2 form-group">
                         <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('quotation_filter').submit(); return false;" data-bs-toggle="tooltip" title="" data-original-title="apply" data-bs-original-title="Apply" style="padding: 10px 15px 10px 15px;float: inline-end;">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                            </a>
                        <span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-primary text-primary form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='var(--color-customColor)';'"></span>
                      
                   </div>--}}

                 
                    <div class="col-sm-3 form-group" style="position: relative;">
                         {{Form::label('period',__('From Date'))}}
                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon" style="position: absolute; right: 26px; top: 60%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                       
                    <div class="col-sm-3 form-group" style="position: relative;">
                         {{Form::label('period',__('To Date'))}}
                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepickerTo" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon1" style="position: absolute; right: 26px; top: 60%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                   
                    <div class="col-sm-3 form-group">
                      {{Form::label('period',__('Period'))}}
                      <select class="form-control text-primary" id="monthSelect" style="border-radius: 15px;">
                      <option value="">Select Month</option>
                      <option value="January">January</option>
                      <option value="February">February</option>
                      <option value="March">March</option>
                      <option value="April">April</option>
                      <option value="May">May</option>
                      <option value="June">June</option>
                      <option value="July">July</option>
                      <option value="August">August</option>
                      <option value="September">September</option>
                      <option value="October">October</option>
                      <option value="November">November</option>
                      <option value="December">December</option>
                       </select>
                   </div>
                    <div class="col-sm-3 form-group">
                         {{Form::label('period',__('Period'))}}
                         <select class="form-control text-primary" id="yearSelect" style="border-radius: 15px;">Select Year</select>

                   </div> 
                  
                  
            </div>
        <!--Sales Report    -->
        <div class="col-12"  >
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 form-group " id="show-div1">
                            
                         <a href="#Vendor-list" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;--bs-btn-color: unset;">
                            Vendor's
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div2">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Order Request
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div3">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Purchase Orders
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div4">
                         <a id="payment-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Return Orders
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                       
                       
                    </div>
                </div>

            </div>
       
                    </div>
                    </div>
             
            <div id="Vendor-list" style="display:none;" >    
            <div class="row">
<!--<div class="preload"><img src="http://i.imgur.com/KUJoe.gif"></div>-->
            <div class="card">
            <div class="card-header">
            <h4>  <image id="return-button1" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                  Vendor's List</h4>
                </div>
         {{ Form::open(array('url' => 'customer/search', 'id' => 'customer_filter')) }}
               <div class="row"   style="margin-top: 70px;padding: 0px 10px 0px 10px;">
                  
                    <div class="col-sm-1 form-group">
                       <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('customer_filter').submit(); return false;" data-bs-toggle="tooltip" title="" data-original-title="apply" data-bs-original-title="Apply" style="padding: 8px 20px 8px 20px;">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                      
                   </div>
                   
                         <div class="col-sm-2 form-group" style="position: relative;">
    <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="border-radius: 15px; padding-right: 30px;x;font-weight: bold;color:var(--color-customColor)">
    <i class="bx bx-calendar text-primary" id="calendar_icon" style="position: absolute; right: 26px; top: 50%; transform: translateY(-50%);cursor:pointer"></i>
</div>
                   
                
                  
                    <div class="col-sm-3 form-group">
                       {{ Form::select('products', $products,'null', array('class' => 'form-control select2', 'id'=>'choices-multiple2')) }}
                   </div> 
                   <div class="col-sm-3 form-group" >
                       {{ Form::select('state_id', $states,null, array('class' => 'form-control select2 state-select','id'=>'choices-multiple5')) }}
                   </div>
                   <div class="col-sm-3 form-group" >
                       {{ Form::select('city_id',[],null, array('class' => 'form-control select2 choices__inner','id'=>'choices-multiple4', 'readonly', 'placeholder'=> 'City', 'style'=>'height: 45px;')) }}
                   </div>
                  
                
                   
                   
                  
            
            
             
                
                     <div class="col-sm-3 form-group">
                       
                   </div>
            
             {{Form::close()}}             

        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h5>Recent Search</h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark rounded-5 border">
                                <tr>
                                    <th style="border-top-left-radius: 30px;border-bottom-left-radius: 30px;">{{_('Sr.')}}</th>
                                    <th>{{ __('Vendor Name') }}</th>
                                    <th>{{ __('Quotation Date') }}</th>
                                    <th>{{ __('Prepared By') }}</th>
                                  
                                    <th>{{ __('Status') }}</th>
                                    <th style="border-top-right-radius: 30px;border-bottom-right-radius: 30px;">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($venders as $k => $Vender)
                                    <tr class="cust_tr" id="vend_detail">
                                       
                                        <td>
                                           {{-- @can('show vender')
                                                <a href="{{ route('vender.show', \Crypt::encrypt($Vender['id'])) }}" class="btn btn-outline-primary">
                                                    {{ AUth::user()->venderNumberFormat($Vender['vender_id']) }}
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-outline-primary"> {{ AUth::user()->venderNumberFormat($Vender['vender_id']) }}
                                                </a>
                                            @endcan --}}
                                             <div class="number-color" style="font-size:12px;background-color: {{ $Vender['status'] =='Waiting'?'#BFBBBB':(($Vender['status'] =='Approved')?'#28941F':'#EA4E44')}}">
                                                  {{ $Vender['vender_id'] }}</div> 
                                        </td>
                                        <td>{{ $Vender['name'] }}</td>
                                         <td>{{ \Carbon\Carbon::parse($Vender['created_at'])->format('d/m/Y') }}</td>
                                        <td>{{ $Vender->createdBy->name }}</td>
                                      
                                        <td>{{ $Vender['status'] }}</td>
                                        <td class="Action">
                                            <span>
                                                    @if ($Vender['is_active'] == 0)
                                                        <i class="fa fa-lock" title="Inactive"></i>
                                                    @else
                                                        @can('show vender')
                                                            <div class="action-btn bg-light ms-2">
                                                                <a href="{{ route('vender.show', \Crypt::encrypt($Vender['id'])) }}"
                                                                    class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip"
                                                                    title="{{ __('View') }}">
                                                                    <i class="ti ti-eye text-dark"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('edit vender')
                                                            <div class="action-btn bg-light ms-2">
                                                                <a href="{{ route('vender.edit', $Vender['id']) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" data-original-title="{{ __('Edit') }}">
                                                                    <i class="ti ti-pencil text-dark"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        {{--@can('delete vender')
                                                            <div class="action-btn bg-light ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['vender.destroy', $Vender['id']], 'id' => 'delete-form-' . $Vender['id']]) !!}
                                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip"
                                                                           data-original-title="{{ __('Delete') }}" title="{{ __('Delete') }}"
                                                                           data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                                           data-confirm-yes="document.getElementById('delete-form-{{ $Vender['id'] }}').submit();">
                                                                        <i class="ti ti-trash text-white text-dark"></i>
                                                                    </a>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        @endcan --}}
                                                @endif
                                            </span>
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
                                                        </div>
                                                        </div>
                                                        <div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        
                                                       

<!-- Order Request-->

        <div id="order-request-list"  style="display:none;">    
            <div class="row">
<!--<div class="preload"><img src="http://i.imgur.com/KUJoe.gif"></div>-->
            <div class="card">
            <div class="card-header">
            <h4>  <image id="return-button2" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                  Order Request</h4>
                </div>
                {{ Form::open(array('url' => 'order/request/search','method'=> 'GET', 'id'=> 'order_request_filter')) }}
                <div class="row pt-5">
               
                <div class="col-sm-1 form-group">
                        <span class="" style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-primary text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='';" onclick="document.getElementById('order_request_filter').submit(); return false;"></span>
                      
                   </div>
                <input type="hidden" id="daterange">   
                <div class="col-sm-3 form-group">
                        <input type="text" class="form-control" name="date" value="{{$date}}" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" style="height: 45px;" id="date-range">
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                <div class="col-sm-2 form-group">
                    <select class="form-control select" name="created_by">
                           <option value="">Prepared By</option>
                           @foreach($emp as $e)
                          
                           <option value="{{$e->id}}" {{Request::get('created_by') == $e->id?'selected':''}}>{{$e->name}} </option>
                          @endforeach
                           </select>
                      
                   </div>

                   <div class="col-sm-2 form-group">
                        <select class="form-control select" name="approved_by">
                           <option value="">Approved By</option>
                           @foreach($users as $u)
                          
                          {{-- <option value="{{$u->id}}" {{Request::get('approved_by') == $u->id?'selected':''}}>{{$u->name}} </option>--}}     
                          @endforeach
                           </select>
                       
                   </div>

                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="status">
                           <option value="">Status</option>
                           <option value="Draft" {{Request::get('status')== 'Draft'?'selected':''}}>Draft </option>
                           <option value="Waiting for Approval" {{Request::get('status')== 'Waiting for Approval'?'selected':''}}>Waiting for Approval</option>
                           <option value="Approved" {{Request::get('status')== 'Approved'?'selected':''}}>Approved</option>
                           <option value="Send" {{Request::get('status')== 'Send'?'selected':''}}>Send</option>

                           </select>
                   </div>

                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority">
                           <option value="">Priority</option>
                           <option value="Low" {{Request::get('priority')== 'Low'?'selected':''}}>Low </option>
                           <option value="Medium" {{Request::get('priority')== 'Medium'?'selected':''}}>Medium</option>
                           <option value="High" {{Request::get('priority')== 'High'?'selected':''}}>High</option>
                           <option value="Immidiate" {{Request::get('priority')== 'Immidiate'?'selected':''}}>Immidiate</option>

                           </select>
                   </div>
                </div>
                 {{Form::close()}}            

        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h5>Recent Search</h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive" >
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                            <th style="border-top-left-radius: 30px; border-bottom-left-radius: 30px;"> {{__('Sr.')}}</th>
                                <th> {{__('Equipments Name')}}</th>
                                <th class="px-3"> {{__('Request Date')}}</th>
                                <th> {{__('Prepared by')}}</th>
                                <th> {{__('Approved by')}}</th>
                                <th>{{__('Order Priority')}}</th>
                                <th>{{__('Order Status')}}</th>
                                
                                @if(Gate::check('edit purchase') || Gate::check('delete purchase') || Gate::check('show purchase'))
                                    <th style="border-top-right-radius: 30px;border-bottom-right-radius: 30px;" > {{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>


                            @foreach ($orders as $key => $order)

                                <tr>
                                    <td class="Id">
                                         <div class="px-4 py-3 " style="border-radius: 10px 0px 0px 10px; font-size:12px;background-color: {{  $order->status =='Waiting for Approval'?'#ff5000':(($order->status =='Approved')?'#6fd943':(($order->status =='Recieved')?'#6610f2':(($order->status =='Draft')?'#C9BABA':'#ffa21d')))}}">
                                                  {{ ($key + 1) }}</div> 
                                      
                                    </td>

                                  
                                     <td>{{$order->material->material_name}}</td>
                                    <td>{{$order->created_date}}</td>
                                    <td>{{$order->createdBy->name}}</td>
                                  
                                    <td>{{$order->approvedBy != ''?$order->approvedBy->name:$order->createdBy->name}}</td>
                                    <td>{{$order->priority}}</td>
                                    <td>{{$order->status}}</td>




                                    @if(Gate::check('edit purchase') || Gate::check('delete purchase') || Gate::check('show purchase'))
                                        <td class="Action">
                                            <span>

                                                @can('show purchase')
                                                    <div class="action-btn bg-info ms-2">
                                                            <a href="{{ route('order.show',\Crypt::encrypt($order->id)) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Show')}}" data-original-title="{{__('Detail')}}">
                                                                <i class="ti ti-eye text-white"></i>
                                                            </a>
                                                        </div>
                                                @endcan
                                                @can('edit purchase')
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="{{ route('order.edit',\Crypt::encrypt($order->id)) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="Edit" data-original-title="{{__('Edit')}}">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                @endcan
                                                @can('delete purchase')
                                                    <div class="action-btn bg-danger ms-2">
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['order.destroy', $order->id],'class'=>'delete-form-btn','id'=>'delete-form-'.$order->id]) !!}
                                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$order->id}}').submit();">
                                                            <i class="ti ti-trash text-white"></i>
                                                        </a>
                                                        {!! Form::close() !!}
                                                    </div>
                                                @endcan
                                            </span>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>


        <!-- Purchase order-->

        <div id="purchase-order-list" style="display:none;">    
            <div class="row">
<!--<div class="preload"><img src="http://i.imgur.com/KUJoe.gif"></div>-->
            <div class="card">
            <div class="card-header">
            <h4>  <image id="return-button3" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                Purchase  Order</h4>
                </div>
                {{ Form::open(array('url' => 'order/request/search','method'=> 'GET', 'id'=> 'order_request_filter')) }}
                <div class="row pt-5">
               
                <div class="col-sm-1 form-group">
                        <span class="" style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-primary text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='';" onclick="document.getElementById('order_request_filter').submit(); return false;"></span>
                      
                   </div>
                <input type="hidden" id="daterange">   
                <div class="col-sm-3 form-group">
                        <input type="text" class="form-control" name="date" value="{{$date}}" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" style="height: 45px;" id="date-range">
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                <div class="col-sm-2 form-group">
                    <select class="form-control select" name="created_by">
                           <option value="">Prepared By</option>
                           @foreach($emp as $e)
                          
                           <option value="{{$e->id}}" {{Request::get('created_by') == $e->id?'selected':''}}>{{$e->name}} </option>
                          @endforeach
                           </select>
                      
                   </div>

                   <div class="col-sm-2 form-group">
                        <select class="form-control select" name="approved_by">
                           <option value="">Approved By</option>
                           @foreach($users as $u)
                          
                          {{-- <option value="{{$u->id}}" {{Request::get('approved_by') == $u->id?'selected':''}}>{{$u->name}} </option>--}}     
                          @endforeach
                           </select>
                       
                   </div>

                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="status">
                           <option value="">Status</option>
                           <option value="Draft" {{Request::get('status')== 'Draft'?'selected':''}}>Draft </option>
                           <option value="Waiting for Approval" {{Request::get('status')== 'Waiting for Approval'?'selected':''}}>Waiting for Approval</option>
                           <option value="Approved" {{Request::get('status')== 'Approved'?'selected':''}}>Approved</option>
                           <option value="Send" {{Request::get('status')== 'Send'?'selected':''}}>Send</option>

                           </select>
                   </div>

                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority">
                           <option value="">Priority</option>
                           <option value="Low" {{Request::get('priority')== 'Low'?'selected':''}}>Low </option>
                           <option value="Medium" {{Request::get('priority')== 'Medium'?'selected':''}}>Medium</option>
                           <option value="High" {{Request::get('priority')== 'High'?'selected':''}}>High</option>
                           <option value="Immidiate" {{Request::get('priority')== 'Immidiate'?'selected':''}}>Immidiate</option>

                           </select>
                   </div>
                </div>
                 {{Form::close()}}            

        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h5>Recent Search</h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive" >
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                            <th style="border-top-left-radius: 30px; border-bottom-left-radius: 30px;"> {{__('Sr.')}}</th>
                                <th> {{__('Equipments Name')}}</th>
                                <th class="px-3"> {{__('Request Date')}}</th>
                                <th> {{__('Prepared by')}}</th>
                                <th> {{__('Approved by')}}</th>
                                <th>{{__('Order Priority')}}</th>
                                <th>{{__('Order Status')}}</th>
                                
                                @if(Gate::check('edit purchase') || Gate::check('delete purchase') || Gate::check('show purchase'))
                                    <th style="border-top-right-radius: 30px;border-bottom-right-radius: 30px;" > {{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>


                            @foreach ($orders as $key => $order)

                                <tr>
                                    <td class="Id">
                                         <div class="px-4 py-3 " style="border-radius: 10px 0px 0px 10px; font-size:12px;background-color: {{  $order->status =='Waiting for Approval'?'#ff5000':(($order->status =='Approved')?'#6fd943':(($order->status =='Recieved')?'#6610f2':(($order->status =='Draft')?'#C9BABA':'#ffa21d')))}}">
                                                  {{ ($key + 1) }}</div> 
                                      
                                    </td>

                                  
                                     <td>{{$order->material->material_name}}</td>
                                    <td>{{$order->created_date}}</td>
                                    <td>{{$order->createdBy->name}}</td>
                                  
                                    <td>{{$order->approvedBy != ''?$order->approvedBy->name:$order->createdBy->name}}</td>
                                    <td>{{$order->priority}}</td>
                                    <td>{{$order->status}}</td>




                                    @if(Gate::check('edit purchase') || Gate::check('delete purchase') || Gate::check('show purchase'))
                                        <td class="Action">
                                            <span>

                                                @can('show purchase')
                                                    <div class="action-btn bg-info ms-2">
                                                            <a href="{{ route('order.show',\Crypt::encrypt($order->id)) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Show')}}" data-original-title="{{__('Detail')}}">
                                                                <i class="ti ti-eye text-white"></i>
                                                            </a>
                                                        </div>
                                                @endcan
                                                @can('edit purchase')
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="{{ route('order.edit',\Crypt::encrypt($order->id)) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="Edit" data-original-title="{{__('Edit')}}">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                @endcan
                                                @can('delete purchase')
                                                    <div class="action-btn bg-danger ms-2">
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['order.destroy', $order->id],'class'=>'delete-form-btn','id'=>'delete-form-'.$order->id]) !!}
                                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$order->id}}').submit();">
                                                            <i class="ti ti-trash text-white"></i>
                                                        </a>
                                                        {!! Form::close() !!}
                                                    </div>
                                                @endcan
                                            </span>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>


         <!-- Return order-->

         <div id="return-order-list" style="display:none;">    
            <div class="row">
<!--<div class="preload"><img src="http://i.imgur.com/KUJoe.gif"></div>-->
            <div class="card">
            <div class="card-header">
            <h4>  <image id="return-button4" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                Return  Order</h4>
                </div>
                {{ Form::open(array('url' => 'order/request/search','method'=> 'GET', 'id'=> 'order_request_filter')) }}
                <div class="row pt-5">
               
                <div class="col-sm-1 form-group">
                        <span class="" style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-primary text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='';" onclick="document.getElementById('order_request_filter').submit(); return false;"></span>
                      
                   </div>
                <input type="hidden" id="daterange">   
                <div class="col-sm-3 form-group">
                        <input type="text" class="form-control" name="date" value="{{$date}}" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" style="height: 45px;" id="date-range">
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                <div class="col-sm-2 form-group">
                    <select class="form-control select" name="created_by">
                           <option value="">Prepared By</option>
                           @foreach($emp as $e)
                          
                           <option value="{{$e->id}}" {{Request::get('created_by') == $e->id?'selected':''}}>{{$e->name}} </option>
                          @endforeach
                           </select>
                      
                   </div>

                   <div class="col-sm-2 form-group">
                        <select class="form-control select" name="approved_by">
                           <option value="">Approved By</option>
                           @foreach($users as $u)
                          
                          {{-- <option value="{{$u->id}}" {{Request::get('approved_by') == $u->id?'selected':''}}>{{$u->name}} </option>--}}     
                          @endforeach
                           </select>
                       
                   </div>

                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="status">
                           <option value="">Status</option>
                           <option value="Draft" {{Request::get('status')== 'Draft'?'selected':''}}>Draft </option>
                           <option value="Waiting for Approval" {{Request::get('status')== 'Waiting for Approval'?'selected':''}}>Waiting for Approval</option>
                           <option value="Approved" {{Request::get('status')== 'Approved'?'selected':''}}>Approved</option>
                           <option value="Send" {{Request::get('status')== 'Send'?'selected':''}}>Send</option>

                           </select>
                   </div>

                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority">
                           <option value="">Priority</option>
                           <option value="Low" {{Request::get('priority')== 'Low'?'selected':''}}>Low </option>
                           <option value="Medium" {{Request::get('priority')== 'Medium'?'selected':''}}>Medium</option>
                           <option value="High" {{Request::get('priority')== 'High'?'selected':''}}>High</option>
                           <option value="Immidiate" {{Request::get('priority')== 'Immidiate'?'selected':''}}>Immidiate</option>

                           </select>
                   </div>
                </div>
                 {{Form::close()}}            

        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h5>Recent Search</h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive" >
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                            <th style="border-top-left-radius: 30px; border-bottom-left-radius: 30px;"> {{__('Sr.')}}</th>
                                <th> {{__('Equipments Name')}}</th>
                                <th class="px-3"> {{__('Request Date')}}</th>
                                <th> {{__('Prepared by')}}</th>
                                <th> {{__('Approved by')}}</th>
                                <th>{{__('Order Priority')}}</th>
                                <th>{{__('Order Status')}}</th>
                                
                                @if(Gate::check('edit purchase') || Gate::check('delete purchase') || Gate::check('show purchase'))
                                    <th style="border-top-right-radius: 30px;border-bottom-right-radius: 30px;" > {{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>


                            @foreach ($orders as $key => $order)

                                <tr>
                                    <td class="Id">
                                         <div class="px-4 py-3 " style="border-radius: 10px 0px 0px 10px; font-size:12px;background-color: {{  $order->status =='Waiting for Approval'?'#ff5000':(($order->status =='Approved')?'#6fd943':(($order->status =='Recieved')?'#6610f2':(($order->status =='Draft')?'#C9BABA':'#ffa21d')))}}">
                                                  {{ ($key + 1) }}</div> 
                                      
                                    </td>

                                  
                                     <td>{{$order->material->material_name}}</td>
                                    <td>{{$order->created_date}}</td>
                                    <td>{{$order->createdBy->name}}</td>
                                  
                                    <td>{{$order->approvedBy != ''?$order->approvedBy->name:$order->createdBy->name}}</td>
                                    <td>{{$order->priority}}</td>
                                    <td>{{$order->status}}</td>




                                    @if(Gate::check('edit purchase') || Gate::check('delete purchase') || Gate::check('show purchase'))
                                        <td class="Action">
                                            <span>

                                                @can('show purchase')
                                                    <div class="action-btn bg-info ms-2">
                                                            <a href="{{ route('order.show',\Crypt::encrypt($order->id)) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Show')}}" data-original-title="{{__('Detail')}}">
                                                                <i class="ti ti-eye text-white"></i>
                                                            </a>
                                                        </div>
                                                @endcan
                                                @can('edit purchase')
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="{{ route('order.edit',\Crypt::encrypt($order->id)) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="Edit" data-original-title="{{__('Edit')}}">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                @endcan
                                                @can('delete purchase')
                                                    <div class="action-btn bg-danger ms-2">
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['order.destroy', $order->id],'class'=>'delete-form-btn','id'=>'delete-form-'.$order->id]) !!}
                                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$order->id}}').submit();">
                                                            <i class="ti ti-trash text-white"></i>
                                                        </a>
                                                        {!! Form::close() !!}
                                                    </div>
                                                @endcan
                                            </span>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>






            


                       
                    </div>
                </div>

            </div>
        </div>
        <!--End seles report-->
       
<!--Vendor report-->

                </div>

            </div>
        </div>

        

        </div>


        
    </div>
    



@endsection
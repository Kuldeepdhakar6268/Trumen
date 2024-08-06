@extends('layouts.admin')
@section('page-title')
    {{ __('Finance Report') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Finance Report') }}</li>
@endsection

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

    <div class="row">
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
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            
                         <a href="{{ route('report.lead') }}" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;--bs-btn-color: unset;">
                            Customer
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Vendor
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Miscellaneous Operation
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="payment-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Bank
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 

                        <div class="col-sm-4 form-group">
                         <a id="payment-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Cash
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 

                        <div class="col-sm-4 form-group">
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
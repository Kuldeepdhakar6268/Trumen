@extends('layouts.admin')
@section('page-title')
    {{__('Manage Lead')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Lead Report')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        <a href="#" class="btn btn-sm btn-primary" onclick="saveAsPDF()"data-bs-toggle="tooltip" title="{{__('Download')}}" data-original-title="{{__('Download')}}">
            <span class="btn-inner--icon"><i class="ti ti-download"></i></span>
        </a>
    </div>
@endsection

@section('content')
    <div class="row" id="printableArea">
        <div class="col-sm-12">
            <input type="hidden" value="{{__('Lead Report')}}" id="filename">
             <div class="row">
                 <div class="col-xl-8">
                   
                </div>
                <div class="col-xl-4">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                           
                            <a class="list-group-item list-group-item-action border-0 text-center text-light d-none" style="background-color: #89AB41;
    border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;" id="generalTab"><i class="ti ti-arrows-right-left"></i> {{ __('Switch to General Report') }}
                                <div class="float-end"></div></a>
                           <a class="list-group-item py-2  list-group-item-action border-0 text-start text-light" style="background-color: #89AB41;
    border-top-left-radius: 10px;border-top-right-radius: 10px;" id="staffTab"><i class="ti ti-arrows-right-left"></i> {{ __('Switch to Staff Report') }}
                                <div class="float-end"></div></a>
                        </div>
                    </div>
                </div>
                </div>
            <div class="row">
               

                <div class="col-xl-12">
                    <div id="general-report">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ __('This Week Leads Conversions ') }}</h5>
                                <h5>{{ __('This Week Leads Conversions ') }}</h5>
                            </div>
                            <div class="card-body"  style="display:inline;height:100px;">
                                <div id="leads-this-week"
                                     data-color="primary"   data-height="480">
                                </div>

                                

                                
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ __('Sources Conversion') }}</h5>
                            </div>
                            <div class="card-body pt-0">
                                <div class="leads-sources-report" id="leads-sources-report"
                                     data-color="primary" data-height="280">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-9">
                                        <h5>{{ __('Monthly') }}</h5>
                                    </div>
                                    <div class="col-3 float-right">
                                        <select name="month" class="form-control selectpicker" id="selectmonth" data-none-selected-text="Nothing selected" >
                                            <option value=" ">{{__('Select Month')}}</option>
                                            <option value="1">{{__('January')}}</option>
                                            <option value="2">{{__('February')}}</option>
                                            <option value="3">{{__('March')}}</option>
                                            <option value="4">{{__('April')}}</option>
                                            <option value="5">{{__('May')}}</option>
                                            <option value="6">{{__('June')}}</option>
                                            <option value="7">{{__('July')}}</option>
                                            <option value="8">{{__('August')}}</option>
                                            <option value="9">{{__('September')}}</option>
                                            <option value="10">{{__('October')}}</option>
                                            <option value="11">{{__('November')}}</option>
                                            <option value="12">{{__('December')}}</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="card-body">

                                <div class="mt-3">
                                    <div id="leads-monthly" data-color="primary" data-height="280"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="staff-report" class="card d-none">
                        <div class="card-header">
                            <h5>{{ __('Staff Report') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    {{ Form::label('From Date', __('From Date'),['class'=>'col-form-label']) }}
                                    {{ Form::date('From Date',null, array('class' => 'form-control from_date','id'=>'data_picker1',)) }}
                                    <span id="fromDate" style="color: red;"></span>
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('To Date', __('To Date'),['class'=>'col-form-label']) }}
                                    {{ Form::date('To Date',null, array('class' => 'form-control to_date','id'=>'data_picker2',)) }}
                                    <span id="toDate"  style="color: red;"></span>
                                </div>
                                <div class="col-md-4" id="filter_type" style="padding-top : 38px;">
                                    <button  class="btn btn-primary label-margin generate_button" >{{__('Generate')}}</button>
                                </div>
                            </div>
                            <div id="leads-staff-report" class="mt-3"
                                 data-color="primary" data-height="280">
                            </div>
                        </div>
                    </div>
                   {{-- <div id="pipeline-report" class="card">
                        <div class="card-header">
                            <h5>{{ __('Pipeline Report') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div id="leads-piplines-report"
                                     data-color="primary" data-height="280"></div>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-page')
    <script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    <script>
        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A2'}
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>

    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        })
        // $(".list-group-item").click(function(){
        //     $('.list-group-item').filter(function(){
        //         return this.href == id;
        //     }).parent().removeClass('text-primary');
        // });

        function check_theme(color_val) {
            $('#theme_color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
        }
    </script>

    <script>

        $(".generate_button").click(function(){
            var from_date = $('.from_date').val();
            if(from_date == ''){
                $("#fromDate").text("Please select date");
            }else{
                $("#fromDate").empty();
            }
            var to_date = $('.to_date').val();
            if(to_date == ''){
                $("#toDate").text("Please select date");
            }else{
                $("#toDate").empty();
            }
            $.ajax({
                url: "{{ route('report.lead') }}",
                type: "get",
                data: {
                    "From_Date": from_date,
                    "To_Date": to_date,
                    "type": 'staff_repport',
                    "_token": "{{ csrf_token() }}",
                },

                cache: false,
                success: function(data) {

                    $("#leads-staff-report").empty();
                    var chartBarOptions = {
                        series: [{
                            name: 'Lead',
                            data: data.data,
                        }],

                        chart: {
                            height: 300,
                            type: 'bar',
                            dropShadow: {
                                enabled: true,
                                color: '#000',
                                top: 18,
                                left: 7,
                                blur: 10,
                                opacity: 0.2
                            },
                            toolbar: {
                                show: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            width: 2,
                            curve: 'smooth'
                        },
                        title: {
                            text: '',
                            align: 'left'
                        },
                        xaxis: {
                            categories: data.name,


                        },
                        colors: ['#6fd944', '#6fd944'],


                        grid: {
                            strokeDashArray: 4,
                        },
                        legend: {
                            show: false,
                        }

                    };
                    var arChart = new ApexCharts(document.querySelector("#leads-staff-report"), chartBarOptions);
                    arChart.render();

                }
            })


        });


        $(document).ready(function(){
            $("#selectmonth").change(function(){
                var selectedVal = $("#selectmonth option:selected").val();
                var start_month = $('.selectpicker').val();
                $.ajax({
                    url:  "{{route('report.lead')}}",
                    type: "get",
                    data:{
                        "start_month": start_month,
                        "_token": "{{ csrf_token() }}",
                    },
                    cache: false,
                    success: function(data){

                        $("#leads-monthly").empty();
                        var chartBarOptions = {
                            series: [{
                                name: 'Lead',
                                data: data.data,
                            }],

                            chart: {
                                height: 300,
                                type: 'bar',
                                dropShadow: {
                                    enabled: true,
                                    color: '#000',
                                    top: 18,
                                    left: 7,
                                    blur: 10,
                                    opacity: 0.2
                                },
                                toolbar: {
                                    show: false
                                }
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                width: 2,
                                curve: 'smooth'
                            },
                            title: {
                                text: '',
                                align: 'left'
                            },
                            xaxis: {
                                categories:data.name,

                                title: {
                                    text: '{{ __("Lead Per Month") }}'
                                }
                            },
                            colors: ['#6fd944', '#6fd944'],


                            grid: {
                                strokeDashArray: 4,
                            },
                            legend: {
                                show: false,
                            }

                        };
                        var arChart = new ApexCharts(document.querySelector("#leads-monthly"), chartBarOptions);
                        arChart.render();


                    }
                })
            });
        });

        $(document).on('click', '#generalTab', function() {
            $('#staffTab').removeClass('d-none');
            $('#staff-report').addClass('d-none');
            $(this).addClass('d-none');
            $('#general-report').removeClass('d-none');
        });
        $(document).on('click', '#staffTab', function() {
            $('#generalTab').removeClass('d-none');
            $('#general-report').addClass('d-none');
            $('#staff-report').removeClass('d-none');
            $(this).addClass('d-none');
        });

        $(document).on('click', '.lang-tab .nav-link', function() {
            $('.lang-tab .nav-link').removeClass('active');
            $('.tab-pane').removeClass('active');
            $(this).addClass('active');
            var id = $('.lang-tab .nav-link.active').attr('data-href');
            $(id).addClass('active');
        });
    </script>
    <script src="{{asset('assets/js/plugins/apexcharts.min.js')}}"></script>
    <script>
        var options = {
            series: {!! json_encode($devicearray['data']) !!},
            
            chart: {
                width: 950,
                height:200,
                type: 'pie',
        
                margin:0,
               
            },
            legend: {
                        position: 'top',

                        labels: {
         
          
          useSeriesColors: true,

          
        
      },
      onItemHover: {
      highlightDataSeries: true
    },

    
                
    },

            


            dataLabels: {
    enabled: false
  },

            legend: {

                     
      markers: {
          size: 0,
          shape: undefined,
          strokeWidth: undefined,
          fillColors: undefined,
          customHTML: undefined,
          onClick: undefined,
          
          width:0,
      },

                    
                        position: 'unset',
                        offsetX: 10,
                        offsetY: 0,

                        
                        labels: {
                            useSeriesColors: true, 
                         
                            
      },

      plotOptions: {
        pie: {
            dataLabels: {
                enabled: false // Ensure data labels are hidden
            }
        }
    },

    itemMargin: {
            horizontal: 0, // Horizontal margin between legend items
            vertical: 10 // Vertical margin between legend items
        },
       
        

      

      

      formatter: function(seriesName, opts) {
        var seriesColor = opts.w.config.colors[opts.seriesIndex];
            
            return `<button class="px-3 py-2 btn mx-2 " style="background-color: ${seriesColor}; color: white; border:none;">${seriesName}</button>`;
                },
      onItemHover: {
      highlightDataSeries: true
    },
    onItemClick: {
          toggleDataSeries: true
      },

    

    
                
    },

    

            

            colors: ["#27B9DA","#09A9F3","#C53DA8","#757575","#8D24AA","#E25488","#0088D1"],
            labels: {!! json_encode($devicearray['label']) !!},
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200,
                        height:200,
                        width: 200,
                        height:200,
                    },
                    
                    
                    legend: {
                        position: 'bottom',
        
                        onItemClick: {
      toggleDataSeries: true
    },

    
    onItemHover: {
      highlightDataSeries: true
    },
                    }
                }
            }]
        };
        var chart = new ApexCharts(document.querySelector("#leads-this-week"), options);
        chart.render();

        (function () {
            var chartBarOptions = {
                series: [{
                    name: 'Source',
                    data: {!! json_encode($leadsourceeData) !!},
                }],

                chart: {
                    height: 300,
                    type: 'bar',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false                            
                        show: false                            
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {
                    categories: {!! json_encode($leadsourceName) !!},

                    title: {
                        text: '{{ __("Source") }}'
                    }
                },
                colors: ['#ffa21d', '#ffa21d'],


                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                }

            };
            var arChart = new ApexCharts(document.querySelector("#leads-sources-report"), chartBarOptions);
            arChart.render();
        })();

        (function () {
            var chartBarOptions = {
                series: [{
                    name: 'Lead',
                    data: {!! json_encode($data) !!},
                }],

                chart: {
                    height: 300,
                    type: 'bar',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {
                    categories: {!! json_encode($labels) !!},

                    title: {
                        text: '{{ __("Lead Per Month") }}'
                    }
                },
                colors: ['#6fd944', '#6fd944'],


                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                }

            };
            var arChart = new ApexCharts(document.querySelector("#leads-monthly"), chartBarOptions);
            arChart.render();
        })();

        (function () {
            var chartBarOptions = {
                series: [{
                    name: 'Lead',
                    data: {!! json_encode($leadusereData) !!},
                }],

                chart: {
                    height: 300,
                    type: 'bar',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {
                    categories: {!! json_encode($leaduserName) !!},
                    title: {
                        text: '{{ __("User") }}'
                    }
                },
                colors: ['#6fd944', '#6fd944'],


                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                }

            };
            var arChart = new ApexCharts(document.querySelector("#leads-staff-report"), chartBarOptions);
            arChart.render();
        })();

        (function () {
            var chartBarOptions = {
                series: [{
                    name: 'Pipeline',
                    data: {!! json_encode($leadpipelineeData) !!},
                }],

                chart: {
                    height: 300,
                    type: 'bar',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {
                    categories: {!! json_encode($leadpipelineName) !!},

                    title: {
                        text: '{{ __("Pipelines") }}'
                    }
                },
                yaxis: {
                    title: {
                        text: '{{ __("Leads") }}'
                    }
                },
                colors: ['#6fd944', '#6fd944'],


                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                }

            };
            var arChart = new ApexCharts(document.querySelector("#leads-piplines-report"), chartBarOptions);
            arChart.render();
        })();

    </script>
@endpush


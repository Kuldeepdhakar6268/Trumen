@extends('layouts.admin')
@section('page-title')
    {{ __('Production Report') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Production Report') }}</li>
@endsection

@push('css-page')

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> -->

   <style>
    /* Hide default arrow */
input[type="text"]::-webkit-input-placeholder {
    color: red;
}
.dataTable-table {
    table-layout: auto;
}
.dataTable-table tbody tr td {
        padding: 0px 0px 0px 0px !important;
    }
    .card:not(.table-card) .table tr th:last-child {
 border-top-right-radius: 30px;
 border-bottom-right-radius: 30px; 

}
.card:not(.table-card) .table tr th:first-child {

  border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
}  
.hover-content { 
    display: none; 
} 
 
/* Display the hover content when hovering over the trigger */ 
.hover-trigger:hover + .hover-content { 
    display: block; 
} 
/*.dataTable-table thead>tr>th{*/
/*        padding: 9px 0px 11px 14px !important; */
/*}*/
/*.dataTable-table td:not(:first-child) {*/
/*        padding-left: 10px !important;*/
/*    }*/
    </style>
@endpush

@push('script-page')

    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <!-- Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://hammerjs.github.io/dist/hammer.js"></script>
    <script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
   
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(document).ready(function() {
    // Initialize the datepickers
    $("#min-date, #max-date").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>
    <!-- <script>
        $(document).ready(function () {
            $('#date-range').daterangepicker({
    opens: 'left',
    drops: 'down',
    autoApply: true,
    locale: {
      format: 'YYYY-MM-DD',
      separator: ' To ',
      applyLabel: 'Apply',
      cancelLabel: 'Cancel',
      fromLabel: 'From',
      toLabel: 'To',
      customRangeLabel: 'Custom',
      daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
      monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      firstDay: 0
    }
  });
  $('#date-range').change(function (){
      $(this).val();
      $("#daterange").val($(this).val())
  })
        }); -->
    </script>
    
    <script type="text/javascript">
        $(document).ready(function() {
           
            var table = $('#production-list-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('report.product.list') }}',
                    type: 'GET'
                },
    
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'model' },
                    { data: 'hsn_code' },
                    { data: 'base_price' },
                    { data: 'quantity' },
                    { data: 'ticket_priority' },
                    { data: 'ticket_status' },
                    { data: 'order_status' },
                    { data: 'created_at' },
                    { data: 'action' }
                ],
                    bLengthChange: false,
                    "bDestroy": true,
                   
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copyHtml5',
                            text: '<i class="fa fa-copy"></i>',
                            title: $("#header_title").text(),
                            titleAttr: 'Copy',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel"></i>',
                            titleAttr: 'Excel',
                            title: $("#header_title").text(),
                            margin: [10, 10, 10, 0],
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            },

                        },
                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-file-csv"></i>',
                            titleAttr: 'CSV',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf"></i>',
                            title: $("#header_title").text(),
                            titleAttr: 'PDF',
                            exportOptions: {
                                columns: ':visible',
                                columns: ':not(:last-child)',
                            },
                            pageSize: 'A4',
                            margin: [0, 0, 0, 0],
                            alignment: 'center',
                            header: true,

                        },
                        { 
                            extend: 'print',
                            text: '<i class="fa fa-print"></i>',
                            titleAttr: 'Print',
                            title: $("#header_title").text(),
                            exportOptions: {
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="ti ti-refresh"></i>',
                            titleAttr: 'Refresh',
                            title: $("#refresh-button").button(),
                           
                        }
                    ],
                    columnDefs: [{
                        visible: false
                    }],
                    responsive: true,
});
//custom filter


    // Event listener for the date range inputs to redraw the DataTable on change
    $('#min-date, #max-date').on('change', function() {
        var minDate = $('#min-date').val();
        var maxDate = $('#max-date').val();

        // Use the search() API to apply a custom filter
        table.rows().every(function() {
        var data = this.data();
        console.log(data['id']); // Log data for each row
    });
    table.rows().every(function() {
                var data = this.data();
                var createdAt = data['created_at']; // Adjust to your date column index
                if(minDate != '' && maxDate != ''){
                    if ((createdAt > minDate) && (createdAt < maxDate)) {
                    $(this.node()).show();
                   
                } else {
                    $(this.node()).hide();
                }
                }
                
            });
        });
    $('#priority_id').on('change', function() {
        var priority = $('#priority_id').val();
        var minDate = $('#min-date').val();
        var maxDate = $('#max-date').val();
        // var maxDate = $('#max-date').val();

        // Use the search() API to apply a custom filter
        table.rows().every(function() {
        var data = this.data();
        console.log(data['id']); // Log data for each row
    });
    table.rows().every(function() {
                var data = this.data();
                var priority_val = data['ticket_priority']; // Adjust to your date column index
                var createdAt = data['created_at']; 
                if(priority != ''){
                    if ((priority_val == priority) ) {
                    $(this.node()).show();
                   
                }else if(priority != '' && maxDate != '' && minDate != ''){
                    if ((priority_val == priority && (createdAt > minDate) && (createdAt < maxDate)) ) {
                        $(this.node()).show();
                    }
                }
                 else {
                    $(this.node()).hide();
                }
                }
                
            });
        // table.column(9).search(minDate + '|' + maxDate, true, false).draw(); // Adjust the column index
    });
    $('#refresh-button').on('click', function() {
            table.ajax.reload(); // Reload the data from the server
            });
 });
 $.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        alert("SDfds")
        var minDate = $('#min-date').val();
        var maxDate = $('#max-date').val();
        var createdAt = moment(data[3], 'YYYY-MM-DD'); // Adjust to your date format

        var startDate = minDate ? moment(minDate, 'YYYY-MM-DD') : null;
        var endDate = maxDate ? moment(maxDate, 'YYYY-MM-DD') : null;

        if (
            (startDate && !createdAt.isSameOrAfter(startDate)) ||
            (endDate && !createdAt.isSameOrBefore(endDate))
        ) {
            return false;
        }

        return true;
    }
);
    


 
</script>
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


<script>
     
     document.querySelector('#show-div a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
    var targetDiv = document.getElementById('Production-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none') {
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('production-report-main');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    
});

document.querySelector('#show-div2 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('production-invoice');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('production-report-main');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    
});

document.querySelector('#return-button ').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
    var targetDiv = document.getElementById('production-report-main');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('Production-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none') {
        targetDiv.style.display = 'block';
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }
   
});

document.querySelector('#return-button2').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    console.log("dslkfsdlkf")

    var targetDiv = document.getElementById('production-invoice');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('production-report-main');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    
   
});

document.querySelector('#show-div3 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('production-records');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('production-report-main');
   
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

    var targetDiv = document.getElementById('production-records');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('production-report-main');
    
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
   

    var targetDiv = document.getElementById('product-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('production-report-main');
   
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

    var targetDiv = document.getElementById('product-list');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('production-report-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
});

document.querySelector('#show-div5 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('damage-product-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('production-report-main');
   
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
    
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

});
    document.querySelector('#return-button5').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    console.log("dslkfsdlkf")

    var targetDiv = document.getElementById('damage-product-list');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('production-report-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
});

document.querySelector('#show-div6 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('dead-product-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('production-report-main');
   
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
    
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

});
    document.querySelector('#return-button6').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    console.log("dslkfsdlkf")

    var targetDiv = document.getElementById('dead-product-list');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('production-report-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
});

document.querySelector('#show-div7 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('material-purchase-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('production-report-main');
   
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
    
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

});
    document.querySelector('#return-button7').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    console.log("dslkfsdlkf")

    var targetDiv = document.getElementById('material-purchase-list');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('production-report-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
});

document.querySelector('#show-div8 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('material-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('production-report-main');
   
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
    
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

});
    document.querySelector('#return-button8').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    console.log("dslkfsdlkf")

    var targetDiv = document.getElementById('material-list');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('production-report-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
});

document.querySelector('#show-div9 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('damage-material-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('production-report-main');
   
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
    
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

});
    document.querySelector('#return-button9').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    console.log("dslkfsdlkf")

    var targetDiv = document.getElementById('damage-material-list');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('production-report-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
});

document.querySelector('#show-div10 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('material-purchase-invoice');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('production-report-main');
   
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
    
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

});
    document.querySelector('#return-button10').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    console.log("dslkfsdlkf")

    var targetDiv = document.getElementById('material-purchase-invoice');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('production-report-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
});

document.querySelector('#show-div11 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('dead-material-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('production-report-main');
   
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
    
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

});
    document.querySelector('#return-button11').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    console.log("dslkfsdlkf")

    var targetDiv = document.getElementById('dead-material-list');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('production-report-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
});

document.querySelector('#show-div12 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('material-ledger');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('production-report-main');
   
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
    
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

});
    document.querySelector('#return-button12').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    console.log("dslkfsdlkf")

    var targetDiv = document.getElementById('material-ledger');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('production-report-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
});

document.querySelector('#show-div13 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('material-stock');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('production-report-main');
   
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
    
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

});
    document.querySelector('#return-button13').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    console.log("dslkfsdlkf")

    var targetDiv = document.getElementById('material-stock');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('production-report-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
});

document.querySelector('#show-div14 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('material-purchase-records');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('production-report-main');
   
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
    
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

});
    document.querySelector('#return-button14').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    console.log("dslkfsdlkf")

    var targetDiv = document.getElementById('material-purchase-records');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('production-report-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
});

document.querySelector('#show-div15 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('vendor-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('production-report-main');
   
    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
    
        targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

});
    document.querySelector('#return-button15').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior

    console.log("dslkfsdlkf")

    var targetDiv = document.getElementById('vendor-list');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('production-report-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
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

    <div class="row" id="production-report-main" style="display:block">
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
                <div class="card-header">
                   <h5>Production Reports</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 form-group" >
                            
                        <div id="show-div">
                         <a href="#Production-list"  class="btn  btn-outline-secondary btn-lg text-center" style="width:300px;--bs-btn-color: unset;">
                            Production List
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                    </div>
                        
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div2">
                         <a href="#Production-invoice" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Production Invoice
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div3">
                            
                         <a href="#production-records"   class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Production Records
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div4">
                         <a  id="product list" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Product List
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div5">
                         <a id="proposal-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Damage Product List
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div6">
                         <a id="customer-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Dead Product List
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                    </div>
                </div>

            </div>
              <div class="card">
                <div class="card-header">
                   <h5>Material Reports</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 form-group" id="show-div7">
                        
                         <a id="income-select" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Material Purchase List
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div8">
                        <a id="transaction-select" class="btn btn-outline-secondary btn-lg" style="width:300px;">
                             Material List
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div9">
                          <a id="customer-select" class="btn btn-outline-secondary btn-lg" style="width:300px;">
                            Damage Material List
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                         
                        </div> 

                        <div class="col-sm-4 form-group" id="show-div10">
                        
                         <a id="income-select" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Material Purchase Invoice
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div14">
                        <a id="transaction-select" class="btn btn-outline-secondary btn-lg" style="width:300px;">
                             Material Purchase Records
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div11">
                          <a id="customer-select" class="btn btn-outline-secondary btn-lg" style="width:300px;">
                            Dead Material List
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                         
                        </div> 

                        <div class="col-sm-4 form-group" id="show-div12">
                        
                         <a id="income-select" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Material Ledger
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div13">
                        <a id="transaction-select" class="btn btn-outline-secondary btn-lg" style="width:300px;">
                             Material Stock
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                       


                       
                    </div>
                </div>

            </div>
        </div>
        <!--End seles report-->
       
<!--Vendor report-->
<div class="col-12">
<div class="card ">
                <div class="card-header">
                   <h5>Vendor Reports</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 form-group" id="show-div15">
                        
                         <a id="income-select" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                            Vendor List
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        </div> 
                       
                       


                       
                    </div>
                </div>

            </div>
        </div>

        </div>
    </div>

    <div id="Production-list" style="display:none;">
        <div class="row mx-4 ">
        <div class="card ">
        <div class="card-header d-flex gap-2">
                <image id="return-button" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                <h4></h4>
            </div>
       
               <div class="row py-3">
                  
                  
                   <div class="col-sm-2 form-group">
                   <input type="text" id="min-date" class="form-control text-primary" name="min-date" placeholder="Select Star Date">
                   </div>
                   <div class="col-sm-2 form-group">
                        <input type="text" class="form-control text-primary" id="max-date" name="max-date" placeholder="Select End Date">
                   </div>
                    <div class="col-sm-2 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        {{ Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3', 'style' => 'height: 45px')) }}
                   </div>
                  
                   <div class="col-sm-2 form-group" style="margin-left: -22px;">
                       {{ Form::select('status_id', $orderstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       {{ Form::select('ticket_status_id', $ticketstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority_id" id="priority_id">
                           <option value="Ticket Priority">Ticket Priority</option>
                           <option value="Low">Low</option>
                           <option value="Medium">Medium</option>
                           <option value="High">High</option>
                           </select>
                   </div>
                  
            </div>
            
       
    </div>
                    

    <div class="row mx-3" >
        <div class="col-xl-12 ">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="display" id="production-list-data"  style="width:100%">
                            <thead class="thead-dark">
                            <tr>
                            <th>{{__('No.')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Model')}}</th>
                                <th>{{__('Specification order')}}</th>
                                <th>{{__('Base Price')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Ticket Priority')}}</th>
                                <th>{{__('Ticket Status')}}</th>
                                <th>{{__('Order status')}}</th>
                                <th>{{__('Created At')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
            </div>
                    </div>
                    </div>
                    </div>

<!-- Production Invoice-->

    <div id="production-invoice" style="display:none;">
    <div class="row mx-4 ">
        <div class="card ">
        <div class="card-header d-flex gap-2">
                <image id="return-button2" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                <h4>Porduction Invoice</h4>
            </div>
         {{ Form::open(array('url' => 'product/searching')) }}
               <div class="row py-3">
                  
                    <div class="col-sm-1 form-group">
                        <span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-danger text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='#ff3a6e';"></span>
                      
                   </div>
                   <div class="col-sm-2 form-group">
                        <input type="text" class="form-control text-primary" name="date" value="" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="height: 45px;"><i class="bx bx-calendar text-primary" style="position: absolute;margin-left: 125px;margin-top: -28px;"></i>
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        {{ Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3', 'style' => 'height: 45px')) }}
                   </div>
                  
                   <div class="col-sm-2 form-group" style="margin-left: -22px;">
                       {{ Form::select('status_id', $orderstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       {{ Form::select('ticket_status_id', $ticketstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Ticket Priority</option>
                           <option value="1">Low</option>
                           <option value="2">Medium</option>
                           <option value="3">High</option>
                           </select>
                   </div>
                  
            </div>
             {{Form::close()}}
        <div class="col-sm-12">
            <div class=" mt-2 {{isset($_GET['category'])?'show':''}}" id="multiCollapseExample1">
                
                    <div class="card-body">
                        {{ Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'),['class'=>'form-label']) }}
                                    {{ Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('productservice.index') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
                    

    <div class="row mx-3">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th>{{__('No.')}}</th>
                                <th>{{__('Product Code')}}</th>
                                <th>{{__('Product Name')}}</th>
                                <th>{{__('Created Date')}}</th>
                                <th>{{__('Created Time')}}</th>
                                <th>{{__('Unit Rate')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                                @php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                @endphp
                                
                            @foreach ($productServices as $productService)
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: {{($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')));}}">
                                                   {{ str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT) }}</div></td>
                                    <td>
                                        <div class="hover-content">{{  $productService->name }}</div>
                                                <div class="hover-trigger">{{ \Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...') }}</div>
                                        </td>
                                    <td>
                                        {{  \Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...') }}
                                       </td>
                                    <td>
                                        <div class="hover-content">{{  $productService->hsn_code == ''?'-':$productService->hsn_code }}</div>
                                                <div class="hover-trigger">{{ $productService->hsn_code == ''?'-':\Illuminate\Support\Str::limit($productService->hsn_code, $limit = 15, $end = '...') }}</div>
                                       </td>
                                    <td>{{ \Auth::user()->priceFormat($productService->sale_price) }}</td>
                                    <td>{{  \Auth::user()->priceFormat($productService->purchase_price )}}</td>
                                    <td>{{$productService->quantity == 0?1:$productService->quantity}}</td>
                                    <td>{{$productService->ticket_priority}}</td>
                                    <td>{{$productService->ticket_status}}</td>
                                    <td>{{ ($productService->status == 1)?'Received':(($productService->status == 4)?'Resolved':(($productService->status == 5)?'Dispatch':(($productService->status == 3)?'Reporting':'Testing'))) }}</td>
                                    @if(Gate::check('edit product & service') || Gate::check('delete product & service'))
                                        <td class="Action">

                                            <div class="action-btn bg-light ms-2">
                                                <a href="{{ route('productservice.detail',$productService->id) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Product Details')}}" data-title="{{__('Product Details')}}">
                                                    <i class="ti ti-eye text-dark"></i>
                                                </a>
                                            </div>

                                            @can('edit product & service')
                                                <div class="action-btn bg-light ms-2">
                                                    <a href="{{ route('productservice.edit',$productService->id) }}" class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="{{__('Edit')}}"  data-title="{{__('Edit Product')}}">
                                                        <i class="ti ti-pencil text-dark"></i>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('delete product & service')
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['productservice.destroy', $productService->id],'id'=>'delete-form-'.$productService->id]) !!}
                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" ><i class="ti ti-trash text-white"></i></a>
                                                    {!! Form::close() !!}
                                                </div>
                                            @endcan 
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
                    <!--product record-->


                    
<div id="production-records" style="display:none;">
    <div class="row mx-4 ">
        <div class="card ">
        <div class="card-header d-flex gap-2">
                <image id="return-button3" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                <h4>Porduction Records</h4>
            </div>
         {{ Form::open(array('url' => 'product/searching')) }}
               <div class="row py-3">
                  
                    <div class="col-sm-1 form-group">
                        <span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-danger text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='#ff3a6e';"></span>
                      
                   </div>
                   <div class="col-sm-2 form-group">
                        <input type="text" class="form-control text-primary" name="date" value="" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="height: 45px;"><i class="bx bx-calendar text-primary" style="position: absolute;margin-left: 125px;margin-top: -28px;"></i>
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        {{ Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3', 'style' => 'height: 45px')) }}
                   </div>
                  
                   <div class="col-sm-2 form-group" style="margin-left: -22px;">
                       {{ Form::select('status_id', $orderstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       {{ Form::select('ticket_status_id', $ticketstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Ticket Priority</option>
                           <option value="1">Low</option>
                           <option value="2">Medium</option>
                           <option value="3">High</option>
                           </select>
                   </div>
                  
            </div>
             {{Form::close()}}
        <div class="col-sm-12">
            <div class=" mt-2 {{isset($_GET['category'])?'show':''}}" id="multiCollapseExample1">
                
                    <div class="card-body">
                        {{ Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'),['class'=>'form-label']) }}
                                    {{ Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('productservice.index') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
                    

    <div class="row mx-3">
        <div class="col-xl-12 ">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th>{{__('No.')}}</th>
                                <th>{{__('Invoice Number')}}</th>
                                <th>{{__('Incharge')}}</th>
                                <th>{{__('Created Date')}}</th>
                                <th>{{__('Created Time')}}</th>
                                <th>{{__('Labor Cost')}}</th>
                                <th>{{__('Material Cost')}}</th>
                                <th>{{__('Other Cost')}}</th>
                                <th>{{__('Total Cost')}}</th>
                              
                            </tr>
                            </thead>
                            <tbody>
                                                @php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                @endphp
                                
                            @foreach ($productServices as $productService)
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: {{($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')));}}">
                                                   {{ str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT) }}</div></td>
                                    <td>
                                        <div class="hover-content">{{  $productService->name }}</div>
                                                <div class="hover-trigger">{{ \Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...') }}</div>
                                        </td>
                                    <td>
                                        {{  \Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...') }}
                                       </td>
                                    <td>
                                        <div class="hover-content">{{  $productService->hsn_code == ''?'-':$productService->hsn_code }}</div>
                                                <div class="hover-trigger">{{ $productService->hsn_code == ''?'-':\Illuminate\Support\Str::limit($productService->hsn_code, $limit = 15, $end = '...') }}</div>
                                       </td>
                                    <td>{{ \Auth::user()->priceFormat($productService->sale_price) }}</td>
                                    <td>{{  \Auth::user()->priceFormat($productService->purchase_price )}}</td>
                                    <td>{{$productService->quantity == 0?1:$productService->quantity}}</td>
                                    <td>{{$productService->ticket_priority}}</td>
                                    <td>{{$productService->ticket_status}}</td>
                                   
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


                    <!--Product list-->

<div id="product-list" style="display:none;">
    <div class="row mx-4 ">
        <div class="card ">
        <div class="card-header d-flex gap-2">
                <image id="return-button4" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                <h4>Product List</h4>
            </div>
         {{ Form::open(array('url' => 'product/searching')) }}
               <div class="row py-3">
                  
                    <div class="col-sm-1 form-group">
                        <span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-danger text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='#ff3a6e';"></span>
                      
                   </div>
                   <div class="col-sm-2 form-group">
                        <input type="text" class="form-control text-primary" name="date" value="" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="height: 45px;"><i class="bx bx-calendar text-primary" style="position: absolute;margin-left: 125px;margin-top: -28px;"></i>
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        {{ Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3', 'style' => 'height: 45px')) }}
                   </div>
                  
                   <div class="col-sm-2 form-group" style="margin-left: -22px;">
                       {{ Form::select('status_id', $orderstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       {{ Form::select('ticket_status_id', $ticketstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Ticket Priority</option>
                           <option value="1">Low</option>
                           <option value="2">Medium</option>
                           <option value="3">High</option>
                           </select>
                   </div>
                  
            </div>
             {{Form::close()}}
        <div class="col-sm-12">
            <div class=" mt-2 {{isset($_GET['category'])?'show':''}}" id="multiCollapseExample1">
                
                    <div class="card-body">
                        {{ Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'),['class'=>'form-label']) }}
                                    {{ Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('productservice.index') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
                    

    <div class="row mx-3" >
        <div class="col-xl-12 ">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th>{{__('No.')}}</th>
                                <th>{{__('Product Code')}}</th>
                                <th>{{__('Product Name')}}</th>
                                <th>{{__('Created Date')}}</th>
                                <th>{{__('Created Time')}}</th>
                               
                                <th>{{__('Quantity')}}</th>
                             
                                <th>{{__('Stock Value')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                                @php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                @endphp
                                
                            @foreach ($productServices as $productService)
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: {{($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')));}}">
                                                   {{ str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT) }}</div></td>
                                    <td>
                                        <div class="hover-content">{{  $productService->name }}</div>
                                                <div class="hover-trigger">{{ \Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...') }}</div>
                                        </td>
                                    <td>
                                        {{  \Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...') }}
                                       </td>
                                    <td>
                                        <div class="hover-content">{{  $productService->hsn_code == ''?'-':$productService->hsn_code }}</div>
                                                <div class="hover-trigger">{{ $productService->hsn_code == ''?'-':\Illuminate\Support\Str::limit($productService->hsn_code, $limit = 15, $end = '...') }}</div>
                                       </td>
                                    <td>{{ \Auth::user()->priceFormat($productService->sale_price) }}</td>
                                    <td>{{  \Auth::user()->priceFormat($productService->purchase_price )}}</td>
                                    <td>{{$productService->quantity == 0?1:$productService->quantity}}</td>
                                   
                                   
                                    @if(Gate::check('edit product & service') || Gate::check('delete product & service'))
                                        <td class="Action">

                                            <div class="action-btn bg-light ms-2">
                                                <a href="{{ route('productservice.detail',$productService->id) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Product Details')}}" data-title="{{__('Product Details')}}">
                                                    <i class="ti ti-eye text-dark"></i>
                                                </a>
                                            </div>

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

                    <!-- Damage Product List-->

<div id="damage-product-list" style="display:none;">
    <div class="row mx-4 ">
        <div class="card ">
        <div class="card-header d-flex gap-2">
                <image id="return-button5" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                <h4>Damage Product List</h4>
            </div>
         {{ Form::open(array('url' => 'product/searching')) }}
               <div class="row py-3">
                  
                    <div class="col-sm-1 form-group">
                        <span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-danger text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='#ff3a6e';"></span>
                      
                   </div>
                   <div class="col-sm-2 form-group">
                        <input type="text" class="form-control text-primary" name="date" value="" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="height: 45px;"><i class="bx bx-calendar text-primary" style="position: absolute;margin-left: 125px;margin-top: -28px;"></i>
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        {{ Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3', 'style' => 'height: 45px')) }}
                   </div>
                  
                   <div class="col-sm-2 form-group" style="margin-left: -22px;">
                       {{ Form::select('status_id', $orderstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       {{ Form::select('ticket_status_id', $ticketstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Ticket Priority</option>
                           <option value="1">Low</option>
                           <option value="2">Medium</option>
                           <option value="3">High</option>
                           </select>
                   </div>
                  
            </div>
             {{Form::close()}}
        <div class="col-sm-12">
            <div class=" mt-2 {{isset($_GET['category'])?'show':''}}" id="multiCollapseExample1">
                
                    <div class="card-body">
                        {{ Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'),['class'=>'form-label']) }}
                                    {{ Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('productservice.index') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
                    

    <div class="row mx-3" >
        <div class="col-xl-12 ">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th>{{__('No.')}}</th>
                                <th>{{__('Product Code')}}</th>
                                <th>{{__('Product Name')}}</th>
                                <th>{{__('Created Date')}}</th>
                                <th>{{__('Created Time')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Stock Value')}}</th>
                                
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                                @php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                @endphp
                                
                            @foreach ($productServices as $productService)
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: {{($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')));}}">
                                                   {{ str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT) }}</div></td>
                                    <td>
                                        <div class="hover-content">{{  $productService->name }}</div>
                                                <div class="hover-trigger">{{ \Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...') }}</div>
                                        </td>
                                    <td>
                                        {{  \Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...') }}
                                       </td>
                                    <td>
                                        <div class="hover-content">{{  $productService->hsn_code == ''?'-':$productService->hsn_code }}</div>
                                                <div class="hover-trigger">{{ $productService->hsn_code == ''?'-':\Illuminate\Support\Str::limit($productService->hsn_code, $limit = 15, $end = '...') }}</div>
                                       </td>
                                    <td>{{ \Auth::user()->priceFormat($productService->sale_price) }}</td>
                                    <td>{{  \Auth::user()->priceFormat($productService->purchase_price )}}</td>
                                    <td>{{$productService->quantity == 0?1:$productService->quantity}}</td>
                                    
                                    @if(Gate::check('edit product & service') || Gate::check('delete product & service'))
                                        <td class="Action">

                                            <div class="action-btn bg-light ms-2">
                                                <a href="{{ route('productservice.detail',$productService->id) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Product Details')}}" data-title="{{__('Product Details')}}">
                                                    <i class="ti ti-eye text-dark"></i>
                                                </a>
                                            </div>

                                           
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

                    <!--Dead Product List-->
    <div id="dead-product-list" style="display:none;">
    <div class="row mx-4 ">
        <div class="card ">
        <div class="card-header d-flex gap-2">
                <image id="return-button6" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                <h4>Dead Product List</h4>
            </div>
         {{ Form::open(array('url' => 'product/searching')) }}
               <div class="row py-3">
                  
                    <div class="col-sm-1 form-group">
                        <span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-danger text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='#ff3a6e';"></span>
                      
                   </div>
                   <div class="col-sm-2 form-group">
                        <input type="text" class="form-control text-primary" name="date" value="" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="height: 45px;"><i class="bx bx-calendar text-primary" style="position: absolute;margin-left: 125px;margin-top: -28px;"></i>
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        {{ Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3', 'style' => 'height: 45px')) }}
                   </div>
                  
                   <div class="col-sm-2 form-group" style="margin-left: -22px;">
                       {{ Form::select('status_id', $orderstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       {{ Form::select('ticket_status_id', $ticketstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Ticket Priority</option>
                           <option value="1">Low</option>
                           <option value="2">Medium</option>
                           <option value="3">High</option>
                           </select>
                   </div>
                  
            </div>
             {{Form::close()}}
        <div class="col-sm-12">
            <div class=" mt-2 {{isset($_GET['category'])?'show':''}}" id="multiCollapseExample1">
                
                    <div class="card-body">
                        {{ Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'),['class'=>'form-label']) }}
                                    {{ Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('productservice.index') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
                    

    <div class="row mx-3" >
        <div class="col-xl-12 ">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th>{{__('No.')}}</th>
                                <th>{{__('Product Code')}}</th>
                                <th>{{__('Product Name')}}</th>
                                <th>{{__('Created Date')}}</th>
                                <th>{{__('Created Time')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Stock Value')}}</th>
                               
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                                @php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                @endphp
                                
                            @foreach ($productServices as $productService)
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: {{($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')));}}">
                                                   {{ str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT) }}</div></td>
                                    <td>
                                        <div class="hover-content">{{  $productService->name }}</div>
                                                <div class="hover-trigger">{{ \Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...') }}</div>
                                        </td>
                                    <td>
                                        {{  \Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...') }}
                                       </td>
                                    <td>
                                        <div class="hover-content">{{  $productService->hsn_code == ''?'-':$productService->hsn_code }}</div>
                                                <div class="hover-trigger">{{ $productService->hsn_code == ''?'-':\Illuminate\Support\Str::limit($productService->hsn_code, $limit = 15, $end = '...') }}</div>
                                       </td>
                                    <td>{{ \Auth::user()->priceFormat($productService->sale_price) }}</td>
                                    <td>{{  \Auth::user()->priceFormat($productService->purchase_price )}}</td>
                                    <td>{{$productService->quantity == 0?1:$productService->quantity}}</td>
                                   
                                    @if(Gate::check('edit product & service') || Gate::check('delete product & service'))
                                        <td class="Action">

                                            <div class="action-btn bg-light ms-2">
                                                <a href="{{ route('productservice.detail',$productService->id) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Product Details')}}" data-title="{{__('Product Details')}}">
                                                    <i class="ti ti-eye text-dark"></i>
                                                </a>
                                            </div>

                                         
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

                                        <!--Materia Purchase List-->
    <div id="material-purchase-list" style="display:none;">
    <div class="row mx-4 ">
        <div class="card ">
        <div class="card-header d-flex gap-2">
                <image id="return-button7" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                <h4>Material Purchase List</h4>
            </div>
         {{ Form::open(array('url' => 'product/searching')) }}
               <div class="row py-3">
                  
                    <div class="col-sm-1 form-group">
                        <span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-danger text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='#ff3a6e';"></span>
                      
                   </div>
                   <div class="col-sm-2 form-group">
                        <input type="text" class="form-control text-primary" name="date" value="" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="height: 45px;"><i class="bx bx-calendar text-primary" style="position: absolute;margin-left: 125px;margin-top: -28px;"></i>
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        {{ Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3', 'style' => 'height: 45px')) }}
                   </div>
                  
                   <div class="col-sm-2 form-group" style="margin-left: -22px;">
                       {{ Form::select('status_id', $orderstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       {{ Form::select('ticket_status_id', $ticketstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Ticket Priority</option>
                           <option value="1">Low</option>
                           <option value="2">Medium</option>
                           <option value="3">High</option>
                           </select>
                   </div>
                  
            </div>
             {{Form::close()}}
        <div class="col-sm-12">
            <div class=" mt-2 {{isset($_GET['category'])?'show':''}}" id="multiCollapseExample1">
                
                    <div class="card-body">
                        {{ Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'),['class'=>'form-label']) }}
                                    {{ Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('productservice.index') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
                    

    <div class="row mx-3" >
        <div class="col-xl-12 ">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th>{{__('No.')}}</th>
                                <th>{{__('Material Code')}}</th>
                                <th>{{__('Material Name')}}</th>
                                <th>{{__('Created Date')}}</th>
                                <th>{{__('Created Time')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Stock Value')}}</th>
                                
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                                @php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                @endphp
                                
                            @foreach ($productServices as $productService)
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: {{($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')));}}">
                                                   {{ str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT) }}</div></td>
                                    <td>
                                        <div class="hover-content">{{  $productService->name }}</div>
                                                <div class="hover-trigger">{{ \Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...') }}</div>
                                        </td>
                                    <td>
                                        {{  \Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...') }}
                                       </td>
                                    <td>
                                        <div class="hover-content">{{  $productService->hsn_code == ''?'-':$productService->hsn_code }}</div>
                                                <div class="hover-trigger">{{ $productService->hsn_code == ''?'-':\Illuminate\Support\Str::limit($productService->hsn_code, $limit = 15, $end = '...') }}</div>
                                       </td>
                                    <td>{{ \Auth::user()->priceFormat($productService->sale_price) }}</td>
                                    <td>{{  \Auth::user()->priceFormat($productService->purchase_price )}}</td>
                                    <td>{{$productService->quantity == 0?1:$productService->quantity}}</td>
                                   
                                    @if(Gate::check('edit product & service') || Gate::check('delete product & service'))
                                        <td class="Action">

                                            <div class="action-btn bg-light ms-2">
                                                <a href="{{ route('productservice.detail',$productService->id) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Product Details')}}" data-title="{{__('Product Details')}}">
                                                    <i class="ti ti-eye text-dark"></i>
                                                </a>
                                            </div>

                                         
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

       <!--Materia List-->
    <div id="material-list" style="display:none;">
    <div class="row mx-4 ">
        <div class="card ">
        <div class="card-header d-flex gap-2">
                <image id="return-button8" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                <h4>Material List</h4>
            </div>
         {{ Form::open(array('url' => 'product/searching')) }}
               <div class="row py-3">
                  
                    <div class="col-sm-1 form-group">
                        <span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-danger text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='#ff3a6e';"></span>
                      
                   </div>
                   <div class="col-sm-2 form-group">
                        <input type="text" class="form-control text-primary" name="date" value="" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="height: 45px;"><i class="bx bx-calendar text-primary" style="position: absolute;margin-left: 125px;margin-top: -28px;"></i>
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        {{ Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3', 'style' => 'height: 45px')) }}
                   </div>
                  
                   <div class="col-sm-2 form-group" style="margin-left: -22px;">
                       {{ Form::select('status_id', $orderstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       {{ Form::select('ticket_status_id', $ticketstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Ticket Priority</option>
                           <option value="1">Low</option>
                           <option value="2">Medium</option>
                           <option value="3">High</option>
                           </select>
                   </div>
                  
            </div>
             {{Form::close()}}
        <div class="col-sm-12">
            <div class=" mt-2 {{isset($_GET['category'])?'show':''}}" id="multiCollapseExample1">
                
                    <div class="card-body">
                        {{ Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'),['class'=>'form-label']) }}
                                    {{ Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('productservice.index') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
                    

    <div class="row mx-3" >
        <div class="col-xl-12 ">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                            <th>{{__('No.')}}</th>
                                <th>{{__('Material Code')}}</th>
                                <th>{{__('Material Name')}}</th>
                                <th>{{__('Created Date')}}</th>
                                <th>{{__('Created Time')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Stock Value')}}</th>
                                
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                                @php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                @endphp
                                
                            @foreach ($productServices as $productService)
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: {{($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')));}}">
                                                   {{ str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT) }}</div></td>
                                    <td>
                                        <div class="hover-content">{{  $productService->name }}</div>
                                                <div class="hover-trigger">{{ \Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...') }}</div>
                                        </td>
                                    <td>
                                        {{  \Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...') }}
                                       </td>
                                    <td>
                                        <div class="hover-content">{{  $productService->hsn_code == ''?'-':$productService->hsn_code }}</div>
                                                <div class="hover-trigger">{{ $productService->hsn_code == ''?'-':\Illuminate\Support\Str::limit($productService->hsn_code, $limit = 15, $end = '...') }}</div>
                                       </td>
                                    <td>{{ \Auth::user()->priceFormat($productService->sale_price) }}</td>
                                    <td>{{  \Auth::user()->priceFormat($productService->purchase_price )}}</td>
                                    <td>{{$productService->quantity == 0?1:$productService->quantity}}</td>
                                   
                                    @if(Gate::check('edit product & service') || Gate::check('delete product & service'))
                                        <td class="Action">

                                            <div class="action-btn bg-light ms-2">
                                                <a href="{{ route('productservice.detail',$productService->id) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Product Details')}}" data-title="{{__('Product Details')}}">
                                                    <i class="ti ti-eye text-dark"></i>
                                                </a>
                                            </div>

                                          
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


                                    <!--Damage Materia List-->
                                    <div id="damage-material-list" style="display:none;">
    <div class="row mx-4 ">
        <div class="card ">
        <div class="card-header d-flex gap-2">
                <image id="return-button9" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                <h4>Damage Material List</h4>
            </div>
         {{ Form::open(array('url' => 'product/searching')) }}
               <div class="row py-3">
                  
                    <div class="col-sm-1 form-group">
                        <span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-danger text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='#ff3a6e';"></span>
                      
                   </div>
                   <div class="col-sm-2 form-group">
                        <input type="text" class="form-control text-primary" name="date" value="" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="height: 45px;"><i class="bx bx-calendar text-primary" style="position: absolute;margin-left: 125px;margin-top: -28px;"></i>
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        {{ Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3', 'style' => 'height: 45px')) }}
                   </div>
                  
                   <div class="col-sm-2 form-group" style="margin-left: -22px;">
                       {{ Form::select('status_id', $orderstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       {{ Form::select('ticket_status_id', $ticketstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Ticket Priority</option>
                           <option value="1">Low</option>
                           <option value="2">Medium</option>
                           <option value="3">High</option>
                           </select>
                   </div>
                  
            </div>
             {{Form::close()}}
        <div class="col-sm-12">
            <div class=" mt-2 {{isset($_GET['category'])?'show':''}}" id="multiCollapseExample1">
                
                    <div class="card-body">
                        {{ Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'),['class'=>'form-label']) }}
                                    {{ Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('productservice.index') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
                    

    <div class="row mx-3" >
        <div class="col-xl-12 ">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                            <th>{{__('No.')}}</th>
                                <th>{{__('Material Code')}}</th>
                                <th>{{__('Material Name')}}</th>
                                <th>{{__('Created Date')}}</th>
                                <th>{{__('Created Time')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Unit Rate')}}</th>
                                
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                                @php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                @endphp
                                
                            @foreach ($productServices as $productService)
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: {{($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')));}}">
                                                   {{ str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT) }}</div></td>
                                    <td>
                                        <div class="hover-content">{{  $productService->name }}</div>
                                                <div class="hover-trigger">{{ \Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...') }}</div>
                                        </td>
                                    <td>
                                        {{  \Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...') }}
                                       </td>
                                    <td>
                                        <div class="hover-content">{{  $productService->hsn_code == ''?'-':$productService->hsn_code }}</div>
                                                <div class="hover-trigger">{{ $productService->hsn_code == ''?'-':\Illuminate\Support\Str::limit($productService->hsn_code, $limit = 15, $end = '...') }}</div>
                                       </td>
                                    <td>{{ \Auth::user()->priceFormat($productService->sale_price) }}</td>
                                    <td>{{  \Auth::user()->priceFormat($productService->purchase_price )}}</td>
                                    <td>{{$productService->quantity == 0?1:$productService->quantity}}</td>
                                   
                                    @if(Gate::check('edit product & service') || Gate::check('delete product & service'))
                                        <td class="Action">

                                            <div class="action-btn bg-light ms-2">
                                                <a href="{{ route('productservice.detail',$productService->id) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Product Details')}}" data-title="{{__('Product Details')}}">
                                                    <i class="ti ti-eye text-dark"></i>
                                                </a>
                                            </div>

                                         
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

                                    <!--Materia Purchase Invoice-->
                                    <div id="material-purchase-invoice" style="display:none;">
    <div class="row mx-4 ">
        <div class="card ">
        <div class="card-header d-flex gap-2">
                <image id="return-button10" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                <h4>Material Purchase Invoice</h4>
            </div>
         {{ Form::open(array('url' => 'product/searching')) }}
               <div class="row py-3">
                  
                    <div class="col-sm-1 form-group">
                        <span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-danger text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='#ff3a6e';"></span>
                      
                   </div>
                   <div class="col-sm-2 form-group">
                        <input type="text" class="form-control text-primary" name="date" value="" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="height: 45px;"><i class="bx bx-calendar text-primary" style="position: absolute;margin-left: 125px;margin-top: -28px;"></i>
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        {{ Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3', 'style' => 'height: 45px')) }}
                   </div>
                  
                   <div class="col-sm-2 form-group" style="margin-left: -22px;">
                       {{ Form::select('status_id', $orderstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       {{ Form::select('ticket_status_id', $ticketstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Ticket Priority</option>
                           <option value="1">Low</option>
                           <option value="2">Medium</option>
                           <option value="3">High</option>
                           </select>
                   </div>
                  
            </div>
             {{Form::close()}}
        <div class="col-sm-12">
            <div class=" mt-2 {{isset($_GET['category'])?'show':''}}" id="multiCollapseExample1">
                
                    <div class="card-body">
                        {{ Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'),['class'=>'form-label']) }}
                                    {{ Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('productservice.index') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
                    

    <div class="row mx-3" >
        <div class="col-xl-12 ">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                            <th>{{__('No.')}}</th>
                                <th>{{__('Invoice Number')}}</th>
                                <th>{{__('Vendor')}}</th>
                                <th>{{__('Created by')}}</th>
                                <th>{{__('Created Date')}}</th>
                                <th>{{__('Created Time')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Unit Rate')}}</th>
                                
                                <th>{{__('Transport')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                                @php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                @endphp
                                
                            @foreach ($productServices as $productService)
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: {{($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')));}}">
                                                   {{ str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT) }}</div></td>
                                    <td>
                                        <div class="hover-content">{{  $productService->name }}</div>
                                                <div class="hover-trigger">{{ \Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...') }}</div>
                                        </td>
                                    <td>
                                        {{  \Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...') }}
                                       </td>
                                    <td>
                                        <div class="hover-content">{{  $productService->hsn_code == ''?'-':$productService->hsn_code }}</div>
                                                <div class="hover-trigger">{{ $productService->hsn_code == ''?'-':\Illuminate\Support\Str::limit($productService->hsn_code, $limit = 15, $end = '...') }}</div>
                                       </td>
                                    <td>{{ \Auth::user()->priceFormat($productService->sale_price) }}</td>
                                    <td>{{  \Auth::user()->priceFormat($productService->purchase_price )}}</td>
                                    <td>{{$productService->quantity == 0?1:$productService->quantity}}</td>
                                    <td>{{$productService->ticket_priority}}</td>
                                    <td>{{$productService->ticket_priority}}</td>
                                  
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


     <!--Materia Purchase Record-->
    <div id="material-purchase-records" style="display:none;">
    <div class="row mx-4 ">
        <div class="card ">
        <div class="card-header d-flex gap-2">
                <image id="return-button14" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                <h4>Material Purchase Records</h4>
            </div>
         {{ Form::open(array('url' => 'product/searching')) }}
               <div class="row py-3">
                  
                    <div class="col-sm-1 form-group">
                        <span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-danger text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='#ff3a6e';"></span>
                      
                   </div>
                   <div class="col-sm-2 form-group">
                        <input type="text" class="form-control text-primary" name="date" value="" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="height: 45px;"><i class="bx bx-calendar text-primary" style="position: absolute;margin-left: 125px;margin-top: -28px;"></i>
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        {{ Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3', 'style' => 'height: 45px')) }}
                   </div>
                  
                   <div class="col-sm-2 form-group" style="margin-left: -22px;">
                       {{ Form::select('status_id', $orderstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       {{ Form::select('ticket_status_id', $ticketstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Ticket Priority</option>
                           <option value="1">Low</option>
                           <option value="2">Medium</option>
                           <option value="3">High</option>
                           </select>
                   </div>
                  
            </div>
             {{Form::close()}}
        <div class="col-sm-12">
            <div class=" mt-2 {{isset($_GET['category'])?'show':''}}" id="multiCollapseExample1">
                
                    <div class="card-body">
                        {{ Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'),['class'=>'form-label']) }}
                                    {{ Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('productservice.index') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
                    

    <div class="row mx-3" >
        <div class="col-xl-12 ">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                            <th>{{__('No.')}}</th>
                                <th>{{__('Material Code')}}</th>
                                <th>{{__('Material Name')}}</th>
                                <th>{{__('Created Date')}}</th>
                                <th>{{__('Created Time')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Stock Value')}}</th>
                                
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                                @php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                @endphp
                                
                            @foreach ($productServices as $productService)
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: {{($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')));}}">
                                                   {{ str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT) }}</div></td>
                                    <td>
                                        <div class="hover-content">{{  $productService->name }}</div>
                                                <div class="hover-trigger">{{ \Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...') }}</div>
                                        </td>
                                    <td>
                                        {{  \Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...') }}
                                       </td>
                                    <td>
                                        <div class="hover-content">{{  $productService->hsn_code == ''?'-':$productService->hsn_code }}</div>
                                                <div class="hover-trigger">{{ $productService->hsn_code == ''?'-':\Illuminate\Support\Str::limit($productService->hsn_code, $limit = 15, $end = '...') }}</div>
                                       </td>
                                    <td>{{ \Auth::user()->priceFormat($productService->sale_price) }}</td>
                                    <td>{{  \Auth::user()->priceFormat($productService->purchase_price )}}</td>
                                    <td>{{$productService->quantity == 0?1:$productService->quantity}}</td>
                                    
                                    @if(Gate::check('edit product & service') || Gate::check('delete product & service'))
                                        <td class="Action">

                                            <div class="action-btn bg-light ms-2">
                                                <a href="{{ route('productservice.detail',$productService->id) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Product Details')}}" data-title="{{__('Product Details')}}">
                                                    <i class="ti ti-eye text-dark"></i>
                                                </a>
                                            </div>

                                           
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


 <!-- Dead Materia List -->
    <div id="dead-material-list" style="display:none;">
    <div class="row mx-4 ">
        <div class="card ">
        <div class="card-header d-flex gap-2">
                <image id="return-button11" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                <h4>Dead Material List</h4>
            </div>
         {{ Form::open(array('url' => 'product/searching')) }}
               <div class="row py-3">
                  
                    <div class="col-sm-1 form-group">
                        <span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-danger text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='#ff3a6e';"></span>
                      
                   </div>
                   <div class="col-sm-2 form-group">
                        <input type="text" class="form-control text-primary" name="date" value="" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="height: 45px;"><i class="bx bx-calendar text-primary" style="position: absolute;margin-left: 125px;margin-top: -28px;"></i>
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        {{ Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3', 'style' => 'height: 45px')) }}
                   </div>
                  
                   <div class="col-sm-2 form-group" style="margin-left: -22px;">
                       {{ Form::select('status_id', $orderstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       {{ Form::select('ticket_status_id', $ticketstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Ticket Priority</option>
                           <option value="1">Low</option>
                           <option value="2">Medium</option>
                           <option value="3">High</option>
                           </select>
                   </div>
                  
            </div>
             {{Form::close()}}
        <div class="col-sm-12">
            <div class=" mt-2 {{isset($_GET['category'])?'show':''}}" id="multiCollapseExample1">
                
                    <div class="card-body">
                        {{ Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'),['class'=>'form-label']) }}
                                    {{ Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('productservice.index') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
                    

    <div class="row mx-3" >
        <div class="col-xl-12 ">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                            <th>{{__('No.')}}</th>
                                <th>{{__('Material Code')}}</th>
                                <th>{{__('Material Name')}}</th>
                                <th>{{__('Created Date')}}</th>
                                <th>{{__('Created Time')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Stock Value')}}</th>
                                
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                                @php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                @endphp
                                
                            @foreach ($productServices as $productService)
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: {{($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')));}}">
                                                   {{ str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT) }}</div></td>
                                    <td>
                                        <div class="hover-content">{{  $productService->name }}</div>
                                                <div class="hover-trigger">{{ \Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...') }}</div>
                                        </td>
                                    <td>
                                        {{  \Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...') }}
                                       </td>
                                    <td>
                                        <div class="hover-content">{{  $productService->hsn_code == ''?'-':$productService->hsn_code }}</div>
                                                <div class="hover-trigger">{{ $productService->hsn_code == ''?'-':\Illuminate\Support\Str::limit($productService->hsn_code, $limit = 15, $end = '...') }}</div>
                                       </td>
                                    <td>{{ \Auth::user()->priceFormat($productService->sale_price) }}</td>
                                    <td>{{  \Auth::user()->priceFormat($productService->purchase_price )}}</td>
                                    <td>{{$productService->quantity == 0?1:$productService->quantity}}</td>
                                   
                                    @if(Gate::check('edit product & service') || Gate::check('delete product & service'))
                                        <td class="Action">

                                            <div class="action-btn bg-light ms-2">
                                                <a href="{{ route('productservice.detail',$productService->id) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Product Details')}}" data-title="{{__('Product Details')}}">
                                                    <i class="ti ti-eye text-dark"></i>
                                                </a>
                                            </div>

                                           
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

                     <!--  Material Ledger -->
    <div id="material-ledger" style="display:none;">
    <div class="row mx-4">
        <div class="card ">
        <div class="card-header d-flex gap-2">
                <image id="return-button12" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                <h4>Material Ledger</h4>
            </div>
         {{ Form::open(array('url' => 'product/searching')) }}
               <div class="row py-3">
                  
                    <div class="col-sm-1 form-group">
                        <span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-danger text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='#ff3a6e';"></span>
                      
                   </div>
                   <div class="col-sm-2 form-group">
                        <input type="text" class="form-control text-primary" name="date" value="" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="height: 45px;"><i class="bx bx-calendar text-primary" style="position: absolute;margin-left: 125px;margin-top: -28px;"></i>
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        {{ Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3', 'style' => 'height: 45px')) }}
                   </div>
                  
                   <div class="col-sm-2 form-group" style="margin-left: -22px;">
                       {{ Form::select('status_id', $orderstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       {{ Form::select('ticket_status_id', $ticketstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Ticket Priority</option>
                           <option value="1">Low</option>
                           <option value="2">Medium</option>
                           <option value="3">High</option>
                           </select>
                   </div>
                  
            </div>
             {{Form::close()}}
        <div class="col-sm-12">
            <div class=" mt-2 {{isset($_GET['category'])?'show':''}}" id="multiCollapseExample1">
                
                    <div class="card-body">
                        {{ Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'),['class'=>'form-label']) }}
                                    {{ Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('productservice.index') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
                    

    <div class="row mx-3" >
        <div class="col-xl-12 ">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th>{{__('No.')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Unit Rate')}}</th>
                                <th>{{__('in Quantity')}}</th>
                              
                                <th>{{__('Out Quantity')}}</th>
                                <th>{{__('Stock')}}</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                                                @php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                @endphp
                                
                            @foreach ($productServices as $productService)
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: {{($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')));}}">
                                                   {{ str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT) }}</div></td>
                                    <td>
                                        <div class="hover-content">{{  $productService->name }}</div>
                                                <div class="hover-trigger">{{ \Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...') }}</div>
                                        </td>
                                    <td>
                                        {{  \Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...') }}
                                       </td>
                                    <td>
                                        <div class="hover-content">{{  $productService->hsn_code == ''?'-':$productService->hsn_code }}</div>
                                                <div class="hover-trigger">{{ $productService->hsn_code == ''?'-':\Illuminate\Support\Str::limit($productService->hsn_code, $limit = 15, $end = '...') }}</div>
                                       </td>
                                    <td>{{ \Auth::user()->priceFormat($productService->sale_price) }}</td>
                                    <td>{{  \Auth::user()->priceFormat($productService->purchase_price )}}</td>
                                    <td>{{$productService->quantity == 0?1:$productService->quantity}}</td>
                                    
                                    
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



   <!--  Materia Stock -->
   <div id="material-stock" style="display:none;">
    <div class="row mx-4 ">
        <div class="card ">
        <div class="card-header d-flex gap-2">
                <image id="return-button13" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                <h4> Material Stock</h4>
            </div>
         {{ Form::open(array('url' => 'product/searching')) }}
               <div class="row py-3">
                  
                    <div class="col-sm-1 form-group">
                        <span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-danger text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='#ff3a6e';"></span>
                      
                   </div>
                   <div class="col-sm-2 form-group">
                        <input type="text" class="form-control text-primary" name="date" value="" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="height: 45px;"><i class="bx bx-calendar text-primary" style="position: absolute;margin-left: 125px;margin-top: -28px;"></i>
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        {{ Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3', 'style' => 'height: 45px')) }}
                   </div>
                  
                   <div class="col-sm-2 form-group" style="margin-left: -22px;">
                       {{ Form::select('status_id', $orderstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       {{ Form::select('ticket_status_id', $ticketstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Ticket Priority</option>
                           <option value="1">Low</option>
                           <option value="2">Medium</option>
                           <option value="3">High</option>
                           </select>
                   </div>
                  
            </div>
             {{Form::close()}}
        <div class="col-sm-12">
            <div class=" mt-2 {{isset($_GET['category'])?'show':''}}" id="multiCollapseExample1">
                
                    <div class="card-body">
                        {{ Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'),['class'=>'form-label']) }}
                                    {{ Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('productservice.index') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
                    

    <div class="row mx-3" >
        <div class="col-xl-12 ">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                            <th>{{__('No.')}}</th>
                                <th>{{__('Material Code')}}</th>
                                <th>{{__('Material Name')}}</th>
                                <th>{{__('Created Date')}}</th>
                                <th>{{__('Created Time')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Stock Value')}}</th>
                                
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                                @php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                @endphp
                                
                            @foreach ($productServices as $productService)
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: {{($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')));}}">
                                                   {{ str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT) }}</div></td>
                                    <td>
                                        <div class="hover-content">{{  $productService->name }}</div>
                                                <div class="hover-trigger">{{ \Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...') }}</div>
                                        </td>
                                    <td>
                                        {{  \Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...') }}
                                       </td>
                                    <td>
                                        <div class="hover-content">{{  $productService->hsn_code == ''?'-':$productService->hsn_code }}</div>
                                                <div class="hover-trigger">{{ $productService->hsn_code == ''?'-':\Illuminate\Support\Str::limit($productService->hsn_code, $limit = 15, $end = '...') }}</div>
                                       </td>
                                    <td>{{ \Auth::user()->priceFormat($productService->sale_price) }}</td>
                                    <td>{{  \Auth::user()->priceFormat($productService->purchase_price )}}</td>
                                    <td>{{$productService->quantity == 0?1:$productService->quantity}}</td>
                                   
                                    <td>{{$productService->quantity == 0?1:$productService->quantity}}</td>
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
                    
     <!-- Vendor List -->
     <div id="vendor-list" style="display:none;">
    <div class="row mx-4 ">
        <div class="card ">
        <div class="card-header d-flex gap-2">
                <image id="return-button15" class="mb-2" src="{{ asset('assets/images/Return-back.svg') }}"></image>
                <h4>Vendor List</h4>
            </div>
         {{ Form::open(array('url' => 'product/searching')) }}
               <div class="row py-3">
                  
                    <div class="col-sm-1 form-group">
                        <span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-danger text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='#ff3a6e';"></span>
                      
                   </div>
                   <div class="col-sm-2 form-group">
                        <input type="text" class="form-control text-primary" name="date" value="" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="height: 45px;"><i class="bx bx-calendar text-primary" style="position: absolute;margin-left: 125px;margin-top: -28px;"></i>
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        {{ Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3', 'style' => 'height: 45px')) }}
                   </div>
                  
                   <div class="col-sm-2 form-group" style="margin-left: -22px;">
                       {{ Form::select('status_id', $orderstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       {{ Form::select('ticket_status_id', $ticketstatus,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Ticket Priority</option>
                           <option value="1">Low</option>
                           <option value="2">Medium</option>
                           <option value="3">High</option>
                           </select>
                   </div>
                  
            </div>
             {{Form::close()}}
        <div class="col-sm-12">
            <div class=" mt-2 {{isset($_GET['category'])?'show':''}}" id="multiCollapseExample1">
                
                    <div class="card-body">
                        {{ Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service']) }}
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'),['class'=>'form-label']) }}
                                    {{ Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('productservice.index') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
                    

    <div class="row mx-3" >
        <div class="col-xl-12 ">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th>{{__('No.')}}</th>
                                <th>{{__('Vendor Name')}}</th>
                                <th>{{__('Company Name')}}</th>
                                <th>{{__('Created Date')}}</th>
                                <th>{{__('Address')}}</th>
                                <th>{{__('Contact Number')}}</th>
                                <th>{{__('Previous Due')}}</th>
                               
                            </tr>
                            </thead>
                            <tbody>
                                                @php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                @endphp
                                
                            @foreach ($productServices as $productService)
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: {{($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')));}}">
                                                   {{ str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT) }}</div></td>
                                    <td>
                                        <div class="hover-content">{{  $productService->name }}</div>
                                                <div class="hover-trigger">{{ \Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...') }}</div>
                                        </td>
                                    <td>
                                        {{  \Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...') }}
                                       </td>
                                    <td>
                                        <div class="hover-content">{{  $productService->hsn_code == ''?'-':$productService->hsn_code }}</div>
                                                <div class="hover-trigger">{{ $productService->hsn_code == ''?'-':\Illuminate\Support\Str::limit($productService->hsn_code, $limit = 15, $end = '...') }}</div>
                                       </td>
                                    <td>{{ \Auth::user()->priceFormat($productService->sale_price) }}</td>
                                    <td>{{  \Auth::user()->priceFormat($productService->purchase_price )}}</td>
                                    <td>{{$productService->quantity == 0?1:$productService->quantity}}</td>
                                   
                                   
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



@endsection

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Finance Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Finance Report')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://hammerjs.github.io/dist/hammer.js"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
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
                    name: "<?php echo e(__('Income')); ?>",
                    data: <?php echo json_encode($incExpBarChartData['income']); ?>

                }, {
                    name: "<?php echo e(__('Expense')); ?>",
                    data: <?php echo json_encode($incExpBarChartData['expense']); ?>

                }],
                xaxis: {
                    categories: <?php echo json_encode($incExpBarChartData['month']); ?>,
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
                    name: "<?php echo e(__('Payment by Bank')); ?>",
                    data: <?php echo json_encode($incExpBarChartData['income']); ?>

                }, {
                    name: "<?php echo e(__('Payment by Cash')); ?>",
                    data: <?php echo json_encode($incExpBarChartData['expense']); ?>

                }],
                xaxis: {
                    categories: <?php echo json_encode($incExpBarChartData['month']); ?>,
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
                    name: "<?php echo e(__('INR')); ?>",
                    data: <?php echo json_encode($incExpBarChartData['income']); ?>

                }, {
                    name: "<?php echo e(__('EURO')); ?>",
                    data: <?php echo json_encode($incExpBarChartData['expense']); ?>

                },
                {
                    name: "<?php echo e(__('USD')); ?>",
                    data: <?php echo json_encode($incExpBarChartData['expense']); ?>

                }],
                xaxis: {
                    categories: <?php echo json_encode($incExpBarChartData['month']); ?>,
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


        document.querySelector('#show-div1 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('customer-reports');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('finance-main');
   
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

    var targetDiv = document.getElementById('customer-reports');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('finance-main');
    
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
   

    var targetDiv = document.getElementById('vendor-reports');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('finance-main');
   
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

    var targetDiv = document.getElementById('vendor-reports');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('finance-main');
    
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
   

    var targetDiv = document.getElementById('miscellaneous-reports');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('finance-main');
   
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

    var targetDiv = document.getElementById('miscellaneous-reports');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('finance-main');
    
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
   

    var targetDiv = document.getElementById('bank-reports');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('finance-main');
   
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

    var targetDiv = document.getElementById('bank-reports');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('finance-main');
    
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
   

    var targetDiv = document.getElementById('cash-reports');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('finance-main');
   
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

    var targetDiv = document.getElementById('cash-reports');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('finance-main');
    
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
   

    var targetDiv = document.getElementById('return-orders-reports');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('finance-main');
   
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

    var targetDiv = document.getElementById('return-orders-reports');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('finance-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
});

document.querySelector('#return-orders-transcation-show-div a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('return-orders-transaction-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    

});


document.querySelector('#cash-transcation-show-div a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('cash-transaction-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    

});

document.querySelector('#bank-transcation-show-div a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('bank-transaction-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    

});

document.querySelector('#miscellaneous-transcation-show-div a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('miscellaneous-transaction-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    

});

document.querySelector('#customer-transcation-show-div a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('customer-transaction-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    

});

document.querySelector('#vendor-transcation-show-div a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('vendor-transaction-list');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
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

<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
<?php
 $monthNames = ["Select Month",
              "January", "February", "March", "April", "May", "June",
              "July", "August", "September", "October", "November", "December"
            ];
?>
    <div class="float-end">
        <a href="#" onclick="saveAsPDF()" class="btn btn-sm btn-primary me-1" data-bs-toggle="tooltip"
            title="<?php echo e(__('Print')); ?>" data-original-title="<?php echo e(__('Print')); ?>"><i class="ti ti-printer"></i></a>
    </div>

    <div class="float-end me-2">
        <?php echo e(Form::open(['route' => ['sales.export']])); ?>

        <input type="hidden" name="start_date" class="start_date">
        <input type="hidden" name="end_date" class="end_date">
        <input type="hidden" name="report" class="report">
        <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>"
            data-original-title="<?php echo e(__('Export')); ?>"><i class="ti ti-file-export"></i></button>
        <?php echo e(Form::close()); ?>

    </div>

    <div class="float-end me-2" id="filter">
        <button id="filter" class="btn btn-sm btn-primary"><i class="ti ti-filter"></i></button>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   
   </div>
   


    <div class="row mx-3 " id="finance-main">
         <div class="row" style="margin:-2px;">
                  
                    

                 
                    <div class="col-sm-3 form-group" style="position: relative;">
                         <?php echo e(Form::label('period',__('From Date'))); ?>

                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepicker" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon" style="position: absolute; right: 26px; top: 60%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                       
                    <div class="col-sm-3 form-group" style="position: relative;">
                         <?php echo e(Form::label('period',__('To Date'))); ?>

                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepickerTo" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon1" style="position: absolute; right: 26px; top: 60%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                   
                    <div class="col-sm-3 form-group">
                      <?php echo e(Form::label('period',__('Period'))); ?>

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
                         <?php echo e(Form::label('period',__('Period'))); ?>

                         <select class="form-control text-primary" id="yearSelect" style="border-radius: 15px;">Select Year</select>

                   </div> 
                  
                  
            </div>

        <!--Sales Report    -->
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 form-group" id="show-div1">
                            
                         <a href="" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;--bs-btn-color: unset;">
                            Customer
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div2">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Vendor
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div3">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Miscellaneous Operation
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div4">
                         <a id="payment-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Bank
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 

                        <div class="col-sm-4 form-group" id="show-div5">
                         <a id="payment-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Cash
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 

                        <div class="col-sm-4 form-group" id="show-div6">
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
                 <!-- customer reports-->    

             <div class="row mx-1" id="customer-reports" style="display:none;"> 
                  <div class="card">
                    <div class="card-header">
                    <h4>  <image id="return-button1" class="mb-2 mr-3" src="<?php echo e(asset('assets/images/Return-back.svg')); ?>"></image>
              Customer</h4>
               
                    </div>
         <div class="row py-4">
                 
                    

                 
                    <div class="col-sm-3 form-group" style="position: relative;">
                         <?php echo e(Form::label('period',__('From Date'))); ?>

                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepicker" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon" style="position: absolute; right: 26px; top: 60%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                       
                    <div class="col-sm-3 form-group" style="position: relative;">
                         <?php echo e(Form::label('period',__('To Date'))); ?>

                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepickerTo" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon1" style="position: absolute; right: 26px; top: 60%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                   
                    <div class="col-sm-3 form-group">
                      <?php echo e(Form::label('period',__('Period'))); ?>

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
                         <?php echo e(Form::label('period',__('Period'))); ?>

                         <select class="form-control text-primary" id="yearSelect" style="border-radius: 15px;">Select Year</select>

                   </div> 
                  
                  
          
        <!--Sales Report    -->
        <div class="col-12">
            <div class="card pt-5">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 form-group" id="customer-transcation-show-div">
                            
                         <a  class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                            Customer Transaction Entry
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Transaction Invoice
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Transaction Reports
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 


                        
                       
                       
                       
                    </div>
                    </div>
                    </div>


                    <div class="row mx-1" id="customer-transaction-list" style="display:none;" > 
                  <div class="card" >
                    <div class="card-header">
                    <h4> 
              Customer Receive / Payment Entry</h4>
               
                    </div>
         <div class="row py-4">
                 
                 
                  
                  
          
        <!--Sales Report    -->
        <div class="col-12">
            <div class="card pt-5">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            
                         <a  class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                            Choose a Transaction Type
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                           Choose the Payment Method
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Name
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 

                        <div class="col-sm-4 form-group">
                            
                            <a href="<?php echo e(route('report.lead')); ?>" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                              Current Due
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                           <div class="col-sm-4 form-group">
                            <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                               Amount
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                           <div class="col-sm-4 form-group">
                               
                            <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                              Note
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                    </div>
                    </div>
                    </div>

                    <div class="">
                        <div class="card-header">
                            <h4>
                            Customer Transaction List
                            </h4>
                        </div>
                        <table>
                            <thead class="card-header bg-gradient bg-light">
                               <tr>
                                <th>S.No</th>
                                <th>
                                    Transaction Code
                                </th>
                                <th>Customer Name </th>
                                <th>Transaction Type </th>
                                <th>Transaction Method </th>
                                <th>Bank Acc Name</th>
                                <th>Amount</th>
                                <th>Date</th>
                               </tr>
                             </thead>
                             <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

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
                    </div>
                    


                    
                                    <!-- vendor reports-->    

             <div class="row mx-1" id="vendor-reports" style="display:none;"> 
                  <div class="card">
                    <div class="card-header">
                    <h4>  <image id="return-button2" class="mb-2 mr-3" src="<?php echo e(asset('assets/images/Return-back.svg')); ?>"></image>
              Vendor</h4>
               
                    </div>
         <div class="row py-4">
                 
                    

                 
                    <div class="col-sm-3 form-group" style="position: relative;">
                         <?php echo e(Form::label('period',__('From Date'))); ?>

                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepicker" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon" style="position: absolute; right: 26px; top: 60%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                       
                    <div class="col-sm-3 form-group" style="position: relative;">
                         <?php echo e(Form::label('period',__('To Date'))); ?>

                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepickerTo" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon1" style="position: absolute; right: 26px; top: 60%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                   
                    <div class="col-sm-3 form-group">
                      <?php echo e(Form::label('period',__('Period'))); ?>

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
                         <?php echo e(Form::label('period',__('Period'))); ?>

                         <select class="form-control text-primary" id="yearSelect" style="border-radius: 15px;">Select Year</select>

                   </div> 
                  
                  
          
        <!--Sales Report    -->
        <div class="col-12">
            <div class="card pt-5">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 form-group" id="vendor-transcation-show-div">
                            
                         <a  class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                            Customer Transaction Entry
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Transaction Invoice
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Transaction Reports
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 


                        
                       
                       
                       
                    </div>
                    </div>
                    </div>


                    <div class="row mx-1" id="vendor-transaction-list" style="display:none;" > 
                  <div class="card" >
                    <div class="card-header">
                    <h4> 
              Customer Receive / Payment Entry</h4>
               
                    </div>
         <div class="row py-4">
                 
                 
                  
                  
          
        <!--Sales Report    -->
        <div class="col-12">
            <div class="card pt-5">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            
                         <a  class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                            Choose a Transaction Type
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                           Choose the Payment Method
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Name
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 

                        <div class="col-sm-4 form-group">
                            
                            <a href="<?php echo e(route('report.lead')); ?>" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                              Current Due
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                           <div class="col-sm-4 form-group">
                            <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                               Amount
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                           <div class="col-sm-4 form-group">
                               
                            <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                              Note
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                    </div>
                    </div>
                    </div>

                    <div class="">
                        <div class="card-header">
                            <h4>
                            Customer Transaction List
                            </h4>
                        </div>
                        <table>
                            <thead class="card-header bg-gradient bg-light">
                               <tr>
                                <th>S.No</th>
                                <th>
                                    Transaction Code
                                </th>
                                <th>Customer Name </th>
                                <th>Transaction Type </th>
                                <th>Transaction Method </th>
                                <th>Bank Acc Name</th>
                                <th>Amount</th>
                                <th>Date</th>
                               </tr>
                             </thead>
                             <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

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

                    </div>


               <!--Miscellaneous reports-->     
             <div class="row mx-1" id="miscellaneous-reports" style="display:none;"> 
                  <div class="card">
                    <div class="card-header">
                    <h4>  <image id="return-button3" class="mb-2 mr-3" src="<?php echo e(asset('assets/images/Return-back.svg')); ?>"></image>
              Miscellaneous </h4>
               
                    </div>
         <div class="row py-4">
                 
                    

                 
                    <div class="col-sm-3 form-group" style="position: relative;">
                         <?php echo e(Form::label('period',__('From Date'))); ?>

                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepicker" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon" style="position: absolute; right: 26px; top: 60%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                       
                    <div class="col-sm-3 form-group" style="position: relative;">
                         <?php echo e(Form::label('period',__('To Date'))); ?>

                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepickerTo" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon1" style="position: absolute; right: 26px; top: 60%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                   
                    <div class="col-sm-3 form-group">
                      <?php echo e(Form::label('period',__('Period'))); ?>

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
                         <?php echo e(Form::label('period',__('Period'))); ?>

                         <select class="form-control text-primary" id="yearSelect" style="border-radius: 15px;">Select Year</select>

                   </div> 
                  
                  
          
        <!--Sales Report    -->
        <div class="col-12">
            <div class="card pt-5">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 form-group" id="miscellaneous-transcation-show-div">
                            
                         <a  class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                            Customer Transaction Entry
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Transaction Invoice
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Transaction Reports
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 


                        
                       
                       
                       
                    </div>
                    </div>
                    </div>


                    <div class="row mx-1" id="miscellaneous-transaction-list" style="display:none;" > 
                  <div class="card" >
                    <div class="card-header">
                    <h4> 
              Customer Receive / Payment Entry</h4>
               
                    </div>
         <div class="row py-4">
                 
                 
                  
                  
          
        <!--Sales Report    -->
        <div class="col-12">
            <div class="card pt-5">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            
                         <a  class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                            Choose a Transaction Type
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                           Choose the Payment Method
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Name
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 

                        <div class="col-sm-4 form-group">
                            
                            <a href="<?php echo e(route('report.lead')); ?>" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                              Current Due
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                           <div class="col-sm-4 form-group">
                            <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                               Amount
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                           <div class="col-sm-4 form-group">
                               
                            <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                              Note
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                    </div>
                    </div>
                    </div>

                    <div class="">
                        <div class="card-header">
                            <h4>
                            Customer Transaction List
                            </h4>
                        </div>
                        <table>
                            <thead class="card-header bg-gradient bg-light">
                               <tr>
                                <th>S.No</th>
                                <th>
                                    Transaction Code
                                </th>
                                <th>Customer Name </th>
                                <th>Transaction Type </th>
                                <th>Transaction Method </th>
                                <th>Bank Acc Name</th>
                                <th>Amount</th>
                                <th>Date</th>
                               </tr>
                             </thead>
                             <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

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

            </div>  
                 

              
              <!--bank Reports-->      
             <div class="row mx-1" id="bank-reports" style="display:none;"> 
                  <div class="card">
                    <div class="card-header">
                    <h4>  <image id="return-button4" class="mb-2 mr-3" src="<?php echo e(asset('assets/images/Return-back.svg')); ?>"></image>
              Bank</h4>
               
                    </div>
         <div class="row py-4">
                 
                    

                 
                    <div class="col-sm-3 form-group" style="position: relative;">
                         <?php echo e(Form::label('period',__('From Date'))); ?>

                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepicker" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon" style="position: absolute; right: 26px; top: 60%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                       
                    <div class="col-sm-3 form-group" style="position: relative;">
                         <?php echo e(Form::label('period',__('To Date'))); ?>

                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepickerTo" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon1" style="position: absolute; right: 26px; top: 60%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                   
                    <div class="col-sm-3 form-group">
                      <?php echo e(Form::label('period',__('Period'))); ?>

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
                         <?php echo e(Form::label('period',__('Period'))); ?>

                         <select class="form-control text-primary" id="yearSelect" style="border-radius: 15px;">Select Year</select>

                   </div> 
                  
                  
          
        <!--Sales Report    -->
        <div class="col-12">
            <div class="card pt-5">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 form-group" id="bank-transcation-show-div">
                            
                         <a  class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                            Customer Transaction Entry
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Transaction Invoice
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Transaction Reports
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 


                        
                       
                       
                       
                    </div>
                    </div>
                    </div>


                    <div class="row mx-1" id="bank-transaction-list" style="display:none;" > 
                  <div class="card" >
                    <div class="card-header">
                    <h4> 
              Customer Receive / Payment Entry</h4>
               
                    </div>
         <div class="row py-4">
                 
                 
                  
                  
          
        <!--Sales Report    -->
        <div class="col-12">
            <div class="card pt-5">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            
                         <a  class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                            Choose a Transaction Type
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                           Choose the Payment Method
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Name
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 

                        <div class="col-sm-4 form-group">
                            
                            <a href="<?php echo e(route('report.lead')); ?>" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                              Current Due
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                           <div class="col-sm-4 form-group">
                            <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                               Amount
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                           <div class="col-sm-4 form-group">
                               
                            <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                              Note
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                    </div>
                    </div>
                    </div>

                    <div class="">
                        <div class="card-header">
                            <h4>
                            Customer Transaction List
                            </h4>
                        </div>
                        <table>
                            <thead class="card-header bg-gradient bg-light">
                               <tr>
                                <th>S.No</th>
                                <th>
                                    Transaction Code
                                </th>
                                <th>Customer Name </th>
                                <th>Transaction Type </th>
                                <th>Transaction Method </th>
                                <th>Bank Acc Name</th>
                                <th>Amount</th>
                                <th>Date</th>
                               </tr>
                             </thead>
                             <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

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

            </div>  
                    

                    
             <div class="row mx-1" id="cash-reports" style="display:none;"> 
                  <div class="card">
                    <div class="card-header">
                    <h4>  <image id="return-button5" class="mb-2 mr-3" src="<?php echo e(asset('assets/images/Return-back.svg')); ?>"></image>
              Cash</h4>
               
                    </div>
         <div class="row py-4">
                 
                    

                 
                    <div class="col-sm-3 form-group" style="position: relative;">
                         <?php echo e(Form::label('period',__('From Date'))); ?>

                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepicker" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon" style="position: absolute; right: 26px; top: 60%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                       
                    <div class="col-sm-3 form-group" style="position: relative;">
                         <?php echo e(Form::label('period',__('To Date'))); ?>

                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepickerTo" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon1" style="position: absolute; right: 26px; top: 60%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                   
                    <div class="col-sm-3 form-group">
                      <?php echo e(Form::label('period',__('Period'))); ?>

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
                         <?php echo e(Form::label('period',__('Period'))); ?>

                         <select class="form-control text-primary" id="yearSelect" style="border-radius: 15px;">Select Year</select>

                   </div> 
                  
                  
          
        <!--Sales Report    -->
        <div class="col-12">
            <div class="card pt-5">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 form-group" id="cash-transcation-show-div">
                            
                         <a  class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                            Customer Transaction Entry
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Transaction Invoice
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Transaction Reports
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 


                        
                       
                       
                       
                    </div>
                    </div>
                    </div>


                    <div class="row mx-1" id="cash-transaction-list" style="display:none;" > 
                  <div class="card" >
                    <div class="card-header">
                    <h4> 
              Customer Receive / Payment Entry</h4>
               
                    </div>
         <div class="row py-4">
                 
                 
                  
                  
          
        <!--Sales Report    -->
        <div class="col-12">
            <div class="card pt-5">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            
                         <a  class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                            Choose a Transaction Type
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                           Choose the Payment Method
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Name
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 

                        <div class="col-sm-4 form-group">
                            
                            <a href="<?php echo e(route('report.lead')); ?>" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                              Current Due
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                           <div class="col-sm-4 form-group">
                            <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                               Amount
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                           <div class="col-sm-4 form-group">
                               
                            <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                              Note
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                    </div>
                    </div>
                    </div>

                    <div class="">
                        <div class="card-header">
                            <h4>
                            Customer Transaction List
                            </h4>
                        </div>
                        <table>
                            <thead class="card-header bg-gradient bg-light">
                               <tr>
                                <th>S.No</th>
                                <th>
                                    Transaction Code
                                </th>
                                <th>Customer Name </th>
                                <th>Transaction Type </th>
                                <th>Transaction Method </th>
                                <th>Bank Acc Name</th>
                                <th>Amount</th>
                                <th>Date</th>
                               </tr>
                             </thead>
                             <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

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

            </div>  

            <!--return-order-reports-->
                    
             <div class="row mx-1" id="return-orders-reports" style="display:none;"> 
                  <div class="card">
                    <div class="card-header">
                    <h4>  <image id="return-button6" class="mb-2 mr-3" src="<?php echo e(asset('assets/images/Return-back.svg')); ?>"></image>
              Return Orders</h4>
               
                    </div>
         <div class="row py-4">
                 
                    

                 
                    <div class="col-sm-3 form-group" style="position: relative;">
                         <?php echo e(Form::label('period',__('From Date'))); ?>

                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepicker" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon" style="position: absolute; right: 26px; top: 60%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                       
                    <div class="col-sm-3 form-group" style="position: relative;">
                         <?php echo e(Form::label('period',__('To Date'))); ?>

                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepickerTo" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon1" style="position: absolute; right: 26px; top: 60%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                   
                    <div class="col-sm-3 form-group">
                      <?php echo e(Form::label('period',__('Period'))); ?>

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
                         <?php echo e(Form::label('period',__('Period'))); ?>

                         <select class="form-control text-primary" id="yearSelect" style="border-radius: 15px;">Select Year</select>

                   </div> 
                  
                  
          
        <!--Sales Report    -->
        <div class="col-12">
            <div class="card pt-5">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 form-group" id="return-orders-transcation-show-div">
                            
                         <a  class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                            Customer Transaction Entry
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Transaction Invoice
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Transaction Reports
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 


                        
                       
                       
                       
                    </div>
                    </div>
                    </div>


                    <div class="row mx-1" id="return-orders-transaction-list" style="display:none;" > 
                  <div class="card" >
                    <div class="card-header">
                    <h4> 
              Customer Receive / Payment Entry</h4>
               
                    </div>
         <div class="row py-4">
                 
                 
                  
                  
          
        <!--Sales Report    -->
        <div class="col-12">
            <div class="card pt-5">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            
                         <a  class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                            Choose a Transaction Type
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                           Choose the Payment Method
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                            Customer Name
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 

                        <div class="col-sm-4 form-group">
                            
                            <a href="<?php echo e(route('report.lead')); ?>" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;--bs-btn-color: unset;">
                              Current Due
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                           <div class="col-sm-4 form-group">
                            <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                               Amount
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                           <div class="col-sm-4 form-group">
                               
                            <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:290px;">
                              Note
                               <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                            </a>
                           
                           </div> 
                    </div>
                    </div>
                    </div>

                    <div class="">
                        <div class="card-header">
                            <h4>
                            Customer Transaction List
                            </h4>
                        </div>
                        <table>
                            <thead class="card-header bg-gradient bg-light">
                               <tr>
                                <th>S.No</th>
                                <th>
                                    Transaction Code
                                </th>
                                <th>Customer Name </th>
                                <th>Transaction Type </th>
                                <th>Transaction Method </th>
                                <th>Bank Acc Name</th>
                                <th>Amount</th>
                                <th>Date</th>
                               </tr>
                             </thead>
                             <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>BH342</td>
                                    <td>Piyush Joshi</td>
                                    <td>Recive</td>
                                    <td>Cash</td>
                                    <td>Piyush Joshi</td>
                                    <td>Amount</td>
                                    <td>Date</td>

                                </tr>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Trumen\resources\views/report/finance_report.blade.php ENDPATH**/ ?>
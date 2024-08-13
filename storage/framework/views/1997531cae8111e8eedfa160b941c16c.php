
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Inventory Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Inventory Report')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
   
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
<?php $__env->stopPush(); ?>



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


        document.querySelector('#show-div1 a').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default anchor behavior
    console.log("dslkfsdlkf")
   

    var targetDiv = document.getElementById('product-stock');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('inventory-main');
   
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

    var targetDiv = document.getElementById('product-stock');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('inventory-main');
    
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
   

    var targetDiv = document.getElementById('material-stock');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('inventory-main');
   
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

    var targetDiv = document.getElementById('material-stock');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('inventory-main');
    
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
   

    var targetDiv = document.getElementById('dead-stock');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('inventory-main');
   
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

    var targetDiv = document.getElementById('dead-stock');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('inventory-main');
    
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
   

    var targetDiv = document.getElementById('dead-material');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('inventory-main');
   
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

    var targetDiv = document.getElementById('dead-material');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('inventory-main');
    
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
   

    var targetDiv = document.getElementById('damage-product');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('inventory-main');
   
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

    var targetDiv = document.getElementById('damage-product');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('inventory-main');
    
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
   

    var targetDiv = document.getElementById('damage-material');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('inventory-main');
   
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

    var targetDiv = document.getElementById('damage-material');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('inventory-main');
    
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
   

    var targetDiv = document.getElementById('purchase-order');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('inventory-main');
   
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

    var targetDiv = document.getElementById('purchase-order');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('inventory-main');
    
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
   

    var targetDiv = document.getElementById('return-order');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('inventory-main');
   
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

    var targetDiv = document.getElementById('return-order');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('inventory-main');
    
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
   

    var targetDiv = document.getElementById('order-request');
    console.log(targetDiv)
    if (targetDiv.style.display === 'none'){
       
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv = document.getElementById('inventory-main');
   
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

    var targetDiv = document.getElementById('order-request');

    if (targetDiv.style.display === 'none'){
        targetDiv.style.display = 'block';
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv.style.display = 'none';
    }

    var targetDiv2 = document.getElementById('inventory-main');
    
    if (targetDiv2.style.display === 'none'){
        targetDiv2.style.display = 'block';
      
        // targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        targetDiv2.style.display = 'none';
    }

    
   


    
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
   

<div class="row" id="inventory-main" >
         <div class="row "  style="margin:-2px;">
                  
                    

                 
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

            <div class="card-header">

            </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 form-group" id="show-div1">
                            
                         <a  class="btn btn-outline-secondary btn-lg text-center" style="width:300px;--bs-btn-color: unset;">
                             Product Stock
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div2">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Material Stock
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div3">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Dead Stock
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group" id="show-div4">
                         <a id="payment-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Dead Material
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 

                        <div class="col-sm-4 form-group" id="show-div5">
                         <a id="payment-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Damage Product
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 

                        <div class="col-sm-4 form-group" id="show-div6">
                         <a id="payment-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Damage Material
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 

                        <div class="col-sm-4 form-group" id="show-div7">
                         <a id="payment-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Purchase Order
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 

                        <div class="col-sm-4 form-group" id="show-div8">
                         <a id="payment-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Return Orders
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 

                        <div class="col-sm-4 form-group" id="show-div9">
                         <a id="payment-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                              Order Request
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                       
                       
                    </div>
                </div>

            </div>
                    </div>
                    </div>


                    

            <div class="row" id="product-stock" style="display:none;" >
        <div class="col-xl-12">

            <div class="card">

            <div class="card-header " style="height:100%;">
            <h4>  <image id="return-button1" class="mb-2" src="<?php echo e(asset('assets/images/Return-back.svg')); ?>"></image>
                Product Stock</h4>
                </div>

            <div class="row my-5" style="margin:-2px;">
                  
                  

               
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
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th><?php echo e(__('No.')); ?></th> 
                                 <th><?php echo e(__('Product Code')); ?></th>
                                <th><?php echo e(__('Product Name')); ?></th>
                              
                            
                                <th><?php echo e(__('Unit Price')); ?></th>
                              
                                <th><?php echo e(__('Quantity')); ?></th>
                               
                             
                                <th><?php echo e(__('Stock Value')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                                <?php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                ?>
                                
                            <?php $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: <?php echo e(($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')))); ?>">
                                                   <?php echo e(str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT)); ?></div></td>
                                                   <td>
                                        <?php echo e(\Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...')); ?>

                                       </td>
                                   
                                                   <td>
                                        <div class="hover-content"><?php echo e($productService->name); ?></div>
                                                <div class="hover-trigger"><?php echo e(\Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...')); ?></div>
                                        </td>
                                        
                                  
                                   
                                    <td><?php echo e(\Auth::user()->priceFormat($productService->sale_price)); ?></td>
                                    <td><?php echo e($productService->quantity == 0?1:$productService->quantity); ?></td>
                                    <td><?php echo e($productService->ticket_priority); ?></td>
                             
                                   
                                   
                                  
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                  </div>
                  </div>
                  </div>


                  <!--Material Stock-->

                <div class="row" id="material-stock" style="display:none;">
        <div class="col-xl-12">

            <div class="card">

            <div class="card-header " style="height:100%;">
            <h4>  <image id="return-button2" class="mb-2" src="<?php echo e(asset('assets/images/Return-back.svg')); ?>"></image>
                Material Stock</h4>
                </div>

            <div class="row my-5" style="margin:-2px;">
                  
                  

               
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
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th><?php echo e(__('No.')); ?></th> 
                                 <th><?php echo e(__('Product Code')); ?></th>
                                <th><?php echo e(__('Product Name')); ?></th>
                              
                            
                                <th><?php echo e(__('Unit Price')); ?></th>
                              
                                <th><?php echo e(__('Quantity')); ?></th>
                               
                             
                                <th><?php echo e(__('Stock Value')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                                <?php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                ?>
                                
                            <?php $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: <?php echo e(($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')))); ?>">
                                                   <?php echo e(str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT)); ?></div></td>
                                                   <td>
                                        <?php echo e(\Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...')); ?>

                                       </td>
                                   
                                                   <td>
                                        <div class="hover-content"><?php echo e($productService->name); ?></div>
                                                <div class="hover-trigger"><?php echo e(\Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...')); ?></div>
                                        </td>
                                        
                                  
                                   
                                    <td><?php echo e(\Auth::user()->priceFormat($productService->sale_price)); ?></td>
                                    <td><?php echo e($productService->quantity == 0?1:$productService->quantity); ?></td>
                                    <td><?php echo e($productService->ticket_priority); ?></td>
                             
                                   
                                   
                                  
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                  </div>
                  </div>
                  </div>

                <div class="row" id="dead-stock" style="display:none;"  >
        <div class="col-xl-12">

            <div class="card">

            <div class="card-header " style="height:100%;">
            <h4>  <image id="return-button3" class="mb-2" src="<?php echo e(asset('assets/images/Return-back.svg')); ?>"></image>
                Dead Stock</h4>
                </div>

            <div class="row my-5" style="margin:-2px;">
                  
                  

               
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
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th><?php echo e(__('No.')); ?></th> 
                                 <th><?php echo e(__('Product Code')); ?></th>
                                <th><?php echo e(__('Product Name')); ?></th>
                              
                            
                                <th><?php echo e(__('Unit Price')); ?></th>
                              
                                <th><?php echo e(__('Quantity')); ?></th>
                               
                             
                                <th><?php echo e(__('Stock Value')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                                <?php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                ?>
                                
                            <?php $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: <?php echo e(($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')))); ?>">
                                                   <?php echo e(str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT)); ?></div></td>
                                                   <td>
                                        <?php echo e(\Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...')); ?>

                                       </td>
                                   
                                                   <td>
                                        <div class="hover-content"><?php echo e($productService->name); ?></div>
                                                <div class="hover-trigger"><?php echo e(\Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...')); ?></div>
                                        </td>
                                        
                                  
                                   
                                    <td><?php echo e(\Auth::user()->priceFormat($productService->sale_price)); ?></td>
                                    <td><?php echo e($productService->quantity == 0?1:$productService->quantity); ?></td>
                                    <td><?php echo e($productService->ticket_priority); ?></td>
                             
                                   
                                   
                                  
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                  </div>
                  </div>
                  </div>


                <div class="row" id="dead-material" style="display:none;" >
        <div class="col-xl-12">

            <div class="card">

            <div class="card-header " style="height:100%;">
            <h4>  <image id="return-button4" class="mb-2" src="<?php echo e(asset('assets/images/Return-back.svg')); ?>"></image>
                Dead Material</h4>
                </div>

            <div class="row my-5" style="margin:-2px;">
                  
                  

               
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
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th><?php echo e(__('No.')); ?></th> 
                                 <th><?php echo e(__('Product Code')); ?></th>
                                <th><?php echo e(__('Product Name')); ?></th>
                              
                            
                                <th><?php echo e(__('Unit Price')); ?></th>
                              
                                <th><?php echo e(__('Quantity')); ?></th>
                               
                             
                                <th><?php echo e(__('Stock Value')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                                <?php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                ?>
                                
                            <?php $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: <?php echo e(($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')))); ?>">
                                                   <?php echo e(str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT)); ?></div></td>
                                                   <td>
                                        <?php echo e(\Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...')); ?>

                                       </td>
                                   
                                                   <td>
                                        <div class="hover-content"><?php echo e($productService->name); ?></div>
                                                <div class="hover-trigger"><?php echo e(\Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...')); ?></div>
                                        </td>
                                        
                                  
                                   
                                    <td><?php echo e(\Auth::user()->priceFormat($productService->sale_price)); ?></td>
                                    <td><?php echo e($productService->quantity == 0?1:$productService->quantity); ?></td>
                                    <td><?php echo e($productService->ticket_priority); ?></td>
                             
                                   
                                   
                                  
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                  </div>
                  </div>
                  </div>


                <!--Damage product-->

                <div class="row" id="damage-product" style="display:none;" >
        <div class="col-xl-12">

            <div class="card">

            <div class="card-header " style="height:100%;">
            <h4>  <image id="return-button5" class="mb-2" src="<?php echo e(asset('assets/images/Return-back.svg')); ?>"></image>
                Damage Product</h4>
                </div>

            <div class="row my-5" style="margin:-2px;">
                  
                  

               
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
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th><?php echo e(__('No.')); ?></th> 
                                 <th><?php echo e(__('Product Code')); ?></th>
                                <th><?php echo e(__('Product Name')); ?></th>
                              
                            
                                <th><?php echo e(__('Unit Price')); ?></th>
                              
                                <th><?php echo e(__('Quantity')); ?></th>
                               
                             
                                <th><?php echo e(__('Stock Value')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                                <?php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                ?>
                                
                            <?php $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: <?php echo e(($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')))); ?>">
                                                   <?php echo e(str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT)); ?></div></td>
                                                   <td>
                                        <?php echo e(\Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...')); ?>

                                       </td>
                                   
                                                   <td>
                                        <div class="hover-content"><?php echo e($productService->name); ?></div>
                                                <div class="hover-trigger"><?php echo e(\Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...')); ?></div>
                                        </td>
                                        
                                  
                                   
                                    <td><?php echo e(\Auth::user()->priceFormat($productService->sale_price)); ?></td>
                                    <td><?php echo e($productService->quantity == 0?1:$productService->quantity); ?></td>
                                    <td><?php echo e($productService->ticket_priority); ?></td>
                             
                                   
                                   
                                  
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                  </div>
                  </div>
                  </div>

                  <!--damage material-->
                <div class="row" id="damage-material" style="display:none;" >
        <div class="col-xl-12">

            <div class="card">

            <div class="card-header " style="height:100%;">
            <h4>  <image id="return-button6" class="mb-2" src="<?php echo e(asset('assets/images/Return-back.svg')); ?>"></image>
                Damage Material</h4>
                </div>

            <div class="row my-5" style="margin:-2px;">
                  
                  

               
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
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th><?php echo e(__('No.')); ?></th> 
                                 <th><?php echo e(__('Product Code')); ?></th>
                                <th><?php echo e(__('Product Name')); ?></th>
                              
                            
                                <th><?php echo e(__('Unit Price')); ?></th>
                              
                                <th><?php echo e(__('Quantity')); ?></th>
                               
                             
                                <th><?php echo e(__('Stock Value')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                                <?php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                ?>
                                
                            <?php $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: <?php echo e(($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')))); ?>">
                                                   <?php echo e(str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT)); ?></div></td>
                                                   <td>
                                        <?php echo e(\Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...')); ?>

                                       </td>
                                   
                                                   <td>
                                        <div class="hover-content"><?php echo e($productService->name); ?></div>
                                                <div class="hover-trigger"><?php echo e(\Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...')); ?></div>
                                        </td>
                                        
                                  
                                   
                                    <td><?php echo e(\Auth::user()->priceFormat($productService->sale_price)); ?></td>
                                    <td><?php echo e($productService->quantity == 0?1:$productService->quantity); ?></td>
                                    <td><?php echo e($productService->ticket_priority); ?></td>
                             
                                   
                                   
                                  
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                  </div>
                  </div>
                  </div>


                <div class="row" id="purchase-order" style="display:none;" >
        <div class="col-xl-12">

            <div class="card">

            <div class="card-header " style="height:100%;">
            <h4>  <image id="return-button7" class="mb-2" src="<?php echo e(asset('assets/images/Return-back.svg')); ?>"></image>
                Purchase Order</h4>
                </div>

            <div class="row my-5" style="margin:-2px;">
                  
                  

               
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
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th><?php echo e(__('No.')); ?></th> 
                                 <th><?php echo e(__('Product Code')); ?></th>
                                <th><?php echo e(__('Product Name')); ?></th>
                              
                            
                                <th><?php echo e(__('Unit Price')); ?></th>
                              
                                <th><?php echo e(__('Quantity')); ?></th>
                               
                             
                                <th><?php echo e(__('Stock Value')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                                <?php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                ?>
                                
                            <?php $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: <?php echo e(($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')))); ?>">
                                                   <?php echo e(str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT)); ?></div></td>
                                                   <td>
                                        <?php echo e(\Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...')); ?>

                                       </td>
                                   
                                                   <td>
                                        <div class="hover-content"><?php echo e($productService->name); ?></div>
                                                <div class="hover-trigger"><?php echo e(\Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...')); ?></div>
                                        </td>
                                        
                                  
                                   
                                    <td><?php echo e(\Auth::user()->priceFormat($productService->sale_price)); ?></td>
                                    <td><?php echo e($productService->quantity == 0?1:$productService->quantity); ?></td>
                                    <td><?php echo e($productService->ticket_priority); ?></td>
                             
                                   
                                   
                                  
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                  </div>
                  </div>
                  </div>
 
                  <!--return order-->

                <div class="row" id="return-order" style="display:none;" >
        <div class="col-xl-12">

            <div class="card">

            <div class="card-header " style="height:100%;">
            <h4>  <image id="return-button8" class="mb-2" src="<?php echo e(asset('assets/images/Return-back.svg')); ?>"></image>
                Return Order</h4>
                </div>

            <div class="row my-5" style="margin:-2px;">
                  
                  

               
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
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th><?php echo e(__('No.')); ?></th> 
                                 <th><?php echo e(__('Product Code')); ?></th>
                                <th><?php echo e(__('Product Name')); ?></th>
                              
                            
                                <th><?php echo e(__('Unit Price')); ?></th>
                              
                                <th><?php echo e(__('Quantity')); ?></th>
                               
                             
                                <th><?php echo e(__('Stock Value')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                                <?php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                ?>
                                
                            <?php $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: <?php echo e(($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')))); ?>">
                                                   <?php echo e(str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT)); ?></div></td>
                                                   <td>
                                        <?php echo e(\Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...')); ?>

                                       </td>
                                   
                                                   <td>
                                        <div class="hover-content"><?php echo e($productService->name); ?></div>
                                                <div class="hover-trigger"><?php echo e(\Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...')); ?></div>
                                        </td>
                                        
                                  
                                   
                                    <td><?php echo e(\Auth::user()->priceFormat($productService->sale_price)); ?></td>
                                    <td><?php echo e($productService->quantity == 0?1:$productService->quantity); ?></td>
                                    <td><?php echo e($productService->ticket_priority); ?></td>
                             
                                   
                                   
                                  
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                  </div>
                  </div>
                  </div>


                  <!--order request-->

                <div class="row" id="order-request" style="display:none;" >
        <div class="col-xl-12">

            <div class="card">

            <div class="card-header " style="height:100%;">
            <h4>  <image id="return-button9" class="mb-2" src="<?php echo e(asset('assets/images/Return-back.svg')); ?>"></image>
                Order Request</h4>
                </div>

            <div class="row my-5" style="margin:-2px;">
                  
                  

               
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
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th><?php echo e(__('No.')); ?></th> 
                                 <th><?php echo e(__('Product Code')); ?></th>
                                <th><?php echo e(__('Product Name')); ?></th>
                              
                            
                                <th><?php echo e(__('Unit Price')); ?></th>
                              
                                <th><?php echo e(__('Quantity')); ?></th>
                               
                             
                                <th><?php echo e(__('Stock Value')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                                <?php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                ?>
                                
                            <?php $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: <?php echo e(($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')))); ?>">
                                                   <?php echo e(str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT)); ?></div></td>
                                                   <td>
                                        <?php echo e(\Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...')); ?>

                                       </td>
                                   
                                                   <td>
                                        <div class="hover-content"><?php echo e($productService->name); ?></div>
                                                <div class="hover-trigger"><?php echo e(\Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...')); ?></div>
                                        </td>
                                        
                                  
                                   
                                    <td><?php echo e(\Auth::user()->priceFormat($productService->sale_price)); ?></td>
                                    <td><?php echo e($productService->quantity == 0?1:$productService->quantity); ?></td>
                                    <td><?php echo e($productService->ticket_priority); ?></td>
                             
                                   
                                   
                                  
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Trumen\resources\views/report/inventory_report.blade.php ENDPATH**/ ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Sales Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Sales Report')); ?></li>
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
   

    <div class="row">
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
                <div class="card-header">
                   <h5>Sales Reports</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            
                         <a href="<?php echo e(route('report.lead')); ?>" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;--bs-btn-color: unset;">
                            Lead Report 
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="invoice-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Invoice Report 
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                            
                         <a id="product-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Product (Item) Report 
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="payment-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Payment Received 
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="proposal-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Proposal Report 
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        </div> 
                        <div class="col-sm-4 form-group">
                         <a id="customer-report" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Customers Report 
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                    </div>
                </div>

            </div>
              <div class="card">
                <div class="card-header">
                   <h5>Chart Based Reports</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 form-group">
                        
                         <a id="income-select" class="btn btn-outline-secondary btn-lg text-center" style="width:300px;">
                             Total Income 
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        </div> 
                        <div class="col-sm-4 form-group">
                        <a id="transaction-select" class="btn btn-outline-secondary btn-lg" style="width:300px;">
                             Payment Mades(Transactions)
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                        
                        </div> 
                        <div class="col-sm-4 form-group">
                          <a id="customer-select" class="btn btn-outline-secondary btn-lg" style="width:300px;">
                            Total Value By Customer Groups
                            <i class="ti ti-chevron-right" style="float: inline-end;"></i>  
                         </a>
                         
                        </div> 
                       
                    </div>
                </div>

            </div>
        </div>
        <!--End seles report-->
        <div class="col-12" id="invoice-container">
             <div class="col-xxl-12 mt-5 d-none" id="income-expense">
                            <div class="card">
                                <div class="card-header">
                                     <h5>Generated Report</h5>
                                        <span class="float-end text-muted"><?php echo e(__('Current Year').' - '.$currentYear); ?></span>
                                    </h5>

                                </div>
                                <div class="card-body">
                                    <div id="incExpBarChart"></div>
                                </div>
                            </div>
             </div>
             <div class="col-xxl-12 mt-5 d-none" id="transaction-expense">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Generated Report</h5>
                                        <span class="float-end text-muted"><?php echo e(__('Current Year').' - '.$currentYear); ?></span>
                                    </h5>

                                </div>
                                <div class="card-body">
                                    <div id="incTraBarChart"></div>
                                </div>
                            </div>
             </div>
             <div class="col-xxl-12 mt-5 d-none" id="customer-expense">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Generated Report</h5>
                                        <span class="float-end text-muted"><?php echo e(__('Current Year').' - '.$currentYear); ?></span>
                                    </h5>

                                </div>
                                <div class="card-body">
                                   
                                    <div id="incCstBarChart"></div>
                                </div>
                            </div>
             </div>
            <div class="card" id="generated-report">
                <div class="card-header">
                      <h5>Generated Report</h5>
                    <div class="d-flex justify-content-between w-100" style="padding-top: 10px;">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="profile-tab3" data-bs-toggle="pill" href="#item" role="tab" aria-controls="pills-item" aria-selected="true"><?php echo e(__('Product Report')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab4" data-bs-toggle="pill" href="#customer" role="tab" aria-controls="pills-customer" aria-selected="false"><?php echo e(__('Customer Report')); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body" id="printableArea">
                    <div class="row">
                        <div class="col-sm-12">
                          
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade fade show active" id="item" role="tabpanel" aria-labelledby="profile-tab3">
                                    <div class="table-responsive">
                                    <table class="table pc-dt-simple" id="item-reort">
                                        <thead>
                                        <tr>
                                            <th width="33%"> <?php echo e(__('Item')); ?></th>
                                            <th width="33%"> <?php echo e(__('Quantity')); ?></th>
                                            <th width="33%"> <?php echo e(__('Total Amount')); ?></th>
                                            <th> <?php echo e(__('Average Price')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $invoiceItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoiceItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($invoiceItem['name']); ?></td>
                                                    <td><?php echo e($invoiceItem['quantity']); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($invoiceItem['price'])); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($invoiceItem['avg_price'])); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>

                                <div class="tab-pane fade fade" id="customer" role="tabpanel" aria-labelledby="profile-tab3">
                                    <div class="table-responsive">
                                    <table class="table pc-dt-simple" id="customer-report">
                                        <thead>
                                        <tr>
                                            <th width="33%"> <?php echo e(__('Customer Name')); ?></th>
                                            <th width="33%"> <?php echo e(__('Total Invoice')); ?></th>
                                            <th width="33%"> <?php echo e(__('Amount')); ?></th>
                                            <th class="text-end"> <?php echo e(__('Amount With Tax')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $invoiceCustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoiceCustomer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($invoiceCustomer['name']); ?></td>
                                                    <td><?php echo e($invoiceCustomer['invoice_count']); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($invoiceCustomer['price'])); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($invoiceCustomer['price'] + $invoiceCustomer['total_tax'])); ?></td>
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

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/report/sales_report.blade.php ENDPATH**/ ?>
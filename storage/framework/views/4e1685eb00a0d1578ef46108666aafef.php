<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Order Request Detail')); ?>

<?php $__env->stopSection(); ?>

<?php
    $settings = Utility::settings();
?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', '#shipping', function () {
            var url = $(this).data('url');
            var is_display = $("#shipping").is(":checked");
            $.ajax({
                url: url,
                type: 'get',
                data: {
                    'is_display': is_display,
                },
                success: function (data) {
                    // console.log(data);
                }
            });
        })


    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('purchase.index')); ?>"><?php echo e(__('Oreder Request')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(Auth::user()->orderNumberFormat($purchase->id)); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice">
                        <div class="invoice-print">
                            <div class="row invoice-title mt-2">
                                <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                                    <h4><?php echo e(__('Order Request')); ?></h4>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                                    <h4 class="invoice-number"><?php echo e(Auth::user()->orderNumberFormat($purchase->id)); ?></h4>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                 <div class="col-6 text-start">
                                    <div class="d-flex align-items-center justify-content-start">
                                       <div class="col-6">
                                    <small>
                                        <strong><?php echo e(__('Status')); ?> :</strong><br>
                                            <span class="badge bg-success p-2 px-3 rounded"><?php echo e(__($purchase->status)); ?></span>
                                    </small>
                                </div>
                                  <div class="col-6">
                                    <small>
                                        <strong><?php echo e(__('Priority')); ?> :</strong><br>
                                            <span class="badge bg-success p-2 px-3 rounded"><?php echo e($purchase->priority); ?></span>
                                    </small>
                                </div>

                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <div class="me-4">
                                            <small>
                                                <strong><?php echo e(__('Issue Date')); ?> :</strong><br>
                                                <?php echo e(\Auth::user()->dateFormat($purchase->created_date)); ?><br><br>
                                            </small>
                                        </div>

                                    </div>
                                </div>
                            </div>


                          
                          
                             
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="font-bold mb-2"><?php echo e(__('Material Summary')); ?></div>
                                  
                                    <div class="table-responsive mt-3">
                                        <table class="table ">
                                            <tr>
                                                <th class="text-dark" data-width="40">#</th>
                                                <th class="text-dark"><?php echo e(__('Material')); ?></th>
                                                <th class="text-dark"><?php echo e(__('Quantity')); ?></th>
                                                <th class="text-dark"><?php echo e(__('Rate')); ?></th>
                                                <th class="text-dark"><?php echo e(__('Discount')); ?></th>
                                                <th class="text-dark"><?php echo e(__('Tax')); ?></th>
                                                <th class="text-dark"><?php echo e(__('Description')); ?></th>
                                                <th class="text-end text-dark" width="12%"><?php echo e(__('Price')); ?><br>
                                                    <small class="text-danger font-weight-bold"><?php echo e(__('after tax & discount')); ?></small>
                                                </th>
                                                <th></th>
                                            </tr>
                                            <?php
                                                $totalQuantity=0;
                                                $totalRate=0;
                                                $totalTaxPrice=0;
                                                $totalDiscount=0;
                                                $taxesData=[];
                                            ?>

                                          
                                               
                                                <tr>
                                                    <td><?php echo e(1); ?></td>
                                                    <td><?php echo e(!empty($iteams)?$iteams->material_name:''); ?></td>
                                                    <td><?php echo e($purchase->qty); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($purchase->price)); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($purchase->discount)); ?></td>

                                                    <?php
                                                   
                                                    $totalRate += $purchase->price * $purchase->qty;
                                                    $totalDiscount += $purchase->discount;
                                                ?>
                                                   
                                                    <td>
                                                       
                                                    </td>
                                                    <td><?php echo e(!empty($purchase->note)?$purchase->note:'-'); ?></td>
                                                    <td class="text-end"><?php echo e($purchase->price * $purchase->qty); ?></td>
                                                </tr>
                                           
                                          
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/orderrequest/view.blade.php ENDPATH**/ ?>
<?php
$profile = asset(Storage::url('uploads/avatar/'));
?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
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
<?php $__env->startPush('script-page'); ?>
    <script>
        jQuery(document).ready(function() {
         jQuery('#loading').fadeOut(3000);
        });
        $(document).on('click', '#billing_data', function() {
            $("[name='shipping_name']").val($("[name='billing_name']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_phone']").val($("[name='billing_phone']").val());
            $("[name='shipping_zip']").val($("[name='billing_zip']").val());
            $("[name='shipping_address']").val($("[name='billing_address']").val());
        })
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Vendors')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Vendor')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" class="btn btn-sm btn-primary" data-url="<?php echo e(route('vender.file.import')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip"
           title="<?php echo e(__('Import')); ?>">
        
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M4 19H20V12H22V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V12H4V19ZM13 9V16H11V9H6L12 3L18 9H13Z"></path></svg>
            <?php echo e(__('Import')); ?>

        </a>

        <a href="<?php echo e(route('vender.export')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M13 10H18L12 16L6 10H11V3H13V10ZM4 19H20V12H22V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V12H4V19Z"></path></svg>
        <?php echo e(__('Export')); ?>

    </a>
        
        

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create vender')): ?>
            <a href="<?php echo e(route('vender.create')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
                <?php echo e(__('Add New Vendor')); ?>

            </a>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <div id="loading"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark rounded-5 border">
                                <tr>
                                    <th style="border-top-left-radius: 30px;border-bottom-left-radius: 30px;"><?php echo e(_('Sr.')); ?></th>
                                    <th><?php echo e(__('Vendor Name')); ?></th>
                                    <th><?php echo e(__('Company Name')); ?></th>
                                    <th><?php echo e(__('Phone Number')); ?></th>
                                    <th><?php echo e(__('Prepared By')); ?></th>
                                    <th><?php echo e(__('Quotation Date')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th style="border-top-right-radius: 30px;border-bottom-right-radius: 30px;"><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $venders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $Vender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="cust_tr" id="vend_detail">
                                       
                                        <td>
                                           
                                             <div class="number-color" style="font-size:12px;background-color: <?php echo e($Vender['status'] =='Waiting'?'#BFBBBB':(($Vender['status'] =='Approved')?'#28941F':'#EA4E44')); ?>">
                                                  <?php echo e($Vender['vender_id']); ?></div> 
                                        </td>
                                        <td><?php echo e($Vender['name']); ?></td>
                                        <td><?php echo e($Vender['company_name']); ?></td>
                                        <td><?php echo e($Vender['contact']); ?></td>
                                        <td><?php echo e($Vender->createdBy->name); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($Vender['created_at'])->format('d/m/Y')); ?></td>
                                        <td><?php echo e($Vender['status']); ?></td>
                                        <td class="Action">
                                            <span>
                                                    <?php if($Vender['is_active'] == 0): ?>
                                                        <i class="fa fa-lock" title="Inactive"></i>
                                                    <?php else: ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show vender')): ?>
                                                            <div class="action-btn bg-light ms-2">
                                                                <a href="<?php echo e(route('vender.show', \Crypt::encrypt($Vender['id']))); ?>"
                                                                    class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip"
                                                                    title="<?php echo e(__('View')); ?>">
                                                                    <i class="ti ti-eye text-dark"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit vender')): ?>
                                                            <div class="action-btn bg-light ms-2">
                                                                <a href="<?php echo e(route('vender.edit', $Vender['id'])); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                                    <i class="ti ti-pencil text-dark"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\_trumen\resources\views/vender/index.blade.php ENDPATH**/ ?>
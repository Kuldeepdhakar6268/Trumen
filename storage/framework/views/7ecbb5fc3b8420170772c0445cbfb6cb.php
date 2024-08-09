
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Material Stock')); ?>

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
.dataTable-table thead>tr>th{
        padding: 9px 0px 11px 14px !important; 
}
.dataTable-table td:not(:first-child) {       padding-left: 10px !important;
   }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Material Stock')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" data-size="md"  data-bs-toggle="tooltip" title="<?php echo e(__('Import')); ?>" data-url="<?php echo e(route('productservice.file.import')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Import product CSV file')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-import"></i>
        </a>
        <a href="<?php echo e(route('productservice.export')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-export"></i>
        </a>

        <a href="<?php echo e(route('productservice.create')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create New Product')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row" style="padding:21px;">   
    <div class="col-md-8">
          <a href="<?php echo e(route('materialstock.create')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create New Product')); ?>" class="btn btn-outline-light text-primary" style="margin-left: 15px;box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.2), 0 2px 5px 0 rgba(0, 0, 0, 0.19);
  text-align: center;">
            <i class="ti ti-plus" style="border: 1px solid;border-radius:5px;"></i>
             <?php echo e(__('Add New Stock')); ?>

        </a>
       
        </div>
        <div class="col-md-4">
       
    </div>
    </div>
    <div class="row">
                   <div class="col-sm-4 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Current Stock</option>
                           <option value="1">Total Stock</option>
                           <option value="2">Product wise Stock</option>
                           
                           </select>
                   </div>
                  
                   <div class="col-sm-4 form-group">
                       <?php echo e(Form::select('mList', $mList,null, array('class' => 'form-control select'))); ?>

                   </div>
                   <div class="col-sm-4 form-group" >
                   </div>
                  
            </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th><?php echo e(__('Sr.')); ?></th>
                                <th><?php echo e(__('Material Code')); ?></th>
                                <th><?php echo e(__('Material Name')); ?></th>
                                <th><?php echo e(__('Unit Price')); ?></th>
                                <th><?php echo e(__('Current Quantity')); ?></th>
                                <th><?php echo e(__('Stock Value')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td>
                                        <div class="number-color" style="background-color:#28941F;width: 50px;height: 40px;">
                                        <?php echo e($loop->iteration); ?></div>
                                        </td>
                                    <td><?php echo e($material->material_code); ?></td>
                                    <td><?php echo e($material->material_name); ?></td>
                                    <td><?php echo e($material->unit_price); ?></td>
                                    <td><?php echo e($material->current_qty); ?></td>
                                    <td><?php echo e($material->stock_value); ?></td>

                                    <td class="Action">
                                        <div class="action-btn bg-info ms-2">
                                            <a href="<?php echo e(route('materialstock.edit', $material->id)); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Update Quantity')); ?>">
                                                <i class="ti ti-plus text-white"></i>
                                            </a>
                                        </div>


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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Trumen\resources\views/materialstock/index.blade.php ENDPATH**/ ?>
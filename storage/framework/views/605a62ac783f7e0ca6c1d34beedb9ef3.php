 
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Material & Specifications')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
<style>
.card:not(.table-card) .table tr th:last-child {
 border-top-right-radius: 30px;
 border-bottom-right-radius: 30px; 

}
.card:not(.table-card) .table tr th:first-child {

  border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
}  
.dataTable-table tbody tr td {
    padding: 0px 0px 0px 0px !important;
} 
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Material & Specifications')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
       
        

        <a href="#" data-size="xl" data-url="<?php echo e(route('productspecification.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create Specification')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th><?php echo e(__('Sr.')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Category')); ?></th>
                                <th><?php echo e(__('Model')); ?></th>
                                <th><?php echo e(__('Price')); ?></th>
                                
                                <th><?php echo e(__('Created_by')); ?></th>
                                <th><?php echo e(__('Created Date')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                     <td> <div class="number-color action-btn bg-primary ms-2" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;margin-left: 0px !important;">
                                                   <?php echo e($productService->id); ?></div></td>
                                    <td><?php echo e($productService->name); ?></td>
                                    <td><?php echo e(!empty($productService->category)?$productService->category->name:''); ?></td>
                                    <td><?php echo e(!empty($productService->model)?$productService->model->name:''); ?></td>
                                    <td>
                                        <?php
                                         $sum = \App\Models\Specification::where('priority', '=', $productService->id)->sum('price');
                                        ?>
                                        <?php echo e($sum); ?></td>
                                    
                                    
                                    <td><?php echo e($productService->users->name); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($productService->created_at)->format('d M Y')); ?></td>
                                    <?php if(Gate::check('edit product & service') || Gate::check('delete product & service')): ?>
                                        <td class="Action">

                                           

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit product & service')): ?>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="<?php echo e(route('productspecification.edit',$productService->id)); ?>" data-ajax-popup="true"  data-size="xl" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"  data-title="<?php echo e(__('Edit Materials')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                           <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete product & service')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['productspecification.destroy', $productService->id],'id'=>'delete-form-'.$productService->id]); ?>

                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" ><i class="ti ti-trash text-white"></i></a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/productspecification/index.blade.php ENDPATH**/ ?>
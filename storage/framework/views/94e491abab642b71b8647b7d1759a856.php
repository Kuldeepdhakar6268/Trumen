

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Categories')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Categories')); ?></li>
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
<?php $__env->startSection('action-btn'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create label')): ?>
        <div class="float-end">
            <a href="#" data-size="md" data-url="<?php echo e(route('groups.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create Group')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
       
         <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th><?php echo e(__('Sr.')); ?></th>
                                <th><?php echo e(__('Category')); ?></th>
                                <th width="250px"><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><div class="number-color action-btn bg-primary ms-2" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;margin-left: 0px !important;"><?php echo e($loop->iteration); ?> </div></td>
                                    <td><?php echo e($group->name); ?></td>
                                    <td class="Active">

                                       
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="<?php echo e(URL::to('groups/'.$group->id.'/edit')); ?>" data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Source')); ?>">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                       
                                            <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['groups.destroy', $group->id]]); ?>

                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>
                                                <?php echo Form::close(); ?>

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


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Trumen\resources\views/groups/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Contract')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Contract')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="<?php echo e(route('contract.index')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('List View')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-list"></i>
        </a>
        <?php if(\Auth::user()->type == 'company'): ?>
            <a href="#" data-size="md" data-url="<?php echo e(route('contract.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create New Contract')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php $__currentLoopData = $contracts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <a href="<?php echo e(route('contract.show',$contract->id)); ?>" class="mb-0"><?php echo e($contract->subject); ?></a>
                    <?php if(\Auth::user()->type == 'company'): ?>
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    <button type="button" class="btn dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="#!" data-size="md" data-url="<?php echo e(route('contract.edit',$contract->id)); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit User')); ?>">
                                            <i class="ti ti-pencil"></i>
                                            <span><?php echo e(__('Edit')); ?></span>
                                        </a>
                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['contract.destroy', $contract->id]]); ?>

                                        <a href="#!" class="dropdown-item bs-pass-para">
                                            <i class="ti ti-archive"></i>
                                            <span> <?php echo e(__('Delete')); ?></span>
                                        </a>
                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body py-3 flex-grow-1">
                        <p class="text-sm mb-0">
                            <?php echo e($contract->description); ?>

                        </p>
                    </div>
                    <div class="card-footer py-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-label"><?php echo e(__('Contract Type')); ?>:</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="badge bg-secondary p-2 px-3 rounded"><?php echo e(!empty($contract->types)?$contract->types->name:''); ?></span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-label"><?php echo e(__('Contract Value')); ?>:</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="badge bg-secondary p-2 px-3 rounded"><?php echo e(\Auth::user()->priceFormat($contract->value)); ?></span>
                                    </div>
                                </div>
                            </li>
                            <?php if(\Auth::user()->type!='client'): ?>
                                <li class="list-group-item px-0">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="form-label"><?php echo e(__('Client')); ?>:</span>
                                        </div>
                                        <div class="col-6 text-end">
                                            <?php echo e(!empty($contract->clients)?$contract->clients->name:''); ?>

                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <small><?php echo e(__('Start Date')); ?>:</small>
                                        <div class="h6 mb-0"><?php echo e(\Auth::user()->dateFormat($contract->start_date )); ?></div>
                                    </div>
                                    <div class="col-6">
                                        <small><?php echo e(__('End Date')); ?>:</small>
                                        <div class="h6 mb-0"><?php echo e(\Auth::user()->dateFormat($contract->end_date )); ?></div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/contract/grid.blade.php ENDPATH**/ ?>
<?php echo e(Form::open(array('url'=>'todos','method'=>'post'))); ?>

<div class="modal-body">
<div class="row">
    <div class="col-8">
        <div class="form-group">
            <?php echo e(Form::label('name', __('Task name'),['class' => 'form-label'])); ?>

            <?php echo e(Form::text('name', null, ['class' => 'form-control','required'=>'required'])); ?>

             <?php echo e(Form::hidden('reminder',0, ['class' => 'form-control','required'=>'required'])); ?>

        </div>
    </div>
   
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('description', __('Description'),['class' => 'form-label'])); ?>

            <small class="form-text text-muted mb-2 mt-0"><?php echo e(__('This textarea will autosize while you type')); ?></small>
            <?php echo e(Form::textarea('description', null, ['class' => 'form-control','rows'=>'1','data-toggle' => 'autosize'])); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('hrs', __('Estimated Hours'),['class' => 'form-label'])); ?>

            <small class="form-text text-muted mb-2 mt-0"><?php echo e(__('Total hrs of project ')); ?></small>
            <?php echo e(Form::number('hrs', null, ['class' => 'form-control','required' => 'required','min'=>'0','maxlength' => '8'])); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('priority', __('Priority'),['class' => 'form-label'])); ?>

            <small class="form-text text-muted mb-2 mt-0"><?php echo e(__('Set Priority of your task')); ?></small>
            <select class="form-control" name="priority" id="priority" required>
                <?php $__currentLoopData = \App\Models\ProjectTask::$priority; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>"><?php echo e(__($val)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('start', __('Start Date'),['class' => 'form-label'])); ?>

            <?php echo e(Form::date('start', null, ['class' => 'form-control'])); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('end', __('End Date'),['class' => 'form-label'])); ?>

            <?php echo e(Form::date('end', null, ['class' => 'form-control'])); ?>

            <?php echo e(Form::time('time','00:00:00', ['class' => 'form-control'])); ?>

        </div>
    </div>
</div>

</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp\htdocs\Trumen\resources\views/task/create.blade.php ENDPATH**/ ?>
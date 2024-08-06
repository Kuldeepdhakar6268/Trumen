<?php echo e(Form::open(array('url'=>'todos','method'=>'post'))); ?>

<div class="modal-body">
<div class="row">
    <div class="col-8">
        <div class="form-group">
            <?php echo e(Form::label('name', __('Task name'),['class' => 'form-label'])); ?>

            <?php echo e(Form::text('name', null, ['class' => 'form-control','required'=>'required'])); ?>

            <?php echo e(Form::hidden('reminder', 1, ['class' => 'form-control','required'=>'required'])); ?>

        </div>
    </div>
   
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('description', __('Description'),['class' => 'form-label'])); ?>

            <small class="form-text text-muted mb-2 mt-0"><?php echo e(__('This textarea will autosize while you type')); ?></small>
            <?php echo e(Form::textarea('description', null, ['class' => 'form-control','rows'=>'1','data-toggle' => 'autosize'])); ?>

            <?php echo e(Form::hidden('hrs', null, ['class' => 'form-control','required' => 'required','min'=>'0','maxlength' => '8'])); ?>

            <?php echo e(Form::hidden('priority', 0, ['class' => 'form-control','required' => 'required','min'=>'0','maxlength' => '8'])); ?>

        </div>
    </div>
   
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('start', __('Date'),['class' => 'form-label'])); ?>

            <?php echo e(Form::date('start', null, ['class' => 'form-control'])); ?>

             <?php echo e(Form::hidden('end', null, ['class' => 'form-control'])); ?>

        </div>
    </div>
   <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('time', __('Time'),['class' => 'form-label'])); ?>

            <?php echo e(Form::time('time', null, ['class' => 'form-control'])); ?>

           
        </div>
    </div>
</div>

</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp\htdocs\_trumen\resources\views/task/createreminder.blade.php ENDPATH**/ ?>
<?php echo e(Form::model($leadStage, array('route' => array('lead_stages.update', $leadStage->id), 'method' => 'PUT'))); ?>

<?php
 $colors = [
        '#EACF2A',
        '#0AA350',
        '#101115',
        '#693599',
        '#449FE3',
        '#F48A1D',
        '#E91C2B'
       
    ];
?>
<div class="modal-body">
    <div class="row">
        <div class="form-group col-12">
            <?php echo e(Form::label('name', __('Stage Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-12">
            <?php echo e(Form::label('pipeline_id', __('Pipeline'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('pipeline_id', $pipelines,null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
         <div class="form-group col-12">
            <?php echo e(Form::label('color', __('Color'),['class'=>'form-label'])); ?>

            <div class="row gutters-xs">
                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="color" type="radio" value="<?php echo e($color); ?>" <?php if($leadStage->color == $color): ?> checked <?php endif; ?> class="colorinput-input">
                            <span class="colorinput-color" style="background-color: <?php echo e($color); ?>"></span>
                        </label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/lead_stages/edit.blade.php ENDPATH**/ ?>
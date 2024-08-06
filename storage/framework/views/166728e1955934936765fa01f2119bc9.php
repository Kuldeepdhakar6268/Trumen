<?php echo e(Form::open(array('url' => 'product-models','enctype' => "multipart/form-data"))); ?>

<div class="modal-body">
    
    <?php
        $plan= \App\Models\Utility::getChatGPTSettings();
    ?>
   
    
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('category_id', __('Category'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('category_id', $group,null, array('class' => 'form-control select','id' => 'group', 'required'=>'required'))); ?>


            <div class=" text-xs">

                <?php echo e(__('Please add constant category. ')); ?><a data-size="md" data-url="<?php echo e(route('groups.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" href="#"><b><?php echo e(__('Add Category')); ?></b></a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required', 'placeholder'=>__('Enter Model Name')))); ?>

            </div>
        </div>
      
    </div>
     
     
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>



<script>
    document.getElementById('pro_image').onchange = function () {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('image').src = src
    }

    //hide & show quantity
 
</script>
<?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/models/create.blade.php ENDPATH**/ ?>
<?php echo e(Form::model($productService, array('route' => array('productspecification.update', $productService->id), 'method' => 'PUT','enctype' => "multipart/form-data"))); ?>

<div class="modal-body">
    
    <?php
        $plan= \App\Models\Utility::getChatGPTSettings();
    ?>
    
    
    <div class="row">
       <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('name', $productService->name, array('class' => 'form-control','required'=>'required', 'placeholder'=>__('Enter Specification Name')))); ?>

            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo e($productService->id); ?>">
       
         <div class="form-group col-md-6">
            <?php echo e(Form::label('group_id', __('Category'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('group_id', $group,null, array('class' => 'form-control select','required'=>'required'))); ?>


            <div class=" text-xs">
                <?php echo e(__('Please add constant category. ')); ?><a data-size="md" data-url="<?php echo e(route('groups.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" href="#"><b><?php echo e(__('Add Category')); ?></b></a>
            </div>
        </div>
         <div class="form-group col-md-2">
            <?php echo e(Form::label('product_model_id', __('Model'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('product_model_id', $model,null, array('class' => 'form-control select','required'=>'required', 'id' => 'product_model'))); ?>


            <div class=" text-xs">
                <?php echo e(__('Please add constant category. ')); ?><a data-size="md" data-url="<?php echo e(route('groups.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" href="#"><b><?php echo e(__('Add Category')); ?></b></a>
            </div>
        </div>
         <div class="form-group col-md-4">
            <?php echo e(Form::label('el_mc', __('Choose one'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <div class="form-group row" style="height: 2.3rem;">
                                         <div class="col-sm-4 commp"> Mechanical <input type="radio" name="check" value="mc" <?php echo e($productService->el_mc == 'mc'?'checked':''); ?>></div>
                                         <div class="col-sm-4 commp">Electronics <input type="radio" name="check" value="el" <?php echo e($productService->el_mc == 'el'?'checked':''); ?>></div>
                                         <div class="col-sm-4 commp">Length <input type="checkbox" name="length" value="on" <?php echo e($productService->is_length == 'on'?'checked':''); ?>></div>  
                                         
                                          
                                    </div>
        </div>
         <div class="form-group col-md-3">
            <?php echo e(Form::label('el_mc', __('Parent'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
           <select class="form-control"name="parent" id="parent">
              <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <option value="<?php echo e($m->id); ?>" <?php echo e($productService->parent == $m->id?'selected':''); ?>><?php echo e($m->name); ?></option>
              
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           </select>
         </div>
        <?php if($subproductService[0]->prefix == null): ?>
         <div class="form-group col-md-3">
            <?php echo e(Form::label('child_id', __('Child'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
           <select class="form-control"name="child_id" id="child">
               <option value="" selected>Choose one</option>
              <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              
               <option value="<?php echo e($m->id); ?>" <?php echo e($productService->child_id == $m->id?'selected':''); ?>><?php echo e($m->name); ?></option>
              
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           </select>
         </div>
        <?php endif; ?>
       <?php if(count($subproductService)>0): ?> 
       <?php $__currentLoopData = $subproductService; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <div class="add_contact"><div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="prefix" class="form-label">BelongsTo</label>
                <?php if($productService->name == 'Gland'): ?>
                <input class="form-control" placeholder="Enter belonging specifications" name="belongs[]" type="text" id="belongs" value="<?php echo e($v->prefix); ?>">
                <?php else: ?>
                 <input class="form-control" placeholder="Enter belonging specifications" name="belongs[]" type="text" id="belongs" value="<?php echo e($v->belongs); ?>">
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                 <label for="prefix" class="form-label">Prefix</label>
                   <?php if($productService->name == 'Gland'): ?>
                 <input class="form-control" placeholder="Enter Prefix" name="prefix[]" type="text" id="prefix_name" value="">
                 <?php else: ?>
                 <input class="form-control" placeholder="Enter Prefix" name="prefix[]" type="text" id="prefix_name" value="<?php echo e($v->prefix); ?>">
                 <?php endif; ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="sub_specification" class="form-label">Name</label>
                <input class="form-control" placeholder="Enter Sub Specification" name="sub_specification[]" type="text" id="sub_specification" value="<?php echo e($v->name); ?>">
            </div>
        </div>
        <div class="col-md-2" style="width: 115px;">
            <div class="form-group">
                <label for="length_price" class="form-label">Length</label>
                <input class="form-control" placeholder="Ex: L250" name="length_price[]" type="text" id="length" value="<?php echo e($v->length_price); ?>">
            </div>
        </div>
        <div class="col-md-2" style="width: 115px;">
            <div class="form-group">
                <label for="price" class="form-label">INR</label>
                <input class="form-control" placeholder="INR Price" name="price[]" type="text" id="price" value="<?php echo e($v->price); ?>">
                </div>
            </div>
        <div class="col-md-1" style="width: 115px;">
            <div class="form-group"><label for="price" class="form-label">USD</label>
            <input class="form-control" placeholder="USD Price" name="usd_price[]" type="text" id="usd_price" value="<?php echo e($v->usd_price); ?>">
            </div>
        </div>
        <div class="col-md-1" style="width: 115px;"><div class="form-group">
            <label for="price" class="form-label">EURO</label>
            <input class="form-control" placeholder="Euro Price" name="euro_price[]" type="text" id="euro_price" value="<?php echo e($v->euro_price); ?>">
            </div>
        </div>
        
        <input type="hidden" name="s_id[]" value="<?php echo e($v->id); ?>">
       
        </div>
        </div>
       
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      
        <div id="divContainer">
             <input class="form-control" placeholder="Enter Prefix" name="prefix_new[]" type="hidden"><input class="form-control" placeholder="Enter Sub Specification" name="sub_specifications_new[]" type="hidden" id="sub_specification"><input class="form-control" placeholder="INR Price" name="price_new[]" type="hidden"><input class="form-control" placeholder="USD Price" name="usd_price_new[]" type="hidden"><input class="form-control" placeholder="Euro Price" name="euro_price_new[]" type="hidden">
        </div>
      
        <div class="form-group">
            <a class="btn btn-primary sm text-light" onclick="appendDiv()"><i class="ti ti-plus"></i> Add Sub-Specification</a>
         </div>
      
        

      
    </div>
    
</div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<script>
    document.getElementById('pro_image').onchange = function () {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('image').src = src
    }
    
     function appendDiv() {
       $('#divContainer').empty();
        $('#divContainer').append('<div class="add_contact"><div class="row"><div class="col-md-2"><div class="form-group"><label for="prefix" class="form-label">BelongTo</label><input class="form-control" placeholder="Enter Belongs" name="belongs[]" type="text" id="belongs"></div></div><div class="col-md-1"><div class="form-group"><label for="prefix" class="form-label">Prefix</label><input class="form-control" placeholder="Enter Prefix" name="prefix[]" type="text" id="prefix_name"></div></div><div class="col-md-3"><div class="form-group"><label for="sub_specification" class="form-label">Details</label><input class="form-control" placeholder="Enter Sub Specification" name="sub_specification[]" type="text" id="sub_specification"></div></div><div class="col-md-2" style="width: 115px;"><div class="form-group"><label for="length_price" class="form-label">Length</label><input class="form-control" placeholder="Ex: L250" name="length_price[]" type="text" id="length"></div></div><div class="col-md-1" style="width: 115px;"><div class="form-group"><label for="price" class="form-label">INR</label><input class="form-control" placeholder="Price" name="price[]" type="text" id="price"></div></div><div class="col-md-1" style="width: 115px;"><div class="form-group"><label for="price" class="form-label">USD</label><input class="form-control" placeholder="Price" name="usd_price[]" type="text" id="usd_price"></div></div><div class="col-md-1" style="width: 115px;"><div class="form-group"><label for="price" class="form-label">EURO</label><input class="form-control" placeholder="Price" name="euro_price[]" type="text" id="euro_price"></div></div><div class="col-md-1" style="padding-top: 25px;padding-left: 0px;"><div class="form-group"><a class="mx-3 btn btn-primary sm  align-items-cente removeButton" title="remove"><label class="form-check-label " for="g_male"><i class="ti ti-trash text-white"></i></label></a></div></div></div></div>');
      
  }
  
   $(document).on('click', '.removeButton', function(e) {
   e.preventDefault();
   $(this).closest('.add_contact').remove();
   return true;
    });
    
    //hide & show quantity

    $(document).on('click', '.type', function ()
    {
        var type = $(this).val();
        if (type == 'product') {
            $('.quantity').removeClass('d-none')
            $('.quantity').addClass('d-block');
        } else {
            $('.quantity').addClass('d-none')
            $('.quantity').removeClass('d-block');
        }
    });
     $(document).on('change', '#groups', function ()
    {
        var id = $(this).val();
        $.ajax({
            url: '<?php echo e(route('category.model')); ?>',
            type: 'GET',
            data: {
               
                "id": id,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                $('#product_model').empty();
                $('#product_model').append('<option value="">Select Model</option>');
                $.each(data.data, function(index, model) {
               $('#product_model').append('<option value="' + model.id + '">' + model.name + '</option>');
            });
            }
        });
    });
</script>

<?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/productspecification/edit.blade.php ENDPATH**/ ?>
<?php echo e(Form::open(array('url' => 'terms-variant','enctype' => "multipart/form-data"))); ?>

<div class="modal-body">
    
    <?php
        $plan= \App\Models\Utility::getChatGPTSettings();
    ?>
   
    
    <div class="row">
        <div class="form-group col-md-4">
            <?php echo e(Form::label('term_id', __('Group'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('term_id', $group,null, array('class' => 'form-control select','required'=>'required'))); ?>


           
        </div>
        
        <div class="col-md-8">
            <div class="form-group">
                <?php echo e(Form::label('details', __('Details'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('details', '', array('class' => 'form-control','required'=>'required', 'placeholder'=>__('Enter variation Details')))); ?>

            </div>
        </div>
        
        
         
        <div id="divContainer"></div>
        <div class="form-group">
            <a class="btn btn-primary sm text-light" onclick="appendDiv()"><i class="ti ti-plus"></i> Add Sub-Specification</a>
         </div>
      
       
      
    </div>
     
     
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>



<script>
   

    //hide & show quantity
  function appendDiv() {
        $('#divContainer').append('<div class="add_contact"><div class="row"><div class="col-md-4"><div class="form-group"><label for="prefix" class="form-label">Prefix</label><input class="form-control" placeholder="Enter Prefix" name="prefix[]" type="text" id="prefix_name"></div></div><div class="col-md-4"><div class="form-group"><label for="sub_specification" class="form-label">Details</label><input class="form-control" placeholder="Enter Sub Specification" name="sub_specification[]" type="text" id="sub_specification"></div></div><div class="col-md-2"><div class="form-group"><label for="price" class="form-label">Price</label><input class="form-control" placeholder="Enter Price" name="price[]" type="text" id="price"></div></div><div class="col-md-2" style="padding-top: 25px;"><div class="form-group"><a class="mx-3 btn btn-primary sm  align-items-cente removeButton" title="remove"><label class="form-check-label " for="g_male"><i class="ti ti-trash text-white"></i></label></a></div></div></div></div>');
      
  }
  
   $(document).on('click', '.removeButton', function(e) {
       alert("sdfds")
   e.preventDefault();
   $(this).closest('.add_contact').remove();
   return true;
    });

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
</script>
<?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/termspecification/create.blade.php ENDPATH**/ ?>
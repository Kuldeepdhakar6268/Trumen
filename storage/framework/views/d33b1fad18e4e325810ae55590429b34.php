<?php $__env->startSection('page-title'); ?>
   <?php echo e(__('Edit Material Stock')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dropzone.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('materialstock.index')); ?>"><?php echo e(__('Material Stock')); ?></a></li>
    <li class="breadcrumb-item"> <?php echo e(__('Edit Material Stock')); ?> </li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo e(Form::model($material, array('route' => array('materialstock.update', $material->id), 'method' => 'PUT'))); ?>

<div class="modal-body" style="margin-top: 25px;">
    
    <?php
        $plan= \App\Models\Utility::getChatGPTSettings();
    ?>
  
    
    
      <div class="row shadow p-3 mb-5 bg-white rounded">
           
        <div class="col-md-4 form-group">
              <h5 class="mb-0"><?php echo e(__('')); ?></h5>
        </div>
         <div class="col-md-6 form-group">
             <label for="pro_image" class="form-label" style="float: inline-end;">
               
                </label>
           
        </div>
        
              
           
      
        <div class="col-md-2 form-group">
             <button type="submit" class="btn-sm btn btn-primary custom-file-uploadss" style="border: none;"><i class="ti ti-send"></i><?php echo e(__('Save')); ?></button>
        </div>
        
        <div class="form-group col-md-4">
            
                <?php echo e(Form::label('material_code', __('Material Code'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('material_code',null, array('class' => 'form-control','required'=>'required', 'placeholder' => 'Enter Material Code EX-TLC123'))); ?>

            
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo e(Form::label('material_name', __('Material Name'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('material_name', null, array('class' => 'form-control','required'=>'required', 'placeholder' => 'Enter Material Name'))); ?>

            </div>
        </div>
         <div class="col-md-4">
            <div class="form-group">
                <?php echo e(Form::label('purchased_qty', __('Purchased Quantity'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('purchased_qty',null, array('class' => 'form-control','required'=>'required', 'step'=>'1','min'=> '0',))); ?>

            </div>
        </div> 
         <div class="col-md-4">
            <div class="form-group">
                <?php echo e(Form::label('used_qty', __('Used in Production Quantity'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('used_qty',null, array('class' => 'form-control','required'=>'required','step'=>'1','min'=> '0',))); ?>

            </div>
        </div> 
         <div class="col-md-4">
            <div class="form-group">
                <?php echo e(Form::label('dead_material_qty', __('Dead Material Quantity'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('dead_material_qty',null, array('class' => 'form-control','required'=>'required', 'step'=>'1','min'=> '0', 'id'=>'material_cost'))); ?>

            </div>
        </div>
         <div class="col-md-4">
            <div class="form-group">
                <?php echo e(Form::label('unit_price', __('Unit Price'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('unit_price',null, array('class' => 'form-control number-input','required'=>'required','step'=>'1','min'=> '0.00','max'=>'1000'))); ?>

            </div>
        </div>
         <div class="col-md-4">
            <div class="form-group">
                <?php echo e(Form::label('current_qty', __('Current Quantity'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('current_qty',null, array('class' => 'form-control number-input','required'=>'required','step'=>'1','min'=> '0','max'=>'1000', 'id'=>'other_cost'))); ?>

            </div>
        </div>
         <div class="col-md-4">
            <div class="form-group">
                <?php echo e(Form::label('stock_value', __('Stock Value'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('stock_value',null, array('class' => 'form-control','required'=>'required','step'=>'1','min'=> '0.00', 'id'=>'grand_total'))); ?>

            </div>
        </div>
        
         
      </div>
    </div>
    
</div>


<?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>
<!-- Modal HTML -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>This is a modal!</p>
  </div>
</div>

<!-- Button to trigger modal -->

<?php $__env->startPush('script-page'); ?>
<script>
    // document.getElementById('pro_image').onchange = function () {
    //     // alert("dsf")
    //     $('#image').removeClass('d-none')
    //      $('#image-preview').removeClass('d-none')
    //     var src = URL.createObjectURL(this.files[0])
    //     document.getElementById('image').src = src
    // }

    //hide & show quantity
  function appendDiv() {
       $('.service-model').removeClass('d-none')
      
  }
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
   
    
   
    //sum of materials price
    
     $(document).on('change', '#unit_price', function ()
    {
       
        var tprice = $("#purchased_qty").val();
        var uprice = $(this).val();
       
        var mcost = $("#material_cost").val();
        var gtotal = parseFloat($("#purchased_qty").val());                
        var lcost = parseFloat($(this).val());
        var sub =  gtotal*lcost;
        $("#grand_total").val(sub); 
    });
     $(document).on('keyup', '#purchased_qty', function ()
    {
       
        var tprice = $("#unit_price").val();
        
        var gtotal = parseFloat($("#unit_price").val());                
        var lcost = parseInt($(this).val());
       
        var sub =  gtotal*lcost;
        $("#grand_total").val(sub); 
    });
    
  

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/materialstock/edit.blade.php ENDPATH**/ ?>
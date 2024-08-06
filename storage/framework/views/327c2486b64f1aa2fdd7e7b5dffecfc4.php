<?php $__env->startSection('page-title'); ?>
   <?php echo e(__('Product Details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dropzone.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
    $(document).ready(function() {
    // Your CSS styling goes here
    
      
        $(document).on('change', '.select-status', function () {
            var id = $(this).val();
            var pid = $('#pid').val();
    
            var url = '<?php echo e(route('product.status')); ?>'
           $.ajax({
                type: 'GET',
                url: url,
                data: {
                   
                    'id': id,
                    'pid':pid,
                    'session_key': session_key
                },
                success: function (data) {
                    // console.log(data)
                 
                    if(data.code==200){
                        show_toastr('success', data.msg, 'success');
                    }else{
                        show_toastr('error', response.msg, 'error'); 
                    }
                   
                
                    
            
                }
            });
        });
    });
     
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('productservice.index')); ?>"><?php echo e(__('Products')); ?></a></li>
    <li class="breadcrumb-item"> <?php echo e(__('Product Details')); ?> </li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end row">
        <div class="col-md-4 form-group">
                    <select class="form-control select-status  text-warning" name="priority_id">
                           <option value="">Ticket Priority</option>
                           <option value="Low" <?php echo e($productService->ticket_priority == 'Low'?'selected':''); ?>>Low</option>
                           <option value="Medium" <?php echo e($productService->ticket_priority == 'Medium'?'selected':''); ?>>Medium</option>
                           <option value="High" <?php echo e($productService->ticket_priority == 'High'?'selected':''); ?>>High</option>
                    </select>
        </div>
        <div class="col-md-4 form-group">
                    <select class="form-control select-status  text-info" name="priority_id">
                           <option value="">Ticket Status</option>
                           <option value="Open" <?php echo e($productService->ticket_status == 'Open'?'selected':''); ?>>Open</option>
                           <option value="Hold" <?php echo e($productService->ticket_status == 'Hold'?'selected':''); ?>>Hold</option>
                           <option value="On-Going" <?php echo e($productService->ticket_status == 'On-Going'?'selected':''); ?>>On-Going</option>
                           <option value="Closed" <?php echo e($productService->ticket_status == 'Closed'?'selected':''); ?>>Closed</option>
                    </select>
        </div>
        <div class="col-md-4 form-group">
                    <select class="form-control select-status text-success" name="priority_id">
                           <option value="">Order Status</option>
                           <option value="1" <?php echo e($productService->status == 1?'selected':''); ?>>Received</option>
                           <option value="2" <?php echo e($productService->status == 2?'selected':''); ?>>Testing</option>
                           <option value="3" <?php echo e($productService->status == 3?'selected':''); ?>>Repairing</option>
                           <option value="4" <?php echo e($productService->status == 4?'selected':''); ?>>Resolved</option>
                           <option value="5" <?php echo e($productService->status == 5?'selected':''); ?>>Dispatch</option>
                           
                    </select>
        </div>
      <input type="hidden" name="pid" id="pid" value="<?php echo e($productService->id); ?>">
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="card" style="margin-top:20px;">
<div class="card-body">
     <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('name',$productService->name, array('class' => 'form-control','required'=>'required','readonly'))); ?>

            </div>
        </div>
        <?php
        $mod = !empty($productService->productModels)?$productService->productModels->name:'';
        ?>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('model', __('Model'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('model', $mod, array('class' => 'form-control','required'=>'required','readonly'))); ?>

            </div>
        </div>
       
       <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('hsn_code', __('Odering code'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('hsn_code', $productService->hsn_code, array('class' => 'form-control','required'=>'required','readonly'))); ?>

            </div>
        </div>
       
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('sale_price', __('Sale Price'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('sale_price', $productService->sale_price, array('class' => 'form-control','required'=>'required','step'=>'0.01','readonly'))); ?>

            </div>
        </div>
       
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('purchase_price', __('Purchase Price'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('purchase_price', $productService->purchase_price, array('class' => 'form-control','required'=>'required','step'=>'0.01','readonly'))); ?>

            </div>
        </div>
       

      

       

        <div class="col-md-6 form-group">
            <?php echo e(Form::label('pro_image',__('Product Image'),['class'=>'form-label'])); ?>

            <div class="choose-file ">
                <label for="pro_image" class="form-label">
                    
                    <img id="image"  class="mt-3" width="100" src="<?php if($productService->pro_image): ?><?php echo e(asset(Storage::url('uploads/pro_image/'.$productService->pro_image))); ?><?php else: ?><?php echo e(asset(Storage::url('uploads/pro_image/user-2_1654779769.jpg'))); ?><?php endif; ?>" />
                </label>
            </div>
        </div>



      

        <div class="form-group col-md-6">
            <?php echo e(Form::label('quantity', __('Quantity'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('quantity',$productService->quantity, array('class' => 'form-control','required'=>'required','readonly'))); ?>

        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

            <?php echo Form::textarea('description', $productService->description, ['class'=>'form-control','rows'=>'2', 'readonly']); ?>

        </div>
         
    </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/productservice/detail.blade.php ENDPATH**/ ?>
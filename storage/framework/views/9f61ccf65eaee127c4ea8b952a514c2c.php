 
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Product & Services')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
   
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
    /* Hide default arrow */
input[type="text"]::-webkit-input-placeholder {
    color: red;
}
.dataTable-table {
    table-layout: auto;
}
.dataTable-table tbody tr td {
        padding: 0px 0px 0px 0px !important;
    }
    .card:not(.table-card) .table tr th:last-child {
 border-top-right-radius: 30px;
 border-bottom-right-radius: 30px; 

}
.card:not(.table-card) .table tr th:first-child {

  border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
}  
.hover-content { 
    display: none; 
} 
 
/* Display the hover content when hovering over the trigger */ 
.hover-trigger:hover + .hover-content { 
    display: block; 
} 
/*.dataTable-table thead>tr>th{*/
/*        padding: 9px 0px 11px 14px !important; */
/*}*/
/*.dataTable-table td:not(:first-child) {*/
/*        padding-left: 10px !important;*/
/*    }*/
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
   
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
     $(document).ready(function() {
        $('.dataTables-empty').text('No Data Available..');
             
    });
    $(document).ready(function() {
    // Your CSS styling goes here
     $('#datepicker').datepicker();
     $('.choices__input').css('color', 'red');
        $('.page-header-title').css('display', 'none');
        $('.choices__list--dropdown').css('color', 'dark');
        $('.dataTable-dropdown').css('display', 'none');
         $('.dataTable-input').css('height', '45px');
        $('.dataTable-search').css({'float': 'left','position': 'absolute',
    'margin-top': '-145px',
    'margin-left': '65px',
    'width': '250px',
    'height': '45px'});
        $('.choices__placeholder').attr('placeholder', 'Enter your text here').css('color', 'red');
         $('.select').attr('placeholder', 'Enter your text here').css('color', 'red');
        $('.dataTable-input').addClass('placeholder-color');
    
     $('.form-group').css('margin-bottom', '0px');
    $('.choices').css('margin-right', '25px');
    $(document).on("click", ".select", function () {
        
         $(this).css('color', 'black');
    });
    $(document).on("click", ".hover-trigger", function () {
        
        $(this).parent().find(".hover-content").css('display', 'block');
        $(this).css('display', 'none');
    });
     $(document).on("click", ".hover-content", function () {
        
        $(this).parent().find(".hover-trigger").css('display', 'block');
        $(this).css('display', 'none');
    });
    
});
      
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="card">
<div class="row" style="padding:21px;">   
    <div class="col-md-8">
          <a href="<?php echo e(route('productservice.create')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create New Product')); ?>" class="btn btn-outline-light text-primary" style="margin-left: 15px;box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.2), 0 2px 5px 0 rgba(0, 0, 0, 0.19);
  text-align: center;">
            <i class="ti ti-plus" style="border: 1px solid;border-radius:5px;"></i>
             <?php echo e(__('Create New Product')); ?>

        </a>
       
        </div>
        <div class="col-md-4">
       
    </div>
    </div>
    <div class="row">
         <?php echo e(Form::open(array('url' => 'product/searching'))); ?>

               <div class="row">
                  
                    <div class="col-sm-1 form-group">
                        <span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="<?php echo e(__('Search')); ?>" data-bs-toggle="tooltip" class="btn btn-danger text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='#ff3a6e';"></span>
                      
                   </div>
                   <div class="col-sm-2 form-group">
                        <input type="text" class="form-control text-primary" name="date" value="" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepicker" style="height: 45px;"><i class="bx bx-calendar text-primary" style="position: absolute;margin-left: 125px;margin-top: -28px;"></i>
                       
                   </div>
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        <?php echo e(Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3', 'style' => 'height: 45px'))); ?>

                   </div>
                  
                   <div class="col-sm-2 form-group" style="margin-left: -22px;">
                       <?php echo e(Form::select('status_id', $orderstatus,null, array('class' => 'form-control select'))); ?>

                   </div>
                   <div class="col-sm-2 form-group">
                       <?php echo e(Form::select('ticket_status_id', $ticketstatus,null, array('class' => 'form-control select'))); ?>

                   </div>
                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Ticket Priority</option>
                           <option value="1">Low</option>
                           <option value="2">Medium</option>
                           <option value="3">High</option>
                           </select>
                   </div>
                  
            </div>
             <?php echo e(Form::close()); ?>

        <div class="col-sm-12">
            <div class=" mt-2 <?php echo e(isset($_GET['category'])?'show':''); ?>" id="multiCollapseExample1">
                
                    <div class="card-body">
                        <?php echo e(Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service'])); ?>

                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6">
                                <div class="btn-box">
                                    <?php echo e(Form::label('category', __('Category'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required'])); ?>

                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="<?php echo e(__('apply')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="<?php echo e(route('productservice.index')); ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="<?php echo e(__('Reset')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th><?php echo e(__('No.')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Model')); ?></th>
                                <th><?php echo e(__('Specification Order')); ?></th>
                                <th><?php echo e(__('Sale Price')); ?></th>
                                <th><?php echo e(__('Purchase Price')); ?></th>
                                <th><?php echo e(__('Quantity')); ?></th>
                                <th><?php echo e(__('Ticket Priority')); ?></th>
                                <th><?php echo e(__('Ticket Status')); ?></th>
                                <th><?php echo e(__('Order Status')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                                <?php 
                                                
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                              
                                                ?>
                                
                            <?php $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               
                                <tr class="font-style">
                                     <td> <div class="number-color" style="font-size:12px;width: 60px;height: 46px;border-radius: 17px 0px 0px 17px;background-color: <?php echo e(($productService->status == 1)?'#9199a0':(($productService->status == 4)?'#0AA350':(($productService->status == 5)?'#693599':(($productService->status == 3)?'#24A9F9':'#E91C2B')))); ?>">
                                                   <?php echo e(str_pad($loop->iteration, $width, $paddingChar, STR_PAD_LEFT)); ?></div></td>
                                    <td>
                                        <div class="hover-content"><?php echo e($productService->name); ?></div>
                                                <div class="hover-trigger"><?php echo e(\Illuminate\Support\Str::limit($productService->name, $limit = 15, $end = '...')); ?></div>
                                        </td>
                                    <td>
                                        <?php echo e(\Illuminate\Support\Str::limit(!empty($productService->productModels)?$productService->productModels->name:'', $limit = 15, $end = '...')); ?>

                                       </td>
                                    <td>
                                        <div class="hover-content"><?php echo e($productService->hsn_code == ''?'-':$productService->hsn_code); ?></div>
                                                <div class="hover-trigger"><?php echo e($productService->hsn_code == ''?'-':\Illuminate\Support\Str::limit($productService->hsn_code, $limit = 15, $end = '...')); ?></div>
                                       </td>
                                    <td><?php echo e(\Auth::user()->priceFormat($productService->sale_price)); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($productService->purchase_price )); ?></td>
                                    <td><?php echo e($productService->quantity == 0?1:$productService->quantity); ?></td>
                                    <td><?php echo e($productService->ticket_priority); ?></td>
                                    <td><?php echo e($productService->ticket_status); ?></td>
                                    <td><?php echo e(($productService->status == 1)?'Received':(($productService->status == 4)?'Resolved':(($productService->status == 5)?'Dispatch':(($productService->status == 3)?'Reporting':'Testing')))); ?></td>
                                    <?php if(Gate::check('edit product & service') || Gate::check('delete product & service')): ?>
                                        <td class="Action">

                                            <div class="action-btn bg-light ms-2">
                                                <a href="<?php echo e(route('productservice.detail',$productService->id)); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Product Details')); ?>" data-title="<?php echo e(__('Product Details')); ?>">
                                                    <i class="ti ti-eye text-dark"></i>
                                                </a>
                                            </div>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit product & service')): ?>
                                                <div class="action-btn bg-light ms-2">
                                                    <a href="<?php echo e(route('productservice.edit',$productService->id)); ?>" class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"  data-title="<?php echo e(__('Edit Product')); ?>">
                                                        <i class="ti ti-pencil text-dark"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete product & service')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['productservice.destroy', $productService->id],'id'=>'delete-form-'.$productService->id]); ?>

                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" ><i class="ti ti-trash text-white"></i></a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            <?php endif; ?> 
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
<script>

 $(document).ready(function() {
    // Your CSS styling goes here
    $('.choices__input ').css('color', 'red');
    // $(document).on("blur", "#dateInput", function () {
    //     alert("dfds")
    //     $(this).type('date');
    //     $("#dateIcon").css('display', 'none');
    // });
    
});

</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/productservice/index.blade.php ENDPATH**/ ?>
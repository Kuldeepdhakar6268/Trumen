<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage JobCard')); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
     <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
    /* Hide default arrow */
input[type="text"]::-webkit-input-placeholder {
   color: var(--color-customColor);
    font-weight: bold;
}
.dataTable-bottom{
    display: none;
}
.dataTable-table tbody tr td {
        padding: 2px 0px 2px 0px !important;
        font-size:15px;
    }
.dataTable-table thead>tr>th{
        padding: 9px 0px 11px 14px !important; 
}
          .dataTable-container{
            margin-top: -15px;
    }
.card:not(.table-card) .table tr th:last-child {
 border-top-right-radius: 30px;
 border-bottom-right-radius: 30px; 

}
.card:not(.table-card) .table tr th:first-child {

  border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
}
.number-color {
    width: 80px;
    height: 85px;
    border-radius: 10px 0px 0px 10px;
    color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-top: -32px !important;
    margin-left: -25px !important;
    margin-bottom: -35px !important;
}
.dataTable-table tfoot tr th, .dataTable-table tfoot tr td, .dataTable-table thead tr th, .dataTable-table thead tr td, .dataTable-table tbody tr th, .dataTable-table tbody tr td{
                padding: 0.4rem 0.4rem;

}
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).on("change", ".change-pipeline select[name=default_pipeline_id]", function () {
            $('#change-pipeline').submit();
        });
        $(document).ready(function() {
            $('.dataTables-empty').text('No Data Available..');
            $(".loader").fadeOut(10, function() {
            $(".content").show();        
            });
            $('.choices__inner').css({
            'border-radius': '15px',
            'color': 'var(--color-customColor)',
            'font-weight': 'bold'
        });
    // Your CSS styling goes here
     $('#datepicker').datepicker();
     $('.choices__input').addClass('text-primary');
             $('.choices__placeholder').css('opacity', '1');

      //  $('.page-header-title').css('display', 'none');
        $('.choices__list--dropdown').css('color', 'dark');
        $('.dataTable-dropdown').css('display', 'none');
         $('.dataTable-input').css({'height': '45px', 'width': '250px'});
       /* $('.dataTable-search').css({'float': 'left','position': 'absolute',
    'margin-top': '-116px',
    'margin-left': '55px',
    'width': '250px',
    'height': '45px'});*/
        $('.choices__placeholder').attr('placeholder', 'Enter your text here').css('color', 'red');
        $('.dataTable-input').addClass('placeholder-color');
        // $('.choices').css('margin-right', '25px');
        
            
        $("#calendar_icon").on("click",function(){
          $('#datepicker').focus();
        })
   
});
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
   
<?php $__env->stopSection(); ?>

<div class="loader"></div>

<?php $__env->startSection('content'); ?>
    
       
         <div class="card content" style="">
         <div class="row" style="margin-top: 50px;">

                 <?php echo e(Form::open(array('url' => 'jobcard/search', 'id' => 'jobcard_filter'))); ?>

               <div class="row" style="margin-top: 70px;">
                  
                    <div class="col-sm-1 form-group">
                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('jobcard_filter').submit(); return false;" data-bs-toggle="tooltip" title="" data-original-title="apply" data-bs-original-title="Apply" style="padding: 12px 20px 12px 20px;;float: inline-end;">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                      
                   </div>
                   
                   <div class="col-sm-3 form-group" style="position: relative;">
                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepicker" style="border-radius: 15px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon" style="position: absolute; right: 26px; top: 50%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                    <div class="col-sm-3 form-group">
                       <?php echo e(Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple6'))); ?>

                   </div>
                    <div class="col-sm-3 form-group">
                       <?php echo e(Form::select('products', $products,'null', array('class' => 'form-control select2', 'id'=>'choices-multiple7'))); ?>

                   </div>
                   <div class="col-sm-2 form-group">
                       
                      
                   </div>
                  
            </div>
             <?php echo e(Form::close()); ?>

        <div class="col-md-12">
                        <h4 class=""><a href="#" class="text-dark" style="font-weight: bolder;margin-left: 20px;margin-top: 50px;position:absolute;margin-bottom: -20px;"><?php echo e(__('JobCard Request')); ?></a></h4>

                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th> <?php echo e(__('Sr.')); ?></th>
                                    <th> <?php echo e(__('Ref SO.')); ?></th>
                                    <th> <?php echo e(__('Company Name')); ?></th>
                                    <th> <?php echo e(__('Product Name')); ?></th>
                                    <th> <?php echo e(__('Total Cost')); ?></th>
                                    <th> <?php echo e(__('Quote Date')); ?></th>
                                    <th> <?php echo e(__('Created by')); ?></th>
                                    <th> <?php echo e(__('Card Request')); ?></th>
                                    <?php if(Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation')): ?>
                                        <th> <?php echo e(__('Acknowledge')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>

                                        <?php
                                         $gtotal =  0;
                                         $total = 0;
                                        ?>
                                <?php $__currentLoopData = $quotations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quotation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               
                                    <tr  style="margin-top: 30px;background: #F8FAFB;">
                                       
                                        <td>
                                            <div class="number-color ms-2" style="font-size:12px;background-color: <?php echo e(($quotation->is_send == 1)?'#ff5000':'#009900'); ?>">
                                                   <?php echo e($loop->iteration); ?></div> 
                                           </td>
                                        <td class="Id">
                                            <a href="<?php echo e(route('quotation.order.view', ['id' => \Crypt::encrypt($quotation->id), 'job' => 'is_job'])); ?>"
                                                class="text-dark"><?php echo e(Auth::user()->soNumberFormat($quotation->jobcard_no == 0?$quotation->jobcard_no+1:$quotation->jobcard_no )); ?></a>
                                        </td>
                                        <td><?php echo e($quotation->organization->name); ?></td>
                                        <?php if(count($quotation->items)>0): ?>
                                         <td>
                                              <?php $__currentLoopData = $quotation->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                         
                                         $quoteProduct = \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->first();
                                         $products = \App\Models\ProductService::find($item->product_id);
                                         
                                         $gtotal =  \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->sum('price');
                                        ?>
                                                  <?php echo e($products->name); ?> 
                                                   <?php if(!$loop->last): ?>
                                                        ,
                                                    <?php endif; ?>
                                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                  </td>
                                       
                                        
                                        <?php if(isset($quoteProduct->tax)): ?>
                                        <?php 
                                        $taxProduct = \App\Models\Tax::find($quoteProduct->tax);
                                        ?>
                                        <td><?php echo e(!empty($taxProduct)?(($gtotal * $taxProduct->rate/100) + $total):$gtotal); ?></td>
                                        <?php else: ?>
                                        <td> <?php echo e($gtotal); ?></td>
                                        <?php endif; ?>
                                       
                                        <?php else: ?>
                                         <?php
                                        
                                         $quoteProduct = \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->first();
                                          $product = \App\Models\ProductService::find($quoteProduct->product_id);
                                        
                                         $totals =  $quoteProduct->price + $quoteProduct->tax;
                                        ?>
                                        <td><?php echo e($product->name); ?></td>
                                        <td><?php echo e($totals); ?></td>
                                        <?php endif; ?>
                                        <td><?php echo e(Auth::user()->dateFormat($quotation->quotation_date)); ?></td>
                                         <td> <?php echo e(!empty($quotation->is_revisedBy != '')?$quotation->assignBy->name:$quotation->createdBy->name); ?> </td>
                                       
                                         <td><?php echo e($quotation->status ==1?'Waiting for Approval':'Approved'); ?></td>
                                        <?php if(Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation')): ?>
                                            <td class="Action">
                                                <span>

                                                    <?php if($quotation->is_converted == 0): ?>
                                                        
                                                        <?php else: ?>
                                                        
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="<?php echo e(route('pos.show', \Crypt::encrypt($quotation->converted_pos_id))); ?>" class="mx-3 btn btn-sm align-items-center"
                                                                    data-bs-toggle="tooltip"
                                                                    title="<?php echo e(__('Already convert to POS')); ?>"
                                                                    data-original-title="<?php echo e(__('Detail')); ?>">
                                                                    <i class="ti ti-file text-white"></i>
                                                                </a>
                                                            </div>
                                                        
                                                    <?php endif; ?>
                                                    <?php if($quotation->status ==1): ?>
                                                     <div style="margin-left: 1rem !important;">
                                                            <a href="#"
                                                                class="btn btn-sm align-items-center text-light bg-dark"
                                                                data-bs-toggle="tooltip" title="Send to email"
                                                                data-original-title="<?php echo e(__('Send to Email')); ?>" style="background-color:#009900;border-radius: 20px;">
                                                               <?php echo e(__('Send to Email')); ?>

                                                            </a>
                                                        </div>  
                                                    <?php else: ?>
                                                     <div style="margin-left: 1rem !important;">
                                                            <a href="<?php echo e(route('jobcard.emails.send', \Crypt::encrypt($quotation->id))); ?>"
                                                                class="btn btn-sm align-items-center text-light"
                                                                data-bs-toggle="tooltip" title="Send to email"
                                                                data-original-title="<?php echo e(__('Send to Email')); ?>" style="background-color:#009900;border-radius: 20px;">
                                                               <?php echo e(__('Send to Email')); ?>

                                                            </a>
                                                        </div>  
                                                    <?php endif; ?>
                                                    
                                                    
                                                </span>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                         <?php echo $quotations->links("pagination::bootstrap-4"); ?>

                        <p style="padding: 12px 10px 10px 30px;">
                            Displaying <?php echo e($quotations->count()); ?> of <?php echo e($quotations->total()); ?> orders.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/jobcards/list.blade.php ENDPATH**/ ?>
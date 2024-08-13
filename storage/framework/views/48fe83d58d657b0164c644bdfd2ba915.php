
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Quotation')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
 
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
.z-0{
    display:none;
}
.dataTable-bottom{
    display: none;
}
  .dataTable-container{
            margin-top: -15px;
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
.dataTable-table thead>tr>th{
        padding: 9px 0px 11px 14px !important; 
}
.dataTable-table td:not(:first-child) {
        padding-left: 10px !important;
    }
.number-color {
    width: 80px;
    height: 78px;
    border-radius: 10px 0px 0px 10px;
    color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-top: -54px !important;
    margin-left: -25px !important;
    margin-bottom: -35px !important;
}
.dataTable-table tfoot tr th, .dataTable-table tfoot tr td, .dataTable-table thead tr th, .dataTable-table thead tr td, .dataTable-table tbody tr th, .dataTable-table tbody tr td{
                padding: 0.5rem 0.5rem;

}
        
        
        
        #choices-multiple1{
             background: #ffffff url("https://trumen.truelymatch.com/assets/images/down-arrow.png") no-repeat right 0.75rem center / 8px 5px;

        }
    </style>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".relative").css('color', '#ff5000')
        $(".leading-5").css('padding', '20px')
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
    //    $('.page-header-title').css('display', 'none');
      //  $('.choices__list--dropdown').css('color', 'dark');
        // $('.dataTable-top').css('display', 'none');
         $('.dataTable-dropdown').css('display', 'none');
         $('.dataTable-input').css({'height': '45px', 'width': '250px'});
        $('.choices__placeholder').attr('placeholder', 'Enter your text here').css('color', 'red');
        $('.choices').css('margin-right', '25px');
        $('#choices-multiple1').css('color', 'red');
        $('#choices-multiple1').click(function() {
           
     $('#choices-multiple1').css('color', '#000000');
    });
});
$(document).ready(function() {
    
    $('.dataTable-input').val('<?php echo e($key); ?>')
    
    $('.dataTable-input').keyup(function(event) {
      
         var searchVal = $(this).val()
         $('#search').val(searchVal)   
            event.preventDefault();
            if($(this).val().length == 6)
            {
                event.preventDefault();
            $('#search_filter').submit();
            }else{
                event.preventDefault();
            $('#search_filter').submit(); 
            }
            console.log('1');
        
      
    });
});
  
        $('.copy_link').click(function(e) {
            e.preventDefault();
            var copyText = $(this).attr('href');

            document.addEventListener('copy', function(e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);

            document.execCommand('copy');
            show_toastr('success', 'Url copied to clipboard', 'success');
        });
        
        
         
        $("#calendar_icon").on("click",function(){
          $('#datepicker').focus();
        })
    </script>
<?php $__env->stopPush(); ?>





<?php $__env->startSection('content'); ?>
<div class="loader"></div>

<div class="card content">
    <div class="row" style="padding:21px;">   
    <div class="col-md-8">
          <a href="<?php echo e(route('quotation.create')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Add New Quotation')); ?>" class="btn btn-outline-light text-primary" style="margin-left: 15px;box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.2), 0 2px 5px 0 rgba(0, 0, 0, 0.19);
  text-align: center;font-weight:bold">
            <i class="ti ti-plus" style="border: 1px solid;border-radius:5px;"></i>
             <?php echo e(__('Add New Quotation')); ?>

        </a>
        
        </div>
        <div class="col-md-4">
       
    </div>
    </div>
     <?php
     $status = [
     '0' =>'Quote Status',
     'Draft',
     'Waiting for approval',
     'Approved',
     'Sent'
     ];
     ?>
    <div class="row">
<!--<div class="preload"><img src="http://i.imgur.com/KUJoe.gif"></div>-->

         <?php echo e(Form::open(array('url' => 'quotation/search', 'id' => 'quotation_filter'))); ?>

               <div class="row" style="margin:-2px;">
                  
                    <div class="col-sm-1 form-group">
                         <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('quotation_filter').submit(); return false;" data-bs-toggle="tooltip" title="" data-original-title="apply" data-bs-original-title="Apply" style="padding: 10px 15px 10px 15px;float: inline-end;">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                            </a>
                        
                      
                   </div>

                 
                   
                       
                    <div class="col-sm-2 form-group" style="position: relative;">
                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepicker" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon" style="position: absolute; right: 26px; top: 50%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                   
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        <?php echo e(Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3'))); ?>

                   </div>
                    <div class="col-sm-3 form-group">
                       <?php echo e(Form::select('products', $products,'null', array('class' => 'form-control select2', 'id'=>'choices-multiple2'))); ?>

                   </div> 
                   <div class="col-sm-3 form-group">
                      <select class="form-control select choices__inner" id="choices-multiple1" name="status_id">
                      <option value="">Quote Status</option>
                      <option value="0"<?php echo e($chkstatus == 0?'selected':''); ?>>Draft</option>
                      <option value="1"<?php echo e($chkstatus == 1?'selected':''); ?>>Waiting for approval</option>
                      <option value="2"<?php echo e($chkstatus == 2?'selected':''); ?>>Approved</option>
                      <option value="3"<?php echo e($chkstatus == 3?'selected':''); ?>>Sent</option>
                      </select>
                   </div>
                  
            </div>
             <?php echo e(Form::close()); ?>

              <?php echo e(Form::open(array('url' => 'quotations/searchSingle','method'=> 'GET', 'id'=> 'search_filter'))); ?>

                 <input type="hidden" value="0" id="search" name="search">
               <?php echo e(Form::close()); ?>

        <div class="col-md-12">
            <h4 class=""><a href="#" class="text-dark" style="font-weight: bolder;margin-left: 20px;margin-top: 40px;position:absolute;margin-bottom: -20px;"><?php echo e(__('Recent Search')); ?></a></h4>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable" style="width:100%;overflow:auto;">
                            <thead class="thead-dark">
                                <tr>
                                    <th> <?php echo e(__('Sr.')); ?></th>
                                    <th> <?php echo e(__('Quote Ref No.')); ?></th>
                                    <th> <?php echo e(__('Product Name')); ?></th>
                                    <th> <?php echo e(__('Total Cost')); ?></th>
                                    <th> <?php echo e(__('Quote Date')); ?></th>
                                    <th> <?php echo e(__('Created by')); ?></th>
                                    <th> <?php echo e(__('Quote Status')); ?></th>
                                    <?php if(Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation')): ?>
                                        <th> <?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                            
                                        <?php
                                         $gtotal =  0;
                                         
                                        ?>
                                <?php $__currentLoopData = $quotations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $quotation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(count($quotation->items)>0): ?>
                                    <tr style="margin-top: 30px;background: #F8FAFB;">
                                        <?php
                                        $rv = $quotation->is_revised != ''?Auth::user()->quotationRvNumberFormat($quotation->id):Auth::user()->quotationNumberFormat($quotation->id);
                                        $count = \App\Models\Quotation::where('is_revised', '!=', '')->count();
                                        ?>
                                        
                                        <td>
                                            <div class="number-color ms-2" style="font-size:12px;background-color: <?php echo e($quotation->status ==1?'#ff5000':(($quotation->status ==2)?'#6fd943':(($quotation->status ==3)?'#6610f2':'#ffa21d'))); ?>">
                                                  <?php echo e(($quotations ->currentpage()-1) * $quotations ->perpage() + $loop->index + 1); ?></div> 
                                           </td>
                                        <td class="Id">
                                            <a href="<?php echo e(route('quotation.show', \Crypt::encrypt($quotation->id))); ?>"
                                                class="text-dark"><?php echo e($rv); ?></a>
                                        </td>
                                        
                                       
                                       <td>
                                        <?php $__currentLoopData = $quotation->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                         
                                         $quoteProduct = \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->first();
                                         $product = \App\Models\ProductService::find($item->product_id);
                                        
                                         $gtotal = $item->price * (!empty($quoteProduct)?$quoteProduct->quantity:1);
                                        ?>
                                        <?php echo e($product->name); ?> 
                                                   <?php if(!$loop->last): ?>
                                                        ,
                                                    <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        
                                        
                                        <?php if(isset($quoteProduct->tax)): ?>
                                        <?php 
                                        $taxProduct = \App\Models\Tax::find($quoteProduct->tax);
                                        ?>
                                        <td><?php echo e(!empty($taxProduct)?(($gtotal * $taxProduct->rate/100) + $gtotal):$gtotal); ?></td>
                                        <?php else: ?>
                                        <td> <?php echo e($gtotal); ?></td>
                                        <?php endif; ?>
                                        
                                       
                                       
                                        <?php
                                        $owner = \App\Models\User::find($quotation->created_by);
                                        ?>
                                        <td><?php echo e(Auth::user()->dateFormat($quotation->quotation_date)); ?></td>
                                        <td> <?php echo e(!empty($quotation->is_revisedBy != '')?$quotation->assignBy->name:$quotation->createdBy->name); ?> </td>
                                       
                                         <td><?php echo e($quotation->status ==1?'Waiting for Approval':(($quotation->status ==2)?'Approved':(($quotation->status ==3)?'Send':'Draft'))); ?></td>
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
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit quotation')): ?>
                                                        <div class="action-btn bg-light ms-2">
                                                            <a href="<?php echo e(route('quotation.edit', \Crypt::encrypt($quotation->id))); ?>"
                                                                class="mx-3 btn btn-sm align-items-center"
                                                                data-bs-toggle="tooltip" title="Edit"
                                                                data-original-title="<?php echo e(__('Edit')); ?>">
                                                                <i class="ti ti-pencil text-dark"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                      <div class="action-btn bg-light ms-2">
                                                                <a href="<?php echo e(route('quotation.show', \Crypt::encrypt($quotation->id))); ?>" class="mx-3 d-inline-flex align-items-center"  data-size="xl" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" data-title="<?php echo e(__('Quotation Detail')); ?>">
                                                                    <i class="ti ti-eye text-dark"></i>
                                                                </a>
                                                            </div>
                                                     <?php if($quotation->status ==2): ?>
                                                     <div class="action-btn bg-light ms-2">
                                                            <a href="#" data-size="md" data-url="<?php echo e(route('quotation.emails.cc', \Crypt::encrypt($quotation->id))); ?>" data-ajax-popup="true"
                                                                class="btn btn-sm align-items-center text-light"
                                                                data-bs-toggle="tooltip" title="Send Quote Email"
                                                                data-original-title="<?php echo e(__('Send Quote Email')); ?>">
                                                               <i class="ti ti-send text-success"></i>
                                                            </a>
                                                        </div>
                                                    <?php else: ?>
                                                     <div class="action-btn bg-light ms-2">
                                                            <a href="javascript:"
                                                                class="btn btn-sm align-items-center text-danger"
                                                                data-bs-toggle="tooltip" title="Send to email"
                                                                data-original-title="<?php echo e(__('Send to Email')); ?>">
                                                               <i class="ti ti-send text-danger"></i>
                                                            </a>
                                                        </div>  
                                                    <?php endif; ?>
                                                   
                                                </span>
                                            </td>
                                        <?php endif; ?>
                                       
                                    </tr>
                                      <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                         <?php echo e($quotations->appends(Request::except('page'))->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Trumen\resources\views/quotation/index.blade.php ENDPATH**/ ?>
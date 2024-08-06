<?php
   // $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar/');
?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
    /* Hide default arrow */
input[type="text"]::-webkit-input-placeholder {
             color: var(--color-customColor);
    font-weight: bold;
}
 .card:not(.table-card) .table tr th:last-child {
 border-top-right-radius: 30px !important;
 border-bottom-right-radius: 30px !important; 

}
.card:not(.table-card) .table tr th:first-child {

  border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
}
#choices-multiple4{
 background: #ffffff url("https://trumen.truelymatch.com/assets/images/down-arrow.png") no-repeat right 0.75rem center / 8px 5px;
  font-weight: bold;
}
.dataTable-bottom{
    display: none;
}
.action-btn1 {
    width: 62px;
    height: 90px; /* Match the height of the <a> tag */
    border-radius: 9.3552px;
    color: #fff;
    display: flex; /* Use flex instead of inline-flex for proper alignment */
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
    margin-top: -44px !important;
    margin-left: -30px !important;
    margin-bottom: -121px !important;
    position: relative;
}
.dataTable-table tbody tr td {
        padding: 7px 0px 5px 18px !important;
    }
/*.dataTable-table thead>tr>th{*/
/*        padding: 9px 0px 11px 14px !important; */
/*}*/
/*.dataTable-table td:not(:first-child) {*/
/*        padding-left: 10px !important;*/
/*    }*/
.action-btn1 a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    border: none;
    font-size: 12px;
    background-color: inherit; /* Use the same background color */
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}


.dataTable-table tfoot tr th, .dataTable-table tfoot tr td, .dataTable-table thead tr th, .dataTable-table thead tr td, .dataTable-table tbody tr th{
                padding: 0.7rem 0.7rem;

}
    </style>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
    $(document).ready(function() {
              $(".loader").fadeOut(10, function() {
        $(".content").show();        
    });
    // Your CSS styling goes here
       $('.choices__inner').css({
    'border-radius': '15px',
    'color': 'var(--color-customColor)',
    'font-weight': 'bold'
});
        $('#datepicker').datepicker();
             $('.choices__placeholder').css('opacity', '1');
     $('.choices__input').addClass('text-primary');
       // $('.page-header-title').css('display', 'none');
        $('.choices__list--dropdown').css('color', 'dark');
       // $('.form-group').css({'padding': '0px'});
         $('.dataTable-dropdown').css('display', 'none');
         $('.dataTable-input').css({'height': '45px', 'width': '250px'});
        $('.choices__placeholder').attr('placeholder', 'Enter your text here').css('color', 'red');
         $('#choices-multiple4').attr('placeholder', 'Select a city').css('color', 'red');
        // $('.choices').css('margin-right', '25px');
    
});

         $("#calendar_icon").on("click",function(){
          $('#datepicker').focus();
        })
        $(document).on('click', '#billing_data', function () {
            $("[name='shipping_name']").val($("[name='billing_name']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_phone']").val($("[name='billing_phone']").val());
            $("[name='shipping_zip']").val($("[name='billing_zip']").val());
            $("[name='shipping_address']").val($("[name='billing_address']").val());
        })
        $(document).on('change', '.state-select', function () {
            var state_id = $(this).val();
        //   alert(state_id);
            var url = '<?php echo e(route('city')); ?>'
           var $citySelect = $(this).siblings('.city-select');
       
            getCities(url,state_id, $citySelect);
        });
      function getCities(url, state_id, $citySelect) {
        //   alert(state_id);
        //  $('#choices-multiple4').attr('placeholder', 'Select a city').css('color', 'black');
        $('#choices-multiple4').css('color', 'black');
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                   
                    'state_id': state_id,
                    'session_key': session_key
                },
                success: function (data) {
                    // console.log(data)
                  
                    $('#choices-multiple4').empty();
                $.each(data.data, function(index, city) {
                    console.log(city.name)
               $('#choices-multiple4').append('<option value="' + city.id + '">' + city.name + '</option>');
            });
             $('#choices-multiple4').removeAttr('readonly');
            

            // Initialize Select2 after populating the options
            
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Customers')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
   
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
<div class="loader"></div>


   <div class="card content">
 
    <div class="row">
<!--<div class="preload"><img src="http://i.imgur.com/KUJoe.gif"></div>-->

         <?php echo e(Form::open(array('url' => 'customer/search', 'id' => 'customer_filter'))); ?>

               <div class="row"   style="margin-top: 70px;padding: 0px 10px 0px 10px;">
                  
                    <div class="col-sm-1 form-group">
                       <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('customer_filter').submit(); return false;" data-bs-toggle="tooltip" title="" data-original-title="apply" data-bs-original-title="Apply" style="padding: 8px 20px 8px 20px;">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                      
                   </div>
                   
                         <div class="col-sm-2 form-group" style="position: relative;">
    <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepicker" style="border-radius: 15px; padding-right: 30px;x;font-weight: bold;color:var(--color-customColor)">
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
                       <?php echo e(Form::select('industry_id', $industry,null, array('class' => 'form-control select2','id'=>'choices-multiple1'))); ?>

                   </div>
                
                   
                   
                  
            </div>
            
            <div class="row">
             
                  <div class="col-sm-3 form-group" style="margin-left:104px;">
                       <?php echo e(Form::select('state_id', $states,null, array('class' => 'form-control select2 state-select','id'=>'choices-multiple5'))); ?>

                   </div>
                   <div class="col-sm-3 form-group" >
                       <?php echo e(Form::select('city_id',[],null, array('class' => 'form-control select choices__inner','id'=>'choices-multiple4', 'readonly', 'placeholder'=> 'City', 'style'=>'height: 45px;'))); ?>

                   </div>
                     <div class="col-sm-3 form-group">
                       
                   </div>
            </div>
             <?php echo e(Form::close()); ?>

        <div class="col-md-12">
            <h4 class=""><a href="#" class="text-dark" style="font-weight: bolder;margin-left: 20px;margin-top: 40px;position:absolute;margin-bottom: -20px;"><?php echo e(__('Customer List')); ?></a></h4>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th><?php echo e(__('Sr.')); ?></th>
                                <th> <?php echo e(__('Name')); ?></th>
                                <th> <?php echo e(__('Company Name')); ?></th>
                                <th> <?php echo e(__('Primary Email')); ?></th>
                                <th> <?php echo e(__('Contact Number')); ?></th>
                                <th> <?php echo e(__('Created At')); ?></th>
                                <th> <?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="cust_tr" id="cust_detail" data-url="<?php echo e(route('customer.show',$customer['id'])); ?>" data-id="<?php echo e($customer['id']); ?>"  style="margin-top: 30px;background: #F8FAFB;">
                                    <td class="Id">
                                        <div class="action-btn1 ms-2" style="font-size:12px;">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show customer')): ?>
                                         
                                            <a href="<?php echo e(route('customer.show',\Crypt::encrypt($customer['id']))); ?>" class="btn btn-outline-primary text-light" style="border-top-right-radius: 0;border-bottom-right-radius: 0;border-top-left-radius: 10px;border-bottom-left-radius: 10px;border: none;font-size:12px;background-color: <?php echo e(($customer->status == 'Pending')?'#9199a0':(($customer->status == 'Confirm')?'#0AA350':'#ff5000')); ?>">
                                                <?php 
                                                $num = 5; // Your number
                                                $width = 2; // Desired width
                                                $paddingChar = '0'; // Character used for padding
                                                $formattedNum = str_pad($customer['customer_id'], $width, $paddingChar, STR_PAD_LEFT);
                                                ?>
                                               <?php echo e(($customers ->currentpage()-1) * $customers ->perpage() + $loop->index + 1); ?>

                                            </a>
                                        <?php else: ?>
                                            <a href="#" class="btn btn-outline-primary">
                                                <?php echo e(($customers ->currentpage()-1) * $customers ->perpage() + $loop->index + 1); ?>

                                            </a>
                                        <?php endif; ?>
                                        </div>
                                    </td>
                                    <td><?php echo e($customer['name']); ?></td>
                                    <td class="font-style"><?php echo e(!empty($customer->leads)?$customer->leads->industry_name:'-'); ?></td>
                                    
                                    <td><?php echo e($customer['email']); ?></td>
                                    <td><?php echo e($customer['contact']); ?></td>
                                     <td><?php echo e(\Carbon\Carbon::parse($customer['created_at'])->format('d M Y')); ?></td>
                                    <td><?php echo e($customer['status']); ?></td>
                                    <td class="Action">
                                        <span>
                                        <?php if($customer['is_active']==0): ?>
                                                <i class="ti ti-lock" title="Inactive"></i>
                                            <?php else: ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show customer')): ?>
                                                <div class="action-btn bg-light ms-2">
                                                    <a href="<?php echo e(route('customer.show',\Crypt::encrypt($customer['id']))); ?>" class="mx-3 btn btn-sm align-items-center"
                                                       data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>">
                                                        <i class="ti ti-eye text-dark"></i>
                                                    </a>
                                                </div>
                                                <?php endif; ?>
                                               <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit customer')): ?>
                                                        <div class="action-btn bg-primary ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="<?php echo e(route('customer.edit',$customer['id'])); ?>" data-ajax-popup="true"  data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"  data-title="<?php echo e(__('Edit Customer')); ?>">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?> 
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete customer')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['customer.destroy', $customer['id']],'id'=>'delete-form-'.$customer['id']]); ?>

                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" ><i class="ti ti-trash text-white text-white"></i></a>
                                                        <?php echo Form::close(); ?>

                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                         <?php echo $customers->links("pagination::bootstrap-4"); ?>

                        <p style="padding: 12px 10px 10px 30px;">
                            Displaying <?php echo e($customers->count()); ?> of <?php echo e($customers->total()); ?> customers.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/customer/index.blade.php ENDPATH**/ ?>
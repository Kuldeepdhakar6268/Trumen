
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Purchase Request')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dropzone.min.css')); ?>">
   <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<style>
#loading {
position: fixed;
width: 100%;
height: 100vh;
background: #fff url('images/loader.gif') no-repeat center center;
z-index: 9999;
}
  .dataTable-container{
            margin-top: -15px;
    }
    .dataTable-table tbody tr td {
        padding: 7px 0px 7px 0px;
    }
    .dataTable-table tbody tr td {
    padding: 7px 0px 5px 18px !important;
}
.number-color {
    width: 80px !important;
    height: 78px !important;
    padding-top: 25px !important;
    font-size: 15px !important;
    margin-top: -54px !important;
    margin-left: -25px !important;
    margin-bottom: -35px !important;
}  
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Order Request')); ?></li>
<?php $__env->stopSection(); ?>
 
<?php $__env->startPush('script-page'); ?>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#date-range').daterangepicker({
    opens: 'left',
    drops: 'down',
    autoApply: true,
    locale: {
      format: 'YYYY-MM-DD',
      separator: ' To ',
      applyLabel: 'Apply',
      cancelLabel: 'Cancel',
      fromLabel: 'From',
      toLabel: 'To',
      customRangeLabel: 'Custom',
      daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
      monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      firstDay: 0
    }
  });
  $('#date-range').change(function (){
      $(this).val();
      $("#daterange").val($(this).val())
  })
        });
    </script>
   

    <script>
      jQuery(document).ready(function() {
    jQuery('#loading').fadeOut(1000);
});

        $('.copy_link').click(function (e) {
            e.preventDefault();
            var copyText = $(this).attr('href');

            document.addEventListener('copy', function (e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);

            document.execCommand('copy');
            show_toastr('success', 'Url copied to clipboard', 'success');
        });
    </script>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('action-btn'); ?>
    <div class="float-end" style="padding-bottom: 15px;">






        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create purchase')): ?>
            <a href="<?php echo e(route('order.create',0)); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Request For Purchase Order')); ?>" class="btn btn-outline-light text-primary" style="margin-left: 15px;box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.2), 0 2px 5px 0 rgba(0, 0, 0, 0.19); text-align: center;font-weight:bold">
            <i class="ti ti-plus text-primary" style="border: 1px solid;border-radius:5px;"></i>&nbsp;&nbsp;&nbsp;<?php echo e(__('Request For Purchase Order')); ?>

        </a>
           
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
  <div id="loading"></div>

    <div class="row" id="contents">
        
        <div class="col-md-15">
            <div class="card">
                <div class="card">
                <?php echo e(Form::open(array('url' => 'order/request/search','method'=> 'GET', 'id'=> 'order_request_filter'))); ?>

                <div class="row pt-5">
               
                <div class="col-sm-1 form-group">
                        <span class="" style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="<?php echo e(__('Search')); ?>" data-bs-toggle="tooltip" class="btn btn-primary text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='';" onclick="document.getElementById('order_request_filter').submit(); return false;"></span>
                      
                   </div>
                <input type="hidden" id="daterange">   
                <div class="col-sm-3 form-group">
                        <input type="text" class="form-control" name="date" value="<?php echo e($date); ?>" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" style="height: 45px;" id="date-range">
                       
                   </div>
                <div class="col-sm-2 form-group">
                    <select class="form-control select" name="created_by">
                           <option value="">Prepared By</option>
                           <?php $__currentLoopData = $emp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          
                           <option value="<?php echo e($e->id); ?>" <?php echo e(Request::get('created_by') == $e->id?'selected':''); ?>><?php echo e($e->name); ?> </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </select>
                      
                   </div>

                   <div class="col-sm-2 form-group">
                        <select class="form-control select" name="approved_by">
                           <option value="">Approved By</option>
                           <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          
                           <option value="<?php echo e($u->id); ?>" <?php echo e(Request::get('approved_by') == $u->id?'selected':''); ?>><?php echo e($u->name); ?> </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </select>
                       
                   </div>

                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="status">
                           <option value="">Status</option>
                           <option value="Draft" <?php echo e(Request::get('status')== 'Draft'?'selected':''); ?>>Draft </option>
                           <option value="Waiting for Approval" <?php echo e(Request::get('status')== 'Waiting for Approval'?'selected':''); ?>>Waiting for Approval</option>
                           <option value="Approved" <?php echo e(Request::get('status')== 'Approved'?'selected':''); ?>>Approved</option>
                           <option value="Send" <?php echo e(Request::get('status')== 'Send'?'selected':''); ?>>Send</option>

                           </select>
                   </div>

                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority">
                           <option value="">Priority</option>
                           <option value="Low" <?php echo e(Request::get('priority')== 'Low'?'selected':''); ?>>Low </option>
                           <option value="Medium" <?php echo e(Request::get('priority')== 'Medium'?'selected':''); ?>>Medium</option>
                           <option value="High" <?php echo e(Request::get('priority')== 'High'?'selected':''); ?>>High</option>
                           <option value="Immidiate" <?php echo e(Request::get('priority')== 'Immidiate'?'selected':''); ?>>Immidiate</option>

                           </select>
                   </div>
                </div>
                 <?php echo e(Form::close()); ?>

                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark " >
                            <tr>
                            <th style="border-top-left-radius: 30px; border-bottom-left-radius: 30px;"> <?php echo e(__('Sr.')); ?></th>
                                <th> <?php echo e(__('Equipments Name')); ?></th>
                                <th class="px-3"> <?php echo e(__('Request Date')); ?></th>
                                <th> <?php echo e(__('Prepared by')); ?></th>
                                <th> <?php echo e(__('Approved by')); ?></th>
                                <th><?php echo e(__('Order Priority')); ?></th>
                                <th><?php echo e(__('Order Status')); ?></th>
                                
                                <?php if(Gate::check('edit purchase') || Gate::check('delete purchase') || Gate::check('show purchase')): ?>
                                    <th style="border-top-right-radius: 30px;border-bottom-right-radius: 30px;" > <?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>


                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td class="Id">
                                         <div class="number-color ms-2" style="font-size:12px;background-color: <?php echo e($order->status =='Waiting for Approval'?'#ff5000':(($order->status =='Approved')?'#6fd943':(($order->status =='Recieved')?'#6610f2':(($order->status =='Draft')?'#C9BABA':'#ffa21d')))); ?>">
                                                  <?php echo e(($key + 1)); ?></div> 
                                      
                                    </td>

                                  
                                     <td><?php echo e($order->material->material_name); ?></td>
                                    <td><?php echo e($order->created_date); ?></td>
                                    <td><?php echo e($order->createdBy->name); ?></td>
                                  
                                    <td><?php echo e($order->approvedBy != ''?$order->approvedBy->name:$order->createdBy->name); ?></td>
                                    <td><?php echo e($order->priority); ?></td>
                                    <td><?php echo e($order->status); ?></td>




                                    <?php if(Gate::check('edit purchase') || Gate::check('delete purchase') || Gate::check('show purchase')): ?>
                                        <td class="Action">
                                            <span>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show purchase')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                            <a href="<?php echo e(route('order.show',\Crypt::encrypt($order->id))); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Show')); ?>" data-original-title="<?php echo e(__('Detail')); ?>">
                                                                <i class="ti ti-eye text-white"></i>
                                                            </a>
                                                        </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit purchase')): ?>
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="<?php echo e(route('order.edit',\Crypt::encrypt($order->id))); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="Edit" data-original-title="<?php echo e(__('Edit')); ?>">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete purchase')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['order.destroy', $order->id],'class'=>'delete-form-btn','id'=>'delete-form-'.$order->id]); ?>

                                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($order->id); ?>').submit();">
                                                            <i class="ti ti-trash text-white"></i>
                                                        </a>
                                                        <?php echo Form::close(); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </span>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Trumen\resources\views/orderrequest/index.blade.php ENDPATH**/ ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Customer-Detail')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('customer.index')); ?>"><?php echo e(__('Customer')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e($customer['name']); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
    <style>
    /* Hide default arrow */

.choose-files div {
    background: #ffffff !important;
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
    height: 44px;
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
    <script src="<?php echo e(asset('assets/js/plugins/dropzone-amd-module.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
      <script>
      function readURL(input, imgno) {

  let file = input.files[0];

  // file validation code not shown

  var reader = new FileReader();

  reader.onload = function(e) {
    
    let src = file.type.startsWith("image") ? e.target.result : defaultImage;
    let size = (file.size / 1024).toFixed(0);
    let date = new Date(file.lastModified).toLocaleDateString();
    $("#blah").text(file.name)
    $("#img_new").attr('src', src);
    $("#blah_holder").append(`
    <div class="col-3" style="padding-right: 40px;">
     <img src="${src}" class="thumb-image" style="
  height: 50px;
  width: auto;
  border: 1px solid lightgray;"
>
</div>
    `);

  }
  reader.readAsDataURL(file);
}



let defaultImage = "https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/833px-PDF_file_icon.svg.png";


$('input[type="file"]').change(function(e) {

 var extension = $('#document').val().split('.').pop().toLowerCase();

if($.inArray(extension, ['gif','png','jpg','jpeg','bmp', 'pdf']) == -1) {
    show_toastr('error', 'You have seleceted unsupported file', 'success');
    return false;
}
  readURL(this, 1);
});
        // $('input[type="file"]').change(function(e) {
        //     var file = e.target.files[0].name;
        //     var file_name = $(this).attr('data-filename');
        //     $('.' + file_name).append(file);
        // });
    </script>
    <script>
        function copyToClipboard(element) {

            var copyText = element.id;
            navigator.clipboard.writeText(copyText);
            // document.addEventListener('copy', function (e) {
            //     e.clipboardData.setData('text/plain', copyText);
            //     e.preventDefault();
            // }, true);
            //
            // document.execCommand('copy');
            show_toastr('success', 'Url copied to clipboard', 'success');
        }
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit customer')): ?>
            <a href="#" data-size="lg" data-url="<?php echo e(route('customer.edit',$customer['id'])); ?>" data-ajax-popup="true" title="<?php echo e(__('Edit Customer')); ?>" data-bs-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-pencil"></i>
            </a>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete customer')): ?>
            <?php echo Form::open(['method' => 'DELETE','class' => 'delete-form-btn', 'route' => ['customer.destroy', $customer['id']]]); ?>

                <a href="#" data-bs-toggle="tooltip" title="<?php echo e(__('Delete Customer')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($customer['id']); ?>').submit();" class="btn btn-sm btn-danger bs-pass-para">
                    <i class="ti ti-trash text-white"></i>
                </a>
            <?php echo Form::close(); ?>

        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="row">
                <div class="col-xl-12">
                    
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="lead-sidenav" style="flex-direction: unset;">
                            <?php if(Auth::user()->type != 'client'): ?>
                                
                                <div data-target="content1" class="list-group-item list-group-item-action border-0 tab active" style="cursor: pointer;"><?php echo e(__('Profile')); ?>

                                    <div class="float-end"></div>
                                </div>
                            <?php endif; ?>

                           
                                <div data-target="content2" data-title="<?php echo e(__('Quotataion')); ?>" class="list-group-item list-group-item-action border-0 tab" style="cursor: pointer;">| <?php echo e(__('Quotation')); ?>

                                    <div class="float-end"></div>
                                </div>
                          
                                <div  data-target="content3" class="list-group-item list-group-item-action border-0 tab" style="cursor: pointer;"><?php echo e(__('Orders')); ?>

                                    <div class="float-end"></div>
                                </div>
                         
                            <?php if(Auth::user()->type != 'client'): ?>
                                <div data-target="content4" class="list-group-item list-group-item-action border-0 tab" style="cursor: pointer;">| <?php echo e(__('Job Card')); ?>

                                    <div class="float-end"></i></div>
                                </div>
                            <?php endif; ?>
                           

                        </div>
                    </div>
                </div>
              
            </div>
    <div class="content" id="content1" style="display:block;">        
    <div class="row">
          <div class="row" style="line-height: 2;margin-top: 30px;">
                               
                                <div class="col-md-8 col-sm-8">
                                <div class="card"> 
                                 <div class="card-body">
                                     <h5><?php echo e(__('Contact Person Info')); ?></h5>
                                <div class="row" >
                                <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                         <div class="ms-2">
                                            <?php echo e(__('Name')); ?>: <span class="mb-0"><?php echo e($customer['name']); ?></span>
                                        </div>
                                   
                                </div>
                               </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        
                                        <div class="ms-2">
                                                 <?php echo e(__('Email')); ?>: <span class="mb-0"><?php echo e($customer['email']); ?></span>
                                        </div>
                                   
                                </div>
                               </div>
                                 <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                          
                                           <?php echo e(__('Number')); ?>: <span class="mb-0 "><?php echo e($customer['contact']); ?></span>
                                        </div>
                                    </div>
                               </div>
                                  <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           <?php echo e(__('Department')); ?>: <span class="mb-0 "><?php echo e($customer['billing_department']); ?></span>
                                        </div>
                                    </div>
                               </div>
                                 <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                           <?php echo e(__('Designation')); ?>: <span class="mb-0"><?php echo e($customer['shipping_designation']); ?></span>
                                        </div>
                                    </div>
                                    </div>
                                     <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           <?php echo e(__('Gender')); ?>: <span class="mb-0"><?php echo e($customer['gender']); ?></span>
                                        </div>
                                    </div>
                                    </div>
                                     
                                    </div>
                               
                                </div>
                                </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                     <div class="card">
                                      <div class="card-body">     
                                     <h5 style="padding-left: 5px;"><?php echo e(__('Categories')); ?></h5>
                                      <div class="d-flex align-items-start">
                                       <?php
                                       $status = \App\Models\Stage::where('created_by', \Auth::user()->creatorId())->first();
                                       ?>
                                        <div class="ms-2">
                                           <?php if(!empty($customer->lead_id != 0)): ?>
                                            <?php echo e(__('Status')); ?>: <span class="mb-0"><?php echo e(!empty($customer->leads->stage)?$customer->leads->stage->name:''); ?></span><br>
                                          
                                           <?php if(!empty($customer->leads->products())): ?>
                                                 <?php $__currentLoopData = $customer->leads->sources(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                 <?php echo e(__('Source')); ?>: <span class="mb-0"><?php echo e(!empty($source->name)?$source->name:''); ?></span><br>
                                                  
                                                   <?php if(!$loop->last): ?>
                                                        ,
                                                    <?php endif; ?>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   <?php else: ?>
                                                   -
                                                   <?php endif; ?>
                                          
                                             <?php echo e(__('Request Type')); ?>: <span class="mb-0"><?php echo e(!empty($customer->leads->request_id)?$customer->leads->request_id:$customer->leads->request_type); ?></span>
                                           
                                           <?php endif; ?>  
                                        </div>
                                    </div>
                                </div>
                           
                            </div>
       
    </div>
                                <div class="card">
                        <div class="card-body">
                            <h5><?php echo e(__('Organization')); ?></h5>
                             <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                           
                                            <?php echo e(__('Sector')); ?>: <span class="mb-0"><?php echo e($customer['sector']); ?></span>
                                           
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                            <?php echo e(__('Industry')); ?>: <span class="mb-0"><?php echo e(!empty($customer->leads->industry_name)?$customer->leads->industry_name:''); ?></span>
                                        </div>
                                    </div>
                                </div>
                                   <?php if(!empty($customer->lead_id != 0)): ?>
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                          
                                              <?php if(!empty($customer->leads->products())): ?>
                                                 <?php $__currentLoopData = $customer->leads->products(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                  <?php echo e(__('Product')); ?>: <span class="mb-0"><?php echo e($product->name); ?></span> 
                                                   <?php if(!$loop->last): ?>
                                                        ,
                                                    <?php endif; ?>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   <?php else: ?>
                                                   -
                                                   <?php endif; ?>
                                                 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            <?php echo e(__('Quantity')); ?>: <span class="mb-0"><?php echo e($customer->leads->quantity); ?></span>
                                        </div>
                                    </div>
                                </div>
                                  <?php endif; ?>  
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            <?php echo e(__('GST Number')); ?>: <span class="mb-0"><?php echo e($customer['tax_number']); ?></span>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        </div>
    <div class="row" style="line-height: 2;">
                                <div class="col-md-8 col-sm-8">
                                    <div class="card">
                                     <div class="card-body">
                                     <h5  style="padding-left: 5px;"><?php echo e(__('Address & Contact')); ?></h5>
                                      <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                            <?php echo e(__('Address')); ?>: <span class="mb-0"><?php echo e($customer['billing_address']); ?></span>
                                        </div>
                                    </div>
                                
                                
                                <div class="row" >
                                
                               <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           <?php echo e(__('Country')); ?>: <span class="mb-0"><?php echo e($customer['billing_country']); ?></span>
                                        </div>
                                    </div>
                                    </div>
                                 <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                          
                                           <?php echo e(__('State')); ?>: <span class="mb-0 "><?php echo e($customer['billing_state']); ?></span>
                                        </div>
                                    </div>
                               </div>
                                  <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           <?php echo e(__('City')); ?>: <span class="mb-0 "><?php echo e($customer['billing_city']); ?></span>
                                        </div>
                                    </div>
                               </div>
                                 
                                    </div>
                                 </div>
                                 </div>
                                </div>
                               
                                <div class="col-md-4 col-sm-4">
                                    <div class="card">
                                    <div class="card-body">
                                     <h5 style="padding-left: 5px;"><?php echo e(__('Additional')); ?></h5>
                                      <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                              <?php if(!empty($customer->lead_id != 0)): ?>
                                            <?php echo e(__('Lead Assigned by')); ?>: <span class="mb-0"><?php echo e($customer->leads->owner->name); ?></span><br>
                                           
                                            <?php echo e(__('Lead Owner ')); ?>: <span class="mb-0"><?php echo e($customer->leads->owner->name); ?></span><br>
                                            <?php echo e(__('Lead Assigned to')); ?>:
                                             <?php $__currentLoopData = $customer->leads->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                             <?php if($loop->first): ?>
                                                <?php continue; ?>
                                               
                                            <?php endif; ?>
                                              <span class="mb-0"><?php echo e(!empty($customer->leads->user)?$customer->leads->user->name:''); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                           
                            </div>                
     </div>
    <div class="row">
         <div class="card">
                        <div class="card-body">
                            <h5><?php echo e(__('Key Notes')); ?></h5>
                            <div class="col-md-12 dropzone top-5-scroll browse-file" id="getnotedetails" style="text-align: justify;">
                                  <?php if(!empty($customer->lead_id != 0)): ?>
                                <?php echo $customer->leads->notes; ?>

                                <?php else: ?>
                                
                                <?php endif; ?>
                            </div>
                        </div>
                        </div>
              <?php echo e(Form::open(array('route' => array('customer.po', $customer->id),'method'=>'post','enctype' => 'multipart/form-data'))); ?>     
             <div class="card">
                        <div class="card-body">
                            
                             <div class="row" style="line-height: 2;">
                                 
                                 <div class="col-md-12 col-sm-12">
                                    <div class="d-flex align-items-start">
                                         <div class="ms-2">
                                           <h5><?php echo e(__('Customer PO Details')); ?></h5>
                                        </div>
                                   
                                </div>
                               </div>
                              
                                <?php echo e(Form::hidden('customer_id',$customer->id,array('class'=>'form-control'))); ?>

                                 <div class="col-md-2 col-sm-2">
                                   
                                            <div class="form-group">
                                                <?php echo e(Form::label('quote_no',__('Quote No.'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::select('quote_no',$qList,null ,array('class'=>'form-control'))); ?>

                                            </div>
                                        
                               </div>
                                <div class="col-md-2 col-sm-2">
                                   
                                            <div class="form-group">
                                                <?php echo e(Form::label('po_date',__('PO Date'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::date('po_date',null,array('class'=>'form-control','placeholder'=>_('Enter Name')))); ?>

                                            </div>
                                        
                               </div>
                                <div class="col-md-2 col-sm-2">
                                  
                                         <div class="form-group">
                                                <?php echo e(Form::label('po_number',__('PO Number'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::text('po_number',null,array('class'=>'form-control','required'=>'required' ,'placeholder'=>_('Enter PO Number')))); ?>

                                            </div>
                                       
                               </div>
                                 <div class="col-md- col-sm-6">
                                  
                                         <div class="card-body employee-detail-create-body">
                           
                                <div class="row">
                                    <div class="form-group col-12 d-flex">
                                        <div class="float-left col-4">
                                            <label for="document"
                                                class="float-left pt-1 form-label">Upload PO File
                                            </label>
                                        </div>
                                        <div class="float-right col-8">
                                            <input type="hidden" name="emp_doc_id" id=""
                                                value="">
                                            <div class="choose-files">
                                                <label for="document">
                                                    <div class=" bg-primary document "> <i
                                                            class="ti ti-upload "></i><?php echo e(__('Choose file here')); ?>

                                                    </div>
                                                    <input type="file"
                                                        class="form-control file"
                                                       
                                                        name="document[]" id="document"
                                                        data-filename="_filename" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                </label>
                                                <span id="blah"></span>
                                             
                                              <div class="row"  id="blah_holder">
                                                 
                                                </div>
                                                
                                            </div>

                                        </div>

                                    </div>
                                </div>
                           
                             </div>
                                        
                        </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="d-flex align-items-start">
                                         <div class="ms-2">
                                         <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn  btn-primary">
                                        </div>
                                   
                                </div>
                               </div>
                            </div>
                          
                        </div>
                        </div>
                          <?php echo e(Form::close()); ?>

                         <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th> <?php echo e(__('Sr.')); ?></th>
                                    <th> <?php echo e(__('Quote Ref No.')); ?></th>
                                    <th> <?php echo e(__('PO Date')); ?></th>
                                    <th> <?php echo e(__('PO Number')); ?></th>
                                    <th> <?php echo e(__('Document')); ?></th>
                                   
                                    <th> <?php echo e(__('PO Status')); ?></th>
                                   
                                </tr>
                            </thead>
                            <tbody>


                                <?php $__currentLoopData = $quotations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quotation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                       
                                        <td>
                                            <div class="number-color ms-2" style="font-size:12px;background-color: <?php echo e(($quotation->status == 0)?'#ffa21d':'#6fd943'); ?>">
                                                   <?php echo e($quotation->id); ?></div> 
                                           </td>
                                        <td class="Id">
                                            <a href="<?php echo e(route('quotation.show', \Crypt::encrypt($quotation->id))); ?>"
                                                class="text text-dark"><?php echo e(Auth::user()->quotationNumberFormat($quotation->quotation_id)); ?></a>
                                        </td>
                                        
                                        <td><?php echo e($quotation->po_date); ?></td>
                                       
                                        <td><?php echo e($quotation->po_number); ?></td>
                                       
                                        <td><a href="https://trumen.truelymatch.com/storage/uploads/document/<?php echo e($quotation->document); ?>" download style="color:#0ce326;"> <?php echo e($quotation->document); ?></a></td>
                                      
                                       <?php
                                        $Po_status = $quotation->document ==''?'Po Pending':'Uploaded';
                                         $Po_status_bg = $quotation->document ==''?'#FF5000':'#0AA350';
                                       ?>
                                         <td><span style="padding:10px;background-color:<?php echo e($Po_status_bg); ?>; border-radius:5px;color:#ffffff;"><?php echo e($Po_status); ?></span></td>
                                       
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
    </div>
   </div>
    </div>
    </div>
    </div>
                        
     <div class="row content" style="display: none;" id="content2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
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


                                <?php $__currentLoopData = $quotations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quotation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                       
                                        <td>
                                            <div class="number-color ms-2" style="font-size:12px;background-color: <?php echo e(($quotation->status == 0)?'#ffa21d':'#6fd943'); ?>">
                                                   <?php echo e($quotation->id); ?></div> 
                                           </td>
                                        <td class="Id">
                                            <a href="<?php echo e(route('quotation.show', \Crypt::encrypt($quotation->id))); ?>"
                                                class="text text-dark"><?php echo e(Auth::user()->quotationNumberFormat($quotation->quotation_id)); ?></a>
                                        </td>
                                        <?php if(count($quotation->items)>0): ?>
                                        <?php $__currentLoopData = $quotation->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                         $product = \App\Models\ProductService::find($item->product_id);
                                         $quoteProduct = \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->first();
                                         $total =  $item->price * (!empty($quoteProduct)?$quoteProduct->quantity:1);
                                        ?>
                                        <td><?php echo e($product->name); ?></td>
                                        <?php if(isset($quoteProduct->tax)): ?>
                                        <?php 
                                        $taxProduct = \App\Models\Tax::find($quoteProduct->tax);
                                        ?>
                                        <td><?php echo e(!empty($taxProduct)?(($total * $taxProduct->rate/100) + $total):$total); ?></td>
                                        <?php else: ?>
                                        <td> <?php echo e($item->price); ?></td>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <td>-</td>
                                        <td>-</td>
                                        <?php endif; ?>
                                        <td><?php echo e(Auth::user()->dateFormat($quotation->quotation_date)); ?></td>
                                        <td> <?php echo e(!empty($quotation->is_revisedBy != '')?$quotation->assignBy->name:$quotation->createdBy->name); ?> </td>
                                       
                                         <td><?php echo e($quotation->status ==0?'Waiting for Approval':'Approved'); ?></td>
                                        <?php if(Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation')): ?>
                                            <td class="Action">
                                                <span>

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
                                                     
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete quotation')): ?>
                                                        <div class="action-btn bg-light ms-2">
                                                                <a href="<?php echo e(route('quotation.show', \Crypt::encrypt($quotation->id))); ?>" class="mx-3 d-inline-flex align-items-center"  data-size="xl" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" data-title="<?php echo e(__('Quotation Detail')); ?>">
                                                                    <i class="ti ti-eye text-dark"></i>
                                                                </a>
                                                            </div>
 <a href="#"
                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para"
                                                                data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"
                                                                data-original-title="<?php echo e(__('Delete')); ?>"
                                                                data-confirm="<?php echo e(__('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?')); ?>"
                                                                data-confirm-yes="document.getElementById('delete-form-<?php echo e($quotation->id); ?>').submit();">
                                                                <i class="ti ti-trash text-white"></i>
                                                            </a>
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
    
    <div class="row content" style="display: none;" id="content3">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-border-style table-border-style">
                    <h5 class="d-inline-block mb-5"><?php echo e(__('Proposal')); ?></h5>

                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th> <?php echo e(__('Sr.')); ?></th>
                                   <th> <?php echo e(__('Order No.')); ?></th>
                                    <th> <?php echo e(__('Product Name')); ?></th>
                                    <th> <?php echo e(__('Total Cost')); ?></th>
                                    <th> <?php echo e(__('Quote Date')); ?></th>
                                    <th> <?php echo e(__('Created by')); ?></th>
                                    <th> <?php echo e(__('Status')); ?></th>
                                     <th> <?php echo e(__('Order Status')); ?></th>
                                    <?php if(Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation')): ?>
                                        <th> <?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(count($orders)>0): ?>
                            
                                        <?php
                                         
                                         $productNames= [];
                                          $totalPrice = 0;
                                          $gtotal = 0;
                                          $created_by = \App\Models\User::find($quotation->created_by)->name;
                                        ?>        
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quotation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr style="margin-top: 30px;background: #F8FAFB;">
                                       
                                        <td>
                                            <div class="number-color ms-2" style="font-size:12px;background-color: <?php echo e(($quotation->status == 1)?'#ffa21d':'#6fd943'); ?>">
                                                   <?php echo e($quotation->id); ?></div> 
                                           </td>
                                       <td class="Id">
                                            <a href="<?php echo e(route('quotation.order.view', \Crypt::encrypt($quotation->id))); ?>"
                                                class="btn btn-outline-primary"><?php echo e(Auth::user()->soNumberFormat($quotation->order_no == 0?$quotation->order_no+1:$quotation->order_no )); ?></a>
                                        </td>
                                        
                                        <?php if(count($quotation->items)>0): ?>
                                       
                                        <?php $__currentLoopData = $quotation->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                         
                                         $quoteProduct = \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->first();
                                         $product = \App\Models\ProductService::find($item->id);
                                         $gtotal += $item->price * (!empty($quoteProduct)?$quoteProduct->quantity:1);
                                        
                                         
                                        ?>
                                       
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                        
                                        <?php 
                                       
                                        $productNamesConcatenated = implode(', ', $productNames);
                                        ?>
                                        
                                        
                                        
                                        <td><?php echo e($gtotal); ?></td>
                                       
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
                                        <td> <?php echo e(($quotation->created_by != '') ? $created_by : ''); ?> </td>
                                       
                                         <td><?php echo e($quotation->status ==1?'Waiting for Approval':(($quotation->status ==2)?'Approved':(($quotation->status ==3)?'Send':'Pending'))); ?></td>
                                          <td><?php echo e($quotation->order_status); ?></td>
                                        <?php if(Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation')): ?>
                                            <td class="Action">
                                                <span>

                                                    
                                                     <div class="action-btn bg-light ms-2">
                                                                <a href="<?php echo e(route('quotation.order.view', \Crypt::encrypt($quotation->id))); ?>"
                                                                    class="mx-3 btn btn-sm align-items-center"
                                                                    data-bs-toggle="tooltip" title="<?php echo e(__('View Quotation')); ?>"
                                                                    data-original-title="<?php echo e(__('Detail')); ?>">
                                                                    <i class="ti ti-eye text-dark"></i>
                                                                </a>
                                                            </div>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit quotation')): ?>
                                                        <div class="action-btn bg-light ms-2">
                                                            <a href="<?php echo e(route('quotation.edit', \Crypt::encrypt($quotation->id))); ?>"
                                                                class="mx-3 btn btn-sm align-items-center"
                                                                data-bs-toggle="tooltip" title="Edit"
                                                                data-original-title="<?php echo e(__('Convert to JobCard')); ?>">
                                                                <i class="ti ti-pencil text-dark"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    
                                                </span>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="8" style="text-align:center;">Record not found</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row content" style="display: none;" id="content4">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-border-style table-border-style">
                    <h5 class="d-inline-block mb-5"><?php echo e(__('Jobcard')); ?></h5>
                     <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th> <?php echo e(__('Sr.')); ?></th>
                                    <th> <?php echo e(__('Ref No.')); ?></th>
                                    <th> <?php echo e(__('Product Name')); ?></th>
                                    <th> <?php echo e(__('Total Cost')); ?></th>
                                    <th> <?php echo e(__('Quote Date')); ?></th>
                                    <th> <?php echo e(__('Created by')); ?></th>
                                    <th> <?php echo e(__('Card Request')); ?></th>
                                     <th> <?php echo e(__('Status')); ?></th>
                                    <?php if(Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation')): ?>
                                        <th> <?php echo e(__('Order Acknowledge')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($jobcard)>0): ?>
                                        <?php
                                         $gtotal =  0;
                                         $total = 0;
                                         $created_by = \App\Models\User::find($quotation->created_by)->name;
                                        ?>
                                <?php $__currentLoopData = $jobcard; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quotation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr  style="margin-top: 30px;background: #F8FAFB;">
                                       
                                        <td>
                                            <div class="number-color ms-2" style="font-size:12px;background-color: <?php echo e(($quotation->status == 0)?'#ffa21d':'#6fd943'); ?>">
                                                   <?php echo e($quotation->id); ?></div> 
                                           </td>
                                        <td class="Id">
                                            <a href="<?php echo e(route('quotation.show', \Crypt::encrypt($quotation->id))); ?>"
                                                class="btn btn-outline-primary"><?php echo e(Auth::user()->jobNumberFormat($quotation->quotation_id)); ?></a>
                                        </td>
                                        
                                        <?php if(count($quotation->items)>0): ?>
                                       
                                       
                                        
                                           
                                         <td>
                                              <?php $__currentLoopData = $quotation->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                         
                                         $quoteProduct = \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->first();
                                         $products = \App\Models\ProductService::find($quoteProduct->product_id);
                                         $gtotal += $item->price * (!empty($quoteProduct)?$quoteProduct->quantity:1);
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
                                        <td> <?php echo e(($quotation->created_by != '') ? $created_by : ''); ?> </td>
                                       
                                         <td><?php echo e($quotation->status ==1?'Waiting for Approval':(($quotation->status ==2)?'Approved':(($quotation->status ==3)?'Send':'Pending'))); ?></td>
                                          <td><?php echo e($quotation->order_status); ?></td>
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
                                 <?php else: ?>
                                <tr>
                                    <td colspan="8" style="text-align:center;">Record not found</td>
                                </tr>
                                <?php endif; ?>
                               
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
    $(document).ready(function(){
       
        // Add click event listener to tabs
        $('.tab').click(function(){
            
            // Hide all content divs
            $('.content').hide();
            $('.tab').removeClass('active');
            // Get the target id from data attribute
            $(this).addClass('active');
            var targetId = $(this).data('target');
            
            // Show the corresponding content div
            $('#' + targetId).show();
        });
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/customer/show.blade.php ENDPATH**/ ?>
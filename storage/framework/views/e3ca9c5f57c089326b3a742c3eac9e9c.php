<?php $__env->startSection('page-title'); ?>
 <?php echo e(__('Edit Leads')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dropzone.min.css')); ?>">
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
     <style>
    .tab-active{
        background-color:#dfe5ea;
    }
/*     input[type="text"]::-webkit-input-placeholder {*/
/*     color: var(--color-customColor);*/
/*    font-weight: bold;*/
/*}*/
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
        $(document).on("change", ".change-pipeline select[name=default_pipeline_id]", function () {
            $('#change-pipeline').submit();
        });
    $(document).ready(function() {
    // Your CSS styling goes here
     $('.tab').click(function(){
            
            // Hide all content divs
            $('.content').hide();
            $('.tab').removeClass('btn btn-primary');
            $('.tab').addClass('tab-active');
            $('.tab').css('color', '#000000');
            // Get the target id from data attribute
            $(this).addClass('btn btn-primary');
            $(this).removeClass('tab-active');
            $(this).css('color', '#ffffff');
            var targetId = $(this).data('target');
            
            // Show the corresponding content div
            $('#' + targetId).show();
        });
    $('.page-header-title').css('display', 'none');
    });

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<h4 class="m-b-10"><a href="<?php echo e(route('leads.list')); ?>" class="text-dark" style="font-weight: bolder;"> <i class="bx bx-undo"></i><?php echo e(__('Edit Leads')); ?></a>
</h4>

   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo e(Form::model($lead, array('route' => array('leads.update', $lead->id), 'method' => 'PUT'))); ?>

<div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8" style="padding:15px;">
                <h6 class="sub-title"></h6>
                </div>
                
                <div class="col-lg-4 col-md-4 col-sm-4" style="margin-top: -30px;">
                 <span style="float: inline-end;"><i class="ti ti-send" style="position: absolute;margin-left: 5px;margin-top: 14px;z-index: 10;color: white;"></i><input type="submit" value="<?php echo e(__('Save')); ?>" title="<?php echo e(__('Edit Lead')); ?>" class="btn-sm custom-file-uploadss" style="border: none;"></span>
                </div>
</div>  


<div class="modal-body">
      <div class="row">
                <div class="col-xl-12">
                    <div class=" sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="lead-sidenav" style="flex-direction: unset;margin-top: 30px;">
                            <?php if(Auth::user()->type != 'client'): ?>
                                
                                
                                 <div data-target="content1" class="tab btn btn-primary" style="cursor: pointer;padding: 10px 70px 11px 65px;margin-right: 5px;color:white;"><?php echo e(__('Profile')); ?>

                                    <div class="float-end"></div>
                                </div>
                            <?php endif; ?>

                            <?php if(Auth::user()->type != 'client'): ?>
                                
                                <a href="<?php echo e(route('quotations.create', ['lead_id' => $lead->id, 0])); ?>" data-title="<?php echo e(__('Quotataion Create')); ?>" class="list-group-item list-group-item-action border-0 tab-active" style="border-radius: 5px;cursor: pointer;padding: 10px 70px 11px 65px;margin-right: 5px;color:black;width:230px;"><?php echo e(__('Quotation')); ?>

                                    <div class="float-end"></div>
                                </a>
                            <?php endif; ?>

                           
                            <?php if(Auth::user()->type != 'client'): ?>
                           
                                
                                 <div data-target="content2" class="btn btn-light tab tab-active" style="border-radius: 5px;cursor: pointer;padding: 10px 70px 11px 65px;margin-right: 5px;color:black;"> <?php echo e(__(' Notes')); ?>

                                    <div class="float-end"></i></div>
                                </div>
                            <?php endif; ?>
                            <?php if(Auth::user()->type != 'client'): ?>
                                
                                <div  data-target="content3" class="btn btn-light tab tab-active" style="border-radius: 5px !important;color:black;padding: 10px 70px 11px 65px;margin-right: 5px;cursor: pointer;border-bottom-left-radius: unset !important;border-top-left-radius: inherit;border-top-right-radius: inherit;;border-bottom-right-radius: unset !important;
"> <?php echo e(__('Activity')); ?>

                                    <div class="float-end"></i></div>
                                </div>
                                 <a href="#" data-target="content4" class="btn btn-light tab tab-active" data-title="<?php echo e(__('Quotataion Create')); ?>" class="btn btn-light tab-active" style="padding: 10px 70px 11px 65px;color:black;"> <?php echo e(__('Quotations')); ?>

                                    <div class="float-end"></div>
                                </a>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
              
            </div>
    
    <?php
        $plan= \App\Models\Utility::getChatGPTSettings();
          $stages = \App\Models\LeadStage::where('created_by', '=', \Auth::user()->ownerId())->get()->pluck('name', 'id');
          $customers             = \App\Models\Customer::where('lead_id', $lead->id)->get();
         
         $types = [
         'Product Inquary',
         'Request for Information'
         ];
        
    ?>
   
    
 <?php
       $Cdata = !empty($customer)?$customer->tax_number:'';
       $cbilling_name = !empty($customer)?$customer->billing_name:'';
       $cphone = !empty($customer)?$customer->billing_phone:'';
       $cemail = !empty($customer)?$customer->email:'';
       $cgender = !empty($customer)?$customer->gender:'';
       $cbilling_designation = !empty($customer)?$customer->billing_designation:'';
       $cbilling_department = !empty($customer)?$customer->billing_department:'';
       $cshipping_address = !empty($customer)?$customer->shipping_address:'';
       $cshipping_country = !empty($customer)?$customer->shipping_country:'';
       $cshipping_state = !empty($customer)?$customer->shipping_state:'';
       $cshipping_city = !empty($customer)?$customer->shipping_city:'';
       $cshipping_zip = !empty($customer)?$customer->shipping_zip:'';
       $cprefix = !empty($customer)?$customer->prefix:'';
       $csector = !empty($customer)?$customer->sector:'';
       $cid = !empty($customer)?$customer->id:'';
       ?>    
<div class="row content" id="content1"  style="display:block;margin-top: 30px;">
    <div class="card">
        <div class="card-body">
           <h6 class="sub-title"><?php echo e(__('Organization')); ?></h6>
            <div class="row">
                
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="form-group">
                <?php echo e(Form::label('industry',__('Industry'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('industry_name',null,array('class'=>'form-control','required'=>'required' ,'placeholder'=>_('Enter Name')))); ?>

            </div>
        </div>        
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="form-group">
                <?php echo e(Form::label('name',__('Sector'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::text('sector',$csector,array('class'=>'form-control','placeholder'=>_('Enter Name')))); ?>

            </div>
        </div>
        
         <div class="col-lg-4 col-md-4 col-sm-8">
            <div class="form-group">
                <?php echo e(Form::label('products', __('Product'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('products[]', $products,null, array('class' => 'form-control select2','id'=>'choices-multiple1','multiple'=>''))); ?>


            </div>
        </div>
       <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('quantity',__('Quantity'),['class'=>'form-label'])); ?>

                <?php echo e(Form::number('quantity',null,array('class'=>'form-control' , 'placeholder'=>__('Enter quantity')))); ?>


            </div>
        </div>
      
       
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('gst_number',__('Gst Number'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('tax_number',$Cdata,array('class'=>'form-control' , 'placeholder' => __('Enter Gst Number')))); ?>

            </div>
        </div>
       
    </div>
        </div>
     </div>  
     
        <div class="row">
            
                <div class="col-md-8">
                    <div class="card">
                    <div class="card-body">
                    <h6 class="sub-title"><?php echo e(__('Contact Person Information')); ?></h6>
                    <div class="col-sm-6" style="float: inline-end;">
                         <select style="padding:10px;;margin-left: 5px;position:absolute;margin-top: 30px;background: white;border: 0px;" name="prefix">
                            <option value="Mr." <?php echo e($cprefix == 'Mr.'?'selected': ''); ?>>Mr.</option>
                            <option value="Mrs." <?php echo e($cprefix == 'Mrs.'?'selected': ''); ?>>Mrs.</option>
                            <option value="Ms." <?php echo e($cprefix == 'Ms.'?'selected': ''); ?>>Ms.</option>
                            </select>
                        <div class="form-group">
                            <?php echo e(Form::label('billing_name',__('Name'),array('class'=>'','class'=>'form-label'))); ?>

                            <?php echo e(Form::text('billing_name', $cbilling_name,array('class'=>'form-control' , 'placeholder'=>__('Enter Name'), 'style' => 'padding-left:90px'))); ?>

                        </div>
                    </div>
                    <div class="col-5 form-group">
                        <?php echo e(Form::label('email', __('Email'),['class'=>'form-label'])); ?>

                        <?php echo e(Form::text('email', $cemail, array('class' => 'form-control','required'=>'required' , 'placeholder' => __('Enter email')))); ?>

                    </div>
                    <div class="col-sm-6" style="float: inline-end;">
                        <div class="form-group">
                            <?php echo e(Form::label('billing_phone',__('Phone'),array('class'=>'form-label'))); ?>

                            <?php echo e(Form::text('phone',$cphone,array('class'=>'form-control' , 'id' => 'phone','placeholder'=>__('Enter Phone')))); ?>

                        </div>
                    </div>
               
           
            <div class="col-sm-6">
                <div class="form-group">
                   <?php echo Form::label('gender', __('Gender'), ['class' => 'form-label' , 'required' => 'required' ]); ?><span class="text-danger">*</span>
                    <div class="d-flex radio-check">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="g_male" value="Male" name="billing_gender"
                                                        class="form-check-input" value="Male" <?php echo e($cgender == 'Male'?'checked':''); ?>>
                                                    <label class="form-check-label " for="g_male"><?php echo e(__('Male')); ?></label>
                                                </div>
                                                <div class="custom-control custom-radio ms-4 custom-control-inline">
                                                    <input type="radio" id="g_female" value="Female" name="billing_gender"
                                                        class="form-check-input" <?php echo e($cgender == 'Female'?'checked':''); ?>>
                                                    <label class="form-check-label "
                                                        for="g_female"><?php echo e(__('Female')); ?></label>
                                                </div>
                                            </div>
    
                </div>
            </div>
            
             <div class="col-sm-5">
                <div class="form-group">
                   <?php echo e(Form::label(null, __('Department'), ['class' => 'form-label', 'style' => 'display: table-column'])); ?>

                 
                </div>
            </div>
             <div class="col-6 form-group"  style="float: inline-end;">
                <?php echo e(Form::label('designation', __('Designation'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('billing_designation', $cbilling_designation, array('class' => 'form-control', 'placeholder' => __('Enter Designation')))); ?>

            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <?php echo e(Form::label('department',__('Department'),array('class'=>'','class'=>'form-label'))); ?>

                    <?php echo e(Form::text('billing_department',$cbilling_department,array('class'=>'form-control' , 'placeholder'=>__('Enter Department')))); ?>

                </div>
            </div>
           <input name="user_id" value="<?php echo e($cid); ?>" type="hidden">
           <input name="pipeline_id" value="<?php echo e($lead->pipeline_id); ?>" type="hidden">
           
            </div>
            </div>
            </div>
             <div class="col-md-4">
                 <div class="card">
                 <div class="card-body">
                  <h6 class="sub-title"><?php echo e(__('Categories')); ?></h6><br>
                 <div class="col-sm-12">
                 <div class="form-group">
                    
                     <?php echo e(Form::label('stage_id', __('Status'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                     <select class="form-control select" required="required" name="stage_ids">
                         <option value="6" <?php echo e($lead->stage_id == 6?'selected':''); ?>>Do not contact</option>
                         <option value="7" <?php echo e($lead->stage_id == 7?'selected':''); ?>>Converted</option>
                         <option value="8" <?php echo e($lead->stage_id == 8?'selected':''); ?>>Open</option>
                         <option value="9" <?php echo e($lead->stage_id == 9?'selected':''); ?>>Replied</option>
                         <option value="11" <?php echo e($lead->stage_id == 11?'selected':''); ?>>Quantitation</option>
                         <option value="12" <?php echo e($lead->stage_id == 12?'selected':''); ?>>Lost Quantitation</option>
                         <option value="13" <?php echo e($lead->stage_id == 13?'selected':''); ?>>Opportunities</option></select>
                 
                </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <?php echo e(Form::label('sources', __('Sources'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                   <?php echo e(Form::select('sources[]', $sources,null, array('class' => 'form-control select','required'=>'required'))); ?>

    
                </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <?php echo e(Form::label('type', __('Request Type'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                   <?php echo e(Form::select('request_id', $types,null, array('class' => 'form-control select','required'=>'required'))); ?>

    
                </div>
                </div>
               </div>
               </div>
            </div>
        </div>
  <?php if(count($customers)>0): ?>
  <?php $__currentLoopData = $customers->slice(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="card">
        <div class="card-body">
  <div class="add_contact"><input name="shipping_user_id[]" value="<?php echo e($v->id); ?>" type="hidden"><h6 class="sub-title">Contact Person Information</h6><div class="row"><div class="col-lg-6 col-md-6 col-sm-6"><div class="form-group"><label for="shipping_name" class="form-label">Name</label><input class="form-control" placeholder="Enter Name" name="shipping_name[]" value="<?php echo e($v->shipping_name); ?>" type="text" id="shipping_name"></div></div><div class="col-lg-6 col-md-6 col-sm-6"><label for="email" class="form-label">Email</label><input class="form-control" placeholder="Enter email" name="shipping_email[]"  value="<?php echo e($v->email); ?>" type="text"></div><div class="col-lg-6 col-md-6 col-sm-6"><div class="form-group"><label for="shipping_phone" class="form-label">Phone</label><span><button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;border-radius: 5px 0px 0px 5px;height: 35px; margin: 31px 0px 0px -34px;position: absolute;"><a href="#"><img src="https://trumen.truelymatch.com/assets/images/india.png" width="30" alt="india"> </a></button><input class="form-control" style="padding-left: 100px;" placeholder="Enter Phone" name="shipping_phone[]" value="<?php echo e($v->shipping_phone); ?>" type="text" id="shipping_phone"> </span></div></div><div class="col-lg-5 col-md-5 col-sm-5"><div class="form-group"><label for="gender" class="form-label">Gender</label><span class="text-danger">*</span><div class="d-flex radio-check"><div class="custom-control custom-radio custom-control-inline"><input type="radio" id="g_male" value="Male" name="shipping_gender[<?php echo e($key); ?>]" value="<?php echo e($v->shipping_gender); ?>" class="form-check-input" <?php echo e($v->shipping_gender != 'Male'?'checked':''); ?>><label class="form-check-label " for="g_male">Male</label></div><div class="custom-control custom-radio ms-4 custom-control-inline"><input type="radio" id="g_female" value="Female" name="shipping_gender[]" class="form-check-input"><label class="form-check-label " for="g_female" <?php echo e($v->shipping_gender != 'Female'?'checked':''); ?>>Female</label></div></div></div></div><div class="col-lg-6 col-md-6 col-sm-6"><div class="form-group"><label for="department_id" class="form-label">Department</label><input class="form-control" placeholder="Enter Department" name="shipping_department[]" value="<?php echo e($v->shipping_department); ?>" type="text"></div></div><div class="col-lg-5 col-md-5 col-sm-5"><div class="form-group"><label for="designation_id" class="form-label">Designation</label><input class="form-control" placeholder="Enter Designation" name="shipping_designation[]" value="<?php echo e($v->shipping_designation); ?>" type="text"></div></div><div class="col-lg-1 col-md-1 col-sm-1" style="padding-top: 26px;"><a class="mx-3 btn btn-primary sm  align-items-center removeButton" title="remove"><label class="form-check-label " for="g_male"><i class="ti ti-trash text-white"></i></label></a></div></div></div></div></div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>
   <div id="divContainer"></div>
            <div class="form-group text-center">
                <a class="btn btn-outline-light sm text-dark" onclick="appendDiv()" style="background-color: revert-layer;"><i class="ti ti-plus" style="background-color: darkgray;
                    border-radius: 50%;"></i> Add Contact Person</a>
             </div>
    <?php if(App\Models\Utility::getValByName('shipping_display')=='on'): ?>
       
       
        <div class="row">
        <div class="col-md-8">
        <div class="card">
        <div class="card-body">
             <h6 class="sub-title"><?php echo e(__('Address & Contact')); ?></h6>
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_address',__('Address'),array('class'=>'form-label'))); ?>

                    <label class="form-label" for="example2cols1Input"></label>
                    <?php echo e(Form::textarea('shipping_address',$cshipping_address,array('class'=>'form-control','rows'=>3 , 'placeholder'=>__('Enter Address')))); ?>


                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-6" style="float: inline-end;">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_city',__('City'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::text('shipping_city',$cshipping_city,array('class'=>'form-control' , 'placeholder'=>__('Enter City')))); ?>


                </div>
            </div>
            <div class=" col-lg-5 col-md-5 col-sm-5">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_state',__('State'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::text('shipping_state',$cshipping_state,array('class'=>'form-control' , 'placeholder'=>__('Enter State')))); ?>


                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6" style="float: inline-end;">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_country',__('Country'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::text('shipping_country',$cshipping_country,array('class'=>'form-control' , 'placeholder'=>__('Enter Country')))); ?>


                </div>
            </div>


            <div class="col-lg-5 col-md-5 col-sm-5">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_zip',__('Zip Code'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::text('shipping_zip',$cshipping_zip,array('class'=>'form-control' , 'placeholder' => __('Enter Zip Code')))); ?>


                </div>
            </div>
           </div>
           </div>
           </div>
             <div class="col-md-4">
               <div class="card">
               <div class="card-body">  
              <h6 class="sub-title"><?php echo e(__('Additional')); ?></h6><br>
             <div class="col-sm-12">
             <div class="form-group">
                  <?php echo e(Form::label('assigned_by',__('Lead Assigned by'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::text('assigned_by',\Auth::user()->name,array('class'=>'form-control' , 'placeholder' => __('Lead Assigned Name'), 'readonly'))); ?>

                
            </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <?php echo e(Form::label('owner_name', __('Lead Owner Name'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('owner_id',\Auth::user()->name, array('class' => 'form-control','readonly'))); ?>


            </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                 <?php echo e(Form::label('assigned_to', __('Lead Assigned to'),['class'=>'form-label'])); ?>

                 <?php echo e(Form::select('assigned_to[]', $assigned_to, null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'','required'=>'required'))); ?>


            </div>
            </div>
           </div>
           </div>
        </div>
        
        </div>
        
    <?php endif; ?>
    
        <input type="hidden" name="subject" value="demo">
        <!--<input type="hidden" name="user_id" value="<?php echo e(\Auth::user()->ownerId()); ?>">-->
        
        <div class="card">
        <div class="card-body">
         <div class="col-12 form-group">
            <?php echo e(Form::label('notes', __('Notes'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('notes',null, array('class' => 'summernote-simple', 'style' => 'width:100%;'))); ?>

        </div>
        </div>
         <div class="modal-footer" style="padding: 13px 18px 12px 15px;">
              <span style="float: inline-end;"><i class="ti ti-send" style="position: absolute;margin-left: 5px;margin-top: 14px;z-index: 10;color: white;"></i><input type="submit" value="<?php echo e(__('Save')); ?>" title="<?php echo e(__('Edit Lead')); ?>" class="btn-sm custom-file-uploadss" style="border: none;"></span>
                
           </div>  
           
        </div>
        </div>
    </div>
    
</div>
<div  id="content2" class="card content" style="display:none;margin-top: 30px;">  
                   
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h5><?php echo e(__('Call Notes')); ?></h5>
                                            
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush mt-2" id="note-lists">
                                            <?php if(!$lead->discussions->isEmpty()): ?>
                                                <?php $__currentLoopData = $lead->discussions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discussion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="list-group-item px-0">
                                                        <div class="d-block d-sm-flex align-items-start">
                                                            <img src="<?php if($discussion->user->avatar): ?> <?php echo e(asset('/storage/uploads/avatar/'.$discussion->user->avatar)); ?> <?php else: ?> <?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?> <?php endif; ?>"
                                                                 class="img-fluid wid-40 me-3 mb-2 mb-sm-0" alt="image">
                                                            <div class="w-100">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <div class="mb-3 mb-sm-0">
                                                                        <h6 class="mb-0"> <?php echo e($discussion->comment); ?></h6>
                                                                        <span class="text-muted text-sm"><?php echo e($discussion->user->name); ?></span>
                                                                    </div>
                                                                    <div class="form-check form-switch form-switch-right mb-2">
                                                                        <?php echo e($discussion->created_at->diffForHumans()); ?>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <li class="text-center">
                                                    <?php echo e(__(' No Data Available.!')); ?>

                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                      

                                        <div class="row">
                                            <div class="col-12 form-group">
                                                <?php echo e(Form::label('comment', __('Message'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::textarea('comment', null, array('class' => 'form-control', 'id'=>'disc-note'))); ?>

                                                 <?php echo e(Form::hidden('id', $lead->id, array('class' => 'form-control', 'id'=>'lead_id'))); ?>

                                            </div>
                                           
                                        </div> 
                                           
                                        
                                    </div>
                                    
                                    <div class="row" style="padding: 10px;">
                                           <div class="col-3 form-group">
                                               <?php echo e(Form::select('stage_id', $stages,null, array('class' => 'form-control select2','id'=>'choices-multiple1'))); ?>

                                           </div>
                                            <div class="col-9 form-group">
                                                <div class="modal-footer">
                                                    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
                                                    <input type="submit" value="<?php echo e(__('Add')); ?>" class="btn  btn-primary" id="add-notes">
                                                </div>
                                            </div>    
                                        </div>        
                                   

                                    </div>
                                </div>
                            </div>
                           
                        </div>  
                         <div id="content3" class="content" style="display:none;margin-top: 30px;">
                    <div id="activity" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Activity')); ?></h5>
                        </div>
                        <div class="card-body ">

                            <div class="row leads-scroll" >
                                <ul class="event-cards list-group list-group-flush mt-3 w-100">
                                    <?php if(!$lead->activities->isEmpty()): ?>
                                        <?php $__currentLoopData = $lead->activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="list-group-item card mb-3">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-auto mb-3 mb-sm-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar">
                                                                <img src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>"
                                                                 class="img-fluid wid-40 me-3 mb-2 mb-sm-0" alt="image">
                                                            </div>
                                                            <div class="ms-3">
                                                                <span class="text-dark text-sm"><?php echo e(__($activity->log_type)); ?></span>
                                                                <h6 class="m-0"><?php echo $activity->getLeadRemark(); ?></h6>
                                                                <small class="text-muted"><?php echo e($activity->created_at->diffForHumans()); ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">

                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        No activity found yet.
                                    <?php endif; ?>
                                </ul>
                            </div>

                        </div>
                    </div>
                    </div>
                     <div class="row content" style="display: none;" id="content4">
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
                                        <td> <?php echo e(!empty($quotation->customer) ? $quotation->customer->name : ''); ?> </td>
                                       
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


<?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
 <script>
   const phoneInputField = document.querySelector("#phone");
   const phoneInput = window.intlTelInput(phoneInputField, {
     utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            nationalMode: true,
            autoHideDialCode: true,
            autoPlaceholder: "ON",
            dropdownContainer: document.body,
            formatOnDisplay: true,
            hiddenInput: "phone",
            initialCountry: "IN",
            placeholderNumberType: "MOBILE",
            separateDialCode: true
   });
 </script>
<script>

     $(document).ready(function() {
     
       $(".iti").css('display', 'block');
  });
    var stage_id = '<?php echo e($lead->stage_id); ?>';

    $(document).ready(function () {
        var pipeline_id = $('[name=pipeline_id]').val();
        getStages(pipeline_id);
    });
    
    $(document).on("change", "#commonModal select[name=pipeline_id]", function () {
        var currVal = $(this).val();
        console.log('current val ', currVal);
        getStages(currVal);
        
    });
    function appendDiv() {
    // Create a new div element
    //  $('#divContainer').append("<div id='mySecondDiv'></div>");
    $('#divContainer').append(' <div class="card"><div class="card-body"><div class="add_contact"><input name="shipping_user_id[]" type="hidden"><h6 class="sub-title">Contact Person Information</h6><div class="row"><div class="col-lg-6 col-md-6 col-sm-6"><div class="form-group"><label for="shipping_name" class="form-label">Name</label><input class="form-control" placeholder="Enter Name" name="shipping_name[]" type="text" id="shipping_name"></div></div><div class="col-lg-6 col-md-6 col-sm-6"><label for="email" class="form-label">Email</label><input class="form-control" placeholder="Enter email" name="shipping_email[]" type="text"></div><div class="col-lg-6 col-md-6 col-sm-6"><div class="form-group"><label for="shipping_phone" class="form-label">Phone</label><span><button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;border-radius: 5px 0px 0px 5px;height: 35px; margin: 31px 0px 0px -34px;position: absolute;"><a href="#"><img src="https://trumen.truelymatch.com/assets/images/india.png" width="30" alt="india"> </a></button><input class="form-control" style="padding-left: 100px;" placeholder="Enter Phone" name="shipping_phone[]" type="text" id="shipping_phone"> </span></div></div><div class="col-lg-5 col-md-5 col-sm-5"><div class="form-group"><label for="gender" class="form-label">Gender</label><span class="text-danger">*</span><div class="d-flex radio-check"><div class="custom-control custom-radio custom-control-inline"><input type="radio" id="g_male" value="Male" name="shipping_genders[]" class="form-check-input" checked><label class="form-check-label " for="g_male">Male</label></div><div class="custom-control custom-radio ms-4 custom-control-inline"><input type="radio" id="g_female" value="Female" name="shipping_genders[]" class="form-check-input"><label class="form-check-label " for="g_female">Female</label></div></div></div></div><div class="col-lg-6 col-md-6 col-sm-6"><div class="form-group"><label for="department_id" class="form-label">Department</label><input class="form-control" placeholder="Enter Department" name="shipping_department[]" type="text"></div></div><div class="col-lg-5 col-md-5 col-sm-5"><div class="form-group"><label for="designation_id" class="form-label">Designation</label><input class="form-control" placeholder="Enter Designation" name="shipping_designation[]" type="text"></div></div><div class="col-lg-1 col-md-1 col-sm-1" style="padding-top: 26px;"><a class="mx-3 btn btn-primary sm  align-items-center removeButton" title="remove"><label class="form-check-label " for="g_male"><i class="ti ti-trash text-white"></i></label></a></div></div></div></div></div>');

    // Append the new div to a container
    // var container = document.getElementById('divContainer');
    // container.appendChild(newDiv);
  }
    $(document).on('click', '.removeButton', function(e) {
   e.preventDefault();
   $(this).closest('.add_contact').remove();
   return false;
});
    function getStages(id) {
        $.ajax({
            url: '<?php echo e(route('leads.json')); ?>',
            data: {pipeline_id: id, _token: $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            success: function (data) {
                var stage_cnt = Object.keys(data).length;
                $("#stage_id").empty();
                if (stage_cnt > 0) {
                    $.each(data, function (key, data1) {
                        var select = '';
                        if (key == '<?php echo e($lead->stage_id); ?>') {
                            select = 'selected';
                        }
                        $("#stage_id").append('<option value="' + key + '" ' + select + '>' + data1 + '</option>');
                    });
                }
                $("#stage_id").val(stage_id);
                $('#stage_id').select2({
                    placeholder: "<?php echo e(__('Select Stage')); ?>"
                });
            }
        })
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/leads/edit.blade.php ENDPATH**/ ?>
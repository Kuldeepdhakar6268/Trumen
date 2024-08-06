<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Vendor-Detail')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('vender.index')); ?>"><?php echo e(__('Vendor')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e($vendor['name']); ?></li>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create bill')): ?>
            <a href="<?php echo e(route('bill.create',$vendor->id)); ?>" class="btn btn-sm btn-primary">
                <?php echo e(__('Create Bill')); ?>

            </a>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit vender')): ?>
            <a href="#" class="btn btn-sm btn-primary" data-size="xl" data-url="<?php echo e(route('vender.edit',$vendor['id'])); ?>" data-ajax-popup="true" title="<?php echo e(__('Edit')); ?>" data-bs-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                <i class="ti ti-pencil"></i>
            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete vender')): ?>
            <?php echo Form::open(['method' => 'DELETE', 'route' => ['vender.destroy', $vendor['id']],'class'=>'delete-form-btn','id'=>'delete-form-'.$vendor['id']]); ?>

            <a href="#" class="btn btn-sm btn-danger bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($vendor['id']); ?>').submit();">
                <i class="ti ti-trash text-white"></i>
            </a>
            <?php echo Form::close(); ?>

        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   
      <div class="row ">
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 <?php echo e(Form::label('name',__('Company Name'),array('class'=>'form-label'))); ?><span class="text-danger">*</span>
                 <?php echo e(Form::text('name',$vendor->name,array('class'=>'form-control','required'=>'required' , 'readonly', 'style' =>'background-color: #efe9e9;', 'placeholder'=>__('M & S Gourav Gases')))); ?>

 
             </div>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 <?php echo e(Form::label('contact_person',__('Contact Person'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                 <?php echo e(Form::text('contact_person',$vendor->contact_person,array('class'=>'form-control','required'=>'required' , 'readonly', 'style' =>'background-color: #efe9e9;','placeholder' => __('Mahi Sharma')))); ?>

 
             </div>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                 <?php echo e(Form::email('email',$vendor->email,array('class'=>'form-control','required'=>'required' , 'readonly', 'style' =>'background-color: #efe9e9;','placeholder' => __('m&m@gmail.com')))); ?>

             </div>
         </div>
 
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 <?php echo e(Form::label('sector',__('Sector'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                 <?php echo e(Form::text('sector',$vendor->sector,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('Sector')))); ?>

             </div>
         </div>
 
           <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 <?php echo e(Form::label('industry',__('Industry'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                 <?php echo e(Form::text('industry',$vendor->industry,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('Manufacturing')))); ?>

             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 <?php echo e(Form::label('tax_number',__('GSTIN'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                 <?php echo e(Form::text('tax_number',$vendor->tax_number,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('213242453234')))); ?>

             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 <?php echo e(Form::label('contact',__('Number'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                 <?php echo e(Form::text('contact',$vendor->contact,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('9999999999')))); ?>

             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 <?php echo e(Form::label('alternate',__('Alternative Number'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                 <?php echo e(Form::text('alternate',$vendor->alternate,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('9999999999')))); ?>

             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 <?php echo e(Form::label('plot_number',__('Plot Number'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                 <?php echo e(Form::text('plot_number',$vendor->plot_number,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('Dreamland 202')))); ?>

             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 <?php echo e(Form::label('land_mark',__('Land Mark'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                 <?php echo e(Form::text('land_mark',$vendor->land_mark,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('Dreamland 202')))); ?>

             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 <?php echo e(Form::label('street_name',__('Street Name'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                 <?php echo e(Form::text('street_name',$vendor->street_name,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('Anand Bazar')))); ?>

             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 <?php echo e(Form::label('area_name',__('Area Name'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                 <?php echo e(Form::text('area_name',$vendor->area_name,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('Old Palasia')))); ?>

             </div>
         </div>
         
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 <?php echo e(Form::label('pincode',__('Pincode'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                 <?php echo e(Form::text('pincode',$vendor->pincode,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('454720')))); ?>

             </div>
         </div>
       
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 <?php echo e(Form::label('city',__('City'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                 <?php echo e(Form::text('city',$vendor->city,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('Indore')))); ?>

             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 <?php echo e(Form::label('state',__('State'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                 <?php echo e(Form::text('state',$vendor->state,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('Madhy Pradesh')))); ?>

             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 <?php echo e(Form::label('country',__('Country'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                 <?php echo e(Form::text('country',$vendor->country,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('India')))); ?>

             </div>
         </div>
 
        
     </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/vender/show.blade.php ENDPATH**/ ?>
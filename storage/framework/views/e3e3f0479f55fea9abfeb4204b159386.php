<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dropzone.min.css')); ?>">
   <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />

<?php $__env->stopPush(); ?>
<style>
input[type="text"]::-webkit-input-placeholder {
     color: #6c6d6e !important;
       font-weight: 500;
}
.note-editable{
    padding-top: 25px !important;
}
</style>
<?php echo e(Form::model($quotation,array('route' => array('quotation.emails.send', $quotation->id), 'method' => 'post'))); ?>

<div class="modal-body">

   
    <div class="row">
        
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <?php echo e(Form::label('email', __('To'),['class'=>'form-label'])); ?>

                 <?php echo e(Form::textarea('email',$quotation->customer->email,array('class'=>'form-control' , 'rows' => '1', 'required' => 'required', 'placeholder'=>__('Enter Email Id')))); ?>

                  <?php echo e(Form::hidden('id',$quotation->id,)); ?>

            </div>
        </div>
        
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <?php echo e(Form::label('emails', __('CC'),['class'=>'form-label'])); ?> <span class="text-danger" style="font-size:12px;"> (Enter multiple emails with comma (,) seperator)</span>
                 <?php echo e(Form::textarea('emails',null,array('class'=>'form-control' , 'rows' => '1', 'placeholder'=>__('Enter multiple emails')))); ?>

                
            </div>
        </div>
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <?php echo e(Form::label('subject', __('Subject'),['class'=>'form-label'])); ?>

                 <?php echo e(Form::textarea('subject',!empty($quotation->lead)?$quotation->lead->subject:'',array('class'=>'form-control' , 'rows' => '1', 'placeholder'=>__('Enter multiple emails')))); ?>

                  
            </div>
        </div>
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <?php echo e(Form::label('notes', __('Content'),['class'=>'form-label'])); ?>

                 <?php echo e(Form::textarea('notes',$desc,array('class'=>'form-control summernote-simple' , 'rows' => '4', 'placeholder'=>__('Enter multiple emails')))); ?>

                
            </div>
        </div>
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <?php echo e(Form::label('pdf', __('Attached Quotation:'),['class'=>'form-label'])); ?> <?php echo $pdf_link; ?>

                
                
            </div>
        </div>
         
    </div>
   

</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Send')); ?>" class="btn btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/quotation/cc_form.blade.php ENDPATH**/ ?>
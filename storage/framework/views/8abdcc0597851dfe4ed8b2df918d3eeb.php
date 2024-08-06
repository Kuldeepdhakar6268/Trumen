<style>
input[type="text"]::-webkit-input-placeholder {
     color: #6c6d6e !important;
       font-weight: 500;
}
</style>
<?php echo e(Form::model($jobcard,array('route' => array('jobcard.field.update', $jobcard->id), 'method' => 'post'))); ?>

<div class="modal-body">

   
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('old_ref_no.',__('Old Ref. No.'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::textarea('old_ref_no',$jobcard->old_ref_no,array('class'=>'form-control','required'=>'required' , 'rows' => '1', 'placeholder'=>__('Enter Old Referance')))); ?>

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('application_extra',__('Application'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::textarea('application_extra',$jobcard->application_extra,array('class'=>'form-control','required'=>'required' , 'rows' => '1', 'placeholder'=>__('Enter Application')))); ?>

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('pressure',__('Pressure'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::textarea('pressure',$jobcard->pressure,array('class'=>'form-control','required'=>'required' , 'rows' => '1','placeholder'=>__('Enter Pressure')))); ?>

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('temperature',__('Temperature'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::textarea('temperature',$jobcard->temperature,array('class'=>'form-control','required'=>'required' , 'rows' => '1','placeholder'=>__('Enter Temperature')))); ?>

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('admin_note',__('Admin Note'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::textarea('admin_note',$jobcard->admin_note,array('class'=>'form-control','required'=>'required' , 'rows' => '1','placeholder'=>__('Enter Admin Note')))); ?>

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('electronic_note',__('Electronic Note'),['class'=>'form-label'])); ?>

                <?php echo e(Form::textarea('electronic_note',$jobcard->electronic_note,array('class'=>'form-control','required'=>'required' , 'rows' => '1','placeholder' => __('Enter Electronic Note')))); ?>

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('mechanical_note',__('Mechanical Note'),['class'=>'form-label'])); ?>

                <?php echo e(Form::textarea('mechanical_note',$jobcard->mechanical_note,array('class'=>'form-control','required'=>'required' , 'rows' => '1','placeholder' => __('Enter Mechanical Note')))); ?>

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('qc_note',__('QC Note'),['class'=>'form-label'])); ?>

                <?php echo e(Form::textarea('qc_note',$jobcard->qc_note,array('class'=>'form-control','required'=>'required' , 'rows' => '1', 'placeholder' => __('Enter QC Note')))); ?>

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('tag_note',__('Tag Note'),['class'=>'form-label'])); ?>

                <?php echo e(Form::textarea('tag_note',$jobcard->tag_note,array('class'=>'form-control','required'=>'required' , 'rows' => '1','placeholder' => __('Tag Note')))); ?>

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('cust_note',__('Cust. Code'),['class'=>'form-label'])); ?>

                <?php echo e(Form::textarea('cust_note',$jobcard->cust_note,array('class'=>'form-control' , 'rows' => '1', 'placeholder'=>__('Cust. Note')))); ?>

            </div>
        </div>
         <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('quantity',__('Quantity'),['class'=>'form-label'])); ?>

                <?php echo e(Form::number('quantity',$jobcard->quantity,array('class'=>'form-control','required'=>'required' , 'placeholder' => __('Enter Quantity')))); ?>


            </div>
        </div>
         <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('reqbydate',__('ReqbyDate '),['class'=>'form-label'])); ?>

                <?php echo e(Form::date('reqbydate',null,array('class'=>'form-control','required'=>'required' ,'placeholder' => __('Select Date')))); ?>


            </div>
        </div>
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <?php echo e(Form::label('remark', __('Remark'),['class'=>'form-label'])); ?>

                 <?php echo e(Form::textarea('remark',$jobcard->remark,array('class'=>'form-control' , 'rows' => '1', 'placeholder'=>__('Enter Your Remark..')))); ?>

            </div>
        </div>
         
    </div>
   

</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/quotation/jobcard_field.blade.php ENDPATH**/ ?>
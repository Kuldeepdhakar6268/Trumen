<?php echo e(Form::open(array('route' => array('deals.import'),'method'=>'post', 'enctype' => "multipart/form-data"))); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-md-12 mb-6">
            <?php echo e(Form::label('file',__('Download sample Deal CSV file'),['class'=>'form-label'])); ?>

            <a href="<?php echo e(asset(Storage::url('uploads/sample')).'/sample-deal.csv'); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-download"></i> <?php echo e(__('Download')); ?>

            </a>
        </div>
        <div class="col-md-12">
            <?php echo e(Form::label('file',__('Select CSV File'),['class'=>'form-label'])); ?>

            <div class="choose-file form-group">
                <label for="file" class="form-label">
                    <input type="file" class="form-control" name="file" id="file" data-filename="upload_file" required>
                </label>
                <p class="upload_file"></p>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Upload')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/deals/import.blade.php ENDPATH**/ ?>
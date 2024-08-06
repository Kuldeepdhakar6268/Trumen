<?php echo e(Form::open(array('url' => 'quotation.send','enctype' => "multipart/form-data"))); ?>

<div class="modal-body">
    
    <?php
        $plan= \App\Models\Utility::getChatGPTSettings();
        
    ?>
  
    
    <?php if($approvalCheck == 'check'): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group text-center">
                <h5>You want send for approval?</h5>
               <div style="padding-top: 20px;">
                <a href="#" class="btn  btn-dark" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></a>
                <div class="btn  btn-primary" id="show-users" style="padding: 9px 31px 9px 31px;"><?php echo e(__('Yes')); ?></div>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group" style="display:none;" id="userList">
               
                <?php echo e(Form::select('user_id', $users,null, array('class' => 'form-control select','required'=>'required', 'id' => 'userAssigned'))); ?>

            </div>
        </div>
    </div>
     
     
</div>
     
 <?php elseif($approvalCheck == 'jobcard'): ?>
      <div class="row">
        <div class="col-md-12">
            <div class="form-group text-center">
                <h5>You want send for approval?</h5>
               <div style="padding-top: 20px;">
                <a href="#" class="btn  btn-dark" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></a>
                <div class="btn  btn-primary" id="show-users" style="padding: 9px 31px 9px 31px;"><?php echo e(__('Yes')); ?></div>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group" style="display:none;" id="userList">
               
                <?php echo e(Form::select('user_id', $users,null, array('class' => 'form-control select','required'=>'required', 'id' => 'userAssignedforJobcard'))); ?>

            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group text-center">
                <h5>Please Approved the Quotation befor order conversion</h5>
               
            </div>
        </div>
    </div>
    <div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
   
</div>
<?php endif; ?>

<?php echo e(Form::close()); ?>



 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
   

    //hide & show quantity
  $(document).on('click', '#show-users', function() {
   
//   e.preventDefault();
   $("#userList").css('display', 'block');
  
});
   $(document).on('change', '#userAssigned', function() {
   
   var id  = $(this).val();
  
   $.ajax({
            url: '<?php echo e(route('quotation.status', ['id' => $id, 'status' => 'userAssigned'])); ?>',
            type: 'Get',
            data: {
                
                "sid": id,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                // $("#commonModal").hide();
                // $("#commonModal .close").click()
                $('#commonModal').modal('toggle'); 
                show_toastr('success', "<?php echo e(__('Quotation has been Assigned to ')); ?>"+data.assigny +'!', 'success');
                return true;  
            }
            });
  
});
$(document).on('change', '#userAssignedforJobcard', function() {
   
   var id  = $(this).val();
  
   $.ajax({
            url: '<?php echo e(route('quotation.status', ['id' => $id, 'status' => 'JobcardAssigned'])); ?>',
            type: 'Get',
            data: {
                
                "sid": id,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                // $("#commonModal").hide();
                // $("#commonModal .close").click()
                $('#commonModal').modal('toggle'); 
                show_toastr('success', "<?php echo e(__('Quotation has been Assigned to ')); ?>"+data.assigny +'!', 'success');
                return true;  
            }
            });
  
});
</script>

<?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/quotation/save_send.blade.php ENDPATH**/ ?>
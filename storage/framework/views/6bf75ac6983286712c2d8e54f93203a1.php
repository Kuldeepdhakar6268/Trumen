<?php $__env->startSection('page-title'); ?>
    <?php echo e($lead->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dropzone.min.css')); ?>">
    <style>
    .tab-active{
        background-color:#dfe5ea;
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
        .choose-files div {
            background: #ffffff !important;
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
  readURL(this, 1);
});
        // $('input[type="file"]').change(function(e) {
        //     var file = e.target.files[0].name;
        //     var file_name = $(this).attr('data-filename');
        //     $('.' + file_name).append(file);
        // });
    </script>
    <script>
     $(document).ready(function(){
     
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
       
      $(document).on('click', '.selectcustomer', function () {
         
          $id = $(this).val();
          $("#customer_id").val($id);
          
      });
      $(document).on('click', '#add-notes', function () {
            var notes = $("#disc-note").val();
            var id = $('#lead_id').val();
            var stage_id = $('#choices-multiple1').val();
            if(stage_id == ''){
              return show_toastr('error', 'Please select status', 'error');  
            }
            var url = '<?php echo e(route('leads.discussion.store', $lead->id)); ?>'
           $.ajax({
                type: 'POST',
                url: url,
                data: {
                   
                    'id': id,
                    'comment':notes,
                    'stage_id': stage_id,
                    'check': '',
                    'session_key': session_key,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                   
                    // console.log(data.msg)
                    //  console.log(data.data)
                       if (data.error) {
                            show_toastr('error', response.msg, 'error'); 
                        $('#note-lists').html('<p>' + data.error + '</p>');
                    } else {
                         show_toastr('success', data.msg, 'success');
                         $("#disc-note").val('');
                        var postHtml = '';
                        var combinedData = [];

                            // Add type indicator and combine arrays
                           
                        $.each(data.data, function(index, values) {
                             var stage = values.stage;
                              console.log(stage.name)
                             $.each(values.discussions, function(index, value) {
                        console.log(value)
                        var formattedDate = moment(value.created_at).format('MM/DD/YYYY ddd hh:mm a');
                            postHtml += '<li class="list-group-item px-0"><div class="d-block d-sm-flex align-items-start"><img src="https://trumen.truelymatch.com/storage/uploads/avatar/avatar.png" class="img-fluid wid-40 me-3 mb-2 mb-sm-0" alt="image"><div class="w-100"><div class="d-flex align-items-center justify-content-between"><div class="mb-3 mb-sm-0"><h6 class="mb-0"><?php echo e(Auth::user()->name); ?></h6><span class="text-muted text-sm">'+value.comment+'</span></div><div class="form-check form-switch form-switch-right mb-2">'+formattedDate+' </div></div></div></div></li>';
                             });
                        });
                        console.log(postHtml)
                        $('#note-lists').html(postHtml);
                    }
                },
                error: function(xhr, status, error) {
                    $('#note-lists').html('<p>An error occurred: ' + error + '</p>');
                }
                   
                   
            });
        });
        // Add click event listener to tabs
        // $('.tab').click(function(){
            
        //     // Hide all content divs
        //     $('.content').hide();
        //     $('.tab').removeClass('active');
        //     // Get the target id from data attribute
        //     $(this).addClass('active');
        //     var targetId = $(this).data('target');
            
        //     // Show the corresponding content div
        //     $('#' + targetId).show();
        // });
    });
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#lead-sidenav',
            offset: 300
        })
        Dropzone.autoDiscover = false;
        Dropzone.autoDiscover = false;
        myDropzone = new Dropzone("#dropzonewidget", {
            maxFiles: 20,
            // maxFilesize: 2000,
            parallelUploads: 1,
            filename: false,
            // acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.txt",
            url: "<?php echo e(route('leads.file.upload',$lead->id)); ?>",
            success: function (file, response) {
                if (response.is_success) {
                    if(response.status==1){
                        show_toastr('success', response.success_msg, 'success');
                    }
                    dropzoneBtn(file, response);
                } else {
                    myDropzone.removeFile(file);
                    show_toastr('error', response.error, 'error');
                }
            },
            error: function (file, response) {
                myDropzone.removeFile(file);
                if (response.error) {
                    show_toastr('error', response.error, 'error');
                } else {
                    show_toastr('error', response, 'error');
                }
            }
        });
        myDropzone.on("sending", function (file, xhr, formData) {
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("lead_id", <?php echo e($lead->id); ?>);
        });

        function dropzoneBtn(file, response) {
            var download = document.createElement('a');
            download.setAttribute('href', response.download);
            download.setAttribute('class', "badge bg-info mx-1");
            download.setAttribute('data-toggle', "tooltip");
            download.setAttribute('data-original-title', "<?php echo e(__('Download')); ?>");
            download.innerHTML = "<i class='ti ti-download'></i>";

            var del = document.createElement('a');
            del.setAttribute('href', response.delete);
            del.setAttribute('class', "badge bg-danger mx-1");
            del.setAttribute('data-toggle', "tooltip");
            del.setAttribute('data-original-title', "<?php echo e(__('Delete')); ?>");
            del.innerHTML = "<i class='ti ti-trash'></i>";

            del.addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();
                if (confirm("Are you sure ?")) {
                    var btn = $(this);
                    $.ajax({
                        url: btn.attr('href'),
                        data: {_token: $('meta[name="csrf-token"]').attr('content')},
                        type: 'DELETE',
                        success: function (response) {
                            if (response.is_success) {
                                btn.closest('.dz-image-preview').remove();
                            } else {
                                show_toastr('error', response.error, 'error');
                            }
                        },
                        error: function (response) {
                            response = response.responseJSON;
                            if (response.is_success) {
                                show_toastr('error', response.error, 'error');
                            } else {
                                show_toastr('error', response, 'error');
                            }
                        }
                    })
                }
            });

            var html = document.createElement('div');
            html.appendChild(download);
            <?php if(Auth::user()->type != 'client'): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit lead')): ?>
            html.appendChild(del);
            <?php endif; ?>
            <?php endif; ?>

            file.previewTemplate.appendChild(html);
        }

        <?php $__currentLoopData = $lead->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(file_exists(storage_path('lead_files/'.$file->file_path))): ?>
        // Create the mock file:
        var mockFile = {name: "<?php echo e($file->file_name); ?>", size: <?php echo e(\File::size(storage_path('lead_files/'.$file->file_path))); ?>};
        // Call the default addedfile event handler
        myDropzone.emit("addedfile", mockFile);
        // And optionally show the thumbnail of the file:
        myDropzone.emit("thumbnail", mockFile, "<?php echo e(asset(Storage::url('lead_files/'.$file->file_path))); ?>");
        myDropzone.emit("complete", mockFile);

        dropzoneBtn(mockFile, {download: "<?php echo e(route('leads.file.download',[$lead->id,$file->id])); ?>", delete: "<?php echo e(route('leads.file.delete',[$lead->id,$file->id])); ?>"});
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit lead')): ?>
        $('.summernote-simple').on('summernote.blur', function () {

            $.ajax({
                url: "<?php echo e(route('leads.note.store',$lead->id)); ?>",
                data: {_token: $('meta[name="csrf-token"]').attr('content'), notes: $(this).val()},
                type: 'POST',
                success: function (response) {
                    if (response.is_success) {
                        // show_toastr('Success', response.success,'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function (response) {
                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response, 'error');
                    }
                }
            })
        });
        <?php else: ?>
        $('.summernote-simple').summernote('disable');
        <?php endif; ?>
    
    </script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('quotation.index')); ?>"><?php echo e(__('Quotation')); ?></a></li>
    <li class="breadcrumb-item"> <?php echo e($lead->name); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('convert lead to deal')): ?>
            <?php if(!empty($deal)): ?>
                <a href="<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Deal')): ?> <?php if($deal->is_active): ?> <?php echo e(route('deals.show',$deal->id)); ?> <?php else: ?> # <?php endif; ?> <?php else: ?> # <?php endif; ?>" data-size="lg" data-bs-toggle="tooltip" class="btn btn-sm btn-primary">
                   <?php echo e(__('Already Converted To Customer')); ?>

                </a>
            <?php else: ?>
           <?php
           $client_email = $lead->email != null?$lead->email:'demo@gmail.com';
          
           ?>
                                                    <?php echo e(Form::model($lead, array('route' => array('quotation.convert.to.deal', $lead->id), 'method' => 'POST','enctype' => 'multipart/form-data'))); ?>

                                                   
                                                    <?php echo e(Form::hidden('client_email', $client_email, array('class' => 'form-control','required'=>'required'))); ?>

                                                    <?php echo e(Form::hidden('name', $lead->subject, array('class' => 'form-control','required'=>'required'))); ?>

                                                    
                                                    
                                                     <input type="hidden" name="customer_id" id="customer_id">
                                                    <a href="#" class="btn btn-primary  align-items-center bs-pass-para" data-bs-toggle="tooltip"
                                                       data-original-title="<?php echo e(__('Convert')); ?>" data-confirm="<?php echo e(__('Are You Sure You Want to Convert To Customer?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($lead->id); ?>').submit();">
                                                        <?php echo e(__('Save')); ?>

                                                   
                                               
               
            <?php endif; ?>
        <?php endif; ?>

       <a href="#" data-url="<?php echo e(URL::to('leads/'.$lead->id.'/labels')); ?>" data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Label')); ?>" class="btn btn-sm btn-primary" style="display: none;">
            <i class="ti ti-bookmark"></i>
        </a>
       
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
           
            <div class="row">
            <div class="content" id="content1" style="display:block">
                    <div class="">
                       
                       
                     
                          <?php if(count($customers)>0): ?>
                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               
                        <div class="card" style="<?php echo e($key == 0?'border: 2px solid #ff5000;':''); ?>">
                        <div class="card-body">
                            
                             <div class="row" style="line-height: 2;">
                                 
                                 <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                         <div class="ms-2">
                                           <h5><?php echo e(__('Contact Person Info')); ?> (<?php echo e($key); ?>)</h5>
                                        </div>
                                   
                                </div>
                               </div>
                               <div class="col-md-6 col-sm-6">
                                    <div class="d-flex" style="float: inline-end;">
                                         <div class="ms-2">
                                          <input type="checkbox" value="<?php echo e($v->id); ?>" class="selectcustomer">
                                        </div>
                                   
                                </div>
                               </div>
                               
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                         <div class="ms-2">
                                              <?php echo e(Form::hidden('client_name',!empty($v->name)?$v->name:'', array('class' => 'form-control','required'=>'required'))); ?>

                                            <?php echo e(__('Name')); ?>: <span class="mb-0"><?php echo e(!empty($v->name)?$v->name:''); ?></span>
                                        </div>
                                   
                                </div>
                               </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        
                                        <div class="ms-2">
                                                 <?php echo e(__('Email')); ?>: <span class="mb-0"><?php echo e(!empty($v->email)?$v->email:''); ?></span>
                                        </div>
                                   
                                </div>
                               </div>
                                 <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                          
                                           <?php echo e(__('Number')); ?>: <span class="mb-0 "><?php echo e(!empty($v->billing_state)?$v->billing_state:''); ?></span>
                                        </div>
                                    </div>
                               </div>
                                  <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           <?php echo e(__('Department')); ?>: <span class="mb-0 "><?php echo e(!empty($v->billing_city)?$v->billing_city:''); ?></span>
                                        </div>
                                    </div>
                               </div>
                                 <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                           <?php echo e(__('Designation')); ?>: <span class="mb-0"><?php echo e(!empty($v->billing_country)?$v->billing_country:''); ?></span>
                                        </div>
                                    </div>
                                    </div>
                                     <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           <?php echo e(__('Gender')); ?>: <span class="mb-0"><?php echo e(!empty($v->gender)?$v->gender:''); ?></span>
                                        </div>
                                    </div>
                                    </div>
                                     <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                           <?php echo e(__('Alternate')); ?>: <span class="mb-0"><?php echo e(!empty($v->billing_phone)?$v->billing_phone:''); ?></span>
                                        </div>
                                    </div>
                                    </div>
                                    
                             
                           
                            </div>
                            
                        </div>
                        </div>
                         <?php if(!$loop->last): ?>
                                   <br>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               <?php endif; ?>
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
                     
                    </div>
             <div class="row">
            <div class="content" id="content1" style="display:block"> 
                    <div class="">
                        <div class="card" style="<?php echo e($key == 0?'border: 2px solid #ff5000;':''); ?>">
                        <div class="card-body">
                            
                             <div class="row" style="line-height: 2;">
                                 
                                 <div class="col-md-12 col-sm-12">
                                    <div class="d-flex align-items-start">
                                         <div class="ms-2">
                                           <h5><?php echo e(__('Customer PO Details')); ?></h5>
                                        </div>
                                   
                                </div>
                               </div>
                             
                                <div class="col-md-3 col-sm-3">
                                   
                                            <div class="form-group">
                                                <?php echo e(Form::label('po_date',__('PO Date'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::date('po_date',null,array('class'=>'form-control datepicker','placeholder'=>_('Enter Name')))); ?>

                                            </div>
                                        
                               </div>
                                <div class="col-md-3 col-sm-3">
                                  
                                         <div class="form-group">
                                                <?php echo e(Form::label('po_number',__('PO Number'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::text('po_number',null,array('class'=>'form-control','required'=>'required' ,'placeholder'=>_('Enter PO Number')))); ?>

                                            </div>
                                       
                               </div>
                                 <div class="col-md-6 col-sm-6">
                                  
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
                            </div>
                            
                        </div>
                        </div>
                        
                        </div>
                    </div>
                    </div>
                   
                  
                   
                
                   
   
                </div>
            </div>
        </div>
    </div>
   
<?php $__env->stopSection(); ?>
  <?php echo Form::close(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/leads/converttocustomer.blade.php ENDPATH**/ ?>
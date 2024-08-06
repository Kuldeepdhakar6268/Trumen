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
    input[type="text"]::-webkit-input-placeholder {
     color: var(--color-customColor);
    font-weight: bold;
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
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/dropzone-amd-module.min.js')); ?>"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
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
    <li class="breadcrumb-item"><a href="<?php echo e(route('leads.list')); ?>"><?php echo e(__('Lead')); ?></a></li>
    <li class="breadcrumb-item"> <?php echo e($lead->name); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="lead-sidenav" style="flex-direction: unset;height: 43px;">
                            <?php if(Auth::user()->type != 'client'): ?>
                                
                                
                                <div data-target="content1" class="tab btn btn-primary" style="cursor: pointer;padding: 10px 70px 11px 65px;margin-right: 5px;color:white;"><?php echo e(__('Profile')); ?>

                                    <div class="float-end"></div>
                                </div>
                                
                            <?php endif; ?>

                            <?php if(Auth::user()->type != 'client'): ?>
                                
                               
                                <a href="<?php echo e(route('quotations.create', ['lead_id' => $lead->id, 0])); ?>" data-title="<?php echo e(__('Quotataion Create')); ?>" class="btn btn-light tab-active" style="padding: 10px 32px 7px 35px;margin-right: 5px;color:black;width: 200px;"> <?php echo e(__('Add Quotation')); ?>

                                    <div class="float-end"></div>
                                </a>
                            <?php endif; ?>

                           
                            <?php if(Auth::user()->type != 'client'): ?>
                           
                                
                                <div data-target="content2" class="btn btn-light tab tab-active" style="border-radius: 5px;cursor: pointer;padding: 10px 90px 11px 70px;margin-right: 5px;color:black;"> <?php echo e(__(' Notes')); ?>

                                    <div class="float-end"></i></div>
                                </div>
                            <?php endif; ?>
                            <?php if(Auth::user()->type != 'client'): ?>
                              
                                <div  data-target="content3" class="btn btn-light tab tab-active" style="border-radius: 5px !important;color:black;padding: 10px 70px 11px 65px;margin-right: 5px;cursor: pointer;border-bottom-left-radius: unset !important;border-top-left-radius: inherit;border-top-right-radius: inherit;;border-bottom-right-radius: unset !important;
"> <?php echo e(__('Activity')); ?>

                                    <div class="float-end"></i></div>
                                </div>
                                 <a href="#" data-target="content4" class="btn btn-light tab tab-active" data-title="<?php echo e(__('Quotataion Create')); ?>" class="btn btn-light tab-active" style="padding: 10px 65px 11px 55px;margin-right: 5px;color:black;"> <?php echo e(__('Quotations')); ?>

                                    <div class="float-end"></div>
                                </a>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
              
            </div>
            <div class="row">
            <div class="content" id="content1" style="display:block">  
              

              
                    <div class="">
                       
                       
                       
                          
                             <div class="row" style="line-height: 2;margin-top: 30px;">
                               
                                <div class="col-md-8 col-sm-8">
                                <div class="card"> 
                                 <div class="card-body">
                                     <h5><?php echo e(__('Contact Person Info')); ?></h5>
                                <div class="row" >
                                <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                         <div class="ms-2">
                                            <?php echo e(__('Name')); ?>: <span class="mb-0"><?php echo e(!empty($lead->customer->billing_name)?$lead->customer->billing_name:''); ?></span>
                                        </div>
                                   
                                </div>
                               </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        
                                        <div class="ms-2">
                                                 <?php echo e(__('Email')); ?>: <span class="mb-0"><?php echo e(!empty($lead->customer->email)?$lead->customer->email:''); ?></span>
                                        </div>
                                   
                                </div>
                               </div>
                                 <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                          
                                           <?php echo e(__('Number')); ?>: <span class="mb-0 "><?php echo e(!empty($lead->customer->contact)?$lead->customer->contact:''); ?></span>
                                        </div>
                                    </div>
                               </div>
                                  <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           <?php echo e(__('Department')); ?>: <span class="mb-0 "><?php echo e(!empty($lead->customer->billing_department)?$lead->customer->billing_department:''); ?></span>
                                        </div>
                                    </div>
                               </div>
                                 <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                           <?php echo e(__('Designation')); ?>: <span class="mb-0"><?php echo e(!empty($lead->customer->shipping_designation)?$lead->customer->shipping_designation:''); ?></span>
                                        </div>
                                    </div>
                                    </div>
                                     <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           <?php echo e(__('Gender')); ?>: <span class="mb-0"><?php echo e(!empty($lead->customer->gender)?$lead->customer->gender:''); ?></span>
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
                                          
                                            <?php echo e(__('Status')); ?>: <span class="mb-0"><?php echo e($lead->stage->name); ?></span><br>
                                           <?php if(!empty($lead->products())): ?>
                                                 <?php $__currentLoopData = $lead->sources(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                 <?php echo e(__('Source')); ?>: <span class="mb-0"><?php echo e(!empty($source->name)?$source->name:''); ?></span><br>
                                                  
                                                   <?php if(!$loop->last): ?>
                                                        ,
                                                    <?php endif; ?>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   <?php else: ?>
                                                   -
                                                   <?php endif; ?>
                                           
                                             <?php echo e(__('Request Type')); ?>: <span class="mb-0"><?php echo e(!empty($lead->request_id)?$lead->request_id:$lead->request_type); ?></span>
                                           
                                            
                                        </div>
                                    </div>
                                </div>
                           
                            </div>
                        </div>
                        </div>
                        </div>
                        
                        <?php
                                $customers = \App\Models\Customer::where('lead_id', $lead->id)->get();
                               
                                ?>
                                <?php if(count($customers)>0): ?>
                                <?php $__currentLoopData = $customers->slice(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               
                        <div class="card">
                        <div class="card-body">
                               
                             <div class="row" style="line-height: 2;">
                                   <h5><?php echo e(__('Contact Person Info')); ?> (<?php echo e($key); ?>)</h5>
                               
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                         <div class="ms-2">
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
                        <div class="card">
                        <div class="card-body">
                            <h5><?php echo e(__('Organization')); ?></h5>
                             <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                           
                                            <?php echo e(__('Sector')); ?>: <span class="mb-0"><?php echo e(!empty($customers)?$customers[0]->sector:''); ?></span>
                                           
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                            <?php echo e(__('Industry')); ?>: <span class="mb-0"><?php echo e(!empty($lead->industry_name)?$lead->industry_name:''); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                           
                                              <?php if(!empty($lead->products())): ?>
                                                 <?php $__currentLoopData = $lead->products(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
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
                                <div class="col-md-4 col-sm-4 mt-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            <?php echo e(__('Quantity')); ?>: <span class="mb-0"><?php echo e($lead->quantity); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 mt-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            <?php echo e(__('GST Number')); ?>: <span class="mb-0"><?php echo e($lead->customer != null?$lead->customer->tax_number:'-'); ?></span>
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
                                            <?php echo e(__('Address')); ?>: <span class="mb-0"><?php echo e(!empty($lead->customer->billing_address)?$lead->customer->billing_address:''); ?></span>
                                        </div>
                                    </div>
                                
                                
                                <div class="row" >
                                
                               <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           <?php echo e(__('Country')); ?>: <span class="mb-0"><?php echo e(!empty($lead->customer->billing_country)?$lead->customer->billing_country:''); ?></span>
                                        </div>
                                    </div>
                                    </div>
                                 <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                          
                                           <?php echo e(__('State')); ?>: <span class="mb-0 "><?php echo e(!empty($lead->customer->billing_state)?$lead->customer->billing_state:''); ?></span>
                                        </div>
                                    </div>
                               </div>
                                  <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           <?php echo e(__('City')); ?>: <span class="mb-0 "><?php echo e(!empty($lead->customer->billing_city)?$lead->customer->billing_city:''); ?></span>
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
                                           
                                            <?php echo e(__('Lead Assigned by')); ?>: <span class="mb-0"><?php echo e(!empty($lead->owner->name)?$lead->owner->name:''); ?></span><br>
                                           
                                            <?php echo e(__('Lead Owner ')); ?>: <span class="mb-0"><?php echo e(!empty($lead->owner->name)?$lead->owner->name:''); ?></span><br>
                                            <?php echo e(__('Lead Assigned to')); ?>:
                                             <?php $__currentLoopData = $lead->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                             <?php if($loop->first): ?>
                                                <?php continue; ?>
                                               
                                            <?php endif; ?>
                                              <span class="mb-0"><?php echo e(!empty($user->name)?$user->name:''); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                        </div>
                                    </div>
                                </div>
                           
                            </div>
                        </div>
                        </div>
                        <div class="card">
                        <div class="card-body">
                            <h5><?php echo e(__('Key Notes')); ?></h5>
                            <div class="col-md-12 dropzone top-5-scroll browse-file" id="getnotedetails" style="text-align: justify;">
                                <?php echo $lead->notes; ?>

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
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/leads/show.blade.php ENDPATH**/ ?>
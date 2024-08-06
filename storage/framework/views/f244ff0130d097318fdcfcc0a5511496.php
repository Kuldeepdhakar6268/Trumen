<?php
    $attachments=\App\Models\Utility::get_file('contract_attechment');
?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dropzone.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Contract Detail')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on("click", ".status", function() {
            var status = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                type: 'POST',
                data: {

                    "status": status ,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    show_toastr('<?php echo e(__("success")); ?>', 'Status Update Successfully!', 'success');
                    location.reload();
                }

            });
        });
    </script>

    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/dropzone-amd-module.min.js')); ?>"></script>
    <script>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage contract')): ?>
        $('.summernote-simple').on('summernote.blur', function () {

            $.ajax({
                url: "<?php echo e(route('contract.contract_description.store',$contract->id)); ?>",
                data: {_token: $('meta[name="csrf-token"]').attr('content'), contract_description: $(this).val()},
                type: 'POST',
                success: function (response) {
                    console.log(response)
                    if (response.is_success) {
                        show_toastr('success', response.success,'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function (response) {

                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                }
            })
        });
        <?php else: ?>
        // $('.summernote-simple').summernote('disable');
        <?php endif; ?>
    </script>
    <script>
        Dropzone.autoDiscover = true;
        myDropzone = new Dropzone("#dropzonewidget", {
            maxFiles: 20,
            parallelUploads: 1,

            url: "<?php echo e(route('contract.file.upload',[$contract->id])); ?>",
            success: function (file, response) {
                // location.reload()

                if (response.is_success) {
                    if(response.status==1){
                        show_toastr('success', response.success_msg, 'success');
                    }else{
                        show_toastr('<?php echo e(__("success")); ?>', 'Attachment Create Successfully!', 'success');
                        dropzoneBtn(file, response);
                    }

                } else {

                    myDropzone.removeFile(file);
                    show_toastr('<?php echo e(__("Error")); ?>', 'The attachment must be same as stoarge setting', 'Error');
                }
            },
            error: function (file, response) {
                myDropzone.removeFile(file);
                if (response.error) {
                    show_toastr('<?php echo e(__("Error")); ?>', 'The attachment must be same as stoarge setting', 'error');
                } else {
                    show_toastr('<?php echo e(__("Error")); ?>', 'The attachment must be same as stoarge setting', 'error');
                }
            }
        });
        myDropzone.on("sending", function (file, xhr, formData) {
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("contract_id", <?php echo e($contract->id); ?>);
        });

        function dropzoneBtn(file, response) {
            var download = document.createElement('a');
            download.setAttribute('href', response.download);
            download.setAttribute('class', "action-btn btn-primary mx-1 mt-1 btn btn-sm d-inline-flex align-items-center");
            download.setAttribute('data-toggle', "tooltip");
            download.setAttribute('data-original-title', "<?php echo e(__('Download')); ?>");
            download.innerHTML = "<i class='fas fa-download'></i>";

            var del = document.createElement('a');
            del.setAttribute('href', response.delete);
            del.setAttribute('class', "action-btn btn-danger mx-1 mt-1 btn btn-sm d-inline-flex align-items-center");
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
                            location.reload();
                            if (response.is_success) {
                                btn.closest('.dz-image-preview').remove();
                            } else {
                                show_toastr('<?php echo e(__("Error")); ?>', response.error, 'error');
                            }
                        },
                        error: function (response) {
                            response = response.responseJSON;
                            if (response.is_success) {
                                show_toastr('<?php echo e(__("Error")); ?>', response.error, 'error');
                            } else {
                                show_toastr('<?php echo e(__("Error")); ?>', response.error, 'error');
                            }
                        }
                    })
                }
            });

            var html = document.createElement('div');
            html.setAttribute('class', "text-center mt-10");
            file.previewTemplate.appendChild(html);
        }
        $(document).on('click', '#comment_submit', function (e) {
            var curr = $(this);

            var comment = $.trim($("#form-comment textarea[name='comment']").val());
            if (comment != '') {
                $.ajax({
                    url: $("#form-comment").data('action'),
                    data: {comment: comment, "_token": "<?php echo e(csrf_token()); ?>"},
                    type: 'POST',
                    success: function (data) {
                        show_toastr('<?php echo e(__("success")); ?>', 'Comment Create Successfully!', 'success');
                        setTimeout(function () {
                            location.reload();
                        }, 500)
                        data = JSON.parse(data);
                        console.log(data);
                        var html = "<div class='list-group-item px-0'>" +
                            "                    <div class='row align-items-center'>" +
                            "                        <div class='col-auto'>" +
                            "                            <a href='#' class='avatar avatar-sm rounded-circle ms-2'>" +
                            "                                <img src="+data.default_img+" alt='' class='avatar-sm rounded-circle'>" +
                            "                            </a>" +
                            "                        </div>" +
                            "                        <div class='col ml-n2'>" +
                            "                            <p class='d-block h6 text-sm font-weight-light mb-0 text-break'>" + data.comment + "</p>" +
                            "                            <small class='d-block'>"+data.current_time+"</small>" +
                            "                        </div>" +
                            "                        <div class='action-btn bg-danger me-4'><div class='col-auto'><a href='#' class='mx-3 btn btn-sm  align-items-center delete-comment' data-url='" + data.deleteUrl + "'><i class='ti ti-trash text-white'></i></a></div></div>" +
                            "                    </div>" +
                            "                </div>";

                        $("#comments").prepend(html);
                        $("#form-comment textarea[name='comment']").val('');
                        load_task(curr.closest('.task-id').attr('id'));
                        show_toastr('<?php echo e(__('success')); ?>', '<?php echo e(__("Comment Added Successfully!")); ?>');
                    },
                    error: function (data) {
                        show_toastr('error', '<?php echo e(__("Some Thing Is Wrong!")); ?>');
                    }
                });
            } else {
                show_toastr('error', '<?php echo e(__("Please write comment!")); ?>');
            }
        });

        $(document).on("click", ".delete-comment", function () {
            var btn = $(this);

            $.ajax({
                url: $(this).attr('data-url'),
                type: 'DELETE',
                dataType: 'JSON',
                data: {"_token": "<?php echo e(csrf_token()); ?>"},
                success: function (data) {
                    load_task(btn.closest('.task-id').attr('id'));
                    show_toastr('<?php echo e(__('success')); ?>', '<?php echo e(__("Comment Deleted Successfully!")); ?>');
                    btn.closest('.list-group-item').remove();
                },
                error: function (data) {
                    data = data.responseJSON;
                    if (data.message) {
                        show_toastr('error', data.message);
                    } else {
                        show_toastr('error', '<?php echo e(__("Some Thing Is Wrong!")); ?>');
                    }
                }
            });
        });


    </script>


    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        })
        $(".list-group-item").click(function(){
            $('.list-group-item').filter(function(){
                return this.href == id;
            }).parent().removeClass('text-primary');
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('contract.index')); ?>"><?php echo e(__('contract')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(\Auth::user()->contractNumberFormat($contract->id)); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end d-flex align-items-center">
        <a href="<?php echo e(route('contract.download.pdf',\Crypt::encrypt($contract->id))); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Download')); ?>" target="_blanks">
            <i class="ti ti-download"></i>
        </a>
        <a href="<?php echo e(route('get.contract',$contract->id)); ?>"  target="_blank" class="btn btn-sm btn-primary btn-icon m-1" >
            <i class="ti ti-eye text-white" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('PreView')); ?>"> </i>
        </a>

    <?php if((\Auth::user()->type=='company')): ?>
       <a href="<?php echo e(route('send.mail.contract',$contract->id)); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Send Email')); ?>"  >
           <i class="ti ti-mail text-white"></i>
       </a>
            <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-size="lg" data-url="<?php echo e(route('contract.copy',$contract->id)); ?>"
               data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Duplicate')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-copy text-white"></i>
            </a>

        <?php endif; ?>

        <?php if((\Auth::user()->type=='company')): ?>
            <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-size="lg" data-url="<?php echo e(route('signature',$contract->id)); ?>"
               data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('Add signature')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-pencil text-white"></i>
            </a>
        <?php elseif(\Auth::user()->type == 'client' && ($contract->status == 'accept')): ?>
            <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-size="lg" data-url="<?php echo e(route('signature',$contract->id)); ?>"
               data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('Add signature')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-pencil text-white"></i>
            </a>
            <?php endif; ?>

   <?php
       $status = App\Models\Contract::status();
   ?>
   <?php
       $status = App\Models\Contract::status();
   ?>

   <?php if(\Auth::user()->type == 'client' ): ?>
       <ul class="list-unstyled m-0 ">
           <li class="dropdown dash-h-item status-drp">
               <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                  role="button" aria-haspopup="false" aria-expanded="false">
               <span class="drp-text hide-mob text-primary"><?php echo e(ucfirst($contract->status)); ?>

                   <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
               </span>
               </a>
               <div class="dropdown-menu dash-h-dropdown">
                   <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <a class="dropdown-item status" data-id="<?php echo e($k); ?>" data-url="<?php echo e(route('contract.status', $contract->id)); ?>" href="#"><?php echo e(ucfirst($status)); ?>

                       </a>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </div>
           </li>
       </ul>
   <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-xl-3">
       <div class="card sticky-top" style="top:30px">
           <div class="list-group list-group-flush" id="useradd-sidenav">
               <a href="#useradd-1" class="list-group-item list-group-item-action border-0"><?php echo e(__('General')); ?>

                   <div class="float-end"><i class="ti ti-chevron-right"></i></div>
               </a>
               <a href="#useradd-2" class="list-group-item list-group-item-action border-0"><?php echo e(__('Attachment')); ?>

                   <div class="float-end"><i class="ti ti-chevron-right"></i></div>
               </a>
               <a href="#useradd-3" class="list-group-item list-group-item-action border-0"><?php echo e(__('Comment')); ?>

                   <div class="float-end"><i class="ti ti-chevron-right"></i></div>
               </a>
               <a href="#useradd-4" class="list-group-item list-group-item-action border-0"><?php echo e(__('Notes')); ?>

                   <div class="float-end"><i class="ti ti-chevron-right"></i></div>
               </a>
           </div>
       </div>
   </div>
   <div class="col-xl-9">
       <div id="useradd-1">
           <div class="row">
               <div class="col-xl-7">
                   <div class="row">
                       <div class="col-lg-4 col-6">
                           <div class="card">
                               <div class="card-body" style="min-height: 205px;">
                                   <div class="theme-avtar bg-primary">
                                       <i class="ti ti-user-plus"></i>
                                   </div>
                                   <h6 class="mb-3 mt-4"><?php echo e(__('Attachment')); ?></h6>
                                   <h3 class="mb-0"><?php echo e(count($contract->files)); ?></h3>
                                   <h3 class="mb-0"></h3>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-4 col-6">
                           <div class="card">
                               <div class="card-body" style="min-height: 205px;">
                                   <div class="theme-avtar bg-info">
                                       <i class="ti ti-click"></i>
                                   </div>
                                   <h6 class="mb-3 mt-4"><?php echo e(__('Comment')); ?></h6>
                                   <h3 class="mb-0"><?php echo e(count($contract->comment)); ?></h3>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-4 col-6">
                           <div class="card">
                               <div class="card-body" style="min-height: 205px;">
                                   <div class="theme-avtar bg-warning">
                                       <i class="ti ti-file"></i>
                                   </div>
                                   <h6 class="mb-3 mt-4 "><?php echo e(__('Notes')); ?></h6>
                                   <h3 class="mb-0"><?php echo e(count($contract->note)); ?></h3>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="col-xxl-5">
                   <div class="card report_card total_amount_card">
                       <div class="card-body pt-0" style="margin-bottom: -30px; margin-top: -10px;">
                           <address class="mb-0 text-sm">
                               <dl class="row mt-4 align-items-center">
                                   <h5><?php echo e(__('Contract Detail')); ?></h5>
                                   <br>
                                   <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Subject')); ?></dt>
                                   <dd class="col-sm-8 text-sm"><?php echo e($contract->subject); ?></dd>
                                   <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Project')); ?></dt>
                                   <dd class="col-sm-8 text-sm"><?php echo e(!empty($contract->projects)?$contract->projects->project_name:'-'); ?></dd>
                                   <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Value')); ?></dt>
                                   <dd class="col-sm-8 text-sm"> <?php echo e(\Auth::user()->priceFormat($contract->value)); ?></dd>
                                   <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Type')); ?></dt>
                                   <dd class="col-sm-8 text-sm"><?php echo e(!empty($contract->types)?$contract->types->name:'-'); ?></dd>
                                   <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Status')); ?></dt>
                                   <dd class="col-sm-8 text-sm"><?php echo e($contract->status); ?></dd>
                                   <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Start Date')); ?></dt>
                                   <dd class="col-sm-8 text-sm"><?php echo e(Auth::user()->dateFormat($contract->start_date)); ?></dd>
                                   <dt class="col-sm-4 h6 text-sm"><?php echo e(__('End Date')); ?></dt>
                                   <dd class="col-sm-8 text-sm"><?php echo e(Auth::user()->dateFormat($contract->end_date)); ?></dd>
                               </dl>
                           </address>
                       </div>
                   </div>
               </div>
           </div>
           <div class="card">
               <div class="card-header">
                   <h5 class="mb-0"><?php echo e(__('Contract Description ')); ?></h5>
               </div>
               <div class="card-body" >
                   <div class="col-md-12">
                       <div class="form-group mt-3" >
                           <textarea class="summernote-simple" ><?php echo $contract->contract_description; ?></textarea>
                       </div>
                   </div>
               </div>
           </div>
       </div>

       <div id="useradd-2">
           <div class="card">
               <div class="card-header">
                   <h5 class="mb-0"><?php echo e(__('Contract Attachments')); ?></h5>
               </div>
               <div class="card-body">
                   <div class="form-group">
                       <?php if(\Auth::user()->type=='company'): ?>
                           <div class="col-md-12 dropzone top-5-scroll browse-file" id="dropzonewidget"></div>

                       <?php elseif(\Auth::user()->type == 'client' && $contract->status=='accept' ): ?>
                           <div class="col-md-12 dropzone top-5-scroll browse-file" id="dropzonewidget"></div>
                       <?php endif; ?>
                   </div>

                   <div class="scrollbar-inner">
                       <div class="card-wrapper p-3 lead-common-box">
                           <?php $__currentLoopData = $contract->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <div class="card mb-3 border shadow-none">
                                   <div class="px-3 py-3">

                                       <div class="row align-items-center">
                                           <div class="col">
                                               <h6 class="text-sm mb-0">
                                                   <a href="#!"><?php echo e($file->files); ?></a>
                                               </h6>
                                               <p class="card-text small text-muted">
                                                   <?php if(!empty($file->files) && file_exists(storage_path('contract_attechment/' . $file->files))): ?>
                                                         <?php echo e(number_format(\File::size(storage_path('contract_attechment/' . $file->files)) / 1048576, 2) . ' ' . __('MB')); ?>

                                                   <?php endif; ?>
                                               </p>
                                           </div>
                                           <div class="action-btn bg-warning ">
                                               <a href="<?php echo e($attachments . '/' . $file->files); ?>"
                                                  class=" btn btn-sm d-inline-flex align-items-center"
                                                  download="" data-bs-toggle="tooltip" title="Download">
                                                   <span class="text-white"> <i class="ti ti-download"></i></span>
                                               </a>
                                           </div>

                                               <?php if((\Auth::user()->type == 'company' && $contract->status == 'accept') || \Auth::user()->id == $file->user_id): ?>

                                               <div class="col-auto actions">
                                                   <div class="action-btn bg-danger">
                                                       <?php echo Form::open(['method' => 'DELETE', 'route' => ['contracts.file.delete', $contract->id, $file->id]]); ?>

                                                       <a href="#!" class="mx-3 btn btn-sm  align-items-center bs-pass-para ">
                                                           <i class="ti ti-trash text-white" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Delete')); ?>" ></i>
                                                       </a>
                                                       <?php echo Form::close(); ?>

                                                   </div>
                                               </div>
                                           <?php endif; ?>
                                       </div>

                                   </div>
                               </div>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </div>
                   </div>

               </div>
           </div>
       </div>

       <div id ="useradd-3">
           <div class="card">
               <div class="card-header">
                   <h5 class="mb-0"><?php echo e(__('Comments')); ?></h5>
               </div>
               <div class="card-body">
                   <?php if(\Auth::user()->type == 'company'): ?>
                       <div class="col-12 d-flex">
                           <div class="form-group mb-0 form-send w-100">
                               <form method="post" class="card-comment-box" id="form-comment" data-action="<?php echo e(route('comment.store', [$contract->id])); ?>">
                                   <textarea rows="1" class="form-control" name="comment" data-toggle="autosize" placeholder="<?php echo e(__('Add a comment...')); ?>"></textarea>
                               </form>
                           </div>
                           <button id="comment_submit" class="btn btn-send mt-2"><i class="f-16 text-primary ti ti-brand-telegram"></i></button>
                       </div>
                       <?php elseif(\Auth::user()->type == 'client' && $contract->status=='accept' ): ?>
                           <div class="col-12 d-flex">
                               <div class="form-group mb-0 form-send w-100">
                                   <form method="post" class="card-comment-box" id="form-comment" data-action="<?php echo e(route('comment.store', [$contract->id])); ?>">
                                       <textarea rows="1" class="form-control" name="comment" data-toggle="autosize" placeholder="<?php echo e(__('Add a comment...')); ?>"></textarea>
                                   </form>
                               </div>
                               <button id="comment_submit" class="btn btn-send mt-2"><i class="f-16 text-primary ti ti-brand-telegram"></i></button>
                           </div>
                       <?php endif; ?>

                   <div class="list-group list-group-flush mb-0" id="comments">
                       <?php $__currentLoopData = $contract->comment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php
                               $user = \App\Models\User::find($comment->user_id);
                               $logo=\App\Models\Utility::get_file('uploads/avatar/');
                           ?>
                           <div class="list-group-item ">
                               <div class="row align-items-center">
                                   <div class="col-auto">
                                       <a href="<?php echo e(!empty($user->avatar) ? $logo . '/' . $user->avatar : $logo . '/avatar.png'); ?>" target="_blank">
                                           <img class="rounded-circle"  width="40" height="40" src="<?php echo e(!empty($user->avatar) ? $logo . '/' . $user->avatar : $logo . '/avatar.png'); ?>">
                                       </a>
                                   </div>
                                   <div class="col-auto">
                                   </div>
                                   <div class="col ml-n2">
                                       <p class="d-block h6 text-sm font-weight-light mb-0 text-break"><?php echo e($comment->comment); ?></p>
                                       <small class="d-block"><?php echo e($comment->created_at->diffForHumans()); ?></small>
                                   </div>

                                   <?php if((\Auth::user()->type == 'company' && $contract->status == 'accept') || \Auth::user()->id == $comment->user_id): ?>
                                       <div class="col-auto actions">
                                           <div class="action-btn bg-danger ms-2">
                                               <?php echo Form::open(['method' => 'DELETE', 'route' => ['comment_store.destroy',  $comment->id]]); ?>

                                               <a href="#!" class="mx-3 btn btn-sm  align-items-center bs-pass-para">
                                                   <i class="ti ti-trash text-white" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Delete')); ?>"></i>
                                               </a>
                                               <?php echo Form::close(); ?>

                                           </div>
                                       </div>
                                   <?php endif; ?>
                               </div>
                           </div>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </div>
               </div>
           </div>
       </div>

       <div id ="useradd-4">
           <div class="card">
               <div class="card-header d-flex justify-content-between">
                   <h5><?php echo e(__('Notes')); ?></h5>
                   <?php
                    $user = \App\Models\User::find(\Auth::user()->creatorId());
                    $plan= \App\Models\Plan::getPlan($user->plan);
                   ?>
                   <?php if($plan->chatgpt == 1): ?>
                       <div class="d-flex justify-content-end">
                           <div class="mt-0">
                               <a href="#" data-size="md" class="btn btn-primary btn-icon btn-sm text-right"
                                  data-ajax-popup-over="true" id="grammarCheck" data-url="<?php echo e(route('grammar',['grammar'])); ?>"
                                  data-bs-placement="top" data-title="<?php echo e(__('Grammar check with AI')); ?>">
                                   <i class="ti ti-rotate"></i> <span><?php echo e(__('Grammar check with AI')); ?></span>
                               </a>
                           </div>
                       </div>
                   <?php endif; ?>
               </div>

               <div class="card-body">
                   <?php if(\Auth::user()->type == 'company'): ?>
                       <div class="col-12 d-flex">
                           <div class="form-group mb-0 form-send w-100">
                               <?php echo e(Form::open(['route' => ['note_store.store', $contract->id]])); ?>

                               <div class="form-group">
                                   <textarea rows="3" class="form-control grammer_textarea" name="notes" data-toggle="autosize" placeholder="<?php echo e(__('Add a Notes...')); ?>" required></textarea>
                               </div>
                               <div class="col-md-12 text-end mb-0">
                                   <?php echo e(Form::submit(__('Add'), ['class' => 'btn  btn-primary'])); ?>

                               </div>
                               <?php echo e(Form::close()); ?>

                           </div>
                       </div>
                   <?php elseif(\Auth::user()->type == 'client' && $contract->status=='accept' ): ?>
                       <div class="col-12 d-flex">
                           <div class="form-group mb-0 form-send w-100">
                               <?php echo e(Form::open(['route' => ['note_store.store', $contract->id]])); ?>

                               <div class="form-group">
                                   <textarea rows="3" class="form-control grammer_textarea" name="notes" data-toggle="autosize" placeholder="<?php echo e(__('Add a Notes...')); ?>" required></textarea>
                               </div>
                               <div class="col-md-12 text-end mb-0">
                                   <?php echo e(Form::submit(__('Add'), ['class' => 'btn  btn-primary'])); ?>

                               </div>
                               <?php echo e(Form::close()); ?>

                           </div>
                       </div>
                   <?php endif; ?>

                   <div class=" list-group list-group-flush mb-0" id="notes">
                       <?php $__currentLoopData = $contract->note; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php
                               $user = \App\Models\User::find($note->user_id);
                                $logo=\App\Models\Utility::get_file('uploads/avatar/');
                               ?>
                               <div class="list-group-item ">
                                   <div class="row align-items-center">
                                       <div class="col-auto">
                                           <a href="<?php echo e(!empty($user->avatar) ? $logo . '/' . $user->avatar : $logo . '/avatar.png'); ?>" target="_blank">
                                               <img class="rounded-circle"  width="40" height="40" src="<?php echo e(!empty($user->avatar) ? $logo . '/' . $user->avatar : $logo . '/avatar.png'); ?>">
                                           </a>
                                       </div>
                                       <div class="col-auto">
                                       </div>
                                       <div class="col ml-n2">
                                           <p class="d-block h6 text-sm font-weight-light mb-0 text-break"><?php echo e($note->notes); ?></p>
                                           <small class="d-block"><?php echo e($note->created_at->diffForHumans()); ?></small>
                                       </div>

                                           <?php if((\Auth::user()->type == 'company' && $contract->status == 'accept') || \Auth::user()->id == $note->user_id): ?>

                                           <div class="col-auto actions">
                                               <div class="action-btn bg-danger ms-2">
                                                   <?php echo Form::open(['method' => 'DELETE', 'route' => ['note_store.destroy',  $note->id]]); ?>

                                                   <a href="#!" class="mx-3 btn btn-sm  align-items-center bs-pass-para ">
                                                       <i class="ti ti-trash text-white" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Delete')); ?>"></i>
                                                   </a>
                                                   <?php echo Form::close(); ?>

                                               </div>
                                           </div>
                                       <?php endif; ?>
                                   </div>
                               </div>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </div>

               </div>
           </div>
       </div>
   </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/contract/show.blade.php ENDPATH**/ ?>
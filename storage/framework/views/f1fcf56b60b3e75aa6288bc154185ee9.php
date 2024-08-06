
<?php
    $profile=\App\Models\Utility::get_file('uploads/avatar/');
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Profile Account')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
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

    <script>
        document.getElementById('avatar').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
        }
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#editIcon').click(function() {
                    $('#fileUploadContainer').toggle();
                });
            });
        </script>
        
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Profile')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="custom-update-profile">
        
        <div class="custom-update-profile-picture">
            <div>
                <h1>Avatar</h1>
                <p>Edit your profile picture </p>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <div class="theme-avtar-logo mt-4">
                        <img id="image" src="<?php echo e(($userDetail->avatar) ? $profile  . $userDetail->avatar : $profile . 'avatar.png'); ?>"
                             class="big-logo">
                            </div>
                            <div style="position: relative;">

                                <div class="custom-update-profile-edit-icon">
                                    <i class='bx bx-edit-alt' id="editIcon" ></i>
                                </div>
                                <div class="custom-update-profile-trash-icon">
                                    <i class='bx bx-trash' ></i> 
                                </div>
                            </div>
                               
                            <div class="choose-files mt-3" id="fileUploadContainer" style="display: none;">
                                <label for="avatar">
                                    <div class=" bg-primary profile_update"> <i class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?></div>
                                    <input type="file" class="form-control file" name="profile" id="avatar" data-filename="profile_update">
                                </label>
                            </div>
                              
                    
                </div>

            </div>
        </div>
        
        
            <div style="display: flex; gap: 30px;">
            <div id="personal_info" class="card custom-card-update-profile">
                <div class="card-header">
                    <h5><?php echo e(__('Personal Info')); ?></h5>
                </div>
               
                    <div class="card-body">
                    <?php echo e(Form::model($userDetail,array('route' => array('update.account'), 'method' => 'post', 'enctype' => "multipart/form-data"))); ?>

                        <?php echo csrf_field(); ?>
                        
                            <div class="form-group">
                                <label class="col-form-label text-dark"><?php echo e(__('Full Name')); ?></label>
                                <div class="custom-update-profile-form-input">
                                    <i class="ti ti-user"></i>
                                    <input class="" name="name" type="text" id="name" placeholder="<?php echo e(__('Enter Your Name')); ?>" value="<?php echo e($userDetail->name); ?>" required autocomplete="name">
                                </div>
                            </div>
                        
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label text-dark"><?php echo e(__('Contact Number')); ?></label>
                                    <div class="custom-update-profile-form-input">
                                        <i class='bx bx-phone-call'></i>
                                    <input class="" name="contact_number" type="text" id="contact_number" placeholder="<?php echo e(__('Enter Contact Number')); ?>" value="" required autocomplete="contact_number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="email" class="col-form-label text-dark"><?php echo e(__('Email')); ?></label>
                                    <div class="custom-update-profile-form-input">
                                        <i class='bx bx-envelope' ></i>
                                    <input class="" name="email" type="text" id="email" placeholder="<?php echo e(__('Enter Your Email Address')); ?>" value="<?php echo e($userDetail->email); ?>" required autocomplete="email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label text-dark"><?php echo e(__('Gender')); ?></label>
                                    <div class="custom-update-profile-form-input">
                                        <i class='bx bx-male-female' ></i>
                                        <input class="" name="gender" type="text" id="gender" placeholder="<?php echo e(__('Enter Gender')); ?>" value="" required autocomplete="gender">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="dob" class="col-form-label text-dark"><?php echo e(__('DOB')); ?></label>
                                    <div class="custom-update-profile-form-input">
                                        <i class='bx bx-cake' ></i>
                                    <input class="" name="dob" type="text" id="dob" placeholder="<?php echo e(__('Enter Your DOB')); ?>" value="" required autocomplete="dob">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-form-label text-dark"><?php echo e(__('Address')); ?></label>
                                <div class="custom-update-profile-form-input">
                                    <i class="">&#x1F4CD;</i>
                                <input class="" name="address" type="text" id="address" placeholder="<?php echo e(__('Enter Your Address')); ?>" value="" required autocomplete="address">
                                </div>
                            </div>
                            
                            
                            <div class="col-lg-12 text-end">
                                <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn btn-print-invoice  btn-primary m-r-10">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div id="change_password" class="card custom-card-update-profile">
                <div class="card-header">
                    <h5><?php echo e(__('Change Password')); ?></h5>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo e(route('update.password')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="">
                            <div class=" form-group">
                                <label for="old_password" class="col-form-label text-dark"><?php echo e(__('Current Password')); ?></label>
                                <input class="form-control" name="old_password" type="password" id="old_password" required autocomplete="old_password" placeholder="<?php echo e(__('Enter Old Password')); ?>">
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-form-label text-dark"><?php echo e(__('New Password')); ?></label>
                                <input class="form-control" name="password" type="password" required autocomplete="new-password" id="password" placeholder="<?php echo e(__('Enter Your New Password')); ?>">
                            </div>
                            
                            <div class="col-lg-12 text-end  custom-button-update-profile">
                                <button type="submit"  class="btn btn-print-invoice  btn-primary m-r-10">Cancel</button>
                                <input type="submit" value="<?php echo e(__('Update Password')); ?>" class="btn btn-print-invoice  btn-primary m-r-10">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/user/profile.blade.php ENDPATH**/ ?>
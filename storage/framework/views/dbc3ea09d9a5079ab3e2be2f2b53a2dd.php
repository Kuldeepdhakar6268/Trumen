
<?php
    use App\Models\Utility;
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $settings = Utility::settings();
    $company_logo = $settings['company_logo'] ?? '';

?>
<?php $__env->startPush('custom-scripts'); ?>
<?php if($settings['recaptcha_module'] == 'on'): ?>
        <?php echo NoCaptcha::renderJs(); ?>

    <?php endif; ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Login')); ?>

<?php $__env->stopSection(); ?>


<?php
    $languages = App\Models\Utility::languages();

?>
<?php $__env->startSection('language-bar'); ?>
    <div class="lang-dropdown-only-desk">
        <li class="dropdown dash-h-item drp-language">
            <a class="dash-head-link dropdown-toggle btn" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="drp-text"> <?php echo e($languages[$lang]); ?>

                </span>
            </a>
            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('login',$code)); ?>"tabindex="0"
                class="dropdown-item ">
                <span><?php echo e(Str::upper($language)); ?></span>
            </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </li>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card-body">
         <div class="navbar-brand" style="margin: 0px -25px 8px -20px;">
                           
                        <a class="navbar-brand" href="#">
                            <?php if($settings['cust_darklayout'] == 'on'): ?>
                                <img class="logo"
                                    src="<?php echo e($logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-light.png') . '?' . time()); ?>"
                                    alt="" loading="lazy"  style="width: 100px;height: 60px;"/>
                            <?php else: ?>
                                <img class="logo"
                                    src="<?php echo e($logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') . '?' . time()); ?>"
                                    alt="" loading="lazy"  style="width: 100px;height: 60px;"/>
                            <?php endif; ?>
                        </a>


                        </div>
        <div>
            <h2 class="mb-3 f-w-600"><?php echo e(__('Welcome Back!')); ?></h2>
        </div>
        <?php echo e(Form::open(['route' => 'login', 'method' => 'post', 'id' => 'loginForm', 'class' => 'login-form'])); ?>

        <?php if(session('status')): ?>
        <div class="mb-4 font-medium text-lg text-green-600 text-danger">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>
        <div class="custom-login-form">
            <div class="form-group mb-3">
                <label class="form-label"><?php echo e(__('User Name')); ?></label>
                <?php echo e(Form::text('email', null, ['class' => 'form-control form-control-custom', 'placeholder' => __('Enter Your Username')])); ?>

                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error invalid-email text-danger" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group mb-3">
                <label class="form-label"><?php echo e(__('Password')); ?></label>
                <?php echo e(Form::password('password', ['class' => 'form-control form-control-custom', 'placeholder' => __('Enter Your Password'), 'id' => 'input-password'])); ?>

                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error invalid-password text-danger" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group mb-4">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <span class="d-flex align-items-center gap-1 custom-checkbox-trumen">
                        <input type="checkbox" name="Remember_me" id="Remember_me" class="form-check-input">
                        <label for="Remember_me" class="form-check-label">Remember me</label>
                    </span>
                    
                    
                </div>
            </div>


            <?php if($settings['recaptcha_module'] == 'on'): ?>
                <div class="form-group col-lg-12 col-md-12 mt-3">
                     <?php echo NoCaptcha::display($settings['cust_darklayout']=='on' ? ['data-theme' => 'dark'] : []); ?>

                    <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="small text-danger" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            <?php endif; ?>

            <div class="d-grid">
                <?php echo e(Form::submit(__('Login'), ['class' => 'btn btn-primary mt-2', 'id' => 'saveBtn'])); ?>

            </div>
           
        </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>



<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $("#form_data").submit(function(e) {
            $("#login_button").attr("disabled", true);
            return true;
        });
    });
</script>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\_trumen\resources\views/auth/login.blade.php ENDPATH**/ ?>
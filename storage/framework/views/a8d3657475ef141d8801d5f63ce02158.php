<?php
    $users=\Auth::user();
    $profile=\App\Models\Utility::get_file('uploads/avatar/');
    $languages=\App\Models\Utility::languages();

    $lang = isset($users->lang)?$users->lang:'en';
    if ($lang == null) {
        $lang = 'en';
    }
    // $LangName = \App\Models\Language::where('code',$lang)->first();
    // $LangName =\App\Models\Language::languageData($lang);
    $LangName = cache()->remember('full_language_data_' . $lang, now()->addHours(24), function () use ($lang) {
    return \App\Models\Language::languageData($lang);
    });

    $setting = \App\Models\Utility::settings();

    $unseenCounter=App\Models\ChMessage::where('to_id', Auth::user()->id)->where('seen', 0)->count();
    if(Auth()->User()->type == 'company')
                    {
                     $data['todo'] = \App\Models\Todo::orderBy('created_at','desc')->where('reminder', 0)->get();
                     $remind = \App\Models\Todo::orderBy('created_at','desc')->where(['reminder' => 1, 'is_read' => 0])->get();
                     $findremind = \App\Models\Todo::where(['created_by' => Auth::user()->id])->orderBy('created_at','desc')->whereDate('start', now()->format('Y-m-d'))->where(['reminder' => 1, 'is_read' => 0])->get();
                    }else{
                     $data['todo'] = \App\Models\Todo::where(['created_by' => Auth::user()->id])->orderBy('created_at','desc')->where('reminder', 0)->get();
                     $remind = \App\Models\Todo::where(['created_by' => Auth::user()->id])->orderBy('created_at','desc')->where('reminder', 1)->get();
                     $findremind = \App\Models\Todo::where(['created_by' => Auth::user()->id])->orderBy('created_at','desc')->whereDate('start', \Carbon\Carbon::now()->format('Y-m-d'))->where(['reminder' => 1, 'is_read' => 0])->get();
        }
?>
<?php if(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on'): ?>
    <header class="dash-header transprent-bg">
<?php else: ?>
    <header class="dash-header">
<?php endif; ?>
    <div class="header-wrapper">
        <div class="me-auto dash-mob-drp">
            <ul class="list-unstyled">
                <li class="dash-h-item mob-hamburger">
                    <a href="#!" class="dash-head-link" id="mobile-collapse">
                        <div class="hamburger hamburger--arrowturn">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                </li>

                <li class="dropdown dash-h-item drp-company">
                       
                    
                  
                    <a class="" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                       
                    <h3 class="hide-mob ms-2" style="font-weight: bolder;"><?php echo e(__('Welcome, ')); ?><?php echo e(\Auth::user()->name); ?></h3>
                        
                        
                    </a>
                    <br>
                      
                    <div class="dropdown-menu dash-h-dropdown logout-dropdown-menu">

                       

                        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="dropdown-item">
                            <i class="ti ti-power text-dark"></i><span><?php echo e(__('Logout')); ?></span>
                        </a>

                        <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo e(csrf_field()); ?>

                        </form>

                    </div>
                </li>
               
                
                

            </ul>
        </div>
        <div class="ms-auto">
            <ul class="list-unstyled">
                <?php if(\Auth::user()->type == 'company' ): ?>
                <?php if (is_impersonating($guard = null)) : ?>
                <li class="dropdown dash-h-item drp-company">
                    <a class="btn btn-danger btn-sm me-3" href="<?php echo e(route('exit.company')); ?>"><i class="ti ti-ban"></i>
                        <?php echo e(__('Exit Company Login')); ?>

                    </a>
                </li>
                <?php endif; ?>
                <?php endif; ?>
                    
                <?php if( \Auth::user()->type !='client' && \Auth::user()->type !='super admin' ): ?>
                      <li class="dropdown dash-h-item drp-notification">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                         <i class="ti ti-bell"></i>
                            <span class="bg-danger dash-h-badge message-toggle-msg  message-counter custom_messanger_counter beep"> <?php echo e($findremind->count()); ?><span
                                    class="sr-only"></span>
                            </span>
                    </a>
                    <?php if(count($findremind)): ?>
                    <div class="dropdown-menu dash-h-dropdown" style="min-width: 250px;">
                        
                            <?php $__currentLoopData = $findremind; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('dashboard')); ?>" class="dropdown-item">
                                <i class="ti ti-message text-dark"></i><span><?php echo e($r->name); ?></span>
                            </a>
    
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                    <?php endif; ?>
                </li>
                    
                    <li class="dropdown dash-h-item drp-notification">
                        <a class="dash-head-link arrow-none me-0" href="<?php echo e(url('chats')); ?>" aria-haspopup="false"
                           aria-expanded="false">
                            <i class="ti ti-bell"></i>
                            <span class="bg-danger dash-h-badge message-toggle-msg  message-counter custom_messanger_counter beep"> <?php echo e($unseenCounter); ?><span
                                    class="sr-only"></span>
                            </span>
                        </a>
                    </li>
                     <li class="dropdown dash-h-item drp-notification">
                        <a class="dash-head-link arrow-none me-0 bg-warning" href="<?php echo e(route('profile')); ?>" aria-haspopup="false"
                           aria-expanded="false">
                             <i class="ti ti-user text-dark"></i>
                            
                        </a>
                    </li>
                <?php endif; ?>
                

                
            </ul>
        </div>
    </div>
      <p style="margin-left: 41px;margin-top: -16px;">Here is your Admin dashboard</p>
    </header>
<?php /**PATH C:\xampp\htdocs\Trumen\resources\views/partials/admin/header.blade.php ENDPATH**/ ?>
<?php
    use App\Models\Utility;
    $setting = \App\Models\Utility::settings();

    $logo = \App\Models\Utility::get_file('uploads/logo');
    $company_favicon = $setting['company_favicon'] ?? '';

    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';

    if(isset($setting['color_flag']) && $setting['color_flag'] == 'true')
    {
        $themeColor = 'custom-color';
    }
    else {
        $themeColor = $color;
    }

    $SITE_RTL = $setting['SITE_RTL'] ?? '';

    $lang = \App::getLocale('lang');
    if ($lang == 'ar' || $lang == 'he') {
        $SITE_RTL = 'on';
    }
    
    $metatitle = isset($setting['meta_title']) ? $setting['meta_title'] : '';
    $metsdesc = isset($setting['meta_desc']) ? $setting['meta_desc'] : '';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $meta_logo = isset($setting['meta_image']) ? $setting['meta_image'] : '';

?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e($SITE_RTL == 'on' ? 'rtl' : ''); ?>">


<meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>">

<head>
    <title><?php echo e($setting['title_text'] ? $setting['title_text'] : config('app.name', 'ERPGO')); ?> - <?php echo $__env->yieldContent('page-title'); ?>
    </title>

    <meta name="title" content="<?php echo e($metatitle); ?>">
    <meta name="description" content="<?php echo e($metsdesc); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:title" content="<?php echo e($metatitle); ?>">
    <meta property="og:description" content="<?php echo e($metsdesc); ?>">
    <meta property="og:image" content="<?php echo e($meta_image . $meta_logo); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:title" content="<?php echo e($metatitle); ?>">
    <meta property="twitter:description" content="<?php echo e($metsdesc); ?>">
    <meta property="twitter:image" content="<?php echo e($meta_image . $meta_logo); ?>">


    <script src="<?php echo e(asset('js/html5shiv.js')); ?>"></script>

    

    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="url" content="<?php echo e(url('') . '/' . config('chatify.path')); ?>" data-user="<?php echo e(Auth::user()->id); ?>">
    <link rel="icon"
        href="<?php echo e($logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>"
        type="image" sizes="16x16">

    <!-- Favicon icon -->
    
    <!-- Calendar-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/main.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/flatpickr.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/animate.min.css')); ?>">

    <!-- font css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!--bootstrap switch-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/bootstrap-switch-button.min.css')); ?>">

    <!-- vendor css -->

    <?php if($SITE_RTL == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>">
    <?php endif; ?>

    <?php if($setting['cust_darklayout'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-dark.css')); ?>" id="main-style-link">
    <?php endif; ?>

    <?php if($SITE_RTL != 'on' && $setting['cust_darklayout'] != 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" id="main-style-link">
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/customizer.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">

    <?php if($setting['cust_darklayout'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/custom-dark.css')); ?>">
    <?php endif; ?>

    <style>
        :root {
            --color-customColor: <?= $color ?>;    
        }
        .logout-dropdown-menu{
            padding: 2px 0!important;
        }
        .dashboard-header-row{
            border-radius: 10px;
            box-shadow: 0 0 10px #d9cdcd;
            margin-top: 10px;
            padding:20px;
        }
        
        .inner-dashboard-content
        {
                border-radius: 10px;
                box-shadow: 0 0 10px #d9cdcd;
                padding: 25px;
                    background: #fff;
        }
        
        .font-weight-600{
                font-weight: bold;
                width:106px;
        }
        
        .percent-heading
        
        {
            color: var(--color-customColor);
                font-size: 13px;
              font-weight: 600;
              margin-top:2px;
                  top: 5px;
    position: relative;

        }
        
       .image-container {
    position: relative;
    display: inline-block;
}

.image-container img {
    height: 200px; /* Adjust as needed */
}

.centered-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: white; /* Adjust text color for better visibility */
}

.centered-text h3,
.centered-text span {
    display: block;
    margin: 0;
}
.position-relative {
    position: relative;
}

.text-right-overlay {
    position: absolute;
    right: 10px;
    transform: translateY(-50%);
    text-align: right;
        top: 370px;

}

.text-right-overlay span {
    display: block;
    margin-bottom: 10px;
}

.todo-list-dashboard-content ul li{
        font-size: 12px;
}
.dataTable-table thead th{
    text-transform:capitalize;
}
.apexcharts-menu-icon{
    display:none;
}

.dataTable-table {
            max-width: 100%;
            width: 100%;
            border-spacing: 0 20px; /* 10px space between rows, 0px space between columns */
            border-collapse: separate;
            padding:20px;
        }
        
        /* Counteract the border-spacing for the first row */
        .dataTable-table tr:first-child {
            margin-bottom: -10px;
        }
        .dataTable-table > thead > tr > th{
        
            background: #fff;
            border: none;
                font-size: 13px;

            
        }
        
        .dataTable-table td:not(:first-child) {
                padding-left: 2px !important;
        }
        /* For the first td */
        .dataTable-table td:first-child {
            border-left: 1px solid #ced4da;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }
        
        /* For the last td */
        .dataTable-table td:last-child {
            border-right: 1px solid #ced4da;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
        }
        
        /* For the other td elements */
        .dataTable-table td:not(:first-child):not(:last-child) {
            border-top: 1px solid #ced4da;
            border-bottom: 1px solid #ced4da;
        }
       
        
        /* Styles for the table cell */
        .dataTable-table td:not(:first-child) {
            white-space: nowrap; /* Prevent text from wrapping */
            overflow: hidden; /* Hide overflowing content */
            text-overflow: ellipsis; /* Display ellipsis for overflow */
            max-width: 500px; /* Adjust the maximum width as needed */
        }
        
             .dataTable-table td:not(:last-child) {
                  white-space: nowrap; /* Prevent text from wrapping */
            overflow: hidden; /* Hide overflowing content */
            text-overflow: ellipsis; /* Display ellipsis for overflow */
             }
        
         .dataTable-table td  {
               white-space: normal; /* Prevent text from wrapping */
            overflow: hidden;
         }
        
        /* Optionally, you can set the table layout to fixed to ensure consistent column widths */
        .dataTable-table {
            table-layout: fixed;
        }
        .dataTable-table tr td:nth-child(5) {
         text-transform:uppercase;   
        }
        .dataTable-table tr td{
            border-top: 1px solid #ced4da;
    border-bottom: 1px solid #ced4da;

        }
        .dataTable-table th {
            width: 8.73684% !important;
        }
        .dataTable-sorter::before, .dataTable-sorter::after{
            display:none;
        }
.is-focused .choices__inner,
  .is-open .choices__inner {
                border-color: var(--color-customColor);
    box-shadow: 0 0 0 0.2rem var(--color-customColor);

}




#choices-multiple4:after {
    content: "";
    height: 0;
    width: 0;
    border-style: solid;
    border-color: #293240 transparent transparent transparent;
    border-width: 5px;
    position: absolute;
    right: 11.5px;
    top: 50%;
    margin-top: -2.5px;
    pointer-events: none;
}


 .content {display:none;}
.preload { width:100px;
    height: 100px;
    position: fixed;
    top: 50%;
    left: 50%;}
    
    
    .loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid  var(--color-customColor);;
  width: 120px;
  height: 120px;
    position: fixed;
    top: 50%;
    left: 50%;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


 </style>

    <link rel="stylesheet" href="<?php echo e(asset('css/custom-color.css')); ?>">
    <?php echo $__env->yieldPushContent('css-page'); ?>
    

</head>



<body class="<?php echo e($themeColor); ?>">

    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <?php echo $__env->make('partials.admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <?php echo $__env->make('partials.admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Modal -->
    <div class="modal notification-modal fade" id="notification-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <h6 class="mt-2">
                        <i data-feather="monitor" class="me-2"></i>Desktop settings
                    </h6>
                    <hr />
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" id="pcsetting1" checked />
                        <label class="form-check-label f-w-600 pl-1" for="pcsetting1">Allow desktop notification</label>
                    </div>
                    <p class="text-muted ms-5">
                        you get lettest content at a time when data will updated
                    </p>
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" id="pcsetting2" />
                        <label class="form-check-label f-w-600 pl-1" for="pcsetting2">Store Cookie</label>
                    </div>
                    <h6 class="mb-0 mt-5">
                        <i data-feather="save" class="me-2"></i>Application settings
                    </h6>
                    <hr />
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" id="pcsetting3" />
                        <label class="form-check-label f-w-600 pl-1" for="pcsetting3">Backup Storage</label>
                    </div>
                    <p class="text-muted mb-4 ms-5">
                        Automaticaly take backup as par schedule
                    </p>
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" id="pcsetting4" />
                        <label class="form-check-label f-w-600 pl-1" for="pcsetting4">Allow guest to print
                            file</label>
                    </div>
                    <h6 class="mb-0 mt-5">
                        <i data-feather="cpu" class="me-2"></i>System settings
                    </h6>
                    <hr />
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" id="pcsetting5" checked />
                        <label class="form-check-label f-w-600 pl-1" for="pcsetting5">View other user chat</label>
                    </div>
                    <p class="text-muted ms-5">Allow to show public user message</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger btn-sm" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-light-primary btn-sm">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="dash-container">
        <div class="dash-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="page-header-title">
                                <h4 class="m-b-10"><?php echo $__env->yieldContent('page-title'); ?></h4>
                            </div>
                            <ul class="breadcrumb">
                                <?php echo $__env->yieldContent('breadcrumb'); ?>
                            </ul>
                        </div>
                        <div class="col action-btn-col">
                            <?php echo $__env->yieldContent('action-btn'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $__env->yieldContent('content'); ?>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="body">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="commonModalOver" tabindex="-1" role="dialog" aria-labelledby="commonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commonModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 99999">
        <div id="liveToast" class="toast text-white fade" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php echo $__env->make('partials.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('Chatify::layouts.footerLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\_trumen\resources\views/layouts/admin.blade.php ENDPATH**/ ?>
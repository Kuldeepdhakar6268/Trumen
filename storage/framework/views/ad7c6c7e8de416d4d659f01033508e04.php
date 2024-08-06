<?php
    use App\Models\Utility;
    $setting = \App\Models\Utility::settings();
    $logo = \App\Models\Utility::get_file('uploads/logo/');
 
    $company_logo = $setting['company_logo_dark'] ?? '';
    $company_logos = $setting['company_logo_light'] ?? '';
    $company_small_logo = $setting['company_small_logo'] ?? '';

    $emailTemplate = \App\Models\EmailTemplate::emailTemplateData();
    $lang = Auth::user()->lang;

    $userPlan = \App\Models\Plan::getPlan(1);
?>

<?php if(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on'): ?>
    <nav class="dash-sidebar light-sidebar transprent-bg">
    <?php else: ?>
        <nav class="dash-sidebar light-sidebar ">
<?php endif; ?>
<div class="navbar-wrapper">
    <div class="m-header main-logo">
        <a href="<?php echo e(url('/account-dashboard')); ?>" class="b-brand">
            

            <?php if($setting['cust_darklayout'] && $setting['cust_darklayout'] == 'on'): ?>
                <img src="<?php echo e($logo . '/' . (isset($company_logos) && !empty($company_logos) ? $company_logos : 'logo-dark.png')); ?>"
                    alt="<?php echo e(config('app.name', 'ERPGo-SaaS')); ?>" class="logo logo-lg" style="height: 75px;">
            <?php else: ?>
                <img src="<?php echo e($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-light.png')); ?>"
                    alt="<?php echo e(config('app.name', 'ERPGo-SaaS')); ?>" class="logo logo-lg" style="height: 75px;">
            <?php endif; ?>

        </a>
    </div>
    <div class="navbar-content">
        <?php if(\Auth::user()->type != 'client'): ?>
            <ul class="dash-navbar">
                <!--------------------- Start Dashboard ----------------------------------->
                <?php if(Gate::check('show hrm dashboard') ||
                        Gate::check('show project dashboard') ||
                        Gate::check('show account dashboard') ||
                        Gate::check('show crm dashboard') ||
                        Gate::check('show pos dashboard')): ?>
                    <li
                        class="dash-item dash-hasmenu
                                <?php echo e(Request::segment(1) == null ||
                                Request::segment(1) == 'account-dashboard' ||
                                Request::segment(1) == 'income report' ||
                               
                                Request::segment(1) == 'reports-monthly-cashflow' ||
                                Request::segment(1) == 'reports-quarterly-cashflow' ||
                                Request::segment(1) == 'reports-payroll' ||
                                Request::segment(1) == 'reports-leave' ||
                                Request::segment(1) == 'reports-monthly-attendance' ||
                                Request::segment(1) == 'reports-lead' ||
                                Request::segment(1) == 'reports-deal' ||
                                Request::segment(1) == 'pos-dashboard' ||
                                Request::segment(1) == 'reports-warehouse' ||
                                Request::segment(1) == 'reports-daily-purchase' ||
                                Request::segment(1) == 'reports-monthly-purchase' ||
                                Request::segment(1) == 'reports-daily-pos' ||
                                Request::segment(1) == 'reports-monthly-pos' ||
                                Request::segment(1) == 'reports-pos-vs-purchase'
                                    ? 'active dash-trigger'
                                    : ''); ?>">
                         <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'account-dashboard' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('dashboard')); ?>" class="dash-link">
                                <span class="dash-micon">
                                <i class="ti ti-home"></i>
                                </span>
                                <span
                                    class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                            </a>
                        
                       
                    </li>
                <?php endif; ?>
                <!--------------------- End Dashboard ----------------------------------->

                <!--------------------- Start CRM ----------------------------------->
 
            <?php if(!empty($userPlan) &&  $userPlan->crm == 1): ?>
          
                                  
                <?php if(Gate::check('manage lead') ||
                        Gate::check('manage deal') ||
                        Gate::check('manage form builder') ||
                        Gate::check('manage contract')): ?>
                       
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'pipelines' || Request::segment(1) == 'deals' || Request::segment(1) == 'leads' || Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response' || Request::segment(1) == 'contract' ? ' active dash-trigger' : ''); ?>">
                        
                            <a href="<?php echo e(route('sales.crm.dashboard')); ?>" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-layers-difference"></i></span><span
                                class="dash-mtext"><?php echo e(__('Sales')); ?> & <?php echo e(__('CRM')); ?></span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                           
                    
                        <ul
                            class="dash-submenu <?php echo e(Request::segment(1) == 'customer' || Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'leads' || Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response' || Request::segment(1) == 'deals' || Request::segment(1) == 'pipelines' ? 'show' : ''); ?>">
                           
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage lead')): ?>
                            <?php if(\Auth::user()->type == 'user'): ?>
                            <li class="dash-item <?php echo e(Request::route()->getName() == 'leads.list' || Request::route()->getName() == 'leads.index' || Request::route()->getName() == 'leads.show' ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('leads.list')); ?>"><?php echo e(__('Leads')); ?></a>
                                </li>
                            <?php else: ?>
                            <li class="dash-item <?php echo e(Request::route()->getName() == 'leads.list' || Request::route()->getName() == 'leads.index' || Request::route()->getName() == 'leads.show' ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('leads.list')); ?>"><?php echo e(__('Leads Generation')); ?></a>
                                </li>
                            <?php endif; ?>
                                
                            <?php endif; ?>
                           
                         <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage quotation')): ?>
                        <li
                            class="dash-item <?php echo e(Request::route()->getName() == 'quotation.index' || Request::route()->getName() == 'quotations.create' || Request::route()->getName() == 'quotation.edit' || Request::route()->getName() == 'quotation.show' ? ' active' : ''); ?>">
                            <a class="dash-link" href="<?php echo e(route('quotation.index')); ?>"><?php echo e(__('Quotation')); ?></a>
                        </li>
                       <?php endif; ?>
                        <?php if(Gate::check('manage customer')): ?>
                                            <li
                                                class="dash-item <?php echo e(Request::segment(1) == 'customer' ? 'active' : ''); ?>">
                                                <a class="dash-link"
                                                    href="<?php echo e(route('customer.index')); ?>"><?php echo e(__('Customer')); ?></a>
                                            </li>
                            <?php endif; ?>
                             <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage quotation')): ?>
                                <li
                                    class="dash-item <?php echo e(Request::route()->getName() == 'quotation.order' ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('quotation.order')); ?>"><?php echo e(__('Order List')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage quotation')): ?>
                                <li
                                    class="dash-item <?php echo e(Request::route()->getName() == 'quotation.jobcard' ? 'active open' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('quotation.jobcard')); ?>"><?php echo e(__('Job card request')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage contract')): ?>
                                <li
                                    class="dash-item  <?php echo e(Request::route()->getName() == 'contract.index' || Request::route()->getName() == 'contract.show' ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('report.sales')); ?>"><?php echo e(__('Sales & CRM reports')); ?></a>
                                </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage lead stage') ||
                            Gate::check('manage pipeline') ||
                            Gate::check('manage source') ||
                            Gate::check('manage label') ||
                            Gate::check('manage stage')): ?>
                        <!--<li-->
                        <!--    class="dash-item  <?php echo e(Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'pipelines' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type' ? 'active dash-trigger' : ''); ?>">-->
                        <!--    <a class="dash-link"-->
                        <!--        href="<?php echo e(route('pipelines.index')); ?>   "><?php echo e(__('CRM System Setup')); ?></a>-->

                        <!--</li>-->
                    <?php endif; ?>
            </ul>
            </li>
        <?php endif; ?>
        <?php endif; ?>

        <!--------------------- End CRM ----------------------------------->
        
         <!--------------------- Start POs System ----------------------------------->
        <?php if(!empty($userPlan) &&  $userPlan->pos == 1): ?>
            <?php if(Gate::check('manage warehouse') ||
                    Gate::check('manage purchase') ||
                    Gate::check('manage pos') ||
                    Gate::check('manage print settings')): ?>
                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'warehouse' || Request::segment(1) == 'purchase'|| Request::route()->getName() == 'pos.barcode' || Request::route()->getName() == 'pos.print' || Request::route()->getName() == 'pos.show' ? ' active dash-trigger' : ''); ?>">
                   <a href="<?php echo e(route('purchase.management.dashboard')); ?>" class="dash-link d-flex"><span class="dash-micon"><i
                                class="ti ti-layers-difference"></i></span><span
                            class="dash-mtext"><?php echo e(__('Purchase & Management')); ?></span><span class="dash-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul
                        class="dash-submenu">
                        <?php if(Gate::check('manage vender')): ?>
                                            <li
                                                class="dash-item <?php echo e(Request::segment(1) == 'vender' ? 'active' : ''); ?>">
                                                <a class="dash-link"
                                                    href="<?php echo e(route('vender.index')); ?>"><?php echo e(__('Vendor')); ?></a>
                                            </li>
                                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage purchase')): ?>
                            <li
                                class="dash-item <?php echo e(Request::route()->getName() == 'order.index' || Request::route()->getName() == 'order.create' || Request::route()->getName() == 'order.edit' || Request::route()->getName() == 'order.show' ? ' active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('order.index')); ?>"><?php echo e(__('Order request')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage purchase')): ?>
                            <li
                                class="dash-item <?php echo e(Request::route()->getName() == 'purchase.index' || Request::route()->getName() == 'purchase.create' || Request::route()->getName() == 'purchase.edit' || Request::route()->getName() == 'purchase.show' ? ' active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('purchase.index')); ?>"><?php echo e(__('Indentan order')); ?></a>
                            </li>
                        <?php endif; ?>
                       
                    
                            <li
                                class="dash-item <?php echo e(Request::route()->getName() == 'orderReturn.index' || Request::route()->getName() == 'orderReturn.create' || Request::route()->getName() == 'orderReturn.edit' || Request::route()->getName() == 'orderReturn.show' ? ' active' : ''); ?>">
                                <a class="dash-link"
                                    href="<?php echo e(route('orderReturn.index')); ?>"><?php echo e(__('Return orders')); ?></a>
                            </li>

                    </ul>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        <!--------------------- End POs System ----------------------------------->
        
        <!--------------------- Start Products System ----------------------------------->

        <?php if(Gate::check('manage product & service') || Gate::check('manage product & service')): ?>
            <li class="dash-item dash-hasmenu">
                <a href="<?php echo e(route('production.dashboard')); ?>" class="dash-link ">
                    <span class="dash-micon"><i class="ti ti-shopping-cart"></i></span><span
                        class="dash-mtext"><?php echo e(__('Production')); ?></span><span class="dash-arrow">
                        <i data-feather="chevron-right"></i></span>
                </a>
                <ul class="dash-submenu">
                    <?php if(Gate::check('manage product & service')): ?>
                        <li class="dash-item <?php echo e(Request::segment(1) == 'productservice' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('productservice.index')); ?>"
                                class="dash-link"><?php echo e(__('Product')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(Gate::check('manage product & service')): ?>
                        <li class="dash-item <?php echo e(Request::segment(1) == 'productstock' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('productstock.index')); ?>"
                                class="dash-link"><?php echo e(__('Operation')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                     <?php if(Gate::check('manage product & service')): ?>
                        <li class="dash-item <?php echo e(Request::segment(1) == 'productspecification' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('productspecification.index')); ?>"
                                class="dash-link"><?php echo e(__('Materials & Specifications')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                     <?php if(Gate::check('manage product & service')): ?>
                        <li class="dash-item <?php echo e(Request::segment(1) == 'groups' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('groups.index')); ?>"
                                class="dash-link"><?php echo e(__('Categories')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                     <?php if(Gate::check('manage product & service')): ?>
                        <li class="dash-item <?php echo e(Request::segment(1) == 'product-models' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('product-models.index')); ?>"
                                class="dash-link"><?php echo e(__('Model')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>

        <!--------------------- End Products System ----------------------------------->
        
         <!--------------------- Start Project ----------------------------------->

       <?php if(!empty($userPlan) &&  $userPlan->project == 1): ?>
            <?php if(Gate::check('manage project')): ?>
                <li
                    class="dash-item dash-hasmenu
                                            <?php echo e(Request::segment(1) == 'project' ||
                                            Request::segment(1) == 'bugs-report' ||
                                            Request::segment(1) == 'bugstatus' ||
                                            Request::segment(1) == 'project-task-stages' ||
                                            Request::segment(1) == 'calendar' ||
                                            Request::segment(1) == 'timesheet-list' ||
                                            Request::segment(1) == 'taskboard' ||
                                            Request::segment(1) == 'timesheet-list' ||
                                            Request::segment(1) == 'taskboard' ||
                                            Request::segment(1) == 'project' ||
                                            Request::segment(1) == 'projects' ||
                                            Request::segment(1) == 'project_report'
                                                ? 'active dash-trigger'
                                                : ''); ?>">
                    <a href="<?php echo e(route('manufacturing.dashboard')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-share"></i></span><span
                            class="dash-mtext"><?php echo e(__('Manufacturing')); ?></span><span class="dash-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="dash-submenu">
                      
                        <?php if(\Auth::user()->type != 'super admin'): ?>
                            <li class="dash-item  <?php echo e(Request::segment(1) == 'time-tracker' ? 'active open' : ''); ?>">
                                <a class="dash-link" href="#"><?php echo e(__('Mechanical')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(\Auth::user()->type == 'company' || \Auth::user()->type == 'Employee'): ?>
                            <li
                                class="dash-item  <?php echo e(Request::route()->getName() == 'project_report.index' || Request::route()->getName() == 'project_report.show' ? 'active' : ''); ?>">
                                <a class="dash-link"
                                    href="#"><?php echo e(__('Electronic')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(\Auth::user()->type == 'company' || \Auth::user()->type == 'Employee'): ?>
                            <li
                                class="dash-item  <?php echo e(Request::route()->getName() == 'project_report.index' || Request::route()->getName() == 'project_report.show' ? 'active' : ''); ?>">
                                <a class="dash-link"#
                                    href="#"><?php echo e(__('Quality check')); ?></a>
                            </li>
                        <?php endif; ?>

                      
                    </ul>
                </li>
            <?php endif; ?>
        <?php endif; ?>  

        <!--------------------- End Project ----------------------------------->

                   <?php if(\Auth::user()->type == 'company'): ?>
            <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'notification_templates' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('disptch.dashboard')); ?>" class="dash-link">
                    <span class="dash-micon"><i class='bx bxs-truck' ></i></span><span
                        class="dash-mtext"><?php echo e(__('Dispatch')); ?></span>
                </a>
            </li>
        <?php endif; ?>
      
       <?php if(\Auth::user()->type != 'super admin' && \Auth::user()->type != 'user' && \Auth::user()->type != 'sales'): ?>
            <li class="dash-item dash-hasmenu <?php echo e(request()->is('calendar*') ? 'active' : ''); ?>">
                <a href="#" class="dash-link">
                    <span class="dash-micon"><i class="ti ti-headphones"></i></span><span
                        class="dash-mtext"><?php echo e(__('Service & Management')); ?></span>
                </a>
            </li>
           
        <?php endif; ?>
        
        
        
            <!--------------------- Start Inventry System ----------------------------------->
        <?php if(!empty($userPlan) &&  $userPlan->pos == 1): ?>
            <?php if(Gate::check('manage warehouse') ||
                    Gate::check('manage purchase') ||
                    Gate::check('manage pos') ||
                    Gate::check('manage print settings')): ?>
                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'report' || Request::segment(1) == 'reports-monthly-cashflow' || Request::segment(1) == 'reports-quarterly-cashflow' ? 'active dash-trigger ' : ''); ?>">
                    <a href="<?php echo e(route('inventory.dashboard')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-layers-difference"></i></span><span
                            class="dash-mtext"><?php echo e(__('Inventory')); ?></span><span class="dash-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul
                        class="dash-submenu <?php echo e(Request::segment(1) == 'warehouse' ||
                        Request::segment(1) == 'purchase' ||
                        Request::route()->getName() == 'pos.barcode' ||
                        Request::route()->getName() == 'pos.print' ||
                        Request::route()->getName() == 'pos.show'
                            ? 'show'
                            : ''); ?>">
                          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('stock report')): ?>   
                          
                            <li class="dash-item <?php echo e(Request::segment(1) == 'productstock' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('productstock.index')); ?>"
                                class="dash-link"><?php echo e(__('Product Stock')); ?>

                            </a>
                            </li>
                                                    <?php endif; ?>
                         <?php if(Gate::check('manage product & service')): ?>
                        <li class="dash-item <?php echo e(Request::segment(1) == 'materialstock' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('materialstock.index')); ?>"
                                class="dash-link"><?php echo e(__('Material Stock')); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage purchase')): ?>
                                     <li
                                            class="dash-item  <?php echo e(Request::route()->getName() == 'project-task-stages.index' ? 'active' : ''); ?>">
                                            <a class="dash-link"
                                                href="#"><?php echo e(__('Dead Product')); ?></a>
                                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage quotation')): ?>
                         <li
                                            class="dash-item <?php echo e(Request::route()->getName() == 'bugstatus.index' ? 'active' : ''); ?>">
                                            <a class="dash-link"
                                                href="#"><?php echo e(__('Dead Material')); ?></a>
                                        </li>
                       
                    <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage pos')): ?>
                            <li class="dash-item <?php echo e(Request::route()->getName() == 'pos.index' ? ' active' : ''); ?>">
                                <a class="dash-link" href="#"><?php echo e(__(' Damage Product')); ?></a>
                            </li>
                            <li
                                class="dash-item <?php echo e(Request::route()->getName() == 'pos.report' || Request::route()->getName() == 'pos.show' ? ' active' : ''); ?>">
                                <a class="dash-link" href="#"><?php echo e(__('Damage Material')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage warehouse')): ?>
                            <li
                                class="dash-item <?php echo e(Request::route()->getName() == 'warehouse-transfer.index' || Request::route()->getName() == 'warehouse-transfer.show' ? ' active' : ''); ?>">
                                <a class="dash-link"
                                    href="<?php echo e(route('warehouse-transfer.index')); ?>"><?php echo e(__('Purchase Order')); ?></a>
                            </li>
                        <?php endif; ?>
                       
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create barcode')): ?>
                            <li
                                class="dash-item <?php echo e(Request::route()->getName() == 'pos.barcode' || Request::route()->getName() == 'pos.print' ? ' active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('pos.barcode')); ?>"><?php echo e(__('Return order')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage pos')): ?>
                            <li
                                class="dash-item <?php echo e(Request::route()->getName() == 'pos-print-setting' ? ' active' : ''); ?>">
                                <a class="dash-link"
                                    href="<?php echo e(route('pos.print.setting')); ?>"><?php echo e(__('Order request')); ?></a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        <!--------------------- End Inventry System ----------------------------------->
        
        
        
          <!--------------------- Start Account ----------------------------------->

            <?php if(!empty($userPlan) &&  $userPlan->account == 1): ?>
                <?php if(Gate::check('manage customer') ||
                        Gate::check('manage vender') ||
                        Gate::check('manage proposal') ||
                        Gate::check('manage bank account') ||
                        Gate::check('manage bank transfer') ||
                        Gate::check('manage invoice') ||
                        Gate::check('manage revenue') ||
                        Gate::check('manage credit note') ||
                        Gate::check('manage bill') ||
                        Gate::check('manage payment') ||
                        Gate::check('manage debit note') ||
                        Gate::check('manage chart of account') ||
                        Gate::check('manage journal entry') ||
                        Gate::check('balance sheet report') ||
                        Gate::check('ledger report') ||
                        Gate::check('trial balance report')): ?>
                    <li
                        class="dash-item dash-hasmenu
                                     <?php echo e(Request::route()->getName() == 'print-setting' ||
                                     Request::segment(1) == 'vender' ||
                                     Request::segment(1) == 'proposal' ||
                                     Request::segment(1) == 'bank-account' ||
                                     Request::segment(1) == 'bank-transfer' ||
                                     Request::segment(1) == 'invoice' ||
                                     Request::segment(1) == 'revenue' ||
                                     Request::segment(1) == 'credit-note' ||
                                     Request::segment(1) == 'taxes' ||
                                     Request::segment(1) == 'product-category' ||
                                     Request::segment(1) == 'product-unit' ||
                                     Request::segment(1) == 'payment-method' ||
                                     Request::segment(1) == 'custom-field' ||
                                     Request::segment(1) == 'chart-of-account-type' ||
                                     (Request::segment(1) == 'transaction' &&
                                         Request::segment(2) != 'ledger' &&
                                         Request::segment(2) != 'balance-sheet' &&
                                         Request::segment(2) != 'trial-balance') ||
                                     Request::segment(1) == 'goal' ||
                                     Request::segment(1) == 'budget' ||
                                     Request::segment(1) == 'chart-of-account' ||
                                     Request::segment(1) == 'journal-entry' ||
                                     Request::segment(2) == 'ledger' ||
                                     Request::segment(2) == 'balance-sheet' ||
                                     Request::segment(2) == 'trial-balance' ||
                                     Request::segment(2) == 'profit-loss' ||
                                     Request::segment(1) == 'bill' ||
                                     Request::segment(1) == 'expense' ||
                                     Request::segment(1) == 'payment' ||
                                     Request::segment(1) == 'debit-note'
                                         ? ' active dash-trigger'
                                         : ''); ?>">
                        <a href="<?php echo e(route('finance.dashboard')); ?>" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-box"></i></span><span
                                class="dash-mtext"><?php echo e(__('Finance ')); ?>

                            </span><span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu">

                         <?php if(Gate::check('manage bank account') || Gate::check('manage bank transfer')): ?>
                                <li
                                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'bank-account' || Request::segment(1) == 'bank-transfer' ? 'active dash-trigger' : ''); ?>">
                                    <a class="dash-link" href="#"><?php echo e(__('Banking')); ?><span
                                            class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">
                                        <li
                                            class="dash-item <?php echo e(Request::route()->getName() == 'bank-account.index' || Request::route()->getName() == 'bank-account.create' || Request::route()->getName() == 'bank-account.edit' ? ' active' : ''); ?>">
                                            <a class="dash-link"
                                                href="<?php echo e(route('bank-account.index')); ?>"><?php echo e(__('Account')); ?></a>
                                        </li>
                                        <li
                                            class="dash-item <?php echo e(Request::route()->getName() == 'bank-transfer.index' || Request::route()->getName() == 'bank-transfer.create' || Request::route()->getName() == 'bank-transfer.edit' ? ' active' : ''); ?>">
                                            <a class="dash-link"
                                                href="<?php echo e(route('bank-transfer.index')); ?>"><?php echo e(__('Transfer')); ?></a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if(Gate::check('manage customer') ||
                                    Gate::check('manage proposal') ||
                                    Gate::check('manage invoice') ||
                                    Gate::check('manage revenue') ||
                                    Gate::check('manage credit note')): ?>
                                <li
                                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'customer' || Request::segment(1) == 'proposal' || Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note' ? 'active dash-trigger' : ''); ?>">
                                    <a class="dash-link" href="#"><?php echo e(__('Sales')); ?><span
                                            class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">
                                        <?php if(Gate::check('manage customer')): ?>
                                            <li
                                                class="dash-item <?php echo e(Request::segment(1) == 'customer' ? 'active' : ''); ?>">
                                                <a class="dash-link"
                                                    href="<?php echo e(route('customer.index')); ?>"><?php echo e(__('Customer')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(Gate::check('manage proposal')): ?>
                                            <li
                                                class="dash-item <?php echo e(Request::segment(1) == 'proposal' ? 'active' : ''); ?>">
                                                <a class="dash-link"
                                                    href="<?php echo e(route('proposal.index')); ?>"><?php echo e(__('Estimate/Proposal')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <li
                                            class="dash-item <?php echo e(Request::route()->getName() == 'invoice.index' || Request::route()->getName() == 'invoice.create' || Request::route()->getName() == 'invoice.edit' || Request::route()->getName() == 'invoice.show' ? ' active' : ''); ?>">
                                            <a class="dash-link"
                                                href="<?php echo e(route('invoice.index')); ?>"><?php echo e(__('Invoice')); ?></a>
                                        </li>
                                        <li
                                            class="dash-item <?php echo e(Request::route()->getName() == 'revenue.index' || Request::route()->getName() == 'revenue.create' || Request::route()->getName() == 'revenue.edit' ? ' active' : ''); ?>">
                                            <a class="dash-link"
                                                href="<?php echo e(route('revenue.index')); ?>"><?php echo e(__('Revenue')); ?></a>
                                        </li>
                                        <li
                                            class="dash-item <?php echo e(Request::route()->getName() == 'credit.note' ? ' active' : ''); ?>">
                                            <a class="dash-link"
                                                href="<?php echo e(route('credit.note')); ?>"><?php echo e(__('Credit Note')); ?></a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                           
                            <?php if(Gate::check('manage chart of account') ||
                                    Gate::check('manage journal entry') ||
                                    Gate::check('balance sheet report') ||
                                    Gate::check('ledger report') ||
                                    Gate::check('trial balance report')): ?>
                                <li
                                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'chart-of-account' ||
                                    Request::segment(1) == 'journal-entry' ||
                                    Request::segment(2) == 'profit-loss' ||
                                    Request::segment(2) == 'ledger' ||
                                    Request::segment(2) == 'balance-sheet' ||
                                    Request::segment(2) == 'trial-balance'
                                        ? 'active dash-trigger'
                                        : ''); ?>">
                                    <a class="dash-link" href="#"><?php echo e(__('Double Entry')); ?><span
                                            class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">
                                        <li
                                            class="dash-item <?php echo e(Request::route()->getName() == 'chart-of-account.index' || Request::route()->getName() == 'chart-of-account.show' ? ' active' : ''); ?>">
                                            <a class="dash-link"
                                                href="<?php echo e(route('chart-of-account.index')); ?>"><?php echo e(__('Chart of Accounts')); ?></a>
                                        </li>
                                        <li
                                            class="dash-item <?php echo e(Request::route()->getName() == 'journal-entry.edit' ||
                                            Request::route()->getName() == 'journal-entry.create' ||
                                            Request::route()->getName() == 'journal-entry.index' ||
                                            Request::route()->getName() == 'journal-entry.show'
                                                ? ' active'
                                                : ''); ?>">
                                            <a class="dash-link"
                                                href="<?php echo e(route('journal-entry.index')); ?>"><?php echo e(__('Journal Account')); ?></a>
                                        </li>
                                        <li
                                            class="dash-item <?php echo e(Request::route()->getName() == 'report.ledger' ? ' active' : ''); ?>">
                                            <a class="dash-link"
                                                href="<?php echo e(route('report.ledger', 0)); ?>"><?php echo e(__('Ledger Summary')); ?></a>
                                        </li>
                                        <li
                                            class="dash-item <?php echo e(Request::route()->getName() == 'report.balance.sheet' ? ' active' : ''); ?>">
                                            <a class="dash-link"
                                                href="<?php echo e(route('report.balance.sheet')); ?>"><?php echo e(__('Balance Sheet')); ?></a>
                                        </li>
                                        <li
                                            class="dash-item <?php echo e(Request::route()->getName() == 'report.profit.loss' ? ' active' : ''); ?>">
                                            <a class="dash-link"
                                                href="<?php echo e(route('report.profit.loss')); ?>"><?php echo e(__('Profit & Loss')); ?></a>
                                        </li>

                                        <li
                                            class="dash-item <?php echo e(Request::route()->getName() == 'trial.balance' ? ' active' : ''); ?>">
                                            <a class="dash-link"
                                                href="<?php echo e(route('trial.balance')); ?>"><?php echo e(__('Trial Balance')); ?></a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                          
                            <?php if(Gate::check('manage customer')): ?>
                                            <li
                                                class="dash-item <?php echo e(Request::segment(1) == 'customer' ? 'active' : ''); ?>">
                                                <a class="dash-link"
                                                    href="<?php echo e(route('customer.index')); ?>"><?php echo e(__('Customer')); ?></a>
                                            </li>
                                        <?php endif; ?>
                            <?php if(Gate::check('manage constant tax') ||
                                    Gate::check('manage constant category') ||
                                    Gate::check('manage constant unit') ||
                                    Gate::check('manage constant payment method') ||
                                    Gate::check('manage constant custom field')): ?>
                                <li
                                    class="dash-item <?php echo e(Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type' ? 'active dash-trigger' : ''); ?>">
                                    <a class="dash-link"
                                        href="#"><?php echo e(__('Vendor')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if(Gate::check('manage print settings')): ?>
                                <li
                                    class="dash-item <?php echo e(Request::route()->getName() == 'print-setting' ? ' active' : ''); ?>">
                                    <a class="dash-link"
                                        href="#"><?php echo e(__('Miscellaneous Operation')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(Gate::check('manage print settings')): ?>
                                <li
                                    class="dash-item <?php echo e(Request::route()->getName() == 'print-setting' ? ' active' : ''); ?>">
                                    <a class="dash-link"
                                        href="#"><?php echo e(__('Bank')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(Gate::check('manage print settings')): ?>
                                <li
                                    class="dash-item <?php echo e(Request::route()->getName() == 'print-setting' ? ' active' : ''); ?>">
                                    <a class="dash-link"
                                        href="#"><?php echo e(__('Cash')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(Gate::check('manage print settings')): ?>
                                <li
                                    class="dash-item <?php echo e(Request::route()->getName() == 'print-setting' ? ' active' : ''); ?>">
                                    <a class="dash-link"
                                        href="#"><?php echo e(__('Salaries')); ?></a>
                                </li>
                            <?php endif; ?>

                        </ul>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <!--------------------- End Account ----------------------------------->

        

                <!--------------------- Start HRM ----------------------------------->

                <?php if(!empty($userPlan) && $userPlan->hrm == 1): ?>
                    <?php if(Gate::check('manage employee') || Gate::check('manage setsalary')): ?>
                        <li
                            class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'holiday-calender' ||
                            Request::segment(1) == 'leavetype' ||
                            Request::segment(1) == 'leave' ||
                            Request::segment(1) == 'attendanceemployee' ||
                            Request::segment(1) == 'document-upload' ||
                            Request::segment(1) == 'document' ||
                            Request::segment(1) == 'performanceType' ||
                            Request::segment(1) == 'branch' ||
                            Request::segment(1) == 'department' ||
                            Request::segment(1) == 'designation' ||
                            Request::segment(1) == 'employee' ||
                            Request::segment(1) == 'leave_requests' ||
                            Request::segment(1) == 'holidays' ||
                            Request::segment(1) == 'policies' ||
                            Request::segment(1) == 'leave_calender' ||
                            Request::segment(1) == 'award' ||
                            Request::segment(1) == 'transfer' ||
                            Request::segment(1) == 'resignation' ||
                            Request::segment(1) == 'training' ||
                            Request::segment(1) == 'travel' ||
                            Request::segment(1) == 'promotion' ||
                            Request::segment(1) == 'complaint' ||
                            Request::segment(1) == 'warning' ||
                            Request::segment(1) == 'termination' ||
                            Request::segment(1) == 'announcement' ||
                            Request::segment(1) == 'job' ||
                            Request::segment(1) == 'job-application' ||
                            Request::segment(1) == 'candidates-job-applications' ||
                            Request::segment(1) == 'job-onboard' ||
                            Request::segment(1) == 'custom-question' ||
                            Request::segment(1) == 'interview-schedule' ||
                            Request::segment(1) == 'career' ||
                            Request::segment(1) == 'holiday' ||
                            Request::segment(1) == 'setsalary' ||
                            Request::segment(1) == 'payslip' ||
                            Request::segment(1) == 'paysliptype' ||
                            Request::segment(1) == 'company-policy' ||
                            Request::segment(1) == 'job-stage' ||
                            Request::segment(1) == 'job-category' ||
                            Request::segment(1) == 'terminationtype' ||
                            Request::segment(1) == 'awardtype' ||
                            Request::segment(1) == 'trainingtype' ||
                            Request::segment(1) == 'goaltype' ||
                            Request::segment(1) == 'paysliptype' ||
                            Request::segment(1) == 'allowanceoption' ||
                            Request::segment(1) == 'competencies' ||
                            Request::segment(1) == 'loanoption' ||
                            Request::segment(1) == 'deductionoption'
                                ? 'active dash-trigger'
                                : ''); ?>">
                            <a href="<?php echo e(route('hrms.dashboard')); ?>" class="dash-link ">
                                <span class="dash-micon">
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="dash-mtext">
                                    <?php echo e(__('HRMS')); ?>

                                </span>
                                <span class="dash-arrow">
                                    <i data-feather="chevron-right"></i>
                                </span>
                            </a>
                            <ul class="dash-submenu">
                              <li
                                    class="dash-item  <?php echo e(Request::segment(1) == 'employee' ? 'active dash-trigger' : ''); ?>   ">
                                    <?php if(\Auth::user()->type == 'Employee'): ?>
                                        <?php
                                            $employee = App\Models\Employee::where('user_id', \Auth::user()->id)->first();
                                        ?>
                                        <a class="dash-link"
                                            href="<?php echo e(route('employee.show', \Illuminate\Support\Facades\Crypt::encrypt($employee->id))); ?>"><?php echo e(__('Employee')); ?></a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('employee.index')); ?>" class="dash-link">
                                            <?php echo e(__('Employee Setup')); ?>

                                        </a>
                                    <?php endif; ?>
                                </li>
                                    <li class="dash-item <?php echo e((request()->is('department*') ? 'active' : '')); ?>">
                                        <a class="dash-link"
                                            href="<?php echo e(route('department.index')); ?>"><?php echo e(__('Department Manage')); ?></a>
                                    </li>
                                 <li class="dash-item <?php echo e((request()->is('designation*') ? 'active' : '')); ?>">
                                        <a class="dash-link"
                                            href="<?php echo e(route('designation.index')); ?>"><?php echo e(__('Designation Manage')); ?></a>
                                    </li>
                                     <?php if(Gate::check('manage leave') || Gate::check('manage attendance')): ?>
                                    <li
                                        class="dash-item dash-hasmenu  <?php echo e(Request::segment(1) == 'leave' || Request::segment(1) == 'attendanceemployee' ? 'active dash-trigger' : ''); ?>">
                                        <a class="dash-link" href="#"><?php echo e(__('Attendance Management')); ?><span
                                                class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage leave')): ?>
                                                <li
                                                    class="dash-item <?php echo e(Request::route()->getName() == 'leave.index' ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('leave.index')); ?>"><?php echo e(__('Manage Leave')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage attendance')): ?>
                                                <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'attendanceemployee' ? 'active dash-trigger' : ''); ?>"
                                                    href="#navbar-attendance" data-toggle="collapse" role="button"
                                                    aria-expanded="<?php echo e(Request::segment(1) == 'attendanceemployee' ? 'true' : 'false'); ?>">
                                                    <a class="dash-link" href="#"><?php echo e(__('Attendance')); ?><span
                                                            class="dash-arrow"><i
                                                                data-feather="chevron-right"></i></span></a>
                                                    <ul class="dash-submenu">
                                                        <li
                                                            class="dash-item <?php echo e(Request::route()->getName() == 'attendanceemployee.index' ? 'active' : ''); ?>">
                                                            <a class="dash-link"
                                                                href="<?php echo e(route('attendanceemployee.index')); ?>"><?php echo e(__('Mark Attendance')); ?></a>
                                                        </li>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create attendance')): ?>
                                                            <li
                                                                class="dash-item <?php echo e(Request::route()->getName() == 'attendanceemployee.bulkattendance' ? 'active' : ''); ?>">
                                                                <a class="dash-link"
                                                                    href="<?php echo e(route('attendanceemployee.bulkattendance')); ?>"><?php echo e(__('Bulk Attendance')); ?></a>
                                                            </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                                <?php if(Gate::check('manage set salary') || Gate::check('manage pay slip')): ?>
                                   
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage set salary')): ?>
                                                <li
                                                    class="dash-item <?php echo e(request()->is('setsalary*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('setsalary.index')); ?>"><?php echo e(__('Salary Payment Entry')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage pay slip')): ?>
                                                <li class="dash-item <?php echo e(request()->is('payslip*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('payslip.index')); ?>"><?php echo e(__('Salary Payment Report')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                       
                                <?php endif; ?>

                               
                             

                            


                        </ul>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <!--------------------- End HRM ----------------------------------->

          


        <!--------------------- Start Project ----------------------------------->

        <?php if(!empty($userPlan) &&  $userPlan->project == 1): ?>
            <?php if(Gate::check('manage project')): ?>
                <li
                    class="dash-item dash-hasmenu
                                            <?php echo e(Request::segment(1) == null ||
                               
                                Request::segment(1) == 'income report' ||
                                Request::segment(1) == 'report' ||
                                Request::segment(1) == 'reports-monthly-cashflow' ||
                                Request::segment(1) == 'reports-quarterly-cashflow' ||
                                Request::segment(1) == 'reports-payroll' ||
                                Request::segment(1) == 'reports-leave' ||
                                Request::segment(1) == 'reports-monthly-attendance' ||
                                Request::segment(1) == 'reports-lead' ||
                                Request::segment(1) == 'reports-deal' ||
                                Request::segment(1) == 'pos-dashboard' ||
                                Request::segment(1) == 'reports-warehouse' ||
                                Request::segment(1) == 'reports-daily-purchase' ||
                                Request::segment(1) == 'reports-monthly-purchase' ||
                                Request::segment(1) == 'reports-daily-pos' ||
                                Request::segment(1) == 'reports-monthly-pos' ||
                                Request::segment(1) == 'reports-pos-vs-purchase'
                                    ? 'active dash-trigger'
                                    : ''); ?>">
                    <a href="<?php echo e(route('reports.dashboard')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-share"></i></span><span
                            class="dash-mtext"><?php echo e(__('Reports')); ?></span><span class="dash-arrow"><i
                                data-feather="chevron-right"></i></span></a>
                    <ul class="dash-submenu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project')): ?>
                            <li
                                class="dash-item  <?php echo e(Request::segment(1) == 'project' || Request::route()->getName() == 'projects.list' || Request::route()->getName() == 'projects.list' || Request::route()->getName() == 'projects.index' || Request::route()->getName() == 'projects.show' || request()->is('projects/*') ? 'active' : ''); ?>">
                                <a class="dash-link" href="#"><?php echo e(__('Sales & CRM Reports')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project task')): ?>
                            <li class="dash-item <?php echo e(request()->is('taskboard*') ? 'active' : ''); ?>">
                                <a class="dash-link"
                                    href="#"><?php echo e(__('Production Report')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage timesheet')): ?>
                            <li class="dash-item <?php echo e(request()->is('timesheet-list*') ? 'active' : ''); ?>">
                                <a class="dash-link" href="#"><?php echo e(__('Purchase & Management Report')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bug report')): ?>
                            <li class="dash-item <?php echo e(request()->is('bugs-report*') ? 'active' : ''); ?>">
                                <a class="dash-link" href="#"><?php echo e(__('Inventory Report')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project task')): ?>
                            <li class="dash-item <?php echo e(request()->is('calendar*') ? 'active' : ''); ?>">
                                <a class="dash-link"
                                    href="#"><?php echo e(__('Service & Management Report')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(\Auth::user()->type != 'super admin'): ?>
                            <li class="dash-item  <?php echo e(Request::segment(1) == 'time-tracker' ? 'active open' : ''); ?>">
                                <a class="dash-link" href="#"><?php echo e(__('Finance Report')); ?></a>
                            </li>
                        <?php endif; ?>
                       <?php if(\Auth::user()->type == 'company' || \Auth::user()->type == 'Employee'): ?>
                            <li
                                class="dash-item  <?php echo e(Request::route()->getName() == 'project_report.index' || Request::route()->getName() == 'project_report.show' ? 'active' : ''); ?>">
                                <a class="dash-link"
                                    href="<?php echo e(route('project_report.index')); ?>"><?php echo e(__('Project Report')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(Gate::check('manage project task stage') || Gate::check('manage bug status')): ?>
                            <li
                                class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'bugstatus' || Request::segment(1) == 'project-task-stages' ? 'active dash-trigger' : ''); ?>">
                                <a class="dash-link" href="#"><?php echo e(__('Project System Setup')); ?><span
                                        class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                <ul class="dash-submenu">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project task stage')): ?>
                                        <li
                                            class="dash-item  <?php echo e(Request::route()->getName() == 'project-task-stages.index' ? 'active' : ''); ?>">
                                            <a class="dash-link"
                                                href="<?php echo e(route('project-task-stages.index')); ?>"><?php echo e(__('Project Task Stages')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bug status')): ?>
                                        <li
                                            class="dash-item <?php echo e(Request::route()->getName() == 'bugstatus.index' ? 'active' : ''); ?>">
                                            <a class="dash-link"
                                                href="<?php echo e(route('bugstatus.index')); ?>"><?php echo e(__('Bug Status')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?> 
                    </ul>
                </li>
            <?php endif; ?>
        <?php endif; ?>

        <!--------------------- End Project ----------------------------------->
        <!--------------------- Start Project ----------------------------------->

   

        <!--------------------- End Project ----------------------------------->



        <!--------------------- Start User Managaement System ----------------------------------->

     <?php if(
    \Auth::user()->type != 'super admin' &&
        (Gate::check('manage user') || Gate::check('manage role') || Gate::check('manage client'))): ?>
  <li
        class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'users' ||
        Request::segment(1) == 'roles' ||
        Request::segment(1) == 'clients' ||
        Request::segment(1) == 'userlogs'
            ? ' active dash-trigger'
            : ''); ?>">

        <a href="#!" class="dash-link "><span class="dash-micon"><i
                    class="ti ti-users"></i></span><span
                class="dash-mtext"><?php echo e(__('Role Management')); ?></span><span class="dash-arrow"><i
                    data-feather="chevron-right"></i></span></a>
        <ul class="dash-submenu">
           
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage role')): ?>
            
                <li
                    class="dash-item <?php echo e(Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'roles.create' || Request::route()->getName() == 'roles.edit' ? ' active' : ''); ?> ">
                    <a class="dash-link" href="<?php echo e(route('roles.index')); ?>"><?php echo e(__('Role')); ?></a>
                </li>
            <?php endif; ?>
           
                                               <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage user')): ?>
                                                   <li class="dash-item <?php echo e((Request::route()->getName() == 'users.index' || Request::segment(1) == 'users' || Request::route()->getName() == 'users.edit') ? ' active' : ''); ?>">
                                                       <a class="dash-link" href="<?php echo e(route('user.userlog')); ?>"><?php echo e(__('User Logs')); ?></a>
                                                   </li>
                                               <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

        <!--------------------- End User Managaement System----------------------------------->





    
       

     

        <!--------------------- Start System Setup ----------------------------------->

        <?php if(\Auth::user()->type != 'super admin'): ?>
            <?php if(Gate::check('manage company plan') || Gate::check('manage order') || Gate::check('manage company settings')): ?>
                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'settings' ||
                    Request::segment(1) == 'plans' ||
                    Request::segment(1) == 'stripe' ||
                    Request::segment(1) == 'order'
                        ? ' active dash-trigger'
                        : ''); ?>">
                    <a href="#!" class="dash-link">
                        <span class="dash-micon"><i class="ti ti-settings"></i></span><span
                            class="dash-mtext"><?php echo e(__('Settings')); ?></span>
                        <span class="dash-arrow">
                            <i data-feather="chevron-right"></i>
                            </span>
                    </a>
                  <ul class="dash-submenu">
                        <?php if(Gate::check('manage company settings')): ?>
                            <li
                                class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'settings' ? ' active' : ''); ?>">
                                <a href="<?php echo e(route('settings')); ?>"
                                    class="dash-link"><?php echo e(__('System Settings')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(Gate::check('manage company plan')): ?>
                            <li
                                class="dash-item<?php echo e(Request::route()->getName() == 'terms-group.index' || Request::route()->getName() == 'stripe' ? ' active' : ''); ?>">
                                <a href="<?php echo e(route('terms-group.index')); ?>"
                                    class="dash-link"><?php echo e(__('Add Terms & Conditions')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(Gate::check('manage order') && Auth::user()->type == 'company'): ?>
                            <li class="dash-item <?php echo e(Request::segment(1) == 'order' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('terms-variant.index')); ?>" class="dash-link"><?php echo e(__('Add Terms detail')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
        <?php endif; ?>




        <!--------------------- End System Setup ----------------------------------->
        </ul>
        <?php endif; ?>
        <?php if(\Auth::user()->type == 'client'): ?>
            <ul class="dash-navbar">
                <?php if(Gate::check('manage client dashboard')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'dashboard' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('client.dashboard.view')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-home"></i></span><span
                                class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage deal')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'deals' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('deals.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-rocket"></i></span><span
                                class="dash-mtext"><?php echo e(__('Deals')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage contract')): ?>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::route()->getName() == 'contract.index' || Request::route()->getName() == 'contract.show' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('contract.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-rocket"></i></span><span
                                class="dash-mtext"><?php echo e(__('Contract')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage project')): ?>
                    <li class="dash-item dash-hasmenu  <?php echo e(Request::segment(1) == 'projects' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('projects.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-share"></i></span><span
                                class="dash-mtext"><?php echo e(__('Project')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage project')): ?>
                    <li
                        class="dash-item  <?php echo e(Request::route()->getName() == 'project_report.index' || Request::route()->getName() == 'project_report.show' ? 'active' : ''); ?>">
                        <a class="dash-link" href="<?php echo e(route('project_report.index')); ?>">
                            <span class="dash-micon"><i class="ti ti-chart-line"></i></span><span
                                class="dash-mtext"><?php echo e(__('Project Report')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('manage project task')): ?>
                    <li class="dash-item dash-hasmenu  <?php echo e(Request::segment(1) == 'taskboard' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('taskBoard.view', 'list')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-list-check"></i></span><span
                                class="dash-mtext"><?php echo e(__('Tasks')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('manage bug report')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'bugs-report' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('bugs.view', 'list')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-bug"></i></span><span
                                class="dash-mtext"><?php echo e(__('Bugs')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('manage timesheet')): ?>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'timesheet-list' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('timesheet.list')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-clock"></i></span><span
                                class="dash-mtext"><?php echo e(__('Timesheet')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('manage project task')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'calendar' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('task.calendar', ['all'])); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-calendar"></i></span><span
                                class="dash-mtext"><?php echo e(__('Task Calender')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="dash-item dash-hasmenu">
                    <a href="<?php echo e(route('support.index')); ?>"
                        class="dash-link <?php echo e(Request::segment(1) == 'support' ? 'active' : ''); ?>">
                        <span class="dash-micon"><i class="ti ti-headphones"></i></span><span
                            class="dash-mtext"><?php echo e(__('Support')); ?></span>
                    </a>
                </li>
            </ul>
        <?php endif; ?>
        <?php if(\Auth::user()->type == 'super admin'): ?>
            <ul class="dash-navbar">
                <?php if(Gate::check('manage super admin dashboard')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'dashboard' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('client.dashboard.view')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-home"></i></span><span
                                class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage user')): ?>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('users.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-users"></i></span><span
                                class="dash-mtext"><?php echo e(__('Companies')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('manage plan')): ?>
                    <li class="dash-item dash-hasmenu  <?php echo e(Request::segment(1) == 'plans' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('plans.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-trophy"></i></span><span
                                class="dash-mtext"><?php echo e(__('Plan')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(\Auth::user()->type == 'super admin'): ?>
                    <li class="dash-item dash-hasmenu <?php echo e(request()->is('plan_request*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('plan_request.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-arrow-up-right-circle"></i></span><span
                                class="dash-mtext"><?php echo e(__('Plan Request')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage coupon')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'coupons' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('coupons.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-gift"></i></span><span
                                class="dash-mtext"><?php echo e(__('Coupon')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage order')): ?>
                    <li class="dash-item dash-hasmenu  <?php echo e(Request::segment(1) == 'orders' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('order.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-shopping-cart-plus"></i></span><span
                                class="dash-mtext"><?php echo e(__('Order')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'email_template' || Request::route()->getName() == 'manage.email.language' ? ' active dash-trigger' : 'collapsed'); ?>">
                    <a href="<?php echo e(route('manage.email.language', [$emailTemplate->id, \Auth::user()->lang])); ?>"
                        class="dash-link">
                        <span class="dash-micon"><i class="ti ti-template"></i></span>
                        <span class="dash-mtext"><?php echo e(__('Email Template')); ?></span>
                    </a>
                </li>

                <?php if(\Auth::user()->type == 'super admin'): ?>
                    <?php echo $__env->make('landingpage::menu.landingpage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>

                <?php if(Gate::check('manage system settings')): ?>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::route()->getName() == 'systems.index' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('systems.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-settings"></i></span><span
                                class="dash-mtext"><?php echo e(__('Settings')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        <?php endif; ?>


        <div class="navbar-footer border-top ">
            <div class="d-flex align-items-center py-3 px-3 border-bottom">
                <div class="me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="29" height="30" viewBox="0 0 29 30"
                        fill="none">
                        <circle cx="14.5" cy="15.1846" r="14.5" fill="#6FD943"></circle>
                        <path opacity="0.4"
                            d="M22.08 8.66459C21.75 8.28459 21.4 7.92459 21.02 7.60459C19.28 6.09459 17 5.18461 14.5 5.18461C12.01 5.18461 9.73999 6.09459 7.98999 7.60459C7.60999 7.92459 7.24999 8.28459 6.92999 8.66459C5.40999 10.4146 4.5 12.6946 4.5 15.1846C4.5 17.6746 5.40999 19.9546 6.92999 21.7046C7.24999 22.0846 7.60999 22.4446 7.98999 22.7646C9.73999 24.2746 12.01 25.1846 14.5 25.1846C17 25.1846 19.28 24.2746 21.02 22.7646C21.4 22.4446 21.75 22.0846 22.08 21.7046C23.59 19.9546 24.5 17.6746 24.5 15.1846C24.5 12.6946 23.59 10.4146 22.08 8.66459ZM14.5 19.6246C13.54 19.6246 12.65 19.3146 11.93 18.7946C11.52 18.5146 11.17 18.1646 10.88 17.7546C10.37 17.0346 10.06 16.1346 10.06 15.1846C10.06 14.2346 10.37 13.3346 10.88 12.6146C11.17 12.2046 11.52 11.8546 11.93 11.5746C12.65 11.0546 13.54 10.7446 14.5 10.7446C15.46 10.7446 16.35 11.0546 17.08 11.5646C17.49 11.8546 17.84 12.2046 18.13 12.6146C18.64 13.3346 18.95 14.2346 18.95 15.1846C18.95 16.1346 18.64 17.0346 18.13 17.7546C17.84 18.1646 17.49 18.5146 17.08 18.8046C16.35 19.3146 15.46 19.6246 14.5 19.6246Z"
                            fill="#162C4E"></path>
                        <path
                            d="M22.08 8.66459L18.18 12.5746C18.16 12.5846 18.15 12.6046 18.13 12.6146C17.84 12.2046 17.49 11.8546 17.08 11.5646C17.09 11.5446 17.1 11.5346 17.12 11.5146L21.02 7.60459C21.4 7.92459 21.75 8.28459 22.08 8.66459Z"
                            fill="#162C4E"></path>
                        <path
                            d="M11.9297 18.7947C11.9197 18.8147 11.9097 18.8347 11.8897 18.8547L7.98969 22.7647C7.60969 22.4447 7.24969 22.0847 6.92969 21.7047L10.8297 17.7947C10.8397 17.7747 10.8597 17.7647 10.8797 17.7547C11.1697 18.1647 11.5197 18.5147 11.9297 18.7947Z"
                            fill="#162C4E"></path>
                        <path
                            d="M11.9297 11.5746C11.5197 11.8546 11.1697 12.2045 10.8797 12.6145C10.8597 12.6045 10.8497 12.5846 10.8297 12.5746L6.92969 8.66453C7.24969 8.28453 7.60969 7.92453 7.98969 7.60453L11.8897 11.5146C11.9097 11.5346 11.9197 11.5546 11.9297 11.5746Z"
                            fill="#162C4E"></path>
                        <path
                            d="M22.08 21.7046C21.75 22.0846 21.4 22.4446 21.02 22.7646L17.12 18.8546C17.1 18.8346 17.09 18.8246 17.08 18.8046C17.49 18.5146 17.84 18.1646 18.13 17.7546C18.15 17.7646 18.16 17.7746 18.18 17.7946L22.08 21.7046Z"
                            fill="#162C4E"></path>
                    </svg>
                </div>
                <div>
                    <b class="d-block f-w-700"><?php echo e(__('You need help?')); ?></b>
                    <span><?php echo e(__('Check out our repository')); ?> </span>
                </div>
            </div>
        </div>
    </div>
</div>
</nav>
<?php /**PATH C:\xampp\htdocs\_trumen\resources\views/partials/admin/menu.blade.php ENDPATH**/ ?>
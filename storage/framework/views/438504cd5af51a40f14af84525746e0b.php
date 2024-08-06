<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Leads')); ?> <?php if($pipeline): ?> - <?php echo e($pipeline->name); ?> <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <style>
    /* Hide default arrow */
    input[type="text"]::-webkit-input-placeholder {
         color: var(--color-customColor);
    font-weight: bold;
    }
    input:-moz-placeholder {
  color: red; /* Change to your desired color */
  opacity: 1; /* Adjust as needed */
}
    .dataTable-container{
            margin-top: -15px;
    }
    .dataTable-table tbody tr td {
        padding: 7px 0px 7px 0px;
    }
/* General button styles */
.import-btn,.export-btn {
    border-radius: 12px;
    box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.2), 0 2px 5px 0 rgba(0, 0, 0, 0.19);
    text-align: center;
    display: flex;
    align-items: center;
    padding: 10px 15px; /* Adjust padding to fit image and text */
}

/* Specific styles for the import and export buttons */
.import-btn {
    margin-right: 10px;
}

.export-btn {
    margin-left: 10px;
}
.pagination {
    padding: 5px 7px 10px 29px;
}
.dataTable-bottom{
    display: none;
}
/* Image styles */
.icon-img {
    height: 13px; /* Adjust height as needed */
    margin-right: 8px; /* Space between image and text */
}
#choices-multiple4{
 background: #ffffff url("https://trumen.truelymatch.com/assets/images/down-arrow.png") no-repeat right 0.75rem center / 8px 5px;
     font-weight: bold;
}

}
/* .table tr thead th:last-child {*/
/* border-top-right-radius: 30px !important;*/
/* border-bottom-right-radius: 30px !important; */

/*}*/
/*.table tr th:first-child {*/

/*  border-top-left-radius: 30px;*/
/*  border-bottom-left-radius: 30px;*/
/*}*/

  .card:not(.table-card) .table tr th:first-child {
   
    border-top-left-radius: 30px !important;
    border-bottom-left-radius: 30px !important;
}

  .card:not(.table-card) .table tr th:last-child {
   
    border-top-right-radius: 30px !important;
    border-bottom-right-radius: 30px !important;
}
        .number-color {
           width: 60px;
            height: 58px;
            border-radius: 10px 0px 0px 10px;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-top: -24px !important;
            margin-left: -25px !important;
            margin-bottom: -18px !important;
        
        }
       
table.inputs td {
    padding: 5px;
}
.dataTable-table {
    table-layout: auto;
}
.dataTable-top {
  padding: 14px 25px;
}
.hover-content { 
    display: none; 
} 
 
/* Display the hover content when hovering over the trigger */ 
.hover-trigger:hover + .hover-content { 
    display: block; 
} 

.slider-container {
    width: 100%;
    overflow: hidden;
    position: relative;
}
.z-0{
    display:none;
}
.slider {
    display: flex;
    transition: transform 0.3s ease-in-out;
}

.menu-item {
    min-width: 200px;
    margin: 10px;
    padding: 20px;
    color: white;
    /*text-align: center;*/
    border-radius: 4px;
    user-select: none;
    cursor: pointer;
    transition: background-color 0.3s;
}
.menu-items {
    min-width: 100px;
    margin: 10px;
    padding: 20px;
    color: white;
    /*text-align: center;*/
    border-radius: 4px;
    user-select: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

/*.menu-item:hover {*/
/*    background-color: #0056b3;*/
/*}*/


.parent{
  width:1500px;
/*  border:5px solid red;*/
  overflow-x: hidden; 
  float:left;
}
.child{
  width:2000px;
   float:left;
  font-size:15px;
  font-family:arial;
  padding:10px;
  cursor: pointer;
}
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
   <script>
    $(document).ready(function () {
        $(".relative").css('color', '#ff5000')
        $(".leading-5").css('padding', '20px')
        let mouseDown = false;
        let startX, scrollLeft;
        const slider = document.querySelector('.parent');
        
        const startDragging = (e) => {
          mouseDown = true;
          startX = e.pageX - slider.offsetLeft;
          scrollLeft = slider.scrollLeft;
        }
        
        const stopDragging = (e) => {
          mouseDown = false;
        }
        
        const move = (e) => {
          e.preventDefault();
          if(!mouseDown) { return; }
          const x = e.pageX - slider.offsetLeft;
          const scroll = x - startX;
          slider.scrollLeft = scrollLeft - scroll;
        }
        
        // Add the event listeners
        slider.addEventListener('mousemove', move, false);
        slider.addEventListener('mousedown', startDragging, false);
        slider.addEventListener('mouseup', stopDragging, false);
        slider.addEventListener('mouseleave', stopDragging, false);
        });
    </script>
    <script>
        $(document).on("change", ".change-pipeline select[name=default_pipeline_id]", function () {
            $('#change-pipeline').submit();
        });
        
    $(document).ready(function () {
    $('#lead_table').DataTable({
        "searching": true,
        "pageLength": 50,
        "paging": true,
        "info": false,
        "fixedHeader": {
        	"headerOffset": 75
        }
    })
    
});
$(document).ready(function() {
    
    
    $('.dataTable-input').val('<?php echo e($key); ?>')
    
    $('.dataTable-input').keyup(function(event) {
      
         var searchVal = $(this).val()
         $('#search').val(searchVal)   
            event.preventDefault();
            if($(this).val().length == 4)
            {
                event.preventDefault();
            $('#search_filter').submit();
            }else{
                event.preventDefault();
            $('#search_filter').submit(); 
            }
            console.log('1');
        
      
    });
});

    $(document).ready(function() {
         $('#datepicker').attr('placeholder', 'Date').css('color', 'red');
// Changes to the inputs will trigger a redraw to update the table
     $(".loader").fadeOut(10, function() {
        $(".content").show();        
    });
        
$('.choices__inner').css({
    'border-radius': '15px',
    'color': 'var(--color-customColor)',
    'font-weight': 'bold'
});
     $(document).on('change', '.state-select', function () {
            var state_id = $(this).val();
        //   alert(state_id);
            var url = '<?php echo e(route('city')); ?>'
           var $citySelect = $(this).siblings('.city-select');
       
            getCities(url,state_id, $citySelect);
        });
      function getCities(url, state_id, $citySelect) {
        //   alert(state_id);
        //  $('#choices-multiple4').attr('placeholder', 'Select a city').css('color', 'black');
        $('#choices-multiple4').css('color', 'black');
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                   
                    'state_id': state_id,
                    'session_key': session_key
                },
                success: function (data) {
                    // console.log(data)
                    
                    
                  $('#choices-multiple4').css('color', 'dark');
                    $('#choices-multiple4').empty();
                    
                 $('#choices-multiple4').append('<option value="">select city</option>');    
                $.each(data.data, function(index, city) {
                  
               $('#choices-multiple4').append('<option value="' + city.name + '">' + city.name + '</option>');
            });
             $('#choices-multiple4').removeAttr('readonly');
            

            // Initialize Select2 after populating the options
            
                }
            });
        }
        
        


    // Your CSS styling goes here
     $('#datepicker').datepicker();
     $('.choices__placeholder').css('opacity', '1');
     $('.choices__input').addClass('text-primary');
     $('#choices-multiple4').css('color', 'var(--color-customColor)');
     
       // $('.page-header-title').css('display', 'none');
        $('.choices__list--dropdown').css('color', 'dark');
       
        $('.choices__placeholder').attr('placeholder', 'Enter your text here').css('color', 'red');
       
         $('#datepicker').attr('placeholder', 'Date').css('color', 'red');
        //$('.dataTable-top').css('display', 'none');
         $('.dataTable-dropdown').css('display', 'none');
         $('.dataTable-input').css({'height': '45px', 'width': '250px'});
       
        $("#calendar_icon").on("click",function(){
          $('#datepicker').focus();
        })
   
    $(document).on("click", ".hover-trigger", function () {
        
        $(this).parent().find(".hover-content").css('display', 'block');
        $(this).css('display', 'none');
    });
     $(document).on("change", "#datepicker", function () {
        
        var f_date = $(this).val();
        $("#f_date").val(f_date);
       
    });
    $(document).on("change", "#choices-multiple3", function () {
        
        var f_assignedby = $(this).val();
        $("#f_assignedby").val(f_assignedby);
       
    });
    $(document).on("change", "#choices-multiple4", function () {
        
        var f_city = $(this).val();
        $("#f_city").val(f_city);
       
    });
    $(document).on("change", "#choices-multiple5", function () {
        
        var f_state = $(this).val();
        $("#f_state").val(f_state);
       
    });
     $(document).on("click", ".hover-content", function () {
        
        $(this).parent().find(".hover-trigger").css('display', 'block');
        $(this).css('display', 'none');
    });
    
    
    
});

    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('breadcrumb'); ?>

    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('leads.list')); ?>"><?php echo e(__('Lead list')); ?></a></li>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
<div class="loader"></div>
<?php
    // Get all parameters from the request
    $params = request()->all();

    // Define expected keys
    $expectedKeys = ['date', 'user_id', 'products', 'stage_id', 'industry_id', 'state_id', 'city_id'];

    // Ensure all expected keys are present, even if they are empty
    foreach ($expectedKeys as $key) {
        if (!array_key_exists($key, $params)) {
            $params[$key] = '';
        }
    }
   
?>
    <?php if($pipeline): ?>
    <div class="card content">
   <div class="row" style="padding:21px;">
    <div class="col-md-4 d-flex align-items-center justify-content-start">
        <a href="<?php echo e(route('leads.create')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Add New Lead')); ?>" class="btn btn-outline-light text-primary" style="margin-left: 15px;box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.2), 0 2px 5px 0 rgba(0, 0, 0, 0.19); text-align: center;font-weight:bold">
            <i class="ti ti-plus" style="border: 1px solid;border-radius:5px;"></i>&nbsp;&nbsp;&nbsp;<?php echo e(__('Add New Lead')); ?>

        </a>
    </div>
  <div class="col-md-8 d-flex align-items-center justify-content-end">
    <div class="d-flex">
        <a href="#" data-size="md" data-bs-toggle="tooltip" title="<?php echo e(__('Import')); ?>" data-url="<?php echo e(route('leads.file.import')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Import Lead CSV file')); ?>" class="btn btn-lg btn-primary mr-2 ml-3 import-btn">
            <img src="<?php echo e(asset('assets/images/dashboard/upload-icon.png')); ?>" alt="" class="icon-img">
            <?php echo e(__('Import')); ?>

        </a>
        <a href="<?php echo e(route('leads.export', ['filterData' => $params])); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>" class="btn btn-lg btn-dark ml3 export-btn">
           
            <img src="<?php echo e(asset('assets/images/dashboard/download-icon.png')); ?>" alt="" class="icon-img">
            <?php echo e(__('Export')); ?>

        </a>
    </div>
</div>

</div>

<!--<div class="preload"><img src="http://i.imgur.com/KUJoe.gif"></div>-->
              <?php 
               $data = $date !='null'?$date:'Date';
               ?>

             
        <div class="row ">
            
                 <?php echo e(Form::open(array('url' => 'leads/search','method'=> 'GET', 'id'=> 'leade_filter'))); ?>

               <div class="row" style="margin:-2px;">
                  
                    <div class="col-sm-1 form-group" style="padding: 0px 0px 0px 10px;">
                         <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('leade_filter').submit(); return false;" data-bs-toggle="tooltip" title="" data-original-title="apply" data-bs-original-title="Apply" style="padding: 10px 24px 10px 26px;float: inline-end;">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                        <!--<span style="float: inline-end;cursor:pointer"><i class="ti ti-filter" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="<?php echo e(__('Search')); ?>" data-bs-toggle="tooltip" class="btn btn-primary text-primary form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='var(--color-customColor)';"></span>-->
                      
                   </div>
            
            <div class="col-sm-2 form-group" style="position: relative;">
              
                    <input type="text" class="form-control text-primary" name="date" value="<?php echo e($data); ?>" placeholder="Date" title="<?php echo e(__('Date')); ?>" data-bs-toggle="tooltip" id="datepicker" style="border-radius: 15px; padding-right: 30px;font-weight: bold;margin-left: -30px;float: inline-end;line-height: 1.8;width:100%;color:var(--color-customColor)">
                    <i class="bx bx-calendar text-primary" id="calendar_icon" style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%);cursor:pointer;"></i>
                </div>

                    <input type="hidden" value="0" id="f_date" name="f_date">
                    <input type="hidden" value="0" id="f_assignedby" name="f_assignedby">
                    <input type="hidden" value="0" id="f_city" name="f_city">
                    <input type="hidden" value="0" id="f_state" name="f_state">
                  
                        
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        <?php echo e(Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3'))); ?>

                   </div>
                    <div class="col-sm-3 form-group">
                       <?php echo e(Form::select('products', $products,'null', array('class' => 'form-control select2', 'id'=>'choices-multiple2'))); ?>

                   </div> 
                   <div class="col-sm-3 form-group">
                       <?php echo e(Form::select('stage_id', $stages,null, array('class' => 'form-control select2','id'=>'choices-multiple1'))); ?>

                   </div>
                   
                  
            </div>
             <div class="row" style="">
                      
                    
                    <div class="col-lg-3 form-group bdr" style="margin-left:53px;">
                       <?php echo e(Form::select('industry_id', $industry,null, array('class' => 'form-control select2','id'=>'choices-multiple6'))); ?>

                   </div>
                  <div class="col-lg-3 form-group bdr">
                       <?php echo e(Form::select('state_id', $states,null, array('class' => 'form-control select2 state-select','id'=>'choices-multiple5'))); ?>

                   </div>
                   <div class="col-lg-3 form-group bdr">
                       <?php echo e(Form::select('city_id',[],null, array('class' => 'form-control  choices__inner city-select','id'=>'choices-multiple4', 'readonly', 'placeholder'=> 'City', 'style'=>'height: 45px;'))); ?>

                   </div>
                  <div class="col-lg-3 form-group">
                       
                   </div>
                  
            </div>

             <?php echo e(Form::close()); ?>

               <?php echo e(Form::open(array('url' => 'leads/searchSingle','method'=> 'GET', 'id'=> 'search_filter'))); ?>

                 <input type="hidden" value="0" id="search" name="search">
               <?php echo e(Form::close()); ?>

            <div class="col-xl-12 " style="margin-top: -42px;">
               <h4 class=""><a href="#" class="text-dark" style="font-weight: bolder;margin-left: 20px;margin-top: 50px;position:absolute;margin-bottom: -20px;"><?php echo e(__('Recent Search')); ?></a>
            </h4>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                           
                            <table class="table datatable" id="lead_table">
                                <thead class="thead-dark">
                                <tr>
                                    <th style="border-top-left-radius: 30px;border-bottom-left-radius: 30px;"><?php echo e(__('Sr.')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Company Name')); ?> </th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Product Name')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Assigned to')); ?></th>
                                    <th><?php echo e(__('City')); ?></th>
                                    <th><?php echo e(__('State')); ?></th>
                                   
                                    <th><?php echo e(__('Actions')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                   
                                <?php if(count($leads) > 0): ?>
                                    <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <?php
                                    $cName = !empty($lead->customer)?$lead->customer->billing_name:'-';
                                   
                                    ?>
                                        <tr style="margin-top:30px;background:#F8FAFB;">
                                          
                                            <td>
                                                   
                                               <div class="number-color ms-2" style="font-size:12px;background-color: <?php echo e(!empty($lead->stage)?$lead->stage->color:'#f5d538'); ?>">
                                                   <?php echo e($lead->id); ?></div> 
                                                </td>
                                            <td><?php echo e(\Carbon\Carbon::parse($lead->date)->format('d/m/Y')); ?></td>
                                            <td>
                                                <div class="hover-content"><?php echo e($lead->industry_name); ?></div>
                                                <div class="hover-trigger"><?php echo e(\Illuminate\Support\Str::limit($lead->industry_name, $limit = 15, $end = '...')); ?></div></td>
                                            <td><?php echo e(\Illuminate\Support\Str::limit($cName, $limit = 15, $end = '...')); ?></td>
                                             
                                              <td>
                                               <?php if($lead->is_indiamart == 0 || is_numeric($lead->products)): ?>
                                                 <?php if(!empty($lead->products())): ?>
                                                 <?php $__currentLoopData = $lead->products(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                  <div class="hover-content">
                                                 <?php echo e($product->name); ?>

                                                 
                                                   <?php if(!$loop->last): ?>
                                                        ,
                                                    <?php endif; ?>
                                                    </div>
                                                <div class="hover-trigger">
                                                 <?php echo e(\Illuminate\Support\Str::limit($product->name, $limit = 15, $end = '...')); ?>

                                                 
                                                   <?php if(!$loop->last): ?>
                                                        ,
                                                    <?php endif; ?>
                                                   </div>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   <?php else: ?>
                                                   -
                                                   <?php endif; ?>
                                                 <?php else: ?> 
                                                 <div class="hover-content">
                                                 <?php echo e($lead->products); ?>

                                                 
                                                 
                                                    </div>
                                                 <div class="hover-trigger">
                                                 <?php echo e(\Illuminate\Support\Str::limit($lead->products, $limit = 15, $end = '...')); ?>

                                                  </div>
                                                <?php endif; ?>
                                                  </td>
                                             
                                           
                                            <td><?php echo e(!empty($lead->stage)?$lead->stage->name:'-'); ?></td>
                                            <td><?php echo e($lead->uname != ''?$lead->uname:'-'); ?></td>
                                            <td><?php echo e(!empty($lead->customer)?$lead->customer->billing_city:'-'); ?></td>
                                            <td><?php echo e(!empty($lead->customer)?$lead->customer->billing_state:'-'); ?></td>
                                            
                                            <?php if(Auth::user()->type != 'client'): ?>
                                                <td class="Action">
                                                    <span>
                                                         <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit lead')): ?>
                                                            <div class="action-btn bg-light ms-2">
                                                                <a href="<?php echo e(route('leads.edit',$lead->id)); ?>" class="mx-3 d-inline-flex align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Lead Edit')); ?>">
                                                                    <i class="ti ti-pencil text-dark"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                   
                                                           
                                                                <div class="action-btn bg-light ms-2">
                                                                <a href="<?php echo e(route('leads.show',$lead->id)); ?>" class="mx-3 d-inline-flex align-items-center"  data-size="xl" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" data-title="<?php echo e(__('Lead Detail')); ?>">
                                                                    <i class="ti ti-eye text-dark"></i>
                                                                </a>
                                                            </div>
                                                          
                                                        
                                                       
                                                       
                                                    </span>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr class="font-style">
                                        <td colspan="10" class="text-center"><?php echo e(__('No data available in table')); ?></td>
                                    </tr>
                                <?php endif; ?>

                                </tbody>
                            </table>
                             <?php echo e($leads->appends(Request::except('page'))->links()); ?>

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\_trumen\resources\views/leads/list.blade.php ENDPATH**/ ?>
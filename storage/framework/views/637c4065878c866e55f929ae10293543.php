<?php $__env->startSection('page-title'); ?>
   <?php echo e(__('Create Products')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dropzone.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('productservice.index')); ?>"><?php echo e(__('Product')); ?></a></li>
    <li class="breadcrumb-item"> <?php echo e(__('Create Products')); ?> </li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo e(Form::open(array('url' => 'productservice','enctype' => "multipart/form-data"))); ?>

<div class="modal-body" style="margin-top: 25px;">
    
    <?php
        $plan= \App\Models\Utility::getChatGPTSettings();
    ?>
  
    
    
      <div class="row shadow p-3 mb-5 bg-white rounded">
           
        <div class="col-md-4 form-group">
              <h5 class="mb-0"><?php echo e(__('Production Product Entry')); ?></h5>
        </div>
         <div class="col-md-6 form-group">
             <label for="pro_image" class="form-label custom-file-upload" style="float: inline-end;">
                <i class="ti ti-upload">upload product image</i>
                </label>
           
        </div>
        
              
           
      
        <div class="col-md-2 form-group">
             <button type="submit" class="btn-sm btn btn-primary custom-file-uploadss" style="border: none;"><i class="ti ti-send"></i><?php echo e(__('Save')); ?></button>
        </div>
        
        
        <div class="form-group col-md-3">
            <?php echo e(Form::label('group_id', __('Category'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('group_id', $group,null, array('class' => 'form-control select','id' => 'group', 'required'=>'required'))); ?>


            <div class=" text-xs">
                <?php echo e(__('Please add constant category. ')); ?><a data-size="md" data-url="<?php echo e(route('groups.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" href="#"><b><?php echo e(__('Add Category')); ?></b></a>
            </div>
        </div>
        <div class="form-group col-md-3">
            <?php echo e(Form::label('model', __('Model'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('product_model', $model,null, array('class' => 'form-control select', 'id' => 'product_model', 'required'=>'required'))); ?>


            <div class=" text-xs">
                <?php echo e(__('Add model')); ?>:<a href="#" data-size="sm" data-url="<?php echo e(route('product-models.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create New Model')); ?>"><b><?php echo e(__('Add Model')); ?></b></a>
            </div>
        </div>
         <div class="form-group col-md-6">
            
                <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required', 'placeholder' => 'Enter Product Name'))); ?>

            
        </div> 
        
       
        <div class="col-md-8">
            <div class="form-group">
                <?php echo e(Form::label('specification-series', __('Specifications order'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('hsn_code', '', array('class' => 'form-control','required'=>'required', 'placeholder' => 'EX-TLH Hxx Pxx Cx Dxx Bxxx Lxxxx', 'readonly', 'id' => 'ordering-serise'))); ?>

            </div>
        </div>
         <div class="form-group col-md-4">
            <div class="col-sm-12 commp">
               <?php echo e(Form::label('integral', __('Is Integral/Split/Flexible'),['class'=>'form-label'])); ?><br>
                Is Integral/Split/Flexible:  <input type="checkbox" name="is_integral">
            </div>
        </div> 
        <div id="main-specification-div" class="row">
        
         </div>
          <div class="card repeater d-none service-model" data-value=''>
                <div class="item-section py-2">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                            <div class="all-button-box me-2">
                                <a href="#" data-repeater-create="" class="btn btn-primary" data-bs-toggle="modal" data-target="#add-bank">
                                    <i class="ti ti-plus"></i> <?php echo e(__('Add item')); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
               
               
            </div>
      </div>
      
      <div class="row shadow p-3 mb-5 bg-white rounded" id="specification-materials">
            <h5 class="mb-0" id="new-app"><?php echo e(__('Used Material Entry/BOM')); ?></h5>
          
       
         <div class="col-md-3 comm-div">
            <div class="form-group">
                <?php echo e(Form::label('material', __('Material'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('unit_rate', 'XXX', array('class' => 'form-control','required'=>'required', 'readonly'))); ?>

                <?php echo e(Form::hidden('model', '', array('class' => 'form-control','required'=>'required', 'readonly', 'id' => 'model-name'))); ?>

            </div>
        </div>
        <div class="col-md-3 comm-div">
            <div class="form-group">
                <?php echo e(Form::label('unit_rate', __('Unit Rate'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('unit_rate', '0.00', array('class' => 'form-control','required'=>'required','step'=>'0.01', 'readonly'))); ?>

            </div>
        </div>
         <div class="col-md-3 comm-div">
            <div class="form-group">
                <?php echo e(Form::label('material_quantity', __('Quantity'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('material_quantity', '1', array('class' => 'form-control','required'=>'required','step'=>'1', 'readonly'))); ?>

            </div>
        </div>
         <div class="col-md-3 comm-div">
            <div class="form-group">
                <?php echo e(Form::label('material_total_price', __('Total'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('unit_rate', '0.00', array('class' => 'form-control','required'=>'required', 'readonly'))); ?>

            </div>
        </div>

       
        
       

        <?php if(!$customFields->isEmpty()): ?>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    <?php echo $__env->make('customFields.formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
     <div class="row shadow p-3 mb-5 bg-white rounded">
            <h5 class="mb-0" id="new-app"><?php echo e(__('Production & Amount Details')); ?></h5>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo e(Form::label('createdby', __('Production In Charge'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('createdby', auth()->user()->name, array('class' => 'form-control','required'=>'required', 'readonly'))); ?>

            </div>
        </div> 
        
        <div class="col-md-3">
            <div class="form-group">
                <?php echo e(Form::label('base_price', __('Base Price (INR)'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('base_price','0.00', array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>    
        <div class="col-md-3">
            <div class="form-group">
                <?php echo e(Form::label('base_price_usd', __('Base Price (USD)'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('base_price_usd','0.00', array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>    
        <div class="col-md-3">
            <div class="form-group">
                <?php echo e(Form::label('base_price_euro', __('Base Price (EURO)'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('base_price_euro','0.00', array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>    
         
         <div class="col-md-3">
            <div class="form-group">
                <?php echo e(Form::label('material_cost', __('Material Cost'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('purchase_price', '0.00', array('class' => 'form-control','required'=>'required', 'readonly', 'id'=>'material_cost'))); ?>

            </div>
        </div>
         <div class="col-md-3">
            <div class="form-group">
                <?php echo e(Form::label('labor_charge', __('Labor Cost'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('labor_charge', '0.00', array('class' => 'form-control number-input','required'=>'required','step'=>'1','min'=> '0','max'=>'1000', 'id'=>'labor_charge'))); ?>

            </div>
        </div>
         <div class="col-md-3">
            <div class="form-group">
                <?php echo e(Form::label('other_cost', __('Other Cost'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::number('other_cost', '0.00', array('class' => 'form-control number-input','required'=>'required','step'=>'1','min'=> '0','max'=>'1000', 'id'=>'other_cost'))); ?>

            </div>
        </div>
         <div class="col-md-3">
            <div class="form-group">
                <?php echo e(Form::label('grand_total', __('Total INR'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('sale_price', '0.00', array('class' => 'form-control','required'=>'required','step'=>'1','min'=> '0', 'id'=>'grand_total'))); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo e(Form::label('usd_grand_total', __('Total USD'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('usd_price', '0.00', array('class' => 'form-control','required'=>'required','step'=>'1','min'=> '0', 'id'=>'usd_grand_total'))); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo e(Form::label('euro_grand_total', __('Total EURO'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('euro_price', '0.00', array('class' => 'form-control','required'=>'required','step'=>'1','min'=> '0', 'id'=>'euro_grand_total'))); ?>

            </div>
        </div>
         <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

            <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']); ?>

        </div>
         <div class="col-md-12 form-group text-center">
            <div class="choose-file d-none" id="image-preview">
                 <input type="file" class="form-control" name="pro_image" id="pro_image" data-filename="pro_image_create" style="display: none;">
                    <img id="image" class="mt-3" style="width:25%;"/>
            </div>  
         </div>
        </div>
</div>


<?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>
<!-- Modal HTML -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>This is a modal!</p>
  </div>
</div>

<!-- Button to trigger modal -->

<?php $__env->startPush('script-page'); ?>
<script>
    document.getElementById('pro_image').onchange = function () {
        // alert("dsf")
        $('#image').removeClass('d-none')
         $('#image-preview').removeClass('d-none')
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('image').src = src
    }

    //hide & show quantity
  function appendDiv() {
       $('.service-model').removeClass('d-none')
      
  }
    $(document).on('click', '.type', function ()
    {
        var type = $(this).val();
        if (type == 'product') {
            $('.quantity').removeClass('d-none')
            $('.quantity').addClass('d-block');
        } else {
            $('.quantity').addClass('d-none')
            $('.quantity').removeClass('d-block');
        }
    });
   
    
     $(document).on('change', '.material_quantity', function ()
    {
        var qty = $(this).val();
        var dataId = $(this).data('id');
        var unit_rate = $("#unit_rate-"+dataId).val();
       
        var sub_total = qty * unit_rate;
        console.log(qty)
        console.log(dataId)
        console.log(unit_rate)
        console.log(sub_total)
        $("#material_total_price-"+dataId).val(sub_total);
       var sum = 0;
       var qty = 0;
        $('.number-input').each(function(){
            var value = parseFloat($(this).val()); // Parse the value to float
            if (!isNaN(value)) { // Check if the value is a valid number
                sum += value;
            }
        });
        $("#total_price").val(sum)
        $("#unit_rate").val(sum)
        $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
        $("#quantity").val(qty)
    });
    
    //sum of materials price
    
    $(document).on('change', '#labor_charge', function ()
    {
       
        var tprice = $("#total_price").val();
        var uprice = $("#unit_rate").val();
       
        var mcost = $("#material_cost").val();
        var gtotal = parseFloat($("#grand_total").val());                
        var lcost = parseFloat($(this).val());
        var sub =  gtotal+lcost;
        $("#grand_total").val(sub); 
    });
    
     $(document).on('change', '#other_cost', function ()
        {
         
        var tprice = $("#total_price").val();
        var uprice = $("#unit_rate").val();
       
        var mcost = $("#material_cost").val();
        var gtotal = parseFloat($("#grand_total").val());                
        var ocost = parseFloat($(this).val());
        var sub = gtotal+ocost;
        $("#grand_total").val(sub); 
    });
     $(document).on('change', '#product_model', function () {
       
        var type = $(this).val();
      
        var name = $("#product_model option:selected").text();
        
            $("#ordering-serise").val(name);
            // $("#model-name").val(name);
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecification')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                $('#main-specification-div').empty();
                $('.comm-div-first').empty();
                $(".comm-div").removeClass('d-none');
                $("#total_price").val('0.00');
                $("#unit_rate").val('0.00');
                $("#quantity").val('0.00');
                $("#material_cost").val('0.00');
                $("#grand_total").val('0.00');
                $("#other_cost").val('0.00');
                $("#labor_charge").val('0.00');
                $("#usd_grand_total").val('0.00');
                $("#euro_grand_total").val('0.00');
                $.each(data, function (key, value) {
                    if(key == 'img')
                    {
                        $('#image-preview').append(value);
                    }else{
                        $('#main-specification-div').append(value); 
                    }
                   
                    
                });
            }

        });
    });
    $(document).on('change', '.group-material-0', function () {
        var id = $(this).val();
        var type = $("#product_model").val();
        var mName = $("#product_model option:selected").text();
        var idValue =$(this).attr('id');
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        // var tab = $(this).data('id');
         var tab = 'Temperature0';
        $(".comm-div").addClass('d-none');
        $('.group-material-1').removeAttr('disabled');
       
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationMaterials')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                     var firstChild = $('#specification-materials').children().first();
                    //  firstChild.after(data);
                     if ($("#specification-materials").find('.Temperature0')) {
                            // Class "myClass" exists in the element with id "myElement"
                            // var $outerDiv = $(outerDivId);
                        $('#specification-materials .Temperature0').each(function(i){
                                 // do stuff
                                  
                                 $(this).remove();
                        });
                        // Find the inner div within the outer div
                            // var $innerDiv = $outerDiv.find(innerDivClass);
                            //  var $innerDiv  = $('#specification-materials').find('.Temperature2')
                            // Remove the old content of the inner div and append new content
                            var newContent = "<p>This is the new content.</p>";
                             firstChild.after(data); 
                                console.log("myClass exists in #myElement");
                            } else {
                                // Class "myClass" does not exist in the element with id "myElement"
                                 firstChild.after(data); 
                                
                            }
                    // $('#specification-materials').append(data);
                        var sum = 0;
                        var usd_sum = 0;
                        var euro_sum = 0;
                        $('.number-input').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                sum += value;
                            }
                            });
                        $('.number-inputs').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                usd_sum += value;
                            }
                            });
                        $('.number-inputss').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                euro_sum += value;
                            }
                            });    
                            $("#total_price").val(sum);
                            $("#unit_rate").val(sum);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            $("#usd_grand_total").val(usd_sum);
                            $("#euro_grand_total").val(euro_sum);
                            var qty = 0;
                        $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                            var serise =  $("#ordering-serise").val();
                            // var serise =  $("#ordering-serise").val();
                             var arr = serise.split('-');
                             console.log("arr-"+arr); 
                              console.log("len-"+arr.length);  console.log("seri-"+serise); 
                              
                            if(arr.length  >= 1)
                            {
                              console.log(arr.length);  
                              arr[0] = $('.prefix-input').eq(0).val();
                               console.log("seri-"+arr.join("-")); 
                               var innns = $("#ordering-serise").val(mName+': '+arr.join("-")); 
                              
                            }else
                            {
                                 $('.prefix-input').each(function(){
                            var value = $(this).val(); // Parse the value to float
                           
                            $("#ordering-serise").val(serise+': '+value);
                            if (!isNaN(value)) { // Check if the value is a valid number
                                serise = serise+': '+value;
                                
                            }
                            });
                            //   $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());   
                            }
                           
                            var idValue =$(this).attr('id');

                            if (idValue === 'print_img') {
                                // Do something if the id value matches the desired value
                                $('#image-preview').removeClass('d-none');
                            }
                            
                           
               
            }

        });
    });
    $(document).on('change', '.group-material-1', function () {
        var id = $(this).val();
        var type = $("#product_model").val();
        var idValue =$(this).attr('id');
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        // var tab = $(this).data('id');
        var tab = 'Temperature1';
        $(".comm-div").addClass('d-none');
        $('.group-material-2').removeAttr('disabled');
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationMaterials')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                 "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                 var firstChild = $('#specification-materials').children().first();
                   
                    //  firstChild.after(data); 
                    var aname= tab.split(" ");
                    // var tabClass =  '.'+aname[0];
                        
                        var outerDivId = "#specification-materials";
                        var innerDivClass = ".Temperature";
                        if ($("#specification-materials").find('.Temperature1')) {
                            // Class "myClass" exists in the element with id "myElement"
                            // var $outerDiv = $(outerDivId);
                        $('#specification-materials .Temperature1').each(function(i){
                                 // do stuff
                                  
                                 $(this).remove();
                        });
                        // Find the inner div within the outer div
                            // var $innerDiv = $outerDiv.find(innerDivClass);
                            //  var $innerDiv  = $('#specification-materials').find('.Temperature1')
                            // Remove the old content of the inner div and append new content
                            var newContent = "<p>This is the new content.</p>";
                             firstChild.after(data); 
                                console.log("myClass exists in #myElement");
                            } else {
                                // Class "myClass" does not exist in the element with id "myElement"
                                 firstChild.after(data); 
                                
                            }
                     
                    
                        var qty = 0;
                        var sum = 0;
                        var usd_sum = 0;
                        var euro_sum = 0;
                        $('.number-input').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                sum += value;
                            }
                            });
                        $('.number-inputs').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                usd_sum += value;
                            }
                            });
                        $('.number-inputss').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                euro_sum += value;
                            }
                            });    
                            $("#total_price").val(sum);
                            $("#unit_rate").val(sum);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            $("#usd_grand_total").val(usd_sum);
                            $("#euro_grand_total").val(euro_sum);
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                            var serise =  $("#ordering-serise").val();
                             var arr = serise.split('-');
                             console.log("arr-"+arr); 
                              console.log("len-"+arr.length);  console.log("seri-"+serise); 
                              
                            if(arr.length  >= 2)
                            {
                              console.log(arr.length);  
                              arr[1] = $('.prefix-input').eq(0).val();
                               console.log("seri-"+arr.join("-")); 
                               var innns = $("#ordering-serise").val(arr.join("-")); 
                              
                            }else
                            {
                              $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());   
                            }
                           
                            var idValue =$(this).attr('id');

                            if (idValue === 'print_img') {
                                // Do something if the id value matches the desired value
                                $('#image-preview').removeClass('d-none');
                            }
               
            }

        });
    });
     $(document).on('change', '.group-material-2', function () {
        var id = $(this).val();
        var type = $("#product_model").val();
        var idValue =$(this).attr('id');
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        // var tab = $(this).data('id');
          var tab = 'Temperature2';
        $(".comm-div").addClass('d-none');
         $('.group-material-3').removeAttr('disabled');
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationMaterials')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                 "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                // $('#specification-materials').empty();
               
                   var firstChild = $('#specification-materials').children().first();
                    //  firstChild.after(data);
                     if ($("#specification-materials").find('.Temperature2')) {
                            // Class "myClass" exists in the element with id "myElement"
                            // var $outerDiv = $(outerDivId);
                        $('#specification-materials .Temperature2').each(function(i){
                                 // do stuff
                                  
                                 $(this).remove();
                        });
                        // Find the inner div within the outer div
                            // var $innerDiv = $outerDiv.find(innerDivClass);
                            //  var $innerDiv  = $('#specification-materials').find('.Temperature2')
                            // Remove the old content of the inner div and append new content
                            var newContent = "<p>This is the new content.</p>";
                             firstChild.after(data); 
                                console.log("myClass exists in #myElement");
                            } else {
                                // Class "myClass" does not exist in the element with id "myElement"
                                 firstChild.after(data); 
                                
                            }
                    var qty = 0;
                        var sum = 0;
                        var usd_sum = 0;
                        var euro_sum = 0;
                        $('.number-input').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                sum += value;
                            }
                            });
                        $('.number-inputs').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                usd_sum += value;
                            }
                            });
                        $('.number-inputss').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                euro_sum += value;
                            }
                            });    
                            $("#total_price").val(sum);
                            $("#unit_rate").val(sum);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            $("#usd_grand_total").val(usd_sum);
                            $("#euro_grand_total").val(euro_sum);
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                            // var serise =  $("#ordering-serise").val();
                            var serise =  $("#ordering-serise").val();
                            var arr = serise.split('-');
                             console.log("arr-"+arr); 
                              console.log("len-"+arr.length);  console.log("seri-"+serise); 
                              
                            if(arr.length  >= 3)
                            {
                              console.log(arr.length);  
                              arr[2] = $('.prefix-input').eq(0).val();
                               console.log("seri-"+arr.join("-")); 
                               var innns = $("#ordering-serise").val(arr.join("-")); 
                              
                            }else
                            {
                              $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());   
                            }
                            // $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());
                            var idValue =$(this).attr('id');

                            if (idValue === 'print_img') {
                                // Do something if the id value matches the desired value
                                $('#image-preview').removeClass('d-none');
                            }
               
            }

        });
    });
     $(document).on('change', '.group-material-3', function () {
        var id = $(this).val();
        var type = $("#product_model").val();
        var idValue =$(this).attr('id');
                    
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        // var tab = $(this).data('id');
          var tab = 'Temperature3';
        $(".comm-div").addClass('d-none');
         $('.group-material-4').removeAttr('disabled');
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationMaterials')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                 "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                // $('#specification-materials').empty();
               
                    var firstChild = $('#specification-materials').children().first();
                    //  firstChild.after(data);
                     if ($("#specification-materials").find('.Temperature3')) {
                            // Class "myClass" exists in the element with id "myElement"
                            // var $outerDiv = $(outerDivId);
                        $('#specification-materials .Temperature3').each(function(i){
                                 // do stuff
                                  
                                 $(this).remove();
                        });
                        // Find the inner div within the outer div
                            // var $innerDiv = $outerDiv.find(innerDivClass);
                            //  var $innerDiv  = $('#specification-materials').find('.Temperature3')
                            // Remove the old content of the inner div and append new content
                            var newContent = "<p>This is the new content.</p>";
                             firstChild.after(data); 
                                console.log("myClass exists in #myElement");
                            } else {
                                // Class "myClass" does not exist in the element with id "myElement"
                                 firstChild.after(data); 
                                
                            }
                    var qty = 0;
                        var sum = 0;
                        var usd_sum = 0;
                        var euro_sum = 0;
                        $('.number-input').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                sum += value;
                            }
                            });
                        $('.number-inputs').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                usd_sum += value;
                            }
                            });
                        $('.number-inputss').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                euro_sum += value;
                            }
                            });    
                            $("#total_price").val(sum);
                            $("#unit_rate").val(sum);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            $("#usd_grand_total").val(usd_sum);
                            $("#euro_grand_total").val(euro_sum);
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                           
                            // $('.prefix-input').each(function(index, value){
                            // var value = $(this).val(); // Parse the value to float
                            var serise =  $("#ordering-serise").val();
                            var arr = serise.split('-');
                             console.log("arr-"+arr); 
                              console.log("len-"+arr.length);  console.log("seri-"+serise); 
                              
                            if(arr.length  >= 4)
                            {
                              console.log(arr.length);  
                              arr[3] = $('.prefix-input').eq(0).val();
                               console.log("seri-"+arr.join("-")); 
                               var innns = $("#ordering-serise").val(arr.join("-")); 
                              
                            }else
                            {
                              $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());   
                            }
                            // $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());
                        

                           
               
            }

        });
    });
     $(document).on('change', '.group-material-4', function () {
        var id = $(this).val();
        var type = $("#product_model").val();
        // var tab = $(this).data('id');
        var tab = 'Temperature4';
        var idValue =$(this).attr('id');
                    
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        $(".comm-div").addClass('d-none');
         $('.group-material-5').removeAttr('disabled');
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationMaterials')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                 "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                // $('#specification-materials').empty();
               
                    var firstChild = $('#specification-materials').children().first();
                    //  firstChild.after(data);
                     if ($("#specification-materials").find('.Temperature4')) {
                            // Class "myClass" exists in the element with id "myElement"
                            // var $outerDiv = $(outerDivId);
                        $('#specification-materials .Temperature4').each(function(i){
                                 // do stuff
                                  
                                 $(this).remove();
                        });
                        // Find the inner div within the outer div
                            // var $innerDiv = $outerDiv.find(innerDivClass);
                            //  var $innerDiv  = $('#specification-materials').find('.Temperature2')
                            // Remove the old content of the inner div and append new content
                            var newContent = "<p>This is the new content.</p>";
                             firstChild.after(data); 
                                console.log("myClass exists in #myElement");
                            } else {
                                // Class "myClass" does not exist in the element with id "myElement"
                                 firstChild.after(data); 
                                
                            }
                        var qty = 0;
                        var sum = 0;
                        var usd_sum = 0;
                        var euro_sum = 0;
                        $('.number-input').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                sum += value;
                            }
                            });
                        $('.number-inputs').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                usd_sum += value;
                            }
                            });
                        $('.number-inputss').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                euro_sum += value;
                            }
                            });    
                            $("#total_price").val(sum);
                            $("#unit_rate").val(sum);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            $("#usd_grand_total").val(usd_sum);
                            $("#euro_grand_total").val(euro_sum);
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                             var serise =  $("#ordering-serise").val();
                              var arr = serise.split('-');
                             console.log("arr-"+arr); 
                              console.log("len-"+arr.length);  console.log("seri-"+serise); 
                              
                            if(arr.length  >= 5)
                            {
                              console.log(arr.length);  
                              arr[4] = $('.prefix-input').eq(0).val();
                               console.log("seri-"+arr.join("-")); 
                               var innns = $("#ordering-serise").val(arr.join("-")); 
                              
                            }else
                            {
                              $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());   
                            }
                            // $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());
                            
               
            }

        });
    });
     $(document).on('change', '.group-material-5', function () {
        var id = $(this).val();
         var tab = 'Temperature5'; 
        var type = $("#product_model").val();
        var idValue =$(this).attr('id');
                    
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        // var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
         $('.group-material-6').removeAttr('disabled');
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationMaterials')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                 "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                // $('#specification-materials').empty();
               
                    var firstChild = $('#specification-materials').children().first();
                    //  firstChild.after(data);
                     if ($("#specification-materials").find('.Temperature5')) {
                            // Class "myClass" exists in the element with id "myElement"
                            // var $outerDiv = $(outerDivId);
                        $('#specification-materials .Temperature5').each(function(i){
                                 // do stuff
                                  
                                 $(this).remove();
                        });
                        // Find the inner div within the outer div
                            // var $innerDiv = $outerDiv.find(innerDivClass);
                            //  var $innerDiv  = $('#specification-materials').find('.Temperature2')
                            // Remove the old content of the inner div and append new content
                            var newContent = "<p>This is the new content.</p>";
                             firstChild.after(data); 
                                console.log("myClass exists in #myElement");
                            } else {
                                // Class "myClass" does not exist in the element with id "myElement"
                                 firstChild.after(data); 
                                
                            }
                        var qty = 0;
                        var sum = 0;
                        var usd_sum = 0;
                        var euro_sum = 0;
                        $('.number-input').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                sum += value;
                            }
                            });
                        $('.number-inputs').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                usd_sum += value;
                            }
                            });
                        $('.number-inputss').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                euro_sum += value;
                            }
                            });    
                            $("#total_price").val(sum);
                            $("#unit_rate").val(sum);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            $("#usd_grand_total").val(usd_sum);
                            $("#euro_grand_total").val(euro_sum);
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                            var serise =  $("#ordering-serise").val();
                            var arr = serise.split('-');
                             console.log("arr-"+arr); 
                              console.log("len-"+arr.length);  console.log("seri-"+serise); 
                              
                            if(arr.length  >= 6)
                            {
                              console.log(arr.length);  
                              arr[5] = $('.prefix-input').eq(0).val();
                               console.log("seri-"+arr.join("-")); 
                               var innns = $("#ordering-serise").val(arr.join("-")); 
                              
                            }else
                            {
                              $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());   
                            }
                            
                           
                           
               
            }

        });
    });
    $(document).on('change', '.group-material-6', function () {
        var id = $(this).val();
        var type = $("#product_model").val();
        var idValue =$(this).attr('id');
         var tab = 'Temperature6';              
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                           }
        // var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
         $('.group-material-7').removeAttr('disabled');
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationMaterials')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                // $('#specification-materials').empty();
               
                    var firstChild = $('#specification-materials').children().first();
                    //  firstChild.after(data);
                     if ($("#specification-materials").find('.Temperature6')) {
                            // Class "myClass" exists in the element with id "myElement"
                            // var $outerDiv = $(outerDivId);
                        $('#specification-materials .Temperature6').each(function(i){
                                 // do stuff
                                  
                                 $(this).remove();
                        });
                        // Find the inner div within the outer div
                            // var $innerDiv = $outerDiv.find(innerDivClass);
                            //  var $innerDiv  = $('#specification-materials').find('.Temperature2')
                            // Remove the old content of the inner div and append new content
                            var newContent = "<p>This is the new content.</p>";
                             firstChild.after(data); 
                                console.log("myClass exists in #myElement");
                            } else {
                                // Class "myClass" does not exist in the element with id "myElement"
                                 firstChild.after(data); 
                                
                            }
                        var qty = 0;
                        var sum = 0;
                        var usd_sum = 0;
                        var euro_sum = 0;
                        $('.number-input').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                sum += value;
                            }
                            });
                        $('.number-inputs').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                usd_sum += value;
                            }
                            });
                        $('.number-inputss').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                euro_sum += value;
                            }
                            });    
                            $("#total_price").val(sum);
                            $("#unit_rate").val(sum);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            $("#usd_grand_total").val(usd_sum);
                            $("#euro_grand_total").val(euro_sum);
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                            var serise =  $("#ordering-serise").val();
                             var arr = serise.split('-');
                             console.log("arr-"+arr); 
                              console.log("len-"+arr.length);  console.log("seri-"+serise); 
                              
                            if(arr.length  >= 7)
                            {
                              console.log(arr.length);  
                              arr[6] = $('.prefix-input').eq(0).val();
                               console.log("seri-"+arr.join("-")); 
                               var innns = $("#ordering-serise").val(arr.join("-")); 
                              
                            }else
                            {
                              $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());   
                            }
                            // $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());
                           
               
            }

        });
    });
    $(document).on('change', '.group-material-7', function () {
        var id = $(this).val();
        var type = $("#product_model").val();
        var idValue =$(this).attr('id');
         var tab = 'Temperature7';           
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                              }
        // var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
         $('.group-material-8').removeAttr('disabled');
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationMaterials')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                // $('#specification-materials').empty();
               
                    var firstChild = $('#specification-materials').children().first();
                    //  firstChild.after(data);
                     if ($("#specification-materials").find('.Temperature7')) {
                            // Class "myClass" exists in the element with id "myElement"
                            // var $outerDiv = $(outerDivId);
                        $('#specification-materials .Temperature7').each(function(i){
                                 // do stuff
                                  
                                 $(this).remove();
                        });
                        // Find the inner div within the outer div
                            // var $innerDiv = $outerDiv.find(innerDivClass);
                            //  var $innerDiv  = $('#specification-materials').find('.Temperature2')
                            // Remove the old content of the inner div and append new content
                            var newContent = "<p>This is the new content.</p>";
                             firstChild.after(data); 
                                console.log("myClass exists in #myElement");
                            } else {
                                // Class "myClass" does not exist in the element with id "myElement"
                                 firstChild.after(data); 
                                
                            }
                        var qty = 0;
                        var sum = 0;
                        var usd_sum = 0;
                        var euro_sum = 0;
                        $('.number-input').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                sum += value;
                            }
                            });
                        $('.number-inputs').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                usd_sum += value;
                            }
                            });
                        $('.number-inputss').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                euro_sum += value;
                            }
                            });    
                            $("#total_price").val(sum);
                            $("#unit_rate").val(sum);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            $("#usd_grand_total").val(usd_sum);
                            $("#euro_grand_total").val(euro_sum);
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                            var serise =  $("#ordering-serise").val();
                             var arr = serise.split('-');
                             console.log("arr-"+arr); 
                              console.log("len-"+arr.length);  console.log("seri-"+serise); 
                              
                            if(arr.length  >= 8)
                            {
                              console.log(arr.length);  
                              arr[7] = $('.prefix-input').eq(0).val();
                               console.log("seri-"+arr.join("-")); 
                               var innns = $("#ordering-serise").val(arr.join("-")); 
                              
                            }else
                            {
                              $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());   
                            }
                            // $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());
                           
               
            }

        });
    });
     $(document).on('change', '.group-material-8', function () {
        var id = $(this).val();
        var type = $("#product_model").val();
        var idValue =$(this).attr('id');
         var tab = 'Temperature8';             
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        // var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
         $('.group-material-9').removeAttr('disabled');
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationMaterials')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                // $('#specification-materials').empty();
               
                    var firstChild = $('#specification-materials').children().first();
                    //  firstChild.after(data);
                     if ($("#specification-materials").find('.Temperature8')) {
                            // Class "myClass" exists in the element with id "myElement"
                            // var $outerDiv = $(outerDivId);
                        $('#specification-materials .Temperature8').each(function(i){
                                 // do stuff
                                  
                                 $(this).remove();
                        });
                        // Find the inner div within the outer div
                            // var $innerDiv = $outerDiv.find(innerDivClass);
                            //  var $innerDiv  = $('#specification-materials').find('.Temperature2')
                            // Remove the old content of the inner div and append new content
                            var newContent = "<p>This is the new content.</p>";
                             firstChild.after(data); 
                                console.log("myClass exists in #myElement");
                            } else {
                                // Class "myClass" does not exist in the element with id "myElement"
                                 firstChild.after(data); 
                                
                            }
                        var qty = 0;
                        var sum = 0;
                        var usd_sum = 0;
                        var euro_sum = 0;
                        $('.number-input').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                sum += value;
                            }
                            });
                        $('.number-inputs').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                usd_sum += value;
                            }
                            });
                        $('.number-inputss').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                euro_sum += value;
                            }
                            });    
                            $("#total_price").val(sum);
                            $("#unit_rate").val(sum);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            $("#usd_grand_total").val(usd_sum);
                            $("#euro_grand_total").val(euro_sum);
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                            var serise =  $("#ordering-serise").val();
                             var arr = serise.split('-');
                             console.log("arr-"+arr); 
                              console.log("len-"+arr.length);  console.log("seri-"+serise); 
                              
                            if(arr.length  >= 9)
                            {
                              console.log(arr.length);  
                              arr[8] = $('.prefix-input').eq(0).val();
                               console.log("seri-"+arr.join("-")); 
                               var innns = $("#ordering-serise").val(arr.join("-")); 
                              
                            }else
                            {
                              $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());   
                            }
                            // $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());
                           
               
            }

        });
    });
     $(document).on('change', '.group-material-9', function () {
        var id = $(this).val();
        var type = $("#product_model").val();
        var idValue =$(this).attr('id');
         var tab = 'Temperature9';             
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        // var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
         $('.group-material-10').removeAttr('disabled');
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationMaterials')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                // $('#specification-materials').empty();
               
                    var firstChild = $('#specification-materials').children().first();
                    //  firstChild.after(data);
                     if ($("#specification-materials").find('.Temperature9')) {
                            // Class "myClass" exists in the element with id "myElement"
                            // var $outerDiv = $(outerDivId);
                        $('#specification-materials .Temperature9').each(function(i){
                                 // do stuff
                                  
                                 $(this).remove();
                        });
                        // Find the inner div within the outer div
                            // var $innerDiv = $outerDiv.find(innerDivClass);
                            //  var $innerDiv  = $('#specification-materials').find('.Temperature2')
                            // Remove the old content of the inner div and append new content
                            var newContent = "<p>This is the new content.</p>";
                             firstChild.after(data); 
                                console.log("myClass exists in #myElement");
                            } else {
                                // Class "myClass" does not exist in the element with id "myElement"
                                 firstChild.after(data); 
                                
                            }
                        var qty = 0;
                        var sum = 0;
                        var usd_sum = 0;
                        var euro_sum = 0;
                        $('.number-input').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                sum += value;
                            }
                            });
                        $('.number-inputs').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                usd_sum += value;
                            }
                            });
                        $('.number-inputss').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                euro_sum += value;
                            }
                            });    
                            $("#total_price").val(sum);
                            $("#unit_rate").val(sum);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            $("#usd_grand_total").val(usd_sum);
                            $("#euro_grand_total").val(euro_sum);
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                            var serise =  $("#ordering-serise").val();
                             var arr = serise.split('-');
                             console.log("arr-"+arr); 
                              console.log("len-"+arr.length);  console.log("seri-"+serise); 
                              
                            if(arr.length  >= 10)
                            {
                              console.log(arr.length);  
                              arr[9] = $('.prefix-input').eq(0).val();
                               console.log("seri-"+arr.join("-")); 
                               var innns = $("#ordering-serise").val(arr.join("-")); 
                              
                            }else
                            {
                              $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());   
                            }
                            // $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());
                           
               
            }

        });
    });
     $(document).on('change', '.group-material-10', function () {
        var id = $(this).val();
        var type = $("#product_model").val();
        var idValue =$(this).attr('id');
         var tab = 'Temperature10';             
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        // var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
         $('.group-material-11').removeAttr('disabled');
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationMaterials')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                // $('#specification-materials').empty();
               
                    var firstChild = $('#specification-materials').children().first();
                    //  firstChild.after(data);
                     if ($("#specification-materials").find('.Temperature10')) {
                            // Class "myClass" exists in the element with id "myElement"
                            // var $outerDiv = $(outerDivId);
                        $('#specification-materials .Temperature10').each(function(i){
                                 // do stuff
                                  
                                 $(this).remove();
                        });
                        // Find the inner div within the outer div
                            // var $innerDiv = $outerDiv.find(innerDivClass);
                            //  var $innerDiv  = $('#specification-materials').find('.Temperature2')
                            // Remove the old content of the inner div and append new content
                            var newContent = "<p>This is the new content.</p>";
                             firstChild.after(data); 
                                console.log("myClass exists in #myElement");
                            } else {
                                // Class "myClass" does not exist in the element with id "myElement"
                                 firstChild.after(data); 
                                
                            }
                        var qty = 0;
                        var sum = 0;
                        var usd_sum = 0;
                        var euro_sum = 0;
                        $('.number-input').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                sum += value;
                            }
                            });
                        $('.number-inputs').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                usd_sum += value;
                            }
                            });
                        $('.number-inputss').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                euro_sum += value;
                            }
                            });    
                            $("#total_price").val(sum);
                            $("#unit_rate").val(sum);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            $("#usd_grand_total").val(usd_sum);
                            $("#euro_grand_total").val(euro_sum);
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                            var serise =  $("#ordering-serise").val();
                             var arr = serise.split('-');
                             console.log("arr-"+arr); 
                              console.log("len-"+arr.length);  console.log("seri-"+serise); 
                              
                            if(arr.length  >= 11)
                            {
                              console.log(arr.length);  
                              arr[10] = $('.prefix-input').eq(0).val();
                               console.log("seri-"+arr.join("-")); 
                               var innns = $("#ordering-serise").val(arr.join("-")); 
                              
                            }else
                            {
                              $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());   
                            }
                            // $("#ordering-serise").val(serise+' - '+$('.prefix-input').eq(0).val());
                           
               
            }

        });
    });

// get models by category  

$(document).on('change', '#group', function ()
    {
        var id = $(this).val();
        $.ajax({
            url: '<?php echo e(route('category.model')); ?>',
            type: 'GET',
            data: {
               
                "id": id,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                $('#product_model').empty();
                $('#product_model').append('<option value="">Select Model</option>');
                $.each(data.data, function(index, model) {
               $('#product_model').append('<option value="' + model.id + '">' + model.name + '</option>');
            });
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/productservice/create.blade.php ENDPATH**/ ?>
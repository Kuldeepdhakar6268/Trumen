@extends('layouts.admin')
@section('page-title')
   {{__('Create New Stock')}}
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/dropzone.min.css')}}">
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('materialstock.index')}}">{{__('Material Stock')}}</a></li>
    <li class="breadcrumb-item"> {{__('Create New Stock')}} </li>
@endsection
@section('content')
{{ Form::open(array('url' => 'materialstock','enctype' => "multipart/form-data")) }}
<div class="modal-body" style="margin-top: 25px;">
    {{-- start for ai module--}}
    @php
        $plan= \App\Models\Utility::getChatGPTSettings();
    @endphp
  
    {{-- end for ai module--}}
    
      <div class="row shadow p-3 mb-5 bg-white rounded">
           
        <div class="col-md-4 form-group">
              <h5 class="mb-0">{{__('')}}</h5>
        </div>
         <div class="col-md-6 form-group">
             <label for="pro_image" class="form-label" style="float: inline-end;">
               
                </label>
           
        </div>
        
              
           
      
        <div class="col-md-2 form-group">
             <button type="submit" class="btn-sm btn btn-primary custom-file-uploadss" style="border: none;"><i class="ti ti-send"></i>{{__('Save')}}</button>
        </div>
        
        <div class="form-group col-md-4">
            
                {{ Form::label('material_code', __('Material Code'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                {{ Form::text('material_code', '', array('class' => 'form-control','required'=>'required', 'placeholder' => 'Enter Material Code EX-TLC123')) }}
            
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('material_name', __('Material Name'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                {{ Form::text('material_name', null, array('class' => 'form-control','required'=>'required', 'placeholder' => 'Enter Material Name')) }}
            </div>
        </div>
         <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('purchased_qty', __('Purchased Quantity'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                {{ Form::number('purchased_qty','0', array('class' => 'form-control','required'=>'required', 'step'=>'1','min'=> '0',)) }}
            </div>
        </div> 
         <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('used_qty', __('Used in Production Quantity'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                {{ Form::number('used_qty','0', array('class' => 'form-control','required'=>'required','step'=>'1','min'=> '0',)) }}
            </div>
        </div> 
         <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('dead_material_qty', __('Dead Material Quantity'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                {{ Form::number('dead_material_qty', '0', array('class' => 'form-control','required'=>'required', 'step'=>'1','min'=> '0', 'id'=>'material_cost')) }}
            </div>
        </div>
         <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('unit_price', __('Unit Price'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                {{ Form::number('unit_price', '0.00', array('class' => 'form-control number-input','required'=>'required','step'=>'1','min'=> '0.00','max'=>'1000')) }}
            </div>
        </div>
         <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('current_qty', __('Current Quantity'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                {{ Form::number('current_qty',null, array('class' => 'form-control number-input','required'=>'required','step'=>'1','min'=> '0','max'=>'1000', 'id'=>'other_cost')) }}
            </div>
        </div>
         <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('stock_value', __('Stock Value'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                {{ Form::number('stock_value',null, array('class' => 'form-control','required'=>'required','step'=>'1','min'=> '0.00', 'id'=>'grand_total')) }}
            </div>
        </div>
        
         {{--<div class="col-md-12 form-group text-center">
            <div class="choose-file d-none" id="image-preview">
                 <input type="file" class="form-control" name="pro_image" id="pro_image" data-filename="pro_image_create" style="display: none;">
                    <img id="image" class="mt-3" style="width:25%;"/>
            </div>  
         </div>--}}
      </div>
    </div>
    
</div>

{{--<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
    <!--<input type="submit" value="{{__('Send for approval')}}" class="btn  btn-primary" name="sendforapp">-->
</div>--}}
{{Form::close()}}
@endsection
<!-- Modal HTML -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>This is a modal!</p>
  </div>
</div>

<!-- Button to trigger modal -->

@push('script-page')
<script>
    // document.getElementById('pro_image').onchange = function () {
    //     // alert("dsf")
    //     $('#image').removeClass('d-none')
    //      $('#image-preview').removeClass('d-none')
    //     var src = URL.createObjectURL(this.files[0])
    //     document.getElementById('image').src = src
    // }

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
    
    $(document).on('change', '#unit_price', function ()
    {
       
        var tprice = $("#purchased_qty").val();
        var uprice = $(this).val();
       
        var mcost = $("#material_cost").val();
        var gtotal = parseFloat($("#purchased_qty").val());                
        var lcost = parseFloat($(this).val());
        var sub =  gtotal*lcost;
        $("#grand_total").val(sub); 
    });
    
    
    
  

// get models by category  


</script>
@endpush

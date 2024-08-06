{{ Form::open(array('url' => 'productspecification','enctype' => "multipart/form-data")) }}
<div class="modal-body">
    {{-- start for ai module--}}
    @php
        $plan= \App\Models\Utility::getChatGPTSettings();
    @endphp
   {{-- @if($plan->chatgpt == 1)
    <div class="text-end">
        <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="{{ route('generate',['productservice']) }}"
           data-bs-placement="top" data-title="{{ __('Generate content with AI') }}">
            <i class="fas fa-robot"></i> <span>{{__('Generate with AI')}}</span>
        </a>
    </div>
    @endif --}}
    {{-- end for ai module--}}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('name', __('Name'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                {{ Form::text('name', '', array('class' => 'form-control','required'=>'required', 'placeholder'=>__('Enter Specification Name'))) }}
            </div>
        </div>
        {{--<div class="col-md-6 form-group">
            {{Form::label('pro_image',__('Product Image'),['class'=>'form-label'])}}
            <div class="choose-file ">
                <label for="pro_image" class="form-label">
                    <input type="file" class="form-control" name="pro_image" id="pro_image" data-filename="pro_image_create">
                    <img id="image" class="mt-3" style="width:25%;"/>

                </label>
            </div>
        </div>--}}
         <div class="form-group col-md-6">
            {{ Form::label('group_id', __('Category'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('group_id', $group,null, array('class' => 'form-control select','required'=>'required', 'id' => 'groups')) }}

            <div class=" text-xs">
                {{__('Please add constant category. ')}}<a data-size="md" data-url="{{ route('groups.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" href="#"><b>{{__('Add Category')}}</b></a>
            </div>
        </div>
        
        
        
         <div class="form-group col-md-2">
            {{ Form::label('product_model_id', __('Model'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('product_model_id', $model,null, array('class' => 'form-control select','required'=>'required', 'id' => 'product_model')) }}

            <div class=" text-xs">
                {{__('Please add constant model. ')}}<a data-size="md" data-url="{{ route('product-models.create') }}" data-ajax-popup="true" title="{{__('Create Model')}}" data-bs-toggle="tooltip" href="#"><b>{{__('Add Model')}}</b></a>
            </div>
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('el_mc', __('Choose one'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            <div class="form-group row" style="height: 2.3rem;">
                                         <div class="col-sm-4 commp"> Mechanical <input type="radio" name="check" value="mc"></div>
                                         <div class="col-sm-4 commp">Electronics <input type="radio" name="check" value="el"></div>
                                         <div class="col-sm-4 commp">Length <input type="checkbox" name="length" value="on"></div>
                                            
                                         
                                          
                                    </div>
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('el_mc', __('Parent'),['class'=>'form-label']) }}<span class="text-danger">*</span>
           <select class="form-control"name="parent" id="parent">
               <option>Choose options1</option>
               <option>Choose options2</option>
           </select>
         </div>
         <div class="form-group col-md-3">
            {{ Form::label('child_id', __('Child'),['class'=>'form-label']) }}<span class="text-danger">*</span>
           <select class="form-control"name="child_id" id="child">
               <option>Choose options1</option>
               <option>Choose options2</option>
           </select>
         </div>
        </div>
        <div id="divContainer"></div>
        <div class="form-group">
            <a class="btn btn-primary sm text-light" onclick="appendDiv()"><i class="ti ti-plus"></i> Add Sub-Specification</a>
         </div>
      
       
      
    </div>
     
     
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>
{{Form::close()}}


<script>
    // document.getElementById('pro_image').onchange = function () {
    //     var src = URL.createObjectURL(this.files[0])
    //     document.getElementById('image').src = src
    // }

    //hide & show quantity
  function appendDiv() {
        $('#divContainer').append('<div class="add_contact"><div class="row"><div class="col-md-2"><div class="form-group"><label for="prefix" class="form-label">BelongTo</label><input class="form-control" placeholder="Enter Belongs" name="belongs[]" type="text" id="belongs"></div></div><div class="col-md-1"><div class="form-group"><label for="prefix" class="form-label">Prefix</label><input class="form-control" placeholder="Enter Prefix" name="prefix[]" type="text" id="prefix_name"></div></div><div class="col-md-3"><div class="form-group"><label for="sub_specification" class="form-label">Details</label><input class="form-control" placeholder="Enter Sub Specification" name="sub_specification[]" type="text" id="sub_specification"></div></div><div class="col-md-2" style="width: 115px;"><div class="form-group"><label for="length_price" class="form-label">Length</label><input class="form-control" placeholder="Ex: L250" name="length_price[]" type="text" id="length"></div></div><div class="col-md-1" style="width: 115px;"><div class="form-group"><label for="price" class="form-label">INR</label><input class="form-control" placeholder="Price" name="price[]" type="text" id="price" value="0.00"></div></div><div class="col-md-1" style="width: 115px;"><div class="form-group"><label for="price" class="form-label">USD</label><input class="form-control" placeholder="Price" name="usd_price[]" type="text" id="usd_price" value="0.00"></div></div><div class="col-md-1" style="width: 115px;"><div class="form-group"><label for="price" class="form-label">EURO</label><input class="form-control" placeholder="Price" name="euro_price[]" type="text" id="euro_price" value="0.00"></div></div><div class="col-md-1" style="padding-top: 25px;padding-left: 0px;"><div class="form-group"><a class="mx-3 btn btn-primary sm  align-items-cente removeButton" title="remove"><label class="form-check-label " for="g_male"><i class="ti ti-trash text-white"></i></label></a></div></div></div></div>');
      
  }
  
   $(document).on('click', '.removeButton', function(e) {
   e.preventDefault();
   $(this).closest('.add_contact').remove();
   return true;
    });

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
    
    $(document).on('change', '#groups', function ()
    {
        var id = $(this).val();
        $.ajax({
            url: '{{route('category.model')}}',
            type: 'GET',
            data: {
               
                "id": id,
                "_token": "{{ csrf_token() }}",
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
     $(document).on('change', '#product_model', function ()
    {
        var id = $(this).val();
        $.ajax({
            url: '{{route('category.model.parent')}}',
            type: 'GET',
            data: {
               
                "id": id,
                "_token": "{{ csrf_token() }}",
            },

            success: function (data) {
                console.log(data);
                $('#parent').empty();
                $('#parent').append('<option value="">Select Model</option>');
                $.each(data.data, function(index, model) {
               $('#parent').append('<option value="' + model.id + '">' + model.name + '</option>');
            });
             $('#child').empty();
                $('#child').append('<option value="">Select parent for remark</option>');
                $.each(data.data, function(index, model) {
               $('#child').append('<option value="' + model.id + '">' + model.name + '</option>');
            });
            }
        });
    });
</script>

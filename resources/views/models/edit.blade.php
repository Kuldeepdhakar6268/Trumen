
{{ Form::model($model, array('route' => array('product-models.update', $model->id), 'method' => 'PUT','enctype' => "multipart/form-data")) }}
<div class="modal-body">
  
    @php
        $plan= \App\Models\Utility::getChatGPTSettings();
    @endphp
   
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('category_id', __('Category'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('group_id', $groups,null, array('class' => 'form-control select','id' => 'group', 'required'=>'required')) }}

            <div class=" text-xs">

                {{__('Please add constant category. ')}}<a data-size="md" data-url="{{ route('groups.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" href="#"><b>{{__('Add Category')}}</b></a>
            </div>
        </div>
       <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('name', __('Name'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                {{ Form::text('name', $model->name, array('class' => 'form-control','required'=>'required', 'placeholder'=>__('Enter Model Name'))) }}
            </div>
        </div>
        <input type="hidden" name="id" value="{{$model->id}}">
       
      

      
    </div>
 
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>
{{Form::close()}}



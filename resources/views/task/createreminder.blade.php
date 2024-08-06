{{ Form::open(array('url'=>'todos','method'=>'post')) }}
<div class="modal-body">
<div class="row">
    <div class="col-8">
        <div class="form-group">
            {{ Form::label('name', __('Task name'),['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control','required'=>'required']) }}
            {{ Form::hidden('reminder', 1, ['class' => 'form-control','required'=>'required']) }}
        </div>
    </div>
   
    <div class="col-12">
        <div class="form-group">
            {{ Form::label('description', __('Description'),['class' => 'form-label']) }}
            <small class="form-text text-muted mb-2 mt-0">{{__('This textarea will autosize while you type')}}</small>
            {{ Form::textarea('description', null, ['class' => 'form-control','rows'=>'1','data-toggle' => 'autosize']) }}
            {{ Form::hidden('hrs', null, ['class' => 'form-control','required' => 'required','min'=>'0','maxlength' => '8']) }}
            {{ Form::hidden('priority', 0, ['class' => 'form-control','required' => 'required','min'=>'0','maxlength' => '8']) }}
        </div>
    </div>
   
    <div class="col-6">
        <div class="form-group">
            {{ Form::label('start', __('Date'),['class' => 'form-label']) }}
            {{ Form::date('start', null, ['class' => 'form-control']) }}
             {{ Form::hidden('end', null, ['class' => 'form-control']) }}
        </div>
    </div>
   <div class="col-6">
        <div class="form-group">
            {{ Form::label('time', __('Time'),['class' => 'form-label']) }}
            {{ Form::time('time', null, ['class' => 'form-control']) }}
           
        </div>
    </div>
</div>

</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>
{{ Form::close() }}


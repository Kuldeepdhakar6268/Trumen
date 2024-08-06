@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/dropzone.min.css')}}">
   <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />

@endpush
<style>
input[type="text"]::-webkit-input-placeholder {
     color: #6c6d6e !important;
       font-weight: 500;
}
.note-editable{
    padding-top: 25px !important;
}
</style>
{{Form::model($quotation,array('route' => array('quotation.emails.send', $quotation->id), 'method' => 'post')) }}
<div class="modal-body">

   
    <div class="row">
        
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('email', __('To'),['class'=>'form-label']) }}
                 {{Form::textarea('email',$quotation->customer->email,array('class'=>'form-control' , 'rows' => '1', 'required' => 'required', 'placeholder'=>__('Enter Email Id')))}}
                  {{Form::hidden('id',$quotation->id,)}}
            </div>
        </div>
        
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('emails', __('CC'),['class'=>'form-label']) }} <span class="text-danger" style="font-size:12px;"> (Enter multiple emails with comma (,) seperator)</span>
                 {{Form::textarea('emails',null,array('class'=>'form-control' , 'rows' => '1', 'placeholder'=>__('Enter multiple emails')))}}
                
            </div>
        </div>
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('subject', __('Subject'),['class'=>'form-label']) }}
                 {{Form::textarea('subject',!empty($quotation->lead)?$quotation->lead->subject:'',array('class'=>'form-control' , 'rows' => '1', 'placeholder'=>__('Enter multiple emails')))}}
                  
            </div>
        </div>
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('notes', __('Content'),['class'=>'form-label']) }}
                 {{Form::textarea('notes',$desc,array('class'=>'form-control summernote-simple' , 'rows' => '4', 'placeholder'=>__('Enter multiple emails')))}}
                
            </div>
        </div>
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('pdf', __('Attached Quotation:'),['class'=>'form-label']) }} {!! $pdf_link !!}
                
                
            </div>
        </div>
         
    </div>
   

</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Send')}}" class="btn btn-primary">
</div>
{{Form::close()}}

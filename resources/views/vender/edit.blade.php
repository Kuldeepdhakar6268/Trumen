

@extends('layouts.admin')
@section('page-title')
    {{__('Add New Vendor')}}
@endsection
@section('breadcrumb')
     
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('vender.index')}}">{{__('Vendor')}}</a></li>
    <li class="breadcrumb-item">{{__('Vendor Create')}}</li>

   
@endsection
@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/dropzone.min.css')}}">
   <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <style>
   .iti{
       display: block;
   }
   </style>
@endpush
@push('script-page')
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/jquery.repeater.min.js')}}"></script>
    <script>
      

    
    </script>
@endpush

@section('content')
<div class="d-flex justify-content-end  " style="margin-top:-3rem; margin-bottom:2rem; ">


</div>
    <div class="row">
    {{Form::model($vender,array('route' => array('vender.update', $vender->id), 'method' => 'PUT')) }}
    <div style="width:100%;margin-bottom: 51px;">
    <button type="submit" style="padding:0.5rem 4rem 0.5rem 0.5rem;float: inline-end;" class="btn bg-dark  text-white d-flex gap-2  pr-4 align-items-center">
     <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M21 8V20.9932C21 21.5501 20.5552 22 20.0066 22H3.9934C3.44495 22 3 21.556 3 21.0082V2.9918C3 2.45531 3.4487 2 4.00221 2H14.9968L21 8ZM19 9H14V4H5V20H19V9Z"></path></svg>
         Save</button>
        </div> 
 <div class="modal-body shadow p-3  mb-5  bg-white rounded">
     <div class="d-flex justify-content-between align-items-center">
     <h6 class="sub-title fs-4">{{__('Vendor Information')}}</h6>
    
 </div>
     <div class="row ">
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('name',__('Company Name'),array('class'=>'form-label')) }}<span class="text-danger">*</span>
                 {{Form::text('name',$vender->company_name,array('class'=>'form-control','required'=>'required' , 'placeholder'=>__('M & S Gourav Gases')))}}
 
             </div>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('contact_person',__('Contact Person'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('contact_person',$vender->name,array('class'=>'form-control','required'=>'required' , 'placeholder' => __('Mahi Sharma')))}}
 
             </div>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('email',__('Email'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::email('email',null,array('class'=>'form-control','required'=>'required' , 'placeholder' => __('m&m@gmail.com')))}}
             </div>
         </div>
 
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('sector',__('Sector'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('sector',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('Sector')))}}
             </div>
         </div>
 
           <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('industry',__('Industry'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('industry',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('Manufacturing')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('tax_number',__('GSTIN'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('tax_number',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('213242453234')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('contact',__('Number'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('contact',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('9999999999')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('alternate',__('Alternative Number'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('alternate',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('9999999999')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('plot_number',__('Plot Number'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('plot_number',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('Dreamland 202')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('land_mark',__('Land Mark'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('land_mark',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('Dreamland 202')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('street_name',__('Street Name'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('street_name',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('Anand Bazar')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('area_name',__('Area Name'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('area_name',$vender->billing_address,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('Old Palasia')))}}
             </div>
         </div>
         
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('pincode',__('Pincode'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('pincode',$vender->billing_zip,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('454720')))}}
             </div>
         </div>
       
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('city',__('City'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('city',$vender->billing_city,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('Indore')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('state',__('State'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('state',$vender->billing_state,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('Madhy Pradesh')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('country',__('Country'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('country',$vender->billing_country,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('India')))}}
             </div>
         </div>
 
         @if(!$customFields->isEmpty())
             <div class="col-lg-4 col-md-4 col-sm-6">
                 <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                     @include('customFields.formBuilder')
                 </div>
             </div>
         @endif
     </div>
   
 {{Form::close()}}  
    </div>

@endsection
@push('script-page')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
 <script>
   const phoneInputField = document.querySelector("#contact");
   const phoneInput = window.intlTelInput(phoneInputField, {
     utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            nationalMode: true,
            autoHideDialCode: true,
            autoPlaceholder: "ON",
            dropdownContainer: document.body,
            formatOnDisplay: true,
            hiddenInput: "contact",
            initialCountry: "IN",
            placeholderNumberType: "MOBILE",
            separateDialCode: true
   });
   const alternateInputField = document.querySelector("#alternate");
   const alternateInput = window.intlTelInput(alternateInputField, {
     utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            nationalMode: true,
            autoHideDialCode: true,
            autoPlaceholder: "ON",
            dropdownContainer: document.body,
            formatOnDisplay: true,
            hiddenInput: "alternate",
            initialCountry: "IN",
            placeholderNumberType: "MOBILE",
            separateDialCode: true
   });
   const countryInputField = document.querySelector("#country");
   const countryInput = window.intlTelInput(countryInputField, {
     utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            nationalMode: true,
            autoHideDialCode: false,
            autoPlaceholder: "ON",
            dropdownContainer: document.body,
            formatOnDisplay: true,
            hiddenInput: "country",
            initialCountry: "IN",
            placeholderNumberType: "MOBILE",
            separateDialCode: false
   });
 </script> 
 @endpush


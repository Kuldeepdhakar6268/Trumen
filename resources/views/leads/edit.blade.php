@extends('layouts.admin')
@section('page-title')
 {{__('Edit Leads')}}
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/dropzone.min.css')}}">
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
     <style>
    .tab-active{
        background-color:#dfe5ea;
    }
/*     input[type="text"]::-webkit-input-placeholder {*/
/*     color: var(--color-customColor);*/
/*    font-weight: bold;*/
/*}*/
  .dataTable-container{
            margin-top: -15px;
    }
.dataTable-table tbody tr td {
        padding: 0px 0px 0px 0px !important;
    }
.card:not(.table-card) .table tr th:last-child {
 border-top-right-radius: 30px;
 border-bottom-right-radius: 30px; 

}
.card:not(.table-card) .table tr th:first-child {

  border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
}    
.dataTable-table thead>tr>th{
        padding: 9px 0px 11px 14px !important; 
}
.dataTable-table td:not(:first-child) {
        padding-left: 10px !important;
    }
.number-color {
    width: 80px;
    height: 78px;
    border-radius: 10px 0px 0px 10px;
    color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-top: -54px !important;
    margin-left: -25px !important;
    margin-bottom: -35px !important;
}
.dataTable-table tfoot tr th, .dataTable-table tfoot tr td, .dataTable-table thead tr th, .dataTable-table thead tr td, .dataTable-table tbody tr th, .dataTable-table tbody tr td{
                padding: 0.5rem 0.5rem;

}
        
        
        
        #choices-multiple1{
             background: #ffffff url("https://trumen.truelymatch.com/assets/images/down-arrow.png") no-repeat right 0.75rem center / 8px 5px;

        }
    </style>
@endpush
@push('script-page')
    <script src="{{asset('css/summernote/summernote-bs4.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    
    <script>
        $(document).on("change", ".change-pipeline select[name=default_pipeline_id]", function () {
            $('#change-pipeline').submit();
        });
    $(document).ready(function() {
    // Your CSS styling goes here
     $('.tab').click(function(){
            
            // Hide all content divs
            $('.content').hide();
            $('.tab').removeClass('btn btn-primary');
            $('.tab').addClass('tab-active');
            $('.tab').css('color', '#000000');
            // Get the target id from data attribute
            $(this).addClass('btn btn-primary');
            $(this).removeClass('tab-active');
            $(this).css('color', '#ffffff');
            var targetId = $(this).data('target');
            
            // Show the corresponding content div
            $('#' + targetId).show();
        });
    $('.page-header-title').css('display', 'none');
    });

    </script>
@endpush
@section('breadcrumb')
<h4 class="m-b-10"><a href="{{route('leads.list')}}" class="text-dark" style="font-weight: bolder;"> <i class="bx bx-undo"></i>{{__('Edit Leads')}}</a>
</h4>

   {{-- <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('leads.index')}}">{{__('Lead')}}</a></li>
    <li class="breadcrumb-item">{{__('Edit Leads')}}</li>--}}
@endsection
@section('content')
{{ Form::model($lead, array('route' => array('leads.update', $lead->id), 'method' => 'PUT')) }}
<div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8" style="padding:15px;">
                <h6 class="sub-title"></h6>
                </div>
                
                <div class="col-lg-4 col-md-4 col-sm-4" style="margin-top: -30px;">
                 <span style="float: inline-end;"><i class="ti ti-send" style="position: absolute;margin-left: 5px;margin-top: 14px;z-index: 10;color: white;"></i><input type="submit" value="{{__('Save')}}" title="{{__('Edit Lead')}}" class="btn-sm custom-file-uploadss" style="border: none;"></span>
                </div>
</div>  
{{--<div class="modal-body">
   
    @php
        $plan= \App\Models\Utility::getChatGPTSettings();
        $stages = \App\Models\LeadStage::where('created_by', '=', \Auth::user()->ownerId())->get()->pluck('name', 'id');
    
    @endphp
    @if($plan->chatgpt == 1)
    <div class="text-end">
        <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="{{ route('generate',['lead']) }}"
           data-bs-placement="top" data-title="{{ __('Generate content with AI') }}">
            <i class="fas fa-robot"></i> <span>{{__('Generate with AI')}}</span>
        </a>
    </div>
    @endif
   
    <div class="row">
        <div class="col-6 form-group">
            {{ Form::label('subject', __('Subject'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::text('subject', null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('user_id', __('User'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('user_id', $users,null, array('class' => 'form-control select','required'=>'required')) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('name', __('Name'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::text('name', null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('email', __('Email'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::email('email', null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('phone', __('Phone'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::text('phone', null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('pipeline_id', __('Pipeline'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('pipeline_id', $pipelines,null, array('class' => 'form-control select','required'=>'required')) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('stage_id', __('Stage'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('stage_id', [''=>__('Select Stage')],null, array('class' => 'form-control select','required'=>'required')) }}
        </div>
        <div class="col-12 form-group">
            {{ Form::label('sources', __('Sources'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('sources[]', $sources,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'')) }}
        </div>
        <div class="col-12 form-group">
            {{ Form::label('products', __('Products'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('products[]', $products,null, array('class' => 'form-control select2','id'=>'choices-multiple1','multiple'=>'')) }}
        </div>
        <div class="col-12 form-group">
            {{ Form::label('notes', __('Notes'),['class'=>'form-label']) }}
            {{ Form::textarea('notes',null, array('class' => 'summernote-simple', 'style' => 'padding-top:50px;')) }}
        </div>
    </div>
</div>--}}

<div class="modal-body">
      <div class="row">
                <div class="col-xl-12">
                    <div class=" sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="lead-sidenav" style="flex-direction: unset;margin-top: 30px;">
                            @if(Auth::user()->type != 'client')
                                {{--<a href="#general" class="list-group-item list-group-item-action border-0">{{__('General')}}
                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>--}}
                                {{--<div data-target="content1" class="list-group-item list-group-item-action border-0 tab active" tyle="cursor: pointer;">{{__('Profile')}}
                                    <div class="float-end"></div>
                                </div>--}}
                                 <div data-target="content1" class="tab btn btn-primary" style="cursor: pointer;padding: 10px 70px 11px 65px;margin-right: 5px;color:white;">{{__('Profile')}}
                                    <div class="float-end"></div>
                                </div>
                            @endif

                            @if(Auth::user()->type != 'client')
                                {{--<a href="#users_products" class="list-group-item list-group-item-action border-0">{{__('Users').' | '.__('Products')}}
                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>--}}
                                <a href="{{ route('quotations.create', ['lead_id' => $lead->id, 0]) }}" data-title="{{ __('Quotataion Create') }}" class="list-group-item list-group-item-action border-0 tab-active" style="border-radius: 5px;cursor: pointer;padding: 10px 70px 11px 65px;margin-right: 5px;color:black;width:230px;">{{ __('Quotation')}}
                                    <div class="float-end"></div>
                                </a>
                            @endif

                           {{-- @if(Auth::user()->type != 'client')
                                <a href="#sources_emails" class="list-group-item list-group-item-action border-0">{{__('Sources').' | '.__('Emails')}}
                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            @endif
                            @if(Auth::user()->type != 'client')
                                <a href="#discussion_note" class="list-group-item list-group-item-action border-0">{{__('Discussion').' | '.__('Notes')}}
                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            @endif
                            @if(Auth::user()->type != 'client')
                                <a href="#files" class="list-group-item list-group-item-action border-0">{{__('Files')}}
                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            @endif --}}
                            @if(Auth::user()->type != 'client')
                           
                                {{--<div data-target="content2" class="list-group-item list-group-item-action border-0 tab" style="cursor: pointer;">| {{__('Call Notes')}}
                                    <div class="float-end"></i></div>
                                </div>--}}
                                 <div data-target="content2" class="btn btn-light tab tab-active" style="border-radius: 5px;cursor: pointer;padding: 10px 70px 11px 65px;margin-right: 5px;color:black;"> {{__(' Notes')}}
                                    <div class="float-end"></i></div>
                                </div>
                            @endif
                            @if(Auth::user()->type != 'client')
                                {{--<div  data-target="content3" class="list-group-item list-group-item-action border-0 tab" style="cursor: pointer;border-bottom-left-radius: unset !important;border-top-left-radius: inherit;border-top-right-radius: inherit;;border-bottom-right-radius: unset !important;
">| {{__('Activity')}}
                                    <div class="float-end"></i></div>
                                </div>--}}
                                <div  data-target="content3" class="btn btn-light tab tab-active" style="border-radius: 5px !important;color:black;padding: 10px 70px 11px 65px;margin-right: 5px;cursor: pointer;border-bottom-left-radius: unset !important;border-top-left-radius: inherit;border-top-right-radius: inherit;;border-bottom-right-radius: unset !important;
"> {{__('Activity')}}
                                    <div class="float-end"></i></div>
                                </div>
                                 <a href="#" data-target="content4" class="btn btn-light tab tab-active" data-title="{{ __('Quotataion Create') }}" class="btn btn-light tab-active" style="padding: 10px 70px 11px 65px;color:black;"> {{ __('Quotations')}}
                                    <div class="float-end"></div>
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
              
            </div>
    {{-- start for ai module--}}
    @php
        $plan= \App\Models\Utility::getChatGPTSettings();
          $stages = \App\Models\LeadStage::where('created_by', '=', \Auth::user()->ownerId())->get()->pluck('name', 'id');
          $customers             = \App\Models\Customer::where('lead_id', $lead->id)->get();
         
         $types = [
         'Product Inquary',
         'Request for Information'
         ];
        
    @endphp
   {{-- @if($plan->chatgpt == 1)
    <div class="text-end">
        <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="{{ route('generate',['lead']) }}"
           data-bs-placement="top" data-title="{{ __('Generate content with AI') }}">
            <i class="fas fa-robot"></i> <span>{{__('Generate with AI')}}</span>
        </a>
    </div>
    @endif --}}
    {{-- end for ai module--}}
 @php
       $Cdata = !empty($customer)?$customer->tax_number:'';
       $cbilling_name = !empty($customer)?$customer->billing_name:'';
       $cphone = !empty($customer)?$customer->billing_phone:'';
       $cemail = !empty($customer)?$customer->email:'';
       $cgender = !empty($customer)?$customer->gender:'';
       $cbilling_designation = !empty($customer)?$customer->billing_designation:'';
       $cbilling_department = !empty($customer)?$customer->billing_department:'';
       $cshipping_address = !empty($customer)?$customer->shipping_address:'';
       $cshipping_country = !empty($customer)?$customer->shipping_country:'';
       $cshipping_state = !empty($customer)?$customer->shipping_state:'';
       $cshipping_city = !empty($customer)?$customer->shipping_city:'';
       $cshipping_zip = !empty($customer)?$customer->shipping_zip:'';
       $cprefix = !empty($customer)?$customer->prefix:'';
       $csector = !empty($customer)?$customer->sector:'';
       $cid = !empty($customer)?$customer->id:'';
       @endphp    
<div class="row content" id="content1"  style="display:block;margin-top: 30px;">
    <div class="card">
        <div class="card-body">
           <h6 class="sub-title">{{__('Organization')}}</h6>
            <div class="row">
                
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="form-group">
                {{Form::label('industry',__('Industry'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                {{Form::text('industry_name',null,array('class'=>'form-control','required'=>'required' ,'placeholder'=>_('Enter Name')))}}
            </div>
        </div>        
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="form-group">
                {{Form::label('name',__('Sector'),array('class'=>'form-label')) }}
                {{Form::text('sector',$csector,array('class'=>'form-control','placeholder'=>_('Enter Name')))}}
            </div>
        </div>
        
         <div class="col-lg-4 col-md-4 col-sm-8">
            <div class="form-group">
                {{ Form::label('products', __('Product'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('products[]', $products,null, array('class' => 'form-control select2','id'=>'choices-multiple1','multiple'=>'')) }}

            </div>
        </div>
       <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                {{Form::label('quantity',__('Quantity'),['class'=>'form-label'])}}
                {{Form::number('quantity',null,array('class'=>'form-control' , 'placeholder'=>__('Enter quantity')))}}

            </div>
        </div>
      
       
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                {{Form::label('gst_number',__('Gst Number'),['class'=>'form-label'])}}
                {{Form::text('tax_number',$Cdata,array('class'=>'form-control' , 'placeholder' => __('Enter Gst Number')))}}
            </div>
        </div>
       
    </div>
        </div>
     </div>  
     
        <div class="row">
            
                <div class="col-md-8">
                    <div class="card">
                    <div class="card-body">
                    <h6 class="sub-title">{{__('Contact Person Information')}}</h6>
                    <div class="col-sm-6" style="float: inline-end;">
                         <select style="padding:10px;;margin-left: 5px;position:absolute;margin-top: 30px;background: white;border: 0px;" name="prefix">
                            <option value="Mr." {{$cprefix == 'Mr.'?'selected': ''}}>Mr.</option>
                            <option value="Mrs." {{$cprefix == 'Mrs.'?'selected': ''}}>Mrs.</option>
                            <option value="Ms." {{$cprefix == 'Ms.'?'selected': ''}}>Ms.</option>
                            </select>
                        <div class="form-group">
                            {{Form::label('billing_name',__('Name'),array('class'=>'','class'=>'form-label')) }}
                            {{Form::text('billing_name', $cbilling_name,array('class'=>'form-control' , 'placeholder'=>__('Enter Name'), 'style' => 'padding-left:90px'))}}
                        </div>
                    </div>
                    <div class="col-5 form-group">
                        {{ Form::label('email', __('Email'),['class'=>'form-label']) }}
                        {{ Form::text('email', $cemail, array('class' => 'form-control','required'=>'required' , 'placeholder' => __('Enter email'))) }}
                    </div>
                    <div class="col-sm-6" style="float: inline-end;">
                        <div class="form-group">
                            {{Form::label('billing_phone',__('Phone'),array('class'=>'form-label')) }}
                            {{Form::text('phone',$cphone,array('class'=>'form-control' , 'id' => 'phone','placeholder'=>__('Enter Phone')))}}
                        </div>
                    </div>
               
           
            <div class="col-sm-6">
                <div class="form-group">
                   {!! Form::label('gender', __('Gender'), ['class' => 'form-label' , 'required' => 'required' ]) !!}<span class="text-danger">*</span>
                    <div class="d-flex radio-check">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="g_male" value="Male" name="billing_gender"
                                                        class="form-check-input" value="Male" {{$cgender == 'Male'?'checked':''}}>
                                                    <label class="form-check-label " for="g_male">{{ __('Male') }}</label>
                                                </div>
                                                <div class="custom-control custom-radio ms-4 custom-control-inline">
                                                    <input type="radio" id="g_female" value="Female" name="billing_gender"
                                                        class="form-check-input" {{$cgender == 'Female'?'checked':''}}>
                                                    <label class="form-check-label "
                                                        for="g_female">{{ __('Female') }}</label>
                                                </div>
                                            </div>
    
                </div>
            </div>
            
             <div class="col-sm-5">
                <div class="form-group">
                   {{ Form::label(null, __('Department'), ['class' => 'form-label', 'style' => 'display: table-column']) }}
                 
                </div>
            </div>
             <div class="col-6 form-group"  style="float: inline-end;">
                {{ Form::label('designation', __('Designation'),['class'=>'form-label']) }}
                {{ Form::text('billing_designation', $cbilling_designation, array('class' => 'form-control', 'placeholder' => __('Enter Designation'))) }}
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    {{Form::label('department',__('Department'),array('class'=>'','class'=>'form-label')) }}
                    {{Form::text('billing_department',$cbilling_department,array('class'=>'form-control' , 'placeholder'=>__('Enter Department')))}}
                </div>
            </div>
           <input name="user_id" value="{{$cid}}" type="hidden">
           <input name="pipeline_id" value="{{$lead->pipeline_id}}" type="hidden">
           
            </div>
            </div>
            </div>
             <div class="col-md-4">
                 <div class="card">
                 <div class="card-body">
                  <h6 class="sub-title">{{__('Categories')}}</h6><br>
                 <div class="col-sm-12">
                 <div class="form-group">
                    
                     {{ Form::label('stage_id', __('Status'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                     <select class="form-control select" required="required" name="stage_ids">
                         <option value="6" {{$lead->stage_id == 6?'selected':''}}>Do not contact</option>
                         <option value="7" {{$lead->stage_id == 7?'selected':''}}>Converted</option>
                         <option value="8" {{$lead->stage_id == 8?'selected':''}}>Open</option>
                         <option value="9" {{$lead->stage_id == 9?'selected':''}}>Replied</option>
                         <option value="11" {{$lead->stage_id == 11?'selected':''}}>Quantitation</option>
                         <option value="12" {{$lead->stage_id == 12?'selected':''}}>Lost Quantitation</option>
                         <option value="13" {{$lead->stage_id == 13?'selected':''}}>Opportunities</option></select>
                 
                </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    {{ Form::label('sources', __('Sources'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                   {{ Form::select('sources[]', $sources,null, array('class' => 'form-control select','required'=>'required')) }}
    
                </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    {{ Form::label('type', __('Request Type'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                   {{ Form::select('request_id', $types,null, array('class' => 'form-control select','required'=>'required')) }}
    
                </div>
                </div>
               </div>
               </div>
            </div>
        </div>
  @if(count($customers)>0)
  @foreach($customers->slice(1) as $key => $v)
  <div class="card">
        <div class="card-body">
  <div class="add_contact"><input name="shipping_user_id[]" value="{{$v->id}}" type="hidden"><h6 class="sub-title">Contact Person Information</h6><div class="row"><div class="col-lg-6 col-md-6 col-sm-6"><div class="form-group"><label for="shipping_name" class="form-label">Name</label><input class="form-control" placeholder="Enter Name" name="shipping_name[]" value="{{$v->shipping_name}}" type="text" id="shipping_name"></div></div><div class="col-lg-6 col-md-6 col-sm-6"><label for="email" class="form-label">Email</label><input class="form-control" placeholder="Enter email" name="shipping_email[]"  value="{{$v->email}}" type="text"></div><div class="col-lg-6 col-md-6 col-sm-6"><div class="form-group"><label for="shipping_phone" class="form-label">Phone</label><span><button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;border-radius: 5px 0px 0px 5px;height: 35px; margin: 31px 0px 0px -34px;position: absolute;"><a href="#"><img src="https://trumen.truelymatch.com/assets/images/india.png" width="30" alt="india"> </a></button><input class="form-control" style="padding-left: 100px;" placeholder="Enter Phone" name="shipping_phone[]" value="{{$v->shipping_phone}}" type="text" id="shipping_phone"> </span></div></div><div class="col-lg-5 col-md-5 col-sm-5"><div class="form-group"><label for="gender" class="form-label">Gender</label><span class="text-danger">*</span><div class="d-flex radio-check"><div class="custom-control custom-radio custom-control-inline"><input type="radio" id="g_male" value="Male" name="shipping_gender[{{$key}}]" value="{{$v->shipping_gender}}" class="form-check-input" {{$v->shipping_gender != 'Male'?'checked':''}}><label class="form-check-label " for="g_male">Male</label></div><div class="custom-control custom-radio ms-4 custom-control-inline"><input type="radio" id="g_female" value="Female" name="shipping_gender[]" class="form-check-input"><label class="form-check-label " for="g_female" {{$v->shipping_gender != 'Female'?'checked':''}}>Female</label></div></div></div></div><div class="col-lg-6 col-md-6 col-sm-6"><div class="form-group"><label for="department_id" class="form-label">Department</label><input class="form-control" placeholder="Enter Department" name="shipping_department[]" value="{{$v->shipping_department}}" type="text"></div></div><div class="col-lg-5 col-md-5 col-sm-5"><div class="form-group"><label for="designation_id" class="form-label">Designation</label><input class="form-control" placeholder="Enter Designation" name="shipping_designation[]" value="{{$v->shipping_designation}}" type="text"></div></div><div class="col-lg-1 col-md-1 col-sm-1" style="padding-top: 26px;"><a class="mx-3 btn btn-primary sm  align-items-center removeButton" title="remove"><label class="form-check-label " for="g_male"><i class="ti ti-trash text-white"></i></label></a></div></div></div></div></div>
  @endforeach
  @endif
   <div id="divContainer"></div>
            <div class="form-group text-center">
                <a class="btn btn-outline-light sm text-dark" onclick="appendDiv()" style="background-color: revert-layer;"><i class="ti ti-plus" style="background-color: darkgray;
                    border-radius: 50%;"></i> Add Contact Person</a>
             </div>
    @if(App\Models\Utility::getValByName('shipping_display')=='on')
       
       
        <div class="row">
        <div class="col-md-8">
        <div class="card">
        <div class="card-body">
             <h6 class="sub-title">{{__('Address & Contact')}}</h6>
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('shipping_address',__('Address'),array('class'=>'form-label')) }}
                    <label class="form-label" for="example2cols1Input"></label>
                    {{Form::textarea('shipping_address',$cshipping_address,array('class'=>'form-control','rows'=>3 , 'placeholder'=>__('Enter Address')))}}

                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-6" style="float: inline-end;">
                <div class="form-group">
                    {{Form::label('shipping_city',__('City'),array('class'=>'form-label')) }}
                    {{Form::text('shipping_city',$cshipping_city,array('class'=>'form-control' , 'placeholder'=>__('Enter City')))}}

                </div>
            </div>
            <div class=" col-lg-5 col-md-5 col-sm-5">
                <div class="form-group">
                    {{Form::label('shipping_state',__('State'),array('class'=>'form-label')) }}
                    {{Form::text('shipping_state',$cshipping_state,array('class'=>'form-control' , 'placeholder'=>__('Enter State')))}}

                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6" style="float: inline-end;">
                <div class="form-group">
                    {{Form::label('shipping_country',__('Country'),array('class'=>'form-label')) }}
                    {{Form::text('shipping_country',$cshipping_country,array('class'=>'form-control' , 'placeholder'=>__('Enter Country')))}}

                </div>
            </div>


            <div class="col-lg-5 col-md-5 col-sm-5">
                <div class="form-group">
                    {{Form::label('shipping_zip',__('Zip Code'),array('class'=>'form-label')) }}
                    {{Form::text('shipping_zip',$cshipping_zip,array('class'=>'form-control' , 'placeholder' => __('Enter Zip Code')))}}

                </div>
            </div>
           </div>
           </div>
           </div>
             <div class="col-md-4">
               <div class="card">
               <div class="card-body">  
              <h6 class="sub-title">{{__('Additional')}}</h6><br>
             <div class="col-sm-12">
             <div class="form-group">
                  {{Form::label('assigned_by',__('Lead Assigned by'),array('class'=>'form-label')) }}
                    {{Form::text('assigned_by',\Auth::user()->name,array('class'=>'form-control' , 'placeholder' => __('Lead Assigned Name'), 'readonly'))}}
                
            </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                {{ Form::label('owner_name', __('Lead Owner Name'),['class'=>'form-label']) }}
                {{ Form::text('owner_id',\Auth::user()->name, array('class' => 'form-control','readonly')) }}

            </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                 {{ Form::label('assigned_to', __('Lead Assigned to'),['class'=>'form-label']) }}
                 {{ Form::select('assigned_to[]', $assigned_to, null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'','required'=>'required')) }}

            </div>
            </div>
           </div>
           </div>
        </div>
        
        </div>
        
    @endif
    
        <input type="hidden" name="subject" value="demo">
        <!--<input type="hidden" name="user_id" value="{{\Auth::user()->ownerId()}}">-->
        {{--<div class="col-6 form-group">
            {{ Form::label('subject', __('Subject'),['class'=>'form-label']) }}
            {{ Form::text('subject', hidden, array('class' => 'form-control','required'=>'required' , 'placeholder'=>__('Enter Subject'))) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('user_id', __('User'),['class'=>'form-label']) }}
            {{ Form::select('user_id', $users,null, array('class' => 'form-control select','required'=>'required')) }}
            @if(count($users) == 1)
                <div class="text-muted text-xs">
                    {{__('Please create new users')}} <a href="{{route('users.index')}}">{{__('here')}}</a>.
                </div>
            @endif
        </div>
        <div class="col-6 form-group">
            {{ Form::label('name', __('Name'),['class'=>'form-label']) }}
            {{ Form::text('name', null, array('class' => 'form-control','required'=>'required' , 'placeholder' => __('Enter Name'))) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('email', __('Email'),['class'=>'form-label']) }}
            {{ Form::text('email', null, array('class' => 'form-control','required'=>'required' , 'placeholder' => __('Enter email'))) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('phone', __('Phone'),['class'=>'form-label']) }}
            {{ Form::text('phone', null, array('class' => 'form-control','required'=>'required' , 'placeholder' => __('Enter Phone'))) }}
        </div>--}}
        <div class="card">
        <div class="card-body">
         <div class="col-12 form-group">
            {{ Form::label('notes', __('Notes'),['class'=>'form-label']) }}
            {{ Form::textarea('notes',null, array('class' => 'summernote-simple', 'style' => 'width:100%;')) }}
        </div>
        </div>
         <div class="modal-footer" style="padding: 13px 18px 12px 15px;">
              <span style="float: inline-end;"><i class="ti ti-send" style="position: absolute;margin-left: 5px;margin-top: 14px;z-index: 10;color: white;"></i><input type="submit" value="{{__('Save')}}" title="{{__('Edit Lead')}}" class="btn-sm custom-file-uploadss" style="border: none;"></span>
                {{--<input type="submit" value="{{__('Update')}}" class="btn  btn-primary">--}}
           </div>  
           
        </div>
        </div>
    </div>
    
</div>
<div  id="content2" class="card content" style="display:none;margin-top: 30px;">  
                   
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h5>{{__('Call Notes')}}</h5>
                                            {{--<div class="float-end">
                                                <a data-size="lg" data-url="{{ route('leads.discussions.create',$lead->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Add Message')}}" class="btn btn-sm btn-primary">
                                                    <i class="ti ti-plus text-white"></i>
                                                </a>
                                            </div>--}}
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush mt-2" id="note-lists">
                                            @if(!$lead->discussions->isEmpty())
                                                @foreach($lead->discussions as $discussion)
                                                    <li class="list-group-item px-0">
                                                        <div class="d-block d-sm-flex align-items-start">
                                                            <img src="@if($discussion->user->avatar) {{asset('/storage/uploads/avatar/'.$discussion->user->avatar)}} @else {{asset('/storage/uploads/avatar/avatar.png')}} @endif"
                                                                 class="img-fluid wid-40 me-3 mb-2 mb-sm-0" alt="image">
                                                            <div class="w-100">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <div class="mb-3 mb-sm-0">
                                                                        <h6 class="mb-0"> {{$discussion->comment}}</h6>
                                                                        <span class="text-muted text-sm">{{$discussion->user->name}}</span>
                                                                    </div>
                                                                    <div class="form-check form-switch form-switch-right mb-2">
                                                                        {{$discussion->created_at->diffForHumans()}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="text-center">
                                                    {{__(' No Data Available.!')}}
                                                </li>
                                            @endif
                                        </ul>
                                      

                                        <div class="row">
                                            <div class="col-12 form-group">
                                                {{ Form::label('comment', __('Message'),['class'=>'form-label']) }}
                                                {{ Form::textarea('comment', null, array('class' => 'form-control', 'id'=>'disc-note')) }}
                                                 {{ Form::hidden('id', $lead->id, array('class' => 'form-control', 'id'=>'lead_id')) }}
                                            </div>
                                           
                                        </div> 
                                           
                                        
                                    </div>
                                    
                                    <div class="row" style="padding: 10px;">
                                           <div class="col-3 form-group">
                                               {{ Form::select('stage_id', $stages,null, array('class' => 'form-control select2','id'=>'choices-multiple1')) }}
                                           </div>
                                            <div class="col-9 form-group">
                                                <div class="modal-footer">
                                                    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
                                                    <input type="submit" value="{{__('Add')}}" class="btn  btn-primary" id="add-notes">
                                                </div>
                                            </div>    
                                        </div>        
                                   

                                    </div>
                                </div>
                            </div>
                           
                        </div>  
                         <div id="content3" class="content" style="display:none;margin-top: 30px;">
                    <div id="activity" class="card">
                        <div class="card-header">
                            <h5>{{__('Activity')}}</h5>
                        </div>
                        <div class="card-body ">

                            <div class="row leads-scroll" >
                                <ul class="event-cards list-group list-group-flush mt-3 w-100">
                                    @if(!$lead->activities->isEmpty())
                                        @foreach($lead->activities as $activity)
                                            <li class="list-group-item card mb-3">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-auto mb-3 mb-sm-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar">
                                                                <img src="{{asset('/storage/uploads/avatar/avatar.png')}}"
                                                                 class="img-fluid wid-40 me-3 mb-2 mb-sm-0" alt="image">
                                                            </div>
                                                            <div class="ms-3">
                                                                <span class="text-dark text-sm">{{ __($activity->log_type) }}</span>
                                                                <h6 class="m-0">{!! $activity->getLeadRemark() !!}</h6>
                                                                <small class="text-muted">{{$activity->created_at->diffForHumans()}}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">

                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @else
                                        No activity found yet.
                                    @endif
                                </ul>
                            </div>

                        </div>
                    </div>
                    </div>
                     <div class="row content" style="display: none;" id="content4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th> {{ __('Sr.') }}</th>
                                    <th> {{ __('Quote Ref No.') }}</th>
                                    <th> {{ __('Product Name') }}</th>
                                    <th> {{ __('Total Cost') }}</th>
                                    <th> {{ __('Quote Date') }}</th>
                                    <th> {{ __('Created by') }}</th>
                                    <th> {{ __('Quote Status') }}</th>
                                    @if (Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation'))
                                        <th> {{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($quotations as $quotation)
                                    <tr>
                                       
                                        <td>
                                            <div class="number-color ms-2" style="font-size:12px;background-color: {{ ($quotation->status == 0)?'#ffa21d':'#6fd943'}}">
                                                   {{ $quotation->id }}</div> 
                                           </td>
                                        <td class="Id">
                                            <a href="{{ route('quotation.show', \Crypt::encrypt($quotation->id)) }}"
                                                class="text text-dark">{{ Auth::user()->quotationNumberFormat($quotation->quotation_id) }}</a>
                                        </td>
                                        @if(count($quotation->items)>0)
                                        @foreach($quotation->items as $item)
                                        @php
                                         $product = \App\Models\ProductService::find($item->product_id);
                                         $quoteProduct = \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->first();
                                         $total =  $item->price * (!empty($quoteProduct)?$quoteProduct->quantity:1);
                                        @endphp
                                        <td>{{$product->name}}</td>
                                        @if(isset($quoteProduct->tax))
                                        @php 
                                        $taxProduct = \App\Models\Tax::find($quoteProduct->tax);
                                        @endphp
                                        <td>{{!empty($taxProduct)?(($total * $taxProduct->rate/100) + $total):$total }}</td>
                                        @else
                                        <td> {{$item->price}}</td>
                                        @endif
                                        @endforeach
                                        @else
                                        <td>-</td>
                                        <td>-</td>
                                        @endif
                                        <td>{{ Auth::user()->dateFormat($quotation->quotation_date) }}</td>
                                        <td> {{ !empty($quotation->customer) ? $quotation->customer->name : '' }} </td>
                                       
                                         <td>{{ $quotation->status ==0?'Waiting for Approval':'Approved' }}</td>
                                        @if (Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation'))
                                            <td class="Action">
                                                <span>

                                                    @can('edit quotation')
                                                        <div class="action-btn bg-light ms-2">
                                                            <a href="{{ route('quotation.edit', \Crypt::encrypt($quotation->id)) }}"
                                                                class="mx-3 btn btn-sm align-items-center"
                                                                data-bs-toggle="tooltip" title="Edit"
                                                                data-original-title="{{ __('Edit') }}">
                                                                <i class="ti ti-pencil text-dark"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                     
                                                    @can('delete quotation')
                                                        <div class="action-btn bg-light ms-2">
                                                                <a href="{{route('quotation.show', \Crypt::encrypt($quotation->id))}}" class="mx-3 d-inline-flex align-items-center"  data-size="xl" data-bs-toggle="tooltip" title="{{__('View')}}" data-title="{{__('Quotation Detail')}}">
                                                                    <i class="ti ti-eye text-dark"></i>
                                                                </a>
                                                            </div>
 <a href="#"
                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para"
                                                                data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                                data-original-title="{{ __('Delete') }}"
                                                                data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="document.getElementById('delete-form-{{ $quotation->id }}').submit();">
                                                                <i class="ti ti-trash text-white"></i>
                                                            </a>
                                                    @endcan
                                                </span>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>--}}

{{Form::close()}}
@endsection

@push('script-page')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
 <script>
   const phoneInputField = document.querySelector("#phone");
   const phoneInput = window.intlTelInput(phoneInputField, {
     utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            nationalMode: true,
            autoHideDialCode: true,
            autoPlaceholder: "ON",
            dropdownContainer: document.body,
            formatOnDisplay: true,
            hiddenInput: "phone",
            initialCountry: "IN",
            placeholderNumberType: "MOBILE",
            separateDialCode: true
   });
 </script>
<script>

     $(document).ready(function() {
     
       $(".iti").css('display', 'block');
  });
    var stage_id = '{{$lead->stage_id}}';

    $(document).ready(function () {
        var pipeline_id = $('[name=pipeline_id]').val();
        getStages(pipeline_id);
    });
    
    $(document).on("change", "#commonModal select[name=pipeline_id]", function () {
        var currVal = $(this).val();
        console.log('current val ', currVal);
        getStages(currVal);
        
    });
    function appendDiv() {
    // Create a new div element
    //  $('#divContainer').append("<div id='mySecondDiv'></div>");
    $('#divContainer').append(' <div class="card"><div class="card-body"><div class="add_contact"><input name="shipping_user_id[]" type="hidden"><h6 class="sub-title">Contact Person Information</h6><div class="row"><div class="col-lg-6 col-md-6 col-sm-6"><div class="form-group"><label for="shipping_name" class="form-label">Name</label><input class="form-control" placeholder="Enter Name" name="shipping_name[]" type="text" id="shipping_name"></div></div><div class="col-lg-6 col-md-6 col-sm-6"><label for="email" class="form-label">Email</label><input class="form-control" placeholder="Enter email" name="shipping_email[]" type="text"></div><div class="col-lg-6 col-md-6 col-sm-6"><div class="form-group"><label for="shipping_phone" class="form-label">Phone</label><span><button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;border-radius: 5px 0px 0px 5px;height: 35px; margin: 31px 0px 0px -34px;position: absolute;"><a href="#"><img src="https://trumen.truelymatch.com/assets/images/india.png" width="30" alt="india"> </a></button><input class="form-control" style="padding-left: 100px;" placeholder="Enter Phone" name="shipping_phone[]" type="text" id="shipping_phone"> </span></div></div><div class="col-lg-5 col-md-5 col-sm-5"><div class="form-group"><label for="gender" class="form-label">Gender</label><span class="text-danger">*</span><div class="d-flex radio-check"><div class="custom-control custom-radio custom-control-inline"><input type="radio" id="g_male" value="Male" name="shipping_genders[]" class="form-check-input" checked><label class="form-check-label " for="g_male">Male</label></div><div class="custom-control custom-radio ms-4 custom-control-inline"><input type="radio" id="g_female" value="Female" name="shipping_genders[]" class="form-check-input"><label class="form-check-label " for="g_female">Female</label></div></div></div></div><div class="col-lg-6 col-md-6 col-sm-6"><div class="form-group"><label for="department_id" class="form-label">Department</label><input class="form-control" placeholder="Enter Department" name="shipping_department[]" type="text"></div></div><div class="col-lg-5 col-md-5 col-sm-5"><div class="form-group"><label for="designation_id" class="form-label">Designation</label><input class="form-control" placeholder="Enter Designation" name="shipping_designation[]" type="text"></div></div><div class="col-lg-1 col-md-1 col-sm-1" style="padding-top: 26px;"><a class="mx-3 btn btn-primary sm  align-items-center removeButton" title="remove"><label class="form-check-label " for="g_male"><i class="ti ti-trash text-white"></i></label></a></div></div></div></div></div>');

    // Append the new div to a container
    // var container = document.getElementById('divContainer');
    // container.appendChild(newDiv);
  }
    $(document).on('click', '.removeButton', function(e) {
   e.preventDefault();
   $(this).closest('.add_contact').remove();
   return false;
});
    function getStages(id) {
        $.ajax({
            url: '{{route('leads.json')}}',
            data: {pipeline_id: id, _token: $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            success: function (data) {
                var stage_cnt = Object.keys(data).length;
                $("#stage_id").empty();
                if (stage_cnt > 0) {
                    $.each(data, function (key, data1) {
                        var select = '';
                        if (key == '{{ $lead->stage_id }}') {
                            select = 'selected';
                        }
                        $("#stage_id").append('<option value="' + key + '" ' + select + '>' + data1 + '</option>');
                    });
                }
                $("#stage_id").val(stage_id);
                $('#stage_id').select2({
                    placeholder: "{{__('Select Stage')}}"
                });
            }
        })
    }
</script>
@endpush

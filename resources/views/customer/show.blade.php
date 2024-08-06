@extends('layouts.admin')
@push('script-page')
@endpush
@section('page-title')
    {{__('Manage Customer-Detail')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('customer.index')}}">{{__('Customer')}}</a></li>
    <li class="breadcrumb-item">{{$customer['name']}}</li>
@endsection
@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
    <style>
    /* Hide default arrow */

.choose-files div {
    background: #ffffff !important;
}
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
    height: 44px;
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
    <script src="{{asset('assets/js/plugins/dropzone-amd-module.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
      <script>
      function readURL(input, imgno) {

  let file = input.files[0];

  // file validation code not shown

  var reader = new FileReader();

  reader.onload = function(e) {
    
    let src = file.type.startsWith("image") ? e.target.result : defaultImage;
    let size = (file.size / 1024).toFixed(0);
    let date = new Date(file.lastModified).toLocaleDateString();
    $("#blah").text(file.name)
    $("#img_new").attr('src', src);
    $("#blah_holder").append(`
    <div class="col-3" style="padding-right: 40px;">
     <img src="${src}" class="thumb-image" style="
  height: 50px;
  width: auto;
  border: 1px solid lightgray;"
>
</div>
    `);

  }
  reader.readAsDataURL(file);
}



let defaultImage = "https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/833px-PDF_file_icon.svg.png";


$('input[type="file"]').change(function(e) {

 var extension = $('#document').val().split('.').pop().toLowerCase();

if($.inArray(extension, ['gif','png','jpg','jpeg','bmp', 'pdf']) == -1) {
    show_toastr('error', 'You have seleceted unsupported file', 'success');
    return false;
}
  readURL(this, 1);
});
        // $('input[type="file"]').change(function(e) {
        //     var file = e.target.files[0].name;
        //     var file_name = $(this).attr('data-filename');
        //     $('.' + file_name).append(file);
        // });
    </script>
    <script>
        function copyToClipboard(element) {

            var copyText = element.id;
            navigator.clipboard.writeText(copyText);
            // document.addEventListener('copy', function (e) {
            //     e.clipboardData.setData('text/plain', copyText);
            //     e.preventDefault();
            // }, true);
            //
            // document.execCommand('copy');
            show_toastr('success', 'Url copied to clipboard', 'success');
        }
    </script>
@endpush

@section('action-btn')
    <div class="float-end">
        {{--@can('create invoice')
            <a href="{{ route('invoice.create',$customer->id) }}" class="btn btn-sm btn-primary">
                {{__('Create Invoice')}}
            </a>
        @endcan
        @can('create proposal')
            <a href="{{ route('proposal.create',$customer->id) }}" class="btn btn-sm btn-primary">
                {{__('Create Proposal')}}
            </a>
        @endcan --}}

        @can('edit customer')
            <a href="#" data-size="lg" data-url="{{ route('customer.edit',$customer['id']) }}" data-ajax-popup="true" title="{{__('Edit Customer')}}" data-bs-toggle="tooltip" data-original-title="{{__('Edit')}}" class="btn btn-sm btn-primary">
                <i class="ti ti-pencil"></i>
            </a>
        @endcan

        @can('delete customer')
            {!! Form::open(['method' => 'DELETE','class' => 'delete-form-btn', 'route' => ['customer.destroy', $customer['id']]]) !!}
                <a href="#" data-bs-toggle="tooltip" title="{{__('Delete Customer')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{ $customer['id']}}').submit();" class="btn btn-sm btn-danger bs-pass-para">
                    <i class="ti ti-trash text-white"></i>
                </a>
            {!! Form::close() !!}
        @endcan
    </div>
@endsection

@section('content')
  <div class="row">
                <div class="col-xl-12">
                    
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="lead-sidenav" style="flex-direction: unset;">
                            @if(Auth::user()->type != 'client')
                                {{--<a href="#general" class="list-group-item list-group-item-action border-0">{{__('General')}}
                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>--}}
                                <div data-target="content1" class="list-group-item list-group-item-action border-0 tab active" style="cursor: pointer;">{{__('Profile')}}
                                    <div class="float-end"></div>
                                </div>
                            @endif

                           
                                <div data-target="content2" data-title="{{ __('Quotataion') }}" class="list-group-item list-group-item-action border-0 tab" style="cursor: pointer;">| {{ __('Quotation')}}
                                    <div class="float-end"></div>
                                </div>
                          
                                <div  data-target="content3" class="list-group-item list-group-item-action border-0 tab" style="cursor: pointer;">{{__('Orders')}}
                                    <div class="float-end"></div>
                                </div>
                         
                            @if(Auth::user()->type != 'client')
                                <div data-target="content4" class="list-group-item list-group-item-action border-0 tab" style="cursor: pointer;">| {{__('Job Card')}}
                                    <div class="float-end"></i></div>
                                </div>
                            @endif
                           

                        </div>
                    </div>
                </div>
              
            </div>
    <div class="content" id="content1" style="display:block;">        
    <div class="row">
          <div class="row" style="line-height: 2;margin-top: 30px;">
                               
                                <div class="col-md-8 col-sm-8">
                                <div class="card"> 
                                 <div class="card-body">
                                     <h5>{{__('Contact Person Info')}}</h5>
                                <div class="row" >
                                <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                         <div class="ms-2">
                                            {{__('Name')}}: <span class="mb-0">{{$customer['name']}}</span>
                                        </div>
                                   
                                </div>
                               </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        
                                        <div class="ms-2">
                                                 {{__('Email')}}: <span class="mb-0">{{$customer['email']}}</span>
                                        </div>
                                   
                                </div>
                               </div>
                                 <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                          
                                           {{__('Number')}}: <span class="mb-0 ">{{$customer['contact']}}</span>
                                        </div>
                                    </div>
                               </div>
                                  <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           {{__('Department')}}: <span class="mb-0 ">{{$customer['billing_department']}}</span>
                                        </div>
                                    </div>
                               </div>
                                 <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                           {{__('Designation')}}: <span class="mb-0">{{$customer['shipping_designation']}}</span>
                                        </div>
                                    </div>
                                    </div>
                                     <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           {{__('Gender')}}: <span class="mb-0">{{$customer['gender']}}</span>
                                        </div>
                                    </div>
                                    </div>
                                     {{--<div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                           {{__('Alternate')}}: <span class="mb-0">{{$customer['billing_phone']}}</span>
                                        </div>
                                    </div>
                                    </div>--}}
                                    </div>
                               
                                </div>
                                </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                     <div class="card">
                                      <div class="card-body">     
                                     <h5 style="padding-left: 5px;">{{__('Categories')}}</h5>
                                      <div class="d-flex align-items-start">
                                       @php
                                       $status = \App\Models\Stage::where('created_by', \Auth::user()->creatorId())->first();
                                       @endphp
                                        <div class="ms-2">
                                           @if(!empty($customer->lead_id != 0))
                                            {{__('Status')}}: <span class="mb-0">{{ !empty($customer->leads->stage)?$customer->leads->stage->name:'' }}</span><br>
                                          
                                           @if(!empty($customer->leads->products()))
                                                 @foreach($customer->leads->sources() as $source) 
                                                 {{__('Source')}}: <span class="mb-0">{{!empty($source->name)?$source->name:''}}</span><br>
                                                  
                                                   @if (!$loop->last)
                                                        ,
                                                    @endif
                                                   @endforeach
                                                   @else
                                                   -
                                                   @endif
                                          
                                             {{__('Request Type')}}: <span class="mb-0">{{!empty($customer->leads->request_id)?$customer->leads->request_id:$customer->leads->request_type}}</span>
                                           
                                           @endif  
                                        </div>
                                    </div>
                                </div>
                           
                            </div>
       
    </div>
                                <div class="card">
                        <div class="card-body">
                            <h5>{{__('Organization')}}</h5>
                             <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                           
                                            {{__('Sector')}}: <span class="mb-0">{{$customer['sector']}}</span>
                                           
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                            {{__('Industry')}}: <span class="mb-0">{{!empty($customer->leads->industry_name)?$customer->leads->industry_name:''}}</span>
                                        </div>
                                    </div>
                                </div>
                                   @if(!empty($customer->lead_id != 0))
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                          
                                              @if(!empty($customer->leads->products()))
                                                 @foreach($customer->leads->products() as $product) 
                                                  {{__('Product')}}: <span class="mb-0">{{$product->name}}</span> 
                                                   @if (!$loop->last)
                                                        ,
                                                    @endif
                                                   @endforeach
                                                   @else
                                                   -
                                                   @endif
                                                 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            {{__('Quantity')}}: <span class="mb-0">{{$customer->leads->quantity}}</span>
                                        </div>
                                    </div>
                                </div>
                                  @endif  
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            {{__('GST Number')}}: <span class="mb-0">{{ $customer['tax_number']}}</span>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        </div>
    <div class="row" style="line-height: 2;">
                                <div class="col-md-8 col-sm-8">
                                    <div class="card">
                                     <div class="card-body">
                                     <h5  style="padding-left: 5px;">{{__('Address & Contact')}}</h5>
                                      <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                            {{__('Address')}}: <span class="mb-0">{{$customer['billing_address']}}</span>
                                        </div>
                                    </div>
                                
                                
                                <div class="row" >
                                {{--<div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        
                                        <div class="ms-2">
                                            @if(!empty($customer->leads->products()))
                                                 @foreach($customer->leads->sources() as $source) 
                                                 {{__('Website')}}: <span class="mb-0">{{!empty($source->name)?$source->name:''}}</span>
                                                  
                                                   @if (!$loop->last)
                                                        ,
                                                    @endif
                                                   @endforeach
                                                   @else
                                                   -
                                                   @endif
                                            
                                        </div>
                                   
                                </div>
                               </div>--}}
                               <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           {{__('Country')}}: <span class="mb-0">{{$customer['billing_country']}}</span>
                                        </div>
                                    </div>
                                    </div>
                                 <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                          
                                           {{__('State')}}: <span class="mb-0 ">{{$customer['billing_state']}}</span>
                                        </div>
                                    </div>
                               </div>
                                  <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           {{__('City')}}: <span class="mb-0 ">{{$customer['billing_city']}}</span>
                                        </div>
                                    </div>
                               </div>
                                 
                                    </div>
                                 </div>
                                 </div>
                                </div>
                               
                                <div class="col-md-4 col-sm-4">
                                    <div class="card">
                                    <div class="card-body">
                                     <h5 style="padding-left: 5px;">{{__('Additional')}}</h5>
                                      <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                              @if(!empty($customer->lead_id != 0))
                                            {{__('Lead Assigned by')}}: <span class="mb-0">{{$customer->leads->owner->name}}</span><br>
                                           
                                            {{__('Lead Owner ')}}: <span class="mb-0">{{$customer->leads->owner->name}}</span><br>
                                            {{__('Lead Assigned to')}}:
                                             @foreach($customer->leads->users as $user)
                                            
                                             @if ($loop->first)
                                                @continue
                                               
                                            @endif
                                              <span class="mb-0">{{!empty($customer->leads->user)?$customer->leads->user->name:''}}</span>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                           
                            </div>                
     </div>
    <div class="row">
         <div class="card">
                        <div class="card-body">
                            <h5>{{__('Key Notes')}}</h5>
                            <div class="col-md-12 dropzone top-5-scroll browse-file" id="getnotedetails" style="text-align: justify;">
                                  @if(!empty($customer->lead_id != 0))
                                {!! $customer->leads->notes !!}
                                @else
                                
                                @endif
                            </div>
                        </div>
                        </div>
              {{ Form::open(array('route' => array('customer.po', $customer->id),'method'=>'post','enctype' => 'multipart/form-data')) }}     
             <div class="card">
                        <div class="card-body">
                            
                             <div class="row" style="line-height: 2;">
                                 
                                 <div class="col-md-12 col-sm-12">
                                    <div class="d-flex align-items-start">
                                         <div class="ms-2">
                                           <h5>{{__('Customer PO Details')}}</h5>
                                        </div>
                                   
                                </div>
                               </div>
                              
                                {{Form::hidden('customer_id',$customer->id,array('class'=>'form-control'))}}
                                 <div class="col-md-2 col-sm-2">
                                   
                                            <div class="form-group">
                                                {{Form::label('quote_no',__('Quote No.'),['class'=>'form-label'])}}
                                                {{Form::select('quote_no',$qList,null ,array('class'=>'form-control'))}}
                                            </div>
                                        
                               </div>
                                <div class="col-md-2 col-sm-2">
                                   
                                            <div class="form-group">
                                                {{Form::label('po_date',__('PO Date'),['class'=>'form-label'])}}
                                                {{Form::date('po_date',null,array('class'=>'form-control','placeholder'=>_('Enter Name')))}}
                                            </div>
                                        
                               </div>
                                <div class="col-md-2 col-sm-2">
                                  
                                         <div class="form-group">
                                                {{Form::label('po_number',__('PO Number'),['class'=>'form-label'])}}
                                                {{Form::text('po_number',null,array('class'=>'form-control','required'=>'required' ,'placeholder'=>_('Enter PO Number')))}}
                                            </div>
                                       
                               </div>
                                 <div class="col-md- col-sm-6">
                                  
                                         <div class="card-body employee-detail-create-body">
                           
                                <div class="row">
                                    <div class="form-group col-12 d-flex">
                                        <div class="float-left col-4">
                                            <label for="document"
                                                class="float-left pt-1 form-label">Upload PO File
                                            </label>
                                        </div>
                                        <div class="float-right col-8">
                                            <input type="hidden" name="emp_doc_id" id=""
                                                value="">
                                            <div class="choose-files">
                                                <label for="document">
                                                    <div class=" bg-primary document "> <i
                                                            class="ti ti-upload "></i>{{ __('Choose file here') }}
                                                    </div>
                                                    <input type="file"
                                                        class="form-control file"
                                                       
                                                        name="document[]" id="document"
                                                        data-filename="_filename" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                </label>
                                                <span id="blah"></span>
                                             
                                              <div class="row"  id="blah_holder">
                                                 
                                                </div>
                                                
                                            </div>

                                        </div>

                                    </div>
                                </div>
                           
                             </div>
                                        
                        </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="d-flex align-items-start">
                                         <div class="ms-2">
                                         <input type="submit" value="{{__('Save')}}" class="btn  btn-primary">
                                        </div>
                                   
                                </div>
                               </div>
                            </div>
                          
                        </div>
                        </div>
                          {{Form::close()}}
                         <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th> {{ __('Sr.') }}</th>
                                    <th> {{ __('Quote Ref No.') }}</th>
                                    <th> {{ __('PO Date') }}</th>
                                    <th> {{ __('PO Number') }}</th>
                                    <th> {{ __('Document') }}</th>
                                   
                                    <th> {{ __('PO Status') }}</th>
                                   {{-- @if (Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation'))
                                        <th> {{ __('Action') }}</th>
                                    @endif --}}
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
                                        
                                        <td>{{$quotation->po_date}}</td>
                                       
                                        <td>{{$quotation->po_number}}</td>
                                       
                                        <td><a href="https://trumen.truelymatch.com/storage/uploads/document/{{ $quotation->document }}" download style="color:#0ce326;"> {{ $quotation->document }}</a></td>
                                      
                                       @php
                                        $Po_status = $quotation->document ==''?'Po Pending':'Uploaded';
                                         $Po_status_bg = $quotation->document ==''?'#FF5000':'#0AA350';
                                       @endphp
                                         <td><span style="padding:10px;background-color:{{$Po_status_bg}}; border-radius:5px;color:#ffffff;">{{$Po_status}}</span></td>
                                       {{-- @if (Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation'))
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
                                        @endif --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
    </div>
   </div>
    </div>
    </div>
    </div>
                        
     <div class="row content" style="display: none;" id="content2">
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
                                        <td> {{ !empty($quotation->is_revisedBy != '')?$quotation->assignBy->name:$quotation->createdBy->name }} </td>
                                       
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
    
    <div class="row content" style="display: none;" id="content3">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-border-style table-border-style">
                    <h5 class="d-inline-block mb-5">{{__('Proposal')}}</h5>

                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th> {{ __('Sr.') }}</th>
                                   <th> {{ __('Order No.') }}</th>
                                    <th> {{ __('Product Name') }}</th>
                                    <th> {{ __('Total Cost') }}</th>
                                    <th> {{ __('Quote Date') }}</th>
                                    <th> {{ __('Created by') }}</th>
                                    <th> {{ __('Status') }}</th>
                                     <th> {{ __('Order Status') }}</th>
                                    @if (Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation'))
                                        <th> {{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($orders)>0)
                            
                                        @php
                                         
                                         $productNames= [];
                                          $totalPrice = 0;
                                          $gtotal = 0;
                                          $created_by = \App\Models\User::find($quotation->created_by)->name;
                                        @endphp        
                                @foreach ($orders as $quotation)
                                    <tr style="margin-top: 30px;background: #F8FAFB;">
                                       
                                        <td>
                                            <div class="number-color ms-2" style="font-size:12px;background-color: {{ ($quotation->status == 1)?'#ffa21d':'#6fd943'}}">
                                                   {{ $quotation->id }}</div> 
                                           </td>
                                       <td class="Id">
                                            <a href="{{ route('quotation.order.view', \Crypt::encrypt($quotation->id)) }}"
                                                class="btn btn-outline-primary">{{Auth::user()->soNumberFormat($quotation->order_no == 0?$quotation->order_no+1:$quotation->order_no )  }}</a>
                                        </td>
                                        
                                        @if(count($quotation->items)>0)
                                       
                                        @foreach($quotation->items as $item)
                                        @php
                                         
                                         $quoteProduct = \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->first();
                                         $product = \App\Models\ProductService::find($item->id);
                                         $gtotal += $item->price * (!empty($quoteProduct)?$quoteProduct->quantity:1);
                                        
                                         
                                        @endphp
                                       
                                        @endforeach
                                         <td>
                                           @foreach($quotation->items as $item)
                                        @php
                                         
                                         $quoteProduct = \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->first();
                                         $product = \App\Models\ProductService::find($item->product_id);
                                        
                                         $gtotal = $item->price * (!empty($quoteProduct)?$quoteProduct->quantity:1);
                                        @endphp
                                        {{$product->name}} 
                                                   @if (!$loop->last)
                                                        ,
                                                    @endif
                                        @endforeach
                                                  </td>
                                        
                                        @php 
                                       
                                        $productNamesConcatenated = implode(', ', $productNames);
                                        @endphp
                                        
                                        
                                        
                                        <td>{{$gtotal }}</td>
                                       
                                        @else
                                         @php
                                        
                                         $quoteProduct = \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->first();
                                          $product = \App\Models\ProductService::find($quoteProduct->product_id);
                                        
                                         $totals =  $quoteProduct->price + $quoteProduct->tax;
                                        @endphp
                                        <td>{{$product->name}}</td>
                                        <td>{{$totals}}</td>
                                        @endif
                                        <td>{{ Auth::user()->dateFormat($quotation->quotation_date) }}</td>
                                        <td> {{ ($quotation->created_by != '') ? $created_by : '' }} </td>
                                       
                                         <td>{{ $quotation->status ==1?'Waiting for Approval':(($quotation->status ==2)?'Approved':(($quotation->status ==3)?'Send':'Pending')) }}</td>
                                          <td>{{ $quotation->order_status }}</td>
                                        @if (Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation'))
                                            <td class="Action">
                                                <span>

                                                    {{--@if ($quotation->is_converted == 0)
                                                        @can('convert quotation')
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="{{ route('poses.index', $quotation->id) }}"
                                                                    class="mx-3 btn btn-sm align-items-center"
                                                                    data-bs-toggle="tooltip" title="{{ __('Convert to POS') }}"
                                                                    data-original-title="{{ __('Detail') }}">
                                                                    <i class="ti ti-exchange text-white"></i>
                                                                </a>
                                                            </div>
                                                        @endcan 
                                                        @else
                                                        @can('show pos')
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="{{ route('pos.show', \Crypt::encrypt($quotation->converted_pos_id)) }}" class="mx-3 btn btn-sm align-items-center"
                                                                    data-bs-toggle="tooltip"
                                                                    title="{{ __('Already convert to POS') }}"
                                                                    data-original-title="{{ __('Detail') }}">
                                                                    <i class="ti ti-file text-white"></i>
                                                                </a>
                                                            </div>
                                                     @endcan 
                                                    @endif--}}
                                                     <div class="action-btn bg-light ms-2">
                                                                <a href="{{ route('quotation.order.view', \Crypt::encrypt($quotation->id)) }}"
                                                                    class="mx-3 btn btn-sm align-items-center"
                                                                    data-bs-toggle="tooltip" title="{{ __('View Quotation') }}"
                                                                    data-original-title="{{ __('Detail') }}">
                                                                    <i class="ti ti-eye text-dark"></i>
                                                                </a>
                                                            </div>
                                                    @can('edit quotation')
                                                        <div class="action-btn bg-light ms-2">
                                                            <a href="{{ route('quotation.edit', \Crypt::encrypt($quotation->id)) }}"
                                                                class="mx-3 btn btn-sm align-items-center"
                                                                data-bs-toggle="tooltip" title="Edit"
                                                                data-original-title="{{ __('Convert to JobCard') }}">
                                                                <i class="ti ti-pencil text-dark"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    {{--@can('delete quotation')
                                                        <div class="action-btn bg-danger ms-2">
                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['quotation.destroy', $quotation->id],
                                                                'class' => 'delete-form-btn',
                                                                'id' => 'delete-form-' . $quotation->id,
                                                            ]) !!}
                                                            <a href="#"
                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para"
                                                                data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                                data-original-title="{{ __('Delete') }}"
                                                                data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="document.getElementById('delete-form-{{ $quotation->id }}').submit();">
                                                                <i class="ti ti-trash text-white"></i>
                                                            </a>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    @endcan --}}
                                                </span>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="8" style="text-align:center;">Record not found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row content" style="display: none;" id="content4">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-border-style table-border-style">
                    <h5 class="d-inline-block mb-5">{{__('Jobcard')}}</h5>
                     <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th> {{ __('Sr.') }}</th>
                                    <th> {{ __('Ref No.') }}</th>
                                    <th> {{ __('Product Name') }}</th>
                                    <th> {{ __('Total Cost') }}</th>
                                    <th> {{ __('Quote Date') }}</th>
                                    <th> {{ __('Created by') }}</th>
                                    <th> {{ __('Card Request') }}</th>
                                     <th> {{ __('Status') }}</th>
                                    @if (Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation'))
                                        <th> {{ __('Order Acknowledge') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($jobcard)>0)
                                        @php
                                         $gtotal =  0;
                                         $total = 0;
                                         $created_by = \App\Models\User::find($quotation->created_by)->name;
                                        @endphp
                                @foreach ($jobcard as $quotation)
                                    <tr  style="margin-top: 30px;background: #F8FAFB;">
                                       
                                        <td>
                                            <div class="number-color ms-2" style="font-size:12px;background-color: {{ ($quotation->status == 0)?'#ffa21d':'#6fd943'}}">
                                                   {{ $quotation->id }}</div> 
                                           </td>
                                        <td class="Id">
                                            <a href="{{ route('quotation.show', \Crypt::encrypt($quotation->id)) }}"
                                                class="btn btn-outline-primary">{{ Auth::user()->jobNumberFormat($quotation->quotation_id) }}</a>
                                        </td>
                                        
                                        @if(count($quotation->items)>0)
                                       
                                       
                                        
                                           
                                         <td>
                                              @foreach($quotation->items as $item)
                                        @php
                                         
                                         $quoteProduct = \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->first();
                                         $products = \App\Models\ProductService::find($quoteProduct->product_id);
                                         $gtotal += $item->price * (!empty($quoteProduct)?$quoteProduct->quantity:1);
                                        @endphp
                                        {{$products->name}}
                                                 
                                                   @if (!$loop->last)
                                                        ,
                                                    @endif
                                                     @endforeach
                                                  </td>
                                       
                                        
                                        @if(isset($quoteProduct->tax))
                                        @php 
                                        $taxProduct = \App\Models\Tax::find($quoteProduct->tax);
                                        @endphp
                                        <td>{{!empty($taxProduct)?(($gtotal * $taxProduct->rate/100) + $total):$gtotal }}</td>
                                        @else
                                        <td> {{$gtotal}}</td>
                                        @endif
                                       
                                        @else
                                         @php
                                        
                                         $quoteProduct = \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->first();
                                          $product = \App\Models\ProductService::find($quoteProduct->product_id);
                                        
                                         $totals =  $quoteProduct->price + $quoteProduct->tax;
                                        @endphp
                                        <td>{{$product->name}}</td>
                                        <td>{{$totals}}</td>
                                        @endif
                                        <td>{{ Auth::user()->dateFormat($quotation->quotation_date) }}</td>
                                        <td> {{ ($quotation->created_by != '') ? $created_by : '' }} </td>
                                       
                                         <td>{{ $quotation->status ==1?'Waiting for Approval':(($quotation->status ==2)?'Approved':(($quotation->status ==3)?'Send':'Pending')) }}</td>
                                          <td>{{ $quotation->order_status }}</td>
                                        @if (Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation'))
                                            <td class="Action">
                                                <span>

                                                    @if ($quotation->is_converted == 0)
                                                        {{--@can('convert quotation')
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="{{ route('poses.index', $quotation->id) }}"
                                                                    class="mx-3 btn btn-sm align-items-center"
                                                                    data-bs-toggle="tooltip" title="{{ __('Convert to POS') }}"
                                                                    data-original-title="{{ __('Detail') }}">
                                                                    <i class="ti ti-exchange text-white"></i>
                                                                </a>
                                                            </div>
                                                        @endcan --}}
                                                        @else
                                                        {{-- @can('show pos') --}}
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="{{ route('pos.show', \Crypt::encrypt($quotation->converted_pos_id)) }}" class="mx-3 btn btn-sm align-items-center"
                                                                    data-bs-toggle="tooltip"
                                                                    title="{{ __('Already convert to POS') }}"
                                                                    data-original-title="{{ __('Detail') }}">
                                                                    <i class="ti ti-file text-white"></i>
                                                                </a>
                                                            </div>
                                                        {{-- @endcan --}}
                                                    @endif
                                                      @if($quotation->status ==1)
                                                     <div style="margin-left: 1rem !important;">
                                                            <a href="#"
                                                                class="btn btn-sm align-items-center text-light bg-dark"
                                                                data-bs-toggle="tooltip" title="Send to email"
                                                                data-original-title="{{ __('Send to Email') }}" style="background-color:#009900;border-radius: 20px;">
                                                               {{ __('Send to Email') }}
                                                            </a>
                                                        </div>  
                                                    @else
                                                     <div style="margin-left: 1rem !important;">
                                                            <a href="{{ route('jobcard.emails.send', \Crypt::encrypt($quotation->id)) }}"
                                                                class="btn btn-sm align-items-center text-light"
                                                                data-bs-toggle="tooltip" title="Send to email"
                                                                data-original-title="{{ __('Send to Email') }}" style="background-color:#009900;border-radius: 20px;">
                                                               {{ __('Send to Email') }}
                                                            </a>
                                                        </div>  
                                                    @endif       
                                                    {{--@can('edit quotation')
                                                        <div class="action-btn bg-primary ms-2">
                                                            <a href="{{ route('quotation.edit', \Crypt::encrypt($quotation->id)) }}"
                                                                class="mx-3 btn btn-sm align-items-center"
                                                                data-bs-toggle="tooltip" title="Edit"
                                                                data-original-title="{{ __('Convert to JobCard') }}">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                        </div>
                                                    @endcan --}}
                                                    {{--@can('delete quotation')
                                                        <div class="action-btn bg-danger ms-2">
                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['quotation.destroy', $quotation->id],
                                                                'class' => 'delete-form-btn',
                                                                'id' => 'delete-form-' . $quotation->id,
                                                            ]) !!}
                                                            <a href="#"
                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para"
                                                                data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                                data-original-title="{{ __('Delete') }}"
                                                                data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="document.getElementById('delete-form-{{ $quotation->id }}').submit();">
                                                                <i class="ti ti-trash text-white"></i>
                                                            </a>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    @endcan --}}
                                                </span>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                 @else
                                <tr>
                                    <td colspan="8" style="text-align:center;">Record not found</td>
                                </tr>
                                @endif
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script-page')
   <script>
    $(document).ready(function(){
       
        // Add click event listener to tabs
        $('.tab').click(function(){
            
            // Hide all content divs
            $('.content').hide();
            $('.tab').removeClass('active');
            // Get the target id from data attribute
            $(this).addClass('active');
            var targetId = $(this).data('target');
            
            // Show the corresponding content div
            $('#' + targetId).show();
        });
    });
</script>
@endpush


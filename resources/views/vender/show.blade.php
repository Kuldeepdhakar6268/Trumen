@extends('layouts.admin')
@push('script-page')
@endpush
@section('page-title')
    {{__('Manage Vendor-Detail')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('vender.index')}}">{{__('Vendor')}}</a></li>
    <li class="breadcrumb-item">{{$vendor['name']}}</li>

@endsection

@section('action-btn')
    <div class="float-end">
        @can('create bill')
            <a href="{{ route('bill.create',$vendor->id) }}" class="btn btn-sm btn-primary">
                {{__('Create Bill')}}
            </a>
        @endcan

        @can('edit vender')
            <a href="#" class="btn btn-sm btn-primary" data-size="xl" data-url="{{ route('vender.edit',$vendor['id']) }}" data-ajax-popup="true" title="{{__('Edit')}}" data-bs-toggle="tooltip" data-original-title="{{__('Edit')}}">
                <i class="ti ti-pencil"></i>
            </a>
        @endcan
        @can('delete vender')
            {!! Form::open(['method' => 'DELETE', 'route' => ['vender.destroy', $vendor['id']],'class'=>'delete-form-btn','id'=>'delete-form-'.$vendor['id']]) !!}
            <a href="#" class="btn btn-sm btn-danger bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{ $vendor['id']}}').submit();">
                <i class="ti ti-trash text-white"></i>
            </a>
            {!! Form::close() !!}
        @endcan
    </div>
@endsection

@section('content')
   {{-- <div class="row">
        <div class="col-md-4 col-lg-4 col-xl-4">
            <div class="card pb-0 customer-detail-box vendor_card">
                <div class="card-body">
                    <h5 class="card-title">{{__('Vendor Info')}}</h5>
                    <p class="card-text mb-0">{{$vendor->name}}</p>
                    <p class="card-text mb-0">{{$vendor->email}}</p>
                    <p class="card-text mb-0">{{$vendor->contact}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4">
            <div class="card pb-0 customer-detail-box vendor_card">
                <div class="card-body">
                    <h3 class="card-title">{{__('Billing Info')}}</h3>
                    <p class="card-text mb-0">{{$vendor->billing_name}}</p>
                    <p class="card-text mb-0">{{$vendor->billing_address}}</p>
                    <p class="card-text mb-0">{{$vendor->billing_city.', '. $vendor->billing_state .', '.$vendor->billing_zip}}</p>
                    <p class="card-text mb-0">{{$vendor->billing_country}}</p>
                    <p class="card-text mb-0">{{$vendor->billing_phone}}</p>

                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4">
            <div class="card pb-0 customer-detail-box vendor_card">
                <div class="card-body">
                    <h3 class="card-title">{{__('Shipping Info')}}</h3>
                    <p class="card-text mb-0">{{$vendor->shipping_name}}</p>
                    <p class="card-text mb-0">{{$vendor->shipping_address}}</p>
                    <p class="card-text mb-0">{{$vendor->shipping_city.', '. $vendor->shipping_state .', '.$vendor->shipping_zip}}</p>
                    <p class="card-text mb-0">{{$vendor->shipping_country}}</p>
                    <p class="card-text mb-0">{{$vendor->shipping_phone}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card pb-0">
                <div class="card-body">
                    <h5 class="card-title">{{__('Company Info')}}</h5>
                    <div class="row">
                        @php
                            $totalBillSum=$vendor->vendorTotalBillSum($vendor['id']);
                            $totalBill=$vendor->vendorTotalBill($vendor['id']);
                            $averageSale=($totalBillSum!=0)?$totalBillSum/$totalBill:0;
                        @endphp
                        <div class="col-md-3 col-sm-6">
                            <div class="p-4">
                                <p class="card-text mb-0">{{__('Vendor Id')}}</p>
                                <h6 class="report-text mb-3">{{\Auth::user()->venderNumberFormat($vendor->vender_id)}}</h6>
                                <p class="card-text mb-0">{{__('Total Sum of Bills')}}</p>
                                <h6 class="report-text mb-0">{{\Auth::user()->priceFormat($totalBillSum)}}</h6>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="p-4">
                                <p class="card-text mb-0">{{__('Date of Creation')}}</p>
                                <h6 class="report-text mb-3">{{\Auth::user()->dateFormat($vendor->created_at)}}</h6>
                                <p class="card-text mb-0">{{__('Quantity of Bills')}}</p>
                                <h6 class="report-text mb-0">{{$totalBill}}</h6>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="p-4">
                                <p class="card-text mb-0">{{__('Balance')}}</p>
                                <h6 class="report-text mb-3">{{\Auth::user()->priceFormat($vendor->balance)}}</h6>
                                <p class="card-text mb-0">{{__('Average Sales')}}</p>
                                <h6 class="report-text mb-0">{{\Auth::user()->priceFormat($averageSale)}}</h6>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="p-4">
                                <p class="card-text mb-0">{{__('Overdue')}}</p>
                                <h6 class="report-text mb-3">{{\Auth::user()->priceFormat($vendor->vendorOverdue($vendor->id))}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <h5 class=" d-inline-block mb-5">{{__('Bills')}}</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{__('Bill')}}</th>
                                <th>{{__('Bill Date')}}</th>
                                <th>{{__('Due Date')}}</th>
                                <th>{{__('Due Amount')}}</th>
                                <th>{{__('Status')}}</th>
                                @if(Gate::check('edit bill') || Gate::check('delete bill') || Gate::check('show bill'))
                                    <th width="10%"> {{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>

                            <tbody>
                                @foreach ($vendor->vendorBill($vendor->id) as $bill)
                                <tr class="font-style">
                                    <td class="Id">
                                        <a href="{{ route('bill.show',\Crypt::encrypt($bill->id)) }}" class="btn btn-outline-primary">{{ AUth::user()->billNumberFormat($bill->bill_id) }}
                                        </a>
                                    </td>
                                    <td>{{ Auth::user()->dateFormat($bill->bill_date) }}</td>
                                    <td>
                                        @if(($bill->due_date < date('Y-m-d')))
                                            <p class="text-danger"> {{ \Auth::user()->dateFormat($bill->due_date) }}</p>
                                        @else
                                            {{ \Auth::user()->dateFormat($bill->due_date) }}
                                            @endif
                                        </td>
                                    <td>{{\Auth::user()->priceFormat($bill->getDue())  }}</td>
                                    <td>
                                        @if($bill->status == 0)
                                            <span class="badge bg-primary p-2 px-3 rounded">{{ __(\App\Models\Invoice::$statues[$bill->status]) }}</span>
                                        @elseif($bill->status == 1)
                                            <span class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\Invoice::$statues[$bill->status]) }}</span>
                                        @elseif($bill->status == 2)
                                            <span class="badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\Invoice::$statues[$bill->status]) }}</span>
                                        @elseif($bill->status == 3)
                                            <span class="badge bg-info p-2 px-3 rounded">{{ __(\App\Models\Invoice::$statues[$bill->status]) }}</span>
                                        @elseif($bill->status == 4)
                                            <span class="badge bg-success p-2 px-3 rounded">{{ __(\App\Models\Invoice::$statues[$bill->status]) }}</span>
                                        @endif
                                    </td>
                                    @if(Gate::check('edit bill') || Gate::check('delete bill') || Gate::check('show bill'))
                                        <td class="Action">
                                            <span>
                                            @can('duplicate bill')
                                                    <div class="action-btn bg-success ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="{{__('Duplicate Bill')}}" data-original-title="{{__('Duplicate')}}" data-confirm="You want to confirm this action. Press Yes to continue or Cancel to go back" data-confirm-yes="document.getElementById('duplicate-form-{{$bill->id}}').submit();">
                                                            <i class="ti ti-copy text-white text-white"></i>
                                                            {!! Form::open(['method' => 'get', 'route' => ['bill.duplicate', $bill->id],'id'=>'duplicate-form-'.$bill->id]) !!}{!! Form::close() !!}
                                                        </a>
                                                    </div>
                                                @endcan
                                                @can('show bill')

                                                    <div class="action-btn bg-info ms-2">
                                                            <a href="{{ route('bill.show',\Crypt::encrypt($bill->id)) }}" class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="{{__('Show')}}" data-original-title="{{__('Detail')}}">
                                                                <i class="ti ti-eye text-white text-white"></i>
                                                            </a>
                                                        </div>
                                                @endcan
                                                @can('edit bill')
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="{{ route('bill.edit',\Crypt::encrypt($bill->id)) }}" class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-original-title="{{__('Edit')}}">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                @endcan
                                                @can('delete bill')
                                                    <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['bill.destroy', $bill->id],'id'=>'delete-form-'.$bill->id]) !!}

                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" data-original-title="{{__('Delete')}}" title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$bill->id}}').submit();">
                                                            <i class="ti ti-trash text-white text-white"></i>
                                                        </a>
                                                    {!! Form::close() !!}
                                                    </div>
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
    </div>--}}
      <div class="row ">
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('name',__('Company Name'),array('class'=>'form-label')) }}<span class="text-danger">*</span>
                 {{Form::text('name',$vendor->name,array('class'=>'form-control','required'=>'required' , 'readonly', 'style' =>'background-color: #efe9e9;', 'placeholder'=>__('M & S Gourav Gases')))}}
 
             </div>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('contact_person',__('Contact Person'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('contact_person',$vendor->contact_person,array('class'=>'form-control','required'=>'required' , 'readonly', 'style' =>'background-color: #efe9e9;','placeholder' => __('Mahi Sharma')))}}
 
             </div>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('email',__('Email'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::email('email',$vendor->email,array('class'=>'form-control','required'=>'required' , 'readonly', 'style' =>'background-color: #efe9e9;','placeholder' => __('m&m@gmail.com')))}}
             </div>
         </div>
 
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('sector',__('Sector'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('sector',$vendor->sector,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('Sector')))}}
             </div>
         </div>
 
           <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('industry',__('Industry'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('industry',$vendor->industry,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('Manufacturing')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('tax_number',__('GSTIN'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('tax_number',$vendor->tax_number,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('213242453234')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('contact',__('Number'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('contact',$vendor->contact,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('9999999999')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('alternate',__('Alternative Number'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('alternate',$vendor->alternate,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('9999999999')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('plot_number',__('Plot Number'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('plot_number',$vendor->plot_number,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('Dreamland 202')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('land_mark',__('Land Mark'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('land_mark',$vendor->land_mark,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('Dreamland 202')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('street_name',__('Street Name'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('street_name',$vendor->street_name,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('Anand Bazar')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('area_name',__('Area Name'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('area_name',$vendor->area_name,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('Old Palasia')))}}
             </div>
         </div>
         
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('pincode',__('Pincode'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('pincode',$vendor->pincode,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('454720')))}}
             </div>
         </div>
       
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('city',__('City'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('city',$vendor->city,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('Indore')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('state',__('State'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('state',$vendor->state,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('Madhy Pradesh')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('country',__('Country'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('country',$vendor->country,array('class'=>'form-control' , 'required'=>'required', 'readonly', 'style' =>'background-color: #efe9e9;','placeholder'=>__('India')))}}
             </div>
         </div>
 
        
     </div>
@endsection

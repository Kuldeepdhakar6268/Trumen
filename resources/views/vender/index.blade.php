@extends('layouts.admin')
@php
$profile = asset(Storage::url('uploads/avatar/'));
@endphp
@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <style>
    /* Hide default arrow */
     #loading {
    position: fixed;
    width: 100%;
    height: 100vh;
    background: #fff url('images/loader.gif') no-repeat center center;
    z-index: 9999;
    }
    
    input[type="text"]::-webkit-input-placeholder {
         color: var(--color-customColor);
    font-weight: bold;
    }
    input:-moz-placeholder {
  color: red; /* Change to your desired color */
  opacity: 1; /* Adjust as needed */
}
    .dataTable-container{
            margin-top: -15px;
    }
    .dataTable-table tbody tr td {
        padding: 7px 0px 7px 0px;
    }
    .dataTable-table tbody tr td {
    padding: 7px 0px 5px 18px !important;
}
.number-color {
    width: 80px !important;
    height: 78px !important;
    padding-top: 25px !important;
    font-size: 15px !important;
    margin-top: -54px !important;
    margin-left: -25px !important;
    margin-bottom: -35px !important;
}
    </style>
@push('script-page')
    <script>
        jQuery(document).ready(function() {
         jQuery('#loading').fadeOut(3000);
        });
        $(document).on('click', '#billing_data', function() {
            $("[name='shipping_name']").val($("[name='billing_name']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_phone']").val($("[name='billing_phone']").val());
            $("[name='shipping_zip']").val($("[name='billing_zip']").val());
            $("[name='shipping_address']").val($("[name='billing_address']").val());
        })
    </script>
@endpush
@section('page-title')
    {{ __('Manage Vendors') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Vendor')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        <a href="#" class="btn btn-sm btn-primary" data-url="{{ route('vender.file.import') }}" data-ajax-popup="true" data-bs-toggle="tooltip"
           title="{{ __('Import') }}">
        
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M4 19H20V12H22V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V12H4V19ZM13 9V16H11V9H6L12 3L18 9H13Z"></path></svg>
            {{ __('Import') }}
        </a>

        <a href="{{ route('vender.export') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="{{ __('Export') }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M13 10H18L12 16L6 10H11V3H13V10ZM4 19H20V12H22V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V12H4V19Z"></path></svg>
        {{ __('Export') }}
    </a>
        
        

        @can('create vender')
            <a href="{{ route('vender.create') }}" data-bs-toggle="tooltip" title="{{ __('Create') }}" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
                {{ __('Add New Vendor') }}
            </a>
        @endcan

    </div>
@endsection
@section('content')
 <div id="loading"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark rounded-5 border">
                                <tr>
                                    <th style="border-top-left-radius: 30px;border-bottom-left-radius: 30px;">{{_('Sr.')}}</th>
                                    <th>{{ __('Vendor Name') }}</th>
                                    <th>{{ __('Company Name') }}</th>
                                    <th>{{ __('Phone Number') }}</th>
                                    <th>{{ __('Prepared By') }}</th>
                                    <th>{{ __('Quotation Date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th style="border-top-right-radius: 30px;border-bottom-right-radius: 30px;">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($venders as $k => $Vender)
                                    <tr class="cust_tr" id="vend_detail">
                                       
                                        <td>
                                           {{-- @can('show vender')
                                                <a href="{{ route('vender.show', \Crypt::encrypt($Vender['id'])) }}" class="btn btn-outline-primary">
                                                    {{ AUth::user()->venderNumberFormat($Vender['vender_id']) }}
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-outline-primary"> {{ AUth::user()->venderNumberFormat($Vender['vender_id']) }}
                                                </a>
                                            @endcan --}}
                                             <div class="number-color" style="font-size:12px;background-color: {{ $Vender['status'] =='Waiting'?'#BFBBBB':(($Vender['status'] =='Approved')?'#28941F':'#EA4E44')}}">
                                                  {{ $Vender['vender_id'] }}</div> 
                                        </td>
                                        <td>{{ $Vender['name'] }}</td>
                                        <td>{{ $Vender['company_name'] }}</td>
                                        <td>{{ $Vender['contact'] }}</td>
                                        <td>{{ $Vender->createdBy->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($Vender['created_at'])->format('d/m/Y') }}</td>
                                        <td>{{ $Vender['status'] }}</td>
                                        <td class="Action">
                                            <span>
                                                    @if ($Vender['is_active'] == 0)
                                                        <i class="fa fa-lock" title="Inactive"></i>
                                                    @else
                                                        @can('show vender')
                                                            <div class="action-btn bg-light ms-2">
                                                                <a href="{{ route('vender.show', \Crypt::encrypt($Vender['id'])) }}"
                                                                    class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip"
                                                                    title="{{ __('View') }}">
                                                                    <i class="ti ti-eye text-dark"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('edit vender')
                                                            <div class="action-btn bg-light ms-2">
                                                                <a href="{{ route('vender.edit', $Vender['id']) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" data-original-title="{{ __('Edit') }}">
                                                                    <i class="ti ti-pencil text-dark"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        {{--@can('delete vender')
                                                            <div class="action-btn bg-light ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['vender.destroy', $Vender['id']], 'id' => 'delete-form-' . $Vender['id']]) !!}
                                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip"
                                                                           data-original-title="{{ __('Delete') }}" title="{{ __('Delete') }}"
                                                                           data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                                           data-confirm-yes="document.getElementById('delete-form-{{ $Vender['id'] }}').submit();">
                                                                        <i class="ti ti-trash text-white text-dark"></i>
                                                                    </a>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        @endcan --}}
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

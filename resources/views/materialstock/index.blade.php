@extends('layouts.admin')
@section('page-title')
    {{__('Manage Material Stock')}}
@endsection
@push('css-page')
   
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
    /* Hide default arrow */
input[type="text"]::-webkit-input-placeholder {
    color: red;
}
.dataTable-table {
    table-layout: auto;
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
.dataTable-table td:not(:first-child) {       padding-left: 10px !important;
   }
    </style>
@endpush
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Material Stock')}}</li>
@endsection
@section('action-btn')
@endsection
@section('action-btn')
    <div class="float-end">
        <a href="#" data-size="md"  data-bs-toggle="tooltip" title="{{__('Import')}}" data-url="{{ route('productservice.file.import') }}" data-ajax-popup="true" data-title="{{__('Import product CSV file')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-file-import"></i>
        </a>
        <a href="{{route('productservice.export')}}" data-bs-toggle="tooltip" title="{{__('Export')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-file-export"></i>
        </a>

        <a href="{{ route('productservice.create') }}" data-bs-toggle="tooltip" title="{{__('Create New Product')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>

    </div>
@endsection
@section('content')
<div class="row" style="padding:21px;">   
    <div class="col-md-8">
          <a href="{{ route('materialstock.create') }}" data-bs-toggle="tooltip" title="{{__('Create New Product')}}" class="btn btn-outline-light text-primary" style="margin-left: 15px;box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.2), 0 2px 5px 0 rgba(0, 0, 0, 0.19);
  text-align: center;">
            <i class="ti ti-plus" style="border: 1px solid;border-radius:5px;"></i>
             {{__('Add New Stock')}}
        </a>
       
        </div>
        <div class="col-md-4">
       
    </div>
    </div>
    <div class="row">
                   <div class="col-sm-4 form-group">
                       <select class="form-control select" name="priority_id">
                           <option value="0">Current Stock</option>
                           <option value="1">Total Stock</option>
                           <option value="2">Product wise Stock</option>
                           
                           </select>
                   </div>
                  
                   <div class="col-sm-4 form-group">
                       {{ Form::select('mList', $mList,null, array('class' => 'form-control select')) }}
                   </div>
                   <div class="col-sm-4 form-group" >
                   </div>
                  
            </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                            <tr>
                                <th>{{ __('Sr.') }}</th>
                                <th>{{ __('Material Code') }}</th>
                                <th>{{ __('Material Name') }}</th>
                                <th>{{ __('Unit Price') }}</th>
                                <th>{{ __('Current Quantity') }}</th>
                                <th>{{ __('Stock Value') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($materials as $material)
                                <tr class="font-style">
                                    <td>
                                        <div class="number-color" style="background-color:#28941F;width: 50px;height: 40px;">
                                        {{ $loop->iteration }}</div>
                                        </td>
                                    <td>{{ $material->material_code }}</td>
                                    <td>{{ $material->material_name }}</td>
                                    <td>{{ $material->unit_price }}</td>
                                    <td>{{ $material->current_qty }}</td>
                                    <td>{{ $material->stock_value }}</td>

                                    <td class="Action">
                                        <div class="action-btn bg-info ms-2">
                                            <a href="{{ route('materialstock.edit', $material->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" title="{{__('Update Quantity')}}">
                                                <i class="ti ti-plus text-white"></i>
                                            </a>
                                        </div>


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

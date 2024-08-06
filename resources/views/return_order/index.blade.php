@extends('layouts.admin')
@section('page-title')
    {{__('Manage Return Order')}}
@endsection
@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/dropzone.min.css')}}">
   <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
<style>
#loading {
position: fixed;
width: 100%;
height: 100vh;
background: #fff url('images/loader.gif') no-repeat center center;
z-index: 9999;
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
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Return Order')}}</li>
@endsection
@push('script-page')
    <script>
     $(document).ready(function() {
            $('.dataTables-empty').text('No Data Available..');
     });
         jQuery(document).ready(function() {
    jQuery('#loading').fadeOut(1000);
});
 
        $('.copy_link').click(function (e) {
            e.preventDefault();
            var copyText = $(this).attr('href');

            document.addEventListener('copy', function (e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);

            document.execCommand('copy');
            show_toastr('success', 'Url copied to clipboard', 'success');
        });
    </script>
@endpush


@section('action-btn')
    <div class="float-end">


{{--        <a href="{{ route('bill.export') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="{{__('Export')}}">--}}
{{--            <i class="ti ti-file-export"></i>--}}
{{--        </a>--}}

        @can('create purchase')
         <a href="{{ route('orderReturn.create') }}" data-bs-toggle="tooltip" title="{{__(' Create Return Order')}}" class="btn btn-outline-light text-primary" style="margin-left: 15px;box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.2), 0 2px 5px 0 rgba(0, 0, 0, 0.19); text-align: center;font-weight:bold">
            <i class="ti ti-plus text-primary" style="border: 1px solid;border-radius:5px;"></i>&nbsp;&nbsp;&nbsp;{{__(' Create Return Order')}}
        </a>
           {{-- <a href="{{ route('purchase.create',0) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="{{__('Create')}}">
                <i class="ti ti-plus"></i>
                Create Purchase Order
            </a> --}}
        @endcan
    </div>
@endsection


@section('content')
<div id="loading"></div>

    <div class="row" style="margin-top: 15px;">
        <div class="col-md-15">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark " >
                            <tr>
                            <th style="border-top-left-radius: 30px; border-bottom-left-radius: 30px;"> {{__('Sr.')}}</th>
                               <th class="px-3"> {{__('Equipment')}}</th>
                                <th class="px-3"> {{__('Request Date')}}</th>
                                  <th> {{__('Vendor')}}</th>
                                <th> {{__('Prepared by')}}</th>
                                <th> {{__('Approved by')}}</th>
                                <th> {{__('Quantity')}}</th>
                                
                                <th>{{__('Order Amount')}}</th>
                                <th>{{__('Order Status')}}</th>
                                
                                @if(Gate::check('edit purchase') || Gate::check('delete purchase') || Gate::check('show purchase'))
                                    <th style="border-top-right-radius: 30px;border-bottom-right-radius: 30px;" > {{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            @php
                            $qty = 0;
                            $totalAmt = 0;
                            $resultstr = [];
                            @endphp
                            @foreach ($purchases as $purchase)

                                <tr>
                                    <td class="Id">
                                      
                                          
                                        <div class="number-color ms-2" style="font-size:12px;background-color: {{  $purchase->items[0]->orderRequest->status =='Waiting for Approval'?'#ff5000':(($purchase->items[0]->orderRequest->status =='Approved')?'#6fd943':(($purchase->items[0]->orderRequest->status =='Recieved')?'#6610f2':(($purchase->items[0]->orderRequest->status =='Draft')?'#C9BABA':'#ffa21d')))}}">
                                        {{$purchase->purchase_code }}</div>  
                                               
                                               
                                    </td>
                                    
                                   
                                     <td>
                                        @foreach($purchase->items as $item)  
                                      
                                          
                                          @php 
                                          $resultstr[] = (!empty($item->orderRequest->material)?$item->orderRequest->material->material_name:'');
                                        
                                          $qty += $item->r_quantity;
                                          $totalAmt += $item->price * $qty;
                                          @endphp
                                        @endforeach  
                                        {{implode(",",$resultstr)}}
                                          </td> 
                                    <!-- <td>{{ !empty($purchase->category)?$purchase->category->name:''}}</td> -->
                                     <td>{{ Auth::user()->dateFormat($purchase->purchase_date) }}</td> 
                                     <td> {{ (!empty( $purchase->vender)?$purchase->vender->name:'') }} </td>
                                    
                                    <td>{{Auth()->user()->name}}</td>
                                   
                                    <td>{{$purchase->items[0]->orderRequest->createdBy->name}}</td>
                                    <td>{{$qty}}</td>
                                    <td>{{$totalAmt}}</td>
                                    <td>{{$purchase->items[0]->orderRequest->status}}</td>




                                    @if(Gate::check('edit purchase') || Gate::check('delete purchase') || Gate::check('show purchase'))
                                        <td class="Action">
                                            <span>

                                                @can('show purchase')
                                                    <div class="action-btn bg-info ms-2">
                                                            <a href="{{ route('orderReturn.show',\Crypt::encrypt($purchase->id)) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Show')}}" data-original-title="{{__('Detail')}}">
                                                                <i class="ti ti-eye text-white"></i>
                                                            </a>
                                                        </div>
                                                @endcan
                                                @can('edit purchase')
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="{{ route('orderReturn.edit',\Crypt::encrypt($purchase->id)) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="Edit" data-original-title="{{__('Edit')}}">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                @endcan
                                                @can('delete purchase')
                                                    <div class="action-btn bg-danger ms-2">
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['orderReturn.destroy', $purchase->id],'class'=>'delete-form-btn','id'=>'delete-form-'.$purchase->id]) !!}
                                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$purchase->id}}').submit();">
                                                            <i class="ti ti-trash text-white"></i>
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
    </div>
@endsection


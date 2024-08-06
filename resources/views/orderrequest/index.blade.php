@extends('layouts.admin')
@section('page-title')
    {{__('Manage Purchase Request')}}
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
    <li class="breadcrumb-item">{{__('Order Request')}}</li>
@endsection
 
@push('script-page')
    <script>
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
    <div class="float-end" style="padding-bottom: 15px;">


{{--        <a href="{{ route('bill.export') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="{{__('Export')}}">--}}
{{--            <i class="ti ti-file-export"></i>--}}
{{--        </a>--}}

        @can('create purchase')
            <a href="{{ route('order.create',0) }}" data-bs-toggle="tooltip" title="{{__('Request For Purchase Order')}}" class="btn btn-outline-light text-primary" style="margin-left: 15px;box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.2), 0 2px 5px 0 rgba(0, 0, 0, 0.19); text-align: center;font-weight:bold">
            <i class="ti ti-plus text-primary" style="border: 1px solid;border-radius:5px;"></i>&nbsp;&nbsp;&nbsp;{{__('Request For Purchase Order')}}
        </a>
           {{-- <a href="{{ route('order.create',0) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="{{__('Create')}}">
                <i class="ti ti-plus"></i>
                Request For Purchase Order
            </a>--}}
        @endcan
    </div>
@endsection


@section('content')
  <div id="loading"></div>

    <div class="row" id="contents">
        <div class="col-md-15">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark " >
                            <tr>
                            <th style="border-top-left-radius: 30px; border-bottom-left-radius: 30px;"> {{__('Sr.')}}</th>
                                <th> {{__('Equipments Name')}}</th>
                                <th class="px-3"> {{__('Request Date')}}</th>
                                <th> {{__('Prepared by')}}</th>
                                <th> {{__('Approved by')}}</th>
                                <th>{{__('Order Priority')}}</th>
                                <th>{{__('Order Status')}}</th>
                                
                                @if(Gate::check('edit purchase') || Gate::check('delete purchase') || Gate::check('show purchase'))
                                    <th style="border-top-right-radius: 30px;border-bottom-right-radius: 30px;" > {{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>


                            @foreach ($orders as $key => $order)

                                <tr>
                                    <td class="Id">
                                         <div class="number-color ms-2" style="font-size:12px;background-color: {{  $order->status =='Waiting for Approval'?'#ff5000':(($order->status =='Approved')?'#6fd943':(($order->status =='Recieved')?'#6610f2':(($order->status =='Draft')?'#C9BABA':'#ffa21d')))}}">
                                                  {{ ($key + 1) }}</div> 
                                      
                                    </td>

                                  
                                     <td>{{$order->material->material_name}}</td>
                                    <td>{{$order->created_date}}</td>
                                    <td>{{$order->createdBy->name}}</td>
                                  
                                    <td>{{$order->approvedBy != ''?$order->approvedBy->name:$order->createdBy->name}}</td>
                                    <td>{{$order->priority}}</td>
                                    <td>{{$order->status}}</td>




                                    @if(Gate::check('edit purchase') || Gate::check('delete purchase') || Gate::check('show purchase'))
                                        <td class="Action">
                                            <span>

                                                @can('show purchase')
                                                    <div class="action-btn bg-info ms-2">
                                                            <a href="{{ route('order.show',\Crypt::encrypt($order->id)) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{__('Show')}}" data-original-title="{{__('Detail')}}">
                                                                <i class="ti ti-eye text-white"></i>
                                                            </a>
                                                        </div>
                                                @endcan
                                                @can('edit purchase')
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="{{ route('order.edit',\Crypt::encrypt($order->id)) }}" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="Edit" data-original-title="{{__('Edit')}}">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                @endcan
                                                @can('delete purchase')
                                                    <div class="action-btn bg-danger ms-2">
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['order.destroy', $order->id],'class'=>'delete-form-btn','id'=>'delete-form-'.$order->id]) !!}
                                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$order->id}}').submit();">
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


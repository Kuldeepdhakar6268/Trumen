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
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
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
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#date-range').daterangepicker({
    opens: 'left',
    drops: 'down',
    autoApply: true,
    locale: {
      format: 'YYYY-MM-DD',
      separator: ' To ',
      applyLabel: 'Apply',
      cancelLabel: 'Cancel',
      fromLabel: 'From',
      toLabel: 'To',
      customRangeLabel: 'Custom',
      daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
      monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      firstDay: 0
    }
  });
  $('#date-range').change(function (){
      $(this).val();
      $("#daterange").val($(this).val())
  })
        });
    </script>
   

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
                <div class="card">
                {{ Form::open(array('url' => 'order/request/search','method'=> 'GET', 'id'=> 'order_request_filter')) }}
                <div class="row pt-5">
               
                <div class="col-sm-1 form-group">
                        <span class="" style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-primary text-danger form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='';" onclick="document.getElementById('order_request_filter').submit(); return false;"></span>
                      
                   </div>
                <input type="hidden" id="daterange">   
                <div class="col-sm-3 form-group">
                        <input type="text" class="form-control" name="date" value="{{$date}}" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" style="height: 45px;" id="date-range">
                       {{--<img src="{{ asset('assets/images/date-icon.png') }}" width="30" alt="india" style="position: absolute;margin-top: -37px;margin-left: 110px;" id="dateIcon"/>--}}
                   </div>
                <div class="col-sm-2 form-group">
                    <select class="form-control select" name="created_by">
                           <option value="">Prepared By</option>
                           @foreach($emp as $e)
                          
                           <option value="{{$e->id}}" {{Request::get('created_by') == $e->id?'selected':''}}>{{$e->name}} </option>
                          @endforeach
                           </select>
                      
                   </div>

                   <div class="col-sm-2 form-group">
                        <select class="form-control select" name="approved_by">
                           <option value="">Approved By</option>
                           @foreach($users as $u)
                          
                           <option value="{{$u->id}}" {{Request::get('approved_by') == $u->id?'selected':''}}>{{$u->name}} </option>
                          @endforeach
                           </select>
                       
                   </div>

                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="status">
                           <option value="">Status</option>
                           <option value="Draft" {{Request::get('status')== 'Draft'?'selected':''}}>Draft </option>
                           <option value="Waiting for Approval" {{Request::get('status')== 'Waiting for Approval'?'selected':''}}>Waiting for Approval</option>
                           <option value="Approved" {{Request::get('status')== 'Approved'?'selected':''}}>Approved</option>
                           <option value="Send" {{Request::get('status')== 'Send'?'selected':''}}>Send</option>

                           </select>
                   </div>

                   <div class="col-sm-2 form-group">
                       <select class="form-control select" name="priority">
                           <option value="">Priority</option>
                           <option value="Low" {{Request::get('priority')== 'Low'?'selected':''}}>Low </option>
                           <option value="Medium" {{Request::get('priority')== 'Medium'?'selected':''}}>Medium</option>
                           <option value="High" {{Request::get('priority')== 'High'?'selected':''}}>High</option>
                           <option value="Immidiate" {{Request::get('priority')== 'Immidiate'?'selected':''}}>Immidiate</option>

                           </select>
                   </div>
                </div>
                 {{Form::close()}}
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


@extends('layouts.admin')
@section('page-title')
    {{__('Order Request Detail')}}
@endsection

@php
    $settings = Utility::settings();
@endphp
@push('script-page')
    <script>
        $(document).on('click', '#shipping', function () {
            var url = $(this).data('url');
            var is_display = $("#shipping").is(":checked");
            $.ajax({
                url: url,
                type: 'get',
                data: {
                    'is_display': is_display,
                },
                success: function (data) {
                    // console.log(data);
                }
            });
        })


    </script>
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('purchase.index')}}">{{__('Oreder Request')}}</a></li>
    <li class="breadcrumb-item">{{ Auth::user()->orderNumberFormat($purchase->id) }}</li>
@endsection

@section('content')

  {{--  @can('send purchase')
        @if($purchase->status!=4)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row timeline-wrapper">
                                <div class="col-md-6 col-lg-4 col-xl-4 create_invoice">
                                    <div class="timeline-icons"><span class="timeline-dots"></span>
                                        <i class="ti ti-plus text-primary"></i>
                                    </div>
                                    <h6 class="text-primary my-3">{{__('Create Purchase')}}</h6>
                                    <p class="text-muted text-sm mb-3"><i class="ti ti-clock mr-2"></i>{{__('Created on ')}}{{\Auth::user()->dateFormat($purchase->purchase_date)}}</p>
                                    @can('edit purchase')
                                        <a href="{{ route('purchase.edit',\Crypt::encrypt($purchase->id)) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="ti ti-pencil mr-2"></i>{{__('Edit')}}</a>

                                    @endcan
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-4 send_invoice">
                                    <div class="timeline-icons"><span class="timeline-dots"></span>
                                        <i class="ti ti-mail text-warning"></i>
                                    </div>
                                    <h6 class="text-warning my-3">{{__('Send Purchase')}}</h6>
                                    <p class="text-muted text-sm mb-3">
                                        @if($purchase->status!=0)
                                            <i class="ti ti-clock mr-2"></i>{{__('Sent on')}} {{\Auth::user()->dateFormat($purchase->send_date)}}
                                        @else
                                            @can('send purchase')
                                                <small>{{__('Status')}} : {{__('Not Sent')}}</small>
                                            @endcan
                                        @endif
                                    </p>

                                    @if($purchase->status==0)
                                        @can('send purchase')
                                            <a href="{{ route('purchase.sent',$purchase->id) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-original-title="{{__('Mark Sent')}}"><i class="ti ti-send mr-2"></i>{{__('Send')}}</a>
                                        @endcan
                                    @endif
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-4 create_invoice">
                                    <div class="timeline-icons"><span class="timeline-dots"></span>
                                        <i class="ti ti-report-money text-info"></i>
                                    </div>
                                    <h6 class="text-info my-3">{{__('Get Paid')}}</h6>
                                    <p class="text-muted text-sm mb-3">{{__('Status')}} : {{__('Awaiting payment')}} </p>
                                    @if($purchase->status!= 0)
                                        @can('create payment purchase')
                                            <a href="#" data-url="{{ route('purchase.payment',$purchase->id) }}" data-ajax-popup="true" data-title="{{__('Add Payment')}}" class="btn btn-sm btn-info" data-original-title="{{__('Add Payment')}}"><i class="ti ti-report-money mr-2"></i>{{__('Add Payment')}}</a> <br>
                                        @endcan
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endcan

   @if(\Auth::user()->type=='company')
        @if($purchase->status!=0)
            <div class="row justify-content-between align-items-center mb-3">
                <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">

                    <div class="all-button-box mx-2">
                        <a href="{{ route('purchase.resent',$purchase->id) }}" class="btn btn-sm btn-primary">
                            {{__('Resend Purchase')}}
                        </a>
                    </div>
                    <div class="all-button-box">
                        <a href="{{ route('purchase.pdf', Crypt::encrypt($purchase->id))}}" target="_blank" class="btn btn-sm btn-primary">
                            {{__('Download')}}
                        </a>
                    </div>
                </div>
            </div>
        @endif

    @endif --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice">
                        <div class="invoice-print">
                            <div class="row invoice-title mt-2">
                                <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                                    <h4>{{__('Order Request')}}</h4>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                                    <h4 class="invoice-number">{{ Auth::user()->orderNumberFormat($purchase->id) }}</h4>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                 <div class="col-6 text-start">
                                    <div class="d-flex align-items-center justify-content-start">
                                       <div class="col-6">
                                    <small>
                                        <strong>{{__('Status')}} :</strong><br>
                                            <span class="badge bg-success p-2 px-3 rounded">{{ __($purchase->status) }}</span>
                                    </small>
                                </div>
                                  <div class="col-6">
                                    <small>
                                        <strong>{{__('Priority')}} :</strong><br>
                                            <span class="badge bg-success p-2 px-3 rounded">{{ $purchase->priority }}</span>
                                    </small>
                                </div>

                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <div class="me-4">
                                            <small>
                                                <strong>{{__('Issue Date')}} :</strong><br>
                                                {{\Auth::user()->dateFormat($purchase->created_date)}}<br><br>
                                            </small>
                                        </div>

                                    </div>
                                </div>
                            </div>


                          
                          
                             
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="font-bold mb-2">{{__('Material Summary')}}</div>
                                  
                                    <div class="table-responsive mt-3">
                                        <table class="table ">
                                            <tr>
                                                <th class="text-dark" data-width="40">#</th>
                                                <th class="text-dark">{{__('Material')}}</th>
                                                <th class="text-dark">{{__('Quantity')}}</th>
                                                <th class="text-dark">{{__('Rate')}}</th>
                                                <th class="text-dark">{{__('Discount')}}</th>
                                                <th class="text-dark">{{__('Tax')}}</th>
                                                <th class="text-dark">{{__('Description')}}</th>
                                                <th class="text-end text-dark" width="12%">{{__('Price')}}<br>
                                                    <small class="text-danger font-weight-bold">{{__('after tax & discount')}}</small>
                                                </th>
                                                <th></th>
                                            </tr>
                                            @php
                                                $totalQuantity=0;
                                                $totalRate=0;
                                                $totalTaxPrice=0;
                                                $totalDiscount=0;
                                                $taxesData=[];
                                            @endphp

                                          
                                               
                                                <tr>
                                                    <td>{{1}}</td>
                                                    <td>{{!empty($iteams)?$iteams->material_name:''}}</td>
                                                    <td>{{$purchase->qty}}</td>
                                                    <td>{{\Auth::user()->priceFormat($purchase->price)}}</td>
                                                    <td>{{\Auth::user()->priceFormat($purchase->discount)}}</td>

                                                    @php
                                                   
                                                    $totalRate += $purchase->price * $purchase->qty;
                                                    $totalDiscount += $purchase->discount;
                                                @endphp
                                                   
                                                    <td>
                                                       
                                                    </td>
                                                    <td>{{!empty($purchase->note)?$purchase->note:'-'}}</td>
                                                    <td class="text-end">{{$purchase->price * $purchase->qty}}</td>
                                                </tr>
                                           
                                          
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  


@endsection

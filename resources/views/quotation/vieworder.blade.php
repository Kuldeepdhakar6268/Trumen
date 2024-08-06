@extends('layouts.admin')
@section('page-title')
    {{__('Order Detail')}}
@endsection
<style>
*{
    padding: 0;
    margin: 0;
   box-sizing: border-box;
   font-family: Arial, Helvetica, sans-serif;
}

.table-parent{
    width: 60vw;
    border: 1px solid black;
    border-collapse: separate;
    border-radius: 10px;
    border-spacing: 0;
    overflow: scroll;
    margin-left: 88px;
}

.table-parent>td ,tr{
    border-radius: 0.2rem;
}
th{
    /* padding: 1rem; */
    font-size: 1.2rem;
    height: 3rem;
    border: 1px solid rgb(219, 211, 211);
    
}

.display{
    display: grid;
    grid-template-columns: repeat(3,1fr);
    align-items: center;
    justify-content: center;
    font-size: 15px;
}

.display2{
    display: flex;
    font-size: 15px
    align-items: center;
    /*justify-content: center;*/
}

.table-header{
    /* border: 1px solid black; */
    width: 90vw;
    justify-content: space-between;
    padding: 0 10px 0 10px;
    background-color: black;
    color: white;
    overflow-x: scroll;
    
}

th:first-child {
    border-top-left-radius: 10px;
}

/* Styling for top right cell */
th:last-child {
    border-top-right-radius: 10px;
}
td{ 
    text-wrap: nowrap;
    
    padding: 0.6rem;
    border: 1px solid rgb(173, 167, 167);
}
.commTD{ 
    text-wrap: wrap;
    
    padding: 0.5rem;
    border: 1px solid rgb(173, 167, 167);
}

th{
    border: 1px solid black;
    background-color: black;
    color: white;  
}
.table-middle-text{
    /* gap: 2rem; */
    display: grid;
    grid-template-columns: repeat(5,1fr);
    align-items: center;
    justify-content: center;
    /* min-width: 2rem; */
    padding: 1.2rem 4rem 0rem 1rem;

    align-items: center;
    justify-content: center;
}
.table-middle-text>p{
    
}
.tfoot-text{
    display: flex;
    grid-template-columns: repeat(3,1fr);

    justify-content: space-between;
    padding: 1rem;
    /* padding: 0.8rem; */
    
    /* align-items: center; */
    
}
tfoot>:last-child td:first-child {
    border-bottom-left-radius: 10px;
}

/* Styling for bottom right cell */
tfoot>:last-child td:last-child {
    border-bottom-right-radius: 10px;
}
</style>
@push('script-page')
 <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
  <script src="{{ asset('public/js/jquery-barcode.js') }}"></script>
    <script>
    
    
            
               $(document).on('change', '.change_status', function () {
            
                var status = $(this).val();
                var url = '{{route('quotation.order.status', ['id' => $quotation->id])}}';
               
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                       
                       'status': status,
                       'check': 'order',
                       "_token": "{{ csrf_token() }}",
                    },
                    cache: false,
                    success: function (data) {
                      show_toastr('success', data.msg, 'success');
                    },
                    
                });

            
        });
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
        });
         
      
           
            $(document).ready(function() {
           
              var data = @json($quotations->itemData);
// alert("sdfds")
 console.log("val"+data)
            // Iterate through the JSON data and display it
            $.each(data, function(key, value) {
                
            
            JsBarcode("#barcode", value.sku, {
                format: "CODE128",
                lineColor: "#000",
                width: 1,
                height: 100,
                displayValue: true
            });
             });
        });
       
        
       

       
    </script>
@endpush

    @php
        $settings = Utility::settings();
        $Qstatus = [
        'Pending',
        'Order',
        'Rejected'
        ];
    @endphp
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('quotation.index')}}">{{__('Order Summary')}}</a></li>
    <li class="breadcrumb-item">So No.{{Auth::user()->soNumberFormat($quotation->order_no == 0?$quotation->order_no+1:$quotation->order_no ) }}</li>
@endsection

@section('action-btn')
    <div class="float-end">
            <div class="form-group" style="float: inline-start;width: 120px;padding-right: 5px;">
            </div>
              @if($quotation->is_order == 1 && $quotation->is_jobcard == 1)
             <a href="#" data-size="md" data-url="{{ route('quotation.repeat.confirmation', [$quotation->id]) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Repeat Order')}}" class="btn btn-primary">{{__('Repeat Order')}}</a>
             @endif
        @if($quotation->is_order == 1 && $quotation->is_jobcard == 0 && $quotation->is_assigned_to_jobcard == 0 && auth()->user()->type == 'company')
        <a href="#" data-size="sm" data-url="{{ route('quotation.send', [$quotation->id, 'check' => 'jobcard']) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('For Approval')}}" class="btn btn-primary">{{__('Save & Send')}}</a>
        @endif
       
        @if($quotation->is_assigned_to_jobcard == auth()->user()->id && $quotation->is_jobcard == 0)
         <a href="{{ route('quotation.status', ['id' => $quotation->id, 'status' => 'is_jobcard'])}}" class="btn btn-primary" disabled>{{__('Convert to JobCard')}}</a>
       
        @endif
         @if(auth()->user()->type == 'company' && $quotation->is_jobcard == 0 && $quotation->is_assigned_to_jobcard != '')
         <a href="#" class="btn btn-secondary" disabled>{{__('Sent Request')}}</a>
         @endif
        @if($quotation->is_assigned_to_jobcard == auth()->user()->id && $quotation->is_jobcard == 1)
       
        <a href="#" class="btn btn-secondary" disabled>{{__('JobCard Request Approved')}}</a>
        @endif
       {{-- <a href="#" data-size="sm" data-url="{{ route('quotation.send', [$quotation->id, 'check' => 'check']) }}" data-ajax-popup="true" class="btn btn-primary" title="You do not change befor quotaion approval">{{__('Change to Order')}}</a>     
        @if($quotation->is_order == 0)<a href="{{ route('quotation.status', ['id' => $quotation->id, 'status' => 'order'])}}" class="btn btn-primary">{{__('Change to Order')}}</a>
        @elseif($quotation->is_order == 1 && $quotation->is_jobcard == 0 && $quotation->is_assigned_to_jobcard == auth()->user()->id)
        <a href="{{ route('quotation.status', ['id' => $quotation->id, 'status' => 'is_jobcard'])}}" class="btn btn-primary" disabled>{{__('Convert to JobCard')}}</a>
        @elseif($quotation->is_jobcard == 1)
        <a href="#" class="btn btn-secondary" disabled>{{__('Converted in JobCard')}}</a>
        @else
        <a href="{{ route('quotation.status', ['id' => $quotation->id, 'status' => 'is_jobcard'])}}" title="Already Converted"class="btn btn-primary" disabled>{{__('Order Rejected')}}</a>
        @endif --}}
        <a href="{{ route('jobcard.pdf', Crypt::encrypt($quotation->id))}}" class="btn btn-primary" target="_blank"><i class="ti ti-file-export"></i>{{__('JobCard')}}</a>
        {{--<a href="#" class="btn btn-primary"><i class="ti ti-file-export"></i>{{__('JobCard')}}</a>--}}
    </div>
@endsection

@section('content')
    <div class="row">
                <div class="col-xl-12">
                    
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="lead-sidenav" style="flex-direction: unset;">
                           
                                {{--<div  data-target="content3" class="list-group-item list-group-item-action border-0 tab {{$_GET['job'] != ''?'':'active'}}" style="cursor: pointer;">{{__('Orders')}}
                                    <div class="float-end"></div>
                                </div>--}}
                         
                           {{-- @if(Auth::user()->type != 'client')
                                <div data-target="content4" class="list-group-item list-group-item-action border-0 tab {{$_GET['job'] == ''?'active':''}}" style="cursor: pointer;border-bottom-left-radius: unset !important;border-top-left-radius: inherit;border-top-right-radius: inherit;;border-bottom-right-radius: unset !important;">| {{__('Job Card')}}
                                    <div class="float-end"></i></div>
                                </div>
                            @endif --}}
                           

                        </div>
                    </div>
                </div>
              
            </div>
   
    <div class="content" id="content3" style="{{$_GET['job'] != ''?'display:none':'display:none'}};">  
    <div class="row">
                        <div class="card">
                        <div class="card-body">
                        <div class="row">    
                    
                            <div class="col-md-6">
                            <h5>{{__('Status')}}</h5>
                            
                            </div>
                            <div class="col-md-4 form-group">
                             <select name="order_status" class="form-control change_status">
                                 <option value="">Change Order Status</option>
                                 <option value="Complete">Complete</option>
                                 <option value="On-Going">On-Going</option>
                                 <option value="Open">Open</option>
                                 <option value="Pending">Pending</option>
                                 </select>
                             </div>
                            <div class="col-md-2">
                            @php
                            $bg = $quotation->order_status == 'Pending'?'bg-primary':(($quotation->order_status == 'Complete')?'bg-success':(($quotation->order_status == 'On-Going')?'bg-warning':'bg-danger'));
                            @endphp
                            <span style="float: inline-end;"><div style="width:5px;height:5px;top: 32px;position: absolute;" class="{{$bg}}"></div>&nbsp;&nbsp;<div class="text-dark bold" style="float: inline-end;font-weight: 600;">
                                 {{$quotation->order_status == 'Pending'?'Hold':$quotation->order_status}}
                            </div></span>
                            </div>
                            <div class="col-md-12 mt-4">
                            <h5>{{__('Key Notes')}}</h5>
                            <div class="col-md-12 dropzone top-5-scroll browse-file" id="getnotedetails" style="text-align: justify;">
                                {!! $lead->notes !!}
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <div class="col-xl-12">
                    
                       <div class="card">
                        <div class="card-body">
                        <div class="row">
                        <div class="col-md-12" style="padding-bottom: 20px;">
                            <div class="table-responsive mt-3">
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th class="text-light" >#</th>
                                        <th class="text-light">{{__('Product Details')}}</th>
                                        <th class="text-light">{{__('Application')}}</th>
                                        <th class="text-light">{{__('Model')}}</th>
                                        <th class="text-light">{{__('Hsn Code')}}</th>
                                        <th class="text-light">{{__('Unit Rate')}}</th>
                                        <th class="text-light">{{__('Quantity')}}</th>
                                        <th class="text-light">{{__('Total')}}</th>
                                    </tr>
                                    </thead>
                                    @php
                                        $totalQuantity=0;
                                        $totalRate=0;
                                        $totalTaxPrice=0;
                                        $totalDiscount=0;
                                        $subTotal = 0;
                                        $total = 0;
                                        $taxesData=[];
                                    @endphp
                                    @foreach($iteams as $key =>$iteam)
                                       
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{!empty($iteam->product())?$iteam->product()->name:''}}</td>
                                            <td>{{$iteam->application}}</td>
                                            <td>{{$iteam->product()->hsn_code}}</td>
                                            <td>{{$iteam->hsn_code}}</td>
                                            <td>{{$iteam->price}}{{$iteam->currency == 'USD'?'$':($iteam->currency == 'EURO'?'€':'₹')}}</td>
                                           {{-- <td>
                                                @if(!empty($iteam->tax))
                                                    <table>
                                                        @php
                                                            $totalTaxRate = 0;
                                                            $totalTaxPrice = 0;
                                                        @endphp
                                                        @foreach($taxes as $tax)
                                                            @php
                                                                $taxPrice=App\Models\Utility::taxRate($tax->rate,$iteam->price,$iteam->quantity);
                                                                $totalTaxPrice+=$taxPrice;
                                                            @endphp
                                                            <tr>
                                                                <span class="badge bg-primary">{{$tax->name .' ('.$tax->rate .'%)'}}</span> <br>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                @else
                                                    -
                                                @endif
                                            </td>--}}
                                            {{--<td>{{\Auth::user()->priceFormat($totalTaxPrice)}}</td>--}}
                                             <td>{{$iteam->quantity}}</td>
                                            <td >{{($iteam->price*$iteam->quantity) + $totalTaxPrice}}{{$iteam->currency == 'USD'?'$':($iteam->currency == 'EURO'?'€':'₹')}}</td>
                                        </tr>
                                        @php
                                                $subTotal +=  (($iteam->price*$iteam->quantity) + $totalTaxPrice);
                                                $total = $subTotal - $totalDiscount;
                                    @endphp
                                    @endforeach
               
                                </table>
                            </div>
                        </div>
                    <div class="col-md-5">
                        <div class="form-group">
                        <label for="specification-name" class="form-label" style="padding: 7px 12px 0px 0px;">Specifications</label>
                        </div>
                    </div>
                    <div class="col-md-7">
                    <div class="form-group">
                         <label for="specification-name" class="form-label" style="padding: 7px 12px 0px 0px;">Descriptions</label>
                    </div>
                    </div>    
                         @foreach ($quotations->itemData as $key => $item)
           
           <?php
            $html = '';
            $productService =  \App\Models\ProductService::find($item->id);
            $cat = \App\Models\Specification::with('subspecifications')->where(['priority' => 0, 'product_model_id' => $productService->product_model_id])->get();
             $material = \App\Models\SpecificationCodeMaterial::where(['specification_code_order_id' =>$productService->specification_code_order_id])->orderBy('id', 'desc')->pluck('name')->toArray();
            
             ?>
            @foreach ($cat as $key => $c) 
            
            <div class="col-md-5">
            <div class="form-group">
            <label for="specification-name" class="form-label" style="padding: 7px 12px 0px 0px;">{{$c->name}} :</label>
            </div></div>
            <div class="col-md-7">
            <div class="form-group">
           
         @foreach ($c->subspecifications as $key => $cs) 
                 @if (array_search($cs->prefix, $material) !== false) 
               
                    <div>{{ $cs->prefix}} :  {{$cs->name}} </div>
               @endif 
         @endforeach
            </div>
          </div>
         
          @endforeach
         
  
    @endforeach   
                    </div> 
                    </div>
                    </div>
                    {{-- <div class="row" style="line-height: 2;">
                                <div class="col-md-2 col-sm-2">
                                     <div class="card">
                                      <div class="card-body">     
                                     
                                      <div class="d-flex align-items-start">
                                       @php
                                       $status = \App\Models\Stage::where('created_by', \Auth::user()->creatorId())->first();
                                       @endphp
                                        <div class="ms-2">
                                          
                                            {{__('ReqdBy')}}: <span class="mb-0">{{ $lead->customer->billing_name }}</span><br>
                                          
                                           
                                             {{__('Sr. No.')}}: <span class="mb-0">{{!empty($quotations)?$quotations->id:''}}</span>
                                           
                                            
                                        </div>
                                    </div>
                                </div>
                           
                            </div>
                        </div>
                                <div class="col-md-8 col-sm-8">
                                <div class="card"> 
                                 <div class="card-body">
                                    
                                <div class="row" >
                                <div class="col-md-8 col-sm-8">
                                    <div class="align-items-start">
                                         <div class="ms-2">
                                            {{__('SO Number')}}: <span class="mb-0"><br>{{!empty($quotation->id)?$quotation->id:''}}</span>
                                        </div>
                                         <div class="ms-2">
                                            {{__('Date')}}: <span class="mb-0"><br>{{!empty( $quotations)? \Carbon\Carbon::parse($quotations->quotation_date)->format('d/m/Y'):''}}</span>
                                        </div>
                                         <div class="ms-2">
                                            {{__('Application')}}: <span class="mb-0"><br>{{!empty($quotations->application == 1)?'Send':(($quotations->application == 2)?'Liquid':'Solid')}} {{$quotations->application_extra}}</span>
                                        </div>
                                          @foreach($iteams as $key =>$iteam)
                                         <div class="ms-2">
                                            {{__('Model')}}: <span class="mb-0"><br>{{!empty($iteam->product())?$iteam->product()->model:''}}</span>
                                        </div>
                                        @endforeach
                                        <div class="ms-2">
                                            {{__('Customer Order Code')}}: <span class="mb-0"><br>{{!empty($quotation->order_code != '')?$quotation->order_code:'None'}}</span>
                                        </div>
                                   
                                </div>
                               </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        
                                        <div class="ms-2">
                                                   @foreach($iteams as $key =>$iteam)
                                                    <div id="{{ $iteam->product()->id }}" class="product_barcode product_barcode_hight_de" data-skucode="{{ $iteam->product()->sku }}"></div>
                                                    @endforeach
                                        </div>
                                   
                                </div>
                               </div>
                                 
                                    </div>
                               
                                </div>
                                </div>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                     <div class="card">
                                      <div class="card-body">     
                                     
                                      <div class="d-flex align-items-start">
                                       @php
                                       $status = \App\Models\Stage::where('created_by', \Auth::user()->creatorId())->first();
                                       @endphp
                                        <div class="ms-2">
                                          
                                            {{__('Quote Ref')}}: <span class="mb-0">{{ $quotations->id }}</span><br>
                                           @if(!empty($lead->products()))
                                                 @foreach($lead->sources() as $source) 
                                                 {{__('Created By')}}: <span class="mb-0">{{!empty( $quotations)? \Carbon\Carbon::parse($quotations->quotation_date)->format('d/m/Y'):''}}</span><br>
                                                  
                                                   @if (!$loop->last)
                                                        ,
                                                    @endif
                                                   @endforeach
                                                   @else
                                                   -
                                                   @endif
                                           
                                             {{__('Quantity')}}: <span class="mb-0">{{!empty($quotations)?$quotations->totalQuantity:'1'}}</span>
                                           
                                            
                                        </div>
                                    </div>
                                </div>
                           
                            </div>
                        </div>
                        </div>--}}
                    {{-- <div class="card">
                        <div class="card-body">
                           
                             <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                            {{__('Mechanical')}}<br> <span class="mb-0">None</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                            {{__('Mechanical testing')}}<br> <span class="mb-0">{{!empty( $quotations)? \Carbon\Carbon::parse($quotations->quotation_date)->format('d/m/Y'):''}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md- col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                                  {{__('Electronic')}}<br> <span class="mb-0"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 mt-6">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                            {{__('Electronic Notes')}}<br> <span class="mb-0">{{$lead->quantity}}</span>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md- col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                                  {{__('Admin')}}<br> <span class="mb-0"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 mt-6">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                            {{__('Admin Notes')}}<br> <span class="mb-0">{{$lead->quantity}}</span>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md- col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                                  {{__('QC')}}<br> <span class="mb-0"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 mt-6">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                            {{__('QC Notes')}}<br> <span class="mb-0">{{$lead->quantity}}</span>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md- col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                                  {{__('Serial Number')}}: <span class="mb-0"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 mt-6">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                            {{__('Serial Number')}}<br> <span class="mb-0">{{$lead->quantity}}</span>
                                        </div>
                                    </div>
                                </div>
                                
                               
                            </div>
                        </div>
                        </div>--}}
                  {{--<div class="card">
                        <div class="card-body">
                            <h5>{{__('Organization')}}</h5>
                             <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                            {{__('Sector')}}: <span class="mb-0">{{!empty($lead->name)?$lead->name:''}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                            {{__('Industry')}}: <span class="mb-0">{{!empty($lead->industry_name)?$lead->industry_name:''}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                           
                                              @if(!empty($lead->products()))
                                                 @foreach($lead->products() as $product) 
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
                                <div class="col-md-4 col-sm-4 mt-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            {{__('Quantity')}}: <span class="mb-0">{{$lead->quantity}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 mt-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            {{__('GST Number')}}: <span class="mb-0">{{ $lead->customer != null?$lead->customer->tax_number:'-'}}</span>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        </div>  --}}
                   {{-- <div id="profile">
                      
                       
                       
                          
                             <div class="row" style="line-height: 2;">
                               
                                <div class="col-md-8 col-sm-8">
                                <div class="card"> 
                                 <div class="card-body">
                                     <h5>{{__('Contact Person Info')}}</h5>
                                <div class="row" >
                                <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                         <div class="ms-2">
                                            {{__('Name')}}: <span class="mb-0">{{!empty($quotation->customer->billing_name)?$quotation->customer->billing_name:''}}</span>
                                        </div>
                                   
                                </div>
                               </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        
                                        <div class="ms-2">
                                                 {{__('Email')}}: <span class="mb-0">{{!empty($quotation->customer->email)?$quotation->customer->email:''}}</span>
                                        </div>
                                   
                                </div>
                               </div>
                                 <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                          
                                           {{__('Number')}}: <span class="mb-0 ">{{!empty($quotation->customer->contact)?$quotation->customer->contact:''}}</span>
                                        </div>
                                    </div>
                               </div>
                                  <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           {{__('Department')}}: <span class="mb-0 ">{{!empty($quotation->customer->billing_department)?$quotation->customer->billing_department:''}}</span>
                                        </div>
                                    </div>
                               </div>
                                 <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                           {{__('Designation')}}: <span class="mb-0">{{!empty($quotation->customer->shipping_designation)?$quotation->customer->shipping_designation:''}}</span>
                                        </div>
                                    </div>
                                    </div>
                                     <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           {{__('Gender')}}: <span class="mb-0">{{!empty($quotation->customer->gender)?$quotation->customer->gender:''}}</span>
                                        </div>
                                    </div>
                                    </div>
                                     <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                           {{__('Alternate')}}: <span class="mb-0">{{!empty($quotation->customer->billing_phone)?$quotation->customer->billing_phone:''}}</span>
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
                                     <h5 style="padding-left: 5px;">{{__('Categories')}}</h5>
                                      <div class="d-flex align-items-start">
                                       @php
                                       $status = \App\Models\Stage::where('created_by', \Auth::user()->creatorId())->first();
                                       @endphp
                                        <div class="ms-2">
                                          
                                            {{__('Status')}}: <span class="mb-0">{{ $lead->stage->name }}</span><br>
                                           @if(!empty($lead->products()))
                                                 @foreach($lead->sources() as $source) 
                                                 {{__('Source')}}: <span class="mb-0">{{!empty($source->name)?$source->name:''}}</span><br>
                                                  
                                                   @if (!$loop->last)
                                                        ,
                                                    @endif
                                                   @endforeach
                                                   @else
                                                   -
                                                   @endif
                                           
                                             {{__('Request Type')}}: <span class="mb-0">{{!empty($lead->request_id)?$lead->request_id:$lead->request_type}}</span>
                                           
                                            
                                        </div>
                                    </div>
                                </div>
                           
                            </div>
                        </div>
                        </div>
                        </div>--}}
                        </div>
                       
                     
                          @php
                                $customers = \App\Models\Customer::where('lead_id', $lead->id)->get();
                               
                                @endphp
                        @if(count($customers)>0)
                         @foreach($customers->slice(1) as $key => $v)
                      
                       {{-- <div class="card">
                        <div class="card-body">
                              
                               
                             <div class="row" style="line-height: 2;">
                                   <h5>{{__('Contact Person Info')}} ({{$key}})</h5>
                               
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                         <div class="ms-2">
                                            {{__('Name')}}: <span class="mb-0">{{!empty($v->name)?$v->name:''}}</span>
                                        </div>
                                   
                                </div>
                               </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        
                                        <div class="ms-2">
                                                 {{__('Email')}}: <span class="mb-0">{{!empty($v->email)?$v->email:''}}</span>
                                        </div>
                                   
                                </div>
                               </div>
                                 <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                          
                                           {{__('Number')}}: <span class="mb-0 ">{{!empty($v->billing_state)?$v->billing_state:''}}</span>
                                        </div>
                                    </div>
                               </div>
                                  <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           {{__('Department')}}: <span class="mb-0 ">{{!empty($v->billing_city)?$v->billing_city:''}}</span>
                                        </div>
                                    </div>
                               </div>
                                 <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                           {{__('Designation')}}: <span class="mb-0">{{!empty($v->billing_country)?$v->billing_country:''}}</span>
                                        </div>
                                    </div>
                                    </div>
                                     <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           {{__('Gender')}}: <span class="mb-0">{{!empty($v->gender)?$v->gender:''}}</span>
                                        </div>
                                    </div>
                                    </div>
                                     <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                           {{__('Alternate')}}: <span class="mb-0">{{!empty($v->billing_phone)?$v->billing_phone:''}}</span>
                                        </div>
                                    </div>
                                    </div>
                                    
                             
                           
                            </div>
                             @if (!$loop->last)
                                   <br>
                                @endif
                                
                               
                        </div>
                        </div>--}}
                        @endforeach
                         @endif
                       {{-- <div class="card">
                        <div class="card-body">
                            <h5>{{__('Organization')}}</h5>
                             <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                            {{__('Sector')}}: <span class="mb-0">{{!empty($lead->name)?$lead->name:''}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                            {{__('Industry')}}: <span class="mb-0">{{!empty($lead->industry_name)?$lead->industry_name:''}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                           
                                              @if(!empty($lead->products()))
                                                 @foreach($lead->products() as $product) 
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
                                <div class="col-md-4 col-sm-4 mt-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            {{__('Quantity')}}: <span class="mb-0">{{$lead->quantity}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 mt-4">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            {{__('GST Number')}}: <span class="mb-0">{{ $lead->customer != null?$lead->customer->tax_number:'-'}}</span>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        </div>--}}
                       
                            
                           {{-- <div class="row" style="line-height: 2;">
                                <div class="col-md-8 col-sm-8">
                                    <div class="card">
                                     <div class="card-body">
                                     <h5  style="padding-left: 5px;">{{__('Address & Contact')}}</h5>
                                      <div class="d-flex align-items-start">
                                        <div class="ms-2">
                                            {{__('Address')}}: <span class="mb-0">{{!empty($lead->customer->billing_address)?$lead->customer->billing_address:''}}</span>
                                        </div>
                                    </div>
                                
                                
                                <div class="row" >
                                <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                        
                                        <div class="ms-2">
                                            @if(!empty($lead->products()))
                                                 @foreach($lead->sources() as $source) 
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
                               </div>
                                 <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                          
                                           {{__('State')}}: <span class="mb-0 ">{{!empty($lead->customer->billing_state)?$lead->customer->billing_state:''}}</span>
                                        </div>
                                    </div>
                               </div>
                                  <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           {{__('City')}}: <span class="mb-0 ">{{!empty($lead->customer->billing_city)?$lead->customer->billing_city:''}}</span>
                                        </div>
                                    </div>
                               </div>
                                 <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                       
                                        <div class="ms-2">
                                            
                                           {{__('Country')}}: <span class="mb-0">{{!empty($lead->customer->billing_country)?$lead->customer->billing_country:''}}</span>
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
                                            @foreach($lead->users as $key => $user)
                                               @if ($loop->iteration == 2)
                                                @continue
                                                @endif
                                            {{__('Lead Assigned by')}}: <span class="mb-0">{{!empty($user->name)?$user->name:''}}</span><br>
                                            @endforeach
                                            {{__('Lead Owner ')}}: <span class="mb-0">{{!empty($lead->owner->name)?$lead->owner->name:''}}</span><br>
                                             @foreach($lead->users as $user)
                                            
                                             @if ($loop->first)
                                                @continue
                                               
                                            @endif
                                             {{__('Lead Assigned to')}}: <span class="mb-0">{{!empty($user->name)?$user->name:''}}</span>
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                </div>
                           
                            </div>
                        </div>
                        </div>--}}
                      {{--  <div class="card">
                        <div class="card-body">
                            <h5>{{__('Key Notes')}}</h5>
                            <div class="col-md-12 dropzone top-5-scroll browse-file" id="getnotedetails" style="text-align: justify;">
                                {!! $lead->notes !!}
                            </div>
                        </div>
                        </div>--}}
                 
        {{--<div class="col-12">
            <div class="card">
                <div class="card-body">
                     @if($quotation_o)
                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                            <h4>{{__('order')}}</h4>
                        </div>
                       
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                            <h4 class="invoice-number">{{ $quotation->is_revised != null?Auth::user()->orderNumberFormat($quotation_o->quotation_id):Auth::user()->orderNumberFormat($quotation_o->quotation_id) }}</h4>
                        </div>
                       
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <small class="font-style">
                                <strong>{{__('Billed To')}} :</strong><br>
                                @if(!empty($customer->billing_name))
                                    {{!empty($customer->billing_name)?$customer->billing_name:''}}<br>
                                    {{!empty($customer->billing_address)?$customer->billing_address:''}}<br>
                                    {{!empty($customer->billing_city)?$customer->billing_city:'' .', '}}<br>
                                    {{!empty($customer->billing_state)?$customer->billing_state:'',', '}},
                                    {{!empty($customer->billing_zip)?$customer->billing_zip:''}}<br>
                                    {{!empty($customer->billing_country)?$customer->billing_country:''}}<br>
                                    {{!empty($customer->billing_phone)?$customer->billing_phone:''}}<br>
                                    @if($settings['vat_gst_number_switch'] == 'on')
                                    <strong>{{__('Tax Number ')}} : </strong>{{!empty($customer->tax_number)?$customer->tax_number:''}}
                                    @endif
                                @else
                                    -
                                @endif
                            </small>
                        </div>
                        <div class="col-4">
                            @if(App\Models\Utility::getValByName('shipping_display')=='on')
                                <small>
                                    <strong>{{__('Shipped To')}} :</strong><br>
                                        @if(!empty($customer->shipping_name))
                                        {{!empty($customer->shipping_name)?$customer->shipping_name:''}}<br>
                                        {{!empty($customer->shipping_address)?$customer->shipping_address:''}}<br>
                                        {{!empty($customer->shipping_city)?$customer->shipping_city:'' . ', '}}<br>
                                        {{!empty($customer->shipping_state)?$customer->shipping_state:'' .', '}},
                                        {{!empty($customer->shipping_zip)?$customer->shipping_zip:''}}<br>
                                        {{!empty($customer->shipping_country)?$customer->shipping_country:''}}<br>
                                        {{!empty($customer->shipping_phone)?$customer->shipping_phone:''}}<br>
                                    @else
                                    -
                                    @endif
                                </small>
                            @endif
                        </div>
                        <div class="col-2">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="me-4">
                                    <small>
                                        <strong>{{__('Issue Date')}} :</strong>
                                        {{\Auth::user()->dateFormat($quotation->quotation_date)}}<br><br>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                           
                            @foreach($iteams as $key =>$iteam)
                             <div id="{{ $iteam->product()->id }}" class="product_barcode product_barcode_hight_de" data-skucode="{{ $iteam->product()->sku }}"></div>
                             @endforeach
                            
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="table-responsive mt-3">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-dark" >#</th>
                                        <th class="text-dark">{{__('Items')}}</th>
                                        <th class="text-dark">{{__('Quantity')}}</th>
                                        <th class="text-dark">{{__('Price')}}</th>
                                        <th class="text-dark">{{__('Tax')}}</th>
                                        <th class="text-dark">{{__('Tax Amount')}}</th>
                                        <th class="text-dark">{{__('Total')}}</th>
                                    </tr>
                                    </thead>
                                    @php
                                        $totalQuantity=0;
                                        $totalRate=0;
                                        $totalTaxPrice=0;
                                        $totalDiscount=0;
                                        $subTotal = 0;
                                        $total = 0;
                                        $taxesData=[];
                                    @endphp
                                    @foreach($iteams as $key =>$iteam)
                                        @if(!empty($iteam->tax))
                                            @php
                                                $taxes=App\Models\Utility::tax($iteam->tax);
                                                $totalQuantity+=$iteam->quantity;
                                                $totalRate+=$iteam->price;
                                                $totalDiscount+=$iteam->discount;

                                                foreach($taxes as $taxe){

                                                    $taxDataPrice=App\Models\Utility::taxRate($taxe->rate,$iteam->price,$iteam->quantity);
                                                    if (array_key_exists($taxe->name,$taxesData))
                                                    {
                                                        $taxesData[$taxe->name] = $taxesData[$taxe->name]+$taxDataPrice;
                                                    }
                                                    else
                                                    {
                                                        $taxesData[$taxe->name] = $taxDataPrice;
                                                    }
                                                }
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{!empty($iteam->product())?$iteam->product()->name:''}}</td>
                                            <td>{{$iteam->quantity}}</td>
                                            <td>{{\Auth::user()->priceFormat($iteam->price)}}</td>
                                            <td>
                                                @if(!empty($iteam->tax))
                                                    <table>
                                                        @php
                                                            $totalTaxRate = 0;
                                                            $totalTaxPrice = 0;
                                                        @endphp
                                                        @foreach($taxes as $tax)
                                                            @php
                                                                $taxPrice=App\Models\Utility::taxRate($tax->rate,$iteam->price,$iteam->quantity);
                                                                $totalTaxPrice+=$taxPrice;
                                                            @endphp
                                                            <tr>
                                                                <span class="badge bg-primary">{{$tax->name .' ('.$tax->rate .'%)'}}</span> <br>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{\Auth::user()->priceFormat($totalTaxPrice)}}</td>
                                            <td >{{\Auth::user()->priceFormat(($iteam->price*$iteam->quantity) + $totalTaxPrice)}}</td>
                                        </tr>
                                        @php
                                                $subTotal +=  (($iteam->price*$iteam->quantity) + $totalTaxPrice);
                                                $total = $subTotal - $totalDiscount;
                                    @endphp
                                    @endforeach


                                    <tr>
                                        <td><b>{{__(' Sub Total')}}</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{\Auth::user()->priceFormat($subTotal)}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>{{__('Discount')}}</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{\Auth::user()->priceFormat($totalDiscount)}}</td>
                                    </tr>
                                    <tr class="pos-header">
                                        <td><b>{{__('Total')}}</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{\Auth::user()->priceFormat($total)}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    @else
                     <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                            <h4>{{__('quotation')}}</h4>
                        </div>
                       
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                            <h4 class="invoice-number">Record not found</h4>
                        </div>
                       
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>--}}
    </div></div>
    <div class="display2" id="content4" style="padding: 2rem 0rem 2rem 1.5rem;background-color: #fff;">  
 
    <div class="quotation-header" style="background: {{$color}};color:{{$font_color}}">
       
    
    </div>
     @foreach ($quotations->itemData as $keyss => $item)
    @php
   
     $year = \Carbon\Carbon::now()->format('y');
        $years= \Carbon\Carbon::now()->format('Y-m-d');
        $yearNext = \Carbon\Carbon::parse($years)->addYears(1);
    $job = \App\Models\Quotation::find($quotation->is_repeat);
    $jobNo =!empty($job)?$job->jobcard_no:''; 
   
    @endphp
     <table class="table-parent">
        
        <thead>
           
                <th colspan="">Job Card</th>
                <th colspan="2" class="text-center">Trumen Technology Pvt. Ltd.</th>
                <th colspan="3" class="text-end"></th>
           
        </thead>
       <tbody>
        <tr>
            <td rowspan="2" class="commTD"> </td>
            
            <td rowspan="2" colspan="2" class="commTD"><div class="display"><span>
                @if($quotation->jobcard_no != 0)
                {{ Auth::user()->jobNumberFormat($quotation->jobcard_no) }}</span><canvas id="barcode" style="width: 130px;height: 56px;"></canvas>
                @else
                 {{Auth::user()->soNumberFormat($quotation->order_no == 0?$quotation->order_no+1:$quotation->order_no ) }}</span><canvas id="barcode" style="width: 130px;height: 56px;"></canvas>
                @endif
                </td>
            
            
            <td class="commTD">Old SO_Ref</td>
            <td class="commTD">{{$quotation->old_ref_no != null?$quotation->old_ref_no:Auth::user()->jobNumberFormat($jobNo)}}</td>
            <tr>
            <td class="commTD">Quote Ref</td>
            <td class="commTD">TTPL/{{$year}}{{$yearNext->format('y')}}/@php echo sprintf('%02d', $quotation->id); @endphp</td>
            </tr>
            
            
        </tr>

       <tr>
            <td style="padding: 0 2rem 0 2rem;" class="commTD">Reqdby</td>
            <td colspan="2" class="commTD">{{ \Carbon\Carbon::parse($quotations->reqbydate)->format('d/m/Y')}}</td>
            <td class="commTD">Created Date</td>
            <td colspan="2" class="commTD">{{ \Carbon\Carbon::parse($quotations->created_at)->format('d/m/Y')}}</td>
        </tr>
        <?php
           $html = '';
            $arr = explode(':', $item->q_model);
            $array = explode('-', $arr[1]);
        //   dd($array);
            // $cat = Specification::with('subspecifications')->where(['priority' => 0, 'group_id' => $item->group_ids])->get();   
            // $productService =  \App\Models\ProductService::find($item->id);
            $cat = \App\Models\Specification::with('subspecifications')->where(['priority' => 0, 'product_model_id' =>$item->product_model_id])->get();
           
             ?>
        <tr>
            <td style="text-align: center;" class="commTD">Sr.No</td>
             <td colspan="2" class="commTD">Application :
                {{$quotations->application_extra != ''?$quotations->application_extra:$item->application}}
                |Pressure: {{$quotations->pressure}} |<br>
                Temperature:  
                
                    {{$quotations->temperature}}
                  
             
            <td colspan="2" style="text-align: center; font-weight: bold;" class="commTD">Quantity</td>
        </tr>

         <tr><td class="commTD"></td>
          @php
          $qty = 0;
          @endphp
          <td colspan="2" style="text-align: center; font-weight: bold;" class="commTD">
       
         
        <p>{{$keyss+1}}. Model: {{$item->n_model != ''?$item->n_model:$item->q_model}}</p>
       
          @php
       
          $qty += $item->quantity;
          @endphp  

           </td>
            <!-- <td></td> -->
            <td colspan="2" style="text-align: center; font-weight: bold;" class="commTD">{{$quotations->quantity}}</td>
         </tr>

         <tr>
            <td class="commTD"></td>
            
            <td colspan="2" style="text-align: center;" class="commTD">Costumer OrderCode:
            
            {{$quotation->cust_note}}
                 
            </td>
            <!-- <td></td> -->
            <td colspan="3" class="commTD"></td>
         </tr>
           <?php
           $html = '';
           $arr = explode(':', $item->q_model);
            $array = explode('-', $arr[1]);
        //   dd($array);
            // $cat = Specification::with('subspecifications')->where(['priority' => 0, 'group_id' => $item->group_ids])->get();   
            // $productService =  \App\Models\ProductService::find($item->id);
            $cat = \App\Models\Specification::with('subspecifications')->where(['priority' => 0, 'product_model_id' =>$item->product_model_id])->get();
            //  $material = \App\Models\SpecificationCodeMaterial::where(['specification_code_order_id' =>$productService->specification_code_order_id])->orderBy('id', 'desc')->pluck('name')->toArray();
            $lids = \App\Models\QuotationProductDesc::where('quotation_product_id', $item->quote_id)->pluck('label_id')->toArray();
             ?>
             <tr>
             <td class="commTD"></td>
            <td colspan="2" style="text-align: center;" class="commTD"><h4>Mechanical :</h4></td>
            <!-- <td></td> -->
            <td colspan="3" class="commTD"></td>
         </tr>
            <tr>
            <td  class="commTD">{{$keyss+1}}.0</td>
              <td rowspan="" colspan="2" class="commTD">
            @foreach ($cat as $keys => $c) 
           
         @foreach ($c->subspecifications as $key => $cs) 
         
           <?php
                if(!empty($item->group_material_2)){    
                   $pName = \App\Models\Specification::find($item->group_material_2); 
                   $MName = \App\Models\Specification::find($pName->parent);
                } 
                if(!empty($item->group_material_3)){    
                   $pName1 = \App\Models\Specification::find($item->group_material_3); 
                   $MName1 = \App\Models\Specification::find($pName1->parent);
                } 
                if(!empty($item->group_material_5)){    
                   $pName2 = \App\Models\Specification::find($item->group_material_5); 
                   $MName2 = \App\Models\Specification::find($pName2->parent);
                } 
                if(!empty($item->group_material_7)){    
                   $pName3 = \App\Models\Specification::find($item->group_material_7); 
                   $MName3 = \App\Models\Specification::find($pName3->parent);
                } 
                if(!empty($item->group_material_4)){    
                   $pName4 = \App\Models\Specification::find($item->group_material_4); 
                   $MName4 = \App\Models\Specification::find($pName4->parent);
                } 
                $integrals = $item->integral == 'rmt1'?'Remote':(($item->integral == 'rmt2')?'Remote':'');

                    ?>
                    
                 @if (array_search($cs->prefix, $array) !== false) 
                 @if($c->el_mc == 'mc') 
               <div style="padding: 0.2rem 0rem 0rem 1rem;">
                    <div  class="text-center"style="gap: 1rem;display: flex;font-size: 12px;">
                    <p style="font-weight:550"> {{ $cs->prefix}} :</p>
                    <p> @if($c->name == 'Enclosure') {{$integrals}} @endif {{$c->name}}:
                    
                    @if (array_search($c->id, $lids) !== false)
                    @php
                    $dd = \App\Models\QuotationProductDesc::where('label_id', $c->id)->where('quotation_product_id', $item->quote_id)->first();
                    @endphp
                    {{$dd->description}},
                    @else
                    {{$cs->name}},
                    @endif
                    @if($c->name == 'Enclosure')
                    
                    @if($item->fd_cd != '')
                    @php
                    $cdfd = $item->fd_cd == 'fd'?'FD':'CD';
                    @endphp
                    
                    @endif
                     {{$item->fd_cd != ''?($cdfd):''}} {{$item->fd_cd != ''?',':''}} ({{$item->gland}})
                    @endif
                     @if(!empty($MName))
                    @if($c->name == $MName->name)
                    ({{$pName->name}}),
                    @endif
                    @endif
                    @if(!empty($MName1))
                    @if($c->name == $MName1->name)
                    ({{$pName1->name}}),
                    @endif
                    @endif
                    @if(!empty($MName2))
                    @if($c->name == $MName2->name)
                    ({{$pName2->name}}),
                    @endif
                    @endif
                    @if(!empty($MName3))
                    @if($c->name == $MName3->name)
                    ({{$pName3->name}}),
                    @endif
                    @endif
                    @if(!empty($MName4))
                    @if($c->name == $MName4->name)
                    ({{$pName4->name}})
                    @endif
                    @endif
                     </p>
                    </div>
                </div>
                   
               @endif
               @endif 
         @endforeach
        
         @endforeach 
         <span style="font-weight: 600;padding: 0.2rem 0rem 1rem 1rem;">Mechanical Note: </span> {{$quotations->mechanical_note}}
          </td>
          
           <td colspan="3"  style="text-align: center; margin: 0; font-weight: bold; padding: 0;" class="commTD">
          Mechinical Testing
           </td>
            
            
        </tr>

        <tr>
             <td class="commTD"></td>
            <td colspan="2" style="text-align: center;" class="commTD"><h4>Electronic :</h4></td>
            <!-- <td></td> -->
            <td colspan="3" class="commTD"></td>
         </tr>
        <tr><td class="commTD"></td>
                <td rowspan="" colspan="2" class="commTD">
            @foreach ($cat as $keys => $c) 
             @foreach ($c->subspecifications as $key => $cs) 
                     @if (array_search($cs->prefix, $array) !== false) 
                   <div style="padding: 0.2rem 0rem 0rem 1rem;">
                        <div  class="text-center"style="gap: 1rem;display: flex;font-size: 12px;">
                     @if($c->el_mc == 'el')
                        <p style="font-weight:550"> {{ $cs->prefix}} :</p>
                        <p> {{$c->name}}: {{$cs->name}}
                        @if($c->name == 'Enclosure')
                        ({{$item->integral}}), {{$item->fd_cd != ''?($item->fd_cd):''}} {{$item->fd_cd != ''?',':''}} ({{$item->gland}})
                        @endif
                    @if(!empty($MName))
                    @if($c->name == $MName->name)
                    ({{$pName->name}}),
                    @endif
                    @endif
                    @if(!empty($MName1))
                    @if($c->name == $MName1->name)
                    ({{$pName1->name}}),
                    @endif
                    @endif
                    @if(!empty($MName2))
                    @if($c->name == $MName2->name)
                    ({{$pName2->name}}),
                    @endif
                    @endif
                    @if(!empty($MName3))
                    @if($c->name == $MName3->name)
                    ({{$pName3->name}}),
                    @endif
                    @endif
                    @if(!empty($MName4))
                    @if($c->name == $MName4->name)
                    ({{$pName4->name}}),
                    @endif
                    @endif
                         </p>
                          @endif
                        </div>
                    </div>
                   @endif 
             @endforeach
            @endforeach 
             <span style="font-weight: 600;padding: 0.2rem 0rem 1rem 1rem;">Electronic Note: </span> {{$quotation->electronic_note}}
            </td>
            <td colspan="2" style="font-weight: 600;text-align: center;" class="commTD">Electronic Testing</td>
         </tr>
        {{-- <tr><td class="commTD"></td>
            <td colspan="2" class="commTD"><span style="font-weight: 600;">Electronic Note:</span>{{$quotations->electronic_note}}</td>
            <td colspan="2" class="commTD"></td>
            
         </tr>--}}

         <tr><td class="commTD"></td>
            <td colspan="2" style="text-align: center; font-weight: 600;" class="commTD">Admin</td>
            <td colspan="3" class="commTD"></td>
         </tr>

         <tr><td class="commTD"></td>
            <td colspan="2" class="commTD"><span style="font-weight: 600;">Admin Note:</span> {{$quotations->admin_note}}</td>
            <td colspan="3" class="commTD"></td>
         </tr>

         <tr><td class="commTD"></td>
            <td colspan="2" style="text-align: center; font-weight: 600;" class="commTD">
                QC:
            </td>
            <td colspan="3" class="commTD"></td>
         </tr>


         <tr><td class="commTD"></td>
            <td colspan="2" class="commTD"><span style="font-weight: 600;">QC Note :</span> {{$quotations->qc_note}}</td>
            <td colspan="3" class="commTD"></td>
         </tr>


         <tr><td class="commTD"></td>
            <td colspan="2" style="text-align: center; font-weight: 600;" class="commTD">Tag Number</td>
            <td colspan="3" class="commTD"></td>
         </tr>


         <tr><td class="commTD"></td>
            <td colspan="2" class="commTD"><span style="font-weight: 600;">Tag No: </span> {{$quotations->tag_note}}</td>
            <td colspan="3" class="commTD"></td>
         </tr>


         <!-- <tr><td></td>
            <td colspan="2">Tag No:None</td>
            <td colspan="2">sdfsdfsdf</td>
         </tr> -->

         <tr>
            
        <td class="commTD"></td>
            <td colspan="" class="display2" style="justify-content: space-between;" class="commTD"><span>Serial No. {{$item->p_model}}-{{ \Carbon\Carbon::parse($quotation->created_at)->format('y')}}-{{sprintf('%02d', $quotation->order_no == 0?$quotation->order_no+1:$quotation->order_no) }}</span><span style="font-weight: 600;">To</span></td>
            <td colspan="" class="commTD">Serial No. {{$item->p_model}}-{{ \Carbon\Carbon::parse($quotation->created_at)->format('y')}}-{{sprintf('%02d', $quotation->order_no == 0?$quotation->order_no+1:$quotation->order_no) }}</td>
            <td colspan="2" class="commTD"></td>
            
         </tr>

         <tr><td class="commTD"></td>
            <td colspan="2" class="commTD">
            Remarks: {{$quotation->remark}}
            </td>
            <td colspan="3" class="commTD"></td>
         </tr>

        </tbody> 
        <tfoot class="abc2" >
            <tr>
            <td colspan="5" class="commTD"> 
                <div class=" tfoot-text">
                    <p><b>{{!empty($quotation->createdBy)?$quotation->createdBy->name:''}}</b></p>
                    <p style="width: 150px;margin-left: 166px;">Created by sales</p>
                    <p>Checked by concerned Department</p>
                </div>
                <div class=" tfoot-text">
                    <p>Prepared by</p>
                    <p style="width: 0px;">Department</p>
                    <p style="width: 218px;">Elecronics/Mechenical</p>
                </div>
            </td>
            </tr>
            
        </tfoot>

    </table> 
   
    </div> 
           
            </tbody>
        </table>
      
      <br>   

       @endforeach     
    {{--</div>--}}
     
{{--<div class="quotation-footer" style="line-height: 8;">
            <b>Turms & Conditions</b>
            {!! $settings['footer_notes'] !!}
        </div>--}}
{{--</div>--}}
  
    </div>
   
@endsection
@push('script-page')
   <script>
    // $(document).on('change', '.quotation_status', function () {
          
    //         //   var status = $(this).val();
    //             var url = $(this).data('url');
    //         var id = $('#q_id').val();
    //         alert(id)
    //             $.ajax({
    //                 url: url,
    //                 type: 'GET',
                   
    //                 data: {
    //                     'id': id,
                       
    //                 },
    //                 cache: false,
    //                 success: function (data) {

    //                 },
                    
    //             });

            
    //     });
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
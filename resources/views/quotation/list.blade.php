@extends('layouts.admin')
@section('page-title')
    {{ __('Manage Order') }}
@endsection
@section('breadcrumb')
    {{--<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Order') }}</li> --}}
@endsection
@push('css-page')
   
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
    /* Hide default arrow */
input[type="text"]::-webkit-input-placeholder {
color: var(--color-customColor);
    font-weight: bold;
    
}
.dataTable-bottom{
    display: none;
}
 .dataTable-table tbody tr td {
        padding: 4px 0px 4px 0px !important;
    }
.dataTable-table thead>tr>th{
        padding: 9px 0px 11px 14px !important; 
}
          .dataTable-container{
            margin-top: -15px;
    }
.card:not(.table-card) .table tr th:last-child {
 border-top-right-radius: 30px;
 border-bottom-right-radius: 30px; 

}
.card:not(.table-card) .table tr th:first-child {

  border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
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
    </style>
@endpush
@push('script-page')
   
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.dataTables-empty').text('No Data Available..');
         $(".loader").fadeOut(10, function() {
        $(".content").show();        
    });
        
    // Your CSS styling goes here
     $('#datepicker').datepicker();
        $('.choices__input').addClass('text-primary');
        $('.choices__placeholder').css('opacity', '1');
       $('.choices__inner').css({
    'border-radius': '15px',
    'color': 'var(--color-customColor)',
    'font-weight': 'bold'
});
       // $('.page-header-title').css('display', 'none');
        $('.choices__list--dropdown').css('color', 'dark');
        $('.dataTable-dropdown').css('display', 'none');
         $('.dataTable-input').css({'height': '45px', 'width': '250px'});
     /*   $('.dataTable-search').css({'float': 'left','position': 'absolute',
    'margin-top': '-145px',
    'margin-left': '55px',
    'width': '250px',
    'height': '45px'});*/
        $('.choices__placeholder').attr('placeholder', 'Enter your text here').css('color', 'red');
        $('.dataTable-input').addClass('placeholder-color');
        
        $("#calendar_icon").on("click",function(){
          $('#datepicker').focus();
        })
    
    // $('.choices').css('margin-right', '25px');
    // $(document).on("blur", "#dateInput", function () {
    //     alert("dfds")
    //     $(this).type('date');
    //     $("#dateIcon").css('display', 'none');
    // });
    
});
        $('.copy_link').click(function(e) {
            e.preventDefault();
            var copyText = $(this).attr('href');

            document.addEventListener('copy', function(e) {
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


        {{--        <a href="{{ route('bill.export') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="{{__('Export')}}"> --}}
        {{--            <i class="ti ti-file-export"></i> --}}
        {{--        </a> --}}

        @can('create quotation')
            {{-- <a href="{{ route('quotations.create', 0) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                title="{{ __('Create') }}">
                <i class="ti ti-plus"></i>
            </a>
            <a href="{{ route('quotation.create') }}"
                data-bs-toggle="tooltip" data-title="{{ __('Quotataion Create') }}" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>--}}
        @endcan
    </div>
@endsection

 
@section('content')
<div class="loader"></div>


  <div class="card content" style="">
    <div class="row"style="margin-top:20px;">
<!--<div class="preload"><img src="http://i.imgur.com/KUJoe.gif"></div>-->

         {{ Form::open(array('url' => 'order/search', 'id' => 'order_filter')) }}
               <div class="row" style="margin-top:70px;">
                  
                    <div class="col-sm-1 form-group">
        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('order_filter').submit(); return false;" data-bs-toggle="tooltip" title="" data-original-title="apply" data-bs-original-title="Apply" style="padding: 10px;float: inline-end;">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                        
                      
                   </div>
                  
                   <div class="col-sm-3 form-group" style="position: relative;">
                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon" style="position: absolute; right: 26px; top: 50%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                    
                    <div class="col-sm-3 form-group">
                       {{ Form::select('products', $products,'null', array('class' => 'form-control select2', 'id'=>'choices-multiple7')) }}
                   </div>
                    {{-- <div class="col-sm-3 form-group">
                       {{ Form::select('status_id', $status,null, array('class' => 'form-control select2','id'=>'choices-multiple6')) }}
                   </div>--}}
                   </div> 
                   <div class="col-sm-5 form-group">
                     
                   </div>
                  
            </div>
             {{Form::close()}}
        <div class="col-md-12">
                        <h4 class=""><a href="#" class="text-dark" style="font-weight: bolder;margin-left: 20px;margin-top: 40px;position:absolute;margin-bottom: -20px;">{{__('Recent Search')}}</a></h4>

            
                <div class="card-body table-border-style ">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th> {{ __('Sr.') }}</th>
                                   <th> {{ __('Ref. SO') }}</th>
                                    <th> {{ __('Product Name') }}</th>
                                    <th> {{ __('Total Cost') }}</th>
                                    <th> {{ __('Quote Date') }}</th>
                                    <th> {{ __('Created by') }}</th>
                                    {{--<th> {{ __('Status') }}</th>
                                     <th> {{ __('Order Status') }}</th>--}}
                                    @if (Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation'))
                                        <th> {{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>

                                        @php
                                         
                                         $productNames= [];
                                          $totalPrice = 0;
                                          $gtotal = 0;
                                        @endphp        
                                @foreach ($quotations as $quotation)
                                    <tr style="margin-top: 30px;background: #F8FAFB;">
                                       
                                        <td>
                                             <div class="number-color ms-2" style="font-size:12px;background-color: {{  $quotation->order_status =='Pending'?'#ff5000':(($quotation->order_status =='On-Going')?'#6fd943':(($quotation->order_status =='Complete')?'#6610f2':'#ffa21d'))}}">
                                                   {{ $quotation->id }}</div> 
                                           </td>
                                           
                                       <td class="Id">
                                            <a href="{{ route('quotation.order.view', ['id' => \Crypt::encrypt($quotation->id), 'job' => '']) }}"
                                                class="text-dark">{{Auth::user()->soNumberFormat($quotation->order_no == 0?$quotation->order_no+1:$quotation->order_no ) }}</a>
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
                                         <td> {{ !empty($quotation->is_revisedBy != '')?$quotation->assignBy->name:$quotation->createdBy->name }} </td>
                                       
                                        
                                          {{--<td>{{ $quotation->order_status }}</td>--}}
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
                                                                <a href="{{ route('quotation.order.view', ['id' => \Crypt::encrypt($quotation->id), 'job' => '']) }}"
                                                                    class="mx-3 btn btn-sm align-items-center"
                                                                    data-bs-toggle="tooltip" title="{{ __('View Quotation') }}"
                                                                    data-original-title="{{ __('Detail') }}">
                                                                    <i class="ti ti-eye text-dark"></i>
                                                                </a>
                                                            </div>
                                                  @can('edit quotation')
                                                        <div class="action-btn bg-light ms-2">
                                                            <a href="#" data-size="lg" data-url="{{ route('jobcard.field.edit', \Crypt::encrypt($quotation->id)) }}" data-ajax-popup="true" data-title="{{__('Add JobCard Field')}}" data-bs-toggle="tooltip" title="{{ __('Create') }}">
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
                            </tbody>
                        </table>
                         {!! $quotations->links("pagination::bootstrap-4") !!}
                        <p style="padding: 12px 10px 10px 30px;">
                            Displaying {{$quotations->count()}} of {{ $quotations->total() }} orders.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')
@section('page-title')
    {{ __('Manage Quotation') }}
@endsection

@section('breadcrumb')
 
@endsection
@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
    <style>
    /* Hide default arrow */
input[type="text"]::-webkit-input-placeholder {
     color: var(--color-customColor);
    font-weight: bold;
}
.z-0{
    display:none;
}
.dataTable-bottom{
    display: none;
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
        
        
        
        #choices-multiple1{
             background: #ffffff url("https://trumen.truelymatch.com/assets/images/down-arrow.png") no-repeat right 0.75rem center / 8px 5px;

        }
    </style>

@endpush
@push('script-page')
    <script src="{{asset('css/summernote/summernote-bs4.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".relative").css('color', '#ff5000')
        $(".leading-5").css('padding', '20px')
        $('.dataTables-empty').text('No Data Available..');
        $(".loader").fadeOut(10, function() {
        $(".content").show();        
    });
        $('.choices__inner').css({
    'border-radius': '15px',
    'color': 'var(--color-customColor)',
    'font-weight': 'bold'
});
    // Your CSS styling goes here
        $('#datepicker').datepicker();
     $('.choices__input').addClass('text-primary');
        $('.choices__placeholder').css('opacity', '1');
    //    $('.page-header-title').css('display', 'none');
      //  $('.choices__list--dropdown').css('color', 'dark');
        // $('.dataTable-top').css('display', 'none');
         $('.dataTable-dropdown').css('display', 'none');
         $('.dataTable-input').css({'height': '45px', 'width': '250px'});
        $('.choices__placeholder').attr('placeholder', 'Enter your text here').css('color', 'red');
        $('.choices').css('margin-right', '25px');
        $('#choices-multiple1').css('color', 'red');
        $('#choices-multiple1').click(function() {
           
     $('#choices-multiple1').css('color', '#000000');
    });
});
$(document).ready(function() {
    
    $('.dataTable-input').val('{{$key}}')
    
    $('.dataTable-input').keyup(function(event) {
      
         var searchVal = $(this).val()
         $('#search').val(searchVal)   
            event.preventDefault();
            if($(this).val().length == 6)
            {
                event.preventDefault();
            $('#search_filter').submit();
            }else{
                event.preventDefault();
            $('#search_filter').submit(); 
            }
            console.log('1');
        
      
    });
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
        
        
         
        $("#calendar_icon").on("click",function(){
          $('#datepicker').focus();
        })
    </script>
@endpush





@section('content')
<div class="loader"></div>

<div class="card content">
    <div class="row" style="padding:21px;">   
    <div class="col-md-8">
          <a href="{{ route('quotation.create') }}" data-bs-toggle="tooltip" title="{{__('Add New Quotation')}}" class="btn btn-outline-light text-primary" style="margin-left: 15px;box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.2), 0 2px 5px 0 rgba(0, 0, 0, 0.19);
  text-align: center;font-weight:bold">
            <i class="ti ti-plus" style="border: 1px solid;border-radius:5px;"></i>
             {{__('Add New Quotation')}}
        </a>
        {{--<a href="{{ route('leads.index') }}" data-bs-toggle="tooltip" title="{{__('Kanban View')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-layout-grid"></i>
        </a>--}}
        </div>
        <div class="col-md-4">
       
    </div>
    </div>
     @php
     $status = [
     '0' =>'Quote Status',
     'Draft',
     'Waiting for approval',
     'Approved',
     'Sent'
     ];
     @endphp
    <div class="row">
<!--<div class="preload"><img src="http://i.imgur.com/KUJoe.gif"></div>-->

         {{ Form::open(array('url' => 'quotation/search', 'id' => 'quotation_filter')) }}
               <div class="row" style="margin:-2px;">
                  
                    <div class="col-sm-1 form-group">
                         <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('quotation_filter').submit(); return false;" data-bs-toggle="tooltip" title="" data-original-title="apply" data-bs-original-title="Apply" style="padding: 10px 15px 10px 15px;float: inline-end;">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                            </a>
                        {{--<span style="float: inline-end;"><i class="ti ti-search" style="position: absolute;margin-left: 14px;margin-top: 12px;z-index: 10;color: white;"></i><input type="submit" title="{{__('Search')}}" data-bs-toggle="tooltip" class="btn btn-primary text-primary form-control" style="border: none;width: 40px;" onmouseover="this.style.backgroundColor='var(--color-customColor)';'"></span>--}}
                      
                   </div>

                 
                   
                       
                    <div class="col-sm-2 form-group" style="position: relative;">
                        <input type="text" class="form-control text-primary" name="date" value="Date" placeholder="Date" title="{{__('Date')}}" data-bs-toggle="tooltip" id="datepicker" style="border-radius: 15px; padding-right: 30px;font-weight: bold;">
                        <i class="bx bx-calendar text-primary" id="calendar_icon" style="position: absolute; right: 26px; top: 50%; transform: translateY(-50%);cursor:pointer"></i>
                    </div>
                   
                    <div class="col-sm-3 form-group">
                       <!--<input type="text" class="form-control btn btn-warning"name="search" value="Assigned By">-->
                        {{ Form::select('user_id', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple3')) }}
                   </div>
                    <div class="col-sm-3 form-group">
                       {{ Form::select('products', $products,'null', array('class' => 'form-control select2', 'id'=>'choices-multiple2')) }}
                   </div> 
                   <div class="col-sm-3 form-group">
                      <select class="form-control select choices__inner" id="choices-multiple1" name="status_id">
                      <option value="">Quote Status</option>
                      <option value="0"{{$chkstatus == 0?'selected':''}}>Draft</option>
                      <option value="1"{{$chkstatus == 1?'selected':''}}>Waiting for approval</option>
                      <option value="2"{{$chkstatus == 2?'selected':''}}>Approved</option>
                      <option value="3"{{$chkstatus == 3?'selected':''}}>Sent</option>
                      </select>
                   </div>
                  
            </div>
             {{Form::close()}}
              {{ Form::open(array('url' => 'quotations/searchSingle','method'=> 'GET', 'id'=> 'search_filter')) }}
                 <input type="hidden" value="0" id="search" name="search">
               {{Form::close()}}
        <div class="col-md-12">
            <h4 class=""><a href="#" class="text-dark" style="font-weight: bolder;margin-left: 20px;margin-top: 40px;position:absolute;margin-bottom: -20px;">{{__('Recent Search')}}</a></h4>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable" style="width:100%;overflow:auto;">
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
                                            
                                        @php
                                         $gtotal =  0;
                                         
                                        @endphp
                                @foreach ($quotations as $key => $quotation)
                                @if(count($quotation->items)>0)
                                    <tr style="margin-top: 30px;background: #F8FAFB;">
                                        @php
                                        $rv = $quotation->is_revised != ''?Auth::user()->quotationRvNumberFormat($quotation->id):Auth::user()->quotationNumberFormat($quotation->id);
                                        $count = \App\Models\Quotation::where('is_revised', '!=', '')->count();
                                        @endphp
                                        
                                        <td>
                                            <div class="number-color ms-2" style="font-size:12px;background-color: {{  $quotation->status ==1?'#ff5000':(($quotation->status ==2)?'#6fd943':(($quotation->status ==3)?'#6610f2':'#ffa21d'))}}">
                                                  {{ ($quotations ->currentpage()-1) * $quotations ->perpage() + $loop->index + 1 }}</div> 
                                           </td>
                                        <td class="Id">
                                            <a href="{{ route('quotation.show', \Crypt::encrypt($quotation->id)) }}"
                                                class="text-dark">{{ $rv }}</a>
                                        </td>
                                        
                                       
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
                                        
                                        
                                        @if(isset($quoteProduct->tax))
                                        @php 
                                        $taxProduct = \App\Models\Tax::find($quoteProduct->tax);
                                        @endphp
                                        <td>{{!empty($taxProduct)?(($gtotal * $taxProduct->rate/100) + $gtotal):$gtotal }}</td>
                                        @else
                                        <td> {{$gtotal}}</td>
                                        @endif
                                        
                                       
                                       
                                        @php
                                        $owner = \App\Models\User::find($quotation->created_by);
                                        @endphp
                                        <td>{{ Auth::user()->dateFormat($quotation->quotation_date) }}</td>
                                        <td> {{ !empty($quotation->is_revisedBy != '')?$quotation->assignBy->name:$quotation->createdBy->name }} </td>
                                       
                                         <td>{{ $quotation->status ==1?'Waiting for Approval':(($quotation->status ==2)?'Approved':(($quotation->status ==3)?'Send':'Draft')) }}</td>
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
                                                      <div class="action-btn bg-light ms-2">
                                                                <a href="{{route('quotation.show', \Crypt::encrypt($quotation->id))}}" class="mx-3 d-inline-flex align-items-center"  data-size="xl" data-bs-toggle="tooltip" title="{{__('View')}}" data-title="{{__('Quotation Detail')}}">
                                                                    <i class="ti ti-eye text-dark"></i>
                                                                </a>
                                                            </div>
                                                     @if($quotation->status ==2)
                                                     <div class="action-btn bg-light ms-2">
                                                            <a href="#" data-size="md" data-url="{{ route('quotation.emails.cc', \Crypt::encrypt($quotation->id)) }}" data-ajax-popup="true"
                                                                class="btn btn-sm align-items-center text-light"
                                                                data-bs-toggle="tooltip" title="Send Quote Email"
                                                                data-original-title="{{ __('Send Quote Email') }}">
                                                               <i class="ti ti-send text-success"></i>
                                                            </a>
                                                        </div>
                                                    @else
                                                     <div class="action-btn bg-light ms-2">
                                                            <a href="javascript:"
                                                                class="btn btn-sm align-items-center text-danger"
                                                                data-bs-toggle="tooltip" title="Send to email"
                                                                data-original-title="{{ __('Send to Email') }}">
                                                               <i class="ti ti-send text-danger"></i>
                                                            </a>
                                                        </div>  
                                                    @endif
                                                   {{-- @can('delete quotation')
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
                                      @endif
                                @endforeach
                            </tbody>
                        </table>
                         {{ $quotations->appends(Request::except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

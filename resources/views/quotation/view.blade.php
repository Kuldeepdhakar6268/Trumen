@extends('layouts.admin')
@section('page-title')
    {{__('Quotation Detail')}}
@endsection

<style>
 *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
 .table td, .table th {
        font-size: 15px;
    }
body{
    background-color: gray;
    /*display: flex;*/
    align-items: center;
    justify-content: center;
    font-family: Arial, Helvetica, sans-serif;
}
.speci_0{
    text-align: center;
}
.display{
    display: flex;
    font-size: 0.7rem;
    align-items: center;
    justify-content: center;
}
.Quotation{
    width: 70vw;
    margin-bottom: 62px !important;
    
    height: 100%;
/*    background-color: white;*/
}

.Quotation-address{
    width: 100%;
}

.Quotation-address-1{
    justify-content: end;
    gap: 1rem;
    padding-right: 3rem;
    margin-top: 1rem;
}
.Quotation-footers>div>p{
    margin-bottom: 1.0rem;
    margin-left: 206;
    font-size: 0.7rem;
}
.Quotation-table>tbody>tr>td {
    border: 1px solid #f1eeee !important;
}
.Quotation-table{
    border: 1px solid #e1d8d8 !important;
    width: 90%;
    /* height: 100rem; */
   
    border-radius: 10px;
    border-collapse:separate;
    border-spacing: 0;
    overflow: scroll;
    
    
}

.Quotation-table>th,thead{
    /* border: 1px solid black; */
    background-color: black;
    color: white;
    height: 3rem;

    
}



.aba {
    list-style: none; /* Remove default bullets */
    text-wrap: nowrap;
    margin-top: 2rem;
    margin-bottom: 2rem;
}

.aba li {
    position: relative; /* Required for pseudo-element positioning */
    padding-left: 30px; /* Space for the image */
    color: blue;
    font-weight: 550;
    font-size: 0.8rem;
}
.aba li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 20px; 
    height: 20px;
    background-image: url('{{asset(Storage::url('uploads/logo/listlogo2.jpg'))}}'); 
    background-size: cover; 
}


.Quotation-table>tbody>tr>td{
    border: 1px solid #f3f0f0 !important;
/*    padding: 1rem;*/
}
th{
    font-size: 1.0rem;
}

th:first-child {
    border-top-left-radius: 10px;
}

/* Styling for top right cell */
th:last-child {
    border-top-right-radius: 10px;
}

tr:last-child{
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}
.Quotation-table>tbody>tr>td{
    font-size: 13px;
}
.Quotation-logos{
    font-size: 1.2rem;
    color: white;
    height: 9rem;
    max-width: 100%;
    
    background-size: contain;
    background-repeat: no-repeat;
    background-image: url('{{asset(Storage::url('uploads/logo/header-logo.png'))}}');
}
.Quotation-logos>p{
    font-size: 16px;
}

.Quotation-footers{
    margin-top: 8rem;
    /* margin-bottom: 2rem; */
    width: 100%;
    height: 3rem;
    display: flex;
    /* padding: 3rem; */
    /*background-position: top;*/
   
    color: white;
    justify-content: space-around;
    font-size: 0.5rem;
    align-items: end;
    /*gap: 17rem;*/
    background-size: cover;
    background-repeat: no-repeat;
    background-image: url('{{asset(Storage::url('uploads/logo/footer_logo.png'))}}');
}

.card:not(.table-card) .table tr th:last-child {
 border-top-right-radius: 30px;
 border-bottom-right-radius: 30px; 

}
.card:not(.table-card) .table tr th:first-child {

  border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
}    
    </style>
@push('script-page')
 <script src="{{ asset('public/js/jquery-barcode.js') }}"></script>
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
        
          $(document).on('click', '#add-notes', function () {
            var notes = $("#disc-note").val();
            var id = $('#lead_id').val();
            var stage_id = $('#qstatus').val();
            if(stage_id == ''){
              return show_toastr('error', 'Please select status', 'error');  
            }
            var url = '{{ route('leads.discussion.store', $quotation->id) }}'
           $.ajax({
                type: 'POST',
                url: url,
                data: {
                   
                    'id': id,
                    'comment':notes,
                    'stage_id': stage_id,
                    'check': 'quote',
                    'session_key': session_key,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                   
                    // console.log(data.msg)
                    //  console.log(data.data)
                       if (data.error) {
                            show_toastr('error', response.msg, 'error'); 
                        $('#note-lists').html('<p>' + data.error + '</p>');
                    } else {
                         show_toastr('success', data.msg, 'success');
                         $("#disc-note").val('');
                        var postHtml = '';
                        var combinedData = [];

                            // Add type indicator and combine arrays
                           
                        $.each(data.data, function(index, values) {
                             var stage = values.stage;
                              console.log(stage.name)
                             $.each(values.discussions, function(index, value) {
                        console.log(value)
                        var formattedDate = moment(value.created_at).format('MM/DD/YYYY ddd hh:mm a');
                            postHtml += '<li class="list-group-item px-0"><div class="d-block d-sm-flex align-items-start"><img src="https://trumen.truelymatch.com/storage/uploads/avatar/avatar.png" class="img-fluid wid-40 me-3 mb-2 mb-sm-0" alt="image"><div class="w-100"><div class="d-flex align-items-center justify-content-between"><div class="mb-3 mb-sm-0"><h6 class="mb-0">{{Auth::user()->name}}</h6><span class="text-muted text-sm">'+value.comment+'</span></div><div class="form-check form-switch form-switch-right mb-2">'+formattedDate+' </div></div></div></div></li>';
                             });
                        });
                        console.log(postHtml)
                        $('#note-lists').html(postHtml);
                    }
                },
                error: function(xhr, status, error) {
                    $('#note-lists').html('<p>An error occurred: ' + error + '</p>');
                }
                   
                   
            });
        });
         $(document).on('change', '.quotation_status', function () {
            
                var status = $(this).val();
                var url = '{{route('quotation.order.status', ['id' => $quotation->id])}}';
               
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                       
                       'status': status,
                       'check': 'quotation',
                       "_token": "{{ csrf_token() }}",
                    },
                    cache: false,
                    success: function (data) {
                      show_toastr('success', data.msg, 'success');
                    },
                    
                });

            
        });
        $(document).ready(function() {
            $(".dataTables-empty").text('No Record Available..')
            $(".product_barcode").each(function() {
                var id = $(this).attr("id");
                var sku = $(this).data('skucode');
                sku = encodeURIComponent(sku);
                generateBarcode(sku, id);
            });
        });
        function generateBarcode(val, id) {

            var value = val;
            var btype = '{{ $barcode['barcodeType'] }}';
            var renderer = '{{ $barcode['barcodeFormat'] }}';
            var settings = {
                output: renderer,
                bgColor: '#FFFFFF',
                color: '#000000',
                barWidth: '1',
                barHeight: '50',
                moduleSize: '5',
                posX: '10',
                posY: '20',
                addQuietZone: '1'
            };
            $('#' + id).html("").show().barcode(value, btype, settings);

        }

        setTimeout(myGreeting, 1000);
        function myGreeting() {
            if ($(".datatable-barcode").length > 0) {
                const dataTable =  new simpleDatatables.DataTable(".datatable-barcode");
            }
        }
    </script>
@endpush

@php
    $settings = Utility::settings();
    $Qstatus = [
    'Pending',
    'Order',
    'Rejected'
    ]
@endphp
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('quotation.index')}}">{{__('Quotation Summary')}}</a></li>
    <li class="breadcrumb-item">{{ AUth::user()->quotationNumberFormat($quotation->is_revised != ''?$quotation->is_revised:$quotation->id) }}</li>
@endsection

@section('action-btn')
    <div class="float-end">
           
            @if($quotation->assigned_to == \Auth()->user()->id)     
            <div class="form-group" style="float: inline-start;width: 150px;padding-right: 5px;">
            
            <select class="form-control quotation_status" name="status">
                <option>Change Status</option>
                <option value="0">Draft</option>
                <option value="1"{{$quotation->status == 1?'selected':''}}>Waiting for approval</option>
                <option value="2"{{$quotation->status == 2?'selected':''}}>Approved</option>
               
            </select>
            </div>
            @else
             @if(!empty($deal))
                <a href="@can('View Deal') @if($deal->is_active) {{route('deals.show',$deal->id)}} @else # @endif @else # @endcan" data-size="lg" data-bs-toggle="tooltip" class="btn btn-sm btn-secondary" style="padding: 8px;">
                   {{__('Customer Converted')}}
                </a>
            @else
         <a href="{{ route('quotation.convert.customer',$quotation->lead_id)}}" class="btn btn-primary">{{__('Convert to Customer')}}</a>
          @endif
        @if($quotation->is_assigned == 0 && $quotation->is_jobcard == 0)
        <a href="#" data-size="sm" data-url="{{ route('quotation.send', [$quotation->id, 'check' => 'check']) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('For Approval')}}" class="btn btn-primary">{{__('Save & Send')}}</a>
        @else
         <a href="#" data-bs-toggle="tooltip" title="{{__('All ready assigned')}}" class="btn btn-secondary">{{__('Save & Send')}}</a>
        @endif
        @if($quotation->is_order == 0 && $quotation->status == 2)<a href="{{ route('quotation.status', ['id' => $quotation->id, 'status' => 'order'])}}" class="btn btn-primary">{{__('Change to Order')}}</a>
        
        @endif
        {{--<a href="#" class="btn btn-primary">{{__('Download')}}</a>--}}
        <a href="{{ route('quotation.pdf', Crypt::encrypt($quotation->id))}}" class="btn btn-primary" target="_blank">{{__('Download')}}</a>
        @endif
    </div>
@endsection

@section('content')
    <div class="row">
                <div class="col-xl-12">
                    
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="lead-sidenav" style="flex-direction: unset;">
                            @if(Auth::user()->type != 'client')
                                {{--<a href="#general" class="list-group-item list-group-item-action border-0">{{__('General')}}
                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>--}}
                                <div data-target="content1" class="list-group-item list-group-item-action border-0 tab active" style="cursor: pointer;">{{__('Quotation')}}
                                    <div class="float-end"></div>
                                </div>
                            @endif

                           
                                <div data-target="content2" data-title="{{ __('Quotataion') }}" class="list-group-item list-group-item-action border-0 tab" style="cursor: pointer;">| {{ __('Revise Quotation')}}
                                    <div class="float-end"></div>
                                </div>
                          
                                <div  data-target="content5" class="list-group-item list-group-item-action border-0 tab" style="cursor: pointer;">|{{__('Call Note')}}
                                    <div class="float-end"></div>
                                </div>
                         
                            @if(Auth::user()->type != 'client')
                                <div data-target="content6" class="list-group-item list-group-item-action border-0 tab" style="cursor: pointer;border-bottom-left-radius: unset !important;border-top-left-radius: inherit;border-top-right-radius: inherit;;border-bottom-right-radius: unset !important;
">| {{__('Activity')}}
                                    <div class="float-end"></i></div>
                                </div>
                            @endif
                           

                        </div>
                    </div>
                </div>
              
            </div>
            
     @php
  $lead = \App\Models\Lead::find($quotation->lead_id);
  $customer = \App\Models\Customer::where('id', $quotation->assigned_to)->first();
  $source = '';
            $year = \Carbon\Carbon::now()->format('y');
            $years= \Carbon\Carbon::now()->format('Y-m-d');
            $yearNext = \Carbon\Carbon::parse($years)->addYears(1);
            
  @endphp        
    <div class="content" id="content1" style="display:block;width: 839px;margin-left: 120px;">  
    <div class="row">

<!--Page 1 of 4-->   

<div class="Quotation card" style="margin-top: 62px;padding:0px;">
       <div class="Quotation-address">
        <div class="Quotation-logos display">
            <!-- <img style="width: 100%; height: auto;" src="logo.jpg" alt=""> -->
            <p>Trumen Technologies Pvt. Ltd.</p>
        </div>
        <div class=" ">
            <div class="display Quotation-address-1">
        <span style="gap: 0.8rem;" class="display"><svg width="1rem"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M9.36556 10.6821C10.302 12.3288 11.6712 13.698 13.3179 14.6344L14.2024 13.3961C14.4965 12.9845 15.0516 12.8573 15.4956 13.0998C16.9024 13.8683 18.4571 14.3353 20.0789 14.4637C20.599 14.5049 21 14.9389 21 15.4606V19.9234C21 20.4361 20.6122 20.8657 20.1022 20.9181C19.5723 20.9726 19.0377 21 18.5 21C9.93959 21 3 14.0604 3 5.5C3 4.96227 3.02742 4.42771 3.08189 3.89776C3.1343 3.38775 3.56394 3 4.07665 3H8.53942C9.0611 3 9.49513 3.40104 9.5363 3.92109C9.66467 5.54288 10.1317 7.09764 10.9002 8.50444C11.1427 8.9484 11.0155 9.50354 10.6039 9.79757L9.36556 10.6821ZM6.84425 10.0252L8.7442 8.66809C8.20547 7.50514 7.83628 6.27183 7.64727 5H5.00907C5.00303 5.16632 5 5.333 5 5.5C5 12.9558 11.0442 19 18.5 19C18.667 19 18.8337 18.997 19 18.9909V16.3527C17.7282 16.1637 16.4949 15.7945 15.3319 15.2558L13.9748 17.1558C13.4258 16.9425 12.8956 16.6915 12.3874 16.4061L12.3293 16.373C10.3697 15.2587 8.74134 13.6303 7.627 11.6707L7.59394 11.6126C7.30849 11.1044 7.05754 10.5742 6.84425 10.0252Z"></path></svg>08109062425, 0731-4972065</span>
        <span style="gap: 0.8rem;" class="display"><svg width="1rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M3 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3ZM20 7.23792L12.0718 14.338L4 7.21594V19H20V7.23792ZM4.51146 5L12.0619 11.662L19.501 5H4.51146Z"></path></svg>sales@trumen.in</span>
        <span style="gap: 0.8rem;" class="display"><svg width="1rem" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" version="1.1" id="Capa_1" viewBox="0 0 58 58" xml:space="preserve">
            <path d="M50.688,48.222C55.232,43.101,58,36.369,58,29c0-7.667-2.996-14.643-7.872-19.834c0,0,0-0.001,0-0.001  c-0.004-0.006-0.01-0.008-0.013-0.013c-5.079-5.399-12.195-8.855-20.11-9.126l-0.001-0.001L29.439,0.01C29.293,0.005,29.147,0,29,0  s-0.293,0.005-0.439,0.01l-0.563,0.015l-0.001,0.001c-7.915,0.271-15.031,3.727-20.11,9.126c-0.004,0.005-0.01,0.007-0.013,0.013  c0,0,0,0.001-0.001,0.002C2.996,14.357,0,21.333,0,29c0,7.369,2.768,14.101,7.312,19.222c0.006,0.009,0.006,0.019,0.013,0.028  c0.018,0.025,0.044,0.037,0.063,0.06c5.106,5.708,12.432,9.385,20.608,9.665l0.001,0.001l0.563,0.015C28.707,57.995,28.853,58,29,58  s0.293-0.005,0.439-0.01l0.563-0.015l0.001-0.001c8.185-0.281,15.519-3.965,20.625-9.685c0.013-0.017,0.034-0.022,0.046-0.04  C50.682,48.241,50.682,48.231,50.688,48.222z M2.025,30h12.003c0.113,4.239,0.941,8.358,2.415,12.217  c-2.844,1.029-5.563,2.409-8.111,4.131C4.585,41.891,2.253,36.21,2.025,30z M8.878,11.023c2.488,1.618,5.137,2.914,7.9,3.882  C15.086,19.012,14.15,23.44,14.028,28H2.025C2.264,21.493,4.812,15.568,8.878,11.023z M55.975,28H43.972  c-0.122-4.56-1.058-8.988-2.75-13.095c2.763-0.968,5.412-2.264,7.9-3.882C53.188,15.568,55.736,21.493,55.975,28z M28,14.963  c-2.891-0.082-5.729-0.513-8.471-1.283C21.556,9.522,24.418,5.769,28,2.644V14.963z M28,16.963V28H16.028  c0.123-4.348,1.035-8.565,2.666-12.475C21.7,16.396,24.821,16.878,28,16.963z M30,16.963c3.179-0.085,6.3-0.566,9.307-1.438  c1.631,3.91,2.543,8.127,2.666,12.475H30V16.963z M30,14.963V2.644c3.582,3.125,6.444,6.878,8.471,11.036  C35.729,14.45,32.891,14.881,30,14.963z M40.409,13.072c-1.921-4.025-4.587-7.692-7.888-10.835  c5.856,0.766,11.125,3.414,15.183,7.318C45.4,11.017,42.956,12.193,40.409,13.072z M17.591,13.072  c-2.547-0.879-4.991-2.055-7.294-3.517c4.057-3.904,9.327-6.552,15.183-7.318C22.178,5.38,19.512,9.047,17.591,13.072z M16.028,30  H28v10.038c-3.307,0.088-6.547,0.604-9.661,1.541C16.932,37.924,16.141,34.019,16.028,30z M28,42.038v13.318  c-3.834-3.345-6.84-7.409-8.884-11.917C21.983,42.594,24.961,42.124,28,42.038z M30,55.356V42.038  c3.039,0.085,6.017,0.556,8.884,1.4C36.84,47.947,33.834,52.011,30,55.356z M30,40.038V30h11.972  c-0.113,4.019-0.904,7.924-2.312,11.58C36.547,40.642,33.307,40.126,30,40.038z M43.972,30h12.003  c-0.228,6.21-2.559,11.891-6.307,16.348c-2.548-1.722-5.267-3.102-8.111-4.131C43.032,38.358,43.859,34.239,43.972,30z   M9.691,47.846c2.366-1.572,4.885-2.836,7.517-3.781c1.945,4.36,4.737,8.333,8.271,11.698C19.328,54.958,13.823,52.078,9.691,47.846  z M32.521,55.763c3.534-3.364,6.326-7.337,8.271-11.698c2.632,0.945,5.15,2.209,7.517,3.781  C44.177,52.078,38.672,54.958,32.521,55.763z"/>
            </svg>www.trumen.in</span>
        </div>
        <div class="display Quotation-address-1" style="padding-right: 7.5rem;">
        <p class="display" style="gap: 0.8rem;" > <svg width="1rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 23.7279L5.63604 17.364C2.12132 13.8492 2.12132 8.15076 5.63604 4.63604C9.15076 1.12132 14.8492 1.12132 18.364 4.63604C21.8787 8.15076 21.8787 13.8492 18.364 17.364L12 23.7279ZM16.9497 15.9497C19.6834 13.2161 19.6834 8.78392 16.9497 6.05025C14.2161 3.31658 9.78392 3.31658 7.05025 6.05025C4.31658 8.78392 4.31658 13.2161 7.05025 15.9497L12 20.8995L16.9497 15.9497ZM12 13C10.8954 13 10 12.1046 10 11C10 9.89543 10.8954 9 12 9C13.1046 9 14 9.89543 14 11C14 12.1046 13.1046 13 12 13Z"></path></svg>39, Mangal Nagar, Behind Sai Ram Plaza, AB Road, Indore, M.P. </p>
        </div>

        </div>
        <div class="display Quotation-address-1">
       
        </div>
       </div>


       <div class="display">
        <table class="Quotation-table">
            <thead>
                <th colspan="3" style="text-align: center;">Quotation</th>
               
            </thead>

            <tbody>
               
                <tr>
                    <td><b>{{!empty($quotation->organization)?$quotation->organization->name:''}}</b></td>
                    <td>Quote Ref</td>
                    @if($quotation->is_revised != '')
                     @php
                $arr = \App\Models\Quotation::where('is_revised', $quotation->is_revised)->pluck('id')->toArray();
                $rv = array_search($quotation->id, $arr)+1;
               
                @endphp
                    <td>TTPL/{{$year}}{{$yearNext->format('y')}}/{{$quotation->is_revised}}{{$quotation->is_revised != ''?'R'. array_search($quotation->id, $arr)+1:''}}</td>
                    @else
                     <td>TTPL/{{$year}}{{$yearNext->format('y')}}/{{$quotation->id}}</td>
                    @endif
                </tr>

                <tr>
                    <td>Plot No. {{!empty($quotation->organization)?$quotation->organization->plot:''}}</td>
                    <td>Quote Date</td>
                    <td>{{ \Carbon\Carbon::parse($quotation->quotation_date)->format('d/m/Y')}}</td>
                </tr>

                <tr>
                    <td>Opp: {{!empty($quotation->organization)?$quotation->organization->street:''}}, {{$quotation->organization->area}},</td>
                    <td>Enquiry Ref</td>
                    <td>
                        @foreach($lead->sources() as $source) 
                                                  <div class="hover-content">
                                                 {{  $source->name }}
                                                 
                                                   @if (!$loop->last)
                                                        ,
                                                    @endif
                                                    @endforeach
                       </td>
                </tr>

                <tr>
                    <td>{{!empty($quotation->organization)?$quotation->organization->street:''}}, {{!empty($quotation->organization)?$quotation->organization->area:''}},{{!empty($quotation->organization)?$quotation->organization->city:''}}, {{!empty($quotation->organization)?$quotation->organization->state:''}} - {{!empty($quotation->organization)?$quotation->organization->pin:''}}</td>
                    <td>Enquiry Date</td>
                    <td>{{ \Carbon\Carbon::parse($lead->date)->format('d/m/Y')}}</td>
                </tr>

                <tr>
                    <td>Mobile: {{!empty($quotation->organization)?$quotation->organization->phone:''}}</td>
                    <td>GST Number</td>
                    <td>{{ !empty($customer)?$customer->tax_number:''}}</td>
                </tr>

                <tr>
                    <td>Email: {{!empty($quotation->organization)?$quotation->organization->email:''}}</td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>Kind Attention: {{ !empty($customer)?$customer->prefix:''}}{{ !empty($customer)?$customer->name:''}}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2rem; line-height: 2rem; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;" >
                <p style="font-weight: 550;">Subject: {{$quotation->subjects}}.</p>
                <p style="margin: 1rem 0 1rem 0;">{{$quotation->notes}}</p>
                {{--<div >
               
                <p style="margin: 1rem 0 1rem 0;">With reference to your email enquiry for the requirement of 
                @foreach ($iteams as $item)
                 <span style="font-weight: 550;">{{ $item->product()->name }},</span>
                @if (!$loop->last)
                    ,
                @endif
                @endforeach
                    we are pleased to submit hereunder our offer for the same.</p>
                <p><span style="font-weight: 550;">"TRUMEN"</span> is an <span style="font-weight: 550;">9001:2015</span> manufacturer & exporter of level control instruments and our list of instruments comprise: Tuning Fork Level Switches for Solids & Liquids, Rotating Paddle Level Switch for Solids, Vibrating Rod Level Switch for Solids, Conductivity Level Switch for Water & Conductive Liquids, RF Admittance Level Switches for Solids and Coat Forming Material, Capacitance Type Level Switches / Transmitters & Indicators, Hydrostatic Level Transmitters, Guided Wave Radar Level Transmitters etc. to name a few. Further, we are pleased to inform that all our instruments are <span style="font-weight: 550;">CE</span> approved.</p>
                <p style="margin: 1rem 0 1rem 0;">The quoted model is having following advanced features to ease your process control:</p>
                </div>--}}
                <div>
                    <ul class="abc aba">
                        <li>Compact Size for Easy Installation with IP-68 Enclosures</li>
                        <li>Micro Processor Based</li>
                        <li>15-260VAC & 15-60VDC Universal supply for integral model suitable for all industrial supplies.</li>
                        <li>In built Time Delay for probe covered & probe uncovered (wet & dry) conditions</li>
                         <li>Models available, suitable for high pressures up to 15 Bar</li>
                         <li>CE certified products.</li>
                        </ul>

                </div>

                <p>Please feel free to contact us for further assistance.</p>
            </td>
                </tr>

            </tbody>
        </table>
       </div>
       <div class="Quotation-footers">
          <p style="line-height: 1.4;width: 184px;">TTPL/{{$year}}{{$yearNext->format('y')}}/{{$quotation->id}} {{\Carbon\Carbon::parse($quotation->quotation_date)->format('d.m.Y')}}</p>
          <div>
          <p>Technologies provides maximum possible customization on all of its products</p></div>
       </div>

   </div> 
<!--Page 1 of 4 End-->
<!--Page 2 of 4-->
 @foreach ($iteams as $key => $item)
<div class="Quotation card" style="padding:0px;">
       <div class="Quotation-address">
        <div class="Quotation-logos display">
            <!-- <img style="width: 100%; height: auto;" src="logo.jpg" alt=""> -->
            <p>Trumen Technologies Pvt. Ltd.</p>
        </div>
        <div class=" ">
            <div class="display Quotation-address-1">
        <span style="gap: 0.8rem;" class="display"><svg width="1rem"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M9.36556 10.6821C10.302 12.3288 11.6712 13.698 13.3179 14.6344L14.2024 13.3961C14.4965 12.9845 15.0516 12.8573 15.4956 13.0998C16.9024 13.8683 18.4571 14.3353 20.0789 14.4637C20.599 14.5049 21 14.9389 21 15.4606V19.9234C21 20.4361 20.6122 20.8657 20.1022 20.9181C19.5723 20.9726 19.0377 21 18.5 21C9.93959 21 3 14.0604 3 5.5C3 4.96227 3.02742 4.42771 3.08189 3.89776C3.1343 3.38775 3.56394 3 4.07665 3H8.53942C9.0611 3 9.49513 3.40104 9.5363 3.92109C9.66467 5.54288 10.1317 7.09764 10.9002 8.50444C11.1427 8.9484 11.0155 9.50354 10.6039 9.79757L9.36556 10.6821ZM6.84425 10.0252L8.7442 8.66809C8.20547 7.50514 7.83628 6.27183 7.64727 5H5.00907C5.00303 5.16632 5 5.333 5 5.5C5 12.9558 11.0442 19 18.5 19C18.667 19 18.8337 18.997 19 18.9909V16.3527C17.7282 16.1637 16.4949 15.7945 15.3319 15.2558L13.9748 17.1558C13.4258 16.9425 12.8956 16.6915 12.3874 16.4061L12.3293 16.373C10.3697 15.2587 8.74134 13.6303 7.627 11.6707L7.59394 11.6126C7.30849 11.1044 7.05754 10.5742 6.84425 10.0252Z"></path></svg>08109062425, 0731-4972065</span>
        <span style="gap: 0.8rem;" class="display"><svg width="1rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M3 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3ZM20 7.23792L12.0718 14.338L4 7.21594V19H20V7.23792ZM4.51146 5L12.0619 11.662L19.501 5H4.51146Z"></path></svg>sales@trumen.in</span>
        <span style="gap: 0.8rem;" class="display"><svg width="1rem" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" version="1.1" id="Capa_1" viewBox="0 0 58 58" xml:space="preserve">
            <path d="M50.688,48.222C55.232,43.101,58,36.369,58,29c0-7.667-2.996-14.643-7.872-19.834c0,0,0-0.001,0-0.001  c-0.004-0.006-0.01-0.008-0.013-0.013c-5.079-5.399-12.195-8.855-20.11-9.126l-0.001-0.001L29.439,0.01C29.293,0.005,29.147,0,29,0  s-0.293,0.005-0.439,0.01l-0.563,0.015l-0.001,0.001c-7.915,0.271-15.031,3.727-20.11,9.126c-0.004,0.005-0.01,0.007-0.013,0.013  c0,0,0,0.001-0.001,0.002C2.996,14.357,0,21.333,0,29c0,7.369,2.768,14.101,7.312,19.222c0.006,0.009,0.006,0.019,0.013,0.028  c0.018,0.025,0.044,0.037,0.063,0.06c5.106,5.708,12.432,9.385,20.608,9.665l0.001,0.001l0.563,0.015C28.707,57.995,28.853,58,29,58  s0.293-0.005,0.439-0.01l0.563-0.015l0.001-0.001c8.185-0.281,15.519-3.965,20.625-9.685c0.013-0.017,0.034-0.022,0.046-0.04  C50.682,48.241,50.682,48.231,50.688,48.222z M2.025,30h12.003c0.113,4.239,0.941,8.358,2.415,12.217  c-2.844,1.029-5.563,2.409-8.111,4.131C4.585,41.891,2.253,36.21,2.025,30z M8.878,11.023c2.488,1.618,5.137,2.914,7.9,3.882  C15.086,19.012,14.15,23.44,14.028,28H2.025C2.264,21.493,4.812,15.568,8.878,11.023z M55.975,28H43.972  c-0.122-4.56-1.058-8.988-2.75-13.095c2.763-0.968,5.412-2.264,7.9-3.882C53.188,15.568,55.736,21.493,55.975,28z M28,14.963  c-2.891-0.082-5.729-0.513-8.471-1.283C21.556,9.522,24.418,5.769,28,2.644V14.963z M28,16.963V28H16.028  c0.123-4.348,1.035-8.565,2.666-12.475C21.7,16.396,24.821,16.878,28,16.963z M30,16.963c3.179-0.085,6.3-0.566,9.307-1.438  c1.631,3.91,2.543,8.127,2.666,12.475H30V16.963z M30,14.963V2.644c3.582,3.125,6.444,6.878,8.471,11.036  C35.729,14.45,32.891,14.881,30,14.963z M40.409,13.072c-1.921-4.025-4.587-7.692-7.888-10.835  c5.856,0.766,11.125,3.414,15.183,7.318C45.4,11.017,42.956,12.193,40.409,13.072z M17.591,13.072  c-2.547-0.879-4.991-2.055-7.294-3.517c4.057-3.904,9.327-6.552,15.183-7.318C22.178,5.38,19.512,9.047,17.591,13.072z M16.028,30  H28v10.038c-3.307,0.088-6.547,0.604-9.661,1.541C16.932,37.924,16.141,34.019,16.028,30z M28,42.038v13.318  c-3.834-3.345-6.84-7.409-8.884-11.917C21.983,42.594,24.961,42.124,28,42.038z M30,55.356V42.038  c3.039,0.085,6.017,0.556,8.884,1.4C36.84,47.947,33.834,52.011,30,55.356z M30,40.038V30h11.972  c-0.113,4.019-0.904,7.924-2.312,11.58C36.547,40.642,33.307,40.126,30,40.038z M43.972,30h12.003  c-0.228,6.21-2.559,11.891-6.307,16.348c-2.548-1.722-5.267-3.102-8.111-4.131C43.032,38.358,43.859,34.239,43.972,30z   M9.691,47.846c2.366-1.572,4.885-2.836,7.517-3.781c1.945,4.36,4.737,8.333,8.271,11.698C19.328,54.958,13.823,52.078,9.691,47.846  z M32.521,55.763c3.534-3.364,6.326-7.337,8.271-11.698c2.632,0.945,5.15,2.209,7.517,3.781  C44.177,52.078,38.672,54.958,32.521,55.763z"/>
            </svg>www.trumen.in</span>
        </div>
        <div class="display Quotation-address-1" style="padding-right: 7.5rem;">
        <p class="display" style="gap: 0.8rem;" > <svg width="1rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 23.7279L5.63604 17.364C2.12132 13.8492 2.12132 8.15076 5.63604 4.63604C9.15076 1.12132 14.8492 1.12132 18.364 4.63604C21.8787 8.15076 21.8787 13.8492 18.364 17.364L12 23.7279ZM16.9497 15.9497C19.6834 13.2161 19.6834 8.78392 16.9497 6.05025C14.2161 3.31658 9.78392 3.31658 7.05025 6.05025C4.31658 8.78392 4.31658 13.2161 7.05025 15.9497L12 20.8995L16.9497 15.9497ZM12 13C10.8954 13 10 12.1046 10 11C10 9.89543 10.8954 9 12 9C13.1046 9 14 9.89543 14 11C14 12.1046 13.1046 13 12 13Z"></path></svg>39, Mangal Nagar, Behind Sai Ram Plaza, AB Road, Indore, M.P. </p>
        </div>

        </div>
        <div class="display Quotation-address-1">
       
        </div>
       </div>


       <div class="display">
        <table class="Quotation-table">
            <thead>
                <th colspan="5" style="text-align: center;">Quotation</th>
                
            </thead>

            
            <tbody>
                <tr>
                    <td style="text-align:center;"><b>S.No.</b></td>
                    <td style="text-align:center;"><b>Description</b></td>
                    <td style="text-align:center;"><b>Unite Rate ({{$item->currency == 'USD'?'$':($item->currency == 'EURO'?'€':'₹')}})</b></td>
                    <td style="text-align:center;"><b>Qty</b></td>
                    <td style="text-align:center;"><b>Total ({{$item->currency == 'USD'?'$':($item->currency == 'EURO'?'€':'₹')}})</b></td>
                </tr>
                
               
           
           <?php
          
           $html = '';
           
            $arr = explode(':', $item->model);
            $array = explode('-', $arr[1]);
        //   dd($array);
            // $cat = Specification::with('subspecifications')->where(['priority' => 0, 'group_id' => $item->group_ids])->get();   
            // $productService =  \App\Models\ProductService::find($item->id);
            $cat = \App\Models\Specification::with('subspecifications')->where(['priority' => 0, 'product_model_id' =>$item->product_model_id])->get();
            //  $material = \App\Models\SpecificationCodeMaterial::where(['specification_code_order_id' =>$productService->specification_code_order_id])->orderBy('id', 'desc')->pluck('name')->toArray();
            $glands = $item->gland != 0?\App\Models\Specification::find($item->gland)->name:'';
            $integrals = $item->integral == 'rmt1'?'Remote':(($item->integral == 'rmt2')?'Remote':'');
            $deviceName = $item->fd_cd == 'cd'?'CD':'FD';
            $fd_cds = $item->fd_cd != ''?'Device Type: '.$deviceName:'';
            $lengths = $item->length;
            $n_model = $item->model_new;
            $lids = \App\Models\QuotationProductDesc::where('quotation_product_id', $item->id)->pluck('label_id')->toArray();
            // dd($lids);
             ?>
             <tr>
                    <td></td>
                    <td><div style="text-decoration: underline; line-height: 3rem; font-weight: 550; text-align:center;">
                       
                                                  <p>
                             
                                                 {{ $item->product()->name }}
                                                    </p>
                       
                        <p>HSN Code: {{$item->hsn_code}}</p><p>Application: {{$item->application_text == ''?$item->application:$item->application_text}}</p></div></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>{{$key+1}}.0</td>
                    <td><b style="padding: 0px 0px 0px 10px;">Model: {{$item->model_new != ''?$item->model_new:$item->model}}</b></td>
                    <td><b style="padding: 0px 0px 0px 10px;">{{$item->price}}{{$item->currency == 'USD'?'$':($item->currency == 'EURO'?'€':'₹')}}</b></td>
                    <td><b style="padding: 0px 0px 0px 10px;">{{$item->quantity}}</b></td>
                    <td><b style="padding: 0px 0px 0px 10px;">{{$item->price}}{{$item->currency == 'USD'?'$':($item->currency == 'EURO'?'€':'₹')}}</b></td>
                </tr>
                @if($item->Enclosure == '' && $item->gland != '')
                 <tr>
                    <td></td>
                    <td><b style="padding: 0px 0px 0px 10px;">{{$item->Enclosure == ''?$glands:''}}</b></td>
                    <td></td>
                    <td><b style="padding: 0px 0px 0px 10px;"></td>
                    <td><b style="padding: 0px 0px 0px 10px;"></b></td>
                </tr>
                @endif
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
                
                  $slName = \App\Models\QuotationProductName::where('quotation_product_id', $item->id)->get();
                    ?>
                    
                 @if (array_search($cs->prefix, $array) !== false) 
                <tr>
                   
                    <td style="border-bottom: 1px solid #fff !important;"></td>
                    <td class=""><b style="padding: 10px;">{{ $cs->prefix}}</b> @if($c->name == 'Enclosure') {{$integrals}} {{$glands}}@endif  {{$c->name}}:
                    @if (array_search($c->id, $lids) !== false)
                    @php
                    $dd = \App\Models\QuotationProductDesc::where('label_id', $c->id)->where('quotation_product_id', $item->id)->first();
                   
                    @endphp
                    {{$dd->description}},
                    @else
                    {{$cs->name}},
                    @endif
                    @foreach ($slName as $sl)
                    @php $nnn = \App\Models\Specification::find($sl->product_id);
                    $Priority = \App\Models\Specification::where('id',$nnn->priority)->first();
                    @endphp
                    @if($nnn->parent == $c->id && $nnn->child_id == null)
                   ({{$Priority->name}}: {{$nnn->name}})
                    @endif
                     @if($nnn->child_id == $c->id)
                   ({{$Priority->name}}: {{$nnn->name}})
                    @endif
                    @endforeach
                    @if($c->name == 'Enclosure')
                    {{$fd_cds != ''?($fd_cds):''}}
                    
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
                   
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
               
               @endif 
         @endforeach
        
         @endforeach 
         
        
            </tbody>
        </table>
       </div>
       <div class="Quotation-footers">
          <p style="line-height: 1.4;width: 184px;">TTPL/{{$year}}{{$yearNext->format('y')}}/{{$quotation->id}} {{\Carbon\Carbon::parse($quotation->quotation_date)->format('d.m.Y')}}</p>
          <div>
          <p>Technologies provides maximum possible customization on all of its products</p></div>
       </div>

   </div> 
      @endforeach
<!--Page 2 of 4 End-->
<!--Page 3 of 4-->
<div class="Quotation card" style="padding:0px;">
       <div class="Quotation-address">
        <div class="Quotation-logos display">
            <!-- <img style="width: 100%; height: auto;" src="logo.jpg" alt=""> -->
            <p>Trumen Technologies Pvt. Ltd.</p>
        </div>
        <div class=" ">
            <div class="display Quotation-address-1">
        <span style="gap: 0.8rem;" class="display"><svg width="1rem"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M9.36556 10.6821C10.302 12.3288 11.6712 13.698 13.3179 14.6344L14.2024 13.3961C14.4965 12.9845 15.0516 12.8573 15.4956 13.0998C16.9024 13.8683 18.4571 14.3353 20.0789 14.4637C20.599 14.5049 21 14.9389 21 15.4606V19.9234C21 20.4361 20.6122 20.8657 20.1022 20.9181C19.5723 20.9726 19.0377 21 18.5 21C9.93959 21 3 14.0604 3 5.5C3 4.96227 3.02742 4.42771 3.08189 3.89776C3.1343 3.38775 3.56394 3 4.07665 3H8.53942C9.0611 3 9.49513 3.40104 9.5363 3.92109C9.66467 5.54288 10.1317 7.09764 10.9002 8.50444C11.1427 8.9484 11.0155 9.50354 10.6039 9.79757L9.36556 10.6821ZM6.84425 10.0252L8.7442 8.66809C8.20547 7.50514 7.83628 6.27183 7.64727 5H5.00907C5.00303 5.16632 5 5.333 5 5.5C5 12.9558 11.0442 19 18.5 19C18.667 19 18.8337 18.997 19 18.9909V16.3527C17.7282 16.1637 16.4949 15.7945 15.3319 15.2558L13.9748 17.1558C13.4258 16.9425 12.8956 16.6915 12.3874 16.4061L12.3293 16.373C10.3697 15.2587 8.74134 13.6303 7.627 11.6707L7.59394 11.6126C7.30849 11.1044 7.05754 10.5742 6.84425 10.0252Z"></path></svg>08109062425, 0731-4972065</span>
        <span style="gap: 0.8rem;" class="display"><svg width="1rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M3 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3ZM20 7.23792L12.0718 14.338L4 7.21594V19H20V7.23792ZM4.51146 5L12.0619 11.662L19.501 5H4.51146Z"></path></svg>sales@trumen.in</span>
        <span style="gap: 0.8rem;" class="display"><svg width="1rem" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" version="1.1" id="Capa_1" viewBox="0 0 58 58" xml:space="preserve">
            <path d="M50.688,48.222C55.232,43.101,58,36.369,58,29c0-7.667-2.996-14.643-7.872-19.834c0,0,0-0.001,0-0.001  c-0.004-0.006-0.01-0.008-0.013-0.013c-5.079-5.399-12.195-8.855-20.11-9.126l-0.001-0.001L29.439,0.01C29.293,0.005,29.147,0,29,0  s-0.293,0.005-0.439,0.01l-0.563,0.015l-0.001,0.001c-7.915,0.271-15.031,3.727-20.11,9.126c-0.004,0.005-0.01,0.007-0.013,0.013  c0,0,0,0.001-0.001,0.002C2.996,14.357,0,21.333,0,29c0,7.369,2.768,14.101,7.312,19.222c0.006,0.009,0.006,0.019,0.013,0.028  c0.018,0.025,0.044,0.037,0.063,0.06c5.106,5.708,12.432,9.385,20.608,9.665l0.001,0.001l0.563,0.015C28.707,57.995,28.853,58,29,58  s0.293-0.005,0.439-0.01l0.563-0.015l0.001-0.001c8.185-0.281,15.519-3.965,20.625-9.685c0.013-0.017,0.034-0.022,0.046-0.04  C50.682,48.241,50.682,48.231,50.688,48.222z M2.025,30h12.003c0.113,4.239,0.941,8.358,2.415,12.217  c-2.844,1.029-5.563,2.409-8.111,4.131C4.585,41.891,2.253,36.21,2.025,30z M8.878,11.023c2.488,1.618,5.137,2.914,7.9,3.882  C15.086,19.012,14.15,23.44,14.028,28H2.025C2.264,21.493,4.812,15.568,8.878,11.023z M55.975,28H43.972  c-0.122-4.56-1.058-8.988-2.75-13.095c2.763-0.968,5.412-2.264,7.9-3.882C53.188,15.568,55.736,21.493,55.975,28z M28,14.963  c-2.891-0.082-5.729-0.513-8.471-1.283C21.556,9.522,24.418,5.769,28,2.644V14.963z M28,16.963V28H16.028  c0.123-4.348,1.035-8.565,2.666-12.475C21.7,16.396,24.821,16.878,28,16.963z M30,16.963c3.179-0.085,6.3-0.566,9.307-1.438  c1.631,3.91,2.543,8.127,2.666,12.475H30V16.963z M30,14.963V2.644c3.582,3.125,6.444,6.878,8.471,11.036  C35.729,14.45,32.891,14.881,30,14.963z M40.409,13.072c-1.921-4.025-4.587-7.692-7.888-10.835  c5.856,0.766,11.125,3.414,15.183,7.318C45.4,11.017,42.956,12.193,40.409,13.072z M17.591,13.072  c-2.547-0.879-4.991-2.055-7.294-3.517c4.057-3.904,9.327-6.552,15.183-7.318C22.178,5.38,19.512,9.047,17.591,13.072z M16.028,30  H28v10.038c-3.307,0.088-6.547,0.604-9.661,1.541C16.932,37.924,16.141,34.019,16.028,30z M28,42.038v13.318  c-3.834-3.345-6.84-7.409-8.884-11.917C21.983,42.594,24.961,42.124,28,42.038z M30,55.356V42.038  c3.039,0.085,6.017,0.556,8.884,1.4C36.84,47.947,33.834,52.011,30,55.356z M30,40.038V30h11.972  c-0.113,4.019-0.904,7.924-2.312,11.58C36.547,40.642,33.307,40.126,30,40.038z M43.972,30h12.003  c-0.228,6.21-2.559,11.891-6.307,16.348c-2.548-1.722-5.267-3.102-8.111-4.131C43.032,38.358,43.859,34.239,43.972,30z   M9.691,47.846c2.366-1.572,4.885-2.836,7.517-3.781c1.945,4.36,4.737,8.333,8.271,11.698C19.328,54.958,13.823,52.078,9.691,47.846  z M32.521,55.763c3.534-3.364,6.326-7.337,8.271-11.698c2.632,0.945,5.15,2.209,7.517,3.781  C44.177,52.078,38.672,54.958,32.521,55.763z"/>
            </svg>www.trumen.in</span>
        </div>
        <div class="display Quotation-address-1" style="padding-right: 7.5rem;">
        <p class="display" style="gap: 0.8rem;" > <svg width="1rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 23.7279L5.63604 17.364C2.12132 13.8492 2.12132 8.15076 5.63604 4.63604C9.15076 1.12132 14.8492 1.12132 18.364 4.63604C21.8787 8.15076 21.8787 13.8492 18.364 17.364L12 23.7279ZM16.9497 15.9497C19.6834 13.2161 19.6834 8.78392 16.9497 6.05025C14.2161 3.31658 9.78392 3.31658 7.05025 6.05025C4.31658 8.78392 4.31658 13.2161 7.05025 15.9497L12 20.8995L16.9497 15.9497ZM12 13C10.8954 13 10 12.1046 10 11C10 9.89543 10.8954 9 12 9C13.1046 9 14 9.89543 14 11C14 12.1046 13.1046 13 12 13Z"></path></svg>39, Mangal Nagar, Behind Sai Ram Plaza, AB Road, Indore, M.P. </p>
        </div>

        </div>
        <div class="display Quotation-address-1">
       
        </div>
       </div>
      
        <div class="display" style="margin-top: 2rem; font-weight: 550;">
            <p>TERMS & CONDITIONS</p>
            {{--<p>Pages {{$page_no + 2}} of {{$page_no + 2}}</p>--}}
        </div>
         @if(!empty($quotation->terms))
        <div style="margin:3rem ; line-height: 2rem;">
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">1. Prices</p>
            <div>
            <p>{{!empty($quotation->terms)?$quotation->terms->price:''}}</p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">2. P&f</p>
            @if($quotation->terms)
            <div>
            <p> GST @ {{!empty($quotation->terms)?$quotation->terms->p_f:''}}</p>
            </div>
            @else
            <div>
            <p> {{!empty($quotation->terms)?$quotation->terms->p_f_next:''}}</p>
            </div>
            @endif
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem;border-top: 3px solid #f1eeee; border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">3. Taxes</p>
            <div>
            <p>{{!empty($quotation->terms)?$quotation->terms->taxes:''}}</p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem;"></div>
          
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">4. Freight</p>
            <div>
            <p>{{!empty($quotation->terms)?$quotation->terms->freight:''}}</p>
            </div>
            </div>
           
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">5. Transit insurance</p>
            <div>
            <p>{{!empty($quotation->terms)?$quotation->terms->insurance:''}}.</p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">6. Delivery</p>
            <div>
            <p> Within {{!empty($quotation->terms)?$quotation->terms->delivery:''}} weeks after confirmed order.</p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem;border-top: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">7. Payment</p>
            <div>
            @if(!empty($quotation->terms))    
            <p>{{$quotation->terms->payment == '100%'?'100% Against proforma invoice prior to dispatch.':$quotation->terms->payment}}</p>
            @endif
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee; height: 33px;">8. Warranty</p>
            <div>
            <p>{{!empty($quotation->terms)?$quotation->terms->warranty:''}} months from the date of commissioning or fifteen months from the date of supply
                which ever is earlier.</p>
                </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">9. Validity of offer</p>
            <p>{{!empty($quotation->terms)?$quotation->terms->validity_offer:''}} Days</p>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">10. Release of po</p>
            <p>Formal order mentioning your delivery address and dispatch instructions</p>
            </div>
            <div class="display" style="display: grid; grid-template-columns:1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee; border-bottom: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">11. Cancellation charges</p>
            <p style="">{{!empty($quotation->terms)?$quotation->terms->cancellation_charges:''}}% Of PO amount to be paid if cancelled after order acceptance.</p>
            </div>
            <p style="margin-top: 3rem;" class="ftr">Trust Our Offer Is In Line With Your Requirement. Please Feel Free To Contact Us For Further Assistance. We Look Forward To Your
                Valued Order</p>
            <p style="margin-top: 2rem;" class="ftr">Thanks And Warm Regards.</p>
            <p style="margin-top: 0.2rem; margin-bottom: 0.2rem; font-weight: 550;" class="ftr">{{!empty($quotation->createdBy)?$quotation->createdBy->name:''}}</p>
            <div style="margin-bottom: 9rem;">
            <p class="ftr">Trumen Technologies Pvt. Ltd.</p>
            <p class="ftr">39, Mangal Nagar, Behind Sai Ram Plaza
                Near Rajiv Gandhi Circle, AB Road</p>
                <p class="ftr">Tel: 0731-4972065, {{!empty($quotation->createdBy)?$quotation->createdBy->contact:''}}</p>
                <p class="ftr">Email: {{!empty($quotation->createdBy)?$quotation->createdBy->email:''}}, Web: www.trumen.in</p>
                </div>
        </div>
        @else
        <div style="margin:3rem ; line-height: 2rem;">
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">1. Prices</p>
            <div>
            <p>{{!empty($quotationTR)?$quotationTR->price:''}}</p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">2. P&f</p>
            @if($quotationTR)
            <div>
            <p> GST @ {{!empty($quotationTR)?$quotationTR->p_f:''}}</p>
            </div>
            @else
            <div>
            <p> {{!empty($quotationTR)?$quotationTR->p_f_next:''}}</p>
            </div>
            @endif
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem;border-top: 3px solid #f1eeee; border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">3. Taxes</p>
            <div>
            <p>{{!empty($quotationTR)?$quotationTR->taxes:''}}</p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem;"></div>
          
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">4. Freight</p>
            <div>
            <p>{{!empty($quotationTR)?$quotationTR->freight:''}}</p>
            </div>
            </div>
           
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">5. Transit insurance</p>
            <div>
            <p>{{!empty($quotationTR)?$quotationTR->insurance:''}}.</p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">6. Delivery</p>
            <div>
            <p> {{!empty($quotationTR)?$quotationTR->delivery:''}} weeks after confirmed order.</p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem;border-top: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">7. Payment</p>
            <div>
            @if(!empty($quotationTR))    
            <p>{{$quotationTR->payment == '100%'?'100% Against proforma invoice prior to dispatch.':$quotation->terms->payment}}</p>
            @endif
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee; height: 33px;">8. Warranty</p>
            <div>
            <p>{{!empty($quotationTR)?$quotationTR->warranty:''}} months from the date of commissioning or fifteen months from the date of supply
                which ever is earlier.</p>
                </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">9. Validity of offer</p>
            <p>{{!empty($quotationTR)?$quotationTR->validity_offer:''}} Days</p>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">10. Release of po</p>
            <p>Formal order mentioning your delivery address and dispatch instructions</p>
            </div>
            <div class="display" style="display: grid; grid-template-columns:1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee; border-bottom: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">11. Cancellation charges</p>
            <p style="">{{!empty($quotationTR)?$quotationTR->cancellation_charges:''}}% Of PO amount to be paid if cancelled after order acceptance.</p>
            </div>
            <p style="margin-top: 3rem;" class="ftr">Trust Our Offer Is In Line With Your Requirement. Please Feel Free To Contact Us For Further Assistance. We Look Forward To Your
                Valued Order</p>
            <p style="margin-top: 2rem;" class="ftr">Thanks And Warm Regards.</p>
            <p style="margin-top: 0.2rem; margin-bottom: 0.2rem; font-weight: 550;" class="ftr">{{!empty($quotation->createdBy)?$quotation->createdBy->name:''}}</p>
            <div style="margin-bottom: 9rem;">
            <p class="ftr">Trumen Technologies Pvt. Ltd.</p>
            <p class="ftr">39, Mangal Nagar, Behind Sai Ram Plaza
                Near Rajiv Gandhi Circle, AB Road</p>
                <p class="ftr">Tel: 0731-4972065, {{!empty($quotation->createdBy)?$quotation->createdBy->contact:''}}</p>
                <p class="ftr">Email: {{!empty($quotation->createdBy)?$quotation->createdBy->email:''}}, Web: www.trumen.in</p>
                </div>
        </div>
        @endif
        
       <div class="Quotation-footers footer1">
          <p style="line-height: 1.4;width: 184px;">TTPL/{{$year}}{{$yearNext->format('y')}}/{{$quotation->id}} {{\Carbon\Carbon::parse($quotation->quotation_date)->format('d.m.Y')}}</p>
          <div class="footer2">
          <p>Technologies provides maximum possible customization on all of its products</p>
       </div>

       
       </div>

   </div> 

<!--Page 3 of 4 End-->

<!--Page 4 of 4 Start-->


    
 
  
        </div>

<!--Page 4 of 4 End-->
        </div>
    <!--</div>-->
    <div class="content" id="content2" style="display: none;">  
    <div class="row">
        <div class="col-12">
            <div class="card">
               <div class="card-body table-border-style">
                 
                     @if(isset($quotation_r))
                    
                    <div class="table-responsive">
                        <table class="table datatable ">
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
                                         $total = 0;
                                        
                                        @endphp    
                                @foreach ($quotation_r as $key => $quotation)
                                    <tr>
                                       
                                        <td style="padding:0px;">
                                            <div class="number-color" style="font-size:12px;background-color:#28941F; width:56px;height:61px;">
                                                   R{{ $key+1 }}</div> 
                                           </td>
                                        <td class="Id">
                                            <a href="{{ route('quotation.show', \Crypt::encrypt($quotation->id)) }}"
                                                >TTPL/{{$year}}{{$yearNext->format('y')}}/{{$quotation->is_revised}}</a>
                                        </td>
                                        
                                        @if(count($quotation->items)>0)
                                       
                                        <td>
                                              @foreach($iteams as $item)
                                        @php
                                         
                                         $quoteProduct = \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->first();
                                         $products = \App\Models\ProductService::find($item->product_id);
                                         $gtotal += $item->price * (!empty($quoteProduct)?$quoteProduct->quantity:1);
                                        @endphp
                                                  {{$products->name}} 
                                                   @if (!$loop->last)
                                                        ,
                                                    @endif
                                                     @endforeach
                                                  </td>
                                        @if(isset($quoteProduct->tax))
                                        @php 
                                        $taxProduct = \App\Models\Tax::find($quoteProduct->tax);
                                        @endphp
                                        <td>{{!empty($taxProduct)?$gtotal:$gtotal }}</td>
                                        @else
                                        <td> {{$gtotal}}</td>
                                        @endif
                                      
                                        @else
                                         @php
                                        
                                         $quoteProduct = \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->first();
                                         
                                        
                                         
                                        @endphp
                                        <td>-</td>
                                        <td>0.00</td>
                                        @endif
                                        <td>{{ Auth::user()->dateFormat($quotation->quotation_date) }}</td>
                                        <td> {{ $quotation->created_by ? \App\Models\User::find($quotation->created_by)->name : '' }} </td>
                                       
                                         <td>{{ $quotation->status ==0?'Waiting for Approval':'Approved' }}</td>
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
                                                                data-original-title="{{ __('Convert to JobCard') }}">
                                                                <i class="ti ti-pencil text-dark"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                     <div class="action-btn bg-light ms-2">
                                                                <a href="{{route('quotation.show', \Crypt::encrypt($quotation->id))}}" class="mx-3 d-inline-flex align-items-center"  data-size="xl" data-bs-toggle="tooltip" title="{{__('View')}}" data-title="{{__('Quotation Detail')}}">
                                                                    <i class="ti ti-eye text-dark"></i>
                                                                </a>
                                                            </div>
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
                                @endforeach
                            </tbody>
                        </table>
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
    </div>
    </div>
     <div  id="content5" class="card content" style="display:none;">  
                   
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h5>{{__('Call Notes')}}</h5>
                                            {{--<div class="float-end">
                                                <a data-size="lg" data-url="{{ route('leads.discussions.create',$lead->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Add Message')}}" class="btn btn-sm btn-primary">
                                                    <i class="ti ti-plus text-white"></i>
                                                </a>
                                            </div>--}}
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush mt-2" id="note-lists">
                                            @if(!$lead->discussions->isEmpty())
                                                @foreach($lead->discussions as $discussion)
                                                    <li class="list-group-item px-0">
                                                        <div class="d-block d-sm-flex align-items-start">
                                                            <img src="@if($discussion->user->avatar) {{asset('/storage/uploads/avatar/'.$discussion->user->avatar)}} @else {{asset('/storage/uploads/avatar/avatar.png')}} @endif"
                                                                 class="img-fluid wid-40 me-3 mb-2 mb-sm-0" alt="image">
                                                            <div class="w-100">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <div class="mb-3 mb-sm-0">
                                                                        <h6 class="mb-0"> {{$discussion->comment}}</h6>
                                                                        <span class="text-muted text-sm">{{$discussion->user->name}}</span>
                                                                    </div>
                                                                    <div class="form-check form-switch form-switch-right mb-2">
                                                                        {{$discussion->created_at->diffForHumans()}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="text-center">
                                                    {{__(' No Data Available.!')}}
                                                </li>
                                            @endif
                                        </ul>
                                      

                                        <div class="row">
                                            <div class="col-12 form-group">
                                                {{ Form::label('comment', __('Message'),['class'=>'form-label']) }}
                                                {{ Form::textarea('comment', null, array('class' => 'form-control', 'id'=>'disc-note')) }}
                                                 {{ Form::hidden('id', $lead->id, array('class' => 'form-control', 'id'=>'lead_id')) }}
                                            </div>
                                           
                                        </div> 
                                           
                                        
                                    </div>
                                    
                                    <div class="row" style="padding: 10px;">
                                         <div class="col-3 form-group">
                                               <select class="form-control" name="status" id="qstatus">
                                                <option>Change Status</option>
                                                <option value="0">Draft</option>
                                                <option value="1">Waiting for approval</option>
                                                <option value="2">Approved</option>
                                                <option value="3">Sent</option>
                                            </select>
                                           </div>
                                            <div class="col-12 form-group">
                                                <div class="modal-footer">
                                                    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
                                                    <input type="submit" value="{{__('Add')}}" class="btn  btn-primary" id="add-notes">
                                                </div>
                                            </div>    
                                        </div>        
                                   

                                    </div>
                                </div>
                            </div>
                           
                        </div>
    @php
    $quoteActivity = \App\Models\LeadActivityLog::where('lead_id', $quotation->lead_id)->get();
   
    @endphp
     <div id="content6" class="content" style="display:none;">
                    <div id="activity" class="card">
                        <div class="card-header">
                            <h5>{{__('Activity')}}</h5>
                        </div>
                        <div class="card-body ">

                            <div class="row leads-scroll" >
                                <ul class="event-cards list-group list-group-flush mt-3 w-100">
                                    @if(count($quoteActivity)>0)
                                        @foreach($quoteActivity as $activity)
                                            <li class="list-group-item card mb-3">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-auto mb-3 mb-sm-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar">
                                                               <img src="{{asset('/storage/uploads/avatar/avatar.png')}}"
                                                                 class="img-fluid wid-40 me-3 mb-2 mb-sm-0" alt="image">
                                                            </div>
                                                            <div class="ms-3">
                                                                <span class="text-dark text-sm">{{ __($activity->log_type) }}</span>
                                                                <h6 class="m-0">{!! $activity->getLeadRemark() !!}</h6>
                                                                <small class="text-muted">{{$activity->created_at->diffForHumans()}}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">

                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @else
                                        No activity found yet.
                                    @endif
                                </ul>
                            </div>

                        </div>
                    </div>
                    </div>    
    <div class="content" id="content3" style="display: none;">  
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                 @if(count($quotation_o)>0)
                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                            <h4>{{__('Order')}}</h4>
                        </div>
                       
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                            <h4 class="invoice-number">{{ $quotation->is_revised != null?Auth::user()->quotationNumberFormat($quotation->quotation_id):Auth::user()->quotationNumberFormat($quotation->quotation_id) }}</h4>
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
                             @foreach($quotation_o as $key =>$order)
                                    @php
                                    $qt =  \App\Models\Quotation::with('items')->find($order->id);
                                    @endphp
                            @foreach($qt->items as $key =>$iteam)
                             <div id="{{ $iteam->product()->id }}" class="product_barcode product_barcode_hight_de" data-skucode="{{ $iteam->product()->sku }}"></div>
                             @endforeach
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
                                    @foreach($quotation_o as $key =>$order)
                                    @php
                                    $qt =  \App\Models\Quotation::with('items')->find($order->id);
                                    @endphp
                                    
                                    @foreach($qt->items as $key =>$iteam)
                                      
                                            @php
                                               
                                                $totalQuantity+=$iteam->quantity;
                                                $totalRate+=$iteam->price;
                                                $totalDiscount+=$iteam->discount;
                                           @endphp
                                               
                                           
                                      
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{!empty($iteam->product())?$iteam->product()->name:''}}</td>
                                            <td>{{$iteam->quantity}}</td>
                                            <td>{{\Auth::user()->priceFormat($iteam->price)}}</td>
                                            <td>
                                               
                                            </td>
                                            <td>{{\Auth::user()->priceFormat($totalTaxPrice)}}</td>
                                            <td >{{\Auth::user()->priceFormat(($iteam->price*$iteam->quantity) + $totalTaxPrice)}}</td>
                                        </tr>
                                        @php
                                                $subTotal +=  (($iteam->price*$iteam->quantity) + $totalTaxPrice);
                                                $total = $subTotal - $totalDiscount;
                                    @endphp
                                    @endforeach

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
                            <h4>{{__('Order')}}</h4>
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
        </div>
    </div></div>
     <div class="content" id="content4" style="display: none;">  
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                     @if(count($quotation_job)>0)
                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                            <h4>{{__('JobCard')}}</h4>
                        </div>
                       
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                            <h4 class="invoice-number">{{ $quotation->is_revised != null?Auth::user()->quotationNumberFormat($quotation->quotation_id):Auth::user()->quotationNumberFormat($quotation->quotation_id) }}</h4>
                        </div>
                       
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
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
                        <div class="col-3">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="me-4">
                                    <small>
                                        <strong>{{__('Issue Date')}} :</strong>
                                        {{\Auth::user()->dateFormat($quotation->quotation_date)}}<br><br>
                                    </small>
                                </div>
                            </div>
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
                                     @foreach($quotation_job as $key =>$job)
                                    @php
                                    $jb =  \App\Models\Quotation::with('items')->find($job->id);
                                    @endphp
                                    @foreach($jb->items as $key =>$iteam)
                                       
                                            @php
                                                $taxes=App\Models\Utility::tax($iteam->tax);
                                                $totalQuantity+=$iteam->quantity;
                                                $totalRate+=$iteam->price;
                                                $totalDiscount+=$iteam->discount;

                                               
                                                       $taxDataPrice;
                                                    
                                                
                                            @endphp
                                      
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{!empty($iteam->product())?$iteam->product()->name:''}}</td>
                                            <td>{{$iteam->quantity}}</td>
                                            <td>{{\Auth::user()->priceFormat($iteam->price)}}</td>
                                            <td>
                                              
                                                    <table>
                                                        @php
                                                            $totalTaxRate = 0;
                                                            $totalTaxPrice = 0;
                                                        @endphp
                                                      
                                                    </table>
                                               
                                            </td>
                                            <td>{{\Auth::user()->priceFormat($totalTaxPrice)}}</td>
                                            <td >{{\Auth::user()->priceFormat(($iteam->price*$iteam->quantity) + $totalTaxPrice)}}</td>
                                        </tr>
                                        @php
                                                $subTotal +=  (($iteam->price*$iteam->quantity) + $totalTaxPrice);
                                                $total = $subTotal - $totalDiscount;
                                    @endphp
                                    @endforeach
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
        </div>
    </div></div>
  
@endsection
@push('script-page')
   <script>
   
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
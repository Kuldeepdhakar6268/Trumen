@extends('layouts.admin')
@section('page-title')
    {{$lead->name}}
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/dropzone.min.css')}}">
    <style>
    .tab-active{
        background-color:#dfe5ea;
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
        .choose-files div {
            background: #ffffff !important;
        }
    </style>
@endpush
@push('script-page')
    <script src="{{asset('css/summernote/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/js/plugins/dropzone-amd-module.min.js')}}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
      <script>
      function readURL(input, imgno) {

  let file = input.files[0];

  // file validation code not shown

  var reader = new FileReader();

  reader.onload = function(e) {

    let src = file.type.startsWith("image") ? e.target.result : defaultImage;
    let size = (file.size / 1024).toFixed(0);
    let date = new Date(file.lastModified).toLocaleDateString();
    $("#blah").text(file.name)
    $("#img_new").attr('src', src);
    $("#blah_holder").append(`
    <div class="col-3" style="padding-right: 40px;">
     <img src="${src}" class="thumb-image" style="
  height: 50px;
  width: auto;
  border: 1px solid lightgray;"
>
</div>
    `);

  }
  reader.readAsDataURL(file);
}



let defaultImage = "https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/833px-PDF_file_icon.svg.png";


$('input[type="file"]').change(function(e) {
  readURL(this, 1);
});
        // $('input[type="file"]').change(function(e) {
        //     var file = e.target.files[0].name;
        //     var file_name = $(this).attr('data-filename');
        //     $('.' + file_name).append(file);
        // });
    </script>
    <script>
     $(document).ready(function(){
     
     $('.tab').click(function(){
            
            // Hide all content divs
            $('.content').hide();
            $('.tab').removeClass('btn btn-primary');
            $('.tab').addClass('tab-active');
            $('.tab').css('color', '#000000');
            // Get the target id from data attribute
            $(this).addClass('btn btn-primary');
            $(this).removeClass('tab-active');
            $(this).css('color', '#ffffff');
            var targetId = $(this).data('target');
            
            // Show the corresponding content div
            $('#' + targetId).show();
        });
       
      $(document).on('click', '.selectcustomer', function () {
         
          $id = $(this).val();
          $("#customer_id").val($id);
          
      });
      $(document).on('click', '#add-notes', function () {
            var notes = $("#disc-note").val();
            var id = $('#lead_id').val();
            var stage_id = $('#choices-multiple1').val();
            if(stage_id == ''){
              return show_toastr('error', 'Please select status', 'error');  
            }
            var url = '{{ route('leads.discussion.store', $lead->id) }}'
           $.ajax({
                type: 'POST',
                url: url,
                data: {
                   
                    'id': id,
                    'comment':notes,
                    'stage_id': stage_id,
                    'check': '',
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
        // Add click event listener to tabs
        // $('.tab').click(function(){
            
        //     // Hide all content divs
        //     $('.content').hide();
        //     $('.tab').removeClass('active');
        //     // Get the target id from data attribute
        //     $(this).addClass('active');
        //     var targetId = $(this).data('target');
            
        //     // Show the corresponding content div
        //     $('#' + targetId).show();
        // });
    });
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#lead-sidenav',
            offset: 300
        })
        Dropzone.autoDiscover = false;
        Dropzone.autoDiscover = false;
        myDropzone = new Dropzone("#dropzonewidget", {
            maxFiles: 20,
            // maxFilesize: 2000,
            parallelUploads: 1,
            filename: false,
            // acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.txt",
            url: "{{route('leads.file.upload',$lead->id)}}",
            success: function (file, response) {
                if (response.is_success) {
                    if(response.status==1){
                        show_toastr('success', response.success_msg, 'success');
                    }
                    dropzoneBtn(file, response);
                } else {
                    myDropzone.removeFile(file);
                    show_toastr('error', response.error, 'error');
                }
            },
            error: function (file, response) {
                myDropzone.removeFile(file);
                if (response.error) {
                    show_toastr('error', response.error, 'error');
                } else {
                    show_toastr('error', response, 'error');
                }
            }
        });
        myDropzone.on("sending", function (file, xhr, formData) {
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("lead_id", {{$lead->id}});
        });

        function dropzoneBtn(file, response) {
            var download = document.createElement('a');
            download.setAttribute('href', response.download);
            download.setAttribute('class', "badge bg-info mx-1");
            download.setAttribute('data-toggle', "tooltip");
            download.setAttribute('data-original-title', "{{__('Download')}}");
            download.innerHTML = "<i class='ti ti-download'></i>";

            var del = document.createElement('a');
            del.setAttribute('href', response.delete);
            del.setAttribute('class', "badge bg-danger mx-1");
            del.setAttribute('data-toggle', "tooltip");
            del.setAttribute('data-original-title', "{{__('Delete')}}");
            del.innerHTML = "<i class='ti ti-trash'></i>";

            del.addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();
                if (confirm("Are you sure ?")) {
                    var btn = $(this);
                    $.ajax({
                        url: btn.attr('href'),
                        data: {_token: $('meta[name="csrf-token"]').attr('content')},
                        type: 'DELETE',
                        success: function (response) {
                            if (response.is_success) {
                                btn.closest('.dz-image-preview').remove();
                            } else {
                                show_toastr('error', response.error, 'error');
                            }
                        },
                        error: function (response) {
                            response = response.responseJSON;
                            if (response.is_success) {
                                show_toastr('error', response.error, 'error');
                            } else {
                                show_toastr('error', response, 'error');
                            }
                        }
                    })
                }
            });

            var html = document.createElement('div');
            html.appendChild(download);
            @if(Auth::user()->type != 'client')
            @can('edit lead')
            html.appendChild(del);
            @endcan
            @endif

            file.previewTemplate.appendChild(html);
        }

        @foreach($lead->files as $file)
        @if (file_exists(storage_path('lead_files/'.$file->file_path)))
        // Create the mock file:
        var mockFile = {name: "{{$file->file_name}}", size: {{\File::size(storage_path('lead_files/'.$file->file_path))}}};
        // Call the default addedfile event handler
        myDropzone.emit("addedfile", mockFile);
        // And optionally show the thumbnail of the file:
        myDropzone.emit("thumbnail", mockFile, "{{asset(Storage::url('lead_files/'.$file->file_path))}}");
        myDropzone.emit("complete", mockFile);

        dropzoneBtn(mockFile, {download: "{{route('leads.file.download',[$lead->id,$file->id])}}", delete: "{{route('leads.file.delete',[$lead->id,$file->id])}}"});
        @endif
        @endforeach

        @can('edit lead')
        $('.summernote-simple').on('summernote.blur', function () {

            $.ajax({
                url: "{{route('leads.note.store',$lead->id)}}",
                data: {_token: $('meta[name="csrf-token"]').attr('content'), notes: $(this).val()},
                type: 'POST',
                success: function (response) {
                    if (response.is_success) {
                        // show_toastr('Success', response.success,'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function (response) {
                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response, 'error');
                    }
                }
            })
        });
        @else
        $('.summernote-simple').summernote('disable');
        @endcan
    
    </script>

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('quotation.index')}}">{{__('Quotation')}}</a></li>
    <li class="breadcrumb-item"> {{$lead->name}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        @can('convert lead to deal')
            @if(!empty($deal))
                <a href="@can('View Deal') @if($deal->is_active) {{route('deals.show',$deal->id)}} @else # @endif @else # @endcan" data-size="lg" data-bs-toggle="tooltip" class="btn btn-sm btn-primary">
                   {{__('Already Converted To Customer')}}
                </a>
            @else
           @php
           $client_email = $lead->email != null?$lead->email:'demo@gmail.com';
          
           @endphp
                                                    {{ Form::model($lead, array('route' => array('quotation.convert.to.deal', $lead->id), 'method' => 'POST','enctype' => 'multipart/form-data')) }}
                                                   
                                                    {{ Form::hidden('client_email', $client_email, array('class' => 'form-control','required'=>'required')) }}
                                                    {{ Form::hidden('name', $lead->subject, array('class' => 'form-control','required'=>'required')) }}
                                                    
                                                    
                                                     <input type="hidden" name="customer_id" id="customer_id">
                                                    <a href="#" class="btn btn-primary  align-items-center bs-pass-para" data-bs-toggle="tooltip"
                                                       data-original-title="{{__('Convert')}}" data-confirm="{{__('Are You Sure You Want to Convert To Customer?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$lead->id}}').submit();">
                                                        {{__('Save')}}
                                                   
                                               
               {{-- <a href="#" data-size="lg" data-url="{{ URL::to('leads/'.$lead->id.'/show_convert') }}" data-ajax-popup="true" data-bs-toggle="tooltip" class="btn btn-sm btn-primary">
                   {{__('Convert To Customer')}}
                </a> --}}
            @endif
        @endcan

       <a href="#" data-url="{{ URL::to('leads/'.$lead->id.'/labels') }}" data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip" title="{{__('Label')}}" class="btn btn-sm btn-primary" style="display: none;">
            <i class="ti ti-bookmark"></i>
        </a>
       {{-- <a href="#" data-size="xl" data-url="{{ route('leads.edit',$lead->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Edit')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-pencil"></i>
        </a>--}}
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
           
            <div class="row">
            <div class="content" id="content1" style="display:block">
                    <div class="">
                       {{-- <div class="card-header ">
                            <h5>{{__('Profile')}}</h5>
                        </div>--}}
                       
                     
                          @if(count($customers)>0)
                                @foreach($customers as $key => $v)
                               
                        <div class="card" style="{{$key == 0?'border: 2px solid #ff5000;':''}}">
                        <div class="card-body">
                            
                             <div class="row" style="line-height: 2;">
                                 
                                 <div class="col-md-6 col-sm-6">
                                    <div class="d-flex align-items-start">
                                         <div class="ms-2">
                                           <h5>{{__('Contact Person Info')}} ({{$key}})</h5>
                                        </div>
                                   
                                </div>
                               </div>
                               <div class="col-md-6 col-sm-6">
                                    <div class="d-flex" style="float: inline-end;">
                                         <div class="ms-2">
                                          <input type="checkbox" value="{{$v->id}}" class="selectcustomer">
                                        </div>
                                   
                                </div>
                               </div>
                               
                                <div class="col-md-4 col-sm-4">
                                    <div class="d-flex align-items-start">
                                         <div class="ms-2">
                                              {{ Form::hidden('client_name',!empty($v->name)?$v->name:'', array('class' => 'form-control','required'=>'required')) }}
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
                            
                        </div>
                        </div>
                         @if (!$loop->last)
                                   <br>
                                @endif
                                @endforeach
                               @endif
                        </div>
                        
                       
                               
                    
                       
                            
                        
                       
                    </div>
                    <div  id="content2" class="card content" style="display:none;margin-top: 30px;">  
                   
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
                                               {{ Form::select('stage_id', $stages,null, array('class' => 'form-control select2','id'=>'choices-multiple1')) }}
                                           </div>
                                            <div class="col-9 form-group">
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
                     
                    </div>
             <div class="row">
            <div class="content" id="content1" style="display:block"> 
                    <div class="">
                        <div class="card" style="{{$key == 0?'border: 2px solid #ff5000;':''}}">
                        <div class="card-body">
                            
                             <div class="row" style="line-height: 2;">
                                 
                                 <div class="col-md-12 col-sm-12">
                                    <div class="d-flex align-items-start">
                                         <div class="ms-2">
                                           <h5>{{__('Customer PO Details')}}</h5>
                                        </div>
                                   
                                </div>
                               </div>
                             
                                <div class="col-md-3 col-sm-3">
                                   
                                            <div class="form-group">
                                                {{Form::label('po_date',__('PO Date'),['class'=>'form-label'])}}
                                                {{Form::date('po_date',null,array('class'=>'form-control datepicker','placeholder'=>_('Enter Name')))}}
                                            </div>
                                        
                               </div>
                                <div class="col-md-3 col-sm-3">
                                  
                                         <div class="form-group">
                                                {{Form::label('po_number',__('PO Number'),['class'=>'form-label'])}}
                                                {{Form::text('po_number',null,array('class'=>'form-control','required'=>'required' ,'placeholder'=>_('Enter PO Number')))}}
                                            </div>
                                       
                               </div>
                                 <div class="col-md-6 col-sm-6">
                                  
                                         <div class="card-body employee-detail-create-body">
                           
                                <div class="row">
                                    <div class="form-group col-12 d-flex">
                                        <div class="float-left col-4">
                                            <label for="document"
                                                class="float-left pt-1 form-label">Upload PO File
                                            </label>
                                        </div>
                                        <div class="float-right col-8">
                                            <input type="hidden" name="emp_doc_id" id=""
                                                value="">
                                            <div class="choose-files">
                                                <label for="document">
                                                    <div class=" bg-primary document "> <i
                                                            class="ti ti-upload "></i>{{ __('Choose file here') }}
                                                    </div>
                                                    <input type="file"
                                                        class="form-control file"
                                                       
                                                        name="document[]" id="document"
                                                        data-filename="_filename" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                </label>
                                                <span id="blah"></span>
                                             
                                              <div class="row"  id="blah_holder">
                                                 
                                                </div>
                                                
                                            </div>

                                        </div>

                                    </div>
                                </div>
                           
                        </div>
                                        
                               </div>
                            </div>
                            
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
  {!! Form::close() !!}
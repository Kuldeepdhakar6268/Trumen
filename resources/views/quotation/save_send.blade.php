{{ Form::open(array('url' => 'quotation.send','enctype' => "multipart/form-data")) }}
<div class="modal-body">
    {{-- start for ai module--}}
    @php
        $plan= \App\Models\Utility::getChatGPTSettings();
        
    @endphp
  
    {{-- end for ai module--}}
    @if($approvalCheck == 'check')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group text-center">
                <h5>You want send for approval?</h5>
               <div style="padding-top: 20px;">
                <a href="#" class="btn  btn-dark" data-bs-dismiss="modal">{{__('Cancel')}}</a>
                <div class="btn  btn-primary" id="show-users" style="padding: 9px 31px 9px 31px;">{{__('Yes')}}</div>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group" style="display:none;" id="userList">
               
                {{ Form::select('user_id', $users,null, array('class' => 'form-control select','required'=>'required', 'id' => 'userAssigned')) }}
            </div>
        </div>
    </div>
     
     
</div>
     
 @elseif($approvalCheck == 'jobcard')
      <div class="row">
        <div class="col-md-12">
            <div class="form-group text-center">
                <h5>You want send for approval?</h5>
               <div style="padding-top: 20px;">
                <a href="#" class="btn  btn-dark" data-bs-dismiss="modal">{{__('Cancel')}}</a>
                <div class="btn  btn-primary" id="show-users" style="padding: 9px 31px 9px 31px;">{{__('Yes')}}</div>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group" style="display:none;" id="userList">
               
                {{ Form::select('user_id', $users,null, array('class' => 'form-control select','required'=>'required', 'id' => 'userAssignedforJobcard')) }}
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-12">
            <div class="form-group text-center">
                <h5>Please Approved the Quotation befor order conversion</h5>
               
            </div>
        </div>
    </div>
    <div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
   
</div>
@endif

{{Form::close()}}


 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
   

    //hide & show quantity
  $(document).on('click', '#show-users', function() {
   
//   e.preventDefault();
   $("#userList").css('display', 'block');
  
});
   $(document).on('change', '#userAssigned', function() {
   
   var id  = $(this).val();
  
   $.ajax({
            url: '{{route('quotation.status', ['id' => $id, 'status' => 'userAssigned'])}}',
            type: 'Get',
            data: {
                
                "sid": id,
                "_token": "{{ csrf_token() }}",
            },

            success: function (data) {
                // $("#commonModal").hide();
                // $("#commonModal .close").click()
                $('#commonModal').modal('toggle'); 
                show_toastr('success', "{{__('Quotation has been Assigned to ')}}"+data.assigny +'!', 'success');
                return true;  
            }
            });
  
});
$(document).on('change', '#userAssignedforJobcard', function() {
   
   var id  = $(this).val();
  
   $.ajax({
            url: '{{route('quotation.status', ['id' => $id, 'status' => 'JobcardAssigned'])}}',
            type: 'Get',
            data: {
                
                "sid": id,
                "_token": "{{ csrf_token() }}",
            },

            success: function (data) {
                // $("#commonModal").hide();
                // $("#commonModal .close").click()
                $('#commonModal').modal('toggle'); 
                show_toastr('success', "{{__('Quotation has been Assigned to ')}}"+data.assigny +'!', 'success');
                return true;  
            }
            });
  
});
</script>


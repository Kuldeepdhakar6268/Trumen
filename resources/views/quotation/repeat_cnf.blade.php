
{{ Form::model($id, array('route' => array('quotation.repeat', $id), 'method' => 'get')) }}

<div class="modal-body">
    {{-- start for ai module--}}
    @php
        $plan= \App\Models\Utility::getChatGPTSettings();
        
    @endphp
  
    {{-- end for ai module--}}
   
    <div class="row">
        <div class="col-md-12">
            <div class="form-group text-center">
                <h5>Ary sure you want to create repeat this order?</h5>
           </div>
        </div>
    </div>     
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    {{Form::label('old_so',__('Old So. No.'),array('class'=>'form-label')) }}
                    {{Form::text('old_so_no',$srno,array('class'=>'form-control' ,'placeholder'=>__('Enter Old Referance')))}}
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    {{Form::label('delivery_date',__('Delivery Date '),['class'=>'form-label'])}}
                    {{Form::date('delivery_date',null,array('class'=>'form-control','required'=>'required' ,'placeholder' => __('Select Date')))}}
    
                </div>
            </div>
        </div>
               <div style="padding-top: 20px;">
                <input type="button" value="{{__('Cancel')}}" class="btn btn-dark" data-bs-dismiss="modal">
                 <input type="submit" value="{{__('Yes')}}" class="btn  btn-primary">
               
            </div>
</div>
     

{{Form::close()}}


 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
   

    //hide & show quantity
 
  
</script>


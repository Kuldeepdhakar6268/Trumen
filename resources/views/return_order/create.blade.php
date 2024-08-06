
@extends('layouts.admin')
@section('page-title')
    {{__('Purchase Create')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('purchase.index')}}">{{__('Purchase')}}</a></li>
    <li class="breadcrumb-item">{{__('Purchase Create')}}</li>
@endsection
@push('script-page')
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/jquery.repeater.min.js')}}"></script>
    <script>
        var selector = "body";
        if ($(selector + " .repeater").length) {
            
            var $dragAndDrop = $("body .repeater tbody").sortable({
                handle: '.sort-handler'
            });
            
           
            var $repeater = $(selector + ' .repeater').repeater({
                initEmpty: false,
                defaultValues: {
                    'status': 1
                },
                show: function () {
                    $(this).slideDown();
                    var file_uploads = $(this).find('input.multi');
                    if (file_uploads.length) {
                        $(this).find('input.multi').MultiFile({
                            max: 3,
                            accept: 'png|jpg|jpeg',
                            max_size: 2048
                        });
                    }
                    $('.select2').select2();
                   
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                        $(this).remove();

                        var inputs = $(".amount");
                       
                        var subTotal = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                        }
                        
                        $('.subTotal').html(subTotal.toFixed(2));
                        $('.totalAmount').html(subTotal.toFixed(2));
                    }
                },
                ready: function (setIndexes) {
                    $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
              
            });
             
            var value = $(selector + " .repeater").attr('data-value');
            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
            }

        }

        $(document).on('change', '#vender', function () {
            $('#vender_detail').removeClass('d-none');
            $('#vender_detail').addClass('d-block');
            $('#vender-box').removeClass('d-block');
            $('#vender-box').addClass('d-none');
            var id = $(this).val();
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': jQuery('#token').val()
                },
                data: {
                    'id': id
                },
                cache: false,
                success: function (data) {
                    if (data != '') {
                        $('#vender_detail').html(data);
                    } else {
                        $('#vender-box').removeClass('d-none');
                        $('#vender-box').addClass('d-block');
                        $('#vender_detail').removeClass('d-block');
                        $('#vender_detail').addClass('d-none');
                    }
                },
            });
        });

        $(document).on('click', '#remove', function () {
            $('#vender-box').removeClass('d-none');
            $('#vender-box').addClass('d-block');
            $('#vender_detail').removeClass('d-block');
            $('#vender_detail').addClass('d-none');
        })

        $(document).on('click', '.removeButton', function(e) {
          
        e.preventDefault();
        $(this).closest('.add_contact').remove();
        return true;
            });

        $(document).on('change', '.item', function () {
            var iteams_id = $(this).val();
            
            var url = $(this).data('url');
            var el = $(this);
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': jQuery('#token').val()
                },
                data: {
                    'product_id': iteams_id
                },
                cache: false,
                success: function (data) {
                    var item = JSON.parse(data);
                    console.log(item)
                    $("#return_purchase").empty();
                    $.each(item.itemData, function(index, option) {
                        $("#return_purchase").append('<tr><td class="sr_no">'+(index+1)+'</td><td width="25%" class="form-group pt-1"><input class="form-control purchase_product_id" placeholder="Product Name" name="items['+index+'][purchase_product_id]" type="hidden" value="'+option.item_id+'"><input class="form-control product_name" placeholder="Product Name" name="product_name" type="text" value="'+option.product_name+'"></td><td width="10%"><div class="form-group"><input class="form-control product_name" placeholder="Product Name" name="priority" type="text" value="'+option.priority+'"></div></td><td><div class="form-group price-input input-group search-form"><input class="form-control price" placeholder="Product Name" name="items['+index+'][price]" type="text" value="'+option.price+'"><span class="input-group-text bg-transparent">₹</span></div></td><td><div class="form-group price-input input-group search-form"><input class="form-control quantity" required="required" placeholder="Qty" name="items['+index+'][quantity]" type="text" value="'+option.quantity+'"><span class="unit input-group-text bg-transparent"></span></div></td><td><div class="form-group"><textarea class="form-control note" rows="1" placeholder="Description" name="items['+index+'][note]" cols="50">'+option.description+'</textarea></div></td><td class="text-end amount">'+(option.quantity * parseFloat(option.price))+'</td><td></td></tr>');
                        });
                    $("#purchase_date").val(item.purchase_date);
                    $(el.parent().parent().find('.subTotal')).html(item.total_amount);
                    $(el.parent().parent().find('.totalAmount')).html(item.total_amount);
                    $("#name").val(item.vendor.company_name);
                    $("#contact_person").val(item.vendor.name);
                    $("#email").val(item.vendor.email);
                    $("#sector").val(item.vendor.sector);
                    $("#industry").val(item.vendor.industry);
                    $("#tax_number").val(item.vendor.tax_number);
                    $("#contact").val(item.vendor.contact);
                    $("#alternate").val(item.vendor.alternate);
                    $("#plot_number").val(item.vendor.plot_number);
                    $("#land_mark").val(item.vendor.land_mark);
                    $("#street_name").val(item.vendor.street_name);
                    $("#area_name").val(item.vendor.billing_address);
                    $("#pincode").val(item.vendor.billing_zip);
                    $("#city").val(item.vendor.billing_city);
                    $("#state").val(item.vendor.billing_state);
                    $("#country").val(item.vendor.billing_country);
                    var details = 'Request by - '+item.created_by+' '+item.ondate
                    $("#createdBy").text(details)

                    var inputs = $(".amount");
                    var subTotal = 0;
                    for (var i = 0; i < inputs.length; i++) {
                        subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                    }
                    $('.subTotal').html(subTotal.toFixed(2));


                    // var totalItemPrice = 0;
                    // var priceInput = $('.price');
                    // for (var j = 0; j < priceInput.length; j++) {
                    //     totalItemPrice += parseFloat(priceInput[j].value);
                    // }

                    // var totalItemTaxPrice = 0;
                    // var itemTaxPriceInput = $('.itemTaxPrice');
                    // for (var j = 0; j < itemTaxPriceInput.length; j++) {
                    //     totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
                    // }

                    // $('.totalTax').html(totalItemTaxPrice.toFixed(2));
                    $('.totalAmount').html((parseFloat(subTotal).toFixed(2)));

                },
            });
        });
         $(document).on('change', '.part', function () {
            var iteams_id = $(this).val();
            var url = $(this).data('url');
            var el = $(this);
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': jQuery('#token').val()
                },
                data: {
                    'id': iteams_id
                },
                cache: false,
                success: function (data) {
                    var item = JSON.parse(data);
                    console.log(item)
                   
                    $(el.parent().parent().parent().parent().parent().parent().find('.u_price')).val(item.product.unit_price);
                      $(el.parent().parent().parent().parent().parent().parent().find('.net_price')).val(item.product.unit_price);
                     $(el.parent().parent().parent().parent().parent().parent().find('.qty')).val(1);

                },
            });
        });
         $(document).on('change', '.qty', function ()
    {
          
        var qty = $(this).val();
        var el = $(this);
        var Uprice =             $(el.parent().parent().parent().find('.u_price')).val();
        var Nprice =             $(el.parent().parent().parent().find('.net_price')).val();
        if(qty >0)
        {
        var total = Uprice *qty;  
         $(el.parent().parent().parent().find('.net_price')).val(total);
        }else{
           $(el.parent().parent().parent().find('.net_price')).val('0.00');  
        }
                    
    });
        $(document).on('keyup', '.quantity', function () {
            var quntityTotalTaxPrice = 0;

            var el = $(this).parent().parent().parent();
            var quantity = $(this).val();
            var price = $(el.find('.price')).val();
            // var discount = $(el.find('.discount')).val();
            // if(discount.length <= 0)
            // {
            //     discount = 0 ;
            // }
            // alert(price)
            var totalItemPrice = (quantity * price);
            var amount = (totalItemPrice);


            var amount = (totalItemPrice);


            // var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            // var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            // $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));

            $(el.find('.amount')).html(parseFloat(amount));

            // var totalItemTaxPrice = 0;
            // var itemTaxPriceInput = $('.itemTaxPrice');
            // for (var j = 0; j < itemTaxPriceInput.length; j++) {
            //     totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            // }


            var totalItemPrice = 0;
            var inputs_quantity = $(".quantity");

            var priceInput = $('.price');
            for (var j = 0; j < priceInput.length; j++) {
                totalItemPrice += (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value));
            }

            var inputs = $(".amount");

            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }

            $('.subTotal').html(totalItemPrice.toFixed(2));
            // $('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal)).toFixed(2));

        })

        $(document).on('keyup change', '.price', function () {
            var el = $(this).parent().parent().parent().parent();
            var price = $(this).val();
            var quantity = $(el.find('.quantity')).val();

            var discount = $(el.find('.discount')).val();
            if(discount.length <= 0)
            {
                discount = 0 ;
            }
            var totalItemPrice = (quantity * price)-discount;

            var amount = (totalItemPrice);


            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));

            $(el.find('.amount')).html(parseFloat(itemTaxPrice)+parseFloat(amount));

            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var totalItemPrice = 0;
            var inputs_quantity = $(".quantity");

            var priceInput = $('.price');
            for (var j = 0; j < priceInput.length; j++) {
                totalItemPrice += (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value));
            }

            var inputs = $(".amount");

            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }

            $('.subTotal').html(totalItemPrice.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal)).toFixed(2));


        })

        $(document).on('keyup change', '.discount', function () {
            var el = $(this).parent().parent().parent();
            var discount = $(this).val();
            if(discount.length <= 0)
            {
                discount = 0 ;
            }

            var price = $(el.find('.price')).val();
            var quantity = $(el.find('.quantity')).val();
            var totalItemPrice = (quantity * price) - discount;


            var amount = (totalItemPrice);


            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));

            $(el.find('.amount')).html(parseFloat(itemTaxPrice)+parseFloat(amount));

            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var totalItemPrice = 0;
            var inputs_quantity = $(".quantity");

            var priceInput = $('.price');
            for (var j = 0; j < priceInput.length; j++) {
                totalItemPrice += (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value));
            }

            var inputs = $(".amount");

            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }


            var totalItemDiscountPrice = 0;
            var itemDiscountPriceInput = $('.discount');

            for (var k = 0; k < itemDiscountPriceInput.length; k++) {

                totalItemDiscountPrice += parseFloat(itemDiscountPriceInput[k].value);
            }


            $('.subTotal').html(totalItemPrice.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal)).toFixed(2));
            $('.totalDiscount').html(totalItemDiscountPrice.toFixed(2));




        })

        

    </script>

    <script>
        $(document).on('click', '[data-repeater-delete]', function () {
            $(".price").change();
            // $(".discount").change();
        });
         $(document).on('click', '.repeat', function () {
         
          var $self = $(this);
          $self.after($self.parent().clone());
          $self.remove();
       });
       
    </script>
@endpush

@section('content')
<div class="d-flex justify-content-end  " style="margin-top:-3rem; margin-bottom:2rem; ">
<button type="button" style="padding:0.5rem 4rem 0.5rem 0.5rem;" class="btn bg-dark  text-white d-flex gap-2  pr-4 align-items-center">
     <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M21 8V20.9932C21 21.5501 20.5552 22 20.0066 22H3.9934C3.44495 22 3 21.556 3 21.0082V2.9918C3 2.45531 3.4487 2 4.00221 2H14.9968L21 8ZM19 9H14V4H5V20H19V9Z"></path></svg>
         Save</button>

</div>
    <div class="row">
        {{ Form::open(array('url' => 'orderReturn','class'=>'w-100')) }}
         @php
      
        $priority = [];
        $priority = [
        'Low' => 'Low',
        'High' => 'High',
        'Medium' => 'Medium',
        'Immediate' => 'Immediate'
        ];
    @endphp
        <div class="col-12">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <div class="card">
                <div class="card-body">
                    <h4 class="mx-3 my-4">Purchase Order</h4>
                   <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="vender-box">
                                {{ Form::label('purchase_id', __('Search Po Number'),['class'=>'form-label']) }}
                                 {{ Form::select('purchase_id',$product_services,'',array('class' => 'form-control select2 item','data-url'=>route('purchase.return.item'),'required'=>'required')) }}
                            </div>
                            <div id="vender_detail" class="d-none">
                            </div>
                        </div>
                        <div class="col-md-6">
                           
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('purchase_date', __('Search PO Date'),['class'=>'form-label']) }}
                                        {{Form::date('purchase_date',null,array('class'=>'form-control','required'=>'required'))}}

                                    </div>
                                </div>
                               
                            </div>


                            </div>
                        </div>
                    </div>
                    </div>
                    {{-- start for ai module--}}
    @php
        $plan= \App\Models\Utility::getChatGPTSettings();
    @endphp
  
    {{-- end for ai module--}}
   
   
   
          <div class="card">
            <div class="card-body">
        
         <h6 class="sub-title fs-4">{{__('Vendor Information')}}</h6>
     <div class="row ">
       
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('name',__('Company Name'),array('class'=>'form-label')) }}<span class="text-danger">*</span>
                 {{Form::text('name',null,array('class'=>'form-control','required'=>'required' , 'placeholder'=>__('M & S Gourav Gases')))}}
 
             </div>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('contact_person',__('Contact Person'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('contact_person',null,array('class'=>'form-control','required'=>'required' , 'placeholder' => __('Mahi Sharma')))}}
 
             </div>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('email',__('Email'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::email('email',null,array('class'=>'form-control','required'=>'required' , 'placeholder' => __('m&m@gmail.com')))}}
             </div>
         </div>
 
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('sector',__('Sector'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('sector',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('Sector')))}}
             </div>
         </div>
 
           <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('industry',__('Industry'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('industry',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('Manufacturing')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('tax_number',__('GSTIN'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('tax_number',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('213242453234')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('contact',__('Number'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('contact',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('9999999999')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('alternate',__('Alternative Number'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('alternate',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('9999999999')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('plot_number',__('Plot Number'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('plot_number',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('Dreamland 202')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('land_mark',__('Land Mark'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('land_mark',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('Dreamland 202')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('street_name',__('Street Name'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('street_name',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('Anand Bazar')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('area_name',__('Area Name'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('area_name',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('Old Palasia')))}}
             </div>
         </div>
         
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('pincode',__('Pincode'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('pincode',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('454720')))}}
             </div>
         </div>
       
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('city',__('City'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('city',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('Indore')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('state',__('State'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('state',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('Madhy Pradesh')))}}
             </div>
         </div>
 
         <div class="col-lg-4 col-md-4 col-sm-6">
             <div class="form-group">
                 {{Form::label('country',__('Country'),['class'=>'form-label'])}}<span class="text-danger">*</span>
                 {{Form::text('country',null,array('class'=>'form-control' , 'required'=>'required', 'placeholder'=>__('India')))}}
             </div>
         </div>
 
        </div>
     </div>
    </div>
               
           

        <div class="col-12">
         
            <div class="card repeater">
                <div class="item-section py-2">
                    <div class="row justify-content-between align-items-center">
                         <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-start">
                            <div class="all-button-box me-2">
                                 <h4 class="mx-3 my-4">Return Order Details</h4>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                            <div class="all-button-box me-2">
                                <a href="#" data-repeater-create="" class="btn btn-primary" data-bs-toggle="modal" data-target="#add-bank">
                                    <i class="ti ti-plus"></i> {{__('Add item')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0" data-repeater-list="items" id="sortable-table">
                            <thead class="thead-dark">
                            <tr>
                                <th>{{__('Sr.')}}</th>
                                <th>{{__('Part/Description')}}</th>
                                <th>{{__('Priority')}} </th>
                                <th>{{__('Unit Rate')}} </th>
                                <th>{{__('Quantity')}}</th>
                               <th>{{__('Request Note')}}</th>
                             
                                <th class="text-end">{{__('Net Value')}} <br><small class="text-danger font-weight-bold">{{__('after tax & discount')}}</small></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="ui-sortable" data-repeater-item id="return_purchase">
                            <tr>
                                <td class="sr_no">1</td>
                                <td width="25%" class="form-group pt-1">
                                     {{ Form::text('product_name','', array('class' => 'form-control product_name','placeholder'=>__('Product Name'))) }}
                                </td>
                                 <td width="10%">
                                    <div class="form-group">
                                     {{ Form::select('priority', $priority,null, array('class' => 'form-control select priority')) }}
                                    </div>
                                   
                                </td>
                                 <td>
                                    <div class="form-group price-input input-group search-form">
                                        {{ Form::text('price','', array('class' => 'form-control price','required'=>'required','placeholder'=>__('Price'),'required'=>'required')) }}
                                        <span class="input-group-text bg-transparent">{{\Auth::user()->currencySymbol()}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group price-input input-group search-form">
                                        {{ Form::text('quantity','', array('class' => 'form-control quantity','required'=>'required','placeholder'=>__('Qty'),'required'=>'required')) }}

                                        <span class="unit input-group-text bg-transparent"></span>
                                    </div>
                                </td>
                                            {{ Form::hidden('discount','', array('class' => 'form-control discount','required'=>'required','placeholder'=>__('Discount'))) }}
                                            {{ Form::hidden('tax','', array('class' => 'form-control tax')) }}
                                            {{ Form::hidden('itemTaxPrice','', array('class' => 'form-control itemTaxPrice')) }}
                                            {{ Form::hidden('itemTaxRate','', array('class' => 'form-control itemTaxRate')) }}
                               
                                
                                    <td>
                                    <div class="form-group">
                                        {{ Form::textarea('note', null, ['class'=>'form-control note','rows'=>'1','placeholder'=>__('Description')]) }}
                                    </div>
                                </td>
                                <td class="text-end amount">
                                    0.00
                                </td>
                                <td>
                                    <a href="#" class="ti ti-trash text-white text-white repeater-action-btn bg-danger ms-2" data-repeater-delete></a>
                                </td>
                            </tr>
                            {{--<tr>
                                <td colspan="2">
                                    <div class="form-group">{{ Form::textarea('description', null, ['class'=>'form-control pro_description','rows'=>'2','placeholder'=>__('Description')]) }}</div>
                                </td>
                                <td colspan="5"></td>
                            </tr>--}}
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td><strong>{{__('Sub Total')}} ({{\Auth::user()->currencySymbol()}})</strong></td>
                                <td class="text-end subTotal">0.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td><strong>{{__('Discount')}} ({{\Auth::user()->currencySymbol()}})</strong></td>
                                <td class="text-end totalDiscount">0.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td><strong>{{__('Tax')}} ({{\Auth::user()->currencySymbol()}})</strong></td>
                                <td class="text-end totalTax">0.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="blue-text"><strong>{{__('Total Amount')}} ({{\Auth::user()->currencySymbol()}})</strong></td>
                                <td class="blue-text text-end totalAmount">0.00</td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

       

    <div class="card px-3 py-3 my-3">
     <h4>Request Note</h4>
     <p class="my-3 fs-6 lh-lg text-secondary">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their
         </p>

         <h5 class="my-2 text-secondary" id="createdBy">Request by - Kuldeep at 10:41 AM Tue 14/06/2024</h5>
         <div class="w-100 bg-light d-flex px-2 py-2 rounded my-3 justify-content-between border"><input style="width:90%;" type="text" placeholder="type here..." class="w-20 bg-transparent outline-none border-0 "/>
        <div>
         <svg style="cursor:pointer;" className=' cursor-pointer' width={{"1.3rem"}} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M14.8287 7.75737L9.1718 13.4142C8.78127 13.8047 8.78127 14.4379 9.1718 14.8284C9.56232 15.219 10.1955 15.219 10.586 14.8284L16.2429 9.17158C17.4144 8.00001 17.4144 6.10052 16.2429 4.92894C15.0713 3.75737 13.1718 3.75737 12.0002 4.92894L6.34337 10.5858C4.39075 12.5384 4.39075 15.7042 6.34337 17.6569C8.29599 19.6095 11.4618 19.6095 13.4144 17.6569L19.0713 12L20.4855 13.4142L14.8287 19.0711C12.095 21.8047 7.66283 21.8047 4.92916 19.0711C2.19549 16.3374 2.19549 11.9053 4.92916 9.17158L10.586 3.51473C12.5386 1.56211 15.7045 1.56211 17.6571 3.51473C19.6097 5.46735 19.6097 8.63317 17.6571 10.5858L12.0002 16.2427C10.8287 17.4142 8.92916 17.4142 7.75759 16.2427C6.58601 15.0711 6.58601 13.1716 7.75759 12L13.4144 6.34316L14.8287 7.75737Z"></path></svg>
         <svg style="cursor:pointer;" className='cursor-pointer' width={{"1.3rem"}} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M1.94619 9.31543C1.42365 9.14125 1.41953 8.86022 1.95694 8.68108L21.0431 2.31901C21.5716 2.14285 21.8747 2.43866 21.7266 2.95694L16.2734 22.0432C16.1224 22.5716 15.8178 22.59 15.5945 22.0876L12 14L18 6.00005L10 12L1.94619 9.31543Z"></path></svg>
         </div>
        </div>
</div>
 <div class="modal-footer">
            <input type="button" value="{{__('Cancel')}}" onclick="location.href = '{{route("purchase.index")}}';" class="btn btn-light">
            <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
        </div>
    {{ Form::close() }}
    </div>
@endsection

<script>
    // document.getElementById('pro_image').onchange = function () {
    //     var src = URL.createObjectURL(this.files[0])
    //     document.getElementById('image').src = src
    // }

     
  
    //hide & show quantity
  function appendDiv() {
       var firstChild = $('#divContainer').children().first();
    //                  firstChild.after(data);
   
        $('#divContainer').append('<div class="add_contact"><div class="row mx-2"><div class="col-md-2"><div class="form-group"><label for="prefix" class="form-label">Sr. No</label><input class="form-control" placeholder="01" name="prefix[]" type="text" id="prefix_name"></div></div><div class="col-md-3"><div class="form-group"><label for="sub_specification" class="form-label">Parts/Description</label>'+vv+'</div></div><div class="col-md-2"><div class="form-group"><label for="price" class="form-label">Unit Rate</label><input class="form-control" placeholder="10" name="price[]" type="text" id="price"></div></div><div class="col-md-2"><div class="form-group"><label for="price" class="form-label">Quantity</label><input class="form-control" placeholder="100" name="price[]" type="text" id="price"></div></div><div class="col-md-2"><div class="form-group"><label for="price" class="form-label">Net Value INR</label><input class="form-control" placeholder="1,000" name="price[]" type="text" id="price"></div></div><div class="col-md-1" style="padding-top: 25px;"><div class="form-group"><a class="mx-3 btn btn-primary sm  align-items-cente removeButton" title="remove"><label class="form-check-label " for="g_male"><i class="ti ti-trash text-white"></i></label></a></div></div></div></div>');
      
  }
  
  
    // $(document).on('click', '.type', function ()
    // {
    //     var type = $(this).val();
    //     if (type == 'product') {
    //         $('.quantity').removeClass('d-none')
    //         $('.quantity').addClass('d-block');
    //     } else {
    //         $('.quantity').addClass('d-none')
    //         $('.quantity').removeClass('d-block');
    //     }
    // });
    
    // $(document).on('change', '#groups', function ()
    // {
    //     var id = $(this).val();
    //     $.ajax({
    //         url: '{{route('category.model')}}',
    //         type: 'GET',
    //         data: {
               
    //             "id": id,
    //             "_token": "{{ csrf_token() }}",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             $('#product_model').empty();
    //             $('#product_model').append('<option value="">Select Model</option>');
    //             $.each(data.data, function(index, model) {
    //            $('#product_model').append('<option value="' + model.id + '">' + model.name + '</option>');
    //         });
    //         }
    //     });
    // });
</script>



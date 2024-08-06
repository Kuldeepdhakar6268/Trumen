<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Purchase Create')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('purchase.index')); ?>"><?php echo e(__('Purchase')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Purchase Create')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.repeater.min.js')); ?>"></script>
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
// alert(item.product.unit_price)
                                $(el.parent().parent().parent().find('.quantity')).val(item.qty);
                                $(el.parent().parent().parent().find('.priority')).val(item.priority);
                                $(el.parent().parent().parent().find('.price')).val(item.price);
                                $(el.parent().parent().parent().find('.note')).val(item.note);
                                $(el.parent().parent().parent().find('.amount')).html(item.total);
                                if(item.approved_by == null){
                                var approvedby = '<?php echo e(auth()->user()->name); ?>';    
                                $("#approvedby").val(approvedby)  
                                }
                                else{
                                $("#approvedby").val('Auto Approved')    
                                }
                                
                    console.log(el);
                    // var taxes = '';
                    // var tax = [];

                    // var totalItemTaxRate = 0;
                    // if (item.taxes == 0) {
                    //     taxes += '-';
                    // } else {
                    //     for (var i = 0; i < item.taxes.length; i++) {

                    //         taxes += '<span class="badge bg-primary mt-1 mr-2">' + item.taxes[i].name + ' ' + '(' + item.taxes[i].rate + '%)' + '</span>';
                    //         tax.push(item.taxes[i].id);
                    //         totalItemTaxRate += parseFloat(item.taxes[i].rate);

                    //     }
                    // }
                    // var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (item.product.unit_price * 1));

                    // $(el.parent().parent().find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));
                    // $(el.parent().parent().find('.itemTaxRate')).val(totalItemTaxRate.toFixed(2));
                    // $(el.parent().parent().find('.taxes')).html(taxes);
                    // $(el.parent().parent().find('.tax')).val(tax);
                    $(el.parent().parent().find('.unit')).html(item.unit);
                    $(el.parent().parent().find('.discount')).val(0);
                    $(el.parent().parent().find('.amount')).html(item.total);
                    $(el.parent().parent().find('.subTotal')).html(item.total);
                    $(el.parent().parent().find('.totalAmount')).html(item.total);
                    $(el.parent().parent().find('.total_amount')).val(item.total);
//   alert($('#total_amount').val());

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
                     $('#total_amount').val(parseFloat(subTotal).toFixed(2));

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

            var el = $(this).parent().parent().parent().parent();
            var quantity = $(this).val();
            var price = $(el.find('.price')).val();
            var discount = $(el.find('.discount')).val();
            if(discount.length <= 0)
            {
                discount = 0 ;
            }

            var totalItemPrice = (quantity * price) - discount;
            var amount = (totalItemPrice);


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
           alert("sdf")
          var $self = $(this);
          $self.after($self.parent().clone());
          $self.remove();
       });
        $(document).on('click', '.choices', function () {
        //   alert("sdf")
           var el = $(this);
          var $self = $(el.find(".choices__list")).css('visibility', 'visible');
        //   $self.after($self.parent().clone());
        //   $self.remove();
       });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-end  " style="margin-top:-3rem; margin-bottom:2rem; ">
<button type="button" style="padding:0.5rem 4rem 0.5rem 0.5rem;" class="btn bg-dark  text-white d-flex gap-2  pr-4 align-items-center">
     <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M21 8V20.9932C21 21.5501 20.5552 22 20.0066 22H3.9934C3.44495 22 3 21.556 3 21.0082V2.9918C3 2.45531 3.4487 2 4.00221 2H14.9968L21 8ZM19 9H14V4H5V20H19V9Z"></path></svg>
         Save</button>

</div>
    <div class="row">
        <?php echo e(Form::open(array('url' => 'purchase','class'=>'w-100'))); ?>

         <?php
      
        $priority = [];
        $priority = [
        'Low' => 'Low',
        'High' => 'High',
        'Medium' => 'Medium',
        'Immediate' => 'Immediate'
        ];
    ?>
        <div class="col-12">
            <input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">
            <div class="card">
                <div class="card-body">
                    <h4 class="mx-3 my-4">Purchase Order</h4>
                   <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="vender-box">
                                <?php echo e(Form::label('vender_id', __('Vendor'),['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('vender_id', $venders,$vendorId, array('class' => 'form-control select','id'=>'vender','data-url'=>route('bill.vender'),'required'=>'required'))); ?>

                            </div>
                            <div id="vender_detail" class="d-none">
                            </div>
                        </div>


                        <div class="col-md-6">
                           
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('purchase_date', __('Purchase Date'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::date('purchase_date',null,array('class'=>'form-control','required'=>'required'))); ?>


                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('purchase_number', __('Purchase Number'),['class'=>'form-label'])); ?>

                                        <input type="text" class="form-control" value="<?php echo e($purchase_number); ?>" readonly>

                                    </div>
                                </div>
                            </div>


                            </div>
                        </div>
                    </div>
                    
    <?php
        $plan= \App\Models\Utility::getChatGPTSettings();
    ?>
   
    
    <div class="row">
        <!-- <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required', 'placeholder'=>__('Enter Specification Name')))); ?>

            </div>
        </div> -->
        
         
         
       
       
        
      
       
      
    </div>
                </div>
            </div>

        <div class="col-12">
         
            <div class="card repeater">
                <div class="item-section py-2">
                    <div class="row justify-content-between align-items-center">
                         <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-start">
                            <div class="all-button-box me-2">
                                 <h4 class="mx-3 my-4">Order Details</h4>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                            <div class="all-button-box me-2">
                                <a href="#" data-repeater-create="" class="btn btn-primary" data-bs-toggle="modal" data-target="#add-bank">
                                    <i class="ti ti-plus"></i> <?php echo e(__('Add item')); ?>

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
                                <th><?php echo e(__('Sr.')); ?></th>
                                <th><?php echo e(__('Part/Description')); ?></th>
                                <th><?php echo e(__('Priority')); ?> </th>
                                <th><?php echo e(__('Unit Rate')); ?> </th>
                                <th><?php echo e(__('Quantity')); ?></th>
                               <th><?php echo e(__('Request Note')); ?></th>
                             
                                <th class="text-end"><?php echo e(__('Net Value')); ?> <br><small class="text-danger font-weight-bold"><?php echo e(__('after tax & discount')); ?></small></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="ui-sortable" data-repeater-item>
                            <tr>
                                <td class="sr_no">1</td>
                                <td width="25%" class="form-group pt-1">
                                    <?php echo e(Form::select('item',$product_services,'',array('class' => 'form-control select2 item','data-url'=>route('purchase.items'),'required'=>'required'))); ?>

                                </td>
                                 <td width="10%">
                                    <div class="form-group">
                                     <?php echo e(Form::select('priority', $priority,null, array('class' => 'form-control select priority'))); ?>

                                    </div>
                                   
                                </td>
                                 <td>
                                    <div class="form-group price-input input-group search-form">
                                        <?php echo e(Form::text('price','', array('class' => 'form-control price','required'=>'required','placeholder'=>__('Price'),'required'=>'required'))); ?>

                                        <span class="input-group-text bg-transparent"><?php echo e(\Auth::user()->currencySymbol()); ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group price-input input-group search-form">
                                        <?php echo e(Form::text('quantity','', array('class' => 'form-control quantity','required'=>'required','placeholder'=>__('Qty'),'required'=>'required'))); ?>


                                        <span class="unit input-group-text bg-transparent"></span>
                                    </div>
                                </td>
                                            <?php echo e(Form::hidden('discount','', array('class' => 'form-control discount','required'=>'required','placeholder'=>__('Discount')))); ?>

                                            <?php echo e(Form::hidden('tax','', array('class' => 'form-control tax'))); ?>

                                            <?php echo e(Form::hidden('itemTaxPrice','', array('class' => 'form-control itemTaxPrice'))); ?>

                                            <?php echo e(Form::hidden('itemTaxRate','', array('class' => 'form-control itemTaxRate'))); ?>

                               
                                
                                    <td>
                                    <div class="form-group">
                                        <?php echo e(Form::textarea('note', null, ['class'=>'form-control note','rows'=>'1','placeholder'=>__('Description')])); ?>

                                    </div>
                                </td>
                                <td class="text-end amount">
                                    0.00
                                </td>
                                <td>
                                    <a href="#" class="ti ti-trash text-white text-white repeater-action-btn bg-danger ms-2" data-repeater-delete></a>
                                </td>
                            </tr>
                            
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td><strong><?php echo e(__('Sub Total')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td class="text-end subTotal">0.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td><strong><?php echo e(__('Discount')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td class="text-end totalDiscount">0.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td><strong><?php echo e(__('Tax')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td class="text-end totalTax">0.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="blue-text"><strong><?php echo e(__('Total Amount')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td class="blue-text text-end totalAmount">0.00</td>
                                <td><?php echo e(Form::hidden('total_amount','1', array('class' => 'form-control total_amount', 'id' => 'total_amount'))); ?></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card px-3 py-3 my-3">
       <div class="card">
                 <div class="card-header">
                    <div class="row">  
                     <div class="col-sm-8">
                        <div class="row">  
                            <div class="col-sm-4">
                             <h5><?php echo e(__('Terms & Conditions')); ?></h5>
                            </div>
                                <div class="col-sm-4">
                                        <select class="form-control" name="terms_options" id="terms_options">
                                          
                                           <option value="forsite" selected>FOR Site</option>
                                           <option value="export">Export</option>
                                           <option value="exworks">Ex works indore</option>
                                           <option value="others">Others</option>
                                       </select>
                                </div>
                        </div>
                     </div>
                        <div class="col-sm-4">
                        </div>
                    </div>
                  </div>
                <div class="card-body">
                    <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        1. <?php echo e(Form::label('terms_price', __('Price'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-8" style="height: 4.0rem;">
                                    <div class="form-group row">
                                          <div class="col-md-6 form-group">
                                          <?php echo e(Form::text('terms_price','FOR Site', ['class'=>'form-control','placeholder'=>__('Ex Works, Indore.'), 'id' => 'terms_price','required'=>'required','readonly'])); ?>

                                            </div>
                                           <div class="col-sm-6 commp"></div>
                                    </div>
                                </div>
                                <hr style="margin-bottom: 0rem;">
                                <div class="col-md-4 text-center" style="display:none;margin-top: 1rem;" id="pandf3">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        2. <?php echo e(Form::label('p_f', __('P & F'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-8" style="display:none;margin-top: 1rem;" id="pandf4">
                                    <div class="form-group row" style="height: 2.3rem;">
                                          
                                          <div class="col-md-6 form-group">
                                            <?php echo e(Form::text('p_fss','Extra @',  ['class'=>'form-control','id' => 'p_f1','placeholder'=>__('Enter Packing Ex: 25%.')])); ?>

                                            </div>
                                            
                                           <div class="col-sm-6 commp"> % AIRWORTHY EXPORT PACKING <input type="radio" name="check" checked id="checkradio1"></div>
                                    </div>
                                    <div class="form-group row" style="height: 2.3rem;">
                                    
                                          <div class="col-md-6 form-group">
                                            <?php echo e(Form::text('p_f_next','Extra @', ['class'=>'form-control','disabled','id' => 'p_f2','placeholder'=>__('Enter Packing Ex: 25%.')])); ?> 
                                            </div>
                                           <div class="col-sm-6 commp">% SEA WORTHY EXPORT PACKING <input type="radio" name="check" id="checkradio2"></div>
                                    </div>
                                    </div>
                                
                                 <div class="col-md-4 text-center" id="pandf1">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;margin-top: 1rem;">
                                        2. <?php echo e(Form::label('p_f', __('P & F'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-8" id="pandf2">
                                   <div class="form-group row" style="height: 2.3rem;margin-top: 1rem;">
                                        
                                        <div class="col-sm-6">
                                        <select name="p_fs" class="form-control" id="pfs_options">
                                          
                                           <option value="2.5%" selected>Extra @ 2.5%</option>
                                           <option value="nil">nil</option>
                                           
                                       </select>
                                        </div>
                                        
                                        <div class="col-sm-1 commp">
                                          Edit: <input type="checkbox" name="check" id="checkradio3">
                                        </div>
                                      
                                    <div class="col-sm-5">
                                      <?php echo e(Form::text('p_fs','Extra @ 2.5%',['class'=>'form-control','disabled','id' => 'p_fs'])); ?>

                                    </div>
                                  </div>
                                </div>
                                 <hr>
                                <div class="col-md-4 text-center" id="taxes1">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        3. <?php echo e(Form::label('taxes', __('Taxes'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-8" id="taxes2">
                                      <div class="form-group row" style="height: 2.3rem;">
                                          
                                          <div class="col-md-6 form-group">
                                            <?php echo e(Form::text('taxes','GST @ 18%', ['class'=>'form-control','required'=>'required'])); ?> 
                                            </div>
                                            <div class="col-md-6 form-group commp">
                                           
                                            </div>
                                          </div>
                                </div>
                                 <hr>
                                <div class="col-md-4 text-center" id="freight1">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        4. <?php echo e(Form::label('freight', __('Freight'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-8" id="freight2">
                                    <div class="form-group row" style="height: 2.3rem;">
                                          <div class="col-md-6 form-group">
                                          <?php echo e(Form::text('freight','Extra at actual through your approved freight carrier.', ['id' => 'freight', 'class'=>'form-control','placeholder'=>__('Extra at actual through your approved freight carrier.')])); ?>

                                            </div>
                                           <div class="col-sm-6 commp"></div>
                                    </div>
                                </div>
                                  <hr>
                                <div class="col-md-4">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        5. <?php echo e(Form::label('transit_insurance', __('Transit Insurance'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-8">
                                     <div class="form-group row" style="height: 2.3rem;">
                                          <div class="col-md-6 form-group">
                                           <select name="transit_insurance" class="form-control">
                                           <option value="Extra to your account" selected>Extra to your account</option>
                                           <option value="Inclusive in above quoted price">Inclusive in above quoted price</option>
                                           </select>
                                            </div>
                                           <div class="col-sm-6 commp"></div>
                                    </div>
                                    <div class="form-group">
                                    </div>
                                </div>
                                 <hr style="margin-bottom: 0rem;">
                                 <div class="col-md-4 text-center" style="display:none;margin-top: 1rem;" id="bank1">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        6. <?php echo e(Form::label('Transaction', __('Bank Transaction Charges'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                 
                                <div class="col-md-8" style="display:none;margin-top: 1rem;"  id="bank2" style="height: 3.5rem;">
                                     <div class="form-group row">
                                          <div class="col-md-6 form-group">
                                             <?php echo e(Form::text('transaction',null, ['class'=>'form-control','placeholder'=>__('Applicable to your account.')])); ?>

                                            </div>
                                            
                                           <div class="col-sm-6 commp"></div>
                                    </div>
                                </div>
                                 <hr>
                                 
                                <div class="col-md-4 text-center">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        7. <?php echo e(Form::label('delivery', __('Delivery'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group row" style="height: 2.3rem;">
                                          <div class="col-sm-1 commp">Within</div> 
                                          <div class="col-md-5 form-group">
                                            <?php echo e(Form::text('delivery',null,['class'=>'form-control','required'=>'required','placeholder'=>__('Within Ex: 5.')])); ?> 
                                            </div>
                                            
                                           <div class="col-sm-6 commp">Weeks after received of confirm order.</div>
                                    </div>
                                </div>
                                 <hr>
                                 
                                 <div class="col-md-4 text-center">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;height: 2.3rem;">
                                        8. <?php echo e(Form::label('payment', __('Payment'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                
                                <div class="col-md-8">
                                    <div class="form-group row" style="height: 2.3rem;">
                                          <div class="col-md-6 form-group">
                                            <select class="form-control" id="paymentOptions" name="payment">
                                           <option value="100%">100% Against proforma invoice prior to dispatch.</option>
                                           <option value="30 days credit">30 days credit</option>
                                           <option value="45 days credit">45 days credit</option>
                                           <option value="60 days credit">60 days credit</option>
                                           <option value="90 days credit">90 days credit</option>
                                            </select>
                                           
                                            </div>
                                        <div class="col-sm-1 commp">
                                          Edit: <input type="checkbox" name="check_payment" id="checkradio5">
                                        </div>
                                      
                                        <div class="col-sm-5">
                                          <?php echo e(Form::text('payments','100%',['class'=>'form-control','disabled','id' => 'payment'])); ?>

                                        </div>
                                         
                                    </div>
                                    
                                </div>
                                 <hr>
                                <div class="col-md-4 text-center">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        9. <?php echo e(Form::label('warranty', __('Warranty'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                
                                <div class="col-md-8" style="height: 4.3rem;">
                                     <div class="form-group row">
                                          <div class="col-md-6 form-group">
                                             <?php echo e(Form::number('warranty','12', ['class'=>'form-control','placeholder'=>__('Enter Payment Ex: 12.')])); ?>

                                            </div>
                                           <div class="col-sm-6">Months from the date of commissioning or <br>Fifteen months from the date of supply which ever is earlier.</div>
                                    </div>
                                </div>
                                 <hr>
                                <div class="col-md-4 text-center">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        10. <?php echo e(Form::label('validity', __('Validity of Offer'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                 
                                <div class="col-md-8" style="height: 3.6rem;">
                                     <div class="form-group row" >
                                          <div class="col-md-6 form-group">
                                            <?php echo e(Form::number('validity','30',['class'=>'form-control','placeholder'=>__('Enter Validity')])); ?> 
                                            </div>
                                           <div class="col-sm-6 commp">Days.</div>
                                    </div>
                                   
                                </div>
                                 <hr>
                                <div class="col-md-4 text-center" style="height: 4.0rem;">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        11. <?php echo e(Form::label('release_po', __('Release of PO'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                
                                <div class="col-md-8" style="height: 2.3rem;">
                                    <div class="form-group row">
                                          <div class="col-md-6 form-group">
                                            <?php echo e(Form::text('release_po','Formal order mentioning your delivery address and dispatch instructions.',['class'=>'form-control','placeholder'=>__('Enter Release PO')])); ?> 
                                            </div>
                                            <div class="col-md-6 form-group"></div>
                                    </div>
                                    
                                </div>
                                 <hr>
                                <div class="col-md-4 text-center">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        12. <?php echo e(Form::label('cancellation', __('Cancellation Charges'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group row" style="margin-bottom: 0.3rem;">
                                          <div class="col-md-6 form-group">
                                            <?php echo e(Form::text('cancellation','50%',['class'=>'form-control','placeholder'=>__('Enter Cancellation Ex: 50%.')])); ?> 
                                            </div>
                                           <div class="col-sm-6">of PO amount to be paid if cancelled after order acceptance.</div>
                                    </div>
                                   
                                </div>
                                <hr>
                               
                </div>
            </div>
            <?php
             $Uaddress = \App\Models\User::find(auth()->user()->id);
            ?>
            <!--Sender Address-->
             <div class="card">
                 <div class="card-header">
                                      
                     <h5><?php echo e(__('Sender Information')); ?></h5>
                  </div>
                <div class="card-body">
                    <div class="row">
                       
                               <div class="col-md-2">
                                    <div class="form-group">
                                        <?php echo e(Form::label('sender_name', __('Prepared By'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                        <?php echo e(Form::text('sender_name',auth()->user()->name, ['class' => 'form-control', 'placeholder' => __('Enter Sender Name'),'required'=>'required'])); ?>


                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <?php echo e(Form::label('approvedby', __('Approved By'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                        <?php echo e(Form::text('approvedby',null, ['class' => 'form-control'])); ?>


                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <?php echo e(Form::label('address', __('Address'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                        <?php echo e(Form::text('address', !empty($Uaddress->employee)?$Uaddress->employee->address:auth()->user()->address, ['class' => 'form-control', 'placeholder' => __('Enter Sender Address'),'required'=>'required'])); ?>


                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                   
                                    <div class="form-group">
                                        <?php echo e(Form::label('sender_number', __('Number'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                        <?php echo e(Form::text('contact', !empty($Uaddress->employee)?$Uaddress->employee->phone:auth()->user()->contact, ['class' => 'form-control', 'id' => 'sender_phone', 'placeholder' => __('Enter Sender Contact No.'),'required'=>'required'])); ?>


                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('sender_email', __('Email'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                        <?php echo e(Form::text('sender_email',auth()->user()->email, ['class' => 'form-control', 'placeholder' => __('Enter Sender Email'),'required'=>'required'])); ?>


                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('sender_website', __('Website'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                        <?php echo e(Form::text('sender_website', 'www.trumen.com', ['class' => 'form-control', 'placeholder' => __('Enter Website'),'required'=>'required'])); ?>


                                    </div>
                                </div>
                    </div>
                </div>
            </div>
</div>
 <div class="modal-footer">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" onclick="location.href = '<?php echo e(route("purchase.index")); ?>';" class="btn btn-light">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
        </div>
    <?php echo e(Form::close()); ?>

</div>

<?php $__env->stopSection(); ?>

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
    //         url: '<?php echo e(route('category.model')); ?>',
    //         type: 'GET',
    //         data: {
               
    //             "id": id,
    //             "_token": "<?php echo e(csrf_token()); ?>",
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



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/purchase/create.blade.php ENDPATH**/ ?>
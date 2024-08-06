<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Quotation Create')); ?>

<?php $__env->stopSection(); ?>
<?php
    $id = \Illuminate\Support\Facades\Request::segment(3); // Adjust the segment index based on your URL structure
    
?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
     
       <li class="breadcrumb-item"><a href="<?php echo e($id==0?route('leads.show',  $_GET['lead_id']):route('leads.edit', $_GET['lead_id'])); ?>"><?php echo e(__('Lead')); ?></a></li>
   
    <li class="breadcrumb-item"><?php echo e(__('Quotation Create')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dropzone.min.css')); ?>">
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
    <style>
    .commp{
        padding: 7px 0px 0px 5px;
    }
    </style>
<?php $__env->stopPush(); ?>

  
<?php $__env->startPush('script-page'); ?>
  
    <script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?php echo e(asset('js/jquery.repeater.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
     <script>
       const phoneInputField = document.querySelector("#phone");
       const phoneInput = window.intlTelInput(phoneInputField, {
         utilsScript:
           "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                nationalMode: true,
                autoHideDialCode: true,
                autoPlaceholder: "ON",
                dropdownContainer: document.body,
                formatOnDisplay: true,
                hiddenInput: "phone",
                initialCountry: "IN",
                placeholderNumberType: "MOBILE",
                separateDialCode: true
       });
    $(document).ready(function() {
       $(".iti").css('display', 'block');
  });
     </script>
      <script>
       const phoneInputFields = document.querySelector("#sender_phone");
       const phoneInputs = window.intlTelInput(phoneInputFields, {
         utilsScript:
           "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                nationalMode: true,
                autoHideDialCode: true,
                autoPlaceholder: "ON",
                dropdownContainer: document.body,
                formatOnDisplay: true,
                hiddenInput: "sender_phone",
                initialCountry: "IN",
                placeholderNumberType: "MOBILE",
                separateDialCode: true
       });
   
     </script>
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
            console.log(value);
            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
                for (var i = 0; i < value.length; i++) {
                    var tr = $('#sortable-table .id[value="' + value[i].id + '"]').parent();
                    tr.find('.item').val(value[i].product_id);
                    changeItem(tr.find('.item'));
                }
            }
        }
       
         $(document).on('change', '#terms_options', function () {
        //   alert($(this).val())
           if($(this).val() == 'forsite')
           {
            $("#freight").val('Nil');
           $("#terms_price").val('FOR Site')
            $("#pandf3").css('display', 'none');
            $("#pandf4").css('display', 'none');
            $("#pandf1").css('display', 'block');
            $("#pandf2").css('display', 'block');
           
            $("#taxes1").css('display', 'block');
            $("#taxes2").css('display', 'block');
            $("#bank1").css('display', 'none');
            $("#bank2").css('display', 'none');
          }else if($(this).val() == 'others'){
              $("#freight").val('Extra at actual through your approved freight carrier.'); 
            $("#terms_price").val('Others')  
            $("#pandf3").css('display', 'none');
            $("#pandf4").css('display', 'none');
            $("#pandf1").css('display', 'block');
            $("#freight1").css('display', 'block');
            $("#freight2").css('display', 'block');
            $("#pandf2").css('display', 'block');
            $("#taxes1").css('display', 'block');
            $("#taxes2").css('display', 'block');
            $("#bank1").css('display', 'none');
            $("#bank2").css('display', 'none');
          }else if($(this).val() == 'export'){
             $("#freight").val('Extra at actual through your approved freight carrier.');   
            $("#terms_price").val('Ex Works Indore, India')  
            $("#pandf3").css('display', 'block');
            $("#pandf4").css('display', 'block');
            $("#pandf1").css('display', 'none');
            $("#pandf2").css('display', 'none');
            $("#freight1").css('display', 'block');
            $("#freight2").css('display', 'block');
            $("#bank1").css('display', 'block');
            $("#bank2").css('display', 'block');
          }else{
            $("#freight").val('Extra at actual through your approved freight carrier.'); 
            $("#terms_price").val('Ex Works, Indore') 
            $("#pandf3").css('display', 'none');
            $("#pandf4").css('display', 'none');
            $("#pandf1").css('display', 'block');
            $("#freight1").css('display', 'block');
            $("#freight2").css('display', 'block');
            $("#pandf2").css('display', 'block');
            $("#taxes1").css('display', 'block');
            $("#taxes2").css('display', 'block');
            $("#bank1").css('display', 'none');
            $("#bank2").css('display', 'none');
          }
        });
        $(document).on('click', '#checkradio1', function () {
           $("#p_f1").removeAttr('disabled');
            $("#p_f2").attr('disabled', 'disabled');
        });
        $(document).on('click', '#checkradio2', function () {
            $("#p_f2").removeAttr('disabled');
            $("#p_f1").attr('disabled', 'disabled');
        });
        $(document).on('click', '#checkradio5', function () {
            
            if($(this).is(':checked')){
              $("#payment").removeAttr('disabled');  
            }else{
                $("#payment").attr('disabled', 'disabled');
            }
            // $("#p_fs").attr('disabled', 'disabled');
        });
        $(document).on('change', '#paymentOptions', function () {
            var v = $(this).val();
            $("#payment").val(v);
           
        });paymentOptions
       

         function summernote() {
            if ($(".summernote-simple").length) {
                $('.summernote-simple').summernote({
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'strikethrough']],
                        ['list', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'unlink']],
                    ],
                    height: 250,
                });
            }
        }
        $(document).on('change', '.item', function () {
            var iteams_id = $(this).val();
            var url = $(this).data('url');
            var el = $(this);
             $(el.parent().parent().parent().find('.usd_sale_price')).val();
                    $(el.parent().parent().parent().find('.price_usd')).val();
                    $(el.parent().parent().parent().find('.euro_sale_price')).val();
                    $(el.parent().parent().parent().find('.price_euro')).val();
                    //  $(".amount").text('0.00');
                    //  $(".subTotal").text('0.00');
                    //  $(".totalAmount").text('0.00');
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
                     if(item.product.is_integral == 'on'){
                      
                    $(el.parent().parent().parent().parent().find('.integral')).removeClass('d-none');   
                   }else{
                       $(el.parent().parent().parent().parent().find('.integral')).addClass('d-none');
                       $(el.parent().parent().parent().parent().find('.group-material-0')).removeClass('d-none');  
                   }
                     $(el.parent().parent().parent().parent().find('.main-specification')).empty();
                     $.each(item.listing, function (key, value) {
                   
                    //  $(this).closest('.main-specification').append(value);
                    
                    $(el.parent().parent().parent().parent().find('.main-specification')).append(value);
                    });
                $(".enable-row").addClass('d-block');
                    if(item.productquantity < 1)
                    {
                        show_toastr('Error', "<?php echo e(__('This product is out of stock!')); ?>", 'error');
                        return false;
                    }
                    var arr2 = (item.product.hsn_code).split(':');
                    var arr3 =arr2[0]+':'; 
                    $(el.parent().parent().parent().parent().find('.main-specification')).removeClass('row');
                    $(el.parent().parent().parent().find('.quantity')).val(1);
                    $(el.parent().parent().parent().find('.model')).val(arr3);
                    $(el.parent().parent().parent().find('.hsnCode')).val('90261020');
                    $(el.parent().parent().parent().find('.product_model_id')).val(item.product.product_model_id);
                    $(el.parent().parent().parent().find('.price')).val(item.product.base_price);
                    $(el.parent().parent().parent().find('.base_price')).val(item.product.base_price);
                    $(el.parent().parent().parent().find('.base_price_usd')).val(item.product.base_price_usd);
                    $(el.parent().parent().parent().find('.base_price_euro')).val(item.product.base_price_euro);
                    $(el.parent().parent().parent().find('.m_price')).val('0.00');
                    $(el.parent().parent().parent().find('.usd_sale_price')).val('0.00');
                    $(el.parent().parent().parent().find('.price_usd')).val('0.00');
                    $(el.parent().parent().parent().find('.euro_sale_price')).val('0.00');
                    $(el.parent().parent().parent().find('.price_euro')).val('0.00');
                    $(el.parent().parent().parent().find('.group_id')).val(item.product.group_id);
                    $(el.parent().parent().parent().parent().find('.pro_description')).val(item.product.description);
                    console.log(el);
                    var taxes = '';
                    var tax = [];

                    var totalItemTaxRate = 0;
                    if (item.taxes == 0) {
                        taxes += '-';
                    } else {
                        for (var i = 0; i < item.taxes.length; i++) {

                            taxes += '<span class="badge bg-primary mt-1 mr-2">' + item.taxes[i].name + ' ' + '(' + item.taxes[i].rate + '%)' + '</span>';
                            tax.push(item.taxes[i].id);
                            totalItemTaxRate += parseFloat(item.taxes[i].rate);

                        }
                    }
                    var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (item.product.sale_price * 1));

                    $(el.parent().parent().parent().find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));
                    $(el.parent().parent().parent().find('.itemTaxRate')).val(totalItemTaxRate.toFixed(2));
                    $(el.parent().parent().parent().find('.taxes')).html(taxes);
                    $(el.parent().parent().parent().find('.tax')).val(tax);
                    $(el.parent().parent().parent().find('.unit')).html(item.unit);
                    $(el.parent().parent().parent().find('.discount')).val(0);
                    $(el.parent().parent().parent().find('.amount')).html(item.product.base_price);


                    var inputs = $(".amount");
                     $('.subTotal').html(item.product.base_price);
                    var subTotal = 0;
                    for (var i = 0; i < inputs.length; i++) {
                        subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                    }
                    $('.subTotal').html(subTotal.toFixed(2));


                    var totalItemPrice = 0;
                    var priceInput = $('.price');
                    for (var j = 0; j < priceInput.length; j++) {
                        totalItemPrice += parseFloat(priceInput[j].value);
                    }

                    var totalItemTaxPrice = 0;
                    var itemTaxPriceInput = $('.itemTaxPrice');
                    for (var j = 0; j < itemTaxPriceInput.length; j++) {
                        totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
                    }

                    $('.totalTax').html(totalItemTaxPrice.toFixed(2));
                    $('.totalAmount').html((parseFloat(subTotal) + parseFloat(totalItemTaxPrice)).toFixed(2));

                },
            });
        });

        $(document).on('keyup', '.quantity', function () {
            var quntityTotalTaxPrice = 0;

            var el = $(this).parent().parent().parent().parent();
            var quantity = $(this).val();
            if(quantity.length == 1)
            {                
                var quantity = 0 + $(this).val();
            }
            var price = $(el.find('.price')).val();
            var item_id = $(el.find('.item')).val();

            $.ajax({
                url: '<?php echo e(route('product.quantity')); ?>',
                type: 'POST',
                data: {
                    "item_id": item_id,
                    "quantity":quantity,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {

                    if(data < quantity)
                    {
                        show_toastr('Error', "<?php echo e(__('This product is out of stock!')); ?>", 'error');
                        return false;
                    }

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

            $('.subTotal').html(amount.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal)).toFixed(2));
        }
            });
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

        var vendorId = '<?php echo e($customer); ?>';
        if (vendorId > 0) {
            $('#vender').val(vendorId).change();
        }
        
    $(document).on('keyup', '.manual_discount', function () {
             var type = $('#selectOption').val();
             var amt = $(this).val();
             var el = $(this);
            
             if(amt != '')
             {
                 if(type == 'flat')
             {
                 var subTotal =  $('.subTotal').text();
                 var Total = parseFloat(subTotal) -  parseFloat(amt);
                 $('.totalAmount').html(parseFloat(Total).toFixed(2));
                  $('.totalDiscount').html(parseFloat(amt).toFixed(2));
             }else
             {
                 
                 var subTotal = $('.subTotal').text();
                 var Total = (parseFloat(subTotal) - parseFloat(subTotal)* parseFloat(amt)/100);
                  $('.totalDiscount').html((parseFloat(subTotal)* parseFloat(amt)/100).toFixed(2));
                 $('.totalAmount').html(parseFloat(Total).toFixed(2));
             }
             }else{
                 var subTotal=0;
                 $('.totalDiscount').html((parseFloat(subTotal).toFixed(2)));
                 var subTotal = $('.subTotal').text();
                 $('.totalAmount').html(parseFloat(subTotal).toFixed(2));
             }
            
            //  $('.subTotal').html(subTotal.toFixed(2));
            //  $('.totalAmount').html(subTotal.toFixed(2)); 
         });
    //  $(document).on('change', '.selectcurrency', function () {
           
             
    //          var type = $(this).val();
    //          var amt = $(this).parent().parent().parent().find('.manual_discount').val();
    //          var m_price = $(this).parent().parent().parent().find('.m_price').val();
    //          var price = $(this).parent().parent().parent().find('.price_inr').val();
    //          var u_price = $(this).parent().parent().parent().find('.usd_sale_price').val();
    //          var e_price = $(this).parent().parent().parent().find('.euro_sale_price').val();
    //          var usd = $(this).parent().parent().parent().find('.price_usd').val()
    //          var euro = $(this).parent().parent().parent().find('.price_euro').val()
           
    //          var el = $(this);
            
    //          if(type != '')
    //          {
                
    //              if(type == 'USD')
    //              {
    //                  $('.cSymbol').text('$')
    //                  if(usd>0){
    //                     $(this).parent().parent().parent().find('.price').empty();
    //                     $(this).parent().parent().parent().find('.price').val(usd); 
    //                     $('.amount').text(usd);
    //                     $('.subTotal').text(usd);
    //                     $('.totalAmount').html(parseFloat(usd).toFixed(2));
                       
    //                       var Mamt = $('#mDiscount').val();
    //          var Dtype = $('#selectOption').val();
            
    //         if(Mamt != ''){
            
    //          if(Mamt != '')
    //          {
    //              if(Dtype == 'flat')
    //          {
    //              var subTotal =  $('.subTotal').text();
                
    //              var Total = parseFloat(subTotal) -  parseFloat(Mamt);
    //              $('.totalAmount').html(parseFloat(Total).toFixed(2));
    //               $('.totalDiscount').html(parseFloat(Mamt).toFixed(2));
    //          }else
    //          {
                 
    //              var subTotal = $('.subTotal').text();
    //              var Total = (parseFloat(subTotal) - parseFloat(subTotal)* parseFloat(Mamt)/100);
    //               $('.totalDiscount').html((parseFloat(subTotal)* parseFloat(amt)/100).toFixed(2));
    //              $('.totalAmount').html(parseFloat(Total).toFixed(2));
    //          }
    //          }else{
    //              var subTotal=0;
    //              $('.totalDiscount').html((parseFloat(subTotal).toFixed(2)));
    //              var subTotal = $('.subTotal').text();
    //              $('.totalAmount').html(parseFloat(subTotal).toFixed(2));
    //          }
    //         }
    //                     return true;
    //                  }else
    //                  {
                       
    //                     return true;
    //                  }
    //                  var amtTotal =  $('.amount').text();
    //                   $('.subTotal').text(u_price);
    //                   var subTotal =  $('.subTotal').text();
    //                  $(this).parent().parent().parent().find('.price').val('0.00');
    //                  if(amt != null)
    //                  {
                         
    //                  var Total = parseFloat(subTotal) -  parseFloat(amt);
    //                  $('.totalAmount').html(parseFloat(Total).toFixed(2));
    //                   $('.totalDiscount').html(parseFloat(amt).toFixed(2));
    //                 }else{
    //                   $('.totalAmount').html(parseFloat(subTotal).toFixed(2)); 
    //                 }
                    
    //              }
    //               else if(type == 'EURO')
    //               {
    //                   $('.cSymbol').text('€')
    //                   if(euro>0){
    //                     $(this).parent().parent().parent().find('.price').empty();
    //                     $(this).parent().parent().parent().find('.price').val(euro); 
    //                     $('.amount').text(euro);
    //                     $('.subTotal').text(euro);
    //                     $('.totalAmount').html(parseFloat(euro).toFixed(2));
                       
    //                       var Mamt = $('#mDiscount').val();
    //          var Dtype = $('#selectOption').val();
           
    //         if(Mamt != ''){
            
    //          if(Mamt != '')
    //          {
    //              if(Dtype == 'flat')
    //          {
    //              var subTotal =  $('.subTotal').text();
    //              alert(subTotal)
    //              var Total = parseFloat(subTotal) -  parseFloat(Mamt);
    //              $('.totalAmount').html(parseFloat(Total).toFixed(2));
    //               $('.totalDiscount').html(parseFloat(Mamt).toFixed(2));
    //          }else
    //          {
                 
    //              var subTotal = $('.subTotal').text();
    //              var Total = (parseFloat(subTotal) - parseFloat(subTotal)* parseFloat(Mamt)/100);
    //               $('.totalDiscount').html((parseFloat(subTotal)* parseFloat(amt)/100).toFixed(2));
    //              $('.totalAmount').html(parseFloat(Total).toFixed(2));
    //          }
    //          }else{
    //              var subTotal=0;
    //              $('.totalDiscount').html((parseFloat(subTotal).toFixed(2)));
    //              var subTotal = $('.subTotal').text();
    //              $('.totalAmount').html(parseFloat(subTotal).toFixed(2));
    //          }
    //         }
    //                     return true;
    //                  }
    //                  else{
    //                     return true;
    //                  }
    //                   var amtTotal =  $('.amount').text();
    //                   $('.subTotal').text(e_price);
    //                   var subTotal =  $('.subTotal').text();
    //                  $(this).parent().parent().parent().find('.price').val('0.00');
    //                  var subTotal =  $('.subTotal').text();
    //                 if(amt != null)
    //                  {
    //                  var Total = parseFloat(subTotal) -  parseFloat(amt);
    //                  $('.totalAmount').html(parseFloat(Total).toFixed(2));
    //                   $('.totalDiscount').html(parseFloat(amt).toFixed(2));
    //                 }else{
                      
    //                   $('.totalAmount').html(parseFloat(subTotal).toFixed(2)); 
    //                 }
    //              }
    //          else{
    //              $('.cSymbol').text('<?php echo e(\Auth::user()->currencySymbol()); ?>')
    //              if(price>0){
    //                     $(this).parent().parent().parent().find('.price').empty();
    //                     $(this).parent().parent().parent().find('.price').val(price); 
    //                     $('.amount').text(price);
    //                     $('.subTotal').text(price);
    //                     $('.totalAmount').html(parseFloat(price).toFixed(2));
                       
    //                       var Mamt = $('#mDiscount').val();
    //         var Dtype = $('#selectOption').val();
    //         if(Mamt != ''){
            
    //          if(Mamt != '')
    //          {
    //              if(Dtype == 'flat')
    //          {
    //              var subTotal =  $('.subTotal').text();
    //              alert(subTotal)
    //              var Total = parseFloat(subTotal) -  parseFloat(Mamt);
    //              $('.totalAmount').html(parseFloat(Total).toFixed(2));
    //               $('.totalDiscount').html(parseFloat(Mamt).toFixed(2));
    //          }else
    //          {
                 
    //              var subTotal = $('.subTotal').text();
    //              var Total = (parseFloat(subTotal) - parseFloat(subTotal)* parseFloat(Mamt)/100);
    //               $('.totalDiscount').html((parseFloat(subTotal)* parseFloat(amt)/100).toFixed(2));
    //              $('.totalAmount').html(parseFloat(Total).toFixed(2));
    //          }
    //          }else{
    //              var subTotal=0;
    //              $('.totalDiscount').html((parseFloat(subTotal).toFixed(2)));
    //              var subTotal = $('.subTotal').text();
    //              $('.totalAmount').html(parseFloat(subTotal).toFixed(2));
    //          }
    //         }
    //                     return true;
    //                  }else{
                         
                        
    //                     return true;
    //                  }
    //              $(this).parent().parent().parent().find('.price').val(m_price);
    //              var subTotal = $('.subTotal').text(m_price);
    //              $('.amount').text(m_price);
    //              $('.totalAmount').text(m_price);
    //          }
    //          }else{
    //              var subTotal=0;
    //              $('.totalDiscount').html((parseFloat(subTotal).toFixed(2)));
    //              var subTotal = $('.subTotal').text();
    //              $('.totalAmount').html(parseFloat(subTotal).toFixed(2));
    //          }
            
    //         //  $('.subTotal').html(subTotal.toFixed(2));
    //         //  $('.totalAmount').html(subTotal.toFixed(2)); 
          
    //      });
    $(document).on('change', '#selectOption', function () {
             var type = $('#selectOption').val();
             var amt = $(this).parent().parent().parent().find('.manual_discount').val();
            
             var el = $(this);
            
             if(amt != '')
             {
                 if(type == 'flat')
             {
                 var subTotal =  $('.subTotal').text();
                 var Total = parseFloat(subTotal) -  parseFloat(amt);
                 $('.totalAmount').html(parseFloat(Total).toFixed(2));
                  $('.totalDiscount').html(parseFloat(amt).toFixed(2));
             }else
             {
                 
                 var subTotal = $('.subTotal').text();
                 var Total = (parseFloat(subTotal) - parseFloat(subTotal)* parseFloat(amt)/100);
                  $('.totalDiscount').html((parseFloat(subTotal)* parseFloat(amt)/100).toFixed(2));
                 $('.totalAmount').html(parseFloat(Total).toFixed(2));
             }
             }else{
                 var subTotal=0;
                 $('.totalDiscount').html((parseFloat(subTotal).toFixed(2)));
                 var subTotal = $('.subTotal').text();
                 $('.totalAmount').html(parseFloat(subTotal).toFixed(2));
             }
            
            //  $('.subTotal').html(subTotal.toFixed(2));
            //  $('.totalAmount').html(subTotal.toFixed(2)); 
         });     
    
    //new code for multiple functionality start
    
    // $(document).on('change', '.group-material-0', function () {
    //     var id = $(this).val();
    //     // var el = $(this);
    //   if(id != 0)
    //   {
    //     console.log("oldpro"+oldPrice+"oldamt"+oldAmount+"oldpr"+newPrice)
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //      ($(this).parent().parent().parent().parent().find('.group-material-1')).removeAttr('disabled');
       
    //     var el = $(this);
    //     var oldPrice = (el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //     var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //     var newPrice = ($(this).parent().find('.selected_price')).val();
    //      if(parseFloat(oldAmount) >= parseFloat(newPrice) && parseFloat(oldPrice) >= parseFloat(newPrice))
    //     {   
    //     //     alert("yes")
    //     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //      }
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //             "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //                 //  var firstChild = $('#specification-materials').children().first();
    //                 //  firstChild.after(data);
    //                 // $('#specification-materials').append(data);
    //                     var sum = 0;
    //                     console.log("ygjj"+data);
                            
    //                         $(el.parent().find('.selected_price')).val(data.price)
    //                         var priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                         var amtAdd = $(".amount");
    //                         var totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                       
    //                         $("#unit_rate").val(sum);
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                     $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                          var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
                            
    //                          var arr2 = serise.split(':');
    //                          var arr = serise.split('-');
                             
                            
    //                          arr[0] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                          console.log(finalval)
    //                         if(arr.length  >= 1)
    //                         {
                               
    //                           var innns = $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(arr2[0]+':'+finalval); 
    //                         }else
    //                         {
                               
    //                             $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }
    //                         // var serise =  $(".ordering-serise").val();
    //                         // var value = $(this).val();
    //                         // $('.prefix-input').each(function(){
    //                         // var value = $(this).val(); // Parse the value to float
                           
    //                         // $(".ordering-serise").val(serise+': '+value);
    //                         // if (!isNaN(value)) { // Check if the value is a valid number
    //                         //     serise = serise+': '+value;
                                
    //                         // }
    //                         // });
    //                           var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
    //                         var idValue =$(this).attr('id');

    //                         if (idValue === 'print_img') {
    //                             // Do something if the id value matches the desired value
    //                             $('#image-preview').removeClass('d-none');
    //                         }
                            
                           
               
    //         }

    //     });
    //   }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    // });
    // $(document).on('change', '.group-material-1', function () {
    //     var id = $(this).val();
    //     if(id != 0)
    //     {
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //      ($(this).parent().parent().parent().parent().find('.group-material-2')).removeAttr('disabled');
    //     // $('.group-material-2').removeAttr('disabled');
    //     var el = $(this);
    //     var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //     var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //     var newPrice = $(el.parent().find('.selected_price')).val();
    //     if(parseFloat(oldAmount) >= parseFloat(newPrice) && parseFloat(oldPrice) >= parseFloat(newPrice))
    //     {   
    //     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //     }
    //     console.log("oldpro"+oldPrice+"oldamt"+parseFloat(oldAmount)+"oldpr"+newPrice)
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // var firstChild = $('#specification-materials').children().first();
    //             //      firstChild.after(data);
    //              console.log(data);
    //                 var sum = 0;
    //                 var qty = 0;
                    
    //                         $(el.parent().find('.selected_price')).val(data.price)
                           
    //                         var priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                         var amtAdd = $(".amount");
    //                         var totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                           
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                         var serise =  $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
    //                         //  var serise =  $("#ordering-serise").val();
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[1] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 2)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val(serise+'-'+data.prefix); 
    //                         }
    //                       var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
    //                         var idValue =$(this).attr('id');

    //                         if (idValue === 'print_img') {
    //                             // Do something if the id value matches the desired value
    //                             $('#image-preview').removeClass('d-none');
    //                         }
               
    //         }

    //     }); 
            
    //     }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
        
    // });
    // $(document).on('change', '.group-material-2', function () {
    //     var id = $(this).val();
    //     var type = $(this).data('id');
    //     if(id != 0)
    //     {
    //     var idValue =$(this).attr('id');
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //      ($(this).parent().parent().parent().parent().find('.group-material-3')).removeAttr('disabled');
    //      var el = $(this);
    //         var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //         var newPrice = $(el.parent().find('.selected_price')).val();
    //         if(parseFloat(oldAmount) >= parseFloat(newPrice) && parseFloat(oldPrice) >= parseFloat(newPrice))
    //         {   
    //         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //         }
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //               var firstChild = $('#specification-materials').children().first();
    //                  firstChild.after(data);
    //                 var sum = 0;
    //                 var qty = 0;
                     
    //                         $(el.parent().find('.selected_price')).val(data.price)
    //                         var priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                         var amtAdd = $(".amount");
    //                         var totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         // $("#total_price").val(sum);
    //                         // $("#unit_rate").val(sum);
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                         // var serise =  $("#ordering-serise").val();
    //                         var serise =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
    //                         //  var serise =  $("#ordering-serise").val();
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[2] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 3)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val(serise+'-'+data.prefix); 
    //                         }
    //                         var idValue =$(this).attr('id');
    //                         var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
    //                         if (idValue === 'print_img') {
    //                             // Do something if the id value matches the desired value
    //                             $('#image-preview').removeClass('d-none');
    //                         }
               
    //         }

    //     }); 
         
    //  }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    // });
    // $(document).on('change', '.group-material-3', function () {
    //     var id = $(this).val();
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //      if(id != 0)
    //     {            
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //      ($(this).parent().parent().parent().parent().find('.group-material-4')).removeAttr('disabled');
    //      var el = $(this);
    //      var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //         var newPrice = $(el.parent().find('.selected_price')).val();
    //         if(parseFloat(oldAmount) >= parseFloat(newPrice) && parseFloat(oldPrice) >= parseFloat(newPrice))
    //         {   
    //         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //         }
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //                 var firstChild = $('#specification-materials').children().first();
    //                  firstChild.after(data);
    //                 var sum = 0;
                  
    //                         $(el.parent().find('.selected_price')).val(data.price)
    //                   var priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                         var amtAdd = $(".amount");
    //                         var totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         // $("#total_price").val(sum);
    //                         // $("#unit_rate").val(sum);
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
                           
    //                         // $('.prefix-input').each(function(index, value){
    //                         // var value = $(this).val(); // Parse the value to float
    //                         var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
    //                         //  var serise =  $("#ordering-serise").val();
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[3] = data.prefix;
    //                          var finalval = (arr.join("-")); 
                            
    //                         if(arr.length  >= 4)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(serise+'-'+data.prefix); 
    //                         }
    //                         var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
                                

                           
               
    //         }

    //     }); 
         
    //  }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    // });
    // $(document).on('change', '.group-material-4', function () {
    //     var id = $(this).val();
    //     var type = $(this).data('id');
    //     var tab = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //      if(id != 0)
    //     {            
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     $(".comm-div").addClass('d-none');
    //     ($(this).parent().parent().parent().parent().find('.group-material-5')).removeAttr('disabled');
    //     var el = $(this);
            
    //         var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //         var newPrice = $(el.parent().find('.selected_price')).val();
    //         if(parseFloat(oldAmount) >= parseFloat(newPrice) && parseFloat(oldPrice) >= parseFloat(newPrice))
    //         {   
    //         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //         }
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //                 var firstChild = $('#specification-materials').children().first();
    //                  firstChild.after(data);
    //                 var sum = 0;
                   
    //                      $(el.parent().find('.selected_price')).val(data.price)
    //                   var priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                         var amtAdd = $(".amount");
    //                         var totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         // $("#total_price").val(sum
    //                         // $("#unit_rate").val(sum);
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                         var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
    //                         //  var serise =  $("#ordering-serise").val();
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[4] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 5)
    //                         {
    //                           var innns = $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(serise+'-'+data.prefix); 
    //                         }
    //                         var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
               
    //         }

    //     }); 
         
    //  }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    // });
    // $(document).on('change', '.group-material-5', function () {
    //     var id = $(this).val();
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //      if(id != 0)
    //     {          
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //     ($(this).parent().parent().parent().parent().find('.group-material-6')).removeAttr('disabled');
    //      var el = $(this);  
    //         var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //         var newPrice = $(el.parent().find('.selected_price')).val();
    //         if(parseFloat(oldAmount) >= parseFloat(newPrice) && parseFloat(oldPrice) >= parseFloat(newPrice))
    //         {   
    //         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //         }
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //                 var firstChild = $('#specification-materials').children().first();
    //                  firstChild.after(data);
    //                 var sum = 0;
                    
    //                         $(el.parent().find('.selected_price')).val(data.price)
    //                   var priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                         var amtAdd = $(".amount");
    //                         var totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         // $("#total_price").val(sum)
    //                         // $("#unit_rate").val(sum)
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                          var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
    //                         //  var serise =  $("#ordering-serise").val().
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[5] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 6)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent.find(".ordering-serise")).val(serise+'-'+data.prefix); 
    //                         }
    //                       var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
               
    //         }

    //     }); 
         
    //  }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    //  });
    // $(document).on('change', '.group-material-6', function () {
    //     var id = $(this).val();
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //      if(id != 0)
    //     {
    //       var el = $(this);           
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //         var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //         var newPrice = $(el.parent().find('.selected_price')).val();
    //         if(parseFloat(oldAmount) >= parseFloat(newPrice) && parseFloat(oldPrice) >= parseFloat(newPrice))
    //         {   
    //         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //         }
    //     $(".comm-div").addClass('d-none');
    //     ($(this).parent().parent().parent().parent().find('.group-material-7')).removeAttr('disabled');
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //                 var firstChild = $('#specification-materials').children().first();
    //                  firstChild.after(data);
    //                 var sum = 0;
    //                         $(el.parent().find('.selected_price')).val(data.price)
    //                         var priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                         var amtAdd = $(".amount");
    //                         var totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         // $("#total_price").val(sum)
    //                         // $("#unit_rate").val(sum)
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                         var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
    //                         //  var serise =  $("#ordering-serise").val();
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[6] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 7)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(serise+'-'+data.prefix); 
    //                         }
    //                         var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
                           
               
    //         }

    //     }); 
          
    //   }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    //  });
    // $(document).on('change', '.group-material-7', function () {
    //     var id = $(this).val();
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //      if(id != 0)
    //     {
    //      var el = $(this);            
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //     var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //         var newPrice = $(el.parent().find('.selected_price')).val();
    //         if(parseFloat(oldAmount) >= parseFloat(newPrice) && parseFloat(oldPrice) >= parseFloat(newPrice))
    //         {   
    //         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //         }
    //     ($(this).parent().parent().parent().parent().find('.group-material-8')).removeAttr('disabled');
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //                 var firstChild = $('#specification-materials').children().first();
    //                  firstChild.after(data);
    //                 var sum = 0;
    //                         $(el.parent().find('.selected_price')).val(data.price)
    //                         var priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                         var amtAdd = $(".amount");
    //                         var totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                          var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
    //                         //  var serise =  $("#ordering-serise").val();
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[7] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 8)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(serise+'-'+data.prefix); 
    //                         }
    //                         var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
                           
               
    //         }

    //     }); 
          
    //   }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    //  });
    // $(document).on('change', '.group-material-8', function () {
    //     var id = $(this).val();
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //      if(id != 0)
    //     {
    //      var el = $(this);            
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //         var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //         var newPrice = $(el.parent().find('.selected_price')).val();
    //         if(parseFloat(oldAmount) >= parseFloat(newPrice) && parseFloat(oldPrice) >= parseFloat(newPrice))
    //         {   
    //         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //         }
    //     ($(this).parent().parent().parent().parent().find('.group-material-9')).removeAttr('disabled');
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //                 // var firstChild = $('#specification-materials').children().first();
    //                 //  firstChild.after(data);
    //                 var sum = 0;
    //                         $(el.parent().find('.selected_price')).val(data.price)
    //                         var priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                         var amtAdd = $(".amount");
    //                         var totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                         var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
    //                         //  var serise =  $("#ordering-serise").val();
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[8] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 9)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(serise+'-'+data.prefix); 
    //                         }
    //                       var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
               
    //         }

    //     });
    //     }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    //  });
    // $(document).on('change', '.group-material-9', function () {
    //     var id = $(this).val();
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //      if(id != 0)
    //     {
    //      var el = $(this);            
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //         var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //         var newPrice = $(el.parent().find('.selected_price')).val();
    //         if(parseFloat(oldAmount) >= parseFloat(newPrice) && parseFloat(oldPrice) >= parseFloat(newPrice))
    //         {   
    //         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //         }
    //     ($(this).parent().parent().parent().parent().find('.group-material-9')).removeAttr('disabled');
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //                 // var firstChild = $('#specification-materials').children().first();
    //                 //  firstChild.after(data);
    //                 var sum = 0;
    //                         $(el.parent().find('.selected_price')).val(data.price)
    //                         var priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                         var amtAdd = $(".amount");
    //                         var totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                         var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
    //                         //  var serise =  $("#ordering-serise").val();
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[9] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 10)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(serise+'-'+data.prefix); 
    //                         }
    //                       var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
               
    //         }

    //     });
    //     }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    //  });
    // $(document).on('change', '.group-material-10', function () {
    //     var id = $(this).val();
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //      if(id != 0)
    //     {
    //      var el = $(this);            
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //         var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //         var newPrice = $(el.parent().find('.selected_price')).val();
    //         if(parseFloat(oldAmount) >= parseFloat(newPrice) && parseFloat(oldPrice) >= parseFloat(newPrice))
    //         {   
    //         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //         }
    //     ($(this).parent().parent().parent().parent().find('.group-material-9')).removeAttr('disabled');
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //                 // var firstChild = $('#specification-materials').children().first();
    //                 //  firstChild.after(data);
    //                 var sum = 0;
    //                 alert(data.price)
    //                         $(el.parent().find('.selected_price')).val(data.price)
    //                         var priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                         var amtAdd = $(".amount");
    //                         var totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                         var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
    //                         //  var serise =  $("#ordering-serise").val();
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[10] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 11)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(serise+'-'+data.prefix); 
    //                         }
    //                       var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
               
    //         }

    //     });
    //     }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    //  });
    //end multiple functionality for variance
    
    // $(document).on('change', '.group-material-0', function () {
    //      var el = $(this);
    //      var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
    //      var arrs = serises.split('-');  
    //     var id = $(this).val();
    //     // alert(id)
    //     $('#group-material-1').removeClass('d-none');  
    //     if(id != 0)
    //     {
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //      ($(this).parent().parent().parent().parent().find('.group-material-1')).removeAttr('disabled');
    //         // var el = $(this);
    //         var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
    //         var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()  
    //         var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
    //         var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
    //         var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
            
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //             "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //                 //  var firstChild = $('#specification-materials').children().first();
    //                 //  firstChild.after(data);
    //                 // $('#specification-materials').append(data);
    //                     var sum = 0;
    //                     var totalAdd = '0.00';
    //                     var priceAdd = '0.00';
                        
    //                         var amtAdd = $(".amount");
                       
    //                         $("#unit_rate").val(sum);
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                     $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                          var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
                             
    //                          var arr2 = serise.split(':');
    //                          var arr = serise.split('-');
    //                         console.log("dfgfdss"+serise)
    //                          arr[0] = data.prefix;
    //                           console.log("dfgfdss"+data.prefix)
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >=1)
    //                         {
    //                           var innns = $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(arr2[0]+':'+finalval); 
    //                         }else
    //                         {
    //                             $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(data.prefix); 
    //                         }
                            
    //                       if(arrs.length  >1)
    //                         {
                             
                                
    //                           var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
    //                           if(currency == 'USD'){
                                   
    //                                  var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     { 
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }   
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
    //                                     }   
    //                                 }else{
    //                                 var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                       
    //                                     if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
    //                                     {   
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //                                     }  
    //                                   if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     {  
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                          $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                     }  
    //                                   if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                         $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                         priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                         totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                     }  
    //                                 }
    //                                  if(currency == 'USD'){
                                
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price) 
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                                      priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                 }else{
                                       
    //                                     $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                 //   alert(totalAddInr)
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
    //                                 }
                                    
                           
                                     
    //                         }
    //                         else
    //                             {
                                    
    //                               var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
    //                           if(currency == 'USD'){
                                   
    //                                  var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     { 
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }   
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
    //                                     }   
    //                                 }else{
    //                                 var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                     if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
    //                                     {   
                                          
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //                                     }  
    //                                   if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     {  
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                          $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                     }  
    //                                   if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                         $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                         priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                         totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                     }  
    //                                 }
    //                             if(currency == 'USD'){
                               
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                     
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                         }else if(currency == 'EURO')
    //                         {
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                           var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                           var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                    
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                         }else{
                                
    //                             $(el.parent().find('.selected_price')).val(data.price) 
    //                             $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                     
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         }
    //                          var amtAdd = $(".amount");
    //                         }
    //                           var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
    //                         var idValue =$(this).attr('id');

    //                         if (idValue === 'print_img') {
    //                             // Do something if the id value matches the desired value
    //                             $('#image-preview').removeClass('d-none');
    //                         }
                            
                           
               
    //         }

    //     });
        
    //     }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    // });
    // $(document).on('change', '.group-material-1', function () {
    //      var el = $(this);
    //      var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
    //      var arrs = serises.split('-');
    //     var id = $(this).val();
    //     $('#group-material-2').removeClass('d-none');  
    //     if(id != 0)
    //     {
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //      ($(this).parent().parent().parent().parent().find('.group-material-2')).removeAttr('disabled');
    //      var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
    //     var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()  
    //     var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
    //     var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //     var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //     var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
            
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // var firstChild = $('#specification-materials').children().first();
    //             //      firstChild.after(data);
    //              console.log(data);
    //                     var sum = 0;
    //                     var qty = 0;
    //                     var totalAdd = '0.00';
    //                     var priceAdd = '0.00';
                           
    //                         var amtAdd = $(".amount");
                           
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                         var serise =  $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
    //                         //  var serise =  $("#ordering-serise").val();
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[1] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 2)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val(serise+'-'+data.prefix); 
    //                         }
    //                       if(arrs.length  > 1)
    //                         {
    //                           var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
    //                             if(currency == 'USD'){
                                   
    //                                  var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     { 
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }   
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
    //                                     }   
    //                                 }else{
    //                                 var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                     if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
    //                                     {   
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //                                     }  
    //                                   if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     {  
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                          $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                     }  
    //                                   if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                         $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                         priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                         totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                     }  
    //                                 }
    //                                  if(currency == 'USD'){
                                
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price) 
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                                      priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                 }else{
                                       
    //                                     $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                     
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
    //                                 }
                                    
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                     
    //                         }
    //                         else
    //                             {
                               
    //                             var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
                            
    //                             if(currency == 'USD'){
                               
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                     
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                         }else if(currency == 'EURO')
    //                         {
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                    
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                         }else{
                                
    //                             $(el.parent().find('.selected_price')).val(data.price) 
    //                             $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         }
    //                          var amtAdd = $(".amount");
    //                         }
    //                       var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                           var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
    //                         var idValue =$(this).attr('id');

    //                         if (idValue === 'print_img') {
    //                             // Do something if the id value matches the desired value
    //                             $('#image-preview').removeClass('d-none');
    //                         }
               
    //         }

    //     });
    //     }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    // });
    // $(document).on('change', '.group-material-2', function () {
    //      var el = $(this);
    //      var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
    //      var arrs = serises.split('-');
       
    //      $('#group-material-3').removeClass('d-none');                     
    //     var id = $(this).val();
    //     var type = $(this).data('id');
    //     if(id != 0)
    //     {
    //     // var el = $(this);
    //     var idValue =$(this).attr('id');
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //      ($(this).parent().parent().parent().parent().find('.group-material-3')).removeAttr('disabled');
        
    //       var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
    //       var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
    //       var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //       var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
    //       var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
    //       var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //               var firstChild = $('#specification-materials').children().first();
    //                  firstChild.after(data);
    //                 var sum = 0;
    //                 var qty = 0;
    //                         var totalAdd = '0.00';
    //                         var priceAdd = '0.00';
                           
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                         // var serise =  $("#ordering-serise").val();
    //                         var serise =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
    //                         //  var serise =  $("#ordering-serise").val();
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[2] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                          console.log("dgg"+serise)
                            
                             
    //                         if(arr.length  >= 3)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val(finalval); 
                                
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val(serise+'-'+data.prefix); 
                                 
    //                         }
                            
    //                         if(arrs.length  > 2)
    //                         {
    //                           var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
    //                             if(currency == 'USD'){
                                   
    //                                  var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     { 
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }   
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
    //                                     }   
    //                                 }else{
    //                                 var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                     if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
    //                                     {   
                                          
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //                                     }  
    //                                   if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     {  
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                          $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                     }  
    //                                   if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                         $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                         priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                         totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                     }  
    //                                 }
    //                                  if(currency == 'USD'){
                                
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price) 
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                                      priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                 }else{
                                       
    //                                     $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
    //                                 }
                                      
                                      
                                    
    //                         }
    //                         else
    //                             {
                                  
    //                             var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
                           
    //                             if(currency == 'USD'){
                               
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                       
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                         }else if(currency == 'EURO')
    //                         {
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                     
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                         }else{
                                
    //                             $(el.parent().find('.selected_price')).val(data.price) 
    //                             $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         }
    //                          var amtAdd = $(".amount");
    //                         }
    //                         var idValue =$(this).attr('id');
    //                         var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
    //                         if (idValue === 'print_img') {
    //                             // Do something if the id value matches the desired value
    //                             $('#image-preview').removeClass('d-none');
    //                         }
               
    //         }

    //     });
    //  }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    // });
    // $(document).on('change', '.group-material-3', function () {
    //     var el = $(this);
    //     var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
    //     var arrs = serises.split('-');
    //     var id = $(this).val();
    //     $('#group-material-4').removeClass('d-none');  
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //      if(id != 0)
    //      {
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //      ($(this).parent().parent().parent().parent().find('.group-material-4')).removeAttr('disabled');
    //     //  var el = $(this);
    //         var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
    //         var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //         var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
    //         var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
    //         var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
            
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //                 var firstChild = $('#specification-materials').children().first();
    //                  firstChild.after(data);
    //                 var sum = 0;
    //                     var totalAdd = '0.00';
    //                         var priceAdd = '0.00';
                       
                           
    //                         var amtAdd = $(".amount");
                           
                           
    //                         // $("#total_price").val(sum);
    //                         // $("#unit_rate").val(sum);
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
                           
    //                         // $('.prefix-input').each(function(index, value){
    //                         // var value = $(this).val(); // Parse the value to float
    //                         var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
    //                         //  var serise =  $("#ordering-serise").val();
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[3] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 4)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(serise+'-'+data.prefix); 
    //                         }
    //                           if(arrs.length  > 3)
    //                         {
    //                           var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
    //                             if(currency == 'USD'){
                                   
    //                                  var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     { 
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }   
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
    //                                     }   
    //                                 }else{
    //                                 var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                     if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
    //                                     {   
                                          
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //                                     }  
    //                                   if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     {  
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                          $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                     }  
    //                                   if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                         $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                         priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                         totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                     }  
    //                                 }
    //                                  if(currency == 'USD'){
                                
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price) 
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                                      priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                 }else{
                                       
    //                                     $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
    //                                 }
                                    
                           
                                     
    //                         }
    //                         else
    //                             {
                                  
    //                             var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
                            
    //                             if(currency == 'USD'){
                               
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                       
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                         }else if(currency == 'EURO')
    //                         {
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                         }else{
                                
    //                             $(el.parent().find('.selected_price')).val(data.price) 
    //                             $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         }
    //                          var amtAdd = $(".amount");
    //                         }
    //                       var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));

                           
               
    //         }

    //     });
    //      }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
        
    // });
    // $(document).on('change', '.group-material-4', function () {
    //         var el = $(this);
    //         var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
    //         var arrs = serises.split('-');
    //         var id = $(this).val();
    //         var type = $(this).data('id');
    //         var idValue =$(this).attr('id');
    //         $('#group-material-5').removeClass('d-none');  
    //      if(id != 0)
    //      {
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //     ($(this).parent().parent().parent().parent().find('.group-material-5')).removeAttr('disabled');
    //     //  var el = $(this);  
    //         var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
    //         var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //         var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
    //         var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
    //         var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val() 
    //         $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //                 var firstChild = $('#specification-materials').children().first();
    //                  firstChild.after(data);
    //                 var sum = 0;
    //                     var totalAdd = '0.00';
    //                         var priceAdd = '0.00';
                       
                           
    //                         var amtAdd = $(".amount");
                           
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                          var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
    //                         //  var serise =  $("#ordering-serise").val().
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[4] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 5)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent.find(".ordering-serise")).val(serise+'-'+data.prefix); 
    //                         }
    //                          if(arrs.length  > 4)
    //                         {
    //                           var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
    //                           if(currency == 'USD'){
                                   
    //                                  var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     { 
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }   
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
    //                                     }   
    //                                 }else{
    //                                 var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                     if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
    //                                     {   
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //                                     }  
    //                                   if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     {  
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                          $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                     }  
    //                                   if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                         $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                         priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                         totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                     }  
    //                                 }
    //                                  if(currency == 'USD'){
                                
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price) 
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                                      priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                 }else{
                                       
    //                                     $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))

    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
    //                                 }
                                    
                           
                                     
    //                         }
    //                         else
    //                             {
                                  
    //                              var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
                            
    //                             if(currency == 'USD'){
                               
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                         }else if(currency == 'EURO')
    //                         {
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                         }else{
                                
    //                             $(el.parent().find('.selected_price')).val(data.price) 
    //                             $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                     
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         }
    //                          var amtAdd = $(".amount");
    //                         }
    //                       var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                           var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
               
    //         }

    //     });
    //      }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    //  });
    // $(document).on('change', '.group-material-5', function () {
    //      var el = $(this);
    //      var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
    //      var arrs = serises.split('-');
    //     var id = $(this).val();
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //     $('#group-material-6').removeClass('d-none');  
    //      if(id != 0)
    //      {
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //     ($(this).parent().parent().parent().parent().find('.group-material-6')).removeAttr('disabled');
    //     //  var el = $(this);  
    //         var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
    //         var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //         var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
    //         var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
    //         var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val() 
            
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //                 var firstChild = $('#specification-materials').children().first();
    //                  firstChild.after(data);
    //                 var sum = 0;
    //                     var totalAdd = '0.00';
    //                         var priceAdd = '0.00';
    //                         var amtAdd = $(".amount");
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                          var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
    //                         //  var serise =  $("#ordering-serise").val().
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[5] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 6)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent.find(".ordering-serise")).val(serise+'-'+data.prefix); 
    //                         }
    //                           if(arrs.length  > 5)
    //                         {
    //                           var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
    //                           if(currency == 'USD'){
                                   
    //                                  var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     { 
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }   
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
    //                                     }   
    //                                 }else{
    //                                 var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                     if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
    //                                     {   
                                        
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //                                     }  
    //                                   if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     {  
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                          $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                     }  
    //                                   if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                         $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                         priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                         totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                     }  
    //                                 }
    //                                  if(currency == 'USD'){
                                
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price) 
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                                      priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                 }else{
                                       
    //                                     $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                     
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
    //                                 }
                           
                                     
    //                         }
    //                         else
    //                             {
                                  
    //                             var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
                           
    //                             if(currency == 'USD'){
                               
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                         }else if(currency == 'EURO')
    //                         {
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                         }else{
                                
    //                             $(el.parent().find('.selected_price')).val(data.price) 
    //                             $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                     
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         }
    //                          var amtAdd = $(".amount");
    //                         }
    //                       var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                           var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
               
    //         }

    //     });
    //      }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    //  });
    // $(document).on('change', '.group-material-6', function () {
    //      var el = $(this);
    //      var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
    //      var arrs = serises.split('-');  
    //     var id = $(this).val();
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //     $('#group-material-7').removeClass('d-none');  
    //     if(id != 0)
    //     {
    //     //   var el = $(this);           
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //     ($(this).parent().parent().parent().parent().find('.group-material-7')).removeAttr('disabled');
    //         var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
    //         var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //         var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
    //         var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
    //         var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val() 
            
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //                 var firstChild = $('#specification-materials').children().first();
    //                  firstChild.after(data);
    //                 var sum = 0;
    //                         var totalAdd = '0.00';
    //                         var priceAdd = '0.00';
                       
    //                         var amtAdd = $(".amount");
                           
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                         var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
    //                         //  var serise =  $("#ordering-serise").val();
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[6] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 7)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(serise+'-'+data.prefix); 
    //                         }
    //                         if(arrs.length  > 6)
    //                         {
    //                           var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
    //                           if(currency == 'USD'){
                                   
    //                                  var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     { 
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }   
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
    //                                     }   
    //                                 }else{
    //                                 var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                     if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
    //                                     {   
                                         
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //                                     }  
    //                                   if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     {  
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                          $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                     }  
    //                                   if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                         $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                         priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                         totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                     }  
    //                                 }
    //                                  if(currency == 'USD'){
                                
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price) 
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                                      priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                 }else{
                                       
    //                                     $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
    //                                 }
                                    
                           
                                     
    //                         }
    //                         else
    //                             {
                                  
    //                              var totalAddUsd = 0;
    //                              var  totalAddEuro = 0;
                            
    //                             if(currency == 'USD'){
                               
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                     
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                         }else if(currency == 'EURO')
    //                         {
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                         }else{
                                
    //                             $(el.parent().find('.selected_price')).val(data.price) 
    //                             $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                       
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         }
    //                          var amtAdd = $(".amount");
    //                         }
    //                         var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
                           
               
    //         }

    //     });
    //     }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    //  });
     
    // $(document).on('change', '.group-material-7', function () {
    //      var el = $(this);
    //      var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
    //      var arrs = serises.split('-');
    //     var id = $(this).val();
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //     $('#group-material-8').removeClass('d-none');  
    //     if(id != 0)
    //     {
    //     //  var el = $(this);            
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //     ($(this).parent().parent().parent().parent().find('.group-material-8')).removeAttr('disabled');
    //         var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
    //         var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //         var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
    //         var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
    //         var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val() 
            
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //                 var firstChild = $('#specification-materials').children().first();
    //                  firstChild.after(data);
    //                 var sum = 0;
    //                         var totalAdd = '0.00';
    //                         var priceAdd = '0.00';
                       
    //                         var amtAdd = $(".amount");
                           
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                          var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
    //                         //  var serise =  $("#ordering-serise").val();
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[7] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 8)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(serise+'-'+data.prefix); 
    //                         }
    //                         if(arrs.length  > 7)
    //                         {
    //                           var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
    //                           if(currency == 'USD'){
                                   
    //                                  var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     { 
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }   
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
    //                                     }   
    //                                 }else{
    //                                 var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                     if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
    //                                     {   
                                         
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //                                     }  
    //                                   if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     {  
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                          $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                     }  
    //                                   if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                         $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                         priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                         totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                     }  
    //                                 }
    //                                  if(currency == 'USD'){
                                
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price) 
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                                      priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                 }else{
                                       
    //                                     $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
    //                                 }
                                    
                           
                                     
    //                         }
    //                         else
    //                             {
                                  
    //                             var totalAddUsd = 0;
    //                             var  totalAddEuro = 0;
                            
    //                             if(currency == 'USD'){
                               
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                       
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                         }else if(currency == 'EURO')
    //                         {
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                         }else{
                                
    //                             $(el.parent().find('.selected_price')).val(data.price) 
    //                             $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                     
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         }
    //                          var amtAdd = $(".amount");
    //                         }
    //                         var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
                           
               
    //         }

    //     });
    //     }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    //  });
    // $(document).on('change', '.group-material-8', function () {
    //      var el = $(this);
    //      var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
    //      var arrs = serises.split('-');
    //     var id = $(this).val();
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //     $('#group-material-9').removeClass('d-none');  
    //     if(id != 0)
    //     {
    //     //  var el = $(this);            
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //     ($(this).parent().parent().parent().parent().find('.group-material-9')).removeAttr('disabled');
    //     var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
    //     var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
    //     var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //     var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
    //     var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
    //     var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
            
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //                 // var firstChild = $('#specification-materials').children().first();
    //                 //  firstChild.after(data);
    //                 var sum = 0;
    //                         var totalAdd = '0.00';
    //                         var priceAdd = '0.00';
                       
    //                         var amtAdd = $(".amount");
                            
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                         var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
    //                         //  var serise =  $("#ordering-serise").val();
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[8] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 9)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(serise+'-'+data.prefix); 
    //                         }
    //                          if(arrs.length  > 8)
    //                         {
    //                           var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
    //                             if(currency == 'USD'){
                                   
    //                                  var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     { 
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }   
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
    //                                     }   
    //                                 }else{
    //                                 var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                     if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
    //                                     {   
                                          
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //                                     }  
    //                                   if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     {  
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                          $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                     }  
    //                                   if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                         $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                         priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                         totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                     }  
    //                                 }
    //                                  if(currency == 'USD'){
                                
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price) 
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                                      priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                 }else{
                                       
    //                                     $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
    //                                 }
                                    
                           
                                     
    //                         }
    //                         else
    //                             {
                                  
    //                             var totalAddUsd = 0;
    //                             var  totalAddEuro = 0;
                           
    //                             if(currency == 'USD'){
                               
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                     
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                         }else if(currency == 'EURO')
    //                         {
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                         }else{
                                
    //                             $(el.parent().find('.selected_price')).val(data.price) 
    //                             $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                     
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         }
    //                          var amtAdd = $(".amount");
    //                         }
    //                         var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
                           
               
    //         }

    //     });
    //     }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    //  });
    // $(document).on('change', '.group-material-9', function () {
    //      var el = $(this);
    //      var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
    //      var arrs = serises.split('-');
    //     var id = $(this).val();
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //     $('#group-material-10').removeClass('d-none');  
    //      if(id != 0)
    //      {
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //     ($(this).parent().parent().parent().parent().find('.group-material-10')).removeAttr('disabled');
    //     //  var el = $(this);  
         
    //         var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
    //         var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //         var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
    //         var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
    //         var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
            
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //                 var firstChild = $('#specification-materials').children().first();
    //                  firstChild.after(data);
    //                 var sum = 0;
    //                     var totalAdd = '0.00';
    //                         var priceAdd = '0.00';
                      
    //                         var amtAdd = $(".amount");
                            
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                          var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
    //                         //  var serise =  $("#ordering-serise").val().
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[9] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 10)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent.find(".ordering-serise")).val(serise+'-'+data.prefix); 
    //                         }
    //                          if(arrs.length  > 9)
    //                         {
    //                           var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
    //                           if(currency == 'USD'){
                                   
    //                                  var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     { 
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }   
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
    //                                     }   
    //                                 }else{
    //                                 var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                     if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
    //                                     {   
                                       
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //                                     }  
    //                                   if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     {  
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                          $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                     }  
    //                                   if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                         $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                         priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                         totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                     }  
    //                                 }
    //                                  if(currency == 'USD'){
                                
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price) 
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                                      priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                 }else{
                                       
    //                                     $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))

    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
    //                                 }
                           
                                     
    //                         }
    //                         else
    //                             {
                                  
    //                             var totalAddUsd = 0;
    //                             var  totalAddEuro = 0;
                            
    //                             if(currency == 'USD'){
                               
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                         }else if(currency == 'EURO')
    //                         {
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                       
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                         }else{
                                
    //                             $(el.parent().find('.selected_price')).val(data.price) 
    //                             $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         }
    //                          var amtAdd = $(".amount");
    //                         }
    //                       var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                           var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
               
    //         }

    //     });
    //      }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    //  });
    // $(document).on('change', '.group-material-10', function () {
    //      var el = $(this);
    //      var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
    //      var arrs = serises.split('-');
    //     var id = $(this).val();
    //     var type = $(this).data('id');
    //     var idValue =$(this).attr('id');
    //     $('#group-material-11').removeClass('d-none');  
    //      if(id != 0)
    //      {
    //      if (idValue === 'print_img') {
    //          // Do something if the id value matches the desired value
    //         $('#image').addClass('d-none')                   
    //         $('#image-preview').removeClass('d-none')
    //                         }
    //     var tab = $(this).data('id');
    //     $(".comm-div").addClass('d-none');
    //     ($(this).parent().parent().parent().parent().find('.group-material-11')).removeAttr('disabled');
    //     //  var el = $(this);  
    //         var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
    //         var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
    //         var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
    //         var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
    //         var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
    //         var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
            
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": type,
    //             "id": id,
    //              "tab":tab,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //             console.log(data);
    //             // $('#specification-materials').empty();
               
    //                 var firstChild = $('#specification-materials').children().first();
    //                  firstChild.after(data);
    //                 var sum = 0;
    //                   var totalAdd = '0.00';
    //                         var priceAdd = '0.00';
                       
    //                         var amtAdd = $(".amount");
                            
    //                         $("#material_cost").val(sum);
    //                         $("#grand_total").val(sum);
    //                         var qty = 0;
    //                         $('.material_quantity').each(function(){
    //                         var value = parseFloat($(this).val()); // Parse the value to float
    //                         if (!isNaN(value)) { // Check if the value is a valid number
    //                             qty += value;
    //                         }
    //                         });
    //                         $("#quantity").val(qty)
    //                          var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
    //                         //  var serise =  $("#ordering-serise").val().
    //                          var arr = serise.split('-');
    //                          var mName = 'LSV';
    //                          arr[10] = data.prefix;
    //                          var finalval = (arr.join("-")); 
    //                         if(arr.length  >= 11)
    //                         {
    //                           var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
    //                         }else
    //                         {
    //                              $(el.parent().parent().parent().parent().parent().parent.find(".ordering-serise")).val(serise+'-'+data.prefix); 
    //                         }
    //                           if(arrs.length  > 10)
    //                         {
                               
    //                             var totalAddUsd = 0;
    //                           var  totalAddEuro = 0;
    //                             if(currency == 'USD'){
                                   
    //                                  var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     { 
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }   
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                   if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
    //                                     }   
    //                                 }else{
    //                                 var newPrice = $(el.parent().find('.selected_price')).val();
    //                                     var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
    //                                     var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
    //                                     if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
    //                                     {   
                                         
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
    //                                     }  
    //                                   if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
    //                                     {  
                                           
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                          $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                     }  
    //                                   if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
    //                                     {   
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
    //                                     // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
    //                                     }else{
    //                                         $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                         priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                         totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                     }  
    //                                 }
    //                                  if(currency == 'USD'){
                                
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
    //                                 }else if(currency == 'EURO')
    //                                 {
    //                                   $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price) 
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                      $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                                      priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                 }else{
                                       
    //                                     $(el.parent().find('.selected_price_usd')).val(data.usd_price) 
    //                                   $(el.parent().find('.selected_price_euro')).val(data.euro_price) 
    //                                   $(el.parent().find('.selected_price')).val(data.price)
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
    //                                 }
                           
                                     
    //                         }
    //                         else
    //                             {
                                  
    //                             var totalAddUsd = 0;
    //                             var  totalAddEuro = 0;
                            
    //                             if(currency == 'USD'){
                               
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                     
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
    //                         }else if(currency == 'EURO')
    //                         {
    //                           var pr = $(el.parent().find('.selected_price')).val(data.price) 
    //                             var prUsd = $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             var prEur = $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                           priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                     
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                                     $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                           totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
    //                         }else{
                                
    //                             $(el.parent().find('.selected_price')).val(data.price) 
    //                             $(el.parent().find('.selected_price_usd')).val(data.usd_price);
    //                             $(el.parent().find('.selected_price_euro')).val(data.euro_price);
    //                                   priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
    //                                   totalAdd = (parseFloat(priceAdd) + parseFloat(data.price))
    //                                   priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
    //                                   priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
    //                                   priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
    //                                   totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                      
    //                                   totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.usd_price))
    //                                   totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
    //                                   $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
    //                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
    //                         }
    //                          var amtAdd = $(".amount");
    //                         }
    //                       var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                           var inputs = $(".amount");
    //                             var subTotal = 0;
    //                             for (var i = 0; i < inputs.length; i++) {
    //                                 subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                             }
    //                             $('.subTotal').html(subTotal.toFixed(2));
    //                             $('.totalAmount').html(subTotal.toFixed(2));
               
    //         }

    //     });
    //      }else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    //  });
    //  $(document).on('change', '.ordering-serise', function () {
    //         var code = $(this).val();
    //         var el = $(this);
    //         var currency = $(el.parent().parent().parent().find('.selectcurrency')).val()
    //         var name = $('#group option:selected').text();
    //         $(".ordering-serise").val(name);
    //         $("#model-name").val(name);
    //     $.ajax({
    //         url: '<?php echo e(route('productServiceCategory.getspecification')); ?>',
    //         type: 'POST',
    //         data: {
    //             "type": 'hsn_code',
    //              "code": code,
    //             "_token": "<?php echo e(csrf_token()); ?>",
    //         },

    //         success: function (data) {
    //              console.log(data);
    //             // $('#main-specification-div').empty();
    //             // $('.comm-div-first').empty();
    //             // $(".comm-div").removeClass('d-none');
    //             // $("#total_price").val('0.00');
    //             // $("#unit_rate").val('0.00');
    //             // $("#quantity").val('0.00');
    //             // $("#material_cost").val('0.00');
    //             // $("#grand_total").val('0.00');
    //             // $("#other_cost").val('0.00');
    //             // $("#labor_charge").val('0.00');
    //             var item = data.item;
    //             var quote = data.quote;
    //                 $(".item_div").empty() 
    //                 $(".item_div").append(data.product) 
                   
    //                 $(el.parent().parent().parent().parent().find('.main-specification')).addClass('row');
    //               if(quote != '')
    //                 {
    //                  var model = quote.model_new != ''?quote.model_new:quote.model;
    //                 $(el.parent().parent().parent().find('.quantity')).val(quote.quantity);
    //                 $(el.parent().parent().parent().find('.model')).val(model);
    //                 $(el.parent().parent().parent().find('.hsn_code')).val(quote.hsn_code);
    //                 $(el.parent().parent().parent().find('.price')).val(quote.price); 
    //                 $(el.parent().parent().parent().find('.group_id')).val(quote.group_id);
    //                 $(el.parent().parent().parent().find('.amount')).html(quote.price);
    //                 }else{
    //                  $(el.parent().parent().parent().find('.quantity')).val(1);
    //                  $(el.parent().parent().parent().find('.model')).val(code);
    //                 $(el.parent().parent().parent().find('.hsn_code')).val('90261020');
    //                 if(currency == 'USD')
    //                 {
    //                  $(el.parent().parent().parent().find('.price')).val(data.countUsd);   
    //                   $(el.parent().parent().parent().find('.amount')).html(data.countUsd);
    //                 }else if(currency == 'EURO')
    //                 {
    //                   $(el.parent().parent().parent().find('.price')).val(data.countEuro); 
    //                   $(el.parent().parent().parent().find('.amount')).html(data.countEuro);
    //                 }
    //                 else{
    //                   $(el.parent().parent().parent().find('.price')).val(data.countInr);   
    //                   $(el.parent().parent().parent().find('.amount')).html(data.countInr);
    //                 }
                    
    //                 $(el.parent().parent().parent().find('.price_inr')).val(data.countInr);
    //                 $(el.parent().parent().parent().find('.price_usd')).val(data.countUsd);
    //                 $(el.parent().parent().parent().find('.price_euro')).val(data.countEuro);
                   
    //                 $(el.parent().parent().parent().find('.group_id')).val(item.group_id);
    //                 }
    //                 // $(el.parent().parent().parent().find('.quantity')).val(1);
    //                 // $(el.parent().parent().parent().find('.model')).val(item.hsn_code);
    //                 // $(el.parent().parent().parent().find('.hsn_code')).val(item.model);
    //                 // $(el.parent().parent().parent().find('.price')).val(item.purchase_price);
    //                 $(el.parent().parent().parent().parent().find('.pro_description')).val(item.description);
    //                   var inputs = $(".amount");
    //                 var subTotal = 0;
    //                 for (var i = 0; i < inputs.length; i++) {
    //                     subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
    //                 }
    //                 $('.subTotal').html(subTotal.toFixed(2));


    //                 var totalItemPrice = 0;
    //                 var priceInput = $('.price');
    //                 for (var j = 0; j < priceInput.length; j++) {
    //                     totalItemPrice += parseFloat(priceInput[j].value);
                       
    //                 }
    //                 console.log(parseFloat(item.labor_charge) +  parseFloat(item.other_cost));
    //                 totalItemTaxPrice = parseFloat(item.labor_charge) +  parseFloat(item.other_cost);
    //               $(el.parent().parent().parent().find('.itemTaxPrice')).val(totalItemTaxPrice.toFixed(2));
    //                 var totalItemTaxPrice = 0;
    //                 // var itemTax = $('.totalTax');
    //                  var itemTaxPriceInput = $('.itemTaxPrice');
    //                 for (var j = 0; j < itemTaxPriceInput.length; j++) {
    //                     totalItemTaxPrice += parseFloat(item.labor_charge) +  parseFloat(item.other_cost);
    //                 }
                    
    //                 $('.totalTax').html(totalItemTaxPrice.toFixed(2));
    //                 $('.totalAmount').html((parseFloat(subTotal)+ parseFloat(totalItemTaxPrice)).toFixed(2));
    //                  $(el.parent().parent().parent().parent().find('.main-specification')).empty();
    //             $.each(data, function (key, value) {
    //                 if(key != 'product' && key != 'item')
    //                 {
    //                 // $('#main-specification').append(value);
                    
    //                   $(el.parent().parent().parent().parent().find('.main-specification')).append(value);
    //                 }
    //             });
                    
    //         }

    //     });
    //     });
        
    //       $(document).on('click', '.enable-row', function () {
   
       
    //     // Find the closest <tr> to the clicked button and enable it
    //      var maxHeight = 400;
    //     if ($(".main-specification").height() > maxHeight) { 
    //         maxHeight = 402;
    //         $(".main-specification").height(maxHeight);
    //         $(".main-specification").css({'overflow-y':'scroll'});
    //     } else {
    //         $(".main-specification").height();
    //         $(".main-specification").css({'overflow-y':'hidden'});
    //     }
        
    //      var closestTr = $(this).closest('tr');
    //      var count = $('.enable-row').length;
    //     var el = $(this);
    //     // Log the count to the console
    //     // console.log("Count of elements with class 'enable-row':", count);
    //     console.log(count);
    //   var nearestElement = $(this).closest('.main-specification').find('.d-none');
    // //  var nearestElements = $(this).addClass('d-none');
    // //   $(this).closest('.main-specification').find('tr').children().addClass('d-none');
    //     //  $(this).addClass('d-none');
    //     // Do something with the nearest element
    //     // nearestElements.find('td').eq(2).addClass('d-none')
    //      var myDiv = document.getElementById('.main-specification');
    //     // console.log(myDiv);
    //     // Do something with the nearest <tr> element
    //  // Iterate over each key-value pair
    // //   console.log(nearestElement.find('td').eq(2).addClass('d-none'));
    //     for (var key in nearestElement) {
    //         if (nearestElement.hasOwnProperty(key)) {
    //             var value = nearestElement[key]; 
    //             console.log("Key:", key, "Value:", value);
               
    //           $('.enable-row').eq(key).removeClass('d-block') 
    //         //   value.find('td').eq(2).eq(key).addClass('d-none');
    //             // value.eq(key).addClass('d-none') 
    //         // $('.main-specification').closest('.enable-row').eq(key).addClass('d-none') 
               
    //             if (value) {
    //                 if(key == 0)
    //                 {
                    
                   
    //                 // $(el.parent()).remove('d-block');
    //                 // $(el.parent()).addClass('d-none');
    //                  value.classList.remove('d-none');
                    
    //             }
    //             // value.classList.remove('d-none');
    //                 // row.classList.add('d-block');
    //             }
    //             // Do something with each value here...
    //         }
    //     }
       
    //     // Check if the closest <tr> contains the specified class
       
    
    // });
   $(document).on('change', '.ordering-serise', function (e) {
            var code = $(this).val();
          
            var el = $(this);
            var currency = $(el.parent().parent().parent().find('.selectcurrency')).val()
            var name = $('#group option:selected').text();
            $(".ordering-serise").val(name);
            $("#model-name").val(name);
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecification')); ?>',
            type: 'POST',
            data: {
                "type": 'hsn_code',
                 "code": code,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log("specifi"+data);
                
                var item = data.item;
                var quote = data.quote;
                console.log(quote);
                    $(".item_div").empty() 
                    $(".item_div").append(data.product) 
                     $(el.parent().parent().parent().parent().find('.main-specification')).addClass('row');
                    if(quote != '')
                    {
                       
                    if(item.is_integral == 'on'){
                      
                    $(el.parent().parent().parent().parent().find('.integral')).removeClass('d-none');
                    var sl =quote.integral == 'int'?'selected':'';
                    var sl1 =quote.integral == 'rmt1'?'selected':'';
                    var sl2 =quote.integral == 'rmt2'?'selected':'';
                    var fd =quote.fd_cd == 'fd'?'selected':'';
                    var cd =quote.fd_cd == 'cd'?'selected':'';
                   
                    var getfdcd = quote.fd_cd != ''?'block':'d-none';
                    
                    var Intop = ' <td colspan="4"><div class="form-group"><label for="selectOptionIntegral">Integral/Slit/Flexible</label><select class="form-control selectOptionIntegral" name="integral"><option value="">Choose options</option><option value="int" '+sl+'>(Int) Standard integral type</option><option value="rmt1"'+sl1+'>Rmt1</option><option value="rmt2" '+sl2+'>Rmt2</option></select></div></td><td colspan="3" class="fd_cd_options '+getfdcd+'"><div class="form-group"><label for="fd_cd">Select FD/CD</label><select class="form-control fd_cd" name="fd_cd" ><option value="fd" '+fd+'>FD</option><option value="cd"'+cd+'> CD </option></select></div></td>';
                    $(el.parent().parent().parent().parent().find('.integral')).empty()
                    $(el.parent().parent().parent().parent().find('.integral')).append(Intop)
                   }else{
                       $(el.parent().parent().parent().parent().find('.integral')).addClass('d-none');
                       $(el.parent().parent().parent().parent().find('.group-material-0')).removeClass('d-none');  
                   }            
                        
                    var model = quote.model_new != ''?quote.model_new:quote.model;
                    $(el.parent().parent().parent().find('.quantity')).val(quote.quantity);
                    $(el.parent().parent().parent().find('.model')).val(model);
                    $(el.parent().parent().parent().find('.hsn_code')).val(quote.hsn_code);
                    $(el.parent().parent().parent().find('.price')).val(quote.price); 
                    $(el.parent().parent().parent().find('.group_id')).val(quote.group_id);
                    $(el.parent().parent().parent().find('.amount')).html(quote.price);
                    }else{
                     $(el.parent().parent().parent().find('.quantity')).val(1);
                     $(el.parent().parent().parent().find('.model')).val(code);
                    $(el.parent().parent().parent().find('.hsn_code')).val('90261020');
                    if(currency == 'USD')
                    {
                     $(el.parent().parent().parent().find('.price')).val(data.countUsd);   
                      $(el.parent().parent().parent().find('.amount')).html(data.countUsd);
                    }else if(currency == 'EURO')
                    {
                      $(el.parent().parent().parent().find('.price')).val(data.countEuro); 
                      $(el.parent().parent().parent().find('.amount')).html(data.countEuro);
                    }
                    else{
                      $(el.parent().parent().parent().find('.price')).val(data.countInr);   
                      $(el.parent().parent().parent().find('.amount')).html(data.countInr);
                    }
                    
                    $(el.parent().parent().parent().find('.price_inr')).val(data.countInr);
                    $(el.parent().parent().parent().find('.price_usd')).val(data.countUsd);
                    $(el.parent().parent().parent().find('.price_euro')).val(data.countEuro);
                   
                    $(el.parent().parent().parent().find('.group_id')).val(item.group_id);
                    }
                    // $(el.parent().parent().parent().find('.quantity')).val(1);
                    // $(el.parent().parent().parent().find('.model')).val(item.hsn_code);
                    // $(el.parent().parent().parent().find('.hsn_code')).val(item.model);
                    // $(el.parent().parent().parent().find('.price')).val(item.purchase_price);
                    $(el.parent().parent().parent().parent().find('.pro_description')).val(item.description);
                   

                   
                   
                      var inputs = $(".amount");
                    var subTotal = 0;
                    for (var i = 0; i < inputs.length; i++) {
                        subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                    }
                    $('.subTotal').html(subTotal.toFixed(2));


                    var totalItemPrice = 0;
                    var priceInput = $('.price');
                    for (var j = 0; j < priceInput.length; j++) {
                        totalItemPrice += parseFloat(priceInput[j].value);
                       
                    }
                    console.log(parseFloat(item.labor_charge) +  parseFloat(item.other_cost));
                    totalItemTaxPrice = parseFloat(item.labor_charge) +  parseFloat(item.other_cost);
                   $(el.parent().parent().parent().find('.itemTaxPrice')).val(totalItemTaxPrice.toFixed(2));
                    var totalItemTaxPrice = 0;
                    // var itemTax = $('.totalTax');
                     var itemTaxPriceInput = $('.itemTaxPrice');
                    for (var j = 0; j < itemTaxPriceInput.length; j++) {
                        totalItemTaxPrice += parseFloat(item.labor_charge) +  parseFloat(item.other_cost);
                    }
                    
                    $('.totalTax').html(totalItemTaxPrice.toFixed(2));
                    $('.totalAmount').html((parseFloat(subTotal)+ parseFloat(totalItemTaxPrice)).toFixed(2));
                     $(el.parent().parent().parent().parent().find('.main-specification')).empty();
                $.each(data, function (key, value) {
                    if(key != 'product' && key != 'item')
                    {
                    // $('#main-specification').append(value);
                    
                      $(el.parent().parent().parent().parent().find('.main-specification')).append(value);
                    }
                });
                    
            }

        });
        })
   $(document).on('change', '.selectcurrency', function () {
           
             
             var type = $(this).val();
             var amt = $(this).parent().parent().parent().find('.manual_discount').val();
             var m_price = $(this).parent().parent().parent().find('.m_price').val();
             var price = $(this).parent().parent().parent().find('.price_inr').val();
             var priceInr = $(this).parent().parent().parent().find('.base_price').val();
             var priceUsd = $(this).parent().parent().parent().find('.base_price_usd').val();
             var priceEuro = $(this).parent().parent().parent().find('.base_price_euro').val();
            
             var u_price = $(this).parent().parent().parent().find('.usd_sale_price').val();
             var e_price = $(this).parent().parent().parent().find('.euro_sale_price').val();
             var usd = $(this).parent().parent().parent().find('.price_usd').val()
             var euro = $(this).parent().parent().parent().find('.price_euro').val()
           
             var el = $(this);
            var totalUsd =  parseFloat(priceUsd) +  parseFloat(usd);
            var totalEuro =  parseFloat(priceEuro) +  parseFloat(euro);
            var totalInr =  parseFloat(priceInr) +  parseFloat(price);
             if(type != '')
             {
                
                 if(type == 'USD')
                 {
                     $('.cSymbol').text('$')
                     if(totalUsd>0){
                         
                        $(this).parent().parent().parent().find('.price').empty();
                        $(this).parent().parent().parent().find('.price').val(totalUsd.toFixed(2)); 
                        $('.amount').text(totalUsd.toFixed(2));
                        $('.subTotal').text(totalUsd.toFixed(2));
                        $('.totalAmount').html(parseFloat(totalUsd).toFixed(2));
                        $('.totalDiscount').text('0.00');
                          var Mamt = $('#mDiscount').val();
             var Dtype = $('#selectOption').val();
           
            if(Mamt != ''){
            alert("Sf")
             if(Mamt != '')
             {
                 if(Dtype == 'flat')
             {
                 var subTotal =  $('.subTotal').text();
                
                 var Total = parseFloat(subTotal) -  parseFloat(Mamt);
                 $('.totalAmount').html(parseFloat(Total).toFixed(2));
                  $('.totalDiscount').html(parseFloat(Mamt).toFixed(2));
             }else
             {
                 
                 var subTotal = $('.subTotal').text();
                 var Total = (parseFloat(subTotal) - parseFloat(subTotal)* parseFloat(Mamt)/100);
                  $('.totalDiscount').html((parseFloat(subTotal)* parseFloat(amt)/100).toFixed(2));
                 $('.totalAmount').html(parseFloat(Total).toFixed(2));
             }
             }else{
                 var subTotal=0;
                 $('.totalDiscount').html((parseFloat(subTotal).toFixed(2)));
                 var subTotal = $('.subTotal').text();
                 $('.totalAmount').html(parseFloat(subTotal).toFixed(2));
             }
            }
                        return true;
                     }else
                     {
                       
                        return true;
                     }
                     var amtTotal =  $('.amount').text();
                      $('.subTotal').text(u_price);
                      var subTotal =  $('.subTotal').text();
                     $(this).parent().parent().parent().find('.price').val('0.00');
                     if(amt != null)
                     {
                         
                     var Total = parseFloat(subTotal) -  parseFloat(amt);
                     $('.totalAmount').html(parseFloat(Total).toFixed(2));
                      $('.totalDiscount').html(parseFloat(amt).toFixed(2));
                    }else{
                       $('.totalAmount').html(parseFloat(subTotal).toFixed(2)); 
                    }
                    
                 }
                  else if(type == 'EURO')
                   {
                       $('.cSymbol').text('€')
                      if(totalEuro>0){
                        $(this).parent().parent().parent().find('.price').empty();
                        $(this).parent().parent().parent().find('.price').val(totalEuro.toFixed(2)); 
                        $('.amount').text(totalEuro.toFixed(2));
                        $('.subTotal').text(totalEuro.toFixed(2));
                        $('.totalAmount').html(parseFloat(totalEuro).toFixed(2));
                       
                          var Mamt = $('#mDiscount').val();
             var Dtype = $('#selectOption').val();
           
            if(Mamt != ''){
            
             if(Mamt != '')
             {
                 if(Dtype == 'flat')
             {
                 var subTotal =  $('.subTotal').text();
                
                 var Total = parseFloat(subTotal) -  parseFloat(Mamt);
                 $('.totalAmount').html(parseFloat(Total).toFixed(2));
                  $('.totalDiscount').html(parseFloat(Mamt).toFixed(2));
             }else
             {
                 
                 var subTotal = $('.subTotal').text();
                 var Total = (parseFloat(subTotal) - parseFloat(subTotal)* parseFloat(Mamt)/100);
                  $('.totalDiscount').html((parseFloat(subTotal)* parseFloat(amt)/100).toFixed(2));
                 $('.totalAmount').html(parseFloat(Total).toFixed(2));
             }
             }else{
                 var subTotal=0;
                 $('.totalDiscount').html((parseFloat(subTotal).toFixed(2)));
                 var subTotal = $('.subTotal').text();
                 $('.totalAmount').html(parseFloat(subTotal).toFixed(2));
             }
            }
                        return true;
                     }
                     else{
                        return true;
                     }
                      var amtTotal =  $('.amount').text();
                      $('.subTotal').text(e_price);
                      var subTotal =  $('.subTotal').text();
                     $(this).parent().parent().parent().find('.price').val('0.00');
                     var subTotal =  $('.subTotal').text();
                    if(amt != null)
                     {
                     var Total = parseFloat(subTotal) -  parseFloat(amt);
                     $('.totalAmount').html(parseFloat(Total).toFixed(2));
                      $('.totalDiscount').html(parseFloat(amt).toFixed(2));
                    }else{
                      
                       $('.totalAmount').html(parseFloat(subTotal).toFixed(2)); 
                    }
                 }
             else{
                 $('.cSymbol').text('<?php echo e(\Auth::user()->currencySymbol()); ?>')
                 if(totalInr>0){
                        $(this).parent().parent().parent().find('.price').empty();
                        $(this).parent().parent().parent().find('.price').val(totalInr.toFixed(2)); 
                        $('.amount').text(totalInr.toFixed(2));
                        $('.subTotal').text(totalInr.toFixed(2));
                        $('.totalAmount').html(parseFloat(totalInr).toFixed(2));
                       
                          var Mamt = $('#mDiscount').val();
            var Dtype = $('#selectOption').val();
            if(Mamt != ''){
            
             if(Mamt != '')
             {
                 if(Dtype == 'flat')
             {
                 var subTotal =  $('.subTotal').text();
                
                 var Total = parseFloat(subTotal) -  parseFloat(Mamt);
                 $('.totalAmount').html(parseFloat(Total).toFixed(2));
                  $('.totalDiscount').html(parseFloat(Mamt).toFixed(2));
             }else
             {
                 
                 var subTotal = $('.subTotal').text();
                 var Total = (parseFloat(subTotal) - parseFloat(subTotal)* parseFloat(Mamt)/100);
                  $('.totalDiscount').html((parseFloat(subTotal)* parseFloat(amt)/100).toFixed(2));
                 $('.totalAmount').html(parseFloat(Total).toFixed(2));
             }
             }else{
                 var subTotal=0;
                 $('.totalDiscount').html((parseFloat(subTotal).toFixed(2)));
                 var subTotal = $('.subTotal').text();
                 $('.totalAmount').html(parseFloat(subTotal).toFixed(2));
             }
            }
                        return true;
                     }else{
                         
                        
                        return true;
                     }
                 $(this).parent().parent().parent().find('.price').val(m_price);
                 var subTotal = $('.subTotal').text(m_price);
                 $('.amount').text(m_price);
                 $('.totalAmount').text(m_price);
             }
             }else{
                 var subTotal=0;
                 $('.totalDiscount').html((parseFloat(subTotal).toFixed(2)));
                 var subTotal = $('.subTotal').text();
                 $('.totalAmount').html(parseFloat(subTotal).toFixed(2));
             }
            
            //  $('.subTotal').html(subTotal.toFixed(2));
            //  $('.totalAmount').html(subTotal.toFixed(2)); 
          
         });
  $(document).on('change', '.gland', function () {
        var el = $(this);
        var inids = $(this).parent().parent().parent().parent().parent().parent().find('.slname').attr("name");
        $(this).attr("name", inids+'[]')
        
    });
        $(document).on('change', '.group-material-0', function () {
         var el = $(this);
         var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
        
         var arrs = serises.split('-');  
        var id = $(this).val();
         var parent = $(this).attr('id');
        if(id > 0)
        {
            
        var type = $(this).data('id');
        var idValue =$(this).attr('id');
         
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                          }
        var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
            // var el = $(this);
            var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
            var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()  
            var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
            var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
             var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
            var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
            
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                "parent":parent,
                "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                     console.log("data-v"+data)
                     
                     if(data.gland != ''){
                        $(el.parent().parent().parent().parent().parent().parent().find('.glands')).empty();
                        $(el.parent().parent().parent().parent().parent().parent().find('.glands')).removeClass('d-none');
                        $(el.parent().parent().parent().parent().parent().parent().find('.glands')).append(data.gland);  
                     }else{
                         
                  $(el.parent().parent().parent().parent().parent().parent().find('.glands')).removeClass('d-none');
                
                     }
                     if(data.filter != ''){
                         $(el.parent().parent().parent().parent().find('.group-material-2')).empty();
                         $(el.parent().parent().parent().parent().find('.group-material-2')).removeClass('d-none');
                         $(el.parent().parent().parent().parent().find('.group-material-2')).append(data.filter);    
                     }else{
                        $(el.parent().parent().parent().parent().find('.group-material-2')).removeClass('d-none');  
                     }
                    //   console.log("data-v"+data.data.id)
                        var sum = 0;
                        var qty = 0;
                        var totalAdd = '0.00';
                        var priceAdd = '0.00';
                       
                           $(el.parent().parent().parent().parent().parent().parent().find('.length_price')).val(data.data.length_price);
                           $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).val(data.data.is_length);
                            var amtAdd = $(".amount");
                       
                            $("#unit_rate").val(sum);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            var qty = 0;
                        $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                             var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
                             
                             var arr2 = serise.split(':');
                             var arr = serise.split('-');
                           
                             arr[0] = data.data.prefix;
                            // var newArr = ["HES","TS","RS","SS","GS","WS","PCS","CS","LL", "LRRP", "LFRP"];
                            //  if(jQuery.inArray(arr[0], newArr) !== -1)
                            //  {
                            //   $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }else{
                               $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }
                             var finalval = (arr.join("-")); 
                            if(arr.length  >=1)
                            {
                              var innns = $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(arr2[0]+':'+finalval); 
                            }else
                            {
                               $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(data.prefix); 
                            }
                            $(el.parent().find(".selected_inr_price")).text('')
                            $(el.parent().parent().parent().find(".selected_inr_price")).text(data.price);
                          
                            if(arrs.length  >1)
                            {
                             
                                
                               var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                               if(currency == 'USD'){
                                   
                                     var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                       if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        { 
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
                                        }   
                                    }else if(currency == 'EURO')
                                    {
                                      var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
                                        }   
                                    }else{
                                    var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                       
                                        if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
                                        {   
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
                                        }  
                                       if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        {  
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                             $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                        }  
                                       if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                            $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                            priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                            totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                        }  
                                    }
                                     if(currency == 'USD'){
                                
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
                                    }else if(currency == 'EURO')
                                    {
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price) 
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                         priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                    }else{
                                       
                                        $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                    //   alert(totalAddInr)
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
                                    }
                                     
                            }
                            else
                                {
                                    
                                  var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                              if(currency == 'USD'){
                                   
                                     var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        { 
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
                                        }   
                                    }else if(currency == 'EURO')
                                    {
                                      var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
                                        }   
                                    }else{
                                    var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                        if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
                                        {   
                                          
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
                                        }  
                                      if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        {  
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                             $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                              priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                              totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
                                        }  
                                      if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                            $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                            priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                            totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                        }  
                                    }
                                if(currency == 'USD'){
                               
                               var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                            }else if(currency == 'EURO')
                            {
                              var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                    
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                            }else{
                                
                                $(el.parent().find('.selected_price')).val(data.data.price) 
                                $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                                      priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                            $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                            }
                             var amtAdd = $(".amount");
                            }
                           
                              var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                                $('.subTotal').html(subTotal.toFixed(2));
                                $('.totalAmount').html(subTotal.toFixed(2));
                            var idValue =$(this).attr('id');

                            if (idValue === 'print_img') {
                                // Do something if the id value matches the desired value
                                $('#image-preview').removeClass('d-none');
                            }
                           
            }

        });
      
        }
        // else{
        //   show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
        //   return false;  
        // }
    });
   $(document).on('change', '.group-material-1', function () {
         var el = $(this);
         var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
         var arrs = serises.split('-');
        var id = $(this).val();
        
        $('#group-material-2').removeClass('d-none');  
       
        //   $(this).parent().parent().find('.inputDesc').attr("name", indesc+'[]')
        if(id != 0)
        {
        var type = $(this).data('id');
        var parent = $(this).attr('id');
        
        var idValue =$(this).attr('id');
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                          }
        var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
        ($(this).parent().parent().parent().parent().find('.group-material-2')).removeAttr('disabled');
        
        // $('.group-material-2').removeAttr('disabled');
        // var el = $(this);
        var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
        var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()  
        var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
        var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
        var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
        var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
        // var oldAmountUsd =  $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html();
        // var oldAmountEuro =  $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html();
            
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "parent":parent,
                "id": id,
                 "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                if(data.data.prefix == null)
                             {
                                var inids = $(el.parent().parent().parent().parent().parent().parent().find('.slname')).attr("name");
                                $(el.attr("name", inids+'[]'))
                             }
                           
                              var inputLN = $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).attr("name");
                              $(el.parent().parent().parent().parent().parent().parent().find('.inputLN')).attr("name", inputLN);
                              if(data.data.is_length == 'on'){
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_inr')).val(data.data.price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_usd')).val(data.data.usd_price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_euro')).val(data.data.euro_price);
                              }
                             
                              $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).val(data.data.is_length);
                             $(el.parent().parent().find('.inputLN')).val(data.data.is_length);
                 console.log(data);
                  if(data.count != 0)
                {
                  
                 if(data.filter != ''){
                         $(el.parent().parent().parent().parent().find('.group-material-3')).empty();
                         $(el.parent().parent().parent().parent().find('.group-material-3')).removeClass('d-none');
                         $(el.parent().parent().parent().parent().find('.group-material-3')).append(data.filter);    
                     }else{
                        $(el.parent().parent().parent().parent().find('.group-material-3')).removeClass('d-none');  
                     }
              
                }else{
                   
                 $('#group-material-2').removeClass('d-none');   
                }
                        var sum = 0;
                        var qty = 0;
                        var totalAdd = '0.00';
                        var priceAdd = '0.00';
                           
                            var amtAdd = $(".amount");
                           
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                            var seri =  $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
                            //  var serise =  $("#ordering-serise").val();
                            
                             
                             var arr = serises.split('-');
                              console.log(arr.length);
                             if(typeof arr[0] === 'undefined'){
                                 arr[0] = data.data.prefix; 
                             }else{
                                  arr[1] = data.data.prefix;
                             }
                          
                             var finalval = (arr.join("-")); 
                           if(data.data.prefix == null){
                                var finalval = serises;     
                             }
                                console.log("fds"+finalval);
                            if(arr.length  >= 2)
                            {
                                  
                               var innns = $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val(finalval); 
                            }else
                            {
                              
                                 $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val(finalval); 
                            }
                             
                            if(arrs.length  > 1)
                            {
                              var totalAddUsd = 0;
                              var  totalAddEuro = 0;
                                if(currency == 'USD'){
                                   
                                     var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                       if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        { 
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
                                        }   
                                    }else if(currency == 'EURO')
                                    {
                                      var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
                                        }   
                                    }else{
                                    var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                        if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
                                        {   
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
                                        }  
                                       if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        {  
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                             $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                        }  
                                       if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                            $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                            priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                            totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
                                        }  
                                    }
                                     if(currency == 'USD'){
                                
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
                                    }else if(currency == 'EURO')
                                    {
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price) 
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                         priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                    }else{
                                       
                                        $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
                                    }
                                    
                            $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                     
                            }
                            else
                                {
                               
                                var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                            
                                if(currency == 'USD'){
                               
                               var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                            }else if(currency == 'EURO')
                            {
                              var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                    
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                            }else{
                                
                                $(el.parent().find('.selected_price')).val(data.data.price) 
                                $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                                      priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                            $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                            }
                             var amtAdd = $(".amount");
                            }
                           var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                               var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                                $('.subTotal').html(subTotal.toFixed(2));
                                $('.totalAmount').html(subTotal.toFixed(2));
                            var idValue =$(this).attr('id');

                            if (idValue === 'print_img') {
                                // Do something if the id value matches the desired value
                                $('#image-preview').removeClass('d-none');
                            }
               
            }

        });
        }
        // else{
        //   show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
        //   return false;  
        // }
    });
    $(document).on('change', '.group-material-2', function () {
         var el = $(this);
         var serises =  $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
         var arrs = serises.split('-');
      
        $('.group-material-3').removeClass('d-none');                   
        var id = $(this).val();
        var type = $(this).data('id');
         var parent = $(this).attr('id');
        
        if(id != 0)
        {
        // var el = $(this);
        var idValue =$(this).attr('id');
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
         ($(this).parent().parent().parent().parent().find('.group-material-3')).removeAttr('disabled');
        
          var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
          var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
          var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
          var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
          var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
           var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "parent":parent,
                
                "id": id,
                 "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                if(data.data.prefix == null)
                             {
                                 var inids = $(el.parent().parent().parent().parent().parent().parent().find('.slname')).attr("name");
                                $(el.attr("name", inids+'[]'))
                             }
                if(data.count != 0)
                {
                    
                 $('#group-material-4').empty();
                 $('#group-material-4').append(data.filter);
                 $('#group-material-4').removeClass('d-none');
                console.log(data);
                }else{
                      
                    $('#group-material-4').empty();
                     $('#group-material-4').append(data.filter);
                 $('#group-material-4').removeClass('d-none');   
                }
                // $('#specification-materials').empty();
                              var inputLN = $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).attr("name");
                              $(el.parent().parent().parent().parent().parent().parent().find('.inputLN')).attr("name", inputLN);
                              if(data.data.is_length == 'on'){
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_inr')).val(data.data.price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_usd')).val(data.data.usd_price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_euro')).val(data.data.euro_price);
                              }
                              $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).val(data.data.is_length);
                              $(el.parent().parent().find('.inputLN')).val(data.data.is_length);
                   var firstChild = $('#specification-materials').children().first();
                     firstChild.after(data);
                    var sum = 0;
                    var qty = 0;
                            var totalAdd = '0.00';
                            var priceAdd = '0.00';
                           
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                            // var serise =  $("#ordering-serise").val();
                            var serise =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
                            //  var serise =  $("#ordering-serise").val();
                             var arr = serise.split('-');
                             var mName = 'LSV';
                             if(typeof arr[1] === 'undefined'){
                                 arr[1] = data.data.prefix; 
                             }else{
                                  arr[2] = data.data.prefix;
                             }
                             var finalval = (arr.join("-")); 
                           if(data.data.prefix == null){
                                var finalval = serise;     
                             }
                            // var newArr = ["HES","TS","RS","SS","GS","WS","PCS","CS","LL", "LRRP", "LFRP"];
                            //  if(jQuery.inArray(arr[2], newArr) !== -1)
                            //  {
                            //   $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }else{
                               $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }
                             
                            if(arr.length  >= 3)
                            {
                               var innns =  $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val(finalval); 
                                
                            }else
                            {
                                 $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val(finalval); 
                                 
                            }
                            
                            if(arrs.length  > 2)
                            {
                               var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                                if(currency == 'USD'){
                                   
                                     var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                       if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        { 
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
                                        }   
                                    }else if(currency == 'EURO')
                                    {
                                      var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
                                        }   
                                    }else{
                                    var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                        if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
                                        {   
                                          
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
                                        }  
                                       if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        {  
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                             $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                        }  
                                       if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                            $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                            priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                            totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                        }  
                                    }
                                     if(currency == 'USD'){
                                
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
                                    }else if(currency == 'EURO')
                                    {
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.price) 
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                         priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                    }else{
                                       
                                        $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
                                    }
                            }
                            else
                                {
                                  
                                var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                           
                                if(currency == 'USD'){
                               
                               var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.price))
                                       
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                            }else if(currency == 'EURO')
                            {
                              var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                            }else{
                                
                                $(el.parent().find('.selected_price')).val(data.data.price) 
                                $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                                      priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                            $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                            }
                             var amtAdd = $(".amount");
                            }
                            var idValue =$(this).attr('id');
                            var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                                var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                                $('.subTotal').html(subTotal.toFixed(2));
                                $('.totalAmount').html(subTotal.toFixed(2));
                            if (idValue === 'print_img') {
                                // Do something if the id value matches the desired value
                                $('#image-preview').removeClass('d-none');
                            }
               
            }

        });
     }
    //  else{
    //       show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
    //       return false;  
    //     }
    });
    $(document).on('change', '.group-material-3', function () {
        var el = $(this);
        var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
        var arrs = serises.split('-');
        var id = $(this).val();
        var parent = $(this).attr('id');
        var type = $(this).data('id');
        var idValue =$(this).attr('id');
       
         if(id != 0)
         {
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
        }
        $('.group-material-4').removeClass('d-none');
        var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
         ($(this).parent().parent().parent().parent().find('.group-material-4')).removeAttr('disabled');
        //  var el = $(this);
            var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
            var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
            var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
            var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
            var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
             var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
            
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "parent":parent,
                "id": id,
                 "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                if(data.data.prefix == null)
                             {
                                var inids = $(el.parent().parent().parent().parent().parent().parent().find('.slname')).attr("name");
                                $(el.attr("name", inids+'[]'))
                             }
                if(data.count != 0)
                {
                    
                 $('#group-material-5').empty();
                 $('#group-material-5').append(data.filter);
                 $('#group-material-5').removeClass('d-none');
                console.log(data);
                }else{
                     
                    $('#group-material-5').empty();
                     $('#group-material-5').append(data.filter);
                 $('#group-material-5').removeClass('d-none');   
                }
                    var firstChild = $('#specification-materials').children().first();
                     firstChild.after(data);
                    var sum = 0;
                        var totalAdd = '0.00';
                            var priceAdd = '0.00';
                       
                           
                            var amtAdd = $(".amount");
                            var inputLN = $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).attr("name");
                              $(el.parent().parent().parent().parent().parent().parent().find('.inputLN')).attr("name", inputLN);
                              if(data.data.is_length == 'on'){
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_inr')).val(data.data.price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_usd')).val(data.data.usd_price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_euro')).val(data.data.euro_price);
                              }
                              $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).val(data.data.is_length);
                              $(el.parent().parent().find('.inputLN')).val(data.data.is_length);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            var qty = 0;
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                           
                            // $('.prefix-input').each(function(index, value){
                            // var value = $(this).val(); // Parse the value to float
                            var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
                            //  var serise =  $("#ordering-serise").val();
                             var arr = serise.split('-');
                             var mName = 'LSV';
                             console.log(arr);
                            //  arr[2] = data.data.prefix;
                             if(typeof arr[2] === 'undefined'){
                                 arr[2] = data.data.prefix; 
                             }else{
                                  arr[3] = data.data.prefix;
                             }
                              var finalval = (arr.join("-"));   
                             if(data.data.prefix == null){
                                var finalval = serise;     
                             }
                              
                            // var newArr = ["HES","TS","RS","SS","GS","WS","PCS","CS","LL", "LRRP", "LFRP"];
                            //  if(jQuery.inArray(arr[3], newArr) !== -1)
                            //  {
                            //   $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }else{
                               $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }
                            if(arr.length  >= 4)
                            {
                               var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }else
                            {
                                 $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }
                             
                            if(arrs.length  > 3)
                            {
                               var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                                if(currency == 'USD'){
                                   
                                     var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                       if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        { 
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
                                        }   
                                    }else if(currency == 'EURO')
                                    {
                                      var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
                                        }   
                                    }else{
                                    var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                        if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
                                        {   
                                          
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
                                        }  
                                       if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        {  
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                             $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                        }  
                                       if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                            $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                            priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                            totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                        }  
                                    }
                                     if(currency == 'USD'){
                                
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
                                    }else if(currency == 'EURO')
                                    {
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.price) 
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                         priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                    }else{
                                       
                                        $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
                                    }
                            }
                            else
                                {
                                  
                                var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                            
                                if(currency == 'USD'){
                               
                               var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                            }else if(currency == 'EURO')
                            {
                              var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                            }else{
                                
                                $(el.parent().find('.selected_price')).val(data.data.price) 
                                $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                                      priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                            $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                            }
                             var amtAdd = $(".amount");
                            }
                           var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                                $('.subTotal').html(subTotal.toFixed(2));
                                $('.totalAmount').html(subTotal.toFixed(2));
            }

        });
         }
        //  else{
        //   show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
        //   return false;  
        // }
        
    });
    $(document).on('change', '.group-material-4', function () {
            var el = $(this);
            var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
            var arrs = serises.split('-');
            var id = $(this).val();
            var type = $(this).data('id');
            var parent =$(this).attr('id');
            var idValue =$(this).attr('id');
           
            $('.group-material-5').removeClass('d-none');
         if(id != 0)
         {
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
        ($(this).parent().parent().parent().parent().find('.group-material-5')).removeAttr('disabled');
        //  var el = $(this);  
            var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
            var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
            var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
            var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
            var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
             var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
            $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "parent":parent,
                "id": id,
                 "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                if(data.data.prefix == null)
                             {
                                 var inids = $(el.parent().parent().parent().parent().parent().parent().find('.slname')).attr("name");
                                $(el.attr("name", inids+'[]'))
                             }
             if(data.data.prefix != null){    
               if(data.count != 0)
                {
                    
                 $('#group-material-6').empty();
                 $('#group-material-6').append(data.filter);
                 $('#group-material-6').removeClass('d-none');
                console.log(data);
                }else{
                     
                    $('#group-material-6').empty();
                     $('#group-material-6').append(data.filter);
                 $('#group-material-6').removeClass('d-none');   
                }
             }
                    var firstChild = $('#specification-materials').children().first();
                     firstChild.after(data);
                    var sum = 0;
                        var totalAdd = '0.00';
                            var priceAdd = '0.00';
                       
                           
                            var amtAdd = $(".amount");
                           var inputLN = $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).attr("name");
                              $(el.parent().parent().parent().parent().parent().parent().find('.inputLN')).attr("name", inputLN);
                              if(data.data.is_length == 'on'){
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_inr')).val(data.data.price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_usd')).val(data.data.usd_price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_euro')).val(data.data.euro_price);
                              }
                              $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).val(data.data.is_length);
                             $(el.parent().parent().find('.inputLN')).val(data.data.is_length);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            var qty = 0;
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                             var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
                            //  var serise =  $("#ordering-serise").val().
                             var arr = serise.split('-');
                             var mName = 'LSV';
                           
                             if(typeof arr[2] === 'undefined'){
                                 arr[2] = data.data.prefix; 
                             }else{
                                  arr[3] = data.data.prefix;
                             }
                             var finalval = (arr.join("-"));
                            if(data.data.prefix == null){
                              var finalval = serise;  
                            }
                            //  alert(arr[4])
                             
                            
                              localStorage.setItem('setItem',finalval);
                           
                               $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                           
                            if(arr.length  >= 5)
                            {
                              
                               var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }else
                            {
                               
                                 $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }
                             if(arrs.length  > 4)
                            {
                              var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                              if(currency == 'USD'){
                                   
                                     var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        { 
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
                                        }   
                                    }else if(currency == 'EURO')
                                    {
                                      var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                      $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
                                        }   
                                    }else{
                                    var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                        if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
                                        {   
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
                                        }  
                                      if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        {  
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                             $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                              priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                              totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                        }  
                                      if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                            $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                            priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                            totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
                                        }  
                                    }
                                     if(currency == 'USD'){
                                
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
                                    }else if(currency == 'EURO')
                                    {
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price) 
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                         priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                    }else{
                                       
                                        $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))

                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
                                    }
                                    
                           
                                     
                            }
                            else
                                {
                                  
                                 var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                            
                                if(currency == 'USD'){
                               
                               var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.usd_price))
                            }else if(currency == 'EURO')
                            {
                              var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.euro_price))
                            }else{
                                
                                $(el.parent().find('.selected_price')).val(data.data.price) 
                                $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                                      priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                            $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                            }
                             var amtAdd = $(".amount");
                            }
                           var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                               var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                                $('.subTotal').html(subTotal.toFixed(2));
                                $('.totalAmount').html(subTotal.toFixed(2));
               
            }

        });
         }
        //  else{
        //   show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
        //   return false;  
        // }
     });
    $(document).on('change', '.group-material-5', function () {
       var el = $(this);
        $('.group-material-6').removeClass('d-none');
        var id = $(this).val();
        var type = $(this).data('id');
        var idValue =$(this).attr('id');
        var parent =$(this).attr('id');
        
         if(id != 0)
         {
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
            
        var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
        ($(this).parent().parent().parent().parent().find('.group-material-6')).removeAttr('disabled');
        //  var el = $(this);  
            var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
            var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
            var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
            var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
            var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
            var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
          var serises = $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
           
         var arrs = serises.split('-');    
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                "parent":parent,
                "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                 if(data.data.prefix == null)
                             {
                                 var inids = $(el.parent().parent().parent().parent().parent().parent().find('.slname')).attr("name");
                                $(el.attr("name", inids+'[]'))
                             }
                 if(data.count != 0)
                {
                    
                //  $('#group-material-6').empty();
                 $('#group-material-7').append(data.filter);
                 $('#group-material-7').removeClass('d-none');
                console.log(data);
                }else{
                     
                    $('#group-material-7').empty();
                    $('#group-material-7').append(data.filter);
                    $('#group-material-7').removeClass('d-none');   
                }
                     var inputLN = $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).attr("name");
                              $(el.parent().parent().parent().parent().parent().parent().find('.inputLN')).attr("name", inputLN);
                              if(data.data.is_length == 'on'){
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_inr')).val(data.data.price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_usd')).val(data.data.usd_price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_euro')).val(data.data.euro_price);
                              }
                              $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).val(data.data.is_length);
                              $(el.parent().parent().find('.inputLN')).val(data.data.is_length);
                    var firstChild = $('#specification-materials').children().first();
                     firstChild.after(data);
                    var sum = 0;
                        var totalAdd = '0.00';
                            var priceAdd = '0.00';
                            var amtAdd = $(".amount");
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            var qty = 0;
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                             var serises =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
                            //  var serise =  $("#ordering-serise").val().
                             var arr = serises.split('-');
                             var mName = 'LSV';
                            
                             if(typeof arr[3] === 'undefined'){
                                 arr[3] = data.data.prefix; 
                             }else{
                                 if(data.data.prefix != null)
                                 {
                                  arr[4] = data.data.prefix;   
                                 }
                                  
                             }
                             if(data.data.prefix != null)
                                 {
                                      var finalval = (arr.join("-")); 
                                 }
                                 else{
                                     var finalval = (serises); 
                                 }
                            localStorage.setItem('setItem',finalval);
                           
                            // var newArr = ["HES","TS","RS","SS","GS","WS","PCS","CS","LL", "LRRP", "LFRP"];
                            //  if(jQuery.inArray(arr[5], newArr) !== -1)
                            //  {
                            //   $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }else{
                               $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }
                            if(arr.length  >= 6)
                            {
                               var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }else
                            {
                                 $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }
                             if(arrs.length  > 5)
                            {
                               var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                               if(currency == 'USD'){
                                   
                                     var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                       if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        { 
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
                                        }   
                                    }else if(currency == 'EURO')
                                    {
                                      var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
                                        }   
                                    }else{
                                    var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                        if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
                                        {   
                                        
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
                                        }  
                                       if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        {  
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                             $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                        }  
                                       if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                            $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                            priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                            totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                        }  
                                    }
                                     if(currency == 'USD'){
                                
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
                                    }else if(currency == 'EURO')
                                    {
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price) 
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                         priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                    }else{
                                       
                                        $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
                                    }
                           
                                     
                            }
                            else
                                {
                                  
                                var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                           
                                if(currency == 'USD'){
                               
                               var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                            }else if(currency == 'EURO')
                            {
                              var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                            }else{
                                
                                $(el.parent().find('.selected_price')).val(data.data.price) 
                                $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                                      priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                            $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                            }
                             var amtAdd = $(".amount");
                            }
                           var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                               var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                                $('.subTotal').html(subTotal.toFixed(2));
                                $('.totalAmount').html(subTotal.toFixed(2));
               
            }

        });
         }
        //  else{
        //   show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
        //   return false;  
        // }
     });
    $(document).on('change', '.group-material-6', function () {
         var el = $(this);
         var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
         var arrs = serises.split('-');  
         $('.group-material-7').removeClass('d-none');
        var id = $(this).val();
        var type = $(this).data('id');
        var parent = $(this).attr('id');
        var idValue =$(this).attr('id');
        
        if(id != 0)
        {
        //   var el = $(this);           
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
        ($(this).parent().parent().parent().parent().find('.group-material-7')).removeAttr('disabled');
            var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
            var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
            var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
            var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
            var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
            var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
            
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "parent":parent,
                "id": id,
                 "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                if(data.data.prefix == null)
                             {
                                var inids = $(el.parent().parent().parent().parent().parent().parent().find('.slname')).attr("name");
                                $(el.attr("name", inids+'[]'))
                             }
                     var inputLN = $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).attr("name");
                              $(el.parent().parent().parent().parent().parent().parent().find('.inputLN')).attr("name", inputLN);
                               if(data.data.is_length == 'on'){
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_inr')).val(data.data.price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_usd')).val(data.data.usd_price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_euro')).val(data.data.euro_price);
                              }
                              $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).val(data.data.is_length);
                              $(el.parent().parent().find('.inputLN')).val(data.data.is_length);
                     if(data.count != 0)
                        {
                         $('#group-material-8').empty();
                         $('#group-material-8').append(data.filter);
                         $('#group-material-8').removeClass('d-none');
                        console.log(data);
                        }else{
                            $('#group-material-8').empty();
                            $('#group-material-8').append(data.filter);
                            $('#group-material-8').removeClass('d-none');   
                        }
                    var sum = 0;
                            var totalAdd = '0.00';
                            var priceAdd = '0.00';
                       
                            var amtAdd = $(".amount");
                           
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            var qty = 0;
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                            var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
                            //  var serise =  $("#ordering-serise").val();
                             var arr = serise.split('-');
                             var mName = 'LSV';
                            //  console.log(""+arr)
                            //  console.log(""+arr[5])
                              if(typeof arr[3] === 'undefined'){
                                 
                                 arr[3] = data.data.prefix; 
                             }else{
                                
                                  arr[4] = data.data.prefix;
                              }
                             var finalval = (arr.join("-")); 
                             console.log(""+finalval)
                              localStorage.setItem('setItem',finalval);
                            // var newArr = ["HES","TS","RS","SS","GS","WS","PCS","CS","LL", "LRRP", "LFRP"];
                            //  if(jQuery.inArray(arr[6], newArr) !== -1)
                            //  {
                            //   $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }else{
                               $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }
                            if(arr.length  >= 7)
                            {
                               var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }else
                            {
                                 $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }
                            if(arrs.length  > 6)
                            {
                               var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                               if(currency == 'USD'){
                                   
                                     var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                       if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        { 
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
                                        }   
                                    }else if(currency == 'EURO')
                                    {
                                      var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
                                        }   
                                    }else{
                                    var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                        if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
                                        {   
                                         
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
                                        }  
                                       if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        {  
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                             $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                        }  
                                       if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                            $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                            priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                            totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                        }  
                                    }
                                     if(currency == 'USD'){
                                
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
                                    }else if(currency == 'EURO')
                                    {
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price)
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price) 
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                         priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                    }else{
                                       
                                        $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
                                    }
                                    
                           
                                     
                            }
                            else
                                {
                                  
                                 var totalAddUsd = 0;
                                 var  totalAddEuro = 0;
                            
                                if(currency == 'USD'){
                               
                               var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                            }else if(currency == 'EURO')
                            {
                              var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                            }else{
                                
                                $(el.parent().find('.selected_price')).val(data.data.price) 
                                $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                                      priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                            $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                            }
                             var amtAdd = $(".amount");
                            }
                            var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                                $('.subTotal').html(subTotal.toFixed(2));
                                $('.totalAmount').html(subTotal.toFixed(2));
                           
               
            }

        });
        }
        // else{
        //   show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
        //   return false;  
        // }
     });
     
    $(document).on('change', '.group-material-7', function () {
         var el = $(this);
         var serises =  $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
         var arrs = serises.split('-');
        var id = $(this).val();
        var type = $(this).data('id');
        var parent = $(this).attr('id');
        var idValue =$(this).attr('id');
        
        $('.group-material-8').removeClass('d-none');
        if(id != 0)
        {
        //  var el = $(this);            
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
        ($(this).parent().parent().parent().parent().find('.group-material-8')).removeAttr('disabled');
            var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
            var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
            var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
            var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
            var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
            var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
            
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                "parent":parent,
                "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                if(data.data.prefix == null)
                             {
                                var inids = $(el.parent().parent().parent().parent().parent().parent().find('.slname')).attr("name");
                                $(el.attr("name", inids+'[]'))
                             }
                    var firstChild = $('#specification-materials').children().first();
                     firstChild.after(data);
                    var sum = 0;
                            var totalAdd = '0.00';
                            var priceAdd = '0.00';
                       
                            var amtAdd = $(".amount");
                           var inputLN = $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).attr("name");
                              $(el.parent().parent().parent().parent().parent().parent().find('.inputLN')).attr("name", inputLN);
                              if(data.data.is_length == 'on'){
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_inr')).val(data.data.price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_usd')).val(data.data.usd_price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_euro')).val(data.data.euro_price);
                              }
                              $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).val(data.data.is_length);
                              $(el.parent().parent().find('.inputLN')).val(data.data.is_length);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            var qty = 0;
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                             var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
                            //  var serise =  $("#ordering-serise").val();
                             var arr = serise.split('-');
                             var mName = 'LSV';
                             if(typeof arr[4] === 'undefined'){
                                 
                                 arr[4] = data.data.prefix; 
                             }else{
                                
                                  arr[5] = data.data.prefix;
                              }
                             var finalval = (arr.join("-")); 
                              localStorage.setItem('setItem',finalval);
                             if(data.data.prefix == null){
                              var finalval = serise;   
                             }
                            
                            var newArr = ["HES","TS","RS","SS","GS","WS","PCS","CS","LL", "LRRP", "LFRP"];
                            //  if(jQuery.inArray(arr[7], newArr) !== -1)
                            //  {
                            //   $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }else{
                               $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }
                            if(arr.length  >= 8)
                            {
                               var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }else
                            {
                                 $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }
                            if(arrs.length  > 7)
                            {
                               var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                               if(currency == 'USD'){
                                   
                                     var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                       if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        { 
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
                                        }   
                                    }else if(currency == 'EURO')
                                    {
                                      var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
                                        }   
                                    }else{
                                    var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                        if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
                                        {   
                                         
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
                                        }  
                                       if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        {  
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                             $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                        }  
                                       if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                            $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                            priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                            totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                        }  
                                    }
                                     if(currency == 'USD'){
                                
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
                                    }else if(currency == 'EURO')
                                    {
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price) 
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                         priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                    }else{
                                       
                                        $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
                                    }
                                    
                           
                                     
                            }
                            else
                                {
                                  
                                var totalAddUsd = 0;
                                var  totalAddEuro = 0;
                            
                                if(currency == 'USD'){
                               
                               var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                            }else if(currency == 'EURO')
                            {
                              var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                            }else{
                                
                                $(el.parent().find('.selected_price')).val(data.data.price) 
                                $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                                      priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                            $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                            }
                             var amtAdd = $(".amount");
                            }
                            var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                                $('.subTotal').html(subTotal.toFixed(2));
                                $('.totalAmount').html(subTotal.toFixed(2));
                           
               
            }

        });
        }
        // else{
        //   show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
        //   return false;  
        // }
     });
    $(document).on('change', '.group-material-8', function () {
         var el = $(this);
         var serises =  $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
         var arrs = serises.split('-');
        var id = $(this).val();
       
        var type = $(this).data('id');
         var parent = $(this).attr('id');
        var idValue =$(this).attr('id');
        $('.group-material-9').removeClass('d-none');
        if(id != 0)
        {
        //  var el = $(this);            
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
        ($(this).parent().parent().parent().parent().find('.group-material-9')).removeAttr('disabled');
        var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
        var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
        var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
        var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
        var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
        var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
            
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                "parent":parent,
                "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                if(data.data.prefix == null)
                             {
                                 var inids = $(el.parent().parent().parent().parent().parent().parent().find('.slname')).attr("name");
                                $(el.attr("name", inids+'[]'))
                             }
                if(data.count != 0)
                        {
                         $('#group-material-9').empty();
                         $('#group-material-9').append(data.filter);
                         $('#group-material-9').removeClass('d-none');
                        console.log(data);
                        }else{
                            $('#group-material-9').empty();
                            $('#group-material-9').append(data.filter);
                            $('#group-material-9').removeClass('d-none');   
                        }
                    var sum = 0;
                            var totalAdd = '0.00';
                            var priceAdd = '0.00';
                       
                            var amtAdd = $(".amount");
                            var inputLN = $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).attr("name");
                              $(el.parent().parent().parent().parent().parent().parent().find('.inputLN')).attr("name", inputLN);
                              if(data.data.is_length == 'on'){
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_inr')).val(data.data.price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_usd')).val(data.data.usd_price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_euro')).val(data.data.euro_price);
                              }
                              $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).val(data.data.is_length);
                              $(el.parent().parent().find('.inputLN')).val(data.data.is_length);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            var qty = 0;
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                            var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
                            //  var serise =  $("#ordering-serise").val();
                             var arr = serise.split('-');
                             var mName = 'LSV';
                             if(typeof arr[5] === 'undefined'){
                                 
                                 arr[5] = data.data.prefix; 
                             }else{
                                
                                  arr[6] = data.data.prefix;
                              }
                             var finalval = (arr.join("-")); 
                              localStorage.setItem('setItem',finalval);
                             if(data.data.prefix == null){
                              var finalval = serise;   
                             }
                             
                            // var newArr = ["HES","TS","RS","SS","GS","WS","PCS","CS","LL", "LRRP", "LFRP"];
                            //  if(jQuery.inArray(arr[8], newArr) !== -1)
                            //  {
                            //   $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }else{
                               $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }
                            if(arr.length  >= 9)
                            {
                               var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }else
                            {
                                $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }
                            if(arrs.length  > 8)
                            {
                              var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                                if(currency == 'USD'){
                                   
                                     var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                       if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        { 
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
                                        }   
                                    }else if(currency == 'EURO')
                                    {
                                      var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
                                        }   
                                    }else{
                                    var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                        if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
                                        {   
                                          
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
                                        }  
                                       if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        {  
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                             $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                        }  
                                       if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                            $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                            priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                            totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                        }  
                                    }
                                     if(currency == 'USD'){
                                
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
                                    }else if(currency == 'EURO')
                                    {
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price) 
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                         priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                    }else{
                                       
                                        $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
                                    }
                                    
                           
                                     
                            }
                            else
                                {
                                  
                                var totalAddUsd = 0;
                                var  totalAddEuro = 0;
                           
                                if(currency == 'USD'){
                               
                               var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                            }else if(currency == 'EURO')
                            {
                              var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                            }else{
                                
                                $(el.parent().find('.selected_price')).val(data.data.price) 
                                $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                                      priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                            $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                            }
                             var amtAdd = $(".amount");
                            }
                            var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                                $('.subTotal').html(subTotal.toFixed(2));
                                $('.totalAmount').html(subTotal.toFixed(2));
                           
               
            }

        });
        }
        // else{
        //   show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
        //   return false;  
        // }
     });
    $(document).on('change', '.group-material-9', function () {
         var el = $(this);
         $('#group-material-10').removeClass('d-none');
         var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
         var arrs = serises.split('-');
        var id = $(this).val();
        var type = $(this).data('id');
        var parent = $(this).attr('id');
        var idValue =$(this).attr('id');
        
         if(id != 0)
         {
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
        ($(this).parent().parent().parent().parent().find('.group-material-10')).removeAttr('disabled');
        //  var el = $(this);  
         
            var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
            var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
            var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
            var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
            var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
            var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
            
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                "parent":parent,
                "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
               if(data.data.prefix == null)
                             {
                                var inids = $(el.parent().parent().parent().parent().parent().parent().find('.slname')).attr("name");
                                $(el.attr("name", inids+'[]'))
                             }
                if(data.count != 0)
                        {
                         $('#group-material-10').empty();
                         $('#group-material-10').append(data.filter);
                         $('#group-material-10').removeClass('d-none');
                        console.log(data);
                        }else{
                            $('#group-material-10').empty();
                            $('#group-material-10').append(data.filter);
                            $('#group-material-10').removeClass('d-none');   
                        }
                    var firstChild = $('#specification-materials').children().first();
                     firstChild.after(data);
                    var sum = 0;
                        var totalAdd = '0.00';
                            var priceAdd = '0.00';
                      
                            var amtAdd = $(".amount");
                            var inputLN = $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).attr("name");
                              $(el.parent().parent().parent().parent().parent().parent().find('.inputLN')).attr("name", inputLN);
                              if(data.data.is_length == 'on'){
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_inr')).val(data.data.price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_usd')).val(data.data.usd_price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_euro')).val(data.data.euro_price);
                              }
                              $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).val(data.data.is_length);
                              $(el.parent().parent().find('.inputLN')).val(data.data.is_length);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            var qty = 0;
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                             var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
                            //  var serise =  $("#ordering-serise").val().
                             var arr = serise.split('-');
                             var mName = 'LSV';
                            if(typeof arr[6] === 'undefined'){
                                 
                                 arr[6] = data.data.prefix; 
                             }else{
                                
                                  arr[7] = data.data.prefix;
                              }
                             var finalval = (arr.join("-")); 
                              localStorage.setItem('setItem',finalval);
                             if(data.data.prefix == null){
                              var finalval = serise;   
                             }
                            //  var newArr = ["HES","TS","RS","SS","GS","WS","PCS","CS","L", "L1", "L2"];
                            //  if(jQuery.inArray(arr[9], newArr) !== -1)
                            //  {
                               $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }else{
                            //   $(el.parent().parent().find('.withinput')).addClass('d-none');   
                            //  }
                            if(arr.length  >= 10)
                            {
                               var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }else
                            {
                                 $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(serise+'-'+data.data.prefix); 
                            }
                            if(arrs.length  > 9)
                            {
                               var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                               if(currency == 'USD'){
                                   
                                     var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                       if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        { 
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
                                        }   
                                    }else if(currency == 'EURO')
                                    {
                                      var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                      $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
                                        }   
                                    }else{
                                    var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                        if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
                                        {   
                                       
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
                                        }  
                                       if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        {  
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                             $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                        }  
                                       if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                            $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                            priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                            totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                        }  
                                    }
                                     if(currency == 'USD'){
                                
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
                                    }else if(currency == 'EURO')
                                    {
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price) 
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                         priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                    }else{
                                       
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price)
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))

                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
                                    }
                           
                                     
                            }
                            else
                                {
                                  
                                var totalAddUsd = 0;
                                var  totalAddEuro = 0;
                            
                                if(currency == 'USD'){
                               
                               var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                            }else if(currency == 'EURO')
                            {
                              var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                            }else{
                                
                                $(el.parent().find('.selected_price')).val(data.data.price) 
                                $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                                      priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                            $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                            }
                             var amtAdd = $(".amount");
                            }
                           var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                               var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                                $('.subTotal').html(subTotal.toFixed(2));
                                $('.totalAmount').html(subTotal.toFixed(2));
               
            }

        });
         }
        //  else{
        //   show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
        //   return false;  
        // }
     });
    $(document).on('change', '.group-material-10', function () {
         var el = $(this);
         var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
         var arrs = serises.split('-');
        var id = $(this).val();
        var type = $(this).data('id');
         var parent = $(this).attr('id');
        var idValue =$(this).attr('id');
        
        $('.group-material-11').removeClass('d-none');
         if(id != 0)
         {
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
        ($(this).parent().parent().parent().parent().find('.group-material-11')).removeAttr('disabled');
        //  var el = $(this);  
            var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
            var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
            var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
            var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
            var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
            var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
            
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                "parent":parent,
                "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                if(data.data.prefix == null)
                             {
                                 var inids = $(el.parent().parent().parent().parent().parent().parent().find('.slname')).attr("name");
                                $(el.attr("name", inids+'[]'))
                             }
                 if(data.count != 0)
                        {
                         $('#group-material-11').empty();
                         $('#group-material-11').append(data.filter);
                         $('#group-material-11').removeClass('d-none');
                        console.log(data);
                        }else{
                            $('#group-material-11').empty();
                            $('#group-material-11').append(data.filter);
                            $('#group-material-11').removeClass('d-none');   
                        }
                    var firstChild = $('#specification-materials').children().first();
                     firstChild.after(data);
                    var sum = 0;
                       var totalAdd = '0.00';
                            var priceAdd = '0.00';
                       
                            var amtAdd = $(".amount");
                            var inputLN = $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).attr("name");
                              $(el.parent().parent().parent().parent().parent().parent().find('.inputLN')).attr("name", inputLN);
                              if(data.data.is_length == 'on'){
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_inr')).val(data.data.price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_usd')).val(data.data.usd_price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_euro')).val(data.data.euro_price);
                              }
                              $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).val(data.data.is_length);
                            $(el.parent().parent().find('.inputLN')).val(data.data.is_length);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            var qty = 0;
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                             var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
                            //  var serise =  $("#ordering-serise").val().
                             var arr = serise.split('-');
                             var mName = 'LSV';
                             if(typeof arr[7] === 'undefined'){
                                 
                                 arr[7] = data.data.prefix; 
                             }else{
                                
                                 if(data.data.prefix != null){
                                      arr[8] = data.data.prefix;
                                 }
                              }
                             var finalval = (arr.join("-")); 
                              localStorage.setItem('setItem',finalval);
                             if(data.data.prefix == null){
                              var finalval = serise;   
                             }
                            
                            //  var newArr = ["HES","TS","RS","SS","GS","WS","PCS","CS","L2", "L1", "L"];
                            //  if(jQuery.inArray(arr[10], newArr) !== -1)
                            //  {data.
                               $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }
                            if(arr.length  >= 11)
                            {
                               var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }else
                            {
                                 $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }
                            if(arrs.length  > 10)
                            {
                               
                                var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                                if(currency == 'USD'){
                                   
                                     var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                       if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        { 
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
                                        }   
                                    }else if(currency == 'EURO')
                                    {
                                      var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
                                        }   
                                    }else{
                                    var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                        if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
                                        {   
                                         
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
                                        }  
                                       if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        {  
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                             $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                        }  
                                       if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                            $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                            priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                            totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                        }  
                                    }
                                     if(currency == 'USD'){
                                
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
                                    }else if(currency == 'EURO')
                                    {
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price) 
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                         priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                    }else{
                                       
                                        $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
                                    }
                           
                                     
                            }
                            else
                                {
                                  
                                var totalAddUsd = 0;
                                var  totalAddEuro = 0;
                            
                                if(currency == 'USD'){
                               
                               var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                            }else if(currency == 'EURO')
                            {
                              var pr = $(el.parent().find('.selected_price')).val(data.data.price)
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                            }else{
                                
                                $(el.parent().find('.selected_price')).val(data.data.price) 
                                $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                                      priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                            $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                            }
                             var amtAdd = $(".amount");
                            }
                           var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                               var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                                $('.subTotal').html(subTotal.toFixed(2));
                                $('.totalAmount').html(subTotal.toFixed(2));
               
            }

        });
         }
        //  else{
        //   show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
        //   return false;  
        // }
     });
    $(document).on('change', '.group-material-11', function () {
         var el = $(this);
         var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
         var arrs = serises.split('-');
        var id = $(this).val();
        var type = $(this).data('id');
        var parent = $(this).attr('id');
        var idValue =$(this).attr('id');
        
        $('.group-material-12').removeClass('d-none');
         if(id != 0)
         {
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
        ($(this).parent().parent().parent().parent().find('.group-material-12')).removeAttr('disabled');
        //  var el = $(this);  
            var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
            var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
            var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
            var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
            var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
            var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
            
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                "parent":parent,
                "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
               if(data.data.prefix == null)
                             {
                                var inids = $(el.parent().parent().parent().parent().parent().parent().find('.slname')).attr("name");
                                $(el.attr("name", inids+'[]'))
                             }
                     if(data.count != 0)
                        {
                         $('#group-material-12').empty();
                         $('#group-material-12').append(data.filter);
                         $('#group-material-12').removeClass('d-none');
                        console.log(data);
                        }else{
                            $('#group-material-12').empty();
                            $('#group-material-12').append(data.filter);
                            $('#group-material-12').removeClass('d-none');   
                        }
                    var firstChild = $('#specification-materials').children().first();
                     firstChild.after(data);
                    var sum = 0;
                       var totalAdd = '0.00';
                            var priceAdd = '0.00';
                       
                            var amtAdd = $(".amount");
                            var inputLN = $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).attr("name");
                              $(el.parent().parent().parent().parent().parent().parent().find('.inputLN')).attr("name", inputLN);
                              if(data.data.is_length == 'on'){
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_inr')).val(data.data.price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_usd')).val(data.data.usd_price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_euro')).val(data.data.euro_price);
                              }
                              $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).val(data.data.is_length);
                             $(el.parent().parent().find('.inputLN')).val(data.data.is_length);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            var qty = 0;
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                             var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
                            //  var serise =  $("#ordering-serise").val().
                             var arr = serise.split('-');
                             var mName = 'LSV';
                             if(typeof arr[7] === 'undefined'){
                                 
                                 arr[7] = data.data.prefix; 
                             }else{
                                
                                 if(data.data.prefix != null){
                                      arr[8] = data.data.prefix;
                                 }
                              }
                             var finalval = (arr.join("-")); 
                              localStorage.setItem('setItem',finalval);
                             if(data.data.prefix == null){
                              var finalval = serise;   
                             }
                            //  var newArr = ["HES","TS","RS","SS","GS","WS","PCS","CS","L2", "L1", "L"];
                            //  if(jQuery.inArray(arr[10], newArr) !== -1)
                            //  {data.
                               $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }
                            if(arr.length  >= 12)
                            {
                               var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }else
                            {
                                 $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }
                            if(arrs.length  > 11)
                            {
                               
                                var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                                if(currency == 'USD'){
                                   
                                     var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                       if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        { 
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
                                        }   
                                    }else if(currency == 'EURO')
                                    {
                                      var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
                                        }   
                                    }else{
                                    var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                        if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
                                        {   
                                         
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
                                        }  
                                       if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        {  
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                             $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                        }  
                                       if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                            $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                            priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                            totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                        }  
                                    }
                                     if(currency == 'USD'){
                                
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
                                    }else if(currency == 'EURO')
                                    {
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price) 
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                         priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                    }else{
                                       
                                        $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
                                    }
                           
                                     
                            }
                            else
                                {
                                  
                                var totalAddUsd = 0;
                                var  totalAddEuro = 0;
                            
                                if(currency == 'USD'){
                               
                               var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                            }else if(currency == 'EURO')
                            {
                              var pr = $(el.parent().find('.selected_price')).val(data.data.price)
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                            }else{
                                
                                $(el.parent().find('.selected_price')).val(data.data.price) 
                                $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                                      priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                            $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                            }
                             var amtAdd = $(".amount");
                            }
                           var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                               var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                                $('.subTotal').html(subTotal.toFixed(2));
                                $('.totalAmount').html(subTotal.toFixed(2));
               
            }

        });
         }
        //  else{
        //   show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
        //   return false;  
        // }
     });
    $(document).on('change', '.group-material-12', function () {
         var el = $(this);
         var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
         var arrs = serises.split('-');
        var id = $(this).val();
        var type = $(this).data('id');
        var parent = $(this).attr('id');
        var idValue =$(this).attr('id');
        
        $('.group-material-12').removeClass('d-none');
         if(id != 0)
         {
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
        ($(this).parent().parent().parent().parent().find('.group-material-12')).removeAttr('disabled');
        //  var el = $(this);  
            var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
            var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
            var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
            var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
            var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
            var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
            
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                "parent":parent,
                "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                if(data.data.prefix == null)
                             {
                                var inids = $(el.parent().parent().parent().parent().parent().parent().find('.slname')).attr("name");
                                $(el.attr("name", inids+'[]'))
                             }
                     if(data.count != 0)
                        {
                         $('#group-material-12').empty();
                         $('#group-material-12').append(data.filter);
                         $('#group-material-12').removeClass('d-none');
                        console.log(data);
                        }else{
                            $('#group-material-12').empty();
                            $('#group-material-12').append(data.filter);
                            $('#group-material-12').removeClass('d-none');   
                        }
                    var firstChild = $('#specification-materials').children().first();
                     firstChild.after(data);
                    var sum = 0;
                       var totalAdd = '0.00';
                            var priceAdd = '0.00';
                       
                            var amtAdd = $(".amount");
                            var inputLN = $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).attr("name");
                              $(el.parent().parent().parent().parent().parent().parent().find('.inputLN')).attr("name", inputLN);
                             if(data.data.is_length == 'on'){
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_inr')).val(data.data.price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_usd')).val(data.data.usd_price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_euro')).val(data.data.euro_price);
                              }
                              $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).val(data.data.is_length);
                             $(el.parent().parent().find('.inputLN')).val(data.data.is_length);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            var qty = 0;
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                             var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
                            //  var serise =  $("#ordering-serise").val().
                             var arr = serise.split('-');
                             var mName = 'LSV';
                             if(typeof arr[8] === 'undefined'){
                                 
                                 arr[8] = data.data.prefix; 
                             }else{
                                
                                 if(data.data.prefix != null){
                                      arr[9] = data.data.prefix;
                                 }
                              }
                             var finalval = (arr.join("-")); 
                            
                              localStorage.setItem('setItem',finalval);
                             if(data.data.prefix == null){
                              var finalval = serise;   
                             }
                            //  var newArr = ["HES","TS","RS","SS","GS","WS","PCS","CS","L2", "L1", "L"];
                            //  if(jQuery.inArray(arr[10], newArr) !== -1)
                            //  {data.
                               $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }
                            if(arr.length  >= 12)
                            {
                               var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }else
                            {
                                 $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }
                            if(arrs.length  > 11)
                            {
                               
                                var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                                if(currency == 'USD'){
                                   
                                     var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                       if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        { 
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
                                        }   
                                    }else if(currency == 'EURO')
                                    {
                                      var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
                                        }   
                                    }else{
                                    var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                        if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
                                        {   
                                         
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
                                        }  
                                       if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        {  
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                             $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                        }  
                                       if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                            $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                            priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                            totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                        }  
                                    }
                                     if(currency == 'USD'){
                                
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
                                    }else if(currency == 'EURO')
                                    {
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price) 
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                         priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                    }else{
                                       
                                        $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
                                    }
                           
                                     
                            }
                            else
                                {
                                  
                                var totalAddUsd = 0;
                                var  totalAddEuro = 0;
                            
                                if(currency == 'USD'){
                               
                               var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                            }else if(currency == 'EURO')
                            {
                              var pr = $(el.parent().find('.selected_price')).val(data.data.price)
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                            }else{
                                
                                $(el.parent().find('.selected_price')).val(data.data.price) 
                                $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                                      priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                            $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                            }
                             var amtAdd = $(".amount");
                            }
                           var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                               var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                                $('.subTotal').html(subTotal.toFixed(2));
                                $('.totalAmount').html(subTotal.toFixed(2));
               
            }

        });
         }
        //  else{
        //   show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
        //   return false;  
        // }
     });
    $(document).on('change', '.group-material-13', function () {
         var el = $(this);
         var serises =   $(el.parent().parent().parent().parent().parent().parent().find('.ordering-serise')).val();
         var arrs = serises.split('-');
        var id = $(this).val();
        var type = $(this).data('id');
        var parent = $(this).attr('id');
        var idValue =$(this).attr('id');
        
        $('.group-material-14').removeClass('d-none');
         if(id != 0)
         {
         if (idValue === 'print_img') {
             // Do something if the id value matches the desired value
            $('#image').addClass('d-none')                   
            $('#image-preview').removeClass('d-none')
                            }
        var tab = $(this).data('id');
        $(".comm-div").addClass('d-none');
        ($(this).parent().parent().parent().parent().find('.group-material-14')).removeAttr('disabled');
        //  var el = $(this);  
            var currency = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
            var oldPrice = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()   
            var oldAmount =  $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html();
            var oldPriceUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val() 
            var oldPriceEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val() 
            var oldPriceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
            
        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getspecificationPrice')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "id": id,
                "parent":parent,
                "tab":tab,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
                alert(data.data.is_length)
                if(data.data.prefix == null)
                             {
                                 var inids = $(el.parent().parent().parent().parent().parent().parent().find('.slname')).attr("name");
                                $(el.attr("name", inids+'[]'))
                             }
                    var firstChild = $('#specification-materials').children().first();
                     firstChild.after(data);
                    var sum = 0;
                       var totalAdd = '0.00';
                            var priceAdd = '0.00';
                       
                            var amtAdd = $(".amount");
                            var inputLN = $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).attr("name");
                              $(el.parent().parent().parent().parent().parent().parent().find('.inputLN')).attr("name", inputLN);
                             if(data.data.is_length == 'on'){
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_inr')).val(data.data.price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_usd')).val(data.data.usd_price);
                                $(el.parent().parent().parent().parent().parent().parent().find('.length_price_euro')).val(data.data.euro_price);
                              }
                              $(el.parent().parent().parent().parent().parent().parent().find('.check_length')).val(data.data.is_length);
                              $(el.parent().parent().find('.inputLN')).val(data.data.is_length);
                            $("#material_cost").val(sum);
                            $("#grand_total").val(sum);
                            var qty = 0;
                            $('.material_quantity').each(function(){
                            var value = parseFloat($(this).val()); // Parse the value to float
                            if (!isNaN(value)) { // Check if the value is a valid number
                                qty += value;
                            }
                            });
                            $("#quantity").val(qty)
                             var serise =   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val();
                            //  var serise =  $("#ordering-serise").val().
                             var arr = serise.split('-');
                             var mName = 'LSV';
                             if(typeof arr[8] === 'undefined'){
                                 
                                 arr[8] = data.data.prefix; 
                             }else{
                                
                                 if(data.data.prefix != null){
                                      arr[9] = data.data.prefix;
                                 }
                              }
                             var finalval = (arr.join("-")); 
                            
                              localStorage.setItem('setItem',finalval);
                             if(data.data.prefix == null){
                              var finalval = serise;   
                             }
                            //  var newArr = ["HES","TS","RS","SS","GS","WS","PCS","CS","L2", "L1", "L"];
                            //  if(jQuery.inArray(arr[10], newArr) !== -1)
                            //  {data.
                               $(el.parent().parent().find('.withinput')).removeClass('d-none');   
                            //  }
                            if(arr.length  >= 12)
                            {
                               var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }else
                            {
                                 $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                            }
                             if(data.data.is_length == ''){
                            if(arrs.length  > 11)
                            {
                               
                                var totalAddUsd = 0;
                               var  totalAddEuro = 0;
                                if(currency == 'USD'){
                                   
                                     var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                       if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' &&  parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        { 
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceUsd)).toFixed(2));
                                        }   
                                    }else if(currency == 'EURO')
                                    {
                                      var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                      if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPriceEuro)).toFixed(2));;
                                        }   
                                    }else{
                                    var newPrice = $(el.parent().find('.selected_price')).val();
                                        var newPriceUsd = $(el.parent().find('.selected_price_usd')).val();
                                        var newPriceEuro = $(el.parent().find('.selected_price_euro')).val();
                                        if(parseFloat(oldAmount) != '' && parseFloat(oldPrice) != '' && parseFloat(oldPrice)>=parseFloat(newPrice))
                                        {   
                                         
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val((parseFloat(oldPrice) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val((parseFloat(oldPriceInr) - parseFloat(newPrice)).toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html((parseFloat(oldAmount) - parseFloat(newPrice)).toFixed(2));
                                        }  
                                       if(parseFloat(oldPriceUsd)>=parseFloat(newPriceUsd))
                                        {  
                                           
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val((parseFloat(oldPriceUsd) - parseFloat(newPriceUsd)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_usd')).html((parseFloat(oldAmountUsd) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                             $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                        }  
                                       if(parseFloat(oldPriceEuro)>=parseFloat(newPriceEuro))
                                        {   
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val((parseFloat(oldPriceEuro) - parseFloat(newPriceEuro)).toFixed(2))
                                        // $(el.parent().parent().parent().parent().parent().parent().find('.amount_euro')).html((parseFloat(oldAmountEuro) - parseFloat(newPriceUsd)).toFixed(2));
                                        }else{
                                            $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                            priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                            totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                        }  
                                    }
                                     if(currency == 'USD'){
                                
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                       
                                    }else if(currency == 'EURO')
                                    {
                                      $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price) 
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                         $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                         priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                    }else{
                                       
                                        $(el.parent().find('.selected_price_usd')).val(data.data.usd_price) 
                                      $(el.parent().find('.selected_price_euro')).val(data.data.euro_price) 
                                      $(el.parent().find('.selected_price')).val(data.data.price)
                                       priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                                        
                                    }
                           
                                     
                            }
                            else
                                {
                                  
                                var totalAddUsd = 0;
                                var  totalAddEuro = 0;
                            
                                if(currency == 'USD'){
                               
                               var pr = $(el.parent().find('.selected_price')).val(data.data.price) 
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddUsd = (parseFloat(priceAdd) + parseFloat(data.data.usd_price))
                            }else if(currency == 'EURO')
                            {
                              var pr = $(el.parent().find('.selected_price')).val(data.data.price)
                                var prUsd = $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                var prEur = $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                               priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                     
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                                        $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                               totalAddEuro = (parseFloat(priceAdd) + parseFloat(data.data.euro_price))
                            }else{
                                
                                $(el.parent().find('.selected_price')).val(data.data.price) 
                                $(el.parent().find('.selected_price_usd')).val(data.data.usd_price);
                                $(el.parent().find('.selected_price_euro')).val(data.data.euro_price);
                                      priceAdd = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
                                       totalAdd = (parseFloat(priceAdd) + parseFloat(data.data.price))
                                       priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
                                       priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
                                       priceAddEuro = $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
                                       totalAddInr = (parseFloat(priceAddInr) + parseFloat(data.data.price))
                                      
                                       totalAddUsd = (parseFloat(priceAddUsd) + parseFloat(data.data.usd_price))
                                       totalAddEuro = (parseFloat(priceAddEuro) + parseFloat(data.data.euro_price))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val(totalAddInr.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val(totalAddUsd.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val(totalAddEuro.toFixed(2))
                                       $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAdd.toFixed(2))
                            $(el.parent().parent().parent().parent().parent().parent().find('.amount')).html(parseFloat(totalAdd).toFixed(2))
                            }
                             var amtAdd = $(".amount");
                            }
                             }
                           var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                               var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                                $('.subTotal').html(subTotal.toFixed(2));
                                $('.totalAmount').html(subTotal.toFixed(2));
               
            }

        });
         }
        //  else{
        //   show_toastr('Error', "<?php echo e(__('Please select another options!')); ?>", 'error');
        //   return false;  
        // }
     });
 $(document).on('click', '.enablebox', function () {
        var inids = $(this).parent().parent().parent().parent().parent().parent().find('.ids').attr("name");
        var indesc = $(this).parent().parent().parent().parent().parent().parent().find('.desc').attr("name");
           $(this).parent().parent().find('.inputId').attr("name", inids+'[]')
           $(this).parent().parent().find('.inputDesc').attr("name", indesc+'[]')
         $("#id_check").val(1);
            if (!$(this).is(":checked")) {
               $(this).parent().parent().find('.inputId').prop("disabled", true)
                $(this).parent().parent().find('.inputDesc').prop("disabled", true)
                }else{
                     $(this).parent().parent().find('.inputDesc').removeAttr('disabled');
                 $(this).parent().parent().find('.inputId').removeAttr('disabled');
                }
     });
    $(document).on('change', '.inputDesc', function () {
         var val = $(this).val();
         var sum = 0;
         var el = $(this);
        
        var perPrice =$(el.parent().parent().parent().parent().parent().parent().find('.length_price_inr')).val()
        var perPriceUsd =$(el.parent().parent().parent().parent().parent().parent().find('.length_price_usd')).val()
        var perPriceEuro =$(el.parent().parent().parent().parent().parent().parent().find('.length_price_euro')).val()
        var chkLength =$(el.parent().parent().find('.inputLN')).val()
       
        var cr = $(el.parent().parent().parent().parent().parent().parent().find('.selectcurrency')).val()
        alert(cr)
        priceAddInr = $(el.parent().parent().parent().parent().parent().parent().find('.price')).val()
        priceInr = $(el.parent().parent().parent().parent().parent().parent().find('.price_inr')).val()
        basePrice = $(el.parent().parent().parent().parent().parent().parent().find('.base_price')).val()
        var serise =  localStorage.getItem('setItem');
        $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serises")).val(serise);
        priceAddUsd = $(el.parent().parent().parent().parent().parent().parent().find('.price_usd')).val()
        priceAddEuro =$(el.parent().parent().parent().parent().parent().parent().find('.price_euro')).val()
     alert(perPrice)
  alert(val)
                            //  var serise =  $("#ordering-serise").val().
                if(chkLength != '' && typeof chkLength != 'undefined')
                {
                   
                             var arr = serise.split('-');
                             var co = arr.length;
                             var ll = arr[co-1];
                              arr[co-1] = ll+''+val;
                             console.log("sdfs"+arr.length);
                            
                          var finalval = (arr.join("-"));
                          console.log("final"+finalval);
                }
                         
            if (val != 0 && !isNaN(val) && val != '') {
                if(chkLength != '' && typeof chkLength != 'undefined')
                {
                   
                if(cr == 'INR') {
                  perPrice = perPrice ==0 ?0:perPrice;  
                }  
                 if(cr == 'USD') {
                  perPrice = perPriceUsd ==0 ?0:perPriceUsd;  
                }  
                 if(cr == 'EURO') {
                  perPrice = perPriceEuro ==0 ?0:perPriceEuro;  
                }  
               
                sum = val * perPrice;
           
                totalAddInr = (parseFloat(priceAddInr) + parseInt(sum))
                $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalAddInr.toFixed(2))
                $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(finalval); 
                $(".amount").html(totalAddInr.toFixed(2))
                $(".subTotal").html(totalAddInr.toFixed(2))
                $(".totalAmount").html(totalAddInr.toFixed(2))
                // $(this).val(sum);
                return true;
                }
                }else if(val == 0 || val == '' && perPrice == 0){
                 
                totalOld = (parseFloat(priceInr) + parseFloat(basePrice))   
                 $(el.parent().parent().parent().parent().parent().parent().find('.price')).val(totalOld)
                 alert(totalOld)
              alert(localStorage.getItem('setItem'))
                   var innns =  $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(localStorage.getItem('setItem')); 
                $(".amount").html(totalOld.toFixed(2))
                $(".subTotal").html(totalOld.toFixed(2))
                $(".totalAmount").html(totalOld.toFixed(2))  
                }
                else{
                   
                   $(el.parent().parent().parent().parent().parent().parent().find(".ordering-serise")).val(localStorage.getItem('setItem')); 
                return true;
                
                }
     });
    </script>

    <script>
     $(document).on('click', '#checkradio3', function () {
            
            if($(this).is(':checked')){
              $("#p_fs").removeAttr('disabled');  
            }else{
                $("#p_fs").attr('disabled', 'disabled');
            }
            // $("#p_fs").attr('disabled', 'disabled');
        });
        $(document).on('change', '#pfs_options', function () {
            var v = $(this).val();
            $("#p_fs").val(v);
           
        });
         $(document).on('click', '#checkradio5', function () {
            
            if($(this).is(':checked')){
              $("#payment").removeAttr('disabled');  
            }else{
                $("#payment").attr('disabled', 'disabled');
            }
            // $("#p_fs").attr('disabled', 'disabled');
        });
   $(document).on('change', '.selectOptionIntegral', function () {
            var v = $(this).val();
            
         if(v == 'rmt1' || v == 'rmt2'){
            if(v== 'rmt1'){
                $(this).parent().parent().parent().parent().find('.fd_cd').empty();  
              var opt =  '<option value="">choose</option><option value="fd" disabled>FD</option><option value="cd">CD</option>';
                $(this).parent().parent().parent().parent().find('.fd_cd').append(opt) 
            }else{
                $(this).parent().parent().parent().parent().find('.fd_cd').empty();  
              var opt =  '<option value="">choose</option><option value="fd">FD</option><option value="cd" disabled>CD</option>';
               $(this).parent().parent().parent().parent().find('.fd_cd').append(opt)   
            }
            $(this).parent().parent().parent().parent().find('.fd_cd_options').removeClass('d-none');  
            $(this).parent().parent().parent().parent().find('.group-material-0').addClass('d-none');
         }else{
              $(this).parent().parent().parent().parent().find('.fd_cd_options').addClass('d-none');
             $(this).parent().parent().parent().parent().find('.group-material-0').removeClass('d-none');  
         }
            
           
        });
         $(document).on('change', '.fd_cd', function () {
            var v = $(this).val();
            var el = $(this);
        if(v == 'cd' || v == 'fd')
        {
         $(el.parent().parent().parent().parent().find('.group-material-0')).removeClass('d-none');    
        }
        });
        
        $(document).on('click', '[data-repeater-delete]', function () {
            $(".price").change();
            $(".discount").change();
        });
         $(document).on('change', '.AppSelect', function () {
         $(this).parent().parent().parent().find('.AppText').css('display', 'block')
           });
    </script>
<?php $__env->stopPush(); ?>
<?php

?>
<?php $__env->startSection('content'); ?>
    <div class="row">
      
        <?php echo e(Form::open(['route' => ['quotation.store.new'], 'method' => 'post', 'id'=>'customerForm'] )); ?>

        <div class="col-12">
            <input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">
            
            <!--Key-->
            <div class="card">
                 <div class="card-header">
                                      
                     <h5><?php echo e(__('Key Point')); ?></h5>
                  </div>
                <div class="card-body">
                    <?php
                    $Cdata = \Carbon\Carbon::now()->format('Y-m-d');
                   
                    ?>
                    <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('quotation_number', __('Quote Ref No.'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('quotation_number', $quotation_number, ['class' => 'form-control', 'readonly' => 'readonly'])); ?>


                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('quotation_date', __('Quote Date'),['class'=>'form-label'])); ?>

                                       <?php echo e(Form::date('quotation_date',$Cdata,array('class'=>'form-control','required'=>'required'))); ?>


                                    </div>
                                </div>
                                
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                         <?php echo e(Form::label('enquiry_ref', __('Enquiry Ref'),['class'=>'form-label'])); ?>

                                         <?php if(!empty($lead->products())): ?>
                                                 <?php $__currentLoopData = $lead->sources(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                 
                                                   <?php echo e(Form::text('enquiry_ref', $source->name, ['class' => 'form-control'])); ?>

                                                   <?php if(!$loop->last): ?>
                                                        ,
                                                    <?php endif; ?>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   <?php else: ?>
                                                    <?php echo e(Form::text('enquiry_ref', null, ['class' => 'form-control'])); ?>

                                                   <?php endif; ?>
                                       
                                       

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php
                                $txtno = $leadCustomer?$leadCustomer->tax_number:'';
                                $zip = $leadCustomer?$leadCustomer->billing_zip:'';
                                $city =$leadCustomer?$leadCustomer->billing_city:'';
                                $state =$leadCustomer?$leadCustomer->billing_state:'';
                                $country =$leadCustomer?$leadCustomer->billing_country:'';
                                $cprefix =$leadCustomer?$leadCustomer->prefix:'';
                               
                                ?>
                                    <div class="form-group">
                                    <?php echo e(Form::label('customer_id', __('GST Number'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::text('gst_number',$txtno, array('class' => 'form-control select'))); ?>

                                    </div>
                            </div>
                    </div>
                </div>
                
            <!--Organizations-->
             <div class="card">
                 <div class="card-header">
                                      
                     <h5><?php echo e(__('Organization Details')); ?></h5>
                  </div>
                <div class="card-body">
                    
                    <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('company_name', __('Company Name'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                        <?php echo e(Form::text('company_name', $lead->industry_name, ['class' => 'form-control','required'=>'required' ])); ?>


                                    </div>
                                </div>
                                <div class="col-md-4">
                                    
                                    
                                    <div class="form-group">
                                        <?php echo e(Form::label('phone', __('Number'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                        <?php echo e(Form::text('company_phone', $lead->phone, array('class' => 'form-control','id'=>'phone', 'required'=>'required' , 'placeholder' => __('Enter Phone'), 'style' => 'padding-left:90px'))); ?>

                                    </div>
                                </div>
                                  <div class="col-md-4">
                                   <div class="form-group">
                                        <?php echo e(Form::label('email', __('Email'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                        <?php echo e(Form::text('company_email', $lead->email, ['class' => 'form-control','required'=>'required'])); ?>


                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('ploat_no', __('Plot No.'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                        <?php echo e(Form::text('plot', null, ['class' => 'form-control','required'=>'required'])); ?>


                                    </div>
                                </div>
                            
                            <div class="col-md-4">
                                    <div class="form-group">
                                    <?php echo e(Form::label('street_name', __('Street Name'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                    <?php echo e(Form::text('street',null, array('class' => 'form-control select','required'=>'required','required'=>'required'))); ?>

                                    </div>
                            </div>
                             <div class="col-md-4">
                                    <div class="form-group">
                                    <?php echo e(Form::label('area_name', __('Area Name'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::text('area', null, array('class' => 'form-control select','required'=>'required','required'=>'required'))); ?>

                                    </div>
                            </div>
                            <div class="col-md-4">
                                <input type="hidden" value="<?php echo e($leadCustomer?$leadCustomer->lead_id:0); ?>" name="lead_id">
                                    <div class="form-group">
                                    <?php echo e(Form::label('pincode', __('Pincode'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                    <?php echo e(Form::text('pin', $zip, array('class' => 'form-control select','required'=>'required'))); ?>

                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                    <?php echo e(Form::label('city', __('City'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                    <?php echo e(Form::text('city', $city, array('class' => 'form-control select','required'=>'required'))); ?>

                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                    <?php echo e(Form::label('state', __('State'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                    <?php echo e(Form::text('state', $state, array('class' => 'form-control select','required'=>'required'))); ?>

                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                    <?php echo e(Form::label('country', __('Country'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                    <?php echo e(Form::text('country', $country, array('class' => 'form-control select','required'=>'required'))); ?>

                                    </div>
                            </div>
                            <div class="col-md-4">
                                 <select style="padding:10px;position:absolute;margin-top: 30px;background: white;border: 0px;margin-left: 5px;" name="prefix">
                            <option value="Mr." <?php echo e($cprefix == 'Mr.'?'selected': ''); ?>>Mr.</option>
                            <option value="Mrs." <?php echo e($cprefix == 'Mrs.'?'selected': ''); ?>>Mrs.</option>
                            <option value="Ms." <?php echo e($cprefix == 'Ms.'?'selected': ''); ?>>Ms.</option>
                            </select>
                                    <div class="form-group">
                                    <?php echo e(Form::label('attention', __('Kind Attention'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                                    <?php echo e(Form::text('attention', $lead->customer->name, array('class' => 'form-control select','required'=>'required', 'style' => 'padding-left:90px'))); ?>

                                    </div>
                            </div>
                    </div>
                </div>    
            </div>
            
            <!--Subject-->
            <?php
            $description = preg_replace('/<\/?p>/', '', $lead->notes);

    // Remove <br>, <br/> and <br /> tags
    $description = preg_replace('/<br\s*\/?>/', '', $description);
            ?>
            <div class="card">
                 <div class="card-header">
                                      
                     <h5><?php echo e(__('Subject')); ?></h5>
                  </div>
                <div class="card-body">
                    <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                       <?php echo e(Form::label('subject', __('Add Subject'),['class'=>'form-label'])); ?>

                                       <div class="form-group">
                                          <?php echo e(Form::textarea('subject', $description, ['class' => 'form-control summernote-simple', 'style' => 'width: 100%;','placeholder' => __('Enter Description')])); ?>

                                          
                                          </div>
 
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
            <?php if($lead->is_indiamart == 1): ?>
            <?php
            $product = $lead->products;
            ?>
           
            <?php else: ?>
           <?php
            $pp = explode(',', $lead->products);
            // dd($pp);
            if(count($pp)>0)
            {
            $p = \App\Models\ProductService::find($pp[0]);
            $product = !empty($p)?$p->name:'';
            }
           ?>
            <?php endif; ?>
            <!--Quotation Template-->
             <div class="card">
                 <div class="card-header">
                                      
                     <h5><?php echo e(__('Quotation Template')); ?></h5>
                  </div>
                <div class="card-body">
                    <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                       <?php echo e(Form::label('quotation_template', __('Add Content'),['class'=>'form-label'])); ?>

                            <div class="form-group">
                             <textarea class="'form-control summernote-simple" rows="10" name="quotation_template" style="width: 100%;">
                            Dear <?php echo e($lead->customer->name); ?> <?php echo e($lead->customer->prefix == 'Mr.'?'Sir':(($lead->customer->prefix == 'Mrs.')?'Madam':(($lead->customer->prefix == 'Ms.'?'Sister':'')))); ?> with reference to your enquiry for Requirment of <?php echo e($product); ?>, we are please to submit here unde our offer 
                            for the same.
                            "TRUMEN" is an ISO 9001-2015  manufacturer and experier at level control instruments and our list of instrument
                            </textarea>
                            </div>

                                    </div>
                                </div>
                    </div>
                </div>
            </div>
            
            <!--Terms & Conditions-->
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
                              
                                <div class="col-md-4" style="height: 3.5rem;">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        1. <?php echo e(Form::label('terms_price', __('Price'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-8" style="height: 3.5rem;">
                                    <div class="form-group row">
                                          <div class="col-md-6 form-group">
                                          <?php echo e(Form::text('terms_price','FOR Site', ['class'=>'form-control','placeholder'=>__('Ex Works, Indore.'), 'id' => 'terms_price','required'=>'required','readonly'])); ?>

                                            </div>
                                           <div class="col-sm-6 commp"></div>
                                    </div>
                                </div>
                                <hr style="margin-bottom: 0rem;">
                                <div class="col-md-4" style="display:none;" id="pandf3">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        2. <?php echo e(Form::label('p_f', __('P & F'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-8" style="display:none;margin-top: 1rem;" id="pandf4">
                                    <div class="form-group row" style="height: 3.5rem;">
                                          
                                          <div class="col-md-6 form-group">
                                            <?php echo e(Form::text('p_fss','Extra @',  ['class'=>'form-control','id' => 'p_f1','placeholder'=>__('Enter Packing Ex: 25%.')])); ?>

                                            </div>
                                            
                                           <div class="col-sm-6 commp"> % AIRWORTHY EXPORT PACKING <input type="radio" name="check" checked id="checkradio1"></div>
                                    </div>
                                    <div class="form-group row" style="height: 2.5rem;">
                                   
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
                                   <div class="form-group row" style="height: 2.5rem;margin-top: 1rem;">
                                       
                                        <div class="col-sm-6">
                                        <select name="pfs_options" id="pfs_options" class="form-control">
                                          
                                           <option value="2.5" selected>Extra @ 2.5%</option>
                                           <option value="nil">nil</option>
                                           
                                       </select>
                                        </div>
                                        
                                        <div class="col-sm-1 commp">
                                          Edit: <input type="checkbox" name="check" id="checkradio3">
                                        </div>
                                      
                                    <div class="col-sm-4">
                                      <?php echo e(Form::text('p_fs', 'Extra @ 2.5%',['class'=>'form-control','disabled','id' => 'p_fs'])); ?>

                                    </div>
                                    
                                         <div class="col-sm-1 commp"></div>
                                        
                                  </div>
                                    
                                </div>
                                 <hr>
                                <div class="col-md-4 text-center" id="taxes1" style="height: 3.5rem;">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        3. <?php echo e(Form::label('taxes', __('Taxes'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-8" id="taxes2" style="height: 3.3rem;">
                                      <div class="form-group row">
                                          
                                          <div class="col-md-6 form-group">
                                            <?php echo e(Form::text('taxes','GST @ 18%', ['class'=>'form-control','required'=>'required'])); ?> 
                                            </div>
                                            <div class="col-md-6 form-group commp">
                                           
                                            </div>
                                          </div>
                                    
                                </div>
                                 <hr>
                               
                                <div class="col-md-4 text-center" id="freight1" style="height: 3.3rem;">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        4. <?php echo e(Form::label('freight', __('Freight'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-8" id="freight2" style="height: 3.3rem;">
                                    <div class="form-group row">
                                          <div class="col-md-6 form-group">
                                          <?php echo e(Form::text('freight','Extra at actual through your approved freight carrier.', ['id' => 'freight', 'class'=>'form-control','placeholder'=>__('Extra at actual through your approved freight carrier.')])); ?>

                                            </div>
                                           <div class="col-sm-6 commp"></div>
                                    </div>
                                   
                                </div>
                                  <hr>
                                <div class="col-md-4">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;height: 2.5rem;">
                                        5. <?php echo e(Form::label('transit_insurance', __('Transit Insurance'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-8" style="height: 2.5rem;">
                                     <div class="form-group row">
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
                                 <div class="col-md-4" style="display:none;margin-top: 1rem;" id="bank1">
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
                                 
                                <div class="col-md-4 text-center" style="height: 3.5rem;">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        7. <?php echo e(Form::label('delivery', __('Delivery'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                               
                                <div class="col-md-8" style="height: 3.5rem;">
                                    <div class="form-group row">
                                          <div class="col-sm-1 commp">Within</div> 
                                          <div class="col-md-5 form-group">
                                            <?php echo e(Form::text('delivery',null,['class'=>'form-control','required'=>'required','placeholder'=>__('Enter Delivery Weeks Ex: 5.')])); ?> 
                                            </div>
                                            
                                           <div class="col-sm-6 commp">Weeks after received of confirm order.</div>
                                    </div>
                                   
                                </div>
                                 <hr>
                                 
                                 <div class="col-md-4 text-center" style="height: 3.5rem;">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        8. <?php echo e(Form::label('payment', __('Payment'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                
                                <div class="col-md-8" style="height: 3.5rem;">
                                    <div class="form-group row">
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
                                          Edit: <input type="checkbox" name="check" id="checkradio5">
                                        </div>
                                      
                                        <div class="col-sm-5">
                                          <?php echo e(Form::text('payments','100%',['class'=>'form-control','disabled','id' => 'payment'])); ?>

                                        </div>
                                    </div>
                                    
                                </div>
                                 <hr>
                                <div class="col-md-4 text-center" style="height: 3.5rem;">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        9. <?php echo e(Form::label('warranty', __('Warranty'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                
                                <div class="col-md-8" style="height: 3.6rem;">
                                     <div class="form-group row">
                                          <div class="col-md-6 form-group">
                                             <?php echo e(Form::number('warranty','12', ['class'=>'form-control','placeholder'=>__('Enter Payment Ex: 12.')])); ?>

                                            </div>
                                           <div class="col-sm-6">Months from the date of commissioning or <br>Fifteen months from the date of supply which ever is earlier.</div>
                                    </div>
                                </div>
                                 <hr>
                                <div class="col-md-4 text-center" style="height: 3.5rem;">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        10. <?php echo e(Form::label('validity', __('Validity of Offer'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                 
                                <div class="col-md-8" style="height: 3.5rem;">
                                     <div class="form-group row">
                                          <div class="col-md-6 form-group">
                                            <?php echo e(Form::number('validity','30',['class'=>'form-control','placeholder'=>__('Enter Validity')])); ?> 
                                            </div>
                                           <div class="col-sm-6 commp">Days.</div>
                                    </div>
                                   
                                </div>
                                 <hr>
                                <div class="col-md-4 text-center" style="height: 3.5rem;">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        11. <?php echo e(Form::label('release_po', __('Release of PO'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                
                                <div class="col-md-8" style="height: 3.5rem;">
                                    <div class="form-group row">
                                          <div class="col-md-6 form-group">
                                            <?php echo e(Form::text('release_po','Formal order mentioning your delivery address and dispatch instructions.',['class'=>'form-control','placeholder'=>__('Enter Release PO')])); ?> 
                                            </div>
                                            <div class="col-md-6 form-group"></div>
                                    </div>
                                    
                                </div>
                                 <hr>
                                <div class="col-md-4 text-center" style="height: 3.5rem;">
                                    <div class="form-group" style="margin-left: 160px;text-align: justify;">
                                        12. <?php echo e(Form::label('cancellation', __('Cancellation Charges'),['class'=>'form-label'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-8" style="height: 3.5rem;">
                                    <div class="form-group row">
                                          <div class="col-md-6 form-group">
                                            <?php echo e(Form::text('cancellation','50%',['class'=>'form-control','placeholder'=>__('Enter Cancellation Ex: 50%.')])); ?> 
                                            </div>
                                           <div class="col-sm-6">of PO amount to be paid if cancelled after order acceptance.</div>
                                    </div>
                                   
                                </div>
                                <hr>
                               
                </div>
            </div>
            </div>
            <?php
            $leadNm =!empty($leadCustomer)?$leadCustomer->name:'';
             $leadAdd =!empty($leadCustomer)?$leadCustomer->billing_address:'';
              $leadNu =!empty($leadCustomer)?$leadCustomer->contact:'';
              $leadEm =!empty($leadCustomer)?$leadCustomer->email:'';
              $Uaddress = \App\Models\User::find(auth()->user()->id);
             
            ?>
            <!--Sender Address-->
             <div class="card">
                 <div class="card-header">
                                      
                     <h5><?php echo e(__('Sender Address')); ?></h5>
                  </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="customer_id" value="<?php echo e($leadCustomer?$leadCustomer->id:0); ?>">
                               <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('sender_name', __('Sender Name'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('sender_name',auth()->user()->name, ['class' => 'form-control'])); ?>


                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <?php echo e(Form::label('address', __('Address'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('address',!empty($Uaddress->employee)?$Uaddress->employee->address:auth()->user()->address, ['class' => 'form-control'])); ?>


                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('sender_number', __('Number'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('contact',!empty($Uaddress->employee)?$Uaddress->employee->phone:auth()->user()->contact, ['class' => 'form-control', 'id' => 'sender_phone'])); ?>


                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('sender_email', __('Email'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('sender_email',auth()->user()->email, ['class' => 'form-control'])); ?>


                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('sender_website', __('Website'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('sender_website', 'www.trumen.com', ['class' => 'form-control'])); ?>


                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        <?php
        $applications = [
        'sand' => 'Sand', 'liquid' => 'Liquid', 'solid' => 'Solid'
        ];
        ?>
        <div class="col-12">
            <h5 class=" d-inline-block mb-4" style="padding-left: 30px;"><?php echo e(__('Product & Services')); ?></h5>
            <div class="card repeater" data-value=''>
                <div class="item-section py-2">
                    <div class="row justify-content-between align-items-center">
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
                        <table class="table mb-0" data-repeater-list="items" id="   ">
                            <thead class="thead-dark">
                            <tr>
                                <th><?php echo e(__('Add Product')); ?></th>
                                <th style="width:25%;"><?php echo e(__('Model')); ?></th>
                                <th><?php echo e(__('Application')); ?></th>
                                <th></th>
                                <th><?php echo e(__('HSN Code')); ?></th>
                                <th style="width:5%;"><?php echo e(__('Qty')); ?></th>
                                <th><?php echo e(__('Unit Rate')); ?> </th>
                               
                                <th class="text-end"><?php echo e(__('Total')); ?> <span class="cSymbol">(<?php echo e(\Auth::user()->currencySymbol()); ?>)</span></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="ui-sortable" data-repeater-item>
                            <tr>
                                <td width="20%" class="form-group pt-1">
                                    <div class="item_div">
                                        
                                        <?php echo e(Form::select('item', $product_services,'', array('class' => 'form-control select2 item','data-url'=>route('quotation.product'),'required'=>'required','style' => 'margin-bottom: 13px;'))); ?>

                                    </div>
                                </td>
                                 <td width="25%">
                                    <div class="form-group">
                                        <?php echo e(Form::text('model','', array('class' => 'form-control model ordering-serise', 'required'=>'required','placeholder'=>__('Model'),'required'=>'required'))); ?>

                                         <?php echo e(Form::hidden('models','', array('class' => 'form-control models ordering-serises','placeholder'=>__('Model')))); ?>

                                       
                                    </div>
                                </td>
                                 <td>
                                    <div width="10%" class="form-group pt-1">
                                        <?php echo e(Form::select('application', $applications,'null', array('class' => 'form-control select2 AppSelect','required'=>'required'))); ?>

                                       
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group pt-1 AppText" style="width: 103px;display:none;">
                                        <?php echo e(Form::text('application_text',null, array('class' => 'form-control','placeholder'=>__('Application')))); ?>

                                       
                                    </div>
                                </td>
                                 <td width="13%">
                                    <div class="form-group">
                                        <?php echo e(Form::text('hsn_code','', array('class' => 'form-control hsnCode','required'=>'required','placeholder'=>__('HSN Code'),'required'=>'required'))); ?>

                                       
                                    </div>
                                </td>
                               <td width="13%">
                                    <div class="form-group price-input input-group search-form"  style="width: 50px;">
                                    <?php echo e(Form::text('quantity','', array('class' => 'form-control quantity','required'=>'required','placeholder'=>__('Qty'),'required'=>'required'))); ?>

                                       
                                    </div>
                                </td>
                                <td width="20%">
                                    <div class="form-group price-input input-group search-form">
                                        <?php echo e(Form::hidden('slname','', array('class' => 'form-control slname'))); ?>

                                        <?php echo e(Form::hidden('slid','', array('class' => 'form-control slid'))); ?> 
                                        <?php echo e(Form::hidden('desc','', array('class' => 'form-control desc'))); ?>

                                        <?php echo e(Form::hidden('ids','', array('class' => 'form-control ids'))); ?>  
                                        <?php echo e(Form::text('price','', array('class' => 'form-control price','placeholder'=>__('Price'),'required'=>'required', 'readonly'))); ?>

                                        <?php echo e(Form::hidden('group_id','', array('class' => 'form-control group_id'))); ?>

                                        <?php echo e(Form::hidden('model_prefix','', array('class' => 'form-control model_prefix'))); ?>

                                        <?php echo e(Form::hidden('price_usd','0.00', array('class' => 'form-control price_usd'))); ?>

                                        <?php echo e(Form::hidden('price_euro','0.00', array('class' => 'form-control price_euro'))); ?>

                                        <?php echo e(Form::hidden('price_inr','0.00', array('class' => 'form-control price_inr'))); ?>

                                        <?php echo e(Form::hidden('base_price','0.00', array('class' => 'form-control base_price'))); ?>

                                        <?php echo e(Form::hidden('base_price_usd','0.00', array('class' => 'form-control base_price_usd'))); ?>

                                        <?php echo e(Form::hidden('base_price_euro','0.00', array('class' => 'form-control base_price_euro'))); ?>

                                        <?php echo e(Form::hidden('base_serial','0.00', array('class' => 'form-control base_serial'))); ?>

                                        <div class="inline-container" style=" display: flex;align-items: center;gap: 10px;">
                                       
                                        <select class="form-control selectcurrency" name="currency" style="border-radius: 3px;width: 57px;">
                                            <option value="INR" selected>₹</option>
                                            <option value="USD">$</option>
                                            <option value="EURO">€</option>
                                        </select>
                                            </div>   
                                           
                                        
                                         <?php echo e(Form::hidden('product_model_id','', array('class' => 'form-control product_model_id'))); ?>

                                         <?php echo e(Form::hidden('m_price','', array('class' => 'form-control m_price'))); ?>

                                         <?php echo e(Form::hidden('length_price','0.00', array('class' => 'form-control length_price'))); ?>

                                          <?php echo e(Form::hidden('length_price_inr','0.00', array('class' => 'form-control length_price_inr'))); ?>

                                         <?php echo e(Form::hidden('length_price_usd','0.00', array('class' => 'form-control length_price_usd'))); ?>

                                         <?php echo e(Form::hidden('length_price_euro','0.00', array('class' => 'form-control length_price_euro'))); ?>

                                         <?php echo e(Form::hidden('usd_sale_price','', array('class' => 'form-control usd_sale_price'))); ?>

                                         <?php echo e(Form::hidden('euro_sale_price','', array('class' => 'form-control euro_sale_price'))); ?>

                                         
                                    </div>
                                </td>
                                    
                                        <?php echo e(Form::hidden('discount','', array('class' => 'form-control discount','required'=>'required','placeholder'=>__('Discount')))); ?>

                                      

                                <td class="text-end amount">
                                    0.00
                                </td>
                                <td>
                                    <a href="#" class="ti ti-trash text-white text-white repeater-action-btn bg-danger ms-2" data-repeater-delete></a>
                                </td>
                            </tr>
                            <tr class="integral d-none">
                                <td colspan="1" style="padding-left: 50px;">
                                    <div class="form-group"> 
                                    <label for="selectOptionIntegral">Integral/Slit/Flexible</label>
                                    </div>
                                </td>
                                <td colspan="5" style="padding-left: 30px;">
                                 <div class="form-group"> 
                                   <select class="form-control selectOptionIntegral" name="integral" style="width: 395px;">
                                        <option value="">Choose option</option>
                                        <option value="int">(Int) Standard integral type</option>
                                        <option value="rmt1">Rmt1</option>
                                        <option value="rmt2">Rmt2</option>
                                    </select></div>
                                </td>
                                <td colspan="1"></td>
                            </tr>
                            <tr class="fd_cd_options d-none">
                                    <td colspan="1" class="fd_cd_options d-none" style="padding-left: 45px;">
                                    <div class="form-group"> 
                                    <label for="fd_cd">Select Field/Controlling type</label>
                                    </div>
                                </td>
                                 <td colspan="5" class="fd_cd_options d-none" style="padding-left: 35px;">
                                 <div class="form-group"> 
                                   
                                    <select class="form-control fd_cd" name="fd_cd" style="width: 395px;">
                                        <option value="fd">FD</option>
                                        <option value="cd">CD</option>
                                       
                                    </select></div>
                                </td>  
                                 <td colspan="1"></td>
                                </tr>
                            <tr>
                               
                                
                                
                                <td colspan="7">
                                 <div class="main-specification" style="overflow-y: scroll;height: 400px;"></div>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td> 
                                <div class="inline-container" style=" display: flex;align-items: center;gap: 10px;">
                                    <label for="selectOption">Discount:</label>
                                    <select id="selectOption" class="form-control" name="discount_type" id="discount_type">
                                        <option value="flat">Flat</option>
                                        <option value="percent">Percent(%)</option>
                                    </select>
                                </div>
                                  <?php echo e(Form::hidden('id_check','0', array('class' => 'form-control','placeholder'=>__('Discount'), 'id' => 'id_check'))); ?>

                                       
                               </td>
                              
                                <td> <?php echo e(Form::text('manual_discount','', array('class' => 'form-control manual_discount','placeholder'=>__('Enter Discount'),'id' =>'mDiscount'))); ?></td>
                                <td></td>
                                <td></td>
                                <td><strong><?php echo e(__('Sub Total')); ?> </strong></td>
                                <td class="text-end subTotal">0.00 </td>
                                <td><span class="cSymbol"><?php echo e(\Auth::user()->currencySymbol()); ?></span></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td><strong><?php echo e(__('Discount')); ?></strong></td>
                                <td class="text-end totalDiscount">0.00 </td>
                                <td><span class="cSymbol"><?php echo e(\Auth::user()->currencySymbol()); ?></span></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td><strong><?php echo e(__('Tax')); ?> </strong></td>
                                <td class="text-end totalTax">0.00 </td>
                                <td><span class="cSymbol"><?php echo e(\Auth::user()->currencySymbol()); ?></span></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="blue-text"><strong><?php echo e(__('Total Amount')); ?></strong></td>
                                <td class="blue-text text-end totalAmount">0.00 </td>
                                <td><span class="cSymbol"><?php echo e(\Auth::user()->currencySymbol()); ?></span></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" onclick="location.href = '<?php echo e(route("quotation.index")); ?>';" class="btn btn-light">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
        </div>
    <?php echo e(Form::close()); ?>

    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
   <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
   <?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/quotation/quotation_create.blade.php ENDPATH**/ ?>
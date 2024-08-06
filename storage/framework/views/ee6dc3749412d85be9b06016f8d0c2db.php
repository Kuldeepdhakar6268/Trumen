<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Order Detail')); ?>

<?php $__env->stopSection(); ?>
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
<?php $__env->startPush('script-page'); ?>
 <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
  <script src="<?php echo e(asset('public/js/jquery-barcode.js')); ?>"></script>
    <script>
    
    
            
               $(document).on('change', '.change_status', function () {
            
                var status = $(this).val();
                var url = '<?php echo e(route('quotation.order.status', ['id' => $quotation->id])); ?>';
               
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                       
                       'status': status,
                       'check': 'order',
                       "_token": "<?php echo e(csrf_token()); ?>",
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
           
              var data = <?php echo json_encode($quotations->itemData, 15, 512) ?>;
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
<?php $__env->stopPush(); ?>

    <?php
        $settings = Utility::settings();
        $Qstatus = [
        'Pending',
        'Order',
        'Rejected'
        ];
    ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('quotation.index')); ?>"><?php echo e(__('Order Summary')); ?></a></li>
    <li class="breadcrumb-item">So No.<?php echo e(Auth::user()->soNumberFormat($quotation->order_no == 0?$quotation->order_no+1:$quotation->order_no )); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
            <div class="form-group" style="float: inline-start;width: 120px;padding-right: 5px;">
            </div>
              <?php if($quotation->is_order == 1 && $quotation->is_jobcard == 1): ?>
             <a href="#" data-size="md" data-url="<?php echo e(route('quotation.repeat.confirmation', [$quotation->id])); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Repeat Order')); ?>" class="btn btn-primary"><?php echo e(__('Repeat Order')); ?></a>
             <?php endif; ?>
        <?php if($quotation->is_order == 1 && $quotation->is_jobcard == 0 && $quotation->is_assigned_to_jobcard == 0 && auth()->user()->type == 'company'): ?>
        <a href="#" data-size="sm" data-url="<?php echo e(route('quotation.send', [$quotation->id, 'check' => 'jobcard'])); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('For Approval')); ?>" class="btn btn-primary"><?php echo e(__('Save & Send')); ?></a>
        <?php endif; ?>
       
        <?php if($quotation->is_assigned_to_jobcard == auth()->user()->id && $quotation->is_jobcard == 0): ?>
         <a href="<?php echo e(route('quotation.status', ['id' => $quotation->id, 'status' => 'is_jobcard'])); ?>" class="btn btn-primary" disabled><?php echo e(__('Convert to JobCard')); ?></a>
       
        <?php endif; ?>
         <?php if(auth()->user()->type == 'company' && $quotation->is_jobcard == 0 && $quotation->is_assigned_to_jobcard != ''): ?>
         <a href="#" class="btn btn-secondary" disabled><?php echo e(__('Sent Request')); ?></a>
         <?php endif; ?>
        <?php if($quotation->is_assigned_to_jobcard == auth()->user()->id && $quotation->is_jobcard == 1): ?>
       
        <a href="#" class="btn btn-secondary" disabled><?php echo e(__('JobCard Request Approved')); ?></a>
        <?php endif; ?>
       
        <a href="<?php echo e(route('jobcard.pdf', Crypt::encrypt($quotation->id))); ?>" class="btn btn-primary" target="_blank"><i class="ti ti-file-export"></i><?php echo e(__('JobCard')); ?></a>
        
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
                <div class="col-xl-12">
                    
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="lead-sidenav" style="flex-direction: unset;">
                           
                                
                         
                           
                           

                        </div>
                    </div>
                </div>
              
            </div>
   
    <div class="content" id="content3" style="<?php echo e($_GET['job'] != ''?'display:none':'display:none'); ?>;">  
    <div class="row">
                        <div class="card">
                        <div class="card-body">
                        <div class="row">    
                    
                            <div class="col-md-6">
                            <h5><?php echo e(__('Status')); ?></h5>
                            
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
                            <?php
                            $bg = $quotation->order_status == 'Pending'?'bg-primary':(($quotation->order_status == 'Complete')?'bg-success':(($quotation->order_status == 'On-Going')?'bg-warning':'bg-danger'));
                            ?>
                            <span style="float: inline-end;"><div style="width:5px;height:5px;top: 32px;position: absolute;" class="<?php echo e($bg); ?>"></div>&nbsp;&nbsp;<div class="text-dark bold" style="float: inline-end;font-weight: 600;">
                                 <?php echo e($quotation->order_status == 'Pending'?'Hold':$quotation->order_status); ?>

                            </div></span>
                            </div>
                            <div class="col-md-12 mt-4">
                            <h5><?php echo e(__('Key Notes')); ?></h5>
                            <div class="col-md-12 dropzone top-5-scroll browse-file" id="getnotedetails" style="text-align: justify;">
                                <?php echo $lead->notes; ?>

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
                                        <th class="text-light"><?php echo e(__('Product Details')); ?></th>
                                        <th class="text-light"><?php echo e(__('Application')); ?></th>
                                        <th class="text-light"><?php echo e(__('Model')); ?></th>
                                        <th class="text-light"><?php echo e(__('Hsn Code')); ?></th>
                                        <th class="text-light"><?php echo e(__('Unit Rate')); ?></th>
                                        <th class="text-light"><?php echo e(__('Quantity')); ?></th>
                                        <th class="text-light"><?php echo e(__('Total')); ?></th>
                                    </tr>
                                    </thead>
                                    <?php
                                        $totalQuantity=0;
                                        $totalRate=0;
                                        $totalTaxPrice=0;
                                        $totalDiscount=0;
                                        $subTotal = 0;
                                        $total = 0;
                                        $taxesData=[];
                                    ?>
                                    <?php $__currentLoopData = $iteams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$iteam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       
                                        <tr>
                                            <td><?php echo e($key+1); ?></td>
                                            <td><?php echo e(!empty($iteam->product())?$iteam->product()->name:''); ?></td>
                                            <td><?php echo e($iteam->application); ?></td>
                                            <td><?php echo e($iteam->product()->hsn_code); ?></td>
                                            <td><?php echo e($iteam->hsn_code); ?></td>
                                            <td><?php echo e($iteam->price); ?><?php echo e($iteam->currency == 'USD'?'$':($iteam->currency == 'EURO'?'€':'₹')); ?></td>
                                           
                                            
                                             <td><?php echo e($iteam->quantity); ?></td>
                                            <td ><?php echo e(($iteam->price*$iteam->quantity) + $totalTaxPrice); ?><?php echo e($iteam->currency == 'USD'?'$':($iteam->currency == 'EURO'?'€':'₹')); ?></td>
                                        </tr>
                                        <?php
                                                $subTotal +=  (($iteam->price*$iteam->quantity) + $totalTaxPrice);
                                                $total = $subTotal - $totalDiscount;
                                    ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               
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
                         <?php $__currentLoopData = $quotations->itemData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           
           <?php
            $html = '';
            $productService =  \App\Models\ProductService::find($item->id);
            $cat = \App\Models\Specification::with('subspecifications')->where(['priority' => 0, 'product_model_id' => $productService->product_model_id])->get();
             $material = \App\Models\SpecificationCodeMaterial::where(['specification_code_order_id' =>$productService->specification_code_order_id])->orderBy('id', 'desc')->pluck('name')->toArray();
            
             ?>
            <?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            
            <div class="col-md-5">
            <div class="form-group">
            <label for="specification-name" class="form-label" style="padding: 7px 12px 0px 0px;"><?php echo e($c->name); ?> :</label>
            </div></div>
            <div class="col-md-7">
            <div class="form-group">
           
         <?php $__currentLoopData = $c->subspecifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                 <?php if(array_search($cs->prefix, $material) !== false): ?> 
               
                    <div><?php echo e($cs->prefix); ?> :  <?php echo e($cs->name); ?> </div>
               <?php endif; ?> 
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
         
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         
  
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                    </div> 
                    </div>
                    </div>
                    
                    
                  
                   
                        </div>
                       
                     
                          <?php
                                $customers = \App\Models\Customer::where('lead_id', $lead->id)->get();
                               
                                ?>
                        <?php if(count($customers)>0): ?>
                         <?php $__currentLoopData = $customers->slice(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      
                       
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php endif; ?>
                       
                       
                            
                           
                      
                 
        
    </div></div>
    <div class="display2" id="content4" style="padding: 2rem 0rem 2rem 1.5rem;background-color: #fff;">  
 
    <div class="quotation-header" style="background: <?php echo e($color); ?>;color:<?php echo e($font_color); ?>">
       
    
    </div>
     <?php $__currentLoopData = $quotations->itemData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyss => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
   
     $year = \Carbon\Carbon::now()->format('y');
        $years= \Carbon\Carbon::now()->format('Y-m-d');
        $yearNext = \Carbon\Carbon::parse($years)->addYears(1);
    $job = \App\Models\Quotation::find($quotation->is_repeat);
    $jobNo =!empty($job)?$job->jobcard_no:''; 
   
    ?>
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
                <?php if($quotation->jobcard_no != 0): ?>
                <?php echo e(Auth::user()->jobNumberFormat($quotation->jobcard_no)); ?></span><canvas id="barcode" style="width: 130px;height: 56px;"></canvas>
                <?php else: ?>
                 <?php echo e(Auth::user()->soNumberFormat($quotation->order_no == 0?$quotation->order_no+1:$quotation->order_no )); ?></span><canvas id="barcode" style="width: 130px;height: 56px;"></canvas>
                <?php endif; ?>
                </td>
            
            
            <td class="commTD">Old SO_Ref</td>
            <td class="commTD"><?php echo e($quotation->old_ref_no != null?$quotation->old_ref_no:Auth::user()->jobNumberFormat($jobNo)); ?></td>
            <tr>
            <td class="commTD">Quote Ref</td>
            <td class="commTD">TTPL/<?php echo e($year); ?><?php echo e($yearNext->format('y')); ?>/<?php echo sprintf('%02d', $quotation->id); ?></td>
            </tr>
            
            
        </tr>

       <tr>
            <td style="padding: 0 2rem 0 2rem;" class="commTD">Reqdby</td>
            <td colspan="2" class="commTD"><?php echo e(\Carbon\Carbon::parse($quotations->reqbydate)->format('d/m/Y')); ?></td>
            <td class="commTD">Created Date</td>
            <td colspan="2" class="commTD"><?php echo e(\Carbon\Carbon::parse($quotations->created_at)->format('d/m/Y')); ?></td>
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
                <?php echo e($quotations->application_extra != ''?$quotations->application_extra:$item->application); ?>

                |Pressure: <?php echo e($quotations->pressure); ?> |<br>
                Temperature:  
                
                    <?php echo e($quotations->temperature); ?>

                  
             
            <td colspan="2" style="text-align: center; font-weight: bold;" class="commTD">Quantity</td>
        </tr>

         <tr><td class="commTD"></td>
          <?php
          $qty = 0;
          ?>
          <td colspan="2" style="text-align: center; font-weight: bold;" class="commTD">
       
         
        <p><?php echo e($keyss+1); ?>. Model: <?php echo e($item->n_model != ''?$item->n_model:$item->q_model); ?></p>
       
          <?php
       
          $qty += $item->quantity;
          ?>  

           </td>
            <!-- <td></td> -->
            <td colspan="2" style="text-align: center; font-weight: bold;" class="commTD"><?php echo e($quotations->quantity); ?></td>
         </tr>

         <tr>
            <td class="commTD"></td>
            
            <td colspan="2" style="text-align: center;" class="commTD">Costumer OrderCode:
            
            <?php echo e($quotation->cust_note); ?>

                 
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
            <td  class="commTD"><?php echo e($keyss+1); ?>.0</td>
              <td rowspan="" colspan="2" class="commTD">
            <?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
           
         <?php $__currentLoopData = $c->subspecifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
         
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
                    
                 <?php if(array_search($cs->prefix, $array) !== false): ?> 
                 <?php if($c->el_mc == 'mc'): ?> 
               <div style="padding: 0.2rem 0rem 0rem 1rem;">
                    <div  class="text-center"style="gap: 1rem;display: flex;font-size: 12px;">
                    <p style="font-weight:550"> <?php echo e($cs->prefix); ?> :</p>
                    <p> <?php if($c->name == 'Enclosure'): ?> <?php echo e($integrals); ?> <?php endif; ?> <?php echo e($c->name); ?>:
                    
                    <?php if(array_search($c->id, $lids) !== false): ?>
                    <?php
                    $dd = \App\Models\QuotationProductDesc::where('label_id', $c->id)->where('quotation_product_id', $item->quote_id)->first();
                    ?>
                    <?php echo e($dd->description); ?>,
                    <?php else: ?>
                    <?php echo e($cs->name); ?>,
                    <?php endif; ?>
                    <?php if($c->name == 'Enclosure'): ?>
                    
                    <?php if($item->fd_cd != ''): ?>
                    <?php
                    $cdfd = $item->fd_cd == 'fd'?'FD':'CD';
                    ?>
                    
                    <?php endif; ?>
                     <?php echo e($item->fd_cd != ''?($cdfd):''); ?> <?php echo e($item->fd_cd != ''?',':''); ?> (<?php echo e($item->gland); ?>)
                    <?php endif; ?>
                     <?php if(!empty($MName)): ?>
                    <?php if($c->name == $MName->name): ?>
                    (<?php echo e($pName->name); ?>),
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(!empty($MName1)): ?>
                    <?php if($c->name == $MName1->name): ?>
                    (<?php echo e($pName1->name); ?>),
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(!empty($MName2)): ?>
                    <?php if($c->name == $MName2->name): ?>
                    (<?php echo e($pName2->name); ?>),
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(!empty($MName3)): ?>
                    <?php if($c->name == $MName3->name): ?>
                    (<?php echo e($pName3->name); ?>),
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(!empty($MName4)): ?>
                    <?php if($c->name == $MName4->name): ?>
                    (<?php echo e($pName4->name); ?>)
                    <?php endif; ?>
                    <?php endif; ?>
                     </p>
                    </div>
                </div>
                   
               <?php endif; ?>
               <?php endif; ?> 
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
         <span style="font-weight: 600;padding: 0.2rem 0rem 1rem 1rem;">Mechanical Note: </span> <?php echo e($quotations->mechanical_note); ?>

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
            <?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
             <?php $__currentLoopData = $c->subspecifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                     <?php if(array_search($cs->prefix, $array) !== false): ?> 
                   <div style="padding: 0.2rem 0rem 0rem 1rem;">
                        <div  class="text-center"style="gap: 1rem;display: flex;font-size: 12px;">
                     <?php if($c->el_mc == 'el'): ?>
                        <p style="font-weight:550"> <?php echo e($cs->prefix); ?> :</p>
                        <p> <?php echo e($c->name); ?>: <?php echo e($cs->name); ?>

                        <?php if($c->name == 'Enclosure'): ?>
                        (<?php echo e($item->integral); ?>), <?php echo e($item->fd_cd != ''?($item->fd_cd):''); ?> <?php echo e($item->fd_cd != ''?',':''); ?> (<?php echo e($item->gland); ?>)
                        <?php endif; ?>
                    <?php if(!empty($MName)): ?>
                    <?php if($c->name == $MName->name): ?>
                    (<?php echo e($pName->name); ?>),
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(!empty($MName1)): ?>
                    <?php if($c->name == $MName1->name): ?>
                    (<?php echo e($pName1->name); ?>),
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(!empty($MName2)): ?>
                    <?php if($c->name == $MName2->name): ?>
                    (<?php echo e($pName2->name); ?>),
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(!empty($MName3)): ?>
                    <?php if($c->name == $MName3->name): ?>
                    (<?php echo e($pName3->name); ?>),
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(!empty($MName4)): ?>
                    <?php if($c->name == $MName4->name): ?>
                    (<?php echo e($pName4->name); ?>),
                    <?php endif; ?>
                    <?php endif; ?>
                         </p>
                          <?php endif; ?>
                        </div>
                    </div>
                   <?php endif; ?> 
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
             <span style="font-weight: 600;padding: 0.2rem 0rem 1rem 1rem;">Electronic Note: </span> <?php echo e($quotation->electronic_note); ?>

            </td>
            <td colspan="2" style="font-weight: 600;text-align: center;" class="commTD">Electronic Testing</td>
         </tr>
        

         <tr><td class="commTD"></td>
            <td colspan="2" style="text-align: center; font-weight: 600;" class="commTD">Admin</td>
            <td colspan="3" class="commTD"></td>
         </tr>

         <tr><td class="commTD"></td>
            <td colspan="2" class="commTD"><span style="font-weight: 600;">Admin Note:</span> <?php echo e($quotations->admin_note); ?></td>
            <td colspan="3" class="commTD"></td>
         </tr>

         <tr><td class="commTD"></td>
            <td colspan="2" style="text-align: center; font-weight: 600;" class="commTD">
                QC:
            </td>
            <td colspan="3" class="commTD"></td>
         </tr>


         <tr><td class="commTD"></td>
            <td colspan="2" class="commTD"><span style="font-weight: 600;">QC Note :</span> <?php echo e($quotations->qc_note); ?></td>
            <td colspan="3" class="commTD"></td>
         </tr>


         <tr><td class="commTD"></td>
            <td colspan="2" style="text-align: center; font-weight: 600;" class="commTD">Tag Number</td>
            <td colspan="3" class="commTD"></td>
         </tr>


         <tr><td class="commTD"></td>
            <td colspan="2" class="commTD"><span style="font-weight: 600;">Tag No: </span> <?php echo e($quotations->tag_note); ?></td>
            <td colspan="3" class="commTD"></td>
         </tr>


         <!-- <tr><td></td>
            <td colspan="2">Tag No:None</td>
            <td colspan="2">sdfsdfsdf</td>
         </tr> -->

         <tr>
            
        <td class="commTD"></td>
            <td colspan="" class="display2" style="justify-content: space-between;" class="commTD"><span>Serial No. <?php echo e($item->p_model); ?>-<?php echo e(\Carbon\Carbon::parse($quotation->created_at)->format('y')); ?>-<?php echo e(sprintf('%02d', $quotation->order_no == 0?$quotation->order_no+1:$quotation->order_no)); ?></span><span style="font-weight: 600;">To</span></td>
            <td colspan="" class="commTD">Serial No. <?php echo e($item->p_model); ?>-<?php echo e(\Carbon\Carbon::parse($quotation->created_at)->format('y')); ?>-<?php echo e(sprintf('%02d', $quotation->order_no == 0?$quotation->order_no+1:$quotation->order_no)); ?></td>
            <td colspan="2" class="commTD"></td>
            
         </tr>

         <tr><td class="commTD"></td>
            <td colspan="2" class="commTD">
            Remarks: <?php echo e($quotation->remark); ?>

            </td>
            <td colspan="3" class="commTD"></td>
         </tr>

        </tbody> 
        <tfoot class="abc2" >
            <tr>
            <td colspan="5" class="commTD"> 
                <div class=" tfoot-text">
                    <p><b><?php echo e(!empty($quotation->createdBy)?$quotation->createdBy->name:''); ?></b></p>
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

       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
    
     


  
    </div>
   
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/quotation/vieworder.blade.php ENDPATH**/ ?>
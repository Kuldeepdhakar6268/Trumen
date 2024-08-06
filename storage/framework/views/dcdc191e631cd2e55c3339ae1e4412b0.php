<?php
    $settings_data = \App\Models\Utility::settingsById($quotation->created_by);

?>
    <!DOCTYPE html>
<html lang="en" dir="<?php echo e($settings_data['SITE_RTL'] == 'on'?'rtl':''); ?>">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" id="csrf-token" content="rmUKwdygRIkIbKrM5t06oQIwu6zlSrMixwLn7B9h">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <style type="text/css">
     :root {
            --theme-color: <?php echo e($color); ?>;
            --white: #ffffff;
            --black: #000000;
        }

        body {
            font-family: 'Lato', sans-serif;
        }

        p,
        li,
        ul,
        ol {
            margin: 0;
            padding: 0;
            list-style: none;
            line-height: 1.5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table tr th {
            padding: 0.75rem;
            text-align: left;
        }
        .table-parent thead tr th {
             font-size: 15px;
             text-align: center;
        }
        table tr td {
            padding: 0.75rem;
            text-align: left;
        }

        table th small {
            display: block;
            font-size: 12px;
        }

        .quotation-preview-main {
            max-width: 830px;
            width: 100%;
            margin: 0 auto;
            background: #ffff;
            box-shadow: 0 0 10px #ddd;
            padding: 20px;
        }

        .quotation-logo {
            max-width: 200px;
            width: 100%;
        }

        .quotation-header table td {
            padding: 15px 30px;
        }

        .text-right {
            text-align: right;
        }

        .no-space tr td {
            padding: 0;
            white-space: nowrap;
        }

        .vertical-align-top td {
            vertical-align: top;
        }

        .view-qrcode {
            max-width: 139px;
            height: 139px;
            width: 100%;
            margin-left: auto;
            margin-top: 15px;
            background: var(--white);
            padding: 13px;
            border-radius: 10px;
        }
        .view-qrcode img {
            width: 100%;
            height: 100%;
        }

        /*.quotation-body {*/
        /*    padding: 0px 2px 0;*/
        /*}*/



        table.add-border tr {
            border-top: 1px solid var(--theme-color);
        }

        tfoot tr:first-of-type {
            border-bottom: 1px solid var(--theme-color);
        }

        .total-table tr:first-of-type td {
            padding-top: 0;
        }

        .total-table tr:first-of-type {
            border-top: 0;
        }

        .sub-total {
            padding-right: 0;
            padding-left: 0;
        }

        .border-0 {
            border: none !important;
        }

        .quotation-summary td,
        .quotation-summary th {
            font-size: 13px;
            font-weight: 600;
        }

        .total-table td:last-of-type {
            width: 146px;
        }

        .quotation-footer {
            padding: 15px 20px;
        }

        .itm-description td {
            padding-top: 0;
        }
        html[dir="rtl"] table tr td,
        html[dir="rtl"] table tr th{
            text-align: right;
        }
        html[dir="rtl"]  .text-right{
            text-align: left;
        }
        html[dir="rtl"] .view-qrcode{
            margin-left: 0;
            margin-right: auto;
        }
        *{
    padding: 0;
    margin: 0;
   box-sizing: border-box;
   font-family: Arial, Helvetica, sans-serif;
}

.table-parent{
    /*width: 50vw;*/
    border: 1px solid black;
    border-collapse: separate;
    border-radius: 10px;
    border-spacing: 0;
    overflow: scroll;
}

.table-parent>td ,tr{
    border-radius: 0.2rem;
}
th{
    /* padding: 1rem; */
    font-size: 1.3rem;
    height: 3rem;
    border: 1px solid rgb(219, 211, 211);
    
}

.display{
    display: grid;
    grid-template-columns: repeat(3,1fr);
    align-items: center;
    justify-content: center;
    font-size: 12px;
}

.display2{
    display: flex;
    font-size: 15px
    align-items: center;
    justify-content: center;
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
    padding: 0.2rem 0rem 0rem 1rem;

    align-items: center;
    justify-content: center;
}
.table-middle-text>p{
    
}
.tfoot-text{
    display: flex;
    grid-template-columns: repeat(3,1fr);

    justify-content: space-between;
    padding: 0.5rem;
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

    <?php if($settings_data['SITE_RTL']=='on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-rtl.css')); ?>">
    <?php endif; ?>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <!--<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>-->
    <script>
       
        $(document).ready(function() {
           
             var data = <?php echo json_encode($quotation->itemData, 15, 512) ?>;

            // Iterate through the JSON data and display it
            $.each(data, function(key, value) {
                console.log(value)
            
            JsBarcode("#barcode", value.sku, {
                format: "CODE128",
                lineColor: "#000",
                width: 1,
                height: 100,
                displayValue: true
            });
            });
            var canvas = $('#barcode');
            var dataURL = canvas[0].toDataURL("image/png");
              $('#barcode').hide();
            var id = '<?php echo e($quotation->id); ?>';
             $.ajax({
            url: '<?php echo e(route('quotation.store.barcode')); ?>',
            type: 'POST',
            data: {
                
                "id": id,
                 "imagebase64":dataURL,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            success: function (data) {
                console.log(data);
              
            }
                
                        });
        });
        
    </script>

</head>
<body class="">
   <canvas id="barcode"></canvas>
<div class="quotation-preview-main"  id="boxes">
    <?php $__currentLoopData = $quotation->itemData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyss => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="quotation-body" style="margin-left:0px;font-size: 12px;height:1030px;margin-top:10px">
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
                <th colspan="2">Trumen Technology Pvt. Ltd.</th>
                <th colspan="3"></th>
        </thead>
       <tbody>
        <tr>
            <td rowspan="2" class="commTD"> </td>
            <td rowspan="2" colspan="2" class="commTD"><div class="display"><span>
                <?php if($quotation->jobcard_no != 0): ?>
                <?php echo e(Auth::user()->jobNumberFormat($quotation->jobcard_no)); ?>

                <?php else: ?>
                 <?php echo e(Auth::user()->soNumberFormat($quotation->order_no == 0?$quotation->order_no+1:$quotation->order_no )); ?>

                <?php endif; ?>
               
                </span><img src="<?php echo e($quotation->barcode); ?>" alt="Red dot" style="width: 130px;height: 56px;"/></td>
            <td class="commTD">Old SO_Ref</td>
            <td class="commTD"><?php echo e($quotation->old_ref_no != null?$quotation->old_ref_no:Auth::user()->jobNumberFormat($jobNo)); ?></td>
            <tr>
            <td class="commTD">Quote Ref</td>
            <td class="commTD">TTPL/<?php echo e($year); ?><?php echo e($yearNext->format('y')); ?>/<?php echo sprintf('%02d', $quotation->id); ?></td>
            </tr>
        </tr>
        <tr>
            <td style="padding: 0 2rem 0 2rem;" class="commTD">Reqdby</td>
            <td colspan="2" class="commTD"><?php echo e(\Carbon\Carbon::parse($quotation->reqbydate)->format('d/m/Y')); ?></td>
            <td class="commTD">Created Date</td>
            <td colspan="2" class="commTD"><?php echo e(\Carbon\Carbon::parse($quotation->created_at)->format('d/m/Y')); ?></td>
        </tr>
         <?php
           $html = '';
            $arr = explode(':', $item->q_model);
            $array = explode('-', $arr[1]);
        
            $cat = \App\Models\Specification::with('subspecifications')->where(['priority' => 0, 'product_model_id' =>$item->product_model_id])->get();
             ?>
             
 
        <tr>
            <td style="text-align: center;" class="commTD">Sr.No</td>
            <td colspan="2" class="commTD">Application :
                <?php echo e($quotation->application_extra != ''?$quotation->application_extra:$item->application); ?>

                |Pressure: <?php echo e($quotation->pressure); ?> |<br>
                Temperature:  
                
                    <?php echo e($quotation->temperature); ?>

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
                 if(!empty($item->group_material_4)){    
                   $pName4 = \App\Models\Specification::find($item->group_material_4); 
                   $MName4 = \App\Models\Specification::find($pName4->parent);
                } 
                if(!empty($item->group_material_5)){    
                   $pName2 = \App\Models\Specification::find($item->group_material_5); 
                   $MName2 = \App\Models\Specification::find($pName2->parent);
                } 
                if(!empty($item->group_material_7)){    
                   $pName3 = \App\Models\Specification::find($item->group_material_7); 
                   $MName3 = \App\Models\Specification::find($pName3->parent);
                } 
               
                    ?>
                    
                 <?php if(array_search($cs->prefix, $array) !== false): ?> 
                 <?php if($c->name == 'Material Temperature'): ?>
                    <?php echo e($quotations->temperature != ''?$quotations->temperature:$cs->name); ?>

                 <?php endif; ?>    
                   
               <?php endif; ?> 
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
         
           </td>
            <td colspan="2" style="text-align: center; font-weight: bold;" class="commTD">Quantity</td>
        </tr>
         <tr><td class="commTD"></td>
          <?php
          $qty = 0;
          ?>
          <td colspan="2" style="text-align: center; font-weight: bold;" class="commTD">
        <p><?php echo e($keyss+1); ?>. <?php echo e($item->new_model != ''?$item->new_model:$item->q_model); ?></p>
          <?php
          $qty += $item->quantity;
          ?>  
           </td>
            <!-- <td></td> -->
            <td colspan="2" style="text-align: center; font-weight: bold;" class="commTD"> <?php echo e($quotation->quantity); ?></td>
         </tr>
         <tr>
            <td class="commTD"></td>
            <td colspan="2" style="text-align: center;" class="commTD">Customer OrderCode:
             <?php echo e($quotation->cust_note); ?>

            </td>
            <!-- <td></td> -->
            <td colspan="3" class="commTD"></td>
         </tr>
         <tr>
            <td class="commTD"></td>
            <td colspan="2" style="text-align: center;" class="commTD"><h4>Mechanical :</h4></td>
            <!-- <td></td> -->
            <td colspan="3" class="commTD"></td>
         </tr>
           <?php
           $html = '';
            $arr = explode(':', $item->q_model);
            $array = explode('-', $arr[1]);
            $cat = \App\Models\Specification::with('subspecifications')->where(['priority' => 0, 'product_model_id' =>$item->product_model_id])->get();
             $lids = \App\Models\QuotationProductDesc::where('quotation_product_id', $item->quote_id)->pluck('label_id')->toArray();
             $integrals = $item->integral == 'rmt1'?'Remote':(($item->integral == 'rmt2')?'Remote':'');

             ?>
            <tr>
            <td  class="commTD"><?php echo e($keyss+1); ?>.0</td>
              <td rowspan="" colspan="2" class="commTD">
            <?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
             <?php $__currentLoopData = $c->subspecifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                     <?php if(array_search($cs->prefix, $array) !== false): ?> 
                   <div style="">
                        <div  class="text-center"style="gap: 1rem;display: flex;font-size: 12px;">
                    <?php if($c->el_mc == 'mc'): ?>
                        <p style="font-weight:550;"> <?php echo e($cs->prefix); ?> :</p>
                        <p class="d-inline-block text-truncate" style="max-width: 400px;"><?php if($c->name == 'Enclosure'): ?> <?php echo e($integrals); ?> <?php endif; ?> <?php echo e($c->name); ?>: 
                       
                    <?php if(array_search($c->id, $lids) !== false): ?>
                    <?php
                    $dd = \App\Models\QuotationProductDesc::where('label_id', $c->id)->where('quotation_product_id', $item->quote_id)->first();
                    ?>
                    <?php echo e($dd->description); ?>,
                    <?php else: ?>
                    <?php echo e($cs->name); ?>,
                    <?php endif; ?>
                    <?php if($item->fd_cd != ''): ?>
                    <?php
                    $cdfd = $item->fd_cd == 'fd'?'FD':'CD';
                    ?>
                    <?php endif; ?>
                    <?php if($c->name == 'Enclosure'): ?>
                       <?php echo e($item->fd_cd != ''?',':''); ?> (<?php echo e($item->gland); ?>)
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
         <span style="font-weight: 600;">Mechanical Note: </span> <?php echo e($quotation->mechanical_note); ?>

          </td>
          <td colspan="3"  style="text-align: center; margin: 0; font-weight: bold; padding: 0;border:0px;" class="commTD">
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
                   <div style="">
                        <div  class="text-center"style="gap: 1rem;display: flex;font-size: 12px;">
                     <?php if($c->el_mc == 'el'): ?>
                        <p style="font-weight:550"> <?php echo e($cs->prefix); ?> :</p>
                        <p><?php if($c->name == 'Enclosure'): ?> <?php echo e($integrals); ?> <?php endif; ?> <?php echo e($c->name); ?>: <?php echo e($cs->name); ?>

                    <?php if($item->fd_cd != ''): ?>
                    <?php
                    $cdfd = $item->fd_cd == 'fd'?'FD':'CD';
                    ?>
                    <?php endif; ?>
                        <?php if($c->name == 'Enclosure'): ?>
                         <?php echo e($cdfd); ?> <?php echo e($item->fd_cd != ''?',':''); ?> (<?php echo e($item->gland); ?>)
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
             <span style="font-weight: 600;">Electronic Note: </span> <?php echo e($quotation->electronic_note); ?>

            </td>
            <td colspan="2" style="font-weight: 600;text-align:center;" class="commTD">Electronic Testing</td>
         </tr>
        
         <tr><td class="commTD"></td>
            <td colspan="2" style="text-align: center; font-weight: 600;" class="commTD">Admin</td>
            <td colspan="3" class="commTD"></td>
         </tr>

         <tr><td class="commTD"></td>
            <td colspan="2" class="commTD"><span style="font-weight: 600;">Admin Note:</span> <?php echo e($quotation->admin_note); ?></td>
            <td colspan="3" class="commTD"></td>
         </tr>
         <tr><td class="commTD"></td>
            <td colspan="2" style="text-align: center; font-weight: 600;" class="commTD">
                QC:
            </td>
            <td colspan="3" class="commTD"></td>
         </tr>
         <tr><td class="commTD"></td>
            <td colspan="2" class="commTD"><span style="font-weight: 600;">QC Note :</span> <?php echo e($quotation->qc_note); ?></td>
            <td colspan="3" class="commTD"></td>
         </tr>
         <tr><td class="commTD"></td>
            <td colspan="2" style="text-align: center; font-weight: 600;" class="commTD">Tag Number</td>
            <td colspan="3" class="commTD"></td>
         </tr>
         <tr><td class="commTD"></td>
            <td colspan="2" class="commTD"><span style="font-weight: 600;">Tag No: </span> <?php echo e($quotation->tag_note); ?></td>
            <td colspan="3" class="commTD"></td>
         </tr>
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
                    <p style="width: 0px;margin-left: 0px;">Department</p>
                    <p style="width: 191px;margin-left: 1px;">Elecronics/Mechenical</p>
                </div>
            </td>
            </tr>
        </tfoot>
    </table>
    </div>
     <br>
  <br>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
</div>
<?php if(!isset($preview)): ?>
    <?php echo $__env->make('quotation.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
<?php endif; ?>

</body>

</html>
<?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/quotation/templates/template11.blade.php ENDPATH**/ ?>
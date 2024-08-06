<?php
    $settings_data = \App\Models\Utility::settingsById($quotation->created_by);

?>
    <!DOCTYPE html>
<html lang="en" dir="<?php echo e($settings_data['SITE_RTL'] == 'on'?'rtl':''); ?>">

<head>
    <meta charset="utf-8">
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
        table th small {
            display: block;
            font-size: 12px;
        }

        .quotation-preview-main {
            max-width: 790px;
            width: 100%;
            height: auto;
            margin: 0 auto;
            background: #ffff;
            box-shadow: 0 0 10px #ddd;
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

        .quotation-body {
            padding: 30px 25px 0;
        }
        table.add-border tr {
            border-top: 1px solid var(--theme-color);
        }

        tfoot tr:first-of-type {
            border-bottom: 1px solid var(--theme-color);
        }

        .total-table tr:first-of-type td {
            padding-top: 0;
        }
        .ftr{
            font-size:0.7rem;
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
        
    /*custome new*/
        *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

body{
    /*background-color: gray;*/
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: Arial, Helvetica, sans-serif;
}
.Quotation-table>tbody>tr>td {
    border: 1px solid #f1eeee !important;
    
}
.second>tbody>tr>td {
    border: 1px solid #f1eeee !important;
    
}

.display{
    display: flex;
    font-size: 0.7rem;
    align-items: center;
    justify-content: center;
}
.Quotation{
    width: 100%;
    /*margin-bottom: 125px;*/
    height: 100%;
    /*background-color: white;*/
}

.Quotation-address{
    width: 100%;
}
.speci_0{
    text-align: center;
}
.Quotation-address-1{
    justify-content: end;
    gap: 1rem;
    padding-right: 3rem;
    margin-top: 0.5rem;
}

.Quotation-table{
    /*border: 1px solid #9b9595 !important;*/
    width: 90%;
    height: 35rem;
    border-radius: 10px;
    /*border-collapse:separate;*/
    border-spacing: 0;
    overflow: scroll;
    
    
}
.Quotation-table>th,thead{
    /* border: 1px solid black; */
    background-color: black;
    color: white;
    height: 3rem;
}
ul {
    list-style: none; /* Remove default bullets */
    text-wrap: nowrap;
    margin-top: 0rem;
    margin-bottom: 1rem;
}

ul li {
    position: relative; /* Required for pseudo-element positioning */
    padding-left: 30px; /* Space for the image */
    color: blue;
    font-weight: 550;
    font-size: 0.8rem;
}

ul li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 20px; /* Desired width */
    height: 20px; /* Desired height */
    background-image: url('<?php echo e(asset(Storage::url('uploads/logo/listlogo2.jpg'))); ?>'); /* Image URL */
    background-size: cover; /* Ensure the image covers the area */
}


td{
    border: 1px solid #9b9595 !important;
    padding: 0.7rem;
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
.Quotation-logo>p{
    margin-left: 95px;
    }
.Quotation-logo{
    font-size: 1.2rem;
    color: white;
    height: 7rem;
    width: 100%;
    
    background-size: cover;
    background-repeat: no-repeat;
    background-image: url('<?php echo e(asset(Storage::url('uploads/logo/header-logo.png'))); ?>');
}
.Quotation-footer>p{
    margin-left: 38px;
        width: 21%;
}

.Quotation-footer{
    margin-top: 15rem;
    margin-bottom: 0rem; 
    width: 100%;
    height: 3rem;
    display: flex;
    /* padding: 3rem; */
    background-position: top;
   
    color: white;
    justify-content: space-around;
    font-size: 0.7rem;
    align-items: end;
    /*gap: 17rem;*/
    background-size: cover;
    background-repeat: no-repeat;
    background-image: url('<?php echo e(asset(Storage::url('uploads/logo/footer_logo.png'))); ?>');
}
    </style>

    <?php if($settings_data['SITE_RTL']=='on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-rtl.css')); ?>">
    <?php endif; ?>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script>
       
        $(document).ready(function() {
           
             var data = <?php echo json_encode($quotation->itemData, 15, 512) ?>;

            // Iterate through the JSON data and display it
            $.each(data, function(key, value) {
                console.log(value)
            
            JsBarcode("#barcode", value.sku, {
                format: "CODE128",
                lineColor: "#000",
                width: 2,
                height: 100,
                displayValue: true
            });
            });
        });
        
    </script>

</head>

<body class="">
<div class="quotation-preview-main"  id="boxes">
<!--Page 1 of 4-->   
 <?php
  $lead = \App\Models\Lead::find($quotation->lead_id);
  $customer = \App\Models\Customer::where('id', $quotation->assigned_to)->first();
  $source = '';
            $year = \Carbon\Carbon::now()->format('y');
            $years= \Carbon\Carbon::now()->format('Y-m-d');
            $yearNext = \Carbon\Carbon::parse($years)->addYears(1);
            $page_no = count($quotation->itemData);
  ?>
 <div class="Quotation" style="margin-top: 0px;" >
     <div class="Quotation-address">
        <div class="Quotation-logo display">
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
        <p class="display" style="gap: 0.8rem;padding-bottom: 15px;" > <svg width="1rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 23.7279L5.63604 17.364C2.12132 13.8492 2.12132 8.15076 5.63604 4.63604C9.15076 1.12132 14.8492 1.12132 18.364 4.63604C21.8787 8.15076 21.8787 13.8492 18.364 17.364L12 23.7279ZM16.9497 15.9497C19.6834 13.2161 19.6834 8.78392 16.9497 6.05025C14.2161 3.31658 9.78392 3.31658 7.05025 6.05025C4.31658 8.78392 4.31658 13.2161 7.05025 15.9497L12 20.8995L16.9497 15.9497ZM12 13C10.8954 13 10 12.1046 10 11C10 9.89543 10.8954 9 12 9C13.1046 9 14 9.89543 14 11C14 12.1046 13.1046 13 12 13Z"></path></svg>39, Mangal Nagar, Behind Sai Ram Plaza, AB Road, Indore, M.P. </p>
        </div>
        </div>
       </div>
       <div class="display">
        <table class="Quotation-table">
            <thead>
                <th colspan="3">Quotation</th>
                
            </thead>
            <tbody>
                <tr>
                   <td><b><?php echo e(!empty($quotation->organization)?$quotation->organization->name:''); ?></b></td>
                    <td>Quote Ref</td>
                    <?php if($quotation->is_revised != ''): ?>
                     <?php
                $arr = \App\Models\Quotation::where('is_revised', $quotation->is_revised)->pluck('id')->toArray();
                $rv = array_search($quotation->id, $arr)+1;
             
                ?>
                    <td>TTPL/<?php echo e($year); ?><?php echo e($yearNext->format('y')); ?>/<?php echo e($quotation->is_revised); ?><?php echo e($quotation->is_revised != ''?'R'. array_search($quotation->id, $arr)+1:''); ?></td>
                    <?php else: ?>
                     <td>TTPL/<?php echo e($year); ?><?php echo e($yearNext->format('y')); ?>/<?php echo e($quotation->id); ?></td>
                    <?php endif; ?>
                </tr>
                
                <tr>
                    <td><?php echo e(!empty($quotation->organization)?$quotation->organization->street:''); ?>, <?php echo e(!empty($quotation->organization)?$quotation->organization->area:''); ?>,<?php echo e(!empty($quotation->organization)?$quotation->organization->city:''); ?>, <?php echo e(!empty($quotation->organization)?$quotation->organization->state:''); ?> - <?php echo e(!empty($quotation->organization)?$quotation->organization->pin:''); ?></td>
                    <td>Quote Date</td>
                    <td><?php echo e(\Carbon\Carbon::parse($quotation->quotation_date)->format('d/m/Y')); ?></td>
                </tr>
                <tr>
                    <td>Mobile: <?php echo e(!empty($quotation->organization)?$quotation->organization->phone:''); ?></td>
                    <td>Enquiry Ref</td>
                    <td>
                     
                         <?php $__currentLoopData = $lead->sources(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                  <div class="hover-content">
                                                 <?php echo e(!empty($source)?$source->name:''); ?>

                                                 
                                                   <?php if(!$loop->last): ?>
                                                        ,
                                                    <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          
                        
                    </td>
                </tr>
                
                <tr>
                    <td>Email: <?php echo e(!empty($quotation->organization)?$quotation->organization->email:''); ?></td>
                    <td>Enquiry Date</td>
                    <td><?php echo e(\Carbon\Carbon::parse($lead->date)->format('d/m/Y')); ?></td>
                   
                </tr>
               
                <tr>
                    <td>Kind Attention:  <?php echo e(!empty($customer)?$customer->prefix:''); ?><?php echo e(!empty($customer)?$customer->name:''); ?></td>
                    <td>GST Number</td>
                    <td><?php echo e(!empty($customer)?$customer->tax_number:''); ?></td>
                </tr>
                
             
                <tr>
                    <td colspan="3" style="padding: 3rem; line-height: 3rem; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;" >
                <p style="font-weight: 550;">Subject: <?php echo e($quotation->subjects); ?>.</p>
                <p style="margin: 1rem 0 1rem 0;height: 50px;"><?php echo e($quotation->notes); ?></p>
                <div>
                    <ul class="abc" style=" width: 1rem;">
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
       
       <div class="Quotation-footer" style="margin-top: 20.2rem;margin-bottom: 0.2rem;">
          <p style="line-height: 2.0;">TTPL/<?php echo e($year); ?><?php echo e($yearNext->format('y')); ?>/<?php echo e($quotation->quotation_id); ?> <?php echo e(\Carbon\Carbon::parse($quotation->quotation_date)->format('d.m.Y')); ?></p>
          <p style="margin-bottom: 0rem;margin-left: 201px;width: 46%;">Technologies provides maximum possible customization on all of its products</p>
       </div>
   </div>
<!--Page 1 of 4 End-->
<!--Page 2 of 4-->
 <?php
 $count = 0;
 ?>
 <?php $__currentLoopData = $quotation->itemData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <div class="Quotation" style="padding-top: 0.2rem;">
       <div class="Quotation-address">
        <div class="Quotation-logo display">
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
        
        <div class="display Quotation-address-1">
        <p class="display" style="gap: 0.8rem;padding-bottom: 15px;" > <svg width="1rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 23.7279L5.63604 17.364C2.12132 13.8492 2.12132 8.15076 5.63604 4.63604C9.15076 1.12132 14.8492 1.12132 18.364 4.63604C21.8787 8.15076 21.8787 13.8492 18.364 17.364L12 23.7279ZM16.9497 15.9497C19.6834 13.2161 19.6834 8.78392 16.9497 6.05025C14.2161 3.31658 9.78392 3.31658 7.05025 6.05025C4.31658 8.78392 4.31658 13.2161 7.05025 15.9497L12 20.8995L16.9497 15.9497ZM12 13C10.8954 13 10 12.1046 10 11C10 9.89543 10.8954 9 12 9C13.1046 9 14 9.89543 14 11C14 12.1046 13.1046 13 12 13Z"></path></svg>39, Mangal Nagar, Behind Sai Ram Plaza, AB Road, Indore, M.P. </p>
        </div>
        </div>
       </div>
       
       <div class="display" style="padding-top: 5px;">
        <table class="Quotation-table" style="border-collapse: collapse;">
            <thead>
                <th colspan="5">Quotation</th>
                
            </thead>
            
            <tbody style="height: fit-content;;">
                
                <tr>
                    <td style="text-align:center;"><b>S.No.</b></td>
                    <td style="text-align:center;"><b>Description</b></td>
                    <td style="text-align:center;"><b>Unite Rate (<?php echo e($item->currency == 'USD'?'$':($item->currency == 'EURO'?'€':'₹')); ?>)</b></td>
                    <td style="text-align:center;"><b>Qty</b></td>
                    <td style="text-align:center;"><b>Total (<?php echo e($item->currency == 'USD'?'$':($item->currency == 'EURO'?'€':'₹')); ?>)</b></td>
                </tr>
               
           <?php
           $html = '';
            $ary = explode(':', $item->q_model);
            $array = explode('-', $ary[1]);
            //  $glands = $item->gland_id != 0?\App\Models\Specification::find($item->gland_id)->name:'';
            $cat = \App\Models\Specification::with('subspecifications')->where(['priority' => 0, 'product_model_id' =>$item->product_model_id])->get();
            $lids = \App\Models\QuotationProductDesc::where('quotation_product_id', $item->quote_id)->pluck('label_id')->toArray();
            //  dd($item);
             ?>
             
             <tr>
                    <td></td>
                    <td><div style="text-decoration: underline; line-height: 3rem; font-weight: 550; text-align:center;"><p><?php echo e($item->name); ?></p><p>HSN Code: <?php echo e($item->hsn_code); ?></p><p>Application: <?php echo e($item->application_text == ''?$item->application:$item->application_text); ?></p></div></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b style="padding: 0px 0px 0px 10px;"><?php echo e($key+1); ?>.0</b></td>
                    <td><b style="padding: 0px 0px 0px 10px;">Model: <?php echo e($item->new_model != ''?$item->new_model:$item->q_model); ?></b></td>
                    <td><b style="padding: 0px 0px 0px 10px;"><?php echo e($item->price); ?><?php echo e($item->currency == 'USD'?'$':($item->currency == 'EURO'?'€':'₹')); ?></b></td>
                    <td><b style="padding: 0px 0px 0px 10px;"><?php echo e($item->quantity); ?></b></td>
                    <td><b style="padding: 0px 0px 0px 10px;"><?php echo e($item->price); ?><?php echo e($item->currency == 'USD'?'$':($item->currency == 'EURO'?'€':'₹')); ?></b></td>
                </tr>
                 <?php if($item->Enclosure == null && $item->gland != ''): ?>
                 <tr>
                    <td></td>
                    <td><b style="padding: 0px 0px 0px 10px;"><?php echo e($item->Enclosure == ''?$item->gland:''); ?></b></td>
                    <td></td>
                    <td><b style="padding: 0px 0px 0px 10px;"></td>
                    <td><b style="padding: 0px 0px 0px 10px;"></b></td>
                </tr>
                <?php endif; ?>
            <?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php $__currentLoopData = $c->subspecifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
         <?php
        
          if(!empty($item->group_material_2)){    
                   $pName = \App\Models\Specification::find($item->group_material_2); 
                   $MName = \App\Models\Specification::find($pName->parent);
                  ;
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
                $integrals = $item->integral == 'rmt1'?'Remote':(($item->integral == 'rmt2')?'Remote':'');
                $slName = \App\Models\QuotationProductName::where('quotation_product_id', $item->quote_id)->get();

// dd($integrals);
         ?>
                 <?php if(array_search($cs->prefix, $array) !== false): ?> 
                <tr>
                    <td></td>
                    <td class="speci_<?php echo e($keys); ?>"><b style="padding: 10px;"><?php echo e($cs->prefix); ?></b><?php if($c->name == 'Enclosure'): ?> <?php echo e($integrals); ?> <?php endif; ?>   <?php echo e($c->name); ?>: 
                    
                    <?php if(array_search($c->id, $lids) !== false): ?>
                    <?php
                    $dd = \App\Models\QuotationProductDesc::where('label_id', $c->id)->where('quotation_product_id', $item->quote_id)->first();
                    ?>
                    <?php echo e($dd->description); ?>,
                    <?php else: ?>
                    <?php echo e($cs->name); ?>,
                    <?php endif; ?>
                  
                     <?php $__currentLoopData = $slName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $nnn = \App\Models\Specification::find($sl->product_id);
                    $Priority = \App\Models\Specification::where('id',$nnn->priority)->first();
                    ?>
                    <?php if($nnn->parent == $c->id && $nnn->child_id == null): ?>
                   (<?php echo e($Priority->name); ?>: <?php echo e($nnn->name); ?>)
                    <?php endif; ?>
                     <?php if($nnn->child_id == $c->id): ?>
                   (<?php echo e($Priority->name); ?>: <?php echo e($nnn->name); ?>)
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php if($c->name == 'Enclosure'): ?>
                    (<?php echo e($item->fd_cd); ?>), (<?php echo e($item->gland); ?>)
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
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
               <?php endif; ?> 
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
       </div>
      <?php if(count($array)>8): ?>
       <div class="Quotation-footer" style="margin-top: 18.5rem;">
          <p style="line-height: 2.0;">TTPL/<?php echo e($year); ?><?php echo e($yearNext->format('y')); ?>/<?php echo e($quotation->quotation_id); ?> <?php echo e(\Carbon\Carbon::parse($quotation->quotation_date)->format('d.m.Y')); ?></p>
          <p style="margin-bottom: 0rem; margin-left: 201px;width: 46%;">Technologies provides maximum possible customization on all of its products</p>
       </div>
      <?php else: ?>
       <div class="Quotation-footer" style="margin-top: 20rem;">
          <p style="line-height: 2.0;">TTPL/<?php echo e($year); ?><?php echo e($yearNext->format('y')); ?>/<?php echo e($quotation->quotation_id); ?> <?php echo e(\Carbon\Carbon::parse($quotation->quotation_date)->format('d.m.Y')); ?></p>
          <p style="margin-bottom: 0rem; margin-left: 201px;width: 46%;">Technologies provides maximum possible customization on all of its products</p>
       </div>
      <?php endif; ?>
   </div> 
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--Page 2 of 4 End-->
<!--Page 3 of 4-->
<div class="Quotation" style="padding-top: 2rem;">
       <div class="Quotation-address">
        <div class="Quotation-logo display">
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
        <div class="display Quotation-address-1">
        <p class="display" style="gap: 0.8rem;padding-bottom: 15px;" > <svg width="1rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 23.7279L5.63604 17.364C2.12132 13.8492 2.12132 8.15076 5.63604 4.63604C9.15076 1.12132 14.8492 1.12132 18.364 4.63604C21.8787 8.15076 21.8787 13.8492 18.364 17.364L12 23.7279ZM16.9497 15.9497C19.6834 13.2161 19.6834 8.78392 16.9497 6.05025C14.2161 3.31658 9.78392 3.31658 7.05025 6.05025C4.31658 8.78392 4.31658 13.2161 7.05025 15.9497L12 20.8995L16.9497 15.9497ZM12 13C10.8954 13 10 12.1046 10 11C10 9.89543 10.8954 9 12 9C13.1046 9 14 9.89543 14 11C14 12.1046 13.1046 13 12 13Z"></path></svg>39, Mangal Nagar, Behind Sai Ram Plaza, AB Road, Indore, M.P. </p>
        </div>
        </div>
       </div>
        <div class="display" style="margin-top: 2rem; font-weight: 550;">
            <p>TERMS & CONDITIONS</p>
            
        </div>
        <div style="margin:3rem ; line-height: 2rem;">
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">1. Prices</p>
            <div>
            <p><?php echo e(!empty($quotation->terms)?$quotation->terms->price:''); ?></p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">2. P&f</p>
            <?php if($quotation->terms->p_f != ''): ?>
            <div>
            <p>GST @ <?php echo e(!empty($quotation->terms)?$quotation->terms->p_f:''); ?></p>
            </div>
            <?php else: ?>
            <div>
            <p> <?php echo e(!empty($quotation->terms)?$quotation->terms->p_f_next:''); ?></p>
            </div>
            <?php endif; ?>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem;border-top: 3px solid #f1eeee; border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">3. Taxes</p>
            <div>
            <p><?php echo e(!empty($quotation->terms)?$quotation->terms->taxes:''); ?></p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem;"></div>
          
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem;border-top: 3px solid #f1eeee; border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">4. Freight</p>
            <div>
            <p><?php echo e(!empty($quotation->terms)?$quotation->terms->freight:''); ?></p>
            </div>
            </div>
           
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">5. Transit insurance</p>
            <div>
            <p><?php echo e(!empty($quotation->terms)?$quotation->terms->insurance:''); ?>.</p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">6. Delivery</p>
            <div>
            <p>Within <?php echo e(!empty($quotation->terms)?$quotation->terms->delivery:''); ?> weeks after confirmed order.</p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem;border-top: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">7. Payment</p>
            <div>
             <?php if(!empty($quotation->terms)): ?>    
            <p><?php echo e($quotation->terms->payment == '100%'?'100% Against proforma invoice prior to dispatch.':$quotation->terms->payment); ?></p>
            <?php endif; ?>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee; height: 33px;">8. Warranty</p>
            <div>
            <p><?php echo e(!empty($quotation->terms)?$quotation->terms->warranty:''); ?> months from the date of commissioning or fifteen months from the date of supply
                which ever is earlier.</p>
                </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">9. Validity of offer</p>
            <p><?php echo e(!empty($quotation->terms)?$quotation->terms->validity_offer:''); ?> Days</p>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">10. Release of po</p>
            <p>Formal order mentioning your delivery address and dispatch instructions</p>
            </div>
            <div class="display" style="display: grid; grid-template-columns:1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee; border-bottom: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">11. Cancellation charges</p>
            <p style=""><?php echo e(!empty($quotation->terms)?$quotation->terms->cancellation_charges:''); ?>% Of po amount to be paid if cancelled after order acceptance.</p>
            </div>
            <p style="margin-top: 3rem;" class="ftr">Trust Our Offer Is In Line With Your Requirement. Please Feel Free To Contact Us For Further Assistance. We Look Forward To Your
                Valued Order</p>
            <p style="margin-top: 2rem;" class="ftr">Thanks And Warm Regards.</p>
            <p style="margin-top: 0.2rem; margin-bottom: 0.2rem; font-weight: 550;" class="ftr"><?php echo e(!empty($quotation->createdBy)?$quotation->createdBy->name:''); ?></p>
            <div style="margin-bottom: 9rem;">
            <p class="ftr">Trumen Technologies Pvt. Ltd.</p>
            <p class="ftr">39, Mangal Nagar, Behind Sai Ram Plaza
                Near Rajiv Gandhi Circle, AB Road</p>
                <p class="ftr">Tel: 0731-4972065, <?php echo e(!empty($quotation->createdBy)?$quotation->createdBy->contact:''); ?></p>
                <p class="ftr">Email: <?php echo e(!empty($quotation->createdBy)?$quotation->createdBy->email:''); ?>, Web: www.trumen.in</p>
                </div>
        </div>
       <div class="Quotation-footer" style="margin-top: 20rem;">
          <p style="line-height: 2.0;">TTPL/<?php echo e($year); ?><?php echo e($yearNext->format('y')); ?>/<?php echo e($quotation->quotation_id); ?> <?php echo e(\Carbon\Carbon::parse($quotation->quotation_date)->format('d.m.Y')); ?></p>
          <div>
          <p style="margin-bottom: 0.5rem;margin-left: 201px;width: 61%;" class="ftr">Technologies provides maximum possible customization on all of its products</p>
       </div>
       </div>
   </div>
<!--Page 3 of 4 End-->
</div>
</div>

<?php if(!isset($preview)): ?>
    <?php echo $__env->make('quotation.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
<?php endif; ?>
</body>
</html>
<?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/quotation/templates/template1.blade.php ENDPATH**/ ?>
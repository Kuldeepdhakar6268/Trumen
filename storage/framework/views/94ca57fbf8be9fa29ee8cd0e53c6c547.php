<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Quotation Detail')); ?>

<?php $__env->stopSection(); ?>

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
    background-image: url('<?php echo e(asset(Storage::url('uploads/logo/listlogo2.jpg'))); ?>'); 
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
    background-image: url('<?php echo e(asset(Storage::url('uploads/logo/header-logo.png'))); ?>');
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
    background-image: url('<?php echo e(asset(Storage::url('uploads/logo/footer_logo.png'))); ?>');
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
<?php $__env->startPush('script-page'); ?>
 <script src="<?php echo e(asset('public/js/jquery-barcode.js')); ?>"></script>
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
            var url = '<?php echo e(route('leads.discussion.store', $quotation->id)); ?>'
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
                            postHtml += '<li class="list-group-item px-0"><div class="d-block d-sm-flex align-items-start"><img src="https://trumen.truelymatch.com/storage/uploads/avatar/avatar.png" class="img-fluid wid-40 me-3 mb-2 mb-sm-0" alt="image"><div class="w-100"><div class="d-flex align-items-center justify-content-between"><div class="mb-3 mb-sm-0"><h6 class="mb-0"><?php echo e(Auth::user()->name); ?></h6><span class="text-muted text-sm">'+value.comment+'</span></div><div class="form-check form-switch form-switch-right mb-2">'+formattedDate+' </div></div></div></div></li>';
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
                var url = '<?php echo e(route('quotation.order.status', ['id' => $quotation->id])); ?>';
               
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                       
                       'status': status,
                       'check': 'quotation',
                       "_token": "<?php echo e(csrf_token()); ?>",
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
            var btype = '<?php echo e($barcode['barcodeType']); ?>';
            var renderer = '<?php echo e($barcode['barcodeFormat']); ?>';
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
<?php $__env->stopPush(); ?>

<?php
    $settings = Utility::settings();
    $Qstatus = [
    'Pending',
    'Order',
    'Rejected'
    ]
?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('quotation.index')); ?>"><?php echo e(__('Quotation Summary')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(AUth::user()->quotationNumberFormat($quotation->is_revised != ''?$quotation->is_revised:$quotation->id)); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
           
            <?php if($quotation->assigned_to == \Auth()->user()->id): ?>     
            <div class="form-group" style="float: inline-start;width: 150px;padding-right: 5px;">
            
            <select class="form-control quotation_status" name="status">
                <option>Change Status</option>
                <option value="0">Draft</option>
                <option value="1"<?php echo e($quotation->status == 1?'selected':''); ?>>Waiting for approval</option>
                <option value="2"<?php echo e($quotation->status == 2?'selected':''); ?>>Approved</option>
               
            </select>
            </div>
            <?php else: ?>
             <?php if(!empty($deal)): ?>
                <a href="<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Deal')): ?> <?php if($deal->is_active): ?> <?php echo e(route('deals.show',$deal->id)); ?> <?php else: ?> # <?php endif; ?> <?php else: ?> # <?php endif; ?>" data-size="lg" data-bs-toggle="tooltip" class="btn btn-sm btn-secondary" style="padding: 8px;">
                   <?php echo e(__('Customer Converted')); ?>

                </a>
            <?php else: ?>
         <a href="<?php echo e(route('quotation.convert.customer',$quotation->lead_id)); ?>" class="btn btn-primary"><?php echo e(__('Convert to Customer')); ?></a>
          <?php endif; ?>
        <?php if($quotation->is_assigned == 0 && $quotation->is_jobcard == 0): ?>
        <a href="#" data-size="sm" data-url="<?php echo e(route('quotation.send', [$quotation->id, 'check' => 'check'])); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('For Approval')); ?>" class="btn btn-primary"><?php echo e(__('Save & Send')); ?></a>
        <?php else: ?>
         <a href="#" data-bs-toggle="tooltip" title="<?php echo e(__('All ready assigned')); ?>" class="btn btn-secondary"><?php echo e(__('Save & Send')); ?></a>
        <?php endif; ?>
        <?php if($quotation->is_order == 0 && $quotation->status == 2): ?><a href="<?php echo e(route('quotation.status', ['id' => $quotation->id, 'status' => 'order'])); ?>" class="btn btn-primary"><?php echo e(__('Change to Order')); ?></a>
        
        <?php endif; ?>
        
        <a href="<?php echo e(route('quotation.pdf', Crypt::encrypt($quotation->id))); ?>" class="btn btn-primary" target="_blank"><?php echo e(__('Download')); ?></a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
                <div class="col-xl-12">
                    
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="lead-sidenav" style="flex-direction: unset;">
                            <?php if(Auth::user()->type != 'client'): ?>
                                
                                <div data-target="content1" class="list-group-item list-group-item-action border-0 tab active" style="cursor: pointer;"><?php echo e(__('Quotation')); ?>

                                    <div class="float-end"></div>
                                </div>
                            <?php endif; ?>

                           
                                <div data-target="content2" data-title="<?php echo e(__('Quotataion')); ?>" class="list-group-item list-group-item-action border-0 tab" style="cursor: pointer;">| <?php echo e(__('Revise Quotation')); ?>

                                    <div class="float-end"></div>
                                </div>
                          
                                <div  data-target="content5" class="list-group-item list-group-item-action border-0 tab" style="cursor: pointer;">|<?php echo e(__('Call Note')); ?>

                                    <div class="float-end"></div>
                                </div>
                         
                            <?php if(Auth::user()->type != 'client'): ?>
                                <div data-target="content6" class="list-group-item list-group-item-action border-0 tab" style="cursor: pointer;border-bottom-left-radius: unset !important;border-top-left-radius: inherit;border-top-right-radius: inherit;;border-bottom-right-radius: unset !important;
">| <?php echo e(__('Activity')); ?>

                                    <div class="float-end"></i></div>
                                </div>
                            <?php endif; ?>
                           

                        </div>
                    </div>
                </div>
              
            </div>
            
     <?php
  $lead = \App\Models\Lead::find($quotation->lead_id);
  $customer = \App\Models\Customer::where('id', $quotation->assigned_to)->first();
  $source = '';
            $year = \Carbon\Carbon::now()->format('y');
            $years= \Carbon\Carbon::now()->format('Y-m-d');
            $yearNext = \Carbon\Carbon::parse($years)->addYears(1);
            
  ?>        
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
                    <td>Plot No. <?php echo e(!empty($quotation->organization)?$quotation->organization->plot:''); ?></td>
                    <td>Quote Date</td>
                    <td><?php echo e(\Carbon\Carbon::parse($quotation->quotation_date)->format('d/m/Y')); ?></td>
                </tr>

                <tr>
                    <td>Opp: <?php echo e(!empty($quotation->organization)?$quotation->organization->street:''); ?>, <?php echo e($quotation->organization->area); ?>,</td>
                    <td>Enquiry Ref</td>
                    <td>
                        <?php $__currentLoopData = $lead->sources(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                  <div class="hover-content">
                                                 <?php echo e($source->name); ?>

                                                 
                                                   <?php if(!$loop->last): ?>
                                                        ,
                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </td>
                </tr>

                <tr>
                    <td><?php echo e(!empty($quotation->organization)?$quotation->organization->street:''); ?>, <?php echo e(!empty($quotation->organization)?$quotation->organization->area:''); ?>,<?php echo e(!empty($quotation->organization)?$quotation->organization->city:''); ?>, <?php echo e(!empty($quotation->organization)?$quotation->organization->state:''); ?> - <?php echo e(!empty($quotation->organization)?$quotation->organization->pin:''); ?></td>
                    <td>Enquiry Date</td>
                    <td><?php echo e(\Carbon\Carbon::parse($lead->date)->format('d/m/Y')); ?></td>
                </tr>

                <tr>
                    <td>Mobile: <?php echo e(!empty($quotation->organization)?$quotation->organization->phone:''); ?></td>
                    <td>GST Number</td>
                    <td><?php echo e(!empty($customer)?$customer->tax_number:''); ?></td>
                </tr>

                <tr>
                    <td>Email: <?php echo e(!empty($quotation->organization)?$quotation->organization->email:''); ?></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>Kind Attention: <?php echo e(!empty($customer)?$customer->prefix:''); ?><?php echo e(!empty($customer)?$customer->name:''); ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 2rem; line-height: 2rem; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;" >
                <p style="font-weight: 550;">Subject: <?php echo e($quotation->subjects); ?>.</p>
                <p style="margin: 1rem 0 1rem 0;"><?php echo e($quotation->notes); ?></p>
                
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
          <p style="line-height: 1.4;width: 184px;">TTPL/<?php echo e($year); ?><?php echo e($yearNext->format('y')); ?>/<?php echo e($quotation->id); ?> <?php echo e(\Carbon\Carbon::parse($quotation->quotation_date)->format('d.m.Y')); ?></p>
          <div>
          <p>Technologies provides maximum possible customization on all of its products</p></div>
       </div>

   </div> 
<!--Page 1 of 4 End-->
<!--Page 2 of 4-->
 <?php $__currentLoopData = $iteams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <td style="text-align:center;"><b>Unite Rate (<?php echo e($item->currency == 'USD'?'$':($item->currency == 'EURO'?'€':'₹')); ?>)</b></td>
                    <td style="text-align:center;"><b>Qty</b></td>
                    <td style="text-align:center;"><b>Total (<?php echo e($item->currency == 'USD'?'$':($item->currency == 'EURO'?'€':'₹')); ?>)</b></td>
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
                             
                                                 <?php echo e($item->product()->name); ?>

                                                    </p>
                       
                        <p>HSN Code: <?php echo e($item->hsn_code); ?></p><p>Application: <?php echo e($item->application_text == ''?$item->application:$item->application_text); ?></p></div></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><?php echo e($key+1); ?>.0</td>
                    <td><b style="padding: 0px 0px 0px 10px;">Model: <?php echo e($item->model_new != ''?$item->model_new:$item->model); ?></b></td>
                    <td><b style="padding: 0px 0px 0px 10px;"><?php echo e($item->price); ?><?php echo e($item->currency == 'USD'?'$':($item->currency == 'EURO'?'€':'₹')); ?></b></td>
                    <td><b style="padding: 0px 0px 0px 10px;"><?php echo e($item->quantity); ?></b></td>
                    <td><b style="padding: 0px 0px 0px 10px;"><?php echo e($item->price); ?><?php echo e($item->currency == 'USD'?'$':($item->currency == 'EURO'?'€':'₹')); ?></b></td>
                </tr>
                <?php if($item->Enclosure == '' && $item->gland != ''): ?>
                 <tr>
                    <td></td>
                    <td><b style="padding: 0px 0px 0px 10px;"><?php echo e($item->Enclosure == ''?$glands:''); ?></b></td>
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
                    
                 <?php if(array_search($cs->prefix, $array) !== false): ?> 
                <tr>
                   
                    <td style="border-bottom: 1px solid #fff !important;"></td>
                    <td class=""><b style="padding: 10px;"><?php echo e($cs->prefix); ?></b> <?php if($c->name == 'Enclosure'): ?> <?php echo e($integrals); ?> <?php echo e($glands); ?><?php endif; ?>  <?php echo e($c->name); ?>:
                    <?php if(array_search($c->id, $lids) !== false): ?>
                    <?php
                    $dd = \App\Models\QuotationProductDesc::where('label_id', $c->id)->where('quotation_product_id', $item->id)->first();
                   
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
                    <?php echo e($fd_cds != ''?($fd_cds):''); ?>

                    
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
       <div class="Quotation-footers">
          <p style="line-height: 1.4;width: 184px;">TTPL/<?php echo e($year); ?><?php echo e($yearNext->format('y')); ?>/<?php echo e($quotation->id); ?> <?php echo e(\Carbon\Carbon::parse($quotation->quotation_date)->format('d.m.Y')); ?></p>
          <div>
          <p>Technologies provides maximum possible customization on all of its products</p></div>
       </div>

   </div> 
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            
        </div>
         <?php if(!empty($quotation->terms)): ?>
        <div style="margin:3rem ; line-height: 2rem;">
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">1. Prices</p>
            <div>
            <p><?php echo e(!empty($quotation->terms)?$quotation->terms->price:''); ?></p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">2. P&f</p>
            <?php if($quotation->terms): ?>
            <div>
            <p> GST @ <?php echo e(!empty($quotation->terms)?$quotation->terms->p_f:''); ?></p>
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
          
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
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
            <p> Within <?php echo e(!empty($quotation->terms)?$quotation->terms->delivery:''); ?> weeks after confirmed order.</p>
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
            <p style=""><?php echo e(!empty($quotation->terms)?$quotation->terms->cancellation_charges:''); ?>% Of PO amount to be paid if cancelled after order acceptance.</p>
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
        <?php else: ?>
        <div style="margin:3rem ; line-height: 2rem;">
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">1. Prices</p>
            <div>
            <p><?php echo e(!empty($quotationTR)?$quotationTR->price:''); ?></p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">2. P&f</p>
            <?php if($quotationTR): ?>
            <div>
            <p> GST @ <?php echo e(!empty($quotationTR)?$quotationTR->p_f:''); ?></p>
            </div>
            <?php else: ?>
            <div>
            <p> <?php echo e(!empty($quotationTR)?$quotationTR->p_f_next:''); ?></p>
            </div>
            <?php endif; ?>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem;border-top: 3px solid #f1eeee; border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">3. Taxes</p>
            <div>
            <p><?php echo e(!empty($quotationTR)?$quotationTR->taxes:''); ?></p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem;"></div>
          
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">4. Freight</p>
            <div>
            <p><?php echo e(!empty($quotationTR)?$quotationTR->freight:''); ?></p>
            </div>
            </div>
           
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">5. Transit insurance</p>
            <div>
            <p><?php echo e(!empty($quotationTR)?$quotationTR->insurance:''); ?>.</p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">6. Delivery</p>
            <div>
            <p> <?php echo e(!empty($quotationTR)?$quotationTR->delivery:''); ?> weeks after confirmed order.</p>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem;border-top: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">7. Payment</p>
            <div>
            <?php if(!empty($quotationTR)): ?>    
            <p><?php echo e($quotationTR->payment == '100%'?'100% Against proforma invoice prior to dispatch.':$quotation->terms->payment); ?></p>
            <?php endif; ?>
            </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee; height: 33px;">8. Warranty</p>
            <div>
            <p><?php echo e(!empty($quotationTR)?$quotationTR->warranty:''); ?> months from the date of commissioning or fifteen months from the date of supply
                which ever is earlier.</p>
                </div>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">9. Validity of offer</p>
            <p><?php echo e(!empty($quotationTR)?$quotationTR->validity_offer:''); ?> Days</p>
            </div>
            <div class="display" style="display: grid; grid-template-columns: 1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">10. Release of po</p>
            <p>Formal order mentioning your delivery address and dispatch instructions</p>
            </div>
            <div class="display" style="display: grid; grid-template-columns:1fr 3fr; justify-content: start; gap: 2rem; border-top: 3px solid #f1eeee; border-bottom: 3px solid #f1eeee; solid;border-right: 3px solid #f1eeee;border-left: 3px solid #f1eeee;">
            <p style="border-right:3px solid #f1eeee;">11. Cancellation charges</p>
            <p style=""><?php echo e(!empty($quotationTR)?$quotationTR->cancellation_charges:''); ?>% Of PO amount to be paid if cancelled after order acceptance.</p>
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
        <?php endif; ?>
        
       <div class="Quotation-footers footer1">
          <p style="line-height: 1.4;width: 184px;">TTPL/<?php echo e($year); ?><?php echo e($yearNext->format('y')); ?>/<?php echo e($quotation->id); ?> <?php echo e(\Carbon\Carbon::parse($quotation->quotation_date)->format('d.m.Y')); ?></p>
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
                 
                     <?php if(isset($quotation_r)): ?>
                    
                    <div class="table-responsive">
                        <table class="table datatable ">
                            <thead class="thead-dark">
                                <tr>
                                    <th> <?php echo e(__('Sr.')); ?></th>
                                    <th> <?php echo e(__('Quote Ref No.')); ?></th>
                                    <th> <?php echo e(__('Product Name')); ?></th>
                                    <th> <?php echo e(__('Total Cost')); ?></th>
                                    <th> <?php echo e(__('Quote Date')); ?></th>
                                    <th> <?php echo e(__('Created by')); ?></th>
                                    <th> <?php echo e(__('Quote Status')); ?></th>
                                    <?php if(Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation')): ?>
                                        <th> <?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                         $gtotal =  0;
                                         $total = 0;
                                        
                                        ?>    
                                <?php $__currentLoopData = $quotation_r; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $quotation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                       
                                        <td style="padding:0px;">
                                            <div class="number-color" style="font-size:12px;background-color:#28941F; width:56px;height:61px;">
                                                   R<?php echo e($key+1); ?></div> 
                                           </td>
                                        <td class="Id">
                                            <a href="<?php echo e(route('quotation.show', \Crypt::encrypt($quotation->id))); ?>"
                                                >TTPL/<?php echo e($year); ?><?php echo e($yearNext->format('y')); ?>/<?php echo e($quotation->is_revised); ?></a>
                                        </td>
                                        
                                        <?php if(count($quotation->items)>0): ?>
                                       
                                        <td>
                                              <?php $__currentLoopData = $iteams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                         
                                         $quoteProduct = \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->first();
                                         $products = \App\Models\ProductService::find($item->product_id);
                                         $gtotal += $item->price * (!empty($quoteProduct)?$quoteProduct->quantity:1);
                                        ?>
                                                  <?php echo e($products->name); ?> 
                                                   <?php if(!$loop->last): ?>
                                                        ,
                                                    <?php endif; ?>
                                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                  </td>
                                        <?php if(isset($quoteProduct->tax)): ?>
                                        <?php 
                                        $taxProduct = \App\Models\Tax::find($quoteProduct->tax);
                                        ?>
                                        <td><?php echo e(!empty($taxProduct)?$gtotal:$gtotal); ?></td>
                                        <?php else: ?>
                                        <td> <?php echo e($gtotal); ?></td>
                                        <?php endif; ?>
                                      
                                        <?php else: ?>
                                         <?php
                                        
                                         $quoteProduct = \App\Models\QuotationProduct::where('quotation_id', $quotation->quotation_id)->first();
                                         
                                        
                                         
                                        ?>
                                        <td>-</td>
                                        <td>0.00</td>
                                        <?php endif; ?>
                                        <td><?php echo e(Auth::user()->dateFormat($quotation->quotation_date)); ?></td>
                                        <td> <?php echo e($quotation->created_by ? \App\Models\User::find($quotation->created_by)->name : ''); ?> </td>
                                       
                                         <td><?php echo e($quotation->status ==0?'Waiting for Approval':'Approved'); ?></td>
                                        <?php if(Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation')): ?>
                                            <td class="Action">
                                                <span>

                                                    <?php if($quotation->is_converted == 0): ?>
                                                        
                                                        <?php else: ?>
                                                        
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="<?php echo e(route('pos.show', \Crypt::encrypt($quotation->converted_pos_id))); ?>" class="mx-3 btn btn-sm align-items-center"
                                                                    data-bs-toggle="tooltip"
                                                                    title="<?php echo e(__('Already convert to POS')); ?>"
                                                                    data-original-title="<?php echo e(__('Detail')); ?>">
                                                                    <i class="ti ti-file text-white"></i>
                                                                </a>
                                                            </div>
                                                        
                                                    <?php endif; ?>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit quotation')): ?>
                                                        <div class="action-btn bg-light ms-2">
                                                            <a href="<?php echo e(route('quotation.edit', \Crypt::encrypt($quotation->id))); ?>"
                                                                class="mx-3 btn btn-sm align-items-center"
                                                                data-bs-toggle="tooltip" title="Edit"
                                                                data-original-title="<?php echo e(__('Convert to JobCard')); ?>">
                                                                <i class="ti ti-pencil text-dark"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                     <div class="action-btn bg-light ms-2">
                                                                <a href="<?php echo e(route('quotation.show', \Crypt::encrypt($quotation->id))); ?>" class="mx-3 d-inline-flex align-items-center"  data-size="xl" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" data-title="<?php echo e(__('Quotation Detail')); ?>">
                                                                    <i class="ti ti-eye text-dark"></i>
                                                                </a>
                                                            </div>
                                                   
                                                </span>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
               
                <?php else: ?>
                 <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                            <h4><?php echo e(__('quotation')); ?></h4>
                        </div>
                       
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                            <h4 class="invoice-number">Record not found</h4>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>
                <?php endif; ?>
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
                                            <h5><?php echo e(__('Call Notes')); ?></h5>
                                            
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush mt-2" id="note-lists">
                                            <?php if(!$lead->discussions->isEmpty()): ?>
                                                <?php $__currentLoopData = $lead->discussions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discussion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="list-group-item px-0">
                                                        <div class="d-block d-sm-flex align-items-start">
                                                            <img src="<?php if($discussion->user->avatar): ?> <?php echo e(asset('/storage/uploads/avatar/'.$discussion->user->avatar)); ?> <?php else: ?> <?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?> <?php endif; ?>"
                                                                 class="img-fluid wid-40 me-3 mb-2 mb-sm-0" alt="image">
                                                            <div class="w-100">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <div class="mb-3 mb-sm-0">
                                                                        <h6 class="mb-0"> <?php echo e($discussion->comment); ?></h6>
                                                                        <span class="text-muted text-sm"><?php echo e($discussion->user->name); ?></span>
                                                                    </div>
                                                                    <div class="form-check form-switch form-switch-right mb-2">
                                                                        <?php echo e($discussion->created_at->diffForHumans()); ?>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <li class="text-center">
                                                    <?php echo e(__(' No Data Available.!')); ?>

                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                      

                                        <div class="row">
                                            <div class="col-12 form-group">
                                                <?php echo e(Form::label('comment', __('Message'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::textarea('comment', null, array('class' => 'form-control', 'id'=>'disc-note'))); ?>

                                                 <?php echo e(Form::hidden('id', $lead->id, array('class' => 'form-control', 'id'=>'lead_id'))); ?>

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
                                                    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
                                                    <input type="submit" value="<?php echo e(__('Add')); ?>" class="btn  btn-primary" id="add-notes">
                                                </div>
                                            </div>    
                                        </div>        
                                   

                                    </div>
                                </div>
                            </div>
                           
                        </div>
    <?php
    $quoteActivity = \App\Models\LeadActivityLog::where('lead_id', $quotation->lead_id)->get();
   
    ?>
     <div id="content6" class="content" style="display:none;">
                    <div id="activity" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Activity')); ?></h5>
                        </div>
                        <div class="card-body ">

                            <div class="row leads-scroll" >
                                <ul class="event-cards list-group list-group-flush mt-3 w-100">
                                    <?php if(count($quoteActivity)>0): ?>
                                        <?php $__currentLoopData = $quoteActivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="list-group-item card mb-3">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col-auto mb-3 mb-sm-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="theme-avtar">
                                                               <img src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>"
                                                                 class="img-fluid wid-40 me-3 mb-2 mb-sm-0" alt="image">
                                                            </div>
                                                            <div class="ms-3">
                                                                <span class="text-dark text-sm"><?php echo e(__($activity->log_type)); ?></span>
                                                                <h6 class="m-0"><?php echo $activity->getLeadRemark(); ?></h6>
                                                                <small class="text-muted"><?php echo e($activity->created_at->diffForHumans()); ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">

                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        No activity found yet.
                                    <?php endif; ?>
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
                 <?php if(count($quotation_o)>0): ?>
                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                            <h4><?php echo e(__('Order')); ?></h4>
                        </div>
                       
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                            <h4 class="invoice-number"><?php echo e($quotation->is_revised != null?Auth::user()->quotationNumberFormat($quotation->quotation_id):Auth::user()->quotationNumberFormat($quotation->quotation_id)); ?></h4>
                        </div>
                       
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <small class="font-style">
                                <strong><?php echo e(__('Billed To')); ?> :</strong><br>
                                <?php if(!empty($customer->billing_name)): ?>
                                    <?php echo e(!empty($customer->billing_name)?$customer->billing_name:''); ?><br>
                                    <?php echo e(!empty($customer->billing_address)?$customer->billing_address:''); ?><br>
                                    <?php echo e(!empty($customer->billing_city)?$customer->billing_city:'' .', '); ?><br>
                                    <?php echo e(!empty($customer->billing_state)?$customer->billing_state:'',', '); ?>,
                                    <?php echo e(!empty($customer->billing_zip)?$customer->billing_zip:''); ?><br>
                                    <?php echo e(!empty($customer->billing_country)?$customer->billing_country:''); ?><br>
                                    <?php echo e(!empty($customer->billing_phone)?$customer->billing_phone:''); ?><br>
                                    <?php if($settings['vat_gst_number_switch'] == 'on'): ?>
                                    <strong><?php echo e(__('Tax Number ')); ?> : </strong><?php echo e(!empty($customer->tax_number)?$customer->tax_number:''); ?>

                                    <?php endif; ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </small>
                        </div>
                        <div class="col-4">
                            <?php if(App\Models\Utility::getValByName('shipping_display')=='on'): ?>
                                <small>
                                    <strong><?php echo e(__('Shipped To')); ?> :</strong><br>
                                        <?php if(!empty($customer->shipping_name)): ?>
                                        <?php echo e(!empty($customer->shipping_name)?$customer->shipping_name:''); ?><br>
                                        <?php echo e(!empty($customer->shipping_address)?$customer->shipping_address:''); ?><br>
                                        <?php echo e(!empty($customer->shipping_city)?$customer->shipping_city:'' . ', '); ?><br>
                                        <?php echo e(!empty($customer->shipping_state)?$customer->shipping_state:'' .', '); ?>,
                                        <?php echo e(!empty($customer->shipping_zip)?$customer->shipping_zip:''); ?><br>
                                        <?php echo e(!empty($customer->shipping_country)?$customer->shipping_country:''); ?><br>
                                        <?php echo e(!empty($customer->shipping_phone)?$customer->shipping_phone:''); ?><br>
                                    <?php else: ?>
                                    -
                                    <?php endif; ?>
                                </small>
                            <?php endif; ?>
                        </div>
                        <div class="col-2">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="me-4">
                                    <small>
                                        <strong><?php echo e(__('Issue Date')); ?> :</strong>
                                        <?php echo e(\Auth::user()->dateFormat($quotation->quotation_date)); ?><br><br>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                             <?php $__currentLoopData = $quotation_o; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $qt =  \App\Models\Quotation::with('items')->find($order->id);
                                    ?>
                            <?php $__currentLoopData = $qt->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$iteam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <div id="<?php echo e($iteam->product()->id); ?>" class="product_barcode product_barcode_hight_de" data-skucode="<?php echo e($iteam->product()->sku); ?>"></div>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="table-responsive mt-3">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-dark" >#</th>
                                        <th class="text-dark"><?php echo e(__('Items')); ?></th>
                                        <th class="text-dark"><?php echo e(__('Quantity')); ?></th>
                                        <th class="text-dark"><?php echo e(__('Price')); ?></th>
                                        <th class="text-dark"><?php echo e(__('Tax')); ?></th>
                                        <th class="text-dark"><?php echo e(__('Tax Amount')); ?></th>
                                        <th class="text-dark"><?php echo e(__('Total')); ?></th>
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
                                    <?php $__currentLoopData = $quotation_o; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $qt =  \App\Models\Quotation::with('items')->find($order->id);
                                    ?>
                                    
                                    <?php $__currentLoopData = $qt->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$iteam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      
                                            <?php
                                               
                                                $totalQuantity+=$iteam->quantity;
                                                $totalRate+=$iteam->price;
                                                $totalDiscount+=$iteam->discount;
                                           ?>
                                               
                                           
                                      
                                        <tr>
                                            <td><?php echo e($key+1); ?></td>
                                            <td><?php echo e(!empty($iteam->product())?$iteam->product()->name:''); ?></td>
                                            <td><?php echo e($iteam->quantity); ?></td>
                                            <td><?php echo e(\Auth::user()->priceFormat($iteam->price)); ?></td>
                                            <td>
                                               
                                            </td>
                                            <td><?php echo e(\Auth::user()->priceFormat($totalTaxPrice)); ?></td>
                                            <td ><?php echo e(\Auth::user()->priceFormat(($iteam->price*$iteam->quantity) + $totalTaxPrice)); ?></td>
                                        </tr>
                                        <?php
                                                $subTotal +=  (($iteam->price*$iteam->quantity) + $totalTaxPrice);
                                                $total = $subTotal - $totalDiscount;
                                    ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><b><?php echo e(__(' Sub Total')); ?></b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($subTotal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td><b><?php echo e(__('Discount')); ?></b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($totalDiscount)); ?></td>
                                    </tr>
                                    <tr class="pos-header">
                                        <td><b><?php echo e(__('Total')); ?></b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($total)); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                     <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                            <h4><?php echo e(__('Order')); ?></h4>
                        </div>
                       
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                            <h4 class="invoice-number">Record not found</h4>
                        </div>
                       
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div></div>
     <div class="content" id="content4" style="display: none;">  
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                     <?php if(count($quotation_job)>0): ?>
                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                            <h4><?php echo e(__('JobCard')); ?></h4>
                        </div>
                       
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                            <h4 class="invoice-number"><?php echo e($quotation->is_revised != null?Auth::user()->quotationNumberFormat($quotation->quotation_id):Auth::user()->quotationNumberFormat($quotation->quotation_id)); ?></h4>
                        </div>
                       
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <small class="font-style">
                                <strong><?php echo e(__('Billed To')); ?> :</strong><br>
                                <?php if(!empty($customer->billing_name)): ?>
                                    <?php echo e(!empty($customer->billing_name)?$customer->billing_name:''); ?><br>
                                    <?php echo e(!empty($customer->billing_address)?$customer->billing_address:''); ?><br>
                                    <?php echo e(!empty($customer->billing_city)?$customer->billing_city:'' .', '); ?><br>
                                    <?php echo e(!empty($customer->billing_state)?$customer->billing_state:'',', '); ?>,
                                    <?php echo e(!empty($customer->billing_zip)?$customer->billing_zip:''); ?><br>
                                    <?php echo e(!empty($customer->billing_country)?$customer->billing_country:''); ?><br>
                                    <?php echo e(!empty($customer->billing_phone)?$customer->billing_phone:''); ?><br>
                                    <?php if($settings['vat_gst_number_switch'] == 'on'): ?>
                                    <strong><?php echo e(__('Tax Number ')); ?> : </strong><?php echo e(!empty($customer->tax_number)?$customer->tax_number:''); ?>

                                    <?php endif; ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </small>
                        </div>
                        <div class="col-4">
                            <?php if(App\Models\Utility::getValByName('shipping_display')=='on'): ?>
                                <small>
                                    <strong><?php echo e(__('Shipped To')); ?> :</strong><br>
                                        <?php if(!empty($customer->shipping_name)): ?>
                                        <?php echo e(!empty($customer->shipping_name)?$customer->shipping_name:''); ?><br>
                                        <?php echo e(!empty($customer->shipping_address)?$customer->shipping_address:''); ?><br>
                                        <?php echo e(!empty($customer->shipping_city)?$customer->shipping_city:'' . ', '); ?><br>
                                        <?php echo e(!empty($customer->shipping_state)?$customer->shipping_state:'' .', '); ?>,
                                        <?php echo e(!empty($customer->shipping_zip)?$customer->shipping_zip:''); ?><br>
                                        <?php echo e(!empty($customer->shipping_country)?$customer->shipping_country:''); ?><br>
                                        <?php echo e(!empty($customer->shipping_phone)?$customer->shipping_phone:''); ?><br>
                                    <?php else: ?>
                                    -
                                    <?php endif; ?>
                                </small>
                            <?php endif; ?>
                        </div>
                        <div class="col-3">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="me-4">
                                    <small>
                                        <strong><?php echo e(__('Issue Date')); ?> :</strong>
                                        <?php echo e(\Auth::user()->dateFormat($quotation->quotation_date)); ?><br><br>
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
                                        <th class="text-dark"><?php echo e(__('Items')); ?></th>
                                        <th class="text-dark"><?php echo e(__('Quantity')); ?></th>
                                        <th class="text-dark"><?php echo e(__('Price')); ?></th>
                                        <th class="text-dark"><?php echo e(__('Tax')); ?></th>
                                        <th class="text-dark"><?php echo e(__('Tax Amount')); ?></th>
                                        <th class="text-dark"><?php echo e(__('Total')); ?></th>
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
                                     <?php $__currentLoopData = $quotation_job; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $jb =  \App\Models\Quotation::with('items')->find($job->id);
                                    ?>
                                    <?php $__currentLoopData = $jb->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$iteam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       
                                            <?php
                                                $taxes=App\Models\Utility::tax($iteam->tax);
                                                $totalQuantity+=$iteam->quantity;
                                                $totalRate+=$iteam->price;
                                                $totalDiscount+=$iteam->discount;

                                               
                                                       $taxDataPrice;
                                                    
                                                
                                            ?>
                                      
                                        <tr>
                                            <td><?php echo e($key+1); ?></td>
                                            <td><?php echo e(!empty($iteam->product())?$iteam->product()->name:''); ?></td>
                                            <td><?php echo e($iteam->quantity); ?></td>
                                            <td><?php echo e(\Auth::user()->priceFormat($iteam->price)); ?></td>
                                            <td>
                                              
                                                    <table>
                                                        <?php
                                                            $totalTaxRate = 0;
                                                            $totalTaxPrice = 0;
                                                        ?>
                                                      
                                                    </table>
                                               
                                            </td>
                                            <td><?php echo e(\Auth::user()->priceFormat($totalTaxPrice)); ?></td>
                                            <td ><?php echo e(\Auth::user()->priceFormat(($iteam->price*$iteam->quantity) + $totalTaxPrice)); ?></td>
                                        </tr>
                                        <?php
                                                $subTotal +=  (($iteam->price*$iteam->quantity) + $totalTaxPrice);
                                                $total = $subTotal - $totalDiscount;
                                    ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td><b><?php echo e(__(' Sub Total')); ?></b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($subTotal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td><b><?php echo e(__('Discount')); ?></b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($totalDiscount)); ?></td>
                                    </tr>
                                    <tr class="pos-header">
                                        <td><b><?php echo e(__('Total')); ?></b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($total)); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                     <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                            <h4><?php echo e(__('quotation')); ?></h4>
                        </div>
                       
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                            <h4 class="invoice-number">Record not found</h4>
                        </div>
                       
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div></div>
  
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u217475692/domains/truelymatch.com/public_html/trumen/resources/views/quotation/view.blade.php ENDPATH**/ ?>
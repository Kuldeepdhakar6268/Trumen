<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Models\PosPayment;
use App\Models\Customer;
use App\Models\Organization;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\QuotationTerm;
use App\Models\SpecificationCodeOrder;
use App\Models\SpecificationCodeMaterial;
use App\Models\Specification;
use App\Models\Lead;
use App\Models\ActivityLog;
use App\Models\Deal;
use App\Models\Purchase;
use App\Models\Utility;
use App\Models\ProductServiceCategory;
use App\Models\ProductService;
use App\Models\WarehouseProduct;
use App\Models\warehouse;
use App\Models\QuotationProduct;
use Carbon\Carbon;
use Auth;
use App\Mail\SendQuotationEmail;
use App\Mail\SendQuotationEmailAck;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use DB;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->type != 'sales')
        {
        if (Auth::user()->can('manage quotation'))
        {
            $quotations      = Quotation::where('is_revised', '=', null)->with(['customer','warehouse', 'items'])->orderBy('id', 'desc')->paginate(10)->withQueryString();
             
             $customers     = Customer::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $customers->prepend('Select Customer', '');

            $warehouse     = warehouse::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $warehouse->prepend('Select Warehouse', '');
            $quotation_number = \Auth::user()->quotationNumberFormat($this->quotationNumber());
            $product_services       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $customer       = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->where('type', '!=', 'company')->where('id', '!=', \Auth::user()->id)->get()->pluck('name', 'id');
            
            $users = User::where('type', '=', 'company')->get()->pluck('name', 'id');
            $users->prepend(__('Created by'), '');
            $products       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $products->prepend(__('Product'), '');
            $status = DB::table('status')->get()->pluck('name','id');
            $status->prepend(__('Quote Status'), '');
            $key = '';
           
            $date = now();
            $chkdate = '';
            $chkstatus = '';
            
           
// dd($quotations);
            return view('quotation.index',compact('quotations','users', 'products', 'status', 'chkstatus', 'chkdate', 'key'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
        }else{
           
         $quotations      = Quotation::where('is_revisedBy', \Auth::user()->id)->orWhere('assigned_to', \Auth::user()->id)->with(['customer','warehouse', 'items'])->orderBy('id', 'desc')->paginate(10)->withQueryString();
             
             $customers     = Customer::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $customers->prepend('Select Customer', '');

            $warehouse     = warehouse::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $warehouse->prepend('Select Warehouse', '');

            // $product_services = ['--'];

            $quotation_number = \Auth::user()->quotationNumberFormat($this->quotationNumber());
            $product_services       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $customer       = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->where('type', '!=', 'company')->where('id', '!=', \Auth::user()->id)->get()->pluck('name', 'id');
            // $lead = Lead::find($lead_id);
            // $leadCustomer              = Customer::where('lead_id', $lead_id)->first();
            $users = User::where('type', '=', 'company')->get()->pluck('name', 'id');
            $users->prepend(__('Created by'), '');
            $products       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $products->prepend(__('Product'), '');
            $status = DB::table('status')->get()->pluck('name','id');
            $status->prepend(__('Quote Status'), '');
            $key = '';
           
            $date = now();
            $chkdate = '';
            $chkstatus = '';
          return view('quotation.index',compact('quotations','users', 'products', 'status', 'chkstatus', 'chkdate', 'key'));   
        }
    }
     public function searchSingleQuote(Request $request)
    {  
        
      
         $usr = \Auth::user();
         $leads = '';   
              $key = $request->search;
             if($request->search != ''){
                         $quotations     = Quotation::select('quotations.*')
                        ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                        ->leftJoin('product_services as p', 'p.id', '=', 'quotation_products.product_id')
                        ->orWhere('quotation_products.price', 'LIKE', '%' . $key . '%')
                        ->orWhere('p.name', 'LIKE', '%' . $key . '%')
                        ->orWhere('quotations.created_at', 'LIKE', '%' . $key . '%')
                        ->orderBy('quotations.id', 'desc')
                        ->paginate(10)->withQueryString();
             }   
             
                else {
          
                   $quotations      = Quotation::where('created_by', \Auth::user()->creatorId())->with(['customer','warehouse', 'items'])->orderBy('id', 'desc')->paginate(10)->withQueryString();
                    // dd($quotations);
                     $customers     = Customer::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                    $customers->prepend('Select Customer', '');
        
                    $warehouse     = warehouse::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                    $warehouse->prepend('Select Warehouse', '');
        
                    // $product_services = ['--'];
        
                    $quotation_number = \Auth::user()->quotationNumberFormat($this->quotationNumber());
                    $product_services       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                    $customer       = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->where('type', '!=', 'company')->where('id', '!=', \Auth::user()->id)->get()->pluck('name', 'id');
                  
                    $date = now();
                }
            //  dd($leads);
            $date = '';
          
            $products       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $products->prepend(__('Product'), '');
            $status = DB::table('order_status')->where('parent', 1)->get()->pluck('name','id');
            $status->prepend(__('Order Status'), '');    
            return view('quotation.list',compact('quotations', 'status', 'products', 'date', 'key'));;
            
        
    }
     public function order_search(Request $request)
    {
         $status = $request->status_id == 9?'Complete':(($request->status_id == 8)?'Open':(($request->status_id == 7)?'On-Going':'Pending'));
        // echo $status;die;
         $date = $request->date == 'Date'?'':$request->date;
         $usr = \Auth::user();
        if (Auth::user()->can('manage quotation'))
        {
            if ($date != '' && $request->products != '' && $request->status_id != '') {
                    
                       
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $quotations     = Quotation::select('quotations.*')
                        ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                        ->where('quotations.quotation_date', '=', $parsedDate)
                        ->where('quotations.order_status', '=', $status)
                        ->where('quotation_products.product_id', '=', $request->products)
                        // ->orderBy('quotations.id')
                        ->groupBy('quotations.id')
                        ->paginate(10)->withQueryString();
                        // dd($quotations);
                    
                }
            elseif ($date != '') {
                    
                       
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $quotations     = Quotation::select('quotations.*')
                        ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                        ->where('quotations.quotation_date', '=', $parsedDate)
                        // ->orderBy('quotations.id')
                        ->groupBy('quotations.id')
                         ->paginate(10)->withQueryString();
                        // dd($quotations);
                    
                }elseif ($request->products != '') {
                   
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $quotations     = Quotation::select('quotations.*')
                        ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                         ->where('quotation_products.product_id', '=', $request->products)
                        ->orderBy('quotations.id')
                        // ->groupBy('quotation_products.quotation_id')
                        ->paginate(10)->withQueryString();
                //   dd($request->products);
                }
                elseif ($request->status_id != '') {
                      
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $quotations     = Quotation::select('quotations.*')
                        ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                       
                        ->where('quotations.order_status', '=', $status)
                       
                        ->orderBy('quotations.id')
                       
                        // ->groupBy('quotation_products.quotation_id')
                        ->paginate(10)->withQueryString();
                //   dd($quotations);
                }
                else {
            
                    $quotations      = Quotation::where('created_by', \Auth::user()->creatorId())->with(['customer','warehouse', 'items'])->orderBy('id', 'desc')->paginate(10)->withQueryString();
                    // dd($quotations);
                     $customers     = Customer::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                    $customers->prepend('Select Customer', '');
        
                    $warehouse     = warehouse::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                    $warehouse->prepend('Select Warehouse', '');
        
                    // $product_services = ['--'];
        
                    $quotation_number = \Auth::user()->quotationNumberFormat($this->quotationNumber());
                    $product_services       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                    $customer       = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->where('type', '!=', 'company')->where('id', '!=', \Auth::user()->id)->get()->pluck('name', 'id');
                  
                    $date = now();

                }
                
            // $quotations      = Quotation::where(['created_by'=> \Auth::user()->creatorId(), 'status' => 1])->with(['customer','warehouse'])->get();
             
            $products       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $products->prepend(__('Product'), '');
            $status = DB::table('order_status')->where('parent', 1)->get()->pluck('name','id');
            $status->prepend(__('Order Status'), '');    
            return view('quotation.list',compact('quotations', 'status', 'products'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    
     /**
     * Show the form for creating a new relabel.
     *
     * @return \Illuminate\Http\Response
     */
      public function SendQuotationEmailCC($id){
        $quotation = Quotation::find(\Crypt::decrypt($id));  
       
        $desc = 'Dear '.$quotation->customer->name.' <br>With reference to your enquiry for Requirment of cable flat label switch recharge (LCF-R),<br>We are please to submit here unde our offer 
        for the same.<br><b>"TRUMEN"</b> is an ISO 9001-2015  manufacturer and experier at level control instruments and our list of instrument<br>';
        $pdf_link = '<a href="'.route('quotation.pdf', [Crypt::encrypt($quotation->id)]).'" targate="__blank">Pdf Link</a>';
        return view('quotation.cc_form', compact('quotation','pdf_link', 'desc'));  
      }
      public function SendQuotationEmail(Request $request){
        // dd($request->all());
                    $quotation             = Quotation::find($request->id);
                    $arraywithemails = explode(',', $request->emails);
                    $customer         = Customer::find($quotation->customer_id);
                  
                    $year = \Carbon\Carbon::now()->format('y');
                    $years= \Carbon\Carbon::now()->format('Y-m-d');
                    $yearNext = \Carbon\Carbon::parse($years)->addYears(1);
                    $settings  = Utility::settings();    
                    foreach ($quotation->items as $product) {
           
                        $item = new \stdClass();
                        $item->name = !empty($product->product()) ? $product->product()->name : '';
                    }
                   
                     $quotationEmail =
                            [
                                'customer_name' => $customer->name,
                                'to' => $request->email,
                                'subject' => $request->subject,
                                'current_year' =>$year, 
                                'next_year' =>$yearNext->format('y'), 
                                'quotation_no' => sprintf('%02d', $quotation->id),
                                'product' => $item->name,
                                'amount' => $product->price,
                                'date' => now(),
                                'notes' => $request->notes,
                                'pdf_link' => '<a href="'.route('quotation.pdf.download', [Crypt::encrypt($quotation->id)]).'" targate="__blank">Your quotation pdf link here, Please click on link for download pdf</a>'
                                
                            ];

                        try
                        {
                             config(
                        [
                            'mail.driver' => $settings['mail_driver'],
                            'mail.host' => $settings['mail_host'],
                            'mail.port' => $settings['mail_port'],
                            'mail.encryption' => $settings['mail_encryption'],
                            'mail.username' => $settings['mail_username'],
                            'mail.password' => $settings['mail_password'],
                            'mail.from.address' => $settings['mail_from_address'],
                            'mail.from.name' => $settings['mail_from_name'],
                        ]
                       );
                        //   dd($customer->email);   
                            $dd = Mail::to($customer->email)->cc($arraywithemails)->send(new SendQuotationEmailAck($quotationEmail, $request->subject));
                                return redirect()->back()->with('success', __('Quotation Acknowledgement has been send to '.$customer->name));
                        }
                        catch(\Exception $e)
                        {
                            $smtp_error = __('E-Mail not sent due to SMTP configuration');
                        }
    } 
    
      public function repeatQuotationConfirm($id)
    {
     
    //   dd($id);
           $quotation =  Quotation::find($id);
           $srno = 0;
             if($quotation->jobcard_no != 0)
             {
                $srno = Auth::user()->jobNumberFormat($quotation->jobcard_no);
             }
             else
            {
                $srno = Auth::user()->soNumberFormat($quotation->order_no == 0?$quotation->order_no+1:$quotation->order_no );
            }
              
            return view('quotation.repeat_cnf', compact('id', 'srno')); 
       
             
    
    }
    public function save_send(Request $request, $id)
    {
     
       if($request->check == 'check')
       {
        // dd($request->all());   
         $approvalCheck = 'check';  
         $users       = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->where('type', '!=', 'company')->where('id', '!=', \Auth::user()->id)->get()->pluck('name', 'id');
              $users->prepend(__('AssignedTo'), '');
            return view('quotation.save_send', compact('users', 'id', 'approvalCheck'));    
       }else if($request->check == 'jobcard')
       {
           
         $approvalCheck = 'jobcard';  
         $users       = User::where('type', '=', 'sales')->where('id', '!=', \Auth::user()->id)->get()->pluck('name', 'id');
              $users->prepend(__('AssignedTo'), '');
             
            return view('quotation.save_send', compact('users', 'id', 'approvalCheck'));   
       }
       else{
          $approvalCheck = '';  
          $users       = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->where('type', '!=', 'company')->where('id', '!=', \Auth::user()->id)->get()->pluck('name', 'id');
              $users->prepend(__('AssignedTo'), '');
            return view('quotation.save_send', compact('users', 'id', 'approvalCheck')); 
       }
             
    
    }
     public function jobcard_field_form($ids)
    {
            $id     = \Crypt::decrypt($ids);
            $jobcard            = Quotation::find($id);
        //   dd($jobcard);

            return view('quotation.jobcard_field', compact('jobcard'));
        
    }
     public function jobcard_field_save(Request $request, $id)
    {
        // dd($request->all());
            $quote            = Quotation::find($id);
            $quote->application_extra = $request->application_extra;
            $quote->admin_note = $request->admin_note;
            $quote->pressure = $request->pressure;
            $quote->temperature = $request->temperature;
            $quote->electronic_note = $request->electronic_note;
            $quote->mechanical_note = $request->mechanical_note;
            $quote->qc_note = $request->qc_note;
            $quote->remark = $request->remark;
            $quote->old_ref_no  = $request->old_ref_no ;
            $quote->qc_note = $request->qc_note;
            $quote->tag_note = $request->tag_note;
            $quote->cust_note = $request->cust_note; 
            $quote->reqbydate = $request->reqbydate; 
            $quote->quantity = $request->quantity;

            $quote->save();    
            return redirect()->back()->with('success', __('Jobcard Field added successfully!'));
        
    }
     public function orders()
    {
        if (Auth::user()->can('manage quotation'))
        {
            $quotations      = Quotation::where(['created_by'=> \Auth::user()->creatorId(), 'is_order' => 1])->with(['customer','warehouse'])->paginate(10);
             
            $products       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $products->prepend(__('Product'), '');
            $status = DB::table('order_status')->where('parent', 1)->get()->pluck('name','id');
            $status->prepend(__('Order Status'), '');    
            return view('quotation.list',compact('quotations', 'status', 'products'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
     public function jobcards()
    {
         if(Auth::user()->type != 'sales')
        {
        if (Auth::user()->can('manage quotation'))
        {
            $quotations = Quotation::where('is_assigned_to_jobcard', '!=', 0)->with(['customer','warehouse'])->orderBy('jobcard_no', 'desc')->paginate(10);
            $users = Customer::where('name', '!=', '')->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $users->prepend(__('Created by'), '');
            $products       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $products->prepend(__('Product'), '');
            return view('jobcards.list',compact('quotations', 'users', 'products'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
        }else{
            $quotations      = Quotation::where('is_assigned_to_jobcard', \Auth::user()->id)->with(['customer','warehouse'])->orderBy('jobcard_no', 'desc')->paginate(10);
            $users = Customer::where('name', '!=', '')->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $users->prepend(__('Created by'), '');
            $products       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $products->prepend(__('Product'), '');
            //  dd($quotations);
            return view('jobcards.list',compact('quotations', 'users', 'products'));
            
        }
        
    }
    public function jobcard_search(Request $request)
    {
        if (Auth::user()->can('manage quotation'))
        {
             $date = $request->date == 'Date'?'':$request->date;
            if ($date != '' && $request->products != '' && $request->user_id != '') {
                    
                       
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $quotations     = Quotation::select('quotations.*')
                        ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                        ->where('quotations.quotation_date', '=', $parsedDate)
                        ->where('quotations.created_by', '=', $request->user_id)
                        ->where('quotation_products.product_id', '=', $request->products)
                       ->where('quotations.is_jobcard', 1)
                        ->groupBy('quotations.id')
                        ->get();
                        // dd($quotations);
                    
                }
            elseif ($date != '') {
                    
                       
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $quotations     = Quotation::select('quotations.*')
                        ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                        ->where('quotations.quotation_date', '=', $parsedDate)
                        ->where('quotations.is_jobcard', 1)
                        ->groupBy('quotations.id')
                        ->get();
                        //  dd($quotations);
                    
                }elseif ($request->products != '') {
                   
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $quotations     = Quotation::select('quotations.*')
                        ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                         ->where('quotation_products.product_id', '=', $request->products)
                        ->orderBy('quotations.id')
                        ->where('quotations.is_jobcard', 1)
                        ->get();
                //   dd($request->products);
                }
                elseif ($request->user_id != '') {
                    //  dd($request->user_id);
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $quotations     = Quotation::select('quotations.*')
                        ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                       
                        ->where('quotations.customer_id', '=', $request->user_id)
                        ->where('quotations.is_jobcard', 1)
                        ->orderBy('quotations.id')
                       
                        // ->groupBy('quotation_products.quotation_id')
                        ->get();
                  
                }
                else {
            
                     $quotations      = Quotation::where(['created_by'=> \Auth::user()->creatorId(), 'is_jobcard' => 1])->with(['customer','warehouse'])->get();
                }
           
            $users = Customer::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $users->prepend(__('Created by'), '');
            $products       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $products->prepend(__('Product'), '');
            return view('jobcards.list',compact('quotations', 'users', 'products'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(\Auth::user()->can('create quotation'))
        {
            // $lead_id = request('lead_id');
            // dd($lead_id);
            $customers     = Lead::where('industry_name', '!=', '')->where('created_by', \Auth::user()->creatorId())->groupBy('industry_name')->get()->pluck('industry_name', 'id');
            $customers->prepend('Select Company', '');
            $warehouse     = warehouse::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $warehouse->prepend('Select Warehouse', '');

             $product_services = ['--'];

            $quotation_number = \Auth::user()->quotationNumberFormat($this->quotationNumber());
            $product_services       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->mapWithKeys(function ($item) {
        // Truncate the name to 20 characters
            $truncatedName = Str::limit($item->name, 22);

        // Return the id and truncated name as key-value pair
            return [$item->id => $truncatedName];
             });
            $product_services->prepend(__('---'), '');
            $customer       = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->where('type', '!=', 'company')->where('id', '!=', \Auth::user()->id)->get()->pluck('name', 'id');
            // $lead = Lead::find($lead_id);
            // $leadCustomer              = Customer::where('lead_id', $lead_id)->first();
            $users = Customer::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $users->prepend(__('Created by'), '');
            $products       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $products->prepend(__('Product'), '');
           
            $date = now();
           
            return view('quotation.create', compact('customer', 'customers','warehouse' , 'quotation_number', 'product_services'));
            // return view('quotation.quotation_create', compact('customers','warehouse' , 'quotation_number', 'product_services', 'lead', 'leadCustomer', 'customer'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }


    public function quotationCreate(Request $request)
    {
        $lead_id = request('lead_id');
        $customers     = Customer::where('name', '!=', '')->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
       
            $customers->prepend('Select Customer', '');

            $warehouse     = warehouse::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $warehouse->prepend('Select Warehouse', '');

            // $product_services = ['--'];

            $quotation_number = \Auth::user()->quotationNumberFormat($this->quotationNumber());
            $product_services       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
             $product_services->prepend(' -- ', '');
            $customer       = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->where('type', '!=', 'company')->where('id', '!=', \Auth::user()->id)->get()->pluck('name', 'id');
            $lead = Lead::find($lead_id);
            
            $leadCustomer              = Customer::where('lead_id', $lead->id)->first();
        
        // $warehouseProducts = WarehouseProduct::where('created_by', '=', \Auth::user()->creatorId())->where('warehouse_id',$request->warehouse_id)->get()->pluck('product_id')->toArray();
        // $product_services = ProductService::where('created_by', \Auth::user()->creatorId())->whereIn('id',$warehouseProducts)->where('type','!=', 'service')->get()->pluck('name', 'id');
        // $product_services->prepend(' -- ', '');

        return view('quotation.quotation_create', compact('customer','warehouse' , 'quotation_number','product_services', 'leadCustomer', 'lead'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           
        if(\Auth::user()->can('create quotation'))
        {
            $validator = \Validator::make(
                $request->all(), [
                    'customer_id' => 'required',
                    'warehouse_id' => 'nullable',
                    'quotation_date' => 'required',
                    'items' => 'required',
                ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $customer = Customer::where('id',$request->customer_id)->first();
            $warehouse = warehouse::where('name',$request->warehouse_id)->first();
            
            
            
            $quotations                 = new Quotation();
            $quotations->quotation_id    = $this->quotationNumber();
            $quotations->customer_id      = $customer->id;
            $quotations->lead_id      = $request->lead_id;
            // $quotations->application      = $request->application;
            // $quotations->warehouse_id      = $warehouse->id;
            $quotations->warehouse_id      =2;
            $quotations->quotation_date  = $request->quotation_date;
            $quotations->discount        =  $request->manual;
            $quotations->discount_type        = $request->discount_type;
            $quotations->status         =  1;
            $quotations->category_id    =  0;
            $quotations->created_by     = \Auth::user()->creatorId();
            $quotations->save();

            $products = $request->items;

            for($i = 0; $i < count($products); $i++)
            {
                $productCode                     = new SpecificationCodeOrder();
                $productCode->code                =$products[$i]['model'];
                $productCode->save();      
               
                $quotationItems              = new QuotationProduct();
                $quotationItems->quotation_id    = $quotations->id;
                $quotationItems->product_id = $products[$i]['item'];
                $quotationItems->price      = $products[$i]['price'];
                $quotationItems->application      = $products[$i]['application'];
                $quotationItems->quantity   = $products[$i]['quantity'];
                $quotationItems->tax       = $products[$i]['tax'] == null?0.00:$products[$i]['tax'];
                $quotationItems->discount        = $products[$i]['discount'];
                $quotationItems->group_id        =  $products[$i]['group_id'];
                $quotationItems->code_order_id        = $productCode->id;
                $quotationItems->model        = str_replace(' ', '', $products[$i]['model']);
                $quotationItems->save();
            }

            return redirect()->route('quotation.index', $quotations->id)->with('success', __('Quotation successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    
     /**
     * Store a newly created resource in storage.
     */
    public function quotation_store(Request $request)
     {
    //   dd($request->all());
        // if(\Auth::user()->can('create quotation'))
        // {
            $validator = \Validator::make(
                $request->all(), [
                    'company_name' => 'required',
                    'company_email' => 'required',
                    'company_phone' => 'required',
                    'plot' => 'nullable',
                    'street' => 'required',
                    'terms_price' => 'required',
                    'terms_options' => 'required',
                    'delivery' => 'required',
                    'taxes' => 'required',
                    'payment' => 'required',
                    'validity' => 'required',
                    'cancellation' => 'required',
                    'customer_id' => 'required',
                    // 'items.*.currency' => 'required',
                    'items.*.item' => 'required',
                    'items.*.application' => 'required',
                    'items.*.product_model_id' => 'required',
                    'taxes' => 'required',
                    'area' => 'nullable',
                    'pin' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'country' => 'required',
                    'sender_email' => 'required',
                    'sender_name' => 'required',
                    'address' => 'required',
                    'contact' => 'required',
                    'quotation_date' => 'nullable',
                    'items' => 'required',
                ]
            );
 

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
        //   dd(\Auth::user()->creatorId());
            //  dd($request->all());
            // $customer = Customer::where('id',$request->customer_id)->first();
            // $warehouse = warehouse::where('name',$request->warehouse_id)->first();
 
            // Customer Store Start
            
                // $customer                  = new Customer();
                // $customer->customer_id     = $this->customerNumber();
                // $customer->name            = $request->sender_name;
                // $customer->contact         = $request->contact;
                // $customer->email           = $request->sender_email;
                // $customer->prefix      =$request->prefix;
                // $customer->created_by      = \Auth::user()->creatorId();
                // $customer->billing_name    = $request->sender_name;
                //  $customer->billing_address = $request->address;
                // $customer->shipping_address = $request->address;

                // $customer->lang = !empty($default_language) ? $default_language->value : '';

                // $customer->save();
            
            // Customer End
            
            // Organization Store Start
            
            $org                 = new Organization();
            $org->name    = $request->company_name;
            $org->email      = $request->company_email;
            $org->phone      = $request->company_phone;
            $org->pin      = $request->pin;
            $org->area      = $request->area;
            $org->street      =$request->street;
            $org->city  = $request->city;
            $org->state         =  $request->state;
            $org->country    =  $request->country;
            $org->plot    =  $request->plot;
            // $org->attention    =  $request->attention;
           
            $org->save();
            
            // Organization End
            
            $c = Customer::where('lead_id', $request->customer_id)->orWhere('id', $request->customer_id)->first();
            // dd($c);
            $cust = Customer::find($c->id);
            $user = User::find(\Auth::user()->id);
            if($user)
            {
               $user->name = $request->sender_name;
            //   $user->email = $request->sender_email;
               $user->contact = $request->contact;
               $user->address = $request->address;
               $user->save();
            }
            if($cust)
            {
               $cust->prefix = $request->prefix;
               $cust->plot = $request->plot;
               $cust->street = $request->street;
               $cust->area = $request->area;
               $cust->save();
            }
            $quotations                 = new Quotation();
            $quotations->quotation_id    = $this->quotationNumber();
            $quotations->customer_id      = $cust->id;
            $quotations->lead_id      = $cust->lead_id;
            $quotations->assigned_to      = $cust->id;
            $quotations->organization_id      = $org->id;
            // $quotations->warehouse_id      = $warehouse->id;
            $quotations->warehouse_id      =3;
            $quotations->quotation_date  = now()->format('Y-m-d');
            $quotations->notes        = $request->quotation_template;
            $quotations->subjects        = $request->subject;
            $quotations->terms_conditions        = $request->terms_conditions;
            $quotations->discount        =  $request->manual;
            $quotations->discount_type        = $request->discount_type;
            $quotations->status         =  0;
            $quotations->category_id    =  0;
            
            $quotations->is_revisedBy     = Auth::user()->id;
            $quotations->created_by     = \Auth::user()->creatorId(); 
            $quotations->save();
            
            if($quotations)
            {
                $quotationTerm                 = new QuotationTerm();
                $quotationTerm->quotation_id   = $quotations->id;
                $quotationTerm->term_type   = $request->terms_options;
                $quotationTerm->price   = $request->terms_price;
                $quotationTerm->p_f   = $request->p_fs != ''?$request->p_fs:$request->p_fss;
                $quotationTerm->p_f_next   = $request->p_f == ''?$request->p_f_next:0;
                $quotationTerm->taxes   = $request->taxes;
                $quotationTerm->freight    = $request->freight;
                $quotationTerm->insurance   = $request->transit_insurance;
                $quotationTerm->bank_transaction   = $request->terms_options == 'export'?$request->transaction:'';
                $quotationTerm->delivery   = $request->delivery;
                $quotationTerm->payment   = $request->payment;
                $quotationTerm->warranty   = $request->warranty;
                $quotationTerm->validity_offer   = $request->validity;
                $quotationTerm->release_po   = $request->release_po;
                $quotationTerm->cancellation_charges   = $request->cancellation;
                if($request->check_payment == 'on'){
                    $quotationTerm->edited_payment   = $request->payments;
                }
                $quotationTerm->save();
            }
            $products = $request->items;
            $lengths = $request->length;
            // dd($lengths);
           
            for($i = 0; $i < count($products); $i++)
            {
              $slname = $products[$i]['slname'];
                // dd($slname);
                $productCode                     = new SpecificationCodeOrder();
                $productCode->code                =$products[$i]['models'] != ''?str_replace(' ', '', $products[$i]['models']):str_replace(' ', '', $products[$i]['model']);
                $productCode->save();      
            
                $quotationItems              = new QuotationProduct();
                $quotationItems->quotation_id    = $quotations->id;
                $quotationItems->product_id = $products[$i]['item'];
                $quotationItems->price      = $products[$i]['price'];
                $quotationItems->application      = $products[$i]['application'];
                $quotationItems->quantity   = $products[$i]['quantity'];
                $quotationItems->tax       = '0.00';
                $quotationItems->discount        = $products[$i]['discount'];
                $quotationItems->application_text        = $products[$i]['application_text'];
                $quotationItems->group_id        =  $products[$i]['group_id'];
                $quotationItems->gland        =  $request->Cable_Gland;
                $quotationItems->length        =   $request->length_gland;
                $quotationItems->integral        =  $products[$i]['integral'];
                $quotationItems->fd_cd        =  $products[$i]['integral'] == 'int'?'':$products[$i]['fd_cd'];
                $quotationItems->currency        =  $products[0]['currency'];
                $quotationItems->product_model_id        =  $products[$i]['product_model_id'];
                $quotationItems->Enclosure        =  $request->Enclosure;
                $quotationItems->Connection        =  $request->Process_Connection;
                $quotationItems->Temprature        =  $request->Process_Temperature;
                $quotationItems->Thermal        =  $request->Thermal;
                $quotationItems->Sensing        =  $request->Sensing;
                $quotationItems->Material        =  $request->Material;
                $quotationItems->Extension        =  $request->Extension;
                $quotationItems->electrical_connection        =  $request->Electrical_Connection;
                $quotationItems->group_material_4        =  $request->group_material_4;
                $quotationItems->group_material_5        =  $request->group_material_5;
                // $quotationItems->group_material_6        =  $request->group_material_6;
                // $quotationItems->group_material_7        =  $request->group_material_7;
                // $quotationItems->group_material_8        =  $request->group_material_8;
                $quotationItems->hsn_code        =  $products[$i]['hsn_code'];
                $quotationItems->code_order_id        = $productCode->id;
                $quotationItems->model_new        =  str_replace(' ', '', $products[$i]['model']);
                $quotationItems->model        = $products[$i]['models'] != ''?str_replace(' ', '', $products[$i]['models']):str_replace(' ', '', $products[$i]['model']);
                $quotationItems->save();

                $ids = $products[$i]['ids'];
                $des = $products[$i]['desc'];
                if($products[$i]['desc'] != null){
                  for($j = 0; $j < count($des); $j++)
                {  
                    DB::table('quotation_product_descriptions')->insert([
                        'quotation_product_id'         =>  $quotationItems->id,
                        'label_id'         =>  $ids[$j],
                        'description'         =>   $des[$j],
                        
                    ]);
                }   
                }
               
                if($products[$i]['slname'] != null){
                  for($k = 0; $k < count($slname); $k++)
                {  
                    DB::table('quotation_product_names')->insert([
                        'quotation_product_id'         =>  $quotationItems->id,
                        'product_id'         =>  $slname[$k],
                        
                        
                    ]);
                }   
                }
               
            }
            if($quotations)
            {
                ActivityLog::create(
                    [
                        'user_id' => \Auth::user()->id,
                        'deal_id' => $quotations->id,
                        'log_type' => 'Create Quotation',
                        'remark' => json_encode(['title' => 'Send Quotaion to '.$cust->prefix.' '.$cust->name.' on '.\Auth::user()->dateFormat(now())]),
                    ]
                );
            }
            return redirect()->route('quotation.show', Crypt::encrypt($quotations->id))->with('success', __('Quotation successfully created.'));
        // }
        // else
        // {
        //     return redirect()->back()->with('error', __('Permission denied.'));
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show($ids)
    {

        if (\Auth::user()->can('show quotation') || \Auth::user()->type == 'company') {
            try {
                $id = Crypt::decrypt($ids);
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', __('Quotation Not Found.'));
            }

            $id = Crypt::decrypt($ids);
        //   dd($id);
            $qData = QuotationProduct::where('quotation_id',$id)->first();
           
            $mData = QuotationProduct::where('quotation_id',$id)->get();
            $quotation = Quotation::find($id);
            $quotationTR = QuotationTerm::where('quotation_id', $quotation->is_revised)->first();
            
            if(isset($qData))
            {
             $product = ProductService::find($qData->product_id);     
            }else{
             return redirect()->back()->with('error',  __('Somthing went wrong.')); 
            }
            
            // $qData =  QuotationProduct::where('quotation_id',$id)->first();
            $quotation_r = Quotation::where('is_revised',$id)->get();
            $quotation_o = Quotation::with('items')->where(['id' => $id, 'is_order' => 1])->get();
            $quotation_job = Quotation::with('items')->where(['id' => $id, 'is_order' => 1, 'is_jobcard' => 1])->get();
            
           $barcode = [
                'barcodeType' => Auth::user()->barcodeType(),
                'barcodeFormat' => Auth::user()->barcodeFormat(),
            ];
            $stages = DB::table('status')->get()->pluck('name','id');
            $stages->prepend(__('Quote Status'), '');
            if ($quotation->created_by == \Auth::user()->creatorId()) {
                $quotationPayment = PosPayment::where('pos_id', $quotation->id)->first();
                $customer = $quotation->customer;
               
                $iteams = $quotation->items;   
            //   dd($iteams);   
            $lead = Lead::find($quotation->lead_id);
//  dd($lead);
        
      
            $deal          = Deal::where('id', '=', $lead->is_converted)->first();  
                
  
                return view('quotation.view', compact('quotation_r','quotation_o','quotation_job', 'quotation', 'customer', 'iteams', 'quotationPayment', 'barcode', 'qData', 'product','mData', 'stages', 'deal', 'quotationTR'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
   
    /**
     * Display the specified resource.
     */
    public function orderview($ids)
    {

        if (\Auth::user()->can('show quotation') || \Auth::user()->type == 'company') {
            try {
                $id = Crypt::decrypt($ids);
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', __('Quotation Not Found.'));
            }

            $id = Crypt::decrypt($ids);
            $status = DB::table('order_status')->where('parent', 1)->get()->pluck('name','id');
            $status->prepend(__('Order Status'), '');    
            $quotation = Quotation::find($id);
            $lead = Lead::find($quotation->lead_id);
            $quotation_r = Quotation::where('is_revised',$id)->get();
            $quotation_o = Quotation::where(['id' => $id, 'is_order' => 1])->first();
        //  dd($quotation_o);
            $quotation_job = Quotation::where(['id' => $id, 'is_order' => 1, 'is_jobcard' => 1])->first();
            $barcode = [
                'barcodeType' => Auth::user()->barcodeType(),
                'barcodeFormat' => Auth::user()->barcodeFormat(),
            ];
            if ($quotation->created_by == \Auth::user()->creatorId()) {
                $quotationPayment = PosPayment::where('pos_id', $quotation->id)->first();
                $customer = $quotation->customer;
                $iteams = $quotation->items;
            
        $settings = Utility::settings();
        $quotationId = Crypt::decrypt($ids);
        $quotations = Quotation::where('id', $quotationId)->first();


        $data = \DB::table('settings');
        $data = $data->where('created_by', '=', $quotations->created_by);
        $data1 = $data->get();

        foreach ($data1 as $row) {
            $settings[$row->name] = $row->value;
        }

        $customer = $quotations->customer;

        $totalTaxPrice = 0;
        $totalQuantity = 0;
        $totalRate = 0;
        $totalDiscount = 0;
        $taxesData = [];
        $items = [];
    //   dd($quotations->items);
        foreach ($quotations->items as $product) {

            $item = new \stdClass();
            $item->name = !empty($product->product()) ? $product->product()->name : '';
            $item->quantity = $product->quantity;
            $item->tax = $product->tax;
            $item->discount = $product->discount;
            $item->price = $product->price;
            $item->application = $product->application;
            $item->quote_id = $product->id;
            $item->description = $product->description;
            $item->group_material_2 = $product->group_material_2;
            $item->group_material_3 = $product->group_material_3;
            $item->group_material_5 = $product->group_material_5;
            $item->group_material_4 = $product->group_material_4;
            $item->group_material_7 = $product->group_material_7;
            $item->group_material_8 = $product->group_material_8;
            $item->id = !empty($product->product()) ? $product->product()->id : '';
            $item->sku = !empty($product->product()) ? $product->product()->sku : ''; 
            $item->image = !empty($product->product()) ? $product->product()->pro_image : 'default.png';
            $item->hsn_code = !empty($product->product()) ? $product->product()->hsn_code : '';
            $item->product_model_id = !empty($product->product()) ? $product->product()->product_model_id : ''; ;
            $item->h_code = $product->hsn_code;
            $item->p_model = \App\Models\ProductModel::find($product->product()->product_model_id)->name; 
            $item->q_model = $product->model;
            $item->gland = $product->gland != ''?Specification::find($product->gland)->name:'';
            $item->integral = $product->integral == 'int'?'Standard Integral Type: '.$product->integral:(($product->integral == 'rmt1')?'One Enclosure with special sensor cable':(($product->integral == 'rmt2')?'Remote type LFV requires two enclosure with special interconnection cable':''));
            $item->fd_cd = $product->fd_cd != ''?'Device Type: '.$product->fd_cd:'';
            $item->length = $product->length;
            $item->n_model = $product->model_new;
            $item->group_ids = $product->group_id; 
            $totalQuantity += $item->quantity;
            $totalRate += $item->price;
            $totalDiscount += $item->discount;
            $taxes = Utility::tax($product->tax);
            $itemTaxes = [];
            // if (!empty($item->tax)) {
            //     foreach ($taxes as $tax) {
            //         $taxPrice = Utility::taxRate($tax->rate, $item->price, $item->quantity);
            //         $totalTaxPrice += $taxPrice;

            //         $itemTax['name'] = $tax->name;
            //         $itemTax['rate'] = $tax->rate . '%';
            //         $itemTax['price'] = Utility::priceFormat($settings, $taxPrice);
            //         $itemTaxes[] = $itemTax;

            //         if (array_key_exists($tax->name, $taxesData)) {
            //             $taxesData[$tax->name] = $taxesData[$tax->name] + $taxPrice;
            //         } else {
            //             $taxesData[$tax->name] = $taxPrice;
            //         }

            //     }

            //     $item->itemTax = $itemTaxes;
            // } else {
                $item->itemTax = [];
            // }
            $items[] = $item;
        }
//  dd($items);
        $quotations->itemData = $items;
        $quotations->totalTaxPrice = $totalTaxPrice;
        $quotations->totalQuantity = $totalQuantity;
        $quotations->totalRate = $totalRate;
        $quotations->totalDiscount = $totalDiscount;
        $quotations->taxesData = $taxesData;

        $logo = asset(Storage::url('uploads/logo/'));
        $company_logo = Utility::getValByName('company_logo_dark');
        $quotation_logo = Utility::getValByName('quotation_logo');
        if (isset($quotation_logo) && !empty($quotation_logo)) {
            $img = Utility::get_file('quotation_logo/') . $quotation_logo;
        } else {
            $img = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png'));
        }
        //  $barcode = [
        //         'barcodeType' => Auth::user()->barcodeType(),
        //         'barcodeFormat' => Auth::user()->barcodeFormat(),
        //     ];
//  dd($settings['quotation_template']);
        if ($quotations) {
            $color = '#' . $settings['quotation_color'];
            $font_color = Utility::getFontColor($color);
 
        }   
        // dd($quotation);
                return view('quotation.vieworder', compact('quotation_r','quotation_o','quotation_job', 'lead','quotation', 'customer', 'iteams', 'quotationPayment', 'barcode','quotations', 'color', 'settings', 'customer', 'img', 'font_color', 'status'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($ids)
    {
        if(\Auth::user()->can('edit quotation'))
        {

            $id   = Crypt::decrypt($ids);
            $quotation     = Quotation::find($id);
        //   dd($quotation);
            $customer = Customer::where('id',$quotation->customer_id)->first();
            $warehouse = warehouse::where('id',$quotation->warehouse_id)->first();

            $warehouseProducts = WarehouseProduct::where('created_by', '=', \Auth::user()->creatorId())->where('warehouse_id',$quotation->warehouse_id)->get()->pluck('product_id')->toArray();
            $product_services = ProductService::where('created_by', \Auth::user()->creatorId())->where('type','!=', 'service')->get()->pluck('name', 'id');
            $product_services->prepend(' -- ', '');

            $quotation_number = \Auth::user()->quotationNumberFormat($quotation->quotation_id);

            return view('quotation.edit', compact('customer', 'product_services','warehouse' , 'quotation_number' , 'quotation'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quotation $quotation)
    {
    //   dd($request->all());
        if(\Auth::user()->can('edit quotation'))
        {
            if($request->revised == 'yes')
            {
        //  dd($this->quotationNumber());
             $validator = \Validator::make(
                    $request->all(), [
                        'customer_id' => 'required',
                        'quotation_date' => 'required',
                        // 'items' => 'required',
                    ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('quotation.index')->with('error', $messages->first());
                }
                // dd($quotation);
            if($request->organization_id == null)   
            {
            $org                 = new Organization();
            $org->name    = $request->company_name;
            $org->email      = $request->email;
            $org->phone      = $request->phone;
            $org->pin      = $request->pincode;
            $org->area      = $request->area_name;
            $org->street      =$request->street_name;
            $org->city  = $request->city;
            $org->state         =  $request->state;
            $org->country    =  $request->country;
            $org->plot    =  $request->ploat_no;
            $org->attention    =  $request->attention;
             $org->save();
            }
           
                $customer = Customer::find($request->customer_id);
                // $warehouse = warehouse::where('name',$request->warehouse_id)->first();
                // $customer = $request->organization_id
                 $quotationR = new Quotation();
                $quotationR->customer_id      = $customer->id;
                $quotationR->quotation_id    = $this->quotationNumber();
                $quotationR->organization_id    = $request->organization_id == null?$org->id:$request->organization_id;
                $quotationR->is_revised      = $quotation->id;
                $quotationR->lead_id      = $quotation->lead_id;
                $quotationR->assigned_to      = $quotation->assigned_to;
                $quotationR->notes        = $request->quotation_template;
                $quotationR->subjects        = $request->subject;
                $quotationR->terms_conditions        = $request->terms_conditions;
                $quotationR->enquiry_ref        = $request->enquiry_ref;
                // $quotationR->warehouse_id      = $warehouse->id;
                $quotationR->quotation_date  = $request->quotation_date;
                $quotationR->status         =  0;
                $quotationR->category_id    =  0;
                $quotationR->is_revisedBy     = Auth::user()->id;
                $quotationR->created_by     = \Auth::user()->creatorId(); 
                //  dd($quotationR);
                $quotationR->save();
                
                // if(!empty($quotation->terms)){
                   
                // $quotationTerm                 = QuotationTerm::find($quotation->terms->id);
                // $quotationTerm->quotation_id   = $quotations->id;
                // $quotationTerm->term_type   = $request->terms_options;
                // $quotationTerm->price   = $request->terms_price;
                // $quotationTerm->p_f   = $request->p_f;
                // $quotationTerm->p_f_next   = $request->p_f_next;
                // $quotationTerm->taxes   = $request->taxes;
                // $quotationTerm->freight    = $request->freight;
                // $quotationTerm->insurance   = $request->transit_insurance;
                // $quotationTerm->bank_transaction   = $request->terms_options == 'export'?$request->transaction:'';
                // $quotationTerm->delivery   = $request->delivery;
                // $quotationTerm->payment   = $request->payment;
                // $quotationTerm->warranty   = $request->warranty;
                // $quotationTerm->validity_offer   = $request->validity;
                // $quotationTerm->release_po   = $request->release_po;
                // $quotationTerm->cancellation_charges   = $request->cancellation;
                
                // $quotationTerm->save();
            
                // }else{
                  
                $quotationTerm                 = new QuotationTerm();
                $quotationTerm->quotation_id   = $quotation->id;
                $quotationTerm->term_type   = $request->terms_options;
                $quotationTerm->price   = $request->terms_price;
                $quotationTerm->p_f   = $request->p_f;
                $quotationTerm->p_f_next   = $request->p_f_next;
                $quotationTerm->taxes   = $request->taxes;
                $quotationTerm->freight    = $request->freight;
                $quotationTerm->insurance   = $request->transit_insurance;
                $quotationTerm->bank_transaction   = $request->terms_options == 'export'?$request->transaction:'';
                $quotationTerm->delivery   = $request->delivery;
                $quotationTerm->payment   = $request->payment;
                $quotationTerm->warranty   = $request->warranty;
                $quotationTerm->validity_offer   = $request->validity;
                $quotationTerm->release_po   = $request->release_po;
                $quotationTerm->cancellation_charges   = $request->cancellation;
                
                $quotationTerm->save();   
                // }
                $products = $request->items;
                
                for($i = 0; $i < count($products); $i++)
                {
                    
                    $quotationProduct = null;

                    if($quotationProduct == null)
                    {
                        $quotationProduct             = new QuotationProduct();
                        $quotationProduct->quotation_id    = $quotationR->id;

                    }
                    if(isset($products[$i]['id']))
                    {
                        $quotationProduct->product_id = $products[$i]['id'];
                    }

                    $quotationProduct->quantity    = $products[$i]['quantity'];
                    $quotationProduct->tax         = '0.00';
                    $quotationProduct->discount    = $products[$i]['discount'];
                    $quotationProduct->price       = $products[$i]['price'];
                    $quotationProduct->product_model_id       = $products[$i]['product_model_id'];
                    $quotationProduct->code_order_id       = $products[$i]['code_order_id'];
                    $quotationProduct->length       = $products[$i]['length'];
                    $quotationProduct->group_id        =  $products[$i]['group_id'];
                    $quotationProduct->application_text        = $products[$i]['application_text'];
                    $quotationProduct->gland        =  $request->gland;
                    $quotationProduct->integral        =  $products[$i]['integral'];
                    $quotationProduct->application        =  $products[$i]['application'];
                    $quotationProduct->fd_cd        =  $products[$i]['fd_cd'];
                    $quotationProduct->hsn_code        =  $products[$i]['hsn_code'];
                    $quotationProduct->model_new        =$products[$i]['model'];
                    $quotationProduct->model        = $products[$i]['models'] != ''?str_replace(' ', '', $products[$i]['models']):str_replace(' ', '', $products[$i]['model']);
                    $quotationProduct->description = $products[$i]['description'];
                    $quotationProduct->save();
// dd($quotationProduct);
                }

                return redirect()->route('quotation.index')->with('success', __('Quotation successfully updated.'));   
            }
            if($quotation->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                        'customer_id' => 'required',
                        'quotation_date' => 'required',
                        'items' => 'required',
                    ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('quotation.index')->with('error', $messages->first());
                }
                $customer = Customer::where('id',$request->customer_id)->first();
                // $warehouse = warehouse::where('name',$request->warehouse_id)->first();

                $quotation->customer_id      = $customer->id;
                // $quotation->warehouse_id      = $warehouse->id;
                $quotation->quotation_date  = $request->quotation_date;
                $quotation->status         =  0;
                $quotation->category_id    =  0;
                $quotation->created_by     = \Auth::user()->creatorId();
                $quotation->save();
                $products = $request->items;
            //   dd($products);
                for($i = 0; $i < count($products); $i++)
                {
                    
                    $quotationProduct = QuotationProduct::find($products[$i]['id']);

                    if($quotationProduct == null)
                    {
                        $quotationProduct             = new QuotationProduct();
                        $quotationProduct->quotation_id    = $quotation->id;

                    }
                    if(isset($products[$i]['item']))
                    {
                        $quotationProduct->product_id = $products[$i]['item'];
                    }

                    $quotationProduct->quantity    = $products[$i]['quantity'];
                    $quotationProduct->tax         = $products[$i]['tax'];
                    $quotationProduct->discount    = $products[$i]['discount'];
                    $quotationProduct->price       = $products[$i]['price'];
                    $quotationProduct->description = $products[$i]['description'];
                    $quotationProduct->save();
// dd($quotationProduct);
                }

                return redirect()->route('quotation.index')->with('success', __('Quotation successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    /**
     * Remove the specified resource from storage.
     */
       public function repeatQuotation(Request $request, $id)
    {
    //  dd($request->all());
      $quotation = Quotation::find($id);
      $ordeCount = Quotation::where(['is_revised' => null, 'is_order' => 1])->count();
    //   dd($ordeCount);
        // $quotationTerm                 = QuotationTerm::find($quotation->terms->id);
    //   dd($quotationTerm->term_type);
        if(\Auth::user()->can('edit quotation'))
        {
            
                // dd($quotation);
                $quotProdut = QuotationProduct::where('quotation_id',$quotation->id )->get();
                $quotationR = new Quotation();
                $quotationR->customer_id      = $quotation->customer_id;
                $quotationR->quotation_id    =count(Quotation::all()) + 1;
                $quotationR->organization_id    = $quotation->organization_id;
                $quotationR->is_revised      =null;
                $quotationR->is_repeat      = $quotation->id;
                $quotationR->lead_id      = $quotation->lead_id;
                $quotationR->assigned_to      = $quotation->assigned_to;
                $quotationR->notes        = $quotation->notes;
                $quotationR->subjects        = $quotation->subjects;
                $quotationR->terms_conditions        = $quotation->terms_conditions;
                $quotationR->enquiry_ref        = $quotation->enquiry_ref;
                // $quotationR->warehouse_id      = $warehouse->id;
                $quotationR->quotation_date  = $request->delivery_date != null? $request->delivery_date: now()->format('Y-m-d');
                $quotationR->old_so_no      = $request->old_so_no;
                $quotationR->status         =  0;
                $quotationR->category_id    =  0;
                $quotationR->is_revisedBy     = null;
                $quotationR->application_extra        = $quotation->application_extra;
                $quotationR->pressure        = $quotation->pressure;
                $quotationR->temperature        = $quotation->temperature;
                $quotationR->admin_note        = $quotation->admin_note;
                $quotationR->electronic_note        = $quotation->electronic_note;
                $quotationR->mechanical_note        = $quotation->mechanical_note;
                $quotationR->qc_note        = $quotation->qc_note;
                $quotationR->remark        = $quotation->remark;
                $quotationR->tag_note        = $quotation->tag_note;
                $quotationR->cust_note        = $quotation->cust_note;
                $quotationR->reqbydate        = $quotation->reqbydate;
                $quotationR->quantity        = $quotation->quantity;
                $quotationR->is_order      = $quotation->is_order;
                $quotationR->order_no      = $ordeCount + 1;
               
                $quotationR->created_by     = \Auth::user()->creatorId(); 
               
                $quotationR->save();
                
               
                $quotationTerms                 = QuotationTerm::find($quotation->terms->id);
                
                $quotationTerm                 = new QuotationTerm();
                $quotationTerm->quotation_id   = $quotationR->id;
                $quotationTerm->term_type   = $quotationTerms->term_type;
                $quotationTerm->price   = $quotationTerms->price;
                $quotationTerm->p_f   = $quotationTerms->p_f;
                $quotationTerm->p_f_next   = $quotationTerms->p_f_next;
                $quotationTerm->taxes   = $quotationTerms->taxes;
                $quotationTerm->freight    = $quotationTerms->freight;
                $quotationTerm->insurance   = $quotationTerms->insurance;
                $quotationTerm->bank_transaction   = $quotationTerms->bank_transaction;
                $quotationTerm->delivery   = $quotationTerms->delivery;
                $quotationTerm->payment   = $quotationTerms->payment;
                $quotationTerm->warranty   = $quotationTerms->warranty;
                $quotationTerm->validity_offer   = $quotationTerms->validity_offer;
                $quotationTerm->release_po   = $quotationTerms->release_po;
                $quotationTerm->cancellation_charges   = $quotationTerms->cancellation_charges;
                
                $quotationTerm->save();   
                // }
                $products =$quotProdut;
                
                for($i = 0; $i < count($products); $i++)
                {
                    
                    $quotationProduct = null;

                    if($quotationProduct == null)
                    {
                        $quotationProduct             = new QuotationProduct();
                        $quotationProduct->quotation_id    = $quotationR->id;

                    }
                    if(isset($products[$i]['id']))
                    {
                        $quotationProduct->product_id = $products[$i]['product_id'];
                    }

                    $quotationProduct->quantity    = $products[$i]['quantity'];
                    $quotationProduct->tax         = '0.00';
                    $quotationProduct->discount    = $products[$i]['discount'];
                    $quotationProduct->price       = $products[$i]['price'];
                    $quotationProduct->product_model_id       = $products[$i]['product_model_id'];
                    $quotationProduct->code_order_id       = $products[$i]['code_order_id'];
                    $quotationProduct->length       = $products[$i]['length'];
                    $quotationProduct->group_id        =  $products[$i]['group_id'];
                    $quotationProduct->application_text        = $products[$i]['application_text'];
                    $quotationProduct->gland        =  $products[$i]['gland'];
                    $quotationProduct->integral        =  $products[$i]['integral'];
                    $quotationProduct->application        =  $products[$i]['application'];
                    $quotationProduct->fd_cd        =  $products[$i]['fd_cd'];
                    $quotationProduct->hsn_code        =  $products[$i]['hsn_code'];
                    $quotationProduct->model_new        =$products[$i]['model_new'];
                    $quotationProduct->model        = $products[$i]['model'];
                    $quotationProduct->description = $products[$i]['description'];
                    $quotationProduct->save();

                }

                return redirect()->route('quotation.order')->with('success', __('Quotation successfully created.'));   
          
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function destroy(Quotation $quotation)
    {
        if(\Auth::user()->can('delete quotation'))
        {
            if($quotation->created_by == \Auth::user()->creatorId())
            {
                $quotation->delete();
                QuotationProduct::where('quotation_id', '=', $quotation->id)->delete();


                return redirect()->route('quotation.index')->with('success', __('Quotation successfully deleted.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    
     /**
     * Remove the specified resource from storage.
     */
    public function changeStatus(Request $request, $id, $status)
    {
      
          
                if($status == 'order')
                {
                    
                   $quotation             = Quotation::find($id);
                   $count = Quotation::where(['is_order' => 1])->count();
                                $quotation->is_order = 1;
                                 $quotation->order_no = $count+1;
                                 $quotation->status = 1;
                                $quotation->save();  
                }else if($status == 'JobcardAssigned'){
                    $quotation             = Quotation::find($id);
                                $quotation->is_assigned_to_jobcard = $request->sid;
                                 $quotation->status = 1;
                                $quotation->save(); 
                }
                else if($status == 'userAssigned'){
                  
                    $quotation             = Quotation::find($id);
                    $customer         = Customer::find($quotation->customer_id);
                     
                                $quotation->assigned_to = $request->sid;
                                $quotation->is_assigned = 1;
                                $quotation->status = 1;
                                $quotation->save();    
                      
                   
                   
                    //  dd($customer);
                                
                    $year = \Carbon\Carbon::now()->format('y');
                    $years= \Carbon\Carbon::now()->format('Y-m-d');
                    $yearNext = \Carbon\Carbon::parse($years)->addYears(1);
                    $settings  = Utility::settings();    

                     $quotationEmail =
                            [
                                'customer_name' => $customer->name,
                                'to' => $customer->email,
                                'subject' => 'Quotation pdf',
                                'current_year' =>$year, 
                                'next_year' =>$yearNext->format('y'), 
                                'quotation_no' => sprintf('%02d', $quotation->id),
                                'assign_user' => !empty($quotation->assignTo)?$quotation->assignTo->name:'',
                                'email' => !empty($quotation->assignTo)?$quotation->assignTo->email:'',
                                'date' => now(),
                                'description' => 'Quotation confirmation with pdf link',
                                'pdf_link' => '<a href="'.route('quotation.pdf', [Crypt::encrypt($quotation->id)]).'" targate="__blank">Your quotation pdf link here, Please click on link for download pdf</a>',
                            ];

                        try
                        {
                             config(
                        [
                            'mail.driver' => $settings['mail_driver'],
                            'mail.host' => $settings['mail_host'],
                            'mail.port' => $settings['mail_port'],
                            'mail.encryption' => $settings['mail_encryption'],
                            'mail.username' => $settings['mail_username'],
                            'mail.password' => $settings['mail_password'],
                            'mail.from.address' => $settings['mail_from_address'],
                            'mail.from.name' => $settings['mail_from_name'],
                        ]
                       );
                        //   dd($customer->email);   
                            $dd = Mail::to($customer->email)->send(new SendQuotationEmail($quotationEmail));
                                $response['status'] =true;
                                $response['msg'] ='Order has been assigne to the user';
                                $response['assigny'] =!empty($quotation->assignTo)?$quotation->assignTo->name:'';
                                return response()->json($response);
                        }
                        catch(\Exception $e)
                        {
                            $smtp_error = __('E-Mail not sent due to SMTP configuration');
                        }
                        
                }
                else{
                    $count = Quotation::where(['is_jobcard' => 1])->count();
                    $quotation             = Quotation::find($id);
                                $quotation->is_jobcard = 1;
                                $quotation->jobcard_no = $count+1;
                                $quotation->status = 2;
                                $quotation->save(); 
                }
               
             $st = $status == 'order'?'Quotation has been change to order successfully':(($status == 'userAssigned')?'Order has been AssignedTo your':'Order has been change to JobCard successfully');
            if($quotation)
            {    
            return redirect()->back()->with('success', __($st));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        
    }
    
    public function changeOrderStatus(Request $request, $id)
    {
           if($request->check == 'order')
                {
        
                
                                $quotation = Quotation::find($id);
                                $quotation->order_status = $request->status;
                                $quotation->save(); 
                                
                                $response['status'] =true;
                                $response['msg'] ='Order status has been changed';
                                $response['data'] =$quotation;
                                return response()->json($response);
                }
                else
                {
                                $quotation = Quotation::find($id);
                                $quotation->status = $request->status;
                                $quotation->save(); 
                                $response['status'] =true;
                                $response['msg'] ='Quotation status has been changed';
                                $response['data'] =$quotation;
                                return response()->json($response);
                }
           
        
    }

    function quotationNumber()
    {
        $latest = Quotation::where('is_revised', '=', null)->get();
        // dd(count($latest));
        if(!$latest)
        {
            return 1;
        }

        return count($latest) + 1;
    }

    public function product(Request $request)
    {
        
         
        $data['product']     = $product = ProductService::find($request->product_id);
        // dd($product);
        //specification listing start
       
        // dd($product);
         $cat = Specification::with('subspecifications')->where(['priority' => 0, 'product_model_id' => $product->product_model_id])->get();
         $material = SpecificationCodeMaterial::where(['specification_code_order_id' =>$product->specification_code_order_id])->orderBy('id', 'desc')->pluck('name')->toArray();
        //  $productService = ProductService::find($id);
     
        // $all_products = ProductService::getallproducts()->count();

      
       $datas = [];
       $htmls = '';
       $count = 0;
        foreach ($cat as $key => $c) {
            $chkkey = $key;
            $kk = $key+1;
            $count = $count+1;
           if($key == 0)
           {
             $html ='<tr class="group-material-'.$key.'">
            <td>
            <label for="specification-name" class="form-label" style="display: inline-block; margin-right: 100px;">' . $c->name . ' :</label></td>
            <td style="width: 550px;"><select class="form-control group-material-'.$key.'" data-id="' . $product->product_model_id . '" id="'.$c->id.'" name="'.$c->name.'" style="display: inline-block; margin-right: 25px;"><option value="0">Select ' . $c->name . '</option>';   
           }else{
                $html ='<tr class="d-none group-material-'.$key.'" id="group-material-'.$key.'">
            <td>
            <label for="specification-name" class="form-label" style="display: inline-block; margin-right: 100px;">' . $c->name . ' :</label></td>
            <td style="width: 550px;"><select class="form-control group-material-'.$key.'" data-id="' . $product->product_model_id . '" id="'.$c->id.'" name="'.$c->name.'" style="display: inline-block; margin-right: 25px;"><option value="0">Select ' . $c->name . '</option>';
           }
             
            $lab = $c->name == 'Enclosure'?'Enclosure':(($c->name == 'Process Connection')?'Connection':(($c->name == 'Process Temprature')?'Temprature':(($c->name == 'Thermal Compensation')?'Thermal':(($c->name == 'Sensing Surface Material')?'Sensing':(($c->name == 'Process Connection Material')?'Material':(($c->name == 'Sensor Extension Material')?'Extension':'Length'))))));
           
             foreach ($c->subspecifications as $key => $cs) {
                 if (array_search($cs->prefix, $material) !== false) {
                   $html .='<option value="' . $cs->id . '">' . $cs->prefix .': '. $cs->name. '</option>';
                } else {
                   $html .='<option value="' . $cs->id . '">' . $cs->prefix .': '. $cs->name. '</option>';  
                }
              
             }
             $html .='</select>';
             foreach ($c->subspecifications as $key => $cs) {
                 if (array_search($cs->prefix, $material) !== false) {
                   $html .='<input type="hidden" value="0.00" class="selected_price">';
                   $html .='<input type="hidden" value="0.00" class="selected_price_usd">';
                   $html .='<input type="hidden" value="0.00" class="selected_price_euro">';
                }
             }
              $html .='</td><td class="withinput d-none"><input type="checkbox" class="enablebox"></td><td class="withinput d-none"><textarea type="text" class="form-control inputDesc" rows="1" id="group-material-field-'.$count.'" placeholder="Enter Description" name="desc[]"disabled multiple></textarea><input class="form-control inputId" type="hidden" value="'.$c->id.'" name="ids[]" multiple disabled></td></tr>';
              if($chkkey == 0)
               {
                  $html .='<tr class="d-none glands"></tr>';
               }
               if($chkkey == 2)
               {
                  $html .='<tr class="d-none tharmal"></tr>';
               }
               array_push($datas, $html);
        }
         //specification listing end
        $data['unit']        = !empty($product->unit) ? $product->unit->name : '';
        $data['modelSeries']        = !empty($product->productModels) ? $product->productModels->name : '';
        $data['taxRate']     = $taxRate = !empty($product->tax_id) ? $product->taxRate($product->tax_id) : 0;
        $data['taxes']       = !empty($product->tax_id) ? $product->tax($product->tax_id) : 0;
        $salePrice           = $product->sale_price;
        $quantity            = 1;
        $taxPrice            = ($taxRate / 100) * ($salePrice * $quantity);
        $data['totalAmount'] = ($salePrice * $quantity);
        $data['listing'] = $datas; 
        $product = ProductService::find($request->product_id);
        $productquantity = 1;
    
        // if ($product) {
        //     $productquantity = $product->quantity;
        // }
        $data['productquantity'] = $productquantity;
//  dd($data);
        return json_encode($data);
    }

    public function productDestroy(Request $request)
    {

        if(\Auth::user()->can('delete quotation'))
        {

            QuotationProduct::where('id', '=', $request->id)->delete();

            return redirect()->back()->with('success', __('Quotation product successfully deleted.'));

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function items(Request $request)
    {
       
        $data['items'] = $item = QuotationProduct::where('quotation_id', $request->quotation_id)->where('product_id', $request->product_id)->first();
        $product = ProductService::find($request->product_id);
        $quote = Quotation::where('id', $request->quotation_id)->first();
        
        $data['discount'] = $quote->discount;
        $data['discount_type'] = $quote->discount_type;
       
      
        
        if(!empty($item)){
        //   $array = explode('-', $item->model);
                $arr = explode(':', $item->model);
                $ss = str_replace(' ', '', $arr[1]);
                $array = explode('-', $ss);
        
         $cat = Specification::with('subspecifications')->where(['priority' => 0, 'product_model_id' => $item->product_model_id])->get();   
          $datas = [];
       $htmls = '';
        foreach ($cat as $key => $c) {
           if($key == 0)
           {
             $html ='<tr>
            <td>
            <label for="specification-name" class="form-label" style="display: inline-block; margin-right: 100px;">' . $c->name . ' :</label></td>
            <td><select class="form-control group-material-'.$key.'" data-id="' . $item->product_model_id . '" style="display: inline-block; margin-right: 25px;" name="'.$c->name.'"><option value="0">Select' . $c->name . '</option>';   
           }else{
                $html ='<tr>
            <td>
            <label for="specification-name" class="form-label" style="display: inline-block; margin-right: 100px;">' . $c->name . ' :</label></td>
            <td><select class="form-control group-material-'.$key.'" data-id="' . $item->product_model_id . '" style="display: inline-block; margin-right: 25px;" name="'.$c->name.'"><option value="0">Select' . $c->name . '</option>';
           }
            
            
           
             foreach ($c->subspecifications as $key => $cs) {
                 if (array_search($cs->prefix, $array) !== false) {
                   $html .='<option value="' . $cs->id . '" selected>' . $cs->prefix .': '. $cs->name. '</option>';
                } else {
                   $html .='<option value="' . $cs->id . '">' . $cs->prefix .': '. $cs->name. '</option>';  
                }
              
             }
             $html .='</select>';
              foreach ($c->subspecifications as $key => $cs) {
                 if (array_search($cs->prefix, $array) !== false) {
                     
                   $html .='<input type="hidden" value="' . $cs->price . '" class="selected_price">';
                   $html .='<input type="hidden" value="' . $cs->usd_price . '" class="selected_price_usd">';
                   $html .='<input type="hidden" value="' . $cs->euro_price . '" class="selected_price_euro">';
                }
             }
              $html .='</td></tr>';
               array_push($datas, $html);
        }
        $data['listing'] = $datas;
        return json_encode($data);
        }else{
         $cat = Specification::with('subspecifications')->where(['priority' => 0, 'product_model_id' => $product->product_model_id])->get();
         $material = SpecificationCodeMaterial::where(['specification_code_order_id' =>$product->specification_code_order_id])->orderBy('id', 'desc')->pluck('name')->toArray(); 
          $datas = [];
       $htmls = '';
        foreach ($cat as $key => $c) {
           if($key == 0)
           {
             $html ='<tr>
            <td>
            <label for="specification-name" class="form-label" style="display: inline-block; margin-right: 100px;">' . $c->name . ' :</label></td>
            <td><select class="form-control group-material-'.$key.'" data-id="' . $product->product_model_id . '" style="display: inline-block; margin-right: 25px;"><option value="0">Select' . $c->name . '</option>';   
           }else{
                $html ='<tr>
            <td>
            <label for="specification-name" class="form-label" style="display: inline-block; margin-right: 100px;">' . $c->name . ' :</label></td>
            <td><select class="form-control group-material-'.$key.'" data-id="' . $product->product_model_id . '" style="display: inline-block; margin-right: 25px;"><option value="0">Select' . $c->name . '</option>';
           }
            
            
           
             foreach ($c->subspecifications as $key => $cs) {
                 if (array_search($cs->prefix, $material) !== false) {
                   $html .='<option value="' . $cs->id . '" selected>' . $cs->prefix .': '. $cs->name. '</option>';
                } else {
                   $html .='<option value="' . $cs->id . '">' . $cs->prefix .': '. $cs->name. '</option>';  
                }
              
             }
             $html .='</select>';
             foreach ($c->subspecifications as $key => $cs) {
                 if (array_search($cs->prefix, $material) !== false) {
                     
                   $html .='<input type="hidden" value="' . $cs->price . '" class="selected_price">';
                   $html .='<input type="hidden" value="' . $cs->usd_price . '" class="selected_price_usd">';
                   $html .='<input type="hidden" value="' . $cs->euro_price . '" class="selected_price_euro">';
                }
             }
            $html .='</td></tr>';
               array_push($datas, $html);
        }
        $data['listing'] = $datas;
       
        return json_encode($data);
        }
      
      
    }

    public function productQuantity(Request $request)
    {
        $product = ProductService::find($request->item_id);
        $productquantity = 1;

        // if ($product) {
        //     $productquantity = $product->getQuantity();
        // }

        return json_encode($productquantity);

    }

    public function previewQuotation($template, $color)
    {

        $objUser = \Auth::user();
        $settings = Utility::settings();

        $quotation = new Quotation();
        $quotationPayment = new posPayment();
        $quotationPayment->amount = 360;
        $quotationPayment->discount = 100;

        $customer = new \stdClass();
        $customer->email = '<Email>';
        $customer->shipping_name = '<Customer Name>';
        $customer->shipping_country = '<Country>';
        $customer->shipping_state = '<State>';
        $customer->shipping_city = '<City>';
        $customer->shipping_phone = '<Customer Phone Number>';
        $customer->shipping_zip = '<Zip>';
        $customer->shipping_address = '<Address>';
        $customer->billing_name = '<Customer Name>';
        $customer->billing_country = '<Country>';
        $customer->billing_state = '<State>';
        $customer->billing_city = '<City>';
        $customer->billing_phone = '<Customer Phone Number>';
        $customer->billing_zip = '<Zip>';
        $customer->billing_address = '<Address>';

        $totalTaxPrice = 0;
        $taxesData = [];
        $items = [];
        for ($i = 1; $i <= 3; $i++) {
            $item = new \stdClass();
            $item->name = 'Item ' . $i;
            $item->quantity = 1;
            $item->tax = 5;
            $item->discount = 50;
            $item->price = 100;

            $taxes = [
                'Tax 1',
                'Tax 2',
            ];

            $itemTaxes = [];
            foreach ($taxes as $k => $tax) {
                $taxPrice = 10;
                $totalTaxPrice += $taxPrice;
                $itemTax['name'] = 'Tax ' . $k;
                $itemTax['rate'] = '10 %';
                $itemTax['price'] = '$10';
                $itemTaxes[] = $itemTax;
                if (array_key_exists('Tax ' . $k, $taxesData)) {
                    $taxesData['Tax ' . $k] = $taxesData['Tax 1'] + $taxPrice;
                } else {
                    $taxesData['Tax ' . $k] = $taxPrice;
                }
            }
            $item->itemTax = $itemTaxes;
            $items[] = $item;
        }

        $quotation->quotation_id = 1;

        $quotation->issue_date = date('Y-m-d H:i:s');
        $quotation->itemData = $items;

        $quotation->totalTaxPrice = 60;
        $quotation->totalQuantity = 3;
        $quotation->totalRate = 300;
        $quotation->totalDiscount = 10;
        $quotation->taxesData = $taxesData;
        $quotation->created_by = $objUser->creatorId();

        $preview = 1;
        $color = '#' . $color;
        $font_color = Utility::getFontColor($color);

        $logo = asset(Storage::url('uploads/logo/'));

        $company_logo = Utility::getValByName('company_logo_dark');
        $settings_data = \App\Models\Utility::settingsById($quotation->created_by);
        $quotation_logo = isset($settings_data['quotation_logo']) ? $settings_data['quotation_logo'] : '';

        if (isset($quotation_logo) && !empty($quotation_logo)) {
            $img = Utility::get_file('quotation_logo/') . $quotation_logo;
        } else {
            $img = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png'));
        }

        return view('quotation.templates.' . $template, compact('quotation', 'preview', 'color', 'img', 'settings', 'customer', 'font_color', 'quotationPayment'));
    }

    public function saveQuotationTemplateSettings(Request $request)
    {

        $post = $request->all();
        unset($post['_token']);

        if (isset($post['quotation_template']) && (!isset($post['quotation_color']) || empty($post['quotation_color']))) {
            $post['quotation_color'] = "ffffff";
        }

        if ($request->quotation_logo) {
            $dir = 'quotation_logo/';
            $quotation_logo = \Auth::user()->id . '_quotation_logo.png';
            $validation = [
                'mimes:' . 'png',
                'max:' . '20480',
            ];
            $path = Utility::upload_file($request, 'quotation_logo', $quotation_logo, $dir, $validation);
            if ($path['flag'] == 0) {
                return redirect()->back()->with('error', __($path['msg']));
            }
            $post['quotation_logo'] = $quotation_logo;
        }

        foreach ($post as $key => $data) {
            \DB::insert(
                'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                    $data,
                    $key,
                    \Auth::user()->creatorId(),
                ]
            );
        }

        return redirect()->back()->with('success', __('Quotation Setting updated successfully'));
    }

    public function printView(Request $request)
    {

        $sess = session()->get('pos');

        $user = Auth::user();
        $settings = Utility::settings();

        $customer = Customer::where('name', '=', $request->vc_name)->where('created_by', $user->creatorId())->first();
        $warehouse = warehouse::where('id', '=', $request->warehouse_name)->where('created_by', $user->creatorId())->first();

        $details = [
            'pos_id' => $user->quotationNumberFormat($this->quotationNumber()),
            'customer' => $customer != null ? $customer->toArray() : [],
            'warehouse' => $warehouse != null ? $warehouse->toArray() : [],
            'user' => $user != null ? $user->toArray() : [],
            'date' => date('Y-m-d'),
            'pay' => 'show',
        ];

        if (!empty($details['customer'])) {
            $warehousedetails = '<h7 class="text-dark">' . ucfirst($details['warehouse']['name']) . '</p></h7>';
            $details['customer']['billing_state'] = $details['customer']['billing_state'] != '' ? ", " . $details['customer']['billing_state'] : '';
            $details['customer']['shipping_state'] = $details['customer']['shipping_state'] != '' ? ", " . $details['customer']['shipping_state'] : '';
            $customerdetails = '<h6 class="text-dark">' . ucfirst($details['customer']['name']) . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['billing_phone'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['billing_address'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['billing_city'] . $details['customer']['billing_state'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['billing_country'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['billing_zip'] . '</p></h6>';
            $shippdetails = '<h6 class="text-dark"><b>' . ucfirst($details['customer']['name']) . '</b>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['shipping_phone'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['shipping_address'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['shipping_city'] . $details['customer']['shipping_state'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['shipping_country'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $details['customer']['shipping_zip'] . '</p></h6>';

        } else {
            $customerdetails = '<h2 class="h6"><b>' . __('Walk-in Customer') . '</b><h2>';
            $warehousedetails = '<h7 class="text-dark">' . ucfirst($details['warehouse']['name']) . '</p></h7>';
            $shippdetails = '-';

        }

        $settings['company_telephone'] = $settings['company_telephone'] != '' ? ", " . $settings['company_telephone'] : '';
        $settings['company_state'] = $settings['company_state'] != '' ? ", " . $settings['company_state'] : '';

        $userdetails = '<h6 class="text-dark"><b>' . ucfirst($details['user']['name']) . ' </b> <h2  class="font-weight-normal">' . '<p class="m-0 font-weight-normal">' . $settings['company_name'] . $settings['company_telephone'] . '</p>' . '<p class="m-0 font-weight-normal">' . $settings['company_address'] . '</p>' . '<p class="m-0 h6 font-weight-normal">' . $settings['company_city'] . $settings['company_state'] . '</p>' . '<p class="m-0 font-weight-normal">' . $settings['company_country'] . '</p>' . '<p class="m-0 font-weight-normal">' . $settings['company_zipcode'] . '</p></h2>';

        $details['customer']['details'] = $customerdetails;
        $details['warehouse']['details'] = $warehousedetails;
            //
        $details['customer']['shippdetails'] = $shippdetails;

        $details['user']['details'] = $userdetails;

        $mainsubtotal = 0;
        $sales = [];

        foreach ($sess as $key => $value) {

            $subtotal = $value['price'] * $value['quantity'];
            $tax = ($subtotal * $value['tax']) / 100;
            $sales['data'][$key]['name'] = $value['name'];
            $sales['data'][$key]['quantity'] = $value['quantity'];
            $sales['data'][$key]['price'] = Auth::user()->priceFormat($value['price']);
            $sales['data'][$key]['tax'] = $value['tax'] . '%';
            $sales['data'][$key]['product_tax'] = $value['product_tax'];
            $sales['data'][$key]['tax_amount'] = Auth::user()->priceFormat($tax);
            $sales['data'][$key]['subtotal'] = Auth::user()->priceFormat($value['subtotal']);
            $mainsubtotal += $value['subtotal'];
        }

        $discount = !empty($request->discount) ? $request->discount : 0;
        $sales['discount'] = Auth::user()->priceFormat($discount);
        $total = $mainsubtotal - $discount;
        $sales['sub_total'] = Auth::user()->priceFormat($mainsubtotal);
        $sales['total'] = Auth::user()->priceFormat($total);

        //for barcode

        $productServices = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get();
        $barcode = [
            'barcodeType' => Auth::user()->barcodeType(),
            'barcodeFormat' => Auth::user()->barcodeFormat(),
        ];

        return view('quotation.printview', compact('details', 'sales', 'customer', 'productServices', 'barcode'));

    }

    public function quotation($quotation_Id)
    {
        $settings = Utility::settings();
        $quotationId = Crypt::decrypt($quotation_Id);
        $quotation = Quotation::where('id', $quotationId)->first();

        $qData = QuotationProduct::where('quotation_id',$quotation->id)->first();
        $mData = QuotationProduct::where('quotation_id',$quotation->id)->get();
        $quotat = Quotation::find($quotationId);
        $iteams = $quotat->items; 
        $product = ProductService::find($qData->product_id);  
        $data = \DB::table('settings');
        $data = $data->where('created_by', '=', $quotation->created_by);
        $data1 = $data->get();

        foreach ($data1 as $row) {
            $settings[$row->name] = $row->value;
        }

        $customer = $quotation->customer;

        $totalTaxPrice = 0;
        $totalQuantity = 0;
        $totalRate = 0;
        $totalDiscount = 0;
        $taxesData = [];
        $items = [];
       
        foreach ($quotation->items as $product) {
            //  dd($product);
            $item = new \stdClass();
            $item->name = !empty($product->product()) ? $product->product()->name : '';
            $item->quantity = $product->quantity;
            $item->tax = $product->tax;
            $item->discount = $product->discount;
            $item->price = $product->price;
            $item->quote_id = $product->id;
            $item->Enclosure = $product->Enclosure;
            $item->group_material_2 = $product->group_material_2;
            $item->group_material_3 = $product->group_material_3;
            $item->group_material_5 = $product->group_material_5;
            $item->group_material_4 = $product->group_material_4;
            $item->group_material_7 = $product->group_material_7;
            $item->group_material_8 = $product->group_material_8;
            $item->application = $product->application;
            $item->application_text = $product->application_text;
            $item->hsn_code =  $product->hsn_code != ''? $product->hsn_code: ''; 
            $item->q_model = $product->model;
             $item->new_model = $product->model_new;
            $item->p_model = \App\Models\ProductModel::find($product->product()->product_model_id)->name; 
            $item->group_ids = $product->group_id; 
            $item->product_model_id = $product->product_model_id; 
            $item->currency = $product->currency; 
            $item->gland_id = $product->gland;
            $item->gland = $product->gland != ''?Specification::find($product->gland)->name:'';
            $item->integral = $product->integral;
            $namedevice = $product->fd_cd == 'cd'?'CD':'FD';
            $item->fd_cd = $product->fd_cd != ''?'Device Type: '.$namedevice:'';
            $item->length = $product->length;
            $item->n_model = $product->model_new;
            $item->description = $product->description;
            $item->id = !empty($product->product()) ? $product->product()->id : '';
            $item->image = !empty($product->product()) ? $product->product()->pro_image : 'default.png';
            $item->sku = !empty($product->product()) ? $product->product()->sku : ''; 
            $totalQuantity += $item->quantity;
            $totalRate += $item->price;
            $totalDiscount += $item->discount;
            $taxes = Utility::tax($product->tax);
            $itemTaxes = [];
            // if (!empty($item->tax)) {
            //     foreach ($taxes as $tax) {
            //         $taxPrice = Utility::taxRate($tax->rate, $item->price, $item->quantity);
            //         $totalTaxPrice += $taxPrice;

            //         $itemTax['name'] = $tax->name;
            //         $itemTax['rate'] = $tax->rate . '%';
            //         $itemTax['price'] = Utility::priceFormat($settings, $taxPrice);
            //         $itemTaxes[] = $itemTax;

            //         if (array_key_exists($tax->name, $taxesData)) {
            //             $taxesData[$tax->name] = $taxesData[$tax->name] + $taxPrice;
            //         } else {
            //             $taxesData[$tax->name] = $taxPrice;
            //         }

            //     }

            //     $item->itemTax = $itemTaxes;
            // } else {
                $item->itemTax = [];
            // }
            $items[] = $item;
        }
//   dd($items);
        $quotation->itemData = $items;
        $quotation->totalTaxPrice = $totalTaxPrice;
        $quotation->totalQuantity = $totalQuantity;
        $quotation->totalRate = $totalRate;
        $quotation->totalDiscount = $totalDiscount;
        $quotation->taxesData = $taxesData;

        $logo = asset(Storage::url('uploads/logo/'));
        $company_logo = Utility::getValByName('company_logo_dark');
        $quotation_logo = Utility::getValByName('quotation_logo');
        if (isset($quotation_logo) && !empty($quotation_logo)) {
            $img = Utility::get_file('quotation_logo/') . $quotation_logo;
        } else {
            $img = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png'));
        }
         $barcode = [
                'barcodeType' => Auth::user()->barcodeType(),
                'barcodeFormat' => Auth::user()->barcodeFormat(),
            ];
//  dd($quotation->itemData);
        // $preview = 1;
        if ($quotation) {
            $color = '#' . $settings['quotation_color'];
            $font_color = Utility::getFontColor($color);
 
            return view('quotation.templates.' . $settings['quotation_template'], compact('quotation', 'color', 'settings', 'customer', 'img', 'iteams','font_color','barcode', 'qData', 'mData', 'product'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }
    
     public function quotationPdf($quotation_Id)
    {
        $settings = Utility::settings();
        $quotationId = Crypt::decrypt($quotation_Id);
        $quotation = Quotation::where('id', $quotationId)->first();

        $qData = QuotationProduct::where('quotation_id',$quotation->id)->first();
        $mData = QuotationProduct::where('quotation_id',$quotation->id)->get();
        $quotat = Quotation::find($quotationId);
        $iteams = $quotat->items; 
        $product = ProductService::find($qData->product_id);  
        $data = \DB::table('settings');
        $data = $data->where('created_by', '=', $quotation->created_by);
        $data1 = $data->get();

        foreach ($data1 as $row) {
            $settings[$row->name] = $row->value;
        }

        $customer = $quotation->customer;

        $totalTaxPrice = 0;
        $totalQuantity = 0;
        $totalRate = 0;
        $totalDiscount = 0;
        $taxesData = [];
        $items = [];
       
        foreach ($quotation->items as $product) {
            // dd($product);
            $item = new \stdClass();
            $item->name = !empty($product->product()) ? $product->product()->name : '';
            $item->quantity = $product->quantity;
            $item->tax = $product->tax;
            $item->discount = $product->discount;
            $item->price = $product->price;
            $item->quote_id = $product->id;
            $item->group_material_2 = $product->group_material_2;
            $item->group_material_3 = $product->group_material_3;
            $item->group_material_5 = $product->group_material_5;
            $item->group_material_4 = $product->group_material_4;
            $item->group_material_7 = $product->group_material_7;
            $item->group_material_8 = $product->group_material_8;
            $item->application = $product->application;
            $item->application_text = $product->application_text;
            $item->hsn_code =  $product->hsn_code != ''? $product->hsn_code: ''; 
            $item->q_model = $product->model;
             $item->new_model = $product->model_new;
            $item->p_model = \App\Models\ProductModel::find($product->product()->product_model_id)->name; 
            $item->group_ids = $product->group_id; 
            $item->product_model_id = $product->product_model_id; 
            $item->currency = $product->currency; 
            $item->gland = $product->gland != ''?Specification::find($product->gland)->name:'';
            $item->integral = $product->integral;
            $namedevice = $product->fd_cd == 'cd'?'CD':'FD';
            $item->fd_cd = $product->fd_cd != ''?'Device Type: '.$namedevice:'';
            $item->length = $product->length;
            $item->n_model = $product->model_new;
            $item->description = $product->description;
            $item->id = !empty($product->product()) ? $product->product()->id : '';
            $item->image = !empty($product->product()) ? $product->product()->pro_image : 'default.png';
            $item->sku = !empty($product->product()) ? $product->product()->sku : ''; 
            $totalQuantity += $item->quantity;
            $totalRate += $item->price;
            $totalDiscount += $item->discount;
            $taxes = Utility::tax($product->tax);
            $itemTaxes = [];
           
                $item->itemTax = [];
           
            $items[] = $item;
        }

        $quotation->itemData = $items;
        $quotation->totalTaxPrice = $totalTaxPrice;
        $quotation->totalQuantity = $totalQuantity;
        $quotation->totalRate = $totalRate;
        $quotation->totalDiscount = $totalDiscount;
        $quotation->taxesData = $taxesData;

        $logo = asset(Storage::url('uploads/logo/'));
        $company_logo = Utility::getValByName('company_logo_dark');
        $quotation_logo = Utility::getValByName('quotation_logo');
        if (isset($quotation_logo) && !empty($quotation_logo)) {
            $img = Utility::get_file('quotation_logo/') . $quotation_logo;
        } else {
            $img = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png'));
        }
       
        if ($quotation) {
            $color = '#' . $settings['quotation_color'];
            $font_color = Utility::getFontColor($color);
 
            return view('quotation.templates.' . $settings['quotation_template'], compact('quotation', 'color', 'settings', 'customer', 'img', 'iteams','font_color', 'qData', 'mData', 'product'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }
    
     public function jobcard($quotation_Id)
    {
        $settings = Utility::settings();
        $quotationId = Crypt::decrypt($quotation_Id);
        $quotation = Quotation::where('id', $quotationId)->first();


        $data = \DB::table('settings');
        $data = $data->where('created_by', '=', $quotation->created_by);
        $data1 = $data->get();

        foreach ($data1 as $row) {
            $settings[$row->name] = $row->value;
        }

        $customer = $quotation->customer;

        $totalTaxPrice = 0;
        $totalQuantity = 0;
        $totalRate = 0;
        $totalDiscount = 0;
        $taxesData = [];
        $items = [];
       
        foreach ($quotation->items as $product) {
           
            $item = new \stdClass();
            $item->name = !empty($product->product()) ? $product->product()->name : '';
            $item->quantity = $product->quantity;
            $item->tax = $product->tax;
            $item->discount = $product->discount;
            $item->price = $product->price;
            $item->h_code = $product->hsn_code;
            $item->quote_id = $product->id;
            $item->application = $product->application;
            $item->group_material_2 = $product->group_material_2;
            $item->group_material_3 = $product->group_material_3;
            $item->group_material_5 = $product->group_material_5;
            $item->group_material_4 = $product->group_material_4;
            $item->group_material_7 = $product->group_material_7;
            $item->group_material_8 = $product->group_material_8;
            $item->hsn_code = !empty($product->product()) ? $product->product()->hsn_code : ''; 
            $item->q_model = $product->model; 
             $item->new_model = $product->model_new;
            $item->p_model = \App\Models\ProductModel::find($product->product()->product_model_id)->name; 
            $item->group_ids = $product->group_id;
            $item->product_model_id = !empty($product->product()) ? $product->product()->product_model_id : ''; ;
            $item->description = $product->description;
            $item->id = !empty($product->product()) ? $product->product()->id : '';
            $item->sku = !empty($product->product()) ? $product->product()->sku : ''; 
            $item->gland = $product->gland != ''?Specification::find($product->gland)->name:'';
            $item->integral = $product->integral == 'int'?'Standard Integral Type: '.$product->integral:(($product->integral == 'rmt1')?'One Enclosure with special sensor cable':(($product->integral == 'rmt2')?'Remote type LFV requires two enclosure with special interconnection cable':''));
            $item->fd_cd = $product->fd_cd != ''?'Device Type: '.$product->fd_cd:'';
            $item->length = $product->length;
            $item->n_model = $product->model_new;
            $totalQuantity += $item->quantity;
            $totalRate += $item->price;
            $totalDiscount += $item->discount;
            $taxes = Utility::tax($product->tax);
            $itemTaxes = [];
            // if (!empty($item->tax)) {
            //     foreach ($taxes as $tax) {
            //         $taxPrice = Utility::taxRate($tax->rate, $item->price, $item->quantity);
            //         $totalTaxPrice += $taxPrice;

            //         $itemTax['name'] = $tax->name;
            //         $itemTax['rate'] = $tax->rate . '%';
            //         $itemTax['price'] = Utility::priceFormat($settings, $taxPrice);
            //         $itemTaxes[] = $itemTax;

            //         if (array_key_exists($tax->name, $taxesData)) {
            //             $taxesData[$tax->name] = $taxesData[$tax->name] + $taxPrice;
            //         } else {
            //             $taxesData[$tax->name] = $taxPrice;
            //         }

            //     }

            //     $item->itemTax = $itemTaxes;
            // } else {
                $item->itemTax = [];
            // }
            $items[] = $item;
        }

        $quotation->itemData = $items;
        $quotation->totalTaxPrice = $totalTaxPrice;
        $quotation->totalQuantity = $totalQuantity;
        $quotation->totalRate = $totalRate;
        $quotation->totalDiscount = $totalDiscount;
        $quotation->taxesData = $taxesData;

        $logo = asset(Storage::url('uploads/logo/'));
        $company_logo = Utility::getValByName('company_logo_dark');
        $quotation_logo = Utility::getValByName('quotation_logo');
        if (isset($quotation_logo) && !empty($quotation_logo)) {
            $img = Utility::get_file('quotation_logo/') . $quotation_logo;
        } else {
            $img = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png'));
        }
         $barcode = [
                'barcodeType' => Auth::user()->barcodeType(),
                'barcodeFormat' => Auth::user()->barcodeFormat(),
            ];
            // dd($settings['quotation_template']);
        if ($quotation) {
            $color = '#' . $settings['quotation_color'];
            $font_color = Utility::getFontColor($color);
            $settings['quotation_template'] = 'template11';
            return view('quotation.templates.' . $settings['quotation_template'], compact('quotation', 'color', 'settings', 'customer', 'img', 'font_color','barcode'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }
    
     public function jobcardPdf($quotation_Id)
    {
        $settings = Utility::settings();
        // $quotationId = Crypt::decrypt($quotation_Id);
        $quotation = Quotation::where('id', $quotation_Id)->first();


        $data = \DB::table('settings');
        $data = $data->where('created_by', '=', $quotation->created_by);
        $data1 = $data->get();

        foreach ($data1 as $row) {
            $settings[$row->name] = $row->value;
        }

        $customer = $quotation->customer;

        $totalTaxPrice = 0;
        $totalQuantity = 0;
        $totalRate = 0;
        $totalDiscount = 0;
        $taxesData = [];
        $items = [];
       
        foreach ($quotation->items as $product) {
           
            $item = new \stdClass();
            $item->name = !empty($product->product()) ? $product->product()->name : '';
            $item->quantity = $product->quantity;
            $item->tax = $product->tax;
            $item->discount = $product->discount;
            $item->price = $product->price;
            $item->h_code = $product->hsn_code;
            $item->quote_id = $product->id;
            $item->application = $product->application;
            $item->group_material_2 = $product->group_material_2;
            $item->group_material_3 = $product->group_material_3;
            $item->group_material_5 = $product->group_material_5;
            $item->group_material_4 = $product->group_material_4;
            $item->group_material_7 = $product->group_material_7;
            $item->group_material_8 = $product->group_material_8;
            $item->hsn_code = !empty($product->product()) ? $product->product()->hsn_code : ''; 
            $item->q_model = $product->model; 
            $item->p_model = \App\Models\ProductModel::find($product->product()->product_model_id)->name; 
            $item->group_ids = $product->group_id;
            $item->product_model_id = !empty($product->product()) ? $product->product()->product_model_id : ''; ;
            $item->description = $product->description;
            $item->id = !empty($product->product()) ? $product->product()->id : '';
            $item->sku = !empty($product->product()) ? $product->product()->sku : ''; 
            $item->gland = $product->gland != ''?Specification::find($product->gland)->name:'';
            $item->integral = $product->integral == 'int'?'Standard Integral Type: '.$product->integral:(($product->integral == 'rmt1')?'One Enclosure with special sensor cable':(($product->integral == 'rmt2')?'Remote type LFV requires two enclosure with special interconnection cable':''));
            $item->fd_cd = $product->fd_cd != ''?'Device Type: '.$product->fd_cd:'';
            $item->length = $product->length;
            $item->n_model = $product->model_new;
            $totalQuantity += $item->quantity;
            $totalRate += $item->price;
            $totalDiscount += $item->discount;
            $taxes = Utility::tax($product->tax);
            $itemTaxes = [];
            // if (!empty($item->tax)) {
            //     foreach ($taxes as $tax) {
            //         $taxPrice = Utility::taxRate($tax->rate, $item->price, $item->quantity);
            //         $totalTaxPrice += $taxPrice;

            //         $itemTax['name'] = $tax->name;
            //         $itemTax['rate'] = $tax->rate . '%';
            //         $itemTax['price'] = Utility::priceFormat($settings, $taxPrice);
            //         $itemTaxes[] = $itemTax;

            //         if (array_key_exists($tax->name, $taxesData)) {
            //             $taxesData[$tax->name] = $taxesData[$tax->name] + $taxPrice;
            //         } else {
            //             $taxesData[$tax->name] = $taxPrice;
            //         }

            //     }

            //     $item->itemTax = $itemTaxes;
            // } else {
                $item->itemTax = [];
            // }
            $items[] = $item;
        }

        $quotation->itemData = $items;
        $quotation->totalTaxPrice = $totalTaxPrice;
        $quotation->totalQuantity = $totalQuantity;
        $quotation->totalRate = $totalRate;
        $quotation->totalDiscount = $totalDiscount;
        $quotation->taxesData = $taxesData;

        $logo = asset(Storage::url('uploads/logo/'));
        $company_logo = Utility::getValByName('company_logo_dark');
        $quotation_logo = Utility::getValByName('quotation_logo');
        if (isset($quotation_logo) && !empty($quotation_logo)) {
            $img = Utility::get_file('quotation_logo/') . $quotation_logo;
        } else {
            $img = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png'));
        }
        //  $barcode = [
        //         'barcodeType' => Auth::user()->barcodeType(),
        //         'barcodeFormat' => Auth::user()->barcodeFormat(),
        //     ];
            // dd($settings['quotation_template']);
        if ($quotation) {
            $color = '#' . $settings['quotation_color'];
            $font_color = Utility::getFontColor($color);
            $settings['quotation_template'] = 'template12';
            return view('quotation.templates.' . $settings['quotation_template'], compact('quotation', 'color', 'settings', 'customer', 'img', 'font_color'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }
    
     //searching start
    
     public function search(Request $request)
    {
    //  dd($request->all());
         $date = $request->date == 'Date'?'':$request->date;
         $usr = \Auth::user();
         $leads = '';    
        
            
            
                
                
             if ($request->status_id != '' && $request->products != '' && $date != '' && $request->user_id != '') {
                    
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $quotations     = Quotation::select('quotations.*')
                        ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                       
                        ->where('quotations.status', '=', $request->status_id)
                        ->whereDate('quotations.quotation_date', '=',$parsedDate)
                        ->where('quotations.created_by', '=', $request->user_id)
                        ->orderBy('quotations.id')
                        ->get();
                //   dd($quotations);
                }
                 elseif ($request->statis_id != '' && $date != '' && $request->user_id != '') {
                  
                       
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $quotations     = Quotation::select('quotations.*')
                        ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                       
                        ->where('quotations.status', '=', $request->status_id)
                        ->whereDate('quotations.quotation_date', '=',$parsedDate)
                        ->where('quotations.created_by', '=', $request->user_id)
                        ->orderBy('quotations.id')
                        ->get();
                  
                }
                 elseif ($request->status_id != '' && $date != '') {
                        // echo "sdfds";die;
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                       
                       
                        $quotations     = Quotation::select('quotations.*')
                        ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                       
                        ->where('quotations.status', '=', $request->status_id)
                        ->whereDate('quotations.quotation_date', '=',$parsedDate)
                       
                        ->orderBy('quotations.id')
                        ->get();
                  
                }
                elseif ($request->user_id != '') {
                        $quotations     = Quotation::select('quotations.*')
                        ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                        ->where('quotations.created_by', '=', $request->user_id)
                        ->orderBy('quotations.id')
                        ->get();
                    
                }
                elseif ($date != '') {
                    
                       
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $quotations     = Quotation::select('quotations.*')
                        ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                        ->where('quotations.quotation_date', '=', $parsedDate)
                        // ->orderBy('quotations.id')
                        ->groupBy('quotations.id')
                        ->get();
                        // dd($quotations);
                    
                }elseif ($request->products != '') {
                   
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $quotations     = Quotation::select('quotations.*')
                        ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                         ->where('quotation_products.product_id', '=', $request->products)
                        ->orderBy('quotations.id')
                        // ->groupBy('quotation_products.quotation_id')
                        ->get();
                //   dd($request->products);
                }
                elseif ($request->status_id != '') {
                      
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $quotations     = Quotation::select('quotations.*')
                        ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                       
                        ->where('quotations.status', '=', $request->status_id)
                       
                        ->orderBy('quotations.id')
                       
                        // ->groupBy('quotation_products.quotation_id')
                        ->get();
                //   dd($quotations);
                }
                else {
            
                    $quotations      = Quotation::where('created_by', \Auth::user()->creatorId())->with(['customer','warehouse', 'items'])->orderBy('id', 'desc')->get();
                    // dd($quotations);
                     $customers     = Customer::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                    $customers->prepend('Select Customer', '');
        
                    $warehouse     = warehouse::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                    $warehouse->prepend('Select Warehouse', '');
        
                    // $product_services = ['--'];
        
                    $quotation_number = \Auth::user()->quotationNumberFormat($this->quotationNumber());
                    $product_services       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                    $customer       = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->where('type', '!=', 'company')->where('id', '!=', \Auth::user()->id)->get()->pluck('name', 'id');
                  
                    $date = now();

                }
            $chkdate = $request->date != 'Date'?Carbon::parse($date)->format('Y-m-d'):'Date';
            $chkstatus = $request->status_id != ''?$request->status_id:'';
            $products = $request->products;
            $user_id = $request->user_id;
            $users = User::where('type', '=', 'company')->get()->pluck('name', 'id');
            $users->prepend(__('Created by'), '');
            $products       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $products->prepend(__('Product'), '');
            
          
            return view('quotation.index',compact('quotations','users', 'products', 'chkdate', 'chkstatus', 'products', 'user_id'));
        
    }
    
    //searching end
    
    function customerNumber()
    {
        $latest = Customer::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->customer_id + 1;
    }
    function storeBarcode(Request $request)
    {
        $quote = Quotation::find($request->id);
        $quote->barcode = $request->imagebase64;
        $quote->save();
        return response()->json(['status' => true, 'msg' => 'barcode stored', 'data' => $quote]);
      
    }
}

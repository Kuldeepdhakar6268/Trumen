<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Imports\CustomerImport;
use App\Models\Customer;
use App\Models\Quotation;
use App\Models\CustomField;
use App\Models\Transaction;
use App\Models\Utility;
use Auth;
use App\Models\User;
use App\Models\ProductService;
use App\Models\Plan;
use App\Models\Lead;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{

    public function dashboard()
    {
        $data['invoiceChartData'] = \Auth::user()->invoiceChartData();

        return view('customer.dashboard', $data);
    }

    public function index()
    {
        if(\Auth::user()->can('manage customer'))
        {
            $customers = Customer::with('leads')->where('created_by', \Auth::user()->creatorId())->where('is_customer', '!=', '')->paginate(10);
            $users = User::where('type', '=', 'company')->get()->pluck('name', 'id');
            $users->prepend(__('Converted by'), '');
            $products       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $products->prepend(__('Product'), '');
            $industry = DB::table('leads')->where('industry_name', '!=', '')->select('industry_name as name', 'id')->get()->pluck('name','id');
            //  dd($industry);
            $industry->prepend(__('Industry'), '');
           
            $states = DB::table('states')->where('country_id', 101)->get()->pluck('name','id');
            $states->prepend(__('State'), '');
           
            return view('customer.index', compact('customers', 'users', 'products', 'industry', 'states'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
     public function getCity(Request $request)
    {
       
         $city = DB::table('cities')->where('state_id', $request->state_id)->get();
        
        return response()->json(['status' => __('City list retrived.'), 'data' => $city], 200);
    }
    public function search(Request $request)
    {
        // dd($request->all());
        if(\Auth::user()->can('manage customer'))
        {
            
         $date = $request->date == 'Date'?'':$request->date;
         $usr = \Auth::user();
         $leads = '';    
        
             if ($request->user_id != '' && $date != '') {
                    
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $customers =  Customer::where(['created_by', $request->user_id])->whereDate('created_at', '=',$parsedDate)->get();
                       
                        
                //   dd($quotations);
                }
                 elseif ($request->user_id != '') {
                   
                       
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $customers =  Customer::where('created_by', '=', $request->user_id)->paginate(10);
                  
                }
                 elseif ($date != '') {
                    
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $customers =  Customer::whereDate('created_at', '=',$parsedDate)->paginate(10);
                  
                }
                 elseif ($request->industry_id != '') {
                    
                        $parsedDate = Carbon::parse($date)->format('Y-m-d');
                        $customers =  Customer::where('lead_id', '=', $request->industry_id)->paginate(10);
                  
                }
                // elseif ($request->user_id != '') {
                //         $quotations     = Quotation::select('quotations.*')
                //         ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                //         ->where('quotations.created_by', '=', $request->user_id)
                //         ->orderBy('quotations.id')
                //         ->get();
                    
                // }
                // elseif ($date != '') {
                    
                       
                //         $parsedDate = Carbon::parse($date)->format('Y-m-d');
                //         $quotations     = Quotation::select('quotations.*')
                //         ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                //         ->where('quotations.quotation_date', '=', $parsedDate)
                //         // ->orderBy('quotations.id')
                //         ->groupBy('quotations.id')
                //         ->get();
                //         // dd($quotations);
                    
                // }elseif ($request->products != '') {
                   
                //         $parsedDate = Carbon::parse($date)->format('Y-m-d');
                //         $quotations     = Quotation::select('quotations.*')
                //         ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                //          ->where('quotation_products.product_id', '=', $request->products)
                //         ->orderBy('quotations.id')
                //         // ->groupBy('quotation_products.quotation_id')
                //         ->get();
                // //   dd($request->products);
                // }
                // elseif ($request->status_id != '') {
                      
                //         $parsedDate = Carbon::parse($date)->format('Y-m-d');
                //         $quotations     = Quotation::select('quotations.*')
                //         ->join('quotation_products', 'quotation_products.quotation_id', '=', 'quotations.id')
                       
                //         ->where('quotations.status', '=', $request->status_id)
                       
                //         ->orderBy('quotations.id')
                       
                //         // ->groupBy('quotation_products.quotation_id')
                //         ->get();
                // //   dd($quotations);
                // }
                else {
            
                     $customers = Customer::where('created_by', \Auth::user()->creatorId())->paginate(10);

                }
            
            
            
           
            $users = User::where('type', '=', 'company')->get()->pluck('name', 'id');
            $users->prepend(__('Created by'), '');
            $products       = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $products->prepend(__('Product'), '');
           
            $states = DB::table('states')->where('country_id', 101)->get()->pluck('name','id');
            $states->prepend(__('State'), '');
            $industry = DB::table('leads')->where('industry_name', '!=', '')->select('industry_name as name', 'id')->get()->pluck('name','id');
            $industry->prepend(__('Industry'), '');
           
            $industry_id =$request->industry_id; 
            return view('customer.index', compact('customers', 'users', 'products', 'states','industry', 'industry_id'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('create customer'))
        {
            $customFields = CustomField::where('created_by', '=', \Auth::user()->creatorId())->where('module', '=', 'customer')->get();

            return view('customer.create', compact('customFields'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function store(Request $request)
    {
        if(\Auth::user()->can('create customer'))
        {

            $rules = [
                'name' => 'required',
                'contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'email' => [
                    'required',
                    Rule::unique('customers')->where(function ($query) {
                        return $query->where('created_by', \Auth::user()->id);
                    })
                ],
            ];


            $validator = \Validator::make($request->all(), $rules);

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
                return redirect()->route('customer.index')->with('error', $messages->first());
            }

            $objCustomer    = \Auth::user();
            $creator        = User::find($objCustomer->creatorId());
            $total_customer = $objCustomer->countCustomers();
            $plan           = Plan::find($creator->plan);

            $default_language          = DB::table('settings')->select('value')->where('name', 'default_language')->first();
            if($total_customer < $plan->max_customers || $plan->max_customers == -1)
            {
                $customer                  = new Customer();
                $customer->customer_id     = $this->customerNumber();
                $customer->name            = $request->name;
                $customer->contact         = $request->contact;
                $customer->email           = $request->email;
                $customer->tax_number      =$request->tax_number;
                $customer->status      ='Pending';
                $customer->created_by      = \Auth::user()->creatorId();
                $customer->billing_name    = $request->billing_name;
                $customer->billing_country = $request->billing_country;
                $customer->billing_state   = $request->billing_state;
                $customer->billing_city    = $request->billing_city;
                $customer->billing_phone   = $request->billing_phone;
                $customer->billing_zip     = $request->billing_zip;
                $customer->billing_address = $request->billing_address;

                $customer->shipping_name    = $request->shipping_name;
                $customer->shipping_country = $request->shipping_country;
                $customer->shipping_state   = $request->shipping_state;
                $customer->shipping_city    = $request->shipping_city;
                $customer->shipping_phone   = $request->shipping_phone;
                $customer->shipping_zip     = $request->shipping_zip;
                $customer->shipping_address = $request->shipping_address;

                $customer->lang = !empty($default_language) ? $default_language->value : '';

                $customer->save();
                CustomField::saveData($customer, $request->customField);
            }
            else
            {
                return redirect()->back()->with('error', __('Your user limit is over, Please upgrade plan.'));
            }

            //For Notification
            $setting  = Utility::settings(\Auth::user()->creatorId());
            $customerNotificationArr = [
                'user_name' => \Auth::user()->name,
                'customer_name' => $customer->name,
                'customer_email' => $customer->email,
            ];

            //Twilio Notification
            if(isset($setting['twilio_customer_notification']) && $setting['twilio_customer_notification'] ==1)
            {
                Utility::send_twilio_msg($request->contact,'new_customer', $customerNotificationArr);
            }


            return redirect()->route('customer.index')->with('success', __('Customer successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    
     public function getDetails(Request $request)
        {
       
        // $id       = \Crypt::decrypt($ids);
        $customer = Customer::where('lead_id', $request->id)->first();
         $data = [];
         $data['lead'] =$customer->leads;
         $data['customer'] =$customer; 
        //   dd($data['lead']);
         return Response($data);
        // return view('customer.show', compact('customer', 'quotations', 'jobcard', 'orders'));
    }
    public function show($ids)
    {
        try {
            $id       = Crypt::decrypt($ids);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Customer Not Found.'));
        }
        $id       = \Crypt::decrypt($ids);
        $customer = Customer::find($id);
        //  dd($customer);
        $quotations      = Quotation::where(['customer_id' => $customer->id])->get();
        $qList      = Quotation::where(['customer_id' => $customer->id])->get()->pluck('id', 'id');
        $qList->prepend(__('select quote'), '');
        $orders      = Quotation::where(['customer_id' => $customer->id,'is_order' => 1])->get();
        $jobcard      = Quotation::where(['customer_id' => $customer->id, 'is_jobcard' => 1])->get();
//   dd($quotations);

        return view('customer.show', compact('customer', 'quotations', 'jobcard', 'orders', 'qList'));
    }


    public function edit($id)
    {
        if(\Auth::user()->can('edit customer'))
        {
            $customer              = Customer::find($id);
            $customer->customField = CustomField::getData($customer, 'customer');

            $customFields = CustomField::where('created_by', '=', \Auth::user()->creatorId())->where('module', '=', 'customer')->get();

            return view('customer.edit', compact('customer', 'customFields'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

     public function updatePo(Request $request)
    {
    //   dd($request->all());
      
        if($request->customer_id != ''){
           $customer = Customer::findOrFail($request->customer_id); 
           $quotation = Quotation::findOrFail($request->quote_no); 
        }else{
          return redirect()->back()->with('error', 'Select at least one customer'); 
        }
        
         if(!empty($request->document) && !is_null($request->document))
            {
                $document_implode = implode(',', array_keys($request->document));
            }
            else
            {
                $document_implode = null;
            }
         if($request->hasFile('document'))
            {
                foreach($request->document as $key => $document)
                {

                    $filenameWithExt = $request->file('document')[$key]->getClientOriginalName();
                    $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension       = $request->file('document')[$key]->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $dir             = storage_path('uploads/document/');
                    $image_path      = $dir . $filenameWithExt;

                    if(File::exists($image_path))
                    {
                        File::delete($image_path);
                    }

                    if(!file_exists($dir))
                    {
                        mkdir($dir, 0777, true);
                    }
                    $path              = $request->file('document')[$key]->storeAs('uploads/document/', $fileNameToStore);
                   
                   
                    $quotation->document = $fileNameToStore;
                    

                }

            }
            // dd($customer);
        if($quotation){
            $quotation->po_date = $request->po_date;
            $quotation->po_number = $request->po_number;
           
            $quotation->save();
        } 
       

      
            if($quotation == true)
            {
                return redirect()->back()->with('success', __('Customer Deatils has been added!'));
            }
            else
            {
                return redirect()->back()->with('error', __('Webhook call failed.'));
            }
        


        return redirect()->back()->with('success', __('Customer Deatils has been added!'));
    }
    
    public function update(Request $request, Customer $customer)
    {

        if(\Auth::user()->can('edit customer'))
        {

            $rules = [
                'name' => 'required',
                'contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            ];


            $validator = \Validator::make($request->all(), $rules);
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->route('customer.index')->with('error', $messages->first());
            }

            $customer->name             = $request->name;
            $customer->contact          = $request->contact;
            $customer->email           = $request->email;
            $customer->tax_number      =$request->tax_number;
            $customer->created_by       = \Auth::user()->creatorId();
            $customer->billing_name     = $request->billing_name;
            $customer->billing_country  = $request->billing_country;
            $customer->billing_state    = $request->billing_state;
            $customer->billing_city     = $request->billing_city;
            $customer->billing_phone    = $request->billing_phone;
            $customer->billing_zip      = $request->billing_zip;
            $customer->billing_address  = $request->billing_address;
            $customer->shipping_name    = $request->shipping_name;
            $customer->shipping_country = $request->shipping_country;
            $customer->shipping_state   = $request->shipping_state;
            $customer->shipping_city    = $request->shipping_city;
            $customer->shipping_phone   = $request->shipping_phone;
            $customer->shipping_zip     = $request->shipping_zip;
            $customer->shipping_address = $request->shipping_address;
            $customer->status      =$request->status;
            $customer->save();
            // dd($request->all());
            
            $lead = Lead::find($request->lead_id);
            $lead->industry_name      =$request->industry_name;
            $lead->save();    
            CustomField::saveData($customer, $request->customField);

            return redirect()->route('customer.index')->with('success', __('Customer successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function destroy(Customer $customer)
    {
        if(\Auth::user()->can('delete customer'))
        {
            if($customer->created_by == \Auth::user()->creatorId())
            {
                $customer->delete();

                return redirect()->route('customer.index')->with('success', __('Customer successfully deleted.'));
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

    function customerNumber()
    {
        $latest = Customer::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->customer_id + 1;
    }

    public function customerLogout(Request $request)
    {
        \Auth::guard('customer')->logout();

        $request->session()->invalidate();

        return redirect()->route('customer.login');
    }

    public function payment(Request $request)
    {

        if(\Auth::user()->can('manage customer payment'))
        {
            $category = [
                'Invoice' => 'Invoice',
                'Deposit' => 'Deposit',
                'Sales' => 'Sales',
            ];

            $query = Transaction::where('user_id', \Auth::user()->id)->where('user_type', 'Customer')->where('type', 'Payment');
            if(!empty($request->date))
            {
                $date_range = explode(' - ', $request->date);
                $query->whereBetween('date', $date_range);
            }

            if(!empty($request->category))
            {
                $query->where('category', '=', $request->category);
            }
            $payments = $query->get();

            return view('customer.payment', compact('payments', 'category'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function transaction(Request $request)
    {
        if(\Auth::user()->can('manage customer payment'))
        {
            $category = [
                'Invoice' => 'Invoice',
                'Deposit' => 'Deposit',
                'Sales' => 'Sales',
            ];

            $query = Transaction::where('user_id', \Auth::user()->id)->where('user_type', 'Customer');

            if(!empty($request->date))
            {
                $date_range = explode(' - ', $request->date);
                $query->whereBetween('date', $date_range);
            }

            if(!empty($request->category))
            {
                $query->where('category', '=', $request->category);
            }
            $transactions = $query->get();

            return view('customer.transaction', compact('transactions', 'category'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function profile()
    {
        $userDetail              = \Auth::user();
        $userDetail->customField = CustomField::getData($userDetail, 'customer');
        $customFields            = CustomField::where('created_by', '=', \Auth::user()->creatorId())->where('module', '=', 'customer')->get();

        return view('customer.profile', compact('userDetail', 'customFields'));
    }

    public function editprofile(Request $request)
    {
        $userDetail = \Auth::user();
        $user       = Customer::findOrFail($userDetail['id']);

        $this->validate(
            $request, [
                        'name' => 'required|max:120',
                        'contact' => 'required',
                        'email' => 'required|email|unique:users,email,' . $userDetail['id'],
                    ]
        );

        if($request->hasFile('profile'))
        {
            $filenameWithExt = $request->file('profile')->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $request->file('profile')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            $dir        = storage_path('uploads/avatar/');
            $image_path = $dir . $userDetail['avatar'];

            if(File::exists($image_path))
            {
                File::delete($image_path);
            }

            if(!file_exists($dir))
            {
                mkdir($dir, 0777, true);
            }

            $path = $request->file('profile')->storeAs('uploads/avatar/', $fileNameToStore);

        }

        if(!empty($request->profile))
        {
            $user['avatar'] = $fileNameToStore;
        }
        $user['name']    = $request['name'];
        $user['email']   = $request['email'];
        $user['contact'] = $request['contact'];
        $user->save();
        CustomField::saveData($user, $request->customField);

        return redirect()->back()->with(
            'success', 'Profile successfully updated.'
        );
    }

    public function editBilling(Request $request)
    {
        $userDetail = \Auth::user();
        $user       = Customer::findOrFail($userDetail['id']);
        $this->validate(
            $request, [
                        'billing_name' => 'required',
                        'billing_country' => 'required',
                        'billing_state' => 'required',
                        'billing_city' => 'required',
                        'billing_phone' => 'required',
                        'billing_zip' => 'required',
                        'billing_address' => 'required',
                    ]
        );
        $input = $request->all();
        $user->fill($input)->save();

        return redirect()->back()->with(
            'success', 'Profile successfully updated.'
        );
    }

    public function editShipping(Request $request)
    {
        $userDetail = \Auth::user();
        $user       = Customer::findOrFail($userDetail['id']);
        $this->validate(
            $request, [
                        'shipping_name' => 'required',
                        'shipping_country' => 'required',
                        'shipping_state' => 'required',
                        'shipping_city' => 'required',
                        'shipping_phone' => 'required',
                        'shipping_zip' => 'required',
                        'shipping_address' => 'required',
                    ]
        );
        $input = $request->all();
        $user->fill($input)->save();

        return redirect()->back()->with(
            'success', 'Profile successfully updated.'
        );
    }


    public function changeLanquage($lang)
    {

        $user       = Auth::user();
        $user->lang = $lang;
        $user->save();

        return redirect()->back()->with('success', __('Language Change Successfully!'));

    }


    public function export()
    {
        $name = 'customer_' . date('Y-m-d i:h:s');
        $data = Excel::download(new CustomerExport(), $name . '.xlsx'); ob_end_clean();

        return $data;
    }

    public function importFile()
    {
        return view('customer.import');
    }

    public function import(Request $request)
    {

        $rules = [
            'file' => 'required|mimes:csv,txt',
        ];

        $validator = \Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $customers = (new CustomerImport())->toArray(request()->file('file'))[0];

        $totalCustomer = count($customers) - 1;
        $errorArray    = [];
        for($i = 1; $i <= count($customers) - 1; $i++)
        {
            $customer = $customers[$i];

            $customerByEmail = Customer::where('email', $customer[2])->first();
            if(!empty($customerByEmail))
            {
                $customerData = $customerByEmail;
            }
            else
            {
                $customerData = new Customer();
                $customerData->customer_id      = $this->customerNumber();
            }

            $customerData->customer_id             = $customer[0];
            $customerData->name             = $customer[1];
            $customerData->email            = $customer[2];
            $customerData->contact          = $customer[3];
            $customerData->is_active        = 1;
            $customerData->billing_name     = $customer[4];
            $customerData->billing_country  = $customer[5];
            $customerData->billing_state    = $customer[6];
            $customerData->billing_city     = $customer[7];
            $customerData->billing_phone    = $customer[8];
            $customerData->billing_zip      = $customer[9];
            $customerData->billing_address  = $customer[10];
            $customerData->shipping_name    = $customer[11];
            $customerData->shipping_country = $customer[12];
            $customerData->shipping_state   = $customer[13];
            $customerData->shipping_city    = $customer[14];
            $customerData->shipping_phone   = $customer[15];
            $customerData->shipping_zip     = $customer[16];
            $customerData->shipping_address = $customer[17];
            $customerData->balance          = $customer[18];
            $customerData->created_by       = \Auth::user()->creatorId();

            if(empty($customerData))
            {
                $errorArray[] = $customerData;
            }
            else
            {
                $customerData->save();
            }
        }

        $errorRecord = [];
        if(empty($errorArray))
        {
            $data['status'] = 'success';
            $data['msg']    = __('Record successfully imported');
        }
        else
        {
            $data['status'] = 'error';
            $data['msg']    = count($errorArray) . ' ' . __('Record imported fail out of' . ' ' . $totalCustomer . ' ' . 'record');


            foreach($errorArray as $errorData)
            {

                $errorRecord[] = implode(',', $errorData);

            }

            \Session::put('errorArray', $errorRecord);
        }

        return redirect()->back()->with($data['status'], $data['msg']);
    }

    public function searchCustomers(Request $request)
    {
        if (\Illuminate\Support\Facades\Auth::user()->can('manage customer')) {
            $customers = [];
            $search    = $request->search;
            if ($request->ajax() && isset($search) && !empty($search)) {
                $customers = Customer::select('id as value', 'name as label', 'email')->where('is_active', '=', 1)->where('created_by', '=', Auth::user()->getCreatedBy())->Where('name', 'LIKE', '%' . $search . '%')->orWhere('email', 'LIKE', '%' . $search . '%')->get();

                return json_encode($customers);
            }

            return $customers;
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }




}

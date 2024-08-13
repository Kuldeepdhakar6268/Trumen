<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Bill;
use App\Models\CustomField;
use App\Models\ProductService;
use App\Models\ProductServiceCategory;
use App\Models\Purchase;
use App\Models\MaterialStock;
use App\Models\OrderRequest;
use App\Models\PurchaseProduct;
use App\Models\PurchasePayment;
use App\Models\StockReport;
use App\Models\Transaction;
use App\Models\Vender;
use App\Models\User;
use \Carbon\Carbon;
use App\Models\Utility;
use App\Models\WarehouseProduct;
use App\Models\WarehouseTransfer;
use Illuminate\Support\Facades\Crypt;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $vender = Vender::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        // $vender->prepend('Select Vendor', '');
        $orders = OrderRequest::all();
        $emp     = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->where('id', '!=', \Auth::user()->id)->get();
          
            $users = User::where('type', '=', 'company')->get();
           
            $status = DB::table('status')->get()->pluck('name','id');
            $status->prepend(__('Status'), '');
            $date= '';
        // $purchases = Purchase::where('created_by', '=', \Auth::user()->creatorId())->with(['vender','category'])->get();


        return view('orderrequest.index', compact('orders', 'emp', 'users', 'status', 'date'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->can('create purchase'))
        {
           
            $product_services = MaterialStock::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('material_name', 'id');
            $product_services->prepend('--', '');
             $mList = MaterialStock::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('material_name', 'id');
             $mList->prepend('Select Part', '');

            return view('orderrequest.create', compact('mList', 'product_services'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(\Auth::user()->can('create purchase'))
        {
            $validator = \Validator::make(
                $request->all(), [
                   
                    'items.price.*' => 'required',
                    'items.priority.*'     => 'required',
                    'items' => 'required',
                ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
           
            $products = $request->items;

            for($i = 0; $i < count($products); $i++)
            {
                $purchaseProduct              = new OrderRequest();
              
                $purchaseProduct->material_id  = $products[$i]['material_id'];
                $purchaseProduct->qty    = $products[$i]['quantity'];
                $purchaseProduct->price       = $products[$i]['price'];
                $purchaseProduct->note       = $request->note;
                $purchaseProduct->created_by     = \Auth::user()->creatorId();
                $purchaseProduct->priority     = $products[$i]['priority'];
                $purchaseProduct->created_date     = now()->format('Y-m-d');
                $purchaseProduct->order_request_id  = '#'.sprintf("%05d", $this->requestNumber());    
                $purchaseProduct->total = $products[$i]['price']*$products[$i]['quantity'];
                $purchaseProduct->save();
            }

            return redirect()->route('order.index', $purchaseProduct->id)->with('success', __('Order Request successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    function requestNumber()
    {
        $latest = OrderRequest::get();
        // dd(count($latest));
        if(!$latest)
        {
            return 1;
        }

        return count($latest) + 1;
    }
     public function items(Request $request)
    {

        $items = OrderRequest::where('id', $request->purchase_id)->first();

        return json_encode($items);
    }
    public function show($ids)
    {

        if(\Auth::user()->can('show purchase'))
        {
            try {
                $id       = Crypt::decrypt($ids);
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', __('Purchase Not Found.'));
            }

            $id   = Crypt::decrypt($ids);
            $purchase = OrderRequest::find($id);

            if($purchase->created_by == \Auth::user()->creatorId())
            {

                $purchasePayment = PurchasePayment::where('purchase_id', $purchase->id)->get();
                // $vendor      = $purchase->vender;
                $iteams      = $purchase->material;

                return view('orderrequest.view', compact('purchase', 'iteams', 'purchasePayment'));
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

    public function edit($idsd)
    {
        if(\Auth::user()->can('edit purchase'))
        {

            $idwww   = Crypt::decrypt($idsd);
            $purchase     = OrderRequest::find($idwww);
            $category = MaterialStock::where('created_by', \Auth::user()->creatorId())->get()->pluck('material_name', 'id');
            $category->prepend('Select material', '');
            $warehouse     = warehouse::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            $purchase_number      = \Auth::user()->orderNumberFormat($purchase->id);
            $venders          = Vender::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $Umaterial = MaterialStock::where('id', $purchase->material_id)->get();
            $product_services = MaterialStock::where('created_by', \Auth::user()->creatorId())->get()->pluck('material_name', 'id');
             $priority = [];
                $priority = [
                'Low' => 'Low',
                'High' => 'High',
                'Medium' => 'Medium',
                'Immediate' => 'Immediate'
                ];
            return view('orderrequest.edit', compact('venders', 'product_services', 'purchase', 'warehouse','purchase_number', 'category','Umaterial', 'priority'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, $id)
    {

        $orderrequest              = OrderRequest::find($id);
        //  dd($orderrequest);
        if(\Auth::user()->can('edit purchase'))
        {

            if($orderrequest->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                       'items.price.*' => 'required',
                        'items.priority.*'     => 'required',
                        'items' => 'required',
                    ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('purchase.index')->with('error', $messages->first());
                }
                $products = $request->items;
                 for($i = 0; $i < count($products); $i++)
                {
              
              
                $orderrequest->material_id  = $products[$i]['item'];
                $orderrequest->qty    = $products[$i]['quantity'];
                $orderrequest->price       = $products[$i]['price'];
                $orderrequest->note       =  $products[$i]['note'];
                $orderrequest->created_by     = \Auth::user()->creatorId();
                $orderrequest->priority     = $products[$i]['priority'];
                $orderrequest->created_date     = now()->format('Y-m-d');
                $orderrequest->total = $products[$i]['price']*$products[$i]['quantity'];
                $orderrequest->save();
            }

                }

                return redirect()->route('order.index')->with('success', __('Purchase successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        if(\Auth::user()->can('delete purchase'))
        {
            if($purchase->created_by == \Auth::user()->creatorId())
            {
                $purchase_products = PurchaseProduct::where('purchase_id',$purchase->id)->get();

                $purchasepayments = $purchase->payments;
                foreach($purchasepayments as $key => $value)
                {
                    $purchasepayment = PurchasePayment::find($value->id)->first();
                    $purchasepayment->delete();
                }

                foreach($purchase_products as $purchase_product)
                {
                    $warehouse_qty = WarehouseProduct::where('warehouse_id',$purchase->warehouse_id)->where('product_id',$purchase_product->product_id)->first();

                    $warehouse_transfers = WarehouseTransfer::where('product_id',$purchase_product->product_id)->where('from_warehouse',$purchase->warehouse_id)->get();
                    foreach ($warehouse_transfers as $warehouse_transfer)
                    {
                        $temp = WarehouseProduct::where('warehouse_id',$warehouse_transfer->to_warehouse)->first();
                        if($temp)
                        {
                            $temp->quantity = $temp->quantity - $warehouse_transfer->quantity;
                            if($temp->quantity > 0)
                            {
                                $temp->save();
                            }
                            else
                            {
                                $temp->delete();
                            }

                        }
                    }
                    if(!empty($warehouse_qty))
                    {
                        $warehouse_qty->quantity = $warehouse_qty->quantity - $purchase_product->quantity;
                        if( $warehouse_qty->quantity > 0)
                        {
                            $warehouse_qty->save();
                        }
                        else
                        {
                            $warehouse_qty->delete();
                        }
                    }
                    $product_qty = ProductService::where('id',$purchase_product->product_id)->first();
                    if(!empty($product_qty))
                    {
                        $product_qty->quantity = $product_qty->quantity - $purchase_product->quantity;
                        $product_qty->save();
                    }
                    $purchase_product->delete();

                }

                $purchase->delete();
                PurchaseProduct::where('purchase_id', '=', $purchase->id)->delete();


                return redirect()->route('orderrequest.index')->with('success', __('Purchase successfully deleted.'));
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

    function purchaseNumber()
    {
        $latest = Purchase::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->purchase_id + 1;
    }
    public function sent($id)
    {
        if(\Auth::user()->can('send purchase'))
        {
            $purchase            = Purchase::where('id', $id)->first();
            $purchase->send_date = date('Y-m-d');
            $purchase->status    = 1;
            $purchase->save();

            $vender = Vender::where('id', $purchase->vender_id)->first();

            $purchase->name = !empty($vender) ? $vender->name : '';
            $purchase->purchase = \Auth::user()->purchaseNumberFormat($purchase->purchase_id);

            $purchaseId    = Crypt::encrypt($purchase->id);
            $purchase->url = route('purchase.pdf', $purchaseId);

            Utility::userBalance('vendor', $vender->id, $purchase->getTotal(), 'credit');

            $vendorArr = [
                'vender_bill_name' => $purchase->name,
                'vender_bill_number' =>$purchase->purchase,
                'vender_bill_url' => $purchase->url,

            ];
            $resp = \App\Models\Utility::sendEmailTemplate('vender_bill_sent', [$vender->id => $vender->email], $vendorArr);

            return redirect()->back()->with('success', __('Purchase successfully sent.') . (($resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : ''));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    public function resent($id)
    {

        if(\Auth::user()->can('send purchase'))
        {
            $purchase = Purchase::where('id', $id)->first();

            $vender = Vender::where('id', $purchase->vender_id)->first();

            $purchase->name = !empty($vender) ? $vender->name : '';
            $purchase->purchase = \Auth::user()->purchaseNumberFormat($purchase->purchase_id);

            $purchaseId    = Crypt::encrypt($purchase->id);
            $purchase->url = route('purchase.pdf', $purchaseId);
                //

                        // Send Email
                //        $setings = Utility::settings();
                //
                //        if($setings['bill_resend'] == 1)
                //        {
                //            $bill = Bill::where('id', $id)->first();
                //            $vender = Vender::where('id', $bill->vender_id)->first();
                //            $bill->name = !empty($vender) ? $vender->name : '';
                //            $bill->bill = \Auth::user()->billNumberFormat($bill->bill_id);
                //            $billId    = Crypt::encrypt($bill->id);
                //            $bill->url = route('bill.pdf', $billId);
                //            $billResendArr = [
                //                'vender_name'   => $vender->name,
                //                'vender_email'  => $vender->email,
                //                'bill_name'  => $bill->name,
                //                'bill_number'   => $bill->bill,
                //                'bill_url' =>$bill->url,
                //            ];
                //
                //            $resp = Utility::sendEmailTemplate('bill_resend', [$vender->id => $vender->email], $billResendArr);
                //
                //
                //        }
                //
                //        return redirect()->back()->with('success', __('Bill successfully sent.') . (($resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : ''));
//
        return redirect()->back()->with('success', __('Bill successfully sent.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    public function purchase($purchase_id)
    {

        $settings = Utility::settings();
        $purchaseId   = Crypt::decrypt($purchase_id);

        $purchase  = Purchase::where('id', $purchaseId)->first();
        $data  = DB::table('settings');
        $data  = $data->where('created_by', '=', $purchase->created_by);
        $data1 = $data->get();

        foreach($data1 as $row)
        {
            $settings[$row->name] = $row->value;
        }

        $vendor = $purchase->vender;

        $totalTaxPrice = 0;
        $totalQuantity = 0;
        $totalRate     = 0;
        $totalDiscount = 0;
        $taxesData     = [];
        $items         = [];

        foreach($purchase->items as $product)
        {

            $item              = new \stdClass();
            $item->name        = !empty($product->product) ? $product->product->name : '';
            $item->quantity    = $product->quantity;
            $item->tax         = $product->tax;
            $item->discount    = $product->discount;
            $item->price       = $product->price;
            $item->description = $product->description;

            $totalQuantity += $item->quantity;
            $totalRate     += $item->price;
            $totalDiscount += $item->discount;

            $taxes     = Utility::tax($product->tax);
            $itemTaxes = [];
            if(!empty($item->tax))
            {
                foreach($taxes as $tax)
                {
                    $taxPrice      = Utility::taxRate($tax->rate, $item->price, $item->quantity,$item->discount);
                    $totalTaxPrice += $taxPrice;

                    $itemTax['name']  = $tax->name;
                    $itemTax['rate']  = $tax->rate . '%';
                    $itemTax['price'] = Utility::priceFormat($settings, $taxPrice);
                    $itemTax['tax_price'] =$taxPrice;
                    $itemTaxes[]      = $itemTax;


                    if(array_key_exists($tax->name, $taxesData))
                    {
                        $taxesData[$tax->name] = $taxesData[$tax->name] + $taxPrice;
                    }
                    else
                    {
                        $taxesData[$tax->name] = $taxPrice;
                    }

                }

                $item->itemTax = $itemTaxes;
            }
            else
            {
                $item->itemTax = [];
            }
            $items[] = $item;
        }

        $purchase->itemData      = $items;
        $purchase->totalTaxPrice = $totalTaxPrice;
        $purchase->totalQuantity = $totalQuantity;
        $purchase->totalRate     = $totalRate;
        $purchase->totalDiscount = $totalDiscount;
        $purchase->taxesData     = $taxesData;


            //        $logo         = asset(Storage::url('uploads/logo/'));
            //        $company_logo = Utility::getValByName('company_logo_dark');
            //        $img          = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png'));

        $logo         = asset(Storage::url('uploads/logo/'));
        $company_logo = Utility::getValByName('company_logo_dark');
        $purchase_logo = Utility::getValByName('purchase_logo');
        if(isset($purchase_logo) && !empty($purchase_logo))
        {
            $img = Utility::get_file('purchase_logo/') . $purchase_logo;
        }
        else{
            $img          = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png'));
        }

        if($purchase)
        {
            $color      = '#' . $settings['purchase_color'];
            $font_color = Utility::getFontColor($color);

            return view('purchase.templates.' . $settings['purchase_template'], compact('purchase', 'color', 'settings', 'vendor', 'img', 'font_color'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    public function previewPurchase($template, $color)
    {
        $objUser  = \Auth::user();
        $settings = Utility::settings();
        $purchase     = new Purchase();

        $vendor                   = new \stdClass();
        $vendor->email            = '<Email>';
        $vendor->shipping_name    = '<Vendor Name>';
        $vendor->shipping_country = '<Country>';
        $vendor->shipping_state   = '<State>';
        $vendor->shipping_city    = '<City>';
        $vendor->shipping_phone   = '<Vendor Phone Number>';
        $vendor->shipping_zip     = '<Zip>';
        $vendor->shipping_address = '<Address>';
        $vendor->billing_name     = '<Vendor Name>';
        $vendor->billing_country  = '<Country>';
        $vendor->billing_state    = '<State>';
        $vendor->billing_city     = '<City>';
        $vendor->billing_phone    = '<Vendor Phone Number>';
        $vendor->billing_zip      = '<Zip>';
        $vendor->billing_address  = '<Address>';

        $totalTaxPrice = 0;
        $taxesData     = [];
        $items         = [];
        for($i = 1; $i <= 3; $i++)
        {
            $item           = new \stdClass();
            $item->name     = 'Item ' . $i;
            $item->quantity = 1;
            $item->tax      = 5;
            $item->discount = 50;
            $item->price    = 100;

            $taxes = [
                'Tax 1',
                'Tax 2',
            ];

            $itemTaxes = [];
            foreach($taxes as $k => $tax)
            {
                $taxPrice         = 10;
                $totalTaxPrice    += $taxPrice;
                $itemTax['name']  = 'Tax ' . $k;
                $itemTax['rate']  = '10 %';
                $itemTax['price'] = '$10';
                $itemTax['tax_price'] = 10;
                $itemTaxes[]      = $itemTax;
                if(array_key_exists('Tax ' . $k, $taxesData))
                {
                    $taxesData['Tax ' . $k] = $taxesData['Tax 1'] + $taxPrice;
                }
                else
                {
                    $taxesData['Tax ' . $k] = $taxPrice;
                }
            }
            $item->itemTax = $itemTaxes;
            $items[]       = $item;
        }

        $purchase->purchase_id    = 1;
        $purchase->issue_date = date('Y-m-d H:i:s');
            //        $purchase->due_date   = date('Y-m-d H:i:s');
        $purchase->itemData   = $items;

        $purchase->totalTaxPrice = 60;
        $purchase->totalQuantity = 3;
        $purchase->totalRate     = 300;
        $purchase->totalDiscount = 10;
        $purchase->taxesData     = $taxesData;
        $purchase->created_by     = $objUser->creatorId();

        $preview      = 1;
        $color        = '#' . $color;
        $font_color   = Utility::getFontColor($color);

        $logo         = asset(Storage::url('uploads/logo/'));
        $company_logo = Utility::getValByName('company_logo_dark');
        $settings_data = \App\Models\Utility::settingsById($purchase->created_by);
        $purchase_logo = $settings_data['purchase_logo'];

        if(isset($purchase_logo) && !empty($purchase_logo))
        {
            $img = Utility::get_file('purchase_logo/') . $purchase_logo;
        }
        else{
            $img          = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png'));
        }


        return view('purchase.templates.' . $template, compact('purchase', 'preview', 'color', 'img', 'settings', 'vendor', 'font_color'));
    }

    public function savePurchaseTemplateSettings(Request $request)
    {

        $post = $request->all();
        unset($post['_token']);

        if(isset($post['purchase_template']) && (!isset($post['purchase_color']) || empty($post['purchase_color'])))
        {
            $post['purchase_color'] = "ffffff";
        }


        if($request->purchase_logo)
        {
            $dir = 'purchase_logo/';
            $purchase_logo = \Auth::user()->id . '_purchase_logo.png';
            $validation =[
                'mimes:'.'png',
                'max:'.'20480',
            ];
            $path = Utility::upload_file($request,'purchase_logo',$purchase_logo,$dir,$validation);
            if($path['flag']==0)
            {
                return redirect()->back()->with('error', __($path['msg']));
            }
            $post['purchase_logo'] = $purchase_logo;
        }


        foreach($post as $key => $data)
        {
            \DB::insert(
                'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                    $data,
                    $key,
                    \Auth::user()->creatorId(),
                ]
            );
        }

        return redirect()->back()->with('success', __('Purchase Setting updated successfully'));
    }

  

    public function purchaseLink($purchaseId)
    {
        try {
            $id       = Crypt::decrypt($purchaseId);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Purchase Not Found.'));
        }

        $id             = Crypt::decrypt($purchaseId);
        $purchase       = Purchase::find($id);

        if(!empty($purchase))
        {
            $user_id        = $purchase->created_by;
            $user           = User::find($user_id);
            $purchasePayment = PurchasePayment::where('purchase_id', $purchase->id)->first();
            $vendor = $purchase->vender;
            $iteams   = $purchase->items;

            return view('purchase.customer_bill', compact('purchase', 'vendor', 'iteams','purchasePayment','user'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }

    }

    public function payment($purchase_id)
    {
        if(\Auth::user()->can('create payment purchase'))
        {
            $purchase    = Purchase::where('id', $purchase_id)->first();
            $venders = Vender::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            $categories = ProductServiceCategory::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $accounts   = BankAccount::select('*', \DB::raw("CONCAT(bank_name,' ',holder_name) AS name"))->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('purchase.payment', compact('venders', 'categories', 'accounts', 'purchase'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));

        }
    }

    public function createPayment(Request $request, $purchase_id)
    {
        if(\Auth::user()->can('create payment purchase'))
        {
            $validator = \Validator::make(
                $request->all(), [
                    'date' => 'required',
                    'amount' => 'required',
                    'account_id' => 'required',

                ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $purchasePayment                 = new PurchasePayment();
            $purchasePayment->purchase_id        = $purchase_id;
            $purchasePayment->date           = $request->date;
            $purchasePayment->amount         = $request->amount;
            $purchasePayment->account_id     = $request->account_id;
            $purchasePayment->payment_method = 0;
            $purchasePayment->reference      = $request->reference;
            $purchasePayment->description    = $request->description;
            if(!empty($request->add_receipt))
            {
                $fileName = time() . "_" . $request->add_receipt->getClientOriginalName();
                $request->add_receipt->storeAs('uploads/payment', $fileName);
                $purchasePayment->add_receipt = $fileName;
            }
            $purchasePayment->save();

            $purchase  = Purchase::where('id', $purchase_id)->first();
            $due   = $purchase->getDue();
            $total = $purchase->getTotal();

            if($purchase->status == 0)
            {
                $purchase->send_date = date('Y-m-d');
                $purchase->save();
            }

            if($due <= 0)
            {
                $purchase->status = 4;
                $purchase->save();
            }
            else
            {
                $purchase->status = 3;
                $purchase->save();
            }
            $purchasePayment->user_id    = $purchase->vender_id;
            $purchasePayment->user_type  = 'Vender';
            $purchasePayment->type       = 'Partial';
            $purchasePayment->created_by = \Auth::user()->id;
            $purchasePayment->payment_id = $purchasePayment->id;
            $purchasePayment->category   = 'Bill';
            $purchasePayment->account    = $request->account_id;
            Transaction::addTransaction($purchasePayment);

            $vender = Vender::where('id', $purchase->vender_id)->first();

            $payment         = new PurchasePayment();
            $payment->name   = $vender['name'];
            $payment->method = '-';
            $payment->date   = \Auth::user()->dateFormat($request->date);
            $payment->amount = \Auth::user()->priceFormat($request->amount);
            $payment->bill   = 'bill ' . \Auth::user()->purchaseNumberFormat($purchasePayment->purchase_id);

            Utility::userBalance('vendor', $purchase->vender_id, $request->amount, 'debit');

            Utility::bankAccountBalance($request->account_id, $request->amount, 'debit');

            // Send Email
            $setings = Utility::settings();
            if($setings['new_bill_payment'] == 1)
            {

                $vender = Vender::where('id', $purchase->vender_id)->first();
                $billPaymentArr = [
                    'vender_name'   => $vender->name,
                    'vender_email'  => $vender->email,
                    'payment_name'  =>$payment->name,
                    'payment_amount'=>$payment->amount,
                    'payment_bill'  =>$payment->bill,
                    'payment_date'  =>$payment->date,
                    'payment_method'=>$payment->method,
                    'company_name'=>$payment->method,

                ];


                $resp = Utility::sendEmailTemplate('new_bill_payment', [$vender->id => $vender->email], $billPaymentArr);

                return redirect()->back()->with('success', __('Payment successfully added.') . (($resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : ''));

            }

            return redirect()->back()->with('success', __('Payment successfully added.'));
        }

    }

    public function paymentDestroy(Request $request, $purchase_id, $payment_id)
    {

        if(\Auth::user()->can('delete payment purchase'))
        {
            $payment = PurchasePayment::find($payment_id);
            PurchasePayment::where('id', '=', $payment_id)->delete();

            $purchase = Purchase::where('id', $purchase_id)->first();

            $due   = $purchase->getDue();
            $total = $purchase->getTotal();

            if($due > 0 && $total != $due)
            {
                $purchase->status = 3;

            }
            else
            {
                $purchase->status = 2;
            }

            Utility::userBalance('vendor', $purchase->vender_id, $payment->amount, 'credit');
            Utility::bankAccountBalance($payment->account_id, $payment->amount, 'credit');

            $purchase->save();
            $type = 'Partial';
            $user = 'Vender';
            Transaction::destroyTransaction($payment_id, $type, $user);

            return redirect()->back()->with('success', __('Payment successfully deleted.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function vender(Request $request)
    {
        $vender = Vender::where('id', '=', $request->id)->first();

        return view('purchase.vender_detail', compact('vender'));
    }
    public function product(Request $request)
    {
        $data['product']     = $product = ProductService::find($request->product_id);
        $data['unit']        = !empty($product->unit) ? $product->unit->name : '';
        $data['taxRate']     = $taxRate = !empty($product->tax_id) ? $product->taxRate($product->tax_id) : 0;
        $data['taxes']       = !empty($product->tax_id) ? $product->tax($product->tax_id) : 0;
        $salePrice           = $product->purchase_price;
        $quantity            = 1;
        $taxPrice            = ($taxRate / 100) * ($salePrice * $quantity);
        $data['totalAmount'] = ($salePrice * $quantity);

        return json_encode($data);
    }

    public function productDestroy(Request $request)
    {

        if(\Auth::user()->can('delete purchase'))
        {

            $res = PurchaseProduct::where('id', '=', $request->id)->first();
//            $res1 = PurchaseProduct::where('purchase_id', '=', $res->purchase_id)->where('product_id', '=', $res->product_id)->get();

            $purchase = Purchase::where('created_by', '=', \Auth::user()->creatorId())->first();
            $warehouse_id= $purchase->warehouse_id;

            $ware_pro =WarehouseProduct::where('warehouse_id',$warehouse_id)->where('product_id',$res->product_id)->first();

            $qty = $ware_pro->quantity;

            if($res->quantity == $qty || $res->quantity > $qty)
            {
                $ware_pro->delete();
            }
            elseif($res->quantity < $qty)
            {
                $ware_pro->quantity =  $qty - $res->quantity;
                $ware_pro->save();

            }
            PurchaseProduct::where('id', '=', $request->id)->delete();


            return redirect()->back()->with('success', __('Purchase product successfully deleted.'));

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

// Searchin start

 public function search(Request $request)
    {  
    //   dd($request->all());
         $date = $request->daterange != ''?explode('To', $request->daterange):'';
        //  dd($date);
         $usr = \Auth::user();
         $orders = '';  
                
             if ($request->status != '' && $request->created_by != '' && $date != '' && $request->approved_by != ''&& $request->priority != '') {
                  
                        $parsedStartDate = Carbon::parse($date[0])->format('Y-m-d');
                        $parsedEndDate = Carbon::parse($date[1])->format('Y-m-d');
                        $orders     = OrderRequest::select('order_requests.*')
                        ->join('users', 'order_requests.created_by', '=', 'users.id')
                        ->join('material_stocks', 'order_requests.material_id', '=', 'material_stocks.id')
                        ->where('order_requests.created_by', '=', $request->created_by)
                        ->where('order_requests.approved_by', '=', $request->approved_by)
                        ->where('order_requests.status', '=', $request->status)
                        ->where('order_requests.priority', '=', $request->priority)
                        ->whereBetween('order_requests.created_at', [$parsedStartDate , $parsedEndDate])
                        ->orderBy('order_requests.id')
                        ->paginate(10)->withQueryString();
                  
                }
                 elseif ($request->status != '' && $date != '' && $request->created_by != '') {
                   
                       $parsedStartDate = Carbon::parse($date[0])->format('Y-m-d');
                       $parsedEndDate = Carbon::parse($date[1])->format('Y-m-d');
                       $orders     = OrderRequest::select('order_requests.*')
                        ->join('users', 'order_requests.created_by', '=', 'users.id')
                        ->join('material_stocks', 'order_requests.material_id', '=', 'material_stocks.id')
                        ->where('order_requests.created_by', '=', $request->created_by)
                        ->where('order_requests.approved_by', '=', $request->approved_by)
                        ->where('order_requests.status', '=', $request->status)
                        ->where('order_requests.priority', '=', $request->priority)
                        ->whereBetween('order_requests.created_at', [$parsedStartDate , $parsedEndDate])
                        
                        ->orderBy('order_requests.id')
                        ->paginate(10)->withQueryString();
                  
                }
                
                 elseif ($request->status != '' && $date != '') {
                     
                      $parsedStartDate = Carbon::parse($date[0])->format('Y-m-d');
                      $parsedEndDate = Carbon::parse($date[1])->format('Y-m-d');
                        $orders     = OrderRequest::select('order_requests.*')
                        ->join('users', 'order_requests.created_by', '=', 'users.id')
                        ->join('material_stocks', 'order_requests.material_id', '=', 'material_stocks.id')
                        ->where('order_requests.status', '=', $request->status)
                        ->whereBetween('order_requests.created_at', [$parsedStartDate , $parsedEndDate])
                        ->orderBy('order_requests.id')
                        ->paginate(10)->withQueryString();
                  
                }
                elseif ($request->status != '') {
                        $orders     = OrderRequest::select('order_requests.*')
                        ->join('users', 'order_requests.created_by', '=', 'users.id')
                        ->join('material_stocks', 'order_requests.material_id', '=', 'material_stocks.id')
                        ->where('order_requests.status', '=', $request->status)
                        ->orderBy('order_requests.id')
                        ->paginate(10)->withQueryString();
                     
                }
                elseif ($request->approved_by != '') {
                        $orders     = OrderRequest::select('order_requests.*')
                        ->join('users', 'order_requests.created_by', '=', 'users.id')
                        ->join('material_stocks', 'order_requests.material_id', '=', 'material_stocks.id')
                        ->where('order_requests.approved_by', '=', $request->approved_by)
                        ->orderBy('order_requests.id')
                        ->paginate(10)->withQueryString();
                  
                }
                elseif ($request->created_by != '') {
                        $orders     = OrderRequest::select('order_requests.*')
                        ->join('users', 'order_requests.created_by', '=', 'users.id')
                        ->join('material_stocks', 'order_requests.material_id', '=', 'material_stocks.id')
                        ->where('order_requests.created_by', '=', $request->created_by)
                        ->orderBy('order_requests.id')
                        ->paginate(10)->withQueryString();
                     
                }
                 elseif ($request->priority != '') {
                        $orders     = OrderRequest::select('order_requests.*')
                        ->join('users', 'order_requests.created_by', '=', 'users.id')
                        ->where('order_requests.priority', '=', $request->priority)
                        ->orderBy('order_requests.id')
                        ->paginate(10)->withQueryString();
                   
                }
                 elseif ($date != '' ) {
                          
                      $parsedStartDate = Carbon::parse($date[0])->format('Y-m-d');
                      $parsedEndDate = Carbon::parse($date[1])->format('Y-m-d');
                        $orders     = OrderRequest::select('order_requests.*')
                        ->join('users', 'order_requests.created_by', '=', 'users.id')
                        ->join('material_stocks', 'order_requests.material_id', '=', 'material_stocks.id')
                        ->whereBetween('order_requests.created_at', [$parsedStartDate , $parsedEndDate])
                        ->orderBy('order_requests.id')
                        ->paginate(10)->withQueryString();
                  
                }
                else {
          
                    $orders     = OrderRequest::all();
                        // ->join('user_leads', 'user_leads.lead_id', '=', 'leads.id')
                        // ->where('user_leads.user_id', '=', $usr->id)
                        // ->where('leads.pipeline_id', '=', $pipeline->id)
                        // ->where('leads.user_id', '=', $request->user_id)
                        // ->orderBy('leads.order')
                        // ->paginate(10)->withQueryString();
                }
             
            $date = $request->date;
            
            $key = '';
            $emp     = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->where('id', '!=', \Auth::user()->id)->get();
           
            $users = User::where('type', '=', 'company')->get();
           
            $status = DB::table('status')->get()->pluck('name','id');
           
            $created_by = $request->created_by;
            $approved_by = $request->approved_by;
            return view('orderrequest.index', compact('orders', 'emp', 'users', 'date', 'key', 'created_by', 'approved_by'));
            
        
    }

//Searchin end



}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;
use App\Models\UserLead;
use App\Models\Lead;
use App\Models\LeadActivityLog;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class LeadStore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $client;
    protected $apiUrl = 'https://mapi.indiamart.com/wservce/crm/crmListing/v2/';
    protected $signature = 'leadStore:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->client = new Client();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
            $apiKey = 'mRyyF7Fu4nfETves4HyN7luPq1DHmTg=';

      
            $response = $this->client->request('GET', $this->apiUrl, [
                'query' => [
                    'glusr_crm_key' => $apiKey,
                    'start_time'=> Carbon::now()->subDays(1)->format('d-M-Y'),
                    'end_time'=> Carbon::now()->format('d-M-Y'),
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
           

            /**
             * Start Indiamart listing store in own db.
             */
            
            if ($data['CODE'] == 200 && $data['STATUS'] == "SUCCESS") {
            $responseData = $data['RESPONSE'];
            // dd($responseData);
            foreach ($responseData as $record) {
                // Assuming $record is an associative array with the correct keys matching your table columns
                $users = User::where(['city' => $record['SENDER_CITY']])->pluck('id')->toArray();
                $dateTime = new \DateTime($record['QUERY_TIME']);
                $formattedDate = $dateTime->format('Y-m-d');  
                $lead              = new Lead();
                $lead->name        = $record['SENDER_NAME'];
                $lead->industry_name  = $record['SENDER_COMPANY'];
                $lead->email       = $record['SENDER_EMAIL'];
                $lead->phone       = $record['SENDER_MOBILE'];
                $lead->subject     = $record['SUBJECT'];
                $lead->quantity     = 1;
                $lead->user_id     = 6;
                $lead->assigned_to     = implode(",", array_filter($users));
                $lead->owner_id     = 6;
                $lead->pipeline_id = 2;
                $lead->stage_id    = 8;
                $lead->sources     = 11;
                $lead->products    = $record['QUERY_PRODUCT_NAME'];
                $lead->indiamart_product_name    = $record['QUERY_PRODUCT_NAME'];
                $lead->notes       = $record['QUERY_MESSAGE'];
                $lead->request_type  = $record['QUERY_TYPE'];
                $lead->is_indiamart  = 1;
                $lead->created_by  = 6;
                $lead->date        = $formattedDate;
                $lead->save();
                
                 if($lead){
                     LeadActivityLog::create(
                    [
                        'user_id' => 6,
                        'lead_id' => $lead->id,
                        'log_type' => 'Create lead',
                        'remark' => json_encode(['title' => 'Created New Lead']),
                    ]
                );
                }
                //start customer create
            // $objCustomer    = \Auth::user();
            // $creator        = User::find($objCustomer->creatorId());
            // $total_customer = $objCustomer->countCustomers();
            // $plan           = Plan::find($creator->plan);

            $default_language          = DB::table('settings')->select('value')->where('name', 'default_language')->first();
            
                $customer                  = new Customer();
                $customer->customer_id     = Customer::count() + 1;
                $customer->lead_id     = $lead->id;
                $customer->name            = $record['SENDER_NAME'];
                $customer->contact         = $record['SENDER_MOBILE'];
                $customer->gender           = 'Male';
                $customer->email           = $record['SENDER_EMAIL'];
                $customer->tax_number      = '';
                $customer->created_by      =6;
                $customer->billing_name    = $record['SENDER_NAME'];
               
                $customer->billing_country = $record['SENDER_COUNTRY_ISO'];
                $customer->billing_state   = $record['SENDER_STATE'];
                $customer->billing_city    = $record['SENDER_CITY'];
                $customer->billing_phone   = $record['SENDER_MOBILE'];
                $customer->billing_zip     = $record['SENDER_PINCODE'];
                $customer->billing_address = $record['SENDER_ADDRESS'];

                $customer->shipping_name    = $record['SENDER_NAME'];
               
                $customer->shipping_country = $record['SENDER_COUNTRY_ISO'];
                $customer->shipping_state   = $record['SENDER_STATE'];
                $customer->shipping_city    = $record['SENDER_CITY'];
                $customer->shipping_phone   = $record['SENDER_MOBILE'];
                $customer->shipping_zip     = $record['SENDER_PINCODE'];
                $customer->shipping_address = $record['SENDER_ADDRESS'];

                $customer->lang = !empty($default_language) ? $default_language->value : '';

                $customer->save();

                
                        $usrLeads = [
                            6
                        ];
                    

                foreach($usrLeads as $usrLead)
                {
                    UserLead::create(
                        [
                            'user_id' => $usrLead,
                            'lead_id' => $lead->id,
                        ]
                    );
                }
                 $users = User::where(['city' => $record['SENDER_CITY']])->get();  
                foreach($users as $usrLeads)
                {
                    UserLead::create(
                        [
                            'user_id' => $usrLeads->id,
                            'lead_id' => $lead->id,
                        ]
                    );
                }
                
            }

            //     return response()->json(['message' => 'Data stored successfully'], 200);
            echo 'Data stored successfully';die;
            } else {
            //     return response()->json(['message' => 'Failed to store data'], 400);
             echo 'Failed to store data';die;
            }
                

                /**
                 * End Indiamart listing store in own db.
                 */ 
                
            return $data;
        
        // return true;
    }
   
}

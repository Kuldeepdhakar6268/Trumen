<?php

namespace App\Exports;

use App\Models\Lead;
use App\Models\User;
use App\Models\LeadStage;
use App\Models\Source;
use App\Models\Pipeline;
use App\Models\Label;
use App\Models\ProductService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $date;
    public function __construct($date)
    {
    $this->date = $date;
    }
    public function collection()
    {
    // dd(count($this->date));
        $data = Lead::where('leads.created_by', \Auth::user()->creatorId());
        if(count($this->date) != 7)
        {
            //  dd(count($this->date));
            if($this->date['f_date'] != '0' && $this->date['f_assignedby'] != '0')
            {
               
                $data = $data->whereDate('leads.date', \Carbon\Carbon::parse($this->date['f_date']))->where('leads.created_by', $this->date['f_assignedby']); 
            }
            
            if($this->date['f_date'] != '0' && $this->date['f_assignedby'] == '0')
            {
               
                $data = $data->whereDate('leads.date', \Carbon\Carbon::parse($this->date['f_date'])); 
            }
            if($this->date['f_assignedby'] != '0' && $this->date['f_date'] == '0')
            {
                 
                $data = $data->where('leads.created_by', $this->date['f_assignedby']); 
                // dd($data);
            }
              if($this->date['f_state'] != '0' && $this->date['f_city'] == '0'){
              
                 $sName = \App\Models\State::find($this->date['f_state']);
                        //  dd($sName);
                 $data = $data->Where('customers.billing_state', '=', $sName->name); 
            }
            if($this->date['f_state'] != '0' && $this->date['f_city'] != '0'){
                 $sName = \App\Models\State::find($this->date['f_state']);
                 $data = $data->where('customers.billing_city', '=', $this->date['f_city'])->Where('customers.billing_state', '=', $sName->name); 
                //  return $data;
            }
           
            
           
        }else
        {
            $data = $data; 
        }
    
            $data = $data->leftJoin('customers', 'customers.lead_id', '=', 'leads.id')->select('leads.*', 'customers.billing_city', 'customers.billing_state', 'customers.billing_name')->orderBy('leads.id','desc')->get();
        //   dd($data);
        
        foreach($data as $k => $lead)
        {
           
            unset($lead->id,$lead->order,
            $lead->quantity,
            $lead->created_at,$lead->updated_at, $lead->indiamart_product_name,  $lead->is_indiamart,$lead->is_converted,$lead->is_active, $lead->labels, $lead->pipeline_id, $lead->user_id,$lead->owner_id, $lead->request_type, $lead->request_id);

               $user = User::find($lead->created_by);
            // $pipeline = Pipeline::find($lead->pipeline_id);
            //  $stage = LeadStage::find($lead->stage_id);
            $assigneds = User::whereIn('id', explode(',', $lead->assigned_to))->get();
            $sources = Source::whereIn('id', explode(',', $lead->sources))->get();
            $sourceName = [];
            $assName = [];
            foreach ($assigneds as $assigned_to) {
                $assName[] = $assigned_to->name;
            }
            
            foreach ($sources as $source) {
                $sourceName[] = $source->name;
            }

            $products = ProductService::whereIn('id', explode(',', $lead->products))->get();
            $productName = [];
            // dd($products);
            foreach ($products as $product) {
                $productName[] = $product->name;
            }

            // $labels = Label::whereIn('id', explode(',', $lead->products))->get();
            // $labelName = [];
            
            // foreach ($labels as $label) {
            //     $labelName[] = $label->name;
            // }
// dd($lead);
              $data[$k]["name"] =   $lead->billing_name;
              unset($lead->billing_name);
            // $data[$k]["pipeline_id"]     = $pipeline->name;
            $data[$k]["assigned_to"]     =  implode(',', $assName);
            $data[$k]["stage_id"]     =  isset($lead->stage)?$lead->stage->name:'';
            $data[$k]["sources"]     = implode(',', $sourceName);
            $data[$k]["products"]     = count($products)>0? implode(',', $productName):$lead->products;
            
            $data[$k]["billing_city"]     = $lead->billing_city;
            $data[$k]["billing_state"]     = $lead->billing_state;
            $data[$k]["created_by"]     = !empty($user)?$user->name:'-';
            $data[$k]["date"]     = $lead->date;
            
            
        }
       
        return $data;
    }

    public function headings(): array
    {
        return [
           
            "Name",
            "Email",
            "Contact",
            "Subject",
            "Assigned To",
            "Status",
            "Source",
            "Industry Name",
            "Products",
            "Notes",
            "Assigned_by",
             "Date",
            "City",
            "State",
           
        ];
    }
}

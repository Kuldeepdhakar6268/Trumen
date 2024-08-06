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

class LeadSample implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Lead::where('created_by', \Auth::user()->creatorId())->orderBy('id', 'desc')->take(2)->get();
 
        foreach($data as $k => $lead)
        {
            // dd($lead);
            unset($lead->id,$lead->order,
            $lead->created_by,$lead->is_active , $lead->is_converted,
            $lead->created_at,$lead->updated_at, $lead->indiamart_product_name,  $lead->is_indiamart,$lead->date, $lead->labels, $lead->stage_id, $lead->pipeline_id, $lead->request_type, $lead->request_id);

            // $user = User::find($lead->user_id);
            // $pipeline = Pipeline::find($lead->pipeline_id);
            // $stage = LeadStage::find($lead->stage_id);

            // $sources = Source::whereIn('id', explode(',', $lead->sources))->get();
            // $sourceName = [];
            
            // foreach ($sources as $source) {
            //     $sourceName[] = $source->name;
            // }

            // $products = ProductService::whereIn('id', explode(',', $lead->products))->get();
            // $productName = [];
            // // dd($products);
            // foreach ($products as $product) {
            //     $productName[] = $product->name;
            // }

            // $labels = Label::whereIn('id', explode(',', $lead->products))->get();
            // $labelName = [];
            
            // foreach ($labels as $label) {
            //     $labelName[] = $label->name;
            // }

            // $data[$k]["user_id"] =   !empty($user) ? $user->name : '';
            // $data[$k]["pipeline_id"]     = $pipeline->name;
            $data[$k]["notes"]     = 'jdlfsdljfsdd';
           
            $data[$k]["address"]     = '145 New Township';
            $data[$k]["country"]     = 'India';
            $data[$k]["state"]     = 'mp';
            $data[$k]["city"]     = 'dewas';
            $data[$k]["qty"]     = 1;
            $data[$k]["gst"]     = 'XYZ123';
            
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
            "User_id",
            "owner_id",
            "Assigned To",
            "Source",
            "Industry Name",
            "Products",
            "Notes",
            "Date",
            "Address",
            "Country",
            "State",
            "City",
            "Qty",
            "Gst Number",
        ];
    }
}

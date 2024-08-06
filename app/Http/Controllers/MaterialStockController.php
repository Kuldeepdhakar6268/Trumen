<?php

namespace App\Http\Controllers;

use App\Models\ProductService;
use App\Models\ProductStock;
use App\Models\MaterialStock;
use App\Models\Utility;
use Illuminate\Http\Request;

class MaterialStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(\Auth::user()->can('manage product & service'))
        {

            $materials = MaterialStock::where('created_by', '=', \Auth::user()->creatorId())->get();
            $mList = MaterialStock::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('material_name', 'id');
            $mList->prepend(__('Select Materials'), '');
            
            return view('materialstock.index', compact('materials', 'mList'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('materialstock.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     $input = $request->all();
     $input['current_qty'] = $input['purchased_qty'];
     $input['created_by'] = \Auth::user()->creatorId();
     MaterialStock::create($input);
      return redirect()->route('materialstock.index')->with('success', __('Material successfully created.'));
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\ProductStock $productStock
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ProductStock $productStock)
    {
        
    }
  public function part(Request $request)
    {
      
        $data['product']     = $product =  MaterialStock::find($request->product_id);
       

        return json_encode($data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ProductStock $productStock
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = MaterialStock::find($id);
        if(\Auth::user()->can('edit product & service'))
        {
            if($material->created_by == \Auth::user()->creatorId())
            {
                return view('materialstock.edit', compact('material'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductStock $productStock
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(\Auth::user()->can('edit product & service'))
        {
            $material = MaterialStock::find($id);
            $input = $request->all();
            $input['current_qty'] = $request->purchased_qty + $request->current_qty;
            $input['created_by'] = \Auth::user()->creatorId();
            if($material->created_by == \Auth::user()->creatorId())
            {
               
                $material->update($input);


                return redirect()->route('materialstock.index')->with('success', __('Material  stock updated manually.'));
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
     *
     * @param \App\Models\ProductStock $productStock
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductStock $productStock)
    {
        //
    }
}

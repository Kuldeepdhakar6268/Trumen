<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\ProductModel;
use App\Models\Specification;
use App\Models\Pipeline;
use App\Models\Group;
use Illuminate\Http\Request;

class ProductModelController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            [
                'auth',
                'XSS',
            ]
        );
    }

    /**
     * Display a listing of the relabel.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('manage label'))
        {
            $models   = ProductModel::all();
            return view('models.index')->with('models', $models);
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    /**
     * Show the form for creating a new relabel.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->can('create label'))
        {
         
            $group = Group::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $group->prepend('Select Category', '');
            return view('models.create', compact('group'));
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }

    /**
     * Store a newly created relabel in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        if(\Auth::user()->can('create label'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required|max:200'
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->route('models.index')->with('error', $messages->first());
            }

            $group              = new ProductModel();
            $group->name        = $request->name;
            $group->group_id        = $request->category_id;
           
            $group->save();

            return redirect()->route('product-models.index')->with('success', __('Model successfully created!'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    /**
     * Display the specified relabel.
     *
     * @param \App\Label $label
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ProductModel $model)
    {
        return redirect()->route('product-models.index');
    }

    /**
     * Show the form for editing the specified relabel.
     *
     * @param \App\Label $label
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         
          $model = ProductModel::find($id);
          $groups = Group::get()->pluck('name', 'id');
            $groups->prepend('Select Category', '');
        return view('models.edit', compact('model', 'groups'));
    }

    public function getModels(Request $request)
    {
         
          $models = ProductModel::where('group_id', $request->id)->get();
         
        return response()->json(['status' => true, 'msg'=>'List retrived', 'data' => $models]);
    }
    
    public function getParent(Request $request)
    {
        // dd($request->all()); 
          $models = Specification::where(['priority' => 0, 'product_model_id' => $request->id])->get();
        
        return response()->json(['status' => true, 'msg'=>'List retrived', 'data' => $models]);
    }

    /**
     * Update the specified relabel in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Label $label
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
                $validator = \Validator::make(
                    $request->all(), [
                                      'name' => 'required|max:20',
                                     
                                  ]
                );
          
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('users')->with('error', $messages->first());
                }
                $model = ProductModel::find($request->id);
                $model->name        = $request->name;
                $model->group_id        = $request->group_id;
                $model->save();

                return redirect()->route('product-models.index')->with('success', __('Model successfully updated!'));
           
       
    }

    /**
     * Remove the specified relabel from storage.
     *
     * @param \App\Label $label
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                $group = ProductModel::find($id);
                $group->delete();

                return redirect()->route('product-models.index')->with('success', __('Model successfully deleted!'));
           
       
 }
}

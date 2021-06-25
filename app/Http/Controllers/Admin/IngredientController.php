<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\FoodItem;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concern\GlobalTrait;

class IngredientController extends Controller
{
    use GlobalTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = Ingredient::orderBy('id', 'DESC')->get();
            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('date_time', function($row){
                    return $this->convertDateTime($row->created_at);
                })
                ->addColumn('food', function($row){
                    $food = FoodItem::find($row->food_id);
                    return $food ? $food->name : 'N/A';
                })
                ->addColumn('type', function($row){
                    if($row->type == 'ingredient') {
                        return 'Ingredient';
                    }else {
                        return 'Cooking Level';
                    }
                })
                ->addColumn('price', function($row){
                    if($row->price) {
                        return '$'.$row->price;
                    }else {
                        return '';
                    }
                })
                ->addColumn('status', function($row){
                    if($row->status == 'Yes') 
                        $status = '<span class="text-info">Active</span><div class="modal fade" id="feedback'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="feedbackTitle" aria-hidden="true">';
                    else
                        $status = '<span class="text-danger">Inactive</span><div class="modal fade" id="feedback'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="feedbackTitle" aria-hidden="true">';
                    return $status;
                })
                ->addColumn('action', function($row){
                    $action = '
                            <a href="'.url('admin/ingredients').'/'.$row->id.'/edit" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" onclick="deleteIngredient('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>';
                    return $action;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('admin.ingredients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = FoodItem::where('status', 'Yes')->orderBy('id', 'DESC')->get();
        return view('admin.ingredients.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'food.*'   => 'required',
                'type.*'   => 'required',
                'name.*'   => 'required|max:150',
                'price.*'  => 'nullable',
                'status.*' => 'required'
            ]
        );
        if(count($request->food)> 0){
            for ($i = 0; $i < count($request->food); $i++) { 
                Ingredient::create(
                    [
                        'food_id' => $request->food[$i],
                        'type'    => $request->type[$i],
                        'name'    => $request->name[$i],
                        'price'   => $request->price[$i],
                        'status'  => $request->status[$i],
                        'remark'  => $request->remark[$i]
                    ]
                );
            }
        }else {
            return redirect('admin/ingredients')->with('warning', 'Ingredient Not Added, Because Invalid Data Exist.');
        }
        return redirect('admin/ingredients')->with('success', 'Ingredient Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $picked = Ingredient::find($id);
        $items = FoodItem::where('status', 'Yes')->orderBy('id', 'DESC')->get();
        return view('admin.ingredients.edit', compact('picked', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'food'   => 'required',
                'type'   => 'required',
                'name'   => 'required|max:150',
                'price'  => 'nullable',
                'status' => 'required'
            ]
        );
        $picked = Ingredient::find($id);
        $picked->update(
            [
                'food_id' => $request->food,
                'type'    => $request->type,
                'name'    => $request->name,
                'price'   => $request->price,
                'status'  => $request->status,
                'remark'  => $request->remark
            ]
        );
        return redirect('admin/ingredients')->with('success', 'Ingredient Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $picked = Ingredient::find($id);
            $picked->delete();
            return $this->success('Ingredient Deleted Sucecssfully.', null);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }
}

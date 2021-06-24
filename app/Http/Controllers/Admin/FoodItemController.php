<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\FoodItem;
use App\Models\Quantity;
use App\Models\Category;
use App\Models\FoodAddon;
use App\Models\FoodVariant;
use App\Models\FoodGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concern\GlobalTrait;

class FoodItemController extends Controller
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
            $users = FoodItem::orderBy('id', 'DESC')->get();
            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('date_time', function($row){
                    return $this->convertDateTime($row->created_at);
                })
                ->addColumn('category', function($row){
                    $category = Category::find($row->category_id);
                    return $category ? $category->name : 'N/A';
                })
                ->addColumn('image', function($row){
                    $image = FoodGallery::where('food_id', $row->id)->first();
                    if($image) {
                        if (Storage::exists($image->image)) 
                            $image = '<div class="table-image"><img src="'.asset('storage/'.$image->image).'"><span>'.$row->name.'</span></div>';
                        else
                            $image = '<div class="table-image"><img src="'.asset('').'/admin/images/dummy.jpg"><span>'.$row->name.'</span></div>';
                    }else {
                        $image = '<div class="table-image"><img src="'.asset('').'/admin/images/dummy.jpg"><span>'.$row->name.'</span></div>';
                    }
                    
                    return $image;
                })
                ->addColumn('quantity_type', function($row){
                    $varients = FoodVariant::where('food_id', $row->id)->get();
                    if(count($varients) > 0) {
                        $quantity = [];
                        foreach ($varients as $varient) {
                            $q = Quantity::find($varient->quantity_id);
                            array_push($quantity, $q->type);
                        }
                        return implode(', ', $quantity);
                    }else {
                        return 'N/A';
                    }
                    return $category ? $category->name : 'N/A';
                })
                ->addColumn('price', function($row){
                    $varient = FoodVariant::where('food_id', $row->id)->orderBy('price', 'DESC')->first();
                    if($varient) {
                        if($varient->discount) {
                            $price  = '<span class="cutprice">$'.$varient->price.'</span> <span class="mainprice">$'.$varient->price.'</span> <span class="discountprice">off '.$varient->discount.'%</span>'; 
                        }else {
                            $price  = '<span class="mainprice">$'.$varient->price.'</span>'; 
                        }
                    }else {
                        return 'N/A';
                    }
                    return $price;
                })
                ->addColumn('stock', function($row){
                    $varient = FoodVariant::where('food_id', $row->id)->orderBy('stock_quantity', 'DESC')->first();
                    if($varient) {
                        $stock = $varient->stock_quantity;
                    }else {
                        return 'N/A';
                    }
                    return $stock;
                })
                ->addColumn('inventory', function($row){
                    if($row->inventory == 'Yes') {
                        return '<span class="text-success">Yes</span>';
                    }else {
                        return '<span class="text-danger">No</span>';
                    }
                })
                ->addColumn('cod', function($row){
                    if($row->cod == 'Yes') {
                        return '<span class="text-success">Yes</span>';
                    }else {
                        return '<span class="text-danger">No</span>';
                    }
                })
                ->addColumn('home_delivery', function($row){
                    if($row->home_delivery == 'Yes') {
                        return '<span class="text-success">Yes</span>';
                    }else {
                        return '<span class="text-danger">No</span>';
                    }
                })
                ->addColumn('takeaway', function($row){
                    if($row->takeaway == 'Yes') {
                        return '<span class="text-success">Yes</span>';
                    }else {
                        return '<span class="text-danger">No</span>';
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
                    if($row->status == 'Yes'){
                        $action = '
                            <a href="javascript:void(0)" onclick="changeStatus('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-times"></i></a>
                            <a href="#" class="btn btn-info btn-sm-custom waves-effect waves-float waves-light show-varient"><i class="fas fa-plus"></i></a>
                            <a href="'.url('admin/food/addons').'/'.$row->slug.'" class="btn btn-info btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-list-ul"></i></a>
                            <a href="'.url('admin/food/items').'/'.$row->slug.'" class="btn btn-success btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-eye"></i></a>
                            <a href="'.url('admin/food/items').'/'.$row->id.'/edit" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" onclick="deleteItem('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>';
                    }else {
                        $action = '
                            <a href="javascript:void(0)" onclick="changeStatus('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-check-circle"></i></a>
                            <a href="#" class="btn btn-info btn-sm-custom waves-effect waves-float waves-light show-varient"><i class="fas fa-plus"></i></a>
                            <a href="'.url('admin/food/addons').'/'.$row->slug.'" class="btn btn-info btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-list-ul"></i></a>
                            <a href="'.url('admin/food/items').'/'.$row->slug.'" class="btn btn-success btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-eye"></i></a>
                            <a href="'.url('admin/food/items').'/'.$row->id.'/edit" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" onclick="deleteItem('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>';
                    }
                    
                    return $action;
                })
                ->rawColumns(['action','status', 'image', 'price', 'inventory', 'cod', 'home_delivery', 'takeaway'])
                ->make(true);
        }
        return view('admin.food_items.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quantities = Quantity::where('status', 'Yes')->get();
        $categories = Category::where('parent_id', null)->orderBy('name', 'ASC')->get();
        return view('admin.food_items.create', compact('categories', 'quantities'));
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
                'category'         => 'required|integer',
                'sub_category'     => 'nullable|integer',
                'name'             => 'required|max:150',
                'delivery_time'    => 'required|max:150',
                'slug'             => 'required|unique:food_items',
                'remark'           => 'nullable',
                'meta_title'       => 'required|max:200',
                'keyword'          => 'required',
                'description'      => 'required',
                'quantity.*'       => 'required|integer',
                'price.*'          => 'required',
                'discount.*'       => 'nullable|numeric|between:0,99.99',
                'final_price.*'    => 'required',
                'stock_quantity.*' => 'nullable',
                'image.*'          => 'required|mimes:jpg,jpeg,png,svg'
            ]
        );
        $food = FoodItem::create(
            [
                'category_id'      => $request->category,
                'sub_category_id'  => $request->sub_category,
                'name'             => $request->name,
                'slug'             => $request->slug,
                'remark'           => $request->remark,
                'meta_title'       => $request->meta_title,
                'keyword'          => $request->keyword,
                'description'      => $request->description,
                'stock'            => $request->has('stock') ? 'Yes' : 'No',
                'inventory'        => $request->has('inventory') ? 'Yes' : 'No',
                'cod'              => $request->has('cod') ? 'Yes' : 'No',
                'home_delivery'    => $request->has('home_delivery') ? 'Yes' : 'No',
                'takeaway'         => $request->has('takeaway') ? 'Yes' : 'No',
                'delivery_time'    => $request->delivery_time,
            ]
        );
        if($request->has('image')) {
            for ($i = 0; $i < count($request->image); $i++) { 
                $image_url = $request->image[$i]->store('food_gallery');
                FoodGallery::create(
                    [
                        'food_id' => $food->id,
                        'image'   => $image_url
                    ]
                );
            }
        }
        if($request->has('quantity')) {
            for ($i = 0; $i < count($request->quantity); $i++) { 
                FoodVariant::create(
                    [
                        'food_id'       => $food->id,
                        'quantity_id'   => $request->quantity[$i],
                        'price'         => $request->price[$i],
                        'discount'      => $request->discount[$i],
                        'final_price'   => $request->final_price[$i],
                        'stock_quantity'=> $request->stock_quantity[$i],
                    ]
                );
            }
        }
        return redirect('admin/food/items')->with('success', 'Food Item Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $picked = FoodItem::with(['getGallery', 'getVarients'])->where('slug', $id)->first();
        return view('admin.food_items.view', compact('picked'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $picked     = FoodItem::with(
            [
                'getGallery', 
                'getVarients' => function($q) {
                    $q->with(['getQuantity']);
                }
            ]
        )->find($id);
        $quantities = Quantity::where('status', 'Yes')->get();
        $categories = Category::where('parent_id', null)->orderBy('name', 'ASC')->get();
        $sub_categories = Category::where('parent_id', $picked->category_id)->orderBy('name', 'ASC')->get();
        return view('admin.food_items.edit', compact('quantities', 'categories', 'picked', 'sub_categories'));
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
                'category'         => 'required|integer',
                'sub_category'     => 'nullable|integer',
                'name'             => 'required|max:150',
                'delivery_time'    => 'required|max:150',
                'slug'             => 'required|unique:food_items,slug,'.$id,
                'remark'           => 'nullable',
                'meta_title'       => 'required|max:200',
                'keyword'          => 'required',
                'description'      => 'required',
                'quantity.*'       => 'required|integer',
                'price.*'          => 'required',
                'discount.*'       => 'nullable|numeric|between:0,99.99',
                'final_price.*'    => 'required',
                'stock_quantity.*' => 'nullable',
                'image.*'          => 'nullable|mimes:jpg,jpeg,png,svg'
            ]
        );
        $picked = FoodItem::find($id);
        $picked->update(
            [
                'category_id'      => $request->category,
                'sub_category_id'  => $request->sub_category,
                'name'             => $request->name,
                'slug'             => $request->slug,
                'remark'           => $request->remark,
                'meta_title'       => $request->meta_title,
                'keyword'          => $request->keyword,
                'description'      => $request->description,
                'stock'            => $request->has('stock') ? 'Yes' : 'No',
                'inventory'        => $request->has('inventory') ? 'Yes' : 'No',
                'cod'              => $request->has('cod') ? 'Yes' : 'No',
                'home_delivery'    => $request->has('home_delivery') ? 'Yes' : 'No',
                'takeaway'         => $request->has('takeaway') ? 'Yes' : 'No',
                'delivery_time'    => $request->delivery_time
            ]
        );
        if($request->has('image')) {
            for ($i = 0; $i < count($request->image); $i++) { 
                $image_url = $request->image[$i]->store('food_gallery');
                FoodGallery::create(
                    [
                        'food_id' => $picked->id,
                        'image'   => $image_url
                    ]
                );
            }
        }
        FoodVariant::where('food_id', $picked->id)->delete();
        if($request->has('quantity')) {
            for ($i = 0; $i < count($request->quantity); $i++) { 
                FoodVariant::create(
                    [
                        'food_id'       => $picked->id,
                        'quantity_id'   => $request->quantity[$i],
                        'price'         => $request->price[$i],
                        'discount'      => $request->discount[$i],
                        'final_price'   => $request->final_price[$i],
                        'stock_quantity'=> $request->stock_quantity[$i],
                    ]
                );
            }
        }
        return redirect('admin/food/items')->with('success', 'Food Item Updated Successfully.');
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
            $picked = FoodItem::find($id);
            $picked->delete();
            return $this->success('Item Deleted Sucecssfully.', null);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }

    public function deleteFoodImage($id) {
        try{
            $picked = FoodGallery::find($id);
            Storage::delete($picked->image);
            $picked->delete();
            return $this->success('Image Deleted Sucecssfully.', null);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }

    public function changeStatus(Request $request) {
        try{
            $picked = FoodItem::find($request->id);
            $status = $picked->status == 'Yes' ? 'No' : 'Yes';
            $msg    = $picked->status == 'Yes' ? 'Item Blocked Sucecssfully.' : 'Item Activated Sucecssfully.';
            $picked->update(
                [
                    'status' => $status
                ]
            );
            return $this->success($msg, $picked);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }  

    public function addons($id)
    {
        $food = FoodItem::where('slug', $id)->first();
        $sub_categories = Category::where('parent_id', $food->category_id)->get();
        $sub_cats = [];
        $root_category = Category::find($food->category_id);
        $children = $this->getAllChildrenFoods($root_category->id, $food->id);
        $data = json_encode($children);
        return view('admin.food_items.addons', compact('food', 'data', 'root_category'));
    }

    public function getAllChildrenFoods($id, $food_id)
    {
        $food = [];
        $items = FoodItem::whereNotIn('id', [$food_id])->where('category_id', $id)->get();
        foreach ($items as $key => $item) {
           $data["id"]    = $item->id;
           $data["text"]  = $item->name;
           $data["state"] = '{ checked : true }';
           array_push($food, $data);
        }
        return $food;
    } 

    public function createAddons(Request $request)
    {
        try{
            $picked = FoodItem::find($request->food_id);
            FoodAddon::where('food_id', $picked->id)->delete();
            for ($i = 0; $i < count($request->ids); $i++) { 
                FoodAddon::create(
                    [
                        'food_id'       => $picked->id,
                        'addon_food_id' => $request->ids[$i]
                    ]
                );
            }
            return $this->success('Food Items Added Successfully.', $picked);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }
}

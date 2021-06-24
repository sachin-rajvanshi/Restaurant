<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\FoodItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Concern\GlobalTrait;

class CouponController extends Controller
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
            $coupons = Coupon::orderBy('id', 'DESC')->get();
            return Datatables::of($coupons)
                ->addIndexColumn()
                ->addColumn('date_time', function($row){
                    return $this->convertDateTime($row->created_at);
                })
                ->addColumn('category', function($row){
                    $c = [];
                    $categories = Category::withTrashed()->whereIn('id', explode(',', $row->category))->get();
                    if(count($categories) > 0) {
                        foreach ($categories as $category) {
                            array_push($c, $category->name);
                        }
                        return implode(', ', $c);
                    }else {
                        return 'N/A';
                    }
                    
                })
                ->addColumn('sub_category_data', function($row){
                    $s = [];
                    $sub_categories = Category::withTrashed()->whereIn('id', explode(',', $row->sub_category))->get();
                    if(count($sub_categories) > 0) {
                        foreach ($sub_categories as $sub_category) {
                            array_push($s, $sub_category->name);
                        }
                        return implode(', ', $s);
                    }else {
                        return 'N/A';
                    }
                })
                ->addColumn('food_items', function($row){
                    $f = [];
                    $items = FoodItem::withTrashed()->whereIn('id', explode(',', $row->food_items))->get();
                    if(count($items) > 0) {
                        foreach ($items as $item) {
                            array_push($f, $item->name);
                        }
                        return implode(', ', $f);
                    }else {
                        return 'N/A';
                    }
                    return $row->food_items ? $row->food_items : 'N/A';
                })
                ->addColumn('discount', function($row){
                    return $row->discount.' (%)';
                })
                ->addColumn('start_date', function($row){
                    return date('d M Y', strtotime($row->start_date));
                })
                ->addColumn('end_date', function($row){
                    return date('d M Y', strtotime($row->end_date));
                })
                ->addColumn('status', function($row){
                    if($row->status == 'Yes') 
                        $status = '<span class="text-info">Active</span><div class="modal fade" id="feedback'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="feedbackTitle" aria-hidden="true">';
                    else
                        $status = '<span class="text-danger">Inactive</span><div class="modal fade" id="feedback'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="feedbackTitle" aria-hidden="true">';
                    return $status;
                })
                ->addColumn('action', function($row){
                    if($row->status == 'Yes') 
                        $action = '
                            <a href="javascript:void(0)" onclick="changeStatus('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-times"></i></a>
                            <a href="'.url('admin/coupons').'/'.$row->id.'" class="btn btn-success btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-eye"></i></a>
                            <a href="'.url('admin/coupons').'/'.$row->id.'/edit" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" onclick="deleteDeal('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>';
                    else
                        $action = '
                            <a href="javascript:void(0)" onclick="changeStatus('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-check-circle"></i></a>
                            <a href="'.url('admin/coupons').'/'.$row->id.'" class="btn btn-success btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-eye"></i></a>
                            <a href="'.url('admin/coupons').'/'.$row->id.'/edit" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" onclick="deleteDeal('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>';
                    return $action;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('admin.offer_coupons.manage_coupons');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', null)->orderBy('name', 'ASC')->get();
        return view('admin.offer_coupons.create_coupon', compact('categories'));
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
                'name'           => 'required|max:150',
                'category.*'     => 'required',
                'sub_category.*' => 'nullable',
                'food_items.*'   => 'required',
                'discount'       => 'required|numeric|between:0,99.99',
                'max_discount'   => 'required|numeric',
                'min_order'      => 'required|numeric',
                'start_date'     => 'required|date',
                'end_date'       => 'required|date|after:start_date',
                'apply_for'      => 'nullable',
                'usages'         => 'required|numeric'
            ]
        );
        Coupon::create(
            [
                'name'          => $request->name,
                'category'      => implode(',', $request->category),
                'sub_category'  => $request->has('sub_category') ? implode(',', $request->sub_category) : null,
                'food_items'    => implode(',', $request->food_items),
                'discount'      => $request->discount,
                'max_discount'  => $request->max_discount,
                'min_order'     => $request->min_order,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'apply_for'     => $request->has('apply_for') ? implode(',', $request->apply_for) : null,
                'usages'        => $request->usages
            ]
        );
        return redirect('admin/coupons')->with('success', 'Coupon Added Successfully.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $picked = Coupon::find($id);
        return view('admin.offer_coupons.view_coupon', compact('picked'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $picked = Coupon::find($id);
        $categories   = Category::where('parent_id', null)->orderBy('name', 'ASC')->get();
        $sub_categories = Category::whereIn('parent_id', explode(',', $picked->category))->get();
        $food_items   = FoodItem::whereIn('category_id', explode(',', $picked->category))->get();
        return view('admin.offer_coupons.edit_coupon', compact('categories', 'picked', 'categories', 'sub_categories', 'food_items'));
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
                'name'           => 'required|max:150',
                'category.*'     => 'required',
                'sub_category.*' => 'nullable',
                'food_items.*'   => 'required',
                'discount'       => 'required|numeric|between:0,99.99',
                'max_discount'   => 'required|numeric',
                'min_order'      => 'required|numeric',
                'start_date'     => 'required|date',
                'end_date'       => 'required|date|after:start_date',
                'apply_for'      => 'nullable',
                'usages'         => 'required|numeric'
            ]
        );
        $picked = Coupon::find($id);
        $picked->update(
            [
                'name'          => $request->name,
                'category'      => implode(',', $request->category),
                'sub_category'  => $request->has('sub_category') ? implode(',', $request->sub_category) : null,
                'food_items'    => implode(',', $request->food_items),
                'discount'      => $request->discount,
                'max_discount'  => $request->max_discount,
                'min_order'     => $request->min_order,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'apply_for'     => $request->has('apply_for') ? implode(',', $request->apply_for) : null,
                'usages'        => $request->usages
            ]
        );
        return redirect('admin/coupons')->with('success', 'Coupon Updated Successfully.');
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
            $picked = Coupon::find($id);
            $picked->delete();
            return $this->success('Coupon Deleted Sucecssfully.', null);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }

    public function changeStatus(Request $request) {
        try{
            $picked = Coupon::find($request->id);
            $status = $picked->status == 'Yes' ? 'No' : 'Yes';
            $msg    = $picked->status == 'Yes' ? 'Coupon Blocked Sucecssfully.' : 'Coupon Activated Sucecssfully.';
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
}

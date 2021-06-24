<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\GalleryCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concern\GlobalTrait;

class GalleryController extends Controller
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
            $users = Gallery::orderBy('id', 'DESC')->get();
            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('date_time', function($row){
                    return $this->convertDateTime($row->created_at);
                })
                ->addColumn('category', function($row){
                    $category = GalleryCategory::find($row->category_id);
                    return $category ? $category->name : '';
                })
                ->addColumn('image', function($row){
                    if($row->image) {
                        if (Storage::exists($row->image)) 
                            $image = '<div class="table-image"><img src="'.asset('storage/'.$row->image).'"></div>';
                        else
                            $image = '<div class="table-image"><img src="'.asset('').'/admin/images/dummy.jpg"></div>';
                    }else {
                        $image = '<div class="table-image"><img src="'.asset('').'/admin/images/dummy.jpg"></div>';
                    }
                    
                    return $image;
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
                            <a href="javascript:void(0)" onclick="deleteCategory('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>';
                    return $action;
                })
                ->rawColumns(['action','status', 'image'])
                ->make(true);
        }
        return view('admin.gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = GalleryCategory::where('status', 'Yes')->get();
        return view('admin.gallery.create', compact('categories'));
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
                'image.*' => 'required|mimes:jpg,png,jpeg,svg',
                'name.*'    => 'required|max:150'
            ]
        );
        for ($i=0; $i < count($request->image); $i++) { 
            $image_url = $request->image[$i]->store('gallery');
            Gallery::create(
                [
                    'category_id'  => $request->category[$i],
                    'image'        => $image_url,
                    'name'         => $request->name[$i],
                    'remark'       => $request->remark[$i],
                    'status'        => $request->status[$i]
                ]
            );
        }
        
        return redirect('admin/gallery')->with('success', 'Gallery Added Successfully.');
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
        $picked = Gallery::find($id);
        return view('admin.gallery.edit', compact('picked'));
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
                'name'   => 'required|max:150',
                'status' => 'required'
            ]
        );
        $picked = Gallery::find($id);
        $picked->update(
            [
                'name'   => $request->name,
                'remark' => $request->remark,
                'status' => $request->status
            ]
        );
        return redirect('admin/gallery')->with('success', 'Gallery Updated Successfully.');
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
            $picked = Gallery::find($id);
            $picked->delete();
            return $this->success('Gallery Deleted Sucecssfully.', null);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }
}

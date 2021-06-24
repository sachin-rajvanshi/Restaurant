<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\GalleryCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concern\GlobalTrait;

class GalleryCategoryController extends Controller
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
            $users = GalleryCategory::orderBy('id', 'DESC')->get();
            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('date_time', function($row){
                    return $this->convertDateTime($row->created_at);
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
                ->addColumn('added_images', function($row){
                    $images = Gallery::where('category_id', $row->id)->count();
                    return $images ? $images : 0;
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
                            <a href="'.url('admin/categories/gallery').'/'.$row->id.'/edit" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" onclick="deleteCategory('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>';
                    return $action;
                })
                ->rawColumns(['action','status', 'image'])
                ->make(true);
        }
        return view('admin.gallery_category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery_category.create');
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
                'image'  => 'required|mimes:jpg,png,jpeg',
                'name'   => 'required|max:150',
                'status' => 'required'
            ]
        );
        $image_url = $request->image->store('categories');
        GalleryCategory::create(
            [
                'image'  => $image_url,
                'name'   => $request->name,
                'remark' => $request->remark,
                'status' => $request->status
            ]
        );
        return redirect('admin/categories/gallery')->with('success', 'Gallery Category Added Successfully.');
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
        $picked = GalleryCategory::find($id);
        return view('admin.gallery_category.edit', compact('picked'));
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
                'image'  => 'nullable|mimes:jpg,png,jpeg',
                'name'   => 'required|max:150',
                'status' => 'required'
            ]
        );
        $picked = GalleryCategory::find($id);
        if($request->image) {
            $image_url = $request->image->store('categories');
            Storage::delete($picked->image);
        }else {
            $image_url = $picked->image;
        }
        $picked->update(
            [
                'image'  => $image_url,
                'name'   => $request->name,
                'remark' => $request->remark,
                'status' => $request->status
            ]
        );
        return redirect('admin/categories/gallery')->with('success', 'Gallery Category Updated Successfully.');
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
            $picked = GalleryCategory::find($id);
            $picked->delete();
            return $this->success('Gallery Category Deleted Sucecssfully.', null);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }

    public function getCategories() {
        try{
            $datas = GalleryCategory::where('status', 'Yes')->get();
            return $this->success('Categories Successfully', $datas);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }
}

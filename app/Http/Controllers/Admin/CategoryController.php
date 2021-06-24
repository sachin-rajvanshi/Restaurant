<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concern\GlobalTrait;

class CategoryController extends Controller
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
            $users = Category::orderBy('id', 'DESC')->get();
            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('date_time', function($row){
                    return $this->convertDateTime($row->created_at);
                })
                ->addColumn('profile', function($row){
                    if (Storage::exists($row->image)) 
                        $image = '<div class="table-image"><img src="'.asset('storage/'.$row->image).'"><span>'.$row->name.'</span></div>';
                    else
                        $image = '<div class="table-image"><img src="'.asset('').'/admin/images/dummy.jpg"><span>'.$row->name.'</span></div>';
                    return $image;
                })
                ->addColumn('sub_categories_count', function($row){
                    $count = Category::where('id', $row->parent_id)->count();
                    return $count;
                })
                ->addColumn('parent_name', function($row){
                    $parent = Category::where('id', $row->parent_id)->first();
                    return $parent ? $parent->name : '';
                })
                ->addColumn('remark', function($row){
                    $remark = '<span class="more-text">'.$row->remark.'</span>';
                    return $remark;
                })
                ->addColumn('meta_title', function($row){
                    $meta_title = '<span class="more-text">'.$row->meta_title.'</span>';
                    return $meta_title;
                })
                ->addColumn('meta_keywords', function($row){
                    $meta_keywords = '<span class="more-text">'.$row->meta_keywords.'</span>';
                    return $meta_keywords;
                })
                ->addColumn('meta_description', function($row){
                    $meta_description = '<span class="more-text">'.$row->meta_Description.'</span>';
                    return $meta_description;
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
                            <a href="'.url('admin/manage/sub/categories').'/'.base64_encode($row->id).'" class="btn btn-info btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-plus"></i></a>
                            <a href="'.url('admin/category').'/'.$row->slug.'" class="btn btn-success btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-eye"></i></a>
                            <a href="'.url('admin/category').'/'.$row->slug.'/edit" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" onclick="deleteCategory('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>';
                    }else {
                        $action = '
                            <a href="javascript:void(0)" onclick="changeStatus('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-check-circle"></i></a>
                            <a href="'.url('admin/manage/sub/categories').'/'.base64_encode($row->id).'" class="btn btn-info btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-plus"></i></a>
                            <a href="'.url('admin/category').'/'.$row->slug.'" class="btn btn-success btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-eye"></i></a>
                            <a href="'.url('admin/category').'/'.$row->slug.'/edit" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" onclick="deleteCategory('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>';
                    }
                    return $action;
                })
                ->rawColumns(['action', 'remark', 'meta_title', 'meta_keywords', 'meta_description', 'status', 'profile'])
                ->make(true);
        }
        return view('admin.category.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageSubCategories(Request $request, $parent_id)
    {  
        $p_id = base64_decode($parent_id);
        if ($request->ajax()) {
            $users = Category::where('parent_id', $p_id)->orderBy('id', 'DESC')->get();
            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('date_time', function($row){
                    return $this->convertDateTime($row->created_at);
                })
                ->addColumn('profile', function($row){
                    if (Storage::exists($row->image)) 
                        $image = '<div class="table-image"><img src="'.asset('storage/'.$row->image).'"><span>'.$row->name.'</span></div>';
                    else
                        $image = '<div class="table-image"><img src="'.asset('').'/admin/images/dummy.jpg"><span>'.$row->name.'</span></div>';
                    return $image;
                })
                ->addColumn('sub_categories_count', function($row){
                    $count = Category::where('id', $row->parent_id)->count();
                    return $count;
                })
                ->addColumn('parent_name', function($row){
                    $parent = Category::where('id', $row->parent_id)->first();
                    return $parent ? $parent->name : '';
                })
                ->addColumn('remark', function($row){
                    $remark = '<span class="more-text">'.$row->remark.'</span>';
                    return $remark;
                })
                ->addColumn('meta_title', function($row){
                    $meta_title = '<span class="more-text">'.$row->meta_title.'</span>';
                    return $meta_title;
                })
                ->addColumn('meta_keywords', function($row){
                    $meta_keywords = '<span class="more-text">'.$row->meta_keywords.'</span>';
                    return $meta_keywords;
                })
                ->addColumn('meta_description', function($row){
                    $meta_description = '<span class="more-text">'.$row->meta_Description.'</span>';
                    return $meta_description;
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
                            <a href="'.url('admin/manage/sub/categories').'/'.base64_encode($row->id).'" class="btn btn-info btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-plus"></i></a>
                            <a href="'.url('admin/category').'/'.$row->slug.'" class="btn btn-success btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-eye"></i></a>
                            <a href="'.url('admin/category').'/'.$row->slug.'/edit" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" onclick="deleteCategory('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>';
                    }else {
                        $action = '
                            <a href="javascript:void(0)" onclick="changeStatus('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-check-circle"></i></a>
                            <a href="'.url('admin/manage/sub/categories').'/'.base64_encode($row->id).'" class="btn btn-info btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-plus"></i></a>
                            <a href="'.url('admin/category').'/'.$row->slug.'" class="btn btn-success btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-eye"></i></a>
                            <a href="'.url('admin/category').'/'.$row->slug.'/edit" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" onclick="deleteCategory('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>';
                    }
                    return $action;
                })
                ->rawColumns(['action', 'remark', 'meta_title', 'meta_keywords', 'meta_description', 'status', 'profile'])
                ->make(true);
        }
        return view('admin.category.sub_categories', compact('p_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.category.create', compact('categories'));
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
                'name'             => 'required|max:150',
                'slug'             => 'required|unique:categories',
                'parent_id'        => 'nullable|integer',
                'remark'           => 'nullable|max:800',
                'meta_title'       => 'required|max:150',
                'meta_keywords'    => 'required|max:500',
                'meta_description' => 'required',
                'image'            => 'required|mimes:jpg,jpeg,png,svg'
            ]
        );
        $image_url = $request->image->store('categories');
        Category::create(
            [
                'parent_id'        => $request->parent_id,
                'image'            => $image_url,
                'name'             => $request->name,
                'slug'             => $request->slug,
                'remark'           => $request->remark,
                'meta_title'       => $request->meta_title,
                'meta_keywords'    => $request->meta_keywords,
                'meta_Description' => $request->meta_description,
            ]
        );
        return redirect('admin/category')->with('success', 'Category Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::where('slug', $id)->first();
        return view('admin.category.view', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category   = Category::where('slug', $id)->first();
        $categories = Category::whereNotIn('id', [$category->id])->get();
        return view('admin.category.edit', compact('category', 'categories'));
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
                'name'             => 'required|max:150',
                'slug'             => 'required|unique:categories,slug,'.$id,
                'parent_id'        => 'nullable|integer',
                'remark'           => 'nullable|max:800',
                'meta_title'       => 'required|max:150',
                'meta_keywords'    => 'required|max:500',
                'meta_description' => 'required',
                'image'            => 'nullable|mimes:jpg,jpeg,png,svg'
            ]
        );
        $picked = Category::find($id);
        if($request->has('image')) {
            $image_url = $request->image->store('categories');
            Storage::delete($picked->image);
        }else {
            $image_url = $picked->image;
        }
        
        $picked->update(
            [
                'parent_id'        => $request->parent_id,
                'image'            => $image_url,
                'name'             => $request->name,
                'slug'             => $request->slug,
                'remark'           => $request->remark,
                'meta_title'       => $request->meta_title,
                'meta_keywords'    => $request->meta_keywords,
                'meta_Description' => $request->meta_description,
            ]
        );
        return redirect('admin/category')->with('success', 'Category Updated Successfully.');
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
            $picked = Category::find($id);
            $picked->delete();
            return $this->success('Category Deleted Sucecssfully.', null);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }

    public function changeStatus(Request $request) {
        try{
            $picked = Category::find($request->id);
            $status = $picked->status == 'Yes' ? 'No' : 'Yes';
            $msg    = $picked->status == 'Yes' ? 'Category Blocked Sucecssfully.' : 'Category Activated Sucecssfully.';
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

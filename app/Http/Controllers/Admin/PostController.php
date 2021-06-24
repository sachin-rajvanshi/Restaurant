<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concern\GlobalTrait;

class PostController extends Controller
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
            $users = Post::orderBy('id', 'DESC')->get();
            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('date_time', function($row){
                    return $this->convertDateTime($row->created_at);
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
                            <a href="'.url('admin/post').'/'.$row->id.'/edit" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" onclick="deleteCategory('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>';
                    return $action;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('admin.post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
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
                'name'   => 'required|max:150',
                'status' => 'required'
            ]
        );
        Post::create(
            [
                'name'   => $request->name,
                'remark' => $request->remark,
                'status' => $request->status
            ]
        );
        return redirect('admin/post')->with('success', 'Post Added Successfully.');
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
        $picked = Post::find($id);
        return view('admin.post.edit', compact('picked'));
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
        $picked = Post::find($id);
        $picked->update(
            [
                'name'   => $request->name,
                'remark' => $request->remark,
                'status' => $request->status
            ]
        );
        return redirect('admin/post')->with('success', 'Post Updated Successfully.');
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
            $picked = Post::find($id);
            $picked->delete();
            return $this->success('Post Deleted Sucecssfully.', null);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }
}

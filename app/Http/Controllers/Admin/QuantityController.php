<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Quantity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concern\GlobalTrait;

class QuantityController extends Controller
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
            $users = Quantity::orderBy('id', 'DESC')->get();
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
                            <a href="'.url('admin/quantity').'/'.$row->id.'/edit" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" onclick="deleteCategory('.$row->id.')" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light"><i class="far fa-trash-alt"></i></a>';
                    return $action;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('admin.quantity.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quantity.create');
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
                'type'   => 'required|max:150',
                'status' => 'required'
            ]
        );
        Quantity::create(
            [
                'type'   => $request->type,
                'remark' => $request->remark,
                'status' => $request->status
            ]
        );
        return redirect('admin/quantity')->with('success', 'Quantity Added Successfully.');
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
        $picked = Quantity::find($id);
        return view('admin.quantity.edit', compact('picked'));
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
                'type'   => 'required|max:150',
                'status' => 'required'
            ]
        );
        $picked = Quantity::find($id);
        $picked->update(
            [
                'type'   => $request->type,
                'remark' => $request->remark,
                'status' => $request->status
            ]
        );
        return redirect('admin/quantity')->with('success', 'Quantity Updated Successfully.');
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
            $picked = Quantity::find($id);
            $picked->delete();
            return $this->success('Quantity Deleted Sucecssfully.', null);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }
}

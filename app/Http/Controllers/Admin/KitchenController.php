<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\Kitchen;
use App\Models\SmsHistory;
use App\Models\EmailHistory;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concern\GlobalTrait;

class KitchenController extends Controller
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
            $datas = Kitchen::orderBy('id', 'DESC')->get();
            return Datatables::of($datas)
                ->addIndexColumn()
                ->addColumn('date_time', function($row){
                    return $this->convertDateTime($row->created_at);
                })
                ->addColumn('branch', function($row){
                    $user = User::find($row->branch_id);
                    return $user ? $user->name : '';
                })
                ->addColumn('status', function($row){
                    if($row->status == 'Yes') 
                        $status = '<span class="text-info">Active</span><div class="modal fade" id="feedback'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="feedbackTitle" aria-hidden="true">';
                    else
                        $status = '<span class="text-danger">Inactive</span><div class="modal fade" id="feedback'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="feedbackTitle" aria-hidden="true">';
                    return $status;
                })
                ->addColumn('action', function($row){
                    $action = '<a href="'.url('admin/kitchen').'/'.$row->id.'/edit" class="btn btn-primary btn-sm-custom waves-effect waves-float waves-light"><i class="fas fa-pencil-alt"></i></a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm-custom waves-effect waves-float waves-light" onclick="deleteKitchen('.$row->id.')"><i class="far fa-trash-alt"></i></a>';
                    return $action;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.kitchen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = User::orderBy('name', 'ASC')->get();
        return view('admin.kitchen.create', compact('branches'));
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
                'branch'    => 'required|integer',
                'name'      => 'required|max:150',
                'chef_name' => 'required|max:150',
                'status'    => 'required'
            ]
        );
        Kitchen::create(
            [
                'branch_id' => $request->branch,
                'name'      => $request->name,
                'chef_name' => $request->chef_name,
                'status'    => $request->status
            ]
        );
        return redirect('admin/kitchen')->with('success', 'Kitchen Added Successfully.');
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
        $branches = User::orderBy('name', 'ASC')->get();
        $kitchen  = Kitchen::find($id);
        return view('admin.kitchen.edit', compact('branches', 'kitchen'));
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
                'branch'    => 'required|integer',
                'name'      => 'required|max:150',
                'chef_name' => 'required|max:150',
                'status'    => 'required'
            ]
        );
        $picked = Kitchen::find($id);
        $picked->update(
            [
                'branch_id' => $request->branch,
                'name'      => $request->name,
                'chef_name' => $request->chef_name,
                'status'    => $request->status
            ]
        );
        return redirect('admin/kitchen')->with('success', 'Kitchen Updated Successfully.');
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
            $picked = Kitchen::find($id);
            $picked->delete();
            return $this->success('Kitchen Deleted Sucecssfully.', null);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }
}

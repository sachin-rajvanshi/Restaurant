<?php

namespace App\Http\Controllers\User;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\AddressBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Concern\GlobalTrait;

class AddressBookController extends Controller
{
    use GlobalTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::get();
        $address_books = AddressBook::orderBy('id', 'DESC')->paginate(10);
        return view('user.manage-address-book', compact('countries', 'address_books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'address'       => 'required|max:190',
                'mobile_number' => 'required|numeric|digits_between:10, 15',   
                'country'       => 'required|integer',   
                'state'         => 'required|integer',   
                'city'          => 'required|integer',   
                'pincode'       => 'required|numeric|digits_between:6, 8',   
                'address_type'  => 'required',  
            ]
        );
        $picked = AddressBook::where('user_id', \Auth::id())
            ->where('type', $request->address_type)
            ->where('set_as_default', 'Yes')->first();
        if($picked) {
            if($request->set_as_default == 'Yes') {
                $picked->update(
                    [
                        'set_as_default' => 'No',
                    ]
                );
            }
            $default = $request->set_as_default;
        }else {
            $default = $request->set_as_default;
        }
        AddressBook::create(
            [
                'user_id'       => \Auth::id(),
                'type'          => $request->address_type,
                'country_id'    => $request->country,
                'state_id'      => $request->state,
                'city_id'       => $request->city,
                'address'       => $request->address,
                'pincode'       => $request->pincode,
                'mobile_number' => $request->mobile_number,
                'set_as_default'=> $default
            ]
        );
        return redirect()->back()->with('success', 'Addess Added Successfully.');
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
        $picked = AddressBook::find($id);
        $countries = Country::get();
        $states    = State::where('country_id', $picked->country_id)->orderBy('name', 'ASC')->get();
        $cities    = City::where('state_id', $picked->state_id)->orderBy('name', 'ASC')->get();
        return view('user.edit-address-book', compact('countries', 'picked', 'states', 'cities'));
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
                'address'       => 'required|max:190',
                'mobile_number' => 'required|numeric|digits_between:10, 15',   
                'country'       => 'required|integer',   
                'state'         => 'required|integer',   
                'city'          => 'required|integer',   
                'pincode'       => 'required|numeric|digits_between:6, 8',   
                'address_type'  => 'required',  
            ]
        );
        $picked = AddressBook::find($id);
        $check  = AddressBook::where('user_id', \Auth::id())
            ->where('type', $request->address_type)
            ->where('set_as_default', 'Yes')->first();
        if($check) {
            if($request->set_as_default == 'Yes') {
                $check->update(
                    [
                        'set_as_default' => 'No',
                    ]
                );
            }
            $default = $request->set_as_default;
        }else {
            $default = $request->set_as_default;
        }
        $picked->update(
            [
                'type'          => $request->address_type,
                'country_id'    => $request->country,
                'state_id'      => $request->state,
                'city_id'       => $request->city,
                'address'       => $request->address,
                'pincode'       => $request->pincode,
                'mobile_number' => $request->mobile_number,
                'set_as_default'=> $default
            ]
        );
        return redirect('user/address/book')->with('success', 'Addess Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setAsDefault($id) {
        try{
            $picked = AddressBook::find($id);
            $picked->update(
                [
                    'set_as_default' => 'Yes'
                ]
            );
            AddressBook::whereNotIn('id', [$picked->id])->where('user_id', \Auth::id())->where('type', $picked->type)->update(
                [
                    'set_as_default' => 'No'
                ]
            );
            $msg = 'Address Set As Default';
            return $this->success($msg, $picked);
        }catch(\Exception $e) {
            return $this->error($e, null);
        }
    }   
}

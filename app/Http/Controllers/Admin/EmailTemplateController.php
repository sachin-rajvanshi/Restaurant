<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EmailTemplateController extends Controller
{
    /**
     * Manage Email Template Listing
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = EmailTemplate::paginate(10);
        return view('admin.email_templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.email_templates.create');
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
                'file'       => 'nullable|mimes:jpg,png,jpeg,svg',
                'name'       => 'required|max:200',
                'subject'    => 'required|max:200',
                'description'=> 'required'
            ]
        );
        $image_url = $request->has('file') ? $request->file->store('templates') : null;
        EmailTemplate::create(
            [
                'image'      => $image_url,
                'name'       => $request->name,
                'code'       => $request->code,
                'subject'    => $request->subject,
                'template'   => $request->description,
                'status'     => $request->status,
                'button'     => $request->button == 'Yes' ? true : false ,
                'button_html'=> $request->button_html,
            ]
        );
        return redirect('admin/email/template')->with('success', 'Email Template Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $picked = EmailTemplate::find($id);
        return view('admin.email_templates.edit', compact('picked'));
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
                'file'       => 'nullable|mimes:jpg,png,jpeg,svg',
                'name'       => 'required|max:200',
                'subject'    => 'required|max:200',
                'description'=> 'required'
            ]
        );
        $picked = EmailTemplate::find($id);
        if($request->has('file')) {
            $image_url =  $request->file->store('templates');
            Storage::delete($picked->image);
        }else {
            $image_url = $picked->image;
        }
        $picked->update(
            [
                'image'     => $image_url,
                'name'      => $request->name,
                'subject'   => $request->subject,
                'template'  => $request->description,
                'status'    => $request->status,
                'button'     => $request->button == 'Yes' ? true : false ,
                'button_html'=> $request->button_html,
            ]
        );
        return redirect('admin/email/template')->with('success', 'Email Template Updated Successfully.');
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
}

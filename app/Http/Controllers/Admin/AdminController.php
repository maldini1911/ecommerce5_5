<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\AdminDatatables;
use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDatatables $admin)
    {
        return $admin->render('admin.admins.index', ['title' => 'Admin Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create', ['title' => trans('admin.Create_Admin')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
       $data = $this->validate(request(), [
           'name'       => 'required',
           'email'      => 'required|email|unique:admins',
           'password'   => 'required'
       ], [], [
           'name'       => trans('admin.name'),
           'email'      => trans('admin.email'),
           'password'   => trans('admin.password')
       ]);

       $data['password'] = bcrypt(request('password'));
       Admin::create($data);
       session()->flash('success', trans('admin.success_add'));
       return back();

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
        $admin = Admin::find($id);
        $title = trans('admin.admin_edit');
        return view('admin.admins.edit', compact('admin', 'title'));
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
        $data = $this->validate(request(), [
            'name'       => 'required',
            'email'      => 'required|email|unique:admins,email,'.$id,
            'password'   => 'sometimes|nullable'
        ], [], [
            'name'       => trans('admin.name'),
            'email'      => trans('admin.email'),
            'password'   => trans('admin.password')
        ]);
 
        if(request()->has('password')){
            $data['password'] = bcrypt(request('password'));
        }
        
        Admin::where('id', $id)->update($data);
        session()->flash('update', trans('admin.success_edit'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Admin::find($id);
        $del->delete();
        return back();
    }

    public function multi_delete(){

        if(is_array(request('item'))){

            Admin::destroy(request('item'));

        }else{

            Admin::find(request('item'))->delete();

        }

        return back();
    }
}

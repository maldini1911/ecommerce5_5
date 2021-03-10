<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\UserDatatables;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDatatables $admin)
    {
        return $admin->render('admin.users.index', ['title' => trans('admin.users')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', ['title' => trans('admin.Create_Admin')]);
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
           'password'   => 'required',
           'level'      => 'required|in:user,company,vendor'
       ], [], [
           'name'       => trans('admin.name'),
           'email'      => trans('admin.email'),
           'password'   => trans('admin.password'),
           'level'   => trans('admin.level')
       ]);

       $data['password'] = bcrypt(request('password'));
       User::create($data);
       session()->flash('success', trans('admin.success_add'));
       return redirect('users');

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
        $user = User::find($id);
        $title = trans('admin.admin_edit');
        return view('admin.users.edit', compact('user', 'title'));
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
            'email'      => 'required|email|unique:users,email,'.$id,
            'password'   => 'sometimes|nullable',
            'level'      => 'required|in:user,company,vendor'
        ], [], [
            'name'       => trans('admin.name'),
            'email'      => trans('admin.email'),
            'password'   => trans('admin.password'),
            'level'   => trans('admin.level')
        ]);
 
        if(request()->has('password')){
            $data['password'] = bcrypt(request('password'));
        }
        
        User::where('id', $id)->update($data);
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
        $del = User::find($id);
        $del->delete();
        return back();
    }

    public function multi_delete(){

        if(is_array(request('item'))){

            User::destroy(request('item'));

        }else{

            User::find(request('item'))->delete();

        }

        return back();
    }
}

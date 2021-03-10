<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\StateDatatables;
use Illuminate\Http\Request;
use App\State;
use Storage;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StateDatatables $state)
    {
        return $state->render('admin.states.index', ['title' => trans('admin.states')]);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.states.create', ['title' => trans('admin.add')]);
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
           'state_name_ar'        => 'required',
           'state_name_en'        => 'required',
           'city_id'              => 'required',
           'country_id'           => 'required'
       ], [], [
           'state_name_ar'       => trans('admin.state_name_ar'),
           'state_name_en'       => trans('admin.state_name_en'),
           'city_id'             => trans('admin.city_name'),
           'country_id'             => trans('admin.country_name')
       ]);

       State::create($data);
       session()->flash('success', trans('admin.success_add'));
       return redirect('states');

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
        $state = State::find($id);
        $title = trans('admin.edit');
        return view('admin.states.edit', compact('state', 'title'));
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
            'state_name_ar'        => 'required',
            'state_name_en'        => 'required',
            'city_id'              => 'required',
            'country_id'           => 'required'
        ], [], [
            'state_name_ar'       => trans('admin.state_name_ar'),
            'state_name_en'       => trans('admin.state_name_en'),
            'city_id'             => trans('admin.city_name'),
            'country_id'             => trans('admin.country_name')
        ]);

        State::where('id', $id)->update($data);
        session()->flash('success', trans('admin.success_edit'));
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
        $del = State::find($id);
        Storage::delete($del->logo);
        $del->delete();
        return back();
    }

    public function multi_delete(){

        if(is_array(request('item'))){
            foreach(request('item') as $id){
                $del = State::find($id);
                Storage::delete($del->logo);
                $del->delete();
                return back();
            }
          

        }else{

                $del = State::find(request('item'));
                Storage::delete($del->logo);
                $del->delete();
                return back();

        }

        return back();
    }
}

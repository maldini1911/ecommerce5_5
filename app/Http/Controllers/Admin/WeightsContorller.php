<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\WeightDatatables;
use Illuminate\Http\Request;
use App\Weight;
use Storage;

class WeightsContorller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WeightDatatables $weight)
    {
        return $weight->render('admin.weights.index', ['title' => trans('admin.weights')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.weights.create', ['title' => trans('admin.add')]);
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
            'name_ar'             => 'required',
            'name_en'             => 'required',
        ], [], [
            'name_ar'             => trans('admin.name_ar'),
            'name_en'             => trans('admin.name_en'),
        ]);

  
       Weight::create($data);
       session()->flash('success', trans('admin.success_add'));
       return redirect('weights');

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
        $weight = Weight::find($id);
        $title = trans('admin.edit');
        return view('admin.weights.edit', compact('weight', 'title'));
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
            'name_ar'             => 'required',
            'name_en'             => 'required',
        ], [], [
            'name_ar'             => trans('admin.name_ar'),
            'name_en'             => trans('admin.name_en'),
        ]);
 
        Weight::where('id', $id)->update($data);
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
        $del = Weight::find($id);
        $del->delete();
        return back();
    }

    public function multi_delete(){

        if(is_array(request('item'))){
            foreach(request('item') as $id){
                $del = Weight::find($id);
                $del->delete();
            }
          

        }else{

                $del = Weight::find(request('item'));
                $del->delete();
        }

        return back();
    }
}

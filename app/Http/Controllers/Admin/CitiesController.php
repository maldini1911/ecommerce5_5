<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\CityDatatables;
use Illuminate\Http\Request;
use App\City;
use Storage;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CityDatatables $city)
    {
        return $city->render('admin.cities.index', ['title' => trans('admin.countries')]);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.create', ['title' => trans('admin.add')]);
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
           'city_name_ar'        => 'required',
           'city_name_en'        => 'required',
           'country_id'          => 'required'
       ], [], [
           'city_name_ar'       => trans('admin.city_name_ar'),
           'city_name_en'       => trans('admin.city_name_en'),
           'country_id'         => trans('admin.city_name')
       ]);

       City::create($data);
       session()->flash('success', trans('admin.success_add'));
       return redirect('cities');

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
        $city = Country::find($id);
        $title = trans('admin.edit');
        return view('admin.cities.edit', compact('city', 'title'));
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
            'city_name_ar'        => 'required',
            'city_name_en'        => 'required',
            'country_id'             => 'required'
        ], [], [
            'city_name_ar'       => trans('admin.city_name_ar'),
            'city_name_en'       => trans('admin.city_name_en'),
            'country_id'            => trans('admin.country_name')
        ]);

        City::where('id', $id)->update($data);
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
        $del = City::find($id);
        Storage::delete($del->logo);
        $del->delete();
        return back();
    }

    public function multi_delete(){

        if(is_array(request('item'))){
            foreach(request('item') as $id){
                $del = City::find($id);
                Storage::delete($del->logo);
                $del->delete();
                return back();
            }
          

        }else{

                $del = City::find(request('item'));
                Storage::delete($del->logo);
                $del->delete();
                return back();

        }

        return back();
    }
}

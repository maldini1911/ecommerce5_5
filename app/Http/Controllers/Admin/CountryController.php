<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\CountriesDatatables;
use Illuminate\Http\Request;
use App\Country;
use Storage;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountriesDatatables $admin)
    {
        return $admin->render('admin.countries.index', ['title' => trans('admin.countries')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.countries.create', ['title' => trans('admin.add')]);
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
           'country_name_ar'        => 'required',
           'country_name_en'        => 'required',
           'mob'                    => 'required',
           'code'                   => 'required',
           'currency'               => 'required',
           'logo'                   => 'required|'.validate_image()
       ], [], [
           'country_name_ar'       => trans('admin.country_name_ar'),
           'country_name_en'       => trans('admin.country_name_en'),
           'mob'                   => trans('admin.mob'),
           'code'                  => trans('admin.code'),
           'currency'              => trans('admin.currency'),
           'logo'                  => trans('admin.country_logo')
       ]);

       if(request()->hasFile('logo')){
        $data['logo'] = Up()->Upload([
            'file' => 'logo',
            'path' => 'countries',
            'upload_type' => 'single',
            'delete_file'=>''
        ]);
    }
       Country::create($data);
       session()->flash('success', trans('admin.success_add'));
       return redirect('countries');

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
        $country = Country::find($id);
        $title = trans('admin.edit');
        return view('admin.countries.edit', compact('country', 'title'));
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
            'country_name_ar'        => 'required',
            'country_name_en'        => 'required',
            'mob'                    => 'required',
            'code'                   => 'required',
            'currency'               => 'required',
            'logo'                   => 'sometimes|nullable|'.validate_image()
        ], [], [
            'country_name_ar'       => trans('admin.country_name_ar'),
            'country_name_en'       => trans('admin.country_name_en'),
            'mob'                   => trans('admin.mob'),
            'code'                  => trans('admin.code'),
            'currency'              => trans('admin.currency'),
            'logo'                  => trans('admin.country_logo')
        ]);
 
        if(request()->hasFile('logo')){
         $data['logo'] = Up()->Upload([
             'file'         => 'logo',
             'path'         => 'countries',
             'upload_type'  => 'single',
             'delete_file'  => Country::find($id)->logo,
         ]);
     }
        Country::where('id', $id)->update($data);
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
        $del = Country::find($id);
        Storage::delete($del->logo);
        $del->delete();
        return back();
    }

    public function multi_delete(){

        if(is_array(request('item'))){
            foreach(request('item') as $id){
                $del = Country::find($id);
                Storage::delete($del->logo);
                $del->delete();
                return back();
            }
          

        }else{

                $del = Country::find(request('item'));
                Storage::delete($del->logo);
                $del->delete();
                return back();

        }

        return back();
    }
}

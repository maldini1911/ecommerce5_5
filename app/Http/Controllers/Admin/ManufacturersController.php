<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ManufacturersDatatables;
use Illuminate\Http\Request;
use App\Manufacturers;
use Storage;

class ManufacturersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManufacturersDatatables $manufacturers)
    {
        return $manufacturers->render('admin.manufacturers.index', ['title' => trans('admin.manufacturers')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manufacturers.create', ['title' => trans('admin.add')]);
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
           'contact_name'        => 'sometimes|nullable|string',
           'facebook'            => 'sometimes|nullable|url',
           'twitter'             => 'sometimes|nullable|url',
           'website'             => 'sometimes|nullable|url',
           'email'               => 'sometimes|nullable|email',
           'mobile'              => 'sometimes|nullable',
           'lat'                 => 'sometimes|nullable',
           'lng'                 => 'sometimes|nullable',
           'address'             => 'sometimes|nullable',
           'icon'                =>  validate_image()
       ], [], [
           'name_ar'             => trans('admin.name_ar'),
           'name_en'             => trans('admin.name_en'),
           'contact_name'        => trans('admin.contact_name'),
           'facebook'            => trans('admin.facebook'),
           'twitter'             => trans('admin.twitter'),
           'website'             => trans('admin.website'),
           'email'               => trans('admin.email'),
           'mobile'              => trans('admin.mobile'),
           'lat'                 => trans('admin.lat'),
           'lng'                 => trans('admin.lng'),
           'icon'               => trans('admin.icon')
       ]);

       if(request()->hasFile('icon')){
        $data['icon'] = Up()->Upload([
            'file' => 'logo',
            'path' => 'manufacturers',
            'upload_type' => 'single',
            'delete_file'=>''
        ]);
    }
       Manufacturers::create($data);
       session()->flash('success', trans('admin.success_add'));
       return redirect('manufacturers');

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
        $manufacts = Manufacturers::find($id);
        $title = trans('admin.edit');
        return view('admin.manufacturers.edit', compact('manufacts', 'title'));
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
            'contact_name'        => 'sometimes|nullable|string',
            'facebook'            => 'sometimes|nullable|url',
            'twitter'             => 'sometimes|nullable|url',
            'website'             => 'sometimes|nullable|url',
            'email'               => 'sometimes|nullable|email',
            'mobile'              => 'sometimes|nullable',
            'lat'                 => 'sometimes|nullable',
            'lng'                 => 'sometimes|nullable',
            'address'             => 'sometimes|nullable',
            'icon'                =>  validate_image()
        ], [], [
            'name_ar'             => trans('admin.name_ar'),
            'name_en'             => trans('admin.name_en'),
            'contact_name'        => trans('admin.contact_name'),
            'facebook'            => trans('admin.facebook'),
            'twitter'             => trans('admin.twitter'),
            'website'             => trans('admin.website'),
            'email'               => trans('admin.email'),
            'mobile'              => trans('admin.mobile'),
            'lat'                 => trans('admin.lat'),
            'lng'                 => trans('admin.lng'),
            'icon'               => trans('admin.icon')
        ]);
 
        if(request()->hasFile('icon')){
         $data['icon'] = Up()->Upload([
             'file' => 'icon',
             'path' => 'manufacturers',
             'upload_type' => 'single',
             'delete_file'=>Manufacturersk::find($id)->icon,
         ]);
     }
     Manufacturers::where('id', $id)->update($data);
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
        $del = Manufacturers::find($id);
        Storage::delete($del->logo);
        $del->delete();
        return back();
    }

    public function multi_delete(){

        if(is_array(request('item'))){
            foreach(request('item') as $id){
                $del = Manufacturers::find($id);
                Storage::delete($del->logo);
                $del->delete();
                return back();
            }
          

        }else{

                $del = Manufacturers::find(request('item'));
                Storage::delete($del->logo);
                $del->delete();
                return back();

        }

        return back();
    }
}

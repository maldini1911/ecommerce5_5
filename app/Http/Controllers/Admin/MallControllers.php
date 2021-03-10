<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\MallDatatables;
use Illuminate\Http\Request;
use App\Mall;
use Storage;

class MallControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MallDatatables $mall)
    {
        return $mall->render('admin.malls.index', ['title' => trans('admin.malls')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.malls.create', ['title' => trans('admin.add')]);
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
            'icon'                =>  validate_image(),
            'country_id'          => 'required',
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
            'icon'               => trans('admin.icon'),
            'country_id'         => trans('admin.country'),
        ]);

       if(request()->hasFile('icon')){
        $data['icon'] = Up()->Upload([
            'file' => 'logo',
            'path' => 'malls',
            'upload_type' => 'single',
            'delete_file'=>''
        ]);
    }
       Mall::create($data);
       session()->flash('success', trans('admin.success_add'));
       return redirect('malls');

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
        $mall = Mall::find($id);
        $title = trans('admin.edit');
        return view('admin.malls.edit', compact('mall', 'title'));
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
            'icon'                =>  validate_image(),
            'country_id'          => 'required',
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
            'icon'               => trans('admin.icon'),
            'country_id'         => trans('admin.country'),
        ]);
 
        if(request()->hasFile('icon')){
         $data['icon'] = Up()->Upload([
             'file' => 'icon',
             'path' => 'malls',
             'upload_type' => 'single',
             'delete_file'=>Mall::find($id)->icon,
         ]);
     }
        Mall::where('id', $id)->update($data);
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
        $del = Mall::find($id);
        Storage::delete($del->logo);
        $del->delete();
        return back();
    }

    public function multi_delete(){

        if(is_array(request('item'))){
            foreach(request('item') as $id){
                $del = Mall::find($id);
                Storage::delete($del->logo);
                $del->delete();
                return back();
            }
          

        }else{

                $del = Mall::find(request('item'));
                Storage::delete($del->logo);
                $del->delete();
                return back();

        }

        return back();
    }
}

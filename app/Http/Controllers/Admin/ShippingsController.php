<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ShippingsDatatables;
use Illuminate\Http\Request;
use App\Shipping;
use Storage;

class ShippingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingsDatatables $shippings)
    {
        return $shippings->render('admin.shippings.index', ['title' => trans('admin.shippings')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shippings.create', ['title' => trans('admin.add')]);
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
           'user_id'             => 'required',
           'lat'                 => 'sometimes|nullable',
           'lng'                 => 'sometimes|nullable',
           'icon'                =>  validate_image()
       ], [], [
           'name_ar'             => trans('admin.name_ar'),
           'name_en'             => trans('admin.name_en'),
           'user_id'            => trans('admin.oner'),
           'lat'                 => trans('admin.lat'),
           'lng'                 => trans('admin.lng'),
           'icon'                => trans('admin.icon')
       ]);

       if(request()->hasFile('icon')){
        $data['icon'] = Up()->Upload([
            'file' => 'icon',
            'path' => 'shippings',
            'upload_type' => 'single',
            'delete_file'=>''
        ]);
    }
       Shipping::create($data);
       session()->flash('success', trans('admin.success_add'));
       return redirect('shippings');

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
        $shipp = Shipping::find($id);
        $title = trans('admin.edit');
        return view('admin.shippings.edit', compact('shipp', 'title'));
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
            'user_id'             => 'required',
            'lat'                 => 'sometimes|nullable',
            'lng'                 => 'sometimes|nullable',
            'icon'                =>  validate_image()
        ], [], [
            'name_ar'             => trans('admin.name_ar'),
            'name_en'             => trans('admin.name_en'),
            'user_id'            => trans('admin.oner'),
            'lat'                 => trans('admin.lat'),
            'lng'                 => trans('admin.lng'),
            'icon'                => trans('admin.icon')
        ]);
 
        if(request()->hasFile('icon')){
         $data['icon'] = Up()->Upload([
             'file' => 'icon',
             'path' => 'shippings',
             'upload_type' => 'single',
             'delete_file'=>Shipping::find($id)->icon,
         ]);
     }
        Shipping::where('id', $id)->update($data);
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
        $del = Shipping::find($id);
        Storage::delete($del->logo);
        $del->delete();
        return back();
    }

    public function multi_delete(){

        if(is_array(request('item'))){
            foreach(request('item') as $id){
                $del = Shipping::find($id);
                Storage::delete($del->logo);
                $del->delete();
                return back();
            }
          

        }else{

                $del = Shipping::find(request('item'));
                Storage::delete($del->logo);
                $del->delete();
                return back();

        }

        return back();
    }
}

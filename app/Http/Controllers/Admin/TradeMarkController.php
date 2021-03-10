<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\TradeMarkDatatables;
use Illuminate\Http\Request;
use App\TradeMark;
use Storage;

class TradeMarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TradeMarkDatatables $trade)
    {
        return $trade->render('admin.trademarks.index', ['title' => trans('admin.trademarks')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trademarks.create', ['title' => trans('admin.add')]);
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
           'name_ar'        => 'required',
           'name_en'        => 'required',
           'logo'           => 'required|'.validate_image()
       ], [], [
           'name_ar'       => trans('admin.name_ar'),
           'name_en'       => trans('admin.name_en'),
           'logo'          => trans('admin.trade_logo')
       ]);

       if(request()->hasFile('logo')){
        $data['logo'] = Up()->Upload([
            'file' => 'logo',
            'path' => 'trademarks',
            'upload_type' => 'single',
            'delete_file'=>''
        ]);
    }
       TradeMark::create($data);
       session()->flash('success', trans('admin.success_add'));
       return redirect('trademarks');

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
        $trademark = TradeMark::find($id);
        $title = trans('admin.edit');
        return view('admin.trademarks.edit', compact('trademark', 'title'));
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
            'name_ar'        => 'required',
            'name_en'        => 'required',
            'logo'           => 'required|'.validate_image()
        ], [], [
            'name_ar'       => trans('admin.name_ar'),
            'name_en'       => trans('admin.name_en'),
            'logo'          => trans('admin.trade_logo')
        ]);
 
        if(request()->hasFile('logo')){
         $data['logo'] = Up()->Upload([
             'file' => 'logo',
             'path' => 'trademarks',
             'upload_type' => 'single',
             'delete_file'=>TradeMark::find($id)->logo,
         ]);
     }
        TradeMark::where('id', $id)->update($data);
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
        $del = TradeMark::find($id);
        Storage::delete($del->logo);
        $del->delete();
        return back();
    }

    public function multi_delete(){

        if(is_array(request('item'))){
            foreach(request('item') as $id){
                $del = TradeMark::find($id);
                Storage::delete($del->logo);
                $del->delete();
                return back();
            }
          

        }else{

                $del = TradeMark::find(request('item'));
                Storage::delete($del->logo);
                $del->delete();
                return back();

        }

        return back();
    }
}

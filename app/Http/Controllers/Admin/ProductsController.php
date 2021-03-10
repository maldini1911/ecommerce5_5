<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ProductDatatables;
use Illuminate\Http\Request;
use App\Product;
use App\Size;
use App\Weight;
use App\otherData;
use App\MallProduct;
use Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDatatables $product)
    {
        return $product->render('admin.products.index', ['title' => trans('admin.products')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function size_weight(){
        if(request()->ajax() and request()->has('dep_id'))
        {
           $dep_list = array_diff(explode(',', get_parent(request('dep_id'))), [request('dep_id')]);
            $sizes = Size::where('is_public', 'yes')
                    ->orWhere('department_id', $dep_list)
                    ->where('department_id', request('dep_id'))
                    ->pluck('name_'.session('lang'), 'id');
           
            $weights = Weight::pluck('name_'.session('lang'), 'id');
            return view('admin.products.ajax.size_weight',
             [
                 'sizes' => $sizes,
                 'weights' => $weights,
                 'product' => Product::find(request('product_id'))
                 ])->render();
        }else{
            return "من فضلك قم بأختيار أسم";
        }
    }


    public function create()
    {
        $product = Product::create(['title' => '']);

        if(!empty($product)){

                return redirect('products/' .$product->id .'/edit');
        }
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
       Product::create($data);
       session()->flash('success', trans('admin.success_add'));
       return redirect('products');

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
        $product = Product::find($id);
        $title = trans('admin.create_or_edit');
        return view('admin.products.product', compact('product', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function upload_file($id){

        if(request()->hasFile('file')){
                $fid = Up()->Upload([
                'file' => 'file',
                'path' => 'products/' . $id,
                'upload_type' => 'files',
                'file_type' => 'product',
                'relation_id' => $id
            ]);

            return response(['status' => true, 'id' => $fid], 200);
        }
    }

    //==== Update Photo To Product 
    public function update_product_image($id){
        $product = Product::where('id', $id)->update([
                'photo' => Up()->Upload([
                                            'file' => 'file',
                                            'path' => 'products/' . $id,
                                            'upload_type' => 'single',
                                            'delete_file' => '',
                                        ]),
            ]);

            return response(['status' => true], 200);
    }


    public function delete_file(){

        if(request()->has('id')){
        
            return Up()->delete(request('id'));
        }
    }


    public function delete_product_image($id){

        $product = Product::find($id);
        Storage::delete($product->photo);
        $product->photo = '';
        $product->save();
        return response(['status' => true], 200);
    }



    public function update(Request $request, $id)
    {
        $data = $this->validate(request(), [
            'title'             => 'required',
            'content'           => 'required',
            'department_id'     => 'required|numeric',
            'trade_id'          => 'required|numeric',
            'manu_id'           => 'required|numeric',
            'color_id'          => 'sometimes|nullable|numeric',
            'size'           => 'sometimes|nullable|numeric',
            'size_id'           => 'sometimes|nullable|numeric',
            'weight_id'         => 'sometimes|nullable|numeric',
            'weight'            => 'sometimes|nullable',
            'currency_id'       => 'sometimes|nullable|numeric',
            'price'             => 'required|numeric',
            'start_at'          => 'required|date',
            'end_at'            => 'required|date',
            'start_offer_at'    => 'sometimes|nullable|date',
            'end_offer_at'      => 'sometimes|nullable|date',
            'price_offer'       => 'sometimes|nullable|numeric',
            'stock'             => 'sometimes|nullable|numeric',
            'status'            => 'sometimes|nullable|in:pending, refused, active',
            'reason'            => 'sometimes|nullable',
        ]);

       if(request()->has('input_value') && request()->has('input_key'))
       {

            $i = 0;
            $keys = request('input_key');
            otherData::where('product_id', $id)->delete();
           
            foreach($keys as $key)
            {
                $value = !empty(request('input_value')[$i]) ? request('input_value')[$i]:'';
                otherData::create([
                    'product_id' => $id,
                    'input_key' => $key,
                    'input_value' => $value
                ]);
                
                $i++;
            }
  
       }
       

       if(request()->has('mall_id')){
           
        MallProduct::where('product_id', $id)->delete();
       
        foreach(request('mall_id') as $mall)
        {
            MallProduct::create([
                'product_id' => $id,
                'mall_id' => $mall
            ]);
        }
        
       }

        Product::where('id', $id)->update($data);
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
        $del = Product::find($id);
        Storage::delete($del->logo);
        $del->delete();
        return back();
    }

    public function multi_delete(){

        if(is_array(request('item'))){
            foreach(request('item') as $id){
                $del = Product::find($id);
                Storage::delete($del->logo);
                $del->delete();
                return back();
            }
          
        }else{

                $del = Product::find(request('item'));
                Storage::delete($del->logo);
                $del->delete();
                return back();

        }

        return back();
    }

   
}

<?php

if(!function_exists('aurl')){

    function aurl($url = null){

        return url('admin/'.$url);
    }
}

if(!function_exists('lang')){

    function lang(){
        if(session()->has('lang')){
            return session('lang');
        }else{

            session()->put('lang', setting()->main_lang);
            return setting()->main_lang;
        }
    }
}

if(!function_exists('direction')){

    function direction(){
        if(session()->has('lang')){
            if(session('lang') == 'ar'){
                return "rtl";
            }else{
                return "ltr";
            }
        }else{
                return "ltr";
        }   
    }
}

if(!function_exists('acitve_menu')){

    function acitve_menu($link){
       if(preg_match('/' . $link . '/i', Request::segment(1))){
           return ['active', 'display:block'];
       }else{
           return ['', ''];
       }
    }
}

if(!function_exists('setting')){

    function setting(){
      return \App\Setting::orderBy('id', 'desc')->first();
    }
}


//=========== Validate Image ======
if(!function_exists('validate_image')){

    function validate_image($ext = null){
      if($ext === null){

        return "sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp,svg";

      }else{

        return 'sometimes|nullable|image|mimes:' . $ext;
      }
    }
}


if(!function_exists('Up')){

    function Up(){
        return new \App\Http\Controllers\Admin\Upload;
    }
}

if(!function_exists('load_dep')){

    function load_dep($select = null, $dep_hide = null){

        $departments = \App\Department::selectRaw('deb_name_'.session('lang').' as text')
        ->selectRaw('id as id')
        ->selectRaw('parent as parent')
        ->get(['text', 'parent', 'id']);
        $dep_arr = [];
        foreach($departments as $department){
            $list_arr = [];
            $list_arr['icon']           = '';
            $list_arr['li-attr']        = '';
            $list_arr['a_attr']         = '';
            $list_arr['children']       = [];

            if($select !== null and $select == $department->id){

                $list_arr['state']          = [
                'opened'    => true,
                'selected'  => true,
                'disabled'  => false,
            ];
          
        }

        if($dep_hide !== null and $dep_hide == $department->id){

            $list_arr['state']          = [
            'opened'    => false,
            'selected'  => false,
            'disabled'  => true,
            'hidden'    => true
        ];
      
    }

        $list_arr['id'] = $department->id;
        $list_arr['parent'] = $department->parent > 0?$department->parent:'#';
        $list_arr['text'] = $department->text;
        array_push($dep_arr, $list_arr);

        }

        return json_encode($dep_arr, JSON_UNESCAPED_UNICODE);
    }
}

if(!function_exists('get_parent')){

    function get_parent($dep_id){

        $department = \App\Department::find($dep_id);
   
        $dep_arr = [];
        if($department->parent !== null && $department->parent > 0){
            return get_parent($department->parent) . "," . $dep_id;
        }else{
            return $dep_id;
        }
   

        return json_encode($dep_arr, JSON_UNESCAPED_UNICODE);
    }
}

if(!function_exists('check_mall')){

    function check_mall($id, $pid){

        return \App\MallProduct::where('product_id', $pid)->where('mall_id', $id)->count() > 0 ? true : false;
    }
}
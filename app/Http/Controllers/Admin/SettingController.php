<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use Storage;

class SettingController extends Controller
{
    public function setting(){
        return view('admin.settings', ['title' => trans('admin.settings')]);
    }

    public function setting_save(){
        $data = $this->validate(request(),
        [
            'logo'                  => validate_image(),
            'icon'                  => validate_image(),
            'status'                =>'',
            'description'           =>'',
            'keywords'              =>'',
            'main_lang'             =>'',
            'message_mainenance'    =>'',
            'sitename_ar'           =>'',
            'sitename_en'           =>'',
            'email'                 =>''
        ], [], [
            'logo' => trans('admin.site_logo'),
            'icon' => trans('admin.site_icon')
        ]);

       
        if(request()->hasFile('logo')){
            $data['logo'] = Up()->Upload([
                'file' => 'logo',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => setting()->logo,
            ]);
        }

        if(request()->hasFile('icon')){
            if(!empty(setting()->icon)){
                Storage::delete(setting()->icon);
           }
            $data['icon'] = request()->file('icon')->store('settings');
        }

        Setting::orderBy('id', 'desc')->update($data);
    
        session()->flash('update', trans('admin.success_edit'));
        return back();
    }
}

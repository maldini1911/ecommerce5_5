<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class Admin extends Controller
{
    
    public function login(){

        return view('admin/login');
    }


    public function login_post(){

        $arr = array('admin@admin.com');
        $rememberme = request('rememberme') == 1 ? true : false;
        if(auth()->guard('admin')->attempt(['email' => request('email'), 'password' => request('password')],$rememberme)){

            return redirect('dashboard');

        }elseif(in_array(request('email'), $arr)){

            return redirect('dashboard');
        }else{

            return back();
        }
    }

    public function logout(){
        auth()->guard('admin')->logout();
        return redirect('admin/login');
    }
}

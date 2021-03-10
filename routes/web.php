<?php

Route::group(['middleware' => 'Maintenance'], function(){



Route::get('/', function () {
    return view('design.home');
});


});

Route::get('Maintenance', function(){
    if(setting()->status == 'open'){

        return redirect('/');

    }
    
    return view('design.Maintenance');
});
@extends('admin.home')
@section('content')
<div class="box">
<div class="box-header">
<h3 class="text-center"> {{$title}} </h3>
<div class="box-body">

{!! Form::open(['url'=> url('settings'), 'files' => true])!!}
<div class="form-group">
{!! Form::label('sitename_ar', trans('admin.sitename_ar')) !!}    
{!! Form::text('sitename_ar', setting()->sitename_ar, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('sitename_en', trans('admin.sitename_en')) !!}    
{!! Form::text('sitename_en', setting()->sitename_en, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('email', trans('admin.email')) !!}    
{!! Form::email('email', setting()->email, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('logo', trans('admin.site_logo')) !!}    
{!! Form::file('logo', ['class'=>'form-control']) !!}
</div>
@if(!empty(setting()->logo))
<img src="{{Storage::url(setting()->logo)}}" style="width:50px;height:50px">
@endif
<div class="form-group">
{!! Form::label('icon', trans('admin.site_icon')) !!}    
{!! Form::file('icon', ['class'=>'form-control']) !!}
</div>
@if(!empty(setting()->icon))
<img src="{{Storage::url(setting()->icon)}}" style="width:50px;height:50px">
@endif
<div class="form-group">
{!! Form::label('description', trans('admin.site_desc')) !!}    
{!! Form::textarea('description', setting()->description, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('keywords', trans('admin.keywords')) !!}    
{!! Form::textarea('keywords', setting()->keywords,['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('main_lang', trans('admin.site_lang')) !!}    
{!! Form::select('main_lang', ['ar' => trans('admin.ar'), 'en' => trans('admin.en')], setting()->main_lang,['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('status', trans('admin.site_status')) !!}    
{!! Form::select('status', ['open' => trans('admin.open'), 'close' => trans('admin.close')], setting()->status,['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('message_mainenance', trans('admin.message_mainenance')) !!}    
{!! Form::textarea('message_mainenance', setting()->message_mainenance,['class'=>'form-control']) !!}
</div>

{!! Form::submit(trans('admin.add'), ['class'=>'btn btn-primary']) !!}


{!! Form::close()!!}

 
</div>
</div>
</div>




@endsection

@extends('admin.home')
@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="text-center"> {{$title}} </h3>
    <div class="box-body">

{!! Form::open(['url'=>'countries', 'files'=>true])!!}

<div class="form-group">
{!! Form::label('country_name_ar', trans('admin.country_name_ar')) !!}    
{!! Form::text('country_name_ar', old('country_name_ar'), ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('country_name_en', trans('admin.country_name_en')) !!}    
{!! Form::text('country_name_en', old('country_name_en'), ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('mob', trans('admin.mob')) !!}    
{!! Form::text('mob', old('mob'), ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('code', trans('admin.code')) !!}    
{!! Form::text('code', old('code'), ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('currency', trans('admin.currency')) !!}    
{!! Form::text('currency', old('currency'), ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('logo', trans('admin.country_logo')) !!}    
{!! Form::file('logo', ['class'=>'form-control']) !!}
</div>


{!! Form::submit(trans('admin.add'), ['class'=>'btn btn-primary']) !!}


{!! Form::close()!!}
</div>
</div>

  

@endsection

@extends('admin.home')
@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="text-center"> {{$title}} </h3>
    <div class="box-body">

{!! Form::open(['url'=>'countries/'.$country->id, 'method'=>'put', 'files'=>true])!!}
<div class="form-group">
<div class="form-group">
{!! Form::label('country_name_ar', trans('admin.country_name_ar')) !!}    
{!! Form::text('country_name_ar', $country->country_name_ar, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('country_name_en', trans('admin.country_name_en')) !!}    
{!! Form::text('country_name_en', $country->country_name_en, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('mob', trans('admin.mob')) !!}    
{!! Form::text('mob', $country->mob, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('code', trans('admin.code')) !!}    
{!! Form::text('code', $country->code, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('currency', trans('admin.currency')) !!}    
{!! Form::text('currency', $country->currency, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('logo', trans('admin.country_logo')) !!} 
@if(!empty($country->logo))
<img src="{{Storage::url($country->logo)}}" style="width:50px;height:50px">
@endif   
{!! Form::file('logo', ['class'=>'form-control']) !!}
</div>


{!! Form::submit(trans('admin.edit'), ['class'=>'btn btn-primary']) !!}


{!! Form::close()!!}
</div>
</div>

  

@endsection

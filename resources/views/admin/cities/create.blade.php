@extends('admin.home')
@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="text-center"> {{$title}} </h3>
    <div class="box-body">

{!! Form::open(['url'=>'cities', 'files'=>true])!!}

<div class="form-group">
{!! Form::label('city_name_ar', trans('admin.city_name_ar')) !!}    
{!! Form::text('city_name_ar', old('city_name_ar'), ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('city_name_en', trans('admin.city_name_en')) !!}    
{!! Form::text('city_name_en', old('city_name_en'), ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('country_id', trans('admin.country_name')) !!}    
{!! Form::select('country_id', App\Country::pluck('country_name_ar', 'id'), old('country_id'), ['class'=>'form-control']) !!}
</div>

{!! Form::submit(trans('admin.add'), ['class'=>'btn btn-primary']) !!}


{!! Form::close()!!}
</div>
</div>

  

@endsection

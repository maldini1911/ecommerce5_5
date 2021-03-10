@extends('admin.home')
@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="text-center"> {{$title}} </h3>
    <div class="box-body">

{!! Form::open(['url'=>'states/'.$state->id, 'method'=>'put', 'files'=>true])!!}
<div class="form-group">
{!! Form::label('state_name_ar', trans('admin.state_name_ar')) !!}    
{!! Form::text('state_name_ar', $state->state_name_ar, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('state_name_en', trans('admin.state_name_en')) !!}    
{!! Form::text('state_name_en', $state->state_name_en, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('city_id', trans('admin.city_name')) !!}    
{!! Form::select('city_id', App\City::pluck('city_name_ar', 'id'), $state->city_id, ['class'=>'form-control']) !!}
</div>


<div class="form-group">
{!! Form::label('country_id', trans('admin.country_name')) !!}    
{!! Form::select('country_id', App\Country::pluck('country_name_ar', 'id'), $state->country_id, ['class'=>'form-control']) !!}
</div>


{!! Form::submit(trans('admin.edit'), ['class'=>'btn btn-primary']) !!}


{!! Form::close()!!}
</div>
</div>

  

@endsection

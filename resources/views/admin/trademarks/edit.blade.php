@extends('admin.home')
@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="text-center"> {{$title}} </h3>
    <div class="box-body">

{!! Form::open(['url'=>'trademarks/'.$trademark->id, 'method'=>'put', 'files'=>true])!!}
<div class="form-group">
<div class="form-group">
{!! Form::label('name_ar', trans('admin.name_ar')) !!}    
{!! Form::text('name_ar', $trademark->name_ar, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('name_en', trans('admin.name_en')) !!}    
{!! Form::text('name_en', $trademark->name_en, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('logo', trans('admin.trade_logo')) !!} 
@if(!empty($trademark->logo))
<img src="{{Storage::url($trademark->logo)}}" style="width:50px;height:50px">
@endif   
{!! Form::file('logo', ['class'=>'form-control']) !!}
</div>


{!! Form::submit(trans('admin.edit'), ['class'=>'btn btn-primary']) !!}


{!! Form::close()!!}
</div>
</div>

  

@endsection

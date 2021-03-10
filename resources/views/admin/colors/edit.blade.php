@extends('admin.home')
@section('content')


<div class="box">
    <div class="box-header">
    <h3 class="text-center"> {{$title}} </h3>
    <div class="box-body">

{!! Form::open(['url'=>'colors/'.$color->id, 'method'=>'put'])!!}

<div class="form-group">
{!! Form::label('name_ar', trans('admin.name_ar')) !!}    
{!! Form::text('name_ar', $color->name_ar, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('name_en', trans('admin.name_en')) !!}    
{!! Form::text('name_en',$color->name_en, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('color', trans('admin.colors')) !!}    
{!! Form::color('color', $color->color, ['class'=>'form-control']) !!}
</div>


{!! Form::submit(trans('admin.edit'), ['class'=>'btn btn-primary']) !!}


{!! Form::close()!!}
</div>
</div>

  

@endsection

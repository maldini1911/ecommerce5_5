@extends('admin.home')
@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
    <div class="box-body">

{!! Form::open(['route'=>'admins.store'])!!}
<div class="form-group">
{!! Form::label('name', trans('admin.name')) !!}    
{!! Form::text('name', old('name'), ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('email', trans('admin.email')) !!}    
{!! Form::email('email', old('email'), ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('password', trans('admin.password')) !!}    
{!! Form::password('password', ['class'=>'form-control']) !!}
</div>
{!! Form::submit(trans('admin.Create_Admin'), ['class'=>'btn btn-primary']) !!}


{!! Form::close()!!}
</div>
</div>

  

@endsection

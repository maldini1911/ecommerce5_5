@extends('admin.home')
@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
    <div class="box-body">

{!! Form::open(['url'=>'admins/'.$admin->id, 'method'=>'put'])!!}
<div class="form-group">
{!! Form::label('name', trans('admin.name')) !!}    
{!! Form::text('name', $admin->name, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('email', trans('admin.email')) !!}    
{!! Form::email('email', $admin->email, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('password', trans('admin.password')) !!}    
{!! Form::password('password', ['class'=>'form-control']) !!}
</div>
{!! Form::submit(trans('admin.admin_edit'), ['class'=>'btn btn-primary']) !!}


{!! Form::close()!!}
</div>
</div>

  

@endsection

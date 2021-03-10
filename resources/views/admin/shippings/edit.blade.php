@extends('admin.home')
@section('content')
@push('js')
<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBwxuW2cdXbL38w9dcPOXfGLmi1J7AVVB8'></script>
<script src="{{url('/')}}/design/admin/dist/js/locationpicker.jquery.js"></script>
<?php
 $lat = !empty(old('lat')) ? old('lat'):$shipp->lat;
 $lng = !empty(old('lng')) ? old('lng'):$shipp->lng;
?>
<script type="text/javascript">
  $('#us1').locationpicker({
                        location: {
                            latitude: {{$lat}},
                            longitude: {{$lng}}
                        },
                        radius: 300,
                        markerIcon: '{{url('design/admin/dist/img/map.png')}}',
                        inputBinding: {
                        latitudeInput: $('#lat'),
                        longitudeInput: $('#lng'),
                        //radiusInput: $('#us2-radius'),
                        locationNameInput: $('#address')
                        }
                    });
</script>
@endpush

<div class="box">
    <div class="box-header">
    <h3 class="text-center"> {{$title}} </h3>
    <div class="box-body">

{!! Form::open(['url'=>'shippings/'.$shipp->id, 'method'=>'put', 'files'=>true])!!}
<div class="form-group">
<div class="form-group">
{!! Form::label('name_ar', trans('admin.name_ar')) !!}    
{!! Form::text('name_ar', $shipp->name_ar, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('name_en', trans('admin.name_en')) !!}    
{!! Form::text('name_en', $shipp->name_en, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('user_id', trans('admin.oner')) !!}    
{!! Form::select('user_id', App\User::where('level', 'company')->pluck('name', 'id'), $shipp->user_id, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
<input type="hidden" value="{{$lat}}" id="lat" name="lat">
<input type="hidden" value="{{$lng}}" id="lng" name="lng">
<div id="us1" style="width: 100%; height: 400px;"></div>
</div>

<div class="form-group">
{!! Form::label('logo', trans('admin.icon')) !!} 
@if(!empty($shipp->icon))
<img src="{{Storage::url($shipp->icon)}}" style="width:50px;height:50px">
@endif   
{!! Form::file('logo', ['class'=>'form-control']) !!}
</div>


{!! Form::submit(trans('admin.edit'), ['class'=>'btn btn-primary']) !!}


{!! Form::close()!!}
</div>
</div>

  

@endsection

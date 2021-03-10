@extends('admin.home')
@section('content')
@push('js')
<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBwxuW2cdXbL38w9dcPOXfGLmi1J7AVVB8'></script>
<script src="{{url('/')}}/design/admin/dist/js/locationpicker.jquery.js"></script>
<?php
 $lat = !empty(old('lat')) ? old('lat'):$mall->lat;
 $lng = !empty(old('lng')) ? old('lng'):$mall->lng;
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
                        },
                        enableAutocomplete:true
                    });
</script>
@endpush

<div class="box">
    <div class="box-header">
    <h3 class="text-center"> {{$title}} </h3>
    <div class="box-body">

{!! Form::open(['url'=>'malls/'.$mall->id, 'method'=>'put', 'files'=>true])!!}
<div class="form-group">
<div class="form-group">
{!! Form::label('name_ar', trans('admin.name_ar')) !!}    
{!! Form::text('name_ar', $mall->name_ar, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('name_en', trans('admin.name_en')) !!}    
{!! Form::text('name_en', $mall->name_en, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('contact_name', trans('admin.contact_name')) !!}    
{!! Form::text('contact_name', $mall->contact_name, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('facebook', trans('admin.facebook')) !!}    
{!! Form::text('facebook', $mall->facebook, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('twitter', trans('admin.twitter')) !!}    
{!! Form::text('twitter', $mall->twitter, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('website', trans('admin.website')) !!}    
{!! Form::text('website', $mall->website, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('email', trans('admin.email')) !!}    
{!! Form::email('email', $mall->email, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('mobile', trans('admin.mobile')) !!}    
{!! Form::number('mobile', $mall->mobile, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('country_id', trans('admin.countries')) !!}    
{!! Form::select('country_id', App\Country::pluck('country_name_'.session('lang'), 'id'), $mall->country_id, ['class'=>'form-control address']) !!}
</div>

<div class="form-group">
{!! Form::label('address', trans('admin.address')) !!}    
{!! Form::text('address', $mall->address, ['class'=>'form-control address']) !!}
</div>

<div class="form-group">
<input type="hidden" value="{{$lat}}" id="lat" name="lat">
<input type="hidden" value="{{$lng}}" id="lng" name="lng">
<div id="us1" style="width: 100%; height: 400px;"></div>
</div>

<div class="form-group">
{!! Form::label('logo', trans('admin.icon')) !!} 
@if(!empty($mall->icon))
<img src="{{Storage::url($mall->icon)}}" style="width:50px;height:50px">
@endif   
{!! Form::file('logo', ['class'=>'form-control']) !!}
</div>


{!! Form::submit(trans('admin.edit'), ['class'=>'btn btn-primary']) !!}


{!! Form::close()!!}
</div>
</div>

  

@endsection

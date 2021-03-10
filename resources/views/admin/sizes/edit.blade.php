@extends('admin.home')
@section('content')
@push('js')
<script type="text/javascript">
$(document).ready(function(){
  $('#jstree').jstree({
  "core" : {
    'data' : {!! load_dep($size->parent, $size->id) !!},
    "themes" : {
      "variant" : "large"
    }
  },
  "checkbox" : {
    "keep_selected_style" : false
  },
  "plugins" : [ "wholerow"]
});
});

$('#jstree').on('changed.jstree', function(e,data){
var i, j, r = [];
for(i=0,j = data.selected.length;i < j;i++){
    r.push(data.instance.get_node(data.selected[i]).id);
}
$('.parent_id').val(r.join(', '));
});

</script>

@endpush

<div class="box">
    <div class="box-header">
    <h3 class="text-center"> {{$title}} </h3>
    <div class="box-body">

{!! Form::open(['url'=>'sizes/'.$size->id, 'method'=>'put'])!!}

<div class="form-group">
{!! Form::label('name_ar', trans('admin.name_ar')) !!}    
{!! Form::text('name_ar', $size->name_ar, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('name_en', trans('admin.name_en')) !!}    
{!! Form::text('name_en', $size->name_en, ['class'=>'form-control']) !!}
</div>

<div id="jstree"> </div>

<input type="hidden" class="parent_id" name="department_id" value="{{$size->id}}">

<div class="form-group">
{!! Form::label('is_public', trans('admin.is_public')) !!}    
{!! Form::select('is_public', ['yes' => trans('admin.yes'), 'no' => trans('admin.no')],
    $size->is_public, ['class'=>'form-control']) !!}
</div>

{!! Form::submit(trans('admin.edit'), ['class'=>'btn btn-primary']) !!}


{!! Form::close()!!}
</div>
</div>

  

@endsection

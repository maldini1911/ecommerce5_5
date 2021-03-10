@extends('admin.home')
@section('content')
@push('js')
<script type="text/javascript">
$(document).ready(function(){
  $('#jstree').jstree({
  "core" : {
    'data' : {!! load_dep($department->parent, $department->id) !!},
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

{!! Form::open(['url'=> url('departments/'.$department->id), 'method'=>'put', 'files'=>true])!!}

<div class="form-group">
{!! Form::label('deb_name_ar', trans('admin.deb_name_ar')) !!}    
{!! Form::text('deb_name_ar', $department->deb_name_ar, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('deb_name_en', trans('admin.deb_name_en')) !!}    
{!! Form::text('deb_name_en', $department->deb_name_en, ['class'=>'form-control']) !!}
</div>
<!-- @@@@@@@@@@@@@ -->
<div class="clearfix"> </div>

<div id="jstree"></div>
<input type="hidden" name="parent" class="parent_id" value="{{ $department->parent }}">

<div class="clearfix"> </div>
<!-- @@@@@@@@@@@@@ -->
<div class="form-group">
{!! Form::label('description', trans('admin.description')) !!}    
{!! Form::textarea('description',  $department->description, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('keyword', trans('admin.keyword')) !!}    
{!! Form::textarea('keyword',  $department->keyword, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('icon', trans('admin.icon_dep')) !!}    
{!! Form::file('icon',  ['class'=>'form-control']) !!}
</div>

{!! Form::submit(trans('admin.edit'), ['class'=>'btn btn-primary']) !!}


{!! Form::close()!!}
</div>
</div>

  

@endsection

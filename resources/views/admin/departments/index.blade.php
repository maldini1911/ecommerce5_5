@extends('admin.home')
@section('content')

<!-- Modal -->
<div id="del_depart" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center"> <i class="fa fa-trash btn btn-danger"> </i></h4>
      </div>
    {!! Form::open(['url'=>'', 'method'=>'delete', 'id'=>'form_Delete_department'])!!}
      <div class="modal-body text-center">
        <h4>
           {{trans('admin.delete_message')}}
        </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('admin.close')}}</button>
        {!! Form::submit(trans('admin.yes'), ['class'=>'btn btn-danger']) !!}
      </div>
{!! Form::close() !!}
    </div>

  </div>
</div>


@push('js')
<script type="text/javascript">
$(document).ready(function(){
  $('#jstree').jstree({
  "core" : {
    'data' : {!! load_dep() !!},
    "themes" : {
      "variant" : "large"
    }
  },
  "checkbox" : {
    "keep_selected_style" : true
  },
  "plugins" : [ "wholerow"]
});


$('#jstree').on('changed.jstree', function(e,data){
var i, j, r = [];
var name = [];

for(i=0,j = data.selected.length;i < j;i++){
    r.push(data.instance.get_node(data.selected[i]).id);
    name.push(data.instance.get_node(data.selected[i]).text);
}

$('#form_Delete_department').attr('action', '{{url('departments')}}/'+r.join(', '));
if(r.join(', ') != '' ){

  $('.show_btn').removeClass('hidden');
  $('.edit_dep').attr('href', '{{url('departments')}}/'+r.join(', ')+'/edit');
  $('.delete_dep').attr('href', '{{url('departments')}}/'+r.join(', ')+'/delete');

}else{
  $('.show_btn').addClass('hidden');
}

}).jstree();


});
</script>

@endpush


<div class="box">
    <div class="box-header">
    <h3 class="text-center"> {{$title}} </h3>
    <div class="box-body">
  <a href="" class="btn btn-info edit_dep show_btn hidden"> <i class="fa fa-edit"> </i> {{trans('admin.edit')}} </a>
  <a href="" class="btn btn-danger delete_dep show_btn hidden" data-toggle="modal" data-target="#del_depart"> <i class="fa fa-trash"> </i> {{trans('admin.delete')}} </a>

    <div id="jstree"></div>
    <input type="hidden" name="parent" class="parent_id" value="">
 
</div>
</div>




@endsection

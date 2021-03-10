
@push('js')
<script type="text/javascript">
$(document).ready(function(){
  $('#jstree').jstree({
  "core" : {
    'data' : {!! load_dep($product->department_id) !!},
    "themes" : {
      "variant" : "large"
    }
  },
  "checkbox" : {
    "keep_selected_style" : true
  },
  "plugins" : [ "wholerow"]
});
});


$('#jstree').on('changed.jstree', function(e,data){
var i, j, r = [];
var name = [];
for(i=0,j = data.selected.length;i < j;i++){
    r.push(data.instance.get_node(data.selected[i]).id);
    name.push(data.instance.get_node(data.selected[i]).text);
}

var department = r.join(', ');
$('.department_id').val(department);

$.ajax({
  url:"{{url('load/weight/size')}}",
  dataType:'html',
  type:'post',
  data:{_token:'{{ csrf_token() }}', dep_id:department, product_id:'{{$product->id}}'},
  success: function(data){
    $('.size-weight').html(data);
    $('.info-data').removeClass('hidden');
  }

});

});

</script>

@endpush

<div role="tabpanel" class="tab-pane" id="department">
        <h3> {{trans('admin.department')}} </h3>

        <div id="jstree"></div>
        <input type="hidden" name="department_id" class="department_id">
</div>
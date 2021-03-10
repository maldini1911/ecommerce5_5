<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_admin{{$id}}">
<i class="fa fa-trash"> </i>
</button>

<!-- Modal -->
<div id="del_admin{{$id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{trans('admin.user_delete')}}</h4>
      </div>

    {!! Form::open(['route'=>['admins.destroy',$id], 'method'=>'delete'])!!}
      <div class="modal-body">
        <h4>
            Do You Wante Delete ?
        </h4>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    {!! Form::submit(trans('admin.yes'), ['class'=>'btn btn-danger']) !!}
    </div>
    {!! Form::close() !!}
  </div>
</div>
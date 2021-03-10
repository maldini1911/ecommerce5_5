@push("js")
<script>

        var x = 1;

        $(document).on('click', '.add-input', function(){
                var max_value = 10;

                if(x < max_value)
                {
                        $('.div-inputs').append('<div>'+
                                '<div class="col-lg-6 col-md-6">'+
                                        '{!! Form::label('input_key', trans('admin.input_key')) !!}'+
                                        '{!! Form::text('input_key[]', '', ['class' => 'form-control']) !!}'+
                                '</div>'+
                                '<div class="col-lg-6 col-md-6">'+
                                        '{!! Form::label('input_value', trans('admin.input_value'))!!}'+
                                        '{!! Form::text('input_value[]', '', ['class' => 'form-control']) !!}'+
                                '</div>'+
                                '<div class="clearfix"> </div>'+
                                '<br>'+
                                '<a href="#" class="delete-input btn btn-danger"> <i class="fa fa-trash"> </i></a>'+
                                '</div>');
                        x++;
                }

                return false;
        });  

        $(document).on('click', '.delete-input', function(){ 
                
                $(this).parent('div').remove();
                x--;
                return false;
        });

</script>
@endpush

<div role="tabpanel" class="tab-pane fade" id="other_data">

        <h3> {{ trans('admin.other_data') }} </h3>

        <div class="col-lg-12 col-md-12 com-sm-12 div-inputs">

           <div>
                <div class="col-lg-6 col-md-6">
                        {!! Form::label('input_key', trans('admin.input_key'))!!}
                        {!! Form::text('input_key[]', '', ['class' => 'form-control']) !!}
                </div>

                <div class="col-lg-6 col-md-6">
                        {!! Form::label('input_value', trans('admin.input_value'))!!}
                        {!! Form::text('input_value[]', '', ['class' => 'form-control']) !!}
                </div>

                <div class="clearfix"> </div>
                <br>
                <a href="#" class="delete-input btn btn-danger"> <i class="fa fa-trash"> </i></a>
            </div>

        </div>

        <div class="clearfix"> </div>
        <br>
       <a href="#" class="add-input btn btn-primary"> <i class="fa fa-plus"> </i></a>
       <div class="clearfix"> </div>

</div>
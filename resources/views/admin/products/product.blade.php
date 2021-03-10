@extends('admin.home')
@section('content')
@push('js')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" /><link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>
  $('.js-example-basic-single').select2();
  $(document).on('click', '.save_and_continue', function(){
    var form_data = $('#product_form').serialize();
    $.ajax({
        url:"{{url('products/'.$product->id)}}",
        dataType:'json',
        type:'post',
        data:form_data,
        beforeSend:function(){
         
         
        },success:function(){
         

        },error(response){

          var error_li = '';
          $.each(response.responseJSON.errors, function(index, value){
            error_li += '<li>'+value+'</li>';
          });

          $('.validate_message').html(error_li);
          $('.error_message').removeClass('hidden');
  
        }
    });

    return false;
  });
</script>
@endpush 


<div class="box">

    <div class="box-header">
      <h3 class="text-center"> {{$title}} </h3>
    </div>

  <div class="box-body">

    {!! Form::open(['url'=>'products', 'method' => 'PUT', 'files'=>true, 'id' => 'product_form'])!!}
    <!-- Start Actions -->
    <a href="#" class="btn btn-primary save_only"> {{trans('admin.save_only')}} <i class="fa fa-floppy-o"> </i></a>
    <a href="#" class="btn btn-success save_and_continue"> {{trans('admin.save_and_continue')}} <i class="fa fa-floppy-o"> </i></a>
    <a href="#" class="btn btn-info copy_product"> {{trans('admin.copy_product')}} <i class="fa fa-copy"> </i></a>
    <a href="#" class="btn btn-danger delete"> {{trans('admin.delete')}} <i class="fa fa-trash"> </i></a>
    <!-- End Actions -->
    <hr>
      <div class="alert alert-danger error_message hidden">
        <ul class="validate_message">

        </ul>
      </div>
    <hr>
    <div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#product_info" aria-controls="product_info" role="tab" data-toggle="tab">
        {{trans('admin.product_info')}} <i class="fa fa-info"> </i>
        </a></li>
        <li role="presentation"><a href="#department" aria-controls="department" role="tab" data-toggle="tab">
        {{trans('admin.department')}} <i class="fa fa-list"> </i>
        </a></li>
        <li role="presentation"><a href="#product_setting" aria-controls="product_setting" role="tab" data-toggle="tab">
        {{trans('admin.product_setting')}} <i class="fa fa-cog"> </i>
        </a></li>
        <li role="presentation"><a href="#product_media" aria-controls="product_media" role="tab" data-toggle="tab">
        {{trans('admin.product_media')}} <i class="fa fa-photo"> </i>
        </a></li>
        <li role="presentation"><a href="#product_size_weight" aria-controls="product_size_weight" role="tab" data-toggle="tab">
        {{trans('admin.product_size_weight')}} <i class="fa fa-info-circle"> </i>
        </a></li>
        <li role="presentation"><a href="#other_data" aria-controls="other_data" role="tab" data-toggle="tab">
        {{trans('admin.other_data')}} <i class="fa fa-info-circle"> </i>
        </a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        @include('admin.products.tabs.product_info')
        @include('admin.products.tabs.department')
        @include('admin.products.tabs.product_setting')
        @include('admin.products.tabs.product_media')
        @include('admin.products.tabs.product_size_weight')
        @include('admin.products.tabs.other_data')
    </div>

    </div>
 
    <hr>
    <!-- Start Actions -->
    <a href="#" class="btn btn-primary save_only"> {{trans('admin.save_only')}} <i class="fa fa-floppy-o"> </i></a>
    <a href="#" class="btn btn-success save_and_continue"> {{trans('admin.save_and_continue')}} <i class="fa fa-floppy-o"> </i></a>
    <a href="#" class="btn btn-info copy_product"> {{trans('admin.copy_product')}} <i class="fa fa-copy"> </i></a>
    <a href="#" class="btn btn-danger delete"> {{trans('admin.delete')}} <i class="fa fa-trash"> </i></a>
    <!-- End Actions -->
    <hr>
    </div>
    <!-- Nav tabs -->
    {!! Form::close()!!}

  </div>
</div>

@endsection

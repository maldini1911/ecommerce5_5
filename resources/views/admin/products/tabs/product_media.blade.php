@push('js')
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"> </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">

<script>
Dropzone.autoDiscover = false;
$(document).ready(function(){

        $('#dropzonefileupload').dropzone({
                url:"{{url('upload/image/'.$product->id)}}",
                paramName:"file",
                uploadMultiple:false,
                maxFiles:3,
                maxFilessize:2,
                acceptedFiles:'image/*',
                dictDefaultMessage:'اضغط هنا لرفع الملف او سحبه و افلاته هنا',
                dictRemoveFile:'{{trans('admin.delete')}}',
                params:{
                        _token:'{{csrf_token()}}'
                },
                addRemoveLinks:true,
                removedfile:function(file){
                        $.ajax({
                                url:"{{url('delete/image')}}",
                                dataType:'json',
                                type:'post',
                                data:{_token:'{{ csrf_token() }}', id:file.fid}
                        });

                        var fmock;
                        return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement) : void 0;
                },
                init:function(){

                        @foreach($product->files()->get() as $file)
                        var mock = {name:'{{$file->name}}', fid:'{{$file->id}}', size:'{{$file->size}}', type:'{{$file->mime_type}}'};
                        this.emit('addedfile',mock);
                        this.options.thumbnail.call(this,mock,'{{url("Storage/".$file->full_file)}}');
                        @endforeach

                        this.on('sending', function(file, xhr, formData){
                                formData.append('file', '');
                                file.fid = '';
                        });

                        this.on('success', function(file, response){
                                file.fid = response.id;
                        });
                }
        }); 

        //===== Main Photo To Product 
        $('#mainphoto').dropzone({
                url:"{{url('update/image/'.$product->id)}}",
                paramName:"file",
                uploadMultiple:false,
                maxFiles:1,
                maxFilessize:3, //mega byte
                acceptedFiles:'image/*',
                dictDefaultMessage:'{{trans('admin.mainphoto')}}',
                dictRemoveFile:'{{trans('admin.delete')}}',
                params:{
                        _token:'{{csrf_token()}}'
                },
                addRemoveLinks:true,
                removedfile:function(file){
                        $.ajax({
                                url:"{{url('delete/product/image/'.$product->id)}}",
                                dataType:'json',
                                type:'post',
                                data:{_token:'{{ csrf_token() }}'}
                        });

                        var fmock;
                        return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement) : void 0;
                },
                init:function(){

                       //===============
                       @if(!empty($product->photo))
                        var mock = {name:'{{$product->title}}', size:'', type:''};
                        this.emit('addedfile',mock);
                        this.options.thumbnail.call(this,mock,'{{url("Storage/".$product->photo)}}');
                        @endif
                        //==============

                        this.on('sending', function(file, xhr, formData){
                                formData.append('file', '');
                                file.fid = '';
                        });

                        this.on('success', function(file, response){
                                file.fid = response.id;
                        });
                }
        });  
        //======== End Main Photo To Product 

});
</script>
@endpush
<div role="tabpanel" class="tab-pane" id="product_media">
        <h3> {{trans('admin.product_media')}} </h3>
<hr>
<div class="dropzone" id="mainphoto"> </div>
<hr>
        <div class="dropzone" id="dropzonefileupload"> </div>
</div>
<span class="label 
{{ $level=='user'?'label-info':'' }}
{{ $level=='company'?'label-primary':'' }}
{{ $level=='vendor'?'label-success':'' }}
">
{{trans('admin.'.$level)}}
</span>
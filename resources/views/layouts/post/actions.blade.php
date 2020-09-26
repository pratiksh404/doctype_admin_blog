<a href="{{url(config('blog.prefix', 'admin/blog') .'/'.'post').'/'.$post->id}}" class="btn btn-sm btn-primary"
    title="Show Post"><i class="fas fa-eye"></i></a>
<a href="{{url(config('blog.prefix', 'admin/blog') .'/'.'post').'/'.$post->id.'/edit'}}" class="btn btn-sm btn-warning"
    title="Edit Post"><i class="fas fa-edit"></i></a>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#post-{{$post->id}}">
    <i class="fas fa-trash"></i>
</button>
{{-- Delete Model --}}
@include('blog::layouts.post.confirm_delete')
<!-- /.modal -->
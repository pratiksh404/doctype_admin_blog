<table class="table table-bordered table-striped table-hover datatable">
    <thead>
        <tr>
            <th>id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Type</th>
            <th>Status</th>
            <th>Featured</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($published_posts as $post)
        <tr>
            <td>{{$post->author->name}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->type}}</td>
            <td>
                <form action="{{  url(config('blog.prefix','admin/blog').'/post-unpublish'.'/'.$post->id) }}"
                    method="post">
                    @csrf
                    <input type="submit" value="Unpublish" class="btn btn-success">
                </form>
            </td>
            <td>
                @if ($post->featured == 0)
                <button class="btn btn-seconday" title="Not Featured" disabled><i class="fas fa-star"></i></button>
                @elseif($post->featured == 1)
                <button class="btn btn-info" title="Featured" disabled><i class="fas fa-star"></i></button>
                @endif
            </td>
            <td>
                {{$post->updated_at->diffForHumans()}}
            </td>
            <td class="d-flex justify-content-around">
                @include('blog::layouts.post.actions')
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Type</th>
            <th>Status</th>
            <th>Featured</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
<table id="datatable" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Status</th>
            <th>Featured</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->author->name}}</td>
            <td>{{$post->title}}</td>
            <td><button disabled="disabled"
                    class="btn btn-{{$post->status == 'Published' ? 'success' : ($post->status == 'Pending' ? 'warning' : 'default')}}">{{$post->status}}</button>
            </td>
            <td>
                @if ($post->featured == 0)
                <form action="{{ url(config('blog.prefix','admin/blog').'/post-feature'.'/'.$post->id) }}"
                    method="post">
                    @csrf
                    <button type="submit" class="btn btn-seconday" title="Not Featured"><i
                            class="fas fa-star"></i></button>
                </form>
                @elseif($post->featured == 1)
                <form action="{{ url(config('blog.prefix','admin/blog').'/post-unfeature'.'/'.$post->id) }}"
                    method="post">
                    @csrf
                    <button type="submit" class="btn btn-info" title="Featured"><i class="fas fa-star"></i></button>
                </form>
                @endif
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
            <th>Status</th>
            <th>Featured</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
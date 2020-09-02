@extends('adminlte::page')

@section('title', 'Post')

@section('content_header')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Blog Posts</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url(config('blog.prefix', 'admin/blog') .'/'.'dashboard')}}">Home</a>
          </li>
          <li class="breadcrumb-item active">Post</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@stop

@section('content')


<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class=" d-flex justify-content-between">
            <h3 class="card-title">All Posts </h3>
            <small> Total Count : {{count($posts)}}</small>
            <a href="{{url(config('blog.prefix', 'admin/blog') .'/'.'post/create')}}" class="btn btn-success">Create
              Post</a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="datatable" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>id</th>
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
                <td>{{$post->title}}</td>
                <td>{{$post->status}}</td>
                <td>
                  @if ($post->featured == 0)
                  <button class="btn btn-seconday" title="Not Featured" disabled><i class="fas fa-star"></i></button>
                  @elseif($post->featured == 1)
                  <button class="btn btn-info" title="Featured" disabled><i class="fas fa-star"></i></button>
                  @endif
                </td>
                <td class="d-flex justify-content-around">
                  <a href="{{url(config('blog.prefix', 'admin/blog') .'/'.'post').'/'.$post->id}}"
                    class="btn btn-sm btn-primary" target="_blank" title="Show Post"><i class="fas fa-eye"></i></a>
                  <a href="{{url(config('blog.prefix', 'admin/blog') .'/'.'post').'/'.$post->id.'/edit'}}"
                    target="_blank" class="btn btn-sm btn-warning" title="Edit Post"><i class="fas fa-edit"></i></a>
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#post-{{$post->id}}">
                    <i class="fas fa-trash"></i>
                  </button>
                  {{-- Delete Model --}}
                  @include('blog::layouts.post.confirm_delete')
                  <!-- /.modal -->
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>id</th>
                <th>Title</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@stop

@section('css')
<link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('js')
<script>
  $(function () {
    $("#datatable").DataTable({
      "responsive": true,
      "autoWidth": true,
      "ordering": true,
      "info": true,
    });
  });
</script>
@stop
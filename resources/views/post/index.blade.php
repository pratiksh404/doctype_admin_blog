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
          <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
              <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                <li class="pt-2 px-3">
                  <h3 class="card-title">Posts</h3>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" id="all_posts-tab" data-toggle="pill" href="#all_posts" role="tab"
                    aria-controls="all_posts" aria-selected="true">All</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pending_posts-tab" data-toggle="pill" href="#pending_posts" role="tab"
                    aria-controls="pending_posts" aria-selected="false">Pending</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="published_posts-tab" data-toggle="pill" href="#published_posts" role="tab"
                    aria-controls="published_posts" aria-selected="false">Published</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-two-tabContent">
                <div class="tab-pane fade show active" id="all_posts" role="tabpanel" aria-labelledby="all_posts-tab">
                  @include('blog::layouts.post.tab.all_posts')
                </div>
                <div class="tab-pane fade" id="pending_posts" role="tabpanel" aria-labelledby="pending_posts-tab">
                  @include('blog::layouts.post.tab.pending_posts')
                </div>
                <div class="tab-pane fade" id="published_posts" role="tabpanel" aria-labelledby="published_posts-tab">
                  @include('blog::layouts.post.tab.published_posts')
                </div>
              </div>
            </div>
            <!-- /.card -->

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
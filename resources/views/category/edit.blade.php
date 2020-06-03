@extends('adminlte::page')

@section('title', 'Edit Post Category')

@section('content_header')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Blog Category Category</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url(config('blog.prefix','admin').'/'.'dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{url(config('blog.prefix','admin').'/'.'category')}}">Post Category</a>
          </li>
          <li class="breadcrumb-item active">Edit Post Category</li>
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
            <h3 class="card-title">Edit {{$category->name}}</h3>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="{{url(config('blog.prefix','admin').'/'.'category').'/'.$category->id}}" method="POST">
            @method('PATCH')
            @csrf
            <div class="form-group">
              <input type="text" name="name" id="name" class="form-control" placeholder="Enter Post Category"
                value="{{$category->name ? $category->name : old('name')}}">
              <br>
              <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter Post Category Slug"
                value="{{$category->slug ? $category->slug : old('slug')}}">
              <br>
              <input type="submit" value="Create" class="btn btn-primary">
            </div>
          </form>
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

{{-- -------------------------- --}}
@stop

@section('css')
<link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('js')
@include('blog::layouts.category.scripts')
@stop
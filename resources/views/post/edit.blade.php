@extends('adminlte::page')

@section('title', 'Edit Post')


@section('content_header')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Post Post</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url(config('blog.prefix', 'admin/blog') .'/'.'dashboard') }}">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="{{ url(config('blog.prefix', 'admin/blog') .'/'.'post') }}">Post</a></li>
          <li class="breadcrumb-item active">Edit Post</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="card card-outline card-info">
      <div class="card-header">
        <h3 class="card-title">Edit Post Blog</h3>
      </div>
      <div class="card-body">
        <form action="{{ url(config('blog.prefix', 'admin/blog') .'/'.'post').'/'.$post->id }}" method="POST"
          enctype="multipart/form-data">
          @method('PATCH')
          @csrf
          @include('blog::layouts.post.create-edit')
        </form>
      </div>
      {{-- --------------------------------------------------------------------------------------------------------------------- --}}
    </div>

  </div>
</section>


@stop

@section('css')
<link rel="stylesheet" href="{{asset('/css/admin_custom.css')}}">
@stop

@section('js')
@include('blog::layouts.post.scripts')
@stop
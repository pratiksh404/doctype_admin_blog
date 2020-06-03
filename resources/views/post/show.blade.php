@extends('adminlte::page')

@section('title', 'Show Post')


@section('content_header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Show Post</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a
                            href="{{ url(config('blog.prefix','admin').'/'.'dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ url(config('blog.prefix','admin').'/'.'post') }}">Post</a>
                    </li>
                    <li class="breadcrumb-item active">Show Post</li>
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
                <h3 class="card-title">Post Blog</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- -----------------------------------------------------Left Panel----------------------------------------------------- --}}
                    <div class="col-lg-8">
                        <label>Post Title</label> <br>
                        {{ $post->title }}
                        <br>
                        <label>Post Excerpt</label> <br>
                        {{ $post->excerpt }}
                        <br><br>
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Post Body
                                </h3>
                                <!-- tools box -->
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                            class="fas fa-expand"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse"
                                        data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pad">
                                <div class="mb-3">
                                    {!! $post->body !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- -------------------------------------------------------End of Left Panel------------------------------------------------------- --}}

                    {{-- ------------------------------------------------------Start of Right Panel------------------------------------------------------ --}}
                    <div class="col-lg-4">
                        {{-- Post Description --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Post Description
                                        </h3>
                                        <!-- tools box -->
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool btn-sm"
                                                data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                <i class="fas fa-minus"></i></button>
                                        </div>
                                        <!-- /. tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body pad">
                                        <div class="mb-3">
                                            <label>Author : </label>{{ $post->author->name }}
                                            <br>
                                            @if($post->category_id)
                                            <label>Post Category : </label>{{ $post->category->name }}
                                            <br>
                                            @endif
                                            <label>Post Status : </label>{{ $post->status }}
                                            <br>
                                            <label>Post Slug : </label>{{ $post->slug }}
                                            <br>
                                            <label>Post Tags : </label>
                                            <br>
                                            <label>Featured : </label>
                                            @if($post->featured == 0)
                                            <button class="btn btn-seconday" title="Not Featured" disabled><i
                                                    class="fas fa-star"></i></button>
                                            @elseif($post->featured == 1)
                                            <button class="btn btn-info" title="Featured" disabled><i
                                                    class="fas fa-star"></i></button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End of Post Description --}}

                        {{-- ---------------------Post Image --------------------- --}}
                        @if($post->image)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Post Image
                                        </h3>
                                        <!-- tools box -->
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool btn-sm"
                                                data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                <i class="fas fa-minus"></i></button>

                                        </div>
                                        <!-- /. tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body pad">
                                        <div class="mb-3">
                                            <img src="{{ asset('storage').'/'.$post->image }}"
                                                alt="{{ $post->seo_title ? $post->seo_title : $post->title }}"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        {{-- ---------------------Post Image End------------------ --}}

                        {{-- ---------------------------- Post SEO ---------------------------- --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Post SEO
                                        </h3>
                                        <!-- tools box -->
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool btn-sm"
                                                data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                <i class="fas fa-minus"></i></button>

                                        </div>
                                        <!-- /. tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body pad">
                                        <div class="mb-3">
                                            <label>Post SEO Title</label>
                                            <br>
                                            {{ $post->seo_title }}
                                            <br>
                                            <label>Post SEO Description</label>
                                            <br>
                                            {{ $post->meta_description }}
                                            <br>
                                            <label>Post Keywords</label>
                                            <br>
                                            {{ $post->meta_keywords }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- --------------------------------End of Post SEO---------------------------------- --}}
                        </div>
                        {{-- -------------------------------------------------------End of Right Panel------------------------------------------------------- --}}
                    </div>
                    {{-- --------------------------------------------------------------------------------------------------------------------- --}}
                </div>

            </div>
        </div>
</section>



@stop

@section('css')
<link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('js')

@stop
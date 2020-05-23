@extends('adminlte::page')

@section('title', 'Post Category')

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
                <li class="breadcrumb-item active">Post Category</li>
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
                    <h3 class="card-title">All Category </h3>
                    <small> Total Count : {{count($categories)}}</small>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create_category">
                        Create Category
                      </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="datatable" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Category</th>
                  <th>Slug</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->slug}}</td>
                    <td class="d-flex justify-content-around">
                    <a href="{{url(config('blog.prefix','admin').'/'.'category').'/'.$category->id.'/edit'}}" target="_blank" class="btn btn-sm btn-warning" title="Edit Category"><i class="fas fa-edit"></i></a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#category-{{$category->id}}">
                      <i class="fas fa-trash"></i>
                    </button>
                    </td>
                    @include('blog::layouts.category.confirm_delete')
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>id</th>
                    <th>Category</th>
                    <th>Slug</th>
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

    {{-- ------Create Category Model --}}
    <div class="modal fade" id="create_category">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Create Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{url(config('blog.prefix','admin').'/'.'category')}}" method="POST">
                @csrf
            <div class="modal-body">
              <p>
            <div class="form-group">
            <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Enter Posts Category">
            <br>
            <input type="text" name="slug" class="form-control" value="{{old('slug')}}" placeholder="Enter Category Slug">
            </div>
              </p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    {{-- -------------------------- --}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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

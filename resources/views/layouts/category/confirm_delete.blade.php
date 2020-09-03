@if (!empty($category))
<div class="modal fade" id="category-{{$category->id}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete Post Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url(config('blog.prefix','admin/blog').'/'.'category').'/'.$category->id}}" method="POST">
        @method('DELETE')
        @csrf
        <div class="modal-body">
          <p>Are you sure you want to delete this category ?
            <br>
            <label>Post Category Name</label>
            <br>
            {{$category->name}}
          </p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" title="Delete category">Yes Delete it.</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endif
<div class="row">
  {{-- -----------------------------------------------------Left Panel----------------------------------------------------- --}}
  <div class="col-lg-8">
    <div class="form-group">

      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                Post Heading
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
              <div class="mb-3">
                {{-- Post Title --}}
                <label for="title">Post Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title"
                  value="{{ !empty($post) ? $post->title : old('title') }}">
                {{-- Post Excerpt --}}
                <label for="post_excerpt">Post Excerpt</label>
                <textarea class="form-control" name="excerpt" rows="3" id="post_excerpt"
                  placeholder="Enter ...">{{!empty($post) ? $post->excerpt : old('excerpt')}}</textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      {{-- Post Body --}}
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info collapsed-card">
            <div class="card-header">
              <h3 class="card-title">
                Post Body
              </h3>
              <!-- tools box -->
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
              <div class="mb-3">
                <textarea class="textarea" name="body" rows="40" placeholder="Place some text here"
                  style="width: 100%; height: 100vh; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 5px;">
              @if (!empty($post))
                  {{$post->body ? $post->body : old('body')}}
              @endif
              </textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <input type="submit" value="Post" class="btn btn-primary btn-block">
      {{-- --------- --}}
    </div>
  </div>
  {{-- -------------------------------------------------------End of Left Panel------------------------------------------------------- --}}

  {{-- ------------------------------------------------------Start of Right Panel------------------------------------------------------ --}}
  <div class="col-lg-4">
    {{-- Post Description --}}
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info collapsed-card">
          <div class="card-header">
            <h3 class="card-title">
              Post Description
            </h3>
            <!-- tools box -->
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
              </button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body pad">
            <div class="mb-3">
              {{-- Author --}}
              {{-- Post Author --}}
              <label for="post_author">Post Author</label>
              <input type="text" class="form-control" placeholder="Post Author" value="{{ Auth::User()->name }}"
                disabled>
              <input type="text" name="author_id" class="form-control" id="post_author" placeholder="Post Author"
                value="{{ Auth::User()->id }}" hidden>
              {{-- ---------- --}}
              {{-- Type --}}
              <label for="post_type">Post Type</label>
              <select id="post_type" name="type" class="form-control">
                <option value="1" {{isset($post->type) ? ($post->type == "Blog" ? 'selected' : '') : ''}}>Blog</option>
                <option value="2" {{isset($post->type) ? ($post->type == "Event" ? 'selected' : '') : ''}}>Event
                </option>
                <option value="3" {{isset($post->type) ? ($post->type == "News" ? 'selected' : '') : ''}}>News</option>
                <option value="4" {{isset($post->type) ? ($post->type == "Job Post" ? 'selected' : '') : ''}}>Job Post
                </option>
              </select>
              {{-- ---------- --}}
              {{-- Category --}}
              <label for="post_category">Post Category</label>
              <select id="post_category" name="category_id" class="form-control">
                @foreach($categories as $category)
                <option value="{{ $category->id }}"
                  {{!empty($post) && $post->category_id ? ($category->id == $post->category_id ? 'selected' : '') : ''}}>
                  {{ $category->name }}</option>
                @endforeach
              </select>
              {{-- ---------- --}}
              {{-- Status --}}
              <label for="post_status">Post Status</label>
              <select id="post_status" name="status" class="form-control">
                <option value="1" {{!empty($post) && $post->status == 1 ? 'selected' : ''}}>Pending</option>
                <option value="2" {{!empty($post) && $post->status == 2 ? 'selected' : ''}}>Draft</option>
                <option value="3" {{!empty($post) && $post->status == 3 ? 'selected' : ''}}>Published</option>
              </select>

              {{-- Post Slug --}}
              <label for="slug">Post Slug</label>
              <input type="text" name="slug" class="form-control" id="slug" placeholder="Enter Post Slug"
                value="{{!empty($post) && $post->slug ? $post->slug : old('slug')}}">
              @if (config('blog.post_tagging','true'))
              {{-- Post Tags --}}
              <label for="post_keyword">Post Tags</label>
              <br>
              {{-- Tagging --}}
              <input type="text" name="tags" id="tags" style="width:100%">
              <script>
                var tags = [
                        @foreach ($tags as $tag)
                        {tag: "{{$tag}}" },
                        @endforeach
                    ];
              </script>
              @endif
              @if (!empty($remove_tags) && !empty($post) && $remove_tags->count() > 0)
              <hr>
              <h3 class="panel-title">
                Remove Existing Tags
              </h3>
              <div class="form-check">

                @foreach ($remove_tags as $tag)
                <input class="form-check-input" type="checkbox" value="{{$tag}}" name="remove_tags[]"
                  aria-label="...">{{$tag}} <br>
                @endforeach

              </div>
              @endif
              {{-- -----Post Featured----- --}}
              <br><br>
              <label for="featured">Featured</label>
              <input type="hidden" name="featured" value="0">
              <input type="checkbox" id="featured" name="featured"
                {{!empty($post) && $post->featured == 1 ? 'checked' : ''}} data-bootstrap-switch data-off-color="danger"
                data-on-color="success" value="1">
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- ----Post Description End----- --}}

    {{-- ---------------------Post Image --------------------- --}}
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info collapsed-card">
          <div class="card-header">
            <h3 class="card-title">
              Post Multimedia
            </h3>
            <!-- tools box -->
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
              </button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body pad">
            {{-- ---------------------Post Images--------------------- --}}
            <div class="mb-3">
              @if (!empty($post) && $post->image)
              <img src="{{asset($post->thumbnail('image','medium'))}}"
                alt="{{$post->seo_title ? $post->seo_title : $post->title}}" class="img-fluid">
              <hr>
              @endif
              <label for="post_image">Post Image</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input" id="post_image">
                  <label class="custom-file-label" for="post_image">Choose file</label>
                </div>
                <div class="input-group-append">
                  <span class="input-group-text" id="">Upload</span>
                </div>
              </div>
            </div>
            {{-- ----------------------------------------------- --}}
            {{-- ---------------------Post Video--------------------- --}}
            <div class="mb-3">
              @if (!empty($post) && $post->video)
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{$post->video}}" allowfullscreen></iframe>
              </div>
              <hr>
              @endif
              <label for="video">Post Video</label>
              <input type="text" name="video" id="video" class="form-control" value="{{$post->video ?? old('video') }}"
                placeholder="Post Video">
            </div>
            {{-- ----------------------------------------------- --}}

          </div>
        </div>
      </div>
    </div>
    {{-- ---------------------Post Image End------------------ --}}

    {{-- ---------------------------- Post SEO ---------------------------- --}}
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info collapsed-card">
          <div class="card-header">
            <h3 class="card-title">
              Post SEO
            </h3>
            <!-- tools box -->
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
              </button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body pad">
            <div class="mb-3">
              {{-- Post SEO Title --}}
              <label for="post_seo_title">Post SEO Title</label>
              <input type="text" name="seo_title" class="form-control" id="post_seo_title" placeholder="Enter SEO Title"
                value="{{!empty($post) && $post->seo_title ? $post->seo_title : ''}}">
              <br>
              {{-- Post Meta Description --}}
              <label for="post_meta_description">Post Meta Description</label>
              <textarea class="form-control" name="meta_description" rows="3" id="meta_description"
                placeholder="Enter ...">
                  {{!empty($post) && $post->meta_description ? $post->meta_description : ''}}
              </textarea>
              <br>
              {{-- Post Keywords --}}

              <label for="post_keyword">Post Keywords</label>
              <input type="text" name="meta_keywords" id="keywords" style="width:100%">
            </div>
          </div>
        </div>
      </div>
      {{-- ------------------------------------------------------------------ --}}
    </div>
    {{-- -------------------------------------------------------End of Right Panel------------------------------------------------------- --}}
  </div>
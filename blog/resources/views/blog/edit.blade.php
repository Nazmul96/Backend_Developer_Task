@extends('dashboard')
@section('page_title', 'Blog List')
@section('content')

<div class="class_button text-end mb-2">
    <a href="{{route('blog.index')}}" class="btn btn-primary"><< back</a>
</div>
<div class="card">
    <div class="card-body table-responsive">
          <form action="{{route('update.blog')}}" method="post">
            @csrf
               <input type="hidden" name="blog_id" value="{{$blog_edit->id}}">
                <div class="col-md-6 form-group">
                        <label for="helpInputTop">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="helpInputTop" placeholder="title" value="{{$blog_edit->title}}">

                        @error('title')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="helpInputTop1">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" name="title" id="helpInputTop1" placeholder="description" cols="30" rows="5">
                           {{$blog_edit->description}} 
                    </textarea>
                    
                    @error('description')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
          </form>
    </div>
</div>

@endsection
@extends('dashboard')
@section('page_title', 'Blog List')
@section('content')

<div class="class_button text-end mb-2">
    <a href="{{route('create.blog')}}" class="btn btn-primary">Add Blog</a>
</div>
<div class="card">
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="card-body table-responsive">
        <div class="row">
            <div class="col-md-2">
                <p><strong>Title:</strong></p>
                <p><strong>Description:</strong></p>
            </div>
            <div class="col-md-8">
                <p>{{$blog_view->title}}</p> 
                <p>{{$blog_view->description}}</p> 
            </div>
        </div>
        @if(Auth::check())
            <div class="comment">
                <form action="{{route('blog.comment.save')}}" method="POST">
                    @csrf
                    <input type="text" name="blog_id" value="{{$blog_view->id}}">
                    <div class="col-md-6 form-group">
                        <label for="helpInputTop1">Cooment</label>
                        <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" name="comment" id="helpInputTop1" placeholder="comment" cols="30" rows="2">
                
                        </textarea>
                        @error('comment')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
         @endif   
    </div>
</div>



@endsection
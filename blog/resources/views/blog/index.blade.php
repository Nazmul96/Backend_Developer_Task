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
            <table class="table table-bordered table-bordered dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach($blogs as $blog)
                        <tr>
                            <td>{{substr($blog->title,0,20).'...'}}</td>
                            <td>{{substr($blog->slug,0,20).'...'}}</td>
                            <td>{{substr($blog->description,0,20).'...'}}</td>
                            <td>
                                <a href="{{route('edit.blog',$blog->id)}}" class="btn btn-sm btn-primary" >Edit</a>
                                <a href="{{route('view.blog',$blog->id)}}" class="btn btn-sm btn-info" >view</a>
                                <a href="{{route('delete.blog',$blog->id)}}" id="delete" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                     @endforeach
                </tbody>
            </table>
    </div>
</div>

@endsection
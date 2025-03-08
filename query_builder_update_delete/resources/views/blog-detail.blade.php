@extends('templates.master')
@section('title', 'Blog Detail')

@section('content')
<div class="container">
    <div class="mt-5">
        <h2 class="text-center fw-bold">{{ $blog->title }}</h2>
        <div class="body-table">
            <p>{{ $blog->description }}</p>
            <div class="d-flex flex-column align-items-end">
                <div>{{ $blog->created_at }}</div>
                <div>by admin</div>
            </div>
        </div>
    </div>
</div>
@endsection
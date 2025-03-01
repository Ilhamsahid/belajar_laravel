@extends('templates.master')
@section('title', 'Blog List')

@section('content')
<div class="container">
    <div class="mt-5">
        <h1 class="text-center fw-bold">Blog List</h1>

        <div class="container mt-4">
            <a class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addBlog">Add New</a>
            @if (Session::has('message'))
                <p class="mt-3 alert alert-success">{{ Session::get('message') }}</p>
            @endif
        </div>

        <div class="container mt-4">
            <div class="search-container text-center">
                <form method="GET">
                    <div class="input-group">
                        <input type="text" name="title" value="{{ $title }}" class="form-control search-input common-input" placeholder="Masukkan kata kunci...">
                        <button type="submit" class="btn search-btn">🔍 Find</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-container mt-4">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() == 0)
                            <tr>
                                <td colspan="3">No Data Found with <strong>{{ $title }}</strong> Keyword</td>
                            </tr>
                        @endif
                        @foreach($data as $item)
                            <tr>
                                <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->index + 1 }}</td>
                                <td class="text-start">{{ $item->title }}</td>
                                <td>
                                    <a href="{{ route('blog.show', $item->id) }}" class="btn btn-action btn-view">🔍 View</a>
                                    <a href="#" class="btn btn-action btn-edit">✏ Edit</a>
                                    <a href="#" class="btn btn-action btn-delete">🗑 Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $data->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</div>

<div class="modal fade" id="addBlog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Blog</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAdd" action="{{ route('blog.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input name="title" type="text" class="form-control common-input" id="title">
                        <div class="text-danger" id="errorTitle"></div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control common-input" id="description"></textarea>
                        <div class="text-danger" id="errorDescription"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="submitBtn" class="btn btn-primary">Save</button>
                    </div>
                </form>
        </div>
    </div>
</div>

<script>
    document.getElementById("submitBtn").addEventListener("click", async function () {
        let form = document.getElementById("formAdd");
        let formData = new FormData(form);

        try {
            let response = await fetch(form.action, {
                method: "POST",
                body: formData,
                headers: { "X-Requested-With": "XMLHttpRequest" }
            });

            let data = await response.json();

            document.getElementById("errorTitle").innerText = data.errors?.title?.[0] || "";
            document.getElementById("errorDescription").innerText = data.errors?.description?.[0] || "";

            if (!data.errors) window.location.reload();
        } catch (error) {
            console.error(error);
        }
    });
</script>
@endsection
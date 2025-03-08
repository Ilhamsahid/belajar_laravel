@extends('templates.master')
@section('title', 'Blog List')

@section('content')

<div class="container">
    <div class="mt-5">
        <h1 class="text-center fw-bold">Blog List</h1>

        <div class="container mt-4">
            <Add class="btn add-btn addModal" data-bs-toggle="modal" data-bs-target="#modal" data-action="">Add New</a>
        </div>

        <div class="container mt-4">
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
                                    <a href="#" id="editBtn" class="btn btn-action btn-edit updateModal" data-bs-toggle="modal" data-bs-target="#modal" data-action="{{ route('blog.update', $item->id) }}" data-id="{{$item->id}}">✏ Edit</a>
                                    <a href="{{ route('blog.delete', $item->id) }}" class="btn btn-action btn-delete" >🗑 Delete</a>
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

@component('components.modal')@endcomponent

<script>
    document.getElementById("submitBtn").addEventListener("click", async function () {
        let form = document.getElementById("form");
        let formData = new FormData(form);
        let method = form.getAttribute('data-method') || "POST";

        if(method === "PUT"){
            formData.append("_method", "PUT");
        }

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
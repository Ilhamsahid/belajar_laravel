<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="container">
        <div class="mt-5">
            <h1 class="text-center fw-bold">Blog List</h1>

            <div class="container mt-4">
                <div class="search-container text-center">
                    <form method="GET">
                        <div class="input-group">
                            <input type="text" name="title" value="{{ $title }}" class="form-control search-input" placeholder="Masukkan kata kunci..." required>
                            <button type="submit" class="btn search-btn">🔍 Cari</button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

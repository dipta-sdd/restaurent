<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $item->name }} - Details</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/admin_style.css" rel="stylesheet">
    <style>
        .item-image {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .item-image:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    @include('admin.header')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-2">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">{{ $item->name }} Details</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="{{ url('/admin/items') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Items
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        @if($item->image)
                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="item-image"
                            id="itemImagePreview" data-bs-toggle="modal" data-bs-target="#itemImageModal">
                        @else
                        <div class="text-center">No Image Available</div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Item Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Subcategory:</strong> {{ $item->subcategory->name }}</p>
                                        <p><strong>Price:</strong> {{ number_format($item->price, 2) }}</p>
                                        <p><strong>Description:</strong> {{ $item->description ?? "N/A" }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Allergens:</strong> {{ $item->allergens ?? "N/A" }}</p>
                                        <p><strong>Dietary Options:</strong> {{ $item->dietary_options ?? "N/A" }}</p>
                                        <p><strong>Created At:</strong> {{ $item->created_at->format('d M, Y, H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4" id="manage_variant">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Create New Variant</h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation">
                            @csrf
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Variant Name <small
                                        class="text-danger">*</small></label>
                                <input type="text" id="name" class="form-control" name="name" required />
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price <small class="text-danger">*</small></label>
                                <input type="number" id="price" class="form-control" name="price" step="0.01"
                                    required />
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" class="form-control" name="status">
                                    <option value="available">Available</option>
                                    <option value="outofstok">Out of stock</option>
                                </select>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary save">
                                    <i class="fas fa-plus"></i> Add Variant
                                </button>
                                <button type="submit" class="btn btn-primary update d-none">
                                    <i class="fas fa-save"></i> Update Variant
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Variants List</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th>Updated By</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="variants-table text-capitalize" id="variantsTbody">
                                    @foreach ($item->variants as $variant)
                                    <tr id="tr-{{ $variant->id }}">
                                        <td>{{ $variant->id }}</td>
                                        <td>{{ $variant->name }}</td>
                                        <td data-price="{{$variant->price}}">{{ number_format($variant->price, 2) }}
                                        </td>
                                        <td>{{ $variant->status }}</td>
                                        <td>{{ $variant->created_by_name }}</td>
                                        <td>{{ $variant->created_at->format('d M, Y, H:i') }}</td>
                                        <td>{{ $variant->updated_by_name }}</td>
                                        <td>{{ $variant->updated_at->format('d M, Y, H:i') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger delete" data-id="{{ $variant->id }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="itemImageModal" tabindex="-1" aria-labelledby="itemImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemImageModalLabel">{{ $item->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    @if($item->image)
                    <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="img-fluid">
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/script.js"></script>

    <script>
        $(document).ready(function() {
            // Variant Add Functionality
            $('#manage_variant form .save').click(function(e) {
                e.preventDefault();
                let data = collectData('#manage_variant form .form-control');
                data.item_id = $('input[name="item_id"]').val();
                console.log(data);

                $.ajax({
                    type: "post",
                    url: "/api/admin/variant",
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(response) {
                        $('#variantsTbody').append(`
                        <tr id="tr-${response.id}">
                            <td>${response.id}</td>
                            <td>${response.name}</td>
                            <td data-price="${response.price}">${parseFloat(response.price).toFixed(2)}</td>
                            <td>${response.status}</td>
                            <td>${response.created_by}</td>
                            <td>${myDateFormat(response.created_at)}</td>
                            <td>${response.updated_by}</td>
                            <td>${myDateFormat(response.updated_at)}</td>
                            <td>
                                <button class="btn btn-sm btn-primary edit">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger delete" data-id="${response.id}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    `);

                        // Reset form
                        $('#manage_variant form .form-control').val('');
                        showToast('Variant added successfully', 'success');
                    },
                    error: function(xhr) {
                        let res = xhr.responseJSON;
                        if (res.errors) {
                            labelErrors('#manage_variant form .form-control', res.errors);
                        } else {
                            showToast('Internal server error', 'danger');
                        }
                    }
                });
            });

            // Edit Variant Functionality
            $(document).on('click', '#variantsTbody .btn.btn-primary.edit', function(e) {
                e.preventDefault();
                const tr = $(this).closest('tr');
                const id = tr.find('td').eq(0).text().trim();
                const data = {
                    name: tr.find('td').eq(1).text().trim(),
                    price: tr.find('td').eq(2).data('price').trim(),
                    status: tr.find('td').eq(3).text().trim()
                };
                console.table(data);
                loadData('#manage_variant form .form-control', data);
                $('#manage_variant form .update').attr('data-id', id);
                $('#manage_variant form button.save').addClass('d-none');
                $('#manage_variant form button.update').removeClass('d-none');
                $('#manage_variant .card-title').text('Update Variant');
            });

            // Update Variant Functionality
            $('#manage_variant form .update').click(function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                let data = collectData('#manage_variant form .form-control');

                $.ajax({
                    type: "post",
                    url: "/api/admin/variant/" + id,
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(response) {
                        let $row = $('#tr-' + id);
                        $row.find('td').eq(1).text(response.name);
                        $row.find('td').eq(2).text(parseFloat(response.price).toFixed(2));
                        $row.find('td').eq(3).text(response.status);
                        $row.find('td').eq(6).text(response.updated_by);
                        $row.find('td').eq(7).text(myDateFormat(response.updated_at));

                        showToast('Variant updated successfully', 'success');
                        $('#manage_variant form .form-control').val('');
                        $('#manage_variant form button.save').removeClass('d-none');
                        $('#manage_variant form button.update').addClass('d-none');
                        $('#manage_variant .card-title').text('Create New Variant');
                    },
                    error: function(xhr) {
                        let res = xhr.responseJSON;
                        if (res.errors) {
                            labelErrors('#manage_variant form .form-control', res.errors);
                        } else {
                            showToast('Internal server error', 'danger');
                        }
                    }
                });
            });

            // Delete Variant Functionality
            $(document).on('click', '#variantsTbody .btn.btn-danger.delete', function(e) {
                e.preventDefault();
                const id = $(this).data('id');

                $.ajax({
                    type: "delete",
                    url: "/api/admin/variant/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function() {
                        $('#tr-' + id).remove();
                        showToast('Variant deleted successfully', 'success');
                    },
                    error: function() {
                        showToast('Error deleting variant', 'danger');
                    }
                });
            });
        });
    </script>
</body>

</html>
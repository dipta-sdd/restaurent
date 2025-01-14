<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Bangla Tandoori Restauresnt') }}</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/admin_style.css" rel="stylesheet">
</head>

<body>
    @include('admin.header')


    <div class="container-fluid">
        <div class="row">

            @include('admin.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-2">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Categories</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary me-2" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </div>
                <!-- this is how you saw a data sended from backed -->
                <!-- {{ json_encode($subcategories) }} -->
                <div class="card mb-4 p-none" id="manage_category">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Create New Category</h5>
                    </div>
                    <div class="card-body">
                        <form action="/create-supply" method="post" class="row g-3 needs-validation">
                            @csrf
                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Type <small
                                        class="text-danger">*</small></label>
                                <select id="category_id" class="form-control" name="category_id" required>
                                    <option value="">Select Type</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="name" class="form-label">Category Name <small
                                        class="text-danger">*</small></label>
                                <input type="text" id="name" class="form-control" name="name" />
                                <small class="text-danger"></small>
                            </div>
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" id="description" class="form-control" name="description" />
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary save">
                                    <i class="fas fa-plus"></i> Add New
                                </button>
                                <button type="submit" class="btn btn-primary update d-none">
                                    <i class="fas fa-save"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0 ">Category List</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Type</th>
                                                <th>Category Name</th>
                                                <th>Description</th>
                                                <th>Created By</th>
                                                <th>Created At</th>
                                                <th>Updated By</th>
                                                <th>Updated At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="supply-table text-capitalize" id="subTobdy">
                                            @foreach ($subcategories as $item)
                                            <tr id="tr-{{ $item->id }}">
                                                <td>{{ $item->id }}</td>
                                                <td data-val="{{ $item->category_id }}">{{ $item->type }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->description ?? "N/A"}}</td>
                                                <td>{{ $item->created_by ?? 'N/A'}}</td>
                                                <td>{{ $item->created_at ? $item->created_at->format('d M, Y, H:i') : 'N/A' }}
                                                </td>
                                                <td>{{ $item->updated_by ?? 'N/A'}}</td>
                                                <td>{{ $item->updated_at ? $item->updated_at->format('d M, Y, H:i') : 'N/A' }}
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary mb-2">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-danger mb-2"
                                                        data-id="{{ $item->id }}">
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
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/admin.js"></script>
    <script>
        $(document).ready(function() {
            const idToType = ['', 'Food', 'Drinks', ];
            $('#manage_category form .save').click(function(e) {
                e.preventDefault();
                let data = collectData('#manage_category form .form-control');
                $.ajax({
                    type: "post",
                    url: "/api/admin/category",
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },

                    success: function(response) {
                        // add new category
                        $('#subTobdy').append(`
                            <tr id="tr-${response.id}">
                                <td>${response.id}</td>
                                <td data-val="${response.category_id}">${idToType[response.category_id]}</td>
                                <td>${response.name}</td>
                                <td>${response.description ?? "N/A"}</td>
                                <td>${response.created_by}</td>
                                <td>${myDateFormat(response.created_at)}</td>
                                <td>${response.updated_by}</td>
                                <td>${myDateFormat(response.updated_at)}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary mb-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger mb-2" data-id="${response.id}">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        `);
                        // clear input
                        $('#manage_category form .form-control').val('');
                        // clear error
                        $('#manage_category form .form-control+small.text-danger').html('');
                        $('#manage_category form .form-control').removeClass('is-invalid');
                        showToast('Category added successfully', 'success');
                    },
                    error: function(xhr) {
                        res = xhr.responseJSON;
                        if (res.errors) {
                            // console.table(res.errors);
                            // display errors
                            labelErrors('#manage_category form .form-control', res.errors);
                        } else showToast('Internal server error', 'danger');
                    }
                });
            });
            // on edit click load data to form
            $(document).on('click', '#subTobdy .btn.btn-primary', function(e) {
                e.preventDefault();
                const tr = $(this).closest('tr');

                const id = tr.find('td').eq(0).text().trim();
                const data = {
                    category_id: tr.find('td').eq(1).data('val'),
                    name: tr.find('td').eq(2).text().trim(),
                    description: tr.find('td').eq(3).text().trim() == 'N/A' ? '' : tr.find('td').eq(3)
                        .text().trim(),
                };
                loadData('#manage_category form .form-control', data);
                $('#manage_category form .update').attr('data-id', id);
                $('#manage_category form button.save').addClass('d-none');
                $('#manage_category form button.update').removeClass('d-none');
                $('#manage_category .card-title').text('Update Category');
            });
            // update click
            $('#manage_category form .update').click(function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                let data = collectData('#manage_category form .form-control');
                $.ajax({
                    type: "post",
                    url: "/api/admin/category/" + id,
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },

                    success: function(response) {
                        // update category

                        $('#tr-' + id).find('td').eq(1).text(idToType[response.category_id]);
                        $('#tr-' + id).find('td').eq(2).text(response.name);
                        $('#tr-' + id).find('td').eq(3).text(response.description ?? "N/A");
                        $('#tr-' + id).find('td').eq(6).text(response.updated_by);
                        $('#tr-' + id).find('td').eq(7).text(myDateFormat(response.updated_at));
                        // clear input
                        $('#manage_category form .form-control').val('');
                        // clear error
                        $('#manage_category form .form-control+small.text-danger').html('');
                        $('#manage_category form .form-control').removeClass('is-invalid');
                        // hide update button
                        $('#manage_category form button.update').addClass('d-none');
                        $('#manage_category form button.save').removeClass('d-none');
                        // change title
                        $('#manage_category .card-title').text('Create New Category');
                        showToast('Category updated successfully', 'success');
                    },
                    error: function(xhr) {
                        res = xhr.responseJSON;
                        if (res.errors) {
                            // console.table(res.errors);    
                            // display errors
                            labelErrors('#manage_category form .form-control', res.errors);
                        } else showToast('Internal server error', 'danger');
                    }
                });
            });
            // click on delete button
            $('#subTobdy .btn.btn-danger').click(function(e) {
                e.preventDefault();
                // alert('Are you sure you want to delete this category?');
                let id = $(this).attr('data-id');
                $.ajax({
                    type: "delete",
                    url: "/api/admin/category/" + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(response) {
                        $('#tr-' + id).remove();
                        showToast('Category deleted successfully', 'success');
                    },
                    error: function(xhr, status, error) {
                        // console.log(xhr);
                        // console.log(status);
                        // console.log(error);
                        showToast('Internal server error', 'danger');
                    }
                });
            });

        });
    </script>
</body>

</html>
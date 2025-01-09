<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Bangla Tandoori Restaurant') }}</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/admin_style.css') }}" rel="stylesheet">
</head>

<body>
    @include('admin.header')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Tables Management</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary me-2" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </div>

                <div class="card mb-4" id="manage_table">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Create New Table</h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation">
                            @csrf
                            <input type="hidden" id="table_id">
                            <div class="col-md-6">
                                <label for="capacity" class="form-label">Capacity <small class="text-danger">*</small></label>
                                <input type="number" id="capacity" class="form-control" name="capacity" min="1" required>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status <small class="text-danger">*</small></label>
                                <select id="status" class="form-control" name="status" required>
                                    <option value="available">Available</option>
                                    <option value="occupied">Occupied</option>
                                    <option value="reserved">Reserved</option>
                                    <option value="maintenance">Maintenance</option>
                                </select>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary save">
                                    <i class="fas fa-plus"></i> Add New
                                </button>
                                <button type="button" class="btn btn-primary update d-none">
                                    <i class="fas fa-save"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tables List</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Capacity</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th>Updated By</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tables-tbody">
                                    @foreach ($tables as $table)
                                    <tr id="tr-{{ $table->id }}">
                                        <td>{{ $table->id }}</td>
                                        <td>{{ $table->capacity }}</td>
                                        <td>
                                            <span class="badge bg-{{ $table->status == 'available' ? 'success' : ($table->status == 'occupied' ? 'danger' : ($table->status == 'reserved' ? 'warning' : 'secondary')) }}">
                                                {{ ucfirst($table->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $table->creator_name }}</td>
                                        <td>{{ $table->created_at ? date('d M, Y, H:i', strtotime($table->created_at)) : 'N/A' }}</td>
                                        <td>{{ $table->updater_name }}</td>
                                        <td>{{ $table->updated_at ? date('d M, Y, H:i', strtotime($table->updated_at)) : 'N/A' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger delete" data-id="{{ $table->id }}">
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

    <script src="{{ asset('/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/js/popper.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Add new table
            $('#manage_table form .save').click(function(e) {
                e.preventDefault();
                const data = {
                    capacity: $('#capacity').val(),
                    status: $('#status').val()
                };

                $.ajax({
                    type: "POST",
                    url: "/api/admin/table",
                    data: data,
                    success: function(response) {
                        const statusClass = getStatusClass(response.status);
                        $('#tables-tbody').prepend(`
                            <tr id="tr-${response.id}">
                                <td>${response.id}</td>
                                <td>${response.capacity}</td>
                                <td>
                                    <span class="badge bg-${statusClass}">
                                        ${response.status.charAt(0).toUpperCase() + response.status.slice(1)}
                                    </span>
                                </td>
                                <td>${response.creator_name}</td>
                                <td>${new Date(response.created_at).toLocaleString()}</td>
                                <td>${response.updater_name}</td>
                                <td>${new Date(response.updated_at).toLocaleString()}</td>
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

                        // Clear form
                        $('#manage_table form')[0].reset();
                        showToast('Table added successfully', 'success');
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            labelErrors('#manage_table form .form-control', xhr.responseJSON.errors);
                        } else {
                            showToast('Error adding table', 'danger');
                        }
                    }
                });
            });

            // Edit table
            $(document).on('click', '.edit', function() {
                const tr = $(this).closest('tr');
                const id = tr.find('td').eq(0).text().trim();
                const capacity = tr.find('td').eq(1).text().trim();
                const status = tr.find('td').eq(2).text().trim().toLowerCase();

                $('#table_id').val(id);
                $('#capacity').val(capacity);
                $('#status').val(status);

                $('#manage_table .card-title').text('Update Table');
                $('#manage_table form .save').addClass('d-none');
                $('#manage_table form .update').removeClass('d-none');

                $('html, body').animate({
                    scrollTop: $('#manage_table').offset().top
                }, 'slow');
            });

            // Update table
            $('#manage_table form .update').click(function(e) {
                e.preventDefault();
                const id = $('#table_id').val();
                const data = {
                    capacity: $('#capacity').val(),
                    status: $('#status').val()
                };

                $.ajax({
                    type: "POST",
                    url: `/api/admin/table/${id}`,
                    data: data,
                    success: function(response) {
                        const statusClass = getStatusClass(response.status);
                        $(`#tr-${id}`).html(`
                            <td>${response.id}</td>
                            <td>${response.capacity}</td>
                            <td>
                                <span class="badge bg-${statusClass}">
                                    ${response.status.charAt(0).toUpperCase() + response.status.slice(1)}
                                </span>
                            </td>
                            <td>${response.creator_name}</td>
                            <td>${new Date(response.created_at).toLocaleString()}</td>
                            <td>${response.updater_name}</td>
                            <td>${new Date(response.updated_at).toLocaleString()}</td>
                            <td>
                                <button class="btn btn-sm btn-primary edit">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger delete" data-id="${response.id}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        `);

                        // Reset form
                        $('#manage_table form')[0].reset();
                        $('#table_id').val('');
                        $('#manage_table .card-title').text('Create New Table');
                        $('#manage_table form .save').removeClass('d-none');
                        $('#manage_table form .update').addClass('d-none');

                        showToast('Table updated successfully', 'success');
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            labelErrors('#manage_table form .form-control', xhr.responseJSON.errors);
                        } else {
                            showToast('Error updating table', 'danger');
                        }
                    }
                });
            });

            // Delete table
            $(document).on('click', '.delete', function() {
                if (confirm('Are you sure you want to delete this table?')) {
                    const id = $(this).data('id');
                    $.ajax({
                        type: "DELETE",
                        url: `/api/admin/table/${id}`,
                        success: function(response) {
                            $(`#tr-${id}`).remove();
                            showToast('Table deleted successfully', 'success');
                        },
                        error: function(xhr) {
                            showToast('Error deleting table', 'danger');
                        }
                    });
                }
            });

            // Helper function to get status badge class
            function getStatusClass(status) {
                switch (status) {
                    case 'available':
                        return 'success';
                    case 'occupied':
                        return 'danger';
                    case 'reserved':
                        return 'warning';
                    default:
                        return 'secondary';
                }
            }
        });
    </script>
</body>

</html>

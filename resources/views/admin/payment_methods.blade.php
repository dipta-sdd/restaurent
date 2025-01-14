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

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/admin_style.css" rel="stylesheet">
</head>

<body>
    @include('admin.header')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Payment Methods Management</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary me-2" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </div>

                <div class="card mb-4" id="manage_payment_method">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Create New Payment Method</h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation">
                            @csrf
                            <input type="hidden" id="payment_method_id">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name <small class="text-danger">*</small></label>
                                <input type="text" id="name" class="form-control" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status <small class="text-danger">*</small></label>
                                <select id="status" class="form-control" name="status" required>
                                    @foreach($statusOptions as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" class="form-control" name="description" rows="3"></textarea>
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
                        <h5 class="card-title mb-0">Payment Methods List</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th>Updated By</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="payment-methods-tbody">
                                    @foreach ($paymentMethods as $method)
                                    <tr id="tr-{{ $method->id }}">
                                        <td>{{ $method->id }}</td>
                                        <td>{{ $method->name }}</td>
                                        <td>{{ $method->description }}</td>
                                        <td>
                                            <span class="badge bg-{{ $method->status == 'active' ? 'success' : 'danger' }}">
                                                {{ $statusOptions[$method->status] }}
                                            </span>
                                        </td>
                                        <td>{{ $method->creator_name }}</td>
                                        <td>{{ $method->created_at ? date('d M, Y, H:i', strtotime($method->created_at)) : 'N/A' }}</td>
                                        <td>{{ $method->updater_name }}</td>
                                        <td>{{ $method->updated_at ? date('d M, Y, H:i', strtotime($method->updated_at)) : 'N/A' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger delete" data-id="{{ $method->id }}">
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

    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/script.js"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Add new payment method
            $('#manage_payment_method form .save').click(function(e) {
                e.preventDefault();
                const data = {
                    name: $('#name').val(),
                    description: $('#description').val(),
                    status: $('#status').val()
                };

                $.ajax({
                    type: "POST",
                    url: "/api/admin/payment-method",
                    data: data,
                    success: function(response) {
                        const statusClass = response.status === 'active' ? 'success' : 'danger';
                        $('#payment-methods-tbody').prepend(`
                            <tr id="tr-${response.id}">
                                <td>${response.id}</td>
                                <td>${response.name}</td>
                                <td>${response.description || ''}</td>
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
                        $('#manage_payment_method form')[0].reset();
                        showToast('Payment method added successfully', 'success');
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            labelErrors('#manage_payment_method form .form-control', xhr.responseJSON.errors);
                        } else {
                            showToast('Error adding payment method', 'danger');
                        }
                    }
                });
            });

            // Edit payment method
            $(document).on('click', '.edit', function() {
                const tr = $(this).closest('tr');
                const id = tr.find('td').eq(0).text().trim();
                const name = tr.find('td').eq(1).text().trim();
                const description = tr.find('td').eq(2).text().trim();
                const status = tr.find('td').eq(3).text().trim().toLowerCase();

                $('#payment_method_id').val(id);
                $('#name').val(name);
                $('#description').val(description);
                $('#status').val(status);

                $('#manage_payment_method .card-title').text('Update Payment Method');
                $('#manage_payment_method form .save').addClass('d-none');
                $('#manage_payment_method form .update').removeClass('d-none');

                $('html, body').animate({
                    scrollTop: $('#manage_payment_method').offset().top
                }, 'slow');
            });

            // Update payment method
            $('#manage_payment_method form .update').click(function(e) {
                e.preventDefault();
                const id = $('#payment_method_id').val();
                const data = {
                    name: $('#name').val(),
                    description: $('#description').val(),
                    status: $('#status').val()
                };

                $.ajax({
                    type: "POST",
                    url: `/api/admin/payment-method/${id}`,
                    data: data,
                    success: function(response) {
                        const statusClass = response.status === 'active' ? 'success' : 'danger';
                        $(`#tr-${id}`).html(`
                            <td>${response.id}</td>
                            <td>${response.name}</td>
                            <td>${response.description || ''}</td>
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
                        $('#manage_payment_method form')[0].reset();
                        $('#payment_method_id').val('');
                        $('#manage_payment_method .card-title').text('Create New Payment Method');
                        $('#manage_payment_method form .save').removeClass('d-none');
                        $('#manage_payment_method form .update').addClass('d-none');

                        showToast('Payment method updated successfully', 'success');
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            labelErrors('#manage_payment_method form .form-control', xhr.responseJSON.errors);
                        } else {
                            showToast('Error updating payment method', 'danger');
                        }
                    }
                });
            });

            // Delete payment method
            $(document).on('click', '.delete', function() {
                if (confirm('Are you sure you want to delete this payment method?')) {
                    const id = $(this).data('id');
                    $.ajax({
                        type: "DELETE",
                        url: `/api/admin/payment-method/${id}`,
                        success: function(response) {
                            $(`#tr-${id}`).remove();
                            showToast('Payment method deleted successfully', 'success');
                        },
                        error: function(xhr) {
                            showToast('Error deleting payment method', 'danger');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
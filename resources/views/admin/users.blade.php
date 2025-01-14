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
                    <h1 class="h2">User Management</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary me-2" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </div>

                <div class="card mb-4" id="manage_user">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Create New User</h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation">
                            @csrf
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name <small class="text-danger">*</small></label>
                                <input type="text" id="first_name" class="form-control" name="first_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name <small class="text-danger">*</small></label>
                                <input type="text" id="last_name" class="form-control" name="last_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                                <input type="email" id="email" class="form-control" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone <small class="text-danger">*</small></label>
                                <input type="text" id="phone" class="form-control" name="phone" required>
                            </div>
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role <small class="text-danger">*</small></label>
                                <select id="role" class="form-control" name="role" required>
                                    @foreach($roles as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status <small class="text-danger">*</small></label>
                                <select id="status" class="form-control" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password <small class="text-danger password-required">*</small></label>
                                <input type="password" id="password" class="form-control" name="password" required>
                                <small class="text-muted">Leave empty to keep current password when updating</small>
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

                <div class="row mb-3">
                    <div class="col-md-2">
                        <select id="filter_role" class="form-select">
                            <option value="">All Roles</option>
                            @foreach($roles as $value => $label)
                                <option value="{{ $value }}" {{ request()->query('role') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Users List</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th>Updated By</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="usersTbody">
                                    @foreach($users as $user)
                                    <tr id="tr-{{ $user->id }}">
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $roles[$user->role] }}</td>
                                        <td>
                                            <span class="badge bg-{{ $user->status == 'active' ? 'success' : 'danger' }}">
                                                {{ ucfirst($user->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $user->creator_name ?? 'N/A' }}</td>
                                        <td>{{ $user->created_at ? date('d M, Y, H:i', strtotime($user->created_at)) : 'N/A' }}</td>
                                        <td>{{ $user->updater_name ?? 'N/A' }}</td>
                                        <td>{{ $user->updated_at ? date('d M, Y, H:i', strtotime($user->updated_at)) : 'N/A' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger delete" data-id="{{ $user->id }}">
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

            // Add new user
            $('#manage_user form .save').click(function(e) {
                e.preventDefault();
                const formData = {
                    first_name: $('#first_name').val(),
                    last_name: $('#last_name').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    role: $('#role').val(),
                    status: $('#status').val() || 'active',
                    password: $('#password').val()
                };

                console.log('Form Data:', formData); // Debug log

                $.ajax({
                    type: "POST",
                    url: "/api/admin/user",
                    data: formData,
                    success: function(response) {
                        console.log('Response:', response); // Debug log
                        const user = response.user;
                        const statusClass = user.status === 'active' ? 'success' : 'danger';
                        $('#usersTbody').prepend(`
                            <tr id="tr-${user.id}">
                                <td>${user.id}</td>
                                <td>${user.first_name}</td>
                                <td>${user.last_name}</td>
                                <td>${user.email}</td>
                                <td>${user.phone}</td>
                                <td>${response.role_display}</td>
                                <td>
                                    <span class="badge bg-${statusClass}">
                                        ${user.status.charAt(0).toUpperCase() + user.status.slice(1)}
                                    </span>
                                </td>
                                <td>${user.creator_name}</td>
                                <td>${new Date(user.created_at).toLocaleString()}</td>
                                <td>${user.updater_name}</td>
                                <td>${new Date(user.updated_at).toLocaleString()}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger delete" data-id="${user.id}">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        `);

                        // Clear form
                        $('#manage_user form')[0].reset();
                        // Reset status to active
                        $('#status').val('active');
                        showToast('User added successfully', 'success');
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr); // Debug log
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            labelErrors('#manage_user form .form-control', xhr.responseJSON.errors);
                        } else {
                            showToast('Error adding user', 'danger');
                        }
                    }
                });
            });

            // Edit user
            $(document).on('click', '.edit', function() {
                const tr = $(this).closest('tr');
                const id = tr.find('td').eq(0).text().trim();
                const statusText = tr.find('td').eq(6).find('span').text().trim();
                const status = statusText.toLowerCase();
                console.log('Edit - Current Status:', status);

                const role = tr.find('td').eq(5).text().trim().toLowerCase();

                $('#first_name').val(tr.find('td').eq(1).text().trim());
                $('#last_name').val(tr.find('td').eq(2).text().trim());
                $('#email').val(tr.find('td').eq(3).text().trim());
                $('#phone').val(tr.find('td').eq(4).text().trim());
                $('#role').val(role === 'customer' ? 'user' : role);
                $('#status').val(status);
                $('#password').val('');

                $('#manage_user form .update').attr('data-id', id);
                $('#manage_user form .save').addClass('d-none');
                $('#manage_user form .update').removeClass('d-none');
                $('#manage_user .card-title').text('Update User');
                $('#password').prop('required', false);
                $('.password-required').addClass('d-none');

                $('html, body').animate({
                    scrollTop: $('#manage_user').offset().top
                }, 'slow');
            });

            // Update user
            $('#manage_user form .update').click(function(e) {
                e.preventDefault();
                const id = $(this).attr('data-id');
                const selectedStatus = $('#status').val();
                console.log('Selected status for update:', selectedStatus);

                const formData = {
                    first_name: $('#first_name').val(),
                    last_name: $('#last_name').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    role: $('#role').val(),
                    status: selectedStatus,
                    password: $('#password').val()
                };

                console.log('Update Form Data:', formData);

                $.ajax({
                    type: "POST",
                    url: `/api/admin/user/${id}`,
                    data: formData,
                    success: function(response) {
                        console.log('Update Response:', response);
                        const user = response.user;
                        const statusClass = user.status === 'active' ? 'success' : 'danger';
                        $(`#tr-${id}`).html(`
                            <td>${user.id}</td>
                            <td>${user.first_name}</td>
                            <td>${user.last_name}</td>
                            <td>${user.email}</td>
                            <td>${user.phone}</td>
                            <td>${response.role_display}</td>
                            <td>
                                <span class="badge bg-${statusClass}">
                                    ${user.status.charAt(0).toUpperCase() + user.status.slice(1)}
                                </span>
                            </td>
                            <td>${user.creator_name}</td>
                            <td>${new Date(user.created_at).toLocaleString()}</td>
                            <td>${user.updater_name}</td>
                            <td>${new Date(user.updated_at).toLocaleString()}</td>
                            <td>
                                <button class="btn btn-sm btn-primary edit">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger delete" data-id="${user.id}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        `);

                        // Reset form
                        $('#manage_user form')[0].reset();
                        $('#manage_user form .save').removeClass('d-none');
                        $('#manage_user form .update').addClass('d-none');
                        $('#manage_user .card-title').text('Create New User');
                        $('#password').prop('required', true);
                        $('.password-required').removeClass('d-none');

                        showToast('User updated successfully', 'success');
                    },
                    error: function(xhr) {
                        console.log('Update Error:', xhr);
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            labelErrors('#manage_user form .form-control', xhr.responseJSON.errors);
                        } else {
                            showToast('Error updating user', 'danger');
                        }
                    }
                });
            });

            // Delete user
            $(document).on('click', '.delete', function() {
                if (confirm('Are you sure you want to delete this user?')) {
                    const id = $(this).data('id');
                    $.ajax({
                        type: "DELETE",
                        url: `/api/admin/user/${id}`,
                        success: function(response) {
                            $(`#tr-${id}`).remove();
                            showToast('User deleted successfully', 'success');
                        },
                        error: function(xhr) {
                            showToast(xhr.responseJSON?.message || 'Error deleting user', 'danger');
                        }
                    });
                }
            });

            // Filter users by role
            $('#filter_role').change(function() {
                const role = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "/api/admin/users",
                    data: { role: role },
                    success: function(response) {
                        $('#usersTbody').empty();
                        response.users.forEach(user => {
                            const statusClass = user.status === 'active' ? 'success' : 'danger';
                            $('#usersTbody').append(`
                                <tr id="tr-${user.id}">
                                    <td>${user.id}</td>
                                    <td>${user.first_name}</td>
                                    <td>${user.last_name}</td>
                                    <td>${user.email}</td>
                                    <td>${user.phone}</td>
                                    <td>${user.role_display}</td>
                                    <td>
                                        <span class="badge bg-${statusClass}">
                                            ${user.status.charAt(0).toUpperCase() + user.status.slice(1)}
                                        </span>
                                    </td>
                                    <td>${user.creator_name || 'N/A'}</td>
                                    <td>${new Date(user.created_at).toLocaleString()}</td>
                                    <td>${user.updater_name || 'N/A'}</td>
                                    <td>${new Date(user.updated_at).toLocaleString()}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger delete" data-id="${user.id}">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            `);
                        });
                    },
                    error: function(xhr) {
                        showToast('Error filtering users', 'danger');
                    }
                });
            });
        });
    </script>
</body>

</html>
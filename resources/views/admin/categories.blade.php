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

    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/admin_style.css') }}" rel="stylesheet">
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
                        <div class="btn-group me-2">
                            <a type="button" class="btn btn-sm btn-outline-secondary"> <i class="fas fa-download"></i>
                                Export</a>
                            <a type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()"> <i
                                    class="fas fa-print"></i> Print</a>
                        </div>
                        <a type="button" class="btn btn-sm btn-primary" href="#">
                            <i class="fas fa-plus"></i> Add New
                        </a>
                    </div>
                </div>
                {{ json_encode($subcategories) }}
                <div class="card mb-4" id="manage_category">
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
                            </div>
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description <small
                                        class="text-danger">*</small></label>
                                <input type="text" id="description" class="form-control" name="description" />
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add New
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Supply List</h5>
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
                                                <th>Created At</th>
                                                <th>Created By</th>
                                            </tr>
                                        </thead>
                                        <tbody class="supply-table">

                                            <tr>
                                                <td colspan="6" class="text-center errors">There is no data available in
                                                    table</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Supply List</h5>
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
                                                <th>Created At</th>
                                                <th>Created By</th>

                                            </tr>
                                        </thead>
                                        <tbody class="supply-table">
                                            <tr>
                                                <td colspan="6" class="text-center errors">There is no data available in
                                                    table</td>
                                            </tr>
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
    <script src="{{ asset('/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/js/popper.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
</body>

</html>
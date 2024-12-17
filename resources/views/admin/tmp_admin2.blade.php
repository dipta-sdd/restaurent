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
                    <h1 class="h2">Main Header</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary me-2" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
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

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Create New Supply</h5>
                    </div>
                    <div class="card-body">
                        <form action="/create-supply" method="post" class="row g-3 needs-validation">
                            @csrf
                            <div class="col-md-5">
                                <label for="branch_id" class="form-label">Branch</label>
                                <select id="branch_id" class="form-control" name="branch_id" required>
                                    <option value="">Select Branch</option>

                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select id="supplier_id" class="form-control" name="supplier_id">
                                    <option value="null" selected>Normal Entry</option>

                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Create New Supply</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Supply List</h5>
                    </div>
                    <div class="card-body">
                        <form id="filter-form" class="row g-3 mb-4 p-none">

                            <div class="col-md-3">
                                <label for="filter-branch" class="form-label">Branch</label>
                                <input type="text" id="filter-branch" name="filter-branch" class="form-control"
                                    placeholder="Filter by branch">
                            </div>
                            <div class="col-md-3">
                                <label for="filter-status" class="form-label">Status</label>
                                <select id="filter-status" name="filter-status" class="form-control">
                                    <option value="">All Statuses</option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="sort-by" class="form-label">Sort By</label>
                                <select id="sort-by" name="sort-by" class="form-control">
                                    <option value="created_at">Created At</option>
                                    <option value="updated_at">Last Update</option>
                                    <option value="total_price">Amount</option>
                                    <option value="supplier">Supplier</option>
                                    <option value="branch">Branch</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="sort-order" class="form-label">Sort Order</label>
                                <select id="sort-order" name="sort-order" class="form-control">
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Supplier</th>
                                        <th>SL No</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Created At</th>
                                        <th>Last Update</th>
                                        <th>Created By</th>
                                    </tr>
                                </thead>
                                <tbody class="supply-table">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Header Information</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <tr>
                                        <th>Id</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <th>Status</th>
                                        <td><span class="badge bg-{{'' }}">{{ ucfirst('') }}</span>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Add Product to Supply</h5>
                            </div>
                            <div class="card-body">
                                <form action="/" method="post" id="product_add">
                                    @csrf
                                    <input type="hidden" id="supply_id" name="supply_id" value="">
                                    <div class="mb-3">
                                        <label for="product_id" class="form-label">Product</label>
                                        <input type="text" id="product_id" name="product_id" class="form-control"
                                            supply="" placeholder="Search for a product" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="strength_id" class="form-label">Strength</label>
                                            <select id="strength_id" name="strength_id" class="form-control" required>
                                                <option value="">Select Strength</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="supplied_quantity" class="form-label">Supplied Quantity</label>
                                            <input type="number" id="supplied_quantity" name="supplied_quantity"
                                                class="form-control" min="1" placeholder="Quantity" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="buying_price" class="form-label">Buying Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" id="buying_price" name="buying_price"
                                                    class="form-control" step="0.01" placeholder="0.00" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="selling_price" class="form-label">Selling Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" id="selling_price" name="selling_price"
                                                    class="form-control" step="0.01" placeholder="0.00" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="expiration_date" class="form-label">Expiration Date</label>
                                        <input type="date" id="expiration_date" name="expiration_date"
                                            class="form-control" value="{{ date('Y-m-t') }}" required>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-plus"></i>Button
                                        </button>
                                    </div>
                                </form>
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
    <script src="{{ asset('/js/admin.js') }}"></script>
</body>

</html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Restaurant') }} - Orders</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                    <h1 class="h2">Order Management</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary me-2" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form id="filter-form" class="row g-3">
                            <div class="col-md-3">
                                <label for="filter-status" class="form-label">Order Status</label>
                                <select id="filter-status" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Ready</option>
                                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="date-range" class="form-label">Date Range</label>
                                <select id="date-range" class="form-select">
                                    <option value="">All Time</option>
                                    <option value="today" {{ request('dateRange') == 'today' ? 'selected' : '' }}>Today</option>
                                    <option value="yesterday" {{ request('dateRange') == 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                                    <option value="week" {{ request('dateRange') == 'week' ? 'selected' : '' }}>This Week</option>
                                    <option value="month" {{ request('dateRange') == 'month' ? 'selected' : '' }}>This Month</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="type" class="form-label">Order Type</label>
                                <select id="type" class="form-select">
                                    <option value="">All Types</option>
                                    <option value="delivery" {{ request('type') == 'delivery' ? 'selected' : '' }}>Delivery</option>
                                    <option value="pickup" {{ request('type') == 'pickup' ? 'selected' : '' }}>Pickup</option>
                                    <option value="dine_in" {{ request('type') == 'dine_in' ? 'selected' : '' }}>Dine In</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="search" class="form-label">Search</label>
                                <input type="text" id="search" class="form-control" placeholder="Order ID..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-filter"></i> Apply Filters
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Orders List -->
                @foreach($orders_by_date as $date => $orders)
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">{{ $date }}</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Delivery Address</th>
                                        <th>Items</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr class="order-row" data-order-id="{{ $order->id }}" style="cursor: pointer;">
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->customerName }}</td>
                                        <td>{{ $order->address->phone }}</td>
                                        <td>{{ $order->address->name }}</td>
                                        <td>
                                            @foreach($order->orderItems as $item)
                                            {{ $item->item->name }}@if(!$loop->last), @endif
                                            @endforeach
                                        </td>
                                        <td>£{{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ 
                                                $order->status === 'pending' ? 'warning' : 
                                                ($order->status === 'processing' ? 'info' : 
                                                ($order->status === 'ready' ? 'primary' : 
                                                ($order->status === 'delivered' ? 'success' : 'secondary'))) 
                                            }}">
                                                {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('H:i') }}</td>
                                        <td>
                                            <a href="/admin/orders/{{ $order->id }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle row click to navigate to order details
            $('.order-row').click(function(e) {
                if (!$(e.target).is('a, button')) {
                    const orderId = $(this).data('order-id');
                    window.location.href = `/admin/orders/${orderId}`;
                }
            });

            // Handle filter form submission
            $('#filter-form').submit(function(e) {
                e.preventDefault();
                const params = new URLSearchParams();

                const status = $('#filter-status').val();
                const dateRange = $('#date-range').val();
                const type = $('#type').val();
                const search = $('#search').val();

                if (status) params.append('status', status);
                if (dateRange) params.append('dateRange', dateRange);
                if (type) params.append('type', type);
                if (search) params.append('search', search);

                const queryString = params.toString();
                window.location.href = `/admin/orders${queryString ? '?' + queryString : ''}`;
            });

        });
    </script>
</body>

</html>
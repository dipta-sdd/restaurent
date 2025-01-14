<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Restaurant') }} - Order Details</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                    <h1 class="h2">Order Details #{{ $order->id }}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary me-2" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <a href="/admin/orders" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-arrow-left"></i> Back to Orders
                        </a>
                    </div>
                </div>

                <div class="row">
                    <!-- Order Status Card -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-2 justify-content-start">
                                        <h5 class="card-title mb-0">Order Status:</h5>
                                        <span class="badge bg-{{ 
                                            $order->status === 'pending' ? 'warning' : 
                                            ($order->status === 'processing' ? 'info' : 
                                            ($order->status === 'ready' ? 'primary' : 
                                            ($order->status === 'delivered' ? 'success' : 'secondary'))) 
                                        }} fs-6">
                                            {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <form class="d-flex align-items-center" id="update-status-form">
                                            @csrf
                                            @if(auth()->user()->is_admin() && $order->status === 'pending')
                                                <button type="button" class="btn btn-primary update-status" data-status="processing">
                                                    <i class="fas fa-check"></i> Confirm Order
                                                </button>
                                            @endif
                                            
                                            @if(auth()->user()->is_rider())
                                                @if($order->status === 'processing')
                                                    <button type="button" class="btn btn-primary update-status" data-status="ready">
                                                        <i class="fas fa-motorcycle"></i> Pickup Order
                                                    </button>
                                                @elseif($order->status === 'ready')
                                                    <button type="button" class="btn btn-success update-status" data-status="delivered">
                                                        <i class="fas fa-check-circle"></i> Mark as Delivered
                                                    </button>
                                                @endif
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Customer Information</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="150">Name:</th>
                                        <td>{{ $order->customerName }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone:</th>
                                        <td>{{ $order->customerPhone ?? $order->address->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $order->customerEmail ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address:</th>
                                        <td>{{ $order->address->name }}</td>
                                    </tr>
                                    @if($order->instructions)
                                    <tr>
                                        <th>Instructions:</th>
                                        <td>{{ $order->instructions }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Order Information -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Order Information</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="150">Order ID:</th>
                                        <td>#{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Date:</th>
                                        <td>{{ $order->created_at->format('d M, Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Method:</th>
                                        <td>{{ $order->payment_method ? ucwords($order->payment_method->name) : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Type:</th>
                                        <td>{{ ucwords($order->order_type) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Amount:</th>
                                        <td>£{{ number_format($order->total_amount, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Order Items</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th class="text-end">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->orderItems as $item)
                                            <tr>
                                                <td>{{ $item->item->name }}</td>
                                                <td>£{{ number_format($item->price, 2) }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td class="text-end">£{{ number_format($item->price * $item->quantity, 2) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3" class="text-end">Total:</th>
                                                <th class="text-end">£{{ number_format($order->total_amount, 2) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle status update
            $('.update-status').click(function(e) {
                e.preventDefault();
                const status = $(this).data('status');
                const orderId = '{{ $order->id }}';
                
                $.ajax({
                    url: `/api/admin/orders/${orderId}/status`,
                    method: 'POST',
                    data: {
                        status: status,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;
                        alert(response.message || 'Error updating order status');
                    }
                });
            });
        });
    </script>
</body>
</html> 
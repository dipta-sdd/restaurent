<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/previousorder.css" />
</head>

<body>
    <div class="container">
        <h1 class="mb-4"><i class="fas fa-utensils order-icon"></i> Your Orders</h1>
        
        <!-- Active Orders Section -->
        <div class="mb-5">
            <h2 class="mb-3">Active Orders</h2>
            <div class="row">
                @forelse($active_orders as $order)
                    <div class="col-md-6 mb-4">
                        <div class="card order-card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-shopping-bag"></i> Order #{{ $order->id }}</span>
                                <span class="badge bg-{{ 
                                    $order->status === 'pending' ? 'warning' : 
                                    ($order->status === 'processing' ? 'info' : 
                                    'primary') }}">
                                    {{ ucwords($order->status) }}
                                </span>
                            </div>
                            <div class="card-body">
                                <p><i class="far fa-calendar-alt"></i> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                                <p><i class="fas fa-dollar-sign"></i> Total: £{{ number_format($order->total_amount, 2) }}</p>
                                <p><i class="fas fa-list-ul"></i> Items:</p>
                                <ul>
                                    @foreach($order->orderItems as $item)
                                        <li>{{ $item->item->name }} x {{ $item->quantity }}</li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('orderConfirmation', $order->id) }}" class="btn btn-primary w-100">
                                    <i class="fas fa-eye"></i> Track Order
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">No active orders at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Order History Section -->
        <div>
            <h2 class="mb-3">Order History</h2>
            <div class="row">
                @forelse($delivered_orders as $order)
                    <div class="col-md-6 mb-4">
                        <div class="card order-card">
                            <div class="card-header">
                                <i class="fas fa-check-circle text-success"></i> Order #{{ $order->id }} (Delivered)
                            </div>
                            <div class="card-body">
                                <p><i class="far fa-calendar-alt"></i> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                                <p><i class="fas fa-dollar-sign"></i> Total: £{{ number_format($order->total_amount, 2) }}</p>
                                <p><i class="fas fa-list-ul"></i> Items:</p>
                                <ul>
                                    @foreach($order->orderItems as $item)
                                        <li>{{ $item->item->name }} x {{ $item->quantity }}</li>
                                    @endforeach
                                </ul>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('orderConfirmation', $order->id) }}" class="btn btn-outline-primary flex-grow-1">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                    <!-- <button class="btn btn-success flex-grow-1" onclick="reorderItems({{ $order->id }})">
                                        <i class="fas fa-redo"></i> Reorder
                                    </button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">No order history available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function reorderItems(orderId) {
            // TODO: Implement reorder functionality
            alert('Reorder functionality will be implemented soon!');
        }
    </script>
</body>

</html>
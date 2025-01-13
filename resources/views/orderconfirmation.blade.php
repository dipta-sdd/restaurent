<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/orderconfirmation.css">
    <style>
        
    </style>
</head>
<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="confirmation-card">
                    <div class="text-center mb-4">
                        <i class="fas fa-check-circle fa-4x text-success"></i>
                        <h1 class="mt-3 mb-2">Thank You for Your Order!</h1>
                        <p class="text-muted">We are preparing your order. Sit tight; it's on its way!</p>
                    </div>

                    <div class="mb-5">
                        <h3 class="mb-3">Order Status</h3>
                        <div class="progress-container">
                            <div class="row">
                                <div class="col-3 progress-step {{ in_array($order->status, ['pending', 'processing', 'out_for_delivery', 'delivered']) ? 'active' : '' }}">
                                    <div class="progress-step-icon">
                                        <i class="fas fa-utensils"></i>
                                    </div>
                                    <p class="progress-label">Order Received</p>
                                </div>
                                <div class="col-3 progress-step {{ in_array($order->status, ['processing', 'out_for_delivery', 'delivered']) ? 'active' : '' }}">
                                    <div class="progress-step-icon">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <p class="progress-label">Preparing</p>
                                </div>
                                <div class="col-3 progress-step {{ in_array($order->status, ['out_for_delivery', 'delivered']) ? 'active' : '' }}">
                                    <div class="progress-step-icon">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <p class="progress-label">Out for Delivery</p>
                                </div>
                                <div class="col-3 progress-step {{ $order->status === 'delivered' ? 'active' : '' }}">
                                    <div class="progress-step-icon">
                                        <i class="fas fa-smile-beam"></i>
                                    </div>
                                    <p class="progress-label">Delivered</p>
                                </div>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 10px;">
                            <div id="progress-bar" class="progress-bar bg-success" role="progressbar" 
                                style="width: {{ 
                                    $order->status === 'pending' ? '25' : 
                                    ($order->status === 'processing' ? '50' : 
                                    ($order->status === 'out_for_delivery' ? '75' : 
                                    ($order->status === 'delivered' ? '100' : '0'))) }}%;" 
                                aria-valuenow="{{ 
                                    $order->status === 'pending' ? '25' : 
                                    ($order->status === 'processing' ? '50' : 
                                    ($order->status === 'out_for_delivery' ? '75' : 
                                    ($order->status === 'delivered' ? '100' : '0'))) }}" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                            </div>
                        </div>
                        <p id="current-status" class="text-center mt-2 text-muted">Current Status: {{ ucwords(str_replace('_', ' ', $order->status)) }}</p>
                    </div>

                    <div class="mb-5">
                        <h3 class="mb-3">Delivery Address</h3>
                        <div class="card border-0 shadow-sm p-3">
                            <div class="card-body">
                                <h5 class="card-title mb-3"><i class="fas fa-map-marker-alt text-danger me-2"></i>Your Address</h5>
                                <p class="mb-1"><strong>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</strong></p>
                                <p class="mb-1">{{ $order->address->name }}</p>
                                @if($order->instructions)
                                    <p class="mb-1"><strong>Instructions:</strong> {{ $order->instructions }}</p>
                                @endif
                                <p class="mb-0"><strong>Phone:</strong> {{ $order->address->phone }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h3 class="mb-3">Order Summary</h3>
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->item->name }}</td>
                                        <td class="text-end">{{ $item->quantity }} x £{{ number_format($item->price, 2) }}</td>
                                        <td class="text-end">£{{ number_format($item->quantity * $item->price, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2" class="text-end">Total:</th>
                                        <th class="text-end">£{{ number_format($order->total_amount, 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- <div class="text-center">
                        <button onclick="window.location.href='/menu'" class="btn btn-primary me-2">Back to Menu</button>
                        <button onclick="window.location.href='/previousorder'" class="btn btn-outline-secondary">View Order History</button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const currentStatus = document.getElementById('current-status');
    </script>
</body>
</html>

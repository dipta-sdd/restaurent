<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary - Bengal Tandoori Restaurant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/menu.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/summary.css">
</head>

<body>
  
    <!-- ================ NAVIGATION SECTION ================ -->
    @include('navbar')

    <!-- ================ MENU SECTION ================ -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <img src="./Images/3343542.jpg" alt="Bengal Tandoori Restaurant Banner" class="card-img-top img-fluid w-50 mx-auto d-block">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">Order Summary</h1>

                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fas fa-home"></i> Home
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="/menu">
                                        <i class="fas fa-utensils"></i> Menu
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <i class="fas fa-receipt"></i> Order Summary
                                </li>
                            </ol>
                        </nav>

                        <div class="mb-4">
                            <h2 class="h4 mb-3">Your Order</h2>
                            <hr>
                            <div id="noItemsMessage" class="alert alert-warning d-none">
                                Your cart is empty. Please add some items from the <a href="/menu">menu</a>.
                            </div>
                            <ul class="list-group list-group-flush" id="orderItemsList">
                                <!-- Order items will be inserted here by JavaScript -->
                            </ul>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="h5">Subtotal:</span>
                                <span class="h5 text-primary" id="subtotalDisplay">£0.00</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="h5">Delivery:</span>
                                <span class="h5 text-primary" id="deliveryDisplay">£2.50</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="h5">Total:</span>
                                <span class="h5 text-primary" id="totalDisplay">£0.00</span>
                            </div>
                        </div>

                        <form id="order-form">
                            <div class="mb-4">
                                <h2 class="h4 mb-3">Delivery Address</h2>
                                <hr>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Enter your address:</label>
                                    <input type="text" class="form-control" id="address" placeholder="123 Main St, City, Country" required>
                                </div>
                                <div class="mb-3">
                                    <label for="instructions" class="form-label">Special Instructions (Optional):</label>
                                    <textarea class="form-control" id="instructions" rows="3" placeholder="Any special instructions for your order..."></textarea>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h2 class="h4 mb-3">Payment Options</h2>
                                <hr>
                                <div class="mb-3">
                                    <label for="paymentMethod" class="form-label">Select Payment Method:</label>
                                    <select class="form-select" id="paymentMethod" required>
                                        <option value="" disabled selected>Select a payment method</option>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="paypal">PayPal</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                    </select>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-utensils me-2"></i>Place Order
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const orderItemsList = document.getElementById('orderItemsList');
            const noItemsMessage = document.getElementById('noItemsMessage');
            
            try {
                // Get order data from localStorage
                const orderData = JSON.parse(localStorage.getItem('orderData'));
                
                if (!orderData || !orderData.items || orderData.items.length === 0) {
                    noItemsMessage.classList.remove('d-none');
                    orderItemsList.classList.add('d-none');
                    document.querySelector('form').style.display = 'none';
                    return;
                }

                // Display order items
                orderData.items.forEach(item => {
                    const li = document.createElement('li');
                    li.className = 'list-group-item d-flex justify-content-between align-items-center';
                    li.innerHTML = `
                        <div>
                            <span class="fw-bold">${item.name}</span>
                            <br>
                            <small class="text-muted">Quantity: ${item.quantity}</small>
                        </div>
                        <span class="badge bg-primary rounded-pill">£${(item.price * item.quantity).toFixed(2)}</span>
                    `;
                    orderItemsList.appendChild(li);
                });

                // Update summary totals
                document.getElementById('subtotalDisplay').textContent = `£${orderData.subtotal.toFixed(2)}`;
                document.getElementById('deliveryDisplay').textContent = `£${orderData.delivery.toFixed(2)}`;
                document.getElementById('totalDisplay').textContent = `£${orderData.total.toFixed(2)}`;

                // Handle form submission
                document.getElementById('order-form').addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Get form data
                    const address = document.getElementById('address').value;
                    const paymentMethod = document.getElementById('paymentMethod').value;

                    // Create complete order details
                    const orderDetails = {
                        ...orderData,
                        address: address,
                        instructions: document.getElementById('instructions').value,
                        paymentMethod: paymentMethod,
                        orderDate: new Date().toISOString()
                    };

                    // Send order data to backend
                    fetch('/api/place-order', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(orderDetails)
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Clear cart data
                        localStorage.removeItem('orderData');
                        // Redirect to order confirmation page
                        window.location.href = `/orderconfirmation/${data.order_id}`;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('There was an error processing your order. Please try again.');
                    });
                });
            } catch (error) {
                console.error('Error loading order data:', error);
                noItemsMessage.classList.remove('d-none');
                orderItemsList.classList.add('d-none');
                document.querySelector('form').style.display = 'none';
            }
        });
    </script>
</body>

</html>
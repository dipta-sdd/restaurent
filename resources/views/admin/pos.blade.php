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

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/admin_style.css" rel="stylesheet">
    <link href="/css/pos.css" rel="stylesheet">
</head>

<body>
    @include('admin.header')


    <div class="container-fluid">
        <div class="row">

            @include('admin.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-2">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Point of Sale</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a type="button" class="btn btn-sm btn-outline-secondary me-2" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </a>
                        <a type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download"></i> Export
                        </a>
                    </div>
                </div>

                <div class="row" id="pos-container">
                    <div id="menu-container">
                        <!-- Food Categories -->
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Foods</h5>

                            </div>
                            <div class="card-body">
                                <div class="accordion rounded-0 border-0" id="foodsAccordion">
                                    @foreach ($foods as $category)
                                    <div class="accordion-item border-0 rounded-0">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button text-capitalize collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#category-{{$category[0]->category_id}}" aria-expanded="false"
                                                aria-controls="food-starters">
                                                {{$category[0]->category_name}}
                                            </button>
                                        </h2>
                                        <div id="category-{{$category[0]->category_id}}" class="accordion-collapse collapse border-bottom"
                                            data-bs-parent="#foodsAccordion">
                                            <div class="accordion-body">
                                                <div class="food-item-container">
                                                    @foreach ($category as $item)
                                                    <div class="food-item card h-100" data-json='{{json_encode($item)}}' id='item-{{$item->id}}-{{$item->variant_id}}' data-quantity="0">
                                                        <img class="border" src="{{asset($item->image)}}" alt="">
                                                        <span class="name text-capitalize">{{$item->name}}</span>
                                                        <div class="d-flex justify-content-between">
                                                            @if ($item->variant_name)
                                                            <span class="variant text-muted text-capitalize">{{$item->variant_name}}</span>
                                                            @endif
                                                            <span class="price">{{$item->price}}</span>
                                                        </div>
                                                        <span class="quantity badge bg-light text-dark border d-none">0</span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Drinks Categories -->
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Drinks</h5>

                            </div>
                            <div class="card-body">
                                <div class="accordion rounded-0 border-0" id="drinksAccordion">
                                    <!-- Similar structure as food categories -->
                                    @foreach ($drinks as $category)
                                    <div class="accordion-item border-0 rounded-0">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button text-capitalize collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#category-{{$category[0]->category_id}}" aria-expanded="false"
                                                aria-controls="drink-starters">
                                                {{$category[0]->category_name}}
                                            </button>
                                        </h2>
                                        <div id="category-{{$category[0]->category_id}}" class="accordion-collapse collapse border-bottom"
                                            data-bs-parent="#drinksAccordion">
                                            <div class="accordion-body">
                                                <div class="food-item-container">
                                                    @foreach ($category as $item)
                                                    <div class="food-item card h-100" data-json='{{json_encode($item)}}' id='item-{{$item->id}}-{{$item->variant_id}}' data-quantity="0">
                                                        <img class="border" src="{{asset($item->image)}}" alt="">
                                                        <span class="name text-capitalize">{{$item->name}}</span>
                                                        <div class="d-flex justify-content-between">
                                                            @if ($item->variant_name)
                                                            <span class="variant text-muted text-capitalize">{{$item->variant_name}}</span>
                                                            @endif
                                                            <span class="price">{{$item->price}}</span>
                                                        </div>
                                                        <span class="quantity badge bg-light text-dark border d-none">0</span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cart Section -->
                    <div id="total-container">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Cart Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="cart-items">
                                    <!-- Cart items will be dynamically added here -->

                                </div>
                                <hr>
                                <div class="cart-summary">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal:</span>
                                        <span id="cart-subtotal" data-subtotal="0">£0.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>VAT (20%):</span>
                                        <span id="cart-vat" data-vat="0" data-vat-rate="20">£0.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <strong>Total:</strong>
                                        <strong id="cart-total" data-total="0">£0.00</strong>
                                    </div>
                                </div>
                                <div class="order-details mt-2 pt-2 border-top ">
                                    <h6 class="mb-3">Order Details</h6>
                                    <div class="mb-3">
                                        <label class="form-label">Order Type</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="orderType" id="dineIn" value="dine_in">
                                                <label class="form-check-label" for="dineIn">
                                                    Dine In
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="orderType" id="takeaway" value="takeaway">
                                                <label class="form-check-label" for="takeaway">
                                                    Takeaway
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-none" id="tableNoContainer">
                                        <label for="tableNo" class="form-label">Table Number</label>
                                        <input type="number" class="form-control" id="tableNo" min="1">
                                    </div>
                                </div>
                                <button class="btn btn-success w-100">Process Order</button>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/admin.js"></script>
    <script>
        $('.sidebar').addClass('autoclose');
    </script>
    <script>
        $(document).ready(function() {
            let cart = {};
            // $('.quantity').click(function (e) { 
            //     e.preventDefault();

            // });
            $('.food-item').on('click', function(e) {

                let id = $(this).attr('id');
                let item = $(this).data('json');
                let quantity = $(this).data('quantity');
                if (!$(e.target).closest('.quantity').length) {
                    if (quantity == 0) {
                        $(this).data('quantity', 1);
                        $(this).find('.quantity').removeClass('d-none');
                        $(this).find('.quantity').text(1);
                        item.quantity = 1;
                    } else {
                        $(this).data('quantity', quantity + 1);
                        $(this).find('.quantity').text(quantity + 1);
                        item.quantity = quantity + 1;
                    }
                } else {
                    $(this).data('quantity', 0);
                    $(this).find('.quantity').addClass('d-none');
                    $(this).find('.quantity').text(0);
                    item.quantity = 0;
                }

                addToCart(item);
            });

            function addToCart(item) {
                let cartItem = document.getElementById(`cart-item-${item.id}-${item.variant_id ?? ''}`);
                if (item.quantity == 0) {
                    if (cartItem) {
                        cartItem.remove();
                    }
                } else {
                    let cartItemHtml = `
                        <div class="cart-item d-flex align-items-center gap-3 py-2 border-bottom" id="cart-item-${item.id}-${item.variant_id ?? ''}" data-json='${JSON.stringify(item)}'>
                                <!-- Section 1: Image -->
                            <div class="cart-item-img" style="width: 80px;">
                                <img src="${item.image}" alt="Food Item" class="rounded w-100 border" style="aspect-ratio: 1/1; object-fit: cover;">
                            </div>
                            
                            <!-- Section 2: Name, Variant & Price -->
                            <div class="cart-item-details flex-grow-1">
                                <h6 class="mb-1 text-capitalize">${item.name}</h6>
                                <div class="d-flex justify-content-end">
                                    <small class="text-muted flex-grow-1 text-capitalize">${item.variant_name??''}</small>
                                    <small>£${item.price}</small>
                                </div>
                            </div>

                            <!-- Section 3: Total & Controls -->
                            <div class="cart-item-controls text-end" style="width: 100px;">
                                <div class="fw-bold mb-2">£${(item.price * item.quantity).toFixed(2)}</div>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-secondary decrement">-</button>
                                    <span class="btn btn-outline-secondary disabled">${item.quantity}</span>
                                    <button class="btn btn-outline-secondary increment">+</button>
                                </div>
                            </div>
                        </div>
                    `;
                    if (cartItem) {
                        cartItem.outerHTML = cartItemHtml;
                    } else {
                        $('.cart-items').append(cartItemHtml);
                    }
                }
                updateCartSummary();
            }

            function updateCartSummary() {
                let subtotal = 0;
                let vat = 0;
                let total = 0;
                let vatRate = $('#cart-vat').data('vat-rate');
                $('.cart-item').each(function() {
                    let item = $(this).data('json');
                    subtotal += item.price * item.quantity;
                });
                vat = subtotal * vatRate / 100;
                total = subtotal + vat;
                $('#cart-subtotal').text(`£${subtotal.toFixed(2)}`);
                $('#cart-vat').text(`£${vat.toFixed(2)}`);
                $('#cart-total').text(`£${total.toFixed(2)}`);
            }
            $(document).on('click', '.cart-item-controls .increment', function(e) {
                e.preventDefault();
                let id = $(this).closest('.cart-item').attr('id');
                let item = $(`#${id}`).data('json');
                item.quantity++;
                updateQuantity(`#item-${item.id}-${item.variant_id ?? ''}`, item.quantity);
                addToCart(item);
            });

            $(document).on('click', '.cart-item-controls .decrement', function(e) {
                e.preventDefault();
                let id = $(this).closest('.cart-item').attr('id');
                let item = $(`#${id}`).data('json');
                item.quantity--;
                updateQuantity(`#item-${item.id}-${item.variant_id ?? ''}`, item.quantity);
                addToCart(item);
            });

            function updateQuantity(id, quantity) {
                $(id).find('.quantity').text(quantity);
                if (quantity == 0) {
                    $(id).find('.quantity').addClass('d-none');
                } else {
                    $(id).find('.quantity').removeClass('d-none');
                }
            }

        });
    </script>
</body>

</html>
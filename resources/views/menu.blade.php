<!--
  File: restaurantMenu.html
  Description: Restaurant menu page with cart functionality
  Features:
  - Responsive menu grid layout
  - Filter sidebar with categories and price range
  - Shopping cart with quantity controls
  - Search functionality
  - Mobile-friendly cart interface
  - Smooth animations and transitions
  - Loading screen
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bengal Tandoori Restaurant - Authentic Indian cuisine in a warm and welcoming atmosphere.">

    <!-- ================ EXTERNAL LIBRARIES ================ -->
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">

    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS Framework -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/menu.css">
    
    <title>Bengal Tandoori Restaurant - Menu</title>
</head>

<body>
    <!-- Page Loader
    <div class="loader-wrapper">
        <div class="loader">
            <div class="spinner"></div>
            <div class="loader-text">Loading...</div>
        </div>
    </div> -->
  
    <!-- ================ NAVIGATION SECTION ================ -->
    @include('navbar')

    <!-- ================ MENU SECTION ================ -->
    <main class="container-fluid pt-3">
        <h2 class="text-center heading_h2 display-4">Our Menu</h2>
        
        <div class="search-section my-2">
            <div class="container">
                <div class="search-wrapper">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" 
                               placeholder="Search for dishes..." aria-label="Search">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Sidebar: Filters -->
            <div class="col-md-2">
                <div class="card filter-sidebar shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4"><i class="fas fa-filter me-2"></i>Filters</h5>
                        
                        <!-- Categories -->
                        <div class="mb-4">
                            <h6 class="filter-heading"><i class="fas fa-utensils me-2"></i>Categories</h6>
                            <div class="form-check">
                                <input class="form-check-input category-filter" type="checkbox" value="all" id="allCheck" checked>
                                <label class="form-check-label" for="allCheck">All Items</label>
                            </div>
                            @foreach($subcategories as $subcategory)
                            <div class="form-check">
                                <input class="form-check-input category-filter" type="checkbox" value="{{ $subcategory->id }}" id="category{{ $subcategory->id }}">
                                <label class="form-check-label" for="category{{ $subcategory->id }}">{{ $subcategory->name }}</label>
                            </div>
                            @endforeach
                        </div>
                        

                        <!-- Sort by Price -->
                        <div class="mb-4">
                            <h6 class="filter-heading"><i class="fas fa-sort me-2"></i>Sort by Price</h6>
                            <div class="btn-group" role="group" aria-label="Sort by Price">
                                <button id="sortLowToHigh" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-down me-1"></i>Low to High
                                </button>
                                <button id="sortHighToLow" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-up me-1"></i>High to Low
                                </button>
                            </div>
                            <button id="clearFilters" class="btn btn-outline-secondary mt-2">Clear Filters</button>
                        </div>

                        <!-- Clear Filters Button -->
                    </div>
                </div>
            </div>

            <!-- Center Content: Menu Items -->
            <div class="col-md-8 col-12">
                <div class="row row-cols-1 row-cols-md-3 g-3" id="menu-items-container">
                    @foreach($items as $item)
                    <div class="col menu-item" data-category="{{ $item->subcategory_id }}">
                        <div class="card h-100 shadow-sm menu-card" style="transition: transform 0.2s;">
                            <div class="position-relative">
                                @if($item->image)
                                <img src="{{ asset($item->image) }}" class="card-img-top menu-img img-fluid" alt="{{ $item->name }}">
                                @else
                                <img src="./Images/food_1.jpg" class="card-img-top menu-img img-fluid" alt="{{ $item->name }}">
                                @endif
                                <span class="badge bg-success position-absolute top-0 end-0 m-2">{{ $item->subcategory->name }}</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text small">{{ $item->description ?? 'No description available' }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="price-section">
                                        <span class="text-decoration-line-through text-muted small">£{{ number_format($item->original_price, 2) }}</span>
                                        <span class="text-danger fw-bold ms-1">£{{ number_format($item->discounted_price, 2) }}</span>
                                    </div>
                                    <button class="btn btn-primary btn-sm add-to-cart" 
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}"
                                            data-price="{{ $item->discounted_price }}"
                                            aria-label="Add {{ $item->name }} to cart">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Sidebar: Cart -->
            <div class="col-md-2 col-12">
                <div class="card cart-sidebar shadow-sm">
                    <div class="card-body p-2">
                        <h5 class="cart-title">
                            <i class="fas fa-shopping-cart me-2"></i>Cart
                        </h5>
                        <div id="cart-items" class="mb-2">
                            <!-- Sample Cart Item -->
                            
                        </div>

                        <!-- Cart Summary -->
                        <div class="cart-summary">
                            <div class="summary-row">
                                <span>Subtotal</span>
                                <span id="subtotalAmount">£0.00</span>
                            </div>
                            <div class="summary-row">
                                <span>Delivery</span>
                                <span>£2.50</span>
                            </div>
                            <div class="summary-row total">
                                <strong>Total</strong>
                                <strong id="totalAmount">£2.50</strong>
                            </div>
                            <button class="btn btn-success w-100">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add this after the main content and before footer -->
    <div class="floating-cart d-md-none">
        <button class="cart-button">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count">1</span>
        </button>
    </div>

    <!-- ================ FOOTER SECTION ================ -->
    <footer class="footer bg-dark text-white pt-5">
        <div class="container">
          <div class="row">
            <!-- Column 1: Important Links -->
            <div class="col-md-4 mb-4">
              <h5 class="text-uppercase">Important Links</h5>
              <ul class="list-unstyled">
                <li><a href="#" class="text-white text-decoration-none">Home</a></li>
                <li><a href="#" class="text-white text-decoration-none">Our Menu</a></li>
                <li><a href="#" class="text-white text-decoration-none">Reservations</a></li>
                <li><a href="#" class="text-white text-decoration-none">About Us</a></li>
                <li><a href="#" class="text-white text-decoration-none">Careers</a></li>
              </ul>
            </div>
  
            <!-- Column 2: Social Media Links -->
            <div class="col-md-4 mb-4">
              <h5 class="text-uppercase">Follow Us</h5>
              <div class="d-flex align-items-center">
                <!-- Social Media Icons with Links -->
                <a href="#" class="text-white me-3">
                  <i class="fab fa-facebook fa-2x"></i>
                </a>
                <a href="#" class="text-white me-3">
                  <i class="fab fa-instagram fa-2x"></i>
                </a>
                <a href="#" class="text-white me-3">
                  <i class="fab fa-twitter fa-2x"></i>
                </a>
                <a href="#" class="text-white me-3">
                  <i class="fab fa-linkedin fa-2x"></i>
                </a>
              </div>
            </div>
  
            <!-- Column 3: Newsletter Subscription -->
            <div class="col-md-4 mb-4">
              <h5 class="text-uppercase">Newsletter</h5>
              <p>Stay updated with our latest news, events, and offers. Subscribe to our newsletter!</p>
              <br>
              <form>
                <div class="mb-3">
                  <input type="email" class="form-control" placeholder="Your Email" required>
                </div>
                <button type="submit" class="btn btn-primary">Subscribe</button>
              </form>
            </div>
          </div>
        </div>
  
        <!-- Footer Bottom: Copyright and Terms -->
        <div class="footer-bottom text-center py-3">
          <p class="mb-0">
            &copy; 2024 Restaurant Name. All Rights Reserved. 
            <a href="#" class="text-white text-decoration-none">Terms</a> | 
            <a href="#" class="text-white text-decoration-none">Privacy Policy</a>
          </p>
        </div>
      </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="scroll-to-top" aria-label="Scroll to top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- ================ SCRIPTS ================ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            let selectedCategories = [];
            let cartItems = [];
            
            // Function to load menu items
            function loadMenuItems(params = {}) {
                $.ajax({
                    url: '/api/menu/items',
                    type: 'GET',
                    data: params,
                    success: function(response) {
                        const container = $('#menu-items-container');
                        container.empty();
                        
                        response.forEach(item => {
                            const html = `
                                <div class="col menu-item" data-category="${item.subcategory_id}">
                                    <div class="card h-100 shadow-sm menu-card">
                                        <div class="position-relative">
                                            ${item.image 
                                                ? `<img src="${item.image}" class="card-img-top menu-img img-fluid" alt="${item.name}">`
                                                : `<img src="./Images/food_1.jpg" class="card-img-top menu-img img-fluid" alt="${item.name}">`
                                            }
                                            <span class="badge bg-success position-absolute top-0 end-0 m-2">${item.subcategory.name}</span>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">${item.name}</h5>
                                            <p class="card-text small">${item.description || 'No description available'}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price-section">
                                                    <span class="text-decoration-line-through text-muted small">£${parseFloat(item.original_price).toFixed(2)}</span>
                                                    <span class="text-danger fw-bold ms-1">£${parseFloat(item.discounted_price).toFixed(2)}</span>
                                                </div>
                                                <button class="btn btn-primary btn-sm add-to-cart"
                                                        data-id="${item.id}"
                                                        data-name="${item.name}"
                                                        data-price="${item.discounted_price}"
                                                        aria-label="Add ${item.name} to cart">
                                                    <i class="fas fa-cart-plus"></i>
                                                    Add
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            container.append(html);
                        });
                        
                        // Reattach cart event handlers
                        attachCartHandlers();
                    },
                    error: function(xhr) {
                        console.error('Error loading menu items:', xhr);
                    }
                });
            }

            // Cart functionality
            function attachCartHandlers() {
                $('.add-to-cart').off('click').on('click', function() {
                    const itemId = $(this).data('id');
                    const itemName = $(this).data('name');
                    const itemPrice = parseFloat($(this).data('price'));
                    
                    addToCart(itemId, itemName, itemPrice);
                    showToast('Item added to cart successfully!', 'success');
                });
            }

            function addToCart(id, name, price) {
                const existingItem = cartItems.find(item => item.id === id);
                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    cartItems.push({
                        id: id,
                        name: name,
                        price: price,
                        quantity: 1
                    });
                }
                updateCartDisplay();
                updateFloatingCartCount();
            }

            function updateFloatingCartCount() {
                const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
                $('.cart-count').text(totalItems);
            }

            function updateCartDisplay() {
                const cartContainer = $('#cart-items');
                cartContainer.empty();
                let subtotal = 0;

                cartItems.forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    subtotal += itemTotal;

                    cartContainer.append(`
                        <div class="cart-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="cart-item-details">
                                    <h6 class="mb-0">${item.name}</h6>
                                <span class="price">£${item.price.toFixed(2)}</span>
                            </div>
                        </div>
                            <div class="quantity-section mt-2">
                            <div class="quantity-controls d-flex justify-content-between align-items-center">
                                    <button class="qty-btn minus btn btn-sm btn-outline-secondary" data-id="${item.id}">-</button>
                                    <span class="qty-value mx-2">${item.quantity}</span>
                                    <button class="qty-btn plus btn btn-sm btn-outline-secondary" data-id="${item.id}">+</button>
                                </div>
                                <div class="item-total text-end mt-1">£${itemTotal.toFixed(2)}</div>
                            </div>
                        </div>
                    `);
                });

                $('#subtotalAmount').text(`£${subtotal.toFixed(2)}`);
                const total = subtotal + 2.50; // Adding delivery charge
                $('#totalAmount').text(`£${total.toFixed(2)}`);
            }

            // Handle quantity buttons
            $(document).on('click', '.qty-btn', function() {
                const itemId = $(this).data('id');
                const item = cartItems.find(item => item.id === itemId);
                
                if ($(this).hasClass('plus')) {
                    item.quantity += 1;
                } else {
                    item.quantity -= 1;
                        if (item.quantity < 1) {
                        cartItems = cartItems.filter(i => i.id !== itemId);
                    }
                }
                updateCartDisplay();
                updateFloatingCartCount();
            });

            // Category filter handling
            $('.category-filter').on('change', function() {
                const isAllCheck = $(this).val() === 'all';
                
                if (isAllCheck) {
                    $('.category-filter:not(#allCheck)').prop('checked', false);
                    selectedCategories = [];
                    } else {
                    $('#allCheck').prop('checked', false);
                    const checkedCategories = $('.category-filter:checked:not(#allCheck)').map(function() {
                        return $(this).val();
                    }).get();
                    
                    selectedCategories = checkedCategories.length > 0 ? checkedCategories : [];
                }

                loadMenuItems({
                    subcategories: selectedCategories
                });
            });

            // Sort by price handling
            $('#sortLowToHigh').on('click', function() {
                $(this).addClass('active').siblings().removeClass('active');
                loadMenuItems({
                    subcategories: selectedCategories,
                    sort: 'asc'
                });
            });

            $('#sortHighToLow').on('click', function() {
                $(this).addClass('active').siblings().removeClass('active');
                loadMenuItems({
                    subcategories: selectedCategories,
                    sort: 'desc'
                });
            });

            // Search functionality
            let searchTimeout;
            $('#searchInput').on('input', function() {
                clearTimeout(searchTimeout);
                const searchTerm = $(this).val();
                
                searchTimeout = setTimeout(() => {
                    loadMenuItems({
                        subcategories: selectedCategories,
                        search: searchTerm
                    });
                }, 300);
            });

            // Clear filters
            $('#clearFilters').on('click', function() {
                $('#searchInput').val('');
                $('.category-filter').prop('checked', false);
                $('#allCheck').prop('checked', true);
                selectedCategories = [];
                $('#sortLowToHigh, #sortHighToLow').removeClass('active');
                loadMenuItems();
            });

            // Mobile cart toggle
            $('.floating-cart').on('click', function() {
                $('.cart-sidebar').toggleClass('show-mobile-cart');
            });

            // Initial setup
            attachCartHandlers();
            updateFloatingCartCount();
            loadMenuItems();
        });
    </script>

    <style>
        /* Hover effect for menu cards */
        .menu-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-group .btn {
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-group .btn:hover {
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
        }

        .filter-heading {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .quantity-section {
            display: flex;
            flex-direction: column; /* Stack items vertically */
            margin-top: 10px; /* Add some space above the total */
        }

        .item-total {
            margin-top: 5px; /* Space between quantity controls and total */
            font-weight: bold; /* Make the total bold for emphasis */
        }

        .show-mobile-cart {
            transform: translateX(0) !important;
        }

        @media (max-width: 768px) {
            .cart-sidebar {
                position: fixed;
                top: 0;
                right: 0;
                height: 100vh;
                width: 300px;
                z-index: 1000;
                transform: translateX(100%);
                transition: transform 0.3s ease-in-out;
            }
        }

        .floating-cart {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
        }

        .cart-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #007bff;
            border: none;
            color: white;
            position: relative;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .btn-group .btn.active {
            background-color: #007bff;
            color: white;
        }

        .cart-item {
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 10px;
        }

        .qty-btn {
            width: 30px;
            height: 30px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</body>
</html>



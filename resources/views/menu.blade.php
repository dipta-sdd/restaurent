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
                                <input class="form-check-input" type="checkbox" value="all" id="allCheck">
                                <label class="form-check-label" for="allCheck">All Items</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="starters" id="startersCheck">
                                <label class="form-check-label" for="startersCheck">Starters</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="mains" id="mainsCheck">
                                <label class="form-check-label" for="mainsCheck">Main Course</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="desserts" id="dessertsCheck">
                                <label class="form-check-label" for="dessertsCheck">Desserts</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="drinks" id="drinksCheck">
                                <label class="form-check-label" for="drinksCheck">Drinks</label>
                            </div>
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
                    <!-- Menu Item 1 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm menu-card" style="transition: transform 0.2s;">
                            <div class="position-relative">
                                <img src="./Images/food_1.jpg" class="card-img-top menu-img img-fluid" alt="Chicken Tikka Masala">
                                <span class="badge bg-danger position-absolute top-0 end-0 m-2">Hot</span>
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">Discount</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Chicken Tikka Masala</h5>
                                <p class="card-text small">Grilled chicken in creamy tomato sauce.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="card-price mb-0"><span class="text-decoration-line-through">£12.99</span> <span class="text-danger">£10.99</span></p>
                                    </div>
                                    <button class="btn btn-primary btn-sm" aria-label="Add Chicken Tikka Masala to cart">
                                        <i class="fas fa-cart-plus me-1"></i>Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Item 2 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm menu-card" style="transition: transform 0.2s;">
                            <div class="position-relative">
                                <img src="./Images/food_2.jpg" class="card-img-top menu-img img-fluid" alt="Butter Chicken">
                                <span class="badge bg-success position-absolute top-0 end-0 m-2">Discount</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Butter Chicken</h5>
                                <p class="card-text small">Tender chicken in rich buttery sauce.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="card-price mb-0"><span class="text-decoration-line-through">£13.99</span> <span class="text-danger">£11.99</span></p>
                                    </div>
                                    <button class="btn btn-primary btn-sm" aria-label="Add Butter Chicken to cart">
                                        <i class="fas fa-cart-plus me-1"></i>Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Item 3 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm menu-card" style="transition: transform 0.2s;">
                            <div class="position-relative">
                                <img src="./Images/004.jpg" class="card-img-top menu-img img-fluid" alt="Vegetable Biryani">
                                <span class="badge bg-success position-absolute top-0 end-0 m-2">Discount</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Vegetable Biryani</h5>
                                <p class="card-text small">Aromatic rice with mixed vegetables.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="card-price mb-0"><span class="text-decoration-line-through">£10.99</span> <span class="text-danger">£8.99</span></p>
                                    </div>
                                    <button class="btn btn-primary btn-sm" aria-label="Add Vegetable Biryani to cart">
                                        <i class="fas fa-cart-plus me-1"></i>Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Item 4 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm menu-card" style="transition: transform 0.2s;">
                            <div class="position-relative">
                                <img src="./Images/003.jpg" class="card-img-top menu-img img-fluid" alt="Paneer Tikka">
                                <span class="badge bg-warning position-absolute top-0 end-0 m-2">Medium</span>
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">Discount</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Paneer Tikka</h5>
                                <p class="card-text small">Grilled cottage cheese with spices.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="card-price mb-0"><span class="text-decoration-line-through">£9.99</span> <span class="text-danger">£7.99</span></p>
                                    </div>
                                    <button class="btn btn-primary btn-sm" aria-label="Add Paneer Tikka to cart">
                                        <i class="fas fa-cart-plus me-1"></i>Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Item 5 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm menu-card" style="transition: transform 0.2s;">
                            <div class="position-relative">
                                <img src="./Images/002.jpg" class="card-img-top menu-img img-fluid" alt="Lamb Rogan Josh">
                                <span class="badge bg-danger position-absolute top-0 end-0 m-2">Hot</span>
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">Discount</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Lamb Rogan Josh</h5>
                                <p class="card-text small">Tender lamb in aromatic curry sauce.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="card-price mb-0"><span class="text-decoration-line-through">£14.99</span> <span class="text-danger">£12.99</span></p>
                                    </div>
                                    <button class="btn btn-primary btn-sm" aria-label="Add Lamb Rogan Josh to cart">
                                        <i class="fas fa-cart-plus me-1"></i>Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Item 6 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm menu-card" style="transition: transform 0.2s;">
                            <div class="position-relative">
                                <img src="./Images/001.jpg" class="card-img-top menu-img img-fluid" alt="Dal Makhani">
                                <span class="badge bg-success position-absolute top-0 end-0 m-2">Discount</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Dal Makhani</h5>
                                <p class="card-text small">Creamy black lentils, slow-cooked.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="card-price mb-0"><span class="text-decoration-line-through">£8.99</span> <span class="text-danger">£6.99</span></p>
                                    </div>
                                    <button class="btn btn-primary btn-sm" aria-label="Add Dal Makhani to cart">
                                        <i class="fas fa-cart-plus me-1"></i>Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Clear Filters functionality
            document.getElementById('clearFilters').addEventListener('click', () => {
                // Reset sorting (you may want to implement a default sorting order)
                const menuContainer = document.getElementById('menu-items-container');
                const items = Array.from(menuContainer.children);
                menuContainer.innerHTML = ''; // Clear current items
                items.forEach(item => menuContainer.appendChild(item)); // Re-append original items

                // Remove active class from buttons
                document.getElementById('sortLowToHigh').classList.remove('active');
                document.getElementById('sortHighToLow').classList.remove('active');

                // Clear all selected categories
                document.querySelectorAll('.filter-sidebar .form-check-input').forEach(checkbox => {
                    checkbox.checked = false; // Uncheck each checkbox
                });

                // Optionally, you can also reset any other filters or states here
            });

            // Sort by Price functionality
            document.getElementById('sortLowToHigh').addEventListener('click', () => {
                sortMenuItems('asc');
            });

            document.getElementById('sortHighToLow').addEventListener('click', () => {
                sortMenuItems('desc');
            });

            function sortMenuItems(order) {
                const menuContainer = document.getElementById('menu-items-container');
                const items = Array.from(menuContainer.children);
                items.sort((a, b) => {
                    const priceA = parseFloat(a.querySelector('.card-price .text-danger').textContent.replace('£', ''));
                    const priceB = parseFloat(b.querySelector('.card-price .text-danger').textContent.replace('£', ''));
                    return order === 'asc' ? priceA - priceB : priceB - priceA;
                });
                menuContainer.innerHTML = ''; // Clear current items
                items.forEach(item => menuContainer.appendChild(item)); // Re-append sorted items
            }

            // Cart functionality
            const cartItems = [];

            document.querySelectorAll('.menu-card button').forEach(button => {
                button.addEventListener('click', (event) => {
                    const card = event.target.closest('.menu-card');
                    const title = card.querySelector('.card-title').textContent;
                    const price = parseFloat(card.querySelector('.card-price .text-danger').textContent.replace('£', ''));
                    addToCart(title, price);
                });
            });

            function addToCart(title, price) {
                const existingItem = cartItems.find(item => item.title === title);
                if (existingItem) {
                    existingItem.quantity += 1; // Increment quantity
                } else {
                    cartItems.push({ title, price, quantity: 1 }); // Add new item with quantity 1
                }
                updateCart();
            }

            function updateCart() {
                const cartItemsContainer = document.getElementById('cart-items');
                cartItemsContainer.innerHTML = ''; // Clear current cart items
                let subtotal = 0;

                cartItems.forEach(item => {
                    const cartItemDiv = document.createElement('div');
                    cartItemDiv.classList.add('cart-item');
                    cartItemDiv.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="cart-item-details">
                                <h6>${item.title}</h6>
                                <span class="price">£${item.price.toFixed(2)}</span>
                            </div>
                        </div>
                        <div class="quantity-section">
                            <div class="quantity-controls d-flex justify-content-between align-items-center">
                                <button class="qty-btn minus" data-title="${item.title}">-</button>
                                <span class="qty-value">${item.quantity}</span>
                                <button class="qty-btn plus" data-title="${item.title}">+</button>
                            </div>
                            <div class="item-total text-end">£${(item.price * item.quantity).toFixed(2)}</div>
                        </div>
                    `;
                    cartItemsContainer.appendChild(cartItemDiv);
                    subtotal += item.price * item.quantity; // Update subtotal
                });

                document.getElementById('subtotalAmount').textContent = `£${subtotal.toFixed(2)}`;
                document.getElementById('totalAmount').textContent = `£${(subtotal + 2.50).toFixed(2)}`; // Adding delivery charge
            }

            // Event delegation for quantity buttons
            document.getElementById('cart-items').addEventListener('click', (event) => {
                if (event.target.classList.contains('qty-btn')) {
                    const title = event.target.getAttribute('data-title');
                    if (event.target.classList.contains('plus')) {
                        const item = cartItems.find(item => item.title === title);
                        item.quantity += 1; // Increment quantity
                    } else if (event.target.classList.contains('minus')) {
                        const item = cartItems.find(item => item.title === title);
                        item.quantity -= 1; // Decrement quantity
                        if (item.quantity < 1) {
                            cartItems.splice(cartItems.indexOf(item), 1); // Remove item if quantity is less than 1
                        }
                    }
                    updateCart(); // Update cart display
                }
            });

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', function() {
                const query = searchInput.value.toLowerCase();
                const menuItems = document.querySelectorAll('#menu-items-container .col');

                menuItems.forEach(item => {
                    const title = item.querySelector('.card-title').textContent.toLowerCase();
                    if (title.includes(query)) {
                        item.style.display = ''; // Show item
                    } else {
                        item.style.display = 'none'; // Hide item
                    }
                });
            });

            // Other existing event listeners and code...
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
    </style>
</body>
</html>



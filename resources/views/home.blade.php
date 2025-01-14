<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Bangla Tandoori Restauresnt') }}</title>
    <meta name="description"
        content="Bengal Tandoori Restaurant - Authentic Indian cuisine in a warm and welcoming atmosphere." />

    <!-- ================ EXTERNAL LIBRARIES ================ -->
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css" />

    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />




    <!-- Performance Optimization: Preload Critical Resources -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        as="style" />
    <link rel="preload" href="./Images/slider_1.jpg" as="image" />
    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/home.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body>
    <!-- Page Loader -->
    <div class="loader-wrapper">
        <div class="loader">
            <div class="spinner"></div>
            <div class="loader-text">Loading...</div>
        </div>
    </div>

    <!-- ================ NAVIGATION SECTION ================ -->
    <!-- 
      Features:
      - Responsive navbar with hamburger menu
      - Dynamic scroll effect
      - Brand logo and text
      - Navigation links
      - Mobile-friendly design
    -->
    <header>
        <nav class="navbar navbar-expand-lg customNav">
            <div class="container-fluid">
                <!-- Brand Logo and Text -->
                <div class="d-flex align-items-center">
                    <a class="navbar-brand d-flex align-items-center" href="#">
                        <picture>
                            <img src="./Images/logo.png" class="nav__logo" alt="Bengal Tandoori Restaurant Logo" />
                        </picture>
                        <h3 class="logo__text px-2">
                            BENGAL TANDOORI RESTAURANT
                        </h3>
                    </a>
                </div>

                <!-- Mobile Toggle Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Links -->
                <div class="collapse navbar-collapse text-end" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="customItem" aria-current="page" href="menu.html">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="customItem" aria-current="page" href="#">Order Online</a>
                        </li>
                        <li class="nav-item">
                            <a class="customItem" aria-current="page" href="pricing.html">Reservations</a>
                        </li>
                        <li class="nav-item">
                            <a class="customItem" aria-current="page" href="#">Contact</a>
                        </li>
                        @if (Auth::user())
                        <li class="nav-item dropdown">


                            <a class="customItem dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ Auth::user()->first_name }}
                            </a>

                            <ul class="dropdown-menu rounded-0">
                                <li><a class="dropdown-item" href="/profile">{{ Auth::user()->name }}</a></li>
                                @if (Auth::user()->is_admin())
                                <li><a class="dropdown-item" href="/admin/dashboard">Dashboard</a></li>
                                @else
                                <li><a class="dropdown-item" href="/previousorder">Order History</a></li>
                                @endif
                                <li><a class="dropdown-item" href="/api/logout">Logout</a></li>
                            </ul>

                            @else
                        <li class="nav-item">
                            <a class="customItem" href="/login">Login</a>
                            @endif
                            <!-- same ending for both -->
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- ================ HERO SLIDER SECTION ================ -->
    <!-- 
      Features:
      - Auto-playing carousel
      - Multiple slides with captions
      - Responsive images
      - Navigation controls
      - Touch-enabled for mobile
    -->
    <section class="hero-slider">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="10000"
            data-bs-touch="true">
            <div class="carousel-inner">
                <!-- Slide 1: Welcome Slide -->
                <div class="carousel-item active">
                    <img src="./Images/slider_1.jpg" class="d-block w-100" alt="Restaurant Welcome Image" />
                    <div class="carousel-caption">
                        <h2>Welcome to</h2>
                        <h5>BENGAL TANDOORI RESTAURANT</h5>
                        <p>
                            Experience the flavors of our exquisite cuisine.
                        </p>
                    </div>
                </div>

                <!-- Slide 2: Authentic Dishes -->
                <div class="carousel-item">
                    <img src="./Images/slider_2.jpg" class="d-block w-100" alt="Authentic Dishes Showcase" />
                    <div class="carousel-caption">
                        <h5>Authentic Dishes</h5>
                        <p>Made with fresh, locally sourced ingredients.</p>
                    </div>
                </div>

                <!-- Slide 3: Dining Experience -->
                <div class="carousel-item">
                    <img src="./Images/slider_3.jpg" class="d-block w-100" alt="Restaurant Ambiance" />
                    <div class="carousel-caption">
                        <h5>Unforgettable Dining Experience</h5>
                        <p>Enjoy our warm hospitality and cozy ambiance.</p>
                    </div>
                </div>
            </div>

            <!-- Carousel Navigation Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- ================ ABOUT US SECTION ================ -->
    <!-- 
      Features:
      - Auto-playing promotional video
      - Restaurant story
      - Key features list
      - Call-to-action button
      - Responsive layout
    -->
    <div class="container my-5">
        <div class="about-section row align-items-center">
            <!-- Video Section -->
            <div class="col-md-6">
                <video class="img-fluid about-video" autoplay muted loop controls>
                    <source src="./videos/1119.mp4" type="video/mp4" />
                    Your browser does not support the video tag.
                </video>
            </div>

            <!-- Content Section -->
            <div class="col-lg-6">
                <div class="about-us-content">
                    <h2 class="display-4">Our Story</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Maecenas sed diam eget risus varius blandit
                        sit amet non magna.
                    </p>

                    <!-- Restaurant Features -->
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li>
                                    <i class="fas fa-check"></i> Fresh,
                                    local ingredients
                                </li>
                                <li>
                                    <i class="fas fa-check"></i> Authentic
                                    recipes
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li>
                                    <i class="fas fa-check"></i> Cozy
                                    ambiance
                                </li>
                                <li>
                                    <i class="fas fa-check"></i> Friendly
                                    service
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <a href="#" class="btn btn-primary mt-4 btn-block">Learn More</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ================ MENU SECTION ================ -->
    <!-- 
      Features:
      - Grid layout for menu items
      - Image showcases
      - Hover effects
      - Responsive grid
      - View full menu button
    -->
    <section class="menu py-5">
        <div class="container">
            <h2 class="text-center mb-5 heading_h2 display-4">Our Menu</h2>
            <div class="menu-grid">
                <!-- Menu Grid Items -->
                <!-- First Row -->
                <div class="grid-item">
                    <img src="./Images/food_1.jpg" alt="Dish 1" />
                    <div class="menu-details">
                        <h3>Dish 1</h3>
                        <p>Delicious and fresh ingredients.</p>
                    </div>
                </div>
                <div class="grid-item">
                    <img src="./Images/food_2.jpg" alt="Dish 2" />
                    <div class="menu-details">
                        <h3>Dish 2</h3>
                        <p>Prepared with love and care.</p>
                    </div>
                </div>
                <div class="grid-item grid-item-tall">
                    <img src="./Images/food_3.jpg" alt="Dish 3" />
                    <div class="menu-details">
                        <h3>Dish 3</h3>
                        <p>A perfect blend of flavors.</p>
                    </div>
                </div>
                <!-- Second Row -->
                <div class="grid-item grid-item-wide">
                    <img src="./Images/food_4.jpg" alt="Dish 4" />
                    <div class="menu-details">
                        <h3>Dish 4</h3>
                        <p>Satisfying and nourishing.</p>
                    </div>
                </div>
            </div>
            <!-- Menu Call-to-Action -->
            <div class="text-center mt-4">
                <a href="#full-menu" class="btn btn-lg btn-primary">View Full Menu</a>
            </div>
        </div>
    </section>

    <!-- ================ RESERVATION SECTION ================ -->
    <!-- 
      Features:
      - Interactive reservation form
      - Real-time validation
      - Date and time picker
      - Guest count selection
      - Responsive layout
      - Form feedback
    -->
    <section class="reservation-section py-5">
        <div class="container">
            <h2 class="text-center mb-4 heading_h2 display-4 py-3">
                Reserve Your Table
            </h2>
            <div class="reservation-container">
                <!-- Left Side: Reservation Image -->
                <div class="reservation-image">
                    <img src="./Images/3914790.jpg" alt="Restaurant Table" loading="lazy" />
                </div>

                <!-- Right Side: Reservation Form -->
                <div class="reservation-form">
                    <form action="#" method="post" aria-label="Table Reservation Form">
                        <h3 class="form-heading text-center mb-4">
                            Book Your Table
                        </h3>

                        <!-- Name Input -->
                        <div class="form-group">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name"
                                required aria-required="true" />
                            <div class="invalid-feedback">
                                Please enter your name
                            </div>
                        </div>

                        <!-- Email Input -->
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter your email" required />
                        </div>

                        <!-- Date Input -->
                        <div class="form-group">
                            <label for="date">Reservation Date</label>
                            <input type="date" id="date" name="date" class="form-control" required />
                        </div>

                        <!-- Time Input -->
                        <div class="form-group">
                            <label for="time">Reservation Time</label>
                            <input type="time" id="time" name="time" class="form-control" required />
                        </div>

                        <!-- Guest Count Input -->
                        <div class="form-group">
                            <label for="guests">Number of Guests</label>
                            <input type="number" id="guests" name="guests" class="form-control"
                                placeholder="Enter number of guests" required />
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary m-0">
                                Reserve Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- ================ TESTIMONIAL SECTION ================ -->
    <!-- Testimonial Section -->
    <section class="testimonials py-5">
        <div class="container">
            <h2 class="text-center mb-5 heading_h2 display-4">
                What Our Guests Say
            </h2>
            <div class="testimonial-slider-wrapper">
                <div class="gradient-left"></div>
                <div class="gradient-right"></div>
                <div class="testimonial-slider">
                    <div class="testimonial-slide">
                        <div class="testimonial-image">
                            <img src="./Images/face1.jpg" alt="Testimonial Author 1" />
                        </div>
                        <div class="testimonial-content">
                            <p>
                                "The food was incredible, the service was
                                impeccable..."
                            </p>
                            <div class="testimonial-author">
                                - Sarah Lee
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-slide">
                        <div class="testimonial-image">
                            <img src="./Images/face2.jpg" alt="Testimonial Author 2" />
                        </div>
                        <div class="testimonial-content">
                            <p>
                                "This restaurant exceeded our expectations!
                                The dishes..."
                            </p>
                            <div class="testimonial-author">
                                - David Chen
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-slide">
                        <div class="testimonial-image">
                            <img src="./Images/face3.jpg" alt="Testimonial Author 3" />
                        </div>
                        <div class="testimonial-content">
                            <p>
                                "We had a wonderful dining experience. The
                                food was..."
                            </p>
                            <div class="testimonial-author">
                                - Peter Jones
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-slide">
                        <div class="testimonial-image">
                            <img src="./Images/face1.jpg" alt="Testimonial Author 4" />
                        </div>
                        <div class="testimonial-content">
                            <p>
                                "Absolutely loved the atmosphere and the
                                delicious meals..."
                            </p>
                            <div class="testimonial-author">
                                - Anna Brown
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-slide">
                        <div class="testimonial-image">
                            <img src="./Images/face2.jpg" alt="Testimonial Author 4" />
                        </div>
                        <div class="testimonial-content">
                            <p>
                                "Absolutely loved the atmosphere and the
                                delicious meals..."
                            </p>
                            <div class="testimonial-author">
                                - Anna Brown
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-slide">
                        <div class="testimonial-image">
                            <img src="./Images/face3.jpg" alt="Testimonial Author 4" />
                        </div>
                        <div class="testimonial-content">
                            <p>
                                "Absolutely loved the atmosphere and the
                                delicious meals..."
                            </p>
                            <div class="testimonial-author">
                                - Anna Brown
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================ CONTACT SECTION ================ -->
    <!-- 
      Features:
      - Contact information display
      - Interactive Google Maps integration
      - Business hours
      - Social media links
      - Responsive layout
    -->
    <section class="contact-section py-5">
        <div class="container">
            <div class="row">
                <!-- Contact Information -->
                <div class="col-md-6">
                    <div class="contact-info">
                        <h2 class="mb-4 heading_h2 display-3">
                            Get in Touch
                        </h2>
                        <!-- Address -->
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt contact-icon"></i>
                            <p>
                                <strong>Address:</strong> 123 Food Street,
                                Flavor Town
                            </p>
                        </div>
                        <!-- Phone -->
                        <div class="contact-item">
                            <i class="fas fa-phone-alt contact-icon"></i>
                            <p><strong>Phone:</strong> +123 456 7890</p>
                        </div>
                        <!-- Email -->
                        <div class="contact-item">
                            <i class="fas fa-envelope contact-icon"></i>
                            <p>
                                <strong>Email:</strong> info@restaurant.com
                            </p>
                        </div>
                        <!-- Business Hours -->
                        <div class="contact-item">
                            <i class="fas fa-clock contact-icon"></i>
                            <p>
                                <strong>Opening Hours:</strong><br />
                                Mon - Fri: 10:00 AM - 10:00 PM<br />
                                Sat - Sun: 12:00 PM - 11:00 PM
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Integration -->
                <div class="col-md-6">
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12654.536034802328!2d-0.1277583341976418!3d51.50735187009144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761bcd8e42d1a7%3A0xf93b07ab2e8ed217!2sLondon!5e0!3m2!1sen!2suk!4v1697011782936!5m2!1sen!2suk"
                            width="100%" height="350" style="border: 0" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================ FOOTER SECTION ================ -->
    <!-- 
      Features:
      - Three-column layout
      - Important links
      - Social media integration
      - Newsletter subscription
      - Copyright information
      - Responsive design
    -->
    <footer class="footer bg-dark text-white pt-5">
        <div class="container">
            <div class="row">
                <!-- Column 1: Important Links -->
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase">Important Links</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#" class="text-white text-decoration-none">Home</a>
                        </li>
                        <li>
                            <a href="#" class="text-white text-decoration-none">Our Menu</a>
                        </li>
                        <li>
                            <a href="#" class="text-white text-decoration-none">Reservations</a>
                        </li>
                        <li>
                            <a href="#" class="text-white text-decoration-none">About Us</a>
                        </li>
                        <li>
                            <a href="#" class="text-white text-decoration-none">Careers</a>
                        </li>
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
                    <p>
                        Stay updated with our latest news, events, and
                        offers. Subscribe to our newsletter!
                    </p>
                    <br />
                    <form>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Your Email" required />
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer Bottom: Copyright and Terms -->
        <div class="footer-bottom text-center py-3">
            <p class="mb-0">
                &copy; 2024 Restaurant Name. All Rights Reserved.
                <a href="#" class="text-white text-decoration-none">Terms</a>
                |
                <a href="#" class="text-white text-decoration-none">Privacy Policy</a>
            </p>
        </div>
    </footer>
    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="scroll-to-top" aria-label="Scroll to top">
        <i class="fas fa-arrow-up"></i>
    </button>
    <!-- ================ MODAL SECTION ================ -->
    <!-- 
      Features:
      - Opening hours display
      - Dismissible modal
      - Centered design
      - One-time display functionality
      - Local storage integration
    -->
    <div class="modal fade" id="openingModal" tabindex="-1" aria-labelledby="openingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header text-center" style="
                            background: linear-gradient(
                                to right,
                                #082a45,
                                #073d69
                            );
                        ">
                    <h5 class="modal-title w-100 text-white fw-bold" id="openingModalLabel">
                        Welcome to Our Restaurant
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <!-- Modal Body: Opening Hours -->
                <div class="modal-body text-center">
                    <p class="fw-bold fs-4">
                        Opening Time:
                        <span class="text-primary">10:00 AM</span>
                    </p>
                    <p class="fw-bold fs-4">
                        Closing Time:
                        <span class="text-danger">11:00 PM</span>
                    </p>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal">
                        Got It!
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ================ SCRIPTS ================ -->
    <!-- Bootstrap Bundle with Popper.js -->
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    <!-- Main JavaScript -->
    <script>
        // Navbar scroll effect
        const navbar = document.querySelector(".customNav");
        window.addEventListener("scroll", () => {
            if (window.scrollY > 50) {
                navbar.classList.add("nav-scrolled");
            } else {
                navbar.classList.remove("nav-scrolled");
            }
        });

        // Modal handling with localStorage
        document.addEventListener("DOMContentLoaded", () => {
            try {
                const modalElement =
                    document.getElementById("openingModal");
                if (
                    modalElement &&
                    !localStorage.getItem("openingModalShown")
                ) {
                    const openingModal = new bootstrap.Modal(modalElement);
                    openingModal.show();
                    localStorage.setItem("openingModalShown", "true");
                }
            } catch (error) {
                console.warn("Modal initialization failed:", error);
            }

            // Initialize the carousel with options
            var myCarousel = new bootstrap.Carousel(
                document.getElementById("heroCarousel"), {
                    interval: 5000,
                    wrap: true,
                    ride: "carousel",
                    touch: true,
                }
            );
        });

        // Form validation
        const form = document.querySelector("form");
        form.addEventListener("submit", function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add("was-validated");
        });

        // Testimonial slider auto-scroll
        document.addEventListener("DOMContentLoaded", function() {
            const testimonialSlider =
                document.getElementById("testimonialSlider");
            let position = 0;

            function moveSlider() {
                position -= 0.5; // Move left
                testimonialSlider.scrollTo({
                    left: position,
                });

                // Reset position when reaching the end
                if (
                    Math.abs(position) >=
                    testimonialSlider.scrollWidth -
                    testimonialSlider.clientWidth
                ) {
                    position = testimonialSlider.clientWidth; // Reset to start from the right
                }
            }

            // Run the slider at a slower interval
            let sliderInterval = setInterval(moveSlider, 30); // Adjust speed as needed
            moveSlider(); // Start moving immediately
        });

        // Mobile menu handling
        document.addEventListener("DOMContentLoaded", function() {
            // Close mobile menu when clicking outside
            document.addEventListener("click", function(e) {
                const navbar = document.querySelector(".navbar-collapse");
                if (
                    navbar.classList.contains("show") &&
                    !e.target.closest(".navbar")
                ) {
                    navbar.classList.remove("show");
                }
            });

            // Close mobile menu after clicking a link
            document
                .querySelectorAll(".nav-item .customItem")
                .forEach((link) => {
                    link.addEventListener("click", () => {
                        const navbar =
                            document.querySelector(".navbar-collapse");
                        if (navbar.classList.contains("show")) {
                            navbar.classList.remove("show");
                        }
                    });
                });
        });

        // Scroll to Top functionality
        document.addEventListener("DOMContentLoaded", function() {
            const scrollToTopBtn = document.getElementById("scrollToTop");

            // Show/hide button based on scroll position
            window.addEventListener("scroll", () => {
                if (window.pageYOffset > 300) {
                    scrollToTopBtn.classList.add("visible");
                } else {
                    scrollToTopBtn.classList.remove("visible");
                }
            });

            // Smooth scroll to top when button is clicked
            scrollToTopBtn.addEventListener("click", () => {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth",
                });
            });
        });

        // Page Loader
        document.addEventListener("DOMContentLoaded", function() {
            // Show loader
            const loader = document.querySelector(".loader-wrapper");

            // Hide loader after page loads
            window.addEventListener("load", function() {
                setTimeout(function() {
                    loader.classList.add("fade-out");
                    setTimeout(function() {
                        loader.style.display = "none";
                    }, 500);
                }, 1000); // Adjust time as needed
            });
        });
    </script>


</body>

</html>
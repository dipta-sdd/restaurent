<!--
  File: signup.html
  Description: Restaurant signup page with form validation and location mapping
  Features:
  - User registration form
  - Password validation
  - Location selection with map
  - Form validation
  - Responsive design
-->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- ================ EXTERNAL LIBRARIES ================ -->
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
  <!-- Google Fonts - Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Leaflet Map CSS and JS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <title>Sign Up - Restaurant</title>

  <!-- ================ STYLES ================ -->
  <style>
    /* Global Styles */
    * {
      font-family: 'Poppins', sans-serif;
    }

    /* Background Setup */
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: url(./Images/vegetables-set-left-black-slate.jpg) center/cover;
      background-attachment: fixed;
      position: relative;
      color: white;
    }

    /* Dark Overlay */
    body::before {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.7);
    }

    /* Main Container */
    .signup-container {
      width: 90%;
      max-width: 800px;
      background: rgba(0, 0, 0, 0.7);
      padding: 2.5rem;
      border-radius: 15px;
      position: relative;
      z-index: 1;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
      backdrop-filter: blur(10px);
      margin: 3rem auto;
    }

    /* Form Controls */
    .form-control {
      background: white;
      color: black;
      padding-left: 40px;
      border: 1px solid #495057;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #f8c14d;
      box-shadow: 0 0 5px #f8c14d;
      outline: none;
    }

    /* Input Wrapper and Icons */
    .input-wrapper {
      position: relative;
      margin-bottom: 1.5rem;
    }

    .input-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #495057;
      z-index: 1;
    }

    /* Section Titles */
    .form-section-title {
      color: #f8c14d;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 1rem;
      border-bottom: 1px solid rgba(248, 193, 77, 0.2);
      padding-bottom: 0.5rem;
    }

    /* Button Styles */
    .btn-primary {
      background-color: #f8c14d;
      border: none;
      color: black;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-primary:hover,
    .btn-primary:focus {
      background-color: #e0a526;
      color: black;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(248, 193, 77, 0.3);
    }

    /* Map Container */
    .map-container {
      height: 300px;
      margin-top: 10px;
      border-radius: 8px;
      overflow: hidden;
      border: 1px solid #ddd;
    }

    #map {
      height: 100%;
      width: 100%;
    }

    /* Location Search */
    .location-search {
      position: relative;
    }

    .use-location-btn {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #495057;
      background: none;
      border: none;
      z-index: 10;
    }

    /* Location Suggestions */
    .suggestions-container {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      margin-top: 5px;
      z-index: 1000;
      display: none;
    }

    .suggestion-item {
      padding: 10px 15px;
      cursor: pointer;
      color: #333;
      transition: all 0.3s ease;
    }

    /* Password Fields */
    #togglePassword,
    #toggleConfirmPassword {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #495057;
      z-index: 5;
      background: white;
      padding: 2px;
    }

    /* Password Match Indicators */
    .password-match,
    .password-mismatch {
      position: relative;
      z-index: 2;
      margin-top: 4px;
      display: none;
    }

    .password-match {
      color: #28a745;
    }

    .password-mismatch {
      color: #dc3545;
    }

    /* Form Validation */
    .invalid-feedback {
      position: absolute;
      left: 0;
      bottom: -20px;
      margin-top: 0;
      font-size: 0.8rem;
      color: #dc3545;
    }

    /* Page Loader Styles */
    .loader-wrapper {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #000000;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      transition: opacity 0.5s ease-in-out;
    }

    .loader {
      text-align: center;
    }

    .spinner {
      width: 50px;
      height: 50px;
      border: 5px solid #f3f3f3;
      border-top: 5px solid #082A45;
      border-radius: 50%;
      animation: spin 1s linear infinite;
      margin: 0 auto 20px;
    }

    .loader-text {
      color: #ffffff;
      font-size: 18px;
      font-weight: 500;
      font-family: 'Poppins', sans-serif;
      letter-spacing: 2px;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    /* Hide loader after page load */
    .loader-wrapper.fade-out {
      opacity: 0;
      visibility: hidden;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .signup-container {
        margin: 2rem auto;
        padding: 1.5rem;
      }
    }

    @media (max-width: 480px) {
      .signup-container {
        margin: 1rem auto;
      }
    }
  </style>
</head>

<body>

  <!-- Page Loader -->
  <div class="loader-wrapper">
    <div class="loader">
      <div class="spinner"></div>
      <div class="loader-text">Loading...</div>
    </div>
  </div>

  <!-- ================ MAIN CONTAINER ================ -->
  <div class="signup-container">
    <!-- Back Navigation -->
    <div class="text-start mb-3">
      <a href="/" class="btn btn-outline-light btn-sm">
        <i class="fas fa-arrow-left"></i> Back to Home
      </a>
    </div>

    <div class="row">
      <div class="col-12">
        <!-- Form Header -->
        <h2 class="text-warning fw-bold mb-3">Create Account</h2>
        <p class="text-white mb-4">Join us to explore delicious meals and exclusive offers!</p>

        <!-- Registration Form -->
        <form class="needs-validation" novalidate>
          <div class="row g-3">
            <!-- Personal Information Section -->
            <div class="col-12">
              <div class="form-section-title">Personal Information</div>
            </div>

            <!-- Name Fields -->
            <div class="col-md-6">
              <div class="input-wrapper">
                <i class="fas fa-user input-icon"></i>
                <input type="text" class="form-control" placeholder="First Name" required>
                <div class="invalid-feedback">Please enter your first name</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-wrapper">
                <i class="fas fa-user input-icon"></i>
                <input type="text" class="form-control" placeholder="Last Name" required>
                <div class="invalid-feedback">Please enter your last name</div>
              </div>
            </div>

            <!-- Contact Information Section -->
            <div class="col-12">
              <div class="form-section-title">Contact Details</div>
            </div>
            <div class="col-md-6">
              <div class="input-wrapper">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" class="form-control" placeholder="Email" required
                  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                <div class="invalid-feedback">Please enter a valid email address</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-wrapper">
                <i class="fas fa-phone input-icon"></i>
                <input type="tel" class="form-control" placeholder="Phone Number" required
                  pattern="[0-9]{11}">
                <div class="invalid-feedback">Please enter a valid 11-digit phone number</div>
              </div>
            </div>

            <!-- Security Section -->
            <div class="col-12">
              <div class="form-section-title">Security</div>
            </div>
            <div class="col-md-6">
              <div class="input-wrapper">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" class="form-control" id="password" placeholder="Password"
                  required minlength="6">
                <i class="far fa-eye" id="togglePassword"></i>
                <div class="invalid-feedback">Password must be at least 6 characters long</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-wrapper">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" class="form-control" id="confirmPassword"
                  placeholder="Confirm Password" required>
                <i class="far fa-eye" id="toggleConfirmPassword"></i>
                <div class="invalid-feedback">Passwords do not match</div>
              </div>
              <div class="password-match"><i class="fas fa-check"></i> Passwords match</div>
              <div class="password-mismatch"><i class="fas fa-times"></i> Passwords do not match</div>
            </div>

            <!-- Delivery Information Section -->
            <div class="col-12">
              <div class="form-section-title">Delivery Information</div>
              <div class="location-search">
                <i class="fas fa-location-dot input-icon"></i>
                <input type="text" class="form-control" id="searchLocation"
                  placeholder="Enter your delivery address">
                <button type="button" class="use-location-btn" id="useCurrentLocation">
                  <i class="fas fa-crosshairs"></i>
                </button>
                <div class="suggestions-container" id="suggestions"></div>
              </div>
              <div class="map-container">
                <div id="map"></div>
              </div>
            </div>

            <!-- Terms and Newsletter Section -->
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms" required>
                <label class="form-check-label text-white-50" for="terms">
                  I agree to the Terms & Conditions
                </label>
              </div>
              <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="newsletter">
                <label class="form-check-label text-white-50" for="newsletter">
                  Subscribe to newsletter for special offers
                </label>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary w-100">Create Account</button>
            </div>
          </div>
        </form>

        <!-- Login Link -->
        <div class="text-center mt-4">
          <p class="text-white-50">Already have an account?
            <a href="/login" class="text-warning text-decoration-none">Login</a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- ================ SCRIPTS ================ -->
  <!-- Bootstrap Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Main JavaScript -->
  <script>
    // Map initialization variables
    let map, marker;
    const mapContainer = document.querySelector('.map-container');
    const searchInput = document.getElementById('searchLocation');
    const suggestionsContainer = document.getElementById('suggestions');
    let debounceTimer;

    // Initialize map with default location
    function initMap() {
      const defaultLocation = [23.8103, 90.4125]; // Default coordinates

      map = L.map('map').setView(defaultLocation, 13);

      // Add map tiles
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
      }).addTo(map);

      // Add draggable marker
      marker = L.marker(defaultLocation, {
        draggable: true
      }).addTo(map);

      // Update address when marker is dragged
      marker.on('dragend', function() {
        const position = marker.getLatLng();
        updateAddress([position.lat, position.lng]);
      });
    }

    // Location search functionality
    searchInput.addEventListener('input', function() {
      clearTimeout(debounceTimer);
      const query = this.value;

      if (query.length < 3) {
        suggestionsContainer.style.display = 'none';
        return;
      }

      // Debounce API calls
      debounceTimer = setTimeout(() => {
        fetch(
            `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`
          )
          .then(response => response.json())
          .then(data => {
            suggestionsContainer.innerHTML = '';
            if (data.length > 0) {
              data.slice(0, 5).forEach(place => {
                const div = document.createElement('div');
                div.className = 'suggestion-item';
                div.textContent = place.display_name;
                div.addEventListener('click', () => {
                  searchInput.value = place.display_name;
                  map.setView([place.lat, place.lon], 17);
                  marker.setLatLng([place.lat, place.lon]);
                  suggestionsContainer.style.display = 'none';
                });
                suggestionsContainer.appendChild(div);
              });
              suggestionsContainer.style.display = 'block';
            }
          })
          .catch(error => console.error('Error:', error));
      }, 300);
    });

    // Hide suggestions when clicking outside
    document.addEventListener('click', (e) => {
      if (!e.target.closest('.location-search')) {
        suggestionsContainer.style.display = 'none';
      }
    });

    // Get current location functionality
    document.getElementById('useCurrentLocation').addEventListener('click', () => {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            const pos = [position.coords.latitude, position.coords.longitude];
            map.setView(pos, 17);
            marker.setLatLng(pos);
            updateAddress(pos);
          },
          () => {
            alert('Error: Unable to get your location.');
          }
        );
      }
    });

    // Update address from coordinates
    function updateAddress([lat, lng]) {
      fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
        .then(response => response.json())
        .then(data => {
          searchInput.value = data.display_name;
        })
        .catch(error => console.error('Error:', error));
    }

    // Initialize map
    initMap();

    // Password visibility toggle functionality
    const togglePassword = document.querySelector('#togglePassword');
    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#confirmPassword');
    const passwordMatch = document.querySelector('.password-match');
    const passwordMismatch = document.querySelector('.password-mismatch');

    // Toggle password visibility
    togglePassword.addEventListener('click', () => {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      togglePassword.classList.toggle('fa-eye-slash');
    });

    toggleConfirmPassword.addEventListener('click', () => {
      const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
      confirmPassword.setAttribute('type', type);
      toggleConfirmPassword.classList.toggle('fa-eye-slash');
    });

    // Check password match
    function checkPasswordMatch() {
      if (password.value && confirmPassword.value) {
        if (password.value === confirmPassword.value) {
          passwordMatch.style.display = 'block';
          passwordMismatch.style.display = 'none';
          confirmPassword.setCustomValidity('');
        } else {
          passwordMatch.style.display = 'none';
          passwordMismatch.style.display = 'block';
          confirmPassword.setCustomValidity('Passwords do not match');
        }
      } else {
        passwordMatch.style.display = 'none';
        passwordMismatch.style.display = 'none';
        confirmPassword.setCustomValidity('');
      }
    }

    // Add password input event listeners
    password.addEventListener('input', checkPasswordMatch);
    confirmPassword.addEventListener('input', checkPasswordMatch);

    // Form validation and submission
    const form = document.querySelector('.needs-validation');

    form.addEventListener('submit', function(event) {
      event.preventDefault();
      checkPasswordMatch();

      if (!form.checkValidity()) {
        event.stopPropagation();
      } else {
        if (password.value === confirmPassword.value) {
          console.log('Form is valid, ready to submit');
          // Add form submission logic here
        }
      }

      form.classList.add('was-validated');
    });

    // Reset password validation
    document.getElementById('confirmPassword').addEventListener('input', function() {
      this.setCustomValidity('');
    });

    // Page Loader
    document.addEventListener('DOMContentLoaded', function() {
      // Show loader
      const loader = document.querySelector('.loader-wrapper');

      // Hide loader after page loads
      window.addEventListener('load', function() {
        setTimeout(function() {
          loader.classList.add('fade-out');
          setTimeout(function() {
            loader.style.display = 'none';
          }, 500);
        }, 1000); // Adjust time as needed
      });
    });
  </script>
</body>

</html>
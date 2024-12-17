<!--
  File: forget_pass.html
  Description: Forgot password page for restaurant website
  Features:
  - Email input for password reset
  - Responsive design
  - Visual feedback with illustration
-->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- ================ EXTERNAL LIBRARIES ================ -->
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <title>Forgot Password</title>

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
    .forgot-password-container {
      width: 90%;
      max-width: 800px;
      background: rgba(0, 0, 0, 0.9);
      padding: 2rem;
      border-radius: 10px;
      position: relative;
      z-index: 1;
    }

    /* Illustration Container */
    .image-container {
      background: url(./Images/forgot.png) center/contain no-repeat;
      min-height: 300px;
      border-radius: 8px;
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
    }

    .input-icon {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #495057;
    }

    /* Button Styles */
    .btn-primary {
      background-color: #f8c14d;
      border: none;
      color: black;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #e0a526;
      transform: translateY(-2px);
    }

    /* Typography */
    h2 {
      font-weight: 600;
      font-size: 1.75rem;
    }

    p {
      font-weight: 400;
    }

    .btn {
      font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .image-container {
        min-height: 250px;
        margin: 1rem 0;
        background-size: contain;
        background-position: center;
      }

      .forgot-password-container {
        padding: 1.5rem;
        margin: 1rem;
      }
    }

    @media (max-width: 480px) {
      .image-container {
        min-height: 200px;
      }
    }

    /* Page Loader Styles */
    .loader-wrapper {
      transition: opacity 0.5s ease-in-out;
    }

    .spinner {
      width: 50px;
      height: 50px;
      border: 5px solid #f3f3f3;
      border-top: 5px solid #082A45;
      border-radius: 50%;
      animation: spin 1s linear infinite;
      margin: 0 auto;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    .loader-wrapper.fade-out {
      opacity: 0;
      visibility: hidden;
    }

    .letter-spacing-2 {
      letter-spacing: 2px;
    }
  </style>
</head>

<body>
  <div class="toast-container" id="toast-container"></div>
  <!-- ================ MAIN CONTAINER ================ -->
  <div class="forgot-password-container">
    <!-- Back Navigation -->
    <div class="text-start mb-3">
      <a href="/" class="btn btn-outline-light btn-sm">
        <i class="fas fa-arrow-left"></i> Back to Home
      </a>
    </div>

    <div class="row g-4">
      <!-- Illustration Section -->
      <div class="col-md-6">
        <div class="image-container"></div>
      </div>

      <!-- Form Section -->
      <div class="col-md-6">
        <!-- Form Header -->
        <h2 class="text-warning fw-bold mb-3">Forgot Password</h2>
        <p class="text-white mb-4">Enter your email to reset your password.</p>

        <!-- Reset Password Form -->
        <form>
          <div class="mb-4 input-wrapper">
            <i class="fas fa-envelope input-icon"></i>
            <input type="email" class="form-control" placeholder="Email">
          </div>
          <button type="button" class="btn btn-primary w-100"
            onclick="window.location.href='otp_verification.html'">Reset Password</button>
        </form>

        <!-- Login Link -->
        <div class="text-center mt-4">
          <p class="text-white-50">Remembered your password?
            <a href="/login" class="text-warning text-decoration-none">Login</a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- ================ SCRIPTS ================ -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Page Loader -->
  <div class="loader-wrapper position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-dark"
    style="z-index: 9999;">
    <div class="text-center">
      <div class="spinner mb-3"></div>
      <div class="text-white fw-500 letter-spacing-2">Loading...</div>
    </div>
  </div>

  <!-- Add this script before closing body tag -->
  <script>
    window.addEventListener('load', function() {
      const loader = document.querySelector('.loader-wrapper');
      setTimeout(() => {
        loader.classList.add('fade-out');
        setTimeout(() => {
          loader.style.display = 'none';
        }, 500);
      }, 1000);
    });
  </script>
</body>

</html>
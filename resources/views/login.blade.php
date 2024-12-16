<!--
  File: login.html
  Description: Restaurant login page
  Features:
  - User login form
  - Password visibility toggle
  - Social login options
  - Responsive design
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ================ EXTERNAL LIBRARIES ================ -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Login Interface</title>

    <!-- ================ STYLES ================ -->
    <style>
    /* Global Styles */
    body {
        font-family: 'Poppins', sans-serif;
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

    /* Login Container */
    .login-container {
        width: 90%;
        max-width: 400px;
        background: rgba(0, 0, 0, 0.7);
        padding: 2rem;
        border-radius: 10px;
        position: relative;
        z-index: 1;
        backdrop-filter: blur(10px);
    }

    /* Form Controls */
    .form-control {
        background: white;
        color: black;
        padding-left: 40px;
    }

    .form-control:focus {
        border-color: #f8c14d;
        box-shadow: 0 0 5px #f8c14d;
        outline: none;
    }

    /* Input Icons */
    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        color: #495057;
    }

    /* Password Toggle */
    #togglePassword {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #495057;
        z-index: 10;
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

    /* Social Login Buttons */
    .social-login a {
        background-color: #343a40;
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .social-login a:hover {
        background-color: #f8c14d;
        color: black;
    }

    /* Link Styles */
    a {
        color: #f8c14d;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    a:hover {
        color: #e0a526;
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
    @media (max-width: 480px) {
        .login-container {
            width: 95%;
            padding: 1.5rem;
        }

        .social-login a {
            padding: 8px 16px;
            font-size: 14px;
        }
    }

    @media (max-width: 360px) {
        .login-container {
            padding: 1rem;
        }

        h2 {
            font-size: 1.5rem;
        }

        p {
            font-size: 0.9rem;
        }

        .social-login {
            flex-direction: column;
            gap: 0.5rem;
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
    <div class="login-container">
        <!-- Back Navigation -->
        <div class="text-start mb-3">
            <a href="/" class="btn btn-outline-light btn-sm">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
        </div>

        <!-- Form Header -->
        <h2 class="text-warning fw-bold mb-3">Login</h2>
        <p class="text-white mb-4">Please enter your credentials to continue.</p>

        <!-- Login Form -->
        <form>
            <!-- Email Input -->
            <div class="mb-3 input-wrapper">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <!-- Password Input -->
            <div class="mb-4 input-wrapper">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                <i class="far fa-eye" id="togglePassword"></i>
            </div>
            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </div>
        </form>

        <!-- Forgot Password Link -->
        <div class="text-center mt-3">
            <a href="/forget_password">Forgot Password?</a>
        </div>

        <!-- Social Login Options -->
        <div class="text-center mt-4">
            <p class="text-white-50">Or login with:</p>
            <div class="social-login d-flex justify-content-center gap-3 mt-2">
                <a href="#"><i class="fab fa-google"></i> Google</a>
                <a href="#"><i class="fab fa-apple"></i> Apple</a>
            </div>
        </div>

        <!-- Sign Up Link -->
        <div class="text-center mt-4">
            <p class="text-white-50">Don't have an account?
                <a href="/signup">Sign Up</a>
            </p>
        </div>
    </div>

    <!-- ================ SCRIPTS ================ -->

    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/script.js"></script>
    <!-- Password Toggle Script -->
    <script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#password');

    togglePassword.addEventListener('click', () => {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        togglePassword.classList.toggle('fa-eye-slash');
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
    // on login button click
    $('form').submit(function(e) {
        e.preventDefault();
        var email = $('input[name=email]').val();
        var password = $('input[name=password]').val();
        $.ajax({
            url: '/api/login',
            type: 'POST',

            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                email: email,
                password: password
            },
            success: function(res) {
                if (res.user.role == 'admin') {
                    window.location.href = '/admin/dashboard';
                } else {
                    window.location.href = '/';
                }
            },
            error: function(xhr, status, error) {
                // console.log(xhr);
                // console.log(status);
                // console.log(error);
                if (xhr.responseJSON.errors) {
                    labelErrors('form input', xhr.responseJSON.errors);
                }
                // showToast('Internal server error', 'danger');


            }
        });
    });
    </script>
</body>

</html>
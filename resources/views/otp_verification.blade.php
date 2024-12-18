<!--
  File: otp_password.html
  Description: OTP verification page for password reset
  Features:
  - 6-digit OTP input
  - Auto-focus navigation
  - Timer with resend functionality
  - Input validation
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

    <title>OTP Verification</title>

    <!-- ================ STYLES ================ -->
    <style>
        /* Base styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #212529;
            min-height: 100vh;
        }

        /* OTP Container styles */
        .otp-container {
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        /* OTP Input field styles */
        .otp-input {
            width: 45px;
            height: 45px;
            font-size: 1.5rem;
            text-align: center;
            border: 1px solid #495057;
            border-radius: 8px;
            background-color: #343a40;
            color: white;
            transition: all 0.3s ease;
        }

        /* Focus state for input fields */
        .otp-input:focus {
            border-color: #f8c14d;
            box-shadow: 0 0 5px #f8c14d;
            outline: none;
        }

        /* Resend link styles with hover effects */
        .resend-link {
            color: #f8c14d;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .resend-link:hover {
            color: #ffd166;
            text-decoration: underline;
            transform: translateY(-1px);
        }

        /* Timer styles */
        .timer {
            color: #f8c14d;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        /* Resend link states */
        .resend-link {
            color: #6c757d;
            pointer-events: none;
            opacity: 0.7;
        }

        .resend-link.active {
            color: #f8c14d;
            pointer-events: auto;
            opacity: 1;
        }

        /* Remove number input spinners for all browsers */
        .otp-input::-webkit-outer-spin-button,
        .otp-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .otp-input[type=number] {
            appearance: textfield;
            -moz-appearance: textfield;
            /* Firefox */
        }

        /* Mobile responsive styles */
        @media (max-width: 380px) {
            .otp-input {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }
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
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">
    <!-- Page Loader -->
    <div class="toast-container" id="toast-container"></div>
    <div class="loader-wrapper">
        <div class="loader">
            <div class="spinner"></div>
            <div class="loader-text">Loading...</div>
        </div>
    </div>
    <!-- ================ MAIN CONTAINER ================ -->
    <div class="otp-container p-4 p-sm-5 mx-3" style="max-width: 450px;">
        <!-- Back Navigation -->
        <div class="text-start mb-3">
            <a href="/" class="btn btn-outline-light btn-sm">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
        </div>

        <!-- Header Section -->
        <h2 class="text-warning fw-bold mb-3">OTP Verification</h2>
        <p class="text-white">Enter the 6-digit OTP sent to your registered email.</p>

        <!-- OTP Input Form -->
        <form>
            <div class="d-flex justify-content-center gap-2 my-4">
                <input type="number" maxlength="1" class="otp-input" placeholder="*" required>
                <input type="number" maxlength="1" class="otp-input" placeholder="*" required>
                <input type="number" maxlength="1" class="otp-input" placeholder="*" required>
                <input type="number" maxlength="1" class="otp-input" placeholder="*" required>
                <input type="number" maxlength="1" class="otp-input" placeholder="*" required>
                <input type="number" maxlength="1" class="otp-input" placeholder="*" required>
            </div>

            <!-- Loading Spinner (Hidden by default) -->
            <div id="spinner" class="d-none text-center mt-3">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </form>

        <!-- Resend OTP Section -->
        <div class="text-warning mt-4">
            <div class="timer mb-2">Time remaining: <span id="timer">02:00</span></div>
            Didn't receive the code?
            <a href="#" class="resend-link" id="resendLink">Resend OTP</a>
        </div>
    </div>

    <!-- ================ SCRIPTS ================ -->
    <!-- Bootstrap Bundle -->
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/script.js"></script>

    <!-- Main JavaScript -->
    <script>
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

            // Initialize variables
            const inputs = document.querySelectorAll('.otp-input');
            const form = document.querySelector('form');
            const spinner = document.getElementById('spinner');

            // Handle OTP input functionality
            inputs.forEach((input, index) => {
                // Prevent non-numeric inputs
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'e' || e.key === '+' || e.key === '-' || e.key === '.') {
                        e.preventDefault();
                    }
                });

                // Handle input and auto-focus
                input.addEventListener('input', function(e) {
                    // Clean input - numbers only
                    this.value = this.value.replace(/[^0-9]/g, '');

                    // Ensure single digit
                    if (this.value.length > 1) {
                        this.value = this.value.slice(0, 1);
                    }

                    // Auto-focus next input
                    if (this.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }

                    // Check for form completion
                    if (index === inputs.length - 1 && this.value.length === 1) {
                        const otp = Array.from(inputs).map(input => input.value).join('');

                        spinner.classList.remove('d-none');
                        $.ajax({
                            type: 'POST',
                            url: '/api/verify-otp',
                            data: {
                                otp: otp
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                spinner.classList.add('d-none');
                                window.location.href = '/';
                            },
                            error: function(xhr, status, error) {
                                spinner.classList.add('d-none');
                                if (xhr.responseJSON.message) {
                                    showToast(xhr.responseJSON.message, 'danger');
                                }
                            }
                        })

                    }
                });

                // Handle backspace navigation
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && index > 0 && input.value.length === 0) {
                        inputs[index - 1].focus();
                    }
                });
            });
        });

        // Timer functionality
        //let timeLeft = {{$timeLeft}};
        let timeLeft = {{$timeLeft}};


        let timerId = null;
        const timerDisplay = document.getElementById('timer');
        const resendLink = document.getElementById('resendLink');

        // Start timer function
        function startTimer() {
            resendLink.classList.remove('active');

            if (timerId) clearInterval(timerId);

            timerId = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(timerId);
                    resendLink.classList.add('active');
                    timerDisplay.textContent = '00:00';
                    return;
                }

                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;

                timerDisplay.textContent =
                    `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                timeLeft--;
            }, 1000);
        }

        // Start timer when page loads
        startTimer(timeLeft);

        // Handle resend click
        resendLink.addEventListener('click', (e) => {
            e.preventDefault();
            if (resendLink.classList.contains('active')) {
                // Add your resend OTP logic here
                startTimer();
            }
        });
    </script>
</body>

</html>
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
  
  <title>User Profile</title>
  
  <!-- ================ STYLES ================ -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: url(./Images/vegetables-set-left-black-slate.jpg) center/cover;
      background-attachment: fixed;
      color: white;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .profile-container {
      background: rgba(0, 0, 0, 0.7);
      padding: 2rem;
      border-radius: 10px;
      width: 90%;
      max-width: 500px;
      backdrop-filter: blur(10px);
    }

    .form-control {
      background: white;
      color: black;
    }

    .btn-primary {
      background-color: #f8c14d;
      border: none;
      color: black;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #e0a526;
    }

    .alert {
      display: none;
      margin-top: 1rem;
    }
  </style>
</head>
<body>
  <div class="profile-container">
    <h2 class="text-warning fw-bold mb-3">User Profile</h2>
    
    <!-- Alert Messages -->
    <div class="alert alert-success" id="successAlert"></div>
    <div class="alert alert-danger" id="errorAlert"></div>
    
    <!-- Profile Form -->
    <form id="profileForm">
      <!-- Name Fields -->
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="first_name" class="form-label">First Name</label>
          <input type="text" class="form-control" id="first_name" name="first_name" value="{{ auth()->user()->first_name }}" required>
        </div>
        <div class="col-md-6">
          <label for="last_name" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="last_name" name="last_name" value="{{ auth()->user()->last_name }}" required>
        </div>
      </div>
      
      <!-- Email Field -->
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}" disabled>
      </div>
      
      <!-- Phone Field -->
      <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="tel" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}" required>
      </div>
      
      <!-- Address Field -->
      <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" name="address" rows="3">{{ auth()->user()->address->name ?? '' }}</textarea>
      </div>
      
      <!-- Update Profile Button -->
      <button type="submit" class="btn btn-primary w-100 mb-4">Update Profile</button>
    </form>

    <!-- Password Change Form -->
    <h3 class="text-warning fw-bold mb-3">Change Password</h3>
    <form id="passwordForm">
      <div class="mb-3">
        <label for="current_password" class="form-label">Current Password</label>
        <input type="password" class="form-control" id="current_password" name="current_password" required>
      </div>
      <div class="mb-3">
        <label for="new_password" class="form-label">New Password</label>
        <input type="password" class="form-control" id="new_password" name="new_password" required>
      </div>
      <div class="mb-3">
        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Change Password</button>
    </form>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('/js/jquery-3.7.1.min.js') }}"></script>
  <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
  
  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      // Show alert function
      function showAlert(message, type) {
        const alertId = type === 'success' ? '#successAlert' : '#errorAlert';
        $(alertId).text(message).fadeIn().delay(3000).fadeOut();
      }

      // Handle profile update
      $('#profileForm').submit(function(e) {
        e.preventDefault();
        
        const formData = {
          first_name: $('#first_name').val(),
          last_name: $('#last_name').val(),
          phone: $('#phone').val(),
          address: $('#address').val()
        };

        $.ajax({
          type: 'POST',
          url: '/api/profile/update',
          data: formData,
          success: function(response) {
            showAlert('Profile updated successfully', 'success');
          },
          error: function(xhr) {
            const errorMessage = xhr.responseJSON?.message || 'Error updating profile';
            showAlert(errorMessage, 'error');
          }
        });
      });

      // Handle password change
      $('#passwordForm').submit(function(e) {
        e.preventDefault();
        
        const formData = {
          current_password: $('#current_password').val(),
          new_password: $('#new_password').val(),
          new_password_confirmation: $('#new_password_confirmation').val()
        };

        $.ajax({
          type: 'POST',
          url: '/api/profile/change-password',
          data: formData,
          success: function(response) {
            showAlert('Password changed successfully', 'success');
            $('#passwordForm')[0].reset();
          },
          error: function(xhr) {
            const errorMessage = xhr.responseJSON?.message || 'Error changing password';
            showAlert(errorMessage, 'error');
          }
        });
      });
    });
  </script>
</body>
</html>
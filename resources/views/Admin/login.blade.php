<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Form</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-container {
      width: 100%;
      max-width: 400px;
      background-color: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #6a11cb;
    }
    .btn-primary {
      background-color: #6a11cb;
      border: none;
    }
    .btn-primary:hover {
      background-color: #5a0db2;
    }
    .form-icon {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      color: #aaa;
    }
    .form-group {
      position: relative;
    }
    .form-control {
      padding-left: 40px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>  
    @endif

    @if(session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>  
    @endif
    <h3 class="text-center mb-4">Sign In</h3>
    <form action="{{ route('login.check') }}" method="POST">
      @csrf
      <div class="mb-3 form-group">
        <i class="fa fa-envelope form-icon"></i>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
      </div>
      <div class="mb-3 form-group">
        <i class="fa fa-lock form-icon"></i>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
      <div class="text-center mt-3">
        <small><a href="#" class="text-muted">Forgot password?</a></small>
        <br>
         <small><a href="{{ route('register') }}" class="text-muted">Create Account</a></small>
      </div>
    </form>
  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

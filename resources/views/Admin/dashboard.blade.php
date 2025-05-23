{{-- @php
  dd($products)
@endphp --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>eCommerce Dashboard</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8f9fa;
    }
    .sidebar {
      height: 100vh;
      background-color: #343a40;
      color: white;
      position: fixed;
      padding-top: 1rem;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      padding: 10px 20px;
      display: block;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
    .main-content {
      margin-left: 250px;
      padding: 2rem;
    }
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  @include('layouts.sidebar')

  <!-- Main Content -->
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-white shadow-sm mb-4 rounded">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h5">{{$data->name}} Dashboard</span>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search..." />
          <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
        </form>
      </div>
    </nav>

    <!-- Dashboard Cards -->
    <div class="row g-4">
      <div class="col-md-3">
        <div class="card p-3 text-center">
          <i class="fas fa-box fa-2x text-primary mb-2"></i>
          <h5>{{$products}}</h5>
          <p class="text-muted mb-0">Products</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3 text-center">
          <i class="fas fa-shopping-cart fa-2x text-success mb-2"></i>
          <h5>350</h5>
          <p class="text-muted mb-0">Orders</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3 text-center">
          <i class="fas fa-dollar-sign fa-2x text-warning mb-2"></i>
          <h5>$8,450</h5>
          <p class="text-muted mb-0">Revenue</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3 text-center">
          <i class="fas fa-users fa-2x text-danger mb-2"></i>
          <h5>225</h5>
          <p class="text-muted mb-0">Customers</p>
        </div>
      </div>
    </div>

    <!-- Recent Orders Section (Example) -->
    <div class="mt-5">
      <h5>Recent Orders</h5>
      <table class="table table-hover bg-white rounded shadow-sm">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Status</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>#1234</td>
            <td>John Doe</td>
            <td>May 7, 2025</td>
            <td><span class="badge bg-success">Completed</span></td>
            <td>$320</td>
          </tr>
          <tr>
            <td>#1235</td>
            <td>Jane Smith</td>
            <td>May 7, 2025</td>
            <td><span class="badge bg-warning">Pending</span></td>
            <td>$150</td>
          </tr>
          <tr>
            <td>#1236</td>
            <td>Ali Singh</td>
            <td>May 6, 2025</td>
            <td><span class="badge bg-danger">Canceled</span></td>
            <td>$220</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Footer -->
    <footer class="mt-5 text-center">
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
          </div>

  <!-- Bootstrap Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

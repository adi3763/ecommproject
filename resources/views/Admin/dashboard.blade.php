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
      background-color: #343a40;
      color: white;
      padding-top: 1rem;
      min-height: 100vh;
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
      padding: 2rem;
    }
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      margin-bottom: 1rem;
    }
    .table-responsive {
      overflow-x: auto;
    }
    .navbar-brand {
      font-size: 1.1rem;
    }
    @media (max-width: 991.98px) {
      .main-content {
        padding: 1rem;
        margin-left: 0;
      }
      .sidebar {
        min-height: auto;
        position: static;
      }
      .navbar-brand {
        font-size: 1rem;
      }
    }
    @media (max-width: 767.98px) {
      .main-content {
        padding: 0.5rem;
      }
      .card {
        margin-bottom: 1rem;
        padding: 1rem 0.5rem;
      }
      .navbar-brand {
        font-size: 0.95rem;
      }
      .table th, .table td {
        font-size: 0.95rem;
        padding: 0.5rem;
      }
    }
    @media (max-width: 575.98px) {
      .main-content {
        padding: 0.25rem;
      }
      .card {
        margin-bottom: 0.75rem;
        padding: 0.75rem 0.25rem;
      }
      .navbar-brand {
        font-size: 0.9rem;
      }
      .table th, .table td {
        font-size: 0.9rem;
        padding: 0.4rem;
      }
      .row.g-4 {
        --bs-gutter-x: 0.5rem;
        --bs-gutter-y: 0.5rem;
      }
    }
    /* Hide sidebar by default on mobile, show with toggler */
    @media (max-width: 991.98px) {
      #sidebarMenu {
        position: absolute;
        z-index: 1050;
        width: 70vw;
        max-width: 300px;
        left: 0;
        top: 56px;
        background: #343a40;
        border-radius: 0 10px 10px 0;
        box-shadow: 2px 0 8px rgba(0,0,0,0.1);
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar (collapsible on mobile) -->
  <nav class="navbar navbar-dark bg-dark d-lg-none">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <span class="navbar-brand mb-0 h1">Menu</span>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row flex-nowrap">
      <div class="col-lg-2 px-0">
        <div class="collapse d-lg-block sidebar" id="sidebarMenu">
          @include('layouts.sidebar')
        </div>
      </div>
      <div class="col-lg-10 main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-light bg-white shadow-sm mb-4 rounded">
          <div class="container-fluid flex-wrap">
            <span class="navbar-brand mb-0 h5">{{$data->name}} Dashboard</span>
            <form class="d-flex mt-2 mt-lg-0 w-100 w-lg-auto">
              <input class="form-control me-2" type="search" placeholder="Search..." />
              <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
            </form>
          </div>
        </nav>

        <!-- Dashboard Cards -->
        <div class="row g-4">
          <div class="col-6 col-md-3">
            <div class="card p-3 text-center">
              <i class="fas fa-box fa-2x text-primary mb-2"></i>
              <h5>{{$products}}</h5>
              <p class="text-muted mb-0">Products</p>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="card p-3 text-center">
              <i class="fas fa-shopping-cart fa-2x text-success mb-2"></i>
              <h5>350</h5>
              <p class="text-muted mb-0">Orders</p>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="card p-3 text-center">
              <i class="fas fa-dollar-sign fa-2x text-warning mb-2"></i>
              <h5>$8,450</h5>
              <p class="text-muted mb-0">Revenue</p>
            </div>
          </div>
          <div class="col-6 col-md-3">
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
          <div class="table-responsive">
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
        </div>

        <!-- Footer -->
        <footer class="mt-5 text-center">
          <form method="POST" action="{{ secure_url('/logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">
              <i class="bi bi-box-arrow-right"></i> Logout
            </button>
          </form>
        </footer>
      </div>
    </div>
  </div>
  <!-- Bootstrap Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

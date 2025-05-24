{{-- @php
  dd($categories);
@endphp --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>eCommerce Home Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    .carousel-item{
        height: 800px;
    }
    .carousel-item img {
        object-fit:fill;
        height: 100%;
    }
    </style>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
  <a class="navbar-brand" href="#">MyShop</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Shop</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('cart') }}">Cart</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
       <form method="POST" action="{{ secure_url('/logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </ul>
  </div>
</nav>

<!-- Carousel Slider -->
<div id="mainSlider" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('assets/Banner_1.png') }}" class="d-block w-100" alt="New Arrivals">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('assets/Banner_2.png') }}" class="d-block w-100" alt="Hot Deals">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('assets/banner_3.png') }}" class="d-block w-100" alt="Trending Now">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#mainSlider" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#mainSlider" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<!-- Categories -->
<div class="container py-5">
  <h3 class="text-center mb-4">Shop by Category</h3>
  <div class="row g-4 text-center">
 @foreach ($categories as $category)
  <div class="col-6 col-md-3">
    <div class="card h-100 position-relative">
      <img src="{{ asset('storage/' .$category->images) }}" class="card-img-top" alt="{{ $category->category_name }}">
      <div class="card-body">
        <h5 class="card-title">{{$category->category_name}}</h5>
      </div>
      <a href="{{ route('shopbycategory', ['category' =>$category->id, 'slug'=>$category->slug]) }}" class="stretched-link"></a>
    </div>
  </div>
@endforeach
  </div>
</div>

<!-- Featured Products -->
<div class="container py-5">
  <h3 class="text-center mb-4">Shop by Subcategories</h3>
  <div class="row g-4">
    @foreach ($categories as $category )
    @foreach ($category->subcategories as $subcategory)
      
    <div class="col-sm-6 col-md-4 col-lg-3">
      <div class="card h-100">
        <img src="{{ asset('storage/' .$subcategory->subcategory_image) }}" class="card-img-top" alt="Product 1">
        <div class="card-body text-center">
          <h5 class="card-title">{{$subcategory->subcategory_name}}</h5>
        </div>
      </div>
    </div>
    @endforeach

    @endforeach
  </div>
</div>



<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
  &copy; 2025 MyShop. All rights reserved.
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <!-- Add your CSS or meta tags here -->
</head>
<body>
    <header>
        <h1>Welcome, User!</h1>
    </header>
    <main>
        <p>This is the user page. Customize it as needed.</p>
        <!-- Add user-specific content here -->
       
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
    </footer>
</body>
</html> --}}



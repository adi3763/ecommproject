{{-- @php
    dd($cartItems);
@endphp --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail - My E-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .price {
            font-size: 1.5rem;
            color: #B12704;
            font-weight: bold;
        }

        .mrp {
            text-decoration: line-through;
            color: gray;
            margin-left: 10px;
        }

        .rating-stars {
            color: #FFA41C;
            font-size: 1rem;
        }

        .btn-action {
            width: 48%;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <!-- Add this just after <body> or inside your container, before the main content -->
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('cart') }}" class="btn btn-outline-secondary position-relative">
                <i class="bi bi-cart3" style="font-size: 1.5rem;"></i>
                <!-- Optionally, show cart item count -->
                @php
                    $item = $cartItems->count();
                @endphp
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $item ? $item : 0 }}
                </span>
            </a>
        </div>
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6">
                @if ($product->productimage->count())
                    <img src="{{ secure_asset($product->productimage->first()->product_image) }}"
                        alt="{{ $product->productname }}" class="img-fluid">
                @endif
            </div>

            <!-- Product Details -->
            <div class="col-md-6">


                <h2>{{ $product->productname }}</h2>
                <div class="rating-stars mb-2">
                    ★★★★☆ <small>(4 star ratings)</small>
                </div>
                <p class="price">
                    <span class="price">₹{{ number_format($product->product_price) }}</span>
                </p>
                <p class="text-success">Free delivery available</p>
                <p><strong>Availability:</strong> {{ $product->product_quantity > 0 ? 'In Stock' : 'Out of Stock' }}</p>

                <hr>
                <h5 class="mb-4">Description</h5>
                <p class="mb-4">{{ $product->product_discription }}</p>


                <form action="{{ secure_url('/cart/add') }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-between mt-4">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-outline-primary btn-action">Add to Cart</button>
                        <button type="submit" class="btn btn-primary btn-action">Buy Now</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

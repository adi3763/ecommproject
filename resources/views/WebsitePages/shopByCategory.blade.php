{{-- @php
    dd($data);
@endphp --}}

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Electronics - My E-commerce</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .price { font-size: 1.2rem; font-weight: bold; color: #B12704; }
    .mrp { text-decoration: line-through; color: gray; margin-left: 5px; }
    .badge-offer { background-color: #cc0c39; color: white; font-size: 0.75rem; }
    .card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    .rating-stars { color: #FFA41C; font-size: 0.9rem; }
    @media (max-width: 767.98px) {
      .card { margin-bottom: 1rem; }
      .card-img-top { height: 180px; object-fit: cover; }
      .card-title { font-size: 1rem; }
      .price { font-size: 1rem; }
    }
    @media (max-width: 575.98px) {
      .row.g-4 { --bs-gutter-x: 0.5rem; --bs-gutter-y: 0.5rem; }
      .card { padding: 0.5rem; }
      .card-img-top { height: 120px; }
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <h2 class="mb-4 text-center">{{$data->category_name}}</h2>

    <div class="row g-4">
      @foreach ($data->product as $product)
        @foreach ($product->productimage as $image )
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100">
              <img src="{{ secure_asset($image->product_image) }}" class="card-img-top" alt="{{ $product->productname }}">
              <div class="card-body">
                <h6 class="card-title">{{ $product->productname }}</h6>
                <div class="d-flex align-items-center mb-2">
                  <span class="price">₹{{ number_format($product->product_price) }}</span>
                </div>
                <p class="text-success small mb-1">Free delivery by {{ now()->addDays(2)->format('D, d M') }}</p>
                <div class="text-center">
                  <button class="btn btn-primary btn-sm">Add to Cart</button>
                </div>
                 <a href="{{ route('buyproduct', ['category' =>$data->category_name, 'slug'=>$data->slug, 'id'=>$product->id]) }}" class="stretched-link"></a>

              </div>
            </div>
          </div>
        @endforeach
      @endforeach
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

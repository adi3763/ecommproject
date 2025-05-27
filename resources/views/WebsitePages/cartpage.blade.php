{{-- @php
    dd($cartItems);
@endphp --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .cart-img { width: 140px; height: 140px; object-fit: cover; }
    .btn-icon { padding: 0.25rem 0.5rem; font-size: 0.9rem; }
    .qty-box { width: 50px; text-align: center; }
    @media (max-width: 767.98px) {
      .cart-img { width: 80px; height: 80px; }
      .table { font-size: 0.95rem; }
      .container { padding: 1rem 0.5rem; }
    }
    @media (max-width: 575.98px) {
      .cart-img { width: 50px; height: 50px; }
      .container { padding: 0.5rem 0.2rem; }
      .table-responsive { overflow-x: auto; }
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <h2 class="mb-4 text-center">Shopping Cart</h2>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cartItems->count())
      <div class="table-responsive">
        <table class="table align-middle">
          <thead>
            <tr>
              <th>Product</th>
              <th>Name</th>
              <th>Price</th>
              <th class="text-center">Quantity</th>
              <th>Total</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($cartItems as $item)
              @php
                $subtotal = $item->quantity * $item->product->product_price;
                $grandTotal += $subtotal;
              @endphp
              <tr>
                  @foreach ($item->product->productimage as $image )
                      
                  
                <td><img src="{{ secure_asset($image->product_image) }}" class="cart-img"></td>
                @endforeach
                <td>{{ $item->product->productname }}</td>
                <td>₹{{ number_format($item->product->product_price) }}</td>
                <td class="text-center">
                  <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('update.cart') }}" method="POST" class="me-2">
                      @csrf
                      <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                      <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                      <button type="submit" class="btn btn-outline-secondary btn-icon" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                        <i class="bi bi-dash"></i>
                      </button>
                    </form>

                    <input type="text" value="{{ $item->quantity }}" readonly class="form-control qty-box mx-1">

                    <form action="{{ route('update.cart') }}" method="POST" class="ms-2">
                      @csrf
                      <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                      <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                      <button type="submit" class="btn btn-outline-secondary btn-icon">
                        <i class="bi bi-plus"></i>
                      </button>
                    </form>
                  </div>
                </td>
                <td>₹{{ number_format($subtotal) }}</td>
                <td>
                  <form action="{{ route('cart.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                    <button class="btn btn-outline-danger btn-sm" title="Remove">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="text-end">
        <h5>Grand Total: ₹{{ number_format($grandTotal) }}</h5>
        <a href=" {{ route('address') }} " class="btn btn-success mt-3">Proceed to Checkout</a>
      </div>
    @else
      <p>Your cart is currently empty.</p>
    @endif
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

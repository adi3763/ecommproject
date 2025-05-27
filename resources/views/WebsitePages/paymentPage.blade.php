{{-- @php
    dd($addresses);
@endphp --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Select Address & Payment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .address-card {
      border: 2px solid #ddd;
      border-radius: 8px;
      padding: 15px;
      cursor: pointer;
      transition: all 0.2s;
    }
    .address-card.selected {
      border-color: #0d6efd;
      background-color: #e9f3ff;
    }
    .payment-option {
      border: 2px solid #ddd;
      padding: 15px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      cursor: pointer;
      transition: all 0.2s;
    }
    .payment-option.selected {
      border-color: #198754;
      background-color: #e6f5ea;
    }
    .payment-option i {
      font-size: 1.5rem;
      margin-right: 10px;
    }
  </style>
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4">Select Delivery Address</h2>
  <form action="#" method="POST">
    @csrf

    <div class="row g-3 mb-5">
      @foreach($addresses as $address)
        <div class="col-md-6">
          <label class="address-card w-100">
            <input type="radio" name="address_id" value="{{ $address->id }}" class="form-check-input me-2" required>
            <div>
              <strong>{{ $address->full_name }}</strong><br>
              {{ $address->address_line_1 }}, {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}<br>
              Phone: {{ $address->phone }}
            </div>
          </label>
        </div>
      @endforeach
    </div>

    <h4 class="mb-3">Select Payment Method</h4>
    <div class="row g-3 mb-4">
      <div class="col-md-4">
        <label class="payment-option w-100">
          <input type="radio" name="payment_method" value="cod" class="form-check-input me-2" required>
          <i class="bi bi-cash"></i> Cash on Delivery
        </label>
      </div>
      <div class="col-md-4">
        <label class="payment-option w-100">
          <input type="radio" name="payment_method" value="razorpay" class="form-check-input me-2" required>
          <i class="bi bi-credit-card"></i> Razorpay
        </label>
      </div>
      <div class="col-md-4">
        <label class="payment-option w-100">
          <input type="radio" name="payment_method" value="upi" class="form-check-input me-2" required>
          <i class="bi bi-upc-scan"></i> UPI
        </label>
      </div>
    </div>

    <button type="submit" class="btn btn-success">Continue to Review</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const addressRadios = document.querySelectorAll('input[name="address_id"]');
  const paymentRadios = document.querySelectorAll('input[name="payment_method"]');

  addressRadios.forEach(radio => {
    radio.addEventListener('change', () => {
      document.querySelectorAll('.address-card').forEach(c => c.classList.remove('selected'));
      radio.closest('.address-card').classList.add('selected');
    });
  });

  paymentRadios.forEach(radio => {
    radio.addEventListener('change', () => {
      document.querySelectorAll('.payment-option').forEach(c => c.classList.remove('selected'));
      radio.closest('.payment-option').classList.add('selected');
    });
  });
</script>
</body>
</html>

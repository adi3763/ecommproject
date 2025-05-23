<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Address</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-5">
    <h2 class="mb-4 text-center">Add Delivery Address</h2>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action=" {{ route('address.add') }} " method="POST">
      @csrf
      {{-- <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"> --}}
      <div class="mb-3">
        <label for="full_name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="full_name" name="full_name" required>
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phone" name="phone" required>
      </div>

      <div class="mb-3">
        <label for="address_line" class="form-label">Address Line</label>
        <textarea class="form-control" id="address_line" name="address_line_1" rows="2" required></textarea>
      </div>

      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="city" class="form-label">City</label>
          <input type="text" class="form-control" id="city" name="city" required>
        </div>

        <div class="col-md-4 mb-3">
          <label for="state" class="form-label">State</label>
          <input type="text" class="form-control" id="state" name="state" required>
        </div>

        <div class="col-md-4 mb-3">
          <label for="pincode" class="form-label">Pincode</label>
          <input type="text" class="form-control" id="pincode" name="pincode" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="type" class="form-label">Address Type</label>
        <select class="form-select" id="type" name="type">
          <option value="home">Home</option>
          <option value="work">Work</option>
          <option value="other">Other</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Submit Address</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

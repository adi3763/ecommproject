{{-- @php
    dd($category)
@endphp
<h1>Hello World</h1> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Interactive Image Upload</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


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
            margin-left: 15em;
            padding: 2rem;

        }

        .image-upload-box {
            border: 2px dashed #ccc;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .image-upload-box:hover {
            border-color: #0d6efd;
        }

        .image-upload-box i {
            font-size: 36px;
            color: #aaa;
        }

        .image-preview {
            display: flex;
            flex-wrap: wrap;
            margin-top: 20px;
            gap: 10px;
        }

        .image-preview img {
            max-width: 120px;
            border: 1px solid #ccc;
            padding: 5px;
            border-radius: 5px;
        }

        input[type="file"] {
            display: none;
        }

        .dt-button {
            background-color: #fad60b !important;
            color: rgb(0, 0, 0) !important;
            border: none !important;
            padding: 8px 15px !important;
            border-radius: 4px !important;
            margin-right: 8px !important;
            font-size: 14px !important;
            width: 150px !important;
        }

        .dt-button:hover {
            background-color: #abd70b !important;
        }
    </style>
</head>

<body>


    @include('layouts.sidebar') <!-- Laravel Blade Sidebar -->
    <div class="container-fluid">
        <div class="main-content">
            <div class="container mt-4">
                <h3 class="mb-4">Edit Product</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        <ul>
                            <div class="alert alert-success">{{ session('success') }}</div>

                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.product.update', [$product->id]) }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Custom Upload Box -->
                    <label for="productImages" class="image-upload-box">
                        <i class="bi bi-plus-lg"></i><br>
                        Click to upload product images
                    </label>
                    <input type="file" id="productImages"  name="product_images[]" accept="image/*" multiple
                        onchange="previewMultipleImages(event)">
                    <div id="imagePreview" class="image-preview"></div>

                    <div class="mb-3 mt-4">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" value="{{ $product->productname }}" id="productName"
                            name="productname" required placeholder="Enter product name">
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" value="{{ $product->product_price }}" id="price"
                            name="product_price" required placeholder="Enter price">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="product_discription" required rows="3"
                            placeholder="Enter product description">{{ $product->product_discription }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" value="{{ $product->product_quantity }}" class="form-control"
                            id="quantity" name="product_quantity" required placeholder="Enter available quantity">
                    </div>

                    <div class="mb-3">
                        <label for="size" class="form-label">Size</label>
                        <select class="form-select" id="size" name="product_size" required>
                            <option selected disabled>Select size</option>
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                            <option value="extra_large">Extra Large</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category_id" required>
                            <option selected disabled>Select category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">
                                    {{ $cat->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="subcategory" class="form-label">Subcategory</label>
                        <select class="form-select" id="subcategory" name="subcategory_id" required>
                            <option selected disabled>Select subcategory</option>

                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
<script src="{{ asset('JS/editProduct.js') }}"></script>
</body>
</html>

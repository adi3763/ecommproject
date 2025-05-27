{{-- @php
  dd($data)
@endphp --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin - Category Management</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
       width: 100%;
     }
     .sidebar {
       height: 100vh;
       background-color: #343a40;
       color: white;
       position: fixed;
       padding-top: 1rem;
       width: 15em;
       max-width: 100vw;
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
       margin-right: 0;
       padding: 2rem;
     }
     @media (max-width: 991.98px) {
       .sidebar {
         position: static;
         width: 100%;
         min-height: auto;
       }
       .main-content {
         margin-left: 0;
         padding: 1rem 0.5rem;
       }
     }
     @media (max-width: 767.98px) {
       .main-content { padding: 0.5rem 0.2rem; }
       .card { margin-bottom: 1rem; }
     }
     .card {
       border: none;
       border-radius: 10px;
       box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
     }
     .container {
       padding-left: 0;
       padding-right: 0;
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

     <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>
<body>

<div class="container-fluid">

  @include('layouts.sidebar')

  <div class="main-content">
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif


  <h2 class="mb-4">Category Management</h2>

  <!-- Add Category -->
  <div class="card mb-4">
    <div class="card-header">Add New Category</div>
    <div class="card-body">
<form action="{{ secure_url('admin/category/insert') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="categoryName" class="form-label">Category Name</label>
          <input type="text" name="category_name" class="form-control" id="categoryName" placeholder="e.g. Electronics">
        </div>

          <div class="mb-3">
        <label for="categorySlug" class="form-label">Category Slug</label>
        <input type="text" name="slug" class="form-control" id="categorySlug" placeholder="e.g. electronics">
    </div>
    <div class="mb-3">
        <label for="categoryImage" class="form-label">Category Image</label>
        <input type="file" name="images" class="form-control" id="categoryImage" accept="image/*">
    </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
      </form>
    </div>
  </div>

  <!-- Add Subcategory -->
  <div class="card mb-4">
    <div class="card-header">Add Subcategory</div>
    <div class="card-body">
      <form action="{{ secure_url('/admin/subcategory/insert') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="parentCategory" class="form-label">Parent Category</label>
          <select class="form-select" id="parentCategory" name="category_id">
            <option selected>Select Category</option>
            @foreach ($data as $d )
              <option value="{{ $d->id }}">{{ $d->category_name }}</option>
              
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="subCategoryName" class="form-label">Subcategory Name</label>
          <input type="text" name="subcategory_name" class="form-control" id="subCategoryName" placeholder="e.g. Laptops">
        </div>

          <div class="mb-3">
        <label for="categorySlug" class="form-label">SubCategory Slug</label>
        <input type="text" name="subcategory_slug" class="form-control" id="categorySlug" placeholder="e.g. electronics">
    </div>
    <div class="mb-3">
        <label for="categoryImage" class="form-label">SubCategory Image</label>
        <input type="file" name="subcategory_image" class="form-control" id="categoryImage" accept="image/*">
    </div>



        <button type="submit" id="submit-button" class="btn btn-success">Add Subcategory</button>
      </form>
    </div>
  </div>

  <!-- Category/Subcategory List -->
    <div class="card">
      <div class="card-header">All Categories & Subcategories</div>
      <div class="card-body">
      <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Category</th>
              <th>Subcategory</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $category)
                <tr>
                    <td>{{ $category->category_name }}</td>
                    <td>
                        <ul>
                            @foreach ($category->subcategories as $subcategory)
                                <li>{{ $subcategory->subcategory_name }}</li>
                            @endforeach
                        </ul>
                    </td>
                  
                </tr>
            @endforeach
        </tbody>
        </table> 
     

  </div>
  <div class="card m-3">
  <div class="card p-4 shadow-sm">
<h2 class="mb-3">Load Subcategories</h2>
<form action="{{ secure_url('/admin/category/loadData') }}" id="loadCategory" method="GET"  >
    <div class="mb-3">
      <label for="category" class="form-label">Select Category</label>
      <select id="category" name="category_id" class="form-select">
        <option value="">-- Select --</option>
        @foreach($data as $category)
          <option value="{{ $category->id }}">{{ $category->category_name }}</option>
        @endforeach
      </select>
    </div>

    <button id="loadSubcategories"  class="btn btn-primary">Show Subcategories</button>
 </form>

  <h3>Category: <span id="categoryName"></span></h3>

  <table id="subcategoryTable" class="display table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Subcategory Name</th>
        <th>Created At</th>
        <th>Actions</th>
      </tr>
    </thead>
   <tbody id="subcategoryTableBody">
        <!-- JS will fill this -->
    </tbody>
    <tfoot>
  <tr>
    <th>#</th>
    <th>Subcategory Name</th>
    <th>Created At</th>
    <th>Actions</th>
  </tr>
</tfoot>
  </table>
    </div>

  </div>
</div>



</div> 

<script src="{{ secure_asset('JS/addSubCategory.js') }}"></script>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- jQuery + DataTables JS + Buttons -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>


</body>
</html>



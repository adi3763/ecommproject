<div class="sidebar d-flex flex-column position-fixed w-100 w-lg-auto" style="width: 15em; max-width:100vw;">
    <h4 class="text-center mb-4">eShop Admin</h4>
    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="{{ route('admin.productpage') }}"><i class="fas fa-box me-2"></i> Products</a>
    <a href="#"><i class="fas fa-shopping-cart me-2"></i> Orders</a>
    <a href="#"><i class="fas fa-users me-2"></i> Customers</a>
    <a href="{{ route('admin.categorypage') }}"><i class="fas fa-list"></i> Category</a>
    <a href="#"><i class="fas fa-cog me-2"></i> Settings</a>
    {{-- <form action="{{ route('admin.logout') }}" method="POST">
      @csrf
      <button id="logout" name="logout"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
    </form> --}}
</div>
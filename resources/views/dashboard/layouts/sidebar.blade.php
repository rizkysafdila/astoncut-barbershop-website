<nav class="p-3">
  <div class="brand text-center">
    <img src="{{ asset('img/astoncut-logo.png') }}" alt="Aston Cut">
  </div>
  <div class="position-sticky mt-3">
    <ul class="nav flex-column">
      <li class="nav-item my-1">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
          <i class="fa-duotone fa-grid-2 px-md-1 px-lg-3 py-2"></i>
          Dashboard
        </a>
      </li>

      @can('customer')
        <li class="nav-item my-1">
          <a class="nav-link {{ Request::is('dashboard/my-reservations*') ? 'active' : '' }}" href="/dashboard/my-reservations">
            <i class="fa-duotone fa-calendar-check px-md-1 px-lg-3 py-2"></i>
            My Reservation
          </a>
        </li>
      @endcan

      @can('admin')
        <li class="nav-item my-1">
          <a class="nav-link {{ Request::is('dashboard/customers*') ? 'active' : '' }}" href="/dashboard/customers">
            <i class="fa-duotone fa-user-group fa-sm px-md-1 px-lg-3 py-2"></i>
            Customers
          </a>
        </li>
      @endcan
      <li class="nav-item my-1">
        <a class="nav-link {{ Request::is('dashboard/transactions*') ? 'active' : '' }}" href="/dashboard/transactions">
          <i class="fa-duotone fa-money-bill-simple-wave px-md-1 px-lg-3 py-2"></i>
          Transactions
        </a>
      </li>
      @can('admin')
        <li class="nav-item my-1">
          <a class="nav-link {{ Request::is('dashboard/services*') ? 'active' : '' }}" href="/dashboard/services">
            <i class="fa-duotone fa-scissors px-md-1 px-lg-3 py-2"></i>
            Services
          </a>
        </li>
        <li class="nav-item my-1">
          <a class="nav-link {{ Request::is('dashboard/stylists*') ? 'active' : '' }}" href="/dashboard/stylists">
            <i class="fa-duotone fa-user px-md-1 px-lg-3 py-2"></i>
            Stylists
          </a>
        </li>
        {{-- <li class="nav-item my-1">
        <a class="nav-link {{ Request::is('dashboard/products*') ? 'active' : '' }}" href="/dashboard/products">
          <i class="fa-duotone fa-box px-md-1 px-lg-3 py-2"></i>
          Products
        </a>
      </li> --}}
        <li class="nav-item my-1">
          <a class="nav-link {{ Request::is('dashboard/report*') ? 'active' : '' }}" href="/dashboard/report">
            <i class="fa-duotone fa-chart-mixed px-md-1 px-lg-3 py-2"></i>
            Report
          </a>
        </li>
      @endcan
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-md-1 px-lg-3 mt-4 mb-1 text-muted">
      <span>Other</span>
    </h6>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/settings*') ? 'active' : '' }}" href="/dashboard/settings">
          <i class="fa-duotone fa-gear px-md-1 px-lg-3 py-2"></i>
          Settings
        </a>
      </li>
      <li class="nav-item">
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="dropdown-item">
            <i class="fa-duotone fa-arrow-right-from-bracket  px-md-1 px-lg-3 py-2"></i>
            Logout
          </button>
        </form>
      </li>
    </ul>
  </div>
</nav>

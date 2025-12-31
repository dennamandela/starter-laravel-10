<nav class="app-header navbar navbar-expand bg-body">
  <div class="container-fluid">

    <!-- LEFT -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list"></i>
        </a>
      </li>
    </ul>

    <!-- RIGHT -->
    <ul class="navbar-nav ms-auto">

      <!-- USER DROPDOWN -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center"
           data-bs-toggle="dropdown"
           href="#">
          <i class="bi bi-person-circle me-1"></i>
          {{ Auth::user()->name ?? Auth::user()->email }}
        </a>

        <ul class="dropdown-menu dropdown-menu-end">
          <li class="dropdown-header text-center">
            <strong>{{ Auth::user()->name ?? 'User' }}</strong><br>
            <small class="text-muted">{{ Auth::user()->email }}</small>
          </li>

          <li><hr class="dropdown-divider"></li>

          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="dropdown-item text-danger">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
              </button>
            </form>
          </li>
        </ul>
      </li>

    </ul>
  </div>
</nav>

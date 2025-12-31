<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="{{ url('/dashboard') }}" class="brand-link">

            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Sistem Bon Pengeluaran</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
  <ul class="nav sidebar-menu flex-column"
      data-lte-toggle="treeview"
      role="navigation"
      aria-label="Main navigation"
      data-accordion="false">

    <!-- Dashboard -->
    <li class="nav-item">
      <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
        <i class="nav-icon bi bi-speedometer"></i>
        <p>Dashboard</p>
      </a>
    </li>

    <!-- Bukti Pengeluaran -->
    <li class="nav-item {{ request()->is('expense-voucher*') ? 'menu-open' : '' }}">
      <a href="#" class="nav-link {{ request()->is('expense-voucher*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-receipt"></i>
        <p>
          Bukti Pengeluaran
          <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
      </a>

      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('expense-voucher') }}"
             class="nav-link {{ request()->routeIs('expense-voucher') ? 'active' : '' }}">
            <i class="nav-icon bi bi-list-check"></i>
            <p>Daftar Bon Pengeluaran</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('expense-voucher.create') }}"
             class="nav-link {{ request()->routeIs('expense-voucher.create') ? 'active' : '' }}">
            <i class="nav-icon bi bi-plus-circle"></i>
            <p>Tambah Bon Pengeluaran</p>
          </a>
        </li>
      </ul>
    </li>

  </ul>
</nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
@extends('layouts.login')
@section('content')
<body class="login-page bg-body-secondary">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <a
            href="#"
            class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover"
          >
            <h1 class="mb-0"><b>Sign</b>In</h1>
          </a>
        </div>
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to start your session</p>
          <form action="{{ route('login.auth') }}" method="post">
            @csrf
            <div class="input-group mb-1">
                <div class="form-floating">
                    <input
                    id="loginEmail"
                    type="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    placeholder="Email"
                    required
                    autofocus
                    />
                    <label for="loginEmail">Email</label>
                </div>
                <div class="input-group-text">
                    <span class="bi bi-envelope"></span>
                </div>
                </div>

                @error('email')
                <div class="text-danger small mb-2">{{ $message }}</div>
                @enderror
                            <div class="input-group mb-1">
                <div class="form-floating">
                    <input
                    id="loginPassword"
                    type="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password"
                    required
                    />
                    <label for="loginPassword">Password</label>
                </div>
                <div class="input-group-text">
                    <span class="bi bi-lock-fill"></span>
                </div>
                </div>

                @error('password')
                <div class="text-danger small mb-2">{{ $message }}</div>
                @enderror
            <!--begin::Row-->
            <div class="row">
              <div class="col-8 d-inline-flex align-items-center">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  <label class="form-check-label" for="flexCheckDefault"> Remember Me </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </form>
          <!-- /.social-auth-links -->
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
  </body>
@endsection
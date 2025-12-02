<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ikatan Alumni Polines</title>

  <!-- AdminLTE -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-gray">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/') }}" class="nav-link">Ikatan Alumni Polines</a>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
      <span class="brand-text font-weight-light ml-2">IKA POLINES</span>
    </a>

    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">


          <!-- ========================= -->
          <!--     SIDEBAR DINAMIS       -->
          <!-- ========================= -->
          @foreach($sidebarTables as $table)
              <li class="nav-item">
                  @switch($table)
                      @case('galeri_usaha')
                          <a href="{{ route('galeri.index') }}" class="nav-link {{ request()->is('galeri*') ? 'active' : '' }}">
                              <i class="nav-icon fas fa-images"></i>
                              <p>Galeri Usaha</p>
                          </a>
                          @break

                      @case('master_perusahaan')
                          <a href="{{ url('/master_perusahaan') }}" class="nav-link {{ request()->is('master_perusahaan*') ? 'active' : '' }}">
                              <i class="nav-icon fas fa-building"></i>
                              <p>Perusahaan</p>
                          </a>
                          @break

                      @default
                          <a href="{{ url('/' . $table) }}" class="nav-link {{ request()->is($table.'*') ? 'active' : '' }}">
                              <i class="nav-icon fas fa-database"></i>
                              <p>{{ ucfirst(str_replace('_', ' ', $table)) }}</p>
                          </a>
                  @endswitch
              </li>
          @endforeach

        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper p-4">
    <section class="content">
      <div class="container-fluid">
        @yield('content')
      </div>
    </section>
  </div>

  <footer class="main-footer text-center">
    <strong>© 2025 Ikatan Alumni Polines</strong>
  </footer>

</div>

<!-- Scripts -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Menu Heading -->
        <div class="sidebar-heading">
            Menu
        </div>

        <!-- Report Dropdown -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReport" aria-expanded="false" aria-controls="collapseReport">
                <i class="fas fa-fw fa-chart-line"></i>
                <span>Report</span>
            </a>
            <div id="collapseReport" class="collapse" aria-labelledby="headingReport" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="">View Reports</a>
                    <a class="collapse-item" href="#">Generate Report</a>
                </div>
            </div>
        </li>

        <!-- Upload Data File Dropdown -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-folder-open"></i>
                <span>Upload Data File</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">{{ Auth::user()->role }} Menu</h6>
                    <a class="collapse-item" href="">tblmaster</a>
                    <a class="collapse-item" href="">tblcorporateloancabangdetail</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Administrator Options (Only visible for admins) -->
        @if (Auth::user()->usertype === 'admin')
        <div class="sidebar-heading">
            Options <!-- Visible only for admin -->
        </div>

        <!-- User Management -->
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="fas fa-fw fa-user"></i>
                <span>User Management</span>
            </a>
        </li>

        <!-- Activity Log -->
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="fas fa-fw fa-list"></i>
                <span>Activity Log</span>
            </a>
        </li>
        @endif
    </ul>
</nav>
    </div>
    <!-- /.sidebar -->
  </aside>

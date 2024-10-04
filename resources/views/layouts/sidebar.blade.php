
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <div class="image">
                <img src="{{ asset('lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info ms-2">
              <span class=" d-block" style="font-size: 1.5rem; color: rgb(255, 255, 255);">{{ Auth::user()->name }}</span> <!-- User Type Info -->
              <span class="text-muted" style="color: rgb(255, 255, 255);">
                  {{ Auth::user()->usertype }}
                  <span class="online-status ms-2"></span> <!-- Green dot for online status -->
              </span>
          </div>
          
        </div>
        <a href="{{ route('profile.edit') }}" class="gear-icon">
            <i class="fas fa-cog"></i> <!-- Icon gear -->
        </a>
    </div>
    
      <!-- SidebarSearch Form -->


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
        
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('pricing.show') }}">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Pricing</span>
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
                    <h6 class="collapse-header">Menu</h6>
                    <a class="collapse-item" href="">tblmaster</a>
                    <a class="collapse-item" href="">tblcorporateloancabangdetail</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Administrator Options -->
        <div class="sidebar-heading">
            Options 
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

    </ul>
</nav>
    </div>
    <!-- /.sidebar -->
  </aside>

  <style>
    .online-status {
    width: 10px;
    height: 10px;
    background-color: green;
    border-radius: 50%;
    display: inline-block;
}

    .gear-icon {
        color: #b8c7ce;
        font-size: 1.2rem;
    }

    .gear-icon:hover {
        color: #ffffff; /* Change color on hover */
    }
  </style>


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
            <div class="info ms-2" style="max-width: 150px; white-space: normal;">
                <span class="d-block" style="font-size: 1.3rem; color: rgb(255, 255, 255); word-wrap: break-word;">{{ Auth::user()->name }}</span> <!-- User Type Info -->
                <span class="text-muted" style="color: rgb(255, 255, 255);">
                    {{ Auth::user()->role }}
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
  <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
    <p>
        Report
        <i class="nav-arrow bi bi-chevron-right"></i>
    </p>
</a>
<ul class="nav nav-treeview">
    <li class="nav-item"> <a href="./widgets/small-box.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
            <p>Report Amortised Cost</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/info-box.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
            <p>Report Amortised Initial Cost</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
            <p>Report Amortised Initial Fee</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
            <p>Report Expective Cash Flow</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
            <p>Report Interest Deferred</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
          <p>Report Journal</p>
        </a> </li>
</ul>
</li>

<<<<<<< HEAD
        <!-- Report Dropdown -->
  <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
    <p>
        Upload Data Files
        <i class="nav-arrow bi bi-chevron-right"></i>
    </p>
</a>
<ul class="nav nav-treeview">
    <li class="nav-item"> <a href="./widgets/small-box.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
            <p>Upload File TbiMaster_tmp</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/info-box.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
            <p>Upload File TblMaster_tmp/C</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
            <p>Upload File TblMaster_tmpPartialCP</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
          <p>Upload File TblMaster_tmpFullCP</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
          <p>Upload File TolMaster_tmpRestructuring</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
          <p>Upload File TbiMaster_tmpimpairment</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
          <p>Upload File TbiMaster_tmpCorporateReview</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
          <p>Upload File ThlMaster_Month</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
          <p>Upload File TblDataCorporateLoan</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
          <p>Upload File TblDataPartialCP</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
          <p>Upload File TblDataPartialCP</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
          <p>Upload File TblDataFullCapPredummy</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
          <p>Upload File TblDataRestructuring</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
          <p>Upload File TblDatalmpairment</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
          <p>Upload File TblinterestChange</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
          <p>Upload File THIPDLGDMaster</p>
        </a> </li>
    <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
          <p>Upload File TbIPDLGDTRX</p>
        </a> </li>
    
</ul>
</li>
=======
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
>>>>>>> 0234c170f1579d5b3885709ddf131d00b3a8dcbf

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
<br><br><br><br>
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

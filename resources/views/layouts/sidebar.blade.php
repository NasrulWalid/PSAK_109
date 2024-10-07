
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
<br><br><br><br>
    </div>
    <!-- /.sidebar -->
  </aside>

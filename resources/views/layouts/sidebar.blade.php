
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
                <span class="" style="color: rgb(255, 255, 255);">
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
              <i class="fas fa-fw fa-dollar-sign"></i>
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
        <a href="#" class="nav-link d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="nav-icon bi bi-box-seam-fill"></i>
                <p class="ms-2 mb-0">Report</p>
            </div>
            <i class="nav-arrow bi bi-chevron-right"></i>
        </a>
        <ul class="nav nav-treeview">
            <!-- Simple Interest Submenu -->
            <li class="ms-2 nav-item">
                <a href="#" class="nav-link d-flex align-items-center">
                    <i class="bi bi-percent"></i> <!-- Icon untuk Simple Interest -->
                    <p class="ms-2 mb-0">Simple Interest</p>
                    <i class="nav-arrow bi bi-chevron-right"></i>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="./widgets/small-box.html" class="nav-link d-flex align-items-center">
                            <i class="nav-icon bi bi-circle"></i>
                            <p class="ms-2 mb-0">Report Amortised Cost</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./widgets/info-box.html" class="nav-link d-flex align-items-center">
                            <i class="nav-icon bi bi-circle"></i>
                            <p class="ms-2 mb-0">Report Amortised Initial Cost</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                            <i class="nav-icon bi bi-circle"></i>
                            <p class="ms-2 mb-0">Report Amortised Interest Fee</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                            <i class="nav-icon bi bi-circle"></i>
                            <p class="ms-2 mb-0">Report Expective Cash Flow</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                            <i class="nav-icon bi bi-circle"></i>
                            <p class="ms-2 mb-0">Report Interest Deffered</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                            <i class="nav-icon bi bi-circle"></i>
                            <p class="ms-2 mb-0">Report Journal</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Effective Submenu -->
            <li class="ms-2 nav-item">
                <a href="#" class="nav-link d-flex align-items-center">
                    <i class="bi bi-graph-up-arrow"></i> <!-- Icon untuk Effective -->
                    <p class="mb-0">Effective</p>
                    <i class="nav-arrow bi bi-chevron-right"></i>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="./widgets/small-box.html" class="nav-link d-flex align-items-center">
                            <i class="nav-icon bi bi-circle"></i>
                            <p class="ms-2 mb-0">Report Amortised Cost</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./widgets/info-box.html" class="nav-link d-flex align-items-center">
                            <i class="nav-icon bi bi-circle"></i>
                            <p class="ms-2 mb-0">Report Amortised Initial Cost</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                            <i class="nav-icon bi bi-circle"></i>
                            <p class="ms-2 mb-0">Report Amortised Interest Fee</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                            <i class="nav-icon bi bi-circle"></i>
                            <p class="ms-2 mb-0">Report Expective Cash Flow</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                            <i class="nav-icon bi bi-circle"></i>
                            <p class="ms-2 mb-0">Report Interest Deffered</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                            <i class="nav-icon bi bi-circle"></i>
                            <p class="ms-2 mb-0">Report Journal</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

                <!-- Upload Data Files Dropdown -->
        <li class="nav-item">
            <a href="#" class="nav-link d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-fw fa-folder-open"></i>
                    <p class="ms-2 mb-0">Upload Data Files</p>
                </div>
                <i class="nav-arrow bi bi-chevron-right"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="./widgets/small-box.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File TbiMaster_tmp</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./widgets/info-box.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File TblMaster_tmp/C</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File TblMaster_tmpPartialCP</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File TblMaster_tmpFullCP</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File TolMaster_tmpRestructuring</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File TbiMaster_tmpimpairment</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File TbiMaster_tmpCorporateReview</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File ThlMaster_Month</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File TblDataCorporateLoan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File TblDataPartialCP</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File TblDataPartialCP</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File TblDataFullCapPredummy</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File TblDataRestructuring</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File TblDatalmpairment</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File TblinterestChange</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File THIPDLGDMaster</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./widgets/cards.html" class="nav-link d-flex align-items-center">
                        <i class="nav-icon bi bi-circle"></i>
                        <p class="ms-2 mb-0">Upload File TbIPDLGDTRX</p>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Administrator Options -->
        <div class="sidebar-heading">
            Options 
        </div>

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

    .sidebar-heading {
            color: #ffffff; /* Change color on hover */
        }
  </style>

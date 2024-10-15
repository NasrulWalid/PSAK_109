<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('landing') }}" class="brand-link" style="text-decoration: none">
        <x-application-logo  />
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
                    <span class="d-block" style="font-size: 1.3rem; color: rgb(255, 255, 255); word-wrap: break-word;">{{ Auth::user()->name }}</span>
                    <span class="text-muted" style="color: rgb(255, 255, 255);">
                        {{ Auth::user()->role }}
                        <span class="online-status ms-2"></span>
                    </span>
                </div>
            </div>
            <a href="{{ route('profile.edit') }}" class="gear-icon">
                <i class="fas fa-cog"></i>
            </a>
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
                        <i class="bi bi-cash"></i> <!-- Icon untuk Pricing -->
                        <span>Pricing</span>
                    </a>
                </li>
                <br>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Menu Heading -->
                <div class="sidebar-heading" style="color: white; margin-left:15px;">
                    Menu
                </div>

                <!-- Report Dropdown -->
                <li class="nav-item">
                    <a href="#" class="nav-link align-items-left">
                        <i class="fas fa-file"></i>
                        <p class="ms-2 mb-0 text-start">Report</p>
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Report Accrual Interest Dropdown -->
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex align-items-center">
                                <p class="ms-2 mb-0 text-start" style="white-space: nowrap;">Report Accrual Interest</p>
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('under') }}" class="nav-link">
                                        <p class="text-start">✦ Effective</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('report.index') }}" class="nav-link">
                                        <p class="text-start">✦ Simple Interest</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <!-- Report Amortised Cost Dropdown -->
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex align-items-center">
                                <p class="ms-2 mb-0 text-start" style="white-space: nowrap;">Report Amortised Cost</p>
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('under') }}" class="nav-link">
                                        <p class="text-start">✦ Effective</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('under') }}" class="nav-link">
                                        <p class="text-start">✦ Simple Interest</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <!-- Report Amortised Initial Cost Dropdown -->
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex align-items-center">
                                <p class="ms-2 mb-0 text-start" style="white-space: nowrap;">Report Amortised Initial Cost</p>
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('under') }}" class="nav-link">
                                        <p class="text-start">✦ Effective</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('under') }}" class="nav-link">
                                        <p class="text-start">✦ Simple Interest</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <!-- Report Amortised Initial Fee Dropdown -->
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex align-items-center">
                                <p class="ms-2 mb-0 text-start" style="white-space: nowrap;">Report Amortised Initial Fee</p>
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('under') }}" class="nav-link">
                                        <p class="text-start">✦ Effective</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('under') }}" class="nav-link">
                                        <p class="text-start">✦ Simple Interest</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <!-- Report Expective Cash Flow Dropdown -->
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex align-items-center">
                                <p class="ms-2 mb-0 text-start" style="white-space: nowrap;">Report Expective Cash Flow</p>
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('under') }}" class="nav-link">
                                        <p class="text-start">✦ Effective</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('under') }}" class="nav-link">
                                        <p class="text-start">✦ Simple Interest</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <!-- Report Interest Deferred Dropdown -->
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex align-items-center">
                                <p class="ms-2 mb-0 text-start" style="white-space: nowrap;">Report Interest Deferred</p>
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('under') }}" class="nav-link">
                                        <p class="text-start">✦ Effective</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('under') }}" class="nav-link">
                                        <p class="text-start">✦ Simple Interest</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <!-- Report Journal Dropdown -->
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex align-items-center">
                                <p class="ms-2 mb-0 text-start" style="white-space: nowrap;">Report Journal</p>
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('under') }}" class="nav-link">
                                        <p class="text-start">✦ Effective</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('under') }}" class="nav-link">
                                        <p class="text-start">✦ Simple Interest</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <!-- Report Outstanding Dropdown -->
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex align-items-center">
                                <p class="ms-2 mb-0 text-start" style="white-space: nowrap;">Report Outstanding</p>
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('under') }}" class="nav-link">
                                        <p class="text-start">✦ Effective</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('under') }}" class="nav-link">
                                        <p class="text-start">✦ Simple Interest</p>
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
                            <a href="{{ route('tblmaster.index') }}" class="nav-link d-flex align-items-center">
                                <p class="ms-2 mb-0 text-center" style="width: 30px;">✦</p>
                                <p class="ms-3 mb-0 flex-grow-1 text-start">Upload File tblmaster_tmpcorporate</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('corporate.index') }}" class="nav-link d-flex align-items-center">
                                <p class="ms-2 mb-0 text-center" style="width: 30px;">✦</p>
                                <p class="ms-3 mb-0 flex-grow-1 text-start">Upload File tblcorporateloancabangdetail</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <br>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Administrator Options -->
                <div class="sidebar-heading" style="color: white; margin-left:15px; margin-top:10px;">
                    Options
                </div>

<!-- Tampilkan menu User Management hanya jika pengguna adalah admin -->
@if (Auth::user()->role === 'admin')
<li class="nav-item">
    <a href="{{ route('admin.usermanajemen') }}" class="nav-link d-flex align-items-center">
        <i class="bi bi-people-fill"></i>
        <p class="ms-2 mb-0">User Management</p>
    </a>
</li>
@endif
<!-- Tampilkan menu User Management hanya jika pengguna adalah superadmin -->
@if (Auth::user()->role === 'superadmin')
<li class="nav-item">
    <a href="{{ route('usermanajemen') }}" class="nav-link d-flex align-items-center">
        <i class="bi bi-people-fill"></i>
        <p class="ms-2 mb-0">User Management</p>
    </a>
</li>
@endif


            </ul><br><br><br>
        </nav>
    </div>
    <!-- /.sidebar -->
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

</aside>

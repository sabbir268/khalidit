<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('home')}}" class="brand-link">
    <img src="{{asset('asset/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Khalid IT</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img
          src="{{asset(auth()->user()->hasRole('admin') ? 'asset/dist/avatar.png' : '/storage/'.auth()->user()->worker->photo)}}"
          class="img-circle elevation-2" style="height: 35px;weidth:35px" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{auth()->user()->name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{route('home')}}" class="nav-link {{ (request()->is('home')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
              {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
          </a>
        </li>
        @if (auth()->user()->hasRole('admin'))


        <li class="nav-item {{ request()->is('user*') || request()->is('user/*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Users Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('user.index')}}" class="nav-link {{ (request()->is('user')) ? 'active' : '' }}">
                <i class="fas fa-users nav-icon"></i>
                <p>Workers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('user.new')}}" class="nav-link {{ (request()->is('user-new')) ? 'active' : '' }}">
                <i class="fas fa-users nav-icon"></i>
                <p>New Applicant</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="fas fa-plus-circle nav-icon"></i>
                <p>Adminstration User</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview {{ request()->is('sheet*') || request()->is('sheet/*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->is('sheet*') || request()->is('sheet/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file-excel"></i>
            <p>
              Sheet Management
              <i class="fas fa-angle-left right"></i>
              {{-- <span class="badge badge-info right">6</span> --}}
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('sheet.index')}}" class="nav-link {{ request()->is('sheet') ? 'active' : '' }}">
                <i class="fas fa-table nav-icon"></i>
                <p>Sheet List</p>
              </a>
            </li>
            <li class="nav-item">
              <a a href="{{route('sheet.create')}}"
                class="nav-link {{ request()->is('sheet/create') ? 'active' : '' }}">
                <i class="fas fa-plus-circle nav-icon"></i>
                <p>Add Sheet</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview ">
          <a href="{{route('lead.report')}}" class="nav-link ">
            <i class="nav-icon fas fa-cube"></i>
            <p>
              Leads Report
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
        </li>

        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
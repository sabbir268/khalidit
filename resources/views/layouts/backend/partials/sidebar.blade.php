
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <img src="{{asset('asset/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Khalid IT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('asset/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Khalid Hasan</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
            {{-- class="{{ (request()->is('admin/cities')) ? 'active' : '' }}" --}}
          </li> -->
          <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link {{ (request()->is('home')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
              Dashboard
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users Management
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('sheet.index')}}" class="nav-link {{ (request()->is('master/sheet')) ? 'active' : '' }}">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Users List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('sheet.create')}}" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="fas fa-briefcase nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                Workers
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('sheet.index')}}" class="nav-link {{ (request()->is('master/sheet')) ? 'active' : '' }}">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Worker List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('sheet.create')}}" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Add Worker</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="fas fa-briefcase nav-icon"></i>
                  <p>Worker Roles</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ (request()->is('master/sheet','master/sheet/create')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('master/sheet','master/sheet/create')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-excel"></i>
              <p>
                Sheet Management
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('sheet.index')}}" class="nav-link {{ (request()->is('master/sheet')) ? 'active' : '' }}">
                  <i class="fas fa-table nav-icon"></i>
                  <p>Sheet List</p>
                </a>
              </li>
              <li class="nav-item">
                <a a href="{{route('sheet.create')}}" class="nav-link {{ (request()->is('master/sheet/create')) ? 'active' : '' }}">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Add Sheet</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="fas fa-briefcase nav-icon"></i>
                  <p>Manage Sheet</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ (request()->is('master/worker','master/worker/create')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('master/worker','master/worker/create')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-pray"></i>
              <p>
                All Works
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview ">
              <li class="nav-item">
                <a href="{{route('worker.index')}}" class="nav-link {{ (request()->is('master/worker')) ? 'active' : '' }}">
                  <i class="fas fa-table nav-icon"></i>
                  <p>Work List</p>
                </a>
              </li>
              <li class="nav-item">
                <a a href="{{route('worker.create')}}" class="nav-link {{ (request()->is('master/worker/create')) ? 'active' : '' }}">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Add Work</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="fas fa-briefcase nav-icon"></i>
                  <p>Manage Work</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
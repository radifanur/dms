<aside class="main-sidebar sidebar-light-olive elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{asset('asset/img/logopidsus.png')}}" alt= "Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin/dist/img/avatar.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
          <a href="{{route('main')}}" class="nav-link {{Request::is('/*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
          </li>
          @can('admin')
          <li class="nav-item">
            <a href="{{route('users')}}" class="nav-link {{Request::is('user*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-user"></i>
              <p>Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('kategori')}}" class="nav-link {{Request::is('kategori*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-filter"></i>
              <p>Kategori</p>
            </a>
          </li>
          @endcan
          <li class="nav-item">
            <a href="#" class="nav-link {{Request::is('dokumen*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Dokumen
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('dokumen.index')}}" class="nav-link {{Request::is('dokumen') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Dokumen</p>
                </a>
              </li>
              @php
              use Illuminate\Support\Facades\DB;

              $kategori = DB::table('kategori')->get();
              foreach ($kategori as $key => $data) {
                $link = "/dokumen/". $data->id;
                $active = Request::is('dokumen/'.$data->id.'*') ? 'active' : '';
                echo '<li class="nav-item">
                <a href="'.$link.'" class="nav-link '.$active.'">
                  <i class="far fa-circle nav-icon"></i>
                  <p>'.$data->nama.'</p>
                </a>
              </li>';
              }
              @endphp
            </ul>
          </li>
          <li class="nav-header"></li>
          <li class="nav-item bg-maroon disabled">
            <a href="{{route('logout')}}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
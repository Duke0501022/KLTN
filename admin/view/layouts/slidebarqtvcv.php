<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="admin/assets/uploads/images/440943120_2188963681457292_7383826080244805221_n.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="logo-lg" id="index">Hệ thống ChildCare</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
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
        <!-- Quản lí  -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Quản lý người dùng
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">6</span>
            </p>
          </a>
        
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?qlcv" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Quản lý chuyên viên</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Phân Quyền + Thống kê báo cáo -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-info-circle"></i>
            <p>
              Khác
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">1</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?thongke" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thống kê</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?thongtin" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thông tin tài khoản</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Thông tin liên hệ -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-address-book"></i>
            <p>
              Thông tin liên hệ
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">1</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="index.php?phanhoi" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Phản hồi</p>
              </a>
            </li>
          </ul>
        </li>

        
        <!-- Quản lí Lịch Giảng Dạy -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
              Quản lí Lịch Tư Vấn
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">2</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?qltv" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Lịch tư vấn</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?duyetuvan" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Duyệt yêu cầu huỷ tư vấn</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?hosoQTV" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Hồ sơ tư vấn</p>
              </a>
            </li>
          </ul>
        </li>

       
        <!-- Quản lí tin tức -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>
              Quản lí tin tức
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">2</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?qltt" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh mục</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?duyett" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Duyệt tin tức</p>
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
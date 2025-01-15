<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
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
              <span class="badge badge-info right"></span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?qlte" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Quản lý hồ sơ trẻ em</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?qlkhdn" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Quản lý phụ huynh</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?qlgv" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Quản lý giáo viên</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Quản lí bài sàng lọc
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right"></span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?qlbt" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh mục câu hỏi</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Quản lí Lĩnh Vực
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right"></span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?qllinhvuc" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh mục Lĩnh vực</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Phân Quyền + Thống kê báo cáo -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-bar"></i>
            <p>
              Khác
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right"></span>
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

       

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-school"></i>
            <p>
              Quản lí Lớp Học
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right"></span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?qllop" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách lớp</p>
              </a>
            </li>
          </ul>
        </li>
        
         <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-coins"></i>
            <p>
              Quản lí Học Phí
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right"></span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?qlhocphi" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách Học Phí</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
              Quản lí Lịch Giảng Dạy Giáo Viên
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right"></span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?qlgd" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Lịch giảng dạy theo tuần</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?addgd" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm Lịch giảng dạy</p>
              </a>
            </li>
          </ul>
       
        </li>
           <li class="nav-item">
               <a href="logout.php" class="nav-link">
  <i class="nav-icon fas fa-sign-out-alt"></i>
  Đăng xuất
</a>
    </li>
      </ul>
     
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
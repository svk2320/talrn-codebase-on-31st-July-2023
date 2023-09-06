<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4" style="background-color:#5473FF;">
  <!-- Brand Logo -->
  <a href="<?php echo base_url('client/dashboard'); ?>" class="brand-link">
    <img src="<?php echo base_url('assets/img/'); ?>T.png" alt="Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text text-light font-weight-light">Talrn</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>dist/img/user.jpg" class="img-circle elevation-2"
          alt="User Image">
      </div>
      <div class="info" style="margin-top: -9px;">
        <a href="<?php echo base_url('client/dashboard'); ?>" class="d-block user_id_text text-light">
          <?php 
            echo $_SESSION['name'];
           ?>
        </a>
        <p style="color: white; font-weight: bold; margin-top: -4px;">
           <?php 
             echo $_SESSION['unique_id'];
           ?>
        </p>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="margin-top: -14px;">   
        <li class="nav-item">
          <a href="<?php echo base_url('client/users/profile/'); ?>" class="nav-link" id="myAccount">
            <i class="text-light nav-icon fas fa-user-circle"></i>
            <p class="text-light">
              My account
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('client/requirements/create'); ?>" class="nav-link" id="createJob">
            <i class="text-light nav-icon fas fa-bullhorn"></i>
            <p class="text-light">
              Create job
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('client/requirements'); ?>" class="nav-link" id="myJob">
            <i class="text-light nav-icon fas fa-briefcase"></i>
            <p class="text-light">
              My job
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a target="_blank" href="<?php echo base_url('profiles'); ?>" class="nav-link" id="search">
            <i class="text-light nav-icon fas fa-search"></i>
            <p class="text-light">
              Search
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('client/announcements/show_all_popups'); ?>" class="nav-link" id="showAllPopups">
            <i class="text-light nav-icon fas fa-envelope"></i>
            <p class="text-light">
              Show All Popups
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('client/auth/logout'); ?>" class="nav-link" id="profileMainNav">
            <i class="text-light nav-icon fas fa-sign-out-alt"></i>
            <p class="text-light">
              Sign Out
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

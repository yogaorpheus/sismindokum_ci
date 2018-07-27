<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('home'); ?>" class="logo" style="background-color: #0e596c">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SMD</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SISMINDOKUM</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color: #136f86">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class='fa fa-user'></i>
              <span class="hidden-xs"><?php echo $nama_lengkap_pegawai; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" style="background-color: #136f86">
                <i class="ion-person" style="font-size: 60px;"></i>
                <p>
                  <?php
                  echo $nama_lengkap_pegawai." - ".$posisi_pegawai;
                  ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url('auth/logout');?>" class="btn btn-danger btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>
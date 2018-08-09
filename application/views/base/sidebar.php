  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="background-color: #106f80; background-image: url(<?php echo base_url('assets/img/bg_pjb_small.png');?>); background-position: -20% 0%; background-attachment: fixed;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div align="middle">
          <a href="<?php echo base_url('home'); ?>">
            <img src="<?php echo base_url('assets/adminlte'); ?>/dist/img/LOGO_PJB_White.png" style="height: 50%; width: 50%;">
          </a>
        </div>
        <!-- <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div> -->
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
      <ul class="sidebar-menu" data-widget="tree">

        <li class="header" style="color: #ffffff; background: rgba(14, 88, 110, 0.5);"><strong>MENU UTAMA</strong></li>
        
        <li> <!-- warna bg -->
          <a href="<?php echo base_url('dashboard'); ?>" style="background-color: rgba(43, 137, 160, 0.5);"> <!-- warna hover -->
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <?php
        foreach ($menu_tampil as $key => $one_menu_utama) 
        {
			$menu_open = ($menu_utama[$key]['nama_controller']==$this->uri->segment(1)) ? " menu-open" : "";
			$show_sub_menu = ($menu_utama[$key]['nama_controller']==$this->uri->segment(1)) ? " display: block;" : "";
			
			echo "<li class='treeview".$menu_open."'>"; 
			if (isset($one_menu_utama[null]))
			{
				echo "<a href=".base_url($menu_utama[$key]['nama_controller']).">";
				echo "<i class='fa fa-circle'></i> <span>".$menu_utama[$key]['nama_menu1']."</span>";
				echo "</a>";
			}
			else
			{
				echo "<a href='#' style='background-color: rgba(43, 137, 160, 0.5);'>";
				echo "<i class='fa fa-file-text-o'></i> <span>".$menu_utama[$key]['nama_menu1']."</span>";
				echo "<span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></span>";
				echo "</a>";

				echo "<ul class='treeview-menu' style='background: rgba(37, 142, 166, 0.6);".$show_sub_menu."'>";
				foreach ($one_menu_utama as $key1 => $one_sub_menu) 
				{
					echo "<li>";
					echo "<a href=".base_url($menu_utama[$key]['nama_controller']."/".$sub_menu[$key1]['nama_method'])." class='lihover' style='color: white;'>";
					echo "<i class='fa fa-circle'></i> ".$sub_menu[$key1]['nama_menu2'];
					echo "</a>";
					echo "</li>";
				}
				echo "</ul>";
			}
			echo "</li>";
        }
        ?>

        <?php
        if ($this->session->userdata('staff_pjb')['kode_subdit_pegawai'] == '024' && $this->session->userdata('staff_pjb')['kode_distrik_pegawai'] == 'Z')
        {
          ?>
          <li>
            <a href="<?php echo base_url('lembaga'); ?>" style="background-color: rgba(43, 137, 160, 0.5);">
              <i class="fa fa-building-o"></i>
              <span>Lembaga</span>
            </a>
          </li>

          <li>
            <a href="<?php echo base_url('unit'); ?>" style="background-color: rgba(43, 137, 160, 0.5);">
              <i class="fa fa-database"></i>
              <span>Unit</span>
            </a>
          </li>

          <li>
            <a href="<?php echo base_url('dasar_hukum'); ?>" style="background-color: rgba(43, 137, 160, 0.5);">
              <i class="fa fa-gavel"></i>
              <span>Dasar Hukum</span>
            </a>
          </li>
          <?php
        }
        ?>

        <!-- <li>
          <a href="<?php echo base_url('pegawai_pjb'); ?>">
            <i class="fa fa-users"></i>
            <span>Pegawai</span>
          </a>
        </li> -->
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
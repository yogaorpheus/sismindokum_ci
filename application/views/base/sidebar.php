  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/adminlte'); ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">MENU UTAMA</li>
        
        <?php
        foreach ($menu_tampil as $key => $one_menu_utama) 
        {

          echo "<li class='treeview'>"; 
          if (isset($one_menu_utama[null]))
          {
            echo "<a href=".base_url($menu_utama[$key]['nama_controller']).">";
            echo "<i class='fa fa-circle'></i> <span>".$menu_utama[$key]['nama_menu1']."</span>";
            echo "</a>";
          }
          else
          {
            echo "<a href='#'>";
            echo "<i class='fa fa-circle'></i> <span>".$menu_utama[$key]['nama_menu1']."</span>";
            echo "<span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></span>";
            echo "</a>";

            echo "<ul class='treeview-menu'>";
            foreach ($one_menu_utama as $key1 => $one_sub_menu) 
            {
              echo "<li>";
              echo "<a href=".base_url($menu_utama[$key]['nama_controller']."/".$sub_menu[$key1]['nama_method']).">";
              echo "<i class='fa fa-circle'></i> ".$sub_menu[$key1]['nama_menu2'];
              echo "</a>";
              echo "</li>";
            }
            echo "</ul>";
          }
          echo "</li>";
        }
        ?>
        
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
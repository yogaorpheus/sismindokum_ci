<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pertanahan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data</a></li>
        <li class="active">Status</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pertanahan</h3>
              <button class="btn btn-success pull-right"><i class="glyphicon glyphicon-download-alt"></i> Download Data</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabel1" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Distrik</th>
                  <th>Jenis Sertifikat</th>
                  <th>No. Sertifikat</th>
                  <th>Lokasi Sertifikat</th>
                  <th>PIC</th>
                  <th>Tanggal Terbit</th>
                  <th>Tanggal Berakhir</th>
                  <th>Status</th>
                  <th>Pengaturan</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1; 
                foreach ($data_pertanahan as $key => $onedata) { 
                ?>
                <tr>
                  <td style="vertical-align: middle;"><?php echo $no++; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['nama_distrik']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['nama_sub_jenis_sertifikat']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['no_sertifikat']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['judul_sertifikat']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['jabatan_pic']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['tanggal_sertifikasi']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['tanggal_kadaluarsa']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['nama_status']; ?></td>
                  <td width="120px;">
                    <?php
                    foreach ($menu_tampil as $key => $one_menu) {

                      if ($this->uri->segment(1) == $menu_utama[$key]['nama_controller']) {
                        foreach ($one_menu as $key1 => $one_sub_menu) {
                          
                          if ($this->uri->segment(2) == $sub_menu[$key1]['nama_method']) {
                            foreach ($one_sub_menu as $key2 => $one_crud) {
                              
                              if ($one_crud['berhak'] && $menu_crud[$key2]['is_crud'])
                              {
                                echo "<a href='".base_url($menu_utama[$key]['nama_controller']."/".$sub_menu[$key1]['nama_method'].$menu_crud[$key2]['nama_concat_method']."/".$onedata['id_sertifikat'])."' class='".$menu_crud[$key2]['nama_menu_crud']."' id='".$menu_crud[$key2]['nama_menu_crud'].$onedata['id_sertifikat']."'>";
                                echo $menu_crud[$key2]['html'];
                                echo "</a>";
                              }
                            }
                          }
                        }
                      }
                    }
                    ?>
                  </td>
                </tr>
                <?php }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Distrik</th>
                  <th>Jenis Sertifikat</th>
                  <th>No. Sertifikat</th>
                  <th>Lokasi Sertifikat</th>
                  <th>PIC</th>
                  <th>Tanggal Terbit</th>
                  <th>Tanggal Berakhir</th>
                  <th>Status</th>
                  <th>Pengaturan</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->  
    </section>
    <!-- /.content -->
    <script>
      $(function () {
        // $('#example1').DataTable()
        // $('#example2').DataTable({
        //   'paging'      : true,
        //   'lengthChange': false,
        //   'searching'   : false,
        //   'ordering'    : true,
        //   'info'        : true,
        //   'autoWidth'   : false
        // })
        $('#tabel1').DataTable()
      })
    </script>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lisensi
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-file-text-o"></i> Review Data</li>
        <li class="active">Lisensi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Lisensi</h3>
              <?php
              if ($this->session->userdata('staff_pjb')['kode_distrik_pegawai'] == 'Z')
              {
                ?>
                <button class="btn btn-success pull-right" data-toggle="modal" data-target="#modal_download"><i class="glyphicon glyphicon-download-alt"></i> Download Data</button>
                <?php
              }
              else
              {
                ?>
                <a href="<?php echo base_url('data/lisensi/download');?>">
                  <button class="btn btn-success pull-right"><i class="glyphicon glyphicon-download-alt"></i> Download Data</button>
                </a>
                <?php
              }
              ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabel1" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Distrik</th>
                  <th>Nama Lisensi</th>
                  <th>Spesifikasi</th>
                  <th>No. Lisensi</th>
                  <th>Lembaga</th>
                  <th>PIC</th>
                  <th>Tanggal Terbit</th>
                  <th>Tanggal Kadaluarsa</th>
                  <th>Status</th>
                  <th>Pengaturan</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1; 
                foreach ($data_lisensi as $key => $onedata) { 
                ?>
                <tr>
                  <td style="vertical-align: middle;"><?php echo $no++; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['nama_distrik']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['judul_sertifikat']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['spesifikasi_lisensi']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['no_sertifikat']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['nama_lembaga']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['jabatan_pic']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['tanggal_sertifikasi']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['tanggal_kadaluarsa']; ?></td>
                  <td style="vertical-align: middle;">
                    <?php
                    echo "<h4>";
                    if (strtolower($onedata['nama_status']) == "aktif")
                      echo "<span class='label label-success'>";
                    else if (strtolower($onedata['nama_status']) == "alarm")
                      echo "<span class='label label-warning'>";
                    else if (strtolower($onedata['nama_status']) == "kadaluarsa")
                      echo "<span class='label label-danger'>";
                    echo $onedata['nama_status'];
                    echo "</span></h4>";
                    ?>
                  </td>
                  <td style="vertical-align: middle;" width="120px;">
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
                  <th>Nama Lisensi</th>
                  <th>Spesifikasi</th>
                  <th>No. Lisensi</th>
                  <th>Lembaga</th>
                  <th>PIC</th>
                  <th>Tanggal Terbit</th>
                  <th>Tanggal Kadaluarsa</th>
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

      <div class="modal fade" id="modal_delete">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">HAPUS DATA</h4>
              </div>
              <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
              </div>
              <div class="modal-footer">
                <a id="delete_yes"><button type="button" class="btn btn-danger pull-left">Iya, Hapus</button></a>
                <button type="button" class="btn btn-success pull-right" data-dismiss="modal" id="delete_no">Tidak</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <div class="modal modal-primary fade" id="modal_download">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">MENGUNDUH DATA</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Distrik</label><br>
                  <select class="form-control select2" name="distrik_download" id="distrik_download" style="width: 100%;">
                    <option value="0" selected="selected">Semua Distrik</option>
                    <?php
                    foreach ($distrik as $key => $one_distrik) {
                      echo "<option value='".$one_distrik['kode_distrik']."'>";
                      echo $one_distrik['nama_distrik'];
                      echo "</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <a id="download_btn" href="<?php echo base_url('data/lisensi/download'); ?>"><button type="button" class="btn btn-success pull-left">Unduh Data</button></a>
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" id="download_abort">Batal Mengunduh</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      
    </section>
    <!-- /.content -->
    <script>
      var delete_href = "";
      var delete_id = "";

      <?php
      if (!is_null($this->session->flashdata('error_msg')))
      {
        ?>alert("<?php echo $this->session->flashdata('error_msg'); ?>");<?php
      }
      ?>

      $(function () {
        
        $('.select2').select2()

        $('#tabel1').DataTable()

        $(document).on("click", ".Delete", function() {
          delete_href = $(this).attr('href');
          delete_id = $(this).attr('id');
          $(this).attr('href', "#");
          $("#delete_yes").attr('href', delete_href);
        })

        $("#delete_no").click(function() {
          delete_id = "#" + delete_id;
          $(delete_id).attr('href', delete_href);
        })

        $(document).on("click", ".Review", function() {
          $(this).attr('target', '_blank');
        })

        $("#distrik_download").change(function() {
          var kode_distrik = $("#distrik_download").val();

          if (kode_distrik == '0')
            kode_distrik = "";
          $("#download_btn").attr('href', "<?php echo base_url('data/lisensi/download')."/"; ?>"+kode_distrik);
        })

      })
    </script>
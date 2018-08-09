<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Unit
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-file-text-o"></i> Unit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a href="<?php echo base_url('unit/tambah_unit'); ?>">
                <button class="btn btn-primary pull-left"><i class="glyphicon glyphicon-plus"></i> Tambah Data Unit</button>
              </a>
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
                <a href="<?php echo base_url('unit/download');?>">
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
                  <th>Nama Distrik</th>
                  <th>Nama Unit</th>
                  <th>Dibuat oleh</th>
                  <th>Pengaturan</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1; 
                foreach ($data_unit as $key => $onedata) { 
                ?>
                <tr>
                  <td style="vertical-align: middle;"><?php echo $no++; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['nama_distrik']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['nama_unit']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['nama_lengkap_pegawai']; ?></td>
                  <td width="120px;">
                    <div class="row">
                      <div class="col-md-6">
                        <a href="<?php echo base_url('unit/edit_unit').'/'.$onedata['id_unit']; ?>">
                          <button type="button" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></button>
                        </a>
                      </div>
                      <div class="col-md-6">
                        <a href="#" class="Delete" id="<?php echo $onedata['id_unit']; ?>">
                          <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal_delete"><i class="glyphicon glyphicon-trash"></i></button>
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Nama Distrik</th>
                  <th>Nama Unit</th>
                  <th>Dibuat oleh</th>
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
        <form id="delete_lembaga" action="<?php echo base_url('unitcontroller/delete_unit'); ?>" method="POST">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">HAPUS DATA</h4>
                <input type="hidden" id="id_data" name="id" value="">
              </div>
              <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
              </div>
              <div class="modal-footer">
                <a id="delete_yes"><button type="submit" class="btn btn-danger pull-left">Iya, Hapus</button></a>
                <button type="button" class="btn btn-success pull-right" data-dismiss="modal" id="delete_no">Tidak</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </form>    
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
                      echo "<option value='".$one_distrik['id_distrik']."'>";
                      echo $one_distrik['nama_distrik'];
                      echo "</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <a id="download_btn" href="<?php echo base_url('unit/download'); ?>"><button type="button" class="btn btn-success pull-left">Unduh Data</button></a>
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

      $(function () {
        
        $('.select2').select2()

        $('#tabel1').DataTable()

        $(document).on("click", ".Delete", function() {
          delete_id = $(this).attr('id');
          $("#id_data").val(delete_id);
        })

        $("#distrik_download").change(function() {
          var kode_distrik = $("#distrik_download").val();

          if (kode_distrik == '0')
            kode_distrik = "";
          $("#download_btn").attr('href', "<?php echo base_url('unit/download')."/"; ?>"+kode_distrik);
        })

        <?php
        if ($this->session->flashdata('error') == 1) {
          echo "alert('Data Lisensi berhasil dihapus');";
        }
        else if ($this->session->flashdata('error') == 2) {
          echo "alert('Data Lisensi gagal dihapus');";
        }
        ?>
      })
    </script>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lisensi
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-file-text-o"></i> Review Data Lama</li>
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
                <a href="<?php echo base_url('data_lama/lisensi/download');?>">
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
                  <th>Lampiran</th>
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
                  <td style="vertical-align: middle;"><h4><span class="label label-default"><?php echo $onedata['nama_status']; ?></span></h4></td>
                  <td style="vertical-align: middle;">
                    <button href="<?php echo $onedata['file_sertifikat']; ?>" class="btn btn-primary btn-xs review" title="lampiran"><i class="glyphicon glyphicon-zoom-in"></i></button>
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
                  <th>Lampiran</th>
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
                <a id="download_btn" href="<?php echo base_url('data_lama/lisensi/download'); ?>"><button type="button" class="btn btn-success pull-left">Unduh Data</button></a>
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

      $(function () {
        
        $('.select2').select2()

        $('#tabel1').DataTable()

        $(document).on('click', '.review', function() {
          var href = $(this).attr('href');
          window.open(href);
        })

        $("#distrik_download").change(function() {
          var kode_distrik = $("#distrik_download").val();

          if (kode_distrik == '0')
            kode_distrik = "";
          $("#download_btn").attr('href', "<?php echo base_url('data_lama/lisensi/download')."/"; ?>"+kode_distrik);
        })
      })
    </script>
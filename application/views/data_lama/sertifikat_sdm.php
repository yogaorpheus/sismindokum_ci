<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sertifikat SDM
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-file-text-o"></i> Review Data Lama</li>
        <li class="active">Sertifikat SDM</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Sertifikat SDM</h3>
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
                <a href="<?php echo base_url('data_lama/sertifikat_sdm/download');?>">
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
                  <th>Kode</th>
                  <th>Judul Sertifikasi</th>
                  <th>Nama Karyawan</th>
                  <th>Lembaga</th>
                  <th>Tanggal Terbit</th>
                  <th>Tanggal Berakhir</th>
                  <th>Status</th>
                  <th>Lampiran</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1; 
                foreach ($data_sdm as $key => $onedata) { 
                ?>
                <tr>
                  <td style="vertical-align: middle;"><?php echo $no++; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['nama_distrik']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['kode_sertifikasi']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['kompetensi']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['nama_lengkap_pegawai']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['nama_lembaga']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['tanggal_diperoleh']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['tanggal_berakhir']; ?></td>
                  <td style="vertical-align: middle;">
                    <?php
                    echo "<h4>";
                    if (strtolower($onedata['nama_status']) == "aktif")
                      echo "<span class='label label-success'>";
                    else if (strtolower($onedata['nama_status']) == "kadaluarsa")
                      echo "<span class='label label-danger'>";
                    echo $onedata['nama_status'];
                    echo "</span></h4>";
                    ?>
                  </td>
                  <td style="vertical-align: middle;" width="80px;">
                    <a href="<?php echo base_url('data_lama/sertifikat_sdm_review')."/".$onedata['id_sdm']; ?>">
                      <button class="btn btn-primary btn-xs review" title="Lampiran"><i class="glyphicon glyphicon-zoom-in"></i></button>
                    </a>
                  </td>
                </tr>
                <?php }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Distrik</th>
                  <th>Kode</th>
                  <th>Judul Sertifikasi</th>
                  <th>Nama Karyawan</th>
                  <th>Lembaga</th>
                  <th>Tanggal Terbit</th>
                  <th>Tanggal Berakhir</th>
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
                <a id="download_btn" href="<?php echo base_url('data_lama/sertifikat_sdm/download'); ?>"><button type="button" class="btn btn-success pull-left">Unduh Data</button></a>
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

        $(document).on("click", ".review", function() {
          $(this).attr('target', '_blank');
        })

        $("#distrik_download").change(function() {
          var kode_distrik = $("#distrik_download").val();

          if (kode_distrik == '0')
            kode_distrik = "";
          $("#download_btn").attr('href', "<?php echo base_url('data_lama/sertifikat_sdm/download')."/"; ?>"+kode_distrik);
        })
      })
    </script>
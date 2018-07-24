<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sertifikat SDM
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
              <h3 class="box-title">Data Sertifikat SDM</h3>
              <button class="btn btn-success pull-right"><i class="glyphicon glyphicon-download-alt"></i> Download Data</button>
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
                  <td style="vertical-align: middle;">MASIH KOSONG</td>
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

        $(document).on("click", ".review", function() {
          $(this).attr('target', '_blank');
        })
      })
    </script>
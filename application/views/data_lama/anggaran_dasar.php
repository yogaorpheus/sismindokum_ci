<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Anggaran Dasar
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-file-text-o"></i> Review Data Lama</li>
        <li class="active">Anggaran Dasar</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Anggaran Dasar</h3>
              <a href="<?php echo base_url('data_lama/anggaran_dasar/download');?>">
                <button class="btn btn-success pull-right"><i class="glyphicon glyphicon-download-alt"></i> Download Data</button>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabel1" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Tanggal RUPS Sirkuler</th>
                  <th>No. Akta</th>
                  <th>Tanggal Akta</th>
                  <th>No. Penerimaan Kemenkumham</th>
                  <th>PIC</th>
                  <th>Status Akta</th>
                  <th>Lampiran</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1; 
                foreach ($data_anggaran_lama as $key => $onedata) { 
                ?>
                <tr>
                  <td style="vertical-align: middle;"><?php echo $no++; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['tahun_anggaran']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['tanggal_rups_sirkuler']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['no_akta_anggaran']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['tanggal_akta_anggaran']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['no_penerimaan_anggaran']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['jabatan_pic']; ?></td>
                  <td style="vertical-align: middle;"><h4><span class="label label-warning"><?php echo $onedata['nama_status']; ?></span></h4></td>
                  <td style="vertical-align: middle;" width="60px;">
                    <div class="col-md-6">
                      <?php 
                      if (!is_null($onedata['file_anggaran_1']) && !empty($onedata['file_anggaran_1']))
                      { 
                        echo "<button class='btn btn-primary btn-xs review' title='lampiran 1' href='".$onedata['file_anggaran_1']."'><i class='glyphicon glyphicon-zoom-in'></i></button>";
                      }
                      ?>
                    </div>
                    <div class="col-md-6">
                      <?php 
                      if (!is_null($onedata['file_anggaran_2']) && !empty($onedata['file_anggaran_2']))
                      {
                        echo "<button class='btn btn-primary btn-xs review' title='lampiran 2' href='".$onedata['file_anggaran_2']."'><i class='glyphicon glyphicon-zoom-in'></i></button>";
                      }
                      ?>
                    </div>
                  </td>
                </tr>
                <?php }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Tanggal RUPS Sirkuler</th>
                  <th>No. Akta</th>
                  <th>Tanggal Akta</th>
                  <th>No. Penerimaan Kemenkumham</th>
                  <th>PIC</th>
                  <th>Status Akta</th>
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

        $(document).on('click', '.review', function() {
          var href = $(this).attr('href');
          window.open(href);
        })
      })
    </script>
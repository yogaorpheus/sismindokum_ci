<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Anggaran Dasar
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
              <h3 class="box-title">Data Lama Anggaran Dasar</h3>
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
                  <td style="vertical-align: middle;"><?php echo $onedata['nama_status']; ?></td>
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
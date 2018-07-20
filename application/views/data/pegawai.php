<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pegawai
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
              <button class="btn btn-success pull-right"><i class="glyphicon glyphicon-download-alt"></i> Download Data</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabel1" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>NID</th>
                  <th>Nama Pegawai</th>
                  <th>Email</th>
                  <th>No. Telp</th>
                  <th>Jabatan</th>
                  <th>Distrik</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1; 
                foreach ($data_pegawai as $key => $onedata) { 
                ?>
                <tr>
                  <td style="vertical-align: middle;"><?php echo $no++; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['nid_pegawai']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['nama_lengkap_pegawai']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['email_pegawai']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['no_hp_pegawai']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['posisi_pegawai']; ?></td>
                  <td style="vertical-align: middle;"><?php echo $onedata['nama_distrik']; ?></td>
                </tr>
                <?php }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>NID</th>
                  <th>Nama Pegawai</th>
                  <th>Email</th>
                  <th>No. Telp</th>
                  <th>Jabatan</th>
                  <th>Distrik</th>
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
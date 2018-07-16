<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Hak Akses
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
              <h3 class="box-title">Data Hak Akses</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabel1" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Distrik</th>
                  <th>Posisi Subdit</th>
                  <th>Menu Utama</th>
                  <th>Sub Menu</th>
                  <th>Menu CRUD</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                foreach ($hak_akses as $key => $value) {
                  echo "<tr>";
                  echo "<td>".$no++."</td>";
                  echo "<td>".$value['nama_distrik']."</td>";
                  echo "<td>".$value['nama_posisi_subdit']."</td>";
                  echo "<td>".$value['nama_menu1']."</td>";
                  echo "<td>".$value['nama_menu2']."</td>";
                  echo "<td>".$value['nama_menu_crud']."</td>";
                  echo "</tr>";
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Distrik</th>
                  <th>Posisi Subdit</th>
                  <th>Menu Utama</th>
                  <th>Sub Menu</th>
                  <th>Menu CRUD</th>
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
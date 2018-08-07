    <section class="content-header">
      <h1>
        Lembaga
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-file-text-o"></i> Dasar Hukum</li>
        <li class="active">Entri Lembaga</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <form id="form_dasar_hukum" action="<?php echo base_url('dasarhukumcontroller/insert_dasar_hukum'); ?>" method="POST">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Tambah Dasar Hukum</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>

              <div class="box-body">
                
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Sub Menu</label>
                      <select class="form-control select2" name="menu2_add" style="width: 100%;" required>
                        <?php
                        foreach ($data_menu2 as $key => $one_data) {
                          echo "<option value='".$one_data['id_menu2']."'>";
                          echo $one_data['nama_menu2'];
                          echo "</option>";
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Kode Dasar Hukum</label>
                      <input class="form-control" name="kode_dasar_hukum_add" type="text" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label id="sub_jenis">Nama Jenis</label>
                      <input class="form-control" name="nama_sub_jenis_sertifikat" type="text" required>
                    </div>

                    <div class="form-group">
                      <label>Keterangan Dasar Hukum</label>
                      <textarea class="form-control" name="keterangan_add" placeholder="Tulis keterangan dasar hukum" rows="3" required></textarea>
                    </div>
                  </div>
                  
                </div>
              </div>

              <div class="box-footer">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary pull-right">Simpan Data</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    $()

  })
</script>
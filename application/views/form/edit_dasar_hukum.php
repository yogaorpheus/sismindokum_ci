    <section class="content-header">
      <h1>
        Dasar Hukum
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
          <form id="form_dasar_hukum" action="<?php echo base_url('dasarhukumcontroller/update_dasar_hukum'); ?>" method="POST">
            <div class="box box-primary">
              <input type="hidden" id="id_edit" name="id_edit" value="<?php echo $dasar_hukum['id_dasar_hukum']; ?>">
              <div class="box-header with-border">
                <h3 class="box-title">Edit Dasar Hukum</h3>

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
                      <select class="form-control select2" name="menu2_edit" id="menu2_edit" style="width: 100%;" required>
                        <?php
                        foreach ($data_menu2 as $key => $one_data) {
                          if ($one_data['id_menu2'] == $dasar_hukum['id_menu2'])
                            echo "<option selected='selected' value='".$one_data['id_menu2']."'>";
                          else
                            echo "<option value='".$one_data['id_menu2']."'>";
                          echo $one_data['nama_menu2'];
                          echo "</option>";
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Kode Dasar Hukum</label>
                      <input type="text" class="form-control" name="kode_dasar_hukum_edit" value="<?php echo $dasar_hukum['kode_dasar_hukum']; ?>" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label id="sub_jenis">Nama Jenis</label>
                      <input class="form-control" name="nama_sub_jenis_sertifikat" type="text" value="<?php echo $dasar_hukum['nama_sub_jenis_sertifikat']; ?>" required>
                    </div>

                    <div class="form-group">
                      <label>Keterangan Dasar Hukum</label>
                      <textarea class="form-control" name="keterangan_edit" id="keterangan_edit" rows="3" required><?php echo $dasar_hukum['keterangan_dasar_hukum']; ?></textarea>
                    </div>
                  </div>
                  
                </div>
              </div>

              <div class="box-footer">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary pull-right">Update dan Simpan Data</button>
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

  })
</script>
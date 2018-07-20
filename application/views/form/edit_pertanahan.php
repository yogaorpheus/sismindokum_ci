    <section class="content-header">
      <h1>
        Pertanahan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Masukkan Data</a></li>
        <li class="active">Anggaran Dasar</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <form id="form_anggaran_dasar" action="<?php echo base_url('data_crud/pertanahan_update'); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_sertifikat" value="<?php echo $data_pertanahan['id_sertifikat']; ?>">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Edit Sertifikat Pertanahan</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>

              <div class="box-body">
                
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Distrik</label><br>
                      <?php
                      echo "<select class='form-control select2' style='width: 75%;' name='distrik'>";
                      
                      foreach ($distrik as $key => $one_distrik) {
                        if ($one_distrik['id_distrik'] == $data_pertanahan['id_distrik_sertifikat'])
                          echo "<option selected='selected' value=".$one_distrik['id_distrik'].">";
                        else
                        {
                          if ($user['kode_distrik_pegawai'] == 'Z')
                          {
                            echo "<option value=".$one_distrik['id_distrik'].">";
                          }
                          else {
                            echo "<option disabled='disabled' value=".$one_distrik['id_distrik'].">";
                          }
                        }
                          
                        echo $one_distrik['nama_distrik'];
                        echo "</option>";
                      }
                      echo "</select>";
                      
                      ?>
                    </div>
                    
                    <div class="form-group">
                      <label>Referensi Pertanahan</label>
                      <select class="form-control select2" style="width: 100%;" name="referensi_pertanahan" id="referensi">
                      <?php
                      foreach ($dasar_hukum as $key => $one_dasar_hukum) {
                        if ($one_dasar_hukum['id_dasar_hukum'] == $data_pertanahan['id_dasar_hukum_sertifikat'])
                          echo "<option selected='selected' value='".$one_dasar_hukum['id_dasar_hukum']."'>";
                        else
                          echo "<option value='".$one_dasar_hukum['id_dasar_hukum']."'>";
                        echo $one_dasar_hukum['kode_dasar_hukum'];
                        echo "</option>";
                      }
                      ?>
                      </select>
                      <p class="help-block" id="keterangan_referensi"></p>
                    </div>

                    <div class="form-group">
                      <label>No. Sertifikat</label>
                      <input type="text" class="form-control" id="no_sertifikat" name="no_sertifikat" value="<?php echo $data_pertanahan['no_sertifikat']; ?>">
                    </div>

                    <div class="form-group">
                      <label>Lokasi Sertifikat</label>
                      <input type="text" class="form-control" id="lokasi_sertifikat" name="lokasi_sertifikat" value="<?php echo $data_pertanahan['judul_sertifikat']; ?>">
                    </div>

                    <div class="form-group">
                      <label>Jenis Sertifikat</label>
                      <select class="form-control select2" style="width: 100%;" name="jenis_sertifikat">
                        <?php
                        foreach ($sub_jenis_sertifikat as $key => $one_sub_jenis) {
                          if ($one_sub_jenis['id_sub_jenis_sertifikat'] == $data_pertanahan['id_sub_jenis_sertifikat'])
                            echo "<option selected='selected' value='".$one_sub_jenis['id_sub_jenis_sertifikat']."'>";
                          else
                            echo "<option value='".$one_sub_jenis['id_sub_jenis_sertifikat']."'>";
                          echo $one_sub_jenis['nama_sub_jenis_sertifikat'];
                          echo "</option>";
                        }
                        ?>
                      </select>
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="form-group">
                      <label>Lembaga</label>
                      <select class="form-control select2" style="width: 100%;" name="lembaga">
                      <?php
                      foreach ($lembaga as $key => $one_lembaga) {
                        if ($one_lembaga['id_lembaga'] == $data_pertanahan['id_lembaga_sertifikat'])
                          echo "<option selected='selected' value='".$one_lembaga['id_lembaga']."'>";
                        else
                          echo "<option value='".$one_lembaga['id_lembaga']."'>";
                        echo $one_lembaga['nama_lembaga'];
                        echo "</option>";
                      }
                      ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Keterangan</label>
                      <textarea class="form-control" name="keterangan" placeholder="Tuliskan keterangan sertifikat" rows="4"><?php echo $data_pertanahan['keterangan']; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label>Tanggal Terbit</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker1" name="tanggal_terbit" value="<?php echo $data_pertanahan['tanggal_terbit']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Tanggal Berakhir</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker2" name="tanggal_berakhir" value="<?php echo $data_pertanahan['tanggal_berakhir']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="file_sertifikat">Lampiran</label>
                      <input type="file" id="lampiran" name="lampiran">
                      <p class="help-block"><?php echo $data_pertanahan['nama_file']; ?></p>
                    </div>

                  </div>

                </div>
              </div>

              <div class="box-footer">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary pull-right btn-lg">Edit dan Simpan</button>
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

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker1').datepicker({
      autoclose: true
    })

    //Date picker
    $('#datepicker2').datepicker({
      autoclose: true
    })

    var id_dasar_hukum = $("#referensi").val();
    var keterangan = "";

    <?php
    foreach ($dasar_hukum as $key => $value) {
      ?>
      if (id_dasar_hukum == <?php echo $key; ?>)
      {
        keterangan = "<?php echo $value['keterangan_dasar_hukum']; ?>";
        console.log(keterangan);
        $("#keterangan_referensi").html(keterangan);
      }
      <?php
    }
    ?>

    $("#referensi").change(function() {
      id_dasar_hukum = $("#referensi").val();
      <?php
      foreach ($dasar_hukum as $key => $value) {
        ?>
        if (id_dasar_hukum == <?php echo $key; ?>)
        {
          keterangan = "<?php echo $value['keterangan_dasar_hukum']; ?>";
          $("#keterangan_referensi").html(keterangan);
        }
        <?php
      }
      ?>
    })

  })
</script>
    <section class="content-header">
      <h1>
        Sertifikat Lisensi
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
          <form id="form_sertifikat_perizinan" action="<?php echo base_url('sertifikat/tambah_sertifikat_lisensi'); ?>" method="POST">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Form Sertifikat Lisensi</h3>

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
                      if ($user['kode_distrik_pegawai'] == 'Z')
                      {
                        echo "<select class='form-control select2' style='width: 75%;' name='distrik'>";
                      }
                      else
                      {
                        echo "<select class='form-control select2' style='width: 75%;' disabled='disabled'>"; 
                        // HANYA DIGUNAKAN SEBAGAI PENANDA BAGI USER
                      }
                      
                      foreach ($distrik as $key => $one_distrik) {
                        if ($one_distrik['kode_distrik'] == $user_detail['kode_distrik_pegawai'])
                          echo "<option selected='selected' value=".$one_distrik['id_distrik'].">";
                        else
                          echo "<option value=".$one_distrik['id_distrik'].">";
                        echo $one_distrik['nama_distrik'];
                        echo "</option>";
                      }
                      echo "</select>";
                      
                      ?>
                    </div>
                  </div>

                </div>
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Referensi Lisensi</label>
                      <select class="form-control select2" style="width: 100%;" name="referensi_lisensi">
                        <option value="0" selected="selected">Tidak ada Referensi Dasar Hukum</option>
                        <?php
                        foreach ($dasar_hukum as $key => $one_dasar_hukum) {
                          echo "<option value='".$one_dasar_hukum['id_dasar_hukum']."'>";
                          echo $one_dasar_hukum['kode_dasar_hukum'];
                          echo "</option>";
                        }
                        ?>
                      </select>
                      <p class="keterangan_referensi"></p>
                    </div>

                    <div class="form-group">
                      <label>Nama Lisensi</label>
                      <input type="text" class="form-control" id="nama_lisensi" name="nama_lisensi" required>
                    </div>

                    <div class="form-group">
                      <label>No. Lisensi</label>
                      <input type="text" class="form-control" id="no_sertifikat" name="no_sertifikat" required>
                    </div>

                    <div class="form-group">
                      <label>Spesifikasi</label>
                      <input type="text" class="form-control" id="spesifikasi" name="spesifikasi">
                    </div>

                    <div class="form-group">
                      <label>Lembaga</label>
                      <select class="form-control select2" style="width: 100%;" name="lembaga">
                      <?php
                      foreach ($lembaga as $key => $one_lembaga) {
                        echo "<option value='".$one_lembaga['id_lembaga']."'>";
                        echo $one_lembaga['nama_lembaga'];
                        echo "</option>";
                      }
                      ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Keterangan</label>
                      <textarea class="form-control" name="keterangan" placeholder="Tuliskan keterangan sertifikat" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                      <label>Tanggal Terbit</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker1" name="tanggal_terbit">
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Tanggal Berakhir</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker2" name="tanggal_berakhir">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="file_sertifikat">Lampiran</label>
                      <input type="file" id="lampiran" name="lampiran">
                    </div>
                  </div>
                  
                </div>
              </div>

              <div class="box-footer">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary pull-right btn-lg">Simpan</button>
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
  })
</script>
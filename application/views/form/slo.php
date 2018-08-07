    <section class="content-header">
      <h1>
        Sertifikat Laik Operasi - SLO
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-file-text-o"></i> Entri Data</li>
        <li class="active">SLO</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <form id="form_anggaran_dasar" action="<?php echo base_url('sertifikat_data/tambah_slo'); ?>" method="POST" enctype="multipart/form-data">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Form SLO</h3>

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
                      echo "<select class='form-control select2' style='width: 75%;' name='distrik' id='distrik' required>";
                      
                      foreach ($distrik as $key => $one_distrik) {
                        if ($one_distrik['kode_distrik'] == $user['kode_distrik_pegawai'])
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
                      <label>No. Sertifikat</label>
                      <input type="text" class="form-control" id="no_sertifikat" name="no_sertifikat" required>
                    </div>

                    <div class="form-group">
                      <label>Unit Sertifikasi</label>
                      <select class="form-control select2" style="width: 100%;" name="unit_sertifikasi" id="unit_sertifikasi" required>
                        <?php
                        foreach ($unit as $key => $one_unit) {
                          echo "<option value='".$one_unit['id_unit']."'>";
                          echo $one_unit['nama_unit'];
                          echo "</option>";
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="file_sertifikat">Lampiran</label>
                      <input type="file" id="lampiran" name="lampiran">
                    </div>

                    <div class="form-group">
                      <label>Lembaga</label>
                      <select class="form-control select2" style="width: 100%;" name="lembaga" required>
                      <?php
                      foreach ($lembaga as $key => $one_lembaga) {
                        echo "<option value='".$one_lembaga['id_lembaga']."'>";
                        echo $one_lembaga['nama_lembaga'];
                        echo "</option>";
                      }
                      ?>
                      </select>
                    </div>

                  </div>
                  <div class="col-md-6">

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
                        <input type="text" class="form-control pull-right" id="datepicker1" name="tanggal_terbit" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Tanggal Berakhir</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker2" name="tanggal_berakhir" required>
                      </div>
                    </div>

                    <div class="checkbox" style="margin-top: -10px; margin-left: 20px;">
                      <input type="checkbox" id="check_forever" value="">
                      <span class="text">Berlaku Selamanya</span>
                    </div>

                    <div class="form-group">
                      <label>Waktu Pengingat</label>
                      <select class="form-control select2" style="width: 100%;" name="remainder" required>
                      <?php
                      foreach ($remainder as $key => $one_remainder) {
                        if ($one_remainder['durasi_remainder'] == 180)
                        {
                          echo "<option value='".$one_remainder['id_remainder']."' selected='selected'>";
                        }
                        else
                        {
                          echo "<option value='".$one_remainder['id_remainder']."' disabled='disabled'>";
                        }
                        echo $one_remainder['nama_remainder'];
                        echo "</option>";
                      }
                      ?>
                      </select>
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

    $("#check_forever").change(function() {
      if ($('#check_forever').is(':checked'))
      {
        $('#datepicker2').datepicker().datepicker('setDate', "12/31/4999");
      }
      else
      {
        $('#datepicker2').datepicker().datepicker('setDate', "");
      }
    })

    <?php
    if (!is_null($this->session->flashdata('error_msg')))
    {
      ?>alert("<?php echo $this->session->flashdata('error_msg'); ?>");<?php
    }
    ?>

    $('#distrik').change(function() {
      var id_distrik = $('#distrik').val();
      $('#unit_sertifikasi').find('option').remove().end();

        <?php
        foreach ($unit as $key => $one_unit) {
          ?>
          if (id_distrik == <?php echo $one_unit['id_distrik_unit']; ?>)
          {
            var id_unit = <?php echo $one_unit['id_unit']; ?>;
            var nama_unit = "<?php echo $one_unit['nama_unit']; ?>";
            $('#unit_sertifikasi').append("<option value='"+ id_unit +"'>"+ nama_unit + "</option");
          }
          <?php
        }
        ?>
    })

    $(document).ready(function() {
      var id_distrik = $('#distrik').val();
      $('#unit_sertifikasi').find('option').remove().end();

        <?php
        foreach ($unit as $key => $one_unit) {
          ?>
          if (id_distrik == <?php echo $one_unit['id_distrik_unit']; ?>)
          {
            var id_unit = <?php echo $one_unit['id_unit']; ?>;
            var nama_unit = "<?php echo $one_unit['nama_unit']; ?>";
            $('#unit_sertifikasi').append("<option value='"+ id_unit +"'>"+ nama_unit + "</option");
          }
          <?php
        }
        ?>
    })

  })
</script>
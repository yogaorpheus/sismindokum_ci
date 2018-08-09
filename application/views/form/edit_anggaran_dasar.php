    <section class="content-header">
      <h1>
        Anggaran Dasar
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-file-text-o"></i> Review Data</li>
        <li>Anggaran Dasar</li>
        <li class="active">Edit Anggaran Dasar</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <form id="form_anggaran_dasar" action="<?php echo base_url('anggaran_dasar/anggaran_dasar_update'); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_anggaran" value="<?php echo $data_anggaran['id_anggaran']; ?>">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Edit Anggaran Dasar</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>

              <div class="box-body">
                
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tanggal RUPS Sirkuler</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker1" autocomplete="off" name="tanggal_rups_sirkuler" value="<?php echo $data_anggaran['tanggal_rups_sirkuler']; ?>" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Tahun</label><br>
                      <select class="form-control select2" style="width: 25%;" name="tahun_anggaran" required>
                        <?php
                        $year_now = date("Y");
                        for ($i = 1990; $i < 2100; $i++)
                        {
                          if ($data_anggaran['tahun_anggaran'] == $i)
                            echo "<option selected='selected'>";
                          else
                            echo "<option>";

                          echo $i;
                          echo "</option>";
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>No. Akta</label>
                      <input type="text" class="form-control" id="no_akta" name="no_akta" value="<?php echo $data_anggaran['no_akta_anggaran']; ?>" required>
                    </div>

                    <div class="form-group">
                      <label>Nomor Penerimaan Kemenkumham</label>
                      <input type="text" class="form-control" id="nomor_penerimaan" name="nomor_penerimaan" value="<?php echo $data_anggaran['no_penerimaan_anggaran']; ?>" required>
                    </div>

                    <!-- ADA TAMBAHAN PIC, DIAMBIL MELALUI SESSION AJA -->                  
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tanggal Akta</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" autocomplete="off" id="datepicker2" name="tanggal_akta" value="<?php echo $data_anggaran['tanggal_akta']; ?>" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Lampiran 1</label>
                      <input type="file" id="lampiran1" name="lampiran1">
                      <p class="help-block"><?php echo $data_anggaran['nama_file1']; ?></p>
                    </div>

                    <div class="form-group">
                      <label>Lampiran 2</label>
                      <input type="file" id="lampiran2" name="lampiran2">
                      <p class="help-block"><?php echo $data_anggaran['nama_file2']; ?></p>
                    </div>

                    <div class="form-group">
                      <label>Tanggal Berakhir</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker3" autocomplete="off" name="tanggal_berakhir" value="<?php echo $data_anggaran['tanggal_berakhir']; ?>" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Waktu Pengingat</label>
                      <select class="form-control select2" style="width: 100%;" name="remainder" required>
                      <?php
                      foreach ($remainder as $key => $one_remainder) {
                        if ($one_remainder['id_remainder'] == $data_anggaran['id_remainder_anggaran'])
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
  })
</script>
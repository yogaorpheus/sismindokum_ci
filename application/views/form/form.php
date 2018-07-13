    <section class="content-header">
      <h1>
        Form Pengisian Sertifikat
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Sertifikat</a></li>
        <li class="active">DUMMY</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <form action="<?php echo base_url('form/add_sertifikat'); ?>" method="POST">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Form Sertifikat DUMMY</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>

              <div class="box-body">
                <div class='col-md-6'>

                  <div class='form-group'>
                    <label>Referensi Hukum</label>
                    <select class='form-control select2' style='width: 100%;' name="referensi_hukum">
                      <option selected='selected' value="0">Tidak ada referensi dasar hukum</option>
                      <option value="1">UUD 1945</option>
                      <option value="2">UU</option>
                      <option value="3">UUD 1999</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Nomor Sertifikat</label>
                    <input type="text" class="form-control" id="no_sertifikat" name="no_sertifikat" placeholder="Masukkan Nomor Sertifikat">
                  </div>

                  <div class="form-group">
                    <label>Jenis Sertifikat</label>
                    <input type="text" class="form-control" id="jenis_sertifikat" name="jenis_sertifikat" value="<?php echo "DUMMY"; ?>" readonly>
                  </div>

                  <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan" rows="4"></textarea>
                  </div>
                
                </div>
                <div class="col-md-6">

                  <div class="form-group">
                    <label>Masa Berlaku Sertifikasi</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="reservation" name="masa_berlaku_sertifikasi">
                    </div>
                      <!-- /.input group -->
                  </div>

                  <div class="form-group">
                    <label for="file_sertifikat">File Sertifikat</label>
                    <input type="file" id="file_sertifikat" name="file_sertifikat">
                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                  </div>

                </div>
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right btn-lg">Simpan</button>
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
    $('#datepicker').datepicker({
      autoclose: true
    })
  })
</script>
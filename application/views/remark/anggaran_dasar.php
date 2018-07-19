    <section class="content-header">
      <h1>
        Anggaran Dasar
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
        <div class="col-md-6">
          <form id="form_anggaran_dasar" action="<?php echo base_url('remark_data/anggaran_dasar_remark'); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_anggaran" value="<?php echo $data_anggaran['id_anggaran']; ?>">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Remark Anggaran Dasar</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>

              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Tanggal RUPS Sirkuler</label>
                      <input type="text" class="form-control" id="tanggal_rups" name="tanggal_rups_sirkuler" value="<?php echo $data_anggaran['tanggal_rups_sirkuler']; ?>" disabled="disabled">
                    </div>

                    <div class="form-group">
                      <label>Tahun Anggaran</label>
                      <input type="text" class="form-control" id="tahun_anggaran" name="tahun_anggaran" value="<?php echo $data_anggaran['tahun_anggaran']; ?>" disabled="disabled">
                    </div>

                    <div class="form-group">
                      <label>Tanggal Akta</label>
                      <input type="text" class="form-control" id="tanggal_akta" name="tanggal_akta" value="<?php echo $data_anggaran['tanggal_akta_anggaran']; ?>" disabled="disabled">
                    </div>

                    <div class="form-group">
                      <label>No. Akta</label>
                      <input type="text" class="form-control" id="no_akta" name="no_akta" value="<?php echo $data_anggaran['no_akta_anggaran']; ?>" disabled="disabled">
                    </div>

                    <div class="form-group">
                      <label>Nomor Penerimaan Kemenkumham</label>
                      <input type="text" class="form-control" id="nomor_penerimaan" name="nomor_penerimaan" value="<?php echo $data_anggaran['no_penerimaan_anggaran']; ?>" disabled="disabled">
                    </div>

                    <div class="form-group">
                      <label>Status</label>
                      <input type="text" class="form-control" id="status" name="status" value="<?php echo $data_anggaran['status_anggaran']; ?>" disabled="disabled">
                    </div>

                    <div class="form-group">
                      <label>Lampiran 1</label>
                      <p class="help-block"><?php echo $data_anggaran['nama_file1']; ?></p>
                    </div>

                    <div class="form-group">
                      <label>Lampiran 2</label>
                      <p class="help-block"><?php echo $data_anggaran['nama_file2']; ?></p>
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
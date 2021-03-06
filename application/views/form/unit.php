    <section class="content-header">
      <h1>
        Unit
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-file-text-o"></i> Unit</li>
        <li class="active">Entri Unit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <form id="form_sertifikat_perizinan" action="<?php echo base_url('unitcontroller/insert_unit'); ?>" method="POST">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Tambah Unit</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>

              <div class="box-body">
                
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama Unit</label>
                      <input class="form-control" name="nama" type="text" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Distrik</label>
                      <select class="form-control select2" style="width: 100%" name="distrik" required>
                        <?php
                        foreach ($data_distrik as $key => $one_distrik) {
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

    <?php
    if ($this->session->flashdata('error') == 1)
    {
      ?>alert('Data Lisensi berhasil dimasukkan'); <?php
    }
    else if ($this->session->flashdata('error') == 2)
    {
      ?>alert('Data Lisensi gagal dimasukkan'); <?php
    }
    ?>

  })
</script>
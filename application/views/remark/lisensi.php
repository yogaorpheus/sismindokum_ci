    <section class="content-header">
      <h1>
        Sertifikat Lisensi
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-file-text-o"></i> Review Data</li>
        <li>Lisensi</li>
        <li class="active">Remark Lisensi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <form id="form_sertifikat_perizinan" action="<?php echo base_url('remark_data/sertifikat_remark'); ?>" method="POST">
          <div class="col-md-6">  
            <input type="hidden" name="id_sertifikat" value="<?php echo $data_sertifikat['id_sertifikat']; ?>">
            <input type="hidden" name="sub_link" value="<?php echo $this->uri->segment(2); ?>">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Data Lisensi</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>

              <div class="box-body">
                
                <div class="row">

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Distrik</label>
                      <input class="form-control" type="text" disabled="disabled" value="<?php echo $data_sertifikat['nama_distrik']; ?>">
                    </div>

                    <div class="form-group">
                      <label>Referensi Lisensi</label>
                      <input class="form-control" type="text" disabled="disabled" value="<?php echo $data_sertifikat['kode_dasar_hukum']; ?>">
                      <p class="help-block"><?php echo $data_sertifikat['keterangan_dasar_hukum']; ?></p>
                    </div>

                    <div class="form-group">
                      <label>Nama Lisensi</label>
                      <input class="form-control" type="text" disabled="disabled" value="<?php echo $data_sertifikat['judul_sertifikat']; ?>">
                    </div>

                    <div class="form-group">
                      <label>No. Lisensi</label>
                      <input class="form-control" type="text" disabled="disabled" value="<?php echo $data_sertifikat['no_sertifikat']; ?>">
                    </div>

                    <div class="form-group">
                      <label>Spesifikasi</label>
                      <input class="form-control" type="text" disabled="disabled" value="<?php echo $data_sertifikat['spesifikasi_lisensi']; ?>">
                    </div>

                    <div class="form-group">
                      <label>Lembaga</label>
                      <input class="form-control" type="text" disabled="disabled" value="<?php echo $data_sertifikat['nama_lembaga']; ?>">
                    </div>

                    <div class="form-group">
                      <label>Keterangan</label>
                      <textarea class="form-control" disabled="disabled" name="keterangan" rows="2"><?php echo $data_sertifikat['keterangan']; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label>Tanggal Terbit</label>
                      <input class="form-control" type="text" disabled="disabled" value="<?php echo $data_sertifikat['tanggal_sertifikasi']; ?>">
                    </div>

                    <div class="form-group">
                      <label>Tanggal Berakhir</label>
                      <input class="form-control" type="text" disabled="disabled" value="<?php echo $data_sertifikat['tanggal_kadaluarsa']; ?>">
                    </div>

                    <div class="form-group">
                      <label>Lampiran</label>
                      <p class="help-block"><?php echo $data_sertifikat['nama_file']; ?></p>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">

              <div class="box box-success direct-chat direct-chat-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Remark Lisensi</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                    <?php
                    foreach ($data_remark as $key => $one_remark) {
                      if ($one_remark['dibuat_oleh'] == $this->session->userdata('staff_pjb')['id_pegawai'])
                      {
                        echo "<div class='direct-chat-msg right'>";
                        echo "<div class='direct-chat-info clearfix'>";
                        echo "<span class='direct-chat-name pull-right'>".$one_remark['nama_lengkap_pegawai']."</span>";
                        echo "<span class='direct-chat-timestamp pull-left'>".$one_remark['tanggal_remark']."</span>";
                      }
                      else
                      {
                        echo "<div class='direct-chat-msg'>";
                        echo "<div class='direct-chat-info clearfix'>";
                        echo "<span class='direct-chat-name pull-left'>".$one_remark['nama_lengkap_pegawai']."</span>";
                        echo "<span class='direct-chat-timestamp pull-right'>".$one_remark['tanggal_remark']."</span>";
                      }

                      echo "</div>";
                      echo "<img class='direct-chat-img' src='".base_url('assets/img').'/user-icon.png'."' alt='user'>";
                      echo "<div class='direct-chat-text'>";
                      echo "Status Remark</br>";
                      echo $one_remark['nama_status']."</br></br>";
                      echo "Remark</br>";
                      echo $one_remark['keterangan']."</br></br>";
                      echo "<a href='#'>";
                      echo "<button class='btn btn-danger btn-xs Delete' type='button' data-toggle='modal' data-target='#modal_delete' id='".$one_remark['id_remark']."'><i class='glyphicon glyphicon-trash'></i></button>";
                      echo "</a>";
                      echo "</div>";
                      echo "</div>";
                    }
                    ?>
                  </div>
                  <!--/.direct-chat-messages-->                  
                </div>
                <!-- /.box-body -->
              </div>
              <!--/.direct-chat -->

            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Remark</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>

              <div class="box-body">
                <div class="row">
                  
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Status Remark</label>
                      <select class="form-control select2" style="width: 100%;" name="status_remark" id="status_remark">
                        <?php
                        foreach ($status_remark as $key => $one_status) {
                          echo "<option value='".$one_status['id_status']."'>";
                          echo $one_status['nama_status'];
                          echo "</option>";
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Keterangan Remark</label>
                      <textarea class="form-control" name="keterangan" placeholder="Tuliskan keterangan remark" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-success pull-right" value="Simpan">Simpan Remark</button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
        <!-- /.row -->

      <div class="modal fade" id="modal_delete">
        <form id="delete_lembaga" action="<?php echo base_url('remark_data/delete_remark'); ?>" method="POST">
          <div class="modal-dialog">
            <input type="hidden" name="id_data" value="<?php echo $data_sertifikat['id_sertifikat']; ?>">
            <input type="hidden" name="sub_link" value="<?php echo $this->uri->segment(2); ?>">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">HAPUS DATA</h4>
                <input type="hidden" id="id_data" name="id" value="">
              </div>
              <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
              </div>
              <div class="modal-footer">
                <a id="delete_yes"><button type="submit" class="btn btn-danger pull-left">Iya, Hapus</button></a>
                <button type="button" class="btn btn-success pull-right" data-dismiss="modal" id="delete_no">Tidak</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </form>    
      </div>
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

    $(document).on("click", ".Delete", function() {
      var delete_id = $(this).attr('id');
      $("#id_data").val(delete_id);
      console.log(delete_id);
    })

  })
</script>
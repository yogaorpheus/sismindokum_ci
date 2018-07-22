    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
          <div class="col-md-6">  
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Data Anggaran Dasar</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>

              <div class="box-body chart-responsive">                
                <div class="chart" id="anggaran_dasar_chart" style="height: 300px; position: relative;"></div>
              </div>
            </div>
          </div>

          <div class="col-md-6">  
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Data Sertifikat</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>

              <div class="box-body chart-responsive">
                <div class="chart chart_hasil" id="sertifikat_chart" style="height: 300px; position: relative;"></div>
              </div>

              <div class="box-footer with-border">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <select class="form-control select2" id="opsi_chart">
                        <?php
                        foreach ($sertifikat as $key => $one) {
                          $nama_sertifikat = strtolower($one['nama_jenis_sertifikat']);
                          $nama_sertifikat = str_replace(" ", "_", $nama_sertifikat);
                          echo "<option value='".$nama_sertifikat."'>";
                          echo $one['nama_jenis_sertifikat'];
                          echo "</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<script>

  $(function () {

    $(".select2").select2()

    $(document).ready(function() {
      $('#opsi_chart').val("pertanahan");

      new Morris.Donut({
          element: 'sertifikat_chart',
          resize: true,
          colors: ["#00a65a", "#fc9c02", "#db0419", "#0f3cad"],
          data: [<?php echo $pertanahan; ?>],
          hideHover: 'auto'
        });
    })

    $('#opsi_chart').change(function() {
      var jenis_chart = $('#opsi_chart').val();
      //$('.chart_hasil').attr('id', id_chart);
      $("#pertanahan").empty();

      if (jenis_chart == "pertanahan") {
        new Morris.Donut({
          element: 'sertifikat_chart',
          resize: true,
          colors: ["#00a65a", "#fc9c02", "#db0419", "#0f3cad"],
          data: [<?php echo $pertanahan; ?>],
          hideHover: 'auto'
        });
      }
      else if (jenis_chart == "slo") {
        new Morris.Donut({
          element: 'sertifikat_chart',
          resize: true,
          colors: ["#00a65a", "#fc9c02", "#db0419", "#0f3cad"],
          data: [<?php echo $slo; ?>],
          hideHover: 'auto'
        });
      }
      else if (jenis_chart == "lisensi") {
        new Morris.Donut({
          element: 'sertifikat_chart',
          resize: true,
          colors: ["#00a65a", "#fc9c02", "#db0419", "#0f3cad"],
          data: [<?php echo $lisensi; ?>],
          hideHover: 'auto'
        });
      }
      else if (jenis_chart == "pengujian") {
        new Morris.Donut({
          element: 'sertifikat_chart',
          resize: true,
          colors: ["#00a65a", "#fc9c02", "#db0419", "#0f3cad"],
          data: [<?php echo $pengujian; ?>],
          hideHover: 'auto'
        });
      }
      else if (jenis_chart == "perizinan") {
        new Morris.Donut({
          element: 'sertifikat_chart',
          resize: true,
          colors: ["#00a65a", "#fc9c02", "#db0419", "#0f3cad"],
          data: [<?php echo $perizinan; ?>],
          hideHover: 'auto'
        });
      }
    })

    var chart_anggaran_dasar = new Morris.Donut({
      element: 'anggaran_dasar_chart',
      resize: true,
      colors: ["#00a65a", "#db0419"],
      data: [<?php echo $data_anggaran; ?>],
      hideHover: 'auto'
    });
  })
</script>
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
      
      <?php
      if ($this->session->userdata('staff_pjb')['kode_distrik_pegawai'] == 'Z')
      {
        ?>
        <div class="row">
          <div class="col-md-6">  
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Data Anggaran</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>

              <div class="box-body">                
                <div id="highchartsAnggaran"></div>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
      <div class="row">

        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Data Sertifikat</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>

            <div class="box-body">
              <div class="row">
                <?php
                if ($this->session->userdata('staff_pjb')['kode_distrik_pegawai'] == 'Z')
                {
                  echo "<div class='col-md-12'>";
                  echo "<div class='form-group'>";
                  echo "<label>Pilih Distrik</label>";
                  echo "<select class='form-control select2' id='distrik' style='width: 100%;'>";
                  echo "<option selected='selected' value='ALL'>Semua Distrik</option>";
                  foreach ($distrik as $key => $one_distrik) {
                    echo "<option value='".$one_distrik['id_distrik']."'>";
                    echo $one_distrik['nama_distrik'];
                    echo "</option>";
                  }
                  echo "</select></div></div>";
                }
                ?>
                <div class="col-md-6">
                  <div class="box box-primary">
                    
                    <div class="box-header with-border">
                      <h3 class="box-title">Data Pertanahan</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <div id="highchartsPertanahan"></div>
                    </div>

                  </div>
                </div>

                <div class="col-md-6">
                  <div class="box box-primary">
                    
                    <div class="box-header with-border">
                      <h3 class="box-title">Data SLO</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <div id="highchartsSLO"></div>
                    </div>
                    
                  </div>
                </div>
              
              </div>
              <div class="row">

                <div class="col-md-6">
                  <div class="box box-primary">
                    
                    <div class="box-header with-border">
                      <h3 class="box-title">Data Sertifikat SDM</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <div id="highchartsSDM"></div>
                    </div>

                  </div>
                </div>

                <div class="col-md-6">
                  <div class="box box-primary">
                    
                    <div class="box-header with-border">
                      <h3 class="box-title">Data Perizinan</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <div id="highchartsPerizinan"></div>
                    </div>
                    
                  </div>
                </div>

              </div>
              <div class="row">

                <div class="col-md-6">
                  <div class="box box-primary">
                    
                    <div class="box-header with-border">
                      <h3 class="box-title">Data Pengujian Alat K3</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <div id="highchartsPengujian"></div>
                    </div>

                  </div>
                </div>

                <div class="col-md-6">
                  <div class="box box-primary">
                    
                    <div class="box-header with-border">
                      <h3 class="box-title">Data Lisensi</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <div id="highchartsLisensi"></div>
                    </div>
                    
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
  var kode_distrik_pegawai = "<?php echo $this->session->userdata('staff_pjb')['kode_distrik_pegawai']; ?>";
  var highchartsPertanahan = new Object();
  var highchartsLisensi = new Object();
  var highchartsPengujian = new Object();
  var highchartsPerizinan = new Object();
  var highchartsSLO = new Object();
  var highchartsSDM = new Object();
  var highchartsAnggaran = new Object();

  $(function () {

    $(".select2").select2()

    function createChartSertifikat(id, title, data, total_data)
    {
      return new Highcharts.Chart(id, {
          colors: ['#27e002', '#ff9d00', '#e51e00', '#af9d9a', '#000000'],
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },
          title: {
              text: title + " (Total data : " + total_data + ")"
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      format: '{point.name}: {point.y}<br>({point.percentage:.1f} %)',
                      style: {
                          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                      }
                  },
                  showInLegend: true
              }
          },
          series: [{
              name: 'Jumlah',
              colorByPoint: true,
              data: data
          }]
      });
    }

    function createChartTwoColors(id, title, data, total_data)
    {
      return new Highcharts.Chart(id, {
          colors: ['#27e002', '#e51e00'],
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },
          title: {
              text: title + " (Total data : " + total_data + ")"
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      format: '{point.name}: {point.y}<br>({point.percentage:.1f} %)',
                      style: {
                          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                      }
                  },
                  showInLegend: true
              }
          },
          series: [{
              name: 'Jumlah',
              colorByPoint: true,
              data: data
          }]
      });
    }

    function updateChart (data)
    {

      if ("<?php echo $this->session->userdata('staff_pjb')['kode_distrik_pegawai']; ?>" != 'Z')
        return alert('Tidak memiliki izin untuk melakukan update');

      $('#highchartsPertanahan').empty()
      $('#highchartsLisensi').empty()
      $('#highchartsPengujian').empty()
      $('#highchartsPerizinan').empty()
      $('#highchartsSLO').empty()
      $('#highchartsSDM').empty()

      highchartsPertanahan = createChartSertifikat('highchartsPertanahan', 'Data Pertanahan', data.pertanahan, data.total_pertanahan);
      highchartsSLO = createChartSertifikat('highchartsSLO', 'Data SLO', data.slo, data.total_slo);
      highchartsPerizinan = createChartSertifikat('highchartsPerizinan', 'Data Perizinan', data.perizinan, data.total_perizinan);
      highchartsPengujian = createChartSertifikat('highchartsPengujian', 'Data Pengujian Alat K3', data.pengujian, data.total_pengujian);
      highchartsLisensi = createChartSertifikat('highchartsLisensi', 'Data Lisensi', data.lisensi, data.total_lisensi);
      highchartsSDM = createChartTwoColors('highchartsSDM', 'Data Sertifikat SDM', data.sdm, data.total_sdm);
    }

    $(document).ready(function() {

      if (kode_distrik_pegawai == 'Z')
      {
        <?php
        if (isset($data_anggaran) && isset($total_anggaran))
        {
          ?>
          dataAnggaran = <?php echo json_encode($data_anggaran, JSON_NUMERIC_CHECK); ?>;
          totalAnggaran = <?php echo $total_anggaran; ?>;
          highchartsAnggaran = createChartTwoColors('highchartsAnggaran', 'Data Anggaran', dataAnggaran, totalAnggaran);
          <?php
        }
        ?>
      }

      dataPertanahan = <?php echo json_encode($pertanahan, JSON_NUMERIC_CHECK); ?>;
      dataSLO = <?php echo json_encode($slo, JSON_NUMERIC_CHECK); ?>;
      dataPerizinan = <?php echo json_encode($perizinan, JSON_NUMERIC_CHECK); ?>;
      dataPengujian = <?php echo json_encode($pengujian, JSON_NUMERIC_CHECK); ?>;
      dataLisensi = <?php echo json_encode($lisensi, JSON_NUMERIC_CHECK); ?>;
      dataSDM = <?php echo json_encode($sdm, JSON_NUMERIC_CHECK); ?>;

      totalSDM = <?php echo $total_sdm; ?>;
      totalPertanahan = <?php echo $total_pertanahan; ?>;
      totalSLO = <?php echo $total_slo; ?>;
      totalPerizinan = <?php echo $total_perizinan; ?>;
      totalPengujian = <?php echo $total_pengujian; ?>;
      totalLisensi = <?php echo $total_lisensi; ?>;

      highchartsPertanahan = createChartSertifikat('highchartsPertanahan', 'Data Pertanahan', dataPertanahan, totalPertanahan);
      highchartsSLO = createChartSertifikat('highchartsSLO', 'Data SLO', dataSLO, totalSLO);
      highchartsPerizinan = createChartSertifikat('highchartsPerizinan', 'Data Perizinan', dataPerizinan, totalPerizinan);
      highchartsPengujian = createChartSertifikat('highchartsPengujian', 'Data Pengujian Alat K3', dataPengujian, totalPengujian);
      highchartsLisensi = createChartSertifikat('highchartsLisensi', 'Data Lisensi', dataLisensi, totalLisensi);
      highchartsSDM = createChartTwoColors('highchartsSDM', 'Data Sertifikat SDM', dataSDM, totalSDM);

    })

    $('#distrik').change(function() {
      var id_distrik = $('#distrik').val();
      
      $.ajax(
      {
        url: "<?php echo site_url('dashboard/ajax_get_dashboard_distrik_by_id'); ?>/"+id_distrik,
        method: "GET"
      })
      .done(function(chart_data)
      {
        updateChart(chart_data);
      })
      .fail(function( jqXHR, textStatus, errorThrown) {
        alert("Request failed : " + textStatus + "\n" + errorThrown);
      });

    })
    
  })
</script>
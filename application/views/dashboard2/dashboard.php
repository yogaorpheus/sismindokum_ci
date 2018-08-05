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
      <?php
      echo json_encode($pertanahan);
      ?>
    </section>
    <!-- /.content -->
<script>
  var highchartsPertanahan = new Object();
  var highchartsLisensi = new Object();
  var highchartsPengujian = new Object();
  var highchartsPerizinan = new Object();
  var highchartsSLO = new Object();
  var highchartsSDM = new Object();
  var highchartsAnggaran = new Object();

  $(function () {

    $(".select2").select2()

    function createChartSertifikat(id, title, data)
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
              text: title
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
              name: 'Brands',
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

      highchartsPertanahan = createChartSertifikat('highchartsPertanahan', 'Data Pertanahan', data.pertanahan);
      highchartsSLO = createChartSertifikat('highchartsSLO', 'Data SLO', data.slo);
      highchartsPerizinan = createChartSertifikat('highchartsPerizinan', 'Data Perizinan', data.perizinan);
      highchartsPengujian = createChartSertifikat('highchartsPengujian', 'Data Pengujian Alat K3', data.pengujian);
      highchartsLisensi = createChartSertifikat('highchartsLisensi', 'Data Lisensi', data.lisensi);
    }

    $(document).ready(function() {

      dataPertanahan = <?php echo json_encode($pertanahan, JSON_NUMERIC_CHECK); ?>;
      dataSLO = <?php echo json_encode($slo, JSON_NUMERIC_CHECK); ?>;
      dataPerizinan = <?php echo json_encode($perizinan, JSON_NUMERIC_CHECK); ?>;
      dataPengujian = <?php echo json_encode($pengujian, JSON_NUMERIC_CHECK); ?>;
      dataLisensi = <?php echo json_encode($lisensi, JSON_NUMERIC_CHECK); ?>;
      //dataSDM = <?php //echo json_encode($sertifikat_sdm, JSON_NUMERIC_CHECK); ?>;

      highchartsPertanahan = createChartSertifikat('highchartsPertanahan', 'Data Pertanahan', dataPertanahan);
      highchartsSLO = createChartSertifikat('highchartsSLO', 'Data SLO', dataSLO);
      highchartsPerizinan = createChartSertifikat('highchartsPerizinan', 'Data Perizinan', dataPerizinan);
      highchartsPengujian = createChartSertifikat('highchartsPengujian', 'Data Pengujian Alat K3', dataPengujian);
      highchartsLisensi = createChartSertifikat('highchartsLisensi', 'Data Lisensi', dataLisensi);

    })

    $('#distrik').change(function() {
      var id_distrik = $('#distrik').val();
      console.log("<?php echo site_url('dashboard/ajax_get_dashboard_distrik_by_id'); ?>/" + id_distrik);

      $.ajax(
      {
        url: "<?php echo site_url('dashboard/ajax_get_dashboard_distrik_by_id'); ?>/"+id_distrik,
        method: "GET"
      })
      .done(function(chart_data)
      {
        console.log("BERHASIL MASUK");
        updateChart(chart_data);
      })
      .fail(function( jqXHR, textStatus, errorThrown) {
        console.log("GAGAL MASUK");
        alert("Request failed : " + textStatus + "\n" + errorThrown);
      });

    })
    
  })
</script>
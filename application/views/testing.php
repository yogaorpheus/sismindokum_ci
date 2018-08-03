<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Status
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data</a></li>
        <li class="active">Status</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<?php
    $dataPoints = array(
        array("y" => 72.48, "legendText" => "Google", "name" => "Google"),
        array("y" => 10.39, "legendText" => "Bing", "name" => "Bing"),
        array("y" => 7.78, "legendText" => "Yahoo!", "name" => "Yahoo!"),
        array("y" => 7.14, "legendText" => "Baidu", "name" => "Baidu"),
        array("y" => 0.22, "legendText" => "Ask", "name" => "Ask"),
        array("y" => 0.15, "legendText" => "AOL", "name" => "AOL"),
        array("y" => 1.84, "legendText" => "Others", "name" => "Others")
    );
?>
      <div class="row">
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div>
            <!-- /.box-header -->
            <div id="box-body">
              <div id="container" style="height: 400px; width: 100%;"></div>
              <div class="row">
                <hr>
                <div class="col-xs-3"><p>TEST</p></div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <?php
          $data = array();
          foreach ($sdm as $key => $one_sdm) {
            $data[] = $one_sdm;
          }
          $data = json_encode($data);
          print_r($data);
          ?>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <script type="text/javascript">
      Highcharts.chart('container', {
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },
          title: {
              text: 'Browser market shares in January, 2018'
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
                      format: '<b>{point.name}</b>: <b>{point.y}</b><br>({point.percentage:.1f} %)',
                      style: {
                          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                      }
                  }
              }
          },
          series: [{
              name: 'Brands',
              colorByPoint: true,
              data: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
          }]
      });
    </script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
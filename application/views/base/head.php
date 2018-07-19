  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>PJB - SISMINDOKUM</title>
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/dist/css/skins/_all-skins.min.css">
  <?php if ($head == 'dashboard2') { ?>
    <!-- <title> DASHBOARD </title> -->
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <?php } else if ($head == 'form' || $head == 'remark') { ?>
    <!-- <title> FORM PJB </title> -->
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <!-- Bootstrap Validator -->
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap_validator'); ?> /css/bootstrapValidator.css"> -->
  <?php } else if ($head == 'data' || $head == 'data_lama') { ?>
    <!-- <title> DATATABLES </title> -->
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url('assets/adminlte'); ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <?php } ?>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/adminlte'); ?>/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url('assets/adminlte'); ?>/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url('assets/adminlte'); ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
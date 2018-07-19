<!-- date-range-picker -->
<script src="<?php echo base_url('assets/adminlte'); ?>/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url('assets/adminlte'); ?>/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url('assets/adminlte'); ?>/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/adminlte'); ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('assets/adminlte'); ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/adminlte'); ?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/adminlte'); ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/adminlte'); ?>/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/adminlte'); ?>/dist/js/demo.js"></script>
<?php if ($head == 'dashboard2') { ?>
	<!-- Morris.js charts -->
	<script src="<?php echo base_url('assets/adminlte'); ?>/bower_components/raphael/raphael.min.js"></script>
	<script src="<?php echo base_url('assets/adminlte'); ?>/bower_components/morris.js/morris.min.js"></script>
	<!-- Sparkline -->
	<script src="<?php echo base_url('assets/adminlte'); ?>/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
	<!-- jvectormap -->
	<script src="<?php echo base_url('assets/adminlte'); ?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo base_url('assets/adminlte'); ?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="<?php echo base_url('assets/adminlte'); ?>/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<?php } else if ($head == 'form' || $head == 'remark') { ?>
	<!-- Select2 -->
	<script src="<?php echo base_url('assets/adminlte'); ?>/bower_components/select2/dist/js/select2.full.min.js"></script>
	<!-- InputMask -->
	<script src="<?php echo base_url('assets/adminlte'); ?>/plugins/input-mask/jquery.inputmask.js"></script>
	<script src="<?php echo base_url('assets/adminlte'); ?>/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="<?php echo base_url('assets/adminlte'); ?>/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<!-- bootstrap time picker -->
	<script src="<?php echo base_url('assets/adminlte'); ?>/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<!-- iCheck 1.0.1 -->
	<script src="<?php echo base_url('assets/adminlte'); ?>/plugins/iCheck/icheck.min.js"></script>
	<!-- Bootstrap Validator -->
	<!-- <script src="<?php echo base_url('assets/bootstrap_validator'); ?>/js/bootstrapValidator.min.js"></script> -->
<?php } else if ($head == 'data' || $head == 'data_lama') { ?>
	<!-- DataTables -->
	<script src="<?php echo base_url('assets/adminlte'); ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url('assets/adminlte'); ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<?php } ?>
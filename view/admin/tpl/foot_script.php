<?php

use App\c\admin\SysCon;

?>
<!-- jQuery UI 1.11.4 -->
<script src="<?= QN_HOST ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>$.widget.bridge('uibutton', $.ui.button);</script>
<!-- Bootstrap 4 -->
<script src="<?= QN_HOST ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?= QN_HOST ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?= QN_HOST ?>/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- ChartJS -->
<script src="<?= QN_HOST ?>/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= QN_HOST ?>/plugins/sparklines/sparkline.js"></script>

<!-- JQVMap -->
<script src="<?= QN_HOST ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= QN_HOST ?>/plugins/jqvmap/maps/jquery.vmap.world.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= QN_HOST ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= QN_HOST ?>/plugins/moment/moment.min.js"></script>
<script src="<?= QN_HOST ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= QN_HOST ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= QN_HOST ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= QN_HOST ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= QN_HOST ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= QN_HOST ?>/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= QN_HOST ?>/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= QN_HOST ?>/dist/js/demo.js"></script>
<script>var upload_url = "<?=SysCon::UPLOAD?>";</script>
<script src="/js/admin.js"></script>


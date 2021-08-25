
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Sarvika</b>Insider
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<!-- Bootstrap 4 -->
<script src="<?php echo $this->config->item('assetspath')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo $this->config->item('assetspath')?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $this->config->item('assetspath')?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $this->config->item('assetspath')?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $this->config->item('assetspath')?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $this->config->item('assetspath')?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo $this->config->item('assetspath')?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo $this->config->item('assetspath')?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo $this->config->item('assetspath')?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo $this->config->item('assetspath')?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo $this->config->item('assetspath')?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo $this->config->item('assetspath')?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo $this->config->item('assetspath')?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/gh/GedMarc/bootstrap4-dialog/dist/js/bootstrap-dialog.js"></script>
<script src="<?php echo $this->config->item('assetspath')?>js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $this->config->item('assetspath')?>js/demo.js"></script>

<script src="<?php echo $this->config->item('assetspath')?>js/jquery.form.js"></script>
<script src="<?php echo $this->config->item('assetspath')?>js/formclass.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>

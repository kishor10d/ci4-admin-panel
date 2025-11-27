<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<!-- jQuery -->
<script src="<?= base_url() ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/adminlte/plugins/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>assets/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<?php if (!empty($plugin) && in_array('dataTables', $plugin)) { ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<?php } ?>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/adminlte/lte/js/adminlte.js"></script>
<script type="text/javascript">
    var windowURL = window.location.href;
    pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
    var x= $('a[href="'+pageURL+'"]');
        x.addClass('active');
        x.parent().addClass('active');
    var y= $('a[href="'+windowURL+'"]');
        y.addClass('active');
        y.parent().addClass('active');
</script>
<?php if (!empty($plugin) && in_array('dataTables', $plugin)) { ?>
<script>
  $(function () {
    $("#userList").DataTable({
      responsive: true, lengthChange: false, autoWidth: false,
      info: true, ordering: true, paging: true, pageLength: 5,
      processing: true,
      serverSide: true,
      stateSave: true,
      ajax: {
        url: '/fetchUsers'
      },
      columnDefs: [
        {
            data: null,
            defaultContent: '<a class="btn btn-sm btn-info" href="<?=site_url("users/edit/") ?>">'
            + '<i class="fa fa-pencil-alt" aria-hidden="true"></i></a>&nbsp;'
            + '<button class="btn btn-sm btn-warning"><i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;'
            + '<button class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>',
            targets: -1
        }
      ]
    }).buttons().container().appendTo('#userList_wrapper .col-md-6:eq(0)');
  });
</script>
<?php } ?>
</body>
</html>
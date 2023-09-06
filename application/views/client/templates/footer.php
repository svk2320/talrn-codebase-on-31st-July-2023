<footer class="main-footer">
        &copy;
    <?php echo date('Y'); ?> Talrn, Our goal is find & onboard the right talent fast. <a href="https://blog.talrn.com/talrn-release-notes-jul-2023/" target="_blank"
        rel="noopener noreferrer"></a> <a href="mailto:hello@talrn.com" target="_blank"
        rel="noopener noreferrer">Facing Problems? Get Support</a>
    </div>

    <div style="display:none" id="baseurl" name="baseurl" value="<?= base_url() ?>" />


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script
        src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/chart.js/Chart.min.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script
        src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
        </script>
    <!-- maggic suggest -->
    <link href="<?php echo base_url() ?>/assets/magicsuggest/magicsuggest-v1-1.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>/assets/magicsuggest/magicsuggest.js"></script>

    <!-- overlayScrollbars -->
    <script
        src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js">
        </script>
    <script
        src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js">
        </script>
    <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/sweetalert2/sweetalert2.all.min.js"></script>

    <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script
        src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script
        src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script
        src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script
        src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script
        src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script
        src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script
        src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script
        src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>dist/js/adminlte.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url('assets/'); ?>Jvectormap/jquery-jvectormap-2.0.5.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>Jvectormap/jquery-jvectormap-world-mill.js"></script>
    <!-- jQuery Knob Chart -->

    <!-- jquiry plugin for autoComplete -->
    <script
        src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>
    <!--  jquiry plugin for datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
        rel="stylesheet" />

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- javascript import for upload-profile -->
    <script src="<?php echo (isset($js)) ? $js : "" ?>"></script>
    <script>
        $(function () {
            $('#reportrange').daterangepicker({
                opens: 'left'
            }, function (start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            // Close button click event
            $('#alert-close').click(function () {
                $(this).closest('.alert').hide();

                // Set the alert cookie with an expiration time (e.g., 24 hours)
                document.cookie = 'alert_displayed=true; expires=' + new Date(Date.now() + (24 * 60 * 60 * 1000)).toUTCString() + '; path=/';
            });
        });

    </script>

    </body>

    </html>

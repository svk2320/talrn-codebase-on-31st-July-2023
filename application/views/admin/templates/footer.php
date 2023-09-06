<footer class="main-footer">
    &copy;
    <?php echo date('Y'); ?> Talrn <a href="https://blog.talrn.com/talrn-release-notes-jul-2023/" target="_blank" rel="noopener noreferrer">(July 2023 Version - Sushi Fusion Release Notes)</a>
        Our goal is to match you with the best work faster & simplified. <a href="mailto:hello@talrn.com" target="_blank"
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
    <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
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
    <script>
        $(function () {
            'use strict'

            // World map by jvectormap
            $('#world-map').vectorMap({
                map: 'world_mill',
                backgroundColor: 'transparent',
                series: {
                    regions: [
                        {
                            values: profile_location_data,
                            scale: ['#C8EEFF', '#0071A4'],
                            normalizeFunction: 'polynomial'
                        }

                    ]
                },
                onRegionTipShow: function (e, el, code) {
                    el.html(el.html() + '(' + profile_location_data[code] + ')');
                }
            });
        })
    </script>

    <!-- OpenReplay Tracking Code for my first project -->
    <script>
        var initOpts = {
            projectKey: "BVNUm6TX42AHgwyoeqHK",
            defaultInputMode: 0,
            obscureTextNumbers: false,
            obscureTextEmails: false,
        };
        var startOpts = { userID: "" };
        (function (A, s, a, y, e, r) {
            r = window.OpenReplay = [e, r, y, [s - 1, e]];
            s = document.createElement('script'); s.src = A; s.async = !a;
            document.getElementsByTagName('head')[0].appendChild(s);
            r.start = function (v) { r.push([0]) };
            r.stop = function (v) { r.push([1]) };
            r.setUserID = function (id) { r.push([2, id]) };
            r.setUserAnonymousID = function (id) { r.push([3, id]) };
            r.setMetadata = function (k, v) { r.push([4, k, v]) };
            r.event = function (k, p, i) { r.push([5, k, p, i]) };
            r.issue = function (k, p) { r.push([6, k, p]) };
            r.isActive = function () { return false };
            r.getSessionToken = function () { };
        })("//static.openreplay.com/latest/openreplay.js", 1, 0, initOpts, startOpts);
    </script>

    </body>

    </html>

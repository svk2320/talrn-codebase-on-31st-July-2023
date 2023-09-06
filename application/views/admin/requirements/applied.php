
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row pb-2">
                <div class="col-sm-6" style="display:flex">
                    <h1 class="m-0 text-dark">Applied list</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/requirements') ?>">Requirements</a></li>
                        <li class="breadcrumb-item active">Applied list</li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12 col-xs-12">

                <!-- /.box -->
            </div>
            <!-- col-md-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- <div class="card-header">
        <h3 class="card-title">Manage Profiles</h3>


      </div> -->
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">

                        <table id="userTable" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Application Date</th>
                                    <th>Unique ID</th>
                                    <th>Name</th>
                                    <th>Job title</th>
                                    <th>Exp</th>
                                    <th>Min</th>
                                    <th>Max</th>
                                    <th>Match %</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="table">
                                <?php if (isset($list)) { ?>
                                    <?php foreach ($list as $k => $v): ?>
                                        <tr>
                                            <td>
                                                <?php echo $v['date']; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url("profile/") . urlencode($v['unique_id']) ?>" target="_blank" data-toggle="tooltip" title="View Applicant">
                                                <?php echo $v['unique_id']; ?>
                                                <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo $v['last_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $v['primary_title']; ?>
                                            </td>
                                            <td>
                                                <?php echo $v['experience']; ?>
                                            </td>
                                            <td>
                                            <?php
                                                if ($v['currency'] === 'USD') {
                                                    echo '$';
                                                } elseif ($v['currency'] === 'INR') {
                                                    echo '₹';
                                                }
                                                echo $v['ppm_min']; ?>
                                            </td>
                                            <td>
                                            <?php
                                                if ($v['currency'] === 'USD') {
                                                    echo '$';
                                                } elseif ($v['currency'] === 'INR') {
                                                    echo '₹';
                                                }
                                                echo $v['ppm_max']; ?>
                                            </td>
                                            <td>
                                                <p data-toggle="popover" data-trigger="hover" data-placement="top" data-html="true" data-content="Based only on tech skills section<br>Review full profile">
                                                    <?php echo round($v['match_percentage']) .'% Tech Skills Match'; ?>
                                                </p>
                                            </td>
                                            <td>
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="statusDropdown_<?php echo $v['unique_id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?php echo $v['status']; ?>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="statusDropdown_<?php echo $v['unique_id']; ?>">
                                                <a class="dropdown-item" href="#" data-status="Pending Review" data-id="<?php echo $v['unique_id']; ?>" data-jd-id="<?php echo $jd_id; ?>">Pending Review</a>
                                                <a class="dropdown-item" href="#" data-status="Reviewed" data-id="<?php echo $v['unique_id']; ?>" data-jd-id="<?php echo $jd_id; ?>">Reviewed</a>
                                                <a class="dropdown-item" href="#" data-status="Shortlisted" data-id="<?php echo $v['unique_id']; ?>" data-jd-id="<?php echo $jd_id; ?>">Shortlisted</a>
                                                <a class="dropdown-item" href="#" data-status="Interview Scheduled" data-id="<?php echo $v['unique_id']; ?>" data-jd-id="<?php echo $jd_id; ?>">Interview Scheduled</a>
                                                <a class="dropdown-item" href="#" data-status="Rejected" data-id="<?php echo $v['unique_id']; ?>" data-jd-id="<?php echo $jd_id; ?>">Rejected</a>
                                                <a class="dropdown-item" href="#" data-status="Selected" data-id="<?php echo $v['unique_id']; ?>" data-jd-id="<?php echo $jd_id; ?>">Selected</a>
                                                </div>
                                            </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script type="text/javascript">
    $(document).ready(function () {
        $("#requirementlist").addClass('active');
        $('#userTable').DataTable({
            order: [],
            // responsive: true,
            bAutoWidth: false,
            "dom": '<"pull-left"f><"pull-right"l>tip',
            language: {
                "zeroRecords": "Not yet applied!"
            }
        });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger : 'hover'
            });
        });
        $('.dropdown-item').on('click', function(e) {
            e.preventDefault();
            var status = $(this).data('status');
            var id = $(this).data('id');
            var jd_id = $(this).data('jd-id');
            
            // AJAX request to update the status using a controller
            $.ajax({
            url: '<?php echo base_url('admin/requirements/change_applicant_status') ?>',
            type: 'POST',
            data: {
                status: status,
                id: id,
                jd_id: jd_id
            },
            success: function(response) {
                $('#statusDropdown_' + id).text(status);
        
                // Handle the response from the controller if needed
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle the error if the AJAX request fails
                console.log(xhr.responseText);
            }
            });
        });
    });


</script>

<script>
    function initializePopovers() {
        $(function() {
            $('[data-toggle="popover"]').popover({
                trigger: 'manual', // Initialize the popover with 'manual' trigger
                template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
            }).on('mouseenter', function() {
                var _this = this;
                $(this).popover('show');
                $('.popover').on('mouseleave', function() {
                    $(_this).popover('hide');
                });
            }).on('mouseleave', function() {
                var _this = this;
                setTimeout(function() {
                    if (!$('.popover:hover').length) {
                        $(_this).popover('hide');
                    }
                }, 100);
            });
        });
    }

    initializePopovers();
</script>
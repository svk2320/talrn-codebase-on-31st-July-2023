<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row pb-2">
                <div class="col-sm-6" style="display:flex">
                    <h1 class="m-0 text-dark">Requirement list</h1>
                    <a href="<?php echo base_url('admin/requirements/create') ?>" class="btn btn-primary"
                        style="margin-left:30px;">Create requirement</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Requirement list</li>
                    </ol>
                </div>
            </div><!-- /.row -->
            <?php if (isset($message)) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <?php echo $message; ?>
                </div>
            <?php } ?>
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
                                    <th>JD Date</th>
                                    <th>JD ID</th>
                                    <th>Job title</th>
                                    <th>Skills</th>
                                    <th>Location</th>
                                    <th>Exp(yrs)</th>
                                    <th>Applicants</th>
                                    <th>Status</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody class="table">
                                <?php if (isset($list)) { ?>
                                    <?php foreach ($list as $k => $v): ?>
                                        <tr>
                                            <td>
                                                <?php echo $v['creation_date']; ?>
                                            </td>
                                            <td>
                                            <a href="<?php echo base_url("job/") . urlencode($v['url']) ?>" class="job-link"  target="_blank" data-toggle="tooltip" title="View Job">
                                                <?php echo $v['jd_id']; ?>
                                                <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo $v['job_title']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $technical_skills = $v['technical_skills'];
                                                if (strlen($technical_skills) > 50) {
                                                    $technical_skills = substr($technical_skills, 0, 50) . '...';
                                                }
                                                echo $technical_skills;
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $v['location']; ?>
                                            </td>
                                           
                                            <td>
                                                <?php echo $v['experience']; ?>
                                            </td>
                                            <td>
                                            <a href="<?php echo base_url("admin/requirements/applied/") . urlencode($v['jd_id']) ?>" target="_blank" data-toggle="tooltip" title="View Applicants">
                                                <?php echo $v['pending_count'] . " Pending / " .$v['total_count'] ." Total"; ?>
                                                <i class="fas fa-external-link-alt"></i>
                                                </a>
                                                
                                            </td>
                                            <td>
                                                <?php if ($v['status'] === '1') {
                                                    echo '<span class="text-green">Active</span>';
                                                }
                                                if ($v['status'] === '0') {
                                                    echo '<span class="text-red">Inactive</span>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-nowrap">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="actionsDropdown_<?php echo $v['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?php if ($v['status'] === '1') { echo 'Active'; } if ($v['status'] === '0') { echo 'Inactive'; } ?>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="actionsDropdown_<?php echo $v['id']; ?>">
                                                <a class="dropdown-item" href="<?php echo base_url("job/") . urlencode($v['url']) ?>" target="_blank"><i class="fa fa-eye"></i> View Job</a>
                                                <?php if($v['approval'] === '0') {?>
                                                    <a class="dropdown-item" href="<?php echo base_url("admin/requirements/approve/") . $v['id'] ?>"><i class="fa fa-thumbs-up"></i> Approve</a>
                                                <?php } ?>
                                                <a class="dropdown-item" href="<?php echo base_url("admin/requirements/edit/") . $v['id'] ?>"><i class="fa fa-edit"></i> Edit</a>
                                                <a class="dropdown-item" href="<?php echo base_url("admin/requirements/change_status/") . $v['id'] ?>" >
                                                    <i class="<?php if ($v['status'] === '1') { echo 'fa fa-toggle-on'; } if ($v['status'] === '0') { echo 'fa fa-toggle-off'; } ?>"></i> Change Status to <?php if ($v['status'] === '1') { echo 'Inactive'; } if ($v['status'] === '0') { echo 'Active'; } ?>
                                                </a>
                                                <a class="dropdown-item" href="<?php echo base_url("admin/requirements/delete/") . $v['id'] ?>"><i class="fa fa-trash"></i> Delete</a>
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
            order: [[7, 'asc'], [0, 'desc']],
            responsive: true,
            bAutoWidth: false,
            "dom": '<"pull-left"f><"pull-right"l>tip',
            language: {
                "zeroRecords": "Please create your requirements and it will start appearing here!"
            }
        });
        history.pushState({}, null, '<?= base_url('admin/requirements') ?>');
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger : 'hover'
            });
        });

    });


</script>
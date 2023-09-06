<?php
// print_r($links);
// exit;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6" style="display:flex">
                    <h1 class="m-0 text-dark">Announcement</h1>
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">announcement</li>
                    </ol>
                </div><!-- /.col -->
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
        
        <div class="container-fluid">
                            <div class="row">
                                <!-- Left section for the first card -->
                                <div class="col-md-6">
                                    <!-- Card 1 -->
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Link 1 goes here -->
                                            <a href="<?= base_url('admin/announcements/sticky_header') ?>">Sticky Header Announcement</a>
                                        </div>
                                    </div>
                                </div>
        
                                <!-- Right section for the second card -->
                                <div class="col-md-6">
                                    <!-- Card 2 -->
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Link 2 goes here -->
                                            <a href="<?= base_url('admin/announcements/pop_up') ?>">Pop up Announcement</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
      
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<style>
    .pull-left {
        float: left !important;
    }

    .pull-right {
        float: right !important;
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        $("#announcements").addClass('active');
    });
</script>

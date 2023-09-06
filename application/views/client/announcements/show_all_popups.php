<?php
// print_r($links);
// exit;
?>

<link media="all" rel="stylesheet" href="<?php echo base_url() . $this->config->item('css') . 'show-all-popups.css' ?>">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6" style="display:flex">
                    <h1 class="m-0 text-dark">All Popup Announcements</h1>
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">All Popup Announcements</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <?php if ($list): ?>
                <?php for ($i = 0; $i < count($list); $i++) { ?>
                    <div class="white-box">
                        <div>
                            <pre class="pre">
<?php echo $list[$i]['title']; ?>
                            </pre>
                            <div class="create-date">
                                Created at: <?php echo date('Y-m-d', strtotime($list[$i]['created_at'])); ?>
                            </div>
                            <pre class="pre">
<?php echo $list[$i]['text']; ?>
                            </pre>
                        </div>
                    </div>
                <?php } ?>
            <?php else: ?>
                <div class="white-box">
                    <div>
                        No pop-ups created.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script type="text/javascript">
    $(document).ready(function () {
        $("#showAllPopups").addClass('active');
    });
</script>

<?php
// print_r($links);
// exit;
?>

<style>
/* Custom CSS for the white box with shadow */
.white-box {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adjust the shadow values as needed */
  margin: 20px;
  width: 100%;
  position: relative;
}

/* The following CSS rule is not closed properly */
.pre {
    font: inherit;
    text-align: left;
    /*white-space: pre-wrap;*/
}

.create-date {
    position: absolute;
    right: 2%;
    top: 1%;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6" style="display:flex">
                    <h1 class="m-0 text-dark">All Popup Announcements of Organisation</h1>
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">All Popup Announcements of Organisation</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <?php if ($organisation): ?>
                <?php for ($i = 0; $i < count($organisation); $i++) { ?>
                    <div class="white-box">
                        <div>
                            <pre class="pre">
<?php echo $organisation[$i]['title']; ?>
                            </pre>
                            <span class="create-date">
                                Created at: <?php echo date('Y-m-d', strtotime($organisation[$i]['created_at'])); ?>
                            </span>
                            <pre class="pre">
<?php echo $organisation[$i]['text']; ?>
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

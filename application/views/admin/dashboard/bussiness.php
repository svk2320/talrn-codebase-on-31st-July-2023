<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Welcome to Talrn</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
  <?php if(isset($verify_msg)){ ?>
    <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $verify_msg ?>
            </div>  
  <?php } ?>

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Talrn bussiness</h3>
      </div>
      <div class="card-body">
        <form action="<?php echo base_url('admin/dashboard/bussinessform') ?>" method="post">
          <div class="form-group row">
            <label for="name" class="col-2 col-form-label">Name :</label>
            <div class="col-4">
              <input id="name" name="name" type="text" class="form-control" required="required" value="<?=$user_data['firstname']." ".$user_data['lastname'] ?>">
            </div>
            <div class="col-6"></div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-2 col-form-label">Email :</label>
            <div class="col-4">
              <input id="email" name="email" type="text" required="required" class="form-control" value="<?=$user_data['email'] ?>">
            </div>
            <div class="col-6"></div>
          </div>
          <div class="form-group row">
            <label for="number" class="col-2 col-form-label">Number :</label>
            <div class="col-4">
              <input id="number" name="number" type="number" class="form-control" required="required" value="<?=$user_data['phone'] ?>">
            </div>
            <div class="col-6"></div>
          </div>
          <div class="form-group row">
            <div class="offset-2 col-8">
              <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
      <!-- /.card-body -->
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function () {
    $("#mainNav").addClass('active');
  });
</script>
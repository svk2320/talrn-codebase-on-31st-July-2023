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
          <h1 class="m-0 text-dark">My Account 
            <!-- <a href="<?php echo base_url('client/users/setting'); ?>"
              style="margin-left:30px" class="btn btn-primary">Edit Account</a> -->
            </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/clients'); ?>">Manage Clients</a></li>
            <li class="breadcrumb-item active">Account</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div class="card">
          <div class="card-header">
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-condensed table-hovered">
              <tr>
                  <th>Name</th>
                  <td>
                    <?php echo $client_data['name']; ?>
                  </td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td>
                    <?php echo $client_data['email']; ?>
                  </td>
                </tr>
                <tr>
                  <th>Job Title</th>
                  <td>
                    <?php echo $client_data['job_title']; ?>
                  </td>
                </tr>
                <tr>
                  <th>Company</th>
                  <td>
                    <?php echo $client_data['company']; ?>
                  </td>
                </tr>
                <tr>
                  <th>Phone</th>
                  <td>
                    <?php echo $client_data['phone']; ?>
                  </td>
                </tr>
                <tr>
                  <th>Client ID</th>
                  <td>
                    <?php echo $client_data['unique_id']; ?>
                  </td>
                </tr>
                
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function () {
    $("#profileMainNav").addClass('active');
  });
</script>

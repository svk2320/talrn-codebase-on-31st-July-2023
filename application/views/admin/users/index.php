<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6" style="display:flex">
          <h1 class="m-0 text-dark">Manage Users</h1>

          <?php if (false): ?>
            <a href="<?php echo base_url('admin/users/create') ?>" class="btn btn-primary" style="margin-left:30px;">Add
              User</a>
          <?php endif; ?>

        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div><!-- /.col -->
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
          <div class="card-header">
            <h3 class="card-title">Manage Users</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
          <div class="table-responsive">
            <table id="userTable" class="table table-bordered table-hove">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Group</th>

                  <?php if (in_array('modifyUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                    <th>Action</th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody class="table">
                
              </tbody>
            </table>
          </div>
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
    $("#li-users").addClass('menu-open');
    $("#link-users").addClass('active');
    $("#manage-users").addClass('active');
  });
</script>

<script type="text/javascript">
    $(document).ready(function() {
    
    $('#userTable').DataTable({
          order: [],
          responsive: true,
          autoWidth: false,
          ajax: '<?=base_url()?>' + 'admin/users/fetchManageUsers',
          dom: '<"pull-left"f><"pull-right"l>tip',
          language: {
            "zeroRecords": "You have not applied for any jobs yet" 
          }
        });
    });
</script>

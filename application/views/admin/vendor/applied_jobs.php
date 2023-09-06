<?php // print_r($links); exit; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6" style="display:flex">
          <h1 class="m-0 text-dark">Applied Jobs</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Applied Jobs</li>
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
          
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            
            <table id="userTable" class="table table-hover text-nowrap" >
              <thead>
                <tr>
                  <th data-priority="1">JD ID</th>
                  <th data-priority="2">Applied Date</th>
                  <th data-priority="2">Job Title</th>
                  <th data-priority="4">Unique ID</th>
                  <th data-priority="4">Name</th>
                  <th data-priority="3">Action</th>
                </tr>
              </thead>
              <tbody class="table">
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
  $(document).ready(function() {
  $("#jobslist").addClass('active');

  $('#userTable').DataTable({
    order: [],
    responsive: true,
    autoWidth: false,
    ajax: '<?=base_url()?>' + 'admin/vendor/fetchAppliedJobs',
    dom: '<"pull-left"f><"pull-right"l>tip',
    language: {
      "zeroRecords": "You have not applied for any jobs yet" 
    }
  });

  history.pushState({}, null, '<?= base_url('admin/vendor/applied_jobs') ?>');
});

</script>


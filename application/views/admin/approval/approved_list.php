<?php // print_r($links); exit; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6" style="display:flex">
          <h1 class="m-0 text-dark">Approved Profiles</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?= base_url('admin/approval') ?>">Approval</a></li>
            <li class="breadcrumb-item active">Approved</li>
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

    <div class="row">
      <div class="col-12">
        <div class="card">
          
          <div class="card-body table-responsive">

            <table id="userTable" class="table table-hover table-bordered">
              <thead>
                <tr>
                <th>Date</th>
                  <th>Unique ID</th>
                  <th>Name</th>
                  <th>Job title</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="table">
                <?php if (isset($list)) { ?>
                  <?php foreach ($list as $k => $v): ?>
                    <tr>
                      <td>
                        <?php echo $v['last_modified']; ?>
                      </td>
                      <td>
                        <?php echo $v['unique_id']; ?>
                      </td>
                      <td>
                        <?php echo $v['last_name'] . " " . $v['first_name'][0]; ?>
                      </td>
                      <td>
                        <?php echo $v['primary_title']; ?>
                      </td>
                      
                      <td>
                      <?php if ($v['approval'] === '1'){
                            echo '<span class="text-green">Approved</span>';}
                        if($v['approval'] === '0'){
                            echo '<span class="text-blue">Pending</span>';} 
                        if($v['approval'] === '2'){
                        echo '<span class="text-red">Awaiting changes</span>';}
                        if($v['approval'] === '3'){
                          echo '<span class="text-red">Rejected</span>';}  ?>
                      </td>
                      <td class="text-nowrap">
                        <a href="<?php echo base_url('admin/approval/viewprofile/' . strtolower($v['unique_id'])) ?>"
                          class="btn btn-default" ><i class="fa fa-eye"></i></a>
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
    $("#approval").addClass('active');
    $('#userTable').DataTable({
      order: [],
      responsive:true,
      "autoWidth": false,
      "dom": '<"pull-left"f><"pull-right"l>tip',
      language: {
        "zeroRecords": "No pending approvals"
      }
    });
    history.pushState({}, null, '<?= base_url('admin/approval/approved') ?>');

  });


</script>
<?php // print_r($links); exit; ?>
<!-- Content Wrapper. Contains page content -->

<?php if($_SESSION['verified']==0){ 

$user_data = $this->model_users->getUserData($_SESSION['id']); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Custom URL</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Custom URL</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                This is a premium feature that helps customize your profile URL so it's easy to find & share your profile.<br><br>
                
                Get your unique URL before someone else does!<br>
                <a href="#">https://talrn.com/profile/<?php echo $user_data['lastname'];?> </a><br><br>
                
                To start using custom URLs<a href="<?= base_url('admin/verified') ?>">&nbsp Get verified now</a>
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
    
<?php } else { ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6" style="display:flex">
          <h1 class="m-0 text-dark">My Verified Profiles</h1>
          
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Custom URL</li>
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
      <!-- <div class="card-header">
        <h3 class="card-title">Manage Profiles</h3>


      </div> -->
      <!-- /.card-header -->
      <div class="card-body table-responsive">
        
        <table id="userTable" class="table table-hover text-nowrap" >
          <thead>
            <tr>
              <th data-priority="1">Unique ID</th>
              <th data-priority="4">Name</th>
              <th data-priority="6">Company</th>
              <th data-priority="5">Status</th>
              <th data-priority="3">Custom URL</th>
              <th data-priority="2">Action</th>
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

<?php } ?>

<script type="text/javascript">
  $(document).ready(function() {
  $("#customurl").addClass('active');

  $('#userTable').DataTable({
    order: [],
    responsive: true,
    autoWidth: false,
    ajax: '<?=base_url()?>' + 'admin/verified/fetchVerifiedProfilesDatabyVendor',
    dom: '<"pull-left"f><"pull-right"l>tip',
    language: {
      "zeroRecords": "No verified profiles!" 
    }
  });

  history.pushState({}, null, '<?= base_url('admin/verified/customurl') ?>');
});


</script>


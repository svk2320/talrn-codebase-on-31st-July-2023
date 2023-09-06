<?php // print_r($links); exit; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6" style="display:flex">
          <h1 class="m-0 text-dark">Manage Profiles</h1>
            <?php if (in_array('modifyUser', $user_permission)): ?>
            <a href="<?php echo base_url('admin/vendor') ?>" class="btn btn-primary" style="margin-left:30px;">Add Profile</a>
            <?php endif; ?>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Profiles</li>
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
              <th data-priority="3">Name</th>
              <th data-priority="13">Country</th>
              <th data-priority="12">City</th>
              <th data-priority="10">Type</th>
              <th data-priority="6">Job title</th>
              <th data-priority="7">Experience</th>
              <th data-priority="8">Max monthly rate </th>
              <th data-priority="11">Availibility</th>
              <th data-priority="9">Notice period</th>
              <th data-priority="5">Active</th>
              <th data-priority="4">Status</th>
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

<script type="text/javascript">
  $(document).ready(function() {
  $("#profilelist").addClass('active');

  $('#userTable').DataTable({
    order: [],
    responsive: true,
    autoWidth: false,
    ajax: '<?=base_url()?>' + 'admin/Profile/fetchProfilesData',
    dom: '<"pull-left"f><"pull-right"l>tip',
    language: {
      "zeroRecords": "No profiles upload, please upload your profile to get started!" 
    }
  });

  history.pushState({}, null, '<?= base_url('admin/vendor/list') ?>');
});


</script>

<script>
    function openCustomModal(title, text, okButton, closeButton, saveChanges, deleteButton, aTagForOkay, aTagForDelete) {
        CustomModal = `
            <!-- Modal -->
            <div class="modal fade" id="openCustomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">${title}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    ${text}
                  </div>
                  <div class="modal-footer">
                    ${closeButton ? '<button type="button" class="btn btn-secondary"} data-dismiss="modal">Close</button>' : ""}
                    ${saveChanges ? '<button type="button" class="btn btn-primary" onclick="return removeVenFunc()">Save changes</button>': ''}
                    ${okButton ? `<button type="button" class="btn btn-primary" ${aTagForOkay ? "" : `data-dismiss="modal"`}>${aTagForOkay ? `<a href=${aTagForOkay} style="color:white;">` : ""}Okay${aTagForOkay ? "</a>" : ""}</button>` : ""}
                    ${deleteButton ? `<button type="button" class="btn btn-primary">${aTagForDelete ? `<a href=${aTagForDelete} style="color:white;">` : ""}Delete${aTagForDelete ? "</a>" : ""}</button>` : ""}
                  </div>
                </div>
              </div>
            </div>
        `;

        // Append the modal HTML code to the body
        $('body').append(CustomModal);

        var modalElement = $('#openCustomModal');

        modalElement.on('hidden.bs.modal', function () {
           // Remove the modal element from the DOM
           modalElement.remove();
        });

        $('#openCustomModal').modal('show');
      }
</script>

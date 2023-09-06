<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Manage Vendors</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a></li>
            <li class="breadcrumb-item active">Vendors</li>
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

        <div id="messages"></div>

        <?php if (in_array('modifyVendor', $user_permission)): ?>
          <!--<button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Vendors</button>-->
          <!--<br /> <br />-->
        <?php endif; ?>


        <div class="card">

          <div class="card-body">
            <div class="table-responsive">
              <table id="manageTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                     <th>Date</th>
                    <th>Vendor name</th>
                    <th>Type</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>Profiles</th>
                    
                    <?php if (in_array('modifyVendor', $user_permission) || in_array('deleteStore', $user_permission)): ?>
                      <th>Action</th>
                    <?php endif; ?>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
  var manageTable;
  var base_url = "<?php echo base_url(); ?>";


  $(document).ready(function () {
    $('#storesMainNav').addClass('active');
    // initialize the datatable
    manageTable = $('#manageTable').DataTable({
      'ajax': base_url + 'admin/stores/fetchCategoryData',
      'order': []
    });
  });

</script>


<?php if (in_array('modifyVendor', $user_permission)): ?>
  <!-- create brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Vendor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
        </div>

        <form role="form" action="<?php echo base_url('admin/stores/create') ?>" method="post" id="createForm">

          <div class="modal-body">

            <div class="form-group">
              <label for="brand_name">Vendor Name</label>
              <input type="text" class="form-control" id="store_name" name="store_name" placeholder="Enter Vendor name"
                autocomplete="off">
            </div>

            <div class="form-group">
              <label for="active">Status</label>
              <select class="form-control" id="active" name="active">
                <option value="1">Active</option>
                <option value="2">Inactive</option>
              </select>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>

        </form>


      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php endif; ?>

<?php if (in_array('modifyVendor', $user_permission)): ?>
  <!-- edit brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Vendor</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
        </div>

        <form role="form" action="<?php echo base_url('stores/update') ?>" method="post" id="updateForm">

          <div class="modal-body">
            <div id="messages"></div>

            <div class="form-group">
              <label for="brand_name">Vendor Name</label>
              <input type="text" class="form-control" id="edit_store_name" name="edit_store_name" placeholder="Enter Vendor
             name" autocomplete="off">
            </div>

            <div class="form-group">
              <label for="active">Status</label>
              <select class="form-control" id="edit_active" name="edit_active">
                <option value="1">Active</option>
                <option value="2">Inactive</option>
              </select>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>

        </form>


      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php endif; ?>

<?php if (in_array('deleteVendor', $user_permission)): ?>
  <!-- remove brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Remove Vendor</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
        </div>

        <form role="form" action="<?php echo base_url('admin/stores/remove') ?>" method="post" id="removeForm">
          <div class="modal-body">
            <p>Do you really want to remove Vendor?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-primary">Delete Vendor (this is irreversible)</button>
          </div>
        </form>


      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php endif; ?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Group</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item">Group</li>
			  <li class="breadcrumb-item active">Edit</li>
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

          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <div class="card">

            <form role="form" action="<?php base_url('Admin/groups/update') ?>" method="post">
              <div class="card-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="group_name">Group Name</label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter group name" value="<?php echo $group_data['group_name']; ?>" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="permission">Permission</label>

                  <?php $serialize_permission = unserialize($group_data['permission']); ?>
                  <div class=" table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th>modify</th>
                        <th>View</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Vendor</td>
                        
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="modifyVendor" value="modifyVendor"  <?php
                        if($serialize_permission) {
                          if(in_array('modifyVendor', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="modifyVendor">&nbsp;</label></div></td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewVendor" value="viewVendor" <?php
                        if($serialize_permission) {
                          if(in_array('viewVendor', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewVendor">&nbsp;</label></div></td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="deleteVendor" value="deleteVendor" <?php
                        if($serialize_permission) {
                          if(in_array('deleteVendor', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="deleteVendor">&nbsp;</label></div></td>
                      </tr>
                      <tr>
                        <td>Profile</td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="modifyProfile" value="modifyProfile" <?php
                        if($serialize_permission) {
                          if(in_array('modifyProfile', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="modifyProfile">&nbsp;</label></div></td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewProfile" value="viewProfile" <?php
                        if($serialize_permission) {
                          if(in_array('viewProfile', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewProfile">&nbsp;</label></div></td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="deleteProfile" value="deleteProfile" <?php
                        if($serialize_permission) {
                          if(in_array('deleteProfile', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="deleteProfile">&nbsp;</label></div></td>
                      </tr>
                      <tr>
                        <td>User</td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="modifyUser" value="modifyUser" <?php
                        if($serialize_permission) {
                          if(in_array('modifyUser', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="modifyUser">&nbsp;</label></div></td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewUser" value="viewUser" <?php
                        if($serialize_permission) {
                          if(in_array('viewUser', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewUser">&nbsp;</label></div></td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="deleteUser" value="deleteUser" <?php
                        if($serialize_permission) {
                          if(in_array('deleteUser', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="deleteUser">&nbsp;</label></div></td>
                      </tr>
                      <tr>
                        <td>Group</td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="modifyGroup" value="modifyGroup" <?php
                        if($serialize_permission) {
                          if(in_array('modifyGroup', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="modifyGroup">&nbsp;</label></div></td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewGroup" value="viewGroup" <?php
                        if($serialize_permission) {
                          if(in_array('viewGroup', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewGroup">&nbsp;</label></div></td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="deleteGroup" value="deleteGroup" <?php
                        if($serialize_permission) {
                          if(in_array('deleteGroup', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="deleteGroup">&nbsp;</label></div></td>
                      </tr>
                      <tr>
                        <td>Edit Custom Fields</td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="modifySuggestion" value="modifySuggestion" <?php
                        if($serialize_permission) {
                          if(in_array('modifySuggestion', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="modifySuggestion">&nbsp;</label></div></td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewSuggestion" value="viewSuggestion" <?php
                        if($serialize_permission) {
                          if(in_array('viewSuggestion', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewSuggestion">&nbsp;</label></div></td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="deleteSuggestion" value="deleteSuggestion" <?php
                        if($serialize_permission) {
                          if(in_array('deleteSuggestion', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="deleteSuggestion">&nbsp;</label></div></td>
                      </tr>
                      <tr>
                        <td>Report</td>
                        <td>-</td>

                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewReport" value="viewReport" <?php
                        if($serialize_permission) {
                          if(in_array('viewReport', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewReport">&nbsp;</label></div></td>
                        
                        <td>-</td>
                      </tr>
                      <tr>
                        <td>Analytics</td>
                        <td>-</td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewAnalytics" value="viewAnalytics" <?php
                        if($serialize_permission) {
                          if(in_array('viewAnalytics', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewAnalytics">&nbsp;</label></div></td>
                        <td>-</td>
                      </tr>
                      <td>Company</td>
                        <td>-</td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewCompany" value="viewCompany" <?php
                        if($serialize_permission) {
                          if(in_array('viewCompany', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewCompany">&nbsp;</label></div></td>
                        <td>-</td>
                      </tr>
                      <tr>
                        <td>Advance Search</td>
                        <td>-</td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewAdvanceSearch" value="viewAdvanceSearch" <?php
                        if($serialize_permission) {
                          if(in_array('viewAdvanceSearch', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewAdvanceSearch">&nbsp;</label></div></td>
                        <td>-</td>
                      </tr>
                      <tr>
                        <td>Admin</td>
                        <td>-</td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewAdmin" value="viewAdmin" <?php
                        if($serialize_permission) {
                          if(in_array('viewAdmin', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewAdmin">&nbsp;</label></div></td>
                        <td>-</td>
                      </tr>
                      <tr>
                        <td>Partner</td>
                        <td>-</td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewPartner" value="viewPartner" <?php
                        if($serialize_permission) {
                          if(in_array('viewPartner', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewPartner">&nbsp;</label></div></td>
                        <td>-</td>
                      </tr>
                      <tr>
                        <td>Email Reminders</td>
                        <td>-</td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewReminders" value="viewReminders" <?php
                        if($serialize_permission) {
                          if(in_array('viewReminders', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewReminders">&nbsp;</label></div></td>
                        <td>-</td>
                      </tr>
                      <tr>
                        <td>Profile Approval</td>
                        <td>-</td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewApproval" value="viewApproval" <?php
                        if($serialize_permission) {
                          if(in_array('viewApproval', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewApproval">&nbsp;</label></div></td>
                        <td>-</td>
                      </tr>
                      <tr>
                        <td>Requirements</td>
                        <td>-</td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewRequirements" value="viewRequirements" <?php
                        if($serialize_permission) {
                          if(in_array('viewRequirements', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewRequirements">&nbsp;</label></div></td>
                        <td>-</td>
                      </tr>
                      <tr>
                        <td>Announcement</td>
                        <td>-</td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewAnnouncmenet" value="viewAnnouncmenet" <?php
                        if($serialize_permission) {
                          if(in_array('viewAnnouncmenet', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewAnnouncmenet">&nbsp;</label></div></td>
                        <td>-</td>
                      </tr>
                      <tr>
                        <td>Profile Verification</td>
                        <td>-</td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewVerification" value="viewVerification" <?php
                        if($serialize_permission) {
                          if(in_array('viewVerification', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewVerification">&nbsp;</label></div></td>
                        <td>-</td>
                      </tr>
                      <tr>
                        <td>Vendor Account Login</td>
                        <td>-</td>
                        <td><div class="custom-control custom-switch"><input type="checkbox" name="permission[]" class="custom-control-input" id="viewVendorLogin" value="viewVendorLogin" <?php
                        if($serialize_permission) {
                          if(in_array('viewVendorLogin', $serialize_permission)) { echo "checked"; }
                        }
                         ?>><label class="custom-control-label" for="viewVendorLogin">&nbsp;</label></div></td>
                        <td>-</td>
                      </tr>
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Changes</button>
                <a href="<?php echo base_url('admin/groups/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
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
    $(document).ready(function() {
       $("#li-groups").addClass('menu-open');
    $("#link-groups").addClass('active');
    $("#manage-groups").addClass('active');
    });
  </script>


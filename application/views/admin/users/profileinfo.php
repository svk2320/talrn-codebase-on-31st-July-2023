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
            <!--<a href="<?php echo base_url('admin/users/setting'); ?>"-->
            <!--  style="margin-left:30px" class="btn btn-primary">Edit Account</a>-->
            </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a></li>
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
                  <th>Type</th>
                  <td>
                    <?php echo ($user_data['registered_as'] == 1) ? 'Organisation' : 'Individual' ?>
                  </td>
                </tr>
                <?php if ($user_data['registered_as'] == 1) { ?>
                  <tr>
                    <th>Organisation</th>
                    <td>
                      <?php echo $name; ?>
                    </td>
                  </tr>
                  <tr>
                    <th>Website</th>
                    <td>
                      <?php echo $website; ?>
                    </td>
                  </tr>
                <?php } ?>
                <tr>
                  <th>Email</th>
                  <td>
                    <?php echo $user_data['email']; ?>
                  </td>
                </tr>
                <tr>
                  <th>First Name</th>
                  <td>
                    <?php echo $user_data['firstname']; ?>
                  </td>
                </tr>
                <tr>
                  <th>Last Name</th>
                  <td>
                    <?php echo $user_data['lastname']; ?>
                  </td>
                </tr>
                <tr>
                  <th>Gender</th>
                  <td>
                    <?php if ($user_data['gender'] == 0) {
                      echo 'Not Set';
                    } elseif ($user_data['gender'] == 1) {
                      echo 'Male';
                    } else {
                      echo 'Female';
                    }
                    ?>
                  </td>
                </tr>
                <?php if ($user_data['registered_as'] == 1) { ?>
                  <tr>
                    <th>Job title</th>
                    <td>
                      <?php echo $user_data['job_title']; ?>
                    </td>
                  </tr>
                <?php } ?>
                <tr>
                  <th>Phone</th>
                  <td>
                    <?php echo $user_data['phone']; ?>
                  </td>
                </tr>
                <tr>
                  <th>City</th>
                  <td>
                    <?php echo $user_data['city']; ?>
                  </td>
                </tr>
                <tr>
                  <th>Referral Code</th>
                  <td>
                    <?php echo $user_data['referral_code']; ?>
                  </td>
                </tr>
                <?php if ($user_data['registered_as'] == 1) { ?>
                  <tr>
                    <th>CIN/GST</th>
                    <td>
                      <?php echo $user_data['cin/gst']; ?>
                    </td>
                  </tr>
                <?php } ?>
                <?php if ($user_data['registered_as'] == 1) { ?>
                  <tr>
                    <th>Total Uploaded Profiles</th>
                    <td>
                      <?php echo $no_of_profiles; ?>
                    </td>
                  </tr>
                <?php } ?>
                <?php if ($user_data['registered_as'] == 2) { ?>
                  <tr>
                    <th>Profile</th>
                    <!--<td><a href="<?= $profile_link ?>"><?php if ($profile_link == '#') {
                      echo 'No Profile Uploaded';
                    } else {
                      echo 'Link';
                    } ?></a></td>-->
                    <td>
                      <?php if ($profile_link == '#') {
                        echo 'No profile uploaded';
                      } else {
                        echo "<a href = $profile_link> Link </a>";
                      } ?>
                    </td>

                  </tr>
                <?php } ?>
                <tr>
                  <th>Email Reminders</th>
                  <td>
                    <div class="custom-control custom-switch"><input type="checkbox" name="reminders"
                        class="custom-control-input" id="reminder" value="reminder" <?php if ($user_data['reminder'] == 1) {
                          echo 'checked';
                        } ?>><label class="custom-control-label" for="reminder"
                        onclick="openLink()">&nbsp;</label></div>
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
      <script>
        function openLink() {
          fetch('<?php echo base_url("admin/users/toggle_reminder/" . $user_data['id']) ?>', { method: 'GET' })
            .catch(error => {
              console.error('Request failed:', error);
            });
        }
      </script>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function () {
    $("#profileMainNav").addClass('active');
  });
</script>

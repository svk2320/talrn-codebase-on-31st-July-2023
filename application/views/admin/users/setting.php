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
            <h1 class="m-0 text-dark">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Profile</a></li>
			  <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <!-- Small cardes (Stat card) -->
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
            <div class="card-header">
              <h3 class="card-title">Update Information</h3>
            </div>
            <!-- /.card-header -->
            <form role="form" action="<?php base_url('admin/users/setting') ?>" method="post">
              <div class="card-body">

                <?php echo validation_errors(); ?>


                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $user_data['email'] ?>" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="fname">First name</label>
                  <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" value="<?php echo $user_data['firstname'] ?>" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="lname">Last name</label>
                  <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?php echo $user_data['lastname'] ?>" autocomplete="off">
                </div>
                <?php if($user_data['registered_as'] == 1){ ?>
                <div class="form-group">
                      <label for="cin/gst">Website</label>
                      <input type="text" class="form-control" id="website" name="website" placeholder="Website" value="<?php echo $store_info['website'] ?>" autocomplete="off">
                  </div>
                  <div class="form-group">
                      <label for="cin/gst">Organisation</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Organisation" value="<?php echo $store_info['name'] ?>" autocomplete="off">
                  </div>
                <?php } ?>

                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo $user_data['phone'] ?>" autocomplete="off">
                </div>
                <div class="form-group">
                      <label for="city">City</label>
                      <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $user_data['city'] ?>" autocomplete="off">
                 </div>

                 <div class="form-group">
                      <label for="referral_code">Referral Code</label>
                      <input type="text" class="form-control" id="referral_code" name="referral_code" placeholder="Referral code" value="<?php echo $user_data['referral_code'] ?>" autocomplete="off">
                 </div>
                 <?php if($user_data['registered_as'] == 1){ ?>
                <div class="form-group">
                      <label for="job_title">Job Title</label>
                      <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Job  title" value="<?php echo $user_data['job_title'] ?>" autocomplete="off">
                  </div>
                
                  <div class="form-group">
                      <label for="cin/gst">CIN/GST</label>
                      <input type="text" class="form-control" id="cin/gst" name="cin/gst" placeholder="CIN/GST" value="<?php echo $user_data['cin/gst'] ?>" autocomplete="off">
                  </div>
                <?php } ?>
                
                <div class="form-group">
                  <label for="gender">Gender</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="gender" id="male" value="1" <?php if($user_data['gender'] == 1) {
                        echo "checked";
                      } ?>>
                      Male
                    </label>
                    <label>
                      <input type="radio" name="gender" id="female" value="2" <?php if($user_data['gender'] == 2) {
                        echo "checked";
                      } ?>>
                      Female
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="alert alert-info alert-dismissible" role="alert">
                      Leave the password field empty if you don't want to change.
                  </div>
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="text" class="form-control" id="password" name="password" placeholder="Password" autocomplete="new-password">
                </div>

                <div class="form-group">
                  <label for="cpassword">Confirm password</label>
                  <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" autocomplete="new-password">
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('admin/users/profile') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
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
      $("#profileMainNav").addClass('active');
    });
  </script>


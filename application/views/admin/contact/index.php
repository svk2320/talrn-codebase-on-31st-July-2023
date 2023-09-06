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
            <h1 class="m-0 text-dark">Contact Info</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Contact Info</li>
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


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Contact</h3>
            </div>
            <form role="form" action="#" method="post">
              <div class="card-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="full_name">Full Name</label>
                  <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter your name" value="<?php echo $contact_data['full_name'] ?>" autocomplete="off">
                </div>




                <div class="form-group">
                  <label for="reason">Reason</label>
                  <?php ?>
                  <select class="form-control" id="reason" name="reason">
                    <option value="">~~SELECT~~</option>

                    <?php foreach ($reason as $k => $v): ?>
                      <option value="<?php echo trim($k); ?>" <?php if($contact_data['reason'] == $k) {
                        echo "selected";
                      } ?>><?php echo $k ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="permission">Message</label>
                  <textarea class="form-control" id="message" name="message">
                     <?php echo $contact_data['message'] ?>
                  </textarea>
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Send</button>
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
    $("#contactMainNav").addClass('active');
  });
</script>


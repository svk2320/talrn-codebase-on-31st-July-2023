  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add New User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a></li>
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
          <?php if($this->session->flashdata('errors')){ ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?>

            </div>
          <?php } ?>

          <div class="card">

            <form role="form" action="<?php base_url('admin/skills/create') ?>" method="post">
              <div class="card-body">



                

                <div class="form-group">
                  <label for="skillname">Name</label>
                  <input type="text" class="form-control" id="skillname" name="skillname" placeholder="Skill name" autocomplete="off" required>
                </div>

                <div class="form-group">
                  <label for="email">Description</label>
                  
                  <textarea class="form-control" rows="3" placeholder="Description..."  id="skilldes" name="skilldes" required></textarea>
                </div>

                

              </div>
              <!-- /.box-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="<?php echo base_url('admin/skills/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
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
    $(document).ready(function() {
        $("#li-skills").addClass('menu-open');
        $("#link-skills").addClass('active');
        $("#skills-create").addClass('active');
    });
</script>
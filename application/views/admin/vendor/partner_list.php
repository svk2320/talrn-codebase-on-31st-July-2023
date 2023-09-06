<?php // print_r($links); exit; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="pt-2">
    <div class="container-fluid">
      <div class="row pd-0">
        <div class="col-sm-4" style="display:flex">
          <h2 class="text-dark">Global Profile List</h2>
        </div><!-- /.col -->
        <!-- <style>
          .partner-message {
            border-style: dashed;
            border-width: 2px;
            border-color: black;
          }
        </style> -->
        <div class="col-sm-5 partner-message" style="display:flex;">
          <p>Require assistance finding profiles or setting up interviews?<br>Schedule a quick <a target="_blank" href="https://calendly.com/superlabs/discovery">meeting</a>  or connect on
          <a target="_blank" href="https://wa.me/+919820045154">chat</a></p>
        </div>
        <div class="col-sm-3">
          <ol class="breadcrumb float-sm-right" style="background-color: rgba(0, 0, 0, 0);">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Global Profile List</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">


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

            <table id="userTable" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Unique ID</th>
                  <th>Name</th>
                  <th>Country</th>
                  <th>City</th>
                  <th>Job title</th>
                  <th>Experience</th>
                  <th>Monthly Rate </th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="table">
                <?php if ($list) { ?>
                  <?php foreach ($list as $k => $v): ?>
                    <tr>
                      <td>
                        <?php echo $v['unique_id']; ?>
                      </td>
                      <td>
                        <?php echo $v['last_name'] . " " . $v['first_name'][0]; ?>
                      </td>

                      <td>
                        <?php echo $v['country']; ?>
                      </td>
                      <td>
                        <?php echo $v['city']; ?>
                      </td>
                      <td>
                        <?php echo $v['primary_title']; ?>
                      </td>
                      <td>
                        <?php if ($v['experience'] < 1) {
                          echo "< 1 ";
                        } else {
                          echo $v['experience'] . " ";
                        } ?>
                      </td>
                      <td>
                      <?php if ($v['registered_as'] == 1) {
                          echo $v['currency'] . " " . ($v['ppm_max'] + $v['ppm_max'] * 1.4);
                        } else {
                          echo $v['currency'] . " " . ($v['ppm_max'] + $v['ppm_max'] * 2.2);
                        } ?>
                      </td>
                      <td class="text-nowrap">
                        <a href="<?php echo base_url('profile/' . strtolower($v['profile_url']) . '/' . strtolower($v['unique_id'])) ?>"
                          class="btn btn-default" target="_blank"><i class="fa fa-eye"></i></a>
                        <a href="<?php echo base_url('home/profile2pdfpartner/' . $v['id'] . $pdf_parameters) ?>"
                          class="btn btn-default"><i class="fa fa-download"></i></a>
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
    $("#partnerlist").addClass('active');
    $('#userTable').DataTable({
      order: [],
      "dom": '<"pull-left"f><"pull-right"l>tip',
      language: {
        "zeroRecords": "No profiles upload, please upload your profile to get started!"
      }
    });

  });


</script>
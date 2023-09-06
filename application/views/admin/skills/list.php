<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Skill sets</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Home</a></li>
              <li class="breadcrumb-item active">Skill sets</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

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

          <?php if(in_array('modifyGroup', $user_permission)): ?>
            <a href="<?php echo base_url('admin/skills/create') ?>" class="btn btn-primary">Add Skill sets</a>
            
          <?php endif; ?>

          <div class="card" style="margin-top:20px;">

            <!-- /.card-header -->
            <div class="card-body">
              <table id="groupTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Id</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Added on</th>
                  <th>Last modified on</th>
                  <th>Active</th>
                  <?php if(in_array('modifyGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                    <th>Action</th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                  <?php if($list): ?>
                    <?php foreach ($list as $k => $v): ?>
                      <tr>
                      <td><?php echo $v['id']; ?></td>
                        <td><?php echo $v['name']; ?></td>
                        <td><?php echo $v['description']; ?></td>
                        <td><?php $dtime = new DateTime($v['created_on']); print $dtime->format("d-M-Y");?></td>
                        <td><?php $dtime = new DateTime($v['modified_on']); print $dtime->format("d-M-Y");?></td>
                        <td><?php echo $v['active'] === '1' ? '<span class="text-green">Active</span>' : '<span class="text-red">In Active</span>'; ?></td>
                        
                        
                        <td>
                          
                          <a href="#" class="btn btn-default"><i class="fa fa-edit"></i></a>
                         
                         
                          <a href="#" class="btn btn-default"><i class="fa fa-trash"></i></a>
                          
                        </td>
                        
                      </tr>
                    <?php endforeach ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
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
        $("#li-skills").addClass('menu-open');
        $("#link-skills").addClass('active');
        $("#skills-list").addClass('active');
    });
  </script>

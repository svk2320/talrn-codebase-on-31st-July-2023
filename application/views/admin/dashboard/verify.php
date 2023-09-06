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
          <h1 class="m-0 text-dark">Welcome to Talrn Verified!</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
  <?php if(isset($verify_msg)){ ?>
    <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $verify_msg ?>
            </div>  
  <?php } ?>

    <!-- Default box -->
    <div class="card">
      <!--<div class="card-header">-->
      <!--  <h3 class="card-title">Verify profile</h3>-->
      <!--</div>-->
      <div class="card-body">
          
        <div>
         

<div class="col-12">

<p>We're thrilled to present to you an opportunity that all iOS developers simply can't miss. With Talrn Verified, you'll gain access to the top 10% of opportunities worldwide, giving you a competitive edge in the job market like never before. And the best part? You'll receive the Talrn Verified Badge, instantly setting you apart from the competition.</p>

<p>Talrn Verified - the ultimate badge of honor for iOS developers.</p>

<p>Here are some of the benefits you'll gain with Talrn Verified:
<ul>
<li>A genuine, active, and available status that sets you apart from the competition</li>
<li>10X faster responses from top companies worldwide</li>
<li>A direct line to the top 10% of opportunities in the industry</li>
<li>A profile that instantly puts you ahead of hundreds of other iOS developers</li>
<li>An exclusive network of verified developers to connect and collaborate with</li>
</ul>
</p>
<p>Increased visibility to IT recruiters who prefer verified profiles</p>

<p>IT recruiters prefer verified profiles over unverified ones, giving you an edge in the job market. And with hundreds of other iOS developers already benefiting from Talrn Verified, you can join them and put yourself ahead of the game.</p>

<p>Now, I know what you may be thinking. "This all sounds great, but what's the price?" Well, let me tell you, it's a steal. Access to the best opportunities worldwide can come with a hefty price tag of $238 per year, but we're offering that same access to you for just $9 per year. That's right, you heard me correctly. For just $9 per year, you can take your career to the next level.</p>

<p>But you must act fast. This offer is only available for a limited time and only to the first 1000 sign-ups. And with over 800 already signed up, you don't want to miss out on this opportunity. So don't wait, sign up now and start paving the way towards a better career!</p>
<br>
</div>

        </div>
        <form action="<?php echo base_url('admin/dashboard/verifyform') ?>" method="post">
          <div class="form-group row">
            <label for="name" class="col-2 col-form-label">Name :</label>
            <div class="col-6">
              <input id="name" name="name" type="text" class="form-control" required="required" value="<?=$user_data['firstname']." ".$user_data['lastname'] ?>">
            </div>
            <div class="col-6"></div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-2 col-form-label">Email :</label>
            <div class="col-6">
              <input id="email" name="email" type="text" required="required" class="form-control" value="<?=$user_data['email'] ?>">
            </div>
            <div class="col-6"></div>
          </div>
          <div class="form-group row">
            <label for="number" class="col-2 col-form-label">Number :</label>
            <div class="col-6">
              <input id="number" name="number" type="tel" 
               
              minlength="6" maxlength="15" class="form-control"  required="required" value="<?=$user_data['phone'] ?>" >
            </div>
            <div class="col-6"></div>
          </div>
          <div class="form-group row">
            <div class="offset-2 col-8">
              <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
      <!-- /.card-body -->
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function () {
    $("#mainNav").addClass('active');
  });
</script>

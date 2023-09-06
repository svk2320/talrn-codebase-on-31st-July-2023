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
          <h1 class="m-0 text-dark">Edit your custom URL</h1>

        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/verified/customurl') ?>">Custom URL</a></li>
            <li class="breadcrumb-item active">Set URL</li>
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
       <form action="<?php echo base_url('admin/verified/updateurl/').$id ?>" method="post" onsubmit="return validateForm()">
           
      <div class="card-body">
          <div class="row mb-2">
          
          <h5 class="mt-2 text-dark">Unlock Your Career Potential with a Personalized URL That Sets You Apart!</h5>
          </div>
        <?php if($custom_url !== null) { ?>

        <div class="row mb-2">
            <span class="font-weight-bold">Your current custom URL : &nbsp</span>
            <a target="_blank" href="<?php echo base_url('profile/'.$custom_url); ?>"> <?php echo base_url('profile/'.$custom_url); ?> </a> 
        </div>
        <?php } ?>
        
        <div class="row mb-2">
            <span class="font-weight-bold">Note:</span><br>
            <div class="col-12" style="color: lightslategray;">URL must contain 3-30 characters.</div>
            <div class="col-12" style="color: lightslategray;">URL must not contain spaces.</div>
            <div class="col-12" style="color: lightslategray;">URL can only contain letters, numbers, hyphens (-), and underscores (_).</div>
            
        </div>      
          <div class="form-group row">
              <label for="url">Your custom URL : </label>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">https://talrn.com/profile/</span>
                  </div>
                  <input id="url" name="url" type="text" class="col-lg-3 col-sx-6 form-control"  value="<?php echo $custom_url?>">
                </div>
                
          <div class="form-group row mb-4 col-12">

            <div class=" text-danger" id="url_error" style="display:none;">This field is required!</div>
           </div>
          <div class="form-group row col-12">
            
              <button name="submit" type="submit" class="btn btn-primary">Update</button>
        
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


<script>
    function validateForm() {
      var urlInput = document.getElementById("url");
      var urlError = document.getElementById("url_error");
      var url = urlInput.value.trim();
    
      if (url === "") {
        urlError.innerHTML = "This field is required!";
        urlError.style.display = "block";
        return false;
      }
    
      if (url.length < 3) {
        urlError.innerHTML = "URL must contain 3 characters!";
        urlError.style.display = "block";
        return false;
      }
      
      if (url.length > 30) {
        urlError.innerHTML = "URL must not exceed 30 characters!";
        urlError.style.display = "block";
        return false;
      }
      
      if (url.indexOf(" ") !== -1) {
        urlError.innerHTML = "URL must not contain spaces!";
        urlError.style.display = "block";
        return false;
      }
    
    
      var pattern = /^[a-zA-Z0-9_-]+$/;
      if (!pattern.test(url)) {
        urlError.innerHTML = "URL must not contain special characters!";
        urlError.style.display = "block";
        return false;
      }
      
      var currentURL = "<?php echo $custom_url;?>";
      if (url == currentURL) {
        urlError.innerHTML = "URL is same as current!";
        urlError.style.display = "block";
        return false;
      }
      
      var xhr = new XMLHttpRequest();
      var base_url = "<?php echo base_url(); ?>";
      var url = "admin/verified/check_status?url=" + encodeURIComponent(url);
      xhr.open("GET", base_url + url, false);
      xhr.send();
    
 
      if (xhr.responseText == 1) {
        urlError.innerHTML = "URL is already taken!";
        urlError.style.display = "block";
        return false;
      }
      return true;
    }
</script>

<script type="text/javascript">
  $(document).ready(function () {
    $("#customurl").addClass('active');
  });
</script>

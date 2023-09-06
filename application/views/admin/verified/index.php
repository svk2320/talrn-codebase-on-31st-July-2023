<link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.9.95/css/materialdesignicons.css" rel="stylesheet">
<link media="all" href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link media="all" rel="stylesheet" href="<?php echo base_url() . $this->config->item('css') . 'verified-index.css' ?>">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>" style="text-decoration:none">Home</a></li>
                <li class="breadcrumb-item active">Profile Verification</li>
            </ol>
            <?php if (isset($message)) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <?php echo $message; ?>
                </div>
            <?php } ?>
        </div><!-- /.container-fluid -->
    </div>
    
    
	<div class="row gy-6 align-items-center mb-14 mb-md-18 w-100">
	    
      <div class="col-lg-4 main-text-center pl-5">
    	    <div class="main-text">
        		<h2 class="display-4">Get verified.</h2>
        		<h2 class="display-4" style="margin: 30px 0px;">Get notified.</h2>
        		<h2 class="display-4 mb-5">Get projects.</h2>
    	    </div>
            <p class="lead fs-lg mb-5 sub-text" style="color: #60697b !important; font-weight: 400;">Instantly stand out as a trusted and reliable professional, grabbing the attention of emplyers & collaborators.</p>
    	</div>
      
      <!--/column -->
      <div class="col-lg-7 offset-lg-1 pricing-wrapper">
        
        <div class="row gy-6 mt-5">
          <div class="col-md-6">
            <div class="pricing card shadow-lg">
              <div class="card-body pb-12">
                <div class="plan-price mt-4">
    				<h1 class="text-custom font-weight-normal mb-0"><sup style="width:50%">$</sup><span style="font-size: 3rem;">5</span><span class="price-duration">/mo</span></h1>
    			</div>
                <!--/.prices -->
                
            	<div class="pricing-name">
			        <h4 class="mt-2">Verified for Individuals</h4>
                </div>
                <div class="price-features" style="margin-top: 35px !important;">
                  <p class="text-box"><i class="mdi mdi-check"></i><span>Custom URL<strong><br>unique to your profile</strong></span></p>
                  <p class="text-box"><i class="mdi mdi-check"></i><span>Talrn <strong>Verified Badge</strong></span></p>
                  <p class="text-box"><i class="mdi mdi-check"></i><span><strong>10x</strong>  More Reach </span></p>
                  <p class="text-box"><i class="mdi mdi-check"></i><span> Trust & <strong> Credibility</strong></span></p>
                  <p class="text-box"><i class="mdi mdi-check"></i><span> Enhanced <strong> Ranking</strong></span></p>
                  <p class="text-box"><i class="mdi mdi-check"></i><span> Priority<strong>  Opportunities</strong></span></p>
                  <p class="text-box"><i class="mdi mdi-check"></i><span> Download CV in <strong>your branding</strong></span></p>
                  <p class="text-box"><i class="mdi mdi-check"></i><span><strong> Email Support </strong></span></p>
                </div>
                <div class="text-center mt-5">
    				<a target="_blank" href="https://rzp.io/l/Ipfi4M5M" class="btn btn-primary rounded-pill" style="padding: 10px 20px">Get Verified Now</a>
    			</div>
              </div>
              <!--/.card-body -->
            </div>
            <!--/.pricing -->
          </div>
          <!--/column -->
          <div class="col-md-6 popular">
            <div class="pricing card shadow-lg">
              <div class="card-body pb-12">
                  
                <div class="plan-price mt-4">
    				<h1 class="text-custom font-weight-normal mb-0"><sup>$</sup><span style="font-size: 3rem;">9</span><span class="price-duration">/mo/3 profiles</span></h1>
    			</div>
                
                <!--/.prices -->
                <div class="pricing-name">
    				<h4 class="mt-2">Verified for Business</h4>
    			</div>
                <div class="price-features" style="margin-top: 35px !important;">
            		<p class="text-box"><i class="mdi mdi-check"></i><span>Valid for <strong>3 Profiles</strong></span></p>
                    <p class="text-box"><i class="mdi mdi-check"></i><span>Custom URL <strong><br>unique to your profile</strong>  </span></p>
                    <p class="text-box"><i class="mdi mdi-check"></i><span>Talrn <strong>Verified Badge</strong></span></p>
                    <p class="text-box"><i class="mdi mdi-check"></i><span><strong>10x</strong>  More Reach </span></p>
                    <p class="text-box"><i class="mdi mdi-check"></i><span> Trust & <strong> Credibility</strong></span></p>
                    <p class="text-box"><i class="mdi mdi-check"></i><span> Enhanced <strong> Ranking</strong></span></p>
                    <p class="text-box"><i class="mdi mdi-check"></i><span> Priority<strong>  Opportunities</strong></span></p>
                    <p class="text-box"><i class="mdi mdi-check"></i><span> Download CV's in <strong>your branding</strong></span></p>
                    <p class="text-box"><i class="mdi mdi-check"></i><span><strong> Priority   </strong>Email Support</span></p>
                </div>
                <div class="text-center mt-5">
    				<a target="_blank" href="https://rzp.io/l/M2U9f3Epz" class="btn btn-primary rounded-pill" style="padding: 10px 20px">Get Verified Now</a>
    			</div>
              </div>
              <!--/.card-body -->
            </div>
            <!--/.pricing -->
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!--/column -->
    </div>
	
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $("#verify").addClass('active');
  });
</script>

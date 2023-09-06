<style>
    pre {
        font: inherit; /* This will inherit the font properties from the parent element (body) */
        text-align: left;
        padding-top: 36px !important;
        white-space: pre-wrap;
    }
</style>

<style>

    @media (max-width: 979px) {
        .offcanvas-body .navbar-nav.flex-row.ms-auto {
        	display: block;
        	text-align: left;
        }
        .ms-auto {
            margin-left: 0px !important;
        }
        
        .navbar-nav.flex-row.ms-auto .nav-item {
        	margin-bottom: 10px;
        }
        
        .navbar-nav.flex-row.ms-auto .nav-link {
        	display: inline-block;
        }
        
        .nav-item.hire-btn {
            display: none;
        }
        
        .navbar-brand.w-100 a img {
            width: 40%;
        }
        
        .navbar .container.flex-lg-row.flex-nowrap.align-items-center{
            margin-top: 10px !important;
        }
    }
    
    @media (max-width: 500px) {
        .navbar-brand.w-100 a img {
                width: 25% !important;
        }
        
        .navbar .container.flex-lg-row.flex-nowrap.align-items-center{
            padding: 0px 15px !important;
        }
    }

</style>

<header class="wrapper bg-soft-primary">
	<?php
	$announcement = $this->Model_announcement->getActiveAnnouncement();
	?>
	<?php if (!$this->input->cookie('alert_displayed') && sizeof($announcement) > 0 ): ?>
		<?php if($announcement[0]['website']): ?>
    <div class="alert bg-primary text-white alert-dismissible fade show rounded-0 mb-1 text-lg-center" role="alert">
        <div class="container">
            <div class="alert-inner d-flex justify-content-center align-items-center p-0">
                <?= $announcement[0]['text'] ?>
            </div>
            <!-- /.alert-inner -->
        </div>
        <!-- /.container -->
        <button type="button" class="btn-close" data-bs-dismiss="alert" id="alert-close" aria-label="Close"></button>
    </div>
	<?php endif; ?>
<?php endif; ?>


    <nav class="navbar navbar-expand-lg classic transparent navbar-light">
		<div class="container flex-lg-row flex-nowrap align-items-center" style="height: 60px; margin-top: -3px; padding: 0px 11px;">
			<div class="navbar-brand w-100">
				<a href="<?= base_url() ?>">
					<img src="<?= base_url('assets/img/newlogo.png') ?>"
						srcset="<?= base_url('assets/img/newlogo.png') ?>" style="width:24%" alt="" />
				</a>
			</div>
			<div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start" style="justify-content: end">
				<div class="offcanvas-header d-lg-none">
					<h3 class="text-white fs-30 mb-0">Talrn</h3>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
						aria-label="Close"></button>
				</div>
				<div class="offcanvas-body ms-lg-large d-flex flex-column h-100">
					<ul class="navbar-nav flex-row align-items-center ms-auto">
					    
					    <li class="nav-item"><a id="nav" class="nav-link " href="<?= base_url('why') ?>">Why</a> </li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Industries</a>
							<ul class="dropdown-menu">
								<li class="nav-item"><a class="dropdown-item"
										href="<?= base_url('industries/travel') ?>">Travel</a></li>
								<li class="nav-item"><a class="dropdown-item"
										href="<?= base_url('industries/automotive') ?>">Automotive</a></li>
								<li class="nav-item"><a class="dropdown-item"
										href="<?= base_url('industries/banking') ?>">Banking</a></li>
								<li class="nav-item"><a class="dropdown-item"
										href="<?= base_url('industries/capital-markets') ?>">Capital Markets</a></li>
								<li class="nav-item"><a class="dropdown-item"
										href="<?= base_url('industries/healthcare') ?>">Healthcare</a></li>
								<li class="nav-item"><a class="dropdown-item"
										href="<?= base_url('industries/ecommerce') ?>">Digital Commerce</a></li>
								<li class="nav-item"><a class="dropdown-item" href="<?= base_url('industries') ?>">View
										all</a></li>
							</ul>
						</li>

						<li class="nav-item"><a id="nav" class="nav-link " href="<?= base_url('profiles') ?>">Find iOS Dev</a> </li>

						<li class="nav-item"><a id="nav" class="nav-link " style="font-size: 14px;" href="<?php echo base_url('join'); ?>" target="_blank">Apply as Vendor</a> </li>
						
						
						
						<li class="nav-item hire-btn">
						    <a href="<?php echo base_url('hire'); ?>" style="font-size: 14px;" class="btn btn-sm btn-primary rounded-pill" style="margin-right: 18px;">Hire iOS Dev</a>
					    </li>

                        <!--Login button-->
                        		<?php if (isset($_SESSION['username'])) { ?>
		                          <li class="nav-item dropdown">
		                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
		                              <?php
		                              if ($_SESSION['username'] == 'Individual') {
		                                $nameParts = explode(' ', $_SESSION['name']);
		                                $lastName = end($nameParts);
		                                echo $lastName;
		                              } else {
		                                echo $_SESSION['username'];
		                              }
		                              ?>
		                            </a>
		                            <ul class="dropdown-menu">
		                              <li class="nav-item"><a class="dropdown-item" href="<?= base_url('admin/dashboard') ?>">My Dashboard</a></li>
		                              <li class="nav-item"><a class="dropdown-item" href="<?= base_url('admin/users/profile/') ?>">My Account</a></li>
		                              <li class="nav-item"><a class="dropdown-item" href="<?= base_url('admin/vendor/list') ?>">My Profile</a></li>
									  <li class="nav-item"><a class="dropdown-item" href="<?= base_url('admin/auth/logout') ?>">Log out</a></li>
		                            </ul>
		                          </li>
								<?php } else if(isset($_SESSION['name'])) { ?>
									<li class="nav-item dropdown">
		                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
		                              <?php
		                                echo $_SESSION['name'];
		                              ?>
		                            </a>
		                            <ul class="dropdown-menu">
		                              <li class="nav-item"><a class="dropdown-item" href="<?= base_url('client/dashboard') ?>">My Dashboard</a></li>
		                              <li class="nav-item"><a class="dropdown-item" href="<?= base_url('client/users/profile/') ?>">My Account</a></li>
									  <li class="nav-item"><a class="dropdown-item" href="<?= base_url('client/auth/logout') ?>">Log out</a></li>
		                            </ul>
		                          </li>
		                        <?php } else { ?>
									<li class="nav-item"><a id="nav" class="nav-link " href="<?php echo base_url('admin'); ?>" target="_blank">Login</a> </li>
		                          
		                        <?php } ?>
						
						<!-- /.navbar-nav -->
						<div class="offcanvas-footer d-lg-none">
							<div style="margin-top: -18px;">
								<a href="<?php echo base_url('hire'); ?>" class="nav-link" style="padding: 0px !important;">Hire Dev</a> <br>
								<a href="mailto:hello@talrn.com" class="link-inverse">hello@talrn.com </a> <br>
								<a href="tel:+919820045154" class="link-inverse">+91 982 004 5154 </a> <br>
								<nav class="nav social social-white mt-4">
									<a href="https://www.linkedin.com/company/talrn/" target="_blank"><i
											class="uil uil-linkedin"></i></a>
									<a href="https://twitter.com/talrnofficial" target="_blank"><i
											class="uil uil-twitter"></i></a>
									<a href="https://www.facebook.com/talrnofficial" target="_blank"><i
											class="uil uil-facebook-f"></i></a>
									<a href="https://www.instagram.com/talrnofficial/" target="_blank"><i
											class="uil uil-instagram"></i></a>
									<!-- /. <a href="#"><i class="uil uil-youtube"></i></a> -->
									<!-- /.<a href="#"><i class="uil uil-behance"></i></a> -->
									<!-- /. <a href="#"><i class="uil uil-dribbble"></i></a> -->
								</nav>
								<!-- /.social -->
							</div>
						</div>
						<!-- /.offcanvas-footer -->
				</div>
			</div>
			<!-- /.navbar-collapse -->
			<div class="navbar-other ms-lg-4">
				<ul class="navbar-nav flex-row align-items-center ms-auto">
				    
					<li class="nav-item d-none d-md-block d-lg-none">
						<a style="font-size: 14px;" href="<?php echo base_url('hire'); ?>" class="btn btn-sm btn-primary rounded-pill">Hire Talent</a>
					</li>
					
					<li class="nav-item d-lg-none" style="font-size: 14px;">
						<button class="hamburger offcanvas-nav-btn"><span></span></button>
					</li>
				</ul>
				<!-- /.navbar-nav -->
			</div>
			<!-- /.navbar-other -->
		</div>
		<!-- /.container -->
	</nav>
	<!-- /.navbar -->
	
	<div class="modal fade" id="modal-signin" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-sm">
			<div class="modal-content text-center">
				<div class="modal-body">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					<h2 class="mb-3 text-start">Thank you for your interest in Talrn</h2>
					<p class="lead mb-6 text-start">We offer insant access to pre-vetted developers, please provide your
						information.</p>
					<form class="text-start mb-3">
						<div class="form-floating mb-4">
							<input type="text" class="form-control" placeholder="Name" id="loginEmail">
							<label for="loginEmail">Name</label>
						</div>
						<div class="form-floating mb-4">
							<input type="text" class="form-control" placeholder="Company name" id="loginEmail">
							<label for="loginEmail">Company name</label>
						</div>
						<div class="form-floating mb-4">
							<input type="text" class="form-control" placeholder="Phone number" id="loginEmail">
							<label for="loginEmail">Phone number</label>
						</div>
						<div class="form-floating mb-4">
							<input type="email" class="form-control" placeholder="Email" id="loginEmail">
							<label for="loginEmail">Work Email</label>
						</div>
						<a class="btn btn-primary rounded-pill btn-login w-100 mb-2">Submit</a>
					</form>
					<!-- /form -->
					<!--/.social -->
				</div>
				<!--/.modal-content -->
			</div>
			<!--/.modal-body -->
		</div>
		<!--/.modal-dialog -->
	</div>
	<!--/.modal -->
	<div class="modal fade" id="modal-signup" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-sm">
			<div class="modal-content text-center">
				<div class="modal-body">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					<h2 class="mb-3 text-start">Sign up to Talrn</h2>
					<p class="lead mb-6 text-start">Registration takes less than a minute.</p>
					<form class="text-start mb-3">
						<div class="form-floating mb-4">
							<input type="text" class="form-control" placeholder="Name" id="loginName">
							<label for="loginName">Name</label>
						</div>
						<div class="form-floating mb-4">
							<input type="email" class="form-control" placeholder="Email" id="loginEmail">
							<label for="loginEmail">Email</label>
						</div>
						<div class="form-floating password-field mb-4">
							<input type="password" class="form-control" placeholder="Password" id="loginPassword">
							<span class="password-toggle"><i class="uil uil-eye"></i></span>
							<label for="loginPassword">Password</label>
						</div>
						<div class="form-floating password-field mb-4">
							<input type="password" class="form-control" placeholder="Confirm Password"
								id="loginPasswordConfirm">
							<span class="password-toggle"><i class="uil uil-eye"></i></span>
							<label for="loginPasswordConfirm">Confirm Password</label>
						</div>
						<a class="btn btn-primary rounded-pill btn-login w-100 mb-2">Sign Up</a>
					</form>
					<!-- /form -->
					<p class="mb-0">Already have an account? data-bs-target="#modal-signin" data-bs-toggle="modal"
						data-bs-dismiss="modal" class="hover">Sign in</a></p>
					<div class="divider-icon my-4">or</div>
					<nav class="nav social justify-content-center text-center">
						class="btn btn-circle btn-sm btn-google"><i class="uil uil-google"></i></a>
						class="btn btn-circle btn-sm btn-facebook-f"><i class="uil uil-facebook-f"></i></a>
						class="btn btn-circle btn-sm btn-twitter"><i class="uil uil-twitter"></i></a>
					</nav>
					<!--/.social -->
				</div>
				<!--/.modal-content -->
			</div>
			<!--/.modal-body -->
		</div>
		<!--/.modal-dialog -->
	</div>
	<!--/.modal -->
	<div class="offcanvas offcanvas-end text-inverse" id="offcanvas-info" data-bs-scroll="true">
		<div class="offcanvas-header">
			<h3 class="text-white fs-30 mb-0">Talrn</h3>
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
				aria-label="Close"></button>
		</div>
		<div class="offcanvas-body pb-6">
			<div class="widget mb-8">
				<p>Talrn is the world’s largest network of pre-vetted talent.</p>
			</div>
			<!-- /.widget -->
			<div class="widget mb-8">
				<h4 class="widget-title text-white mb-3">Contact Info</h4>
				<address> 305, IRIS Corporate Centre, <br /> Hiranandani Meadows, 400610. </address>
				<a href="mailto:hello@talrn.com">hello@talrn.com</a><br /> +919820045154
			</div>
			<!-- /.widget -->
			<div class="widget mb-8">
				<h4 class="widget-title text-white mb-3">Learn More</h4>
				<ul class="list-unstyled">
					<li><a href="#">Our Story</a></li>
					<li><a href="#">Terms of Use</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Contact Us</a></li>
				</ul>
			</div>
			<!-- /.widget -->
			<div class="widget">
				<h4 class="widget-title text-white mb-3">Follow Us</h4>
				<nav class="nav social social-white">
					<a href="#"><i class="uil uil-twitter"></i></a>
					<a href="#"><i class="uil uil-facebook-f"></i></a>
					<a href="#"><i class="uil uil-dribbble"></i></a>
					<a href="#"><i class="uil uil-instagram"></i></a>
					<a href="#"><i class="uil uil-youtube"></i></a>
				</nav>
				<!-- /.social -->
			</div>
			<!-- /.widget -->
		</div>
		<!-- /.offcanvas-body -->
	</div>
	<!-- /.offcanvas -->


</header>

    <?php
    	// Get CodeIgniter instance to access the framework's resources
        $ci =& get_instance();
    
        // Load the model
        $ci->load->model('Model_notification');
    
        // Call the method and assign the result to the variable
        $notification = $ci->Model_notification->getNotificationForWebsite();
        
        //   if(isset($_SESSION['registered_as'])){
        //   $user_type = ($_SESSION['registered_as'] == 1) ? "organisation" : "individual";
        //   }else{
        //     $user_type = 'website';
        //   }
        
        $notificationCount = count($notification) ? 1 : 0;
	?>



<?php
if ($notification){
     $nam = $notification[0]['id'] . $notification[0]['title'] . ($notification[0]['admin'] ? 'A' : '') . ($notification[0]['website'] ? 'W' : '') . ($notification[0]['organisation'] ? 'O' : '') . ($notification[0]['individual'] ? 'I' : '') . $notification[0]['expiration_date'];
	
        if($notification[0]['website']) {
            $show = 1;
            $nam .= 'website';
        } else {
            $show = 0;
        }
    } else {
        $show = 0;
        $nam = ' ';
    } 
?>

    <?php if($show): ?>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content text-center">
          <div class="modal-body" style="padding: 0px;padding-top: 2.5rem;">
            <h5 class="modal-title" id="exampleModalLongTitle" style="margin: 0px auto;"><?php echo $notification[0]['title']; ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <pre>
<?php echo $notification[0]['text']; ?>
            </pre>
            <div class="d-flex justify-content-between position-relative" style="padding-bottom: 15px;">
              <div class="d-flex justify-content-center flex-fill">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Okay</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php endif; ?>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    <?php if (isset($notificationCount)) { ?>
      var combinedData = "<?php echo $nam; ?>";
    
      // Function to get a cookie value
      function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length === 2) return parts.pop().split(";").shift();
      }
    
      // Function to set a cookie
      function setCookie(name, value, expirationDate) {
        var expires = "expires=" + expirationDate.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
      }
    
      // Function to delete a cookie
      function deleteCookie(name) {
        document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
      }
    
      $(document).ready(function() {
        // const skipButton = document.getElementById('skipButton');
    
        // skipButton.addEventListener('click', function() {
        //   $('#exampleModalCenter').modal('hide');
    
        //   // Make an AJAX request to update the $show variable on the server-side
        //   $.ajax({
        //     url: '', 
        //     method: '', 
        //     data: { show: 0 }, 
        //     success: function(response) {
        //       // The request was successful, you can handle the response if needed
        //       deleteCookie(combinedData);
        //     },
        //     error: function() {
        //       // Handle any errors that occurred during the AJAX request
        //     }
        //   });
        // });
    
        // Function to be executed when the modal is closed
        function onModalClose() {
          // Your code here to handle actions when the modal is closed
          console.log("Modal is closed.");
        }
    
        // Attach event listener to the modal's 'hidden.bs.modal' event
        $('#exampleModalCenter').on('hidden.bs.modal', function() {
          // Call the function when the modal is closed
          onModalClose();
        });
    
        // Check if the cookie exists (indicating the modal was shown before)
        if (!getCookie(combinedData)) {
          // If the cookie doesn't exist, show the modal
          $('#exampleModalCenter').modal('show');
          
          // Set a cookie to prevent the modal from showing again
          var expirationDate = new Date("<?= date('Y-m-d', strtotime($notification[0]['expiration_date'] . ' + 1 day')) ?>"); // Increment expiration date by 1 day
          setCookie(combinedData, 'true', expirationDate);
        }
    });
    <?php } ?>
</script>

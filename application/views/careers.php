<section class="wrapper bg-light">
      <div class="container">
        <div class="row gx-lg-8 gx-xl-12 gy-10 gy-xl-0  align-items-center">
          <div class="col-lg-7 order-lg-2">
            <figure><img class="img-auto" src="<?=base_url('assets/img/illustrations/i21.png')?>" srcset="./assets/img/illustrations/i21@2x.png 2x" alt="" /></figure>
          </div>
          <!-- /column -->
          <div class="col-md-10 offset-md-1 offset-lg-0 col-lg-5 text-center text-lg-start">
            <h1 class="display-1 fs-54 mb-5 mx-md-n5 mx-lg-0 mt-7">We are  <br class="d-md-none"> seeking <br class="d-md-none"><span class="rotator-fade text-primary">Competitors, Explorers, Executors, Contributors, Architects, Super Stars</span></h1>
            <p class="lead fs-lg mb-7">We are a globally recognized iOS augmentation firm, find your next job at Talrn.</p>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      <!-- /.container -->
    </section>
	 <section id="snippet-2" class="wrapper bg-light wrapper-border">
      <div class="container pt-15 pt-md-17 pb-13 pb-md-15">
        <h2 class="display-4 mb-3">The Talrn Hiring Process</h2>
        <p class="lead fs-lg mb-8">Hiring works best when it's a two-way street. That's why we help you get to know us and envision what your future role at Talrn might look like.</p>
        <div class="row ">
          <div class="col-md-6 col-lg-3"> <span class="icon btn btn-circle btn-lg btn-soft-primary disabled mb-4"><span class="number">01</span></span>
            <h4 class="mb-1">Chat With Us</h4>
            <p class="mb-0">If your application is a good match, our talent manager will invite you to a brief call.</p>
          </div>
          <!--/column -->
          <div class="col-md-6 col-lg-3"> <span class="icon btn btn-circle btn-lg btn-soft-primary disabled mb-4"><span class="number">02</span></span>
            <h4 class="mb-1">Complete Projects</h4>
            <p class="mb-0">Next, we'll send you a test project. Expect a second if all goes well.</p>
          </div>
          <!--/column -->
          <div class="col-md-6 col-lg-3"> <span class="icon btn btn-circle btn-lg btn-soft-primary disabled mb-4"><span class="number">03</span></span>
            <h4 class="mb-1">Meet Our Team</h4>
            <p class="mb-0">We'll talk between projects so we can learn more about each other.</p>
          </div>
          <!--/column -->
          <div class="col-md-6 col-lg-3"> <span class="icon btn btn-circle btn-lg btn-soft-primary disabled mb-4"><span class="number">04</span></span>
            <h4 class="mb-1">Hop Onboard!</h4>
            <p class="mb-0">If everyone thinks it's a good fit, we'll make you an offer to join.</p>
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
	  </section>
    <!-- /section -->
    <section class="wrapper bg-light">
      <div class="container py-14 py-md-16">
        <div class="row text-center">
          <div class="col-xl-10 mx-auto">
            <h2 class="fs-15 text-uppercase text-primary mb-3">Open Positions</h2>
            <h3 class="display-4 mb-10 px-xxl-15">Current openings at Talrn.</h3>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
       <!-- /.row -->
       <?php $this->load->view('current-openings'); ?>
      <!-- /.container -->
	  
    </section>
    <!-- /section -->
    <script type="text/javascript">

        history.pushState({}, null, '<?= base_url('careers') ?>');

    </script>

	

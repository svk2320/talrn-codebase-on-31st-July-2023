<!-- Bootstrap 4 JavaScript dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6" style="display:flex">
                    <h1 class="m-0 text-dark">Welcome back, <?php echo $_SESSION['name']; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('client') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard, Version 1.9.1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            
            <div class="row">
                <div class="col-lg-3 col-12">
                    <div class="small-box bg-info" style="background-color: #2c7dfa !important;">
                        <div class="inner firstRows">
                            <h3 style="display: inline">
                                <?php echo $no_of_profiles ?>
                            </h3>
                            <br>
                            <h3 style="display: inline; font-weight: 300; font-size: 32px;">
                                iOS Developers
                            </h3>
                            <p style="display:inline;"></p>
                            <br>
                            <p>
                                Available for work
                            </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="<?= base_url('profiles') ?>" class="small-box-footer" target="_blank">
                            Search for iOS Dev <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-9 col-12">
                    <div class="white-box">
                        <b>Book a quick 20-minute consultation call with Us</b>
                        <ul class="mt-2">
                            <li>15 mins: Review and create a complete JD to match the right IOS developer for your project.</li>
                            <li>5 mins: Find the right match and onboarding.</li>
                        </ul>
                        <a target="_blank" href="https://calendly.com/superlabs/discovery" style="margin-left:30px" class="btn btn-primary">Book a call&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    
    <div class="heading" style="margin-bottom:10px;margin-left:5px;font-size:20px;">
        <span style="font-size: 25px;">My Requirements</span>
        <span><a href="<?= base_url('client/requirements') ?>" style="text-decoration: underline; font-size: 16px;">View All</a></span>
    </div>
    
    <section>
        <div class="row gx-md-5 gy-5 position-relative" style="margin-right: 0px; margin-left: 0px;">
            <div class="slide-container swiper">
                <div class="slide-content">
                    <div class="card-wrapper swiper-wrapper">

                <?php foreach ($latest_jobs as $job) { ?>
                    <a href="<?= base_url('job/' . urlencode($job['url'])); ?>" class="card1 swiper-slide  lift h-100" target="_blank">
                        <div class="card-content1 p-5 d-flex flex-row">
                                  <div style="margin-right: 20px">
                                  <?php
                                    if (file_exists($job['company_logo'])) {
                                        echo '<img src="' . base_url($job['company_logo']) . '" class="avatar w-11 h-11 fs-20 me-4" id="profile-image">';
                                    } else {
                                        echo '<span class="avatar bg-yellow text-white w-11 h-11 fs-20 me-4">Dev</span>';
                                    }
                                  ?>
                                  </div>
                                  <div>
                                    <?php
                                if ($job['employment_type'] === 'FULL_TIME') {
                                    echo '<span class="badge1 bg-pale-blue text-blue  py-1 mb-2">Full Time</span>';
                                }
                                if ($job['employment_type'] === 'PART_TIME') {
                                    echo '<span class="badge1 bg-pale-blue text-blue  py-1 mb-2">Part Time</span>';
                                }
                                if ($job['employment_type'] === 'CONTRACTOR') {
                                    echo '<span class="badge1 bg-pale-blue text-blue  py-1 mb-2">Contract</span>';
                                }
                                if ($job['employment_type'] === 'TEMPORARY') {
                                    echo '<span class="badge1 bg-pale-blue text-blue  py-1 mb-2">Temporary</span>';
                                }
                                if ($job['employment_type'] === 'SEASONAL') {
                                    echo '<span class="badge1 bg-pale-blue text-blue  py-1 mb-2">Seasonal</span>';
                                }
                                if ($job['employment_type'] === 'INTERN') {
                                    echo '<span class="badge1 bg-pale-blue text-blue  py-1 mb-2">Internship</span>';
                                }
                                ?>
                                 <?php
                                    if ($job['creation_date'] != '') {
                                        $date = date_create($job['creation_date']);
                                        $formattedDate = date_format($date, 'jS M Y');
                                        echo '<span style="font-size: 13px; margin-left: 11px; color:blue;"> Date: ' . $formattedDate . '</span>';
                                    }
                                    ?>
                                    <h4 class="mb-1" style="width: 230px;
                                            white-space: nowrap;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                        }"> <?= $job['job_title'] ?>
                                    <?php if ($job['experience'] != 0) {
                                        echo ", " . $job['experience'] . "+ years";
                                    } ?></h4>
                                    <?php
                                    if ($job['technical_skills'] != '') {
                                        $skills = explode(',', $job['technical_skills']); // Split skills into an array
                                        $numSkills = count($skills); // Count the number of skills

                                        // Display the first three skills separately
                                        for ($i = 0; $i < min($numSkills, 3); $i++) {
                                            if(strlen($skills[$i])>=7){
                                                echo '<span class="badge1 bg-pale-blue text-blue py-1 mb-2" style="margin-right:2px;">' . substr(trim($skills[$i]),0,7) . '..</span> ';
                                            } 
                                            else{
                                                echo '<span class="badge1 bg-pale-blue text-blue py-1 mb-2" style="margin-right:2px;">' . trim($skills[$i]) . '</span> ';
                                            }
                                        }
                                        if ($numSkills > 3){
                                          echo '<span class="badge1 bg-pale-blue text-blue rounded py-1 mb-2" style="margin-right:2px;">' . ($numSkills - 3) . ' + </span>';
                                        }
                                    }
                                    ?>
                                    <p class="mb-0 text-body" style="font-size: 18px;color:#60697B"><?php
                                    if ($job['job_location_type'] === 'TELECOMMUTE') {
                                        echo 'Remote';
                                    }
                                    if ($job['job_location_type'] === 'WORK_FROM_HOME') {
                                        echo 'WFH';
                                    }
                                    if ($job['job_location_type'] === 'WORK_FROM_ANYWHERE') {
                                        echo 'WFA';
                                    }
                                    if ($job['job_location_type'] === 'ONSITE') {
                                        echo 'Onsite';
                                    }
                                    ?>
                                    <?php if ($job['location'] != '') {
                                        echo ", " . $job['location'];
                                    } ?></p>
                                    <!-- <div data-toggle="popover" class="bg-pale-blue text-blue" style="width: 154px; text-decoration: underline; color: blue;" data-offset="0,5" data-trigger="hover" data-placement="top" data-html="true" data-content="33 IOS Dev's match your job description">
                                        Suitable Candidates:32
                                    </div> -->
                                  </div>
                        </div>
                    </a>

                <?php } ?>

                    <a href="<?= base_url('client/requirements/create') ?>" class="card1 swiper-slide  lift" style="height:175px;font-size:20px;overflow: hidden;">
                        <div class="card-content1 align-items-center text-center">
                            <div class="mb-0 text-body" style="font-size: 24px;color:#60697B;"> 
                                Create your <br> iOS developer <br> requirement <br> <span style="font-size: 30px;"> + </span>
                            </div>
                        </div>
                    </a>

                </div>
                </div>
            </div>
            <div class="swiper-navBtns">
                <div class="swiper-button-prev swiper-navBtn"></div>
                <div class="swiper-button-next swiper-navBtn"></div>
            </div>
        </div>
    </section>
    
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        $("#dashboard").addClass('active');
    });
</script>


<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
     var swiper = new Swiper(".slide-content", {
          slidesPerView: 4,
          spaceBetween: 10,
          // loop: true,
        //   centerSlide: 'true',
          fade: 'true',
          resistance:'false',
          grabCursor: 'true',
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
          },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
          breakpoints:{
              0: {
                  slidesPerView: 1 ,
              },
              400: {
                  slidesPerView: 1,
              },
              800: {
                  slidesPerView: 2,
              },
              1200: {
                  slidesPerView: 3,
              },
          },
        });

    function initializePopovers() {
        $(function() {
            $('[data-toggle="popover"]').popover({
                trigger: 'manual', // Initialize the popover with 'manual' trigger
                template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
            }).on('mouseenter', function() {
                var _this = this;
                $(this).popover('show');
                $('.popover').on('mouseleave', function() {
                    $(_this).popover('hide');
                });
            }).on('mouseleave', function() {
                var _this = this;
                setTimeout(function() {
                    if (!$('.popover:hover').length) {
                        $(_this).popover('hide');
                    }
                }, 100);
            });
        });
    }

    initializePopovers();
</script>

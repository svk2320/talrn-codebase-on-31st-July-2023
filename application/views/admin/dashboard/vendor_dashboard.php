<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Bootstrap 4 JavaScript dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>

<link media="all" rel="stylesheet" href="<?php echo base_url() . $this->config->item('css') . 'admin-vendor-dashboard.css' ?>">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Welcome to Talrn Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Dashboard, Version 1.9.1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">

      <div class="container-fluid">
        <div class="row">

          <div class="col-lg-3 col-12">
            <div class="small-box bg-info">
              <div class="inner">
                <h3 style="display:inline;">
                  <?php echo $profile_view_count_vendor ?>
                </h3>
                <p style="display:inline;">Total Profile Views</p>
                <br>
                <p></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('admin/vendor/list') ?>" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-12">
            <div class="small-box bg-info">
              <div class="inner">
                <h3 style="display:inline;">
                  <?php echo $profile_pdf_count_vendor ?>
                </h3>
                <p style="display:inline;">Total PDF Downloads</p>
                <br>
                <p></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('admin/vendor/list') ?>" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-12">
            <div class="small-box bg-info">
              <div class="inner">
                <h3 style="display:inline;">
                  <?php echo $profile_share_count_vendor ?>
                </h3>
                <p style="display:inline;">Total Profile Shared</p>
                <br>
                <p></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('admin/vendor/list') ?>" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-12">
            <div class="small-box bg-info">
              <div class="inner">
                <h3 style="display:inline;">
                  <?php echo $profile_hire_count_vendor ?>
                </h3>
                <p style="display:inline;">Hire button Clicked</p>
                <br>
                <p></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('admin/vendor/list') ?>" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    
<div class="heading" style="margin-bottom:10px;margin-left:5px;font-size:20px;">
      Recommended Jobs 
    <span><a href="<?= base_url('remote-ios-jobs') ?>" target="_blank">View All</a></span>
</div>

<div class="row  gx-md-5 gy-5 position-relative">

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
                                  <div style="margin-top: 20px;" data-toggle="popover" data-offset="0,5" data-trigger="hover" data-placement="top" data-html="true" data-content="<?php echo (round($job['match_percentage']) > 20) ? 'Based on ' . (array_key_exists('best_org_unique_id', $job) ? '<a href='. $job['best_org_profile_url'] .'>' . $job['best_org_unique_id'] . '</a>' : ' your') . ' technical skills' : (($job['no_profiles'] ? "You have no approved profiles to show job match %" :"Review your technical skills")); ?>">
                                      <div role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="--value: <?php echo (round($job['match_percentage']) > 20) ? round($job['match_percentage']) : 60; ?>; --primary: <?php echo (round($job['match_percentage']) > 20) ? '#3CB048' : '#A9A9A9'; ?>; --seconday: <?php echo (round($job['match_percentage']) > 20) ? '#fff' : '#A9A9A9'; ?>; color: <?php echo (round($job['match_percentage']) > 20) ? '#3CB048' : '#777B7E'; ?>;"><?php echo (round($job['match_percentage']) > 20) ? round($job['match_percentage']) .'%' : (($job['no_profiles'] ? "" :"Low")) ?></div>
                                      <div class='progress-text' style="color: <?php echo (round($job['match_percentage']) > 20) ? '#3CB048' : '#777B7E'; ?>; margin-left: 13px;"> Match <?php echo $job['no_profiles'] ? " % " : ""; ?></div>
                                      <div class='progress-text' style="color: #777B7E; margin-top: -4px;"><?php echo $job['no_profiles'] ? " unavailable" : ""; ?></div>
                                  </div>
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
                                        echo '<span style="font-size: 13px; margin-left: 11px; color:blue;"> Date published: ' . $formattedDate . '</span>';
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
                                  </div>
                        </div>
                    </a>

                <?php } ?>
                    <a href="<?= base_url('remote-ios-jobs') ?>" class="card1 swiper-slide  lift" style="height:213px;font-size:20px" target="_blank">
                        <div class="card-content1 align-items-center text-center">
                                 
                                  <div>
                                    <p class="mb-0 text-body" style="font-size: 18px;color:#60697B;margin-top:44px;">Want to see more such jobs?</p></p>
                                    Browse all iOS Jobs
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
        </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
                      
          <?php if (in_array('viewVendor', $user_permission)) { ?>
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Vendor Information</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">View all Vendors.</h6>


                <p class="card-text">Get list of all Vendor information.</p>
                <a href="<?= base_url('admin/stores/') ?>" class="btn btn-primary">View Vendors</a>
              </div>
            </div>
          <?php } ?>
          <?php if ($awaiting_changes_count > 0) { ?>
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="m-0">Profile Awaiting Changes</h5>
            </div>
            <div class="card-body">
              <h6 class="card-title"> <?=$awaiting_changes_count?> <?php echo ($awaiting_changes_count > 1) ? "profiles are" : "profile is"; ?> "awaiting changes". Please fix this so the profile goes live on Talrn and shown to potential clients </h6>
              </h6>


              <p class="card-text"></p>
              <a href="<?= base_url('admin/vendor/list') ?>" class="btn btn-primary">Profile list</a>
            </div>
          </div>
          <?php } ?>
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="m-0">Account Information</h5>
            </div>
            <div class="card-body">
              <h6 class="card-title">Get started with your Account information.</h6>

              <p class="card-text">Quickly update information.</p>
              <a href="<?= base_url('admin/users/setting/') ?>" class="btn btn-primary">Edit Info</a>
            </div>
          </div>
          <?php if (in_array('modifyProfile', $user_permission)) { ?>
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="m-0">Upload Profile</h5>
            </div>
            <div class="card-body">
              <h6 class="card-title">Please Upload your profile</h6>
              </h6>


              <p class="card-text"></p>
              <a href="<?= base_url('admin/vendor') ?>" class="btn btn-primary">Upload</a>
            </div>
          </div>
          <?php } ?>
          <!-- /.card -->
          
          <!-- /.card -->

        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">
         

          <!-- <div class="card card-primary card-outline" >
            <div class="card-header">
              <h5 class="m-0">Talrn Bussiness</h5>
            </div>
            <div class="card-body">
              <h6 class="card-title">Get started with your Account information.</h6>

              <p class="card-text">Quickly update information.</p>
              <a href="<?= base_url('admin/dashboard/bussiness') ?>" class="btn btn-primary">Bussiness</a>
            </div>
          </div> -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Recent Searches</h3>
            </div>
            <div class="card-header">
              <h3 class="card-title">Update your profile skills to get matched on projects</h3>
            </div>
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                <?php foreach ($search_reports as $search_data) { ?>
                  <li class="item">
                    <div class="product-info">
                      <?php
                      $skills_list = explode(",", $search_data['skills']);
                      foreach ($skills_list as $skill) {
                        echo '<span class="badge badge-info">' . $skill . '</span> ';
                      }
                      ?>
                    </div>
                  </li>
                <?php } ?>

              </ul>
            </div>

          </div>
        </div>
        <!-- /.col-md-6 -->
      </div>
    </div>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function () {
    $("#mainNav").addClass('active');
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
</script>


<script>
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

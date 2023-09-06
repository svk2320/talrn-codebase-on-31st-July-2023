<!-- Bootstrap JavaScript dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>

<link media="all" rel="stylesheet" href="<?php echo base_url() . $this->config->item('css') . 'jobs.css' ?>">

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
        <div class="row gy-6">

            <?php foreach ($job_list as $job) { ?>
                <div class="col-md-6 col-lg-4">
                    <a href="<?= base_url('job/' . urlencode($job['url'])); ?>" class="card shadow-lg lift h-100">
                        <div class="card-body p-5 d-flex flex-row">
                            <div>
                                <?php
                                if (file_exists($job['company_logo'])) {
                                    echo '<img src="' . base_url($job['company_logo']) . '" class="avatar w-11 h-11 fs-20 me-4" id="profile-image">';
                                } else {
                                    echo '<span class="avatar bg-yellow text-white w-11 h-11 fs-20 me-4">Dev</span>';
                                }
                                ?>
                                <div class="row">
                                    <div style="margin-top: 20px;">
                                          <div role="progressbar" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-html = "true" data-bs-content="<?php echo $userType != 0 && (round($job['match_percentage']) > 20) ? ($userType == 1 && (round($job['match_percentage']) > 20) ? 'Based on ' . (array_key_exists('best_org_unique_id', $job) ? '<a href='. $job['best_org_profile_url'] .'>' . $job['best_org_unique_id'] . '</a>' : ' your') . ' technical skills' : "Based on your technical skills") : ($userType != 0 ? ($job['no_profiles'] ? "You have no approved profiles to show job match %" :"Review your technical skills") : "<a href='". base_url('admin/auth/login') ."'> Login</a> or <a href='". base_url('join') ."'>sign up</a> to know your profile Match %"); ?>" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="margin-left: -1px; --value: <?php echo $userType != 0 && (round($job['match_percentage']) > 20) ? round($job['match_percentage']) : 0; ?>; --primary: <?php echo $userType != 0 && (round($job['match_percentage']) > 20) ? '#3CB048' : '#A9A9A9'; ?>; --seconday: <?php echo $userType != 0 && (round($job['match_percentage']) > 20) ? '#fff' : '#A9A9A9'; ?>; color: <?php echo $userType != 0 && (round($job['match_percentage']) > 20) ? '#3CB048' : '#777B7E'; ?>;"><?php echo $userType != 0 && (round($job['match_percentage']) > 20) ? round($job['match_percentage']) .'%' :($userType != 0 ? (!($job['no_profiles']) && $userType != 0 ? "Low" : "") : ""); ?></div>
                                          <div class='progress-text' style="color: <?php echo $userType != 0 && (round($job['match_percentage']) > 20) ? '#3CB048; width: 58px !important;' : '#777B7E; width: 58px !important;'; ?> text-align: center !important; "> Match <?php echo $userType == 0 || $job['no_profiles'] ? " % " : ""; ?> </div>
                                          <div class='progress-text' style="color: #777B7E; margin-top: -4px; margin-left: -5px;"><?php echo $userType == 0 || $job['no_profiles'] ? " unavailable" : ""; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <?php
                                if ($job['employment_type'] === 'FULL_TIME') {
                                    echo '<span class="badge bg-pale-blue text-blue rounded py-1 mb-2">Full Time</span>';
                                }
                                if ($job['employment_type'] === 'PART_TIME') {
                                    echo '<span class="badge bg-pale-blue text-blue rounded py-1 mb-2">Part Time</span>';
                                }
                                if ($job['employment_type'] === 'CONTRACTOR') {
                                    echo '<span class="badge bg-pale-blue text-blue rounded py-1 mb-2">Contract</span>';
                                }
                                if ($job['employment_type'] === 'TEMPORARY') {
                                    echo '<span class="badge bg-pale-blue text-blue rounded py-1 mb-2">Temporary</span>';
                                }
                                if ($job['employment_type'] === 'SEASONAL') {
                                    echo '<span class="badge bg-pale-blue text-blue rounded py-1 mb-2">Seasonal</span>';
                                }
                                if ($job['employment_type'] === 'INTERN') {
                                    echo '<span class="badge bg-pale-blue text-blue rounded py-1 mb-2">Internship</span>';
                                }
                                ?>
                                 <?php
                                    if ($job['creation_date'] != '') {
                                        $date = date_create($job['creation_date']);
                                        $formattedDate = date_format($date, 'jS M Y');
                                        echo '<span style="font-size:12px;margin-left: 5px;">' . $formattedDate . '</span>';
                                    }
                                    ?>

                                <h4 class="mb-1">
                                    <?= $job['job_title'] ?>
                                    <?php if ($job['experience'] != 0) {
                                        echo ", " . $job['experience'] . "+ years";
                                    } ?>
                                </h4>
                                <?php
                                    if ($job['technical_skills'] != '') {
                                        $skills = explode(',', $job['technical_skills']); // Split skills into an array
                                        $numSkills = count($skills); // Count the number of skills

                                        // Display the first three skills separately
                                        for ($i = 0; $i < min($numSkills, 3); $i++) {
                                            echo '<span class="badge bg-pale-blue text-blue rounded py-1 mb-2" style="margin-right:2px;">' . trim($skills[$i]) . '</span>';
                                            
                                        }
                                        
                                        if ($numSkills > 3){
                                            echo '<span class="badge bg-pale-blue text-blue rounded py-1 mb-2" style="margin-right:2px;">' . ($numSkills - 3) . ' + </span>';
                                        }
                                    }
                                    ?>
                                <p class="mb-0 text-body">
                                    <?php
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
                                    } ?>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <div class="pagination-container">
            <?php if (isset($links))
                    echo $links; ?>
            </div>
        </div> <!-- /.container -->

</section>
<script type="text/javascript">

        history.pushState({}, null, '<?= base_url('remote-ios-jobs') ?>');

</script>

<script>
    function initializePopovers() {
      $(function() {
        $('[data-bs-toggle="popover"]').popover({
          trigger: 'manual' // Initialize the popover with 'manual' trigger
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

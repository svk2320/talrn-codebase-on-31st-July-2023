<link media="all" rel="stylesheet" href="<?php echo base_url() . $this->config->item('css') . 'job.css' ?>">

<!-- /section -->
<section class="wrapper bg-soft-primary">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="blog single  py-3">
                <?php if($job_details[0]['type'] == 'admin' || $job_details[0]['approval'] == '1' ){ ?>
                    <div class="text-muted py-4">
                        <i class="uil uil-arrow-left"></i> <a href="<?= base_url(); ?>">Home</a> / <a
                            href="<?= base_url('remote-ios-jobs'); ?>">Jobs</a> /
                        <?php echo $job_details[0]['jd_id']; ?>
                    </div>
                <?php } ?>
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <a class="btn btn-sm btn-outline-primary share-link" onclick="navigator.share({url:''});">
                                <i class="fa fa-share-alt"></i>
                            </a>
                            <div class="row text-center">
                                <div class="col-md-10 col-xl-8 mx-auto">
                                    <div class="post-header">
                                        <h1 class="job-title mb-5">
                                            <?= $job_details[0]['job_title'] ?>
                                        </h1>
                                        <ul class="post-meta fs-17 mb-5">

                                            <?php
                                            if ($job_details[0]['employment_type'] === 'FULL_TIME') {
                                                echo '<li><i class="uil uil-clock"></i>Full Time</li>';
                                            }
                                            if ($job_details[0]['employment_type'] === 'PART_TIME') {
                                                echo '<li><i class="uil uil-clock"></i>Part Time</li>';
                                            }
                                            if ($job_details[0]['employment_type'] === 'CONTRACTOR') {
                                                echo '<li><i class="uil uil-clock"></i>Contract</li>';
                                            }
                                            ?>

                                            <?php if ($job_details[0]['location'] != '') {
                                                echo '<li><i class="uil uil-location-arrow"></i>' . $job_details[0]['location'] . '</li>';
                                            } ?>

                                            <?php
                                            if ($job_details[0]['job_location_type'] === 'TELECOMMUTE') {
                                                echo '<li><i class="uil uil-building"></i>Remote</li>';
                                            }
                                            if ($job_details[0]['job_location_type'] === 'WORK_FROM_HOME') {
                                                echo '<li><i class="uil uil-building"></i>WFH</li>';
                                            }
                                            if ($job_details[0]['job_location_type'] === 'WORK_FROM_ANYWHERE') {
                                                echo '<li><i class="uil uil-building"></i>WFA</li>';
                                            }
                                            if ($job_details[0]['job_location_type'] === 'ONSITE') {
                                                echo '<li><i class="uil uil-building"></i>Onsite</li>';
                                            }
                                            ?>
                                            <?php if ($job_details[0]['experience'] > 0) {
                                                echo '<li><i class="uil uil-hourglass"></i>' . $job_details[0]['experience'] . '+ years </li>';
                                            } ?>


                                        </ul>
                                        <!-- /.post-meta -->
                                    </div>
                                    <!-- /.post-header -->
                                </div>
                                <!-- /column -->
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <h4>Mandatory Technical Skills:</h4>
                                    <?php
                                    $skills_array = explode(', ', $job_details[0]['technical_skills']);
                                    foreach ($skills_array as $skill) {
                                        echo '<span class="badge bg-pale-blue text-blue rounded py-1 mb-2">' . $skill . '</span> ';
                                    }
                                    ?>
                                </div>
                                
                                <div class="col-md-2 d-none d-md-flex align-items-center">
                                    <div class="d-flex justify-content-between align-items-center" style="position: absolute; right: 2%;">
                                        <div style="position: absolute; left: -91%;">
                                            <div style="margin-top: 20px; display: flex; flex-direction: column; align-items: center;">
                                              <div role="progressbar" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-html = "true" data-bs-content="<?php echo $userType != 0 && (round($job_details[0]['match_percentage']) > 20) ? ($userType == 1 && (round($job_details[0]['match_percentage']) > 20) ? 'Based on ' . ((is_array($job_details[0]) && array_key_exists('best_org_unique_id', $job_details[0])) ? '<a href='. $job_details[0]['best_org_profile_url'] .'>' . $job_details[0]['best_org_unique_id'] . '</a>' : ' your') . ' technical skills' : "Based on your technical skills") : ($userType != 0 ? ($job_details[0]['no_profiles'] ? "You have no approved profiles to show job match %" :"Review your technical skills") : "<a href='". base_url('admin/auth/login') ."'> Login</a> or <a href='". base_url('join') ."'>sign up</a> to know your profile Match %"); ?>" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="<?php echo ($userType == 0 || $job_details[0]['no_profiles']) ? 'margin-left: -10px;' : '' ?>  --value: <?php echo $userType != 0 && (round($job_details[0]['match_percentage']) > 20) ? round($job_details[0]['match_percentage']) : 0; ?>; --primary: <?php echo $userType != 0 && (round($job_details[0]['match_percentage']) > 20) ? '#3CB048' : '#A9A9A9'; ?>; --seconday: <?php echo $userType != 0 && (round($job_details[0]['match_percentage']) > 20) ? '#fff' : '#A9A9A9'; ?>; color: <?php echo $userType != 0 && (round($job_details[0]['match_percentage']) > 20) ? '#3CB048' : '#777B7E'; ?>;"><?php echo $userType != 0 && (round($job_details[0]['match_percentage']) > 20) ? round($job_details[0]['match_percentage']) .'%' :($userType != 0 ? (!($job_details[0]['no_profiles']) && $userType != 0 ? "Low" : "") : ""); ?></div>
                                              <div class='progress-text' style="color: <?php echo $userType != 0 && (round($job_details[0]['match_percentage']) > 20) ? '#3CB048' : '#777B7E'; ?>; "> Match <?php echo $userType == 0 || $job_details[0]['no_profiles'] ? " % " : ""; ?> </div>
                                              <div class='progress-text' style="color: #777B7E; margin-top: -4px;"><?php echo $userType == 0 || $job_details[0]['no_profiles'] ? " unavailable" : ""; ?></div>
                                            </div>
                                            <div class='progress-text' style="font-size: 10px; color: <?php echo $userType == 1 && (round($job_details[0]['match_percentage']) > 20) ? '#2c7dfa' : '#777B7E'; ?>;" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-html = "true" data-bs-content="<?php echo $userType != 0 && (round($job_details[0]['match_percentage']) > 20) ? "This profiles matches the JD most" : ""; ?>"><?php echo $userType == 1 && (round($job_details[0]['match_percentage']) > 20) ? $job_details[0]['best_org_unique_id'] : ''; ?></div>
                                        </div>
                                        
                                        <button class="btn btn-primary btn-sm" onclick="apply()" id="buttonOne"
                                            <?php if ($already_applied) {
                                                echo 'disabled';
                                            } ?>>
                                            <?php if ($already_applied) {
                                                echo '<i class="fas fa-check"></i> Applied';
                                            } else {
                                                echo 'Apply';
                                            } ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-send" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>


                            </div>
                            <h3 class="h2 pt-5">Job Description</h3>
                            <p>
                                <?php echo $job_details[0]['job_description']; ?>
                            </p>
                            <br>
                            <!--/.row -->
                            <?php if ($job_details[0]['interview_rounds'] > 0) { ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>Interview Rounds:</h4>
                                    </div>
                                    <div class="col-md-8">
                                        <p>
                                            <?php echo $job_details[0]['interview_rounds']; ?>
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($job_details[0]['budget_min'] > 0 || $job_details[0]['budget_max'] > 0) { ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>Budget:</h4>
                                    </div>
                                    <div class="col-md-8">
                                        <?php if ($job_details[0]['hide_budget'] == 0) { ?>
                                            <p>
                                                <?php echo $job_details[0]['budget_currency']; ?>
                                                <?php echo $job_details[0]['budget_min']; ?> -
                                                <?php echo $job_details[0]['budget_currency']; ?>
                                                <?php echo $job_details[0]['budget_max']; ?>
                                            </p>
                                        <?php } else { ?>
                                            <p>Not disclosed</p>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>Valid Through:</h4>
                                </div>
                                <div class="col-md-8">
                                    <p>
                                        <?php
                                        $date = new DateTime($job_details[0]['valid_through']);
                                        echo $date->format('jS F Y');
                                        ?>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                            <button class="btn btn-primary" onclick="apply()" id="buttonTwo" 
                            <?php if ($already_applied){
                                echo 'disabled > <i class="fas fa-check"></i> Applied';
                            }
                            else{
                                echo '>Apply';
                            }
                            ?>
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-left:10px;" width="16"
                                    height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                    <path
                                        d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                                </svg>
                            </button>
                            
                            <div style="margin-top: 20px; margin-left: 45px; display: flex; flex-direction: column; align-items: center;">
                                <div>
                                  <div role="progressbar" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-html = "true" data-bs-content="<?php echo $userType != 0 && (round($job_details[0]['match_percentage']) > 20) ? ($userType == 1 && (round($job_details[0]['match_percentage']) > 20) ? 'Based on ' . ((is_array($job_details[0]) && array_key_exists('best_org_unique_id', $job_details[0])) ? '<a href='. $job_details[0]['best_org_profile_url'] .'>' . $job_details[0]['best_org_unique_id'] . '</a>' : ' your') . ' technical skills' : "Based on your technical skills") : ($userType != 0 ? ($job_details[0]['no_profiles'] ? "You have no approved profiles to show job match %" :"Review your technical skills") : "<a href='". base_url('admin/auth/login') ."'> Login</a> or <a href='". base_url('join') ."'>sign up</a> to know your profile Match %"); ?>" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style=" <?php echo ($userType == 0 || $job_details[0]['no_profiles']) ? 'margin-left: 5px;' : '' ?> --value: <?php echo $userType != 0 && (round($job_details[0]['match_percentage']) > 20) ? round($job_details[0]['match_percentage']) : 0; ?>; --primary: <?php echo $userType != 0 && (round($job_details[0]['match_percentage']) > 20) ? '#3CB048' : '#A9A9A9'; ?>; --seconday: <?php echo $userType != 0 && (round($job_details[0]['match_percentage']) > 20) ? '#fff' : '#A9A9A9'; ?>; color: <?php echo $userType != 0 && (round($job_details[0]['match_percentage']) > 20) ? '#3CB048' : '#777B7E'; ?>;"><?php echo $userType != 0 && (round($job_details[0]['match_percentage']) > 20) ? round($job_details[0]['match_percentage']) .'%' :($userType != 0 ? (!($job_details[0]['no_profiles']) && $userType != 0 ? "Low" : "") : ""); ?></div>
                                   <div class='progress-text' style="color: <?php echo $userType != 0 && (round($job_details[0]['match_percentage']) > 20) ? '#3CB048;' : '#777B7E; text-align: center !important; '; ?>"> Match <?php echo $userType == 0 || $job_details[0]['no_profiles'] ? " % " : ""; ?> </div>
                                   <div class='progress-text' style="color: #777B7E; margin-top: -4px;"><?php echo $userType == 0 || $job_details[0]['no_profiles'] ? " unavailable" : ""; ?></div>
                                  
                                </div>
                                <div class='progress-text' style="font-size: 10px; color: <?php echo $userType == 1 && (round($job_details[0]['match_percentage']) > 20) ? '#2c7dfa' : '#777B7E'; ?>; margin-left: 48px;" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-html = "true" data-bs-content="<?php echo $userType != 0 && (round($job_details[0]['match_percentage']) > 20) ? "This profiles matches the JD most" : " "; ?>"><?php echo $userType == 1 && (round($job_details[0]['match_percentage']) > 20) ? $job_details[0]['best_org_unique_id'] : ''; ?></div>
                            </div>
                            
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.blog -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

  <!-- Bootstrap 5 JS scripts (Make sure you have jQuery and Popper.js included before this) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<div class="modal fade" id="noApprovedProfile" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content text-center">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <p class="lead mb-6 text-start">Your account does not have any approved profile to apply to this Job</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ApplySuccess" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content text-center">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <p class="lead mb-6 text-start">You have successfully applied for this job! </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="clientLogIn" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content text-center">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <p class="lead mb-6 text-start">You need to be logged into a vendor account to apply for this job! </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="notLogIn" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content text-center">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <h2 class="mb-3 text-start">Login to Apply</h2>
        <p class="lead mb-6 text-start">Fill your email and password to sign in.</p>
        <form class="text-start mb-3" action="<?php echo base_url('admin/auth/login') ?>" method="post" target="_blank" onsubmit="closeModal()">
          <div class="form-floating mb-4">
            <input type="email" class="form-control" name="email" placeholder="Email" id="loginEmail" >
            <label for="loginEmail">Email</label>
          </div>
          <div class="form-floating password-field mb-4">
            <input type="password" class="form-control" name="password" placeholder="Password" id="loginPassword">
            <span class="password-toggle"><i class="uil uil-eye"></i></span>
            <label for="loginPassword">Password</label>
          </div>
          <button class="btn btn-primary rounded-pill btn-login w-100 mb-2" type="submit" >Sign In</button>
        </form>
        <!-- /form -->
        <p class="mb-1"><a href="<?php echo base_url('forgot-password') ?>" class="hover"  target="_blank" >Forgot Password?</a></p>
        <p class="mb-0">Don't have an account? <a href="<?php echo base_url('join') ?>" class="hover"  target="_blank">Sign up</a></p>
        <!--/.social -->
      </div>
      <!--/.modal-content -->
    </div>
    <!--/.modal-body -->
  </div>
  <!--/.modal-dialog -->
</div>
<!--/.modal -->

<script>
    function closeModal() {
        // Close the modal by its ID
        $('#notLogIn').modal('hide');
        
        setTimeout(function() {
          location.reload(); // Reload the page after 2 seconds
        }, 500);
    }
</script>

<script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "JobPosting",
      "title": "<?php echo $job_details[0]['job_title']; ?>",
      "description": <?php echo json_encode($job_details[0]['job_description'], JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS); ?>,
      "url" : "<?php echo base_url('job/') . urlencode($job_details[0]['url']); ?>",
      "datePosted": "<?php echo $job_details[0]['date']; ?>",
      "validThrough": "<?php echo $job_details[0]['valid_through']; ?>",
      "employmentType": "<?php echo $job_details[0]['employment_type']; ?>",
      "hiringOrganization": {
        "@type": "Organization",
        "name": "Talrn",
        "sameAs": "https://www.Talrn.com/"
      },
      <?php if ($job_details[0]['location'] != '') { ?>
          "jobLocation": {
            "@type": "Place",
            "address": {
              "@type": "PostalAddress",
              "addressLocality": "<?php echo $job_details[0]['location']; ?>",
              "addressRegion": "",
              "addressCountry": ""
            }
          },
      <?php } ?>
      <?php if ($job_details[0]['job_location_type'] == 'TELECOMMUTE') { ?>
          "jobLocationType": "<?php echo $job_details[0]['job_location_type']; ?>",
          "applicantLocationRequirements": {
            "@type": "Country",
            "name": "Any country"
        },
      <?php } ?>
      <?php if ($job_details[0]['experience'] > 0) { ?>
          "experienceRequirements" : {
                "@type" : "OccupationalExperienceRequirements",
                "monthsOfExperience" : "<?php echo $job_details[0]['experience'] * 12; ?>"
              },
          <?php } ?>
      "baseSalary": {
        "@type": "MonetaryAmount",
        "currency": "<?php echo $job_details[0]['budget_currency']; ?>",
        "value": {
          "@type": "QuantitativeValue",
          "minValue": <?php echo $job_details[0]['budget_min']; ?>,
          "maxValue": <?php echo $job_details[0]['budget_max']; ?>,
          "unitText": "MONTH"
        }
      }
    }
</script>

<script>
    var base_url = "<?php echo base_url(''); ?>";
    var jobId = "<?php echo $job_details[0]['jd_id']; ?>";
    
    function OrgTable(data){
        tableRow = '';
        
        function capitalizeFirstWord(str) {
          return str.charAt(0).toUpperCase() + str.slice(1);
        }
        
        for(i=0; i<data.length; i++) { 

            const isApplied = data[i]['applied'] === '1';

            tableRow += `<tr>
                  <td class="table-data">${data[i]['unique_id']}</td>
                  <td class="table-data">${capitalizeFirstWord(data[i]['first_name']) + ' ' + capitalizeFirstWord(data[i]['last_name'])}</td>
                  <td class="table-data">${data[i]['match_percentage'] + '%'}</td>
                  <td class="table-data" style="text-align: center;">
                    <button class="btn btn-primary custom-button" id="${data[i]['unique_id']}" style="100px; height: 43px;" onclick="apply('${data[i]['unique_id']}')" ${isApplied ? 'disabled' : ''} ${(data[i]['approval'] == 1) ? '' : 'disabled'}>
                      ${(data[i]['approval'] == 0) ? '<span style="font-size: 14px;" class="custom-text">Pending Approval</span>' : isApplied ? '<span style="font-size: 15px;" class="custom-text"><i class="fas fa-check"></i> &nbsp; Applied</span>' : '<span style="font-size: 14px;" class="custom-text">Apply</span>'}
                    </button>
                  </td>
                </tr>`;
        }
        
        CustomModal = `
                    <div class="modal fade" id="OrgTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header" style="padding: 50px 19px 4px; text-align: center;">
                              <h3 class="modal-title" id="exampleModalLabel">Choose a profile to apply for this job</h3>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body table-body">
                              <div class="">
                                <table class="table">
                                  <!--Modal body -->
                                  <thead>
                                    <tr>
                                      <th class="table-data unique_id">Unique Id</th>
                                      <th class="table-data">Name</th>
                                      <th class="table-data">Match%</th>
                                      <th class="table-data action-th" style="text-align: center;">Actions</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                        ${tableRow}
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>`;
            
            // Append the modal HTML code to the body
        $('body').append(CustomModal);
        
        var modalElement = $('#OrgTable');

        modalElement.on('hidden.bs.modal', function () {
           // Remove the modal element from the DOM
           modalElement.remove();
        });
        
        $('#OrgTable').modal('show');
    }
    
    function apply(unique_id = null) {
        let formData = new FormData();
        
        formData.append("jobId", jobId);
        formData.append("unique_id", unique_id);
        
        // Send the data via AJAX to the server
        $.ajax({
            url: base_url + 'jobs/applyJob', 
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                
                var responses = JSON.parse(response);
                
                if (responses.login_status == 'not logged in') {
                   
                    if(responses.hasOwnProperty('type')){
                      $('#clientLogIn').modal('show');
                    }else{
                      $('#notLogIn').modal('show');
                    }
                } else if (responses.userType == 1) {
                    if (responses.list.length == 0){
                        $('#noApprovedProfile').modal('show');
                    } else {
                        OrgTable(responses.list);
                        
                    }
                } else if (responses.userType == 'subprofiles') {
                    var button = document.getElementById(responses.unique_id);
                    
                    button.innerHTML = '<i class="fas fa-check"></i>Applied';
                    button.disabled = true;
                } else if (responses.userType == 2 && responses.unique_id == null) {
                    $('#noApprovedProfile').modal('show');   
                }else if (responses.userType == 2) {
                    var buttonOne = document.getElementById('buttonOne');
                    var buttonTwo = document.getElementById('buttonTwo');
                    
                    var sendIcon = `<svg xmlns="http://www.w3.org/2000/svg" style="margin-left:10px;" width="16"
                                    height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                    <path
                                        d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                                    </svg>`;
                    
                    buttonOne.innerHTML = '<i class="fas fa-check"></i>Applied' + sendIcon;
                    buttonOne.disabled = true;
                    
                    buttonTwo.innerHTML = '<i class="fas fa-check"></i>Applied' + sendIcon;
                    buttonTwo.disabled = true;

                    $('#ApplySuccess').modal('show');
                    
                }
    
            },
            error: function (xhr, status, error) {
                // Handle the error case
                console.error(error);
            },
        });
    };
    
</script>

</section>
<!-- /section -->

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

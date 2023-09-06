<?php $this->load->view('template/header'); ?>
<div class="content-wrapper">
  <?php if (!isset($profiles[0])) {
    echo 'something went wrong';
    return false;
  } ?>
  <?php $fullname = $profiles[0]['last_name'] . ' ' . substr($profiles[0]['first_name'], 0, 1); ?>

  <?php
  $profileID = (int) $profiles[0]['id'];
  function flat($array, &$return)
  {
    if (is_array($array)) {
      array_walk_recursive($array, function ($a) use (&$return) {
        flat($a, $return);
      });
    } else if (is_string($array) && stripos($array, '[') !== false) {
      $array = explode(',', trim($array, "[]"));
      flat($array, $return);
    } else {
      $return[] = $array;
    }
  }
  $return = array();
  flat($profiles[0]['skills'], $return);

  function stripQuotes($text)
  {
    return preg_replace('/^(\'(.*)\'|"(.*)")$/', '$2$3', $text);
  }

  function url_encode_custom($input)
  {
    $output = trim($input);
    $output = str_replace(' ', '-', $output);
    $output = str_replace('/', '-and-', $output);
    $output = strtolower($output);
    return $output;
  }

  ?>
  <style>
    .subsection-items div:hover {}
  </style>
  <div class="container">
    <section class="px-3 border-bottom">
      <section>
        <div class="row mt-4">
          <div class="text-muted">
            <i class="uil uil-arrow-left"></i> <a href="<?= base_url('admin'); ?>">Home</a> / <a
              href="<?= base_url('admin/approval'); ?>">Approval</a> /
            <?php echo $profiles[0]['unique_id']; ?>
          </div>
          <section>
            <center>
              <div class="subsection-2 py-4 mb-1">
                <div class="row">
                  <div class="col-md-6">
                    <a href="<?= base_url("admin/approval/approve/") . $profiles[0]['unique_id'] ?>"
                      class="btn btn-success  rounded-pill mb-2 mb-md-0">
                      Approve    
                    </a>
                  </div>
                  <div class="col-md-6">
                    <a data-bs-toggle="modal" data-bs-target="#modal-reject"
                      class="btn btn-danger rounded-pill mb-2 mb-md-0">Request changes or Reject
                    </a>
                  </div>
                </div>
              </div>
            </center>
          </section>

          <div class="col-lg-4" id="profile-image-container">
            <img src="<?= base_url($profiles[0]['userPhoto']) ?>"
              onerror="this.onerror=null; this.src='<?= base_url('assets/img/noimage.jpg') ?>'" class="img-fluid mt-4"
              id="profile-image" style="aspect-ratio:1">
          </div>
          <div class="col-lg-8">
            <div class="mt-3">
              <div class="h5 text-muted" id="profile-title">
                <?php echo $fullname; ?><span class="uid">
                  <?= $profiles[0]['unique_id'] ?>
                </span> <span style="margin-left:10px;">
                  <?php echo $profiles[0]['active'] === '1' ? '<span class="text-green" style="font-size: 12px;">Active</span>' : '<span class="text-red" style="font-size: 12px;">In Active</span>'; ?>
                </span>
              </div>
              <div class="h5 text-dark">
                <?php echo $profiles[0]['primary_title']; ?> in
                <?php echo $profiles[0]['city']; ?>
              </div>
              <div class="mt-2" id="profile-bio">
                <?php echo $profiles[0]['bio']; ?>
              </div>

            </div>
          </div>
          <div class="skill-container mt-5">
            <?php for ($skill = 0; $skill < sizeof($profile_skills); $skill++) { ?>
              <div class="skill-pill">
                <a target="_blank"
                  href="<?php echo base_url('skills/') . url_encode_custom($profile_skills[$skill]['name']); ?>"
                  class="text-dark">
                  <?= $profile_skills[$skill]['name'] ?>
                </a>
              </div>
            <?php } ?>
          </div>
        </div>
      </section>
      <section>
        <div class="subsection mt-3">
          <div class="subsection-items px-2 py-2">
            <span class="h5">Industries : </span>
            <!-- <span class="h5" style="font-weight:normal;"><u>Banking</u>,</span>
                    <span class="h5" style="font-weight:normal;"><u>Automotive</u>,</span>
                    <span class="h5" style="font-weight:normal;"><u>eCommerce</u></span> -->
            <?php
            $industry_array = array();
            for ($i = 0; $i < sizeof($profile_pro); $i++) {
              array_push($industry_array, $profile_pro[$i]['industry']);
            }
            $industries = array_unique($industry_array);
            $industries = array_values($industries);
            ?>
            <?php for ($i = 0; $i < sizeof($industries); $i++) {
              if ($i == 0) {
                echo '<u>' . $industries[$i] . '</u>';
              } else {
                echo ', <u>' . $industries[$i] . '</u>';
              }
            } ?>

          </div>
        </div>
      </section>
      <section>
        <div class="subsection-2 mt-2 mb-2" style="text-align:center !important;">
          <div class="subsection-items px-2 py-2 actions-container">
            <div class="btn btn-light text-dark" onclick="share()"><i style="margin-right:10px;"
                class="uil uil-share"></i> Share
            </div>
            <!-- <a href=""> -->
            <div class="btn btn-light text-dark" onclick="hire()"><i style="margin-right:10px;"
                class="uil uil-chat-info"></i>
              Hire
              <?php echo $fullname; ?>
            </div>
            <!-- </a> -->
            <script>
              function share() {

                // Send a request to the first link without waiting for a response
                fetch('<?= base_url('home/addsharecount/' . $profileID); ?>', { method: 'GET' })
                  .catch(error => {
                    console.error('Request failed:', error);
                  });

                navigator.share({ url: '' });
              }


              function hire() {
                // Send a request to the first link without waiting for a response
                fetch('<?= base_url('home/addhirecount/' . $profileID); ?>', { method: 'GET' })
                  .catch(error => {
                    console.error('Request failed:', error);
                  });

                // Redirect the user to the second link
                window.location.href = '<?= base_url('hire'); ?>';
              }
            </script>

            <a href="<?= base_url('home/profile2pdf/' . $profileID) ?>">
              <div class="btn btn-light text-dark"><i style="margin-right:10px;" class="uil uil-download-alt"></i>
                Download PDF</div>
            </a>
          </div>
        </div>
      </section>
    </section>

    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-7 col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <i class="bi bi-calendar-check"></i>
                            <span style="position:relative;top:2px;left:5px;">Availability</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <!-- • IST Time Zone -->
            <div class="col-5 col-lg-7 sction-content"><?php echo $profiles[0]['comittment'];?></div>
        </div>
    </section>

    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-7 col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <i class="bi bi-hourglass"></i>
                            <span style="position:relative;top:2px;left:5px;">Total experience</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
           <div class="col-5 col-lg-6 sction-content">
            <?php if ($profiles[0]['experience'] < 1) {
                    echo "< 1 years ";
                    } else {
                    echo $profiles[0]['experience'] . " years";
                    }?>
                    </div>
        </div>
    </section>

    <section class="px-3 border-bottom">
      <div class="row py-3 mt-1">
        <div class="col-lg-4">
          <div class="h5">
            <div class="row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <i class="bi bi-code-slash"></i>
                <span style="position:relative;top:2px;left:5px;">Technical skills</span>
              </div>
              <div class="col-lg-2"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="row section-content">

            <?php for ($skill = 0; $skill < sizeof($profile_skills); $skill++) { ?>
              <div class="row">
                <?php
                $year = (int) $profile_skills[$skill]['year'];
                $month = (int) $profile_skills[$skill]['month'];
                ?>
                <div class="col-lg-4 col-6 py-1">
                  <?= $profile_skills[$skill]['name'] ?>
                </div>
                <?php if ($year > 0 && $month > 0) { ?>
                  <div class="col-lg-8 col-6 py-1">
                    <?= $year ?> Years &
                    <?= $month ?> Months
                  </div>
                <?php } elseif ($year == 0 && $month == 0) { ?>
                  <div class="col-lg-8 col-6 py-1"></div>
                <?php } elseif ($month == 0) { ?>
                  <div class="col-lg-8 col-6 py-1">
                    <?= $year ?> Years
                  </div>
                <?php } elseif ($year == 0) { ?>
                  <div class="col-lg-8 col-6 py-1">
                    <?= $month ?> Months
                  </div>
                <?php } ?>

              </div>
            <?php } ?>

          </div>
        </div>
      </div>
    </section>

    <section class="px-3 border-bottom">
      <div class="row py-3 mt-1">
        <div class="col-lg-4">
          <div class="h5">
            <div class="row">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <i class="bi bi-gear"></i>
                <span style="position:relative;top:2px;left:5px;">Projects</span>
              </div>
              <div class="col-lg-2"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-7 section-content">

          <?php for ($i = 0; $i < sizeof($profile_pro); $i++) {
            ?>
            <div class="mb-3">
              <?php $project_url = $profile_pro[$i]['url']; ?>
              <div class="h5" id="project-title">
                <span id="project-title-text">
                  <?php echo $profile_pro[$i]['title']; ?>
                </span>
                <?php
                if (!$project_url == "") {
                  echo "
                                <span
                                    style='font-weight:normal;font-size:14px' class='px-5'><a
                                    href='" . $project_url . "' target='blank'>View project <i
                                    class='bi bi-box-arrow-up-right'
                                    style='font-size:12px;position:relative;bottom:4px;'></i> </a>
                                </span>     
                                ";
                }
                ?>
              </div>
              <div class="px-4 mb-2 text-muted">

                <?php
                if (!empty($profile_pro[$i]['pro_start'])) {
                  echo $profile_pro[$i]['pro_start'] . ' to ' . $profile_pro[$i]['pro_end'];
                }
                ?>

              </div>
              <div id="project-details">
                <div class="fw-bold">Description</div>
                <div class="mb-2">
                  <?php echo $profile_pro[$i]['description']; ?>
                </div>

                <div class="fw-bold">Roles and Responsibilites</div>
                <div class="mb-2">
                  <?php echo $profile_pro[$i]['responsibilities']; ?>
                </div>
                <div class="fw-bold mb-2">Technologies: <span style="font-weight:normal">
                    <?php echo $profile_pro[$i]['technologies']; ?>
                  </span></div>
                <div class="fw-bold mb-2">Industry: <span style="font-weight:normal">
                    <?php echo $profile_pro[$i]['industry']; ?>
                  </span></div>
              </div>
            </div>
          <?php } ?>

        </div>
      </div>
    </section>

    <?php if(($profile_exp[0]['title'])!='') { ?>
      <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
          <div class="col-lg-4">
            <div class="h5">
              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <i class="bi bi-briefcase"></i>
                  <span style="position:relative;top:2px;left:5px;">Work history</span>
                </div>
                <div class="col-lg-2"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-7 section-content">
            <?php for ($i = 0; $i < sizeof($profile_exp); $i++) { ?>
              <div class="mb-2">
                <div class="text-dark">
                  <?php echo $profile_exp[$i]['title']; ?>
                </div>
                <div class="text-dark">
                  <?php echo $profile_exp[$i]['company_name']; ?>
                  <?php echo ($profile_exp[$i]['start'] != '' ? "• " . $profile_exp[$i]['start'] : '') . ($profile_exp[$i]['end'] != '' ? " to " . $profile_exp[$i]['end'] : ''); ?>
                </div>

                <div class="mb-2">
                  <?php echo $profile_exp[$i]['description'] != '' ? "Description: " . $profile_exp[$i]['description'] : ''; ?>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </section>
    <?php } ?>

    <?php
if(isset($profiles[0]['soft_skill']) && strlen($profiles[0]['soft_skill']) && !empty(trim($profiles[0]['soft_skill']))) {
    $soft_skills = explode(",", $profiles[0]['soft_skill']);
    $filtered_soft_skills = array_filter($soft_skills, 'trim');
    if (!empty($filtered_soft_skills)) {
?>
<section class="px-3 border-bottom">
    <div class="row py-3 mt-1">
        <div class="col-lg-4">
            <div class="h5">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <i class="bi bi-nut"></i>
                        <span style="position:relative;top:2px;left:5px;">Soft skills</span>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 section-content">
            <?php
            foreach ($filtered_soft_skills as $soft_skill) {
                echo "<div class='soft-skill'>$soft_skill</div>";
            }
            ?>
        </div>
    </div>
</section>
<?php
    }
}
?>

    <?php if (isset($profile_cert[0]['name']) && $profile_cert[0]['name']) { ?>
      <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
          <div class="col-lg-4">
            <div class="h5">
              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <i class="bi bi-patch-check"></i>
                  <span style="position:relative;top:2px;left:5px;">Certifications</span>
                </div>
                <div class="col-lg-2"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-7 section-content">
            <?php for ($i = 0; $i < sizeof($profile_cert); $i++) { ?>
              <div class="mb-2">
                <div class="text-dark">
                  <?php echo $profile_cert[$i]['name']; ?>
                  <?php echo $profile_cert[$i]['issuer'] != '' ? "by " . $profile_cert[$i]['issuer'] : ''; ?>
                </div>
                <div class="text-muted">
                  <?php echo $profile_cert[$i]['year'] != '0' ? $profile_cert[$i]['year'] : ''; ?>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </section>
    <?php } ?>

    <?php if (sizeof($profile_edu) > 0 && ($profile_edu[0]['degree'] != 'None')) { ?>
      <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
          <div class="col-lg-4">
            <div class="h5">
              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                    class="bi bi-mortarboard" viewBox="0 0 16 16">
                    <path
                      d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5ZM8 8.46 1.758 5.965 8 3.052l6.242 2.913L8 8.46Z" />
                    <path
                      d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46l-3.892-1.556Z" />
                  </svg>
                  <span style="position:relative;top:2px;left:5px;">Education</span>
                </div>
                <div class="col-lg-2"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-7 section-content">
            <?php
            for ($i = 0; $i < sizeof($profile_edu); $i++) {
              ?>
              <div class="mb-2">
                <div class="text-dark">
                  <?= $profile_edu[$i]['degree'] ?> degree in
                  <?= $profile_edu[$i]['major'] ?>
                </div>
                <div class="text-muted" style="font-size:16px">
                  <?= $profile_edu[$i]['univ'] ?>
                </div>
                <div class="text-muted">
                  <?php echo $profile_edu[$i]['edu_start'] . ' to ' . $profile_edu[$i]['edu_end']; ?>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </section>
    <?php } ?>
    <section>
      
    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26">
                                <path d="m475 976 181-480h82l186 480h-87l-41-126H604l-47 126h-82Zm151-196h142l-70-194h-2l-70 194Zm-466 76-55-55 204-204q-38-44-67.5-88.5T190 416h87q17 33 37.5 62.5T361 539q45-47 75-97.5T487 336H40v-80h280v-80h80v80h280v80H567q-22 69-58.5 135.5T419 598l98 99-30 81-127-122-200 200Z" />
                            </svg>
                            <span style="position:relative;top:2px;left:5px;">Language</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <!-- • IST Time Zone -->
            <div class="col-lg-7 sction-content">English - <?php echo ucfirst($profiles[0]['english']);?></div>
        </div>
    </section>
        
<section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <i class="bi bi-globe2"></i>
                            <span style="position:relative;top:2px;left:5px;">Country</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <!-- • IST Time Zone -->
            <div class="col-lg-7 sction-content"><?php echo $profiles[0]['country'];?></div>
        </div>
    </section>

    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <i class="bi bi-person-badge-fill"></i>
                            <span style="position:relative;top:2px;left:5px;">Citizenship</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <!-- • IST Time Zone -->
            <div class="col-lg-7 sction-content"><?php echo $profiles[0]['citizenship'];?></div>
        </div>
    </section>

 <?php
 $work_location = $profiles[0]["work_location"];

 if (!($work_location == "N;" || $work_location == "")) {

     $work_location = unserialize($work_location);

     // Check if the "remote" checkbox was checked
     $remote_checked = in_array("remote", $work_location);
     // Check if the "onsite" checkbox was checked
     $onsite_checked = in_array("onsite", $work_location);
     // Check if the "same-city" checkbox was checked
     $same_city_checked = in_array("same-city", $work_location);
     // Check if the "same-country" checkbox was checked
     $same_country_checked = in_array("same-country", $work_location);
     // Check if the "work-permit" checkbox was checked
     $work_permit_checked = in_array("work-permit", $work_location);
     ?>

    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <i class="bi bi-geo-alt"></i>
                            <span style="position:relative;top:2px;left:5px;">Work Location</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <!-- • IST Time Zone -->
            <div class="col-lg-7 sction-content">

            <?php if ($remote_checked) { ?>

            <div>Remote</div>

            <?php }
            if($onsite_checked) { ?>

            <div>Onsite

            <?php if($same_city_checked || $same_country_checked || $work_permit_checked) { echo " :"; ?>

            </div>

            <?php }}

            if($same_city_checked) { ?>
            <div style="margin-left:20px;">
            <div>Current City</div>

            <?php }

            if($same_country_checked) { ?>

            <div>Anywhere in Current Country</div> 

            <?php }

            if($work_permit_checked) { ?>

            <div>Anywhere with Work Permit</div> 
            </div>

            <?php }?>

            </div>
        </div>
    </section>
    <?php } ?>

    
    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-video" viewBox="0 0 16 16">
                                <path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2Zm10.798 11c-.453-1.27-1.76-3-4.798-3-3.037 0-4.345 1.73-4.798 3H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1.202Z"/>
                            </svg>
                            <span style="position:relative;top:2px;left:5px;">Job status</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <!-- • IST Time Zone -->
            <div class="col-lg-7 sction-content"><?php echo $profiles[0]['job_status'];?></div>
        </div>
    </section>
 

    <?php if($profiles[0]['notice_period'] != ""){ 

    $notice_period = $profiles[0]['notice_period'];
    ?>
    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <i class="bi bi-clock"></i>
                            <span style="position:relative;top:2px;left:5px;">Notice period</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <!-- • IST Time Zone -->
            <div class="col-lg-7 sction-content"><?php echo ($profiles[0]['notice_period']==0)?'Immediately':"$notice_period weeks";?></div>
        </div>
    </section>
    <?php } ?>

    <?php if($profiles[0]['linkedin'] != ""){ ?>
    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <i class="bi bi-linkedin"></i>
                            <span style="position:relative;top:2px;left:5px;">LinkedIn</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <!-- • IST Time Zone -->
            <div class="col-lg-7 sction-content"><a href="<?php echo $profiles[0]['linkedin'];?>" target="_blank">Click here <i class="bi bi-box-arrow-up-right"></i></a></div>
        </div>
    </section>
    <?php } ?>

    <?php if($profiles[0]['github'] != ""){ ?>
    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <i class="bi bi-github"></i>
                            <span style="position:relative;top:2px;left:5px;">GitHub</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <!-- • IST Time Zone -->
            <div class="col-lg-7 sction-content"><a href="<?php echo $profiles[0]['github'];?>" target="_blank">Click here <i class="bi bi-box-arrow-up-right"></i></a></div>
        </div>
    </section>
    <?php } ?>


    <section class="px-3 border-bottom">
        <div class="row py-3 mt-1">
            <div class="col-lg-4">
                <div class="h5">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <i class="bi bi-tag"></i>
                            <span style="position:relative;top:2px;left:5px;">Price per month <br> &nbsp &nbsp (160 hours)</span>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
            <!-- • IST Time Zone -->
            <div class="col-lg-7 sction-content"><?php echo ($profiles[0]['currency']=='INR') ? '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mb-1 bi bi-currency-rupee" viewBox="0 0 16 16">
                                                                                                  <path d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4v1.06Z"/>
                                                                                                </svg>':'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mb-1 bi bi-currency-dollar" viewBox="0 0 16 16">
                                                                                                  <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                                                                                                </svg>'; ?><?php echo $profiles[0]['ppm_min'];?>-<?php echo $profiles[0]['ppm_max'];?>

            </div>
        </div>
    </section>
    
          <section>
            <center>
              <div class="subsection-2 py-4 mb-1">
                <div class="row">
                  <div class="col-md-6">
                    <a href="<?= base_url("admin/approval/approve/") . $profiles[0]['unique_id'] ?>"
                      class="btn btn-success  rounded-pill mb-2 mb-md-0">
                      Approve    
                    </a>
                  </div>
                  <div class="col-md-6">
                    <a data-bs-toggle="modal" data-bs-target="#modal-reject"
                      class="btn btn-danger rounded-pill mb-2 mb-md-0">Request changes or Reject
                    </a>
                  </div>
                </div>
              </div>
            </center>
          </section>

  </div>

  <!-- page footer -->


</div>
<style>
  .modal-backdrop {
    opacity: 0.5 !important;
    /* set the opacity to your preferred value */
    background-color: rgba(0, 0, 0, 0.5) !important;
    /* set the background color to transparent */
  }
</style>
<div class="modal fade bg-transparent" id="modal-reject" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 650px;">
    <div class="modal-content text-center">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <h3 class="mb-3">Update status to "Awaiting changes" & notify user</h3>
        <p class="text-muted medium mb-3">Comments below will be emailed to the user, please include the details so they
          can rectify and resubmit their profile</p>

        <form class="text-start mb-3" action="<?= base_url("admin/approval/reject/") . $profiles[0]['unique_id'] ?>"
          method="post">
          <div class="form-floating mb-4">
            <div class="d-flex justify-content-center">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permanent_reject" id="permanent-reject">
                <label class="form-check-label" for="permanent-reject">
                This profile is not an iOS dev/not relevant 
                </label>
              </div>
            </div>
          </div>
          <div class="form-floating mb-4">
            <textarea class="form-control" name="comment" rows="5" style="height: 150px;"
              placeholder="Enter your comment here"></textarea>
          </div>
          <button class="btn btn-primary rounded-pill w-100 mb-2" type="submit">Submit</button>
        </form>
        <!-- /form -->

      </div>
      <!--/.modal-content -->
    </div>
    <!--/.modal-body -->
  </div>
  <!--/.modal-dialog -->
</div>
<!--/.modal -->

<script>
  const checkbox = document.querySelector('#permanent-reject');
  const commentTextarea = document.querySelector('[name="comment"]');

  checkbox.addEventListener('change', function () {
    if (this.checked) {
      commentTextarea.value = 'This profile is not an iOS dev/not relevant.';
    } else {
      commentTextarea.value = '';
    }
  });
</script>
<script src="<?php echo base_url() . $this->config->item('js') . 'plugins.js' ?>"></script>
<script src="<?php echo base_url() . $this->config->item('js') . 'theme.js' ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

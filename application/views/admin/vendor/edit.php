<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Include CSS dependencies -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- Include JS dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css" />
<link media="all" rel="stylesheet" href="<?php echo base_url() . $this->config->item('css') . 'admin-vendor-edit.css' ?>">

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Profile</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="<?=base_url('admin') ?>">Home </a>
            </li>
            <li class="breadcrumb-item active">Edit profile</li>
          </ol>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- Main content -->
  <section class="content">
  <div class="row">
      <!--<div class="col-md-12 col-xs-12" style="margin-bottom: 30px;">-->
      <!--  <a href="" class="btn btn-primary">View All Profile(s)</a>-->
      <!--</div>-->
    </div>
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="card">
          <!-- PLEASE UPDATE HRER -->
          <div class="stepper-wrapper">
            <div class="stepper-item">
              <div onclick = "changeTab(0)" class="stepper-number"> 1 </div>
              <div class="stepper-title"> Profile </div>
            </div>
            <div class="stepper-item">
              <div onclick = "changeTab(1)" class="stepper-number"> 2 </div>
              <div class="stepper-title"> Experience </div>
            </div>
            <div class="stepper-item">
              <div onclick = "changeTab(2)" class="stepper-number"> 3 </div>
              <div class="stepper-title"> Skills </div>
            </div>
            <div class="stepper-item">
              <div onclick = "changeTab(3)" class="stepper-number"> 4 </div>
              <div class="stepper-title"> Projects </div>
            </div>
            <div class="stepper-item">
              <div onclick = "changeTab(4)" class="stepper-number"> 5 </div>
              <div class="stepper-title"> Employment </div>
            </div>
            <div class="stepper-item">
              <div onclick = "changeTab(5)" class="stepper-number"> 6 </div>
              <div class="stepper-title"> Education </div>
            </div>
            <div class="stepper-item">
              <div onclick = "changeTab(6)" class="stepper-number"> 7 </div>
              <div class="stepper-title"> Finish </div>
            </div>
          </div>
          <?php
          $attributes = array('name' => 'frmRegistration', 'id' => 'regForm', 'enctype' => "multipart/form-data");
          echo form_open('admin/vendor/editformdata/'.$profile[0]['id'], $attributes);
          ?>
          <div class="tab">
            <div class="container">
              <div class="row">
                <div class="col-lg-1">&nbsp;</div>
                <div class="col-lg-10 py-4">
                  <div class="h3 text-center fw-bold"> Upload profile information here </div>
                  <div class="text-center">
                    <p>Talrn matches resources with top companies globally.</p>
                  </div>
                  <div class="row mt-4">
                    <div class="col-lg-7">
                      <label class='fw-bold'>First name *</label>
                      <input type="text" class="form-control py-3 mt-2" placeholder='First name' name='first_name' id='first_name' value="<?=$profile[0]['first_name'] ?>" />
                      <div class="req text-danger" id='first_name_error'>This field is required</div>

                      <label class='fw-bold mt-4'>Last name *</label>
                      <input type="text" class="form-control py-3 mt-2" placeholder='Last name' name='last_name' id='last_name' value="<?=$profile[0]['last_name'] ?>" />
                      <div class="req text-danger" id='last_name_error'>This field is required</div>

                      <label class='fw-bold mt-4'>City *</label>
                      <input type="text" class="form-control py-3 mt-2" placeholder='City' name='city' id='city' value="<?=$profile[0]['city'] ?>" />
                      <div class="req text-danger" id='city_error'>This field is required</div>

                      <label class='fw-bold mt-4'>Country *</label>
                      <div>
                        <select class="form-control select-box" name="country" id="country">
                          <?php
                          $json_file = file_get_contents("./assets/countries.json");
                          $countries = json_decode($json_file, true);
                          echo '<option value="">Please select a country</option>';
                          foreach ($countries as $country) {
                            if($profile[0]['country_code'] == $country['code']){
                              $selected = 'selected="selected"';
                            } 
                            else{
                              $selected = '';
                            }
                            $country_code = $country['code'];
                            $country_name = $country['name'];
                            echo '<option value="' . $country_code . ':' . $country_name . '"'.$selected.' >' . $country_name . '</option>';
                          }
                          ?>
                        </select>
                        </div>
                        <div class="req text-danger" id='country_error'>This field is required</div>

                      <label class='fw-bold mt-4'>Citizenship *</label>
                      <input type="text" class="form-control py-3 mt-2" placeholder='e.g. Andorra' name='citizenship' id ='citizenship' value="<?=$profile[0]['citizenship'] ?>"/>
                      <div class="req text-danger" id='citizenship_error'>This field is required</div>

                      <label class='fw-bold mt-4'>English proficiency *</label>
                      <div class='mt-2'>
                        <input class='english-radio' type="radio" name="english" id="native" value="native" <?php if($profile[0]['english'] == 'native'){echo 'checked';} ?> />
                        <label class='english-label' htmlFor="" for="native">Native/Fluent</label>

                        <input class='english-radio' type="radio" name="english" id="advanced" value="advanced" <?php if($profile[0]['english'] == 'advanced'){echo 'checked';} ?> />
                        <label class='english-label' for="advanced">Advanced</label>

                        <input class='english-radio' type="radio" name="english" id="intermediate" value="intermediate" <?php if($profile[0]['english'] == 'intermediate'){echo 'checked';} ?> />
                        <label class='english-label' for="intermediate">Intermidiate</label>

                        <input class='english-radio' type="radio" id="basic" name="english" value="basic" <?php if($profile[0]['english'] == 'basic'){echo 'checked';} ?> />
                        <label class='english-label' for="basic">Basic</label>
                        <div class="req text-danger" id="proficiency_error">This field is required</div>
                      </div>

                    </div>
                    <div class="col-lg-5">&nbsp;</div>
                  </div>
                </div>
                <div class="col-lg-1">&nbsp;</div>
              </div>
            </div>
          </div>
          <div class="tab">
            <div class="container">
              <div class="row">
                <div class="col-lg-1">&nbsp;</div>
                <div class="col-lg-10 py-4">
                  <div class="h3 text-center fw-bold"> Experience </div>
                  <div class="row mt-4">
                    <div class="col-lg-8">
                      <label class='fw-bold'>How many years of professional experience do you have in your field
                        overall? *</label>
                      <input type="number" class="form-control" placeholder="Enter your years of experience" min="0" step="1" onfocus="this.previousValue=this.value" onkeydown="this.previousValue = this.value"
                            oninput="validity.valid || (value = this.previousValue)" name="experience" id="years_of_experience" value="<?=$profile[0]['experience'] ?>">
                      <div class="req text-danger" id="years_of_experience_error">This field is required</div>

                      <label class='fw-bold mt-2'>Primary job title *</label>
                      <div class="position-relative">
                      <input type="text" class="form-control titleAutoComplete" autocomplete="off" name="primary_title" placeholder="Enter your primary job title" id="primary_job_title" value="<?=$profile[0]['primary_title'] ?>"  >
                      <div class="loading-circle"></div>
                    </div>
                    <div class="req text-danger" id="primary_job_title_error">This field is required</div>

                      <br>
                      <?php

                        $work_location = $profile[0]['work_location'];
                                                
                        if($work_location == 'N;' || $work_location == ''){
                          $work_location = array();
                        }else{
                          $work_location = unserialize($work_location);
                        }
                        // Check if the "remote" checkbox was checked
                        $remote_checked = in_array('remote', $work_location);
                        // Check if the "onsite" checkbox was checked
                        $onsite_checked = in_array('onsite', $work_location);
                        // Check if the "same-city" checkbox was checked
                        $same_city_checked = in_array('same-city', $work_location);
                        // Check if the "same-country" checkbox was checked
                        $same_country_checked = in_array('same-country', $work_location);
                        // Check if the "work-permit" checkbox was checked
                        $work_permit_checked = in_array('work-permit', $work_location);
                        ?>

                        <label for="fw-bold mt-2">Work Location:</label>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remote_location[]" id="remote" value="remote" <?php echo ($remote_checked) ? 'checked' : ''; ?>>
                            <label class="custom-control-label" style="line-height: 22px;" for="remote">Remote</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remote_location[]" id="onsite" value="onsite" <?php echo ($onsite_checked) ? 'checked' : ''; ?>>
                            <label class="custom-control-label" style="line-height: 22px;" for="onsite">Onsite</label>
                        </div>

                        <div id="remote-options"  <?php echo ($onsite_checked) ? 'style="margin-left:20px"' : 'style="margin-left:20px;display:none"'; ?> >
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="remote_location[]" id="same-city" value="same-city" <?php echo ($same_city_checked) ? 'checked' : ''; ?>>
                                <label class="custom-control-label" style="line-height: 22px;" for="same-city">Current City </label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="remote_location[]" id="same-country" value="same-country" <?php echo ($same_country_checked) ? 'checked' : ''; ?>>
                                <label class="custom-control-label" style="line-height: 22px;" for="same-country">Anywhere in Current Country</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="remote_location[]" id="work-permit" value="work-permit" <?php echo ($work_permit_checked) ? 'checked' : ''; ?>>
                                <label class="custom-control-label" style="line-height: 22px;" for="work-permit">Anywhere with Work Permit</label>
                            </div>
                        </div>
                        <?php if($user_data['registered_as'] == 2){ ?>
                      <label class="fw-bold mt-4">Are you actively looking for remote jobs? *</label>
                      <div class="card availibility-card <?php if($profile[0]['job_status'] == 'Ready to Interview'){echo 'selected';} ?>" style="cursor: pointer;" onclick="selectCard('ready_to_interview')">
                        <div class="card-body">
                          <input class="job-status-radio" type="radio" name="job_status" id="ready_to_interview" value="Ready to Interview" <?php if($profile[0]['job_status'] == 'Ready to Interview'){echo 'checked';} ?> />
                          <label for="ready_to_interview">Ready to Interview</label>
                          <p>I am actively looking for a new remote job. Mark me available to interview for the next 30 days. </p>
                        </div>
                      </div>
                      <div class="card availibility-card <?php if($profile[0]['job_status'] == 'Open to Offers'){echo 'selected';} ?>" style="cursor: pointer;" onclick="selectCard('open_to_offers')">
                        <div class="card-body">
                          <input class="job-status-radio" type="radio" name="job_status" id="open_to_offers" value="Open to Offers" <?php if($profile[0]['job_status'] == 'Open to Offers'){echo 'checked';} ?> />
                          <label  for="open_to_offers">Open to Offers</label>
                          <p>I am not actively looking for a new remote jobs, but I am available to hear about new job opportunities for the next 30 days. </p>
                        </div>
                      </div>
                      <div class="card availibility-card <?php if($profile[0]['job_status'] == 'Unavailable for jobs'){echo 'selected';} ?>" style="cursor: pointer;" onclick="selectCard('unavailable_for_jobs')">
                        <div class="card-body">
                          <input class="job-status-radio" type="radio" name="job_status" id="unavailable_for_jobs" value="Unavailable for jobs" <?php if($profile[0]['job_status'] == 'Unavailable for jobs'){echo 'checked';} ?> />
                          <label for="unavailable_for_jobs">Unavailable for jobs</label>
                          <p>I am not looking for a new remote job at the moment.</p>
                        </div>
                      </div>
                      
                      <?php }else{ ?>
                        <input type="hidden" name="job_status" value="Ready to Interview" />
                        <?php } ?>
                        <div class="req text-danger" id="job_status_error">This field is required</div>
                      <label class='fw-bold mt-4'>Which type of commitment do you prefer? *</label>
                      <div class="py-2" >
                        <div>
                        <input type="radio" name="comittment" id="full" value="Full-time" <?php if($profile[0]['comittment'] == 'Full-time'){echo 'checked';} ?>>
                        <label for="full" class="px-2">Full-time (40 hours/week) <span class="text-muted">(Recommended)</span></label>
                        </div>
                        <div>
                        <input type="radio" name="comittment" id="part" value="Part-time" <?php if($profile[0]['comittment'] == 'Part-time'){echo 'checked';} ?> >
                        <label for="part" class="px-2">Part-time (20 hours/week)</label>
                        </div>
                        <div>
                        <input type="radio" name="comittment" id="hour" value="Hourly" <?php if($profile[0]['comittment'] == 'Hourly'){echo 'checked';} ?>>
                        <label for="hour" class="px-2">Hourly (upto 10 hours/week)</label>
                        </div>
                        <div class="req text-danger" id="comittment_error">This field is required</div>
                      </div>
                      <?php if($user_data['registered_as'] == 2){ ?>
                      <label class='fw-bold mt-4'>What is your notice period for resigning from your current job and starting full-time with Talrn? *</label>
                      <div class="py-2" >
                        <div>
                        <input type="radio" name="notice-period" id="Immediately" value="0" <?php if($profile[0]['notice_period'] == '0'){echo 'checked';} ?>>
                        <label for="Immediately" class="px-2">Immediately</label>
                        </div>
                        <div>
                        <input type="radio" name="notice-period" id="notice-period-custom" value="<?php if($profile[0]['notice_period'] > '0'){echo $profile[0]['notice_period'];}else{ echo '1';} ?>" <?php if($profile[0]['notice_period'] > '0'){echo 'checked';} ?> >
                        <label for="notice-period-custom" class="px-2">In <input type="number" style="width: 40px;height: 25px;"  class="d-inline-block" id="notice-period-input" name="notice-period-input" value="<?php if($profile[0]['notice_period'] > '0'){echo $profile[0]['notice_period'];}else{ echo '1';} ?>"  /> week after I get the offer </label>
                        </div>
                        <div class="req text-danger" id="notice-period_error">This field is required</div>
                      </div>
                      <?php }else{ ?>
                        <input type="hidden" name="notice-period" value="0" />
                        <?php } ?>
                      
                      <label class='fw-bold mt-4'>LinkedIn</label>
                      <input type="text" name="linkedin" class="form-control py-3 mt-2" placeholder='Linkedin profile link' value="<?=$profile[0]['linkedin'] ?>"/>
                      <label class='fw-bold mt-4'>Github</label>
                      <input type="text" name="github" class="form-control py-3 mt-2" placeholder='Github profile link' value="<?=$profile[0]['github'] ?>" />
                    </div>
                    <div class="col-lg-4">&nbsp;</div>
                  </div>
                </div>
                <div class="col-lg-1">&nbsp;</div>
              </div>
            </div>
          </div>
          <div class="tab">
            <div class="container">
              <div class="h3 text-center py-4">
                Skills
              </div>
              <div class="row">
                <div class="col-lg-1">&nbsp;</div>
                <div class="col-lg-10">
                  <div>
                    <div style="font-size:16px; font-weight:bold">Add your programming languages and frameworks</div>
                    <div>These will help us match you with relevant work, more skills are better  </div>
                  </div>
                  <div class="req text-danger" id="skills_error">This field is required</div>
                  <div class="add_skill_wrapper mt-3">
                        <div class="row skill_list">
                          <div class="col-lg-5">
                            <span>Skill name *</span>
                            <div class="position-relative">
                                <input type="text" class="form-control skillAutoComplete" name="skill_details[0][]" placeholder="Skill name" autocomplete="off"
                                  id="skill_name0" value="<?=$profile_skills[0]['name'] ?>"  >
                                <div class="loading-circle"></div>
                            </div>
                            <div class="req text-danger" id="skill_name0_error">This field is required</div>
                          </div>
                          <div class="col-lg-2">
                            <span>Years *</span>
                            <input type="number" class="form-control" name="skill_details[0][]" placeholder="Years"
                              id="skill_year0" value="<?=$profile_skills[0]['year'] ?>">
                            <div class="req text-danger" id="skill_year0_error">This field is required</div>
                          </div>
                          <div class="col-lg-2">
                            <span>Months *</span>
                            <input type="number" class="form-control" name="skill_details[0][]" placeholder="Months"
                              id="skill_month0" value="<?=$profile_skills[0]['month'] ?>">
                            <div class="req text-danger" id="skill_month0_error">This field is required</div>
                          </div>

                          <div class="col-lg-1">
                            <button type='button' class="btn btn-primary mt-4 add_skill" id="0">+</button>
                          </div>
                        </div>
                        <?php if (sizeof($profile_skills) > 1){
                            for($i = 1;$i < sizeof($profile_skills);$i++){ ?>
                        <div class="row skill_list">
                          <div class="col-lg-5 mt-2">
                            <div class="position-relative">
                                <input type="text" class="form-control skillAutoComplete" name="skill_details[<?=$i ?>][]" placeholder="Skill name" autocomplete="off"
                                  id="skill_name<?=$i ?>" value="<?=$profile_skills[$i]['name'] ?>"  >
                                <div class="loading-circle"></div>
                           </div>
                            <div class="req text-danger" id="skill_name<?=$i ?>_error">This field is required</div>
                          </div>
                          <div class="col-lg-2 mt-2">

                            <input type="number" class="form-control" name="skill_details[<?=$i ?>][]" placeholder="Years"
                              id="skill_year<?=$i ?>" value="<?=$profile_skills[$i]['year'] ?>">
                            <div class="req text-danger" id="skill_year<?=$i ?>_error">This field is required</div>
                          </div>
                          <div class="col-lg-2 mt-2">

                            <input type="number" class="form-control" name="skill_details[<?=$i ?>][]" placeholder="Months"
                              id="skill_month<?=$i ?>" value="<?=$profile_skills[$i]['month'] ?>">
                            <div class="req text-danger" id="skill_month<?=$i ?>_error">This field is required</div>
                          </div>

                          <div class="col-lg-1">
                            <a href="javascript:void(0);" class="skill_remove_button btn btn-danger mt-2" id="<?=$i ?>">-</a>
                          </div>
                        </div>
                        <?php    }
                        }?>
                      </div>
                </div>
                <div class="col-lg-1">&nbsp;</div>
              </div>
              <div class="row">
                <div class="col-lg-1">&nbsp;</div>
                <div class="col-lg-5">
                <label class='fw-bold mt-3'>Add your soft skills</label>
                <div id="magicsuggest" class="form-control"></div>
                </div>
                <div class="col-lg-1">&nbsp;</div>
              </div>
            </div>
          </div>
          
          <!--Modal for skill limit alert-->
          
                <div class="modal" id="skillalert" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <p>Allowed maximum 50 skills</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                      </div>
                    </div>
                  </div>
                </div>
          
                    <div class="tab">
                <div class="container">
                    <div class="row ">
                        <div class="col-lg-1">&nbsp;</div>

                        <div class="col-lg-10 py-4">
                            <div class="h3 text-center fw-bold"> Projects  </div>
                            <div class="req text-danger" id="projects_error">This field is required</div>
                            <div class="project_wrapper" style="margin-top:30px;">
                                
                                <button id="addmore" class="btn btn-primary add_input" id="0"type="button">Add more projects</button>

                                <?php for($i = 0;$i < sizeof($profile_pro);$i++){ ?>
                                        <div class="project required_inp">
                                            <div class="row more_projects">

                                                <div class="col-xs-3 col-sm-3 col-md-3">
                                                    <div class="form-group"> Project Title * <input autocomplete="off" name="project_details[<?=$i?>][]"
                                                                                                  type="text" placeholder="Project title" class="form-control" id="project_title<?=$i?>" value="<?=$profile_pro[$i]['title'] ?>" />
                                                        <div class="req text-danger" id="project_title<?=$i?>_error">This field is required</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-3 col-sm-3 col-md-3">
                                                    <div class="form-group">Technologies used *<input autocomplete="off" name="project_details[<?=$i?>][]"
                                                                                                    type="text" placeholder="Technologies used" class="form-control" id="project_tech<?=$i?>" value="<?=$profile_pro[$i]['technologies'] ?>" />
                                                        <div class="req text-danger" id="project_tech<?=$i?>_error">This field is required</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-3 col-sm-3 col-md-3">
                                                    <div class="form-group"> Start date <input autocomplete="off"
                                                                                               name="project_details[<?=$i?>][]"  placeholder="Start date"
                                                                                               class="form-control monthYearPicker" id="start_pro<?=$i?>" value="<?=$profile_pro[$i]['pro_start'] ?>"/>

                                                    </div>
                                                </div>
                                                <div class="col-xs-3 col-sm-3 col-md-3">
                                                    <div class="form-group"> End date <input autocomplete="off"
                                                                                             name="project_details[<?=$i?>][]" placeholder="End date" id="end_pro<?=$i?>"
                                                                                             class="form-control monthYearPicker" value="<?=$profile_pro[$i]['pro_end'] ?>"/>

                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">Project Description * <textarea class="form-control"
                                                                                                          placeholder="Project Description" style="height: 70px" name="project_details[<?=$i?>][]"
                                                                                                          id="project_description<?=$i?>" ><?=$profile_pro[$i]['description'] ?></textarea>
                                                        <div class="req text-danger" id="project_description<?=$i?>_error" >This field is required</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">Your Responsibilities * <textarea class="form-control"
                                                                                                            placeholder="Your Responsibilities" style="height: 70>px" name="project_details[<?=$i?>][]"
                                                                                                            id="project_resp<?=$i?>" ><?=$profile_pro[$i]['responsibilities'] ?></textarea>
                                                        <div class="req text-danger" id="project_resp<?=$i?>_error">This field is required</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">Project URL(Website/Play Store/App Store)
                                                        <input autocomplete="off" name="project_details[<?=$i?>][]"
                                                               id="project_url<?=$i?>"    type="text" placeholder="If project is not live, please leave empty" class="form-control" value="<?=$profile_pro[$i]['url'] ?>" />
                                                        <div class="req text-danger" id="project_url<?=$i?>_error">This field is required</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">Industry *
                                                        <div class="position-relative">
                                                        <input  name="project_details[<?=$i?>][]"  type="text" placeholder="Industry type"   value="<?=$profile_pro[$i]['industry'] ?>"
                                                                class="form-control basicAutoComplete" autocomplete="off"  id="project_industry<?=$i?>"/>
                                                        <div class="loading-circle"></div>
                                                        </div>
                                                        <div class="req text-danger" id="project_industry<?=$i?>_error">This field is required</div>
                                                </div>
                                                </div>
                                            </div>
                                            <input type="button" class="inputRemove btn btn-danger" id="<?=$i?>" value="Remove project">
                                        </div>

                                    <?php  }?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-1">&nbsp;</div>
            </div>
          <div class="tab">
            <div class="container">
              <div class="row">
                <div class="col-lg-1">&nbsp;</div>
                <div class="col-lg-10 py-4">
                  <div class="h3 text-center fw-bold"> Employment </div>
                  <div class="exp_wrapper" style="margin-top:30px;">
                    <div class="row mt-6">
                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">Company name <input autocomplete="off" name="exp[0][]" type="text"
                            placeholder="Company name" class="form-control" value="<?=$profile_exp[0]['company_name'] ?>"/>
                        </div>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">Job Title 
                        <div class="position-relative">
                            <input autocomplete="off" name="exp[0][]" type="text" placeholder="Title name" class="form-control titleAutoComplete"   value="<?=$profile_exp[0]['title'] ?>"/>
                            <div class="loading-circle"></div>
                        </div>
                        </div>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">Location <input autocomplete="off" name="exp[0][]" type="text"
                            placeholder="Location" class="form-control" value="<?=$profile_exp[0]['location'] ?>" />
                        </div>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">Employment type
                          <select class="form-control select-box" aria-label="Employment type" name="exp[0][]"
                            placeholder="Employment type">
                            <option selected>Employment type</option>
                            <option value="full-time" <?php if($profile_exp[0]['emp_type'] == 'full-time'){echo 'selected="selected"';} ?> >Full-time</option>
                            <option value="part-time" <?php if($profile_exp[0]['emp_type'] == 'part-time'){echo 'selected="selected"';} ?>>Part-time</option>
                            <option value="self-employment" <?php if($profile_exp[0]['emp_type'] == 'self-employment'){echo 'selected="selected"';} ?>>Self-Employment</option>
                            <option value="freelance"  <?php if($profile_exp[0]['emp_type'] == 'freelance'){echo 'selected="selected"';} ?>>Freelance</option>
                            <option value="internship" <?php if($profile_exp[0]['emp_type'] == 'internship'){echo 'selected="selected"';} ?>>Internship</option>
                            <option value="trainee" <?php if($profile_exp[0]['emp_type'] == 'trainee'){echo 'selected="selected"';} ?>>Trainee</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group"> Start date
                          <input name="exp[0][]" class="monthYearPicker form-control"
                            placeholder="Ex: Sep <?= date("Y") ?>" value="<?=$profile_exp[0]['start'] ?>"/>
                        </div>

                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group"> End date
                          <input name="exp[0][]" class="monthYearPicker form-control"
                            placeholder="Ex: Sep <?= date("Y") ?>" value="<?=$profile_exp[0]['end'] ?>" />
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group"> Roles and Responsibilities
                          <input autocomplete="off" name="exp[0][]" type="text" placeholder="Description"
                            class="form-control" value="<?=$profile_exp[0]['description'] ?>" />
                        </div>
                      </div>

                      <div class="col-xs-3 col-sm-3 col-md-3 mb-10">
                        <button class="btn btn-primary exp_add_button" type="button">+ Add more records</button>
                      </div>
                    </div>
                   <?php if (sizeof($profile_exp) > 1){
                  for($i = 1;$i < sizeof($profile_exp);$i++){ ?>
                    <div class="row mt-10" style="margin-top:20px;">
                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">Company name <input autocomplete="off" name="exp[<?=$i?>][]" type="text" id="emp_company_name<?=$i?>"
                            placeholder="Company name" class="form-control" value="<?=$profile_exp[$i]['company_name'] ?>"/>
                        </div>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">Job Title <div class="position-relative"><input autocomplete="off" name="exp[<?=$i?>][]" type="text"  id="emp_title<?=$i?>"
                            placeholder="Title name" class="form-control titleAutoComplete"   value="<?=$profile_exp[$i]['title'] ?>"/>
                            <div class="loading-circle"></div>
                        </div>
                        </div>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">Location <input autocomplete="off" name="exp[<?=$i?>][]"id="emp_location<?=$i?>"
                            placeholder="Location" class="form-control" value="<?=$profile_exp[$i]['location'] ?>" />
                        </div>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">Employment type
                          <select class="form-control select-box" aria-label="Employment type" name="exp[<?=$i?>][]" id="emp_type<?=$i?>"
                            placeholder="Employment type">
                            <option selected>Employment type</option>
                            <option value="full-time" <?php if($profile_exp[$i]['emp_type'] == 'full-time'){echo 'selected="selected"';} ?> >Full-time</option>
                            <option value="part-time" <?php if($profile_exp[$i]['emp_type'] == 'part-time'){echo 'selected="selected"';} ?>>Part-time</option>
                            <option value="self-employment" <?php if($profile_exp[$i]['emp_type'] == 'self-employment'){echo 'selected="selected"';} ?>>Self-Employment</option>
                            <option value="freelance"  <?php if($profile_exp[$i]['emp_type'] == 'freelance'){echo 'selected="selected"';} ?>>Freelance</option>
                            <option value="internship" <?php if($profile_exp[$i]['emp_type'] == 'internship'){echo 'selected="selected"';} ?>>Internship</option>
                            <option value="trainee" <?php if($profile_exp[$i]['emp_type'] == 'trainee'){echo 'selected="selected"';} ?>>Trainee</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group"> Start date
                          <input name="exp[<?=$i?>][]" class="monthYearPicker form-control" id="emp_start<?=$i?>"
                            placeholder="Ex: Sep <?= date("Y") ?>" value="<?=$profile_exp[$i]['start'] ?>"/>
                        </div>

                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group"> End date
                          <input name="exp[<?=$i?>][]" class="monthYearPicker form-control" id="emp_end<?=$i?>"
                            placeholder="Ex: Sep <?= date("Y") ?>" value="<?=$profile_exp[$i]['end'] ?>" />
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group"> Roles and Responsibilities
                          <input autocomplete="off" name="exp[<?=$i?>][]" type="text" placeholder="Description" id="emp_resp<?=$i?>"
                            class="form-control" value="<?=$profile_exp[$i]['description'] ?>" />
                        </div>
                      </div>

                      <div class="col-xs-3 col-sm-3 col-md-3 mb-10">
                        <a href="javascript:void(0);" class="exp_remove_button btn btn-danger" id="<?=$i?>">Remove extra fields</a>
                      </div>
                    </div>
                    <?php    }
                        }?>
                  </div>
                </div>
                <div class="col-lg-1">&nbsp;</div>
              </div>

            </div>
          </div>
          <div class="tab">
          <div class="container">
              <div class="row">
                <div class="col-lg-1">&nbsp;</div>
                <div class="col-lg-10 py-4">
                  <div class="h3 text-center fw-bold">Education History</div>
                  <div class="list_wrapper" style="margin-top:30px;">
                    <div class="row education">
                      <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group"> Degree *<select class="form-control py-3 select-box" id="degree0"
                            name="list[0][]">
                            <option value="None"  <?php if($profile_edu[0]['degree'] == 'None'){echo 'selected="selected"';} ?> >Select Degree</option>
                          <option value="School" <?php if($profile_edu[0]['degree'] == 'School'){echo 'selected="selected"';} ?>>School</option>
                            <option value="Diploma" <?php if($profile_edu[0]['degree'] == 'Diploma'){echo 'selected="selected"';} ?>>Diploma</option>
                            <option value="Bachelors" <?php if($profile_edu[0]['degree'] == 'Bachelors'){echo 'selected="selected"';} ?>>Bachelors</option>
                            <option value="Masters" <?php if($profile_edu[0]['degree'] == 'Masters'){echo 'selected="selected"';} ?>>Masters</option>
                            <option value="PHD" <?php if($profile_edu[0]['degree'] == 'PHD'){echo 'selected="selected"';} ?>>Phd</option>
                          </select>
                        </div>
                        <div class="req text-danger" id='degree0_error'>This field is required</div>
                      </div>
                      <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group"> Major *<input autocomplete="off" name="list[0][]" type="text"
                            placeholder="Major" class="form-control" id="major0" value="<?=$profile_edu[0]['major'] ?>"/>
                        </div>
                        <div class="req text-danger" id='major0_error' >This field is required</div>
                      </div>
                      <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group"> University *<input autocomplete="off" name="list[0][]" type="text"
                            placeholder="University" class="form-control" id="university0" value="<?=$profile_edu[0]['univ'] ?>" />
                        </div>
                        <div class="req text-danger" id='university0_error' >This field is required</div>
                      </div>
                      <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group"> Start date *<input autocomplete="off" name="list[0][]"
                            placeholder="Start date" class="form-control datepicker" id="edu_start0" value="<?=$profile_edu[0]['edu_start'] ?>"/>
                        </div>
                        <div class="req text-danger" id='edu_start0_error' >This field is required</div>
                      </div>
                      <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group"> End date *<input autocomplete="off" name="list[0][]"
                            placeholder="End date" class="form-control datepicker" id="edu_end0" value="<?=$profile_edu[0]['edu_end'] ?>"/>
                        </div>
                        <div class="req text-danger" id='edu_end0_error' >This field is required</div>
                      </div>
                      <div class="col-xs-1 col-sm-1 col-md-1">
                        <br>
                        <button class="btn btn-primary list_add_button" type="button">+</button>
                      </div>
                    </div>
                    <?php if (sizeof($profile_edu) > 1){
                        for($i = 1;$i < sizeof($profile_edu);$i++){ ?>

                    <div class="row education">
                      <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group"> Degree *<select class="form-control py-3 select-box" id="degree<?=$i ?>"
                            name="list[<?=$i ?>][]">
                            <option value="None"  <?php if($profile_edu[$i]['degree'] == 'None'){echo 'selected="selected"';} ?> >Select Degree</option>
                          <option value="School" <?php if($profile_edu[0]['degree'] == 'School'){echo 'selected="selected"';} ?>>School</option>
                            <option value="Diploma" <?php if($profile_edu[$i]['degree'] == 'Diploma'){echo 'selected="selected"';} ?>>Diploma</option>
                            <option value="Bachelors" <?php if($profile_edu[$i]['degree'] == 'Bachelors'){echo 'selected="selected"';} ?>>Bachelors</option>
                            <option value="Masters" <?php if($profile_edu[$i]['degree'] == 'Masters'){echo 'selected="selected"';} ?>>Masters</option>
                            <option value="PHD" <?php if($profile_edu[$i]['degree'] == 'PHD'){echo 'selected="selected"';} ?>>Phd</option>
                          </select>
                        </div>
                        <div class="req text-danger" id='degree<?=$i ?>_error'>This field is required</div>
                      </div>
                      <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group"> Major *<input autocomplete="off" name="list[<?=$i ?>][]" type="text"
                            placeholder="Major" class="form-control" id="major<?=$i ?>" value="<?=$profile_edu[$i]['major'] ?>"/>
                        </div>
                        <div class="req text-danger" id='major<?=$i ?>_error' >This field is required</div>
                      </div>
                      <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group"> University *<input autocomplete="off" name="list[<?=$i ?>][]" type="text"
                            placeholder="University" class="form-control" id="university<?=$i ?>" value="<?=$profile_edu[$i]['univ'] ?>" />
                        </div>
                        <div class="req text-danger" id='university<?=$i ?>_error' >This field is required</div>
                      </div>
                      <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group"> Start date *<input autocomplete="off" name="list[<?=$i ?>][]"
                            placeholder="Start date" class="form-control datepicker" id="edu_start<?=$i ?>" value="<?=$profile_edu[$i]['edu_start'] ?>"/>
                        </div>
                        <div class="req text-danger" id='edu_start<?=$i ?>_error' >This field is required</div>
                      </div>
                      <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group"> End date *<input autocomplete="off" name="list[<?=$i ?>][]"
                            placeholder="End date" class="form-control datepicker" id="edu_end<?=$i ?>" value="<?=$profile_edu[$i]['edu_end'] ?>"/>
                        </div>
                        <div class="req text-danger" id='edu_end<?=$i ?>_error' >This field is required</div>
                      </div>
                      <div class="col-xs-1 col-sm-7 col-md-1">
                        <a href="javascript:void(0);" class="list_remove_button btn btn-danger" style="margin-top:20px;" id="<?=$i ?>">-</a>
                      </div>
                    </div>
                    <?php    }
                    }?>
                  </div>
                </div>
                <div class="col-lg-1">&nbsp;</div>
              </div>
            </div>
            <div class="container">
              <div class="row">

                <div class="col-lg-1">&nbsp;</div>

                <div class="col-lg-10 py-4">
                  <div class="h3 text-center fw-bold">Certifications</div>
                  <div class="cert_wrapper" style="margin-top:30px;">
                    <div class="row">

                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group"> Name <input autocomplete="off" name="cert_details[0][]" type="text"
                            placeholder="Name" class="form-control" value="<?=$profile_cert[0]['name'] ?>"/>
                        </div>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group"> Issuer <input autocomplete="off" name="cert_details[0][]" type="text"
                            placeholder="Issuer" class="form-control" value="<?=$profile_cert[0]['issuer'] ?>" />
                        </div>
                      </div>
                      <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group allowinttype"> Year <input autocomplete="off" name="cert_details[0][]"
                             placeholder="Year" class="form-control datepicker" onkeypress="return isNumber(event)"
                            maxlength="4" minlength="4" value="<?php echo $profile_cert[0]['year'] != '0' ? $profile_cert[0]['year'] : ''; ?>" />
                        </div>
                      </div>

                      <div class="col-xs-1 col-sm-1 col-md-1">
                        <br>
                        <button class="btn btn-primary cert_add_button" type="button">+</button>
                      </div>
                    </div>
                    <?php if (sizeof($profile_cert) > 1){
                        for($i = 1;$i < sizeof($profile_cert);$i++){ ?>
                        <div class="row">

                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group"> Name <input autocomplete="off" name="cert_details[<?=$i?>][]" type="text" id="cert_name<?=$i?>"
                            placeholder="Name" class="form-control" value="<?=$profile_cert[$i]['name'] ?>"/>
                        </div>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group"> Issuer <input autocomplete="off" name="cert_details[<?=$i?>][]" type="text" id="cert_issuer<?=$i?>"
                            placeholder="Issuer" class="form-control" value="<?=$profile_cert[$i]['issuer'] ?>" />
                        </div>
                      </div>
                      <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group allowinttype"> Year <input autocomplete="off" name="cert_details[<?=$i?>][]" id="cert_year<?=$i?>"
                             placeholder="Year" class="form-control datepicker" onkeypress="return isNumber(event)"
                            maxlength="4" minlength="4" value="<?php echo $profile_cert[$i]['year'] != '0' ? $profile_cert[$i]['year'] : ''; ?>" />
                        </div>
                      </div>

                      <div class="col-xs-1 col-sm-1 col-md-1">
                        <br>
                        <a href="javascript:void(0);" class="cert_remove_button btn btn-danger" id="<?=$i?>">-</a>
                      </div>
                    </div>
                    <?php    }
                        }?>
                  </div>
                </div>


              </div>
            </div>
          </div>
          <div class="tab">
            <div class="container">
              <div class="row">
                <div class="col-lg-1">&nbsp;</div>
                <div class="col-lg-10 py-4">
                  <div class="h3 text-center fw-bold"> Set up your professional profile </div>
                  <div class="row mt-4">
                    <div style="margin: 10px;">
                        <label class="fw-bold" style="margin-bottom: 20px;">Professional photo *</label>
                        
                        <div class="d-flex flex-column flex-lg-row align-items-start">
                          <div class="options col-lg-6" style="margin-bottom: 25px;">
                            <div class="d-flex flex-column align-items-center">
                              <img class="cropped" src="<?=base_url($profile[0]['userPhoto'])?>" alt="" onerror="this.onerror=null; this.src='<?=base_url('assets/img/noimage.jpg')?>'">
                              <button type="button" class="btn btn-danger mt-2" id="deleteProfileImg">Delete</button>
                            </div>
                          </div>
                          
                          <div class="col-lg-6">
                            <div>
                              <div>Please upload a high-quality profile photo</div>
                              <div>Professional photos are prioritized and see more jobs with Talrn clients.</div>
                              <div style="color: lightslategray;">Minimum resolution: 500 x 500 pixels</div>
                              <div style="color: lightslategray;">Maximum file size: 10MB</div>
                            </div>
                            
                            <!-- Warning message for image is not in square shape -->
                            <div id="warning" style="color: red"></div>
                            
                            <input type="file" class="mt-2" id="original-image" onchange="validateImage()" accept="image/*" />
                            <input type="text" name="imageFilePath" class="form-control" id="imageFilePath" value="<?=$profile[0]['userPhoto'] ?>" style="display: none">
                          </div>
                        </div>

                        
                      <div id="popup" class="popup">
                          <div id="popup-content" class="popup-content">
                            <!-- Add a close button inside the popup content -->
                
                            <h4 class="center-heading bold-heading">Crop your profile photo</h4>
                
                            <div class="box-2" style="margin-top: 10px">
                              <div id="result"></div>
                            </div>
                
                            <div class="box">
                              <div class="options hide">
                                <label style="display: none">Width</label>
                                <input
                                  type="number"
                                  class="img-w"
                                  value="300"
                                  min="100"
                                  max="1200"
                                  style="display: none"
                                />
                              </div>
                
                              <button type="button" class="btn btn-primary save hide">Save</button>
                            </div>
                          </div>
                        </div>
                
                        <!--rightbox-->
                        <div class="box-2 img-result hide">
                          <!-- result of crop -->
                        </div>

                      <div class="container my-4">
                        <label>Price per month (160 hours)</label>
                        <div class="row">
                          <div class="col-lg-4 col-md-12">
                            <span>Currency *</span>
                            <select class="form-control select-box" id="currency" name="currency">
                                    <option value="INR" <?php if($profile[0]['currency'] == 'INR'){echo 'selected="selected"';} ?>>₹INR</option>
                                    <option value="USD" <?php if($profile[0]['currency'] == 'USD'){echo 'selected="selected"';} ?>>$USD</option>
                            </select>
                          </div>

                          <div class="col-lg-4 col-md-6">
                            <span>Minimum *</span>
                            <input type="number" class="form-control" placeholder="minimum" name="pph_min" id="pph_min" value="<?=$profile[0]['ppm_min'] ?>">
                            <div class="req text-dange " id="pph_min_error">This field is required</div>
                          </div>

                          <div class="col-lg-4 col-md-6">
                            <span>Maximum *</span>
                            <input type="number" class="form-control" placeholder="maximum" name="pph_max" id="pph_max" value="<?=$profile[0]['ppm_max'] ?>">
                            <div class="req text-dange " id="pph_max_error">This field is required</div>
                          </div>
                        </div>
                        <div class="req text-dange " id="pph_error">This field is required</div>
                      </div>



                      <label class='fw-bold' style="margin-top:30px; margin-bottom:0px!important;">Short bio *</label>
                      <textarea type="text" class="form-control py-3 mb-2" rows="3" placeholder='Short bio'
                        name="bio" id="bio"><?=$profile[0]['bio'] ?></textarea>
                        <div class="req text-danger" id="bio_error" >This field is required</div>
                    </div>
                    <div class="col-lg-5">&nbsp;</div>
                  </div>
                </div>
                <div class="col-lg-1">&nbsp;</div>
              </div>
            </div>
          </div>
          <div class="container" style="margin-bottom: 30px;">
            <div class="row mb-15">
              <div class="col-md-12 col-lg-10 col-xl-10 mx-auto ">
                <button type="button" id="previous" onclick="nextPrev(-1)">Back</button>
                <button type="button" id="next" onclick="nextPrev(1)">Continue</button>
              </div>
            </div>
          </div>
          <?php echo form_close(); ?>
          <!-- END PLEASE UPDATE HRER -->
        </div>
        <!-- /.card -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    var onsiteCheckbox = document.getElementById("onsite");
    var remoteOptions = document.getElementById("remote-options");
    var sameCityCheckbox = document.getElementById("same-city");
    var sameCountryCheckbox = document.getElementById("same-country");
    var workPermitCheckbox = document.getElementById("work-permit");

    onsiteCheckbox.addEventListener("change", function() {
        if (this.checked) {
            remoteOptions.style.display = "block";
        } else {
            remoteOptions.style.display = "none";
            sameCityCheckbox.checked = false;
            sameCountryCheckbox.checked = false;
            workPermitCheckbox.checked = false;
        }
    });
</script>
<script>
  // Get the input element
  const noticePeriodInput = document.getElementById('notice-period-input');
  const customNoticePeriodRadio = document.getElementById('notice-period-custom');
  // Add an event listener to the input element
  noticePeriodInput.addEventListener('input', function() {
    
    customNoticePeriodRadio.value = noticePeriodInput.value;
  });
</script>
<script>
  function selectCard(cardId) {
    const cards = document.querySelectorAll('.card');
    const selectedCard = document.getElementById(cardId);
    
    cards.forEach((card) => {
      card.classList.remove('selected');
    });

    selectedCard.closest('.card').classList.add('selected');
    var job_status = document.getElementById(cardId);
    job_status.checked = true;
  }
</script>
<script>
    var soft_skill_tags;
     

    $(document).ready(function () {
      soft_skill_tags = $('#magicsuggest').magicSuggest({
        placeholder: 'Enter your soft skills ',
        data: ['Communication','Teamwork','Problem-solving','Time management','Critical thinking'],
        name: 'soft_skills',
        <?php if($profile[0]['soft_skill']!="") { ?>
        value:[<?php $soft_skills= explode(",",$profile[0]['soft_skill']);
                for($i=0;$i<count($soft_skills);$i++){
                  if ($i == 0){
                    echo '"'.$soft_skills[$i].'"';
                  }
                  else{
                    echo ',"'.$soft_skills[$i].'"';
                  }  
                }
      ?>],
      <?php } ?>
        selectionPosition: 'inner',
        selectionStacked: false,
        noSuggestionText: 'Press "ENTER" to add {{query}}'
      });
    });
  </script>
<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
    $(".datepicker").datepicker({
      format: "yyyy",
      viewMode: "years",
      minViewMode: "years",
      startDate: '-70y',
      endDate: "+10y"
    });
    $(".monthYearPicker").datepicker( {
      format: "MM-yyyy",
      startView: "months",
      minViewMode: "months",
      endDate:"0m"
    });

    var x = 0 + <?php echo sizeof($profile_edu) - 1; ?>; //Initial field counter
    var list_maxField = 3; //Input fields increment limitation

    $("#profileupload").addClass('active');

    //Once add button is clicked
    $('.list_add_button').click(function () {
        //Check maximum number of input fields
        if (x < list_maxField) {
            x++; //Increment field counter
            var list_fieldHTML = '<div class="row education"> <div class="col-xs-3 col-sm-3 col-md-3"> <div class="form-group"> Degree *<select class="form-control py-3 select-box" id="degree' + x + '" name="list[' + x + '][]"> <option value="None">Select Degree</option> <option value="School">School</option><option value="Diploma">Diploma</option> <option value="Bachelors">Bachelors</option> <option value="Masters">Masters</option> <option value="PHD">Phd</option> </select> </div> <div class="req text-danger" id="degree' + x + '_error">This field is required</div> </div> <div class="col-xs-2 col-sm-2 col-md-2"> <div class="form-group"> Major *<input autocomplete="off" name="list[' + x + '][]" type="text" placeholder="Major" class="form-control" id="major' + x + '"/> </div> <div class="req text-danger" id="major' + x + '_error" >This field is required</div> </div> <div class="col-xs-2 col-sm-2 col-md-2"> <div class="form-group"> University *<input autocomplete="off" name="list[' + x + '][]" type="text" placeholder="University" class="form-control" id="university' + x + '"/> </div> <div class="req text-danger" id="university' + x + '_error" >This field is required</div> </div> <div class="col-xs-2 col-sm-2 col-md-2"> <div class="form-group"> Start date *<input autocomplete="off" name="list[' + x + '][]"  placeholder="Start date" class="form-control datepicker" id="edu_start' + x + '" /> </div> <div class="req text-danger" id="edu_start' + x + '_error" >This field is required</div> </div> <div class="col-xs-2 col-sm-2 col-md-2"> <div class="form-group"> End date *<input autocomplete="off" name="list[' + x + '][]" placeholder="End date" class="form-control datepicker" id="edu_end' + x + '" /> </div> <div class="req text-danger" id="edu_end' + x + '_error" >This field is required</div> </div> <div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="list_remove_button btn btn-danger" style="margin-top:20px;" id="'+ x +'">-</a></div> </div> '; //New input field html
            $('.list_wrapper').append(list_fieldHTML); //Add field html
            $(".datepicker").datepicker({
              format: "yyyy",
              viewMode: "years",
              minViewMode: "years"
            });
        } else {
            alert('Allowed max 3 data');
        }
    });

    //Once remove button is clicked
    $('.list_wrapper').on('click', '.list_remove_button', function () {
      for(var i = Number(this.id); i < x;i++){
        document.getElementById('degree'+i).value = document.getElementById('degree'+ (i+1)).value;
        document.getElementById('major'+i).value = document.getElementById('major'+ (i+1)).value;
        document.getElementById('university'+i).value = document.getElementById('university'+ (i+1)).value;
        document.getElementById('edu_start'+i).value = document.getElementById('edu_start'+ (i+1)).value;
        document.getElementById('edu_end'+i).value = document.getElementById('edu_end'+ (i+1)).value;
      }
      $(document.getElementById('degree'+x)).closest('div.row').remove(); 
      x--; //Decrement field counter
    });


    let initialCount = 0 + <?php echo sizeof($profile_skills) - 1;?> ;//Initial field counter
    let allowedCount = 49;
    $('.add_skill').click(function () {
        if (initialCount < allowedCount) {
            console.log('adding new skill');
            initialCount++; //Increment field counter
            var list_fieldHTML =
                '<div class="row skill_list"><div class="col-lg-5 mt-2"><div class="position-relative"><input type="text" class="form-control skillAutoComplete"   autocomplete="off" name="skill_details[' + initialCount +
                '][]" placeholder="Skill name" id="skill_name'+ initialCount +'" /><div class="loading-circle"></div></div><div class="req text-danger" id="skill_name'+ initialCount +'_error">This field is required</div></div> <div class="col-lg-2 mt-2"><input type="number" class="form-control" name="skill_details[' + initialCount +
                '][]" placeholder="Years" id="skill_year'+ initialCount +'"/> <div class="req text-danger" id="skill_year'+ initialCount +'_error">This field is required</div></div> <div class="col-lg-2 mt-2"><input type="number" class="form-control" name="skill_details[' + initialCount +
                '][]" placeholder="Months" id="skill_month'+ initialCount +'"/><div class="req text-danger" id="skill_month'+ initialCount +'_error">This field is required</div></div> <div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="skill_remove_button btn btn-danger mt-2" id="'+ initialCount +'">-</a></div> </div>'; //New input field html
            $('.add_skill_wrapper').append(list_fieldHTML); //Add field html
     
     $(function() {
          $('.skillAutoComplete').each(function() {
            var $autocompleteInput = $(this);
            var $loadingCircle = $autocompleteInput.closest('.position-relative').find('.loading-circle');
            let skillRequestTerm = '';
        
            $autocompleteInput.autocomplete({
              source: function(request, response) {
                skillRequestTerm = request.term;
                $loadingCircle.addClass('show');
                
                $.ajax({
                  url: '<?php echo base_url('autocomplete/skill_search'); ?>',
                  dataType: 'json',
                  data: {
                    search: request.term
                  },
                  success: function(data) {
                    $loadingCircle.removeClass('show');
                    
                    if (request.term == data[0] && data.length == 1){
                        response(data);
                    } else if (data.length === 0 && request.term === 'Type to search') {
                      response([{ label: 'Type to search', value: '' }]);
                    } else if (data.length === 0) {
                      response([{ label: 'Create option: "' + request.term + '"', value: request.term }]);
                    } else {
                      response(data.concat([{ label: 'Create option: "' + request.term + '"', value: request.term }]));
                    }
                  },
                  error: function() {
                    response([{ label: 'Create option: "' + request.term + '"', value: request.term }]);
                  }
                });
              },
              minLength: 0,
              focus: function(event, ui) {
                if (ui.item.label.startsWith('Create option:')) {
                  $autocompleteInput.val(ui.item.value);
                  return false;
                }
              },
              select: function(event, ui) {
                if (ui.item.label.startsWith('Create option:')) {
                  $autocompleteInput.val(ui.item.value);
                  return false;
                }
              },
              open: function(event, ui) {
                var $menu = $(this).autocomplete('widget');
                var noResultItem = $menu.find('.ui-menu-item:contains("No result found")');
                var typeToSearch = $menu.find('.ui-menu-item:contains("Type to search")');
                
                if (skillRequestTerm == '') {
                   var createOption = $menu.find('.ui-menu-item:contains("Create option:")');
                   createOption.addClass('no-result-item');
                }
                
                noResultItem.addClass('no-result-item');
                typeToSearch.addClass('no-result-item');
              },
              response: function(event, ui) {
                if (ui.content.length === 1 && ui.content[0].label.startsWith('Create option:')) {
                  ui.content.push({ label: 'No result found', value: '' });
                }
              }
            });
        
            $autocompleteInput.on('focus', function() {
              if ($(this).val() === '') {
                $(this).autocomplete('search', 'Type to search');
              }
            });
          });
        });
        } else {
            $('#skillalert').modal('show')
        }
    });

    //Once remove button is clicked
    $('.add_skill_wrapper').on('click', '.skill_remove_button', function () {
      for(var i = Number(this.id); i < initialCount;i++){
        document.getElementById('skill_name'+i).value = document.getElementById('skill_name'+ (i+1)).value;
        document.getElementById('skill_year'+i).value = document.getElementById('skill_year'+ (i+1)).value;
        document.getElementById('skill_month'+i).value = document.getElementById('skill_month'+ (i+1)).value;
        document.getElementById('skill_name'+i+'_error').innerHTML = document.getElementById('skill_name'+(i+1)+'_error').innerHTML;
        document.getElementById('skill_name'+i+'_error').className = document.getElementById('skill_name'+(i+1)+'_error').className;
        document.getElementById('skill_year'+i+'_error').innerHTML = document.getElementById('skill_year'+(i+1)+'_error').innerHTML;
        document.getElementById('skill_year'+i+'_error').className = document.getElementById('skill_year'+(i+1)+'_error').className;
        document.getElementById('skill_month'+i+'_error').innerHTML = document.getElementById('skill_month'+(i+1)+'_error').innerHTML;
        document.getElementById('skill_month'+i+'_error').className = document.getElementById('skill_month'+(i+1)+'_error').className;

      }
      $(document.getElementById('skill_month'+initialCount)).closest('div.row').remove(); 
      initialCount--; //Decrement field counter
    });

    var exp_count = 0 + <?php echo sizeof($profile_exp) - 1;?>; //Initial field counter
    var list_maxField = 14; //Input fields increment limitation
    $('.exp_add_button').click(function () {
      //Check maximum number of input fields
      if (exp_count < list_maxField) {
        exp_count++; //Increment field counter
        var list_fieldHTML =
          '<div class="row mt-10" style="margin-top:20px;"><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group">Company name <input autocomplete="off" name="exp[' +
         exp_count +
          '][]" type="text" placeholder="Company name" id="emp_company_name' + exp_count + '" class="form-control"></div></div><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group">Job Title <div class="position-relative"><input autocomplete="off" name="exp[' +
          exp_count +
          '][]" type="text" placeholder="Title name" id="emp_title' + exp_count + '" class="form-control titleAutoComplete"  ><div class="loading-circle"></div></div></div></div><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group">Location <input autocomplete="off" name="exp[' +
          exp_count +
          '][]" type="text" placeholder="Location" id="emp_location' + exp_count + '" class="form-control"></div></div><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group">Employment type<select class="form-control select-box" aria-label="Employment type" name="exp[' +
          exp_count +
          '][]" id="emp_type' + exp_count + '" placeholder="Employment type"><option selected="selected">Employment type</option><option value="full-time">Full-time</option><option value="part-time">Part-time</option><option value="self-employment">Self-Employment</option><option value="freelance">Freelance</option><option value="internship">Internship</option><option value="trainee">Trainee</option></select></div></div><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group">Start date <input name="exp[' +
          exp_count +
          '][]" class="monthYearPicker form-control hasDatepicker" id="emp_start' + exp_count + '" placeholder="Ex: Sep <?= date("Y") ?>"></div></div><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group">End date <input name="exp[' +
          exp_count +
          '][]" class="monthYearPicker form-control hasDatepicker" id="emp_end' + exp_count + '" placeholder="Ex: Sep <?= date("Y") ?>"></div></div><div class="col-xs-12 col-sm-12 col-md-12"><div class="form-group">Description<input autocomplete="off" name="exp[' +
          exp_count +
          '][]" type="text" placeholder="Description" id="emp_resp' + exp_count + '" class="form-control" /></div></div><div class="col-xs-3 col-sm-7 col-md-3"><a href="javascript:void(0);" class="exp_remove_button btn btn-danger" id="' + exp_count + '">Remove extra fields</a></div></div>'; //New input field html
        $('.exp_wrapper').append(list_fieldHTML); //Add field html
        
        $(function() {
          let JobRequestTerm = '';
          
          $('.titleAutoComplete').each(function() {
            var $autocompleteInput = $(this);
            var $loadingCircle = $autocompleteInput.closest('.position-relative').find('.loading-circle');
        
            $autocompleteInput.autocomplete({
              source: function(request, response) {
                JobRequestTerm = request.term;
                $loadingCircle.addClass('show');
        
                $.ajax({
                  url: '<?php echo base_url('autocomplete/job_title_search'); ?>',
                  dataType: 'json',
                  data: {
                    search: request.term
                  },
                  success: function(data) {
                    $loadingCircle.removeClass('show');
        
                    if (request.term == data[0] && data.length == 1){
                        response(data);
                    } else if (data.length === 0 && request.term === 'Type to search') {
                      response([{ label: 'Type to search', value: '' }]);
                    } else if (data.length === 0) {
                      response([{ label: 'Create option: "' + request.term + '"', value: request.term }]);
                    } else {
                      response(data.concat([{ label: 'Create option: "' + request.term + '"', value: request.term }]));
                    }
                  },
                  error: function() {
                    response([{ label: 'Create option: "' + request.term + '"', value: request.term }]);
                  }
                });
              },
              minLength: 0,
              focus: function(event, ui) {
                if (ui.item.label.startsWith('Create option:')) {
                  $autocompleteInput.val(ui.item.value);
                  return false;
                }
              },
              select: function(event, ui) {
                if (ui.item.label.startsWith('Create option:')) {
                  $autocompleteInput.val(ui.item.value);
                  return false;
                }
              },
              open: function(event, ui) {
                var $menu = $(this).autocomplete('widget');
                var noResultItem = $menu.find('.ui-menu-item:contains("No result found")');
                var typeToSearch = $menu.find('.ui-menu-item:contains("Type to search")');
        
                if (JobRequestTerm == '') {
                   var createOption = $menu.find('.ui-menu-item:contains("Create option:")');
                   createOption.addClass('no-result-item');
                }
        
                noResultItem.addClass('no-result-item');
                typeToSearch.addClass('no-result-item');
              },
              response: function(event, ui) {
                if (ui.content.length === 1 && ui.content[0].label.startsWith('Create option:')) {
                  ui.content.push({ label: 'No result found', value: '' });
                }
              }
            });
        
            $autocompleteInput.on('focus', function() {
              if ($(this).val() === '') {
                $(this).autocomplete('search', 'Type to search');
              }
            });
          });
        });

        $(".monthYearPicker").datepicker({
          format: "MM-yyyy",
          startView: "months",
          minViewMode: "months",
          endDate:"0m"
        });
      } else {
        alert('Allowed max 15 data');
      }
    });

    //Once remove button is clicked
    $('.exp_wrapper').on('click', '.exp_remove_button', function () {
      for(var i = Number(this.id); i < exp_count;i++){
        document.getElementById('emp_company_name'+i).value = document.getElementById('emp_company_name'+ (i+1)).value;
        document.getElementById('emp_title'+i).value = document.getElementById('emp_title'+ (i+1)).value;
        document.getElementById('emp_location'+i).value = document.getElementById('emp_location'+ (i+1)).value;
        document.getElementById('emp_start'+i).value = document.getElementById('emp_start'+ (i+1)).value;
        document.getElementById('emp_end'+i).value = document.getElementById('emp_end'+ (i+1)).value;
        document.getElementById('emp_resp'+i).value = document.getElementById('emp_resp'+ (i+1)).value;
        document.getElementById('emp_type'+i).value = document.getElementById('emp_type'+ (i+1)).value;
      }
      $(document.getElementById('emp_company_name'+exp_count )).closest('div.row').remove();
      exp_count--;
    });

    let xy = 0 + <?php echo sizeof($profile_cert) - 1;?>; //Initial field counter
    let addCount = 3; //Input fields increment limitation

    //Once add button is clicked
    $('.cert_add_button').click(function () {
      //Check maximum number of input fields
      if (xy < addCount) {
        xy++; //Increment field counter
        let list_fieldHTML =
          '<div class="row"><div class="col-xs-4 col-sm-4 col-md-4"><div class="form-group">Name <input autocomplete="off" name="cert_details[' +
          xy +
          '][]" type="text" id="cert_name'+ xy +'" placeholder="Name" class="form-control"></div></div><div class="col-xs-4 col-sm-4 col-md-4"> <div class="form-group"> Issuer <input autocomplete="off" name="cert_details[' +
          xy +
          '][]" type="text" placeholder="Issuer" id="cert_issuer'+ xy +'" class="form-control" /> </div> </div><div class="col-xs-3 col-sm-3 col-md-3"><div class="form-group">Year <input autocomplete="off" name="cert_details[' +
          xy +
          '][]"  placeholder="Year" id="cert_year'+ xy +'" class="form-control datepicker" onkeypress="return isNumber(event)" maxlength="4" minlength="4"></div></div><div class="col-xs-1 col-sm-7 col-md-1"><a href="javascript:void(0);" class="cert_remove_button btn btn-danger"  id="'+ xy +'" style="margin-top:20px;">-</a></div></div>'; //New input field html
        $('.cert_wrapper').append(list_fieldHTML); //Add field html
        $(".datepicker").datepicker({
          format: "yyyy",
          viewMode: "years",
          minViewMode: "years"
        });
      } else {
        alert('Allowed max 3 data');
      }
    });

    //Once remove button is clicked
    $('.cert_wrapper').on('click', '.cert_remove_button', function () {
      for(var i = Number(this.id); i < xy;i++){
        document.getElementById('cert_name'+i).value = document.getElementById('cert_name'+ (i+1)).value;
        document.getElementById('cert_name'+i).value = document.getElementById('cert_name'+ (i+1)).value;
        document.getElementById('cert_issuer'+i).value = document.getElementById('cert_issuer'+ (i+1)).value;
      }
      $(document.getElementById('cert_name'+xy)).closest('div.row').remove(); 
      xy--; //Decrement field counter
    });


});

</script>
<script>
$(document).ready(function () {
    
$(function() {

  $('.basicAutoComplete').each(function() {
    var $autocompleteInput = $(this);
    var $loadingCircle = $autocompleteInput.closest('.position-relative').find('.loading-circle');
    var IndustryRequestTerm = '';

    $autocompleteInput.autocomplete({
      source: function(request, response) {
        IndustryRequestTerm = request.term;
        $loadingCircle.addClass('show');

        $.ajax({
          url: '<?php echo base_url('autocomplete/industry_search'); ?>',
          dataType: 'json',
          data: {
            search: request.term
          },
          success: function(data) {
            $loadingCircle.removeClass('show');

            if (request.term == data[0] && data.length == 1){
                response(data);
            } else if (data.length === 0 && request.term === 'Type to search') {
              response([{ label: 'Type to search', value: '' }]);
            } else if (data.length === 0) {
              response([{ label: 'Create option: "' + request.term + '"', value: request.term }]);
            } else {
              response(data.concat([{ label: 'Create option: "' + request.term + '"', value: request.term }]));
            }
          },
          error: function() {
            response([{ label: 'Create option: "' + request.term + '"', value: request.term }]);
          }
        });
      },
      minLength: 0,
      focus: function(event, ui) {
        if (ui.item.label.startsWith('Create option:')) {
          $autocompleteInput.val(ui.item.value);
          return false;
        }
      },
      select: function(event, ui) {
        if (ui.item.label.startsWith('Create option:')) {
          $autocompleteInput.val(ui.item.value);
          return false;
        }
      },
      open: function(event, ui) {
        var $menu = $(this).autocomplete('widget');
        var noResultItem = $menu.find('.ui-menu-item:contains("No result found")');
        var typeToSearch = $menu.find('.ui-menu-item:contains("Type to search")');

        if (IndustryRequestTerm == '') {
           var createOption = $menu.find('.ui-menu-item:contains("Create option:")');
           createOption.addClass('no-result-item');
        }

        noResultItem.addClass('no-result-item');
        typeToSearch.addClass('no-result-item');
      },
      response: function(event, ui) {
        if (ui.content.length === 1 && ui.content[0].label.startsWith('Create option:')) {
          ui.content.push({ label: 'No result found', value: '' });
        }
      }
    });

    $autocompleteInput.on('focus', function() {
      if ($(this).val() === '') {
        $(this).autocomplete('search', 'Type to search');
      }
    });
  });
});
    
$(function() {
  
  $('.titleAutoComplete').each(function() {
    var $autocompleteInput = $(this);
    var $loadingCircle = $autocompleteInput.closest('.position-relative').find('.loading-circle');
    var JobRequestTerm = '';

    $autocompleteInput.autocomplete({
      source: function(request, response) {
        JobRequestTerm = request.term;
        $loadingCircle.addClass('show');

        $.ajax({
          url: '<?php echo base_url('autocomplete/job_title_search'); ?>',
          dataType: 'json',
          data: {
            search: request.term
          },
          success: function(data) {
            $loadingCircle.removeClass('show');

            if (request.term == data[0] && data.length == 1){
                response(data);
            } else if (data.length === 0 && request.term === 'Type to search') {
              response([{ label: 'Type to search', value: '' }]);
            } else if (data.length === 0) {
              response([{ label: 'Create option: "' + request.term + '"', value: request.term }]);
            } else {
              response(data.concat([{ label: 'Create option: "' + request.term + '"', value: request.term }]));
            }
          },
          error: function() {
            response([{ label: 'Create option: "' + request.term + '"', value: request.term }]);
          }
        });
      },
      minLength: 0,
      focus: function(event, ui) {
        if (ui.item.label.startsWith('Create option:')) {
          $autocompleteInput.val(ui.item.value);
          return false;
        }
      },
      select: function(event, ui) {
        if (ui.item.label.startsWith('Create option:')) {
          $autocompleteInput.val(ui.item.value);
          return false;
        }
      },
      open: function(event, ui) {
        var $menu = $(this).autocomplete('widget');
        var noResultItem = $menu.find('.ui-menu-item:contains("No result found")');
        var typeToSearch = $menu.find('.ui-menu-item:contains("Type to search")');
        
        if (JobRequestTerm == '') {
           var createOption = $menu.find('.ui-menu-item:contains("Create option:")');
           createOption.addClass('no-result-item');
        }

        noResultItem.addClass('no-result-item');
        typeToSearch.addClass('no-result-item');
      },
      response: function(event, ui) {
        if (ui.content.length === 1 && ui.content[0].label.startsWith('Create option:')) {
          ui.content.push({ label: 'No result found', value: '' });
        }
      }
    });

    $autocompleteInput.on('focus', function() {
      if ($(this).val() === '') {
        $(this).autocomplete('search', 'Type to search');
      }
    });
  });
});

    
    
$(function() {
  $('.skillAutoComplete').each(function() {
    var $autocompleteInput = $(this);
    var $loadingCircle = $autocompleteInput.closest('.position-relative').find('.loading-circle');
    let skillRequestTerm = '';

    $autocompleteInput.autocomplete({
      source: function(request, response) {
        skillRequestTerm = request.term;
        $loadingCircle.addClass('show');
        
        $.ajax({
          url: '<?php echo base_url('autocomplete/skill_search'); ?>',
          dataType: 'json',
          data: {
            search: request.term
          },
          success: function(data) {
            $loadingCircle.removeClass('show');
            
            if (request.term == data[0] && data.length == 1){
                response(data);
            } else if (data.length === 0 && request.term === 'Type to search') {
              response([{ label: 'Type to search', value: '' }]);
            } else if (data.length === 0) {
              response([{ label: 'Create option: "' + request.term + '"', value: request.term }]);
            } else {
              response(data.concat([{ label: 'Create option: "' + request.term + '"', value: request.term }]));
            }
          },
          error: function() {
            response([{ label: 'Create option: "' + request.term + '"', value: request.term }]);
          }
        });
      },
      minLength: 0,
      focus: function(event, ui) {
        if (ui.item.label.startsWith('Create option:')) {
          $autocompleteInput.val(ui.item.value);
          return false;
        }
      },
      select: function(event, ui) {
        if (ui.item.label.startsWith('Create option:')) {
          $autocompleteInput.val(ui.item.value);
          return false;
        }
      },
      open: function(event, ui) {
        var $menu = $(this).autocomplete('widget');
        var noResultItem = $menu.find('.ui-menu-item:contains("No result found")');
        var typeToSearch = $menu.find('.ui-menu-item:contains("Type to search")');
        
        if (skillRequestTerm == '') {
           var createOption = $menu.find('.ui-menu-item:contains("Create option:")');
           createOption.addClass('no-result-item');
        }
        
        noResultItem.addClass('no-result-item');
        typeToSearch.addClass('no-result-item');
      },
      response: function(event, ui) {
        if (ui.content.length === 1 && ui.content[0].label.startsWith('Create option:')) {
          ui.content.push({ label: 'No result found', value: '' });
        }
      }
    });

    $autocompleteInput.on('focus', function() {
      if ($(this).val() === '') {
        $(this).autocomplete('search', 'Type to search');
      }
    });
  });
});




    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

      var divcount = 0 + <?php echo sizeof($profile_pro) - 1;?>;
      var allowed_proj_Count = 14;
           $("#addmore").click(function () {
          if (divcount < allowed_proj_Count) {
            divcount++;
            $(".project_wrapper").append('<div class="project required_inp"> <div class="row more_projects"> <div class="col-xs-3 col-sm-3 col-md-3"> <div class="form-group">Project Title * <input autocomplete="off" name="project_details[' + divcount + '][]" type="text" placeholder="Project title" class="form-control" id="project_title' + divcount + '" /> <div class="req text-danger" id="project_title' + divcount + '_error">This field is required</div> </div> </div> <div class="col-xs-3 col-sm-3 col-md-3"> <div class="form-group">Technologies used * <input autocomplete="off" name="project_details[' + divcount + '][]" type="text" placeholder="Technologies used" class="form-control" id="project_tech' + divcount + '"/> <div class="req text-danger" id="project_tech' + divcount + '_error">This field is required</div> </div> </div> <div class="col-xs-3 col-sm-3 col-md-3"> <div class="form-group">Start date <input autocomplete="off" id="start_pro' + divcount + '" name="project_details[' + divcount + '][]"  placeholder="Start date" class="form-control monthYearPicker"> </div> </div> <div class="col-xs-3 col-sm-3 col-md-3"> <div class="form-group">End date <input autocomplete="off" id="end_pro' + divcount + '" name="project_details[' + divcount + '][]" placeholder="End date" class="form-control monthYearPicker"></div> </div> <div class="col-xs-6 col-sm-6 col-md-6"> <div class="form-group">Project Description *<textarea class="form-control" placeholder="Project Description" style="height:70px" name="project_details[' + divcount + '][]" id="project_description' + divcount + '"></textarea> <div class="req text-danger" id="project_description' + divcount + '_error" >This field is required</div> </div> </div> <div class="col-xs-6 col-sm-6 col-md-6"> <div class="form-group">Your Responsibilities *<textarea class="form-control" placeholder="Your Responsibilities" style="height:70px" name="project_details[' + divcount + '][]" id="project_resp' + divcount + '"></textarea> <div class="req text-danger" id="project_resp' + divcount + '_error">This field is required</div> </div> </div> <div class="col-xs-6 col-sm-6 col-md-6"> <div class="form-group">Project URL(Website/Play Store/App Store) <input autocomplete="off" name="project_details[' + divcount + '][]" type="text" placeholder="If project is not live, please leave empty" class="form-control" id="project_url' + divcount + '" /> <div class="req text-danger" id="project_url' + divcount + '_error">This field is required</div> </div> </div> <div class="col-xs-6 col-sm-6 col-md-6"> <div class="form-group">Industry * <div class="position-relative"><input name="project_details[' + divcount +'][]" type="text" placeholder="Industry type" class="form-control basicAutoComplete"   autocomplete="off" id="project_industry' + divcount +'"/> <div class="loading-circle"></div></div> <div class="req text-danger" id="project_industry' + divcount +'_error">This field is required</div> </div> </div> </div> <input type="button" class="inputRemove btn btn-danger" id = "' + divcount +'"value="Remove project"></div>');
      
      $(function() {
          let IndustryRequestTerm = '';
        
          $('.basicAutoComplete').each(function() {
            var $autocompleteInput = $(this);
            var $loadingCircle = $autocompleteInput.closest('.position-relative').find('.loading-circle');
        
            $autocompleteInput.autocomplete({
              source: function(request, response) {
                IndustryRequestTerm = request.term;
                $loadingCircle.addClass('show');
        
                $.ajax({
                  url: '<?php echo base_url('autocomplete/industry_search'); ?>',
                  dataType: 'json',
                  data: {
                    search: request.term
                  },
                  success: function(data) {
                    $loadingCircle.removeClass('show');
        
                    if (request.term == data[0] && data.length == 1){
                        response(data);
                    } else if (data.length === 0 && request.term === 'Type to search') {
                      response([{ label: 'Type to search', value: '' }]);
                    } else if (data.length === 0) {
                      response([{ label: 'Create option: "' + request.term + '"', value: request.term }]);
                    } else {
                      response(data.concat([{ label: 'Create option: "' + request.term + '"', value: request.term }]));
                    }
                  },
                  error: function() {
                    response([{ label: 'Create option: "' + request.term + '"', value: request.term }]);
                  }
                });
              },
              minLength: 0,
              focus: function(event, ui) {
                if (ui.item.label.startsWith('Create option:')) {
                  $autocompleteInput.val(ui.item.value);
                  return false;
                }
              },
              select: function(event, ui) {
                if (ui.item.label.startsWith('Create option:')) {
                  $autocompleteInput.val(ui.item.value);
                  return false;
                }
              },
              open: function(event, ui) {
                var $menu = $(this).autocomplete('widget');
                var noResultItem = $menu.find('.ui-menu-item:contains("No result found")');
                var typeToSearch = $menu.find('.ui-menu-item:contains("Type to search")');
        
                if (IndustryRequestTerm == '') {
                   var createOption = $menu.find('.ui-menu-item:contains("Create option:")');
                   createOption.addClass('no-result-item');
                }
        
                noResultItem.addClass('no-result-item');
                typeToSearch.addClass('no-result-item');
              },
              response: function(event, ui) {
                if (ui.content.length === 1 && ui.content[0].label.startsWith('Create option:')) {
                  ui.content.push({ label: 'No result found', value: '' });
                }
              }
            });
        
            $autocompleteInput.on('focus', function() {
              if ($(this).val() === '') {
                $(this).autocomplete('search', 'Type to search');
              }
            });
          });
        });

            $(".monthYearPicker").datepicker( {
              format: "MM-yyyy",
              startView: "months",
              minViewMode: "months",
              endDate:"0m"
            });
          } else {
            alert('Allowed max 15 data');
          }
      });


      $('body').on('click', '.inputRemove', function () {
        for(var i = Number(this.id); i < divcount;i++){
          document.getElementById('project_title'+i).value = document.getElementById('project_title'+ (i+1)).value;
          document.getElementById('project_tech'+i).value = document.getElementById('project_tech'+ (i+1)).value;
          document.getElementById('start_pro'+i).value = document.getElementById('start_pro'+ (i+1)).value;
          document.getElementById('end_pro'+i).value = document.getElementById('end_pro'+ (i+1)).value;
          document.getElementById('project_url'+i).value = document.getElementById('project_url'+ (i+1)).value;
          document.getElementById('project_description'+i).value = document.getElementById('project_description'+ (i+1)).value;
          document.getElementById('project_resp'+i).value = document.getElementById('project_resp'+ (i+1)).value;
          document.getElementById('project_industry'+i).value = document.getElementById('project_industry'+ (i+1)).value;
        }
        $(document.getElementById('project_title'+divcount)).closest('div.required_inp').remove();
        divcount--;
      });
    });
</script>
<link href="<?=base_url('assets/select2/')?>css/select2.css" rel="stylesheet" />
<script src="<?=base_url('assets/select2/')?>js/select2.js"></script>
<script>
  $(document).ready(function() {
      $('#country').select2();
  });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js"></script>
<script>
  var deleteProfileImg = document.getElementById("deleteProfileImg");
  
  var imageFileName = document.getElementById("imageFilePath");
  var fileInput = document.querySelector("#original-image");
  let resultContainer = document.querySelector("#result"),
    img_result = document.querySelector(".img-result"),
    img_w = document.querySelector(".img-w"),
    img_h = document.querySelector(".img-h"),
    options = document.querySelector(".options"),
    save = document.querySelector(".save"),
    cropped = document.querySelector(".cropped"),
    dwn = document.querySelector(".download"),
    upload = document.querySelector("#original-image"),
    cropper = "",
    popup = document.getElementById("popup");

  function validateImage(callback) {
    var fileInput = document.getElementById("original-image");
    var filePath = fileInput.value;

    // Check file size
    var fileSize = fileInput.files[0].size; // in bytes
    var maxSizeMB = 10; // 10MB
    var maxSizeBytes = maxSizeMB * 1024 * 1024; // Convert to bytes
    
    if (fileSize > maxSizeBytes) {
      document.getElementById("warning").innerHTML =
        "Upload an image with a file size up to 10MB.";
      fileInput.value = "";
      if (typeof callback === "function") {
        callback(false);
      }
      return false;
    }
    
    // Check if a file is selected
    if (filePath.trim() === "") {
      document.getElementById("warning").innerHTML =
        "Choose an image file.";
      fileInput.value = "";
      if (typeof callback === "function") {
        callback(false);
      }
      return false;
    }

    // Check if the image dimensions are square and size is within limits
    var img = new Image();
    img.src = window.URL.createObjectURL(fileInput.files[0]);
    img.onload = function () {

     // Check if the image dimensions are within the specified limits
      if (this.width < 499 || this.height < 499) {
        document.getElementById("warning").innerHTML =
          "Provide an image that has dimensions greater than 500x500 pixels.";
        fileInput.value = "";
        if (typeof callback === "function") {
          callback(false);
        }
        return false;
      }

      document.getElementById("warning").innerHTML = "";
      if (typeof callback === "function") {
        callback(true);
      }
    };
  }

  function dataURLtoFile(dataURL, fileName) {
    var arr = dataURL.split(",");
    var mime = "image/webp"; // Set the mime type to WebP
    var bstr = atob(arr[1]);
    var n = bstr.length;
    var u8arr = new Uint8Array(n);

    while (n--) {
      u8arr[n] = bstr.charCodeAt(n);
    }

    return new File([u8arr], fileName, { type: mime });
  }

      // on change show image with crop options
      upload.addEventListener("change", (e) => {
        if (e.target.files.length) {
          validateImage((isValid) => {
            if (isValid) {
              // start file reader
              const reader = new FileReader();
              reader.onload = (e) => {
                if (e.target.result) {
                  // create new image
                  let img = document.createElement("img");
                  img.id = "image";
                  img.src = e.target.result;
    
                  // clean result before
                  resultContainer.innerHTML = "";
                  
                  // append new image
                  resultContainer.appendChild(img);
    
                  // show save btn and options
                  save.classList.remove("hide");
                  options.classList.remove("hide");
    
                  // init cropper
                  cropper = new Cropper(img, {
                    aspectRatio: 1,
                    minContainerHeight: 316,
                    minContainerWidth: 316,
                    minCanvasHeight: 316,
                    minCanvasWidth: 316,
                    minCropBoxWidth: 175,
                    minCropBoxHeight: 175
                  });
    
                  // Display the popup
                  popup.style.display = "block";
                }
              };
              reader.readAsDataURL(e.target.files[0]);
            }
          });
        }
      });
  
    save.addEventListener("click", function (e) {
        e.preventDefault();
    
        // Get the unique ID from the profile URL
        let url = window.location.href;
        let uniqueId = url.substring(url.lastIndexOf('/') + 1);
        var base_url = "<?php echo base_url(''); ?>";
    
        // Get the cropped image data
        let croppedCanvas = cropper.getCroppedCanvas({ width: 500, height: 500 });
        let imgData = croppedCanvas.toDataURL("image/webp");
    
        // Extract the original file name from the file input field
        let originalFileName = fileInput.files[0].name;
    
        // Prepare the data to be sent via AJAX
        let formData = new FormData();
        formData.append("uniqueId", uniqueId);
        formData.append("croppedImage", dataURLtoFile(imgData, originalFileName));
        
        // 1 means existing user
        formData.append("userType", 1)
    
        // Send the data via AJAX to the server
        $.ajax({
            url: base_url + 'admin/vendor/uploadProfileImg', 
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                
                // Parse the JSON string into a JavaScript object
                var responseObject = JSON.parse(response);
                
                // Access the fileName property
                var fileName = responseObject.fileName;
                
                imageFileName.value = "uploads/" + fileName;
            },
            error: function (xhr, status, error) {
                // Handle the error case
                console.error(error);
            },
        });
    
        // Close the popup
        popup.style.display = "none";
        
        // adding cropped image to cropped_img tag
        cropped.src = imgData;
    });
    
     deleteProfileImg.addEventListener("click", function (e) {
        e.preventDefault();
        
        // Get the unique ID from the profile URL
        let url = window.location.href;
        let uniqueId = url.substring(url.lastIndexOf('/') + 1);
        
        let formData = new FormData();
        var base_url = "<?php echo base_url(''); ?>";
        
        const fileName = imageFileName.value.split("uploads/")[1];
        
        formData.append("fileTitle", fileName);
        formData.append("uniqueId", uniqueId);
        
        // Send the data via AJAX to the server
        $.ajax({
            url: base_url + 'admin/vendor/deleteProfileImg', 
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                
                imageFileName.value = "uploads/";
                
                // adding cropped image to cropped_img tag
                cropped.src = '<?=base_url('assets/img/noimage.jpg')?>';
            },
            error: function (xhr, status, error) {
                // Handle the error case
                console.error(error);
            },
        });
    });
    
    window.onload = function() {
      if (cropped.src.includes('assets/img/noimage.jpg')) {
        deleteProfileImg.style.display = "none";
      } else {
        deleteProfileImg.style.display = "block";
      }
    };
    
    const observer = new MutationObserver(() => {
      if (cropped.src.includes('assets/img/noimage.jpg')) {
        deleteProfileImg.style.display = "none";
      } else {
        deleteProfileImg.style.display = "block";
      }
    });
    
    observer.observe(cropped, { attributes: true, attributeFilter: ["src"] });

  document.addEventListener("DOMContentLoaded", function () {
    var fileInput = document.querySelector("#original-image");
    // var closeBtn = document.getElementById("popup-close");

    fileInput.addEventListener("change", function (event) {
      validateImage((isValid) => {
        if (isValid) {
          popup.style.display = "block";
        }
      });
    });

  });
</script>

<script>
    function validationFailModal(currentTab) {
        var section_name = document.getElementsByClassName("stepper-title")[currentTab].innerHTML;
        CustomModal = `
            <!-- Modal -->
            <div class="modal fade"  id="openCustomModal" tabindex="-1" role="dialog"  aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" >Validation Failed!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        Validation failed in ${section_name} section, please fix the data before jumping to the selected section.
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="changeTab(${currentTab})" data-dismiss="modal">Ok</button>
                  </div>
                </div>
              </div>
            </div>
        `;

        // Append the modal HTML code to the body
        $('body').append(CustomModal);

        var modalElement = $('#openCustomModal');

        modalElement.on('hidden.bs.modal', function () {
           // Remove the modal element from the DOM
           modalElement.remove();
        });

        $('#openCustomModal').modal('show');
      }
</script>

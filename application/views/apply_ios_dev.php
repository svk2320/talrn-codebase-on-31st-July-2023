<section class="wrapper bg-soft-primary">
  <div class="container pt-md-2 pb-md-8">
    <div class="row">
      <div class="col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
        <h2 class="display-4 text-center pb-3">Create your Talrn Account</h2>
        <div class="text-center pb-2">
        	<p class="lead">Talrn is an exclusive network of the world's top talent.</p>
        	<p class="lead">We provide access to top companies and resources that can help accelerate your growth.</p>
        </div>
          <div class="container" onload="javascript:optionsCheck();">
              <div class="row ">
                  <div class="col-lg-3 col-md-6">
                      <script type="text/javascript">

                          function changeDomain(){
                              var x = document.getElementById("form_web").value;
                              x = x.replace(/^(https?:\/\/)?(www\.)?/,'', '');
                              if(x.length == 0){
                                  document.getElementById("email_domain").innerHTML = "@website.com";
                              }
                              else{
                                  document.getElementById("email_domain").innerHTML = "@" + x;
                              }

                          }

                          function formsubmit(){
                              if(document.getElementById('Organisation').checked) {
                                  if(document.getElementById('form_web').value != '' && document.getElementById('email_domain').style.display == 'inline-block' ){
                                      var website = document.getElementById('form_web').value;
                                      var x = document.getElementById('form_work_email').value + '@' + website.replace(/^(https?:\/\/)?(www\.)?/,'', '');
                                      document.getElementById('form_work_email').value = x
                                  }

                              }
                              document.getElementById("registration_form").submit();

                          }
                          function optionsCheck() {
                              if (document.getElementById('Individual').checked) {
                                  var i = 0;
                                  w = document.getElementsByClassName('work');
                                  for(i = 0; i< w.length;i++){
                                      w[i].style.display = 'none';
                                  }
                                  document.getElementById('form_org_name').value = "Individual";
                                  document.getElementById('email_domain').style.display = 'none';
                                  document.getElementById('x_icon').style.display = 'none';
                                  document.getElementById('form_work_email').style.width = '100%';


                              } else {
                                  var i = 0;
                                  w = document.getElementsByClassName('work');
                                  for(i = 0; i< w.length;i++){
                                      w[i].style.display = 'block';
                                  }
                                  document.getElementById('form_org_name').value = "";
                                  document.getElementById('email_domain').style.display = 'inline-block';
                                  document.getElementById('x_icon').style.display = 'block';
                                  document.getElementById('form_work_email').style.width = '60%';
                              }
                              changeDomain();
                          }
                          function cancel_autofill() {

                              $.confirm({
                                  title: 'Are you sure?',
                                  content: "Warning:\nUsing an email that does not end in "+ document.getElementById("email_domain").innerHTML + " will prolong the account registration process significantly.",
                                  buttons: {
                                      confirm: function () {
                                          document.getElementById('email_domain').style.display = 'none';
                                          document.getElementById('x_icon').style.display = 'none';
                                          document.getElementById('form_work_email').style.width = '100%';
                                      },
                                      cancel: function () {

                                      },
                                  }
                              });
                          }
                          $(document).ready(function () {
                            changeDomain();
                          });

                  </script>
                  </div>
                  <div class="col-lg-3 col-md-6">
                      <div class="form-check form-check-inline" >
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Organisation" onclick="javascript:optionsCheck();"
                          <?php if(!$Individual){
                              echo 'checked';
                          } ?> >
                          <label class="form-check-label" for="Organisation">Organisation</label>
                      </div>
                  </div>

                  <div class="col-lg-3 col-md-6">
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Individual" onclick="javascript:optionsCheck();"
                              <?php if($Individual){
                                  echo 'checked';
                              } ?> >
                          <label class="form-check-label" for="Individual">Individual</label>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                  </div>

              </div>
              <br>
          </div>
        <div class="text-success"> <?=$message?> </div>
        <form action="<?php echo base_url('join') ?>" method="post" novalidate class="mt-0  " id="registration_form">
          <div class="row gx-4">
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input id="org_first_name" type="text" name="org_first_name" class="form-control" placeholder="Jane" required
                  value="<?=set_value('org_first_name')?>">
                <label for="org_first_name">First Name *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your first name. </div>
                <?php echo form_error('org_first_name', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input id="org_last_name" type="text" name="org_last_name" class="form-control" placeholder="Jane" required
                  value="<?=set_value('org_last_name')?>">
                <label for="org_last_name">Last Name *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your last name. </div>
                <?php echo form_error('org_last_name', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
              </div>
            </div>
              <div class="col-md-6 work" <?php if($Individual){echo 'style="display:none"';} ?> >
                  <div class="form-floating mb-4">
                      <input id="org_job_title" type="text" name="org_job_title" class="form-control" placeholder="Job title"
                             required value="<?=set_value('org_job_title')?>">
                      <label for="org_job_title">Job title *</label>
                      <div class="valid-feedback"> Looks good! </div>
                      <div class="invalid-feedback"> Please enter your job title. </div>
                      <?php echo form_error('org_job_title', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
                  </div>
              </div>
              <div class="col-md-6 work" <?php if($Individual){echo 'style="display:none"';} ?> >
                  <div class="form-floating mb-4">
                      <input id="form_org_name" type="text" name="org_name" class="form-control" placeholder="Organization"
                             required value="<?=set_value('org_name')?>">
                      <label for="form_org_name">Organization *</label>
                      <div class="valid-feedback"> Looks good! </div>
                      <div class="invalid-feedback"> Please enter your organization name. </div>
                      <?php echo form_error('org_name', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
                  </div>
              </div>
              <div class="col-md-6 work" <?php if($Individual){echo 'style="display:none"';} ?> >
                  <div class="form-floating mb-4">
                      <input id="form_web" type="url" pattern="http://.*" name="org_website" class="form-control"
                             placeholder="Jane" required value="<?=set_value('org_website')?>" oninput="changeDomain()" onchange="changeDomain()">
                      <label for="form_web">Website *</label>
                      <div class="valid-feedback"> Looks good! </div>
                      <div class="invalid-feedback"> Please enter your website. </div>
                      <?php echo form_error('org_website', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
                  </div>
              </div>
              <?php $email_array = explode("@", set_value('org_email', '@'));
              $domain = end($email_array);
              $pattern = '/^(https?:\/\/)?(www\.)?/';
              $website = preg_replace($pattern, '', set_value('org_website'));
              ?>
              <div class="col-md-6">
<!--                  <div class="row gx-0" >-->
                    <?php if($Individual){ ?>
                        <div class="form-floating mb-4" id="email_input">
                            <input  style="width: 100%;display: inline-block;" id="form_work_email" type="email" name="org_email" class="form-control"
                                   placeholder="email@website.com" required="" value="<?php echo set_value('org_email')?>">
                            <label for="form_work_email">Work email *</label>
                            <p id="email_domain" style="display: none;width: 35%;">@website.com</p>
                            <i id="x_icon" class="uil uil-times-circle" style="position:absolute; top:0; right:0;display: none" onclick="cancel_autofill()"></i>
                            <?php echo form_error('org_email', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
                        </div>
                      <?php } elseif ($website != $domain) {?>
                        <div class="form-floating mb-4" id="email_input">
                            <input style="width: 100%;display: inline-block;" id="form_work_email" type="email" name="org_email" class="form-control"
                                   placeholder="email@website.com" required="" value="<?php echo str_replace('@'.$website,"",set_value('org_email'))?>">
                            <label for="form_work_email">Work email *</label>
                            <p id="email_domain" style="display: none;width: 35%;">@<?php if(set_value('org_website','website.com') == '')
                                {
                                    echo 'website.com';
                                }
                                else{
                                    echo set_value('org_website','website.com');
                                }?></p>
                            <i id="x_icon" class="uil uil-times-circle" style="position:absolute; top:0; right:0;display: none" onclick="cancel_autofill()"></i>
                            <?php echo form_error('org_email', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
                        </div>
                      <?php } else{ ?>
                          <div class="form-floating mb-4" id="email_input">
                              <input style="width: 60%;display: inline-block;" id="form_work_email" type="email" name="org_email" class="form-control"
                                placeholder="email@website.com" required="" value="<?php echo str_replace('@'.$website,"",set_value('org_email'))?>">
                              <label for="form_work_email">Work email *</label>
                              <p id="email_domain" style="display: inline;width: 35%;">@<?php if(set_value('org_website','website.com') == '')
                                  {
                                      echo 'website.com';
                                  }
                                  else{
                                      echo set_value('org_website','website.com');
                                  }?></p>
                              <i id="x_icon" class="uil uil-times-circle" style="position:absolute; top:0; right:0;" onclick="cancel_autofill()"></i>
                              <?php echo form_error('org_email', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
                          </div>
                    <?php }  ?>

              </div>
              <div class="col-md-6">
                  <div class="form-floating mb-4">
                      <input  type="tel" name="org_tel" class="form-control" placeholder="9876543210" id="form_org_tel"
                              maxlength="16" minlength="6" required value="<?=set_value('org_tel')?>"
                    >
                      <label for="form_org_tel">Phone number *</label>
                      <div class="valid-feedback"> Looks good! </div>
                      <div class="invalid-feedback"> Please enter your phone. </div>
                      <?php echo form_error('org_tel', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-floating mb-4">
                      <input id="form_city_name" type="text" name="org_city" class="form-control" placeholder="City"
                             required value="<?=set_value('org_city')?>">
                      <label for="form_city_name">City *</label>
                      <div class="valid-feedback"> Looks good! </div>
                      <div class="invalid-feedback"> Please enter your city. </div>
                      <?php echo form_error('org_city', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
                  </div>
              </div>
              <div class="col-md-6 work" <?php if($Individual){echo 'style="display:none"';} ?> >
                  <div class="form-floating mb-4">
                      <input id="form_org_cin" type="text" name="org_cin" class="form-control" placeholder="CIN/GST"
                             required value="<?=set_value('org_cin')?>">
                      <label for="form_org_cin">Corporate Registration Number *</label>
                      <div class="valid-feedback"> Looks good! </div>
                      <div class="invalid-feedback"> Please enter your CIN/GST. </div>
                      <?php echo form_error('org_cin', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-floating mb-4">
                      <input id="form_referral_code" type="text"  onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" name="referral_code" class="form-control" placeholder="Referral code"
                             required value="<?=set_value('referral_code')?>">
                      <label for="form_referral_code">Referral code</label>
                      <div class="valid-feedback"> Looks good! </div>
                      <div class="invalid-feedback"> Please enter your referral code. </div>
                      <?php echo form_error('referral_code', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
                  </div>
              </div>
          </div>

          <div class="col-12">
            <div class="form-check">
              <input class="form-check-input" name="org_accept_terms" type="checkbox" value="1" id="invalidCheck"
                <?php echo set_value('org_accept_terms') ? 'checked': ''?> required>
              <label class="form-check-label" for="invalidCheck">
                By clicking Register, you agree to the <a href="<?=base_url('terms-and-conditions')?>">Terms of use</a> and <a
                  href="<?=base_url('privacy-policy')?>">Privacy policy</a>
              </label>
              <div class="invalid-feedback">
                You must agree before submitting.
              </div>
              <?php echo form_error('org_accept_terms', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
            </div>
          </div>
          <div class="col-12 text-center mt-3 mb-3">
            <input type="button"  onclick="formsubmit()" class="btn btn-primary rounded-pill btn-send mb-3" value="Register">

          </div>

        </form>
      </div>
    </div>

  </div>
</section>
<script type="text/javascript">

        history.pushState({}, null, '<?= base_url('join') ?>');

    </script>


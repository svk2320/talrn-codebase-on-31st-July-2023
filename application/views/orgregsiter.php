<section class="wrapper bg-soft-primary">
  <div class="container pt-10 pb-12 pt-md-14 pb-md-17">
    <div class="row mt-10">
      <div class="col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
        <h2 class="display-4 mb-3 text-center">Register</h2>
        <div> <?=$message?> </div> 
        <form action="<?php echo base_url('home/orgregsiter') ?>" method="post" novalidate>
          <div class="row gx-4">
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input id="form_name" type="text" name="org_first_name" class="form-control" placeholder="Jane" required value="<?=set_value('org_first_name')?>">
                <label for="form_name">First Name *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your first name. </div>
                <?php echo form_error('org_first_name', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input id="form_name" type="text" name="org_last_name" class="form-control" placeholder="Jane" required value="<?=set_value('org_last_name')?>">
                <label for="form_name">Last Name *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your last name. </div>
                <?php echo form_error('org_last_name', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
              </div>
            </div>
          </div>
          <div class="row gx-4">
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input id="form_name" type="text" name="org_name" class="form-control" placeholder="Organization" required value="<?=set_value('org_name')?>">
                <label for="form_name">Organization *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your organization name. </div>
                <?php echo form_error('org_name', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input id="form_name" type="email" name="org_email" class="form-control" placeholder="email@domain.com" required value="<?=set_value('org_email')?>">
                <label for="form_name">Work email *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your email address. </div>
                <?php echo form_error('org_email', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
              </div>
            </div>
          </div>
          <div class="row gx-4">
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input id="form_name" type="text" name="org_tel" class="form-control" placeholder="9876543210" pattern="[7-9]{1}[0-9]{9}" required value="<?=set_value('org_tel')?>">
                <label for="form_name">Phone *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your phone. </div>
                <?php echo form_error('org_tel', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input id="form_name" type="url" pattern="http://.*" name="org_website" class="form-control" placeholder="Jane" required value="<?=set_value('org_website')?>">
                <label for="form_name">Website *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your website. </div>
                <?php echo form_error('org_website', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
              </div>
            </div>
          </div>
          <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" name="org_accept_terms" type="checkbox" value="1" id="invalidCheck" <?php echo set_value('org_accept_terms') ? 'checked': ''?> required>
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
      <?php echo form_error('org_accept_terms', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
    </div>
  </div>
          <div class="col-12 text-center">
              <input type="submit" class="btn btn-primary rounded-pill btn-send mb-3" value="Register">
              <p class="text-muted"><strong>*</strong> These fields are required.</p>
              <p class="text-muted">By clicking Register, you agree to the Terms and Conditions & Privacy Policy of Talrn.com</p>
          </div>
          <!-- <div class="user__details"><div class="input__box"><span class="details">First Name</span><input type="text" placeholder="E.g: John" name="org_first_name" id="org_first_name" required></div><div class="input__box"><span class="details">Last Name</span><input type="text" placeholder="E.g: Smith" name="org_last_name" id="org_last_name" required></div><div class="input__box"><span class="details">Organization</span><input type="text" placeholder="organization" name="org_name" id="org_name" required></div><div class="input__box"><span class="details">Email</span><input type="email" placeholder="johnsmith@hotmail.com" name="org_email" id="org_email" required></div><div class="input__box"><span class="details">Phone Number</span><input type="tel" name="org_tel" id="org_tel" required></div></div><div class="button"><input type="Submit" class="btn btn-primary rounded-0" value="Register"></div> -->
        </form>
      </div>
    </div>
    <!-- 

  <div class="row mt-15"><div class="col-lg-10 offset-lg-1 col-xl-8 offset-xl-2"><h2 class="display-4 mb-3 text-center">Register</h2>
			<?php echo validation_errors(); ?><p class="lead text-center mb-10">Reach out to us from our contact form and we will get back to you shortly.</p><form class="contact-form needs-validation" method="post" action="
			<?php echo base_url('home/orgregsiter2') ?>" novalidate><div class="messages"></div><div class="row gx-4"><div class="col-md-6"><div class="form-floating mb-4"><input id="form_name" type="text" name="org_first_name" class="form-control" placeholder="Jane" required><label for="form_name">First Name *</label><div class="valid-feedback"> Looks good! </div><div class="invalid-feedback"> Please enter your first name. </div></div></div><div class="col-md-6"><div class="form-floating mb-4"><input id="form_lastname" type="text" name="org_last_name" class="form-control" placeholder="Doe" required><label for="form_lastname">Last Name *</label><div class="valid-feedback"> Looks good! </div><div class="invalid-feedback"> Please enter your last name. </div></div></div><div class="col-md-6"><div class="form-floating mb-4"><input id="form_email" type="email" name="org_email" class="form-control" placeholder="jane.doe@example.com" required><label for="form_email">Email *</label><div class="valid-feedback"> Looks good! </div><div class="invalid-feedback"> Please provide a valid email address. </div></div></div><div class="col-md-6"><div class="form-floating mb-4"><input id="form_organization" type="text" name="org_name" class="form-control" placeholder="jane.doe@example.com" required><label for="form_organization">Organization *</label><div class="valid-feedback"> Looks good! </div><div class="invalid-feedback"> Please provide a valid organization. </div></div></div><div class="col-md-6"><div class="form-floating mb-4"><input id="form_organization" type="tel" name="org_tel" class="form-control" placeholder="jane.doe@example.com" required><label for="form_organization">Phone *</label><div class="valid-feedback"> Looks good! </div><div class="invalid-feedback"> Please provide a valid phone. </div></div></div><div class="col-md-6"><div class="form-floating mb-4"><input id="form_organization_website" type="text" name="org_website" class="form-control" placeholder="http://example.com" required><label for="form_organization_website">Website *</label><div class="valid-feedback"> Looks good! </div><div class="invalid-feedback"> Please provide a valid organization website. </div></div></div><div class="col-12 mb-10"><div class="form-check"><input class="form-check-input" name="org_accept_terms" type="checkbox" value="" id="invalidCheck" required><label class="form-check-label" for="invalidCheck">
        I'd also like to speak to an expert from Trustpilot to learn more ways to grow.
      </label><div class="invalid-feedback">
        You must agree before submitting.
      </div></div></div><div class="col-12 text-center mb-15"><input type="submit" class="btn btn-primary rounded-pill btn-send mb-3" value="Regsiter"><p class="text-muted"><strong>*</strong> These fields are required.</p><label class="text-muted">By clicking Register, you agree to the Terms and Conditions & Privacy Policy of Talrn.com. </label></div></div></form></div></div> -->
  </div>
</section>
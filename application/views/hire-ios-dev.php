<section class="wrapper bg-soft-primary">
  <div class="container pt-2 pb-12 pt-md-2 pb-md-2">
    <div class="row mt-1">
      <div class="col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
        <h2 class="display-4 mb-3 text-center">Hire the best dedicated iOS developers</h2>
        <p class="lead text-center mt-4 mb-0">Hire pre-vetted iOS developers with strong technical and communication skills at unbeatable prices. </p>
        <p class="lead text-center mb-2">If you decide to stop within one week, you pay nothing.</p>
        <div class="mb-2 pb-2 text-center"><?=$message?></div>
        <form action="<?php echo base_url('hire_ios_dev') ?>" method="post" novalidate>
          <div class="row gx-4">
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input id="reg_first_name" type="text" name="reg_first_name" class="form-control" placeholder="Jane" required value="<?=set_value('reg_first_name')?>">
                <label for="reg_first_name">Name *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your first name. </div>
                <?php echo form_error('reg_first_name', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input id="reg_last_name" type="text" name="reg_last_name" class="form-control" placeholder="Jane" required value="<?=set_value('reg_last_name')?>">
                <label for="reg_last_name">Job Title *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your last name. </div>
                <?php echo form_error('reg_last_name', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
              </div>
            </div>
          </div>
          <div class="row gx-4">
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input id="reg_name" type="text" name="reg_name" class="form-control" placeholder="Company" required value="<?=set_value('reg_name')?>">
                <label for="reg_name">Company Name *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your company name. </div>
                <?php echo form_error('reg_name', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
              </div>
            </div>
            

            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input id="reg_email" type="email" name="reg_email" class="form-control" placeholder="email@domain.com" required value="<?=set_value('reg_email')?>">
                <label for="reg_email">Work Email *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your email address. </div>
                <?php echo form_error('reg_email', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
              </div>
            </div>
          </div>
          <div class="row gx-4">
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input id="reg_tel" type="text" name="reg_tel" class="form-control" placeholder="9876543210" pattern="[6789][0-9]{9}" maxlength="10" required value="<?=set_value('reg_tel')?>" onkeypress='validateNumberInput(event)'>
                <label for="reg_tel">Phone *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your phone. </div>
                <?php echo form_error('reg_tel', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-select-wrapper mb-4">
                <select class="form-select" aria-label="Default select example" name="reg_mode" required="">
                  <option value="">How did you hear about us? *</option>
                  <option value="Email">Email</option>
                  <option value="Search engine">Search engine</option>
                  <option value="Social media">Social media</option>
                  <option value="Others">Others</option>
                </select>
                <?php echo form_error('reg_mode', '<div class="text-red custom-font-size-0.6rem">', '</div>'); ?>
              </div>
            </div>
          </div>
          
          <div class="col-12 text-center mt-5">
              <input type="submit" class="btn btn-primary rounded-pill btn-send mb-3" value="Submit">
              <p class="text-muted"><strong>*</strong> These fields are required.</p>
              
          </div>
          
        </form>
      </div>
    </div>
    
  </div>
</section>
<script type="text/javascript">

        history.pushState({}, null, '<?= base_url('hire') ?>');

    </script>

<script>
    window.addEventListener('load', function() {
      var email = localStorage.getItem('email');
      if (email) {
        document.getElementById('reg_email').value = email; // Set the email value in the input field
        localStorage.removeItem('email'); // Remove the email value from local storage
      }
    });
</script>

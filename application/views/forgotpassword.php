<section>

    <div class="forgot-flex-container bg-soft-primary">
        <div class="forgot-flex-item rounded bg-light"> 
            <div class="h3">Forgot password</div>
            <div style="font-size:14px">Enter the email address associated with your account and we'll send you a link to reset your password.</div>
            <div>
                <div class="fw-bold text-dark mt-5 mb-2">Email</div>
                <input type="text" class="form-control" id="mail">
                <span id="errormessgae"><?php echo $message ?></span>
                <label class="text-danger mt-1" id="invalid" style="display:none">Please enter valid email address</label>
                <button class="btn btn-primary form-control mt-4" id="continue" onclick="validate()">Continue</button>
                
            </div>
            <a href="<?=base_url('admin')?>"><div class="text-primary text-center fw-bold mt-3 return-to-signin">Return to vendor sign in</div></a>

        </div>
        <div id="create-account" class="mt-3">
            Don't have an account? <span class="text-primary"><a href="<?=base_url('join')?>">Sign up</a></span>
        </div>
        <div id="create-account px-2">
           Please <span class="text-primary"><a href="<?=base_url('contact-us')?>">Contact us</a></span> if you require any assistance
        </div>
    </div>

    <script>
        function validate(){
            let data = document.getElementById('mail').value;
            let tag = document.getElementById('invalid');
            let validRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
            if(data.match(validRegex)){
                tag.style.display="none";
                window.location = "<?php echo base_url('home/sendemail/')?>" + data;
            }
            else{
                document.getElementById('errormessgae').style.display="none";
                tag.style.display="inline-block";
            }
        }
    </script>
</section>
<script type="text/javascript">

        history.pushState({}, null, '<?= base_url('forgot-password') ?>');

    </script>

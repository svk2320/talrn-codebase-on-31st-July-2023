<section>

    <div class="forgot-flex-container bg-soft-primary">
        <div class="forgot-flex-item rounded bg-light">
            <div class="h3">Sign in to start your session</div>
            <br>
            <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?php if (!empty($errors)) {
                echo $errors;
            } ?>
            <form action="<?php echo base_url('admin/auth/login') ?>" method="post">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                        autocomplete="off">
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                        autocomplete="off">
                </div>
                <button type="submit" class="btn btn-primary form-control mt-4" id="submit">Continue</button>
            </form>
            <a href="<?= base_url('forgot-password') ?>"><div class="text-primary text-center fw-bold mt-3 return-to-signin">Forgot password?</div></a>
        </div>
        <div id="create-account" class="mt-3">
            Don't have an account? <span class="text-primary"><a href="<?= base_url('join') ?>">Sign up</a></span>
        </div>
        <div id="create-account px-2">
            Please <span class="text-primary"><a href="<?= base_url('contact-us') ?>">Contact us</a></span> if you
            require
            any assistance
        </div>
    </div>
</section>
<script type="text/javascript">

        history.pushState({}, null, '<?= base_url('admin/auth/login') ?>');

    </script>

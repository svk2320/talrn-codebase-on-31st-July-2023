<section class="wrapper bg-soft-primary">
    <div class="container pt-md-14 pb-md-17">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
                
                <div class="jumbotron text-center">
                    <h1 class="text-success">Thank You!</h1>
                    <p class="lead">Please check your email <strong><?php echo $email; ?></strong> for your login information and account activation.</p>
                    <p class="lead">We will be redirecting you to upload profile form in </p>
                    <h1><span id="seconds">5</span>s</h1>
                    <br>
                    <p class="lead">
                        <a class="btn btn-primary btn-sm" onclick="redirect()" role="button" onclick="">Continue to Upload a profile</a>
                    </p>
                </div>
                <form id="login" style="display: none" action="<?php echo base_url('admin/auth/login_join') ?>" method="post">
                    <input type="email" name="email" id="email" autocomplete="off" value="<?=$email?>">
                    <input type="password" name="password" id="password" autocomplete="off" value="<?=$password?>">
                </form>
                
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <script>
            $(document).ready(function () {
                countdownTimer();
            });
            var seconds = 5; // seconds for HTML
            var foo; // variable for clearInterval() function

            function redirect() {
                document.getElementById("login").submit();
            }

            function updateSecs() {
                document.getElementById("seconds").innerHTML = seconds;
                seconds--;
                if (seconds == -1) {
                    clearInterval(foo);
                    redirect();
                }
            }

            function countdownTimer() {
                foo = setInterval(function () {
                    updateSecs()
                }, 1000);
            }
        </script>

    </div>
</section>
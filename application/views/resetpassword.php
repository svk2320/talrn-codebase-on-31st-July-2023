<section>

    <div class="forgot-flex-container bg-soft-primary">
        <div class="forgot-flex-item rounded" style="background-color:white">
            <div class="h3">Reset password</div>
            <div style="font-size:14px">Create a new password for your Talrn vendor account</div>
            <div>
                <?php echo "<font color='red'>".$message."</font>"; ?>
                <div class="fw-bold text-dark mt-3 mb-2">New password</div>
                <div class="row bg-light">
                    <div class="col-lg-10 col-10">
                        <input type="password" class="form-control" id="passwordField">
                    </div>
                    <div class="col-lg-2 col-2">
                        <i id="eye-1" class="bi bi-eye-fill text-dark text-center eye-icon" onclick="showPassword()"></i>
                        <i style="display:none" id="eye-slash-1" class="bi bi-eye-slash-fill text-dark text-center eye-icon" onclick="showPassword()"></i>
                    </div>
                </div>

                <div class="fw-bold text-dark mt-3 mb-2">Confirm password</div>
                <div class="row bg-light">
                    <div class="col-lg-10 col-10">
                        <input type="password" class="form-control" id="confirmField" onkeyup="match()">
                    </div>
                    <div class="col-lg-2 col-2">
                        <i id="eye-2" class="bi bi-eye-fill text-dark text-center eye-icon" onclick="showConfirm()"></i>
                        <i style="display:none" id="eye-slash-2" class="bi bi-eye-slash-fill text-dark text-center eye-icon" onclick="showConfirm()"></i>
                    </div>
                </div>
                <label id="nomatch" class="text-danger" style="display:none"> Password dont match !</label>
                <button class="btn btn-primary form-control mt-4" id="reset" onclick="buttonClick()" disabled>Reset password</button>
            </div>


        </div>
    </div>
    <script>
        
        function buttonClick(){
            console.log('button clicked');
            password = document.getElementById('passwordField').value;
            window.location = "<?php echo base_url('home/resetpass').'?id='.$user_id.'&token='.$pass.'&pass='?>" + password ;
        }
        
        
        
        function showConfirm(){
            var temp = document.getElementById("confirmField");
            if (temp.type === "password") {
                temp.type = "text";
                document.getElementById('eye-2').style.display="none";
                document.getElementById('eye-slash-2').style.display="inline-block";
            }
            else {
                temp.type = "password";
                document.getElementById('eye-2').style.display="inline-block";
                document.getElementById('eye-slash-2').style.display="none";
            }

        }
        function showPassword(){
            var temp = document.getElementById("passwordField");
            if (temp.type === "password") {
                temp.type = "text";
                document.getElementById('eye-1').style.display="none";
                document.getElementById('eye-slash-1').style.display="inline-block";
                
            }
            else {
                temp.type = "password";
                document.getElementById('eye-1').style.display="inline-block";
                document.getElementById('eye-slash-1').style.display="none";
            }

        }

        function match(){
            let pass = document.getElementById('passwordField').value
            let confirm = document.getElementById('confirmField').value
            let tag = document.getElementById('nomatch')
            let reset = document.getElementById('reset')
            if(pass!=confirm){
                console.log("Not matched")
                tag.style.display="inline-block"
                reset.disabled=true
            }
            else{
                console.log("Matched")
                tag.style.display="none"
                reset.disabled=false
            }
        }
    </script>
</section>

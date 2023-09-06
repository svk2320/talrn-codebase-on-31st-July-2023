

<section class="wrapper bg-soft-primary">
      <div class="container pt-10 pb-12 pt-md-14 pb-md-17">

        <ul id="signup-step">
            <li id="personal" class="active">Personal Detail</li>
            <li id="password">Password</li>
            <li id="contact">Contact</li>
        </ul>

        <?php
        if (isset($success)) {
            echo '<div>User record inserted successfully</div>';
        }

        $attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
        echo form_open('admin/vendor/formdata', $attributes);
        ?>
        <div id="personal-field">
            <label>Name</label><span id="name-error" class="signup-error"></span>
            <div><input type="text" name="name" id="name" class="demoInputBox"/></div>
            <label>Date of Birth</label><span id="dob-error" class="signup-error"></span>
            <div><input type="text" name="dob" id="dob" class="demoInputBox"/></div>
            <label>Gender</label>
            <div>
                <select name="gender" id="gender" class="demoInputBox">
                    <option value="male">Male</option>
                    <option value="female">Female</option>                                                                         
                </select>
            </div>
        </div>

        <div id="password-field" style="display:none;">
            <label>Enter Password</label><span id="password-error" class="signup-error"></span>
            <div><input type="password" name="password" id="user-password" class="demoInputBox" /></div>
            <label>Re-enter Password</label><span id="confirm-password-error" class="signup-error"></span>
            <div><input type="password" name="confirm-password" id="confirm-password" class="demoInputBox" /></div>
        </div>

        <div id="contact-field" style="display:none;">
            <label>Phone</label><span id="phone-error" class="signup-error"></span>
            <div><input type="text" name="phone" id="phone" class="demoInputBox" /></div>
            <label>Email</label><span id="email-error" class="signup-error"></span>
            <div><input type="text" name="email" id="email" class="demoInputBox" /></div>
            <label>Address</label><span id="address-error" class="signup-error"></span>
            <div><textarea name="address" id="address" class="demoInputBox" rows="5" cols="50"></textarea></div>
        </div>

        <div>
            <input class="btnAction" type="button" name="back" id="back" value="Back" style="display:none;">
            <input class="btnAction" type="button" name="next" id="next" value="Next" >
            <input class="btnAction" type="submit" name="finish" id="finish" value="Finish" style="display:none;">
        </div>
        <?php echo form_close(); ?>
    </div>
    </section>
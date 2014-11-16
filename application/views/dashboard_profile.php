<div class="content">
<div class="header">
    <h1 class="page-title">Admin Profile</h1>
</div>
<div class="main-content">
    <h4>Account Information</h4>
    <form>
        <fieldset>
            <!-- Name, Email & Phone Section -->
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="firstname">Firstname<span>*</span></label>
                    <?php echo form_error('firstname'); ?><br/>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" value="<?php echo $firstname; ?>" id="firstname" required="">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="lastname">Lastname<span>*</span></label>
                    <?php echo form_error('lastname'); ?><br/>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" value="<?php echo $lastname; ?>" id="lastname" required="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="email">Email<span>*</span></label>
                    <?php echo form_error('email'); ?><br/>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" class="form-control" value="<?php echo $email; ?>" id="email" required="">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="phone">Phone No<span>*</span></label>
                    <?php echo form_error('phone'); ?><br/>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="text" class="form-control" value="<?php echo $phone; ?>" id="phone" required="">
                    </div>
                </div>
            </div>
        </fieldset>


        <!-- Save Button -->
        <div class="row">
            <div class="pull-left">
                <button type="submit" id="save-name" class="btn btn-primary"><i class="fa fa-check"></i>Save</button>
            </div>
        </div>
    </form>

    <h4>Change Password</h4>
    <form id="form-password">
        <fieldset>
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="password">Current Password:<span>*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="password" class="form-control " placeholder="Your password:" id="old-password" required="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="password">New Password:<span>*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="password" class="form-control " placeholder="Your password:" id="new-password" required="">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="password2">Confirm new password:<span>*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="password" class="form-control " placeholder="Your password:" id="new-password1" required="">
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="row">
                <div class="pull-left">
                    <button type="submit" id="save-password" class="btn btn-primary"><i class="fa fa-check"></i>Save</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
       $("#save-name").click(function(){
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            var email = $("#email").val();
            var phone = $("#phone").val();
            // Returns successful data submission message when the entered information is stored in database.
            var dataString = 'firstname1='+ firstname + '&lastname1='+ lastname + '&email1='+ email + '&phone1='+ phone;
            if(firstname==''||lastname==''||email==''||phone=='')
            {
                alert("Please Fill All Fields");
            }
            else
            {
                // AJAX Code To Submit Form.
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('dashboard/update_admin_profile')?>",
                    data: dataString,
                    cache: false,
                    success: function(result){
                        alert(result);
                    }
                });
            }
            return false;
        });
        $("#save-password").click(function(){
            var oldPassword = $("#old-password").val();
            var newPassword = $("#new-password").val();
            var newPassword1 = $("#new-password1").val();
            // Returns successful data submission message when the entered information is stored in database.
            var dataString = 'oldPassword1='+ oldPassword + '&newPassword2='+ newPassword + '&newPassword3='+ newPassword1;
            if(oldPassword==''||newPassword==''||newPassword1=='')
            {
                alert("Please Fill All Fields");
            }
            else if (newPassword != newPassword1)
            {
                alert("Your new password not match!. Please try it again!");
            }
            else
            {
                // AJAX Code To Submit Form.
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('dashboard/update_admin_password')?>",
                    data: dataString,
                    cache: false,
                    success: function(result){
                        alert(result);
                        jQuery('#form-password').resetForm();
                    }
                });
            }
            return false;
        });
    });
</script>



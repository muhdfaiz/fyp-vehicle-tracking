<h4>Edit User</h4>
<form>
    <fieldset>
        <!-- Name, Email & Phone Section -->
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="firstname">Firstname<span>*</span></label>
                <?php echo form_error('firstname'); ?><br/>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" value="<?php echo $firstname;?>" id="firstname" required="">
                </div>
            </div>
            <div class="form-group col-sm-6">
                <label for="lastname">Lastname<span>*</span></label>
                <?php echo form_error('lastname'); ?><br/>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" value="<?php echo $lastname;?>" id="lastname" required="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="icNumber">IC No<span>*</span></label>
                <?php echo form_error('phone'); ?><br/>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" class="form-control" value="<?php echo $ic_number;?>" id="icNo" required="">
                </div>
            </div>
            <div class="form-group col-sm-6">
                <label for="phone1">User Phone No<span>*</span></label>
                <?php echo form_error('phone1'); ?><br/>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" class="form-control" value="<?php echo $user_phone_no;?>" id="phone1" required="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="phone">Relative Phone No<span>*</span></label>
                <?php echo form_error('phone'); ?><br/>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" class="form-control" value="<?php echo $relative_phone_no;?>" id="phone" required="">
                </div>
            </div>
            <div class="form-group col-sm-6">
                <label for="address">Address<span>*</span></label>
                <?php echo form_error('address'); ?><br/>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="text" class="form-control" value="<?php echo $address;?>" id="address" required="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="device">Device No<span>*</span></label>
                <?php echo form_error('device'); ?><br/>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="text" class="form-control" value="<?php echo $device_number;?>" id="device" required="">
                </div>
            </div>
            <div class="form-group col-sm-6">
                <label for="days">Days of use:<span>*</span></label>
                <?php echo form_error('address'); ?><br/>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="text" class="form-control" value="<?php echo $day_used;?>" id="days" required="">
                </div>
            </div>
        </div>
    </fieldset>


    <!-- Save Button -->
    <div class="row">
        <div class="pull-left">
            <button type="submit" id="save-user" class="btn btn-primary"><i class="fa fa-check"></i>Save</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function(){
        $("#save-user").click(function(){
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            var icNo = $("#icNo").val();
            var address = $("#address").val();
            var phone = $("#phone").val();
            var phone1 = $("#phone1").val();
            var days = $("#days").val();
            var device = $("#device").val();
            // Returns successful data submission message when the entered information is stored in database.
            var dataString = 'firstname1='+ firstname + '&lastname1=' + lastname + '&icNo1=' + icNo + '&address1=' + address + '&phone1=' + phone + '&phone2=' + phone1 + '&days1=' + days + '&device1=' + device;
            if(firstname==''||lastname==''||icNo==''||address==''||phone==''||phone1==''||days==''||device=='')
            {
                alert("Please Fill All Fields");
            }
            else
            {
                // AJAX Code To Submit Form.
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('dashboard/update_user/' . $userId)?>",
                    data: dataString,
                    cache: false,
                    success: function(result){
                        alert('User Information Successfully Update');
                        window.location.replace("<?php echo base_url() . 'dashboard/user' ?>");
                    }
                });
                return false;
            }
        });
    });
</script>
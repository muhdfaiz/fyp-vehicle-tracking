<div class="content">
    <div class="header">
        <h1 class="page-title">Add & View User</h1>
    </div>
    <div class="main-content">
        <h4>Add New User</h4>
        <form>
            <fieldset>
                <!-- Name, Email & Phone Section -->
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="firstname">Firstname<span>*</span></label>
                        <?php echo form_error('firstname'); ?><br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="First Name" id="firstname" required="">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="lastname">Lastname<span>*</span></label>
                        <?php echo form_error('lastname'); ?><br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="Last Name" id="lastname" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="icNumber">IC No<span>*</span></label>
                        <?php echo form_error('phone'); ?><br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="text" class="form-control" placeholder="IC No" id="icNo" required="">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="phone1">User Phone No<span>*</span></label>
                        <?php echo form_error('phone'); ?><br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="text" class="form-control" placeholder="Relative Phone No" id="phone1" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="phone">Relative Phone No<span>*</span></label>
                        <?php echo form_error('phone'); ?><br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" class="form-control" placeholder="Your Relative Phone No" id="phone" required="">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="address">Address<span>*</span></label>
                        <?php echo form_error('address'); ?><br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" class="form-control" placeholder="Address" id="address" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="device">Device No<span>*</span></label>
                        <?php echo form_error('device'); ?><br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" class="form-control" placeholder="Device Number" id="device" required="">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="days">Days of use:<span>*</span></label>
                        <?php echo form_error('address'); ?><br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" class="form-control" placeholder="No of days used" id="days" required="">
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

        <div style="padding-top: 40px;" class="row">
            <div class="vehicle-list col-md-12">
                <!-- BEGIN SAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bus"></i>List Of User
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Device No</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>IC Number</th>
                                    <th>User Phone No</th>
                                    <th>Relative Phone No</th>
                                    <th style="width: 30%;">Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($listUser->result() as $row)
                                { ?>
                                    <tr>
                                        <td>
                                            <span id="edit" class="label label-sm label-info">Edit</span>
                                            <span id="delete" class="label label-sm label-warning">Delete</span>
                                            <div style="display: none;" class='userId'><?php echo $row->user_id; ?></div>
                                        </td>
                                        <td><?php echo $row->device_number; ?></td>
                                        <td><?php echo $row->firstname; ?></td>
                                        <td><?php echo $row->lastname; ?></td>
                                        <td><?php echo $row->ic_number; ?></td>
                                        <td><?php echo $row->user_phone_no; ?></td>
                                        <td><?php echo $row->relative_phone_no; ?></td>
                                        <td><?php echo $row->address; ?></td>
                                    </tr>
                                <?php }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END SAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
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
                        url: "<?php echo base_url('dashboard/add_new_user')?>",
                        data: dataString,
                        cache: false,
                        success: function(result){
                            alert(result);
                            window.location.reload();
                        }
                    });
                    return false;
                }
            });
            $(document).on('click', '#delete', function(){
                if(confirm('Are you sure want to delete?')){
                    // get the id
                    var user_id = $(this).closest('td').find('.userId').text();

                    // Returns successful data submission message when the entered information is stored in database.
                    var dataString = 'user_id1='+ user_id;

                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('dashboard/delete_user')?>",
                        data: dataString,
                        cache: false,
                        success: function(result){
                            alert(result);
                            window.location.reload();
                        }
                    });
                    return false;
                }
            });
            $(document).on('click', '#edit', function(){
                var user_id = $(this).closest('td').find('.userId').text();
                $(".main-content").load('update_user/' + user_id);

            });
        });
    </script>
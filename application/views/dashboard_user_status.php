<div class="content">
    <div class="header">
        <h1 class="page-title">User Status</h1>
    </div>
    <div class="main-content">
        <div class="selectStatus form-group col-sm-4">
            <form>
                <fieldset>
                    <label for="type">Status</label>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <select class="form-control" id="selectStatus">
                            <option>All</option>
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>
                </fieldset>
            </form>
        </div>
        <div style="padding-top: 40px;" class="row">
            <div class="user-list col-md-12">
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
                                    <th>Status</th>
                                    <th>Device No</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>IC Number</th>
                                    <th>User Phone No</th>
                                    <th>Relative Phone No</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($listUser->result() as $row)
                                { ?>
                                    <tr>
                                        <td><?php if ($row->status == 'inactive') { ?>
                                                <span id="setActive" class="label label-sm label-info">Set Active</span>
                                            <?php }
                                            else
                                            { ?>
                                                <span id="setInactive" class="label label-sm label-warning">Set Inactive</span>
                                            <?php }?>

                                            <div style="display: none;" class='userId'><?php echo $row->user_id; ?></div>
                                        </td>
                                        <td><?php echo $row->status; ?></td>
                                        <td><?php echo $row->device_number; ?></td>
                                        <td><?php echo $row->firstname; ?></td>
                                        <td><?php echo $row->lastname; ?></td>
                                        <td><?php echo $row->ic_number; ?></td>
                                        <td><?php echo $row->user_phone_no; ?></td>
                                        <td><?php echo $row->relative_phone_no; ?></td>
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
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#selectStatus").change(function () {
            selectedStatus = $('#selectStatus').val();
            if(selectedStatus == 'Active')
            {
                $( ".user-list" ).load( "<?php echo base_url() . "dashboard/update_user_status/active" ?>");
            }
            else if(selectedStatus == 'Inactive')
            {
                $( ".user-list" ).load( "<?php echo base_url() . "dashboard/update_user_status/inactive" ?>");
            }
            else if(selectedStatus == 'All')
            {
                $( ".user-list" ).load( "<?php echo base_url() . "dashboard/update_user_status1" ?>");
            }
        });
        $(document).on('click', '#setInactive', function(){
                // get the id
                var user_id = $(this).closest('td').find('.userId').text();

                // Returns successful data submission message when the entered information is stored in database.
                var dataString = 'user_id1='+ user_id;

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('dashboard/set_user_status/inactive')?>",
                    data: dataString,
                    cache: false,
                    success: function(result){
                        window.location.reload();
                    }
                });
                return false;
            });
        $(document).on('click', '#setActive', function(){
            // get the id
            var user_id = $(this).closest('td').find('.userId').text();

            // Returns successful data submission message when the entered information is stored in database.
            var dataString = 'user_id1='+ user_id;

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('dashboard/set_user_status/active')?>",
                data: dataString,
                cache: false,
                success: function(result){
                    window.location.reload();
                }
            });
            return false;
        });
    });
</script>
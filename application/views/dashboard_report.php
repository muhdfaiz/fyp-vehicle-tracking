<div class="content">
    <div class="header">
        <h1 class="page-title">Admin Profile</h1>
    </div>
    <div class="main-content">
        <div class="selectUser form-group col-sm-4">
            <form>
                <fieldset>
                    <label for="type">Select Active User</label>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bus"></i></span>
                        <select class="form-control" id="userList">
                            <?php
                            $index =0; ?>
                            <option value="Select Active User">Select User</option>
                            <?php foreach($listUser->result() as $row)
                            { ?>
                                <option value="<?php echo $row->firstname . ' ' . $row->lastname;?>"><?php echo $row->firstname . ' ' . $row->lastname;?></option>
                            <?php }?>
                        </select>
                    </div>
                </fieldset>
            </form>
        </div>

        <div style="clear: both" class="row">
            <div id="route-container" class="col-md-12">
                <div id="routeData" style="width:100%;height:500px;"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#userList").change(function () {
            selectedUser = $('#userList').val();
            splitUser = selectedUser.split(" ");
            console.log(splitUser[0]);
            $( "#routeData" ).load( "<?php echo base_url() . "gps_data/get_gps_data1/" ?>" + splitUser[0]);
        });
    });
</script>
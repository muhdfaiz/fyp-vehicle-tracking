<div class="content">
    <div class="header">
        <h1 class="page-title">Track Active User</h1>
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
                            <option value="Select Active User">Select Active User</option>
                            <?php foreach($listActiveUser->result() as $row)
                            { ?>
                                <option value="<?php echo $row->firstname . ' ' . $row->lastname;?>"><?php echo $row->firstname . ' ' . $row->lastname;?></option>
                            <?php }?>
                        </select>
                    </div>
                </fieldset>
            </form>
        </div>
        <div id="currentLocation">
            <h3>Current Location</h3>
            <b>Latitude:</b> <span id="latitude"></span><br />
            <b>Longitude:</b> <span id="longitude"></span><br />
            <b>Date:</b> <span id="date"></span><br />
            <b>Time:</b> <span id="time"></span>
        </div>
        <div id="map" style="width:100%;height:500px;"></div>
    </div>
</div>
<script src="<?=base_url()?>public/js/dateformat.js"></script>
<script>
    var selectedUser, lat = [], lati = [], long = [];
    var dateData;
    var timeData;
    var userPath = [];
    var counter = 0;
    var counter1 = 0;
    var map;
    var coordinate = [];
    var marker;
    var gpsData;
    var splitGpsData = [];

    $(document).ready(function(){
        googleMapInit();
        $("#userList").change(function () {
            selectedUser = $('#userList').val();
            //console.log(selectedVehicle);
            if(selectedUser!='Select Active User')
            {
                console.log('Selected User: ' + selectedUser);
                counter++; // 2
                console.log('Counter: ' + counter);
                if(counter>1){
                    console.log('close event');
                    window[gpsData + (counter-1).toString].close();//gpsData1
                }
                window[gpsData + counter.toString] = new EventSource("<?php echo base_url() . 'sse_push/getGpsData/' ?>" + selectedUser);
                googleMapInit();
                window[gpsData + counter.toString].onmessage = function (e) { //gpsData1
                    if(e.data )
                    {
                        var combineGpsData = e.data;
                        // Create a variable to contain the array

                        // Use the string.split function to split the string
                        splitGpsData = combineGpsData.split(" ");
                        var length = splitGpsData.length;
                        var latitude = splitGpsData[0];
                        var longitude = splitGpsData[1];
                        var date = splitGpsData[2];
                        var time = splitGpsData[3];
                        console.log(date);

                        for (var i = 5; i < length; i++) {
                            address += splitGpsData[i] + ' ';
                            //address =
                        }
                        dateFormatting = new Date(date);
                        var dateResult = dateFormatting.format("dd-mm-yyyy");
                        lat.push(latitude);
                        counter1++; // 1
                        //if(counter1<2 || latitude != lat[counter1-1]) {
                        //console.log('Latitude: ' +latitude);
                        //console.log('Lat: ' + lat[counter1-1]);
                        moveToLocation(latitude, longitude);
                        userPath.push(new google.maps.LatLng(latitude, longitude));
                        //console.log('Add Marker');
                        //reverseGeocoding(latitude, longitude, speed, dateResult, time, map);
                        addMarker(latitude, longitude, map, date, time);
                        drawROute(userPath);
                        //}

                        $('#latitude').text(splitGpsData[0]);
                        $('#longitude').text(splitGpsData[1]);
                        $('#date').text(splitGpsData[2]);
                        $('#time').text(splitGpsData[3]);
                    }
                };
            }else
            {
                $(".selectVehicleText").text('Please select vehicle!');
                googleMapInit1();
                window[gpsData + (counter).toString].close();//gpsData1
            }

        });

    });
    //google.maps.event.addDomListener(window, 'load', googleMapInit);
</script>

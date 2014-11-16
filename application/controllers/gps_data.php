<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gps_Data extends CI_Controller
{
    public function store_data($userId, $latitude, $longitude)
    {
        // http://localhost/tracking-people/gps_data/store_data/2/3.23986500/101.62398000
        $this->load->model('gps_model');
        $date = new DateTime('now', new DateTimeZone('Asia/Kuala_Lumpur'));
        $gpsData = array(
            'user_id' => $userId,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'date' => $date->format('Y-m-d H:i:s'),
        );


            $this->gps_model->insertData('gps', $gpsData);
    }

    public function store_address()
    {
        $id = $_POST['gpsId1'];
        $userInfo = array(
            'address' => $_POST['address1'],
        );
        echo $userInfo['address'];
        $this->load->model('gps_model');
        $this->gps_model->updateData('gps', $userInfo, 'gps_id', $id);
    }

    public function get_gps_data($firstname)
    {
        $query = null;
        $numRow = null;
        $this->load->model('gps_model');
        $user_id = $this->gps_model->readDataFilter('firstname', $firstname, 'user', 'user_id');

        //echo $this->db->last_query() . '<br/>';
        $query = $this->gps_model->getGpsData('gps', 'user_id', $user_id);
        $numRow = $this->gps_model->countGpsData('gps', 'user_id', $user_id);
        //echo $this->db->last_query();

        //echo $this->db->last_query();
        //print_r($query);
        //echo $numRow -1 ;
        if($query->num_rows()>0)
        {
            ?>
            <script>

                var selectedUser;
                var lat, lng;
                var dateData;
                var timeData;
                var userPath = [];
                var counter = 0;
                var map;
                var coordinate = [];
                var marker;
                var gpsData;
                var contentString;
                var address;
                $(document).ready(function(){
                    map = new GMaps({
                        div: '#map',
                        lat: 3.23486,
                        lng: 101.62984,
                        zoom: 18
                    });
                    <?php
                    $counter=0;

                    foreach ($query->result() as $row)
                    { ?>
                    if(counter==0){
                        map.drawOverlay({
                            lat: <?php echo $row->latitude; ?>,
                            lng: <?php echo $row->longitude; ?>,
                            content: "<a class='tooltips' href='#'><span>Start</span></a>"
                        });
                        var center = new google.maps.LatLng(<?php echo $row->latitude; ?>, <?php echo $row->longitude; ?>);
                        // using global variable:
                        map.panTo(center);
                    }
                    else if(counter == <?php echo $numRow - 1?>)
                    {
                        map.drawOverlay({
                            lat: <?php echo $row->latitude; ?>,
                            lng: <?php echo $row->longitude; ?>,
                            content: "<a class='tooltips' href='#'><span>Stop</span></a>"
                        });
                    }

                    console.log(counter);
                    contentString = "<div style='font-size:14px;width:190px; height:90px;'>" + "<span style='font-weight: bold;'>Location:</span>" + "<span class='counter'>" + counter + "</span>" + "<br /> <span style='font-weight: bold;'>Latitude:</span> " + <?php echo $row->latitude; ?> + "<br /> <span style='font-weight: bold;'>Longitude:</span> "  + "<span id='longitude'>" + <?php echo $row->longitude; ?> + "</span>" + '</div>';
                    marker = map.addMarker({
                        lat: <?php echo $row->latitude; ?>,
                        lng: <?php echo $row->longitude; ?>,
                        title: 'Location: ' + counter,
                        id: counter,
                        infoWindow: {
                            content: contentString
                        }
                    });

                    google.maps.event.addListener(marker, 'click', function(event) {
                    });
                    counter++;
                    userPath.push(new google.maps.LatLng(<?php echo $row->latitude; ?>, <?php echo $row->longitude; ?>));
                    <?php } ?>

                    map.drawPolyline({
                        path: userPath,
                        strokeColor: '#4d5b76',
                        strokeOpacity: 1.0,
                        strokeWeight: 5
                    });
                });
            </script>
        <?php }
        else
        { ?>
            <script>
                map = new GMaps({
                    div: '#map',
                    lat: 3.23486,
                    lng: 101.62984,
                    zoom: 18
                });
                alert('Not Have Any GPS Data For This Specific Date')
            </script>
        <?php }
    }

    public function get_gps_data1($firstname)
    {
        $query = null;
        $numRow = null;
        $this->load->model('gps_model');
        $user_id = $this->gps_model->readDataFilter('firstname', $firstname, 'user', 'user_id');

        //echo $this->db->last_query() . '<br/>';
        $query = $this->gps_model->getGpsData('gps', 'user_id', $user_id);
        $numRow = $this->gps_model->countGpsData('gps', 'user_id', $user_id);
        //echo $this->db->last_query();

        //echo $this->db->last_query();
        //print_r($query);
        //echo $numRow -1 ;
        if($query->num_rows()>0)
        { ?>
            <div class="col-md-12">
                <!-- BEGIN SAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-history"></i>Route History
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $counter = 1;
                                foreach ($query->result() as $row)
                                { ?>
                                    <tr>
                                        <td><?php echo $counter++; ?></td>
                                        <td><?php echo $row->latitude; ?></td>
                                        <td><?php echo $row->longitude; ?></td>
                                        <td>
                                            <?php $getDateOnly = new DateTime($row->date);
                                            echo $getDateOnly->format('d-m-Y'); ?>
                                        </td>
                                        <td>
                                            <?php $getTimeOnly = new DateTime($row->date);
                                            echo $getTimeOnly->format('h:m:s'); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END SAMPLE TABLE PORTLET-->
            </div>
            <script>
                $( "#export-button" ).show();
            </script>
        <?php }
        else
        { ?>
            <script>
                alert('Not Have Any GPS Data For This Specific Date')
                $( "#export-button" ).hide();
            </script>
        <?php }
    }
}
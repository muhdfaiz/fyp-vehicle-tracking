<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Sse_Push extends CI_Controller
    {
        public function getGPSData($userFullName)
        {
            header('Content-Type: text/event-stream');
            header('Cache-Control: no-cache');
            $firstname = explode("%20", $userFullName);
            //echo $firstname[0];

            $serverTime = time();
            $this->gpsData($serverTime, $firstname[0]);
        }

        function gpsData($id, $firstname) {
            echo "id: $id" . PHP_EOL;
            $CI =& get_instance();
            $CI->load->model('sse_model');
            $userId = $CI->sse_model->selectSpecificColumn('user_id', 'user', 'firstname', $firstname);
            $latitude = $CI->sse_model->readOnlyLastRow('gps', 'gps_id', 'latitude', 'user_id', $userId);
            //echo $this->db->last_query();
            $longitude = $CI->sse_model->readOnlyLastRow('gps', 'gps_id', 'longitude', 'user_id', $userId);
            $date = $CI->sse_model->readOnlyLastRow('gps', 'gps_id', 'date', 'user_id', $userId);
            //$noOfRow = $CI->sse_model->getRowCount('gps', 'user_id', '41');
            echo "data: $latitude " . PHP_EOL;
            echo "data: $longitude " . PHP_EOL;
            echo "data: $date " . PHP_EOL;
            echo "retry: 10000\n\n";
            echo PHP_EOL;
            ob_flush();
            flush();
        }
    }
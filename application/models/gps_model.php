<?php
class Gps_Model extends CI_Model
{
    public function insertData($tableName, $data) {
        $this->db->insert($tableName, $data);
    }

    public function readDataFilter($filterColumn, $filterId, $tableName, $columnName)
    {
        $userData = '';
        $this->db->select($columnName);
        $this->db->where($filterColumn, $filterId );
        $query = $this->db->get($tableName);

        foreach ($query->result() as $row)
        {
            $data =  $row->$columnName;
        }
        return $data;
    }

    public function getGPSData($tableName, $filterColumn, $filterValue)
    {
        $this->db->where($filterColumn, $filterValue);
        //echo $sql;
        $query = $this->db->get($tableName);
        return $query;
    }

    public function countGPSData($tableName, $filterColumn, $filterValue)
    {
        $this->db->where($filterColumn, $filterValue);
        //echo $sql;
        $query = $this->db->get($tableName);
        $countRow = $query->num_rows();
        return $countRow;
    }
}
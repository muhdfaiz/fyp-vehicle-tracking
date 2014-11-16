<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function readAllData($tableName)
    {
        $query = $this->db->get($tableName);
        return $query;
    }

    public function readDataByRow($tableName, $rowName)
    {
        $id = $this->session->userdata('admin_id');
        $this->db->where('admin_id', $id );
        $query = $this->db->get($tableName);

        foreach ($query->result() as $row)
        {
            $userData =  $row->$rowName;
        }
        return $userData;
    }

    public function readDataFilter($filterColumn, $filterId, $tableName)
    {
        $this->db->where($filterColumn, ($filterId) );
        $query = $this->db->get($tableName);

        return $query;
    }

    public function readDataFilter1($filterColumn, $filterId, $tableName, $rowName)
    {
        $userData = '';
        $this->db->where($filterColumn, $filterId );
        $query = $this->db->get($tableName);

        foreach ($query->result() as $row)
        {
            $userData =  $row->$rowName;
        }
        return $userData;
    }
    public function addData($tableName, $data)
    {
        $this->db->insert($tableName, $data);
    }

    public function updateData($tableName, $data, $filterColumn, $filterId)
    {
        $this->db->where($filterColumn, $filterId);
        $this->db->update($tableName, $data);
    }

    public function deleteData($tableName, $tableId, $id)
    {
        $this->db->where($tableId, $id );
        $this->db->delete($tableName);
    }

    public function comparePasswordHash()
    {
        $this->db->select('hash');
        $id = $this->session->userdata('admin_id');
        $this->db->where('admin_id', $id );
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            return $query->row()->hash;
        }
    }

    public function getRowCount($tableName, $columnName, $filterId)
    {
        $this->db->where($columnName, $filterId );
        return $this->db->count_all($tableName);
    }

    function readOnlyLastRow($tableName, $orderColumn, $rowName, $filterColumn, $filterValue)
    {
        $data = '';
        $this->db->where($filterColumn, $filterValue );
        $this->db->order_by($orderColumn, 'desc');
        $query = $this->db->get($tableName, 1,0);
        foreach ($query->result() as $row)
        {
            $data =  $row->$rowName;
        }
        return $data;
    }
}
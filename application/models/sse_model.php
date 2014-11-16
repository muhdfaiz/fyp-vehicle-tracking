<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Sse_Model extends CI_Model
    {
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
        public function getRowCount($tableName, $columnName, $filterId)
        {
            $this->db->where($columnName, $filterId );
            return $this->db->count_all($tableName);
        }

        public function selectSpecificColumn($columnName, $tableName, $filterColumn, $filterValue)
        {
            $data = '';
            $this->db->select($columnName);
            $this->db->where($filterColumn, $filterValue );
            $query = $this->db->get($tableName);

            foreach ($query->result() as $row)
            {
                $data =  $row->$columnName;
            }
            return $data;
        }
    }
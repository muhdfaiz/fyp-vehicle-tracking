<?php
class Login_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function verify_login($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('admin');
        return $query;
    }
}
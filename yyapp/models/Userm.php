<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Userm extends CI_Model {
    public function __construct(){
    	parent::__construct();
        $this->load->database('crmp');
    }
	public function checkuser($userid){
		$query = $this->db->query("SELECT * FROM user WHERE userid='".$userid."' AND status=1");
		$row   = $query->row_array();
		return empty($row);
	}
	public function checkPassword($userid,$password){
		$query = $this->db->query("SELECT * FROM user WHERE userid='".$userid."' and password='".$password."'");
		$row   = $query->row_array();
		return !empty($row);
	}
	public function getUser($userid){
		$query = $this->db->query("SELECT * FROM user WHERE userid='".$userid."'");
		$row   = $query->row_array();
		return $row;
	}
}

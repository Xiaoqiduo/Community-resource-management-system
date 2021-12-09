<?php
/**
 * wirited by Seaside_He
 * Functions related to community public resources
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Peoplem extends CI_Model {
    public function __construct(){
    	parent::__construct();
        $this->load->database('crmp');
    }
	/**
	  * insert orders information into the "orders table
	  * */
	public function insertAdmin($data){
		$query = $this->db->insert('user',$data);
		return $query;
	}
	
	/**
	 * Query orders information from the "orders table
	 * */
	
	 public function getPersonInf($user_signature){
	 	$sql = "SELECT * FROM (csessioninfo a LEFT JOIN street b ON a.street_id=b.street_id) LEFT JOIN community c ON a.cmty_id=c.cmty_id WHERE user_signature='".$user_signature."'";
	 	$result = $this->db->query($sql);
	 	return $result->row_array();
	 }
	 

	 
	 public function getAdmin(){
	 	$sql ="SELECT a.*, b.role_name, c.street_name, d.cmty_name FROM ((user a LEFT JOIN role b ON a.role=b.role_id) LEFT JOIN street c ON a.street_id=c.street_id) LEFT JOIN community d ON a.cmty_id=d.cmty_id ";
	 	$query = $this->db->query($sql);
	 	$row   = $query->result_array();
	 	return $row;
	 }
	 
	 public function getAdminId($userid){
		
		$query = $this->db->query("SELECT a.*, b.role_name, c.street_name, d.cmty_name FROM ((user a LEFT JOIN role b ON a.role=b.role_id) LEFT JOIN street c ON a.street_id=c.street_id) LEFT JOIN community d ON a.cmty_id=d.cmty_id WHERE userid='".$userid."'");
		$row   = $query->result_array();
		return $row;
	 	
	 }
	
	/**
	 * update res_state of community common resource information in the resource table
	 * */
	 public function updateAdmin($date){
	 		 
	 	$this->db->where('user', $date['userid']);
	 	$query = $this->db->update('user',$date);
	 		//$query = $this->db->update('Orders',$order_time_down);
	 	return $query;
	 }
	 

	
	/**
	 * delete community common resource information into the "resource table
	 * */
	public function delAdmin($id){
	 		$result = $this->db->query("DELETE FROM user WHERE id=".$id."");
	 		return $result; 
	 }
	
	


	
	
	
	
	
}

<?php
/**
 * wirited by Seaside_He
 * Functions related to community public resources
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class StrCmtym extends CI_Model {
    public function __construct(){
    	parent::__construct();
        $this->load->database('crmp');
    }
	/**
	  * insert orders information into the "orders table
	  * */
	public function insertCmty($data){
		$query = $this->db->insert('community',$data);
		return $query;
	}
	
	/**
	 * Query orders information from the "orders table
	 * */
	 public function getStreets(){
	 	$sql = "SELECT street_id AS value,street_name AS name FROM street";
	 	$result = $this->db->query($sql);
	 	return $result->result_array();
	 }
	 public function getCmtys($street){
	 	$sql = "SELECT cmty_id AS value,cmty_name AS name,1 AS isleaf FROM community 
	 	WHERE street_id=".$street;
	 	$result = $this->db->query($sql);
	 	return $result->result_array();
	 }
	 
	 public function getCmty($street_id){
	 	$sql ="SELECT b.*,a.* FROM community a LEFT JOIN street b ON a.street_id=b.street_id WHERE a.street_id=".$street_id."";
	 	$query = $this->db->query($sql);
	 	$row   = $query->result_array();
	 	return $row;
	 }
	 
	 public function getStreet($cmty_id){
	 	$sql ="SELECT b.*,a.* FROM community a LEFT JOIN street b ON a.street_id=b.street_id WHERE a.cmty_id=".$cmty_id."";
	 	$query = $this->db->query($sql);
	 	$row   = $query->result_array();
	 	return $row;
	 }
	 /**
	  * delete community common resource information into the "resource table
	  * */
	 public function delCmty($cmty_id){
	  		$result = $this->db->query("DELETE FROM community WHERE cmty_id=".$cmty_id."");
	  		return $result; 
	  }
	//  public function getNoticesStateType($notice_type_id){
	//  	$sql ="SELECT a.*,b.notice_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((Notices a LEFT JOIN notice_type b ON a.notice_type_id=b.notice_type_id) LEFT JOIN state c ON a.Notice_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE a.notice_state=1 AND a.notice_type_id=".$notice_type_id."";
	//  	$query = $this->db->query($sql);
	//  	$row   = $query->result_array();
	//  	return $row;
	//  }
	 
	// public function getNoticesStreetCmty($street_id,$cmty_id){
	// 	$sql ="SELECT a.*,b.notice_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((Notices a LEFT JOIN notice_type b ON a.notice_type_id=b.notice_type_id) LEFT JOIN state c ON a.Notice_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE a.street_id=".$street_id." AND a.cmty_id=".$cmty_id."";
	// 	$query = $this->db->query($sql);
	// 	$row   = $query->result_array();
	// 	return $row;
	// }
	
	
	
	
	/**
	 * update res_state of community common resource information in the resource table
	 * */
	 // public function updateNoticesState($notice_id,$notice_state){
		 
	 // 	$this->db->where('notice_id', $notice_id);
	 // 	$query = $this->db->update('Notices',$notice_state);
		// //$query = $this->db->update('Orders',$order_time_down);
	 // 	return $query;
	 // }
	
	
	
	


	
	
	
	
	
}

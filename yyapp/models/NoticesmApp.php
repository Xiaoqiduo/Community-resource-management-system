<?php
/**
 * wirited by Seaside_He
 * Functions related to community public resources
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class NoticesmApp extends CI_Model {
    public function __construct(){
    	parent::__construct();
        $this->load->database('crmp');
    }
	/**
	  * insert orders information into the "orders table
	  * */
	public function insertNotices($data){
		$query = $this->db->insert('notices',$data);
		return $query;  	
	}
	
	/**
	 * Query orders information from the "orders table
	 * */
	 public function getNoticesState($notice_state){
	 	$sql ="SELECT a.*,b.notice_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((Notices a LEFT JOIN notice_type b ON a.notice_type_id=b.notice_type_id) LEFT JOIN state c ON a.Notice_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE a.notice_state=".$notice_state."";
	 	$query = $this->db->query($sql);
	 	$row   = $query->result_array();
	 	return $row;
	 }
	 
	 public function getNoticesStateType($notice_type_id){
	 	$sql ="SELECT a.*,b.notice_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((Notices a LEFT JOIN notice_type b ON a.notice_type_id=b.notice_type_id) LEFT JOIN state c ON a.Notice_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE a.notice_state=1 AND a.notice_type_id=".$notice_type_id."";
	 	$query = $this->db->query($sql);
	 	$row   = $query->result_array();
	 	return $row;
	 }
	 
	public function getNoticesStreetCmty($street_id,$cmty_id){
		$sql ="SELECT a.*,b.notice_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((Notices a LEFT JOIN notice_type b ON a.notice_type_id=b.notice_type_id) LEFT JOIN state c ON a.Notice_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE a.street_id=".$street_id." AND a.cmty_id=".$cmty_id."";
		$query = $this->db->query($sql);
		$row   = $query->result_array();
		return $row;
	}
	
	public function getNoticesStreetCmtyType($street_id,$cmty_id,$notice_type_id){
		$sql ="SELECT a.*,b.notice_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((Notices a LEFT JOIN notice_type b ON a.notice_type_id=b.notice_type_id) LEFT JOIN state c ON a.Notice_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE a.street_id=".$street_id." AND a.cmty_id=".$cmty_id." AND a.notice_type_id=".$notice_type_id."";
		$query = $this->db->query($sql);
		$row   = $query->result_array();
		return $row;
	}
	
	public function getNoticesId($notice_id){
		$query = $this->db->query("SELECT a.*,b.notice_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((Notices a LEFT JOIN notice_type b ON a.notice_type_id=b.notice_type_id) LEFT JOIN state c ON a.Notice_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE a.notice_id=".$notice_id."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getTopNotices($top,$notice_type_id){
		$sql = "SELECT a.*,b.notice_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((Notices a LEFT JOIN notice_type b ON a.notice_type_id=b.notice_type_id) LEFT JOIN state c ON a.Notice_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE notice_state=1 AND a.notice_type_id=".$notice_type_id." ORDER BY notice_order DESC LIMIT 0,".$top;
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	
	/**
	 * update res_state of community common resource information in the resource table
	 * */
	 public function updateNoticesState($notice_id,$notice_state){
		 
	 	$this->db->where('notice_id', $notice_id);
	 	$query = $this->db->update('notices',$notice_state);
		//$query = $this->db->update('Orders',$order_time_down);
	 	return $query;
	 }
	 
	 public function updateNotices($notice_id,$notice){
	 		 
	 	$this->db->where('notice_id', $notice_id);
	 	$query = $this->db->update('notices',$notice);
	 		//$query = $this->db->update('Orders',$order_time_down);
	 	return $query;
	 }
	
	/**
	 * delete community common notices information into the "notices table
	 * */
	public function delNotices($notice_id){
	 		$query = $this->db->query("DELETE FROM notices WHERE notice_id=".$notice_id."");
	 		return $query; 
	 }
	


	
	
	
	
	
}

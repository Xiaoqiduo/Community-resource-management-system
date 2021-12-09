<?php
/**
 * wirited by Seaside_He
 * Functions related to community public resources
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Resgetm extends CI_Model {
    public function __construct(){
    	parent::__construct();
        $this->load->database('crmp');
    }
	/**
	 * Query community common resource information from the "resource table
	 * */
	public function getResources(){
		$query = $this->db->query("SELECT * FROM resource");
		$row   = $query->row_array();
		return $row;
	}

	public function getResourcesState($res_state){
		$query = $this->db->query("SELECT a.*,d.street_name,b.cmty_name,c.res_type_name, e.state_name 
		FROM (((resource a LEFT JOIN community b ON a.cmty_id=b.cmty_id) LEFT JOIN resource_type c ON a.res_type_id=c.res_type_id) 
		LEFT JOIN street d ON b.street_id=d.street_id) LEFT JOIN state e ON a.res_state=e.state_id WHERE a.res_state=".$res_state."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getResourcesStreetCmty($street_id,$cmty_id){
		$query = $this->db->query("SELECT a.*,d.street_name,b.cmty_name,c.res_type_name, e.state_name FROM 
		(((resource a LEFT JOIN community b ON a.cmty_id=b.cmty_id) LEFT JOIN resource_type c ON a.res_type_id=c.res_type_id) 
		LEFT JOIN street d ON b.street_id=d.street_id) LEFT JOIN state e ON a.res_state=e.state_id WHERE b.street_id=".$street_id." AND a.cmty_id=".$cmty_id."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getResourcesStreetCmtyType($street_id,$cmty_id,$res_type_id){
		$query = $this->db->query("SELECT a.*,d.street_name,b.cmty_name,c.res_type_name, e.state_name 
		FROM (((resource a LEFT JOIN community b ON a.cmty_id=b.cmty_id) 
		LEFT JOIN resource_type c ON a.res_type_id=c.res_type_id) LEFT JOIN street d ON b.street_id=d.street_id) 
		LEFT JOIN state e ON a.res_state=e.state_id 
		WHERE b.street_id=".$street_id." AND a.cmty_id=".$cmty_id." AND a.res_type_id=".$res_type_id." ");
		$row   = $query->result_array();
		return $row;
	}
		
	public function getResourcesStateStreetCmty($street_id,$cmty_id){
		$query = $this->db->query("SELECT a.*,d.street_name,b.cmty_name,c.res_type_name FROM 
		((resource a LEFT JOIN community b ON a.cmty_id=b.cmty_id) LEFT JOIN resource_type c ON a.res_type_id=c.res_type_id) 
		LEFT JOIN street d ON b.street_id=d.street_id WHERE a.res_state=1 AND b.street_id=".$street_id." AND a.cmty_id=".$cmty_id."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getResourcesStateStreet($street_id){
		$query = $this->db->query("SELECT a.*,d.street_name,b.cmty_name,c.res_type_name FROM 
		((resource a LEFT JOIN community b ON a.cmty_id=b.cmty_id) LEFT JOIN resource_type c ON a.res_type_id=c.res_type_id) 
		LEFT JOIN street d ON b.street_id=d.street_id WHERE a.res_state=1 AND b.street_id=".$street_id."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getResourcesStateType($res_type_id){
		$query = $this->db->query("SELECT a.*,d.street_name,b.cmty_name,c.res_type_name FROM 
		((resource a LEFT JOIN community b ON a.cmty_id=b.cmty_id) LEFT JOIN resource_type c ON a.res_type_id=c.res_type_id) 
		LEFT JOIN street d ON b.street_id=d.street_id WHERE a.res_state=1 AND a.res_type_id=".$res_type_id."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getTypes(){
		$query = $this->db->query("SELECT * FROM resource_type");
		$row   = $query->result_array();
		return $row;
	}
	/**
	 * check the availability of reserved resources "checkResource table
	 * */
	 public function getResourcesStateStreetDate($cmty_id,$res_date,$res_type_id){
		 $sql = "SELECT r.*,c.cmty_name FROM resource r 
		 LEFT JOIN community c ON r.cmty_id=c.cmty_id 
		 WHERE r.res_type_id=".$res_type_id." AND r.res_state=1 AND r.cmty_id=".$cmty_id;
		$query = $this->db->query($sql);
		$row   = $query->result_array();
		return $row;
	 }
	 
	 public function getResourcesSSDError($cmty_id,$res_date,$res_type_id){
		$query = $this->db->query("SELECT rl.* FROM (SELECT rl.* FROM resource_luck rl 
		LEFT JOIN resource r ON rl.res_id=r.res_id 
		WHERE rl.res_luck_date='".$res_date."' AND r.res_type_id=".$res_type_id.") rl 
		LEFT JOIN resource b ON rl.res_id=b.res_id WHERE b.cmty_id=".$cmty_id."");
		$row   = $query->result_array();
		return $row;
	 }
	 
	 public function getResourcesStateStreetCmtyDate($street_id,$cmty_id,$res_date){
		$query = $this->db->query("SELECT a.*,b.res_luck_date,b.res_luck_lefttime,b.res_luck_righttime, d.street_name,c.cmty_name,e.res_type_name 
		FROM (((resource a LEFT JOIN (select b.* from resource_luck b where b.res_luck_date='".$res_date."') b ON a.res_id=b.res_id) 
		LEFT JOIN community c ON a.cmty_id=c.cmty_id) LEFT JOIN street d ON c.street_id=d.street_id) 
		LEFT JOIN resource_type e ON a.res_type_id=e.res_type_id WHERE a.res_state=1 AND c.street_id=".$street_id." AND a.cmty_id=".$cmty_id." order by a.res_id");
		$row   = $query->result_array();
		return $row;
	 }
		 
	 public function getResourcesSSCDError($street_id,$cmty_id,$res_date){
	 	 	$query = $this->db->query("SELECT rl.* FROM ((SELECT rl.* FROM resource_luck rl WHERE rl.res_luck_date='".$res_date."') rl 
			LEFT JOIN resource b ON rl.res_id=b.res_id) LEFT JOIN community d on b.cmty_id=d.cmty_id WHERE d.street_id=".$street_id." AND b.cmty_id=".$cmty_id."");
	 	 	$row   = $query->result_array();
	 	 	return $row;
	 	 }
		 
	 public function getResourcesStateTypeDate($res_type_id,$res_date){
	 	 	$query = $this->db->query("SELECT a.*,b.res_luck_date,b.res_luck_lefttime,b.res_luck_righttime, d.street_name,c.cmty_name,e.res_type_name 
			FROM (((resource a LEFT JOIN (select b.* from resource_luck b where b.res_luck_date='".$res_date."') b ON a.res_id=b.res_id) 
			LEFT JOIN community c ON a.cmty_id=c.cmty_id) LEFT JOIN street d ON c.street_id=d.street_id) 
			LEFT JOIN resource_type e ON a.res_type_id=e.res_type_id WHERE a.res_state=1 AND a.res_type_id=".$res_type_id." order by a.res_id");
	 	 	$row   = $query->result_array();
	 	 	return $row;
	 	 }
	 
	 public function getResourcesSTDError($res_type_id,$res_date){
	 	 	$query = $this->db->query("SELECT rl.* FROM (SELECT rl.* FROM resource_luck rl WHERE rl.res_luck_date='".$res_date."') rl 
			LEFT JOIN resource b ON rl.res_id=b.res_id WHERE b.res_type_id=".$res_type_id."");
	 	 	$row   = $query->result_array();
	 	 	return $row;
	 	 }
	 
	 public function getResourcesStateStreetCmtyTypeDate($street_id,$cmty_id,$res_type_id,$res_date){
	 	 	$query = $this->db->query("SELECT a.*,b.res_luck_date,b.res_luck_lefttime,b.res_luck_righttime, d.street_name,c.cmty_name,e.res_type_name 
			FROM (((resource a LEFT JOIN (select b.* from resource_luck b where b.res_luck_date='".$res_date."') b ON a.res_id=b.res_id) 
			LEFT JOIN community c ON a.cmty_id=c.cmty_id) LEFT JOIN street d ON c.street_id=d.street_id) LEFT JOIN resource_type e ON a.res_type_id=e.res_type_id 
			WHERE a.res_state=1 AND c.street_id=".$street_id." AND a.cmty_id=".$cmty_id." AND a.res_type_id=".$res_type_id." order by a.res_id");
	 	 	$row   = $query->result_array();
	 	 	return $row;
	 	 }
	 
	 public function getResourcesSSCTDError($street_id,$cmty_id,$res_type_id,$res_date){
	 	 	$query = $this->db->query("SELECT rl.* FROM (SELECT rl.* FROM resource_luck rl WHERE rl.res_luck_date='".$res_date."') rl 
			LEFT JOIN resource b ON rl.res_id=b.res_id WHERE b.res_type_id=".$res_type_id." AND c.street_id=".$street_id." AND b.cmty_id=".$cmty_id."");
	 	 	$row   = $query->result_array();
	 	 	return $row;
	 	 }

	/**
	 * update res_state of community common resource information in the resource table
	 * */
	 public function updateResourcesState($res_id,$res_state){
		 
	 	$this->db->where('res_id', $res_id);
	 	$query = $this->db->update('resource', $res_state);
	 	return $query;
	 }
	
	 /**
	  * insert community common resource information into the "resource table
	  * */
	public function insertResources($data){
		$this->db->insert('resource',$data);
		$resid = $this->db->insert_id();
		return $resid;
	}
	public function insertResourcesImg($data){
		$result = $this->db->insert('resource_img',$data);
		return $result;
	}
	public function insertType($data){
		$query = $this->db->insert('resource_type',$data);
		return $query;  	
	}
	/**
	 * delete community common resource information into the "resource table
	 * */
	public function delResources($res_id){
	 		$result = $this->db->query("DELETE FROM resource WHERE res_id=".$res_id."");
	 		return $result; 
	}
	 public function delResourcesTypes($res_type_id){
	  		$result = $this->db->query("DELETE FROM resource_type WHERE res_type_id=".$res_type_id."");
	  		return $result; 
	  }
	 /**
	  * uploda community common resource information into the "resource table
	  * */
	  // public function do_upload($data){
	  // 	$query = $this->db->insert('resource_img',$data);
	  // 	return $query;
	  // }
	public function getPic($res_id){
		$query = $this->db->query("SELECT a.res_img FROM resource a WHERE a.res_id=".$res_id."");
		$row   = $query->result_array();
		return $row;
	}
}

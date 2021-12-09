<?php
/**
 * wirited by Seaside_He
 * Functions related to community public resources
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Shopsm extends CI_Model {
    public function __construct(){
    	parent::__construct();
        $this->load->database('crmp');
    }
	/**
	  * insert orders information into the "orders table
	  * */
	public function insertShops($data){
		$query = $this->db->insert('Shops',$data);
		return $query;  	
	}
	
	public function insertType($data){
		$query = $this->db->insert('Shop_type',$data);
		return $query;  	
	}
	/**
	 * Query orders information from the "orders table
	 * */
	public function getShopsAcc($account){
		$query = $this->db->query("SELECT a.*,b.shop_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((shops a LEFT JOIN shop_type b ON  a.shop_type_id=b.shop_type_id) LEFT JOIN state c ON a.shop_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE a.account=".$account."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getShopsUser($user_signature){
		$query = $this->db->query("SELECT a.*,b.shop_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((shops a LEFT JOIN shop_type b ON  a.shop_type_id=b.shop_type_id) LEFT JOIN state c ON a.shop_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE a.user_signature='".$user_signature."'");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getShopsStreet($street_id){
		$query = $this->db->query("SELECT a.*,b.shop_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((shops a LEFT JOIN shop_type b ON  a.shop_type_id=b.shop_type_id) LEFT JOIN state c ON a.shop_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE a.shop_state=1 AND a.street_id=".$street_id."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getShopsCmty($cmty_id){
		$query = $this->db->query("SELECT a.*,b.shop_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((shops a LEFT JOIN shop_type b ON  a.shop_type_id=b.shop_type_id) LEFT JOIN state c ON a.shop_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE a.shop_state=1 AND a.cmty_id=".$cmty_id."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getShopsCmtyType($cmty_id,$shop_type_id){
		$query = $this->db->query("SELECT a.*,b.shop_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((shops a LEFT JOIN shop_type b ON  a.shop_type_id=b.shop_type_id) LEFT JOIN state c ON a.shop_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE a.shop_state=1 AND a.cmty_id=".$cmty_id." AND a.shop_type_id=".$shop_type_id."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getShopsStreetCmty($street_id,$cmty_id){
		$query = $this->db->query("SELECT a.*,b.shop_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((shops a LEFT JOIN shop_type b ON  a.shop_type_id=b.shop_type_id) LEFT JOIN state c ON a.shop_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE a.shop_state=1 AND a.street_id=".$street_id." AND a.cmty_id=".$cmty_id."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getShopsId($shop_id){
		$query = $this->db->query("SELECT a.*,b.shop_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((shops a LEFT JOIN shop_type b ON  a.shop_type_id=b.shop_type_id) LEFT JOIN state c ON a.shop_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE a.shop_state=1 AND a.shop_id=".$shop_id."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getShopsType($shop_type_id){
		$query = $this->db->query("SELECT a.*,b.shop_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((shops a LEFT JOIN shop_type b ON  a.shop_type_id=b.shop_type_id) LEFT JOIN state c ON a.shop_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE a.shop_state=1 AND a.shop_type_id=".$shop_type_id."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getShopsStreetCmtyType($street_id,$cmty_id,$shop_type_id){
		$query = $this->db->query("SELECT a.*,b.shop_type_name, c.state_name, d.street_name, e.cmty_name  FROM (((shops a LEFT JOIN shop_type b ON  a.shop_type_id=b.shop_type_id) LEFT JOIN state c ON a.shop_state=c.state_id) LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id WHERE a.shop_state=1 AND a.street_id=".$street_id." AND a.cmty_id=".$cmty_id." AND a.shop_type_id=".$shop_type_id."");
		$row   = $query->result_array();
		return $row;
	}
	/**
	shops a->
	shop_type b->
	state c->
	street d->
	community e->
	a.cmty_id = e.cmty_id e.street_id = d.street_id
	 */
	public function getShopsStateStreetCmty($shop_state,$street_id,$cmty_id){
		if($shop_state==''){
			$sql ="SELECT a.*,b.shop_type_name, c.state_name, d.street_name, e.cmty_name, e.street_id  
			FROM (((shops a LEFT JOIN shop_type b ON  a.shop_type_id=b.shop_type_id) LEFT JOIN state c ON a.shop_state=c.state_id) 
			 LEFT JOIN community e ON a.cmty_id=e.cmty_id) LEFT JOIN street d ON e.street_id=d.street_id 
			WHERE a.shop_state!=0 AND e.street_id=".$street_id." AND a.cmty_id=".$cmty_id."";
		}else{
			$sql = "SELECT a.*,b.shop_type_name, c.state_name, d.street_name, e.cmty_name, e.street_id  
			FROM (((shops a LEFT JOIN shop_type b ON  a.shop_type_id=b.shop_type_id) LEFT JOIN state c ON a.shop_state=c.state_id) 
			 LEFT JOIN community e ON a.cmty_id=e.cmty_id) LEFT JOIN street d ON e.street_id=d.street_id  
			WHERE a.shop_state=".$shop_state." AND e.street_id=".$street_id." AND a.cmty_id=".$cmty_id."";
		}
		$query = $this->db->query($sql);
		$row   = $query->result_array();
		return $row;
	}
	
	public function getTypes(){
		$query = $this->db->query("SELECT * FROM shop_type");
		$row   = $query->result_array();
		return $row;
	}
	
	/**
	 * update res_state of community common resource information in the resource table
	 * */
	 public function updateShopsState($shop_id,$shop_state){
		 
	 	$this->db->where('shop_id', $shop_id);
	 	$query = $this->db->update('Shops',$shop_state);
		//$query = $this->db->update('Orders',$order_time_down);
	 	return $query;
	 }
	 /**
	  * delete community common resource information into the "resource table
	  * */
	 public function delShopTypes($shop_type_id){
	  		$result = $this->db->query("DELETE FROM shop_type WHERE shop_type_id=".$shop_type_id."");
	  		return $result; 
	  }
	
	/**
	 * shops a->shop_id,shop_name,shop_service,shop_address,
		shop_type b->shop_type_name
		street d->street_id
		community e->cmty_id
	 
	 **/
	public function getShopsIdTypeStreet($street_id,$cmty_id){
		// $query = $this->db->query("SELECT a.*,b.shop_type_name, c.state_name, d.street_name, e.cmty_name  
		// FROM (((shops a LEFT JOIN shop_type b ON  a.shop_type_id=b.shop_type_id) LEFT JOIN state c ON a.shop_state=c.state_id) 
		// LEFT JOIN street d ON a.street_id=d.street_id) LEFT JOIN community e ON a.cmty_id=e.cmty_id 
		// WHERE a.shop_state=1 AND a.street_id=".$street_id." AND a.cmty_id=".$cmty_id."");
		$query = $this->db->query("SELECT a.*,b.shop_type_name,d.street_name,e.cmty_name
		FROM((shops a LEFT JOIN shop_type b ON a.shop_type_type_id=b.shop_type_type_id) 
		LEFT JOIN community e ON a.cmty_id=e.cmty_id) LEFT JOIN street d ON e.street_id=d.street_id 
		WHERE e.street_id=".$street_id." AND a.cmty_id=".$cmty_id."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getShopPic($shop_id){
		$query = $this->db->query("SELECT a.shop_pic FROM shops a WHERE a.shop_id=".$shop_id."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getDoorPic($shop_id){
		$query = $this->db->query("SELECT a.shop_door FROM shops a WHERE a.shop_id=".$shop_id."");
		$row   = $query->result_array();
		return $row;
	}

	public function getShopType(){
		$sql = "SELECT distinct shop_type_name AS name,shop_type_id AS value FROM shop_type";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	
	public function getShopTypeType($type){
		$sql = "SELECT shop_type_type_id AS value,shop_type_type_name AS name,1 AS isleaf FROM shop_type 
		WHERE shop_type_id=".$type;
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	
	public function insertShopInfo($data){
		$query = $this->db->insert('shops',$data);
		return $query;
	}
	
	public function insertShopDoor($data){
		$query = $this->db->insert('shops',$data);
		return $query;
	}
	
	public function insertShopPic($data){
		$query = $this->db->insert('shops',$data);
		return $query;
	}
	
	public function getShopTypeInfo($data){
		$query = $this->db->query("SELECT a.shop_type_id FROM shop_type a WHERE a.shop_type_type_id=".$data."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function delshop($shop_id){
	 		$result = $this->db->query("DELETE FROM shops WHERE shop_id=".$shop_id."");
	 		return $result; 
	}
	
}

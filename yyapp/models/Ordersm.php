<?php
/**
 * wirited by Seaside_He
 * Functions related to community public resources
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Ordersm extends CI_Model {
    public function __construct(){
    	parent::__construct();
        $this->load->database('crmp');
    }
	/**
	  * insert orders information into the "orders table
	  * */
	public function insertOrders($data){
		$query = $this->db->insert('orders',$data);
		return $query;  	
	}
	
	/**
	 * Query orders information from the "orders table
	 * */
	public function getOrdersStateAcc($order_state,$account){
		$query = $this->db->query("SELECT a.*,c.state_name, b.*, d.street_name, e.cmty_name  FROM (((orders a LEFT JOIN resource b ON  a.res_id=b.res_id) LEFT JOIN state c ON a.order_state=c.state_id) LEFT JOIN street d ON b.street_id=d.street_id) LEFT JOIN community e ON b.cmty_id=e.cmty_id WHERE a.order_state=".$order_state." AND a.account=".$account."");
		$row   = $query->result_array();
		return $row;
	}
	
	public function getOrdersUser($user_signature){
		$query = $this->db->query("SELECT a.*,c.state_name, b.*, d.street_name, e.cmty_name, f.res_type_name FROM ((((orders a LEFT JOIN resource b ON  a.res_id=b.res_id) LEFT JOIN state c ON a.order_state=c.state_id) LEFT JOIN street d ON b.street_id=d.street_id) LEFT JOIN community e ON b.cmty_id=e.cmty_id) LEFT JOIN resource_type f ON b.res_type_id=f.res_type_id WHERE a.account='".$user_signature."'");
		$row   = $query->result_array();
		return $row;
	}
	/**
	 * orders a->+order_id,+res_id,+order_res_date,+order_res_lefttime,+order_res_righttime,1=order_state
	 * resource b->res_id,res_type_id
	 * resource_type g->res_type_id,+res_type_name,
	 * csessioninfo f->+name
	 * state c->1=state_id,+state_name
	 * community e->street_id
	**/
	public function getOrdersStateStreetCmty($order_state,$street_id,$cmty_id){
		
		//已审核
		if($order_state==''){
			$sql ="SELECT a.*,f.name,f.idcard,f.phone,f.street_id,f.cmty_id,c.state_name, b.*, d.street_name, e.cmty_name, g.res_type_name 
			FROM (((((orders a LEFT JOIN resource b ON  a.res_id=b.res_id) LEFT JOIN state c ON a.order_state=c.state_id)
			LEFT JOIN community e ON b.cmty_id=e.cmty_id) LEFT JOIN street d ON e.street_id=d.street_id)
			LEFT JOIN csessioninfo f ON a.account=f.user_signature) LEFT JOIN resource_type g ON b.res_type_id=g.res_type_id 
			WHERE a.order_state!=0 AND e.street_id=".$street_id." AND b.cmty_id=".$cmty_id."";
		}else{
			$sql = "SELECT a.*,f.name,f.idcard,f.phone,f.street_id,f.cmty_id,c.state_name, b.*, d.street_name, e.cmty_name, g.res_type_name 
			FROM (((((orders a LEFT JOIN resource b ON  a.res_id=b.res_id) LEFT JOIN state c ON a.order_state=c.state_id)
			 LEFT JOIN community e ON b.cmty_id=e.cmty_id) LEFT JOIN street d ON e.street_id=d.street_id) 
			 LEFT JOIN csessioninfo f ON a.account=f.user_signature) LEFT JOIN resource_type g ON b.res_type_id=g.res_type_id
			  WHERE a.order_state=".$order_state." AND e.street_id=".$street_id." AND b.cmty_id=".$cmty_id."";
		}
		$query = $this->db->query($sql);
		$row   = $query->result_array();
		return $row;
	}
	
	public function getOrdersId($order_id,$user_signature){
		$query = $this->db->query("SELECT a.*,c.state_name, b.*, d.street_name, e.cmty_name, f.res_type_name FROM ((((orders a LEFT JOIN resource b ON  a.res_id=b.res_id) LEFT JOIN state c ON a.order_state=c.state_id) LEFT JOIN street d ON b.street_id=d.street_id) LEFT JOIN community e ON b.cmty_id=e.cmty_id) LEFT JOIN resource_type f ON b.res_type_id=f.res_type_id WHERE a.account='".$user_signature."' AND a.order_id=".$order_id."");
		$row   = $query->result_array();
		return $row;
	}
	
	/**
	 * update res_state of community common resource information in the resource table
	 * */
	 public function updateOrdersState($order_id,$order_state){
		 
	 	$this->db->where('order_id', $order_id);
	 	$query = $this->db->update('Orders',$order_state);
		//$query = $this->db->update('Orders',$order_time_down);
	 	return $query;
	 }
	
	
	public function getTypeCount(){
		$sql = "SELECT count(*) AS value,d.res_type_name AS name
		FROM resource_type d 
		LEFT JOIN resource b ON d.res_type_id=b.res_type_id
		LEFT JOIN orders a ON a.res_id=b.res_id
		WHERE a.order_state=1
		GROUP BY d.res_type_name";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	


	
	
	
	
	
}

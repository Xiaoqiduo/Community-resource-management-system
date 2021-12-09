<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Projectm extends CI_Model {
    public function __construct(){
    	parent::__construct();
        $this->load->database('crmp');
    }
	public function getTopShops($top){
		$sql = "SELECT s.*,c.cmty_name FROM shops s LEFT JOIN community c ON s.cmty_id=c.cmty_id WHERE shop_state=1 ORDER BY shop_order DESC LIMIT 0,".$top;
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function getShopBanner($shop_id){
		$sql = "SELECT * FROM shop_img WHERE shop_id=".$shop_id;
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function getShopInfo($shop_id){
		$sql = "SELECT * FROM shops WHERE shop_id=".$shop_id;
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function getShopImageList($shop_id){
		$sql = "SELECT * FROM shop_goods WHERE shop_id=".$shop_id;
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function getStreets(){
		$sql = "SELECT street_id AS value,street_name AS text FROM street";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function getCmtys($street){
		$sql = "SELECT cmty_id AS value,cmty_name AS text,1 AS isleaf FROM community 
		WHERE street_id=".$street;
		$result = $this->db->query($sql);
		return $result->result_array();
	}
	public function getUserInfoDetail($user_signature){
		$sql = "SELECT * FROM csessioninfo WHERE user_signature='".$user_signature."'";
		$result = $this->db->query($sql);
		return $result->row_array();
	}
	public function setOrder($data){
		$query = $this->db->insert('orders',$data);
		return $query;  	
	}
	public function setUserInfo($data){
		$this->db->where('user_signature',$data['user_signature']);
		$result = $this->db->update('csessioninfo',$data);
		return $result;
	}
}

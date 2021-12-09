<?php
/**
 * 主逻辑控制，权限，class
 * */
defined('BASEPATH') OR exit('No direct script access allowed');
class Shops extends CI_Controller {
	public function __construct(){
        parent::__construct();
		// $this->load->library('session');
        $this->load->helper('url_helper');
        $this->load->helper('array');
        $this->load->model('Shopsm');
		session_start();
    }
	// public function checkSession(){
	// 	// return empty($_SESSION['username']);
	// 	return false;
	// }
	// public function login(){
	// 	$_SESSION['username'] = 'ddddd';
	// }
	public function insertShops(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = elements(array('shop_name','shop_type_id','shop_type_type_id','shop_service','cmty_id','street_id','shop_address','shop_contact','shop_tel'), $_POST);
		//$data['order_time_up'] = date("Y-m-d H:i:s");
		
		$result = $this->Shopsm ->insertShops($data);
		if(!$result){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}
		echo json_encode($res);
	}
	
	public function insertType(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = elements(array('shop_type_name'), $_POST);
		//$data['order_time_up'] = date("Y-m-d H:i:s");
		
		$result = $this->Shopsm ->insertType($data);
		if(!$result){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}
		echo json_encode($res);
	}
	
	public function getShopsAcc(){
		//$order_state = $_GET['shop_state'];
		$account = $_GET['user_signature'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Shopsm ->getShopsAcc($account);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	public function getShopsUser(){
		//$order_state = $_GET['shop_state'];
		$user_signature = $_POST['user_signature'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Shopsm ->getShopsUser($user_signature);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getShopsStreet(){
		//$order_state = $_GET['shop_state'];
		$street_id = $_GET['street_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Shopsm ->getShopsStreet($street_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getShopsCmty(){
		//$order_state = $_GET['shop_state'];
		$cmty_id = $_GET['cmty_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Shopsm ->getShopsCmty($cmty_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getShopsCmtyType(){
		//$order_state = $_GET['shop_state'];
		// $cmty_id = $_GET['cmty_id'];
		// $shop_type_id = $_GET['shop_type_id'];
		$cmty_id = $_GET['cmty_id'];
		$shop_type_id = $_GET['shop_type_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Shopsm ->getShopsCmtyType($cmty_id,$shop_type_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		$res['post'] = $_POST;
		echo json_encode($res);
	}
	
	public function getShopsStreetCmty(){
		//$order_state = $_GET['shop_state'];
		$street_id = $_GET['street_id'];
		$cmty_id = $_GET['cmty_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Shopsm ->getShopsStreetCmty($street_id,$cmty_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getShopsId(){
		$shop_id = $_GET['shop_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Shopsm ->getShopsId($shop_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	
	public function getShopsType(){
		//$order_state = $_GET['shop_state'];
		$shop_type_id = $_GET['shop_type_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Shopsm ->getShopsType($shop_type_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getShopsStreetCmtyType(){
		//$order_state = $_GET['shop_state'];
		$street_id = $_GET['street_id'];
		$cmty_id = $_GET['cmty_id'];
		$shop_type_id = $_GET['shop_type_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Shopsm ->getShopsStreetCmtyType($street_id,$cmty_id,$shop_type_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getShopsStateStreetCmty(){
		$shop_state = isset($_GET['shop_state'])?$_GET['shop_state']:'';
		$street_id = $_GET['street_id'];
		$cmty_id = $_GET['cmty_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Shopsm ->getShopsStateStreetCmty($shop_state,$street_id,$cmty_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getTypes(){
		//$shop_type_id = $_GET['shop_type_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Shopsm ->getTypes();
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function delShopTypes(){
		$shop_type_id = $_GET['shop_type_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Shopsm ->delShopTypes($shop_type_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function updateShopsState(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$shop_id=$_POST['shop_id'];
		//$_POST['order_time_down']= date("Y-m-d H:i:s");
		$result = $this->Shopsm ->updateShopsState($shop_id,$_POST);
		
		if(!$result){
					$res['code']=-1;
					$res['msg'] = 'no data';
				}else{
					//$res['data'] = $data;
				}
		echo json_encode($res);
	}
	
	public function getShopsIdTypeStreet(){
		$street_id = $_GET['street_id'];
		$cmty_id = $_GET['cmty_id'];
		//$shop_type_id = $_GET['shop_type_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Shopsm ->getShopsIdTypeStreet($street_id,$cmty_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getShopPic(){
		$shop_id = $_POST['shop_id'];
		//$shop_type_id = $_GET['shop_type_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Shopsm ->getShopPic($shop_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getDoorPic(){
		$shop_id = $_POST['shop_id'];
		//$shop_type_id = $_GET['shop_type_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Shopsm ->getDoorPic($shop_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getShopType(){
		$res = array(
			'code' => 0,
			'msg'  => ''
		);
		$types = $this->Shopsm->getShopType();
		$i = 0;
		foreach($types as $type){
			$types[$i]['children'] = $this->Shopsm->getShopTypeType($type['value']);
			$i++;
		}
		//店铺banner
		$res['data'] = $types;
		echo json_encode($res);
	}
	
	public function uploadShopDoor(){
		$res = array(
			'code' => 0,
			'msg'  => 'success'
		);
		$cmty_id =  isset($_SESSION['cmty_id'])?$_SESSION['cmty_id']:'';
		if($cmty_id==''){
			$res['code'] = -1;
			$res['msg'] = '登陆失效，请重新登陆！';
		}else{
			$config['upload_path']      = './public/uploads/pho/';
			$config['allowed_types']    = 'jpg|png|jpeg';
			$config['encrypt_name']    = true;
			$this->load->library('upload', $config);
			$this->upload->do_upload('shop_door');
			$res['location'] = base_url().'public/uploads/pho/'.$this->upload->data('file_name');
		}
		echo json_encode($res);
	}
	
	public function uploadShopPic(){
		$res = array(
			'code' => 0,
			'msg'  => 'success'
		);
		$cmty_id =  isset($_SESSION['cmty_id'])?$_SESSION['cmty_id']:'';
		if($cmty_id==''){
			$res['code'] = -1;
			$res['msg'] = '登陆失效，请重新登陆！';
		}else{
			$config['upload_path']      = './public/uploads/pho/';
			$config['allowed_types']    = 'jpg|png|jpeg';
			$config['encrypt_name']    = true;
			$this->load->library('upload', $config);
			$this->upload->do_upload('shop_pic');
			$res['location'] = base_url().'public/uploads/pho/'.$this->upload->data('file_name');
		}
		echo json_encode($res);
	}
	
	public function insertShopInfo(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		//$street=$this->StrCmtym ->getStreet($_SESSION['cmty_id']);
		//$_POST['street_id'] =$street['street_id'];
		//$_POST['res_type_id'] = $type;
		// $data['time'] = time();
		
		//$result = $this->Shopsm->getShopTypeInfo($_POST['shop_type_type_id']);
		//$_POST['shop_type_id']=$result[0];
		$_POST['shop_type_id']=1;
		$_POST['shop_state']=1;
		$_POST['cmty_id']=$_SESSION['cmty_id'];
		unset($_POST['file']);
		//unset($_POST['imgurl']);
		$result = $this->Shopsm->insertShopInfo($_POST);
		// foreach ($_POST['imgurl'] as $value) {
		//     if($value!=-1){
		//         $this->Shopsm->insertShopDoor(array('shop_type_type_id'=>$shop_type_type_id,'imageurl'=>$value));
		//     }
		// }
		// foreach ($_POST['imgurl'] as $value) {
		//     if($value!=-1){
		//         $this->Shopsm->insertShopPic(array('shop_type_type_id'=>$shop_type_type_id,'imageurl'=>$value));
		//     }
		// }
		if(!$result){
			$res['code']=-1;
			$res['msg'] = 'error';
		}
		// $res['data'] = $_POST;
		echo json_encode($res);
		//echo json_encode($result[0]);
		//echo json_encode($_POST['shop_type_id']);
	}
	
	public function delshop(){
		$res_id = $_GET['shop_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Shopsm ->delshop($res_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
}

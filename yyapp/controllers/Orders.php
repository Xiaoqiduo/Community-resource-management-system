<?php
/**
 * 主逻辑控制，权限，class
 * */
defined('BASEPATH') OR exit('No direct script access allowed');
class Orders extends CI_Controller {
	public function __construct(){
        parent::__construct();
		// $this->load->library('session');
        $this->load->helper('url_helper');
        $this->load->helper('array');
        $this->load->model('Ordersm');
		session_start();
    }
	// public function checkSession(){
	// 	// return empty($_SESSION['username']);
	// 	return false;
	// }
	// public function login(){
	// 	$_SESSION['username'] = 'ddddd';
	// }
	public function insertOrders(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = elements(array('res_id','order_res_date','order_res_time','person_name','person_id','person_street_id','person_cmty_id','person_tel','vehicle_id','reason','team_name'), $_POST);
		$data['order_time_up'] = date("Y-m-d H:i:s");
		
		$result = $this->Ordersm ->insertOrders($data);
		if(!$result){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}
		echo json_encode($res);
	}
	
	public function getOrdersStateAcc(){
		$order_state = $_GET['order_state'];
		$account = $_GET['account'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Ordersm ->getOrdersStateAcc($order_state,$account);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getOrdersUser(){
		$user_signature = $_POST['user_signature'];
		//$user_signature = $_GET['user_signature'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Ordersm ->getOrdersUser($user_signature);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getOrdersStateStreetCmty(){
		$order_state = isset($_GET['order_state'])?$_GET['order_state']:'';
		$street_id = $_GET['street_id'];
		$cmty_id = $_GET['cmty_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Ordersm ->getOrdersStateStreetCmty($order_state,$street_id,$cmty_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getOrdersId(){
		$user_signature = $_POST['user_signature'];
		$order_id = $_POST['order_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Ordersm ->getOrdersId($order_id,$user_signature);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function updateOrdersState(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$order_id=$_POST['order_id'];
		$_POST['order_time_down']= date("Y-m-d H:i:s");
		$result = $this->Ordersm ->updateOrdersState($order_id,$_POST);
		
		if(!$result){
					$res['code']=-1;
					$res['msg'] = 'no data';
				}else{
					//$res['data'] = $data;
				}
		echo json_encode($res);
	}
	
	public function getTypeCount(){
		$res = array(
			'code' => 0,
			'msg'  => 'success'
		);
		
		$data = $this->Ordersm->getTypeCount();
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		
		echo json_encode($res);
	}
	
	
}

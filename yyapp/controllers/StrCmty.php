<?php
/**
 * 主逻辑控制，权限，class
 * */
defined('BASEPATH') OR exit('No direct script access allowed');
class StrCmty extends CI_Controller {
	public function __construct(){
        parent::__construct();
		// $this->load->library('session');
        $this->load->helper('url_helper');
        $this->load->helper('array');
        $this->load->model('StrCmtym');
		session_start();
    }
	// public function checkSession(){
	// 	// return empty($_SESSION['username']);
	// 	return false;
	// }
	// public function login(){
	// 	$_SESSION['username'] = 'ddddd';
	// }
	// public function insertNotices(){
	// 	$res = array(
	// 		'code'=>0,
	// 		'msg'=>'success'
	// 	);
	// 	$data = elements(array('notice_title','street_id','cmty_id','notice_type_id','notice_content','notice_publisher','notice_tel'), $_POST);
	// 	//$data['order_time_up'] = date("Y-m-d H:i:s");
		
	// 	$result = $this->Noticesm ->insertNotices($data);
	// 	if(!$result){
	// 		$res['code']=-1;
	// 		$res['msg'] = 'no data';
	// 	}
	// 	echo json_encode($res);
	// }
	
	public function getCmty(){
		$street_id = $_GET['street_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->StrCmtym ->getCmty($street_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getStreet(){
		$cmty_id = $_GET['cmty_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->StrCmtym ->getStreet($cmty_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getStreets(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->StrCmtym ->getStreets();
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getStreetCmty(){
		$res = array(
			'code' => 0,
			'msg'  => ''
		);
		$streets = $this->StrCmtym->getStreets();
		$i = 0;
		foreach($streets as $street){
			$streets[$i]['children'] = $this->StrCmtym->getCmtys($street['value']);
			$i++;
		}
		//店铺banner
		$res['data'] = $streets;
		echo json_encode($res);
	}
	
	public function insertCmty(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		//$street=$this->StrCmtym ->getStreet($_SESSION['cmty_id']);
		//$_POST['street_id'] =$street['street_id'];
		//$_POST['res_type_id'] = $type;
		// $data['time'] = time();
		$result = $this->StrCmtym ->insertCmty($_POST);
		if(!$result){
			$res['code']=-1;
			$res['msg'] = 'error';
		}
		// $res['data'] = $_POST;
		echo json_encode($res);
	}
	
	

	public function delCmty(){
		$cmty_id = $_GET['cmty_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->StrCmtym ->delCmty($cmty_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	// public function getNoticesStreetCmty(){
	// 	$street_id = $_GET['street_id'];
	// 	$cmty_id = $_GET['cmty_id'];
	// 	$res = array(
	// 		'code'=>0,
	// 		'msg'=>'success'
	// 	);
	// 	$data = $this->Noticesm ->getNoticesStreetCmty($street_id,$cmty_id);
	// 	if(empty($data)){
	// 		$res['code']=-1;
	// 		$res['msg'] = 'no data';
	// 	}else{
	// 		$res['data'] = $data;
	// 	}
	// 	echo json_encode($res);
	// }
	
	
	
	// public function updateNoticesState(){
	// 	$res = array(
	// 		'code'=>0,
	// 		'msg'=>'success'
	// 	);
	// 	$notice_id=$_POST['notice_id'];
	// 	//$_POST['order_time_down']= date("Y-m-d H:i:s");
	// 	$result = $this->Noticesm ->updateNoticesState($notice_id,$_POST);
		
	// 	if(!$result){
	// 				$res['code']=-1;
	// 				$res['msg'] = 'no data';
	// 			}else{
	// 				//$res['data'] = $data;
	// 			}
	// 	echo json_encode($res);
	// }
	
	
	
}

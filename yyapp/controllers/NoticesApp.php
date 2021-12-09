<?php
/**
 * 主逻辑控制，权限，class
 APP展示栏控制器
 * */
defined('BASEPATH') OR exit('No direct script access allowed');
class NoticesApp extends CI_Controller {
	public function __construct(){
        parent::__construct();
		// $this->load->library('session');
        $this->load->helper('url_helper');
        $this->load->helper('array');
        $this->load->model('NoticesmApp');
		session_start();
    }
	// public function checkSession(){
	// 	// return empty($_SESSION['username']);
	// 	return false;
	// }
	// public function login(){
	// 	$_SESSION['username'] = 'ddddd';
	// }
	public function insertNotices(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$_POST['cmty_id'] = $_SESSION['cmty_id'];
		//$_POST['street_id'] = $_SESSION['street_id'];
		$result = $this->NoticesmApp ->insertNotices($_POST);
		if(!$result){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}
		echo json_encode($res);
	}
	
	public function getNoticesState(){
		$notice_state = $_GET['notice_state'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Noticesm ->getNoticesState($notice_state);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getNoticesStateType(){
		$notice_type_id = $_GET['notice_type_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Noticesm ->getNoticesStateType($notice_type_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getNoticesStreetCmty(){
		$street_id = $_GET['street_id'];
		$cmty_id = $_GET['cmty_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Noticesm ->getNoticesStreetCmty($street_id,$cmty_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getNoticesStreetCmtyType(){
		$street_id = $_GET['street_id'];
		$cmty_id = $_GET['cmty_id'];
		$notice_type_id=$_GET['notice_type_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Noticesm ->getNoticesStreetCmtyType($street_id,$cmty_id,$notice_type_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getNoticesId(){
		$notice_id = $_GET['notice_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Noticesm ->getNoticesId($notice_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	//获取推荐公告
	public function getTopNotices($top=5){
		$notice_type_id = $_GET['notice_type_id'];
		$res = array(
			'code' => 0,
			'msg'  => ''
		);
		$result = $this->Noticesm->getTopNotices($top,$notice_type_id);
		$res['data'] = $result;
		echo json_encode($res);
	}
	
	
	
	
	public function updateNoticesState(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$notice_id=$_POST['notice_id'];
		//$_POST['order_time_down']= date("Y-m-d H:i:s");
		$result = $this->Noticesm ->updateNoticesState($notice_id,$_POST);
		
		if(!$result){
					$res['code']=-1;
					$res['msg'] = 'no data';
				}else{
					//$res['data'] = $data;
				}
		echo json_encode($res);
	}
	
	public function updateNotices(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$notice_id=$_POST['notice_id'];
		$result = $this->Noticesm ->updateNotices($notice_id,$_POST);
		
		if(!$result){
					$res['code']=-1;
					$res['msg'] = 'no data';
				}else{
					//$res['data'] = $data;
				}
		echo json_encode($res);
	}
	
	public function delNotices(){
		$notice_id = $_GET['notice_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Noticesm ->delNotices($notice_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	
}

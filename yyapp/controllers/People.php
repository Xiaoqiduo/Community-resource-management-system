<?php
/**
 * 主逻辑控制，权限，class
 * */
defined('BASEPATH') OR exit('No direct script access allowed');
class People extends CI_Controller {
	public function __construct(){
        parent::__construct();
		// $this->load->library('session');
        $this->load->helper('url_helper');
        $this->load->helper('array');
        $this->load->model('Peoplem');
		session_start();
    }

	public function getPersonInf(){
		$user_signature = $_POST['user_signature'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Peoplem ->getPersonInf($user_signature);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	
	public function getAdmin(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Peoplem ->getAdmin();
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getAdminId(){
		
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$userid = $_SESSION['userid'];
		$data = $this->Peoplem ->getAdminId($userid);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function updateAdmin(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$date=$_POST;
		//$_POST['order_time_down']= date("Y-m-d H:i:s");
		$result = $this->Peoplem ->updateAdmin($date);
		
		if(!$result){
					$res['code']=-1;
					$res['msg'] = 'no data';
				}else{
					//$res['data'] = $data;
				}
		echo json_encode($res);
	}
	
	public function insertAdmin(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		//$street=$this->StrCmtym ->getStreet($_SESSION['cmty_id']);
		//$_POST['street_id'] =$street['street_id'];
		//$_POST['res_type_id'] = $type;
		// $data['time'] = time();
		$result = $this->Peoplem ->insertAdmin($_POST);
		if(!$result){
			$res['code']=-1;
			$res['msg'] = 'error';
		}
		// $res['data'] = $_POST;
		echo json_encode($res);
	}
	public function delAdmin(){
		$id = $_GET['id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Peoplem ->delAdmin($id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	
}
 

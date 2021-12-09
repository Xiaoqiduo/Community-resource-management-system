<?php
/**
 * 主逻辑控制，权限，class
 * */
defined('BASEPATH') OR exit('No direct script access allowed');
class Xgxt extends CI_Controller {
	public function __construct(){
        parent::__construct();
		// $this->load->library('session');
        $this->load->helper('url_helper');
        $this->load->model('userm');
    }
	public function index(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->userm ->getUser('60210');
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	public function test(){
		echo '123';
	}
}

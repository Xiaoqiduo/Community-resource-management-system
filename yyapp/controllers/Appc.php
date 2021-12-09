<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appc extends CI_Controller {
	public function __construct(){
	    parent::__construct();
		// $this->load->library('session');
	    $this->load->helper('url_helper');
		$this->load->model('projectm');
		$this->load->model('userm');
		session_start();
	}
	public function getUserInfo(){
		$res = array(
			'code' => -1,
			'msg'  => '登录失效！'
		);
		if(isset($_SESSION['userid'])){
			$res['data'] = $_SESSION;
		}
		echo json_encode($res);
	}
	//获取推荐/最新店铺前几位
	public function getTopShops($top=5){
		$res = array(
			'code' => 0,
			'msg'  => ''
		);
		$result = $this->projectm->getTopShops($top);
		$res['data'] = $result;
		echo json_encode($res);
	}
	public function getShopDetail($shop_id){
		$res = array(
			'code' => 0,
			'msg'  => ''
		);
		//店铺banner
		$res['data']['banner'] = $this->projectm->getShopBanner($shop_id);
		$res['data']['shop'] = $this->projectm->getShopInfo($shop_id);
		$res['data']['imagelist'] = $this->projectm->getShopImageList($shop_id);
		echo json_encode($res);
	}
	public function getStreetCmty(){
		$res = array(
			'code' => 0,
			'msg'  => ''
		);
		$streets = $this->projectm->getStreets();
		$i = 0;
		foreach($streets as $street){
			$streets[$i]['children'] = $this->projectm->getCmtys($street['value']);
			$i++;
		}
		//店铺banner
		$res['data'] = $streets;
		echo json_encode($res);
	}
	public function setUserInfo(){
		$res = array(
			'code' => 0,
			'msg'  => ''
		);
		$result = $this->projectm->setUserInfo($_POST);
		if(!$result){
			$res['code'] = 1;
			$res['msg'] = '保存失败';
		}
		echo json_encode($res);
	}
	public function getUserStreetCmty(){
		$user_signature = $_POST['user_signature'];
		$res = array(
			'code' => 0,
			'msg'  => ''
		);
		$userInfo = $this->projectm->getUserInfoDetail($user_signature);
		$streets = $this->projectm->getStreets();
		$i = 0;
		foreach($streets as $street){
			$cmtys = $this->projectm->getCmtys($street['value']);
			if($street['value']==$userInfo['street_id']){
				$j = 0;
				foreach($cmtys as $cmty){
					if($cmty['value']==$userInfo['cmty_id']){
						$cmtys[$j]['checked'] = 1;
					}
				}
				$streets[$i]['checked'] = 1;
			}
			$streets[$i]['children'] = $cmtys;
			$i++;
		}
		//店铺banner
		$res['data'] = $streets;
		echo json_encode($res);
	}
	public function checkUserInfoDetail(){
		$user_signature = $_POST['user_signature'];
		$res = array(
			'code' => 0,
			'msg'  => ''
		);
		$userInfo = $this->projectm->getUserInfoDetail($user_signature);
		if(empty($userInfo['phone'])||empty($userInfo['street_id'])||empty($userInfo['cmty_id'])||empty($userInfo['name'])){
			$res['code'] = 1;
			$res['msg'] = '请先完善个人信息';
			$res['data'] = $userInfo;
		}else{
			$res['data'] = $userInfo;
		}
		echo json_encode($res);
	}
	public function setOrder(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$_POST['order_time_up'] = date("Y-m-d H:i:s");
		
		$result = $this->projectm->setOrder($_POST);
		if(!$result){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}
		echo json_encode($res);
	}
}

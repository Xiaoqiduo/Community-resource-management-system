<?php
/**
 * 主逻辑控制，权限，class
 * */
defined('BASEPATH') OR exit('No direct script access allowed');
class ResgetApp extends CI_Controller {
	public function __construct(){
        parent::__construct();
		// $this->load->library('session');
        $this->load->helper('url_helper');
        $this->load->helper('array');
        $this->load->model('ResgetmApp');
		session_start();
    }
	// public function checkSession(){
	// 	// return empty($_SESSION['username']);
	// 	return false;
	// }
	// public function login(){
	// 	$_SESSION['username'] = 'ddddd';
	// }
	// public function getResourcesState(){
	// 	$res = array(
	// 		'code'=>0,
	// 		'msg'=>'success'
	// 	);
	// 	if($this->checkSession()){
	// 		$res['code'] = 2;
	// 		$res['msg'] = 'shixiao';
	// 	}else{
	// 		$data = $_POST;
	// 		$res_state = $_POST['res_state'];
	// 		$result = $this->Resgetm ->getResourcesState($data);
	// 		if(!$result){
	// 			$res['code']=-1;
	// 			$res['msg'] = 'no data';
	// 		}else{
	// 			$res['data'] = $data;
	// 		}
	// 	}
	// 	echo json_encode($res);
	// }
	// public function getResources(){
	// 	$res = array(
	// 		'code'=>0,
	// 		'msg'=>'success'
	// 	);
	// 	$data = $this->Resgetm ->getResources();
	// 	if(empty($data)){
	// 		$res['code']=-1;
	// 		$res['msg'] = 'no data';
	// 	}else{
	// 		$res['data'] = $data;
	// 	}
	// 	echo json_encode($res);
	// }
	/**
	 * 查询可用资源
	 * */
	public function getResourcesState(){
		$resource_id = $_GET['res_id'];//获取资源类型id
		$community_id = $_GET['comm_id'];//获取社区id
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->ResgetmApp ->getResourcesState($resource_id,$community_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getResourcesStreetCmty(){
		$street_id = $_GET['street_id'];
		$cmty_id = $_GET['cmty_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Resgetm ->getResourcesStreetCmty($street_id,$cmty_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getResourcesStreetCmtyType(){
		$street_id = $_SESSION['street_id'];
		$cmty_id = $_SESSION['cmty_id'];
		$res_type_id = $_GET['res_type_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Resgetm ->getResourcesStreetCmtyType($street_id,$cmty_id,$res_type_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getResourcesStateStreetCmty(){
		//$res_state = $_GET['res_state'];
		$street_id = $_GET['street_id'];
		$cmty_id = $_GET['cmty_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Resgetm ->getResourcesStateStreetCmty($street_id,$cmty_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getResourcesStateStreet(){
		//$res_state = $_GET['res_state'];
		$street_id = $_GET['street_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Resgetm ->getResourcesStateStreet($street_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function getResourcesStateType(){
		//$res_state = $_GET['res_state'];
		$res_type_id = $_GET['res_type_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Resgetm ->getResourcesStateType($res_type_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}

	/**
	 * 查询日期时间下可用资源
	 * */
	
	public function getResourcesStateStreetDate(){
		$cmty_id = $_POST['cmty_id'];
		$res_type_id = $_POST['res_type_id'];
		$res_date = $_POST['res_date'];
		$res_time_left = $_POST['res_time_left'];
		$res_time_right = $_POST['res_time_right'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$dataError = $this->Resgetm ->getResourcesSSDError($cmty_id,$res_date,$res_type_id);
		$dataErrorId = array();
		foreach($dataError as $temp){
			if(((strtotime($temp['res_luck_lefttime'])<=strtotime($res_time_left)&&strtotime($res_time_left)<strtotime($temp['res_luck_righttime']))||(strtotime($temp['res_luck_lefttime'])<strtotime($res_time_right)&&strtotime($res_time_right)<=strtotime($temp['res_luck_righttime'])))){
				array_push($dataErrorId,$temp['res_id']);
			}
		}
		$data = $this->Resgetm ->getResourcesStateStreetDate($cmty_id,$res_date,$res_type_id);
		$i=0;
		$dataA = array();
		$res_id_tmp = '';
		foreach($data as $temp){
			if(!in_array($temp['res_id'],$dataErrorId)){
				array_push($dataA,$temp);
			}
			// if(strtotime($temp['res_luck_date']) == strtotime($res_date)){
			// 		if(((strtotime($temp['res_luck_lefttime'])<=strtotime($res_time_left)&&strtotime($res_time_left)<strtotime($temp['res_luck_righttime']))||(strtotime($temp['res_luck_lefttime'])<strtotime($res_time_right)&&strtotime($res_time_right)<=strtotime($temp['res_luck_righttime'])))){
			// 			continue;
			// 		}else{
						// if(!in_array($temp['res_id'],$dataErrorId)){
						// 　　array_push($dataA,$temp);
						// }
			// 		}
			// }else{
			// 	if(!(in_array($temp['res_id'],$dataErrorId))){
			// 		array_push($dataA,$temp);
			// 	}
			// }
			$i++;
		}
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $dataA;
		}
		echo json_encode($res);
	}
	
	public function getResourcesStateStreetCmtyDate(){
		$street_id = $_POST['street_id'];
		$cmty_id = $_POST['cmty_id'];
		$res_date = $_POST['res_date'];
		$res_time_left = $_POST['res_time_left'];
		$res_time_right = $_POST['res_time_right'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$dataError = $this->Resgetm ->getResourcesSSCDError($street_id,$cmty_id,$res_date);
		$dataErrorId = array();
		foreach($dataError as $temp){
			if(((strtotime($temp['res_luck_lefttime'])<=strtotime($res_time_left)&&strtotime($res_time_left)<strtotime($temp['res_luck_righttime']))||(strtotime($temp['res_luck_lefttime'])<strtotime($res_time_right)&&strtotime($res_time_right)<=strtotime($temp['res_luck_righttime'])))){
				
				array_push($dataErrorId,$temp['res_id']);
			}
		}
		$data = $this->Resgetm ->getResourcesStateStreetCmtyDate($street_id,$cmty_id,$res_date);
		$i=0;
		$dataA = array();
		$res_id_tmp = '';
		foreach($data as $temp){
			
			if(strtotime($temp['res_luck_date']) == strtotime($res_date)){
				// if($res_id_tmp==$temp['res_id']){
				// 	continue;
				// }else{
					if(((strtotime($temp['res_luck_lefttime'])<=strtotime($res_time_left)&&strtotime($res_time_left)<strtotime($temp['res_luck_righttime']))||(strtotime($temp['res_luck_lefttime'])<strtotime($res_time_right)&&strtotime($res_time_right)<=strtotime($temp['res_luck_righttime'])))){
						
						
						continue;
					}else{
						if(!in_array($temp['res_id'],$dataErrorId)){
						
						　　array_push($dataA,$temp);
						
						}
					}
				// }
				
				
			}else{
				if(!(in_array($temp['res_id'],$dataErrorId))){
					array_push($dataA,$temp);
				}
			}
			// $res_id_tmp = $temp['res_id'];
			$i++;
			// echo $i;
		}
		
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			// $dataB = array();
			// foreach($dataA as $tempC){
			// 	if(!isset($temC['disabled'])||$temC['disabled']==1){
			// 		array_push($dataB,$tempC);
			// 	}
			// }
			$res['data'] = $dataA;
		}
		// echo '<br/>';
		echo json_encode($res);
	}
	
	public function getResourcesStateTypeDate(){
		$res_type_id = $_POST['res_type_id'];
		$res_date = $_POST['res_date'];
		$res_time_left = $_POST['res_time_left'];
		$res_time_right = $_POST['res_time_right'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$dataError = $this->Resgetm ->getResourcesSTDError($res_type_id,$res_date);
		$dataErrorId = array();
		foreach($dataError as $temp){
			if(((strtotime($temp['res_luck_lefttime'])<=strtotime($res_time_left)&&strtotime($res_time_left)<strtotime($temp['res_luck_righttime']))||(strtotime($temp['res_luck_lefttime'])<strtotime($res_time_right)&&strtotime($res_time_right)<=strtotime($temp['res_luck_righttime'])))){
				array_push($dataErrorId,$temp['res_id']);
			}
		}
		$data = $this->Resgetm ->getResourcesStateTypeDate($res_type_id,$res_date);
		$i=0;
		$dataA = array();
		$res_id_tmp = '';
		foreach($data as $temp){
			if(strtotime($temp['res_luck_date']) == strtotime($res_date)){
					if(((strtotime($temp['res_luck_lefttime'])<=strtotime($res_time_left)&&strtotime($res_time_left)<strtotime($temp['res_luck_righttime']))||(strtotime($temp['res_luck_lefttime'])<strtotime($res_time_right)&&strtotime($res_time_right)<=strtotime($temp['res_luck_righttime'])))){
						continue;
					}else{
						if(!in_array($temp['res_id'],$dataErrorId)){
						　　array_push($dataA,$temp);
						}
					}
			}else{
				if(!(in_array($temp['res_id'],$dataErrorId))){
					array_push($dataA,$temp);
				}
			}
			$i++;
		}
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $dataA;
		}
		echo json_encode($res);
	}
	
	public function getResourcesStateStreetCmtyTypeDate(){
		$street_id = $_POST['street_id'];
		$cmty_id = $_POST['cmty_id'];
		$res_type_id = $_POST['res_type_id'];
		$res_date = $_POST['res_date'];
		$res_time_left = $_POST['res_time_left'];
		$res_time_right = $_POST['res_time_right'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$dataError = $this->Resgetm ->getResourcesSSCTDError($street_id,$cmty_id,$res_type_id,$res_date);
		$dataErrorId = array();
		foreach($dataError as $temp){
			if(((strtotime($temp['res_luck_lefttime'])<=strtotime($res_time_left)&&strtotime($res_time_left)<strtotime($temp['res_luck_righttime']))||(strtotime($temp['res_luck_lefttime'])<strtotime($res_time_right)&&strtotime($res_time_right)<=strtotime($temp['res_luck_righttime'])))){
				array_push($dataErrorId,$temp['res_id']);
			}
		}
		$data = $this->Resgetm ->getResourcesStateStreetCmtyTypeDate($street_id,$cmty_id,$res_type_id,$res_date);
		$i=0;
		$dataA = array();
		$res_id_tmp = '';
		foreach($data as $temp){
			if(strtotime($temp['res_luck_date']) == strtotime($res_date)){
					if(((strtotime($temp['res_luck_lefttime'])<=strtotime($res_time_left)&&strtotime($res_time_left)<strtotime($temp['res_luck_righttime']))||(strtotime($temp['res_luck_lefttime'])<strtotime($res_time_right)&&strtotime($res_time_right)<=strtotime($temp['res_luck_righttime'])))){
						continue;
					}else{
						if(!in_array($temp['res_id'],$dataErrorId)){
						　　array_push($dataA,$temp);
						}
					}
			}else{
				if(!(in_array($temp['res_id'],$dataErrorId))){
					array_push($dataA,$temp);
				}
			}
			$i++;
		}
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $dataA;
		}
		echo json_encode($res);
	}
	
	public function checkResource(){
		echo strtotime('2021-6-18');
		echo '<br/>';
		echo strtotime('2021-06-18');
		// $arr = array("朝阳区","海淀区","西城区","东城区","丰台区");
		// unset($arr[3]);
		// $arr.uns
		// echo "<pre>";
		// print_r($arr);
		// phpinfo();
	}
	
	public function getTypes(){
		//$shop_type_id = $_GET['shop_type_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Resgetm ->getTypes();
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	/**
	 * 审核公共资源状态
	 * */
	public function updateResourcesState(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$res_id=$_POST['res_id'];
		$result = $this->Resgetm ->updateResourcesState($res_id,$_POST);
		if(!$result){
					$res['code']=-1;
					$res['msg'] = 'no data';
				}else{
					//$res['data'] = $data;
				}
		echo json_encode($res);
	}
	
	/**
	 * 发布公共资源
	 * */
	// public function insertResources(){
	// 	$res = array(
	// 		'code'=>0,
	// 		'msg'=>'success'
	// 	);
	// 	$data = elements(array('street_id','cmty_id', 'res_type_id','res_address','res_time','res_contact','res_tel'), $_POST);
	// 	// $data['time'] = time();
		
	// 	$result = $this->Resgetm ->insertResources($data);
	// 	if(!$result){
	// 		$res['code']=-1;
	// 		$res['msg'] = 'no data';
	// 	}
	// 	echo json_encode($res);
	// }
	/**
	 * 发布公共资源
	 * */
	// public function insertResources($type){
	// 	$res = array(
	// 		'code'=>0,
	// 		'msg'=>'success'
	// 	);
	// 	$_POST['cmty_id'] = $_SESSION['cmty_id'];
	// 	$_POST['res_type_id'] = $type;
	// 	// $data['time'] = time();
		
	// 	$result = $this->Resgetm ->insertResources($_POST);
	// 	if(!$result){
	// 		$res['code']=-1;
	// 		$res['msg'] = 'error';
	// 	}
	// 	echo json_encode($res);
	// }
	public function insertResources($type){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$_POST['cmty_id'] = $_SESSION['cmty_id'];
		$_POST['street_id'] = $_SESSION['street_id'];
		$_POST['res_type_id'] = $type;
		$resid = $this->Resgetm ->insertResources(elements(array('cmty_id', 'street_id', 'res_type_id','res_address','res_time','res_count','res_contact','res_tel'), $_POST));
		// if(!$result){
		// 	$res['code']=-1;
		// 	$res['msg'] = 'error';
		// }
		// else{
		// 	$config['upload_path']      = './public/uploads/pho2';
		// 	$config['allowed_types']    = 'jpg|png';//上传文件类型
		// 	$config['max_size']     = 100;
		// 	$config['file_name']     = time();//保存文件名为时间戳
		// 	$this->load->library('upload', $config);
		// 	$this->upload->do_upload('file');
		// 	// $imgData = $this->upload->data();
		// 	$res['code'] = 0;
		// 	$res['msg'] = '';
		// 	$res['imgUrl'] = '';
			
		// 	if ( ! $this->upload->do_upload('file')){
		// 	    $error = array('error' => $this->upload->display_errors());
		// 		$res['code'] = -1;
		// 		$res['msg'] = $error;
		// 	}else{
		// 	    // $data = array('upload_data' => $this->upload->data());
		// 		$imgName = $this->upload->data('file_name');
		// 		$data = array(
		// 			'res_id'=>$resid,
		// 			'res_img'=>base_url().'public/uploads/pho2'.$imgName
		// 		);
		// 		//将资源id与照片绝对路径插入数据库
		// 		$result = $this->Resgetm ->insertResourcesImg($data);
		// 		if($result){
		// 			$res['imgUrl'] = base_url().'public/uploads/pho2'.$imgName;
		// 		}
		// 	    // $this->load->view('upload_success', $data);
		// 	}
		// }
		//$res['data'] = $_POST;
		echo json_encode($res);
	}
	
	public function insertType(){
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = elements(array('res_type_name'), $_POST);
		//$data['order_time_up'] = date("Y-m-d H:i:s");
		
		$result = $this->Resgetm ->insertType($data);
		if(!$result){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}
		echo json_encode($res);
	}
	
	public function delResources(){
		$res_id = $_GET['res_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Resgetm ->delResources($res_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	public function delResourcesTypes(){
		$res_type_id = $_GET['res_type_id'];
		$res = array(
			'code'=>0,
			'msg'=>'success'
		);
		$data = $this->Resgetm ->delResourcesTypes($res_type_id);
		if(empty($data)){
			$res['code']=-1;
			$res['msg'] = 'no data';
		}else{
			$res['data'] = $data;
		}
		echo json_encode($res);
	}
	
	// public function uploadResourcesImg()
	// {
	// 	$config['upload_path']      = './public/uploads/pho2';
	// 	$config['allowed_types']    = 'jpg|png';//上传文件类型
	// 	$config['max_size']     = 100;
	// 	$config['file_name']     = time();//保存文件名为时间戳
	// 	$this->load->library('upload', $config);
	// 	$this->upload->do_upload('file');
	// 	// $imgData = $this->upload->data();
	// 	$res['code'] = 0;
	// 	$res['msg'] = '';
	// 	$res['imgUrl'] = '';
	// 	$resid=$_GET['resid'];
	// 	// if ( ! $this->upload->do_upload('file')){
	// 	//     $error = array('error' => $this->upload->display_errors());
	// 	// 	$res['code'] = -1;
	// 	// 	$res['msg'] = $error;
	// 	// }else{
	// 	    // $data = array('upload_data' => $this->upload->data());
	// 		$imgName = $this->upload->data('file_name');
	// 		$data = array(
	// 			'res_id'=>$resid,
	// 			'res_img'=>base_url().'public/uploads/pho2'.$imgName
	// 		);
	// 		//将资源id与照片绝对路径插入数据库
	// 		$result = $this->Resgetm ->insertResourcesImg($data);
	// 		if($result){
	// 			$res['imgUrl'] = base_url().'public/uploads/pho2'.$imgName;
	// 		}
	// 	    // $this->load->view('upload_success', $data);
	// 	// }
	// }

    public function do_upload()
    {	
		$config['upload_path']      = './public/uploads/pho2';
		$config['allowed_types']    = 'jpg|png';//上传文件类型
		$config['max_size']     = 100;
		$config['file_name']     = time();//保存文件名为时间戳
		$this->load->library('upload', $config);
		$this->upload->do_upload('file');
		// $imgData = $this->upload->data();
		$res['code'] = 0;
		$res['imgUrl'] = '';
		
        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
			var_dump($error);
            // $this->load->view('upload_form', $error);
        }
        else
        {
            // $data = array('upload_data' => $this->upload->data());
			$res['imgUrl'] = $this->upload->data();
            // $this->load->view('upload_success', $data);
        }
		echo json_encode($res);
    }
}

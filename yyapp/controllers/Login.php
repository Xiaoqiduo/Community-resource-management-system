<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use QCloud_WeApp_SDK\Auth\LoginService as Loginservice;
use QCloud_WeApp_SDK\Constants as Constants;

class Login extends CI_Controller {
	public function __construct(){
	    parent::__construct();
		// $this->load->library('session');
	    $this->load->helper('url_helper');
	    $this->load->model('Userm');
		session_start();
	}
    public function index() {
        $result = Loginservice::login();
        
        if ($result['loginState'] === Constants::S_AUTH) {
			
            echo json_encode([
                'code' => 0,
                'data' => $result['userinfo']
            ]);
        } else {
            echo json_encode([
                'code' => -1,
                'error' => $result['error']
            ]);
        }
    }
	//单点登录SSO
	public function authCheck() {
		$res = array(
			'code' => -1,
			'msg'  => '账号不存在，请联系管理员！'
		);
			$password = isset($_POST['password'])?md5(htmlspecialchars(addslashes($_POST['password']))):'illegal';
			$username = isset($_POST['username'])?htmlspecialchars(addslashes($_POST['username'])):'illegal';
			if($this->Userm->checkuser($username)){
				$res = array(
					'code' => -1,
					'msg'  => '账号不存在，请联系管理员！'
				);
			}elseif($this->Userm->checkPassword($username,$password)){
				$_SESSION['userid'] = $_POST['username'];
				$userInfo = $this->Userm->getUser($_POST['username']);
				$_SESSION['role'] = $userInfo['role'];
				$_SESSION['name'] = $userInfo['name'];
				$_SESSION['cmty_id'] = $userInfo['cmty_id'];
				$_SESSION['street_id'] = $userInfo['street_id'];
				$res['code'] = 0;
				$res['msg'] = '登录成功';
				$res['data']=array('role'=>$userInfo['role'],'name'=>$userInfo['name'],'userid'=>$userInfo['userid']);
			}else{
				$res = array(
					'code' => -1,
					'msg'  => '密码错误，请重新输入'
				);
			}
			echo json_encode($res);
		} 
	public function authCheck2() {
		$this->config->load('sso');
		$options = $this->config->item('sso');
		$_app_id = $options['_app_id']; //APP ID
		$_app_key = $options['_app_key']; //App Key
		$_app_secret = $options['_app_secret']; //App Secret
		$_sso_Api = $options['_sso_Api'];
		
		$_arr_crypt = array(
		    'user_name' => $_POST['username'],
		    'user_pass' => md5($_POST['password']),
		    'user_ip'   => '127.0.0.1',
		    'timestamp' => strval(time())
		);
		
		$_str_crypt   = json_encode($_arr_crypt,false); //编码
		$_str_encrypt = openssl_encrypt((string)$_str_crypt, 'AES-128-CBC', $_app_key, 1, $_app_secret); // 加密
		
		$_arr_encrypt = base64_encode((string)$_str_encrypt); // base64 编码
		$_arr_encrypt = str_replace(array('+', '/', '='), array('-', '_', ''), $_arr_encrypt);
		
		$_arr_data = array(
		    'app_id'    => $_app_id,
		    'app_key'   => $_app_key,
		    'code'      => $_arr_encrypt,
		    'sign'      => strtoupper(md5($_str_crypt . $_app_key . $_app_secret)),
		);
		
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $_sso_Api);
		curl_setopt ($ch, CURLOPT_POST, 1);
		if($_arr_data != ''){
		    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_arr_data));
		}
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    // https请求 不验证证书和hosts
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$file_contents = curl_exec($ch);
		curl_close($ch);
		$_arr_get = json_decode($file_contents,true);
		$string = str_replace(array('-', '_'), array('+', '/'), (string)$_arr_get['code']); // 替换 URL 传输时容易出错的字符
		$_num_mod4 = strlen($string) % 4;
		
		if ($_num_mod4) {
			$string .= substr('====', $_num_mod4);
		}

		$string =  base64_decode($string);
		
		$result = json_decode( openssl_decrypt($string, 'AES-128-CBC', $_app_key, 1, $_app_secret),true); // 解密
		if($result['rcode']!='y010103'){
			$res = array(
				'code' => -1,
				'msg'  => $result['msg']
			);
		}else{
			$_SESSION['userid'] = $_POST['username'];
			$userInfo = $this->Userm->getUser($_POST['username']);
			$_SESSION['role'] = $userInfo['role'];
			$_SESSION['name'] = $userInfo['name'];
			$_SESSION['cmty_id'] = $userInfo['cmty_id'];
			$_SESSION['street_id'] = $userInfo['street_id'];
			$res = array(
				'code' => 0,
				'msg'  => '登录成功',
				'data' => $_SESSION
			);
		}
		echo json_encode($res);
	} 
	public function getUserInfo(){
		$res = array(
			'code' => -1,
			'msg'  => '登录失效！'
		);
		if(isset($_SESSION['userid'])){
			$res['code'] = 0;
			$res['data'] = $_SESSION;
			$res['msg'] = '';
		}
		echo json_encode($res);
	}
	public function testget(){
		$userInfo = $this->Userm->getUser('zygladmin');
		echo json_encode($userInfo);
	}
}

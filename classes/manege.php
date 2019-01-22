<?php

class Manege{

	private $users;
	private $data;
	private $registry;
	
	public function __construct($registry){
		$this->registry = $registry;
		$this->data = $this->secureData(array_merge($_POST, $_GET));
		$this->users = $registry['users'];
		$this->orders = $registry['orders'];
	}
	
	private function secureData($get){
		foreach ($get as $key => $value){
		if (is_array($value)) $this->secureData($value);
		else $data[$key] = htmlspecialchars($value);
		}
	return $data;
	}
	
	public function redirect($link){
		header("Location: $link");
		exit;
	}

	public function regUser(){
		if(isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response']) {
			$secret = '6Lc_SQ0UAAAAABalnexPS4VvVE-yA4HV-p5zSzM-';
			$ip = $_SERVER['REMOTE_ADDR'];
			$response = $_POST['g-recaptcha-response'];
			$rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$ip");
			$arr = json_decode($rsp, TRUE);
			if($arr['success']){
				$user['login'] = $this->data["login"];
				$user['FIO'] = $this->data["FIO"];
				$user['phone'] = $this->data["phone"];
				$user['second_phone'] = (empty($this->data["second-phone"]))?'':$this->data["second-phone"];
				$user['organization'] = (empty($this->data["organization"]))?'':$this->data["organization"];
				$user['country'] = $this->data["country"];
				$user['region'] = $this->data["region"];
				$user['city'] = $this->data["city"];
				$user['adress'] = $this->data["adress"];
				$user['index'] = $this->data["index"];
				$user['password'] = $this->hashPassword($this->data["password"]);
				$user['regdate'] = time();
				if (!($this->users->loginExists($user['login'])))
					return $this->returnMessege("EXISTS_LOGIN", $this->registry['adress'].$this->registry['reg_link']);
				
				$result = $this->users->addUser($user);
				if ($result){
					$this->registry['email']->reg($user['login'], $this->data["password"]);
					return $this->returnPageMessege("SUCCRESS_REG", $this->registry['adress'].$this->registry['msg_link']);
				}
				else
					return $this->unknownError($this->registry['adress'].$this->registry['reg_link']);
			}
		}
		else {
			$_SESSION['no_capcha']=1;
			return $this->unknownError($this->registry['adress'].$this->registry['order_link']);
		}
	}
	
	public function autoRegUser($login, $FIO, $phone, $country, $region, $city, $adress, $index, $second_phone, $organization){
		$user['login'] = $login;
		$user['FIO'] = $FIO;
		$user['phone'] = $phone;
		$user['second_phone'] = $second_phone;
		$user['organization'] = $organization;
		$user['country'] = $country;
		$user['region'] = $region;
		$user['city'] = $city;
		$user['adress'] = $adress;
		$user['index'] = $index;
		$password = $this->users->getRandomPass();
		$user['password'] = $this->hashPassword($password);
		$user['regdate'] = time();		
		
		$result = $this->users->addUser($user);
		return $password;
	}
	
	public function editUser(){
		$user=$this->registry['users']->getUserOnLogin($_SESSION["login"]);
		$user['FIO'] = $this->data["FIO"];
		$user['phone'] = $this->data["phone"];
		$user['second_phone'] = (empty($this->data["second-phone"]))?'':$this->data["second-phone"];
		$user['organization'] = (empty($this->data["organization"]))?'':$this->data["organization"];
		$user['vk_link'] = (empty($this->data["vk_link"]))?'':$this->data["vk_link"];
		$user['facebook_link'] = (empty($this->data["facebook_link"]))?'':$this->data["facebook_link"];
		$user['country'] = (empty($this->data["country"]))?'':$this->data["country"];
		$user['region'] = (empty($this->data["region"]))?'':$this->data["region"];
		$user['city'] = (empty($this->data["city"]))?'':$this->data["city"];
		$user['organization'] = (empty($this->data["organization"]))?'':$this->data["organization"];
		$user['adress'] = (empty($this->data["adress"]))?'':$this->data["adress"];
		$user['index'] = (empty($this->data["index"]))?'':$this->data["index"];
		
		if ($this->data['newpassword']!='')
		if ($user['password']==$this->hashPassword($this->data["oldpassword"])){
			$user['password'] = $this->hashPassword($this->data["newpassword"]);
		}
		else{
			$r = $this->registry['adress'].'?route=lk/profile#fast';
			$_SESSION["error_auth"] = 1;
			return $r;			
		}
			
		$result = $this->users->editUser($user['id'], $user);
		if ($result)
			return $this->returnPageMessege("SUCCRESS_EDIT_USER", $this->registry['adress'].$this->registry['msg_link']);
		else	
			return $this->unknownError($this->registry['adress'].$this->registry['profile_link']);
	}
	
	public function forgetpass(){
		if (!($this->users->loginExists($this->data["login"]))){
			$user=$this->registry['users']->getUserOnLogin($this->data["login"]);
			if ($user['phone']==$this->data["phone"]){
				$password = $this->users->getRandomPass();
				$user['password'] = $this->hashPassword($password);
				$result = $this->users->editUser($user['id'], $user);
				if ($result){
					echo $this->registry['email']->newPass($user['login'], $password);
					return $this->returnPageMessege("SUCCRESS_NEWPASS", $this->registry['adress'].$this->registry['msg_link']);
				}
				else
					return $this->unknownError($this->registry['adress'].$this->registry['profile_link']);
			}
		}
		$r = $this->registry['adress'].'?route=forgetpass';
		$_SESSION["error_forgetpass"] = 1;
		return $r;
		
	}

	public function order(){
		if(isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response']) {
			$secret = '6Lc_SQ0UAAAAABalnexPS4VvVE-yA4HV-p5zSzM-';
			$ip = $_SERVER['REMOTE_ADDR'];
			$response = $_POST['g-recaptcha-response'];
			$rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$ip");
			$arr = json_decode($rsp, TRUE);
			if($arr['success']){
				$order['type'] = $this->data["type"];
				$order['pay'] = $this->data["pay"];
				
				$order['email'] = $this->data["email"];
				$order['FIO'] = $this->data["FIO"];
				$order['phone'] = $this->data["phone"];
				$order['second_phone'] = (empty($this->data["second_phone"]))?'':$this->data["second_phone"];
				$order['organization'] = (empty($this->data["organization"]))?'':$this->data["organization"];
				$order['country'] = $this->data["country"];
				$order['region'] = $this->data["region"];
				$order['city'] = $this->data["city"];
				$order['adress'] = $this->data["adress"];
				$order['index'] = $this->data["index"];
				$order['note'] = (empty($this->data["note"]))?'':$this->data["note"];
				
				$order['email2'] = $this->data["email2"];
				$order['FIO2'] = $this->data["FIO2"];
				$order['phone2'] = $this->data["phone2"];
				$order['second_phone2'] = (empty($this->data["second_phone2"]))?'':$this->data["second_phone2"];
				$order['organization2'] = (empty($this->data["organization2"]))?'':$this->data["organization2"];
				$order['country2'] = $this->data["country2"];
				$order['region2'] = $this->data["region2"];
				$order['city2'] = $this->data["city2"];
				$order['adress2'] = $this->data["adress2"];
				$order['index2'] = $this->data["index2"];
				$order['note2'] = (empty($this->data["note2"]))?'':$this->data["note2"];
				
				$order['places'] = (empty($this->data["places"]))?'':$this->data["places"];
				$order['weight'] = $this->data["weight"];
				$order['description'] = (empty($this->data["description"]))?'':$this->data["description"];
				$order['orderdate'] = time();
				$order['status'] = '1';
				$order['payed'] = $this->data["price"];
				
				if (!empty($_SESSION["id"])){  //Если авторизован
					$order['autor'] = $_SESSION["id"];
					$email = $this->users->getLoginOnId($_SESSION["id"]);
				}
				else if (!$this->users->loginExists($this->data["email"])){  //Если не авторизован, но такой логин уже имеется
					$order['autor'] = $this->users->getIdOnLogin($this->data["email"]);
					$email = $this->data["email"];
				}
				else{  //Если такой логин встречается впервые
					$_SESSION["auto_pass"] = $this->autoRegUser($order['email'], $order['FIO'], $order['phone'], $order['country'], $order['region'], $order['city'], $order['adress'], $order['index'], $order['second_phone'], $order['organization2']);
					$_SESSION["auto_login"] = $this->data["email"];
					$order['autor'] = $this->users->getIdOnLogin($this->data["email"]);
					$result = $this->orders->addOrder($order);
					if ($result){
						$_SESSION['order']=$this->orders->getLastId();
						$this->registry['email']->orderReg($_SESSION["auto_login"], $_SESSION["auto_pass"], $_SESSION['order'], $order);
						return $this->returnPageMessege("SUCCRESS_ORDER_AND_REG", $this->registry['adress'].$this->registry['msg_link']);
					}
					else{
						return $this->unknownError($this->registry['adress'].$this->registry['order_link']);
					}
				}  
				// для зарегистрированных продолжаем по старой схеме
				$result = $this->orders->addOrder($order);
				if ($result){
					$_SESSION['order']=$this->orders->getLastId();
					$this->registry['email']->order($email, $_SESSION['order'], $order);
					return $this->returnPageMessege("SUCCRESS_ORDER", $this->registry['adress'].$this->registry['msg_link']);
				}
				else
					return $this->unknownError($this->registry['adress'].$this->registry['reg_link']);
			}
		}
		else {
			$_SESSION['no_capcha']=1;
			return $this->unknownError($this->registry['adress'].$this->registry['order_link']);
		}
	}

	public function login(){
		$login = $this->data["login"];
		$password = $this->hashPassword($this->data["password"]);
		$r = $this->registry['adress'].'?route=lk';
		if ($this->users->checkUser($login, $password)){
			$_SESSION["login"] = $login;
			$_SESSION["password"] = $password;
			$_SESSION["id"] = $this->users->getIdOnLogin($login);
			$this->users->updateLastSessionTime($_SESSION["id"]);
			return $r;
		}
		else
			$_SESSION["error_auth"] = 1;
			return $r;
	}
	
	public function logout(){
		unset($_SESSION["login"]);
		unset($_SESSION["password"]);
		unset($_SESSION["id"]);
		return $this->registry['adress'];
	}
	public function deleteUser($id){
		if ($this->users->getUserOnId($_SESSION["id"])['power_group']!=2) return '/';
		$this->users->deleteUser($id);
		return "?route=lk/users#fast";//исправить при переносе на сервер
	}
	
	public function callback(){
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$callback['phone'] = (empty($_GET['callbackphone']))?$_POST['callbackphone']:$_GET['callbackphone'];
		$callback['date'] = time();
		$result = $this->registry['callback']->addCallback($callback);
		if ($result)
			return $this->returnPageMessege("SUCCRESS_CALLBACK", $this->registry['adress'].$this->registry['msg_link']);
		else
			return $this->returnPageMessege("FAIL", $this->registry['adress'].$this->registry['msg_link']);
	}
	
	private function hashPassword($password){
		return md5($password.$this->registry['pswd_secret']);
	}
	
	private function unknownError($r){
		return $this->returnMessege("UNKNOWN_ERROR", $r);
	}
	
	private function returnMessege($messege, $r){
		$_SESSION["messege"] = $messege;
		return $r;
	}
	
	private function returnPageMessege($messege, $r){
		$_SESSION["page_messege"] = $messege;
		return $r;
	}
}
?>
<?php

require_once ('global.php');

class Users extends GlobalClass{

	public function __construct($registry){
		parent::__construct("users", $registry);
	}
	
	public function getCountUsers(){	//checked
		return count($this->getAll("regdate", false));
	}	
	
		
	public function getAllCouriers(){
		return $this->getAllOnField('power_group', '1', "regdate");
	}
	
	public function getAllUsers(){	//checked
		return $this->getAll("regdate", false);
	}	
	
	public function getPageUsers($page){	//checked
		return $this->getPage($page, "power_group", false);
	}
	
	public function deleteUser($id){	//checked
		return $this->delete($id);
	}
	
	public function addUser($user){	//checked
		//if (!$this->checkValid($login, $password, $regdate)) return false;
		return $this->add($user);
	}

	public function editUser($id, $array){	//checked
		// if (!$this->checkValid($array['login'], $array['password'], $array['date'])) return false;
		return $this->edit($id, $array);
	}
	
	public function loginExists($login){	//checked
		return $this->isExists("login", $login);
		return true;
	}
	
	public function updateLastSessionTime($id){
		return $this->edit($id, array("last_session" => time()));
	}
	
	public function checkUser($login, $password){
		$user = $this->getUserOnLogin($login);
		if (!$user) return false;
		return $user['password'] === $password;
	}
	
	public function getUserOnLogin($login){	//checked
		$id = $this->getField("id", "login", $login);
		return $this->get($id);
	}	
	
	public function getIdOnLogin($login){	//checked
		$id = $this->getField("id", "login", $login);
		$user = $this->get($id);
		return $user['id'];
	}	
	
	public function getLoginOnId($id){	//checked=
		$user = $this->get($id);
		return $user['login'];
	}
	
	public function getUserOnId($id){
		return $this->get($id);
	}
	
	private function checkValid($login, $password, $date){	//checked
		if (!$this->valid->validLogin($login)) return false;
		if (!$this->loginExists($login)) return false;
	//	if (!$this->valid->validHash($password)) return false;
		if (!$this->valid->validTimeStamp($date)) return false;
		return true;
	}
	
	public function getRandomPass(){
		return substr(md5(uniqid(rand(),true)), 0, 8);
	}
}
?>
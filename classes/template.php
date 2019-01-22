<?php
Class Template {
 
	private $registry;
	private $vars = array();
	
function __construct($registry) {
	$this->registry = $registry;
}
		
	public function getReplaceTemplate($template, $values=null){
		$values['adress'] = $this->registry['adress'];
		$values['logout_link'] = $this->registry['logout_link'];
		if (!empty($_SESSION["login"])){
			$user = $this->registry['users']->getUserOnId($_SESSION["id"]);
			$values['callbackphone'] = $user['phone'];
			$val['countOrders']='2';
			//$values['refreshscript']=null;
			//$values['refreshscript']=($values['refreshscript']==null)?$values['refreshscript']=$this->getReplaceTemplate('ajax_refreshscript', $val):$values['refreshscript'];
			
			//$values['countOrders'] = $this->getTemplate('ajax_refreshscript');
		}
		else{
			$values['callbackphone'] = '';
			$values['refreshscript'] = '';
		}
		$values['notifications'] = $this->getTemplate('notification');
		
		return $this->getReplaceContent($this->getTemplate($template), $values);
	}
		
	protected function getTemplate($template){
		$path = site_path . 'tpl' . DIRSEP . $template . '.tpl';
		$text = file_get_contents($path);
		return($text);
	}
	
	protected function getReplaceContent($content, $values){
		if (empty($values['scripts'])) $values['scripts']='';
		$search = array();
		$replace = array();
		$i=0;
		foreach ($values as $key => $value){
			$search[$i] = "%".$key."%";
			$replace[$i] = $value;
			$i++;
		}
		return str_replace($search, $replace, $content);
	}

}
 
 
?>
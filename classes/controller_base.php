<?php
Abstract Class Controller_Base {

        protected $registry;

        function __construct($registry) {
                $this->registry = $registry;
        }
		protected function getRandomBanner(){
			switch (rand(1, 3)){
				case "1": $banner = "econombanner"; break;
				case "2": $banner = "expressbanner"; break;
				case "3": $banner = "waybillbanner"; break;
			}
			return $banner;
		}
		
		protected function getNotificationScript(){
			//для AJAX
			$values['refreshscript']='';
			$val='';
			if (!empty($_SESSION["login"])){
				//админ
				if ($this->registry['users']->getUserOnLogin($_SESSION["login"])['power_group']==2)
				{
					$val['countOrders'] = $this->registry['orders']->getCountOrders();
					$val['countCallbacks'] = $this->registry['callback']->getCountCallbacks();
					$values['refreshscript']=$this->registry['template']->getReplaceTemplate('ajax_refreshscript_admin', $val);
				}
				//курьер
				elseif ($this->registry['users']->getUserOnLogin($_SESSION["login"])['power_group']==1)
				{
					$val['id'] = $_SESSION["id"];
					$val['countOrders'] = $this->registry['orders']->getCountOrdersByCourier($_SESSION['id']);
					$values['refreshscript']=$this->registry['template']->getReplaceTemplate('ajax_refreshscript_courier', $val);
				}
				//юзер
				elseif ($this->registry['users']->getUserOnLogin($_SESSION["login"])['power_group']==0)
					$values['refreshscript']='';
			}
			return $values['refreshscript'];
		}
		
		protected function cutString($string, $length, $pointed=true, $part='name'){
			$string .=' '; 
			$string = strip_tags($string);
			$string=$part=='name'?explode(' ', $string)[1]:explode(' ', $string)[0];
			$string .=' '; 
			$string = substr($string, 0, $length);
			$string = rtrim($string, "!,.-");
			$string = substr($string, 0, strrpos($string, ' '));
			
			if ($pointed) return $string."… ";		
			return $string;
		}
		
		protected function getOrderColor($status){
			if ($status==1) return 'statusBlue';
			if ($status==2) return 'statusOrange';
			if ($status==3) return 'statusYellow';
			if ($status==4) return 'statusGreen';
			if ($status==0) return 'statusRed';
			return $color;
		}
		
		protected function getGroupColor($status){
			if ($status==0) return 'statusOrange';
			if ($status==1) return 'statusYellow';
			if ($status==2) return 'statusRed';
			return $color;
		}
		
		protected function getCallbackColor($status){
			if ($status==0) return 'statusBlue';
			if ($status==1) return 'statusOrange';
			return $color;
		}
		
        abstract function index();
}


?>
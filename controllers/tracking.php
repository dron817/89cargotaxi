<?php
Class Controller_tracking Extends Controller_Base {
	
        function index() {
					$values['refreshscript']=$this->getNotificationScript();
					if (!empty($_SESSION["login"])){
						$values['content'] = $this->registry['template']->getReplaceTemplate($this->getRandomBanner());
						
						$orders = $this->registry['orders']->getOrdersByUser($_SESSION["id"]);
						$res['orders']='';
						foreach ($orders as $order){
							$orderinfo['n'] = $order['id'];
							
							date_default_timezone_set("Europe/Moscow");
							$orderinfo['date'] = $order['orderdate']?date('d.m.y',$order['orderdate']).'г.':'';
							$orderinfo['way'] = $this->registry['db']->getFieldOnID('cities', $order['city'], 'city').' > '.$this->registry['db']->getFieldOnID('cities', $order['city2'], 'city');
							$orderinfo['weight'] = $order['weight'];
							$orderinfo['price'] = $order['payed'];
							$orderinfo['status'] = $order['status'];
							$res['orders'] .= $this->registry['template']->getReplaceTemplate('order', $orderinfo);
						}
						$values['content'] .= $this->registry['template']->getReplaceTemplate('tracking-form', $res);
					}
					else{
						if (!empty($_SESSION['error_auth'])){
							$values['message'] = $this->registry['template']->getReplaceTemplate('error_auth');
							unset($_SESSION['error_auth']);
						}
						else
							$values['message'] = '';
						$values['content'] = $this->registry['template']->getReplaceTemplate('auth-form', $values);
					}
					$values['content'] .= $this->registry['template']->getReplaceTemplate('calcblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('shipingblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('economblock');
				$content = $this->registry['template']->getReplaceTemplate('main', $values);
            echo $content;
        }
}
?>
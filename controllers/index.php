<?php
Class Controller_Index Extends Controller_Base {
	
        function index() {                               
					//echo $this->registry['email']->send('myroyalfamilydot@gmail.com', 'Тема', 'Сообщение</br>с тегами\n и такими');
					
					$values['refreshscript']=$this->getNotificationScript();
					$values['content'] = $this->registry['template']->getReplaceTemplate('slider');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('preview-block');
					if (!empty($_SESSION["login"])){
						$user = $this->registry['users']->getUserOnId($_SESSION["id"]);
						$values['FIO'] = $this->cutString($user['FIO'], 28, false);
						$values['user_phone'] = $user['phone'];
						if ($this->registry['users']->getUserOnLogin($_SESSION["login"])['power_group']==0) $values['count_orders'] = $this->registry['orders']->getCountOrdersByUser($_SESSION["id"]);
						if ($this->registry['users']->getUserOnLogin($_SESSION["login"])['power_group']==1) $values['count_orders'] = $this->registry['orders']->getCountOrdersByCourier($_SESSION["id"]);
						if ($this->registry['users']->getUserOnLogin($_SESSION["login"])['power_group']==2) $values['count_orders'] = $this->registry['orders']->getCountOrders();
						$values['discount'] = $user['discount'];
						$values['content'] .= $this->registry['template']->getReplaceTemplate('user-panel');
					}
					else
						$values['content'] .= $this->registry['template']->getReplaceTemplate('auth-block');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('calcblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('shipingblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('economblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('expressblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('assembledblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('statusblock');
				$content = $this->registry['template']->getReplaceTemplate('main', $values);
            echo $content;
        }
}
?>
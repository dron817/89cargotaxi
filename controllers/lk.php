<?php
Class Controller_lk Extends Controller_Base {
	
		function page($args=1){
			$this->index($args);
		}
	
        function index($args=1) {
					if (!empty($_SESSION["login"])){
						
						$values['refreshscript']=$this->getNotificationScript();
						$values['content'] = $this->registry['template']->getReplaceTemplate($this->getRandomBanner());
						$values['content'] .= $this->registry['template']->getReplaceTemplate('fast');
						//админ
						if ($this->registry['users']->getUserOnLogin($_SESSION["login"])['power_group']==2){
							//для AJAX
								$val['countOrders'] = $this->registry['orders']->getCountOrders();
								
							$res['header'] = $this->registry['template']->getReplaceTemplate('orders_header_admin', $val);
							
								
							//$orders = $this->registry['orders']->getAllOrders();
							if (($args==1)||($args==null)) {unset($args); $args[0]=1;}
							$orders = $this->registry['orders']->getPageOrders($args[0]);
							if ($orders!=null){
								$res['orders']='';
								foreach ($orders as $order){
									$orderinfo['n'] = $order['id'];
									date_default_timezone_set("Europe/Moscow");
									$orderinfo['date'] = $order['orderdate']?date('d.m.y',$order['orderdate']).'г.':'';
									$orderinfo['way'] = $this->registry['db']->getFieldOnID('cities', $order['city'], 'city').' > '.$this->registry['db']->getFieldOnID('cities', $order['city2'], 'city');
									$orderinfo['weight'] = $order['weight'];
									
									$priceinfo['id'] = $order['id'];
									$priceinfo['price'] = $order['payed'];
									$orderinfo['price'] = $this->registry['template']->getReplaceTemplate('price_option', $priceinfo);
									
									$couriers = $this->registry['users']->getAllCouriers();
									$orderinfo['couriers']='';
									foreach ($couriers as $courier){
										$courinfo['id'] = $courier['id'];
										$courinfo['name'] =  $this->cutString($courier['FIO'], 25, false);
										$courinfo['selected_id']=$this->itHisOrder($courier['id'], $order['id'])?'selected':'';
										$orderinfo['couriers'] .= $this->registry['template']->getReplaceTemplate('courier_option', $courinfo);
									}
									
									$orderinfo['selected_order']=($order['status']==1)?'selected':'';
									$orderinfo['selected_accepted']=($order['status']==2)?'selected':'';
									$orderinfo['selected_inway']=($order['status']==3)?'selected':'';
									$orderinfo['selected_done']=($order['status']==4)?'selected':'';
									$orderinfo['selected_cancel']=($order['status']==0)?'selected':'';
									
									$res['orders'] .= $this->registry['template']->getReplaceTemplate('order_admin', $orderinfo);
								}
							}
							else die ('404 Not Found');
							
							$n_pages =  ceil($this->registry['orders']->getCountOrders()/$this->registry['items_on_page']);
							$pages['pages']='';
							$pages['section']='lk';
							for ($i = 1; $i <= $n_pages; $i++){
								$n['n_page']=$i;
								$pages['pages'].=$args[0]==$n['n_page']?$this->registry['template']->getReplaceTemplate('page_selected', $n):$this->registry['template']->getReplaceTemplate('page_noselected', $n);
							}
							$res['pagination'] = $this->registry['template']->getReplaceTemplate('pagination', $pages);
							$values['content'] .= $this->registry['template']->getReplaceTemplate('lk', $res);
						}
						//курьер
						elseif ($this->registry['users']->getUserOnLogin($_SESSION["login"])['power_group']==1){
						//для AJAX
							$val['countOrders'] = $this->registry['orders']->getCountOrdersByCourier($_SESSION['id']);
							$val['id'] = $_SESSION['id'];
							
							$res['header'] = $this->registry['template']->getReplaceTemplate('orders_header_courier', $val);
							if (($args==1)||($args==null)) {unset($args); $args[0]=1;}
							$orders = $this->registry['orders']->getPageOrdersByCourier($_SESSION["id"], $args[0]);
							if ($orders!=null){
								$res['orders']='';
								foreach ($orders as $order){
									$orderinfo['n'] = $order['id'];
									date_default_timezone_set("Europe/Moscow");
									$orderinfo['date'] = $order['orderdate']?date('d.m.y',$order['orderdate']).'г.':'';
									$orderinfo['way'] = $this->registry['db']->getFieldOnID('cities', $order['city'], 'city').' > '.$this->registry['db']->getFieldOnID('cities', $order['city2'], 'city');
									$orderinfo['weight'] = $order['weight'];
									$orderinfo['price'] = $order['payed'];
									
									$couriers = $this->registry['users']->getAllCouriers();
									
									$orderinfo['selected_order']=($order['status']==1)?'selected':'';
									$orderinfo['selected_accepted']=($order['status']==2)?'selected':'';
									$orderinfo['selected_inway']=($order['status']==3)?'selected':'';
									$orderinfo['selected_done']=($order['status']==4)?'selected':'';
									$orderinfo['selected_cancel']=($order['status']==0)?'selected':'';
									
									$res['orders'] .= $this->registry['template']->getReplaceTemplate('order_courier', $orderinfo);
								}										
								$n_pages =  ceil($this->registry['orders']->getCountOrdersByCourier($_SESSION["id"])/$this->registry['items_on_page']);										
								$res['pagination'] = '';
								if ($n_pages>1){
									$pages['pages']='';
									$pages['section']='lk';
									for ($i = 1; $i <= $n_pages; $i++){
										$n['n_page']=$i;
										$pages['pages'].=$args[0]==$n['n_page']?$this->registry['template']->getReplaceTemplate('page_selected', $n):$this->registry['template']->getReplaceTemplate('page_noselected', $n);
									}
									$res['pagination'] = $this->registry['template']->getReplaceTemplate('pagination', $pages);
								}
								
							}
							else{
								$res['header']='Вы не получили ни одного заказа';
								$res['orders']='';
								$res['pagination']='';
							}
							$values['content'] .= $this->registry['template']->getReplaceTemplate('lk', $res);
						}
						//пользователь
						else{
							$res['header'] = $this->registry['template']->getReplaceTemplate('orders_header');
							
							if (($args==1)||($args==null)) {unset($args); $args[0]=1;}
							//$orders = $this->registry['orders']->getPageOrders($args[0]);
							$orders = $this->registry['orders']->getPageOrdersByUser($_SESSION["id"], $args[0]);
							if ($orders!=null){
								$res['orders']='';
								foreach ($orders as $order){
									$orderinfo['n'] = $order['id'];
									date_default_timezone_set("Europe/Moscow");
									$orderinfo['date'] = $order['orderdate']?date('d.m.Y',$order['orderdate']).'г.':'';
									$orderinfo['way'] = $this->registry['db']->getFieldOnID('cities', $order['city'], 'city').' > '.$this->registry['db']->getFieldOnID('cities', $order['city2'], 'city');
									$orderinfo['weight'] = $order['weight'].' кг.';
									$orderinfo['price'] = $order['payed'].' руб.';
									$orderinfo['status'] = $this->statusConvert($order['status']);
									$res['orders'] .= $this->registry['template']->getReplaceTemplate('order', $orderinfo);
								}										
								$n_pages =  ceil($this->registry['orders']->getCountOrdersByUser($_SESSION["id"])/$this->registry['items_on_page']);										
								$res['pagination'] = '';
								if ($n_pages>1){
									$pages['pages']='';
									$pages['section']='lk';
									for ($i = 1; $i <= $n_pages; $i++){
										$n['n_page']=$i;
										$pages['pages'].=$args[0]==$n['n_page']?$this->registry['template']->getReplaceTemplate('page_selected', $n):$this->registry['template']->getReplaceTemplate('page_noselected', $n);
									}
									$res['pagination'] = $this->registry['template']->getReplaceTemplate('pagination', $pages);
								}
							}
							else{
								$res['header']='<p>Вы не сделали ни одного заказа</p><p><a href="?route=order/econom" class="biglink">Сделать заказ</a></p>';
								$res['orders']='';
								$res['pagination']='';
							}							
							$values['content'] .= $this->registry['template']->getReplaceTemplate('lk', $res);
						}
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
					$values['scripts'] = $this->registry['template']->getReplaceTemplate('ajax');
				$content = $this->registry['template']->getReplaceTemplate('main', $values);
            echo $content;
        }
		
		function order($args){
			//проверяем доступ к данным
			$orders = $this->registry['orders']->getOrdersByUser($_SESSION["id"]);
			if ($this->registry['users']->getUserOnLogin($_SESSION["login"])['power_group']>0) $orders = $this->registry['orders']->getAllOrders($_SESSION["id"]);
			$f=0;
			foreach ($orders as $order) if ($order['id']==$args[0]) {$f=1; break;}
			if (($f==1)||($this->registry['users']->getUserOnLogin($_SESSION["login"])['power_group']==2)){				
				$values['content'] = $this->registry['template']->getReplaceTemplate($this->getRandomBanner());
				$values['content'] .= $this->registry['template']->getReplaceTemplate('fast');
				date_default_timezone_set("Europe/Moscow");
				$orderinfo['n'] = $order['id'];
				$orderinfo['type'] = $this->typeConvert($order['type']);
				$orderinfo['orderdate'] = date('d.m.Y',$order['orderdate']).'г.';
				$orderinfo['status'] = $this->statusConvert($order['status']);
				$orderinfo['payed'] = $this->payedConvert($order['payed']);
				$orderinfo['places'] = $order['places'];
				$orderinfo['description'] = $order['description'];
				$orderinfo['weight'] = $order['weight'];
				$orderinfo['email'] = $order['email'];
				$orderinfo['FIO'] = $order['FIO'];
				$orderinfo['phone'] = $order['phone'];
				$orderinfo['second_phone'] = $order['second_phone'];
				$orderinfo['organization'] = $order['organization'];
				$orderinfo['country'] = $this->registry['db']->getFieldOnID('countries', $order['country'], 'name');
				$orderinfo['region'] = $this->registry['db']->getFieldOnID('regions', $order['region'], 'region');
				$orderinfo['city'] = $this->registry['db']->getFieldOnID('cities', $order['city'], 'city');
				$orderinfo['orderadress'] = $order['adress'];
				$orderinfo['index'] = $order['index'];
				$orderinfo['note'] = $order['note'];
				$orderinfo['email2'] = $order['email2'];
				$orderinfo['FIO2'] = $order['FIO2'];
				$orderinfo['phone2'] = $order['phone2'];
				$orderinfo['second_phone2'] = $order['second_phone2'];
				$orderinfo['organization2'] = $order['organization2'];
				$orderinfo['country2'] = $this->registry['db']->getFieldOnID('countries', $order['country2'], 'name');
				$orderinfo['region2'] = $this->registry['db']->getFieldOnID('regions', $order['region2'], 'region');
				$orderinfo['city2'] = $this->registry['db']->getFieldOnID('cities', $order['city2'], 'city');
				$orderinfo['orderadress2'] = $order['adress2'];
				$orderinfo['index2'] = $order['index2'];
				$orderinfo['note2'] = $order['note2'];
				
				
				$values['content'] .= $this->registry['template']->getReplaceTemplate('orderinfo', $orderinfo);
				
				$values['content'] .= $this->registry['template']->getReplaceTemplate('calcblock');
				$values['content'] .= $this->registry['template']->getReplaceTemplate('shipingblock');
				$values['content'] .= $this->registry['template']->getReplaceTemplate('statusblock');
				$content = $this->registry['template']->getReplaceTemplate('main', $values);
				echo $content;
			}
			else{
				echo 'хуй тебе, умник .!.';
			}
		}
		
		function profile(){
				$values['content'] = $this->registry['template']->getReplaceTemplate($this->getRandomBanner());
				$values['scripts'] = $this->registry['template']->getReplaceTemplate('ajax');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('fast');
					if (!empty($_SESSION["login"])){
						
						if (!empty($_SESSION['error_auth'])){
							$values['message'] = $this->registry['template']->getReplaceTemplate('error_edit_user');
							unset($_SESSION['error_auth']);
						}
						else
							$values['message'] = '';
						
						$profile=$this->registry['users']->getUserOnLogin($_SESSION["login"]);
						$val['FIO']=$profile['FIO'];
						$val['phone']=$profile['phone'];
						$val['second-phone']=$profile['second_phone'];
						$val['organization']=$profile['organization'];
						$val['vk_link']=$profile['vk_link'];
						$val['facebook_link']=$profile['facebook_link'];
								
						$val['counries_options']='';
						$table_name= "countries";
						$order = "id";
						$up = true;
						$rows = $this->registry['db']->getAll($table_name, $order, $up);
						foreach ($rows as $numRow => $row) {
							$selected =($profile['country']==$row['id'])?'selected':'';
							$val['counries_options'] .= "<option $selected value='".$row['id']."'>".$row['name']."</option>";
						};
						
						$val['regions_options']='';
						$table_name= "regions";
						$field = "country_id";
						$value = $profile['country'];
						$order = "region";
						$up = true;
						$rows = $this->registry['db']->getAllOnfield($table_name, $field, $value, $order, $up);
						foreach ($rows as $numRow => $row) {
							$selected =($profile['region']==$row['id'])?'selected':'';
							$val['regions_options'] .= "<option $selected value='".$row['id']."'>".$row['region']."</option>";
						};
						
						$val['cities_options']='';
						$table_name= "cities";
						$field = "id_region";
						$value = $profile['region'];
						$order = "city";
						$up = true;
						$rows = $this->registry['db']->getAllOnfield($table_name, $field, $value, $order, $up);
						foreach ($rows as $numRow => $row) {
							$selected =($profile['city']==$row['id'])?'selected':'';
							$val['cities_options'] .= "<option $selected value='".$row['id']."'>".$row['city']." (".$row['state'].")</option>";
						};
						
						$val['urseadress']=$profile['adress'];
						$val['index']=$profile['index'];
						$values['content'] .= $this->registry['template']->getReplaceTemplate('profile', $val);
					}
					else{
						$values['content'] .= $this->registry['template']->getReplaceTemplate('auth-form', $values);
					}
					$values['content'] .= $this->registry['template']->getReplaceTemplate('calcblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('shipingblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('statusblock');
				$content = $this->registry['template']->getReplaceTemplate('main', $values);
            echo $content;
		}  
		
		function adressbook(){
				$values['content'] = $this->registry['template']->getReplaceTemplate($this->getRandomBanner());
					$values['content'] .= $this->registry['template']->getReplaceTemplate('fast');
					$val['mesage']='Раздел в разработке';
					$values['content'] .= $this->registry['template']->getReplaceTemplate('in_work', $val);
					$values['content'] .= $this->registry['template']->getReplaceTemplate('calcblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('shipingblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('statusblock');
				$content = $this->registry['template']->getReplaceTemplate('main', $values);
            echo $content;
		}
		
		function users($args=1){
				$values['content'] = $this->registry['template']->getReplaceTemplate($this->getRandomBanner());
				$values['content'] .= $this->registry['template']->getReplaceTemplate('fast');
				$values['scripts'] = $this->registry['template']->getReplaceTemplate('ajax');
					
					$res['header'] = $this->registry['template']->getReplaceTemplate('users_header');
					if ($this->registry['users']->getUserOnId($_SESSION["id"])['power_group']!=2)  die ('404 Not Found');
					if (($args==1)||($args==null)) {unset($args); $args[0]=1;} else $args[0]=$args[1];
					$users = $this->registry['users']->getPageUsers($args[0]);
					$res['users']='';
					foreach ($users as $user){
						$userinfo['n'] = $user['id'];
						
						date_default_timezone_set("Europe/Moscow");
						$userinfo['regdate'] = $user['regdate']?date('d.m.y',$user['regdate']).'г.':'';
						$userinfo['login'] = $user['login'];
						$userinfo['id'] = $user['id'];
						
						if (empty($user['vk_link']) & (empty($user['facebook_link']))){
							$userinfo['social'] = '';
						}
						else{
							$userinfo['social'] = '';
							if (!empty($user['vk_link'])){
								$link['vk_link'] = "http://".$user['vk_link'];
								$userinfo['social'] = $this->registry['template']->getReplaceTemplate('vk_link', $link);
							}
							if (!empty($user['facebook_link'])){
								$link['facebook_link'] = "http://".$user['facebook_link'];
								$userinfo['social'] .= $this->registry['template']->getReplaceTemplate('facebook_link', $link);
							}
						}
						$userinfo['n_orders'] = $this->registry['orders']->getCountOrdersByUser($user['id'])+$this->registry['orders']->getCountOrdersByCourier($user['id']);
						$userinfo['selected_user']=$user['power_group']==0?'selected':'';
						$userinfo['selected_courier']=$user['power_group']==1?'selected':'';
						$userinfo['selected_admin']=$user['power_group']==2?'selected':'';
						$res['users'] .= $this->registry['template']->getReplaceTemplate('user_info', $userinfo);
					}
					$n_pages = $this->registry['users']->getCountUsers($_SESSION["id"])/$this->registry['items_on_page'];										
					$res['pagination'] = '';
					if ($n_pages>1){
						$pages['pages']='';
						$pages['section'] = 'lk/users';
						for ($i = 1; $i < $n_pages+1; $i++){
							$n['n_page']=$i;
							$pages['pages'].=$args[0]==$n['n_page']?$this->registry['template']->getReplaceTemplate('page_selected', $n):$this->registry['template']->getReplaceTemplate('page_noselected', $n);
						}
						$res['pagination'] = $this->registry['template']->getReplaceTemplate('pagination', $pages);
					}
					$values['content'] .= $this->registry['template']->getReplaceTemplate('users', $res);
					$values['content'] .= $this->registry['template']->getReplaceTemplate('calcblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('shipingblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('statusblock');
				$content = $this->registry['template']->getReplaceTemplate('main', $values);
            echo $content;
		}
		
		function discount(){
				$values['content'] = $this->registry['template']->getReplaceTemplate($this->getRandomBanner());
					$values['content'] .= $this->registry['template']->getReplaceTemplate('fast');
					if (!empty($_SESSION["login"])){
						$profile=$this->registry['users']->getUserOnLogin($_SESSION["login"]);
						$val['discount']=$profile['discount'];
						$values['content'] .= $this->registry['template']->getReplaceTemplate('discount', $val);
					}
					else{
						$values['content'] .= $this->registry['template']->getReplaceTemplate('auth-form', $values);
					}
					$values['content'] .= $this->registry['template']->getReplaceTemplate('calcblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('shipingblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('statusblock');
				$content = $this->registry['template']->getReplaceTemplate('main', $values);
            echo $content;
		}
		
		private function itHisOrder($courier, $order){
			return $this->registry['orders']->getOrderOnId($order)['courier']==$courier;
		}
		
		private function typeConvert($type){
				$type=$type=="econom"?"Эконом":$type;
				$type=$type=="express"?"Экспресс":$type;
				$type=$type=="assembled"?"Сборный груз":$type;
			return $type;
		}
		
		private function statusConvert($status){
				$status=$status=="1"?"Оформлен":$status;
				$status=$status=="2"?"Принят":$status;
				$status=$status=="3"?"В пути":$status;
				$status=$status=="4"?"Доставлен":$status;
				$status=$status=="0"?"Отклонён":$status;
			return $status;
		}
		private function payedConvert($payed){
			return"Информация недоступна";
			
				$payed=$payed=="wait"?"Ожидает обработки":$payed;
			return $payed;
		}
}
?>
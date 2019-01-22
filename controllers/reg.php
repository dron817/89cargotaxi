<?php
Class Controller_reg Extends Controller_Base {
	
        function index() {
			$values['refreshscript']=$this->getNotificationScript();
			$values['scripts'] = $this->registry['template']->getReplaceTemplate('ajax');
					if (!empty($_SESSION["login"])){
						header("Location: http://localhost/");
					}
					else {
						$msg['err_msg']=isset($_SESSION['no_capcha'])?'Подтвердите, что вы не робот':'';
						unset($_SESSION['no_capcha']);
						$values['content'] = $this->registry['template']->getReplaceTemplate('userbanner');
						$values['content'] .= $this->registry['template']->getReplaceTemplate('reg-form', $msg);
					}
					$values['content'] .= $this->registry['template']->getReplaceTemplate('calcblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('shipingblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('statusblock');
				$content = $this->registry['template']->getReplaceTemplate('main', $values);
            echo $content;
        }
}
?>
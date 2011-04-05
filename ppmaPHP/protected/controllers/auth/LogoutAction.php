<?php
class LogoutAction extends CAction{

	function run()
	{
		$controller = $this->controller;
		if(Yii::app()->user->isGuest)
			$controller->redirect('auth');
		else 
		{
			Yii::app()->user->logout();
			$controller->redirect(Yii::app()->user->returnUrl);
		}
	}
	
}